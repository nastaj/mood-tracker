<?php
// Connect to database
include "db_connect.php";

// Create database if not exists
$conn->query("CREATE DATABASE IF NOT EXISTS `$dbname` CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci");
$conn->select_db($dbname);

// Drop tables if exist (to avoid FK issues)
$conn->query("DROP TABLE IF EXISTS `mood_entry_categories`");
$conn->query("DROP TABLE IF EXISTS `mood_entries`");
$conn->query("DROP TABLE IF EXISTS `mood_categories`");
$conn->query("DROP TABLE IF EXISTS `insights`");
$conn->query("DROP TABLE IF EXISTS `merch_orders`");
$conn->query("DROP TABLE IF EXISTS `merch`");
$conn->query("DROP TABLE IF EXISTS `users`");

// Create tables
$conn->query("CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci");

$conn->query("CREATE TABLE IF NOT EXISTS `insights` (
  `insight_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `insight_text` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`insight_id`),
  KEY `users_insights_fk` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci");

$conn->query("CREATE TABLE IF NOT EXISTS `merch` (
  `merch_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `stock_quantity` int DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`merch_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci");

$conn->query("CREATE TABLE IF NOT EXISTS `merch_orders` (
  `merch_order_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `merch_id` int NOT NULL,
  `quantity` int DEFAULT NULL,
  `total_price` decimal(8,2) NOT NULL,
  `order_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`merch_order_id`),
  KEY `merch_fk` (`merch_id`),
  KEY `users_fk` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci");

$conn->query("CREATE TABLE IF NOT EXISTS `mood_categories` (
  `category_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` text,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci");

$conn->query("CREATE TABLE IF NOT EXISTS `mood_entries` (
  `entry_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `intensity` tinyint DEFAULT NULL,
  `notes` text,
  `entry_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`entry_id`),
  KEY `users_moodentries_fk` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci");

$conn->query("CREATE TABLE IF NOT EXISTS `mood_entry_categories` (
  `link_id` int NOT NULL AUTO_INCREMENT,
  `entry_id` int NOT NULL,
  `category_id` int NOT NULL,
  PRIMARY KEY (`link_id`),
  KEY `mec_mc_fk` (`category_id`),
  KEY `moodentries_mec_fk` (`entry_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci");

// Add foreign key constraints
$conn->query("ALTER TABLE `insights`
  ADD CONSTRAINT `users_insights_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE");

$conn->query("ALTER TABLE `merch_orders`
  ADD CONSTRAINT `merch_fk` FOREIGN KEY (`merch_id`) REFERENCES `merch` (`merch_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `users_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE RESTRICT ON UPDATE RESTRICT");

$conn->query("ALTER TABLE `mood_entries`
  ADD CONSTRAINT `users_moodentries_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE");

$conn->query("ALTER TABLE `mood_entry_categories`
  ADD CONSTRAINT `mec_mc_fk` FOREIGN KEY (`category_id`) REFERENCES `mood_categories` (`category_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `moodentries_mec_fk` FOREIGN KEY (`entry_id`) REFERENCES `mood_entries` (`entry_id`) ON DELETE RESTRICT ON UPDATE RESTRICT");

// Populate tables with mock data using prepared statements

// Users
$stmt = $conn->prepare("INSERT INTO `users` (`username`, `email`, `password_hash`, `created_at`) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $username, $email, $password_hash, $created_at);

$users = [
    ['dev', 'g00424689@atu.ie', 'test', '2025-10-03 18:35:21'],
    ['alice', 'alice@example.com', 'hash1', date('Y-m-d H:i:s')],
    ['bob', 'bob@example.com', 'hash2', date('Y-m-d H:i:s')]
];
foreach ($users as $u) {
    [$username, $email, $password_hash, $created_at] = $u;
    $stmt->execute();
}
$stmt->close();

// Merch
$stmt = $conn->prepare("INSERT INTO `merch` (`name`, `price`, `stock_quantity`, `description`) VALUES (?, ?, ?, ?)");
$stmt->bind_param("sdis", $name, $price, $stock_quantity, $description);

$merch = [
    ['Anti-Stress Ball', 10.00, 30, 'Helps you with anxiety during stress moments'],
    ['Mood Journal', 15.50, 20, 'A journal to track your daily moods'],
    ['Motivational Mug', 8.99, 50, 'Start your day with a positive quote']
];
foreach ($merch as $m) {
    [$name, $price, $stock_quantity, $description] = $m;
    $stmt->execute();
}
$stmt->close();

// Merch Orders
$stmt = $conn->prepare("INSERT INTO `merch_orders` (`user_id`, `merch_id`, `quantity`, `total_price`, `order_date`) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("iiids", $user_id, $merch_id, $quantity, $total_price, $order_date);

$orders = [
    [1, 1, 2, 20.00, '2025-10-03 18:50:28'],
    [2, 2, 1, 15.50, date('Y-m-d H:i:s')],
    [3, 3, 3, 26.97, date('Y-m-d H:i:s')]
];
foreach ($orders as $o) {
    [$user_id, $merch_id, $quantity, $total_price, $order_date] = $o;
    $stmt->execute();
}
$stmt->close();

// Mood Categories
$stmt = $conn->prepare("INSERT INTO `mood_categories` (`name`, `description`) VALUES (?, ?)");
$stmt->bind_param("ss", $cat_name, $cat_desc);

$categories = [
    ['Happy', 'Feeling joyful and content'],
    ['Sad', 'Feeling down or unhappy'],
    ['Anxious', 'Feeling nervous or worried'],
    ['Excited', 'Feeling enthusiastic or eager'],
    ['Calm', 'Feeling relaxed and peaceful']
];
foreach ($categories as $c) {
    [$cat_name, $cat_desc] = $c;
    $stmt->execute();
}
$stmt->close();

// Mood Entries
$stmt = $conn->prepare("INSERT INTO `mood_entries` (`user_id`, `intensity`, `notes`, `entry_date`) VALUES (?, ?, ?, ?)");
$stmt->bind_param("iiss", $user_id, $intensity, $notes, $entry_date);

$mood_entries = [
    [1, 8, 'Had a productive day!', '2025-10-03 09:00:00'],
    [2, 3, 'Feeling a bit low.', '2025-10-03 10:00:00'],
    [3, 6, 'Looking forward to the weekend.', '2025-10-03 11:00:00'],
    [1, 5, 'Some anxiety before meeting.', '2025-10-04 08:30:00']
];
foreach ($mood_entries as $me) {
    [$user_id, $intensity, $notes, $entry_date] = $me;
    $stmt->execute();
}
$stmt->close();

// Mood Entry Categories (linking entries to categories)
$stmt = $conn->prepare("INSERT INTO `mood_entry_categories` (`entry_id`, `category_id`) VALUES (?, ?)");
$stmt->bind_param("ii", $entry_id, $category_id);

$entry_categories = [
    [1, 1], // Happy
    [2, 2], // Sad
    [3, 4], // Excited
    [4, 3]  // Anxious
];
foreach ($entry_categories as $ec) {
    [$entry_id, $category_id] = $ec;
    $stmt->execute();
}
$stmt->close();

// Insights
$stmt = $conn->prepare("INSERT INTO `insights` (`user_id`, `insight_text`, `created_at`) VALUES (?, ?, ?)");
$stmt->bind_param("iss", $user_id, $insight_text, $created_at);

$insights = [
    [1, 'Regular journaling helps improve mood awareness.', date('Y-m-d H:i:s')],
    [2, 'Exercise seems to boost my happiness.', date('Y-m-d H:i:s')],
    [3, 'Socializing reduces my anxiety.', date('Y-m-d H:i:s')]
];
foreach ($insights as $ins) {
    [$user_id, $insight_text, $created_at] = $ins;
    $stmt->execute();
}
$stmt->close();

echo "Database and tables created, mock data inserted.";
$conn->close();
?>