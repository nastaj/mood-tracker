const entriesContainer = document.getElementById('entries');

const filterInputs = [
    document.getElementById('mood_filter'),
    document.getElementById('mood_date_from'),
    document.getElementById('mood_date_to')
];

filterInputs.forEach(input => {
    input.addEventListener('change', loadEntries);
});

document.addEventListener('DOMContentLoaded', loadEntries);

async function loadEntries() {
    const moodFilter = document.getElementById('mood_filter').value;
    const dateFrom = document.getElementById('mood_date_from').value;
    const dateTo = document.getElementById('mood_date_to').value;

    try {
        const userRes = await fetch('./api/get_user.php');
        const userData = await userRes.json();
        const userId = userData.user.user_id;
        console.log(userId);

        const entriesRes = await fetch(`./api/get_moods.php?user_id=${userId}&category_id=${moodFilter}&date_from=${dateFrom}&date_to=${dateTo}`);
        const html = await entriesRes.text();

        entriesContainer.innerHTML = html;
    } catch (error) {
        console.error('Error loading entries:', error);
    }
}