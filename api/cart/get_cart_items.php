<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$cart = $_SESSION['cart'] ?? [];

$total = 0;
foreach ($cart as $item) {
    $total += $item['price'] * $item['quantity'];
}

if (empty($cart)) {
    echo '<p class="mb-4">Your cart is empty.</p>';
}

if(!empty($cart)) {
    foreach ($cart as $item) {
        echo '<div class="cart-item flex items-center gap-3 mb-5">';
        echo '<img src="' . htmlspecialchars($item['image_url']) . '" class="w-16 h-16 object-cover rounded">';
        echo '<div class="mr-auto">';
        echo '<p class="font-semibold">' . htmlspecialchars($item['name']) . '</p>';
        echo '<p class="quantity">€' . number_format($item['price'], 2) . ' × ' . $item['quantity'] . '</p>';
        echo '</div>';
        echo '<button class="text-red-500 underline remove-item" onclick="removeFromCart(' . $item['merch_id'] . ')">';
        echo '<i class="fas fa-remove"></i>';
        echo '</button>';
        echo '</div>';
    }

    echo '<p class="text-right font-semibold mt-4 border-t border-gray-400 pt-2">Total: €' . number_format($total, 2) . '</p>';
}
    