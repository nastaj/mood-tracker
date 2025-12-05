import showToast from './toast.js';

const moodForm = document.getElementById('moodForm');

function clearErrors() {
    document.querySelectorAll(".error-text").forEach(el => el.textContent = "");
}

const moodBtns = document.querySelectorAll('input[name="mood"]');
moodBtns.forEach(btn => {
    btn.addEventListener('change', async () => {
        // Change input field for notes based on mood selection
        const notesInput = document.getElementById('notes');

        const res = await fetch(`./api/get_category_desc.php?moodCategory=${btn.value}`);
        const data = await res.json();

        if (data.success) {
            notesInput.placeholder = data.description;
        } else {
            notesInput.placeholder = "What are you feeling?";
        }
    });
});

moodForm.addEventListener('submit', (event) => {
    event.preventDefault();
    logMood();
});

async function logMood() {
    const selectedMood = document.querySelector('input[name="mood"]:checked');
    const intensityInput = document.getElementById('moodIntensity');
    const hoursSleptInput = document.getElementById('sleepHours');
    const notesInput = document.getElementById('notes');
    const insightInput = document.getElementById('insight');
    const tagSelect = document.getElementById('tag');

    const formData = new FormData();
    formData.append('moodCategory', selectedMood.value);
    formData.append('intensity', intensityInput.value);
    formData.append('hoursSlept', hoursSleptInput.value);
    formData.append('notes', notesInput.value);
    formData.append('insight', insightInput.value);
    formData.append('tag', tagSelect.value);

    try {
        const response = await fetch('./api/add_mood.php', {
            method: 'POST',
            body: formData,
        });

        const result = await response.json();

        if (response.ok && result.success) {
            showToast("success", result.message);
            setTimeout(() => {
                window.location.href = './home.php';
            }, 3000);
        } else {
            // Clear previous error messages
            clearErrors();

            // Display new error messages
            for (const field in result.errors) {
                const errorSpan = document.getElementById(`error-${field}`);
                if (errorSpan) {
                    errorSpan.textContent = result.errors[field];
                }
            }
        }
    } catch (error) {
        showToast("error", error.message);
    }
}