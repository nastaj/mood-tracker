<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="./assets/css/output.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
        <script src="./assets/js/merch/product.js" type="module"></script>
        <title>Mood Tracker | Product Details</title>
    </head>
    <body>
        <?php include './includes/header.php'; ?>
        <main id="product-container" class="lg:flex items-center justify-evenly lg:pt-16 mb-12">
            <!-- Product Details will be dynamically loaded here -->
        </main>

        <section id="reviews-container" class="lg:flex flex-col gap-6 items-center mb-12">
            <!-- Product Reviews will be dynamically loaded here -->
        </section>

        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    </body>
</html>