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
    <script type="module" src="./assets/js/checkout.js" defer></script>
</head>

<body>
    <?php include './includes/header.php'; ?>

    <main class="mt-24 px-4 flex justify-evenly">
            <section>
                <h1 class="text-4xl font-bold mb-4">Payment Details</h1>
                <form id="payment-details-form" class="flex flex-col gap-4 border border-gray-300 rounded-lg p-6">
                    <div class="flex gap-12 mb-4">
                        <div class="flex flex-col">
                            <label for="first-name">First Name</label>
                            <input class="border border-gray-300 rounded py-1 px-2" type="text" id="first-name" name="first_name" placeholder="John" required>
                        </div>
                        <div class="flex flex-col">
                            <label for="last-name">Last Name</label>
                            <input class="border border-gray-300 rounded py-1 px-2" type="text" id="last-name" name="last_name" placeholder="Doe" required>
                        </div>
                    </div>
                    <div class="flex flex-col mb-4">
                        <label for="email">Email</label>
                        <input class="border border-gray-300 rounded py-1 px-2" type="email" id="email" name="email" placeholder="john.doe@gmail.com" required>
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
                        <input class="border border-gray-300 rounded py-1 px-2" type="text" id="payment-details" name="payment_details" placeholder="**** **** **** ****" required>
                    </div>
                    <div class="flex flex-col mb-4">
                        <label for="address">Address</label>
                        <input class="border border-gray-300 rounded py-1 px-2" type="text" id="address" name="address" placeholder="123 Main St, City, Country" required>
                    </div>
                    <button type="submit" class="mt-4 bg-blue-500 text-white px-4 py-2 rounded cursor-pointer">Save Details</button>
                </form>
            </section>

            <section>
                <h2 class="text-4xl font-bold mb-4">Order Summary</h2>
                <div class="flex flex-col gap-2 border border-gray-300 rounded-lg p-4">
                    <!-- Order items will be displayed here -->
                    <?php include './api/checkout/get_order_summary.php'; ?>
                    
                    <button type="button" class="mt-6 bg-green-500 text-white px-4 py-2 rounded w-full cursor-pointer">Order Now</button>
                </div>
            </section>
    </main>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
</body>

</html>