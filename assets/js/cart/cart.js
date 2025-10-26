const cartItems = document.getElementById("cart-items");

function updateCartCount(action, quantity = 1) {
    const cartCountEl = document.getElementById("cart-count");
    cartCountEl.textContent = parseInt(cartCountEl.textContent) + (action === 'add' ? quantity : -quantity);
}

async function addToCart(merchId, quantity = 1) {
    const formData = new FormData();
    formData.append('merch_id', merchId);
    formData.append('quantity', quantity);

    try {
        // Send POST request to add item to cart
        await fetch('./api/cart/add_to_cart.php', {
            method: 'POST',
            body: formData
        });

        updateCartCount('add', quantity);

        Toastify({
            text: `👍 Added ${quantity} item${quantity > 1 ? 's' : ''} to cart`,
            duration: 2000,
            gravity: "top",
            position: "center",
            style: {
                background: "linear-gradient(to right, #00b09b, #96c93e)",
            },
        }).showToast();

        // Update cart modal content
        const res = await fetch('./api/cart/get_cart_items.php');
        const html = await res.text();
        cartItems.innerHTML = html;
    } catch (error) {
        Toastify({
            text: `❌ Failed to add item to cart: ${error.message}`,
            duration: 2000,
            gravity: "top",
            position: "center",
            style: {
                background: "linear-gradient(to right, #ff5f5f, #ffcccb)",
            },
        }).showToast();
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
        Toastify({
            text: `❌ Failed to remove item from cart: ${error.message}`,
            duration: 2000,
            gravity: "top",
            position: "center",
            style: {
                background: "linear-gradient(to right, #ff5f5f, #ffcccb)",
            },
        }).showToast();
    }
}