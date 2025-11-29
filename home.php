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
<body class="bg-background text-text-primary">

    <?php include './includes/header.php'; ?>

    <main class="max-w-5xl mt-24 mx-auto px-4 flex flex-col gap-28">

        <!-- Greeting Section -->
        <section class="bg-white shadow-lg rounded-xl p-10 text-center">
            <p id="user-greeting" class="text-3xl font-semibold text-primary transition-colors">Loading...</p>
            <h1 class="text-5xl font-bold mt-4 mb-2">How are you feeling today?</h1>
            <p id="current-date" class="text-lg text-text-secondary mb-6">Current Date</p>
            <a href="log_mood.php" class="inline-block bg-primary text-white px-6 py-3 rounded-xl font-semibold text-lg shadow-md hover:bg-secondary transition">Log Your Mood</a>
        </section>

        <!-- Grid Section -->
        <section class="grid grid-cols-2 grid-rows-2 gap-8">

            <!-- Mood Card -->
            <div class="flex justify-around row-span-2 bg-card-bg gap-12 p-6 rounded-xl shadow-md hover:shadow-xl transition">
                <div class="flex flex-col justify-between">
                    <div>
                        <p class="text-text-secondary">Today, I'm feeling</p>
                        <h3 id="mood-category" class="text-3xl font-bold">Loading...</h3>
                    </div>
                    <div>
                        <p>
                            <img src="./assets/img/quote.png" alt="Quotation mark" width="24" height="24">
                        </p>
                        <p class="text-lg text-text-secondary">"It's a beautiful day!"</p>
                    </div>
                </div>
                <div class="self-center">
                    <p id="mood-emoji" class="text-9xl">😄</p>
                </div>
            </div>

            <!-- Sleep Card -->
            <div class="bg-card-bg rounded-xl p-6 shadow-md hover:shadow-xl transition flex flex-col items-center justify-center">
                <img class="mb-3 w-10 h-10" src="./assets/img/sleep.png" alt="Sleeping icon">
                <p class="text-text-secondary font-semibold text-lg">Sleep</p>
                <p id="sleep-hours" class="text-3xl font-bold mt-2">Loading...</p>
            </div>

            <!-- Insight Card -->
            <div class="bg-card-bg rounded-xl flex flex-col justify-between p-6 shadow-md hover:shadow-xl transition">
                <div class="mb-6">
                    <p class="font-semibold text-lg mb-1">Insight of the day</p>
                    <p id="insight" class="text-text-secondary">Loading...</p>
                </div>
                <p id="tags" class="text-sm text-text-secondary">...</p>
            </div>

        </section>

        <!-- Notes Section -->
        <section class="bg-card-bg rounded-xl p-6 text-center shadow-md hover:shadow-lg transition">
            <h4 class="text-xl font-bold mb-3">Notes for Today</h4>
            <p id="note" class="text-text-secondary">Loading...</p>
        </section>

    </main>
</body>
</html>
