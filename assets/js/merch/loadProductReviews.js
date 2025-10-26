export default async function loadProductReviews(container) {
    const urlParams = new URLSearchParams(window.location.search);
    const productId = urlParams.get('id');

    try {
        const res = await fetch(`./api/merch/get_product_reviews.php?id=${productId}`);
        if (!res.ok) {
            throw new Error('Network response was not ok');
        }

        const reviews = await res.text();
        container.innerHTML = reviews;
    } catch (error) {
        console.error('Error fetching product reviews:', error);
        throw error;
    }
}
