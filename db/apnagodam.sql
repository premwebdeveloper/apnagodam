-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 02, 2019 at 04:52 AM
-- Server version: 5.6.44-cll-lve
-- PHP Version: 7.2.7

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
-- Table structure for table `bank_master`
--

CREATE TABLE `bank_master` (
  `id` int(11) NOT NULL,
  `bank_name` varchar(100) DEFAULT NULL,
  `interest_rate` varchar(10) DEFAULT NULL,
  `loan_pass_days` varchar(10) DEFAULT NULL,
  `processing_fee` varchar(10) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bank_master`
--

INSERT INTO `bank_master` (`id`, `bank_name`, `interest_rate`, `loan_pass_days`, `processing_fee`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Apnagodam', '10', '10', '1', 1, '2019-10-08 01:00:17', '2019-10-08 12:06:31'),
(2, 'HDFC', '10', '10', '1', 1, '2019-10-06 00:43:29', '2019-10-08 12:06:45'),
(3, 'SBI', '10', '10', '1', 1, '2019-10-06 00:43:06', '2019-10-08 12:07:01'),
(4, 'ICICI', '10', '20', '1', 1, '2019-10-14 17:24:11', '2019-10-14 17:24:11');

-- --------------------------------------------------------

--
-- Table structure for table `buy_sells`
--

CREATE TABLE `buy_sells` (
  `id` int(10) UNSIGNED NOT NULL,
  `buyer_id` int(11) DEFAULT NULL,
  `seller_id` int(11) NOT NULL,
  `seller_cat_id` int(11) NOT NULL,
  `payment_ref_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'final price after bidding between seller and buyer',
  `status` tinyint(1) NOT NULL COMMENT 'status 1 active bid and 2 for complete bid / deal done 3 for pdf send and payment accept',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `buy_sells`
--

INSERT INTO `buy_sells` (`id`, `buyer_id`, `seller_id`, `seller_cat_id`, `payment_ref_no`, `quantity`, `price`, `status`, `created_at`, `updated_at`) VALUES
(8, 11, 3, 15, '122121212121', '25', '1760', 3, '2019-12-02 21:10:17', '2019-12-02 21:29:12'),
(9, 3, 11, 16, '515348', '25', '1890', 3, '2019-12-02 21:48:49', '2019-12-02 21:59:18');

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

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `category` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `commodity_type` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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

INSERT INTO `categories` (`id`, `category`, `commodity_type`, `gst`, `commossion`, `mandi_fees`, `loading`, `bardana`, `freight`, `image`, `status`, `created_at`, `updated_at`) VALUES
(3, 'Makka', 'Paid', '0', '0', '0.5', '0', '0', '0', '8309de.jpeg', 1, '2019-01-19 10:13:13', '2019-10-15 00:48:07'),
(8, 'Barley', 'Payable', '0', '0', '1.6', '0', '0', '0', 'a75d91.jpg', 1, '2019-10-08 15:05:56', '2019-10-08 15:05:56'),
(9, 'Makka', 'Payable', '0', '0', '0', '0', '0', '0', '447770.jpeg', 1, '2019-10-08 15:28:44', '2019-10-08 15:30:08'),
(10, 'Barley', 'Paid', '0', '0', '0', '0', '0', '0', '36a667.jpg', 1, '2019-10-08 15:29:15', '2019-10-08 15:29:15'),
(11, 'Bajra', 'Payable', '0', '0', '0.5', '0', '0', '0', '1d43dc.jpg', 1, '2019-10-08 15:31:02', '2019-10-08 15:31:02'),
(12, 'Bajra', 'Paid', '0', '0', '0', '0', '0', '0', '005768.jpg', 1, '2019-10-08 15:31:21', '2019-10-08 15:31:21'),
(13, 'Jvaar', 'Payable', '0', '0', '0.5', '0', '0', '0', '07d784.jpg', 1, '2019-10-08 15:33:50', '2019-10-08 15:33:50'),
(14, 'Jvaar', 'Paid', '0', '0', '0', '0', '0', '0', '1daf3d.jpg', 1, '2019-10-08 15:34:07', '2019-10-08 15:34:07'),
(15, 'Wheat', 'Payable', '0', '0', '1.6', '0', '0', '0', 'a349d1.jpg', 1, '2019-10-08 15:36:23', '2019-10-08 15:36:23'),
(16, 'Wheat', 'Paid', '0', '0', '0', '0', '0', '0', '47af99.jpg', 1, '2019-10-08 15:36:39', '2019-10-08 15:36:39'),
(17, 'Gram', 'Payable', '0', '0', '1.6', '0', '0', '0', '46cab5.jpg', 1, '2019-10-08 15:38:54', '2019-10-08 15:38:54'),
(18, 'Mung', 'Payable', '0', '0', '1.6', '0', '0', '0', 'bcbf93.jpg', 1, '2019-10-08 15:42:25', '2019-10-08 15:42:25'),
(19, 'Mung', 'Paid', '0', '0', '0', '0', '0', '0', '519818.jpg', 1, '2019-10-08 15:42:46', '2019-10-08 15:42:46'),
(20, 'Moth', 'Payable', '0', '0', '1.6', '0', '0', '0', '3cf4e0.jpg', 1, '2019-10-08 15:45:25', '2019-10-08 15:45:25'),
(21, 'Moth', 'Paid', '0', '0', '0', '0', '0', '0', '0cd7cf.jpg', 1, '2019-10-08 15:45:50', '2019-10-08 15:45:50'),
(22, 'Mustard', 'Payable', '0', '0', '1', '0', '0', '0', 'fe45a4.jpg', 1, '2019-10-08 15:47:03', '2019-10-08 15:47:03'),
(23, 'Mustard', 'Paid', '0', '0', '0', '0', '0', '0', 'b17f0f.jpg', 1, '2019-10-08 15:47:27', '2019-10-08 15:47:27'),
(24, 'Soybean', 'Payable', '0', '0', '1', '0', '0', '0', 'ea88da.jpg', 1, '2019-10-08 15:49:08', '2019-10-08 15:49:08'),
(25, 'Soybean', 'Paid', '0', '0', '0', '0', '0', '0', '96f235.jpg', 1, '2019-10-08 15:49:26', '2019-10-08 15:49:26'),
(26, 'Groundnut', 'Payable', '0', '0', '1', '0', '0', '0', 'e0c305.jpg', 1, '2019-10-08 15:50:19', '2019-10-08 15:50:19'),
(27, 'Groundnut', 'Paid', '0', '0', '0', '0', '0', '0', '84bbd1.jpg', 1, '2019-10-08 15:50:57', '2019-10-08 15:50:57'),
(28, 'Gram', 'Paid', '0', '0', '0', '0', '0', '0', '570f2e.jpg', 1, '2019-10-08 15:51:51', '2019-10-08 15:51:51');

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
(5, 'Fire Equipment', 'fire equipment', '559e17.png', 1, '2019-09-28 01:36:39', '2019-09-28 01:36:39'),
(7, 'E-Mandi Only', 'E-Mandi Only', 'd24d1b.png', 1, '2019-10-04 20:23:19', '2019-10-04 20:23:19');

-- --------------------------------------------------------

--
-- Table structure for table `finances`
--

CREATE TABLE `finances` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `bank_id` int(11) NOT NULL,
  `pan` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `balance_sheet` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_statement` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `commodity_id` int(11) NOT NULL,
  `quantity` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remaining_amount` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `finances`
--

INSERT INTO `finances` (`id`, `user_id`, `bank_id`, `pan`, `balance_sheet`, `bank_statement`, `commodity_id`, `quantity`, `amount`, `remaining_amount`, `status`, `created_at`, `updated_at`) VALUES
(1, 3, 2, NULL, NULL, NULL, 6, '25', '500000', 300000, 2, '2019-10-15 23:45:39', '2019-10-16 01:00:13'),
(2, 3, 2, NULL, NULL, NULL, 3, '10', '10000', NULL, 1, '2019-10-16 00:10:45', '2019-10-16 00:10:45'),
(3, 3, 2, NULL, NULL, NULL, 6, '50', '500000', NULL, 1, '2019-10-16 00:12:55', '2019-10-16 00:12:55'),
(4, 3, 4, NULL, NULL, NULL, 6, '50', '500000', NULL, 1, '2019-10-16 00:13:36', '2019-10-16 00:13:36'),
(5, 3, 3, NULL, NULL, NULL, 6, '50', '500000', NULL, 1, '2019-10-16 00:13:58', '2019-10-16 00:13:58'),
(6, 3, 1, NULL, NULL, NULL, 6, '10', '35000', NULL, 1, '2019-10-16 00:15:38', '2019-10-16 00:16:08'),
(7, 13, 4, NULL, NULL, NULL, 9, '100', '15000', NULL, 2, '2019-11-30 22:15:12', '2019-11-30 22:15:54'),
(9, 3, 4, NULL, NULL, NULL, 15, '15', '15000', 10000, 2, '2019-12-02 22:41:33', '2019-12-02 22:43:50'),
(10, 3, 1, NULL, NULL, NULL, 17, '25', '33000', NULL, 2, '2019-12-02 23:22:36', '2019-12-02 23:25:07');

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

--
-- Dumping data for table `finance_responses`
--

INSERT INTO `finance_responses` (`id`, `finance_id`, `bank_name`, `amount`, `interest`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, NULL, NULL, 2, '2019-10-15 23:45:39', '2019-10-15 23:46:51'),
(2, 2, NULL, NULL, NULL, NULL, '2019-10-16 00:10:45', '2019-10-16 00:10:45'),
(3, 3, NULL, NULL, NULL, NULL, '2019-10-16 00:12:55', '2019-10-16 00:12:55'),
(4, 4, NULL, NULL, NULL, NULL, '2019-10-16 00:13:36', '2019-10-16 00:13:36'),
(5, 5, NULL, NULL, NULL, NULL, '2019-10-16 00:13:58', '2019-10-16 00:13:58'),
(6, 6, NULL, NULL, NULL, NULL, '2019-10-16 00:15:38', '2019-10-16 00:15:38'),
(7, 7, NULL, NULL, NULL, 2, '2019-11-30 22:15:12', '2019-11-30 22:15:54'),
(9, 9, NULL, NULL, NULL, 2, '2019-12-02 22:41:33', '2019-12-02 22:42:11'),
(10, 10, NULL, NULL, NULL, 2, '2019-12-02 23:22:36', '2019-12-02 23:25:07');

-- --------------------------------------------------------

--
-- Table structure for table `inventories`
--

CREATE TABLE `inventories` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `warehouse_id` int(11) NOT NULL,
  `commodity` int(11) NOT NULL,
  `weight_bridge_no` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `truck_no` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stack_no` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lot_no` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `net_weight` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  `quantity` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sell_quantity` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gate_pass_wr` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quality_category` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sales_status` int(11) DEFAULT '1' COMMENT '1 For Primary 2 For Secondary Sales',
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `inventories`
--

INSERT INTO `inventories` (`id`, `user_id`, `warehouse_id`, `commodity`, `weight_bridge_no`, `truck_no`, `stack_no`, `lot_no`, `net_weight`, `type`, `quantity`, `sell_quantity`, `price`, `gate_pass_wr`, `quality_category`, `image`, `sales_status`, `status`, `created_at`, `updated_at`) VALUES
(15, 3, 2, 11, '5678', '1234', '12', '12', '20', NULL, '15', NULL, '1700', '1234', 'A', NULL, 1, 1, '2019-12-02 20:39:31', '2019-12-02 21:29:08'),
(16, 11, 2, 12, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, '1800', '1234', 'A', NULL, 2, 0, '2019-12-02 21:29:08', '2019-12-02 21:58:28'),
(17, 3, 2, 12, NULL, NULL, NULL, NULL, NULL, NULL, '25', '25', '1800', '1234', 'A', NULL, 2, 1, '2019-12-02 21:58:10', '2019-12-02 23:26:29');

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
-- Table structure for table `loan_max_value`
--

CREATE TABLE `loan_max_value` (
  `id` int(11) NOT NULL,
  `loan_value` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `loan_max_value`
--

INSERT INTO `loan_max_value` (`id`, `loan_value`) VALUES
(1, 70);

-- --------------------------------------------------------

--
-- Table structure for table `mandi_name`
--

CREATE TABLE `mandi_name` (
  `id` int(11) NOT NULL,
  `mandi_name` varchar(255) NOT NULL,
  `mandi_tax_fees` varchar(25) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mandi_name`
--

INSERT INTO `mandi_name` (`id`, `mandi_name`, `mandi_tax_fees`, `created_at`, `updated_at`, `status`) VALUES
(1, 'Sikar', NULL, '2019-01-18 20:00:09', '2019-01-18 20:00:09', 1),
(2, 'Jhunjhunu', NULL, '2019-01-18 20:00:21', '2019-01-18 20:00:21', 1),
(3, 'Jaipur', NULL, '2019-01-18 20:00:33', '2019-01-18 20:00:33', 1),
(4, 'Shrimadhopur', NULL, '2019-01-18 20:00:45', '2019-01-18 20:00:45', 1),
(5, 'Chomu', NULL, '2019-01-18 20:00:55', '2019-01-18 20:00:55', 1);

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
(3, '4500', '5000', '4000', 3, 3, '2019-01-21 09:39:20', '2019-10-07 09:20:34', 1),
(4, '4450', '4600', '4400', 4, 4, '2019-01-21 09:39:54', '2019-01-21 09:39:54', 1),
(5, '1650', '1700', '1600', 7, 5, '2019-01-21 09:40:23', '2019-10-07 09:21:31', 1),
(6, '1925', '1950', '1900', 1, 5, '2019-01-21 09:41:47', '2019-08-21 18:21:34', 1),
(7, '4500', '4600', '4400', 4, 3, '2019-01-21 09:42:22', '2019-01-21 09:42:22', 1),
(8, '3750', '3800', '3650', 5, 2, '2019-01-21 09:43:03', '2019-10-07 09:20:17', 1),
(9, '4500', '5000', '4000', 3, 4, '2019-01-21 09:43:57', '2019-10-07 09:21:11', 1),
(10, '3700', '3800', '3600', 5, 3, '2019-01-21 09:44:30', '2019-10-07 09:20:52', 1);

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
(1, 'Admin', '', 'admin@admin.com', '$2y$10$JCJ6HuLpoDYa0obD88w0buwVOYjjK5/M59CxfPM/UDqtJHLb2uK5O', '9314142089', NULL, NULL, 'cfQINe4XqLxOZn5SHvn44LQmjs42y6Ndb2XwSe73beWotJ1X7SsEKcd2BWHw', 1, '2018-09-01 08:17:09', '2019-12-02 20:33:02'),
(2, 'Super Admin', '', 'ravikumawat4949@gmail.com', '$2y$10$JCJ6HuLpoDYa0obD88w0buwVOYjjK5/M59CxfPM/UDqtJHLb2uK5O', '9549494175', NULL, NULL, 'BQYnypaZmD0V3rvtMFdbPp8dzwOKo7VkArXZMD86OXBXmpq5NnJmciqfMKNK', 1, '2018-09-01 08:17:09', '2019-12-02 20:33:02'),
(3, 'Pooja', 'Pooja', NULL, '$2y$10$Y6ki2B/9P/SbKQAWklCftulY29KNFX4a1ly8JMGD47TGPNOCbkS8C', '8955895493', NULL, '', NULL, 1, '2019-10-15 19:11:27', '2019-12-02 22:24:52'),
(11, 'Ravi Kumawat', NULL, NULL, '$2y$10$8/BDfmPxgHRdxPHE7aYWS.N1V2hn59jd/C4eO16..2jYAqX9NYKX2', '7014432414', NULL, NULL, 'uMRs82RN0kjh2LzwKVxbEsoNsvqcBqWDV4SRNfSw1RonMkM0SlyQPcWV67gK', 1, '2019-11-28 07:34:48', '2019-12-02 21:24:47'),
(14, 'Rekha Agarwal Test', NULL, NULL, '$2y$10$8vuzYWl5TfXqW4o9xri0hesMP8/p7uQlhDA.DaESYp3i4PtLrSoVe', '8005731068', NULL, NULL, NULL, 1, '2019-12-02 20:26:41', '2019-12-02 20:27:12');

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
  `referral_code` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `referral_by` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`id`, `user_id`, `fname`, `lname`, `email`, `phone`, `referral_code`, `referral_by`, `father_name`, `category`, `gst_number`, `khasra_no`, `village`, `tehsil`, `district`, `image`, `power`, `aadhar_no`, `bank_name`, `bank_branch`, `bank_acc_no`, `bank_ifsc_code`, `profile_image`, `aadhar_image`, `cheque_image`, `firm_name`, `address`, `mandi_license`, `latitude`, `longitude`, `transfer_amount`, `status`, `created_at`, `updated_at`) VALUES
(7, 3, 'pooja', 'Pooja', '', '8955895493', 'R772ED', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'user.png', '9211250', '123445694789', NULL, NULL, NULL, NULL, NULL, '4a5960.png', 'dd5f7f.png', NULL, 'p.no 16 sector 9, opposite vidhyadhar nagar jaipur', NULL, NULL, NULL, NULL, 1, '2019-10-15 00:06:00', '2019-12-02 21:59:18'),
(10, 11, 'Ravi Kumawat', NULL, NULL, '7014432414', 'RA710B', NULL, NULL, NULL, 'GSTIN1215254589653254', NULL, NULL, NULL, NULL, 'user.png', '261000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Hastag Soft', 'F-125, Unnati Tower, Central Spine,, Vidhyadhar Nagar Jaipur', 'REF./157411', NULL, NULL, NULL, 1, '2019-11-28 07:34:48', '2019-12-02 21:29:12'),
(13, 14, 'Rekha Agarwal Test', NULL, NULL, '8005731068', 'RDA384', NULL, 'Girdhari Lal', NULL, NULL, NULL, 'Jaipur', NULL, 'Jaipur', 'user.png', '1000000', '963852741012', 'SBI', 'VDN', '963963963963', 'SBIN0031211', NULL, '70e1f2.jpg', '334ced.jpg', NULL, 'Vidhyadhar Nagar, Jaipur', NULL, NULL, NULL, NULL, 1, '2019-12-02 20:26:40', '2019-12-02 20:27:04');

-- --------------------------------------------------------

--
-- Table structure for table `user_groups`
--

CREATE TABLE `user_groups` (
  `id` int(11) NOT NULL,
  `group_id` varchar(10) NOT NULL,
  `user_ids` text NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_groups`
--

INSERT INTO `user_groups` (`id`, `group_id`, `user_ids`, `status`, `created_at`, `updated_at`) VALUES
(1, 'AG96883', '[\"3\",\"11\"]', 1, '2019-12-02 15:50:56', '2019-12-02 15:50:56');

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
(1, 1, 1, '2018-09-06 08:26:31', '2018-09-06 08:26:31'),
(2, 2, 1, '2018-09-06 08:26:31', '2018-09-06 08:26:31'),
(3, 3, 2, '2019-10-12 19:15:49', '2019-10-12 19:15:49'),
(4, 4, 2, '2019-10-12 19:19:43', '2019-10-12 19:19:43'),
(5, 5, 2, '2019-10-12 21:40:09', '2019-10-12 21:40:09'),
(6, 8, 2, '2019-10-14 21:11:07', '2019-10-14 21:11:07'),
(7, 9, 2, '2019-10-15 00:06:00', '2019-10-15 00:06:00'),
(8, 10, 5, '2019-10-15 00:47:03', '2019-10-15 00:47:03'),
(9, 10, 5, '2019-10-15 00:47:03', '2019-10-15 00:47:03'),
(10, 8, 2, '2019-10-15 23:21:51', '2019-10-15 23:21:51'),
(11, 9, 5, '2019-10-16 00:32:22', '2019-10-16 00:32:22'),
(12, 10, 2, '2019-11-24 20:29:30', '2019-11-24 20:29:30'),
(13, 11, 2, '2019-11-28 07:34:48', '2019-11-28 07:34:48'),
(14, 12, 2, '2019-11-28 07:51:34', '2019-11-28 07:51:34'),
(15, 13, 2, '2019-11-30 21:55:33', '2019-11-30 21:55:33'),
(16, 14, 2, '2019-12-02 20:26:40', '2019-12-02 20:26:40');

-- --------------------------------------------------------

--
-- Table structure for table `warehouses`
--

CREATE TABLE `warehouses` (
  `id` int(10) UNSIGNED NOT NULL,
  `warehouse_code` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `facility_ids` text COLLATE utf8mb4_unicode_ci,
  `bank_ids` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `warehouses`
--

INSERT INTO `warehouses` (`id`, `warehouse_code`, `name`, `facility_ids`, `bank_ids`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 'TL001', 'Greenwings Innovative', '[\"2\",\"4\",\"5\"]', NULL, '0e3da0.jpg', 1, '2019-01-18 19:52:09', '2019-10-04 20:21:34'),
(2, 'TL002', 'Sharda Devi', '[\"2\",\"3\",\"4\"]', NULL, NULL, 1, '2019-01-18 19:52:31', '2019-10-07 09:24:01'),
(3, 'TL003', 'Chiraag Logistics', '[\"2\",\"4\",\"5\"]', NULL, 'f454a1.jpg', 1, '2019-01-18 19:53:02', '2019-10-03 01:17:03'),
(4, 'TL004', 'R K Warehouse', '[\"2\",\"3\",\"4\"]', NULL, NULL, 1, '2019-01-18 19:53:39', '2019-01-18 19:53:39'),
(5, 'TL005', 'Maharshi Export', '[\"2\",\"4\",\"5\"]', NULL, '198162.jpg', 1, '2019-01-18 19:54:01', '2019-10-03 01:17:44'),
(6, 'TL006', 'Giriraj Dharan Industries', '[\"4\",\"5\"]', NULL, '54d544.jpg', 1, '2019-04-06 16:13:54', '2019-10-03 01:17:31'),
(7, 'TL007', 'National Industries', '[\"2\",\"3\",\"5\"]', NULL, 'd0c70b.jpg', 1, '2019-04-17 16:45:47', '2019-10-03 01:17:57'),
(8, 'TL008', 'Raka Tripathi', '[\"2\",\"3\",\"5\"]', NULL, NULL, 1, '2019-04-17 16:45:47', '2019-04-17 16:45:47'),
(9, 'TL009', 'Agarwal Industries', '[\"2\",\"3\",\"4\",\"5\",\"7\"]', '[\"1\",\"2\",\"4\"]', '2ea85b.jpg', 1, '2019-01-18 19:53:02', '2019-10-14 17:43:53'),
(10, 'TL010', 'Shah Industries', '[\"2\",\"4\",\"5\"]', NULL, NULL, 1, '2019-04-06 16:13:54', '2019-04-06 16:13:54'),
(11, 'TL011', 'Savita Devi', '[\"2\",\"4\",\"5\"]', NULL, NULL, 1, '2019-01-18 19:54:01', '2019-01-18 19:54:01'),
(12, 'TL012', 'Nature Fresh Agro Industries', '[\"4\",\"5\"]', NULL, NULL, 1, '2019-01-18 19:54:01', '2019-01-18 19:54:01'),
(13, 'TL013', 'abc', 'null', 'null', '6752da.png', 2, '2019-10-14 17:42:53', '2019-10-14 17:43:13');

-- --------------------------------------------------------

--
-- Table structure for table `warehouse_enquirers`
--

CREATE TABLE `warehouse_enquirers` (
  `id` int(11) NOT NULL,
  `warehouse_id` int(11) NOT NULL,
  `commodity` varchar(255) DEFAULT NULL,
  `quantity` varchar(50) DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `commitment` varchar(20) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `warehouse_enquirers`
--

INSERT INTO `warehouse_enquirers` (`id`, `warehouse_id`, `commodity`, `quantity`, `mobile`, `commitment`, `status`, `created_at`, `updated_at`) VALUES
(7, 9, '9', '10', '9602947878', '6', 1, '2019-10-15 13:48:30', '2019-10-15 13:48:30'),
(9, 9, '10', '10', '9639639639', '58', 1, '2019-10-15 14:18:25', '2019-10-15 14:18:25'),
(10, 3, '13', '12', '1234567890', '12', 1, '2019-10-17 16:11:03', '2019-10-17 16:11:03'),
(11, 1, '11', '1', '1', '2', 1, '2019-10-17 16:51:03', '2019-10-17 16:51:03');

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
(2, 1, 'Greenwings Innovative', 'Keshwana', 'Kotputli', 'Jaipur', '42000', '94', '7560', NULL, NULL, NULL, 1, '2019-09-11 15:58:52', '2019-10-04 20:21:34'),
(3, 2, 'morija', 'Morija', 'Chomu', 'Jaipur', '20000', '100', '3600', NULL, NULL, NULL, 1, '2019-09-11 15:59:29', '2019-10-07 09:24:01'),
(4, 3, 'Chiraag Logistics', 'Manda', 'Khatushyam', 'Sikar', '20000', '100', '3600', 'RK Transports || Maharishi Transports', 'Muhana Mandi || Chommu Mandi', 'Bajara || Barley || Ground Nutt', 1, '2019-09-11 16:00:02', '2019-10-03 01:17:03'),
(5, 4, 'R K Warehouse', 'Manda', 'Khatushyam', 'Sikar', '16000', '100', '2880', NULL, NULL, NULL, 1, '2019-09-11 16:00:51', '2019-09-11 16:00:51'),
(6, 5, 'Maharshi Export', 'Palsana', 'Palsana', 'Sikar', '13000', '90', '2340', NULL, NULL, NULL, 1, '2019-09-11 16:06:47', '2019-10-03 01:17:44'),
(7, 6, 'Giriraj Dharan Industries', 'Ajeetgarh', 'Ajeetgarh', 'Sikar', '10000', '100', '1800', NULL, NULL, NULL, 1, '2019-09-11 16:07:17', '2019-10-03 01:17:31'),
(8, 7, 'National Industries', 'Reengas', 'Reengas', 'Sikar', '6000', '90', '1080', NULL, NULL, NULL, 1, '2019-09-11 16:17:37', '2019-10-03 01:17:57'),
(9, 8, 'Raka Tripathi', 'Jhunjhunu', 'Jhunjhunu', 'Jhunjhunu', '4500', '100', '810', NULL, NULL, NULL, 1, '2019-09-11 16:18:05', '2019-09-11 16:18:05'),
(10, 9, 'Agarwal Industries', 'Palsana', 'Palsana', 'Sikar', '4200', '90', '756', 'Nature Fresh Agro Industries || Agarwal Caters', 'Muhana Mandi', 'Bajra || Makka', 1, '2019-09-11 16:18:38', '2019-10-14 17:43:53'),
(11, 10, 'Shah Industries', 'Palsana', 'Palsana', 'Sikar', '4200', '90', '756', NULL, NULL, NULL, 1, '2019-09-11 16:19:19', '2019-09-11 16:19:19'),
(12, 11, 'Savita Devi', 'Rampura', 'Jaipur', 'Jaipur', '3000', '80', '540', NULL, NULL, NULL, 1, '2019-09-11 16:19:55', '2019-09-11 16:19:55'),
(13, 12, 'Nature Fresh Agro Industries', 'Muhana', 'Muhana', 'Jaipur', '20000', '150', '2000', NULL, NULL, NULL, 1, '2019-09-17 19:45:54', '2019-09-17 19:45:54'),
(14, 13, 'xyz', 'jaipur', 'rajasthan', 'jaipur', '25000', '17500', '1110', NULL, NULL, NULL, 1, '2019-10-14 17:42:53', '2019-10-14 17:42:53');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bank_master`
--
ALTER TABLE `bank_master`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `loan_max_value`
--
ALTER TABLE `loan_max_value`
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
-- Indexes for table `user_groups`
--
ALTER TABLE `user_groups`
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
-- Indexes for table `warehouse_enquirers`
--
ALTER TABLE `warehouse_enquirers`
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
-- AUTO_INCREMENT for table `bank_master`
--
ALTER TABLE `bank_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `buy_sells`
--
ALTER TABLE `buy_sells`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `buy_sell_conversations`
--
ALTER TABLE `buy_sell_conversations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `finances`
--
ALTER TABLE `finances`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `finance_responses`
--
ALTER TABLE `finance_responses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `inventories`
--
ALTER TABLE `inventories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `loan_max_value`
--
ALTER TABLE `loan_max_value`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `user_details`
--
ALTER TABLE `user_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `user_groups`
--
ALTER TABLE `user_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `warehouses`
--
ALTER TABLE `warehouses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `warehouse_enquirers`
--
ALTER TABLE `warehouse_enquirers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `warehouse_rent_rates`
--
ALTER TABLE `warehouse_rent_rates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
