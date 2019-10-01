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