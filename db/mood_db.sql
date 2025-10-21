-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 21, 2025 at 04:47 PM
-- Server version: 9.1.0
-- PHP Version: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mood_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer_details`
--

DROP TABLE IF EXISTS `customer_details`;
CREATE TABLE IF NOT EXISTS `customer_details` (
  `customer_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `credit_card` varchar(19) NOT NULL,
  `address` varchar(50) NOT NULL,
  PRIMARY KEY (`customer_id`),
  KEY `users_customers_fk` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `merch`
--

DROP TABLE IF EXISTS `merch`;
CREATE TABLE IF NOT EXISTS `merch` (
  `merch_id` int NOT NULL AUTO_INCREMENT,
  `category_id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `stock_quantity` int DEFAULT NULL,
  `description` text,
  `image_url` varchar(50) NOT NULL,
  PRIMARY KEY (`merch_id`),
  KEY `merch_categories_fk` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `merch`
--

INSERT INTO `merch` (`merch_id`, `category_id`, `name`, `price`, `stock_quantity`, `description`, `image_url`) VALUES
(1, 3, 'Motivational Mug', 12.00, 40, 'Start your day with a smile.', 'motivational_mug.png');

-- --------------------------------------------------------

--
-- Table structure for table `merch_categories`
--

DROP TABLE IF EXISTS `merch_categories`;
CREATE TABLE IF NOT EXISTS `merch_categories` (
  `category_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `merch_categories`
--

INSERT INTO `merch_categories` (`category_id`, `name`) VALUES
(1, 'Stress Relief'),
(2, 'Journals & Planners'),
(3, 'Mugs & Accessories');

-- --------------------------------------------------------

--
-- Table structure for table `merch_orders`
--

DROP TABLE IF EXISTS `merch_orders`;
CREATE TABLE IF NOT EXISTS `merch_orders` (
  `merch_order_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `merch_id` int NOT NULL,
  `quantity` int DEFAULT '1',
  `total_price` decimal(8,2) NOT NULL,
  `order_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`merch_order_id`),
  KEY `merch_fk` (`merch_id`),
  KEY `users_fk` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mood_categories`
--

DROP TABLE IF EXISTS `mood_categories`;
CREATE TABLE IF NOT EXISTS `mood_categories` (
  `category_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` text,
  `image` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `mood_categories`
--

INSERT INTO `mood_categories` (`category_id`, `name`, `description`, `image`) VALUES
(1, 'Very Happy', 'Feeling ecstatic, joyful, or delighted', '😁'),
(2, 'Happy', 'Feeling good and positive', '😊'),
(3, 'Neutral', 'Neither positive nor negative', '😐'),
(4, 'Sad', 'Feeling down or upset', '😒'),
(5, 'Very Sad', 'Feeling deeply sad or hopeless', '☹️');

-- --------------------------------------------------------

--
-- Table structure for table `mood_entries`
--

DROP TABLE IF EXISTS `mood_entries`;
CREATE TABLE IF NOT EXISTS `mood_entries` (
  `entry_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `intensity` tinyint DEFAULT NULL,
  `notes` text,
  `insight` text,
  `hours_of_sleep` int DEFAULT NULL,
  `entry_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`entry_id`),
  KEY `users_moodentries_fk` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `mood_entries`
--

INSERT INTO `mood_entries` (`entry_id`, `user_id`, `intensity`, `notes`, `insight`, `hours_of_sleep`, `entry_date`) VALUES
(30, 10, 8, 'Feeling great today after a good workout.', 'Exercise really boosts my mood.', 7, '2025-09-30 23:00:00'),
(31, 10, 6, 'A bit tired and stressed from work.', 'Need to manage work stress better.', 6, '2025-10-01 23:00:00'),
(32, 10, 7, 'Had a fun outing with friends.', 'Socializing lifts my spirits.', 8, '2025-10-02 23:00:00'),
(33, 10, 5, 'Feeling meh, nothing special.', 'Could try meditating.', 5, '2025-10-03 23:00:00'),
(34, 10, 9, 'Excited about upcoming trip.', 'Looking forward to new experiences.', 7, '2025-10-04 23:00:00'),
(35, 10, 4, 'A little anxious about deadlines.', 'Better planning could help.', 6, '2025-10-05 23:00:00'),
(36, 10, 6, 'Good day overall, productive at work.', 'Staying organized helps mood.', 7, '2025-10-06 23:00:00'),
(37, 10, 3, 'Feeling down, skipped breakfast.', 'Need to take care of health.', 4, '2025-10-07 23:00:00'),
(38, 10, 8, 'Happy after completing a personal project.', 'Accomplishments boost confidence.', 8, '2025-10-08 23:00:00'),
(39, 10, 5, 'Neutral day, nothing special.', 'Maybe try something new tomorrow.', 6, '2025-10-09 23:00:00'),
(40, 10, 7, 'Relaxing evening, watched a movie.', 'Relaxation is important.', 7, '2025-10-10 23:00:00'),
(41, 10, 6, 'Work was stressful but managed.', 'Stress management is key.', 5, '2025-10-11 23:00:00'),
(42, 10, 9, 'Feeling very happy, great news!', 'Good things make me appreciate life.', 7, '2025-10-12 23:00:00'),
(43, 10, 4, 'A bit sad thinking about past.', 'Need to focus on present.', 6, '2025-10-13 23:00:00'),
(44, 10, 8, 'Motivated for new challenges.', 'Setting goals keeps me energized.', 8, '2025-10-14 23:00:00'),
(45, 10, 5, 'Mild mood, average day.', 'Could try journaling.', 6, '2025-10-15 23:00:00'),
(46, 10, 7, 'Had a productive day at work.', 'Completing tasks improves mood.', 7, '2025-10-16 23:00:00'),
(47, 10, 6, 'Feeling a bit tired.', 'Sleep more for better energy.', 5, '2025-10-17 23:00:00'),
(48, 10, 8, 'Excited about weekend plans.', 'Planning fun activities helps mood.', 7, '2025-10-18 23:00:00'),
(49, 10, 4, 'Low mood, gloomy weather.', 'Maybe get some sunlight.', 6, '2025-10-19 23:00:00'),
(50, 10, 7, 'Happy after meeting old friends.', 'Connections matter.', 8, '2025-10-20 23:00:00'),
(51, 10, 6, 'A neutral day, did chores.', 'Routine can be comforting.', 6, '2025-10-21 23:00:00'),
(52, 10, 9, 'Feeling very happy, accomplished goal.', 'Small wins matter.', 7, '2025-10-22 23:00:00'),
(53, 10, 5, 'A bit stressed from deadlines.', 'Breaks could help.', 5, '2025-10-23 23:00:00'),
(54, 10, 8, 'Motivated and energetic.', 'Good exercise in the morning.', 7, '2025-10-24 23:00:00'),
(55, 10, 4, 'Felt anxious about finances.', 'Need to plan budget better.', 6, '2025-10-25 23:00:00'),
(56, 10, 7, 'Calm evening, read a book.', 'Reading relaxes me.', 7, '2025-10-27 00:00:00'),
(57, 10, 6, 'Neutral mood, normal day.', 'Could focus on hobbies.', 6, '2025-10-28 00:00:00'),
(58, 10, 8, 'Excited about new opportunities.', 'Opportunities bring energy.', 8, '2025-10-29 00:00:00'),
(59, 10, 5, 'A bit tired and sad.', 'Sleep and self-care needed.', 5, '2025-10-30 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `mood_entry_categories`
--

DROP TABLE IF EXISTS `mood_entry_categories`;
CREATE TABLE IF NOT EXISTS `mood_entry_categories` (
  `link_id` int NOT NULL AUTO_INCREMENT,
  `entry_id` int NOT NULL,
  `category_id` int NOT NULL,
  PRIMARY KEY (`link_id`),
  KEY `mec_mc_fk` (`category_id`),
  KEY `moodentries_mec_fk` (`entry_id`)
) ENGINE=InnoDB AUTO_INCREMENT=301 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `mood_entry_categories`
--

INSERT INTO `mood_entry_categories` (`link_id`, `entry_id`, `category_id`) VALUES
(270, 29, 1),
(271, 30, 1),
(272, 31, 4),
(273, 32, 1),
(274, 33, 3),
(275, 34, 1),
(276, 35, 3),
(277, 36, 2),
(278, 37, 4),
(279, 38, 2),
(280, 39, 3),
(281, 40, 2),
(282, 41, 3),
(283, 42, 1),
(284, 43, 4),
(285, 44, 2),
(286, 45, 3),
(287, 46, 2),
(288, 47, 4),
(289, 48, 1),
(290, 49, 5),
(291, 50, 1),
(292, 51, 3),
(293, 52, 1),
(294, 53, 3),
(295, 54, 2),
(296, 55, 3),
(297, 56, 2),
(298, 57, 3),
(299, 58, 1),
(300, 59, 4);

-- --------------------------------------------------------

--
-- Table structure for table `mood_entry_tags`
--

DROP TABLE IF EXISTS `mood_entry_tags`;
CREATE TABLE IF NOT EXISTS `mood_entry_tags` (
  `entry_id` int NOT NULL,
  `tag_id` int NOT NULL,
  KEY `entry_id_fk` (`entry_id`),
  KEY `tag_id_fk` (`tag_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `mood_entry_tags`
--

INSERT INTO `mood_entry_tags` (`entry_id`, `tag_id`) VALUES
(29, 1),
(29, 2),
(55, 3),
(58, 8),
(56, 3),
(52, 4),
(50, 3),
(48, 8),
(45, 2),
(44, 3),
(43, 5),
(42, 8),
(40, 11),
(39, 8),
(38, 3),
(37, 1),
(35, 2),
(34, 4),
(32, 31),
(31, 9),
(30, 19),
(59, 6),
(57, 34),
(54, 18),
(53, 9),
(51, 14),
(49, 32),
(47, 9),
(46, 7),
(41, 39),
(36, 3),
(33, 24);

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

DROP TABLE IF EXISTS `tags`;
CREATE TABLE IF NOT EXISTS `tags` (
  `tag_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`tag_id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`tag_id`, `name`) VALUES
(50, 'Adventurous'),
(32, 'Alone'),
(5, 'Angry'),
(6, 'Anxious'),
(34, 'Bored'),
(8, 'Calm'),
(2, 'Confident'),
(46, 'Confused'),
(14, 'Content'),
(25, 'Cooking'),
(33, 'Creative'),
(38, 'Curious'),
(18, 'Energetic'),
(27, 'Evening'),
(7, 'Excited'),
(19, 'Exercising'),
(30, 'Family'),
(35, 'Focused'),
(48, 'Friendly'),
(31, 'Friends'),
(10, 'Frustrated'),
(24, 'Gaming'),
(43, 'Grateful'),
(3, 'Happy'),
(44, 'Hopeful'),
(37, 'Inspired'),
(42, 'Jealous'),
(36, 'Lazy'),
(49, 'Loyal'),
(22, 'Meditating'),
(51, 'Mindful'),
(26, 'Morning'),
(1, 'Motivated'),
(39, 'Nervous'),
(13, 'Overwhelmed'),
(40, 'Playful'),
(15, 'Productive'),
(52, 'Proud'),
(11, 'Relaxed'),
(45, 'Relieved'),
(47, 'Romantic'),
(4, 'Sad'),
(41, 'Sadistic'),
(53, 'Silly'),
(16, 'Social'),
(9, 'Stressed'),
(20, 'Studying'),
(17, 'Tired'),
(23, 'Traveling'),
(28, 'Weekend'),
(29, 'Workday'),
(21, 'Working');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password_hash`, `created_at`) VALUES
(1, 'jakub', 'g00424689@atu.ie', '$2y$10$x99ZvW11Xlc2y61vKTWn4..JhC/ZqPw2BZFgdGql5TZ.xZtjGGDc2', '2025-10-10 11:00:45'),
(2, 'alice', 'alice@example.com', '$2y$10$HUn49eF7y58lM3013AqBLuYicWewFh9aJqeHU8eD5GWtQzurh7fwi', '2025-10-10 11:00:45'),
(3, 'bob', 'bob@example.com', '$2y$10$8rFSrqToc/m5M8KC/FXfjuWul1.SZWjW29W8ZlX2ECpPuxmKydlRi', '2025-10-10 11:00:45'),
(4, 'charlie', 'charlie@example.com', '$2y$10$leRMcouDmxvwKn9kN1cbwuDke...bU/ZEJ5bdX0f8T1x9b4gHj08q', '2025-10-10 11:00:45'),
(5, 'diana', 'diana@example.com', '$2y$10$RK3dbEvji5DvtKCVgp7RgeWHd5OJo35/ZMTnfqKZKn4phSkPmU0im', '2025-10-10 11:00:45'),
(6, 'root', 'dev@gmail.com', 'e3b0c44298fc1c149afbf4c8996fb92427ae41e4649b934ca495991b7852b855', '2025-10-10 12:29:10'),
(9, 'ww', 'ww@gmail.com', 'e3b0c44298fc1c149afbf4c8996fb92427ae41e4649b934ca495991b7852b855', '2025-10-10 13:15:03'),
(10, 'kuba', 'kuba@atu.ie', '$2y$10$XrxjmcGukhWJz9e2YpMkPeznJfV.tTwtQnWWOUoHx8vUoK2hBNJKy', '2025-10-10 13:27:55'),
(11, 'warwol', 'asdsad@asdasd.pl', '$2y$10$jI4Mc1ryydibNQQI/UwE5.Eyc5hM0X2G7nhOI5HOFMij0nc7bakQq', '2025-10-10 15:34:42'),
(12, 'warwol2', 'kek@wp.pl', '$2y$10$xf5qO.ZXqaR9wGwnpHVKXuilnYEo37wWh7T0k5f8EjKbNL4tvC4j2', '2025-10-10 15:40:40');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customer_details`
--
ALTER TABLE `customer_details`
  ADD CONSTRAINT `users_customers_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Constraints for table `merch`
--
ALTER TABLE `merch`
  ADD CONSTRAINT `fk_merch_category` FOREIGN KEY (`category_id`) REFERENCES `merch_categories` (`category_id`) ON UPDATE CASCADE;

--
-- Constraints for table `merch_orders`
--
ALTER TABLE `merch_orders`
  ADD CONSTRAINT `fk_merchorder_merch` FOREIGN KEY (`merch_id`) REFERENCES `merch` (`merch_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `fk_merchorder_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `mood_entries`
--
ALTER TABLE `mood_entries`
  ADD CONSTRAINT `fk_mood_entries_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mood_entry_categories`
--
ALTER TABLE `mood_entry_categories`
  ADD CONSTRAINT `fk_mec_category` FOREIGN KEY (`category_id`) REFERENCES `mood_categories` (`category_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `fk_mec_entry` FOREIGN KEY (`entry_id`) REFERENCES `mood_entries` (`entry_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mood_entry_tags`
--
ALTER TABLE `mood_entry_tags`
  ADD CONSTRAINT `entry_id_fk` FOREIGN KEY (`entry_id`) REFERENCES `mood_entries` (`entry_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tag_id_fk` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`tag_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
