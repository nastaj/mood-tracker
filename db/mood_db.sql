-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 24, 2025 at 08:43 PM
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
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `merch`
--

INSERT INTO `merch` (`merch_id`, `category_id`, `name`, `price`, `stock_quantity`, `description`, `image_url`) VALUES
(1, 3, 'Motivational Mug', 12.00, 40, 'Start your day with a smile.', 'motivational_mug.png'),
(2, 1, 'Aromatherapy Candle', 12.99, 50, 'Relaxing scented candle for stress relief', './assets/img/merch/aromatherapy_candle.png'),
(3, 2, 'Mindfulness Journal', 15.50, 40, 'Daily journal to track thoughts and moods', './assets/img/merch/mindfulness_journal.png'),
(4, 3, 'Motivational Mug', 9.99, 60, 'Ceramic mug with motivational quotes', './assets/img/merch/motivational_mug.png'),
(5, 4, 'Fidget Spinner', 7.99, 80, 'Keep your hands busy and stress-free', './assets/img/merch/fidget_spinner.png'),
(6, 5, 'Logo Hoodie', 39.99, 30, 'Comfortable hoodie with our brand logo', './assets/img/merch/logo_hoodie.png'),
(7, 6, 'Wireless Earbuds', 59.99, 25, 'High-quality earbuds for music lovers', './assets/img/merch/wireless_earbuds.png'),
(8, 7, 'Decorative Plant', 14.99, 50, 'Indoor plant to brighten up your room', './assets/img/merch/decorative_plant.png'),
(9, 8, 'Collector’s Pin Set', 19.99, 20, 'Limited edition pin set', './assets/img/merch/collectors_pin_set.png'),
(10, 9, 'Starter Bundle', 79.99, 15, 'Includes hoodie, mug, and journal', './assets/img/merch/starter_bundle.png'),
(11, 1, 'Stress Ball', 5.99, 100, 'Squeeze to release tension', './assets/img/merch/stress_ball.png'),
(12, 2, 'Gratitude Journal', 16.50, 40, 'Reflect on positive moments daily', './assets/img/merch/gratitude_journal.png'),
(13, 3, 'Inspirational Mug', 10.50, 60, 'Start your day motivated', './assets/img/merch/inspirational_mug.png'),
(14, 4, 'Keychain', 4.99, 70, 'Cute and handy keychain', './assets/img/merch/keychain.png'),
(15, 5, 'T-Shirt', 24.99, 50, 'Comfortable cotton t-shirt', './assets/img/merch/tshirt.png'),
(16, 6, 'Portable Charger', 29.99, 35, 'Keep your devices powered on the go', './assets/img/merch/portable_charger.png'),
(17, 7, 'Desk Organizer', 22.99, 40, 'Keep your workspace tidy', './assets/img/merch/desk_organizer.png'),
(18, 8, 'Limited Edition Poster', 12.99, 25, 'Exclusive poster artwork', './assets/img/merch/limited_poster.png'),
(19, 9, 'Premium Bundle', 99.99, 10, 'Includes hoodie, earbuds, and mug', './assets/img/merch/premium_bundle.png'),
(20, 1, 'Meditation Stones', 8.99, 60, 'Set of calming stones for meditation', './assets/img/merch/meditation_stones.png'),
(21, 2, 'Planner Journal', 18.00, 35, 'Plan your days effectively', './assets/img/merch/planner_journal.png'),
(22, 3, 'Coffee Mug Set', 14.99, 40, 'Two mugs with fun designs', './assets/img/merch/coffee_mug_set.png'),
(23, 4, 'Phone Grip', 6.99, 90, 'Easy-to-hold phone accessory', './assets/img/merch/phone_grip.png'),
(24, 5, 'Zip Hoodie', 42.99, 30, 'Stylish zip hoodie', './assets/img/merch/zip_hoodie.png'),
(25, 6, 'Bluetooth Speaker', 49.99, 20, 'Portable speaker with great sound', './assets/img/merch/bluetooth_speaker.png'),
(26, 7, 'Wall Clock', 27.99, 25, 'Modern design wall clock', './assets/img/merch/wall_clock.png'),
(27, 8, 'Signed Poster', 15.99, 15, 'Limited edition signed poster', './assets/img/merch/signed_poster.png'),
(28, 9, 'Family Bundle', 119.99, 8, 'Hoodie, mugs, and planner set', './assets/img/merch/family_bundle.png'),
(29, 1, 'Yoga Mat', 21.99, 45, 'Non-slip mat for exercise', './assets/img/merch/yoga_mat.png'),
(30, 2, 'Daily Journal', 14.50, 50, 'Track your daily moods', './assets/img/merch/daily_journal.png'),
(31, 3, 'Tea Mug', 9.50, 70, 'Ceramic mug for tea lovers', './assets/img/merch/tea_mug.png'),
(32, 4, 'Notebook', 5.50, 60, 'Compact notebook for notes', './assets/img/merch/notebook.png'),
(33, 5, 'Sweatpants', 29.99, 40, 'Comfortable lounge pants', './assets/img/merch/sweatpants.png'),
(34, 6, 'Smartwatch', 129.99, 15, 'Track your fitness and notifications', './assets/img/merch/smartwatch.png'),
(35, 7, 'Photo Frame', 11.99, 50, 'Decorative frame for photos', './assets/img/merch/photo_frame.png'),
(36, 8, 'Limited Edition Mug', 12.99, 20, 'Special collectible mug', './assets/img/merch/limited_mug.png'),
(37, 9, 'Mega Bundle', 149.99, 5, 'Complete merch package', './assets/img/merch/mega_bundle.png'),
(38, 1, 'Aromatherapy Oil', 13.99, 35, 'Calming essential oils', './assets/img/merch/aromatherapy_oil.png'),
(39, 2, 'Reflection Journal', 17.50, 45, 'Daily reflection prompts', './assets/img/merch/reflection_journal.png'),
(40, 3, 'Funny Mug', 10.99, 55, 'Humorous quotes on mug', './assets/img/merch/funny_mug.png'),
(41, 4, 'Bracelet', 6.50, 80, 'Stylish accessory bracelet', './assets/img/merch/bracelet.png'),
(42, 5, 'Long Sleeve Shirt', 34.99, 35, 'Casual long sleeve shirt', './assets/img/merch/long_sleeve_shirt.png'),
(43, 6, 'Headphones', 79.99, 25, 'High-quality over-ear headphones', './assets/img/merch/headphones.png'),
(44, 7, 'Desk Lamp', 29.99, 30, 'Adjustable LED desk lamp', './assets/img/merch/desk_lamp.png'),
(45, 8, 'Collector’s Notebook', 15.99, 20, 'Special edition notebook', './assets/img/merch/collectors_notebook.png'),
(46, 9, 'Ultimate Bundle', 179.99, 3, 'Everything included', './assets/img/merch/ultimate_bundle.png'),
(47, 1, 'Relaxation Kit', 24.99, 25, 'Includes candle, stress ball, and oils', './assets/img/merch/relaxation_kit.png'),
(48, 2, 'Goal Journal', 16.99, 40, 'Set and track your goals', './assets/img/merch/goal_journal.png'),
(49, 3, 'Travel Mug', 11.99, 50, 'Take your drinks on the go', './assets/img/merch/travel_mug.png'),
(50, 4, 'Necklace', 12.99, 60, 'Elegant necklace accessory', './assets/img/merch/necklace.png'),
(51, 5, 'Polo Shirt', 32.99, 40, 'Classic polo shirt', './assets/img/merch/polo_shirt.png');

-- --------------------------------------------------------

--
-- Table structure for table `merch_categories`
--

DROP TABLE IF EXISTS `merch_categories`;
CREATE TABLE IF NOT EXISTS `merch_categories` (
  `category_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `merch_categories`
--

INSERT INTO `merch_categories` (`category_id`, `name`) VALUES
(1, 'Stress Relief'),
(2, 'Journals'),
(3, 'Mugs'),
(4, 'Accessories'),
(5, 'Clothing'),
(6, 'Electronics'),
(7, 'Home & Living'),
(8, 'Limited Edition'),
(9, 'Bundles');

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
-- Table structure for table `merch_ratings`
--

DROP TABLE IF EXISTS `merch_ratings`;
CREATE TABLE IF NOT EXISTS `merch_ratings` (
  `rating_id` int NOT NULL AUTO_INCREMENT,
  `merch_id` int NOT NULL,
  `user_id` int NOT NULL,
  `rating` tinyint NOT NULL,
  `review_text` text,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`rating_id`),
  KEY `merch_id` (`merch_id`),
  KEY `user_id` (`user_id`)
) ;

--
-- Dumping data for table `merch_ratings`
--

INSERT INTO `merch_ratings` (`rating_id`, `merch_id`, `user_id`, `rating`, `review_text`, `created_at`, `updated_at`) VALUES
(1, 8, 38, 2, 'Looks good but slightly overpriced.', '2025-09-29 10:45:31', '2025-10-24 21:01:00'),
(2, 20, 31, 2, 'Amazing craftsmanship.', '2025-10-14 06:13:06', '2025-10-24 21:01:00'),
(3, 44, 20, 5, 'Fine but not outstanding.', '2025-10-04 18:20:51', '2025-10-24 21:01:00'),
(4, 25, 5, 4, 'Color not exactly as shown.', '2025-10-24 11:49:42', '2025-10-24 21:01:00'),
(5, 2, 5, 4, 'Average item, expected better packaging.', '2025-10-14 10:08:49', '2025-10-24 21:01:00'),
(6, 18, 11, 3, 'Highly recommend!', '2025-10-09 23:10:28', '2025-10-24 21:01:00'),
(7, 25, 33, 4, 'Satisfactory.', '2025-10-07 04:41:01', '2025-10-24 21:01:00'),
(8, 12, 44, 4, 'Loved it, perfect fit.', '2025-10-14 14:27:39', '2025-10-24 21:01:00'),
(9, 10, 25, 4, 'Color not exactly as shown.', '2025-10-10 20:58:56', '2025-10-24 21:01:00'),
(10, 48, 41, 3, 'Not what I expected.', '2025-09-27 14:49:30', '2025-10-24 21:01:00'),
(11, 32, 27, 3, 'Looks good but slightly overpriced.', '2025-10-05 02:35:35', '2025-10-24 21:01:00'),
(12, 3, 44, 5, 'Nice addition to collection.', '2025-09-28 04:39:54', '2025-10-24 21:01:00'),
(13, 2, 17, 1, 'Amazing craftsmanship.', '2025-10-01 05:48:35', '2025-10-24 21:01:00'),
(14, 21, 20, 3, 'Fantastic quality, definitely worth it!', '2025-10-19 08:28:44', '2025-10-24 21:01:00'),
(15, 20, 42, 4, 'Nice design and feel.', '2025-10-06 22:35:16', '2025-10-24 21:01:00'),
(16, 20, 18, 1, 'Loved it, perfect fit.', '2025-10-23 13:45:59', '2025-10-24 21:01:00'),
(17, 51, 52, 5, 'Okay, not very durable.', '2025-10-06 20:36:01', '2025-10-24 21:01:00'),
(18, 28, 48, 3, 'Good, but could be softer.', '2025-10-11 13:16:44', '2025-10-24 21:01:00'),
(19, 27, 39, 5, 'Color not exactly as shown.', '2025-10-03 17:52:27', '2025-10-24 21:01:00'),
(20, 18, 26, 4, 'Nice and functional.', '2025-10-09 21:13:35', '2025-10-24 21:01:00'),
(21, 30, 42, 4, 'Fine but not outstanding.', '2025-10-02 15:58:46', '2025-10-24 21:01:00'),
(22, 32, 22, 2, 'Looks good but slightly overpriced.', '2025-10-07 05:56:45', '2025-10-24 21:01:00'),
(23, 5, 17, 1, 'Not what I expected.', '2025-10-21 17:46:40', '2025-10-24 21:01:00'),
(24, 7, 4, 1, 'Looks good but slightly overpriced.', '2025-09-26 14:36:09', '2025-10-24 21:01:00'),
(25, 20, 6, 5, 'Amazing craftsmanship.', '2025-10-13 20:40:27', '2025-10-24 21:01:00'),
(26, 7, 12, 4, 'Not what I expected.', '2025-10-16 21:05:26', '2025-10-24 21:01:00'),
(27, 29, 25, 5, 'Nice addition to collection.', '2025-10-13 21:45:22', '2025-10-24 21:01:00'),
(28, 16, 54, 4, 'Nice addition to collection.', '2025-10-07 23:27:21', '2025-10-24 21:01:00'),
(29, 24, 33, 2, 'Amazing craftsmanship.', '2025-09-28 21:31:04', '2025-10-24 21:01:00'),
(30, 21, 39, 3, 'Okay, not very durable.', '2025-10-24 18:48:26', '2025-10-24 21:01:00'),
(31, 14, 25, 3, 'Nice and functional.', '2025-10-02 10:41:23', '2025-10-24 21:01:00'),
(32, 13, 34, 1, 'Good, but could be softer.', '2025-10-24 07:58:08', '2025-10-24 21:01:00'),
(33, 28, 20, 5, 'Color not exactly as shown.', '2025-10-03 02:45:21', '2025-10-24 21:01:00'),
(34, 22, 50, 2, 'Really happy with this purchase.', '2025-10-09 20:52:50', '2025-10-24 21:01:00'),
(35, 41, 31, 3, 'Looks good but slightly overpriced.', '2025-10-07 19:38:38', '2025-10-24 21:01:00'),
(36, 25, 36, 2, 'Exceeded expectations!', '2025-10-12 02:59:27', '2025-10-24 21:01:00'),
(37, 46, 15, 1, 'Absolutely love this!', '2025-10-09 21:32:36', '2025-10-24 21:01:00'),
(38, 47, 53, 3, 'Pretty good.', '2025-09-26 23:33:58', '2025-10-24 21:01:00'),
(39, 31, 29, 3, 'Average item, expected better packaging.', '2025-10-01 16:01:51', '2025-10-24 21:01:00'),
(40, 43, 8, 3, 'Nice and functional.', '2025-10-21 20:40:35', '2025-10-24 21:01:00'),
(41, 48, 45, 1, 'Satisfactory.', '2025-10-18 12:33:43', '2025-10-24 21:01:00'),
(42, 12, 9, 4, 'Color not exactly as shown.', '2025-10-19 10:38:11', '2025-10-24 21:01:00'),
(43, 12, 15, 3, 'Exceeded expectations!', '2025-09-28 20:06:15', '2025-10-24 21:01:00'),
(44, 5, 51, 5, 'Exceeded expectations!', '2025-10-15 16:53:44', '2025-10-24 21:01:00'),
(45, 3, 2, 2, 'Amazing craftsmanship.', '2025-10-23 17:31:49', '2025-10-24 21:01:00'),
(46, 22, 56, 1, 'Okay, not very durable.', '2025-10-01 22:30:48', '2025-10-24 21:01:00'),
(47, 6, 37, 4, 'Absolutely love this!', '2025-10-18 12:57:09', '2025-10-24 21:01:00'),
(48, 21, 35, 5, 'Loved it, perfect fit.', '2025-09-27 07:00:28', '2025-10-24 21:01:00'),
(49, 40, 37, 3, 'Looks good but slightly overpriced.', '2025-10-22 11:03:17', '2025-10-24 21:01:00'),
(50, 20, 44, 4, 'Loved it, perfect fit.', '2025-10-23 01:36:17', '2025-10-24 21:01:00'),
(51, 26, 31, 1, 'Not what I expected.', '2025-10-21 16:08:13', '2025-10-24 21:01:00'),
(52, 3, 39, 3, 'Nice addition to collection.', '2025-10-22 14:47:27', '2025-10-24 21:01:00'),
(53, 4, 44, 4, 'Fine but not outstanding.', '2025-09-30 15:56:41', '2025-10-24 21:01:00'),
(54, 14, 1, 4, 'Exactly what I needed!', '2025-10-22 23:59:22', '2025-10-24 21:01:00'),
(55, 16, 31, 3, 'Satisfactory.', '2025-10-02 15:59:08', '2025-10-24 21:01:00'),
(56, 23, 43, 1, 'Nice design and feel.', '2025-10-19 06:22:39', '2025-10-24 21:01:00'),
(57, 1, 23, 3, 'Really happy with this purchase.', '2025-10-06 17:35:35', '2025-10-24 21:01:00'),
(58, 3, 46, 4, 'Absolutely love this!', '2025-10-04 05:34:23', '2025-10-24 21:01:00'),
(59, 29, 9, 4, 'Looks good but slightly overpriced.', '2025-09-30 05:03:40', '2025-10-24 21:01:00'),
(60, 37, 45, 5, 'Nice design and feel.', '2025-10-11 02:35:57', '2025-10-24 21:01:00'),
(61, 50, 40, 2, 'Loved it, perfect fit.', '2025-09-25 15:08:39', '2025-10-24 21:01:00'),
(62, 35, 1, 1, 'Loved it, perfect fit.', '2025-10-07 09:47:47', '2025-10-24 21:01:00'),
(63, 44, 47, 3, 'Really happy with this purchase.', '2025-10-14 00:26:03', '2025-10-24 21:01:00'),
(64, 22, 51, 4, 'Amazing craftsmanship.', '2025-10-15 10:10:41', '2025-10-24 21:01:00'),
(65, 32, 34, 2, 'Pretty good.', '2025-10-03 05:27:33', '2025-10-24 21:01:00'),
(66, 15, 3, 3, 'Highly recommend!', '2025-10-14 03:22:23', '2025-10-24 21:01:00'),
(67, 10, 43, 1, 'Really happy with this purchase.', '2025-10-16 00:43:00', '2025-10-24 21:01:00'),
(68, 49, 49, 5, 'Nice addition to collection.', '2025-09-27 22:23:26', '2025-10-24 21:01:00'),
(69, 28, 47, 2, 'Nice design and feel.', '2025-10-04 14:52:08', '2025-10-24 21:01:00'),
(70, 14, 44, 4, 'Amazing craftsmanship.', '2025-10-15 14:54:15', '2025-10-24 21:01:00'),
(71, 9, 37, 2, 'Color not exactly as shown.', '2025-10-20 15:30:30', '2025-10-24 21:01:00'),
(72, 39, 54, 1, 'Highly recommend!', '2025-10-09 12:58:10', '2025-10-24 21:01:00'),
(73, 42, 2, 2, 'Nice design and feel.', '2025-10-12 12:19:23', '2025-10-24 21:01:00'),
(74, 7, 23, 4, 'Fine but not outstanding.', '2025-10-21 13:14:05', '2025-10-24 21:01:00'),
(75, 22, 3, 2, 'Nice and functional.', '2025-10-19 21:23:47', '2025-10-24 21:01:00'),
(76, 25, 1, 5, 'Exceeded expectations!', '2025-10-03 00:06:41', '2025-10-24 21:01:00'),
(77, 11, 12, 3, 'Nice and functional.', '2025-10-14 20:13:08', '2025-10-24 21:01:00'),
(78, 5, 30, 5, 'Really happy with this purchase.', '2025-10-06 13:38:09', '2025-10-24 21:01:00'),
(79, 39, 42, 1, 'Not what I expected.', '2025-10-24 06:39:11', '2025-10-24 21:01:00'),
(80, 14, 18, 5, 'Nice design and feel.', '2025-10-14 05:15:03', '2025-10-24 21:01:00'),
(81, 28, 30, 4, 'Nice design and feel.', '2025-10-15 13:31:36', '2025-10-24 21:01:00'),
(82, 35, 35, 2, 'Amazing craftsmanship.', '2025-09-27 20:44:18', '2025-10-24 21:01:00'),
(83, 39, 36, 4, 'Exactly what I needed!', '2025-09-25 14:00:21', '2025-10-24 21:01:00'),
(84, 44, 52, 2, 'Satisfactory.', '2025-10-06 01:00:33', '2025-10-24 21:01:00'),
(85, 8, 43, 2, 'Really happy with this purchase.', '2025-10-19 17:30:31', '2025-10-24 21:01:00'),
(86, 47, 14, 3, 'Average item, expected better packaging.', '2025-10-07 10:02:32', '2025-10-24 21:01:00'),
(87, 4, 35, 5, 'Looks good but slightly overpriced.', '2025-10-08 02:27:07', '2025-10-24 21:01:00'),
(88, 17, 44, 3, 'Looks good but slightly overpriced.', '2025-10-24 18:24:32', '2025-10-24 21:01:00'),
(89, 35, 31, 5, 'Not what I expected.', '2025-10-10 13:16:34', '2025-10-24 21:01:00'),
(90, 21, 27, 2, 'Fantastic quality, definitely worth it!', '2025-10-02 04:35:50', '2025-10-24 21:01:00'),
(91, 49, 24, 1, 'Nice design and feel.', '2025-10-07 01:49:46', '2025-10-24 21:01:00'),
(92, 22, 10, 1, 'Nice addition to collection.', '2025-10-16 23:35:28', '2025-10-24 21:01:00'),
(93, 10, 47, 2, 'Color not exactly as shown.', '2025-10-18 17:58:13', '2025-10-24 21:01:00'),
(94, 21, 40, 4, 'Really happy with this purchase.', '2025-10-02 19:17:12', '2025-10-24 21:01:00'),
(95, 15, 47, 3, 'Nice and functional.', '2025-09-28 10:08:11', '2025-10-24 21:01:00'),
(96, 11, 17, 4, 'Amazing craftsmanship.', '2025-10-17 07:03:32', '2025-10-24 21:01:00'),
(97, 14, 28, 2, 'Average item, expected better packaging.', '2025-10-05 03:49:54', '2025-10-24 21:01:00'),
(98, 6, 16, 1, 'Nice addition to collection.', '2025-10-21 07:52:48', '2025-10-24 21:01:00'),
(99, 24, 43, 1, 'Nice and functional.', '2025-10-17 05:22:15', '2025-10-24 21:01:00'),
(100, 41, 24, 4, 'Exactly what I needed!', '2025-09-29 14:32:51', '2025-10-24 21:01:00'),
(101, 34, 2, 4, 'Fantastic quality, definitely worth it!', '2025-09-25 22:38:01', '2025-10-24 21:01:00'),
(102, 4, 2, 5, 'Loved it, perfect fit.', '2025-10-09 23:19:28', '2025-10-24 21:01:00'),
(103, 37, 50, 1, 'Highly recommend!', '2025-10-24 11:50:35', '2025-10-24 21:01:00'),
(104, 25, 8, 2, 'Amazing craftsmanship.', '2025-10-01 08:59:41', '2025-10-24 21:01:00'),
(105, 18, 25, 5, 'Good, but could be softer.', '2025-10-11 07:36:04', '2025-10-24 21:01:00'),
(106, 23, 10, 5, 'Exactly what I needed!', '2025-10-15 07:29:53', '2025-10-24 21:01:00'),
(107, 28, 36, 2, 'Fine but not outstanding.', '2025-10-05 09:57:02', '2025-10-24 21:01:00'),
(108, 28, 19, 1, 'Pretty good.', '2025-10-23 12:31:46', '2025-10-24 21:01:00'),
(109, 5, 20, 5, 'Good, but could be softer.', '2025-10-10 05:47:47', '2025-10-24 21:01:00'),
(110, 1, 1, 1, 'Good, but could be softer.', '2025-10-14 23:32:06', '2025-10-24 21:01:00'),
(111, 6, 12, 2, 'Fantastic quality, definitely worth it!', '2025-10-19 07:15:28', '2025-10-24 21:01:00'),
(112, 27, 31, 3, 'Really happy with this purchase.', '2025-10-06 19:24:17', '2025-10-24 21:01:00'),
(113, 4, 50, 1, 'Satisfactory.', '2025-10-23 04:10:39', '2025-10-24 21:01:00'),
(114, 7, 55, 2, 'Highly recommend!', '2025-10-04 13:41:46', '2025-10-24 21:01:00'),
(115, 49, 41, 3, 'Not what I expected.', '2025-10-21 03:19:38', '2025-10-24 21:01:00'),
(116, 29, 17, 2, 'Nice design and feel.', '2025-10-09 19:09:12', '2025-10-24 21:01:00'),
(117, 10, 42, 1, 'Looks good but slightly overpriced.', '2025-10-14 15:30:43', '2025-10-24 21:01:00'),
(118, 17, 56, 1, 'Looks good but slightly overpriced.', '2025-09-28 19:16:05', '2025-10-24 21:01:00'),
(119, 10, 26, 3, 'Really happy with this purchase.', '2025-10-04 11:50:25', '2025-10-24 21:01:00'),
(120, 8, 55, 2, 'Pretty good.', '2025-10-22 22:28:35', '2025-10-24 21:01:00'),
(121, 9, 7, 3, 'Absolutely love this!', '2025-10-16 00:13:48', '2025-10-24 21:01:00'),
(122, 46, 50, 3, 'Nice addition to collection.', '2025-10-21 03:25:39', '2025-10-24 21:01:00'),
(123, 15, 42, 1, 'Fantastic quality, definitely worth it!', '2025-10-22 12:13:45', '2025-10-24 21:01:00'),
(124, 48, 33, 4, 'Highly recommend!', '2025-10-03 23:29:19', '2025-10-24 21:01:00'),
(125, 1, 15, 4, 'Nice design and feel.', '2025-09-25 08:22:36', '2025-10-24 21:01:00'),
(126, 2, 29, 3, 'Not what I expected.', '2025-09-29 08:30:46', '2025-10-24 21:01:00'),
(127, 34, 47, 4, 'Average item, expected better packaging.', '2025-10-05 09:02:30', '2025-10-24 21:01:00'),
(128, 14, 32, 2, 'Exactly what I needed!', '2025-09-29 19:39:02', '2025-10-24 21:01:00'),
(129, 39, 16, 1, 'Color not exactly as shown.', '2025-10-22 23:12:42', '2025-10-24 21:01:00'),
(130, 17, 34, 4, 'Really happy with this purchase.', '2025-10-12 18:38:10', '2025-10-24 21:01:00'),
(131, 14, 27, 5, 'Not what I expected.', '2025-10-16 10:26:35', '2025-10-24 21:01:00'),
(132, 20, 51, 5, 'Amazing craftsmanship.', '2025-10-07 08:38:30', '2025-10-24 21:01:00'),
(133, 23, 6, 2, 'Exactly what I needed!', '2025-09-30 22:21:20', '2025-10-24 21:01:00'),
(134, 42, 25, 3, 'Fantastic quality, definitely worth it!', '2025-09-30 16:20:22', '2025-10-24 21:01:00'),
(135, 5, 38, 4, 'Fantastic quality, definitely worth it!', '2025-10-10 10:46:22', '2025-10-24 21:01:00'),
(136, 34, 4, 5, 'Loved it, perfect fit.', '2025-10-03 14:11:30', '2025-10-24 21:01:00'),
(137, 43, 18, 2, 'Good, but could be softer.', '2025-10-14 21:04:27', '2025-10-24 21:01:00'),
(138, 41, 21, 5, 'Fantastic quality, definitely worth it!', '2025-10-18 00:02:20', '2025-10-24 21:01:00'),
(139, 10, 13, 4, 'Looks good but slightly overpriced.', '2025-10-01 00:06:25', '2025-10-24 21:01:00'),
(140, 36, 46, 1, 'Fine but not outstanding.', '2025-10-14 03:13:32', '2025-10-24 21:01:00'),
(141, 20, 55, 1, 'Exceeded expectations!', '2025-10-14 16:37:40', '2025-10-24 21:01:00'),
(142, 26, 38, 3, 'Fine but not outstanding.', '2025-09-26 16:52:26', '2025-10-24 21:01:00'),
(143, 51, 7, 3, 'Amazing craftsmanship.', '2025-10-04 03:25:05', '2025-10-24 21:01:00'),
(144, 32, 16, 2, 'Okay, not very durable.', '2025-10-13 21:39:49', '2025-10-24 21:01:00'),
(145, 42, 11, 4, 'Pretty good.', '2025-10-02 21:26:42', '2025-10-24 21:01:00'),
(146, 51, 21, 5, 'Pretty good.', '2025-09-28 11:33:06', '2025-10-24 21:01:00'),
(147, 37, 16, 4, 'Nice addition to collection.', '2025-10-04 08:50:41', '2025-10-24 21:01:00'),
(148, 28, 13, 3, 'Good, but could be softer.', '2025-09-25 10:38:11', '2025-10-24 21:01:00'),
(149, 8, 53, 4, 'Loved it, perfect fit.', '2025-10-21 13:07:29', '2025-10-24 21:01:00'),
(150, 47, 46, 1, 'Exceeded expectations!', '2025-09-26 08:56:43', '2025-10-24 21:01:00');

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
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
(13, 'alex_moore', 'alex.moore@example.com', '$2y$10$D9Y9Ex7pK3tF.2I8x81lfO9hbnR4uQlVsn7pUtOaSDoA2L53a/bmy', '2025-09-01 09:15:23'),
(14, 'sarah_lee', 'sarah.lee@example.com', '$2y$10$O4E7YpS2dQwE1GkTt6XzIeZLOfjJZz6C7WxzG3w6CkKtk6JMjx8G6', '2025-09-01 09:18:05'),
(15, 'daniel_smith', 'daniel.smith@example.com', '$2y$10$YH43uOQ9uLbFxy9vA0kMBe8kSYeq0kB5RkJX5EgrVQZCGNQ12rj6W', '2025-09-01 09:22:41'),
(16, 'emily_johnson', 'emily.johnson@example.com', '$2y$10$F1dkl2sSoe6VmQan.QrMLehZlQWQqzWm3zZXVgXexSHiY5Fgn9SYW', '2025-09-01 09:25:37'),
(17, 'matthew_white', 'matthew.white@example.com', '$2y$10$gQb7jP7EQfNFW9W7Z1F56uYPL14Lwzkp7U1VxAD2pjZmKxPEk2AjG', '2025-09-01 09:30:52'),
(18, 'olivia_walker', 'olivia.walker@example.com', '$2y$10$PR1Af48VvGSh64u9hzvH3uM7Z4QdBhd54ZJ7R.7bqjvGeGqzM7RfO', '2025-09-01 09:33:18'),
(19, 'liam_harris', 'liam.harris@example.com', '$2y$10$YvZ1nJhsPv1yMljd9Cgk4uLcfB2fTqRzw0k6eP7VJSmHu1cg7dx3m', '2025-09-01 09:35:20'),
(20, 'ava_roberts', 'ava.roberts@example.com', '$2y$10$uLWXbAoE2E3t1p4RUlC2t.qcGf3EHDQ0A/NBvSp.MtK8pjFd9.xHe', '2025-09-01 09:37:45'),
(21, 'noah_wilson', 'noah.wilson@example.com', '$2y$10$V7vccU8rE1c4iF5KQdD5FeJ2RbkWW5a5z8YyFDz2D1eWj2DEx5xyy', '2025-09-01 09:39:09'),
(22, 'isabella_clark', 'isabella.clark@example.com', '$2y$10$e3yJq7n8KHFtPzjK/x3T7OrRsgp28g8kz5qgNzWpKViV0y2z0IhDq', '2025-09-01 09:42:55'),
(23, 'ethan_davis', 'ethan.davis@example.com', '$2y$10$7gH4DsP3mG/9mH2o6XH8IuKJ3V1gD7RzR4fC8nWmMZbK2sV0Q7LmG', '2025-09-01 09:45:33'),
(24, 'mia_thompson', 'mia.thompson@example.com', '$2y$10$FwD8Qm2f4E9Vj7ZkE9yAue7E2x8cK7fKQ3yPz2Z3Qk2L8v5Gm3Z5O', '2025-09-01 09:47:18'),
(25, 'jacob_martin', 'jacob.martin@example.com', '$2y$10$L5Qp4Xb6e7Q9sC0VvZ2aFqCjK7vR5zZ8YyQ8QpRkMZfV2xK7X9rNe', '2025-09-01 09:50:12'),
(26, 'amelia_allen', 'amelia.allen@example.com', '$2y$10$R6Jv2pM3Y8WjK5aN6ZbVfQnC9tD7mR8J9ZbX7VgM5nF2yL3A4C6qE', '2025-09-01 09:52:21'),
(27, 'lucas_scott', 'lucas.scott@example.com', '$2y$10$O8rG2jN6vM9zL4bC5YhTgQnJ2wXbU8pK3sE5rJ9xZqA7L1nP6K4dH', '2025-09-01 09:54:36'),
(28, 'sophia_turner', 'sophia.turner@example.com', '$2y$10$D3gYh6Q8VvM4tP9nB1zEwXkA7R9fT6cM5kD2lN8qV7uP4sL9Z1rXj', '2025-09-01 09:57:20'),
(29, 'william_brown', 'william.brown@example.com', '$2y$10$N5rWvK7bP8tD4yN2mX9fR1sC3aG8L6uM2pT5bQ4dK9sF7eR0jW1qE', '2025-09-01 10:00:12'),
(30, 'ella_morgan', 'ella.morgan@example.com', '$2y$10$T7qWzP9nC5eD6mX2vL8fK3tQ1rJ9bN5yM4dS7pL2aE8gZ0xH9vU6y', '2025-09-01 10:03:41'),
(31, 'james_taylor', 'james.taylor@example.com', '$2y$10$E4kP8mX2bN9zW1tQ6yJ3dH7aF0gK2pC8sV5rM3zL7uD9jQ1wT6xY', '2025-09-01 10:06:11'),
(32, 'grace_hall', 'grace.hall@example.com', '$2y$10$V2rJ6nQ9tC4mK7pW1bY5zE3sH8xF9uD0aN2lP4vR3jM8dT6gS9yX', '2025-09-01 10:09:33'),
(33, 'henry_adams', 'henry.adams@example.com', '$2y$10$U4qK9mH3wL6zE7yN5aR2tD1sF8pG9jB2cX4vP3nM5kT8rQ0zJ1wY', '2025-09-01 10:12:09'),
(34, 'chloe_evans', 'chloe.evans@example.com', '$2y$10$P6jM4zQ8bC1nD9aT7yV3xE5sR2pG0hN8wJ4mK2uF9tL5rB6qY1vS', '2025-09-01 10:15:27'),
(35, 'benjamin_green', 'benjamin.green@example.com', '$2y$10$Z8pT6qW4bV9nY7jF3mR5xH2dS1lG0aE5wM8vC4rT9uK6pJ2yN3fX', '2025-09-01 10:18:42'),
(36, 'lily_wright', 'lily.wright@example.com', '$2y$10$C7dP2tM5rV9qF8bH1xL4nE3gY0sJ6aK7zD9uW5pX3mN2vR8cT1jS', '2025-09-01 10:21:19'),
(37, 'sebastian_king', 'sebastian.king@example.com', '$2y$10$N2zR5qC8tW6yM1kE9pJ3dL7hS0fX4bA5rV8gP2mK9uD3nT6wY1vF', '2025-09-01 10:23:54'),
(38, 'zoe_bailey', 'zoe.bailey@example.com', '$2y$10$B5yW8jK1vN4pR3qH9zL2dM7eG0tC8aS6xP9uV4nD5rF2mJ7kY1wZ', '2025-09-01 10:27:00'),
(39, 'jack_hughes', 'jack.hughes@example.com', '$2y$10$M3xE9rP5qL8zT1dH6vK2nC4sA7bF0mN9pU2gV5yR3wX8jQ7tL9hY', '2025-09-01 10:29:33'),
(40, 'natalie_cooper', 'natalie.cooper@example.com', '$2y$10$K4hR8pC2vL6xT1yM9aN3dE5bG0fS7uP8wQ2rJ9zV4nD3tF6kX5mL', '2025-09-01 10:33:12'),
(41, 'leo_hughes', 'leo.hughes@example.com', '$2y$10$J6xQ2nV8aD5pK3zH9tR1mL4sE0gN7cB2yW9uP5fV3rT8kX7lZ2jC', '2025-09-01 10:36:41'),
(42, 'ella_brooks', 'ella.brooks@example.com', '$2y$10$R5yW2tH9mX6zQ3pC8nA1dL4sG0fV7bK2rJ9uP5vM3kT8xE7wZ2jY', '2025-09-01 10:39:23'),
(43, 'max_reed', 'max.reed@example.com', '$2y$10$F7pE9tR4yV2wC8zL1qH5kN3mJ0dX6gB2aS9uV5rP3nT8xK7lY4jM', '2025-09-01 10:42:57'),
(44, 'hannah_price', 'hannah.price@example.com', '$2y$10$E8tQ6nM3bP9yD1vC5rJ7kL4sA0fG7hB2uV9xT5wP3zK8yN7lX4jR', '2025-09-01 10:45:30'),
(45, 'nathan_mitchell', 'nathan.mitchell@example.com', '$2y$10$W9tY4xE6nV2pJ3qK1rL8mH5sC0gN7dB2aS9uT5vP3nR8kX7lY4jD', '2025-09-01 10:48:12'),
(46, 'ella_richards', 'ella.richards@example.com', '$2y$10$L8qP2mC4vR6xK1tN9aH3jE5bG0sF7dB2uV9pT5wP3zK8yN7lX4jW', '2025-09-01 10:50:55'),
(47, 'samuel_harris', 'samuel.harris@example.com', '$2y$10$M4wE9rP5qL8tN1dH6vK2jC4sA7bG0mN9pU2gV5yR3wX8kT7lZ9hY', '2025-09-01 10:53:17'),
(48, 'layla_gray', 'layla.gray@example.com', '$2y$10$C5tR2mV8aL4pK3zH9nR1jL4sE0fN7cB2yW9uP5vM3rT8xE7lY2jP', '2025-09-01 10:55:49'),
(49, 'ryan_bell', 'ryan.bell@example.com', '$2y$10$P3zQ9nM5bT8xD1vC6rJ7kL4sA0fG7bH2uV9xT5wP3nR8yK7lY4jN', '2025-09-01 10:58:21'),
(50, 'zoe_hamilton', 'zoe.hamilton@example.com', '$2y$10$Z7rP3qW9tL5yM1kE8pJ4dN6hS0fX4cA5rV8gP2mK9uD3nT6wY1vQ', '2025-09-01 11:00:00'),
(51, 'mason_carter', 'mason.carter@example.com', '$2y$10$E6dT4mR7qV9pC1xH8nA3jL5sG0fN7bD2yW9uP5vM3rT8xE7lY2jS', '2025-09-01 11:03:25'),
(52, 'scarlett_baker', 'scarlett.baker@example.com', '$2y$10$K9hP2mL4vR6xT1nN8aJ3eE5bG0fS7cB2uV9pT5wM3zK8yN7lX4jR', '2025-09-01 11:06:18'),
(53, 'logan_fisher', 'logan.fisher@example.com', '$2y$10$T8qW2nV6aD5pK3zH9tR1mL4sE0gN7bB2aS9uP5vM3rT8kX7lY4jC', '2025-09-01 11:09:45'),
(54, 'violet_hayes', 'violet.hayes@example.com', '$2y$10$H7rQ4mN9bV5xC1tK8nA3jE5sG0fD7bB2uV9pT5wP3nR8yN7lY4jW', '2025-09-01 11:12:59'),
(55, 'carter_morris', 'carter.morris@example.com', '$2y$10$R8tY6xE9nV2pJ3qK1rL8mH5sC0gN7dB2aS9uT5vP3nR8kX7lY4jZ', '2025-09-01 11:15:37'),
(56, 'ella_perry', 'ella.perry@example.com', '$2y$10$N8pR2mC4vR6xK1tN9aH3jE5bG0sF7dB2uV9pT5wP3zK8yN7lX4jW', '2025-09-01 11:18:11'),
(57, 'owen_barnes', 'owen.barnes@example.com', '$2y$10$Q4xE9rP5qL8zT1dH6vK2nC4sA7bF0mN9pU2gV5yR3wX8kT7lZ9hY', '2025-09-01 11:21:08');

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
