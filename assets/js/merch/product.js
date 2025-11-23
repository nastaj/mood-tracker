import loadProductDetails from "./loadProductDetails";
import loadProductReviews from "./loadProductReviews";
import addToCart from "../cart/addToCart";
import showToast from "../toast";

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

    // Star rating event listeners
    const stars = document.querySelectorAll("#star-rating .user-rating");
    const ratingInput = document.getElementById("selected-rating");

    stars.forEach(star => {
        star.addEventListener("click", () => {
            const value = parseInt(star.dataset.value);
            ratingInput.value = value;

            // Highlight selected stars
            stars.forEach(s => {
                s.classList.toggle("fas", parseInt(s.dataset.value) <= value);
                s.classList.toggle("text-gray-300", parseInt(s.dataset.value) > value);
            });
        });

        // Hover effect
        star.addEventListener("mouseover", () => {
            const value = parseInt(star.dataset.value);
            stars.forEach(s => {
                s.classList.toggle("text-yellow-500", parseInt(s.dataset.value) <= value);
                s.classList.toggle("text-gray-300", parseInt(s.dataset.value) > value);
            });
        });

        star.addEventListener("mouseout", () => {
            const value = parseInt(ratingInput.value);
            stars.forEach(s => {
                s.classList.toggle("text-yellow-400", parseInt(s.dataset.value) <= value);
                s.classList.toggle("text-gray-300", parseInt(s.dataset.value) > value);
            });
        });
    });

    // Handle review submission
    const reviewForm = document.getElementById("review-form");
    reviewForm.addEventListener("submit", async (e) => {
        e.preventDefault();

        const rating = ratingInput.value;
        const review = document.getElementById("review").value;

        if (rating == 0) {
            showToast("error", "Please select a rating");
            return;
        }

        if (review.trim() === "") {
            showToast("error", "Please write a review");
            return;
        }

        // Get product ID from URL
        const urlParams = new URLSearchParams(window.location.search);
        const productId = urlParams.get("id");

        const formData = new FormData();
        formData.append("rating", rating);
        formData.append("review", review);
        formData.append("product_id", productId);

        const res = await fetch("./api/merch/submit_review.php", {
            method: "POST",
            body: formData
        });

        const data = await res.json();

        if (data.success) {
            showToast("success", "Review submitted!");
            reviewForm.reset();
            ratingInput.value = 0;

            stars.forEach(s => s.classList.add("text-gray-300", "far"));
            stars.forEach(s => s.classList.remove("text-yellow-400", "fas"));

            // Refresh reviews and product details to show new review and updated rating
            loadProductDetails(productContainer);
            loadProductReviews(reviewsContainer);
        } else {
            showToast("error", data.message);
        }
    });
});