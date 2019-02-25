-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 25, 2019 at 03:22 PM
-- Server version: 10.1.22-MariaDB
-- PHP Version: 7.1.4

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
  `buyer_id` int(11) DEFAULT NULL,
  `seller_id` int(11) NOT NULL,
  `seller_cat_id` int(11) NOT NULL,
  `quantity` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'final price after bidding between seller and buyer',
  `status` tinyint(1) NOT NULL COMMENT 'status 1 active bid and 2 for deal done 3 for pdf send and payment accept',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, 'Rice', '32543', '10', '50', '200', '10', '50', '592ecc.jpg', 1, '2018-09-26 08:54:27', '2018-09-26 08:54:27'),
(2, 'Chana', '5', '10', '50', '150', '10', '40', 'f14b5c.jpg', 1, '2019-02-21 05:14:41', '2019-02-21 05:14:41');

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
(1, 'Barley', '66e9cf.jpg', '2019-01-15 13:04:13', '2019-01-17 15:22:37', 0),
(2, 'Grams', '6245e3.jpg', '2019-01-15 14:31:05', '2019-01-17 15:22:40', 0),
(3, 'Barley', '81af37.jpg', '2019-01-17 15:23:03', '2019-01-17 15:23:03', 1),
(4, 'Chana', 'c70dd1.jpg', '2019-01-17 15:23:13', '2019-01-17 15:23:13', 1),
(5, 'Bajra', '132f50.jpg', '2019-01-17 15:23:22', '2019-01-17 15:23:22', 1),
(6, 'Guar', '507926.jpg', '2019-01-17 15:23:31', '2019-01-17 15:23:31', 1),
(7, 'Ground nutt', '763b2c.jpg', '2019-01-17 15:23:43', '2019-01-17 15:23:43', 1),
(8, 'Chola', '71ad5a.jpg', '2019-01-17 15:23:52', '2019-01-17 15:23:52', 1),
(9, 'Methi', '8e8b4e.jpg', '2019-01-17 15:24:01', '2019-01-17 15:24:01', 1);

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
(1, 'CCTV cameras', 1, '2019-02-12 08:59:34', '2019-02-12 08:59:34'),
(2, 'Secuirity Guards', 1, '2019-02-12 08:59:47', '2019-02-12 08:59:47'),
(3, 'Electical Boundaries', 1, '2019-02-12 09:00:08', '2019-02-12 09:00:08'),
(4, 'Water Proof', 1, '2019-02-12 09:00:18', '2019-02-12 09:00:18');

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
(1, 2, 3, 1, NULL, '0', '80', '3000', '1201', 'B', '4fe35a.pdf', 1, '2019-02-21 05:16:22', '2019-02-22 05:25:02'),
(2, 3, 3, 1, NULL, '200', NULL, '3300', '1202', 'A', '096fb8.pdf', 1, '2019-02-21 05:16:55', '2019-02-21 05:16:55'),
(3, 2, 3, 2, NULL, '100', NULL, '4200', '1203', 'A', '9a6dd3.pdf', 1, '2019-02-21 05:20:51', '2019-02-21 05:20:51'),
(4, 6, 3, 1, NULL, '80', NULL, NULL, NULL, NULL, NULL, 1, '2019-02-22 05:25:02', '2019-02-22 05:25:02');

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
(1, 'RAMGANJMANDI', '2019-01-15 12:39:25', '2019-01-17 15:21:15', 0),
(2, 'PRATAPGARH', '2019-01-15 12:32:43', '2019-01-17 15:21:18', 0),
(3, 'Sikar', '2019-01-17 15:21:30', '2019-01-17 15:21:30', 1),
(4, 'Chomu', '2019-01-17 15:21:40', '2019-01-17 15:21:40', 1),
(5, 'Palsana', '2019-01-17 15:21:47', '2019-01-17 15:21:47', 1),
(6, 'Jaipur', '2019-01-17 15:21:53', '2019-01-17 15:21:53', 1),
(7, 'Shri Modhopur', '2019-01-17 15:22:13', '2019-01-17 15:22:13', 1),
(8, 'Pratapgarh', '2019-01-17 15:22:27', '2019-01-17 15:22:27', 1);

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
(12, '2000', '2200', '1900', 3, 3, '2019-01-17 15:24:27', '2019-01-17 15:24:27', 1),
(13, '4000', '4200', '3800', 4, 3, '2019-01-17 15:24:39', '2019-01-17 15:24:39', 1),
(14, '1500', '1600', '1400', 5, 3, '2019-01-17 15:24:52', '2019-01-17 15:24:52', 1),
(15, '4500', '4700', '4000', 6, 3, '2019-01-17 15:25:05', '2019-01-17 15:25:05', 1),
(16, '5000', '5500', '4500', 7, 3, '2019-01-17 15:25:20', '2019-01-17 15:25:20', 1),
(17, '6000', '6500', '5500', 8, 3, '2019-01-17 15:25:36', '2019-01-17 15:25:36', 1),
(18, '10000', '11000', '9000', 9, 3, '2019-01-17 15:25:50', '2019-01-17 15:25:50', 1),
(19, '1900', '2200', '1800', 3, 4, '2019-01-17 15:26:05', '2019-01-17 15:26:05', 1),
(20, '4500', '4700', '4000', 4, 4, '2019-01-17 15:26:18', '2019-01-17 15:26:18', 1),
(21, '4600', '4800', '4300', 4, 5, '2019-01-17 15:26:34', '2019-01-17 15:26:34', 1);

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
(1, 'Admin', '', 'admin@admin.com', '$2y$10$JCJ6HuLpoDYa0obD88w0buwVOYjjK5/M59CxfPM/UDqtJHLb2uK5O', '7014432414', NULL, '1owxBfye80m9xeR09aUVlqWilDE8yb1dQX1yrQOfnw6oSGkQbohBG8lRW0rX', 1, '2018-09-01 08:17:09', '2019-02-25 13:05:26'),
(2, 'Ravi Farmer', NULL, NULL, '$2y$10$WAsNHIL96vkPp6ubK6lW5uCsbr4OPntdyj3LB6ZXvQdB6WYmcpbEm', '9549494175', NULL, '8wDEMpeYvMaQEB04GlEBka8ctG3IHqFIV82nJnzc0V71g5KUwYC1bpI0t6CS', 1, '2019-02-12 08:52:35', '2019-02-25 13:05:26'),
(3, 'Prem Farmer', NULL, NULL, '$2y$10$yijOkP8L3rFRphaRtRmpGOf8vCyn.orc9QbcxGxzqxnT85uAh0fge', '9602947878', NULL, 'nMRwchhteS9mYRrG8ZihM8y3q27Lt5r4gZ1Yp8qEsVCV1ixrnAmjl0OKQgyJ', 1, '2019-02-12 08:55:13', '2019-02-25 13:03:50'),
(4, 'Amit Trader', NULL, NULL, '$2y$10$dwol5Qhqkx1KyYwH1zAGj.ExKjYCQVx8PQmkG8QVWGYj5SV1scKLK', '7014957469', NULL, 'uCmlpoc0pYuPBZPqMLxe5Vv9tXbZWYPugdIniB6E9hv0ErnZmkjPMoWJT3V8', 1, '2019-02-12 08:56:11', '2019-02-21 05:43:57'),
(5, 'Akshay Trader', NULL, NULL, '$2y$10$JHchoGC.g.UW6n/rJrm05ejImgjp7rwwKxm6nZFQDxTbrxF3hEEc6', '8005609866', NULL, 'hzOF5ysKkSEngRRL7tSTKnwUpfw1rvNWratWdnqQJNoTKv1MXWrahkkMCwoZ', 1, '2019-02-12 08:57:32', '2019-02-21 05:57:59'),
(6, 'Manish Trader', NULL, NULL, '$2y$10$yHB0fszvAylMUDRgUeYgH.rZlrB5crSoWQ9DggdmrPWSOAZeTmVqG', '8003947560', NULL, NULL, 1, '2019-02-12 08:58:13', '2019-02-22 08:23:25');

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
(1, 2, 'Ravi Farmer', NULL, NULL, '9976543210', 'Father Name', NULL, NULL, NULL, 'kuchaman', NULL, 'nagaur', 'user.png', '1', '0123456789', 'SBI', 'Kuchaman city', '61140020032', 'SBIN123456', NULL, NULL, NULL, 1, '2019-02-12 08:52:34', '2019-02-12 08:52:34'),
(2, 3, 'Prem Farmer', NULL, NULL, '9988776655', 'Father Name', NULL, NULL, NULL, 'Khetri nagar', NULL, 'jhunjhunu', 'user.png', '1', '9120524528', 'Uco Bank', 'Vishwakarma', '9638521470', 'UCO9876543', NULL, NULL, NULL, 1, '2019-02-12 08:55:13', '2019-02-12 08:55:13'),
(3, 4, 'Amit Trader', NULL, NULL, '1234567890', NULL, NULL, '654321', NULL, NULL, NULL, NULL, 'user.png', '100000000', NULL, NULL, NULL, NULL, NULL, 'Amit Firm', 'Jaipur', '123456', 1, '2019-02-12 08:56:11', '2019-02-19 04:35:19'),
(4, 5, 'Akshay Trader', NULL, NULL, '8974563210', NULL, NULL, '543210', NULL, NULL, NULL, NULL, 'user.png', '100000000', NULL, NULL, NULL, NULL, NULL, 'Akshay Firm', 'Chomu', '012345', 1, '2019-02-12 08:57:32', '2019-02-12 08:57:32'),
(5, 6, 'Manish Trader', NULL, NULL, '7894563210', NULL, NULL, '256985', NULL, NULL, NULL, NULL, 'user.png', '99758800', NULL, NULL, NULL, NULL, NULL, 'Manish Firm', 'Behror', '520825', 1, '2019-02-12 08:58:13', '2019-02-22 05:25:08');

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
(2, 2, 5, '2019-02-12 08:52:34', '2019-02-12 08:52:34'),
(3, 3, 5, '2019-02-12 08:55:13', '2019-02-12 08:55:13'),
(4, 4, 6, '2019-02-12 08:56:11', '2019-02-12 08:56:11'),
(5, 5, 6, '2019-02-12 08:57:32', '2019-02-12 08:57:32'),
(6, 6, 6, '2019-02-12 08:58:13', '2019-02-12 08:58:13');

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
(1, 'Bansal Warehouse', 'Palsana', '1500 MT', '[\"1\",\"2\"]', '[\"1\"]', 1, '2018-09-20 08:52:04', '2019-01-15 13:24:26'),
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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `buy_sell_conversations`
--
ALTER TABLE `buy_sell_conversations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `commodity_name`
--
ALTER TABLE `commodity_name`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `facilities`
--
ALTER TABLE `facilities`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `mandi_name`
--
ALTER TABLE `mandi_name`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `user_details`
--
ALTER TABLE `user_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `warehouses`
--
ALTER TABLE `warehouses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
