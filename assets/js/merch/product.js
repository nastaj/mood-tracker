import loadProductDetails from "./loadProductDetails";
import loadProductReviews from "./loadProductReviews";
import addToCart from "../cart/addToCart";

const productContainer = document.getElementById('product-container');
const reviewsContainer = document.getElementById('reviews-container');

document.addEventListener("DOMContentLoaded", async () => {
    // Load product details and reviews on page load
    await loadProductDetails(productContainer);
    await loadProductReviews(reviewsContainer);

    // Quantity adjustment buttons event listeners
    const decreaseQtyBtn = document.getElementById('btn-decrease-quantity');
    const increaseQtyBtn = document.getElementById('btn-increase-quantity');
    const quantitySpan = document.getElementById('quantity');

    decreaseQtyBtn.addEventListener('click', () => {
        let currentQty = parseInt(quantitySpan.textContent);
        if (currentQty > 0) {
            currentQty -= 1;
            quantitySpan.textContent = currentQty;
            quantitySpan.dataset.quantity = currentQty;
        }
    });

    increaseQtyBtn.addEventListener('click', () => {
        let currentQty = parseInt(quantitySpan.textContent);
        currentQty += 1;
        quantitySpan.textContent = currentQty;
        quantitySpan.dataset.quantity = currentQty;
    });

    // Add to cart button event listener
    const addToCartBtn = document.getElementById('add-to-cart-btn');

    addToCartBtn.addEventListener('click', () => {
        const merchId = addToCartBtn.dataset.merchId;
        const quantity = parseInt(quantitySpan.textContent);
        console.log(quantity);

        if (quantity > 0) addToCart(merchId, quantity);
    });
});