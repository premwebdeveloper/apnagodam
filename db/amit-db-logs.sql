-- ------------------- `ALTER TABLE `user_details` at 17-09-2018 -------------------
ALTER TABLE `user_details` CHANGE `lname` `lname` VARCHAR(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL;
ALTER TABLE `users` CHANGE `lname` `lname` VARCHAR(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL;

-- ------------------- ALTER TABLE `categories` at 26-09-2018 -------------------
ALTER TABLE `categories` ADD `image` VARCHAR(255) NULL AFTER `freight`;

-- ------------------- Create TABLE `facilitiy_master` at 28-09-2019 ------------

CREATE TABLE `facilitiy_master` (
  `id` int(11) NOT NULL,
  `name` varchar(250) DEFAULT NULL,
  `description` text,
  `image` text,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `facilitiy_master`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `facilitiy_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

-- ------------------- ALTER TABLE `warehouse_rent_rates` at 26-09-2019 ------------------
ALTER TABLE `warehouse_rent_rates` ADD `warehouse_id` INT NULL AFTER `id`;

-- ------------------- ALTER TABLE `warehouses` at 26-09-2019 ------------------
ALTER TABLE `warehouses` CHANGE `facilities` `facility_id` INT NULL;

-- ------------------- ALTER TABLE `warehouses` at 26-09-2019 ------------------
ALTER TABLE `warehouses` CHANGE `created_at` `created_at` DATETIME NULL DEFAULT NULL, CHANGE `updated_at` `updated_at` DATETIME NULL DEFAULT NULL;
ALTER TABLE `warehouses` CHANGE `facility_id` `facility_ids` TEXT NULL DEFAULT NULL;
ALTER TABLE `warehouses` CHANGE `items` `items` VARCHAR(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL;
ALTER TABLE `warehouses` ADD `image` TEXT NULL AFTER `facility_ids`;


-- ------------------- ALTER TABLE `warehouses` at 02-10-2019 ------------------
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

ALTER TABLE `warehouse_enquirers`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `warehouse_enquirers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;


-- ------------------- ALTER TABLE `warehouses` at 03-10-2019 ------------------
ALTER TABLE `warehouses` ADD `warehouse_code` VARCHAR(25) NULL AFTER `id`;

-- ------------------- ALTER TABLE `inventories` at 03-10-2019 ------------------
ALTER TABLE `inventories` ADD `weight_bridge_no` VARCHAR(50) NULL AFTER `commodity`, ADD `truck_no` VARCHAR(50) NULL AFTER `weight_bridge_no`, ADD `stack_no` VARCHAR(50) NULL AFTER `truck_no`, ADD `lot_no` VARCHAR(50) NULL AFTER `stack_no`, ADD `net_weight` VARCHAR(50) NULL AFTER `lot_no`;

-- ------------------- ALTER TABLE `inventories` at 07-10-2019 ------------------
ALTER TABLE `finances` DROP `bank_name`, DROP `branch_name`, DROP `acc_number`, DROP `ifsc`, DROP `aadhar`;
ALTER TABLE `finances` ADD `bank_id` INT NOT NULL AFTER `user_id`;
ALTER TABLE `finances` CHANGE `pan` `pan` VARCHAR(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL, CHANGE `balance_sheet` `balance_sheet` VARCHAR(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL, CHANGE `bank_statement` `bank_statement` VARCHAR(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL;
ALTER TABLE `mandi_name` ADD `mandi_tax_fees` VARCHAR(25) NULL AFTER `mandi_name`;
ALTER TABLE `warehouses` ADD `bank_ids` VARCHAR(255) NULL AFTER `facility_ids`;

-- ------------------- ALTER TABLE `finances` at 08-10-2019 ------------------
ALTER TABLE `finances` ADD `remaining_amount` INT NULL AFTER `amount`;

-- ------------------- ALTER TABLE `categories` at 08-10-2019 ------------------
ALTER TABLE `categories` ADD `commodity_type` VARCHAR(10) NULL AFTER `category`;

-- ------------------- ALTER TABLE `buy_sells` at 10-10-2019 ------------------
ALTER TABLE `buy_sells` CHANGE `status` `status` TINYINT(1) NOT NULL COMMENT 'status 1 active bid and 2 for complete bid / deal done 3 for pdf send and payment accept';

-- ------------------- ALTER TABLE `inventories` at 10-10-2019 ------------------
ALTER TABLE `inventories` ADD `sales_status` VARCHAR(25) NULL AFTER `image`;
ALTER TABLE `inventories` CHANGE `sales_status` `sales_status` INT NULL DEFAULT '1' COMMENT '1 For Primary 2 For Secondary Sales';

-- ------------------- ALTER TABLE `buy_sells` at 10-10-2019 ------------------
ALTER TABLE `buy_sells` ADD `payment_ref_no` VARCHAR(255) NULL AFTER `seller_cat_id`;

-- ------------------- ALTER TABLE `user_details` at 10-10-2019 ------------------
ALTER TABLE `user_details` ADD `referral_code` VARCHAR(10) NULL AFTER `phone`;
ALTER TABLE `user_details` ADD `referral_by` VARCHAR(10) NULL AFTER `referral_code`;

-- ------------------- CREATE TABLE `user_groups` at 10-10-2019 ------------------
CREATE TABLE `user_groups` (
  `id` int(11) NOT NULL,
  `group_id` varchar(10) NOT NULL,
  `user_ids` text NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `user_groups`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `user_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

-- ------------------- CREATE TABLE `loan_max_value` at 11-10-2019 ------------------

CREATE TABLE `loan_max_value` (
  `id` int(11) NOT NULL,
  `loan_value` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `loan_max_value` (`id`, `loan_value`) VALUES
(1, 85);

ALTER TABLE `loan_max_value`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `loan_max_value`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;


-- ------------------- CREATE TABLE `bank_master` at 11-10-2019 ------------------
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

INSERT INTO `bank_master` (`id`, `bank_name`, `interest_rate`, `loan_pass_days`, `processing_fee`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Apnagodam', '10', '10', '1', 1, '2019-10-08 01:00:17', '2019-10-08 12:06:31'),
(2, 'HDFC', '10', '10', '1', 1, '2019-10-06 00:43:29', '2019-10-08 12:06:45'),
(3, 'SBI', '10', '10', '1', 1, '2019-10-06 00:43:06', '2019-10-08 12:07:01');

ALTER TABLE `bank_master`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `bank_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
