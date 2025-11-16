<?php include './includes/auth.php';?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <link href="./assets/css/output.css" rel="stylesheet">

    <title>Mood Tracker | Your Orders</title>
    <script type="module" src="./assets/js/orders.js" defer></script>
</head>
<body>
    <?php include './includes/header.php'; ?>

    <main class="mt-8 px-4 flex flex-col items-center gap-8">
        <h1 class="text-3xl font-semibold">Your Orders</h1>
        <div id="orders-container" class="w-full flex flex-col items-center"></div>
    </main>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
</body>
</html>