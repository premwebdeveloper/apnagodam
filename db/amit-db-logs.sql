-- ------------------- `ALTER TABLE `user_details` at 17-09-2018 -------------------
ALTER TABLE `user_details` CHANGE `lname` `lname` VARCHAR(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL;
ALTER TABLE `users` CHANGE `lname` `lname` VARCHAR(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL;

-- ------------------- ALTER TABLE `categories` at 26-09-2018 -------------------
ALTER TABLE `categories` ADD `image` VARCHAR(255) NULL AFTER `freight`;

-- ------------------- INSERT INTO `users` at 05-01-2019 -------------------
INSERT INTO `users` (`id`, `fname`, `lname`, `email`, `password`, `phone`, `login_otp`, `remember_token`, `status`, `created_at`, `updated_at`) VALUES (NULL, 'Goverment', NULL, NULL, '', '9413145945', NULL, NULL, '1', NOW(), NOW());

-- ------------------- INSERT INTO `roles` at 05-01-2019 -------------------
INSERT INTO `roles` (`id`, `role`, `created_at`, `updated_at`) VALUES (NULL, 'govt_user', NOW(), NOW());

-- ------------------- INSERT INTO `user_roles` at 05-01-2019 -------------------
INSERT INTO `user_roles` (`id`, `user_id`, `role_id`, `created_at`, `updated_at`) VALUES (NULL, '25', '4', NOW(), NOW());

-- ------------------- CREATE TABLE `today_prices` at 05-01-2019 -------------------
CREATE TABLE `today_prices` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `price` varchar(255) DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `today_prices`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `today_prices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
  
-- ------------------- INSERT INTO `today_prices` at 05-01-2019 -------------------
INSERT INTO `today_prices` (`id`, `name`, `price`, `updated_at`, `status`) VALUES (NULL, 'Barley', NULL, NOW(), ''), (NULL, 'Gram', NULL, NOW(), ''), (NULL, 'Groundnut', NULL, NOW(), ''), (NULL, 'chola', NULL, NOW(), ''), (NULL, 'guar', NULL, NOW(), ''), (NULL, 'wheat', NULL, NOW(), ''), (NULL, 'bajra', NULL, NOW(), ''), (NULL, 'methi', NULL, NOW(), ''), (NULL, 'mustard', NULL, NOW(), ''), (NULL, 'paddy', NULL, NOW(), '');
  
-- ------------------- INSERT INTO `roles` at 13-01-2019 -------------------
INSERT INTO `roles` (`id`, `role`, `created_at`, `updated_at`) VALUES (NULL, 'farmer', NOW(), NOW()); 
 
-- ------------------- INSERT INTO `roles` at 13-01-2019 -------------------
INSERT INTO `roles` (`id`, `role`, `created_at`, `updated_at`) VALUES (NULL, 'trader', NOW(), NOW()); 

-- ------------------- ALTER TABLE `user_details` ADD at 13-01-2019 -------------------
ALTER TABLE `user_details` ADD `aadhar_no` VARCHAR(255) NULL AFTER `power`, ADD `bank_name` VARCHAR(255) NULL AFTER `aadhar_no`, ADD `bank_branch` VARCHAR(255) NOT NULL AFTER `bank_name`, ADD `bank_acc_no` VARCHAR(255) NOT NULL AFTER `bank_branch`, ADD `bank_ifsc_code` VARCHAR(255) NOT NULL AFTER `bank_acc_no`;

-- ------------------- ALTER TABLE `user_details` ADD at 13-01-2019 -------------------
ALTER TABLE `user_details` ADD `firm_name` VARCHAR(255) NULL AFTER `bank_ifsc_code`, ADD `address` LONGTEXT NULL AFTER `firm_name`, ADD `mandi_license` VARCHAR(255) NULL AFTER `address`;

-- ------------------- ALTER TABLE `user_details` CHANGE at 15-01-2019 -------------------
ALTER TABLE `user_details` CHANGE `bank_branch` `bank_branch` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL, CHANGE `bank_acc_no` `bank_acc_no` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL, CHANGE `bank_ifsc_code` `bank_ifsc_code` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL;

-- ------------------- CREATE TABLE `commodity_name` at 15-01-2019 -------------------
CREATE TABLE `commodity_name` (
  `id` int(11) NOT NULL,
  `commodity` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `commodity_name`
--
ALTER TABLE `commodity_name`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `commodity_name`
--
ALTER TABLE `commodity_name`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
  
-- ------------------- CREATE TABLE `commodity_name` at 15-01-2019 -------------------
CREATE TABLE `mandi_name` (
  `id` int(11) NOT NULL,
  `mandi_name` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mandi_name`
--
ALTER TABLE `mandi_name`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mandi_name`
--
ALTER TABLE `mandi_name`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

-- ------------------- ALTER TABLE `today_prices` DROP at 15-01-2019 -------------------
ALTER TABLE `today_prices` DROP `name`, DROP `price`;

-- ------------------- ALTER TABLE `today_prices` ADD at 15-01-2019 -------------------
ALTER TABLE `today_prices` ADD `modal` VARCHAR(191) NULL AFTER `id`, ADD `max` VARCHAR(191) NULL AFTER `modal`, ADD `min` VARCHAR(191) NULL AFTER `max`, ADD `commodity_id` INT NOT NULL AFTER `min`, ADD `mandi_id` INT NOT NULL AFTER `commodity_id`;

-- ------------------- ALTER TABLE `today_prices` ADD at 15-01-2019 -------------------
ALTER TABLE `today_prices` ADD `created_at` DATETIME NOT NULL AFTER `mandi_id`;