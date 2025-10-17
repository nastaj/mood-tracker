<?php 
include './includes/auth.php';
include './api/get_categories.php';
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
                <?php while($category = $categories->fetch_assoc()): ?>
                    <option value="<?php echo $category['category_id']; ?>"><?php echo htmlspecialchars($category['name']); ?></option>
                <?php endwhile; ?>
            </select>
            <div class="flex gap-8 basis-1/3 justify-center">
                <button class="hover:cursor-pointer">Most Recent</button>
                <span>/</span>
                <button class="hover:cursor-pointer">Oldest</button>
                <span>/</span>
                <button class="hover:cursor-pointer">Highest Mood</button>
            </div>
        </div>
    </main>

    <div id="entries" class="max-w-7xl mt-16 mb-24 mx-auto px-4 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" id="mood_entries_container">
        
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
</body>
</html>