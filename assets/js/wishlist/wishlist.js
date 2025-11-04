import showToast from "../toast";

async function removeFromWishlist(merchId, e) {
    const itemElement = e.target.closest('article');

    try {
        const formData = new FormData();
        formData.append('merch_id', merchId);

        const res = await fetch('./api/wishlist/toggle_wishlist.php', {
            method: 'POST',
            body: formData,
        });

        const data = await res.json();

        if (data.status === 'success') {
            showToast('success', '💔 Item removed from wishlist.');

            // Remove the item from the DOM
            itemElement.remove();
        }
    } catch (err) {
        console.error('Wishlist toggle failed:', err);
    }
}

document.addEventListener('click', (e) => {
    if (e.target.matches('.remove-wishlist-btn')) {
        const merchId = e.target.dataset.id;
        removeFromWishlist(merchId, e);
    }
});