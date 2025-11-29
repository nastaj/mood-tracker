<?php
echo '
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/bf8d4f7ae9.js" crossorigin="anonymous"></script>
    <script src="./assets/js/nav.js" defer></script>
    <script type="module" src="./assets/js/cart/cart.js" defer></script>
    <script src="./assets/js/logout.js" defer></script>

    <header class="sticky top-0 z-50 bg-white shadow-sm">
        <nav class="flex justify-between items-center px-10 py-4">
            <!-- Left — Brand -->
            <div class="flex items-center gap-2">
                <a href="home.php" class="fa-regular fa-face-grin-beam text-secondary text-3xl"></a>
                <a href="home.php" class="text-primary text-2xl font-bold tracking-tight">Mood Tracker</a>
            </div>

            <!-- Center — Nav Links -->
            <div class="hidden lg:flex gap-8 items-center text-lg font-semibold text-text-primary">
                <a href="merch.php" class="flex gap-2 items-center hover:text-primary transition-colors">
                    <img src="./assets/img/merch.png" width="28" height="28" />
                    <span>Buy Merch</span>
                </a>
                <a href="moods.php" class="flex gap-2 items-center hover:text-primary transition-colors">
                    <img src="./assets/img/entries.png" width="28" height="28" />
                    <span>Show Entries</span>
                </a>
                <a href="log_mood.php" class="flex gap-2 items-center hover:text-primary transition-colors">
                    <img src="./assets/img/add-log.png" width="28" height="28" />
                    <span>Log Mood</span>
                </a>
            </div>

            <!-- Right — Profile -->
            <div class="relative flex items-center gap-6">
            '; include 'cart.php'; echo '
                <button 
                    id="profileBtn"
                    class="rounded-full p-1 hover:bg-slate-200 hover:cursor-pointer transition"
                    onclick="toggleUserModal()"
                >
                    <img src="./assets/img/profile.png" width="36" height="36" />
                </button>

                <!-- Dropdown -->
                <div 
                    id="userModal" 
                    class="hidden absolute right-0 top-14 bg-white shadow-xl rounded-xl w-60 p-4 border border-gray-200 animate-fade-in"
                >
                    <div class="flex flex-col gap-3">
                        <a class="menu-link" href="profile.php">Profile</a>
                        <a class="menu-link" href="wishlist.php">Wishlist</a>
                        <a class="menu-link" href="orders.php">Orders</a>

                        <button 
                            id="logoutBtn" 
                            class="w-full bg-danger text-white py-2 rounded-lg font-semibold hover:bg-red-600 transition hover:cursor-pointer"
                            onclick="logout()"
                        >
                            Logout
                        </button>

                        <button 
                            id="closeUserModal" 
                            class="w-full bg-slate-200 py-2 rounded-lg font-semibold hover:bg-slate-300 transition hover:cursor-pointer"
                            onclick="toggleUserModal()"
                        >
                            Close
                        </button>
                    </div>
                </div>
            </div>
        </nav>
    </header>
';
?>
