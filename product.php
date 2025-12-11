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

        <section class="lg:flex flex-col gap-6 items-center mb-12">
            <form id="review-form" class="flex flex-col gap-4 w-1/2 bg-white p-6 rounded-xl shadow">
                <label class="font-semibold text-lg">Your Rating</label>
                <div id="star-rating" class="flex text-3xl gap-2 cursor-pointer select-none">
                    <i data-value="1" class="user-rating far fa-star text-gray-300"></i>
                    <i data-value="2" class="user-rating far fa-star text-gray-300"></i>
                    <i data-value="3" class="user-rating far fa-star text-gray-300"></i>
                    <i data-value="4" class="user-rating far fa-star text-gray-300"></i>
                    <i data-value="5" class="user-rating far fa-star text-gray-300"></i>
                </div>

                <!-- Hidden input that stores rating -->
                <input type="hidden" id="selected-rating" name="rating" value="0">

                <label for="review" class="font-semibold text-lg">Your Review</label>
                <textarea
                    name="review"
                    id="review"
                    placeholder="Write your review here"
                    class="border p-3 border-gray-300 rounded h-32"
                ></textarea>

                <button class="bg-primary text-white px-4 py-2 rounded font-semibold cursor-pointer hover:opacity-50 hover:drop-shadow-glow active:scale-95 transition-all" type="submit">
                    Submit Review
                </button>

            </form>
        </section>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    </body>
</html>