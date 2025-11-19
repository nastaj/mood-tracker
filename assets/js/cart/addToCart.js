import showToast from "../toast";
import updateCartCount from "../cart/updateCartCount";

const cartItems = document.getElementById("cart-items");

export default async function addToCart(merchId, quantity = 1) {
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