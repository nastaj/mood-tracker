<?php
session_start();
require_once '../../config/db_connect.php';

$merch_id = $_POST['merch_id'] ?? null;
$quantity = $_POST['quantity'] ?? 1;

if (!$merch_id) {
    http_response_code(400);
    echo "Invalid merch ID.";
    exit;
}

// Fetch merch details from database
$stmt = $conn->prepare("SELECT merch_id, name, price, image_url FROM merch WHERE merch_id = ?");
$stmt->bind_param("i", $merch_id);
$stmt->execute();
$item = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$item) {
    http_response_code(404);
    echo "Item not found.";
    exit;
}

// Initialize cart if empty
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Check if item already exists in cart
$found = false;
foreach ($_SESSION['cart'] as $key => $cart_item) {
    if ($cart_item['merch_id'] == $merch_id) {
        $_SESSION['cart'][$key]['quantity'] += $quantity;
        $found = true;
        break;
    }
}

// Add new item if not found
if (!$found) {
    $_SESSION['cart'][] = [
        'merch_id' => $item['merch_id'],
        'name' => $item['name'],
        'price' => $item['price'],
        'image_url' => $item['image_url'],
        'quantity' => $quantity
    ];
}

echo json_encode(['status' => 'success', 'cart' => $_SESSION['cart']]);
?>
