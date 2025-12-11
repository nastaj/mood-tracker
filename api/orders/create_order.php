<?php
require_once "../../config/db_connect.php";
include '../../includes/auth.php';

header('Content-Type: application/json');

if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    echo json_encode(['success' => false, 'message' => 'Your cart is empty.']);
    exit;
}

$user_id = $_SESSION['user_id'];

// Calculate subtotals
$subtotal = 0;

foreach ($_SESSION['cart'] as $item) {
    $subtotal += $item['price'] * $item['quantity'];
}

// Tax
$tax = $subtotal * (23 / 123);

// Delivery
$delivery_fee = ($subtotal > 50) ? 0 : 5;

// Final total
$final_total = $subtotal + $delivery_fee;

$stmt = $conn->prepare("
    INSERT INTO merch_orders (user_id, merch_id, quantity, total_price)
    VALUES (?, ?, ?, ?)
");

if (!$stmt) {
    echo json_encode(['success' => false, 'message' => 'Database error: Could not prepare statement']);
    exit;
}

$stmt->bind_param("iiid", $user_id, $merch_id, $quantity, $total_price);

foreach ($_SESSION['cart'] as $item) {
    $merch_id   = (int)$item['merch_id'];
    $quantity   = (int)$item['quantity'];
    $unit_price = (float)$item['price'];

    // Store full final price (subtotal + delivery + tax)
    $total_price = $final_total;

    if (!$stmt->execute()) {
        echo json_encode(['success' => false, 'message' => 'Error creating order']);
        exit;
    }
}

// Update stock quantities
$update_stmt = $conn->prepare("
    UPDATE merch
    SET stock_quantity = stock_quantity - ?
    WHERE merch_id = ?
");

$update_stmt->bind_param("ii", $quantity, $merch_id);

foreach ($_SESSION['cart'] as $item) {
    $merch_id   = (int)$item['merch_id'];
    $quantity   = (int)$item['quantity'];

    if (!$update_stmt->execute()) {
        echo json_encode(['success' => false, 'message' => 'Error updating stock']);
        exit;
    }
}

// Clear cart after order creation
unset($_SESSION['cart']);

$stmt->close();
$conn->close();

echo json_encode(['success' => true, 'message' => 'Order successfully created!']);
?>
