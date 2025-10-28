<?php
require_once("./config/db_connect.php");

// Start session to access cart data
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!empty($_SESSION['cart'])) {
    $user_id = $_SESSION['user_id'];

    // Fetch customer details
    $sql = "
    SELECT 
    first_name,
    last_name,
    payment_method,
    address
    FROM customer_details
    WHERE user_id = ?
    ";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $customer = null;
    if ($row = $result->fetch_assoc()) {
        $customer = $row;
    } else {
        echo '<p class="text-red-500">Please fill in your payment details.</p>';
        exit;
    }

    // Map payment method to readable format
    $payment_method = '';
    switch ($customer['payment_method']) {
        case 'credit-card':
            $payment_method = 'Credit Card';
            break;
        case 'paypal':
            $payment_method = 'PayPal';
            break;
        case 'bank-transfer':
            $payment_method = 'Bank Transfer';
            break;
        default:
            $payment_method = 'Unknown';
    }

    // Calculate totals and generate order summary
    $subtotal = 0;
    $tax = 0;
    $delivery_fee = 0;
    $total = 0;

    foreach ($_SESSION['cart'] as $item) {
        $subtotal += $item['price'] * $item['quantity'];
        $tax += ($item['price'] * $item['quantity']) * (23 / 123);
        $delivery_fee = ($subtotal > 50) ? 0 : 5;
        $total = $subtotal + $delivery_fee;


        echo '<div class="flex gap-4 mb-8">';
        echo '    <img src="' . $item['image_url'] . '" alt="Product Image" class="w-16 h-16 object-cover mr-4">';
        echo '     <div class="flex flex-col justify-between">';
        echo '        <h3 class="font-semibold">' . $item['name'] . '</h3>';
        echo '        <p class="text-sm text-gray-500">x ' . number_format($item['quantity'], 0) . '</p>';
        echo '        <p class="text-sm text-gray-500">€' . number_format($item['price'], 2) . '</p>';
        echo '     </div>';
        echo '</div>';
    }

    // Display totals and customer details
    echo '<div class="border-b border-t border-gray-300 py-2">';
    echo '    <p>' . htmlspecialchars($customer['first_name']) . ' ' . htmlspecialchars($customer['last_name']) . '</p>';
    echo '    <p>' . htmlspecialchars($payment_method) . '</p>';
    echo '    <p>' . htmlspecialchars($customer['address']) . '</p>';
    echo '</div>';
    echo '<div class="flex justify-between">';
    echo '    <span>Tax Included (23%):</span>';
    echo '    <span>€' . number_format($tax, 2) . '</span>';
    echo '</div>';
    echo '<div class="flex justify-between border-b border-gray-300 pb-2">';
    echo '    <span>Delivery:</span>';
    echo '    <span>€' . number_format($delivery_fee, 2) . '</span>';
    echo '</div>';
    echo '<div class="flex justify-between font-bold">';
    echo '    <span>Total:</span>';
    echo '    <span>€' . number_format($total, 2) . '</span>';
    echo '</div>';

    $stmt->close();
} else {
    echo '<p class="text-xl">Your cart is empty.</p>';
}
?>