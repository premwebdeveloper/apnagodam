-- ------------------- `ALTER TABLE `user_details` at 17-09-2018 -------------------
ALTER TABLE `user_details` CHANGE `lname` `lname` VARCHAR(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL;
ALTER TABLE `users` CHANGE `lname` `lname` VARCHAR(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL;