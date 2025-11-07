<?php include './includes/auth.php'; ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="./assets/css/output.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
        <title>Mood Tracker | Profile</title>
        <script src="./assets/js/logout.js" defer></script>
        <script type="module" src="./assets/js/profile.js" defer></script>
    </head>
    <body>
        <!-- Header -->
        <?php include './includes/header.php'; ?>

        <main class="mt-24 flex flex-col items-center px-4">
            <section class="w-full max-w-4xl">
                <h1 class="text-3xl font-bold mb-8 text-center">My Profile</h1>

                <!-- Profile Overview -->
                <div class="flex flex-col md:flex-row items-center md:items-start gap-6 bg-white border border-gray-200 rounded-lg p-6 shadow-sm">
                    <img src="./assets/img/placeholder.png" alt="Profile Picture" class="w-24 h-24 rounded-full object-cover border border-gray-300">
                    <div class="flex-1">
                        <h2 id="name-display" class="text-xl font-semibold">John Doe</h2>
                        <p id="email-display" class="text-gray-600">john@example.com</p>
                        <p class="text-gray-500 text-sm mt-1">Member since: March 2024</p>
                        <button id="edit-profile-btn" class="mt-4 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition-all">Edit Profile</button>
                    </div>
                </div>

                <!-- Tabs -->
                <div class="mt-10 flex justify-center gap-6 text-gray-600 font-medium border-b border-gray-300 pb-2">
                    <button class="tab-btn active text-blue-600 border-b-2 border-blue-600 pb-2 cursor-pointer" data-tab="orders">Orders</button>
                    <button class="tab-btn cursor-pointer" data-tab="payment">Payment Details</button>
                    <button class="tab-btn cursor-pointer" data-tab="settings">Account Settings</button>
                </div>

                <!-- Content Sections -->
                <section id="orders" class="tab-content mt-8">
                    <h2 class="text-xl font-semibold mb-4">Your Orders</h2>
                    <div class="border border-gray-200 rounded p-4 text-gray-600">
                        <p>No orders yet.</p>
                    </div>
                </section>

                <section id="payment" class="tab-content hidden mt-8">
                    <h2 class="text-xl font-semibold mb-4">Payment Details</h2>
                    <form id="payment-details-form" class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <input id="first-name" type="text" name="first_name" placeholder="First Name" class="border border-gray-300 p-2 rounded" required>
                        <input id="last-name" type="text" name="last_name" placeholder="Last Name" class="border border-gray-300 p-2 rounded" required>
                        <input id="email" type="email" name="email" placeholder="Email" class="border border-gray-300 p-2 rounded" required>
                        <select id="payment-method" name="payment_method" class="border border-gray-300 p-2 rounded" required>
                            <option value="">Select Payment Method</option>
                            <option value="credit-card">Credit Card</option>
                            <option value="paypal">PayPal</option>
                            <option value="bank-transfer">Bank Transfer</option>
                        </select>
                        <input id="payment-details" type="text" name="payment_details" placeholder="Payment Details" class="border border-gray-300 p-2 rounded" required>
                        <input id="address" type="text" name="address" placeholder="Address" class="border border-gray-300 p-2 rounded col-span-full" required>
                        <button type="submit" class="col-span-full bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition-all cursor-pointer">Save</button>
                    </form>
                </section>

                <section id="settings" class="tab-content hidden mt-8">
                    <h2 class="text-xl font-semibold mb-4">Account Settings</h2>
                    <button id="change-password-btn" class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300 transition-all cursor-pointer">Change Password</button>
                    <button id="delete-account-btn" class="ml-4 px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600 transition-all cursor-pointer">Delete Account</button>
                    <button id="logout-btn" class="ml-4 px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600 transition-all cursor-pointer" onclick="logout()">Logout</button>
                </section>
        </section>
    </main>

    <!-- Delete Account Confirmation Modal -->
    <div id="deleteModal" class=" fixed hidden inset-0 flex items-center justify-center z-50">
        <div class="bg-white p-8 rounded-lg shadow-xl max-w-md w-full mx-4">
            <h2 class="text-2xl font-bold mb-4">Confirm Deletion</h2>
            <p class="mb-6">Confirm your password in order to delete your account. This action cannot be undone.</p>
            <input id="delete-account-password" type="password" placeholder="Enter your password" class="border border-gray-300 p-2 rounded mb-4" required>
            <div class="flex gap-4 justify-end">
                <button id="cancelDelete" class="px-4 py-2 bg-gray-300 hover:bg-gray-400 rounded">Cancel</button>
                <button id="confirmDelete" class="px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded">Delete</button>
            </div>
        </div>
    </div>

    <!-- Change Password Modal -->
    <div id="changePasswordModal" class="fixed hidden inset-0 flex items-center justify-center z-50">
        <div class="bg-white p-8 rounded-lg shadow-xl max-w-md w-full mx-4">
            <h2 class="text-2xl font-bold mb-4">Change Password</h2>
            <form id="change-password-form" class="flex flex-col">
                <input id="current-password" type="password" placeholder="Current Password" name="current_password" class="border border-gray-300 p-2 rounded mb-4" required>
                <input id="new-password" type="password" placeholder="New Password" name="new_password" class="border border-gray-300 p-2 rounded mb-4" required>
                <input id="confirm-new-password" type="password" placeholder="Confirm New Password" name="confirm_password" class="border border-gray-300 p-2 rounded mb-4" required>
                <div class="flex gap-4 justify-end">
                    <button type="button" id="cancelChangePassword" class="px-4 py-2 bg-gray-300 hover:bg-gray-400 rounded cursor-pointer">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded cursor-pointer">Change Password</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Profile Modal -->
     <div id="editProfileModal" class="hidden fixed inset-0 flex items-center justify-center z-50">
        <div class="bg-white p-8 rounded-lg shadow-xl max-w-md w-full mx-4">
            <h2 class="text-2xl font-bold mb-4">Edit Profile</h2>
            <form id="edit-profile-form" class="flex flex-col">
                <input id="first-name" type="text" placeholder="First Name" name="first_name" class="border border-gray-300 p-2 rounded mb-4">
                <input id="last-name" type="text" placeholder="Last Name" name="last_name" class="border border-gray-300 p-2 rounded mb-4">
                <input id="email" type="email" placeholder="Email" name="email" class="border border-gray-300 p-2 rounded mb-4">
                <div class="flex gap-4 justify-end">
                    <button type="button" id="cancelEditProfile" class="px-4 py-2 bg-gray-300 hover:bg-gray-400 rounded cursor-pointer">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded cursor-pointer">Save Changes</button>
                </div>
            </form>
        </div>
    </div>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    </body>
</html>