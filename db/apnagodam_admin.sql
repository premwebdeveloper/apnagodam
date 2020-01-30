-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 30, 2020 at 07:25 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

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
  `loan_per_total_amount` varchar(191) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bank_master`
--

INSERT INTO `bank_master` (`id`, `bank_name`, `interest_rate`, `loan_pass_days`, `processing_fee`, `loan_per_total_amount`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Apnagodam', '10', '10', '1', '75', 1, '2019-10-08 01:00:17', '2019-12-10 13:32:51'),
(2, 'HDFC', '10', '10', '1', '85', 1, '2019-10-06 00:43:29', '2019-12-10 13:33:01'),
(3, 'SBI', '10', '10', '1', '75', 1, '2019-10-06 00:43:06', '2019-12-10 13:33:08'),
(4, 'ICICI', '10', '20', '1', '65', 1, '2019-10-14 17:24:11', '2019-12-10 13:33:16');

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
  `mandi_fees` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL COMMENT 'status 1 active bid and 2 for complete bid / deal done 3 for pdf send and payment accept',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `buy_sells`
--

INSERT INTO `buy_sells` (`id`, `buyer_id`, `seller_id`, `seller_cat_id`, `payment_ref_no`, `quantity`, `price`, `mandi_fees`, `status`, `created_at`, `updated_at`) VALUES
(8, 11, 3, 15, '122121212121', '25', '1760', NULL, 3, '2019-12-02 21:10:17', '2019-12-02 21:29:12'),
(9, 3, 11, 16, '515348', '25', '1890', NULL, 3, '2019-12-02 21:48:49', '2019-12-02 21:59:18'),
(10, 20, 21, 20, NULL, '30', '5100', NULL, 3, '2019-12-23 19:06:16', '2019-12-23 19:10:41'),
(11, 20, 21, 21, NULL, '30', '5100', NULL, 3, '2019-12-23 19:07:37', '2019-12-23 19:12:32'),
(12, 20, 21, 22, NULL, '30', '5100', NULL, 3, '2019-12-23 19:08:20', '2019-12-23 19:12:55'),
(15, 20, 21, 26, 'CHN 000030', '33', '5100', NULL, 3, '2019-12-24 23:03:25', '2020-01-09 17:21:50'),
(16, 20, 21, 27, NULL, '26', '5200', NULL, 3, '2019-12-24 23:03:52', '2019-12-24 23:13:38'),
(17, 20, 21, 30, NULL, '29', '5100', NULL, 3, '2019-12-26 21:41:11', '2019-12-26 21:43:12'),
(18, 20, 21, 31, NULL, '22', '5200', NULL, 3, '2019-12-26 21:41:29', '2019-12-26 21:43:43'),
(19, 11, 21, 21, NULL, '30.70', '2100', NULL, 2, '2020-01-23 09:08:08', '2020-01-23 10:50:09'),
(20, NULL, 3, 15, NULL, '15', NULL, NULL, 1, '2020-01-23 11:01:05', '2020-01-23 11:01:05');

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
(1, 19, 11, '2100', 1, '2020-01-23 09:08:08', '2020-01-23 09:55:05'),
(2, 20, 21, '1800', 1, '2020-01-23 11:01:05', '2020-01-23 11:01:05');

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
(3, 'Makka', 'Paid', '0', '0', '0.5', '0', '0', '0', '3e0fe9.png', 1, '2019-01-19 10:13:13', '2019-12-26 19:13:12'),
(8, 'Barley', 'Payable', '0', '0', '1.6', '0', '0', '0', 'a75d91.jpg', 1, '2019-10-08 15:05:56', '2019-10-08 15:05:56'),
(9, 'Makka', 'Payable', '0', '0', '0', '0', '0', '0', '447770.jpeg', 1, '2019-10-08 15:28:44', '2019-10-08 15:30:08'),
(10, 'Barley', 'Paid', '0', '0', '0', '0', '0', '0', '3568ca.png', 1, '2019-10-08 15:29:15', '2019-12-26 19:15:39'),
(11, 'Bajra', 'Payable', '0', '0', '0.5', '0', '0', '0', '1d43dc.jpg', 1, '2019-10-08 15:31:02', '2019-10-08 15:31:02'),
(12, 'Bajra', 'Paid', '0', '0', '0', '0', '0', '0', 'b90c29.png', 1, '2019-10-08 15:31:21', '2019-12-26 19:18:36'),
(13, 'Jvaar', 'Payable', '0', '0', '0.5', '0', '0', '0', '07d784.jpg', 1, '2019-10-08 15:33:50', '2019-10-08 15:33:50'),
(14, 'Jvaar', 'Paid', '0', '0', '0', '0', '0', '0', 'e7bcdb.png', 1, '2019-10-08 15:34:07', '2019-12-26 19:21:10'),
(15, 'Wheat', 'Payable', '0', '0', '1.6', '0', '0', '0', 'a349d1.jpg', 1, '2019-10-08 15:36:23', '2019-10-08 15:36:23'),
(16, 'Wheat', 'Paid', '0', '0', '0', '0', '0', '0', '3797d2.png', 1, '2019-10-08 15:36:39', '2019-12-26 19:23:26'),
(17, 'Gram', 'Payable', '0', '0', '1.6', '0', '0', '0', '46cab5.jpg', 1, '2019-10-08 15:38:54', '2019-10-08 15:38:54'),
(18, 'Mung', 'Payable', '0', '0', '1.6', '0', '0', '0', 'bcbf93.jpg', 1, '2019-10-08 15:42:25', '2019-10-08 15:42:25'),
(19, 'Mung', 'Paid', '0', '0', '0', '0', '0', '0', '9669d9.png', 1, '2019-10-08 15:42:46', '2019-12-26 19:25:35'),
(20, 'Moth', 'Payable', '0', '0', '1.6', '0', '0', '0', '3cf4e0.jpg', 1, '2019-10-08 15:45:25', '2019-10-08 15:45:25'),
(21, 'Moth', 'Paid', '0', '0', '0', '0', '0', '0', 'e7828e.png', 1, '2019-10-08 15:45:50', '2019-12-26 19:27:15'),
(22, 'Mustard', 'Payable', '0', '0', '1', '0', '0', '0', 'fe45a4.jpg', 1, '2019-10-08 15:47:03', '2019-10-08 15:47:03'),
(23, 'Mustard', 'Paid', '0', '0', '0', '0', '0', '0', '593939.png', 1, '2019-10-08 15:47:27', '2019-12-26 19:29:16'),
(24, 'Soybean', 'Payable', '0', '0', '1', '0', '0', '0', 'ea88da.jpg', 1, '2019-10-08 15:49:08', '2019-10-08 15:49:08'),
(25, 'Soybean', 'Paid', '0', '0', '0', '0', '0', '0', '8a96a7.png', 1, '2019-10-08 15:49:26', '2019-12-26 19:31:14'),
(26, 'Groundnut', 'Payable', '0', '0', '1', '0', '0', '0', 'f09473.png', 1, '2019-10-08 15:50:19', '2019-12-26 19:38:50'),
(27, 'Groundnut', 'Paid', '0', '0', '0', '0', '0', '0', '820e45.png', 1, '2019-10-08 15:50:57', '2019-12-26 19:36:45'),
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
(3, 'Ground nut', 'd642ee.jpg', '2019-01-18 19:55:28', '2019-01-18 19:55:28', 1),
(4, 'Guar', 'bf2ddd.jpg', '2019-01-18 19:55:50', '2019-01-18 19:55:50', 1),
(5, 'Chola', '43566a.jpg', '2019-01-18 19:56:03', '2019-01-18 19:56:03', 1);

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
  `description` text DEFAULT NULL,
  `image` text DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `facilitiy_master`
--

INSERT INTO `facilitiy_master` (`id`, `name`, `description`, `image`, `status`, `created_at`, `updated_at`) VALUES
(2, 'Dharam Kanta', 'Dharam Kanta', 'a78808.png', 1, '2019-09-28 01:33:55', '2019-09-28 01:33:55'),
(3, 'Fumigation', 'fumigation', '7dee41.png', 1, '2019-09-28 01:34:23', '2019-09-28 01:34:23'),
(4, 'CCTV Camera', 'CCTV Camera', 'b88e25.png', 1, '2019-09-28 01:34:48', '2019-09-28 01:34:48'),
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
(10, 10, NULL, NULL, NULL, 2, '2019-12-02 23:22:36', '2019-12-02 23:25:07'),
(11, 11, NULL, NULL, NULL, NULL, '2019-12-11 23:43:01', '2019-12-11 23:43:01');

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
  `sales_status` int(11) DEFAULT 1 COMMENT '1 For Primary 2 For Secondary Sales',
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `inventories`
--

INSERT INTO `inventories` (`id`, `user_id`, `warehouse_id`, `commodity`, `weight_bridge_no`, `truck_no`, `stack_no`, `lot_no`, `net_weight`, `type`, `quantity`, `sell_quantity`, `price`, `gate_pass_wr`, `quality_category`, `image`, `sales_status`, `status`, `created_at`, `updated_at`) VALUES
(15, 3, 2, 11, '5678', '1234', '12', '12', '20', NULL, '15', '15', '1500', '1234', 'A', NULL, 1, 1, '2019-12-02 20:39:31', '2020-01-22 09:32:10'),
(16, 11, 2, 12, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, '0', '1234', 'A', NULL, 2, 0, '2019-12-02 21:29:08', '2019-12-17 12:07:30'),
(17, 3, 2, 12, NULL, NULL, NULL, NULL, NULL, NULL, '25', NULL, '0', '1234', 'A', NULL, 2, 1, '2019-12-02 21:58:10', '2019-12-17 12:07:30'),
(18, 16, 3, 27, '96', 'rj19gc3832', '1', '1', NULL, NULL, '128', NULL, '0', '4940', 'A', '3a8d46.pdf', 1, 1, '2019-12-09 23:07:03', '2019-12-17 12:07:30'),
(19, 3, 5, 27, '1111', '123456', '1', '1', NULL, NULL, '150', NULL, '0', '1245', 'A', 'a6d739.pdf', 1, 1, '2019-12-11 23:37:36', '2019-12-17 12:07:30'),
(20, 21, 14, 26, '18', 'RJ07GB0116', 'NA', 'NA', NULL, NULL, '30', '30', '1890', '3767', 'A', '30fbba.pdf', 1, 1, '2019-12-23 18:46:42', '2020-01-23 10:55:55'),
(21, 21, 14, 26, '19', 'RJ07GC0584', 'NA', 'NA', NULL, NULL, '30.70', '30.70', '5000', '3768', 'A', 'e1774d.pdf', 1, 1, '2019-12-23 18:54:03', '2019-12-23 19:01:56'),
(22, 21, 14, 26, '20', 'RJ07GC3630', 'NA', 'NA', NULL, NULL, '30.70', '30.70', '5000', '3769', 'A', '950c1d.pdf', 1, 1, '2019-12-23 18:55:14', '2019-12-23 19:02:19'),
(23, 20, 14, 27, NULL, NULL, NULL, NULL, NULL, NULL, '30', NULL, '5100', '3770', 'A', '30fbba.pdf', 2, 1, '2019-12-23 19:10:37', '2019-12-23 20:03:19'),
(24, 20, 14, 27, NULL, NULL, NULL, NULL, NULL, NULL, '30', NULL, '5100', '3771', 'A', 'e1774d.pdf', 2, 1, '2019-12-23 19:12:29', '2019-12-23 19:12:29'),
(25, 20, 14, 27, NULL, NULL, NULL, NULL, NULL, NULL, '30', NULL, '5100', '3772', 'A', '950c1d.pdf', 2, 1, '2019-12-23 19:12:52', '2019-12-23 19:12:52'),
(26, 21, 14, 26, '23', 'RJ07GB0116', 'NA', 'NA', NULL, NULL, '33.30', '33', '5100', '3771A', 'A', 'f8341a.pdf', 1, 1, '2019-12-24 22:14:03', '2019-12-24 22:55:24'),
(27, 21, 14, 26, '24', 'RJ07GB4387', 'NA', 'NA', NULL, NULL, '26.20', '26', '5100', '3772A', 'A', '8fe0c2.pdf', 1, 1, '2019-12-24 22:21:50', '2019-12-24 22:55:50'),
(28, 20, 14, 27, NULL, NULL, NULL, NULL, NULL, NULL, '33', NULL, '5100', '3771AB', 'A', 'f8341a.pdf', 2, 1, '2019-12-24 23:12:58', '2019-12-24 23:12:58'),
(29, 20, 14, 27, NULL, NULL, NULL, NULL, NULL, NULL, '26', NULL, '5200', '3772AB', 'A', '8fe0c2.pdf', 2, 1, '2019-12-24 23:13:35', '2019-12-24 23:13:35'),
(30, 21, 14, 26, '26', 'RJ07GB4387', 'NA', 'NA', NULL, NULL, '29.4', '29', '5000', '3773', 'A', '199c8c.pdf', 1, 1, '2019-12-26 20:29:38', '2019-12-26 21:37:37'),
(31, 21, 14, 26, '29', 'RJ07GB4387', 'NA', 'NA', NULL, NULL, '22.10', '22', '5100', '3774', 'A', '87a19f.pdf', 1, 1, '2019-12-26 20:31:30', '2019-12-26 21:38:09'),
(32, 20, 14, 27, NULL, NULL, NULL, NULL, NULL, NULL, '29', NULL, '5100', '3773A', 'A', '199c8c.pdf', 2, 1, '2019-12-26 21:43:09', '2019-12-26 21:43:09'),
(33, 20, 14, 27, NULL, NULL, NULL, NULL, NULL, NULL, '22', NULL, '5200', '3774A', 'A', '87a19f.pdf', 2, 1, '2019-12-26 21:43:40', '2019-12-26 21:43:40');

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
  `mandi_tax_fees` varchar(25) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `phone` varchar(12) DEFAULT NULL,
  `bank_name` varchar(100) DEFAULT NULL,
  `bank_account_no` varchar(30) DEFAULT NULL,
  `branch_name` varchar(200) DEFAULT NULL,
  `branch_ifsc` varchar(20) DEFAULT NULL,
  `account_holder` varchar(200) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mandi_name`
--

INSERT INTO `mandi_name` (`id`, `mandi_name`, `mandi_tax_fees`, `email`, `phone`, `bank_name`, `bank_account_no`, `branch_name`, `branch_ifsc`, `account_holder`, `created_at`, `updated_at`, `status`) VALUES
(1, 'Sikar', '1.8', 'ravi@gmail.com', '9569569569', 'SBI', '74174174174', 'VDN', 'SBIN00314733', 'Apna Godam', '2020-01-16 15:07:11', '2020-01-16 15:08:15', 0),
(2, 'Jhunjhunu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-01-18 20:00:21', '2020-01-16 15:08:25', 0),
(3, 'Jaipur', '1', NULL, NULL, NULL, '132121212121', 'VND', 'SBI12345', 'Apna Godam', '2020-01-16 13:34:00', '2020-01-16 13:34:00', 1),
(4, 'Shrimadhopur', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-01-18 20:00:45', '2020-01-16 15:08:19', 0),
(5, 'Chomu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-01-18 20:00:55', '2020-01-16 15:08:22', 0),
(6, 'Chommu', '2.0', NULL, NULL, NULL, 'Apnagodam', 'VDN', 'SBIN00312211', '1234567891230', '2020-01-16 12:44:23', '2020-01-16 13:48:50', 0),
(7, 'Chommu', '11.7', NULL, NULL, NULL, '12345678968764', 'VDN', 'SBIn012', '1234567891230', '2020-01-16 13:45:16', '2020-01-16 13:48:46', 0),
(8, 'Vidhyadhar Nagar', '8.5', NULL, NULL, NULL, '84556465456', 'vdn', 'ICICI123465', 'Apngo', '2020-01-16 13:57:07', '2020-01-16 13:57:07', 1),
(9, 'vdn', '12', NULL, NULL, 'ICICI', '564654564564', 'VDN', 'FDG5D645DFS4G6', 'kjh', '2020-01-16 13:59:10', '2020-01-16 13:59:10', 1),
(10, 'lsdkjflksdj', '1.9', NULL, NULL, '<script>$*#&^&*#$^&*(sattdsds 5f4sdf a</script>', '4678645', 'fgcjdjfg', 'DJHDFG65456DSF4G', 'dfsgdfgdf', '2020-01-16 14:44:36', '2020-01-16 14:44:36', 1),
(11, 'VDN', '12', 'vdn@gmail.com', '9639639630', 'icici', '85698569852', 'vdn', 'DSFSF21SD3F1', 'apnago', '2020-01-16 15:07:48', '2020-01-16 15:07:55', 0);

-- --------------------------------------------------------

--
-- Table structure for table `mandi_samitis`
--

CREATE TABLE `mandi_samitis` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `district` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mandi_samitis`
--

INSERT INTO `mandi_samitis` (`id`, `name`, `address`, `district`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Krishi Upaj Mandi Samiti, Chomu', 'Chomu', 'Jaipur', 1, '2019-12-10 00:00:00', '2020-01-16 15:35:41'),
(2, 'Krishi Upaj Mandi Samiti, Sikar', 'Sikar', 'Sikar', 1, '2019-12-10 00:00:00', '2020-01-16 15:36:03'),
(3, 'Krishi Upaj Mandi Samiti, Rajaldesar', 'Rajaldesar Churu', 'Churu', 1, '2019-12-23 00:00:00', '2020-01-16 15:35:56');

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
(1, 'Admin', '2018-09-06 08:27:26', '2018-09-06 08:27:26'),
(2, 'User', '2018-09-06 08:27:26', '2018-09-06 08:27:26'),
(3, 'Account', '2020-01-21 06:32:00', '2020-01-21 06:32:00'),
(4, 'Government', '2019-01-05 13:17:45', '2019-01-05 13:17:45'),
(5, 'Inventory', '2019-01-13 07:25:38', '2019-01-13 07:25:38'),
(6, 'Sales', '2019-01-13 07:29:03', '2019-01-13 07:29:03');

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
-- Table structure for table `states`
--

CREATE TABLE `states` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `country_id` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`id`, `name`, `country_id`) VALUES
(1, 'Andaman and Nicobar', 101),
(2, 'Andhra Pradesh', 101),
(3, 'Arunachal Pradesh', 101),
(4, 'Assam', 101),
(5, 'Bihar', 101),
(6, 'Chandigarh', 101),
(7, 'Chhattisgarh', 101),
(8, 'Dadra and Nagar Haveli', 101),
(9, 'Daman and Diu', 101),
(10, 'Delhi', 101),
(11, 'Goa', 101),
(12, 'Gujarat', 101),
(13, 'Haryana', 101),
(14, 'Himachal Pradesh', 101),
(15, 'Jammu and Kashmir', 101),
(16, 'Jharkhand', 101),
(17, 'Karnataka', 101),
(18, 'Kerala', 101),
(19, 'Lakshdweep', 101),
(20, 'Madhya Pradesh', 101),
(21, 'Maharashtra', 101),
(22, 'Manipur', 101),
(23, 'Meghalaya', 101),
(24, 'Mizoram', 101),
(25, 'Nagaland', 101),
(26, 'Odisha', 101),
(27, 'Puducherry', 101),
(28, 'Punjab', 101),
(29, 'Rajasthan', 101),
(30, 'Sikkim', 101),
(31, 'Tamil Nadu', 101),
(32, 'Tripura', 101),
(33, 'Uttar Pradesh', 101),
(34, 'Uttarakhand', 101),
(35, 'West Bengal', 101),
(36, 'Telangana', 101);

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
  `terminal_id` int(11) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` datetime NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `today_prices`
--

INSERT INTO `today_prices` (`id`, `modal`, `max`, `min`, `commodity_id`, `terminal_id`, `created_at`, `updated_at`, `status`) VALUES
(1, '1900', '1905', '1891', 1, 1, '2019-01-21', '2019-08-21 18:20:22', 1),
(2, '1885', '1900', '1860', 1, 2, '2019-01-21', '2019-08-21 18:20:48', 1),
(3, '4500', '5000', '4000', 3, 3, '2019-01-21', '2019-10-07 09:20:34', 1),
(4, '4450', '4600', '4400', 4, 4, '2019-01-21', '2019-01-21 09:39:54', 1),
(5, '1650', '1700', '1600', 7, 5, '2019-01-21', '2019-10-07 09:21:31', 1),
(6, '1925', '1950', '1900', 1, 5, '2019-01-21', '2019-08-21 18:21:34', 1),
(7, '4500', '4600', '4400', 4, 3, '2019-01-21', '2019-01-21 09:42:22', 1),
(8, '3750', '3800', '3650', 5, 2, '2019-01-21', '2019-10-07 09:20:17', 1),
(9, '4500', '5000', '4000', 3, 4, '2019-01-21', '2020-01-16 16:57:29', 1),
(10, '3700', '3800', '3600', 5, 3, '2019-01-21', '2019-10-07 09:20:52', 1),
(11, '4200', '4300', '4100', 27, 3, '2019-12-10', '2019-12-10 13:33:49', 1),
(12, '4220', '4000', '3500', 27, 5, '2019-12-11', '2019-12-11 16:42:20', 1);

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
(1, 'Admin', '', 'admin@admin.com', '$2y$10$JCJ6HuLpoDYa0obD88w0buwVOYjjK5/M59CxfPM/UDqtJHLb2uK5O', '9314142089', '752363', NULL, 'f3jnizhrJvgezJiH6okg8ZAvPjAfsi1NefxCbySM6ZY9Nc9n1Bu45q9gJBGy', 1, '2018-09-01 08:17:09', '2020-01-11 19:16:06'),
(2, 'Super Admin', '', 'ravikumawat4949@gmail.com', '$2y$10$JCJ6HuLpoDYa0obD88w0buwVOYjjK5/M59CxfPM/UDqtJHLb2uK5O', '9549494175', NULL, NULL, '5koTmNKgatcPMc3sefsNXUkluj1TNcnHeXTBnO7Fol5rGBamojRDIYW0jgYZ', 1, '2018-09-01 08:17:09', '2020-01-21 06:07:11'),
(3, 'Pooja', 'Pooja', NULL, '$2y$10$Y6ki2B/9P/SbKQAWklCftulY29KNFX4a1ly8JMGD47TGPNOCbkS8C', '8955895493', '691489', '', 'KMvzJutYc0144XS1FzfY7drgnPkqi7rL7ii4QgzNcYH94l6JJzAmoD465bc1', 1, '2019-10-15 19:11:27', '2020-01-21 11:12:48'),
(11, 'Ravi Kumawat', NULL, NULL, '$2y$10$8/BDfmPxgHRdxPHE7aYWS.N1V2hn59jd/C4eO16..2jYAqX9NYKX2', '7014432414', NULL, NULL, 'k4cFaj4FxIMweUi8L2uSsDgQYG2RIWFDf9OIinakfCAsyldvZoH2bRuGG22C', 1, '2019-11-28 07:34:48', '2020-01-29 07:24:14'),
(14, 'Rekha Agarwal Test', NULL, NULL, '$2y$10$8vuzYWl5TfXqW4o9xri0hesMP8/p7uQlhDA.DaESYp3i4PtLrSoVe', '8005731068', NULL, NULL, NULL, 1, '2019-12-02 20:26:41', '2019-12-02 20:27:12'),
(15, 'SANJAY KATARIA', NULL, NULL, '$2y$10$iV5WH7fQ5RMEmrRhT4XCuOBpYA.vzzLon1gbpWH02GPWhdFgK8oze', '9414077394', NULL, NULL, 'yhEF1mj2C2qRpqTc895P0ALXdWySTZE7cKKBiy61n7MCr7qfLUCnO1wNS68B', 1, '2019-12-09 21:54:39', '2019-12-11 23:29:19'),
(16, 'POONIA TRADING COMPANY', NULL, NULL, '$2y$10$57yKHrTA/mf2KDbHL4Ukd.RmKtZGrBpRPrJeMmm4YvqqQpELmZ35.', '9414595409', NULL, NULL, 'In5s5ShMT5zaWANIJ6gjfm4LUSXlLsK37nE4ddjdesLvZMmAMhk0PVHi1psk', 1, '2019-12-09 23:04:39', '2019-12-10 21:42:27'),
(17, 'Vishal Kashyap', NULL, NULL, '$2y$10$wl1qCUQ.DViexEfaxWqNt.IMfHGLIyLor9nCZBOtO2kGuW0WRM7TO', '7631450000', NULL, '585301', NULL, 0, '2019-12-12 19:36:47', '2019-12-12 19:36:47'),
(18, 'Vishal Kashyap', NULL, NULL, '$2y$10$ZodbfShTQWQX6vll0fjQUOYvkWtpqWnG0o15GqhHiy7Lopw4NPtJO', '9587391444', NULL, NULL, 'E3Lnj6kwSx2bEuddLlTfBNdlN7buSsm3fsrQlsOH4q8L6B1toYkQEQfz5Tdk', 1, '2019-12-16 20:32:24', '2020-01-24 07:24:31'),
(19, 'Sanjay Goyal', NULL, NULL, '$2y$10$KT9ec2HP/0K8kJgM0tZyIePC0kRzeWIexQmCJrxm7hG1MHE/4CJTO', '9887694140', NULL, NULL, NULL, 1, '2019-12-21 03:14:31', '2019-12-21 03:14:31'),
(20, 'Suleman@clpl', NULL, NULL, '$2y$10$EBDNUGDmDi0U3wxL9LNYiuynGcOnYZ3iFDcaqCN1PBO.ez459hpZi', '9587745999', NULL, NULL, 'eBjrRMqjBotpEM35akvGvVQqA9LPJy2jzv12PI8DKjgohf0JrhnPUg2NLOp1', 1, '2019-12-23 18:10:40', '2019-12-26 21:40:56'),
(21, 'Pankaj Kanwar', NULL, NULL, '$2y$10$PxAwcapIIptzyPuCscKxDu1yLxnhKI5baaf54uB85sa3rIBcT30lG', '9950821555', '860508', NULL, 'XXBHTFz7TF0xgxnooIJixAZ7oERpSnIqyJKn27ZBqXJmlP31cfWdIajhYRhb', 1, '2019-12-23 18:24:17', '2020-01-23 10:10:07'),
(22, 'Surendra Kanwar', NULL, NULL, '$2y$10$7CMjKnVBy8adfbZAgdtgbufb73.mdoi/QfqHsLoQsRA1bU8Ns1Khu', '9672055666', NULL, NULL, NULL, 1, '2019-12-23 18:38:27', '2019-12-23 18:38:51'),
(23, 'Bhanwar Kanwar', NULL, NULL, '$2y$10$abtCGrDsOA48sMNCKut5W.6iT3pjmKc9W5GLT1ecOdUoGGHD.W3Dy', '9414143098', NULL, NULL, NULL, 1, '2019-12-23 18:42:28', '2019-12-23 18:48:15'),
(24, 'Virendra Kumar Yadav', NULL, NULL, '$2y$10$3A12BadYVJYSWhSjVMemVe4r5v2rlnqTFXlXOwuwY.3regSFp.iSa', '8953666324', NULL, NULL, NULL, 1, '2020-01-13 21:08:21', '2020-01-13 21:08:21'),
(31, 'Kishan Lal', NULL, 'kishan@gmail.com', '$2y$10$xwHbMPwcApEMM5AsSMuYYu11PLXOlqnToV/kSWE3WKidRXWgkTPCe', '8560031312', NULL, NULL, 'Z8Myl2vOlfMkE3jSwQBvjFmOtYIxkqUC4OVZBZbJzBQMsWDEtXukJlaecEcO', 1, '2020-01-20 07:27:26', '2020-01-20 07:33:28'),
(32, 'Prem', NULL, 'ravi@gmail.com', '$2y$10$dS2b9Yae2MpWtBidrFQha.vsh7TfhoGwn7Lx6WQwvqF.hYtOW6PTm', '7000005000', NULL, NULL, NULL, 1, '2020-01-20 08:06:30', '2020-01-20 08:06:47'),
(33, 'Naresh Yadav', NULL, 'dam.regulation@rajasthan.gov.in', '$2y$10$iJwdNGhtO7nGJw2cZsMjeOPHPGMwCoEPhsCDwenBaxu5T3ZaSdJ/C', '9413145945', NULL, NULL, 'BxNUtWoRZNg6gaoWnF6ndxop2WNf12nuhPR1rCpZkJKbyY2KgN8diMpkaeDX', 1, '2020-01-27 06:14:55', '2020-01-27 06:22:12'),
(34, 'Ravi', NULL, 'ram@gmail.com', '$2y$10$L4r2GIx8sChdN3WpVkpQUuJUziRxBxUwdvSeOWNfuUed2l2csXJyO', '1234567891', NULL, '709036', NULL, 0, '2020-01-29 08:53:40', '2020-01-29 08:53:40'),
(35, 'Ravi', NULL, 'cxv@f.fg', '$2y$10$bXXinK8t5K113xwPGZ728u5AT6L5is9TgYhtx5D8psR1h2LCH6V4u', '9696969696', NULL, '626180', NULL, 0, '2020-01-29 09:06:24', '2020-01-29 09:06:24');

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_type` int(11) DEFAULT NULL COMMENT '1 for Farmer, 2 for Trader',
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
  `profile_image` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `aadhar_image` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cheque_image` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `firm_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `area_vilage` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pincode` varchar(8) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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

INSERT INTO `user_details` (`id`, `user_id`, `user_type`, `fname`, `lname`, `email`, `phone`, `referral_code`, `referral_by`, `father_name`, `category`, `gst_number`, `khasra_no`, `village`, `tehsil`, `district`, `image`, `power`, `aadhar_no`, `bank_name`, `bank_branch`, `bank_acc_no`, `bank_ifsc_code`, `profile_image`, `aadhar_image`, `cheque_image`, `firm_name`, `address`, `area_vilage`, `city`, `state`, `pincode`, `mandi_license`, `latitude`, `longitude`, `transfer_amount`, `status`, `created_at`, `updated_at`) VALUES
(7, 3, NULL, 'pooja', 'Pooja', '', '8955895493', 'R772ED', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'user.png', '9211250', '123445694789', NULL, NULL, NULL, NULL, NULL, '4a5960.png', 'dd5f7f.png', NULL, 'p.no 16 sector 9, opposite vidhyadhar nagar jaipur', 'Vidhyadhar Nagar', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2019-10-15 00:06:00', '2019-12-02 21:59:18'),
(10, 11, NULL, 'Ravi Kumawat', NULL, NULL, '7014432414', 'RA710B', NULL, NULL, NULL, 'GSTIN1215254589653254', NULL, NULL, NULL, NULL, '6df608.png', '261000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Hastag Soft', 'F-125, Unnati Tower, Central Spine,, Vidhyadhar Nagar Jaipur', 'Murlipura', NULL, NULL, NULL, 'REF./157411', NULL, NULL, NULL, 1, '2019-11-28 07:34:48', '2020-01-24 09:46:28'),
(13, 14, NULL, 'Rekha Agarwal Test', NULL, NULL, '8005731068', 'RDA384', NULL, 'Girdhari Lal', NULL, NULL, NULL, 'Jaipur', NULL, 'Jaipur', 'user.png', '1000000', '963852741012', 'SBI', 'VDN', '963963963963', 'SBIN0031211', NULL, '70e1f2.jpg', '334ced.jpg', NULL, 'Vidhyadhar Nagar, Jaipur', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2019-12-02 20:26:40', '2019-12-02 20:27:04'),
(14, 15, NULL, 'SANJAY KATARIA', NULL, NULL, '9414077394', 'R26802', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'user.png', '600000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SWASTIK OIL INDUSTRIES', 'NIWAI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2019-12-09 21:54:39', '2019-12-10 20:26:57'),
(15, 16, NULL, 'POONIA TRADING COMPANY', NULL, NULL, '9414595409', 'RF39A1', NULL, 'BHADARRAM', NULL, NULL, NULL, 'sardarshahar', NULL, 'sardarshahar', 'user.png', '2', '362841676438', 'bank of baroda', NULL, NULL, '12160400000630', NULL, 'd4ac1a.jpeg', 'ed54d2.jpeg', NULL, 'Shop no 14 krshi upaj mandi sardrshahar', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2019-12-09 23:04:39', '2019-12-10 18:38:26'),
(16, 17, 1, 'Vishal Kashyap', NULL, NULL, '7631450000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'user.png', '1', '51548252555', NULL, NULL, NULL, NULL, NULL, 'c97cd5.jpg', '0ae9b9.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2019-12-12 19:36:47', '2019-12-12 19:36:47'),
(17, 18, 1, 'Vishal Kashyap', NULL, NULL, '9587391444', 'RA6BCC', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'user.png', '1', '525522222213', NULL, NULL, NULL, NULL, NULL, '8f3b85.jpg', '6af58b.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2019-12-16 20:32:24', '2019-12-16 20:32:45'),
(18, 19, NULL, 'Sanjay Goyal', NULL, NULL, '9887694140', NULL, NULL, 'shankar Lal Goyal', NULL, NULL, NULL, 'kotputli', NULL, 'Jaipur', NULL, '1', '322165922621', 'yes bank', 'kotputli', '077369700000057', 'yesb0000773', '5046e3b.jpg', 'c213e709.jpg', '60059ff7.jpg', NULL, 'a/5 new Aanaj Mandi', NULL, NULL, NULL, NULL, NULL, '27.7078708', '76.1986146', '50', 1, '2019-12-20 07:00:00', '2019-12-20 07:00:00'),
(19, 20, NULL, 'Suleman@clpl', NULL, NULL, '9587745999', 'RE82CF', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'user.png', '87700', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'suleman@CLPL', 'Jaipur', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2019-12-23 18:10:40', '2019-12-26 21:43:43'),
(20, 21, NULL, 'Pankaj Kanwar', NULL, NULL, '9950821555', 'RE3275', NULL, 'Girwar Singh', NULL, NULL, NULL, NULL, NULL, 'Bikaner', 'user.png', '100000', '713102649583', 'HDFC Bank', 'Rani Bazar Bikaner', '50200021056133', 'HDFC0000645', NULL, '47e2e1.jpg', '3e44ed.jpg', NULL, 'Near Hanuman Mandir, FCI Godam Road, Subhashpura', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2019-12-23 18:24:17', '2019-12-23 18:24:53'),
(21, 22, NULL, 'Surendra Kanwar', NULL, NULL, '9672055666', 'R98C8D', NULL, 'Chandan Singh', NULL, NULL, NULL, NULL, NULL, 'Bikaner', 'user.png', '1', '221942518975', 'HDFC Bank', 'Rani Bazar Bikaner', '50200021061630', 'HDFC0000645', NULL, '471b7b.jpg', '99eb00.jpg', NULL, 'Near Hanuman Mandir, FCI Godam Road, Subhashpura', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2019-12-23 18:38:27', '2019-12-23 18:38:51'),
(22, 23, NULL, 'Bhanwar Kanwar', NULL, NULL, '9414143098', 'R1BAE5', NULL, 'Narayan Singh', NULL, NULL, NULL, NULL, NULL, 'Bikaner', 'user.png', '1', '499274799224', 'HDFC Bank', 'Rani Bazar Bikaner', '50200032179361', 'HDFC0000645', NULL, '0317fa.jpg', 'e1bebd.jpg', NULL, 'Near Hanuman Mandir, FCI Godam Road, Subhashpura', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2019-12-23 18:42:28', '2019-12-23 18:48:15'),
(23, 24, NULL, 'Virendra Kumar Yadav', NULL, NULL, '8953666324', NULL, NULL, 'Khedan Yadav', NULL, NULL, NULL, 'Maroofpur', NULL, 'Chandauli', NULL, '1', '696785972212', 'Union Bank Of India', 'Maroofpur', '488302011004824', 'UBIN0548839', '4b46200d.jpg', '576bd49d.jpg', '2a88ef10.jpg', NULL, 'Village+Post-Maroofpur', NULL, NULL, NULL, NULL, NULL, '25.4988834', '83.2088926', '50', 1, '2020-01-13 07:00:00', '2020-01-13 07:00:00'),
(28, 31, NULL, 'Kishan Lal', NULL, 'kishan@gmail.com', '8560031312', 'R2F0BE', NULL, 'Mohan Lal', NULL, NULL, NULL, NULL, NULL, NULL, 'user.png', '1', '123456789852', NULL, 'Kuchaman', '61140032522', 'SBIN003122331', NULL, '51ec7d.jpg', '8b8855.jpg', NULL, 'Haritnagr Khariya', NULL, 'Nagaur', 'Rajasthan', '302039', NULL, NULL, NULL, NULL, 1, '2020-01-20 07:27:26', '2020-01-20 07:29:37'),
(29, 32, NULL, 'Prem', NULL, 'ravi@gmail.com', '7000005000', 'R8350A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'user.png', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Hastag', 'F-125', NULL, 'Jaipur', 'Rajasthan', '302039', NULL, NULL, NULL, NULL, 1, '2020-01-20 08:06:30', '2020-01-20 08:06:47'),
(30, 33, NULL, 'Naresh Yadav', NULL, 'dam.regulation@rajasthan.gov.in', '9413145945', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, 'user.png', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2020-01-27 06:14:55', '2020-01-27 06:15:32'),
(31, 34, 1, 'Ravi', NULL, 'ram@gmail.com', '1234567891', NULL, NULL, NULL, NULL, '456456465464', NULL, NULL, NULL, NULL, 'user.png', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Hastag', 'F-125, Cewntal', 'kjlh', 'Jaipur', 'Rajasthan', '302039', '56465654', NULL, NULL, NULL, 0, '2020-01-29 08:53:40', '2020-01-29 08:53:40'),
(32, 35, 1, 'Ravi', NULL, 'cxv@f.fg', '9696969696', NULL, NULL, 'Gordhan Lal', NULL, NULL, NULL, NULL, NULL, NULL, 'user.png', '1', '456123123456', NULL, 'VDN', '61140083607', 'SBIN0031733', NULL, 'fd92eb.png', '0387c1.png', NULL, 'fdgsfdgfdsg', NULL, NULL, 'Rajasthan', '302039', NULL, NULL, NULL, NULL, 0, '2020-01-29 09:06:24', '2020-01-29 09:06:24');

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
(1, 'AG96883', '[\"3\",\"11\"]', 1, '2019-12-02 15:50:56', '2019-12-02 15:50:56'),
(2, 'AG549114', '[\"14\",\"15\",\"16\"]', 1, '2020-01-18 16:14:34', '2020-01-18 16:14:34');

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
(16, 14, 2, '2019-12-02 20:26:40', '2019-12-02 20:26:40'),
(17, 15, 2, '2019-12-09 21:54:39', '2019-12-09 21:54:39'),
(18, 16, 2, '2019-12-09 23:04:39', '2019-12-09 23:04:39'),
(19, 17, 2, '2019-12-12 19:36:47', '2019-12-12 19:36:47'),
(20, 18, 2, '2019-12-16 20:32:24', '2019-12-16 20:32:24'),
(21, 19, 5, '2019-12-21 03:16:31', '2019-12-21 03:16:31'),
(22, 20, 2, '2019-12-23 18:10:40', '2019-12-23 18:10:40'),
(23, 21, 2, '2019-12-23 18:24:17', '2019-12-23 18:24:17'),
(24, 22, 2, '2019-12-23 18:38:27', '2019-12-23 18:38:27'),
(25, 23, 2, '2019-12-23 18:42:28', '2019-12-23 18:42:28'),
(26, 24, 5, '2020-01-13 21:08:48', '2020-01-13 21:08:48'),
(27, 25, 2, '2020-01-18 11:04:11', '2020-01-18 11:04:11'),
(28, 26, 2, '2020-01-20 06:00:31', '2020-01-20 06:00:31'),
(29, 27, 2, '2020-01-20 06:04:23', '2020-01-20 06:04:23'),
(30, 28, 2, '2020-01-20 06:22:30', '2020-01-20 06:22:30'),
(31, 29, 2, '2020-01-20 07:23:01', '2020-01-20 07:23:01'),
(32, 30, 2, '2020-01-20 07:24:30', '2020-01-20 07:24:30'),
(33, 31, 2, '2020-01-20 07:27:26', '2020-01-20 07:27:26'),
(34, 32, 2, '2020-01-20 08:06:30', '2020-01-20 08:06:30'),
(35, 33, 4, '2020-01-27 06:14:55', '2020-01-27 06:14:55'),
(36, 34, 2, '2020-01-29 08:53:40', '2020-01-29 08:53:40'),
(37, 35, 2, '2020-01-29 09:06:24', '2020-01-29 09:06:24');

-- --------------------------------------------------------

--
-- Table structure for table `warehouses`
--

CREATE TABLE `warehouses` (
  `id` int(10) UNSIGNED NOT NULL,
  `mandi_samiti_id` int(11) NOT NULL COMMENT 'mandi samiti id',
  `warehouse_code` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `facility_ids` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_ids` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `warehouses`
--

INSERT INTO `warehouses` (`id`, `mandi_samiti_id`, `warehouse_code`, `name`, `facility_ids`, `bank_ids`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'TL001', 'Greenwings Innovative', '[\"2\",\"4\",\"5\"]', NULL, '0e3da0.jpg', 1, '2019-01-18 19:52:09', '2019-10-04 20:21:34'),
(2, 1, 'TL002', 'Sharda Devi', '[\"2\",\"3\",\"4\"]', 'null', NULL, 1, '2019-01-18 19:52:31', '2019-12-10 13:28:45'),
(3, 2, 'TL003', 'Chiraag Logistics', '[\"2\",\"4\",\"5\"]', 'null', 'f454a1.jpg', 1, '2019-01-18 19:53:02', '2019-12-10 13:36:50'),
(4, 1, 'TL004', 'R K Warehouse', '[\"2\",\"3\",\"4\"]', NULL, NULL, 1, '2019-01-18 19:53:39', '2019-01-18 19:53:39'),
(5, 1, 'TL005', 'Maharshi Export', '[\"2\",\"4\",\"5\"]', NULL, '198162.jpg', 1, '2019-01-18 19:54:01', '2019-10-03 01:17:44'),
(6, 1, 'TL006', 'Giriraj Dharan Industries', '[\"4\",\"5\"]', NULL, '54d544.jpg', 1, '2019-04-06 16:13:54', '2019-10-03 01:17:31'),
(7, 1, 'TL007', 'National Industries', '[\"2\",\"3\",\"5\"]', NULL, 'd0c70b.jpg', 1, '2019-04-17 16:45:47', '2019-10-03 01:17:57'),
(8, 1, 'TL008', 'Raka Tripathi', '[\"2\",\"3\",\"5\"]', NULL, NULL, 1, '2019-04-17 16:45:47', '2019-04-17 16:45:47'),
(9, 1, 'TL009', 'Agarwal Industries', '[\"2\",\"3\",\"4\",\"5\",\"7\"]', '[\"1\",\"2\",\"4\"]', '2ea85b.jpg', 1, '2019-01-18 19:53:02', '2019-10-14 17:43:53'),
(10, 1, 'TL010', 'Shah Industries', '[\"2\",\"4\",\"5\"]', NULL, NULL, 1, '2019-04-06 16:13:54', '2019-04-06 16:13:54'),
(11, 1, 'TL011', 'Savita Devi', '[\"2\",\"4\",\"5\"]', NULL, NULL, 1, '2019-01-18 19:54:01', '2019-01-18 19:54:01'),
(12, 1, 'TL012', 'Nature Fresh Agro Industries', '[\"4\",\"5\"]', NULL, NULL, 1, '2019-01-18 19:54:01', '2019-01-18 19:54:01'),
(13, 1, 'TL013', 'abc', 'null', 'null', '6752da.png', 2, '2019-10-14 17:42:53', '2019-10-14 17:43:13'),
(14, 3, 'TL014', 'Greentech Mega Food Park Ltd.\r\nLachharsar', '[\"2\",\"3\",\"4\",\"5\",\"7\"]', '[\"1\",\"2\",\"3\",\"4\"]', '3de3cd.jpg', 1, '2019-12-23 11:22:40', '2019-12-23 11:22:40');

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
  `status` tinyint(4) DEFAULT 0,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `warehouse_enquirers`
--

INSERT INTO `warehouse_enquirers` (`id`, `warehouse_id`, `commodity`, `quantity`, `mobile`, `commitment`, `status`, `created_at`, `updated_at`) VALUES
(1, 12, '3', '1', '7062070323', '1', 1, '2019-12-17 01:10:04', '2019-12-17 01:10:04'),
(2, 1, '26', '56', '7631450000', '3', 1, '2019-12-24 17:16:24', '2019-12-24 17:16:24'),
(3, 6, '3', '60', '9879879870', '3', 1, '2019-12-31 14:04:41', '2019-12-31 14:04:41'),
(4, 6, '18', '5000', '24569874512', '5', 1, '2020-01-10 22:40:50', '2020-01-10 22:40:50');

-- --------------------------------------------------------

--
-- Table structure for table `warehouse_rent_rates`
--

CREATE TABLE `warehouse_rent_rates` (
  `id` int(11) NOT NULL,
  `warehouse_id` int(11) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `location` varchar(100) DEFAULT NULL,
  `area` varchar(100) DEFAULT NULL,
  `district` varchar(100) DEFAULT NULL,
  `area_sqr_ft` varchar(10) DEFAULT NULL,
  `rent_per_month` varchar(10) DEFAULT NULL,
  `capacity_in_mt` varchar(10) DEFAULT NULL,
  `nearby_transporter_info` text DEFAULT NULL,
  `nearby_mandi_info` text DEFAULT NULL,
  `nearby_crop_info` text DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `warehouse_rent_rates`
--

INSERT INTO `warehouse_rent_rates` (`id`, `warehouse_id`, `address`, `location`, `area`, `district`, `area_sqr_ft`, `rent_per_month`, `capacity_in_mt`, `nearby_transporter_info`, `nearby_mandi_info`, `nearby_crop_info`, `status`, `created_at`, `updated_at`) VALUES
(2, 1, 'Greenwings Innovative', 'Keshwana', 'Kotputli', 'Jaipur', '42000', '94', '7560', NULL, NULL, NULL, 1, '2019-09-11 15:58:52', '2019-10-04 20:21:34'),
(3, 2, 'morija', 'Morija', 'Chomu', 'Jaipur', '20000', '100', '3600', NULL, NULL, NULL, 1, '2019-09-11 15:59:29', '2019-12-10 13:28:45'),
(4, 3, 'Chiraag Logistics', 'Manda', 'Khatushyam', 'Sikar', '20000', '100', '3600', 'RK Transports || Maharishi Transports', 'Muhana Mandi || Chommu Mandi', 'Bajara || Barley || Ground Nutt', 1, '2019-09-11 16:00:02', '2019-12-10 13:36:50'),
(5, 4, 'R K Warehouse', 'Manda', 'Khatushyam', 'Sikar', '16000', '100', '2880', NULL, NULL, NULL, 1, '2019-09-11 16:00:51', '2019-09-11 16:00:51'),
(6, 5, 'Maharshi Export', 'Palsana', 'Palsana', 'Sikar', '13000', '90', '2340', NULL, NULL, NULL, 1, '2019-09-11 16:06:47', '2019-10-03 01:17:44'),
(7, 6, 'Giriraj Dharan Industries', 'Ajeetgarh', 'Ajeetgarh', 'Sikar', '10000', '100', '1800', NULL, NULL, NULL, 1, '2019-09-11 16:07:17', '2019-10-03 01:17:31'),
(8, 7, 'National Industries', 'Reengas', 'Reengas', 'Sikar', '6000', '90', '1080', NULL, NULL, NULL, 1, '2019-09-11 16:17:37', '2019-10-03 01:17:57'),
(9, 8, 'Raka Tripathi', 'Jhunjhunu', 'Jhunjhunu', 'Jhunjhunu', '4500', '100', '810', NULL, NULL, NULL, 1, '2019-09-11 16:18:05', '2019-09-11 16:18:05'),
(10, 9, 'Agarwal Industries', 'Palsana', 'Palsana', 'Sikar', '4200', '90', '756', 'Nature Fresh Agro Industries || Agarwal Caters', 'Muhana Mandi', 'Bajra || Makka', 1, '2019-09-11 16:18:38', '2019-10-14 17:43:53'),
(11, 10, 'Shah Industries', 'Palsana', 'Palsana', 'Sikar', '4200', '90', '756', NULL, NULL, NULL, 1, '2019-09-11 16:19:19', '2019-09-11 16:19:19'),
(12, 11, 'Savita Devi', 'Rampura', 'Jaipur', 'Jaipur', '3000', '80', '540', NULL, NULL, NULL, 1, '2019-09-11 16:19:55', '2019-09-11 16:19:55'),
(13, 12, 'Nature Fresh Agro Industries', 'Muhana', 'Muhana', 'Jaipur', '20000', '150', '2000', NULL, NULL, NULL, 1, '2019-09-17 19:45:54', '2019-09-17 19:45:54'),
(14, 13, 'xyz', 'jaipur', 'rajasthan', 'jaipur', '25000', '17500', '1110', NULL, NULL, NULL, 1, '2019-10-14 17:42:53', '2019-10-14 17:42:53'),
(15, 14, 'lachhasar rajaldesar', 'Jaipur', '1466 meter', 'Churu', '15780', '130', '4000', NULL, NULL, NULL, 1, '2019-12-23 11:22:40', '2019-12-23 11:22:40');

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
-- Indexes for table `mandi_name`
--
ALTER TABLE `mandi_name`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mandi_samitis`
--
ALTER TABLE `mandi_samitis`
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
-- Indexes for table `states`
--
ALTER TABLE `states`
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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `buy_sell_conversations`
--
ALTER TABLE `buy_sell_conversations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `finance_responses`
--
ALTER TABLE `finance_responses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `inventories`
--
ALTER TABLE `inventories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `mandi_name`
--
ALTER TABLE `mandi_name`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `mandi_samitis`
--
ALTER TABLE `mandi_samitis`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
-- AUTO_INCREMENT for table `states`
--
ALTER TABLE `states`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `today_prices`
--
ALTER TABLE `today_prices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `user_details`
--
ALTER TABLE `user_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `user_groups`
--
ALTER TABLE `user_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `warehouses`
--
ALTER TABLE `warehouses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `warehouse_enquirers`
--
ALTER TABLE `warehouse_enquirers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `warehouse_rent_rates`
--
ALTER TABLE `warehouse_rent_rates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
