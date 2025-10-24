<?php
require_once '../../config/db_connect.php';

// Get filters from request
$price_from = $_GET['price_from'] ?? null;
$price_to = $_GET['price_to'] ?? null;
$category_id = $_GET['category_id'] ?? null;
$sort_by = $_GET['sort_by'] ?? 'recent'; // recent, oldest, highest
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
    'oldest' => 'm.merch_id ASC',
    'highest' => 'm.price DESC',
    'lowest' => 'm.price ASC',
    default => 'm.merch_id DESC' // recent
};

// Query merch items
$sql = "
SELECT 
    m.merch_id,
    m.name,
    m.price,
    m.stock_quantity,
    m.description,
    m.image_url
FROM merch m
$where_clause
ORDER BY $order_by
";

$stmt = $conn->prepare($sql);
if ($params) {
    $stmt->bind_param($types, ...$params);
}
$stmt->execute();
$result = $stmt->get_result();

// Generate HTML for each merch item
while ($item = $result->fetch_assoc()) {
    $availability = ($item['stock_quantity'] > 0) ? 'Available' : 'Out of Stock';
    echo '<article class="border border-gray-300 rounded p-4">';
    echo '<img src="' . htmlspecialchars('./assets/img/placeholder.png') . '" alt="' . htmlspecialchars($item['name']) . '" class="w-full h-auto mb-4">';
    echo '<a class="mb-3 font-semibold">' . htmlspecialchars($item['name']) . '</a>';
    echo '<div class="flex justify-between mb-4">';
    echo '<p class="text-gray-700 mb-2 font-semibold">€' . number_format($item['price'], 2) . '</p>';
    echo '<p>' . $availability . '</p>';
    echo '</div>';
    echo '<button class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Add to Cart</button>';
    echo '</article>';
}

$stmt->close();
$conn->close();
?>
