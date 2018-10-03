-- ------------------- DB started at 06-09-2018 ----------------------------------

-- ------------------- ALTER TABLE `users` at 06-09-2018 -------------------------
ALTER TABLE `users` CHANGE `name` `fname` VARCHAR(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL;
ALTER TABLE `users` ADD `lname` VARCHAR(191) NOT NULL AFTER `fname`;
ALTER TABLE `users` ADD `phone` VARCHAR(10) NULL AFTER `password`;
ALTER TABLE `users` ADD `status` BOOLEAN NOT NULL AFTER `remember_token`;

-- ------------------- CREATE TABLE `roles` at 06-09-2018 -------------------------
CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `role` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `roles` (`id`, `role`, `created_at`, `updated_at`) VALUES
(1, 'admin', '2018-09-06 13:57:26', '2018-09-06 13:57:26'),
(2, 'user', '2018-09-06 13:57:26', '2018-09-06 13:57:26');

ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;


-- ------------------- CREATE TABLE `user_roles` at 06-09-2018 -------------------------
CREATE TABLE `user_roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `user_roles` (`id`, `user_id`, `role_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2018-09-06 13:56:31', '2018-09-06 13:56:31'),
(2, 2, 2, '2018-09-06 13:56:31', '2018-09-06 13:56:31');

ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `user_roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

-- ------------------- CREATE TABLE `user_details` at 06-09-2018 -------------------
CREATE TABLE `user_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `fname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

ALTER TABLE `user_details`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `user_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

-- ------------------- ALTER TABLE `user_details` at 10-09-2018 -------------------
ALTER TABLE `user_details` ADD `father_name` VARCHAR(191) NULL AFTER `phone`, ADD `khasra_no` VARCHAR(191) NULL AFTER `father_name`, ADD `village` VARCHAR(191) NULL AFTER `khasra_no`, ADD `tehsil` VARCHAR(191) NULL AFTER `village`, ADD `district` VARCHAR(191) NULL AFTER `tehsil`, ADD `commodity` VARCHAR(191) NULL AFTER `district`;

ALTER TABLE `user_details` ADD `user_id` INT NOT NULL AFTER `id`;

-- ------------------- CREATE TABLE `warehouses` at 13-09-2018 -------------------
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

ALTER TABLE `warehouses`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `warehouses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

-- ------------------- ALTER TABLE `user_details` at 14-09-2018 -------------------
ALTER TABLE `user_details` ADD `image` VARCHAR(191) NULL AFTER `commodity`;

-- ------------------- ALTER TABLE `user_details` at 17-09-2018 -------------------
ALTER TABLE `user_details` DROP `commodity`;
ALTER TABLE `user_details` ADD `category` INT NULL AFTER `father_name`, ADD `gst_number` VARCHAR(191) NULL AFTER `category`;
ALTER TABLE `user_details` ADD `power` VARCHAR(191) NULL AFTER `image`;

-- ------------------- CREATE TABLE `inventories` at 17-09-2018 -------------------
CREATE TABLE `inventories` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `commodity` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` int(11) NOT NULL,
  `quantity` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

ALTER TABLE `inventories`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `inventories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

-- ------------------- CREATE TABLE `finances` at 17-09-2018 -------------------
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
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

ALTER TABLE `finances`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `finances`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

-- ------------------- CREATE TABLE `facilities` at 17-09-2018 -------------------
CREATE TABLE `facilities` (
  `id` int(10) UNSIGNED NOT NULL,
  `facility` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

ALTER TABLE `facilities`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `facilities`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

-- ------------------- CREATE TABLE `items` at 17-09-2018 -------------------
CREATE TABLE `items` (
  `id` int(10) UNSIGNED NOT NULL,
  `item` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

-- ------------------- ALTER TABLE `inventories` at 18-09-2018 -------------------
ALTER TABLE `inventories` CHANGE `type` `type` INT(11) NULL;
ALTER TABLE `inventories` ADD `image` VARCHAR(191) NULL AFTER `price`;

-- ------------------- CREATE TABLE `finance_responses` at 22-09-2018 -------------------
CREATE TABLE `finance_responses` (
  `id` int(10) UNSIGNED NOT NULL,
  `finance_id` int(11) NOT NULL,
  `finance_status` int(11) NOT NULL,
  `bank_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `interest` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

ALTER TABLE `finance_responses`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `finance_responses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

-- ------------------- ALTER TABLE `users` at 26-09-2018 -------------------
ALTER TABLE `users` CHANGE `email` `email` VARCHAR(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL;
ALTER TABLE `user_details` CHANGE `email` `email` VARCHAR(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL;
ALTER TABLE `finance_responses` DROP `finance_status`;

-- ------------------- CREATE TABLE `categories` at 26-09-2018 -------------------
CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `category` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gst` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `commossion` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mandi_fees` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `loading` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bardana` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `freight` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

-- ------------------- ALTER TABLE `finance_responses` at 26-09-2018 -------------------
ALTER TABLE `finance_responses` CHANGE `status` `status` TINYINT(1) NULL;

-- ------------------- CREATE TABLE `buy_sells` at 27-09-2018 -------------------
CREATE TABLE `buy_sells` (
  `id` int(10) UNSIGNED NOT NULL,
  `buyer_id` int(11) NOT NULL,
  `seller_id` int(11) NOT NULL,
  `seller_cat_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

ALTER TABLE `buy_sells`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `buy_sells`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;


-- ------------------- CREATE TABLE `buy_sell_conversations` at 27-09-2018 -------------------
CREATE TABLE `buy_sell_conversations` (
  `id` int(10) UNSIGNED NOT NULL,
  `buy_sell_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `conversation` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

ALTER TABLE `buy_sell_conversations`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `buy_sell_conversations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

-- ------------------- ALTER TABLE `inventories` at 27-09-2018 ------
ALTER TABLE `inventories` CHANGE `commodity` `commodity` INT NOT NULL;

-- ------------------- ALTER TABLE `users` at 27-09-2018 ------
ALTER TABLE `users` ADD `login_otp` VARCHAR(6) NULL AFTER `phone`;

-- ------------------- ALTER TABLE `inventories` at 03-10-2018 ------
ALTER TABLE `inventories` ADD `warehouse_id` INT NOT NULL AFTER `user_id`;