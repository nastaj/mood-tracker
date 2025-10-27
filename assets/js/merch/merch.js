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

// Wishlist toggle
document.addEventListener('click', async (e) => {
    const btn = e.target.closest('.wishlist-btn');
    if (!btn) return;
    const btnIcon = btn.querySelector('i');

    const merchId = btn.dataset.merchId;

    try {
        const formData = new FormData();
        formData.append('merch_id', merchId);

        const res = await fetch('./api/wishlist/toggle_wishlist.php', {
            method: 'POST',
            body: formData,
        });

        const data = await res.json();

        if (data.status === 'success') {
            if (data.action === 'added') {
                btnIcon.classList.replace('fa-regular', 'fa-solid');
                btnIcon.classList.add('text-red-500');
                Toastify({ text: 'Added to wishlist ❤️', duration: 2000, position: 'center' }).showToast();
            } else {
                btnIcon.classList.replace('fa-solid', 'fa-regular');
                btnIcon.classList.remove('text-red-500');
                Toastify({ text: 'Removed from wishlist 💔', duration: 2000, position: 'center' }).showToast();
            }
        }
    } catch (err) {
        console.error('Wishlist toggle failed:', err);
    }
});
