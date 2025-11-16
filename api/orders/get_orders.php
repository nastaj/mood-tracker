<?php
require_once "../../config/db_connect.php";
session_start();
header('Content-Type: application/json');

// Ensure user is logged in
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'User not logged in']);
    exit;
}

$user_id = $_SESSION['user_id'];

// 1. Get all orders for this user
$sql = "
SELECT 
    o.merch_order_id,
    o.merch_id,
    o.quantity,
    o.total_price,
    o.order_date,
    m.name AS merch_name,
    m.image_url,
    m.price AS unit_price
FROM merch_orders o
JOIN merch m ON o.merch_id = m.merch_id
WHERE o.user_id = ?
ORDER BY o.order_date DESC
";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

// 2. Group orders by order date
$orders = [];
while ($row = $result->fetch_assoc()) {
    $order_date = $row['order_date'];
    $orders[$order_date][] = $row;
}

$stmt->close();
$conn->close();

// Generate HTML
$html = '';

if (empty($orders)) {
    $html .= '<p class="text-gray-500 text-xl">You have no orders yet.</p>';
}

foreach ($orders as $order_items) {
    // Calculate subtotal
    $subtotal = 0;
    foreach ($order_items as $item) {
        $subtotal += $item['unit_price'] * $item['quantity'];
    }
    $tax = $subtotal * (23 / 123); // included tax
    $delivery_fee = $subtotal > 50 ? 0 : 5;
    $total = $subtotal + $delivery_fee;

    // Each order card
    $html .= '<div class="w-full max-w-4xl bg-white rounded-xl shadow p-6 mb-6">';
    
    // Order header (take date from first item)
    $order_date = $order_items[0]['order_date'];
    $html .= '<div class="flex justify-between items-center mb-4">';
    $html .= '<h2 class="text-xl font-semibold">Order on ' . htmlspecialchars($order_date) . '</h2>';
    $html .= '</div>';

    // Order items
    $html .= '<div class="flex flex-col gap-4 border-t border-b py-4">';
    foreach ($order_items as $item) {
        $html .= '<div class="flex items-center gap-4">';
        $html .= '<img src="' . htmlspecialchars($item['image_url']) . '" alt="Product" class="w-20 h-20 object-cover rounded">';
        $html .= '<div class="flex flex-col">';
        $html .= '<h3 class="font-bold">' . htmlspecialchars($item['merch_name']) . '</h3>';
        $html .= '<p class="text-gray-500 text-sm">Quantity: ' . intval($item['quantity']) . '</p>';
        $html .= '<p class="text-gray-500 text-sm">€' . number_format($item['unit_price'], 2) . ' each</p>';
        $html .= '</div></div>';
    }
    $html .= '</div>'; // end items

    // Order summary
    $html .= '<div class="mt-4 border-t pt-4 flex flex-col gap-2">';
    $html .= '<div class="flex justify-between text-gray-700"><span>Tax Included (23%):</span><span>€' . number_format($tax, 2) . '</span></div>';
    $html .= '<div class="flex justify-between text-gray-700"><span>Delivery Fee:</span><span>€' . number_format($delivery_fee, 2) . '</span></div>';
    $html .= '<div class="flex justify-between font-bold text-lg"><span>Total:</span><span>€' . number_format($total, 2) . '</span></div>';
    $html .= '</div>'; // end summary

    $html .= '</div>'; // END order card
}

$html .= '</div>'; // END orders-container

echo json_encode(['success' => true, 'html' => $html]);
?>
