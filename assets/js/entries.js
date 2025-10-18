import loadEntries from './loadEntries.js';
import deleteEntry from './deleteEntry.js';
import editEntry from './editEntry.js';

const editForm = document.getElementById('editMoodForm');
const entriesContainer = document.getElementById('entries');
const deleteModal = document.getElementById('deleteModal');
const editModal = document.getElementById('editModal');
let entryToDelete = null;
let entryToEdit = null;

document.addEventListener('DOMContentLoaded', async () => {
    // Load entries on page load
    await loadEntries(entriesContainer);

    // Modal buttons
    const cancelDeleteBtn = document.getElementById('cancelDelete');
    const confirmDeleteBtn = document.getElementById('confirmDelete');
    const cancelEditBtn = document.getElementById('cancelEdit');
    const confirmEditBtn = document.getElementById('confirmEdit');

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

    // Edit modal event listeners
    // Cancel button hides the modal
    cancelEditBtn.addEventListener('click', (e) => {
        e.preventDefault();
        editModal.classList.add('hidden');
        entryToEdit = null;
    });

    // Confirm edit
    editForm.addEventListener('submit', async (e) => {
        e.preventDefault();

        if (entryToEdit) {
            const mood = document.getElementById('editCategory').value;
            const notes = document.getElementById('editNotes').value;
            const intensity = document.getElementById('editIntensity').value;
            const hours_slept = document.getElementById('editSleepHours').value;
            const insight = document.getElementById('editInsight').value;
            const tag = document.getElementById('editTag').value;

            const entryId = entryToEdit.getAttribute('data-entry-id');

            try {
                const { updatedMood, category } = await editEntry(entryId, {
                    mood,
                    notes,
                    intensity,
                    hours_slept,
                    insight,
                    tag
                });

                if (updatedMood.success) {
                    // Update the entry in the UI
                    const entryDiv = entryToEdit;
                    entryDiv.querySelector('.mood-category').textContent = `${category.data.image} ${category.data.name}`;
                    entryDiv.querySelector('.mood-notes').textContent = notes;
                    entryDiv.querySelector('.mood-intensity').textContent = `${intensity}/10`;
                    entryDiv.querySelector('.mood-hours-slept').textContent = `${hours_slept}h of sleep`;
                    // entryDiv.querySelector('.mood-insight').textContent = insight;
                    entryDiv.querySelector('.mood-tags').textContent = tag;

                    // Close the modal
                    editModal.classList.add('hidden');
                }
            } catch (error) {
                console.error('Error editing entry:', error);
                alert('An error occurred while editing the entry. Please try again.');
            }
        }
    });
});

// Delegate clicks for dynamically loaded entries
document.addEventListener('click', (e) => {
    if (e.target.classList.contains('btn-delete')) {
        entryToDelete = e.target.closest('div[data-entry-id]');
        deleteModal.classList.remove('hidden');
    }
});

document.addEventListener('click', (e) => {
    if (e.target.classList.contains('btn-edit')) {
        console.log('Edit button clicked');
        entryToEdit = e.target.closest('div[data-entry-id]');
        editModal.classList.remove('hidden');
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

