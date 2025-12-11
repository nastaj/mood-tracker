<?php 
include './includes/auth.php';
include './api/merch/get_categories.php';
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="./assets/css/output.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
        <title>Mood Tracker | Merch</title>
        <script type="module" src="./assets/js/merch/merch.js" defer></script>
    </head>
    <body>
        <?php include './includes/header.php'; ?>

        <main class="mx-48 flex">
            <aside class="basis-1/3 mt-12">
                <div class="w-fit border border-gray-300 rounded-lg p-4">
                    <div class="flex flex-col mb-8">
                        <label for="pricing-from" class="font-semibold mb-3 text-xl">Pricing</label>
                        <div>
                            <input type="number" id="pricing-from" name="pricing-from" min="0" max="1000" step="1" class="mr-2 border border-gray-300 rounded px-2 py-1">
                            <span> - </span>
                            <input type="number" id="pricing-to" name="pricing-to" min="0" max="1000" step="1" class="ml-2 border border-gray-300 rounded px-2 py-1">
                        </div>
                    </div>
                    <div class="flex flex-col mb-8">
                        <label for="category" class="font-semibold mb-3 text-xl">Category</label>
                        <?php foreach ($categories as $category): ?>
                            <div class="mb-2">
                                <input type="checkbox" id="category-<?php echo $category['category_id']; ?>" name="category" value="<?php echo $category['category_id']; ?>">
                                <label for="category-<?php echo $category['category_id']; ?>"><?php echo $category['name']; ?></label>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="flex flex-col">
                        <label for="availability" class="font-semibold mb-3 text-xl">Availability</label>
                        <div class="flex flex-col">
                            <div class="flex items-center">
                                <input type="radio" id="availability-in-stock" name="availability" value="in-stock" class="mr-2 border border-gray-300 rounded px-2 py-1" checked>
                                <label for="availability-in-stock">In stock</label>
                            </div>
                            <div class="flex items-center">
                                <input type="radio" id="availability-out-of-stock" name="availability" value="out-of-stock" class="mr-2 border border-gray-300 rounded px-2 py-1">
                                <label for="availability-out-of-stock" class="mr-4">Out of stock</label>
                            </div>
                        </div>
                    </div>
                </div>
            </aside>

            <section class="basis-2/3 flex flex-col mt-12">
                <div class="flex justify-between mb-12">
                    <input type="text" id="search-bar" name="search-bar" placeholder="Search merch..." class="border border-gray-300 rounded-lg p-2 w-1/3">
                    <div class="flex gap-8 justify-center">
                        <button value="most-recent" class="hover:cursor-pointer btn-sort">Most Recent</button>
                        <button value="availability" class="hover:cursor-pointer btn-sort">Available</button>
                        <button value="price-ascending" class="hover:cursor-pointer btn-sort">Price ascending</button>
                        <button value="price-descending" class="hover:cursor-pointer btn-sort">Price descending</button>
                        <button value="rating" class="hover:cursor-pointer btn-sort">Rating</button>
                    </div>
                </div>
                

                <section id="merch-items" class="space-y-8 grid-cols-1 2xl:grid-cols-4 xl:grid-cols-3 lg:grid-cols-2 grid gap-8">
                    <!-- Merch items will be dynamically loaded here -->
                </section>
            </section>
        </main>

        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    </body>
</html>