<?php
echo '<header class="p-12 border-b-2 border-gray-300">
    <nav class="flex justify-between items-center">
        <a href="home.php" class="text-2xl font-semibold">Mood Tracker</a>
        <div class="flex gap-12 items-center text-xl">
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
            </a>
            <button>
                <img src="./assets/img/shopping-cart.png" alt="Shopping cart icon" width="32" height="32">
            </button>
            <button>
                <img src="./assets/img/profile.png" alt="Profile icon" width="32" height="32">
            </button>
        </div>
    </nav>
</header>';
?>