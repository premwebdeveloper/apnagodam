-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 16, 2018 at 01:23 PM
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
(8, 23, 1, 1, NULL, '190', NULL, '0', NULL, 1, '2018-10-19 06:16:47', '2018-10-19 06:16:47');

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
(2, 'user', '2018-09-06 08:27:26', '2018-09-06 08:27:26');

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
(1, 'Admin', '', 'admin@admin.com', '$2y$10$JCJ6HuLpoDYa0obD88w0buwVOYjjK5/M59CxfPM/UDqtJHLb2uK5O', '7378000002', '123456', '0AraHhkGaz3DbljiefWM8ak3Ya5WWcKiQKq4HdYriwef1Re0obMWka82q1T6', 1, '2018-09-01 08:17:09', '2018-09-01 08:17:09'),
(22, 'amit', NULL, 'admin@gmail.com', '$2y$10$zsWb.TJ/RxNR4o6ozTEXj.Ru0/LE9ObDeMrPUNvbOOWG0ySqDMAgO', '8003947560', '384085', NULL, 1, '2018-10-15 14:16:51', '2018-10-17 14:23:48'),
(23, 'Prem Saini', NULL, 'premsaini9602@gmail.com', '$2y$10$RJ1V2OOTWbaf8hyVn3JL6OIeu5G7POFz0CLGe23sJduQsLJXgQ0Tm', '7014957469', '668318', NULL, 1, '2018-10-17 14:15:19', '2018-10-17 14:27:23');

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
(16, 22, 'amit', NULL, 'admin@gmail.com', '8003947560', 'Ganpat ram saini', 1, NULL, '321123', 'khetri nagar', 'khetri', 'jhunjhunu', 'user.png', '86000', 1, '2018-10-15 14:16:51', '2018-10-18 13:17:40'),
(17, 23, 'Prem Saini', NULL, 'premsaini9602@gmail.com', '7014957469', 'Ganpat ram saini', 2, '3021364', NULL, 'khetri nagar', 'khetri', 'jhunjhunu', 'user.png', '27400', 1, '2018-10-17 14:15:18', '2018-10-20 06:01:41');

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
(3, 5, 2, '2018-09-11 08:14:37', '2018-09-11 08:14:37'),
(10, 14, 2, '2018-09-18 07:49:26', '2018-09-18 07:49:26'),
(11, 15, 2, '2018-09-19 08:16:00', '2018-09-19 08:16:00'),
(12, 16, 2, '2018-09-26 06:39:34', '2018-09-26 06:39:34'),
(14, 18, 2, '2018-10-15 14:07:31', '2018-10-15 14:07:31'),
(15, 19, 2, '2018-10-15 14:08:23', '2018-10-15 14:08:23'),
(16, 20, 2, '2018-10-15 14:12:23', '2018-10-15 14:12:23'),
(17, 21, 2, '2018-10-15 14:16:11', '2018-10-15 14:16:11'),
(18, 22, 2, '2018-10-15 14:16:51', '2018-10-15 14:16:51'),
(19, 23, 2, '2018-10-17 14:15:18', '2018-10-17 14:15:18');

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
(1, 'Warehouse', 'jaipur', '1000 sqft.', '[\"1\",\"2\"]', '[\"1\"]', 1, '2018-09-20 08:52:04', '2018-09-22 06:42:51'),
(2, 'Ravi', 'khetri nagar', '1000 sqft.', '[\"1\",\"2\"]', '[\"1\"]', 1, '2018-09-22 06:43:09', '2018-09-22 06:43:33'),
(3, 'Amit', 'khetri nagar', '1000 sqft.', '[\"2\"]', '[\"1\"]', 1, '2018-09-22 06:43:42', '2018-09-22 06:47:26');

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `user_details`
--
ALTER TABLE `user_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `warehouses`
--
ALTER TABLE `warehouses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
