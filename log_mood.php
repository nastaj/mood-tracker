<?php
include './includes/auth.php';
include './api/get_tags.php';
include './api/get_categories.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./assets/css/output.css" rel="stylesheet">
    <title>Mood Tracker | Log Mood</title>
    <script type="module" src="./assets/js/logMood.js" defer></script>
</head>

<body>
    <?php include './includes/header.php'; ?>

    <main class="max-w-7xl mt-24 mx-auto px-4">
        <div class="flex justify-between gap-24">
            <div class="w-1/2">
                <h1 class="text-5xl font-bold mb-6">Log Your Mood</h1>
                <form id="moodCategoryForm" class="flex flex-col gap-4">
                    <label for="mood" class="text-3xl font-semibold mb-4">How was your mood today?</label>
                    <div class="bg-neutral-100">
                        <?php foreach ($categories as $category): ?>
                            <?php
                            $id = htmlspecialchars($category['category_id']);
                            $name = htmlspecialchars($category['name']);
                            $category_img = htmlspecialchars($category['image']);
                            
                            echo '
                            <div class="flex items-center justify-between border-2 px-4 py-2 rounded-lg border-gray-300 hover:border-blue-600 font-semibold mb-6 transition-all">
                                <div class="text-2xl">
                                    <input type="radio" id="mood-' . $id . '" name="mood" value="' . $id . '" class="mr-2">
                                    <label for="mood-' . $id . '" class="mr-4 cursor-pointer">' . ucfirst($name) . '</label>
                                </div>
                                <span class="text-3xl">'. $category_img .'</span>
                            </div>';
                            ?>
                    <?php endforeach; ?>
                </div>
                </form>
            </div>

            <div class="w-1/2">
                <form id="moodForm" class="flex flex-col gap-8">
                    <div class="flex flex-col">
                        <label for="moodIntensity" class="text-lg font-medium">Mood Intensity (1-10):</label>
                        <input type="range" id="moodIntensity" name="moodIntensity" min="1" max="10" class="w-full">
                        <p class="text-sm text-gray-500">How strong is the feeling?</p>
                    </div>

                    <div class="flex flex-col">
                        <label for="sleepHours" class="text-lg font-medium mt-4">Hours of Sleep:</label>
                        <input type="number" id="sleepHours" name="sleepHours" min="0" max="24"
                            class="w-full border border-gray-300 rounded px-2 py-1" required>
                    </div>

                    <div class="flex flex-col">
                        <label for="notes" class="text-lg font-medium mt-4">Notes:</label>
                        <textarea id="notes" name="notes" rows="4"
                            class="w-full border border-gray-300 rounded px-2 py-1" required></textarea>
                    </div>

                    <div class="flex flex-col">
                        <label for="insight" class="text-lg font-medium mt-4">Insights:</label>
                        <textarea id="insight" name="insight" rows="4"
                            class="w-full border border-gray-300 rounded px-2 py-1" required></textarea>
                    </div>

                    <div class="flex flex-col">
                        <label for="tag" class="text-lg font-medium mt-4">Tag:</label>
                        <select id="tag" name="tag" class="w-full border border-gray-300 rounded px-2 py-1">
                            <option value="">Select a tag</option>
                            <?php
                            while ($row = mysqli_fetch_assoc($tags)) {
                                echo '<option value="' . htmlspecialchars($row['name']) . '">' . htmlspecialchars($row['name']) . '</option>';
                            }
                            ?>
                        </select>
                    </div>

                    <button type="submit" class="mt-4 bg-blue-600 text-white rounded px-4 py-2">Log
                        Mood</button>
                </form>
            </div>
        </div>
    </main>
</body>

</html>