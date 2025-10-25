const userModal = document.getElementById('userModal');
const cartModal = document.getElementById('cartModal');

// Toggle User Modal
function toggleUserModal() {
    userModal.classList.toggle('hidden');
    cartModal.classList.add('hidden');
}

// Toggle Cart Modal
function toggleCartModal() {
    cartModal.classList.toggle('hidden');
    userModal.classList.add('hidden');
}