export default async function loadProductDetails(container) {
    const urlParams = new URLSearchParams(window.location.search);
    const productId = urlParams.get('id');

    try {
        const res = await fetch(`./api/merch/get_product_details.php?id=${productId}`);
        if (!res.ok) {
            throw new Error('Network response was not ok');
        }

        const product = await res.text();
        container.innerHTML = product;
    } catch (error) {
        console.error('Error fetching product details:', error);
        throw error;
    }
}
