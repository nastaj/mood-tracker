import loadProductDetails from "./loadProductDetails";
import loadProductReviews from "./loadProductReviews";

const productContainer = document.getElementById('product-container');
const reviewsContainer = document.getElementById('reviews-container');

document.addEventListener("DOMContentLoaded", async () => {
    // Load product details and reviews on page load
    await loadProductDetails(productContainer);
    await loadProductReviews(reviewsContainer);

    // Function to change quantity
    window.changeQuantity = function (action) {
        const quantitySpan = document.getElementById('quantity');
        let quantity = parseInt(quantitySpan.dataset.quantity);

        if (action === 'increase') {
            quantity++;
        } else if (action === 'decrease' && quantity > 0) {
            quantity--;
        }

        quantitySpan.dataset.quantity = quantity;
        quantitySpan.textContent = quantity;
    };

    // Add to cart button event listener
    const addToCartBtn = document.getElementById('btn-add-to-cart');
    const quantitySpan = document.getElementById('quantity');

    addToCartBtn.addEventListener('click', () => {
        const merchId = addToCartBtn.dataset.merchId;
        const quantity = parseInt(quantitySpan.textContent);

        if (quantity > 0) addToCart(merchId, quantity);
    });
});