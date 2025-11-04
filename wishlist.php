<?php include './includes/auth.php'; ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="./assets/css/output.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
        <script type="module" src="./assets/js/wishlist/wishlist.js" defer></script>
        <title>Mood Tracker | Wishlist</title>
    </head>
    <body>
        <?php include './includes/header.php'; ?>
        
        <main class="mt-24 flex flex-col gap-16 px-4 items-center">
            <h1 class="text-3xl font-bold">Your Wishlist</h1>
            <div id="wishlist-items" class="grid grid-cols-1 gap-6 w-full max-w-4xl">
                <?php include './api/wishlist/get_wishlist_items.php'; ?>
            </div>
        </main>

        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    </body>
</html>