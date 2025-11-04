import loadEntries from './loadEntries.js';
import deleteEntry from './deleteEntry.js';
import editEntry from './editEntry.js';
import getMood from './getMood.js';
import showToast from './toast.js';

const editForm = document.getElementById('editMoodForm');
const entriesContainer = document.getElementById('entries');
const deleteModal = document.getElementById('deleteModal');
const editModal = document.getElementById('editModal');
const btnSorts = document.querySelectorAll('.btn-sort');

let entryToDelete = null;
let entryToEdit = null;
let sortBy = 'recent';

document.addEventListener('DOMContentLoaded', async () => {
    // Load entries on page load
    await loadEntries(entriesContainer);

    // Modal buttons
    const cancelDeleteBtn = document.getElementById('cancelDelete');
    const confirmDeleteBtn = document.getElementById('confirmDelete');
    const cancelEditBtn = document.getElementById('cancelEdit');

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
                showToast("success", "Entry deleted successfully.");
            } else {
                showToast("error", "Failed to delete the entry. Please try again.");
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
                    // Close the modal
                    editModal.classList.add('hidden');
                    showToast("success", "Entry updated successfully.");

                    // Reload entries to reflect changes
                    await loadEntries(entriesContainer, sortBy);
                }
            } catch (error) {
                showToast("error", "An error occurred while editing the entry. Please try again.");
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

document.addEventListener('click', async (e) => {
    if (e.target.classList.contains('btn-edit')) {
        entryToEdit = e.target.closest('div[data-entry-id]');
        const entryId = entryToEdit.getAttribute('data-entry-id');

        // Pre-fill the edit form with existing data
        try {
            const moodData = await getMood(entryId);
            document.getElementById('editCategory').value = moodData.category_id;
            document.getElementById('editNotes').value = moodData.notes;
            document.getElementById('editIntensity').value = moodData.intensity;
            document.getElementById('editSleepHours').value = moodData.hours_of_sleep;
            document.getElementById('editInsight').value = moodData.insight;
            document.getElementById('editTag').value = moodData.tags;

            editModal.classList.remove('hidden');
        } catch (error) {
            console.error('Error fetching mood for edit:', error);
            alert('Failed to load entry data for editing. Please try again.');
        }
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

btnSorts.forEach(button => {
    button.addEventListener('click', () => {
        sortBy = button.value;
        loadEntries(entriesContainer, sortBy);
    });
});