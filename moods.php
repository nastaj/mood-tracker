<?php 
include './includes/auth.php';
include './api/get_categories.php';
include './api/get_tags.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
<link href="./assets/css/output.css" rel="stylesheet">
<title>Mood Tracker | Mood Entries</title>
<script type="module" src="./assets/js/entries.js" defer></script>
</head>
<body class="bg-background text-text-primary">
<?php include './includes/header.php'; ?>

<main class="max-w-7xl mt-24 mx-auto px-4 flex flex-col gap-12">

    <h1 class="text-3xl font-bold text-center mb-6 text-primary">Your Mood Entries</h1>

    <!-- Filters -->
    <div class="flex flex-col md:flex-row gap-4 items-center justify-between bg-card-bg p-6 rounded-xl shadow-md">
        <div class="flex gap-2 items-center">
            <input type="date" name="mood_date_from" id="mood_date_from" class="border border-gray-300 rounded px-2 py-1 hover:cursor-pointer">
            <span>-</span>
            <input type="date" name="mood_date_to" id="mood_date_to" class="border border-gray-300 rounded px-2 py-1 hover:cursor-pointer">
        </div>

        <select name="mood_filter" id="mood_filter" class="bg-card-bg border border-gray-300 rounded px-3 py-2 text-center cursor-pointer">
            <option value="">All Categories</option>
            <?php foreach ($categories as $category): ?>
                <option value="<?= htmlspecialchars($category['category_id']) ?>"><?= htmlspecialchars($category['name']) ?></option>
            <?php endforeach; ?>
        </select>

        <div class="flex gap-2 items-center justify-center">
            <button value="recent" class="btn-sort bg-primary text-white px-4 py-2 rounded hover:bg-secondary transition hover:cursor-pointer">Most Recent</button>
            <button value="oldest" class="btn-sort bg-primary text-white px-4 py-2 rounded hover:bg-secondary transition hover:cursor-pointer">Oldest</button>
            <button value="intensity" class="btn-sort bg-primary text-white px-4 py-2 rounded hover:bg-secondary transition hover:cursor-pointer">Intensity</button>
        </div>
    </div>
</main>

<!-- Entries Grid -->
<div id="entries" class="max-w-7xl mt-8 mb-24 mx-auto px-4 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
    <!-- Mood entries will be dynamically loaded here -->
</div>

<!-- Delete Modal -->
<div id="deleteModal" class="fixed hidden inset-0 bg-black/50 flex items-center justify-center z-50 animate-fade-in">
    <div class="bg-card-bg p-6 rounded-xl shadow-xl max-w-md w-full mx-4">
        <h2 class="text-2xl font-bold mb-4">Confirm Deletion</h2>
        <p class="mb-6">Are you sure you want to delete this mood entry? This action cannot be undone.</p>
        <div class="flex gap-4 justify-end">
            <button id="cancelDelete" class="px-4 py-2 bg-gray-300 hover:bg-gray-400 rounded hover:cursor-pointer">Cancel</button>
            <button id="confirmDelete" class="px-4 py-2 bg-danger hover:bg-red-600 text-white rounded hover:cursor-pointer">Delete</button>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div id="editModal" class="fixed hidden inset-0 bg-black/50 flex items-center justify-center z-50 overflow-auto animate-fade-in">
    <div class="bg-card-bg p-8 rounded-xl shadow-xl border border-gray-200 max-w-md w-full mx-4">
        <h2 class="text-2xl font-bold mb-4">Edit Mood Entry</h2>
        <form id="editMoodForm" class="flex flex-col gap-4">
            <label for="editCategory">Category:</label>
            <select id="editCategory" name="category" class="w-full p-2 border border-gray-300 rounded cursor-pointer">
                <option value="">All Categories</option>
                <?php foreach ($categories as $category): ?>
                    <option value="<?= htmlspecialchars($category['category_id']) ?>"><?= htmlspecialchars($category['name']) ?></option>
                <?php endforeach; ?>
            </select>

            <label for="editIntensity">Mood Intensity:</label>
            <input type="range" id="editIntensity" name="intensity" min="1" max="10" class="w-full">
            <p class="text-sm text-text-secondary">How strong is the feeling?</p>

            <label for="editSleepHours">Hours of Sleep:</label>
            <input type="number" id="editSleepHours" name="sleepHours" min="0" max="24" class="w-full p-2 border border-gray-300 rounded">

            <label for="editNotes">Notes:</label>
            <textarea id="editNotes" name="notes" class="w-full p-2 border border-gray-300 rounded"></textarea>

            <label for="editInsight">Insights:</label>
            <textarea id="editInsight" name="insight" class="w-full p-2 border border-gray-300 rounded"></textarea>

            <label for="editTag">Tag:</label>
            <select id="editTag" name="tag" class="w-full p-2 border border-gray-300 rounded">
                <option value="">Select a tag</option>
                <?php while ($row = mysqli_fetch_assoc($tags)) : ?>
                    <option value="<?= htmlspecialchars($row['name']) ?>"><?= htmlspecialchars($row['name']) ?></option>
                <?php endwhile; ?>
            </select>

            <div class="flex justify-between mt-4">
                <button id="cancelEdit" class="px-4 py-2 bg-gray-300 hover:bg-gray-400 rounded hover:cursor-pointer">Cancel</button>
                <button id="confirmEdit" type="submit" class="px-4 py-2 bg-primary hover:bg-secondary text-white rounded hover:cursor-pointer">Save Changes</button>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
</body>
</html>