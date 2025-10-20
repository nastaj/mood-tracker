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
    <link href="./assets/css/output.css" rel="stylesheet">
    <title>Mood Tracker | Mood Entries</title>
    <script type="module" src="./assets/js/entries.js" defer></script>
</head>
<body>
    <?php include './includes/header.php'; ?>

    <main class="max-w-7xl mt-24 flex flex-col gap-16 mx-auto px-4 text-center">
        <h1 class="text-3xl font-bold">Your Mood Entries</h1>
        <div class="flex">
            <div class="flex gap-4 basis-1/3 justify-center">
                <input type="date" name="mood_date_from" id="mood_date_from">
                <span>-</span>
                <input type="date" name="mood_date_to" id="mood_date_to">
            </div>
            <select name="mood_filter" id="mood_filter" class="basis-1/3 text-center bg-gray-200 rounded">
                <option value="">All Categories</option>
                <?php foreach ($categories as $category): ?>
                    <option value="<?= htmlspecialchars($category['category_id']) ?>"><?= htmlspecialchars($category['name']) ?></option>
                <?php endforeach; ?>
            </select>
            <div class="flex gap-8 basis-1/3 justify-center">
                <button value="recent" class="hover:cursor-pointer btn-sort">Most Recent</button>
                <span>/</span>
                <button value="oldest" class="hover:cursor-pointer btn-sort">Oldest</button>
                <span>/</span>
                <button value="intensity" class="hover:cursor-pointer btn-sort">Intensity</button>
            </div>
        </div>
    </main>

    <div id="entries" class="max-w-7xl mt-16 mb-24 mx-auto px-4 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" id="mood_entries_container">
        <!-- Mood entries will be dynamically inserted here -->
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class=" fixed hidden inset-0 flex items-center justify-center z-50">
        <div class="bg-white p-8 rounded-lg shadow-xl max-w-md w-full mx-4">
            <h2 class="text-2xl font-bold mb-4">Confirm Deletion</h2>
            <p class="mb-6">Are you sure you want to delete this mood entry? This action cannot be undone.</p>
            <div class="flex gap-4 justify-end">
                <button id="cancelDelete" class="px-4 py-2 bg-gray-300 hover:bg-gray-400 rounded">Cancel</button>
                <button id="confirmDelete" class="px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded">Delete</button>
            </div>
        </div>
    </div>

    <!-- Edit Mood Modal -->
    <div id="editModal" class="fixed hidden inset-0 flex items-center justify-center z-50 overflow-auto">
        <div class="bg-white p-8 rounded-lg shadow-xl border-2 border-gray-200 max-w-md w-full mx-4">
            <h2 class="text-2xl font-bold mb-4">Edit Mood Entry</h2>
            <form id="editMoodForm" class="flex flex-col gap-4">
                <label for="editCategory">Category:</label>
                <select id="editCategory" name="category" class="w-full p-2 border border-gray-300 rounded">
                   <option value="">All Categories</option>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?= htmlspecialchars($category['category_id']) ?>"><?= htmlspecialchars($category['name']) ?></option>
                    <?php endforeach; ?>
                </select>
                
                <label for="editIntensity">Mood Intensity:</label>
                <input type="range" id="editIntensity" name="intensity" min="1" max="10" class="w-full">
                <p class="text-sm text-gray-500">How strong is the feeling?</p>

                <label for="editSleepHours">Hours of Sleep:</label>
                <input type="number" id="editSleepHours" name="sleepHours" min="0" max="24" class="w-full p-2 border border-gray-300 rounded">

                <label for="editNotes">Notes:</label>
                <textarea id="editNotes" name="notes" class="w-full p-2 border border-gray-300 rounded"></textarea>

                <label for="editInsight">Insights:</label>
                <textarea id="editInsight" name="insight" class="w-full p-2 border border-gray-300 rounded"></textarea>

                <label for="editTag">Tag:</label>
                <select id="editTag" name="tag" class="w-full p-2 border border-gray-300 rounded">
                    <option value="">Select a tag</option>
                    <?php
                    while ($row = mysqli_fetch_assoc($tags)) {
                        echo '<option value="' . htmlspecialchars($row['name']) . '">' . htmlspecialchars($row['name']) . '</option>';
                    }
                    ?>
                </select>

                <div class="flex justify-between">
                        <button id="cancelEdit" class="px-4 py-2 bg-gray-300 hover:bg-gray-400 hover:cursor-pointer rounded">Cancel</button>
                        <button id="confirmEdit" type="submit" class="px-4 py-2 bg-blue-500 hover:bg-blue-600 hover:cursor-pointer text-white rounded">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>