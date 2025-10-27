<?php
require_once '../../config/db_connect.php';

// Get filters from request
$price_from = $_GET['price_from'] ?? null;
$price_to = $_GET['price_to'] ?? null;
$category_id = $_GET['category_id'] ?? null;
$sort_by = $_GET['sort_by'] ?? 'most-recent'; // most-recent, available, price-ascending, price-descending, rating
$search_string = $_GET['search'] ?? null;

// Build WHERE clause
$where = [];
$params = [];
$types = "";

// Price filters
if (!empty($price_from)) {
    $where[] = "m.price >= ?";
    $params[] = $price_from;
    $types .= "d"; // decimal
}
if (!empty($price_to)) {
    $where[] = "m.price <= ?";
    $params[] = $price_to;
    $types .= "d";
}

// Category filter
if (!empty($category_id)) {
    $where[] = "m.category_id = ?";
    $params[] = $category_id;
    $types .= "i";
}

// Search filter
if (!empty($search_string)) {
    $where[] = "m.name LIKE ?";
    $params[] = "%$search_string%";
    $types .= "s";
}

$where_clause = $where ? "WHERE " . implode(" AND ", $where) : "";

// Build ORDER BY clause
$order_by = match($sort_by) {
    'most-recent' => 'm.merch_id DESC',
    'availability' => 'm.stock_quantity DESC',
    'price-ascending' => 'm.price ASC',
    'price-descending' => 'm.price DESC',
    'rating' => 'avg_rating DESC', 
    default => 'm.merch_id DESC',
};

// Query merch items with average rating
$sql = "
SELECT 
    m.merch_id,
    m.name,
    m.price,
    m.stock_quantity,
    m.description,
    m.image_url,
    ROUND(AVG(r.rating), 1) AS avg_rating,
    COUNT(r.rating_id) AS rating_count
FROM merch m
LEFT JOIN merch_ratings r ON m.merch_id = r.merch_id
$where_clause
GROUP BY m.merch_id, m.name, m.price, m.stock_quantity, m.description, m.image_url
ORDER BY $order_by
";

$stmt = $conn->prepare($sql);
if ($params) {
    $stmt->bind_param($types, ...$params);
}
$stmt->execute();
$result = $stmt->get_result();

// Get wishlist from cookie
$wishlist = [];
if (isset($_COOKIE['wishlist'])) {
    $wishlist = json_decode($_COOKIE['wishlist'], true);
    if (!is_array($wishlist)) $wishlist = [];
}

// Generate HTML for each merch item
while ($item = $result->fetch_assoc()) {
    $availability = ($item['stock_quantity'] > 0) ? 'In Stock' : 'Out of Stock';

    // Check if item is in wishlist
    $isInWishlist = in_array($item['merch_id'], $wishlist);
    $wishlistClasses = $isInWishlist 
        ? 'fa-solid fa-heart text-red-500'  // filled heart
        : 'fa-regular fa-heart text-gray-400'; // outline heart

    // Calculate number of full stars, half star, and empty stars
    $avg_rating = floatval($item['avg_rating']);
    $full_stars = floor($avg_rating);
    $half_star = ($avg_rating - $full_stars) >= 0.5 ? 1 : 0;
    $empty_stars = 5 - $full_stars - $half_star;

    echo '<article class="relative border border-gray-300 rounded p-4">';
    echo '<button class="wishlist-btn absolute top-2 right-2 text-gray-400 hover:text-red-500 hover:cursor-pointer transition-all" data-merch-id="' . $item['merch_id'] . '">
          <i class="' . $wishlistClasses . '"></i>
          </button>';
    echo '<img src="' . htmlspecialchars($item['image_url']) . '" alt="' . htmlspecialchars($item['name']) . '" class="w-full h-48 object-cover rounded mb-4" onerror="this.src=\'./assets/img/placeholder.png\';">';
    echo '<a href="./product.php?id=' . $item['merch_id'] . '" class="block font-semibold mb-2 hover:text-blue-600 cursor-pointer transition-all">' . htmlspecialchars($item['name']) . '</a>';

    // Star rating display
    echo '<div class="flex items-center mb-2">';
    for ($i = 0; $i < $full_stars; $i++) {
        echo '<i class="fas fa-star text-yellow-400"></i>'; // full star
    }
    if ($half_star) {
        echo '<i class="fas fa-star-half-alt text-yellow-400"></i>'; // half star
    }
    for ($i = 0; $i < $empty_stars; $i++) {
        echo '<i class="far fa-star text-gray-300"></i>'; // empty star
    }
    echo '<span class="ml-2 text-sm text-gray-500">(' . ($item['rating_count'] ?? 0) . ' reviews)</span>';
    echo '</div>';

    echo '<div class="flex justify-between mb-4">';
    echo '<p class="text-gray-700 mb-2 font-semibold">€' . number_format($item['price'], 2) . '</p>';
    echo '<p class="text-green-600 text-sm font-semibold">' . $availability . '</p>';
    echo '</div>';
    echo '<button class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 hover:cursor-pointer transition-all add-to-cart" onclick="addToCart(' . $item['merch_id'] . ')">Add to Cart</button>';
    echo '</article>';
}

$stmt->close();
$conn->close();
?>
