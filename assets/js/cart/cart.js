const cartItems = document.getElementById("cart-items");

function updateCartCount(action) {
    const cartCountEl = document.getElementById("cart-count");
    cartCountEl.textContent = parseInt(cartCountEl.textContent) + (action === 'add' ? 1 : -1);
}

async function addToCart(merchId) {
    const formData = new FormData();
    formData.append('merch_id', merchId);

    try {
        // Send POST request to add item to cart
        await fetch('./api/cart/add_to_cart.php', {
            method: 'POST',
            body: formData
        });

        updateCartCount('add');

        // Update cart modal content
        const res = await fetch('./api/cart/get_cart_items.php');
        const html = await res.text();
        cartItems.innerHTML = html;
    } catch (error) {
        console.error('Error adding item to cart:', error);
    }
}

async function removeFromCart(merchId) {
    const formData = new FormData();
    formData.append('merch_id', merchId);

    try {
        // Send POST request to remove item from cart
        await fetch('./api/cart/remove_from_cart.php', {
            method: 'POST',
            body: formData
        });

        updateCartCount('remove');

        // Update cart modal content
        const res = await fetch('./api/cart/get_cart_items.php');
        const html = await res.text();
        cartItems.innerHTML = html;
    } catch (error) {
        console.error('Error removing item from cart:', error);
    }
}