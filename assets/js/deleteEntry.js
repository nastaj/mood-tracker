export default async function deleteEntry(entryId) {
    const formData = new FormData();
    formData.append('entry_id', entryId);

    try {
        const response = await fetch(`./api/delete_mood.php`, {
            method: 'POST',
            body: formData
        });

        const result = await response.json();

        return result.success;
    } catch (error) {
        console.error('Error deleting entry:', error);
        return false;
    }
}