import showToast from "../toast";
import addToCart from "../cart/addToCart";
import updateCartCount from "../cart/updateCartCount";

const cartItems = document.getElementById("cart-items");

async function removeFromCart(merchId) {
    const formData = new FormData();
    formData.append('merch_id', merchId);
    console.log(merchId);

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