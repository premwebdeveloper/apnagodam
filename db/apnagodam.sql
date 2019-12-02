-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 09, 2018 at 02:57 PM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 7.2.5

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
(1, 7, 3, 18, '5', '5000', 2, '2018-10-08 06:42:58', '2018-10-08 06:42:58'),
(3, 7, 3, 18, '10', '4500', 2, '2018-10-08 07:37:01', '2018-10-08 07:37:45'),
(4, 7, 3, 18, '4', '4300', 2, '2018-10-08 07:40:40', '2018-10-08 07:46:57');

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
(1, 1, 7, '5000', 1, '2018-10-08 06:42:58', '2018-10-08 06:42:58'),
(8, 3, 7, '4000', 1, '2018-10-08 07:37:01', '2018-10-08 07:37:01'),
(9, 3, 3, '4800', 1, '2018-10-08 07:37:31', '2018-10-08 07:37:31'),
(10, 3, 7, '4500', 1, '2018-10-08 07:37:38', '2018-10-08 07:37:38'),
(11, 3, 3, '4500', 1, '2018-10-08 07:37:45', '2018-10-08 07:37:45'),
(12, 4, 7, '4000', 1, '2018-10-08 07:40:40', '2018-10-08 07:40:40'),
(13, 4, 3, '4500', 1, '2018-10-08 07:41:27', '2018-10-08 07:41:27'),
(16, 4, 7, '4300', 1, '2018-10-08 07:46:50', '2018-10-08 07:46:50'),
(17, 4, 3, '4300', 1, '2018-10-08 07:46:57', '2018-10-08 07:46:57');

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
(1, 'wheat', '5', '5', '5', '5', '5', '5', 'ff59de.jpg', 1, '2018-09-27 06:27:08', '2018-09-27 06:27:08'),
(2, 'Chana', '5', '5', '5', '5', '5', '5', '4fc77c.jpg', 1, '2018-09-27 06:27:30', '2018-09-27 06:27:30'),
(3, 'Peanut', '2', '200', '150', '100', '25', '75', '10fa78.jpg', 1, '2018-10-05 02:22:07', '2018-10-05 02:22:07'),
(4, 'Almond', '5', '500', '250', '125', '400', '200', 'd3a32f.jpg', 1, '2018-10-05 02:22:37', '2018-10-05 02:22:37');

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
(1, 'Dharm Kanta', 1, '2018-09-26 12:02:01', '2018-09-26 12:02:01'),
(2, 'CCTV', 1, '2018-09-26 12:02:01', '2018-09-26 12:02:01');

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
(2, 3, 'Bank Of Baroda', 'Singhana', '61148299568', 'SBIN0031155', 'd9b4e7.jpg', '8bf51c.jpg', '78bf51.jpg', 'd397a7.jpg', 18, NULL, '10000', 1, '2018-10-05 04:22:02', '2018-10-05 04:22:02');

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
(2, 2, NULL, NULL, NULL, NULL, '2018-10-05 04:22:02', '2018-10-05 04:22:02');

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
(17, 2, 4, 1, NULL, '100', '20', '20', '222ba7.pdf', 1, '2018-10-05 02:31:05', '2018-10-07 05:36:08'),
(18, 3, 2, 4, NULL, '181', '51', '5000', '30e148.pdf', 1, '2018-10-05 02:31:24', '2018-10-08 07:46:57'),
(19, 2, 4, 3, NULL, '150', '80', '2500', 'e74ac3.pdf', 1, '2018-10-05 02:31:40', '2018-10-08 06:41:15'),
(20, 4, 1, 2, NULL, '500', '400', '3500', 'bcb772.pdf', 1, '2018-10-05 02:31:58', '2018-10-05 02:31:58'),
(21, 6, 4, 3, NULL, '100', '100', '1500', '162c9a.pdf', 1, '2018-10-05 02:32:23', '2018-10-05 02:32:23'),
(22, 7, 1, 1, NULL, '100', '0', '0', '2ffffe.pdf', 1, '2018-10-05 03:40:31', '2018-10-07 05:31:54'),
(23, 7, 4, 3, NULL, '50', NULL, '0', NULL, 1, '2018-10-07 06:46:54', '2018-10-07 06:46:54'),
(24, 7, 2, 4, NULL, '19', NULL, '0', NULL, 1, '2018-10-08 06:42:58', '2018-10-08 06:42:58');

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
(1, 'Item A', 1, '2018-09-26 12:02:30', '2018-09-26 12:02:30'),
(2, 'Item B', 1, '2018-09-26 12:02:30', '2018-09-26 12:02:30');

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
(2, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2018_09_06_125124_create_roles_table', 2),
(5, '2018_09_06_125445_create_user_roles_table', 3),
(7, '2018_09_06_130518_create_user_details_table', 4),
(8, '2018_09_13_114238_create_warehouses_table', 5),
(9, '2018_09_17_120058_create_inventories_table', 6),
(10, '2018_09_17_120618_create_finances_table', 7),
(11, '2018_09_17_124005_create_items_table', 8),
(12, '2018_09_17_124037_create_facilities_table', 8),
(13, '2018_09_22_122228_create_finance_responses_table', 9),
(14, '2018_09_26_123235_create_categories_table', 10),
(15, '2018_09_27_115959_create_buy_sells_table', 11),
(16, '2018_09_27_120032_create_buy_sell_conversations_table', 11);

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
(1, 'admin', '2018-09-06 13:57:26', '2018-09-06 13:57:26'),
(2, 'user', '2018-09-06 13:57:26', '2018-09-06 13:57:26');

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
(1, 'Admin', '', 'admin@admin.com', '$2y$10$8tXr4/YWabiDDW2AfnMZC.TuF0tMtetSx9Pe/yvlNON2hLlymmqeK', '7014957469', NULL, 'sA72wUSZWjqO46uzH3KZd4rK9pXpdrYBTGQqBbBNSDoWcdDSJbLLzY0HunMU', 1, '2018-09-01 08:17:09', '2018-09-17 08:03:32'),
(2, 'Amit Sharma', NULL, NULL, '$2y$10$6JzKUBsDb0hmrFa2xx9/d.U6Thwphdsrjhq20tQspzBshV9befJuG', '9314142089', NULL, 'BQAm6qJg6aSRiX7GucU5hs6B8k84sKoAG4ahDzNFpdZnrxXv6S1poewy8hd3', 1, '2018-10-05 02:24:51', '2018-10-05 02:24:51'),
(3, 'Prem Saini', NULL, 'premsaini9602@gmail.com', '$2y$10$eT3lvbBhSxZDazizdE4V/ONbBq/2U5rp/ATlHElFCDksKreTMZE4e', '9602947878', NULL, '3XW2aHX5NTHv2inq4vQWWauUCBcWhHnpzqzM5TK3HzQKk8PD8AQ9m6UpxKG6', 1, '2018-10-05 02:25:33', '2018-10-05 02:25:33'),
(4, 'Ravi Kumar', NULL, NULL, '$2y$10$qjEhOP9qJVX/V4VIt4JeK.7.MdB6kgjxN6Z.QvNF9ZH5OTwhI/vRu', '9509201120', NULL, NULL, 1, '2018-10-05 02:26:30', '2018-10-05 02:26:30'),
(6, 'Kumar Prem', NULL, NULL, '$2y$10$50G6l0BAYE65sHdPtvpGS.SAM0RW2bRQKaPAluJrUSwOY6abRlfTi', '8005609866', NULL, NULL, 1, '2018-10-05 02:27:45', '2018-10-05 02:27:55'),
(7, 'Ani Modi', NULL, NULL, '$2y$10$tjwUzPXS5/bzc4X6Tfv6oOtBW/Y9X3t7VdmHeufl456a3lq83UxV6', '9602047010', NULL, NULL, 1, '2018-10-05 03:37:52', '2018-10-05 03:39:05');

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
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`id`, `user_id`, `fname`, `lname`, `email`, `phone`, `father_name`, `category`, `gst_number`, `khasra_no`, `village`, `tehsil`, `district`, `image`, `power`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 'Amit Sharma', NULL, NULL, '8003947560', 'FAther', 1, NULL, '12345', 'singhana', 'Buhana', 'jhunjhunu', 'c9e0c7.jpg', '1', 1, '2018-10-05 02:24:51', '2018-10-05 02:24:51'),
(2, 3, 'Prem Saini', NULL, 'premsaini9602@gmail.com', '9602947878', 'Father', 2, '98765', NULL, 'singhana', 'Buhana', 'jhunjhunu', 'b571e4.jpg', '1', 1, '2018-10-05 02:25:33', '2018-10-05 02:25:33'),
(3, 4, 'Ravi Kumar', NULL, NULL, '9509201120', 'Father', 3, '123456789', NULL, 'Shastri Nagar', 'Vidhyadhar Nagar', 'Jaipur', '462df1.jpg', '1', 1, '2018-10-05 02:26:30', '2018-10-05 02:26:30'),
(5, 6, 'Kumar Prem', NULL, NULL, '8005609866', 'Father', 1, NULL, '1234', 'vidhyadhar nagar', 'jaipur', 'jaipur', 'user.png', '500000', 1, '2018-10-05 02:27:44', '2018-10-05 02:27:55'),
(6, 7, 'Ani Modi', NULL, NULL, '9602047010', 'Father NAme', 1, NULL, '12345', 'vidhyadhar nagar', 'jaipur', 'jaipur', 'user.png', '2800', 1, '2018-10-05 03:37:51', '2018-10-08 07:46:57');

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
(1, 1, 1, '2018-09-06 13:56:31', '2018-09-06 13:56:31'),
(12, 2, 2, '2018-10-05 02:24:51', '2018-10-05 02:24:51'),
(13, 3, 2, '2018-10-05 02:25:33', '2018-10-05 02:25:33'),
(14, 4, 2, '2018-10-05 02:26:30', '2018-10-05 02:26:30'),
(15, 5, 2, '2018-10-05 02:26:30', '2018-10-05 02:26:30'),
(16, 6, 2, '2018-10-05 02:27:44', '2018-10-05 02:27:44'),
(17, 7, 2, '2018-10-05 03:37:51', '2018-10-05 03:37:51');

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
(1, 'warehouse palsana', 'palsana', '200 ton', '[\"1\",\"3\"]', '[\"1\",\"2\",\"4\"]', 1, '2018-09-13 07:28:27', '2018-09-14 06:09:19'),
(2, 'warehouse jaipur', 'chomu', '1000 ton', '[\"1\",\"3\"]', '[\"1\",\"4\"]', 1, '2018-09-13 07:31:05', '2018-09-14 06:09:45'),
(3, 'warehouse jhunjhunu', 'singhana', '500 ton', '[\"2\"]', '[\"3\",\"4\"]', 2, '2018-09-13 08:00:38', '2018-09-14 06:18:35'),
(4, 'vidhyadhar nagar warehouse', 'vidhyadhar nagar', '10000', '[\"1\",\"2\"]', '[\"1\",\"2\"]', 1, '2018-10-03 08:47:13', '2018-10-03 09:01:24');

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `buy_sell_conversations`
--
ALTER TABLE `buy_sell_conversations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `facilities`
--
ALTER TABLE `facilities`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `finances`
--
ALTER TABLE `finances`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `finance_responses`
--
ALTER TABLE `finance_responses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `inventories`
--
ALTER TABLE `inventories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user_details`
--
ALTER TABLE `user_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `warehouses`
--
ALTER TABLE `warehouses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
