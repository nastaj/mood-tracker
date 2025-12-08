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
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <title>Mood Tracker | Log Mood</title>
    <script type="module" src="./assets/js/logMood.js" defer></script>
</head>

<body class="bg-background text-text-primary">
    <?php include './includes/header.php'; ?>

    <main class="max-w-7xl mt-24 mx-auto px-4 flex flex-col gap-12">

        <h1 class="text-5xl font-bold text-center text-primary mb-8">Log Your Mood</h1>

        <div class="flex flex-col lg:flex-row gap-12">

            <!-- Mood Categories -->
            <div class="lg:w-1/2 bg-card-bg rounded-xl p-8 shadow-md hover:shadow-xl transition">
                <h2 class="text-3xl font-semibold mb-6">How was your mood today?</h2>
                <form id="moodCategoryForm" class="flex flex-col gap-4">
                    <?php foreach ($categories as $category): ?>
                        <?php
                        $id = htmlspecialchars($category['category_id']);
                        $name = htmlspecialchars($category['name']);
                        $category_img = htmlspecialchars($category['image']);

                        echo '
                        <div class="flex items-center justify-between border-2 px-4 py-3 rounded-xl border-gray-300 hover:border-primary transition-all mb-4 cursor-pointer">
                            <div class="flex items-center gap-2">
                                <input type="radio" id="mood-' . $id . '" name="mood" value="' . $id . '" class="cursor-pointer" ' . ($name == 'Neutral' ? 'checked' : '') . '>
                                <label for="mood-' . $id . '" class="font-semibold text-lg cursor-pointer">' . ucfirst($name) . '</label>
                            </div>
                            <span class="text-3xl">' . $category_img . '</span>
                        </div>';
                        ?>
                    <?php endforeach; ?>
                </form>
            </div>

            <!-- Mood Details -->
            <div class="lg:w-1/2 bg-card-bg rounded-xl p-8 shadow-md hover:shadow-xl transition">
                <form id="moodForm" class="flex flex-col gap-6">

                    <!-- Mood Intensity -->
                    <div class="flex flex-col">
                        <div class="flex justify-between">
                            <label for="moodIntensity" class="text-lg font-medium">Mood Intensity (1-10)</label>
                            <span class="text-red-500 text-error" id="error-moodIntensity"></span>
                        </div>
                        <input type="range" id="moodIntensity" name="moodIntensity" min="1" max="10"
                            class="w-full mt-2">
                        <p class="text-sm text-text-secondary mt-1">How strong is the feeling?</p>
                    </div>

                    <!-- Sleep Hours -->
                    <div class="flex flex-col">
                        <div class="flex justify-between">
                            <label for="sleepHours" class="text-lg font-medium">Hours of Sleep</label>
                            <span class="text-red-500 text-error" id="error-hoursSlept"></span>
                        </div>
                        <input type="number" id="sleepHours" name="sleepHours" min="0" max="24"
                            class="w-full border border-gray-300 rounded px-3 py-2 mt-2" required>
                    </div>

                    <!-- Notes -->
                    <div class="flex flex-col">
                        <div class="flex justify-between">
                            <label for="notes" class="text-lg font-medium">Notes</label>
                            <span class="text-red-500 text-error" id="error-notes"></span>
                        </div>
                        <textarea id="notes" name="notes" rows="4"
                            class="w-full border border-gray-300 rounded px-3 py-2 mt-2" required></textarea>
                    </div>

                    <!-- Insights -->
                    <div class="flex flex-col">
                        <div class="flex justify-between">
                            <label for="insight" class="text-lg font-medium">Insights</label>
                            <span class="text-red-500 text-error" id="error-insight"></span>
                        </div>
                        <textarea id="insight" name="insight" rows="4"
                            class="w-full border border-gray-300 rounded px-3 py-2 mt-2" required></textarea>
                    </div>

                    <!-- Tag Selection -->
                    <div class="flex flex-col">
                        <div class="flex justify-between">
                            <label for="tag" class="text-lg font-medium">Tag</label>
                            <span class="text-red-500 text-error" id="error-tag"></span>
                        </div>
                        <select id="tag" name="tag"
                            class="w-full border border-gray-300 rounded px-3 py-2 mt-2">
                            <option value="">Select a tag</option>
                            <?php while ($row = mysqli_fetch_assoc($tags)) : ?>
                                <option value="<?= htmlspecialchars($row['name']) ?>"><?= htmlspecialchars($row['name']) ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit"
                        class="mt-4 bg-primary hover:bg-secondary text-white font-semibold rounded-lg px-6 py-3 shadow-md transition">
                        Log Mood
                    </button>
                </form>
            </div>
        </div>
    </main>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
</body>

</html>
