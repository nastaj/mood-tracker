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
    <title>Mood Tracker | Checkout</title>
    <script src="./assets/js/checkout.js" defer></script>
</head>

<body>
    <?php include './includes/header.php'; ?>

    <main class="mt-24 px-4 flex justify-evenly">
            <section>
                <h1 class="text-4xl font-bold mb-4">Payment Details</h1>
                <form id="payment-details" class="flex flex-col gap-4 border border-gray-300 rounded-lg p-6">
                    <div class="flex gap-12 mb-4">
                        <div class="flex flex-col">
                            <label for="first-name">First Name</label>
                            <input class="border border-gray-300 rounded py-0.5" type="text" id="first-name" name="first_name" required>
                        </div>
                        <div class="flex flex-col">
                            <label for="last-name">Last Name</label>
                            <input class="border border-gray-300 rounded py-0.5" type="text" id="last-name" name="last_name" required>
                        </div>
                    </div>
                    <div class="flex flex-col mb-4">
                        <label for="email">Email</label>
                        <input class="border border-gray-300 rounded py-0.5" type="email" id="email" name="email" required>
                    </div>
                    <div class="flex flex-col mb-4">
                        <label for="payment-method">Payment Method</label>
                        <select class="border border-gray-300 p-2" name="payment_method" id="payment-method" required>
                            <option value="">Select Payment Method</option>
                            <option value="credit-card">Credit Card</option>
                            <option value="paypal">PayPal</option>
                            <option value="bank-transfer">Bank Transfer</option>
                        </select>
                    </div>
                    <div class="flex flex-col mb-4">
                        <label for="payment-details">Payment Details</label>
                        <input class="border border-gray-300 rounded py-0.5" type="text" id="payment-details" name="payment_details" required>
                    </div>
                    <div class="flex flex-col mb-4">
                        <label for="address">Address</label>
                        <input class="border border-gray-300 rounded py-0.5" type="text" id="address" name="address" required>
                    </div>
                    <button type="submit" class="mt-4 bg-blue-500 text-white px-4 py-2 rounded cursor-pointer">Save Details</button>
                </form>
            </section>

            <section>
                <h2 class="text-4xl font-bold mb-4">Order Summary</h2>
                <div class="flex flex-col gap-2 border border-gray-300 rounded-lg p-4">
                    <div class="flex gap-4 mb-8">
                        <img src="./assets/img/placeholder.png" alt="Product Image" class="w-16 h-16 object-cover mr-4">
                        <div class="flex flex-col justify-between">
                            <h3 class="font-semibold">Product Name</h3>
                            <p class="text-sm text-gray-500">€100.00</p>
                        </div>
                    </div>
                    <div class="border-b border-t border-gray-300 py-2">
                        <p>John Doe</p>
                        <p>Delivery Address</p>
                    </div>
                    <div class="flex justify-between">
                        <span>Tax (10%):</span>
                        <span>€1.00</span>
                    </div>
                    <div class="flex justify-between border-b border-gray-300 pb-2">
                        <span>Delivery:</span>
                        <span>€1.00</span>
                    </div>
                    <div class="flex justify-between font-bold">
                        <span>Total:</span>
                        <span>€10.99</span>
                    </div>
                    <button type="button" class="mt-6 bg-green-500 text-white px-4 py-2 rounded w-full cursor-pointer">Order Now</button>
                </div>
            </section>
    </main>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
</body>

</html>