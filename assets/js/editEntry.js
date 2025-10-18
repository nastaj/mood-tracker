export default async function editEntry(entryId, data) {
    const formData = new FormData();
    formData.append('entry_id', entryId);
    formData.append('moodCategory', data.mood);
    formData.append('intensity', data.intensity);
    formData.append('hoursSlept', data.hours_slept);
    formData.append('notes', data.notes);
    formData.append('insight', data.insight);
    formData.append('tag', data.tag);

    try {
        const moodRes = await fetch(`./api/update_mood.php`, {
            method: 'POST',
            body: formData
        });
        const moodData = await moodRes.json();

        const categoryRes = await fetch(`./api/get_category.php?moodCategory=${data.mood}`);
        const categoryData = await categoryRes.json();

        return { updatedMood: moodData, category: categoryData };
    } catch (error) {
        console.error('Error editing entry:', error);
        return false;
    }
}