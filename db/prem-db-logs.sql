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