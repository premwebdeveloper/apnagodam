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

