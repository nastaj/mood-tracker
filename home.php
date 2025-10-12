<?php include './includes/auth.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./assets/css/output.css" rel="stylesheet">
    <title>Mood Tracker | Home</title>
    <script src="./assets/js/home.js" defer></script>
</head>
<body>
    <?php include './includes/header.php'; ?>

    <main class="max-w-5xl mt-24 flex flex-col gap-28 mx-auto px-4">
    <!-- Greeting Section -->
    <div class="text-center space-y-6">
        <p id="user-greeting" class="text-3xl font-semibold text-blue-600">Loading...</p>
        <h1 class="text-5xl font-bold">How are you feeling today?</h1>
        <p id="current-date" class="text-lg mb-12 text-gray-700">Current Date</p>
        <a href="log_mood.php" class="bg-blue-600 text-white px-4 py-2 rounded font-semibold">Log Your Mood</a>
    </div>

    <!-- Grid Section -->
    <div class="grid grid-cols-2 grid-rows-2 gap-x-8 gap-y-6">
        <!-- Mood Card -->
        <div class="flex justify-around row-span-2 bg-gray-200 gap-12 p-6 rounded-xl">
            <div class="flex flex-col justify-between">
                <div>
                    <p class="text-gray-600">Today, I'm feeling</p>
                    <h3 id="mood-category" class="text-3xl font-bold">Loading...</h3>
                </div>
                <div>
                    <p>
                        <img src="./assets/img/quote.png" alt="Quotation mark" width="24" height="24">
                    </p>
                    <p class="text-lg">"It's a beautiful day!"</p>
                </div>
            </div>
            <div class="self-center">
                <p id="mood-emoji" class="text-9xl"></p>
            </div>
        </div>

        <!-- Sleep Card -->
        <div class="bg-gray-200 rounded-xl p-4">
            <p class="mb-4">
                <img class="inline" src="./assets/img/sleep.png" alt="Sleeping icon" width="32" height="32">
                <span class="text-gray-600 font-semibold text-lg">Sleep</span>
            </p>
            <p id="sleep-hours" class="text-2xl font-bold">Loading...</p>
        </div>

        <!-- Insight Card -->
        <div class="bg-gray-200 rounded-xl flex flex-col justify-between p-4">
            <div class="mb-6">
                <p class="font-semibold">Insight of the day</p>
                <p id="insight">Loading...</p>
            </div>
            <p id="tags" class="text-sm text-gray-600">...</p>
        </div>
    </div>

    <!-- Notes Section -->
    <div class="bg-gray-200 rounded-xl p-4 text-center">
        <h4 class="font-bold mb-4">Notes for Today</h4>
        <p id="note">Loading...</p>
    </div>
</main>

</body>
</html>