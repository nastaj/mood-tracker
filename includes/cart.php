<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$cartCount = 0;
if (!empty($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $item) {
        $cartCount += $item['quantity'];
    }
}

echo '
                <!-- Shopping Cart -->
                <div class="relative">
                    <button id="cartBtn" class="relative hover:cursor-pointer hover:bg-black/20 rounded-full p-1" onclick="toggleCartModal()">
                        <img src="./assets/img/shopping-cart.png" alt="Shopping cart icon" width="32" height="32">
                    </button>
                    <span id="cart-count" class="absolute -top-0.5 right-0 transform translate-x-1/2 -translate-y-1/2 bg-red-500 text-white text-xs font-semibold rounded-full px-2 py-1">';
                    echo $cartCount;
                    echo '</span>

                    <div id="cartModal" class="hidden absolute right-0 top-12 z-50">
                        <div class="bg-white p-8 rounded-lg shadow-2xl flex flex-col items-center w-100">
                            <h2 class="text-xl font-semibold mb-6 border-b border-gray-400 pb-4 w-full text-center">Shopping Cart</h2>
                            <div id="cart-items" class="w-full mb-4">';
                            // Cart items will be dynamically loaded here
                            include './api/cart/get_cart_items.php';
                                
echo '
                            </div>
                            <button id="checkoutBtn" class="bg-green-500 hover:bg-green-700 cursor-pointer text-white rounded px-4 py-2 w-full mb-3 text-lg">Checkout</button>  
                            <button id="closeCartModal" class="px-4 py-2 bg-gray-300 hover:bg-gray-400 cursor-pointer rounded w-full text-lg" onclick="toggleCartModal()">Close</button>
                        </div>
                    </div>
                </div>
'
?>