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

-- ------------------- ALTER TABLE `warehouse_rent_rates` at 26-09-2018 ------------------
ALTER TABLE `warehouse_rent_rates` ADD `warehouse_id` INT NULL AFTER `id`;

-- ------------------- ALTER TABLE `warehouses` at 26-09-2018 ------------------
ALTER TABLE `warehouses` CHANGE `facilities` `facility_id` INT NULL;

-- ------------------- ALTER TABLE `warehouses` at 26-09-2018 ------------------
ALTER TABLE `warehouses` CHANGE `created_at` `created_at` DATETIME NULL DEFAULT NULL, CHANGE `updated_at` `updated_at` DATETIME NULL DEFAULT NULL;
ALTER TABLE `warehouses` CHANGE `facility_id` `facility_ids` TEXT NULL DEFAULT NULL;
ALTER TABLE `warehouses` CHANGE `items` `items` VARCHAR(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL;
ALTER TABLE `warehouses` ADD `image` TEXT NULL AFTER `facility_ids`;


-- ------------------- ALTER TABLE `warehouses` at 02-10-2018 ------------------
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


-- ------------------- ALTER TABLE `warehouses` at 03-10-2018 ------------------
ALTER TABLE `warehouses` ADD `warehouse_code` VARCHAR(25) NULL AFTER `id`;

-- ------------------- ALTER TABLE `inventories` at 03-10-2018 ------------------
ALTER TABLE `inventories` ADD `weight_bridge_no` VARCHAR(50) NULL AFTER `commodity`, ADD `truck_no` VARCHAR(50) NULL AFTER `weight_bridge_no`, ADD `stack_no` VARCHAR(50) NULL AFTER `truck_no`, ADD `lot_no` VARCHAR(50) NULL AFTER `stack_no`, ADD `net_weight` VARCHAR(50) NULL AFTER `lot_no`;









-- ------------------- ALTER TABLE `mandi_name` at 16-01-2020 ------------------
ALTER TABLE `mandi_name` ADD `bank_account_no` VARCHAR(30) NULL AFTER `mandi_tax_fees`, ADD `branch_name` VARCHAR(200) NULL AFTER `bank_account_no`, ADD `branch_ifsc` VARCHAR(20) NULL AFTER `branch_name`, ADD `account_holder` VARCHAR(200) NULL AFTER `branch_ifsc`;
ALTER TABLE `mandi_name` ADD `bank_name` VARCHAR(100) NULL AFTER `mandi_tax_fees`;
ALTER TABLE `mandi_name` ADD `email` VARCHAR(50) NULL AFTER `mandi_tax_fees`, ADD `phone` VARCHAR(12) NULL AFTER `email`;

-- ------------------- ALTER TABLE `user_details` at 16-01-2020 ------------------
ALTER TABLE `user_details` ADD `area/vilage` TEXT NULL AFTER `address`, ADD `city` VARCHAR(100) NULL AFTER `area/vilage`, ADD `state` VARCHAR(100) NULL AFTER `city`, ADD `pincode` VARCHAR(8) NULL AFTER `state`;
ALTER TABLE `user_details` CHANGE `area/vilage` `area_vilage` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;

-- ------------------- UPDATE and INSERT TABLE `role` at 21-01-2020 ------------------
UPDATE `roles` SET `role` = 'inventory' WHERE `roles`.`id` = 5;
UPDATE `roles` SET `role` = 'sales' WHERE `roles`.`id` = 6;
INSERT INTO `roles` (`id`, `role`, `created_at`, `updated_at`) VALUES ('3', 'account', '2020-01-21 12:02:00', '2020-01-21 12:02:00');

-- ------------------- ALTER TABLE `user_details` at 21-01-2020 ------------------
ALTER TABLE `user_details` ADD `user_type` INT NULL COMMENT '1 for Farmer, 2 for Trader' AFTER `user_id`;
ALTER TABLE `buy_sells` ADD `mandi_fees` INT NULL AFTER `price`;
ALTER TABLE `buy_sells` CHANGE `mandi_fees` `mandi_fees` VARCHAR(10) NULL DEFAULT NULL;

-- ------------------- ALTER TABLE `mandi_samitis` at 03-02-2020 ------------------
ALTER TABLE `mandi_samitis` ADD `class` VARCHAR(2) NULL AFTER `name`, ADD `secretary_name` VARCHAR(100) NULL AFTER `class`, ADD `phone` VARCHAR(15) NULL AFTER `secretary_name`, ADD `std_code` VARCHAR(10) NULL AFTER `phone`, ADD `tel_no` VARCHAR(15) NULL AFTER `std_code`, ADD `fax` VARCHAR(12) NULL AFTER `tel_no`, ADD `email` VARCHAR(100) NULL AFTER `fax`;

-- ------------------- ALTER TABLE `warehouse_rent_rates` at 04-02-2020 ------------------
ALTER TABLE `warehouse_rent_rates` ADD `state` VARCHAR(10) NULL AFTER `district`;

-- ------------------- ALTER TABLE `buy_sells` at 15-02-2020 ------------------
ALTER TABLE `buy_sells` ADD `todays_price` VARCHAR(30) NULL AFTER `price`, ADD `bid_type` TINYINT NULL DEFAULT '1' COMMENT '1 For E-Mandi, 2 for Corporate Buying' AFTER `todays_price`;

-- ------------------- ALTER TABLE `apna_case` at 18-02-2020 ------------------
ALTER TABLE `apna_case` CHANGE `status` `status` TINYINT(4) NOT NULL COMMENT '1 for active, 0 for cancel and 2 for completed';
ALTER TABLE `apna_case` ADD `approved_remark` TEXT NULL AFTER `purpose`;

-- ------------------- ALTER TABLE `apna_case_quality_claim` at 20-02-2020 ------------------
ALTER TABLE `apna_case_quality_claim` ADD `quality_discount_value` VARCHAR(50) NULL AFTER `live_insects`;
ALTER TABLE `apna_case_accounts` ADD `inventory` VARCHAR(10) NULL AFTER `whs_issulation`;

-- ------------------- ALTER TABLE `apna_employees` at 13-03-2020 ------------------
ALTER TABLE `apna_employees` ADD `personal_phone` VARCHAR(20) NULL AFTER `email`, ADD `address` TEXT NULL AFTER `personal_phone`;

-- ------------------- ALTER TABLE `categories` at 26-03-2020 ------------------
ALTER TABLE `categories` ADD `gst_on_rent` VARCHAR(20) NULL AFTER `gst`;

-- ------------------- ALTER TABLE `warehouses` at 26-03-2020 ------------------
ALTER TABLE `warehouses` ADD `no_of_stacks` INT NULL AFTER `gatepass_end`;

-- ------------------- ALTER TABLE `warehouses` at 28-03-2020 ------------------
ALTER TABLE `warehouses` ADD `dharam_kanta` INT NULL AFTER `no_of_stacks`;
ALTER TABLE `warehouses` ADD `labour_contractor` VARCHAR(100) NULL AFTER `dharam_kanta`, ADD `contractor_phone` VARCHAR(20) NULL AFTER `labour_contractor`, ADD `labour_rate` VARCHAR(10) NULL AFTER `contractor_phone`;

-- ------------------- ALTER TABLE `apna_case_cdf` at 29-03-2020 ------------------
ALTER TABLE `apna_case_cdf` ADD `stack_no` INT NULL AFTER `user_id`;

-- ------------------- ALTER TABLE `inventories` at 31-03-2020 ------------------
ALTER TABLE `inventories` CHANGE `case_id` `case_id` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;

-- ------------------- ALTER TABLE `apna_case` at 2-04-2020 ------------------
ALTER TABLE `apna_case` ADD `no_of_bags` INT NULL AFTER `sale_name`, ADD `cancel_notes` TEXT NULL AFTER `no_of_bags`;

-- ------------------- ALTER TABLE `inventory_cases_id` at 5-04-2020 ------------------
ALTER TABLE `inventory_cases_id` ADD `weight` VARCHAR(100) NULL AFTER `case_id`;

-- ------------------- ALTER TABLE `apna_case_pricing` at 10-04-2020 ------------------
ALTER TABLE `apna_case_pricing` CHANGE `user_id` `user_id` INT(11) NULL, CHANGE `processing_fees` `processing_fees` VARCHAR(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `interest_rate` `interest_rate` VARCHAR(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `price` `price` VARCHAR(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `rent` `rent` VARCHAR(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `labour_rate` `labour_rate` VARCHAR(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL;

-- ------------------- ALTER TABLE `buy_sells` at 27-04-2020 ------------------
ALTER TABLE `buy_sells` ADD `labour_rate` VARCHAR(50) NULL AFTER `price`;

-- ------------------- CREATE TABLE `apna_case_grn` at 09-06-2020 ------------------

CREATE TABLE `apna_case_grn` (
  `id` int(11) NOT NULL,
  `case_id` varchar(200) NOT NULL,
  `user_id` int(11) NOT NULL,
  `gate_pass_no` int(11) DEFAULT NULL,
  `bags` int(11) DEFAULT NULL,
  `grn_weight` varchar(100) DEFAULT NULL,
  `in_case_id` varchar(100) DEFAULT NULL,
  `other` text DEFAULT NULL,
  `stack_no` varchar(30) DEFAULT NULL,
  `lot_no` varchar(30) DEFAULT NULL,
  `file` text DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `apna_case_grn`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `apna_case_grn`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;