export default function updateCartCount(action, quantity = 1) {
    const cartCountEl = document.getElementById("cart-count");
    cartCountEl.textContent = parseInt(cartCountEl.textContent) + (action === 'add' ? quantity : -quantity);
}