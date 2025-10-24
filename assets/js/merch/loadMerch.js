export default async function loadMerch(container, sortBy = 'recent') {
    const priceFrom = document.getElementById('pricing-from').value;
    const priceTo = document.getElementById('pricing-to').value;
    const searchString = document.getElementById('search-bar').value;
    const categoryId = document.querySelector('input[name="category"]:checked') ? document.querySelector('input[name="category"]:checked').value : '';

    try {
        const res = await fetch(`./api/merch/get_merch.php?category_id=${categoryId}&price_from=${priceFrom}&price_to=${priceTo}&search=${encodeURIComponent(searchString)}&sort_by=${sortBy}`);
        const html = await res.text();

        container.innerHTML = html;
    } catch (error) {
        console.error('Error loading merch items:', error);
    }
}