<?php
require_once './config/db_connect.php';

// Get wishlist items from cookie
$wishlist = [];
if (isset($_COOKIE['wishlist'])) {
    $wishlist = json_decode($_COOKIE['wishlist'], true);
    if (!is_array($wishlist)) {
        $wishlist = [];
    }
}

// If wishlist is empty, exit early
if (empty($wishlist)) {
    echo '<p class="text-center text-3xl mb-4">Your wishlist is empty.</p>';
    echo '<p class="text-center text-xl">Add some items to your wishlist!</p>';
    echo '<a href="./merch.php" class="text-white px-4 py-2 bg-primary-orange rounded text-center text-2xl">Browse Products</a>';
    exit;
}

// Build dynamic placeholders (?, ?, ?, ...)
$placeholders = implode(',', array_fill(0, count($wishlist), '?'));

// Prepare SQL with dynamic placeholders
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
WHERE m.merch_id IN ($placeholders)
GROUP BY m.merch_id
";

$stmt = $conn->prepare($sql);

// Build types string (all integers)
$types = str_repeat('i', count($wishlist));

// Bind all IDs dynamically
$stmt->bind_param($types, ...$wishlist);

$stmt->execute();
$result = $stmt->get_result();

while ($item = $result->fetch_assoc()) {
    $availability = ($item['stock_quantity'] > 0) ? 'In Stock' : 'Out of Stock';

    // Calculate number of full stars, half star, and empty stars
    $avg_rating = floatval($item['avg_rating']);
    $full_stars = floor($avg_rating);
    $half_star = ($avg_rating - $full_stars) >= 0.5 ? 1 : 0;
    $empty_stars = 5 - $full_stars - $half_star;

    echo '<article class="relative border border-gray-300 rounded p-4">';
    echo '<img src="' . htmlspecialchars($item['image_url']) . '" alt="' . htmlspecialchars($item['name']) . '" class="w-full h-72 object-cover rounded mb-4" onerror="this.src=\'./assets/img/placeholder.png\';">';
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
    echo  '<div class="flex gap-4">';
    echo '<button class="add-to-cart-btn px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 hover:cursor-pointer transition-all add-to-cart" data-id="' . $item['merch_id'] . '">Add to Cart</button>';
    echo '<button class="remove-wishlist-btn px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 hover:cursor-pointer transition-all" data-id="' . $item['merch_id'] . '">Remove from Wishlist</button>';
    echo  '</div>';
    echo '</article>';
}

$stmt->close();
$conn->close();
?>