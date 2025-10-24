<?php 
include './includes/auth.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./assets/css/output.css" rel="stylesheet">
    <title>Mood Tracker | Merch</title>
    <script type="module" src="./assets/js/merch.js" defer></script>
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
                <div class="flex flex-col">
                    <label for="category" class="font-semibold mb-3 text-xl">Category</label>
                    <div class="mb-2">
                        <input type="checkbox" id="category-apparel" name="category" value="apparel">
                        <label for="category-apparel">Apparel</label>
                    </div>
                    <div class="mb-2">
                        <input type="checkbox" id="category-accessories" name="category" value="accessories">
                        <label for="category-accessories">Accessories</label>
                    </div>
                    <div class="mb-2">
                        <input type="checkbox" id="category-home-decor" name="category" value="home-decor">
                        <label for="category-home-decor">Home Decor</label>
                    </div>
                </div>
            </div>
        </aside>

        <section class="basis-2/3 flex flex-col mt-12">
            <div class="flex justify-between mb-12">
                <input type="text" id="search-bar" name="search-bar" placeholder="Search merch..." class="border border-gray-300 rounded-lg p-2 w-1/3">
                <div class="flex gap-8 basis-1/3 justify-center">
                    <button value="merch-available" class="hover:cursor-pointer btn-sort">Available</button>
                    <button value="price-ascending" class="hover:cursor-pointer btn-sort">Price ascending</button>
                    <button value="price-descending" class="hover:cursor-pointer btn-sort">Price descending</button>
                </div>
            </div>

            <section id="merch-items" class="space-y-8">
                <!-- Row 1 -->
                 <section class="grid grid-cols-4 gap-8">
                       <article class="border border-gray-300 rounded p-4">
                         <img src="./assets/img/placeholder.png" alt="Merch Item 1" class="w-full h-auto mb-4">
                         <a class="mb-3 font-semibold">Item Name</a>
                         <div class="flex justify-between mb-4">
                             <p class="text-gray-700 mb-2 font-semibold">€19.99</p>
                             <p>Available</p>
                            </div>
                            <button class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Add to Cart</button>
                        </article>
                        
                        <article class="border border-gray-300 rounded p-4">
                            <img src="./assets/img/placeholder.png" alt="Merch Item 1" class="w-full h-auto mb-4">
                            <h5 class="mb-3">Item Name</h5>
                            <div class="flex justify-between mb-4">
                                <p class="text-gray-700 mb-2 font-semibold">€19.99</p>
                                <p>Available</p>
                            </div>
                            <button class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Add to Cart</button>
                        </article>
                        
                        <article class="border border-gray-300 rounded p-4">
                            <img src="./assets/img/placeholder.png" alt="Merch Item 1" class="w-full h-auto mb-4">
                            <h5 class="mb-3">Item Name</h5>
                            <div class="flex justify-between mb-4">
                                <p class="text-gray-700 mb-2 font-semibold">€19.99</p>
                                <p>Available</p>
                            </div>
                            <button class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Add to Cart</button>
                        </article>
                        
                        <article class="border border-gray-300 rounded p-4">
                            <img src="./assets/img/placeholder.png" alt="Merch Item 1" class="w-full h-auto mb-4">
                            <h5 class="mb-3">Item Name</h5>
                            <div class="flex justify-between mb-4">
                                <p class="text-gray-700 mb-2 font-semibold">€19.99</p>
                                <p>Available</p>
                            </div>
                            <button class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Add to Cart</button>
                        </article>
                    </section>
                        
                    <!-- Row 2 -->
                    <section class="grid grid-cols-2 gap-8">
                        <article class="border border-gray-300 rounded p-4 ">
                            <img src="./assets/img/placeholder.png" alt="Merch Item 1" class="w-full h-56 object-fill">
                            <h5 class="mb-3">Item Name</h5>
                            <div class="flex justify-between mb-4">
                                <p class="text-gray-700 mb-2 font-semibold">€19.99</p>
                                <p>Available</p>
                            </div>
                            <button class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Add to Cart</button>
                        </article>
                        
                        <article class="border border-gray-300 rounded p-4">
                            <img src="./assets/img/placeholder.png" alt="Merch Item 1" class="w-full h-56 object-fill mb-4">
                            <h5 class="mb-3">Item Name</h5>
                            <div class="flex justify-between mb-4">
                                <p class="text-gray-700 mb-2 font-semibold">€19.99</p>
                                <p>Available</p>
                            </div>
                            <button class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Add to Cart</button>
                        </article>
                    </section>
                </section>
            </section>
            </main>
        </body>
        </html>