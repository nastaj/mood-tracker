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
        echo '<a href="./product.php?id=' . $item['merch_id'] . '" class="font-semibold">' . htmlspecialchars($item['name']) . '</a>';
        echo '<p class="quantity">€' . number_format($item['price'], 2) . ' × ' . $item['quantity'] . '</p>';
        echo '</div>';
        echo '<button class="remove-from-cart-btn text-red-500 underline remove-item cursor-pointer" data-id="' . $item['merch_id'] . '">';
        echo '<i class="remove-from-cart-btn fas fa-remove" data-id="' . $item['merch_id'] . '"></i>';
        echo '</button>';
        echo '</div>';
    }

    echo '<p class="text-right font-semibold mt-4 border-t border-gray-400 pt-2">Total: €' . number_format($total, 2) . '</p>';
}
    