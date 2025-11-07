import showToast from "../toast";

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
        showToast('success', `👍 Added ${quantity} item${quantity > 1 ? 's' : ''} to cart`);

        // Update cart modal content
        const res = await fetch('./api/cart/get_cart_items.php');
        const html = await res.text();
        cartItems.innerHTML = html;
    } catch (error) {
        showToast('error', error.message);
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
        showToast('error', error.message);
    }
}

document.addEventListener('click', (e) => {
    if (e.target.matches('.btn-add-to-cart')) {
        const merchId = e.target.dataset.merchId;
        addToCart(merchId);
    }
    if (e.target.matches('.remove-from-cart-btn')) {
        const merchId = e.target.dataset.id;
        removeFromCart(merchId);
    }
});