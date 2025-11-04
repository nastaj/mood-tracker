<?php
echo '
    <script src="https://kit.fontawesome.com/bf8d4f7ae9.js" crossorigin="anonymous"></script>
    <script src="./assets/js/nav.js" defer></script>
    <script type="module" src="./assets/js/cart/cart.js" defer></script>
    <script src="./assets/js/logout.js" defer></script>
    <header class="p-6 border-b-2 border-gray-300">
        <nav class="flex justify-between items-center mx-16">
            <a href="home.php" class="text-2xl font-semibold">Mood Tracker</a>
            <div class="flex gap-10 items-center text-xl">
                <a href="merch.php" class="flex gap-2 items-center hover:underline">
                    <img src="./assets/img/merch.png" alt="Merch icon" width="32" height="32">
                    <span>Buy Merch</span>
                </a>
                <a href="moods.php" class="flex gap-2 items-center hover:underline">
                    <img src="./assets/img/entries.png" alt="Entries icon" width="32" height="32">
                    <span>Show Entries</span>
                </a>
                <a href="log_mood.php" class="flex gap-2 items-center hover:underline">
                    <img src="./assets/img/add-log.png" alt="Add log icon" width="32" height="32">
                    <span>Log Mood</span>
                </a>';
                
                include 'cart.php';
echo '
                <!-- Profile/Modal -->
                <div class="relative">
                    <button id="profileBtn" class="hover:cursor-pointer hover:bg-black/20 rounded-full p-1" onclick="toggleUserModal()">
                        <img src="./assets/img/profile.png" alt="Profile icon" width="32" height="32">
                    </button>

                    <div id="userModal" class="hidden absolute right-0 top-12 z-50">
                        <div class="bg-white p-8 rounded-lg shadow-2xl w-56 flex flex-col items-center">
                            <a class="bg-gray-300 hover:bg-gray-400 cursor-pointer rounded px-4 py-2 mb-3 w-full text-center text-lg" href="profile.php">Profile</a>
                            <a class="bg-gray-300 hover:bg-gray-400 cursor-pointer rounded px-4 py-2 mb-3 w-full text-center text-lg" href="wishlist.php">Wishlist</a>
                            <a class="bg-gray-300 hover:bg-gray-400 cursor-pointer rounded px-4 py-2 mb-3 w-full text-center text-lg" href="orders.php">Orders</a>
                            <button id="logoutBtn" class="bg-red-500 hover:bg-red-700 cursor-pointer text-white rounded px-4 py-2 w-full mb-3 text-lg" onclick="logout()">Logout</button>  
                            <button id="closeUserModal" class="px-4 py-2 bg-gray-300 hover:bg-gray-400 cursor-pointer rounded w-full text-lg" onclick="toggleUserModal()">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </header>';
?>