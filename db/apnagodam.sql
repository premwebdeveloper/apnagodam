-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 02, 2019 at 10:48 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `apnagodam_admin`
--

-- --------------------------------------------------------

--
-- Table structure for table `buy_sells`
--

CREATE TABLE `buy_sells` (
  `id` int(10) UNSIGNED NOT NULL,
  `buyer_id` int(11) DEFAULT NULL,
  `seller_id` int(11) NOT NULL,
  `seller_cat_id` int(11) NOT NULL,
  `quantity` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'final price after bidding between seller and buyer',
  `status` tinyint(1) NOT NULL COMMENT 'status 1 active bid and 0 for complete bid / deal done 3 for pdf send and payment accept',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `buy_sells`
--

INSERT INTO `buy_sells` (`id`, `buyer_id`, `seller_id`, `seller_cat_id`, `quantity`, `price`, `status`, `created_at`, `updated_at`) VALUES
(1, NULL, 5, 19, '100', NULL, 1, '2019-04-03 23:44:59', '2019-04-03 23:44:59'),
(2, 8, 5, 22, '800', '1704', 3, '2019-04-04 22:43:20', '2019-04-05 00:10:04'),
(3, 33, 5, 23, '500', '1726', 3, '2019-04-06 23:38:04', '2019-04-07 00:18:14'),
(4, NULL, 34, 24, '500', NULL, 1, '2019-04-06 23:41:02', '2019-04-06 23:41:02'),
(5, NULL, 34, 25, '1200', NULL, 1, '2019-04-06 23:41:19', '2019-04-06 23:41:19'),
(6, 33, 5, 28, '1300', '1736', 3, '2019-04-09 23:39:08', '2019-04-10 00:02:23'),
(7, 21, 40, 42, '10', '1800', 3, '2019-04-30 23:34:35', '2019-05-01 00:00:43'),
(8, NULL, 5, 45, '1560', NULL, 1, '2019-09-05 19:46:38', '2019-09-05 20:05:30'),
(9, 46, 5, 46, '1560', '1857', 3, '2019-09-05 22:49:40', '2019-09-05 23:28:50'),
(10, NULL, 46, 47, NULL, NULL, 1, '2019-09-21 17:52:05', '2019-09-21 17:52:05');

-- --------------------------------------------------------

--
-- Table structure for table `buy_sell_conversations`
--

CREATE TABLE `buy_sell_conversations` (
  `id` int(10) UNSIGNED NOT NULL,
  `buy_sell_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `price` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `buy_sell_conversations`
--

INSERT INTO `buy_sell_conversations` (`id`, `buy_sell_id`, `user_id`, `price`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 21, '2011', 1, '2019-04-03 23:44:59', '2019-04-03 23:44:59'),
(2, 1, 27, '2012', 1, '2019-04-04 17:27:36', '2019-04-04 17:27:36'),
(3, 2, 10, '1702', 1, '2019-04-04 22:43:20', '2019-04-04 22:43:20'),
(4, 2, 21, '1703', 1, '2019-04-04 23:50:00', '2019-04-04 23:50:00'),
(5, 2, 8, '1704', 1, '2019-04-04 23:59:37', '2019-04-04 23:59:37'),
(6, 3, 33, '1726', 1, '2019-04-06 23:38:04', '2019-04-06 23:38:04'),
(7, 4, 10, '1726', 1, '2019-04-06 23:41:02', '2019-04-06 23:41:02'),
(8, 5, 10, '1741', 1, '2019-04-06 23:41:19', '2019-04-06 23:41:19'),
(9, 6, 33, '1736', 1, '2019-04-09 23:39:08', '2019-04-09 23:39:08'),
(10, 7, 21, '1800', 1, '2019-04-30 23:34:35', '2019-04-30 23:34:35'),
(11, 8, 21, '1855', 1, '2019-09-05 19:46:38', '2019-09-05 20:09:38'),
(12, 9, 46, '1857', 1, '2019-09-05 22:49:40', '2019-09-05 22:49:40'),
(13, 9, 21, '1856', 1, '2019-09-05 22:51:48', '2019-09-05 23:28:14'),
(14, 10, 112, '1852', 1, '2019-09-21 17:52:05', '2019-09-21 17:52:05'),
(15, 10, 21, '1750', 1, '2019-10-01 20:25:37', '2019-10-01 20:25:37');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `category` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gst` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `commossion` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mandi_fees` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `loading` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bardana` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `freight` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category`, `gst`, `commossion`, `mandi_fees`, `loading`, `bardana`, `freight`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Barley', '464646', '4646', '6464', '6464', '6464', '6464', '385c4a.jpg', 0, '2019-01-19 03:06:45', '2019-01-19 03:18:08'),
(2, 'Bajra', '44666464', '64656', '6464', '6464', '6464', '646', 'e9ff5b.jpg', 0, '2019-01-19 03:12:44', '2019-01-19 03:18:14'),
(3, 'Groundnut', '646464', '4646', '6464', '64646', '6464', '6464', 'c033a5.jpg', 1, '2019-01-19 03:13:13', '2019-01-19 03:13:13'),
(4, 'Chola', '54434', '13143', '31313', '3131', '31313', '31313', '0d0014.jpg', 1, '2019-01-19 03:13:33', '2019-01-19 03:13:33'),
(5, 'Guar', '4441431', '3131', '31313', '3131', '3131', '3131', '11d163.jpg', 1, '2019-01-19 03:13:55', '2019-01-19 03:13:55'),
(6, 'Barley', '654646', '64646', '64646', '64646', '64646', '6464', '2a0966.jpg', 1, '2019-01-19 03:18:49', '2019-01-19 03:18:49'),
(7, 'Bajra', '4646', '64646', '46464', '64646', '464646', '6464', '4c5518.jpg', 1, '2019-01-19 03:19:08', '2019-01-19 03:19:08');

-- --------------------------------------------------------

--
-- Table structure for table `commodity_name`
--

CREATE TABLE `commodity_name` (
  `id` int(11) NOT NULL,
  `commodity` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `commodity_name`
--

INSERT INTO `commodity_name` (`id`, `commodity`, `image`, `created_at`, `updated_at`, `status`) VALUES
(1, 'Barley', 'b2e369.jpg', '2019-04-18 12:05:47', '2019-04-18 12:05:47', 1),
(2, 'Bajra', '83bc6a.jpg', '2019-01-18 19:55:09', '2019-01-18 19:55:09', 1),
(3, 'Ground nutt', 'd642ee.jpg', '2019-01-18 19:55:28', '2019-01-18 19:55:28', 1),
(4, 'Guar', 'bf2ddd.jpg', '2019-01-18 19:55:50', '2019-01-18 19:55:50', 1),
(5, 'chola', '43566a.jpg', '2019-01-18 19:56:03', '2019-01-18 19:56:03', 1);

-- --------------------------------------------------------

--
-- Table structure for table `facilities`
--

CREATE TABLE `facilities` (
  `id` int(10) UNSIGNED NOT NULL,
  `facility` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `facilitiy_master`
--

CREATE TABLE `facilitiy_master` (
  `id` int(11) NOT NULL,
  `name` varchar(250) DEFAULT NULL,
  `description` text,
  `image` text,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `facilitiy_master`
--

INSERT INTO `facilitiy_master` (`id`, `name`, `description`, `image`, `status`, `created_at`, `updated_at`) VALUES
(2, 'Dharam Kanta', 'Dharam Kanta', 'a78808.png', 1, '2019-09-28 01:33:55', '2019-09-28 01:33:55'),
(3, 'Fumigation', 'fumigation', '7dee41.png', 1, '2019-09-28 01:34:23', '2019-09-28 01:34:23'),
(4, 'CCTC Camera', 'CCTC Camera', 'b88e25.png', 1, '2019-09-28 01:34:48', '2019-09-28 01:34:48'),
(5, 'Fire Equipment', 'fire equipment', '559e17.png', 1, '2019-09-28 01:36:39', '2019-09-28 01:36:39');

-- --------------------------------------------------------

--
-- Table structure for table `finances`
--

CREATE TABLE `finances` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `bank_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `branch_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `acc_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ifsc` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `aadhar` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `balance_sheet` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank_statement` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `commodity_id` int(11) NOT NULL,
  `quantity` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `finance_responses`
--

CREATE TABLE `finance_responses` (
  `id` int(10) UNSIGNED NOT NULL,
  `finance_id` int(11) NOT NULL,
  `bank_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `interest` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inventories`
--

CREATE TABLE `inventories` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `warehouse_id` int(11) NOT NULL,
  `commodity` int(11) NOT NULL,
  `type` int(11) DEFAULT NULL,
  `quantity` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sell_quantity` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gate_pass_wr` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quality_category` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `inventories`
--

INSERT INTO `inventories` (`id`, `user_id`, `warehouse_id`, `commodity`, `type`, `quantity`, `sell_quantity`, `price`, `gate_pass_wr`, `quality_category`, `image`, `status`, `created_at`, `updated_at`) VALUES
(2, 5, 2, 2, NULL, '100', NULL, '0', NULL, NULL, 'c5c360.pdf', 0, '2019-01-19 03:14:34', '2019-02-22 00:01:03'),
(4, 5, 2, 7, NULL, '100', '100', '1500', '123', 'A', '0fa576.pdf', 0, '2019-01-19 03:21:04', '2019-04-04 21:49:04'),
(5, 6, 1, 6, NULL, '0', NULL, '0', NULL, NULL, NULL, 0, '2019-01-19 03:25:52', '2019-04-01 17:04:09'),
(6, 7, 2, 7, NULL, '0', NULL, '0', NULL, NULL, NULL, 0, '2019-01-19 03:30:32', '2019-04-04 21:50:08'),
(7, 5, 2, 6, NULL, '0', NULL, '0', NULL, NULL, 'f2bdd4.pdf', 0, '2019-01-21 16:57:25', '2019-04-04 21:49:53'),
(8, 5, 1, 3, NULL, '0', NULL, '0', NULL, NULL, 'fc188a.pdf', 0, '2019-01-21 17:00:14', '2019-04-04 21:48:56'),
(9, 9, 2, 6, NULL, '0', NULL, '0', NULL, NULL, '4c706d.pdf', 0, '2019-01-22 03:09:34', '2019-04-04 21:50:13'),
(10, 11, 3, 6, NULL, '500', NULL, '0', NULL, NULL, '92c23d.pdf', 0, '2019-01-22 23:49:33', '2019-04-04 21:48:41'),
(11, 5, 2, 6, NULL, '0', NULL, '0', NULL, NULL, 'fbfd32.pdf', 0, '2019-01-22 23:54:00', '2019-04-04 21:50:00'),
(12, 5, 1, 6, NULL, '0', NULL, '0', NULL, NULL, '0567ff.pdf', 0, '2019-01-23 00:23:12', '2019-04-04 21:49:35'),
(13, 8, 1, 6, NULL, '1250', NULL, '0', NULL, NULL, 'a8f0d7.pdf', 0, '2019-01-23 01:00:51', '2019-04-05 00:10:01'),
(14, 12, 1, 6, NULL, '10', NULL, '0', NULL, NULL, 'd52129.pdf', 0, '2019-01-24 23:37:03', '2019-04-04 21:49:22'),
(15, 13, 1, 6, NULL, '1', NULL, '0', NULL, NULL, '386fb1.pdf', 0, '2019-01-28 18:23:38', '2019-04-04 21:49:30'),
(16, 5, 1, 3, NULL, '0', NULL, '0', NULL, NULL, '7993a1.pdf', 0, '2019-01-30 22:09:10', '2019-04-04 21:49:40'),
(17, 6, 1, 6, NULL, '10', NULL, '0', 'dummy1', 'A', NULL, 0, '2019-01-30 22:28:58', '2019-04-04 21:49:16'),
(18, 8, 1, 6, NULL, '250', NULL, '0', NULL, NULL, 'a711cb.pdf', 0, '2019-02-03 19:40:29', '2019-02-22 00:01:03'),
(19, 5, 3, 6, NULL, '100', '100', '2010', '123', 'A', '447c87.pdf', 0, '2019-03-05 21:39:19', '2019-04-04 21:49:10'),
(20, 6, 1, 6, NULL, '1250', NULL, '1700', 'dummy', 'A', '355c46.pdf', 0, '2019-04-04 00:51:11', '2019-04-04 21:48:36'),
(21, 5, 1, 6, NULL, '0', '1250', '1700', 'dummy', 'A', 'b1b694.pdf', 0, '2019-04-04 00:55:50', '2019-04-04 21:49:48'),
(22, 5, 2, 6, NULL, '500', '800', '1700', '1B', 'A', '6a2dd9.pdf', 0, '2019-04-04 22:27:45', '2019-04-06 23:10:48'),
(23, 5, 2, 6, NULL, '0', '500', '1725', '1B', 'A', '2c488d.pdf', 0, '2019-04-06 23:11:53', '2019-04-07 00:25:31'),
(24, 34, 5, 6, NULL, '500', '500', '1725', 'C-3/1', 'A', '626897.pdf', 0, '2019-04-06 23:13:01', '2019-04-09 23:08:13'),
(25, 34, 6, 6, NULL, '1200', '1200', '1740', 'C-2/26', 'A', '8fd25e.pdf', 0, '2019-04-06 23:15:05', '2019-04-09 23:08:32'),
(26, 33, 2, 6, NULL, '1800', NULL, NULL, NULL, NULL, NULL, 0, '2019-04-07 00:18:12', '2019-04-10 00:02:20'),
(27, 5, 2, 6, NULL, '1200', '1200', '1735', '1C', 'A', '5f5597.pdf', 0, '2019-04-09 23:07:54', '2019-04-10 00:07:32'),
(28, 5, 2, 6, NULL, '0', '1300', '1735', '4A', 'A', '0f58c4.pdf', 0, '2019-04-09 23:09:27', '2019-04-10 00:07:36'),
(29, 34, 6, 6, NULL, '1550', '1550', '1751', 'C-2/26', 'A', 'cff1f5.pdf', 0, '2019-04-13 22:52:05', '2019-04-14 01:56:33'),
(30, 34, 6, 6, NULL, '750', '750', '1751', 'C-2/27', 'A', '465102.pdf', 0, '2019-04-13 22:52:42', '2019-04-14 01:56:38'),
(31, 34, 5, 6, NULL, '1100', NULL, '1741', 'C-3/1', 'A', '793fd6.pdf', 0, '2019-04-13 22:53:32', '2019-04-13 22:54:13'),
(32, 34, 5, 6, NULL, '1100', '1100', '1741', 'C-3/1', 'A', 'ec990e.pdf', 0, '2019-04-13 22:53:35', '2019-04-14 01:56:36'),
(33, 34, 6, 6, NULL, '1550', '1550', '1771', 'C-2/26', 'A', 'fa23c9.pdf', 0, '2019-04-15 20:37:06', '2019-04-16 02:32:45'),
(34, 34, 6, 6, NULL, '750', '750', '1771', 'C-2/27', 'A', '960a32.pdf', 0, '2019-04-15 20:38:12', '2019-04-16 02:32:48'),
(35, 34, 6, 6, NULL, '1550', '1550', '1741', 'c-2/26', 'A', '3fe275.pdf', 0, '2019-04-17 22:57:01', '2019-09-04 00:56:26'),
(36, 34, 6, 6, NULL, '750', '750', '1741', 'C-2/27', 'A', 'a2ada7.pdf', 0, '2019-04-17 22:58:08', '2019-09-04 00:56:35'),
(37, 21, 2, 6, NULL, '1010', NULL, '1741', '4A', 'A', '782ae9.pdf', 0, '2019-04-17 23:05:02', '2019-05-01 00:00:41'),
(38, 21, 2, 6, NULL, '1000', NULL, '1741', '3A', 'A', 'd8a1be.pdf', 0, '2019-04-17 23:09:50', '2019-04-17 23:11:37'),
(39, 9, 2, 6, NULL, '1000', '1000', '2000', '4A', 'A', 'b86203.pdf', 0, '2019-04-17 23:14:12', '2019-09-04 00:56:32'),
(40, 9, 2, 6, NULL, '1000', '1000', '1751', '3A', 'A', '46b857.pdf', 0, '2019-04-17 23:14:52', '2019-04-18 18:56:40'),
(41, 34, 5, 6, NULL, '1100', '1100', '1731', 'C-3/1', 'A', '56a6a6.pdf', 0, '2019-04-18 19:22:37', '2019-09-04 00:56:28'),
(42, 40, 1, 6, NULL, '0', '10', '1795', 'dummy', 'A', '493324.pdf', 0, '2019-04-30 20:52:16', '2019-09-04 00:56:38'),
(43, 5, 6, 6, NULL, '1560', '1560', '1875', 'STACK 31', 'A', 'c08383.pdf', 0, '2019-09-04 00:59:31', '2019-09-04 21:49:49'),
(44, 5, 6, 6, NULL, '1560', '1560', '1871', '31', 'A', 'e8a3a8.pdf', 0, '2019-09-04 22:10:26', '2019-09-05 17:17:59'),
(45, 5, 6, 6, NULL, '1560', '1560', '1870', '31', 'A', 'ab655f.pdf', 0, '2019-09-05 17:18:36', '2019-09-05 20:10:10'),
(46, 5, 6, 6, NULL, '0', '1560', '1856', '31', 'A', 'ae883b.pdf', 1, '2019-09-05 20:16:49', '2019-09-05 23:28:48'),
(47, 46, 6, 6, NULL, '1560', NULL, NULL, NULL, NULL, NULL, 1, '2019-09-05 23:28:48', '2019-09-05 23:28:48');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(10) UNSIGNED NOT NULL,
  `item` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `item`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Barley', 0, '2019-01-19 02:56:55', '2019-01-21 16:48:29');

-- --------------------------------------------------------

--
-- Table structure for table `mandi_name`
--

CREATE TABLE `mandi_name` (
  `id` int(11) NOT NULL,
  `mandi_name` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mandi_name`
--

INSERT INTO `mandi_name` (`id`, `mandi_name`, `created_at`, `updated_at`, `status`) VALUES
(1, 'Sikar', '2019-01-18 20:00:09', '2019-01-18 20:00:09', 1),
(2, 'Jhunjhunu', '2019-01-18 20:00:21', '2019-01-18 20:00:21', 1),
(3, 'Jaipur', '2019-01-18 20:00:33', '2019-01-18 20:00:33', 1),
(4, 'Shrimadhopur', '2019-01-18 20:00:45', '2019-01-18 20:00:45', 1),
(5, 'Chomu', '2019-01-18 20:00:55', '2019-01-18 20:00:55', 1);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `role` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role`, `created_at`, `updated_at`) VALUES
(1, 'admin', '2018-09-06 08:27:26', '2018-09-06 08:27:26'),
(2, 'user', '2018-09-06 08:27:26', '2018-09-06 08:27:26'),
(4, 'govt_user', '2019-01-05 13:17:45', '2019-01-05 13:17:45'),
(5, 'farmer', '2019-01-13 07:25:38', '2019-01-13 07:25:38'),
(6, 'trader', '2019-01-13 07:29:03', '2019-01-13 07:29:03');

-- --------------------------------------------------------

--
-- Table structure for table `sms_hash_key`
--

CREATE TABLE `sms_hash_key` (
  `id` int(11) NOT NULL,
  `hash` varchar(191) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sms_hash_key`
--

INSERT INTO `sms_hash_key` (`id`, `hash`) VALUES
(1, 'BycE+CkOSN/');

-- --------------------------------------------------------

--
-- Table structure for table `today_prices`
--

CREATE TABLE `today_prices` (
  `id` int(11) NOT NULL,
  `modal` varchar(191) DEFAULT NULL,
  `max` varchar(191) DEFAULT NULL,
  `min` varchar(191) DEFAULT NULL,
  `commodity_id` int(11) NOT NULL,
  `mandi_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `today_prices`
--

INSERT INTO `today_prices` (`id`, `modal`, `max`, `min`, `commodity_id`, `mandi_id`, `created_at`, `updated_at`, `status`) VALUES
(1, '1900', '1905', '1891', 1, 1, '2019-01-21 09:37:10', '2019-08-21 18:20:22', 1),
(2, '1885', '1900', '1860', 1, 2, '2019-01-21 09:37:41', '2019-08-21 18:20:48', 1),
(3, '5500', '5800', '5000', 3, 3, '2019-01-21 09:39:20', '2019-08-21 18:22:15', 1),
(4, '4450', '4600', '4400', 4, 4, '2019-01-21 09:39:54', '2019-01-21 09:39:54', 1),
(5, '2050', '2100', '2000', 2, 5, '2019-01-21 09:40:23', '2019-08-21 18:21:55', 1),
(6, '1925', '1950', '1900', 1, 5, '2019-01-21 09:41:47', '2019-08-21 18:21:34', 1),
(7, '4500', '4600', '4400', 4, 3, '2019-01-21 09:42:22', '2019-01-21 09:42:22', 1),
(8, '4500', '4600', '4400', 5, 2, '2019-01-21 09:43:03', '2019-08-21 18:22:45', 1),
(9, '5350', '5400', '5300', 3, 4, '2019-01-21 09:43:57', '2019-08-21 18:23:33', 1),
(10, '4500', '4600', '4400', 5, 3, '2019-01-21 09:44:30', '2019-08-21 18:23:04', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `fname` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lname` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `login_otp` varchar(6) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `register_otp` varchar(6) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fname`, `lname`, `email`, `password`, `phone`, `login_otp`, `register_otp`, `remember_token`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Admin', '', 'admin@admin.com', '$2y$10$JCJ6HuLpoDYa0obD88w0buwVOYjjK5/M59CxfPM/UDqtJHLb2uK5O', '9602947878', NULL, NULL, 'qDvVRaIjmI9dLmnuH3Y2Vg9VzaHxr6U3p6WFWr4vEWCVdPIyfa73phE3W4mp', 1, '2018-09-01 08:17:09', '2019-10-02 06:34:28');

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `fname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lname` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `father_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category` int(11) DEFAULT NULL,
  `gst_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `khasra_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `village` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tehsil` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `district` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `power` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `aadhar_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_branch` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_acc_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_ifsc_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profile_image` text COLLATE utf8mb4_unicode_ci,
  `aadhar_image` text COLLATE utf8mb4_unicode_ci,
  `cheque_image` text COLLATE utf8mb4_unicode_ci,
  `firm_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` longtext COLLATE utf8mb4_unicode_ci,
  `mandi_license` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `latitude` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `longitude` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transfer_amount` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`id`, `user_id`, `role_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2018-09-06 08:26:31', '2018-09-06 08:26:31');

-- --------------------------------------------------------

--
-- Table structure for table `warehouses`
--

CREATE TABLE `warehouses` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `facility_ids` text COLLATE utf8mb4_unicode_ci,
  `image` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `warehouses`
--

INSERT INTO `warehouses` (`id`, `name`, `facility_ids`, `image`, `status`, `created_at`, `updated_at`) VALUES
(8, 'Genus Power', '[\"2\",\"4\"]', '07cc8a.jpg', 1, '2019-10-01 14:55:10', '2019-10-01 14:55:10'),
(9, 't1', '[\"2\",\"4\",\"5\"]', 'b24df2.jpg', 2, '2019-10-01 20:10:30', '2019-10-02 00:53:29'),
(10, 't2', '[\"2\",\"3\",\"4\"]', 'f187a9.jpg', 2, '2019-10-01 20:14:27', '2019-10-01 20:29:45'),
(11, 'Genus Power', '[\"2\",\"3\"]', '71aded.jpg', 1, '2019-10-02 00:55:18', '2019-10-02 00:55:18'),
(12, 'R K Warehouse', '[\"2\",\"3\"]', 'e1b1b4.jpg', 1, '2019-10-02 01:48:37', '2019-10-02 01:57:41');

-- --------------------------------------------------------

--
-- Table structure for table `warehouse_rent_rates`
--

CREATE TABLE `warehouse_rent_rates` (
  `id` int(11) NOT NULL,
  `warehouse_id` int(11) DEFAULT NULL,
  `address` text,
  `location` varchar(100) DEFAULT NULL,
  `area` varchar(100) DEFAULT NULL,
  `district` varchar(100) DEFAULT NULL,
  `area_sqr_ft` varchar(10) DEFAULT NULL,
  `rent_per_month` varchar(10) DEFAULT NULL,
  `capacity_in_mt` varchar(10) DEFAULT NULL,
  `nearby_transporter_info` text,
  `nearby_mandi_info` text,
  `nearby_crop_info` text,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `warehouse_rent_rates`
--

INSERT INTO `warehouse_rent_rates` (`id`, `warehouse_id`, `address`, `location`, `area`, `district`, `area_sqr_ft`, `rent_per_month`, `capacity_in_mt`, `nearby_transporter_info`, `nearby_mandi_info`, `nearby_crop_info`, `status`, `created_at`, `updated_at`) VALUES
(2, NULL, 'Genus Power', 'Keshwana', 'Kotputli', 'Jaipur', '42000', '94', '7560', NULL, NULL, NULL, 1, '2019-09-11 15:58:52', '2019-09-11 15:58:52'),
(3, NULL, 'R K Warehouse', 'Morija', 'Chomu', 'Jaipur', '20000', '100', '3600', NULL, NULL, NULL, 1, '2019-09-11 15:59:29', '2019-09-11 15:59:29'),
(4, NULL, 'Chiraag Logistics', 'Manda', 'Khatushyam', 'Sikar', '20000', '100', '3600', NULL, NULL, NULL, 1, '2019-09-11 16:00:02', '2019-09-11 16:00:02'),
(5, NULL, 'R K Warehouse', 'Manda', 'Khatushyam', 'Sikar', '16000', '100', '2880', NULL, NULL, NULL, 1, '2019-09-11 16:00:51', '2019-09-11 16:00:51'),
(6, NULL, 'Maharshi Export', 'Palsana', 'Palsana', 'Sikar', '13000', '90', '2340', NULL, NULL, NULL, 1, '2019-09-11 16:06:47', '2019-09-11 16:06:47'),
(7, NULL, 'Giriraj Dharan Industries', 'Ajeetgarh', 'Ajeetgarh', 'Sikar', '10000', '100', '1800', NULL, NULL, NULL, 1, '2019-09-11 16:07:17', '2019-09-11 16:07:17'),
(8, NULL, 'National Industries', 'Reengas', 'Reengas', 'Sikar', '6000', '90', '1080', NULL, NULL, NULL, 1, '2019-09-11 16:17:37', '2019-09-11 16:17:37'),
(9, NULL, 'Raka Tripathi', 'Jhunjhunu', 'Jhunjhunu', 'Jhunjhunu', '4500', '100', '810', NULL, NULL, NULL, 1, '2019-09-11 16:18:05', '2019-09-11 16:18:05'),
(10, NULL, 'Agarwal Industries', 'Palsana', 'Palsana', 'Sikar', '4200', '90', '756', NULL, NULL, NULL, 1, '2019-09-11 16:18:38', '2019-09-11 16:18:38'),
(11, NULL, 'Shah Industries', 'Palsana', 'Palsana', 'Sikar', '4200', '90', '756', NULL, NULL, NULL, 1, '2019-09-11 16:19:19', '2019-09-11 16:19:19'),
(12, NULL, 'Savita Devi', 'Rampura', 'Jaipur', 'Jaipur', '3000', '80', '540', NULL, NULL, NULL, 1, '2019-09-11 16:19:55', '2019-09-11 16:19:55'),
(13, NULL, 'Nature Fresh Agro Industries', 'Muhana', 'Muhana', 'Jaipur', '20000', '150', '2000', NULL, NULL, NULL, 1, '2019-09-17 19:45:54', '2019-09-17 19:45:54'),
(14, 9, 'ta', 't', 'ta', 'td', 'tai', 'tr', 'tc', NULL, NULL, NULL, 1, '2019-10-01 20:10:30', '2019-10-02 00:48:47'),
(15, 10, 'ta', 'tl', 'ta', 'td', 'tai', 'tr', 'tc', NULL, NULL, NULL, 1, '2019-10-01 20:14:27', '2019-10-01 20:14:27'),
(16, 11, 'Keshwana', 'Kotputli', 'Jaipur', 'Jaipur', '42000', '94', '7560', NULL, NULL, NULL, 1, '2019-10-02 00:55:18', '2019-10-02 00:55:18'),
(17, 12, 'Morija', 'Chomu', 'Jaipur', 'Jaipur', '20000', '100', '3600', 'Transporter A || Transporter B || Transporter C', 'Mandi A || Mandi B', 'Crop A', 1, '2019-10-02 01:48:37', '2019-10-02 01:57:41');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buy_sells`
--
ALTER TABLE `buy_sells`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `buy_sell_conversations`
--
ALTER TABLE `buy_sell_conversations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `commodity_name`
--
ALTER TABLE `commodity_name`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `facilities`
--
ALTER TABLE `facilities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `facilitiy_master`
--
ALTER TABLE `facilitiy_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `finances`
--
ALTER TABLE `finances`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `finance_responses`
--
ALTER TABLE `finance_responses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inventories`
--
ALTER TABLE `inventories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mandi_name`
--
ALTER TABLE `mandi_name`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sms_hash_key`
--
ALTER TABLE `sms_hash_key`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `today_prices`
--
ALTER TABLE `today_prices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `warehouses`
--
ALTER TABLE `warehouses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `warehouse_rent_rates`
--
ALTER TABLE `warehouse_rent_rates`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `buy_sells`
--
ALTER TABLE `buy_sells`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `buy_sell_conversations`
--
ALTER TABLE `buy_sell_conversations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `commodity_name`
--
ALTER TABLE `commodity_name`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `facilities`
--
ALTER TABLE `facilities`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `facilitiy_master`
--
ALTER TABLE `facilitiy_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `finances`
--
ALTER TABLE `finances`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `finance_responses`
--
ALTER TABLE `finance_responses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inventories`
--
ALTER TABLE `inventories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `mandi_name`
--
ALTER TABLE `mandi_name`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sms_hash_key`
--
ALTER TABLE `sms_hash_key`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `today_prices`
--
ALTER TABLE `today_prices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_details`
--
ALTER TABLE `user_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=158;

--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `warehouses`
--
ALTER TABLE `warehouses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `warehouse_rent_rates`
--
ALTER TABLE `warehouse_rent_rates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
