import loadEntries from './loadEntries.js';
import deleteEntry from './deleteEntry.js';

const entriesContainer = document.getElementById('entries');
const deleteModal = document.getElementById('deleteModal');
let entryToDelete = null;

document.addEventListener('DOMContentLoaded', async () => {
    // Load entries on page load
    await loadEntries(entriesContainer);

    // Modal buttons
    const cancelDeleteBtn = document.getElementById('cancelDelete');
    const confirmDeleteBtn = document.getElementById('confirmDelete');

    // Delete modal event listeners
    // Cancel button hides the modal
    cancelDeleteBtn.addEventListener('click', () => {
        deleteModal.classList.add('hidden');
        entryToDelete = null;
    });

    // Confirm delete
    confirmDeleteBtn.addEventListener('click', async () => {
        if (entryToDelete) {
            const entryId = entryToDelete.getAttribute('data-entry-id');
            const success = await deleteEntry(entryId);
            if (success) {
                entryToDelete.remove();
            } else {
                alert('Failed to delete the entry. Please try again.');
            }
        }
        deleteModal.classList.add('hidden');
    });
});

// Delegate clicks for dynamically loaded entries
document.addEventListener('click', (e) => {
    if (e.target.classList.contains('btn-delete')) {
        entryToDelete = e.target.closest('div[data-entry-id]');
        deleteModal.classList.remove('hidden');
    }
});

// Dynamically update entries on filter change
const filterInputs = [
    document.getElementById('mood_filter'),
    document.getElementById('mood_date_from'),
    document.getElementById('mood_date_to')
];

filterInputs.forEach(input => {
    input.addEventListener('change', () => loadEntries(entriesContainer));
});

