import loadMerch from "./loadMerch";

const merchContainer = document.getElementById("merch-items");
const categories = document.querySelectorAll('input[name="category"]');
const btnSorts = document.querySelectorAll('.btn-sort');

let sortBy = 'most-recent';

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

// Sort entries on sort button click
btnSorts.forEach(btn => {
    btn.addEventListener('click', async () => {
        sortBy = btn.value;
        await loadMerch(merchContainer, sortBy);
    });
});