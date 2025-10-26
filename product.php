<?php 
include './api/merch/get_categories.php';
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="./assets/css/output.css" rel="stylesheet">
        <title>Mood Tracker | Product Details</title>
    </head>
    <body>
        <?php include './includes/header.php'; ?>

        <main class="lg:flex items-center justify-evenly lg:pt-16">
            <!-- Product Image -->
            <img src="./assets/img/placeholder.png" alt="" class="w-1/5 md:rounded-lg lg:cursor-pointer">

            <!-- Product Details -->
            <article class="p-6 mb-2 basis-2/5 lg:mb-0 xl:basis-2/6">
                <span class="inline-block uppercase font-bold text-sm text-primary-orange tracking-wide mb-4">
                    Moodies
                </span>

                <h1 class="text-3xl lg:text-4xl font-bold text-black leading-none mb-6 lg:mb-8">
                    Fall Limited Edition Sneakers
                </h1>

                <p class="text-neutral-gray-1 mb-6 lg:mb-8">
                    These low-profile sneakers are your perfect casual wear companion.
                    Featuring a durable rubber outer sole, they&apos;ll withstand everything
                    the weather can offer.
                </p>

                <section class="flex justify-between items-center mb-6 lg:flex-col lg:items-start">
                    <div class="flex gap-4 lg:mb-2">
                    <h2 class="text-3xl font-bold">$125.00</h2>
                    <!-- <span class="inline-block text-lg text-primary-orange font-bold bg-primary-pale px-3 py-1 rounded-md">
                        50%
                    </span> -->
                    </div>

                    <!-- <span class="text-lg text-neutral-gray-2 font-bold line-through">
                    $250.00
                    </span> -->
                </section>

                <div class="flex flex-col lg:flex-row mb-12 lg:mb-0 lg:gap-6">
                    <div class="flex justify-between bg-neutral-gray-3 rounded-md px-5 py-3 mb-4 lg:basis-2/5 lg:mb-0">
                        <button type="button" class="cursor-pointer">
                            <i class="fa-minus fa-solid text-primary-orange"></i>
                        </button>

                        <span class="font-bold text-lg">0</span>
                        
                        <button type="button" class="cursor-pointer">
                            <i class="fa-plus fa-solid text-primary-orange"></i>
                        </button>
                    </div>

                    <button
                      type="button"
                      class="flex justify-center gap-4 items-center bg-primary-orange rounded-md px-5 py-3 lg:basis-3/5 hover:opacity-50 hover:drop-shadow-glow active:scale-95 transition-all cursor-pointer"
                    >
                        <svg width="22" height="20" xmlns="http://www.w3.org/2000/svg" class="inline-block">
                            <path
                                d="M20.925 3.641H3.863L3.61.816A.896.896 0 0 0 2.717 0H.897a.896.896 0 1 0 0 1.792h1l1.031 11.483c.073.828.52 1.726 1.291 2.336C2.83 17.385 4.099 20 6.359 20c1.875 0 3.197-1.87 2.554-3.642h4.905c-.642 1.77.677 3.642 2.555 3.642a2.72 2.72 0 0 0 2.717-2.717 2.72 2.72 0 0 0-2.717-2.717H6.365c-.681 0-1.274-.41-1.53-1.009l14.321-.842a.896.896 0 0 0 .817-.677l1.821-7.283a.897.897 0 0 0-.87-1.114ZM6.358 18.208a.926.926 0 0 1 0-1.85.926.926 0 0 1 0 1.85Zm10.015 0a.926.926 0 0 1 0-1.85.926.926 0 0 1 0 1.85Zm2.021-7.243-13.8.81-.57-6.341h15.753l-1.383 5.53Z"
                                fill="hsl(0, 0%, 100%)"
                                fillRule="nonzero"
                            />
                        </svg>
        
                        <span class="text-white text-md font-bold">Add to cart</span>
                    </button>
                </div>
            </article>
        </main>
        <!-- Product Reviews -->
        <section class="lg:flex items-center justify-evenly lg:pt-16">
            <div class="w-1/12"></div>
            <div class="flex flex-col gap-4 p-6">
                <h2 class="text-2xl font-bold mb-4">Customer Reviews</h2>
                <article class="p-4 border border-neutral-gray-2 rounded-md">
                    <h3 class="text-primary-orange font-semibold mb-1">Jane Doe</h3>
                    <p class="text-md text-black mb-4">These sneakers are incredibly comfortable! I wear them all day and my feet never hurt.</p>
                    <p class="text-sm text-neutral-gray-1">26 October 2025</p>
                </article>
                <article class="p-4 border border-neutral-gray-2 rounded-md">
                    <h3 class="text-primary-orange font-semibold mb-1">John Smith</h3>
                    <p class="text-md text-black mb-4">I love the design and the quality is top-notch. Highly recommend!</p>
                    <p class="text-sm text-neutral-gray-1">27 October 2025</p>
                </article>
            </div>
        </section>
    </body>
</html>