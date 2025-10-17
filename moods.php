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
    <script src="./assets/js/entries.js" defer></script>
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
                <button>Most Recent</button>
                <span>/</span>
                <button>Oldest</button>
                <span>/</span>
                <button>Highest Mood</button>
            </div>
        </div>
    </main>

    <div id="entries" class="max-w-7xl mt-16 mb-24 mx-auto px-4 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" id="mood_entries_container">
        <div class="bg-gray-200 p-6 rounded-lg shadow-md flex flex-col justify-between gap-6">
            <p class="font-semibold">😀 Very Happy</p>
            <p>"Had a great day at work and treated myself to a walk."</p>
            <p>#Relaxed #Productive</p>
            <p>8/10</p>
            <div class="flex justify-between items-center">
                <p>7 Oct 2025</p>
                <div>
                    <button class="text-blue-500 underline mr-2">Edit</button>
                    <button class="text-red-500 underline">Delete</button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>