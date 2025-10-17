export default async function loadEntries(container) {
    const moodFilter = document.getElementById('mood_filter').value;
    const dateFrom = document.getElementById('mood_date_from').value;
    const dateTo = document.getElementById('mood_date_to').value;

    try {
        const res = await fetch(`./api/get_moods.php?category_id=${moodFilter}&date_from=${dateFrom}&date_to=${dateTo}`);
        const html = await res.text();

        container.innerHTML = html;
    } catch (error) {
        console.error('Error loading entries:', error);
    }
}