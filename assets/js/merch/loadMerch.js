export default async function loadMerch(container, sortBy = 'recent') {
    const priceFrom = document.getElementById('pricing-from').value;
    const priceTo = document.getElementById('pricing-to').value;
    const searchString = document.getElementById('search-bar').value;
    const availability = document.querySelector('input[name="availability"]:checked') ? document.querySelector('input[name="availability"]:checked').value : '';

    // Get all checked checkboxes
    const categories = [...document.querySelectorAll('input[name="category"]:checked')];
    const categoryIds = categories.map(c => c.value).join(','); // "1,3,5"
    console.log(categoryIds);

    try {
        const res = await fetch(`./api/merch/get_merch.php?category_id=${encodeURIComponent(categoryIds)}&price_from=${priceFrom}&price_to=${priceTo}&search=${encodeURIComponent(searchString)}&availability=${availability}&sort_by=${sortBy}`);
        const html = await res.text();

        container.innerHTML = html;
    } catch (error) {
        console.error('Error loading merch items:', error);
    }
}