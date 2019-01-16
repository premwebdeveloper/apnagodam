-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 16, 2019 at 03:26 PM
-- Server version: 10.1.29-MariaDB
-- PHP Version: 7.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `apnagodam`
--

-- --------------------------------------------------------

--
-- Table structure for table `buy_sells`
--

CREATE TABLE `buy_sells` (
  `id` int(10) UNSIGNED NOT NULL,
  `buyer_id` int(11) NOT NULL,
  `seller_id` int(11) NOT NULL,
  `seller_cat_id` int(11) NOT NULL,
  `quantity` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'final price after bidding between seller and buyer',
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `buy_sells`
--

INSERT INTO `buy_sells` (`id`, `buyer_id`, `seller_id`, `seller_cat_id`, `quantity`, `price`, `status`, `created_at`, `updated_at`) VALUES
(8, 23, 22, 7, '10', '910', 2, '2018-10-19 05:08:32', '2018-10-19 07:07:33'),
(9, 23, 22, 7, '50', '900', 2, '2018-10-20 06:01:41', '2018-10-20 06:01:41');

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
(10, 8, 23, '900', 1, '2018-10-19 05:08:32', '2018-10-19 05:08:32'),
(13, 8, 22, '910', 1, '2018-10-19 05:32:23', '2018-10-19 05:32:23'),
(29, 8, 23, '910', 1, '2018-10-19 06:41:48', '2018-10-19 06:41:48'),
(30, 9, 23, '900', 1, '2018-10-20 06:01:41', '2018-10-20 06:01:41');

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
(1, 'Chana', '123196', '10', '50', '200', '10', '50', 'e24536.jpg', 1, '2018-09-26 08:25:07', '2018-09-26 08:53:26'),
(2, 'Rice', '32543', '10', '50', '200', '10', '50', '592ecc.jpg', 1, '2018-09-26 08:54:27', '2018-09-26 08:54:27'),
(3, 'Mustard', '32543', '10', '50', '200', '10', '50', 'd0cbef.jpg', 1, '2018-09-26 08:55:13', '2018-09-26 08:55:13'),
(4, 'Milk', '32543', '10', '50', '200', '10', '50', '24e090.png', 0, '2018-10-12 07:22:47', '2018-10-12 07:22:53');

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
(1, 'Barley', '66e9cf.jpg', '2019-01-15 13:04:13', '2019-01-15 13:04:13', 1),
(2, 'Grams', '6245e3.jpg', '2019-01-15 14:31:05', '2019-01-15 14:31:05', 1);

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

--
-- Dumping data for table `facilities`
--

INSERT INTO `facilities` (`id`, `facility`, `status`, `created_at`, `updated_at`) VALUES
(1, 'facility', 1, '2018-09-20 08:31:00', '2018-09-20 08:31:00'),
(2, 'facility 1', 1, '2018-09-20 08:35:44', '2018-09-20 08:35:46');

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

--
-- Dumping data for table `finances`
--

INSERT INTO `finances` (`id`, `user_id`, `bank_name`, `branch_name`, `acc_number`, `ifsc`, `pan`, `aadhar`, `balance_sheet`, `bank_statement`, `commodity_id`, `quantity`, `amount`, `status`, `created_at`, `updated_at`) VALUES
(1, 5, 'sbi', 'jaipur', '123456', 'asfasf', 'd73433.png', 'd78fc1.png', '38cd22.png', 'd74e1c.png', 1, NULL, NULL, 3, '2018-10-03 08:08:15', '2018-10-03 08:09:49'),
(2, 22, 'sbi', 'jaipur', '123456', 'asfasf', '353a4a.png', '9f964e.png', '4ec543.gif', '79c80b.png', 5, '10', '1000', 1, '2018-10-15 15:00:46', '2018-10-15 15:00:46'),
(3, 22, 'sbi', 'jaipur', '123456', 'asfasf', '7c1a23.png', 'b177ff.png', 'a27573.gif', '4cbbe7.png', 5, '10', '1000', 1, '2018-10-15 15:01:13', '2018-10-15 15:01:13');

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
(1, 1, 'ert', 2354, '343', 2, '2018-10-03 08:08:15', '2018-10-03 08:09:49'),
(2, 2, NULL, NULL, NULL, NULL, '2018-10-15 15:00:46', '2018-10-15 15:00:46'),
(3, 3, NULL, NULL, NULL, NULL, '2018-10-15 15:01:13', '2018-10-15 15:01:13');

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
  `price` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `inventories`
--

INSERT INTO `inventories` (`id`, `user_id`, `warehouse_id`, `commodity`, `type`, `quantity`, `sell_quantity`, `price`, `image`, `status`, `created_at`, `updated_at`) VALUES
(7, 22, 1, 1, NULL, '350', '150', '900', '125f00.pdf', 1, '2018-10-18 14:05:19', '2018-10-20 06:01:41'),
(8, 23, 1, 1, NULL, '190', NULL, '0', NULL, 1, '2018-10-19 06:16:47', '2018-10-19 06:16:47'),
(9, 33, 1, 1, NULL, '100', '100', '2000', 'e2e33a.pdf', 1, '2019-01-15 13:40:31', '2019-01-15 13:56:25'),
(10, 33, 1, 2, NULL, '50', '31', '2000', 'f1e0ee.pdf', 1, '2019-01-15 13:40:50', '2019-01-15 14:18:06');

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
(1, 'Item 1', 1, '2018-09-20 07:47:01', '2018-09-20 07:47:01'),
(2, 'Item 2', 1, '2018-09-20 07:47:13', '2018-09-20 08:01:31');

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
(1, 'RAMGANJMANDI', '2019-01-15 12:39:25', '2019-01-15 12:39:25', 1),
(2, 'PRATAPGARH', '2019-01-15 12:32:43', '2019-01-15 12:40:56', 1);

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
(11, '3800', '4000', '3600', 1, 1, '2019-01-15 15:18:15', '2019-01-15 16:03:43', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `fname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lname` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `login_otp` varchar(6) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fname`, `lname`, `email`, `password`, `phone`, `login_otp`, `remember_token`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Admin', '', 'admin@admin.com', '$2y$10$JCJ6HuLpoDYa0obD88w0buwVOYjjK5/M59CxfPM/UDqtJHLb2uK5O', '9602947878', NULL, 'QQvNMEj0CQvZeX01DHkIr9PGzBmGLUJkI3MsLQXXeR5qGmN5HLt1VYKbYOv4', 1, '2018-09-01 08:17:09', '2018-09-01 08:17:09'),
(25, 'Goverment', NULL, NULL, '$2y$10$JCJ6HuLpoDYa0obD88w0buwVOYjjK5/M59CxfPM/UDqtJHLb2uK5O', '9413145945', NULL, 'bXmTLRdeFyqjBGw1kJBhffU8PXZewz3CsUyOHuzXl0NKflzVQFgbSYOXmqGb', 1, '2019-01-05 13:06:59', '2019-01-05 13:06:59'),
(33, 'amit', NULL, NULL, '$2y$10$rm66CB3Ql9RmwpTACNXw1.pICZCs4MdXATP3GIfYNNGG/6ry4OHF.', '9314142089', NULL, 'gpmhzPrWUcmPNtnqs24pJdcc7EibJaNXXb4c82iGSIi8oegqoBGNWq542wqD', 1, '2019-01-15 06:06:24', '2019-01-15 06:06:24'),
(35, 'Ravi', NULL, NULL, '$2y$10$InG2QGMkWB2DUbiPLSJY/uhIKmIVAJ4WpTcedU4GC5.PPjiIIEtUS', '9413347010', NULL, '61t8lE9wtxToUcUgN79GSXkuhoHXUesRtoCAxMbu8TOVIZauC9Gjk2XyLHN6', 1, '2019-01-15 06:21:08', '2019-01-15 06:21:08');

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
  `firm_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` longtext COLLATE utf8mb4_unicode_ci,
  `mandi_license` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`id`, `user_id`, `fname`, `lname`, `email`, `phone`, `father_name`, `category`, `gst_number`, `khasra_no`, `village`, `tehsil`, `district`, `image`, `power`, `aadhar_no`, `bank_name`, `bank_branch`, `bank_acc_no`, `bank_ifsc_code`, `firm_name`, `address`, `mandi_license`, `status`, `created_at`, `updated_at`) VALUES
(19, 33, 'amit', NULL, NULL, '8003947560', 'ashok', NULL, NULL, NULL, 'singhana', NULL, 'jhunjhunu', 'user.png', '1', '123456789012', 'icici', 'singhana', '888', 'icici0006731', NULL, NULL, NULL, 1, '2019-01-15 06:06:23', '2019-01-15 06:06:23'),
(20, 35, 'Ravi', NULL, NULL, '9509201120', NULL, NULL, '32543', NULL, NULL, NULL, NULL, 'user.png', '1', NULL, NULL, NULL, NULL, NULL, 'Beauty', 'jaipur', '98765425', 1, '2019-01-15 06:21:08', '2019-01-15 06:21:08');

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
(21, 25, 4, '2019-01-05 13:22:33', '2019-01-05 13:22:33'),
(29, 33, 5, '2019-01-15 06:06:23', '2019-01-15 06:06:23'),
(31, 35, 6, '2019-01-15 06:21:08', '2019-01-15 06:21:08');

-- --------------------------------------------------------

--
-- Table structure for table `warehouses`
--

CREATE TABLE `warehouses` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `village` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `capacity` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `items` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `facilities` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `warehouses`
--

INSERT INTO `warehouses` (`id`, `name`, `village`, `capacity`, `items`, `facilities`, `status`, `created_at`, `updated_at`) VALUES
(1, 'b 97', 'Palsana', '1500 MT', '[\"1\",\"2\"]', '[\"1\"]', 1, '2018-09-20 08:52:04', '2019-01-15 13:24:26'),
(2, 'CLPL', 'Manda', '3000 MT', '[\"1\",\"2\"]', '[\"1\"]', 1, '2018-09-22 06:43:09', '2019-01-15 13:24:03'),
(3, 'R K Warehouse', 'Morija', '3000 MT', '[\"2\"]', '[\"1\"]', 1, '2018-09-22 06:43:42', '2019-01-15 13:23:21');

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `buy_sells`
--
ALTER TABLE `buy_sells`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `buy_sell_conversations`
--
ALTER TABLE `buy_sell_conversations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `commodity_name`
--
ALTER TABLE `commodity_name`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `facilities`
--
ALTER TABLE `facilities`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `finances`
--
ALTER TABLE `finances`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `finance_responses`
--
ALTER TABLE `finance_responses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `inventories`
--
ALTER TABLE `inventories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `mandi_name`
--
ALTER TABLE `mandi_name`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
-- AUTO_INCREMENT for table `today_prices`
--
ALTER TABLE `today_prices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `user_details`
--
ALTER TABLE `user_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `warehouses`
--
ALTER TABLE `warehouses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
