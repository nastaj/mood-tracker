import loadMerch from "./loadMerch";

const merchContainer = document.getElementById("merch-items");
const categories = document.querySelectorAll('input[name="category"]');

document.addEventListener("DOMContentLoaded", async () => {
    // Load merch items on page load
    await loadMerch(merchContainer);
});

// Dynamically update entries on category change
categories.forEach(category => {
    category.addEventListener('change', () => loadMerch(merchContainer));
});


// Dynamically update entries on filter change
const filterInputs = [
    document.getElementById('pricing-from'),
    document.getElementById('pricing-to'),
    document.getElementById("search-bar")
];

filterInputs.forEach(input => {
    input.addEventListener("input", async () => {
        await loadMerch(merchContainer);
    });
});
