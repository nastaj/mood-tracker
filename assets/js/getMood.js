export default async function getMood(entryId) {
    try {
        const res = await fetch(`./api/get_mood.php?entry_id=${entryId}`);
        const data = await res.json();
        return data;
    } catch (error) {
        console.error('Error fetching mood entry:', error);
        return { error: 'Failed to fetch mood entry' };
    }
}