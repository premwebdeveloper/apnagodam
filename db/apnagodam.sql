-- Adminer 4.2.5 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `buy_sells`;
CREATE TABLE `buy_sells` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `buyer_id` int(11) DEFAULT NULL,
  `seller_id` int(11) NOT NULL,
  `seller_cat_id` int(11) NOT NULL,
  `quantity` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'final price after bidding between seller and buyer',
  `status` tinyint(1) NOT NULL COMMENT 'status 1 active bid and 0 for complete bid / deal done 3 for pdf send and payment accept',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `buy_sells` (`id`, `buyer_id`, `seller_id`, `seller_cat_id`, `quantity`, `price`, `status`, `created_at`, `updated_at`) VALUES
(1,	NULL,	5,	19,	'100',	NULL,	1,	'2019-04-03 23:44:59',	'2019-04-03 23:44:59'),
(2,	8,	5,	22,	'800',	'1704',	3,	'2019-04-04 22:43:20',	'2019-04-05 00:10:04'),
(3,	33,	5,	23,	'500',	'1726',	3,	'2019-04-06 23:38:04',	'2019-04-07 00:18:14'),
(4,	NULL,	34,	24,	'500',	NULL,	1,	'2019-04-06 23:41:02',	'2019-04-06 23:41:02'),
(5,	NULL,	34,	25,	'1200',	NULL,	1,	'2019-04-06 23:41:19',	'2019-04-06 23:41:19'),
(6,	33,	5,	28,	'1300',	'1736',	3,	'2019-04-09 23:39:08',	'2019-04-10 00:02:23'),
(7,	21,	40,	42,	'10',	'1800',	3,	'2019-04-30 23:34:35',	'2019-05-01 00:00:43'),
(8,	NULL,	5,	45,	'1560',	NULL,	1,	'2019-09-05 19:46:38',	'2019-09-05 20:05:30'),
(9,	46,	5,	46,	'1560',	'1857',	3,	'2019-09-05 22:49:40',	'2019-09-05 23:28:50'),
(10,	NULL,	46,	47,	NULL,	NULL,	1,	'2019-09-21 17:52:05',	'2019-09-21 17:52:05');

DROP TABLE IF EXISTS `buy_sell_conversations`;
CREATE TABLE `buy_sell_conversations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `buy_sell_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `price` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `buy_sell_conversations` (`id`, `buy_sell_id`, `user_id`, `price`, `status`, `created_at`, `updated_at`) VALUES
(1,	1,	21,	'2011',	1,	'2019-04-03 23:44:59',	'2019-04-03 23:44:59'),
(2,	1,	27,	'2012',	1,	'2019-04-04 17:27:36',	'2019-04-04 17:27:36'),
(3,	2,	10,	'1702',	1,	'2019-04-04 22:43:20',	'2019-04-04 22:43:20'),
(4,	2,	21,	'1703',	1,	'2019-04-04 23:50:00',	'2019-04-04 23:50:00'),
(5,	2,	8,	'1704',	1,	'2019-04-04 23:59:37',	'2019-04-04 23:59:37'),
(6,	3,	33,	'1726',	1,	'2019-04-06 23:38:04',	'2019-04-06 23:38:04'),
(7,	4,	10,	'1726',	1,	'2019-04-06 23:41:02',	'2019-04-06 23:41:02'),
(8,	5,	10,	'1741',	1,	'2019-04-06 23:41:19',	'2019-04-06 23:41:19'),
(9,	6,	33,	'1736',	1,	'2019-04-09 23:39:08',	'2019-04-09 23:39:08'),
(10,	7,	21,	'1800',	1,	'2019-04-30 23:34:35',	'2019-04-30 23:34:35'),
(11,	8,	21,	'1855',	1,	'2019-09-05 19:46:38',	'2019-09-05 20:09:38'),
(12,	9,	46,	'1857',	1,	'2019-09-05 22:49:40',	'2019-09-05 22:49:40'),
(13,	9,	21,	'1856',	1,	'2019-09-05 22:51:48',	'2019-09-05 23:28:14'),
(14,	10,	112,	'1852',	1,	'2019-09-21 17:52:05',	'2019-09-21 17:52:05'),
(15,	10,	21,	'1750',	1,	'2019-10-01 20:25:37',	'2019-10-01 20:25:37');

DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
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
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `categories` (`id`, `category`, `gst`, `commossion`, `mandi_fees`, `loading`, `bardana`, `freight`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1,	'Barley',	'464646',	'4646',	'6464',	'6464',	'6464',	'6464',	'385c4a.jpg',	0,	'2019-01-19 03:06:45',	'2019-01-19 03:18:08'),
(2,	'Bajra',	'44666464',	'64656',	'6464',	'6464',	'6464',	'646',	'e9ff5b.jpg',	0,	'2019-01-19 03:12:44',	'2019-01-19 03:18:14'),
(3,	'Groundnut',	'646464',	'4646',	'6464',	'64646',	'6464',	'6464',	'c033a5.jpg',	1,	'2019-01-19 03:13:13',	'2019-01-19 03:13:13'),
(4,	'Chola',	'54434',	'13143',	'31313',	'3131',	'31313',	'31313',	'0d0014.jpg',	1,	'2019-01-19 03:13:33',	'2019-01-19 03:13:33'),
(5,	'Guar',	'4441431',	'3131',	'31313',	'3131',	'3131',	'3131',	'11d163.jpg',	1,	'2019-01-19 03:13:55',	'2019-01-19 03:13:55'),
(6,	'Barley',	'654646',	'64646',	'64646',	'64646',	'64646',	'6464',	'2a0966.jpg',	1,	'2019-01-19 03:18:49',	'2019-01-19 03:18:49'),
(7,	'Bajra',	'4646',	'64646',	'46464',	'64646',	'464646',	'6464',	'4c5518.jpg',	1,	'2019-01-19 03:19:08',	'2019-01-19 03:19:08');

DROP TABLE IF EXISTS `commodity_name`;
CREATE TABLE `commodity_name` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `commodity` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `commodity_name` (`id`, `commodity`, `image`, `created_at`, `updated_at`, `status`) VALUES
(1,	'Barley',	'b2e369.jpg',	'2019-04-18 12:05:47',	'2019-04-18 12:05:47',	1),
(2,	'Bajra',	'83bc6a.jpg',	'2019-01-18 19:55:09',	'2019-01-18 19:55:09',	1),
(3,	'Ground nutt',	'd642ee.jpg',	'2019-01-18 19:55:28',	'2019-01-18 19:55:28',	1),
(4,	'Guar',	'bf2ddd.jpg',	'2019-01-18 19:55:50',	'2019-01-18 19:55:50',	1),
(5,	'chola',	'43566a.jpg',	'2019-01-18 19:56:03',	'2019-01-18 19:56:03',	1);

DROP TABLE IF EXISTS `facilities`;
CREATE TABLE `facilities` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `facility` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `facilitiy_master`;
CREATE TABLE `facilitiy_master` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) DEFAULT NULL,
  `description` text,
  `image` text,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `facilitiy_master` (`id`, `name`, `description`, `image`, `status`, `created_at`, `updated_at`) VALUES
(2,	'Dharam Kanta',	'Dharam Kanta',	'a78808.png',	1,	'2019-09-28 01:33:55',	'2019-09-28 01:33:55'),
(3,	'Fumigation',	'fumigation',	'7dee41.png',	1,	'2019-09-28 01:34:23',	'2019-09-28 01:34:23'),
(4,	'CCTC Camera',	'CCTC Camera',	'b88e25.png',	1,	'2019-09-28 01:34:48',	'2019-09-28 01:34:48'),
(5,	'Fire Equipment',	'fire equipment',	'559e17.png',	1,	'2019-09-28 01:36:39',	'2019-09-28 01:36:39'),
(6,	'E-Mandi Linked or Not',	'E-Mandi Linked or Not',	'09d528.png',	1,	'2019-09-28 01:37:03',	'2019-09-28 01:37:03');

DROP TABLE IF EXISTS `finances`;
CREATE TABLE `finances` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
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
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `finance_responses`;
CREATE TABLE `finance_responses` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `finance_id` int(11) NOT NULL,
  `bank_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `interest` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `inventories`;
CREATE TABLE `inventories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
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
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `inventories` (`id`, `user_id`, `warehouse_id`, `commodity`, `type`, `quantity`, `sell_quantity`, `price`, `gate_pass_wr`, `quality_category`, `image`, `status`, `created_at`, `updated_at`) VALUES
(2,	5,	2,	2,	NULL,	'100',	NULL,	'0',	NULL,	NULL,	'c5c360.pdf',	0,	'2019-01-19 03:14:34',	'2019-02-22 00:01:03'),
(4,	5,	2,	7,	NULL,	'100',	'100',	'1500',	'123',	'A',	'0fa576.pdf',	0,	'2019-01-19 03:21:04',	'2019-04-04 21:49:04'),
(5,	6,	1,	6,	NULL,	'0',	NULL,	'0',	NULL,	NULL,	NULL,	0,	'2019-01-19 03:25:52',	'2019-04-01 17:04:09'),
(6,	7,	2,	7,	NULL,	'0',	NULL,	'0',	NULL,	NULL,	NULL,	0,	'2019-01-19 03:30:32',	'2019-04-04 21:50:08'),
(7,	5,	2,	6,	NULL,	'0',	NULL,	'0',	NULL,	NULL,	'f2bdd4.pdf',	0,	'2019-01-21 16:57:25',	'2019-04-04 21:49:53'),
(8,	5,	1,	3,	NULL,	'0',	NULL,	'0',	NULL,	NULL,	'fc188a.pdf',	0,	'2019-01-21 17:00:14',	'2019-04-04 21:48:56'),
(9,	9,	2,	6,	NULL,	'0',	NULL,	'0',	NULL,	NULL,	'4c706d.pdf',	0,	'2019-01-22 03:09:34',	'2019-04-04 21:50:13'),
(10,	11,	3,	6,	NULL,	'500',	NULL,	'0',	NULL,	NULL,	'92c23d.pdf',	0,	'2019-01-22 23:49:33',	'2019-04-04 21:48:41'),
(11,	5,	2,	6,	NULL,	'0',	NULL,	'0',	NULL,	NULL,	'fbfd32.pdf',	0,	'2019-01-22 23:54:00',	'2019-04-04 21:50:00'),
(12,	5,	1,	6,	NULL,	'0',	NULL,	'0',	NULL,	NULL,	'0567ff.pdf',	0,	'2019-01-23 00:23:12',	'2019-04-04 21:49:35'),
(13,	8,	1,	6,	NULL,	'1250',	NULL,	'0',	NULL,	NULL,	'a8f0d7.pdf',	0,	'2019-01-23 01:00:51',	'2019-04-05 00:10:01'),
(14,	12,	1,	6,	NULL,	'10',	NULL,	'0',	NULL,	NULL,	'd52129.pdf',	0,	'2019-01-24 23:37:03',	'2019-04-04 21:49:22'),
(15,	13,	1,	6,	NULL,	'1',	NULL,	'0',	NULL,	NULL,	'386fb1.pdf',	0,	'2019-01-28 18:23:38',	'2019-04-04 21:49:30'),
(16,	5,	1,	3,	NULL,	'0',	NULL,	'0',	NULL,	NULL,	'7993a1.pdf',	0,	'2019-01-30 22:09:10',	'2019-04-04 21:49:40'),
(17,	6,	1,	6,	NULL,	'10',	NULL,	'0',	'dummy1',	'A',	NULL,	0,	'2019-01-30 22:28:58',	'2019-04-04 21:49:16'),
(18,	8,	1,	6,	NULL,	'250',	NULL,	'0',	NULL,	NULL,	'a711cb.pdf',	0,	'2019-02-03 19:40:29',	'2019-02-22 00:01:03'),
(19,	5,	3,	6,	NULL,	'100',	'100',	'2010',	'123',	'A',	'447c87.pdf',	0,	'2019-03-05 21:39:19',	'2019-04-04 21:49:10'),
(20,	6,	1,	6,	NULL,	'1250',	NULL,	'1700',	'dummy',	'A',	'355c46.pdf',	0,	'2019-04-04 00:51:11',	'2019-04-04 21:48:36'),
(21,	5,	1,	6,	NULL,	'0',	'1250',	'1700',	'dummy',	'A',	'b1b694.pdf',	0,	'2019-04-04 00:55:50',	'2019-04-04 21:49:48'),
(22,	5,	2,	6,	NULL,	'500',	'800',	'1700',	'1B',	'A',	'6a2dd9.pdf',	0,	'2019-04-04 22:27:45',	'2019-04-06 23:10:48'),
(23,	5,	2,	6,	NULL,	'0',	'500',	'1725',	'1B',	'A',	'2c488d.pdf',	0,	'2019-04-06 23:11:53',	'2019-04-07 00:25:31'),
(24,	34,	5,	6,	NULL,	'500',	'500',	'1725',	'C-3/1',	'A',	'626897.pdf',	0,	'2019-04-06 23:13:01',	'2019-04-09 23:08:13'),
(25,	34,	6,	6,	NULL,	'1200',	'1200',	'1740',	'C-2/26',	'A',	'8fd25e.pdf',	0,	'2019-04-06 23:15:05',	'2019-04-09 23:08:32'),
(26,	33,	2,	6,	NULL,	'1800',	NULL,	NULL,	NULL,	NULL,	NULL,	0,	'2019-04-07 00:18:12',	'2019-04-10 00:02:20'),
(27,	5,	2,	6,	NULL,	'1200',	'1200',	'1735',	'1C',	'A',	'5f5597.pdf',	0,	'2019-04-09 23:07:54',	'2019-04-10 00:07:32'),
(28,	5,	2,	6,	NULL,	'0',	'1300',	'1735',	'4A',	'A',	'0f58c4.pdf',	0,	'2019-04-09 23:09:27',	'2019-04-10 00:07:36'),
(29,	34,	6,	6,	NULL,	'1550',	'1550',	'1751',	'C-2/26',	'A',	'cff1f5.pdf',	0,	'2019-04-13 22:52:05',	'2019-04-14 01:56:33'),
(30,	34,	6,	6,	NULL,	'750',	'750',	'1751',	'C-2/27',	'A',	'465102.pdf',	0,	'2019-04-13 22:52:42',	'2019-04-14 01:56:38'),
(31,	34,	5,	6,	NULL,	'1100',	NULL,	'1741',	'C-3/1',	'A',	'793fd6.pdf',	0,	'2019-04-13 22:53:32',	'2019-04-13 22:54:13'),
(32,	34,	5,	6,	NULL,	'1100',	'1100',	'1741',	'C-3/1',	'A',	'ec990e.pdf',	0,	'2019-04-13 22:53:35',	'2019-04-14 01:56:36'),
(33,	34,	6,	6,	NULL,	'1550',	'1550',	'1771',	'C-2/26',	'A',	'fa23c9.pdf',	0,	'2019-04-15 20:37:06',	'2019-04-16 02:32:45'),
(34,	34,	6,	6,	NULL,	'750',	'750',	'1771',	'C-2/27',	'A',	'960a32.pdf',	0,	'2019-04-15 20:38:12',	'2019-04-16 02:32:48'),
(35,	34,	6,	6,	NULL,	'1550',	'1550',	'1741',	'c-2/26',	'A',	'3fe275.pdf',	0,	'2019-04-17 22:57:01',	'2019-09-04 00:56:26'),
(36,	34,	6,	6,	NULL,	'750',	'750',	'1741',	'C-2/27',	'A',	'a2ada7.pdf',	0,	'2019-04-17 22:58:08',	'2019-09-04 00:56:35'),
(37,	21,	2,	6,	NULL,	'1010',	NULL,	'1741',	'4A',	'A',	'782ae9.pdf',	0,	'2019-04-17 23:05:02',	'2019-05-01 00:00:41'),
(38,	21,	2,	6,	NULL,	'1000',	NULL,	'1741',	'3A',	'A',	'd8a1be.pdf',	0,	'2019-04-17 23:09:50',	'2019-04-17 23:11:37'),
(39,	9,	2,	6,	NULL,	'1000',	'1000',	'2000',	'4A',	'A',	'b86203.pdf',	0,	'2019-04-17 23:14:12',	'2019-09-04 00:56:32'),
(40,	9,	2,	6,	NULL,	'1000',	'1000',	'1751',	'3A',	'A',	'46b857.pdf',	0,	'2019-04-17 23:14:52',	'2019-04-18 18:56:40'),
(41,	34,	5,	6,	NULL,	'1100',	'1100',	'1731',	'C-3/1',	'A',	'56a6a6.pdf',	0,	'2019-04-18 19:22:37',	'2019-09-04 00:56:28'),
(42,	40,	1,	6,	NULL,	'0',	'10',	'1795',	'dummy',	'A',	'493324.pdf',	0,	'2019-04-30 20:52:16',	'2019-09-04 00:56:38'),
(43,	5,	6,	6,	NULL,	'1560',	'1560',	'1875',	'STACK 31',	'A',	'c08383.pdf',	0,	'2019-09-04 00:59:31',	'2019-09-04 21:49:49'),
(44,	5,	6,	6,	NULL,	'1560',	'1560',	'1871',	'31',	'A',	'e8a3a8.pdf',	0,	'2019-09-04 22:10:26',	'2019-09-05 17:17:59'),
(45,	5,	6,	6,	NULL,	'1560',	'1560',	'1870',	'31',	'A',	'ab655f.pdf',	0,	'2019-09-05 17:18:36',	'2019-09-05 20:10:10'),
(46,	5,	6,	6,	NULL,	'0',	'1560',	'1856',	'31',	'A',	'ae883b.pdf',	1,	'2019-09-05 20:16:49',	'2019-09-05 23:28:48'),
(47,	46,	6,	6,	NULL,	'1560',	NULL,	NULL,	NULL,	NULL,	NULL,	1,	'2019-09-05 23:28:48',	'2019-09-05 23:28:48');

DROP TABLE IF EXISTS `items`;
CREATE TABLE `items` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `item` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `items` (`id`, `item`, `status`, `created_at`, `updated_at`) VALUES
(1,	'Barley',	0,	'2019-01-19 02:56:55',	'2019-01-21 16:48:29');

DROP TABLE IF EXISTS `mandi_name`;
CREATE TABLE `mandi_name` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mandi_name` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `mandi_name` (`id`, `mandi_name`, `created_at`, `updated_at`, `status`) VALUES
(1,	'Sikar',	'2019-01-18 20:00:09',	'2019-01-18 20:00:09',	1),
(2,	'Jhunjhunu',	'2019-01-18 20:00:21',	'2019-01-18 20:00:21',	1),
(3,	'Jaipur',	'2019-01-18 20:00:33',	'2019-01-18 20:00:33',	1),
(4,	'Shrimadhopur',	'2019-01-18 20:00:45',	'2019-01-18 20:00:45',	1),
(5,	'Chomu',	'2019-01-18 20:00:55',	'2019-01-18 20:00:55',	1);

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1,	'2014_10_12_000000_create_users_table',	1),
(2,	'2014_10_12_100000_create_password_resets_table',	1);

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `role` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `roles` (`id`, `role`, `created_at`, `updated_at`) VALUES
(1,	'admin',	'2018-09-06 08:27:26',	'2018-09-06 08:27:26'),
(2,	'user',	'2018-09-06 08:27:26',	'2018-09-06 08:27:26'),
(4,	'govt_user',	'2019-01-05 13:17:45',	'2019-01-05 13:17:45'),
(5,	'farmer',	'2019-01-13 07:25:38',	'2019-01-13 07:25:38'),
(6,	'trader',	'2019-01-13 07:29:03',	'2019-01-13 07:29:03');

DROP TABLE IF EXISTS `sms_hash_key`;
CREATE TABLE `sms_hash_key` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hash` varchar(191) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `sms_hash_key` (`id`, `hash`) VALUES
(1,	'BycE+CkOSN/');

DROP TABLE IF EXISTS `today_prices`;
CREATE TABLE `today_prices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `modal` varchar(191) DEFAULT NULL,
  `max` varchar(191) DEFAULT NULL,
  `min` varchar(191) DEFAULT NULL,
  `commodity_id` int(11) NOT NULL,
  `mandi_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `today_prices` (`id`, `modal`, `max`, `min`, `commodity_id`, `mandi_id`, `created_at`, `updated_at`, `status`) VALUES
(1,	'1900',	'1905',	'1891',	1,	1,	'2019-01-21 09:37:10',	'2019-08-21 18:20:22',	1),
(2,	'1885',	'1900',	'1860',	1,	2,	'2019-01-21 09:37:41',	'2019-08-21 18:20:48',	1),
(3,	'5500',	'5800',	'5000',	3,	3,	'2019-01-21 09:39:20',	'2019-08-21 18:22:15',	1),
(4,	'4450',	'4600',	'4400',	4,	4,	'2019-01-21 09:39:54',	'2019-01-21 09:39:54',	1),
(5,	'2050',	'2100',	'2000',	2,	5,	'2019-01-21 09:40:23',	'2019-08-21 18:21:55',	1),
(6,	'1925',	'1950',	'1900',	1,	5,	'2019-01-21 09:41:47',	'2019-08-21 18:21:34',	1),
(7,	'4500',	'4600',	'4400',	4,	3,	'2019-01-21 09:42:22',	'2019-01-21 09:42:22',	1),
(8,	'4500',	'4600',	'4400',	5,	2,	'2019-01-21 09:43:03',	'2019-08-21 18:22:45',	1),
(9,	'5350',	'5400',	'5300',	3,	4,	'2019-01-21 09:43:57',	'2019-08-21 18:23:33',	1),
(10,	'4500',	'4600',	'4400',	5,	3,	'2019-01-21 09:44:30',	'2019-08-21 18:23:04',	1);

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fname` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lname` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `login_otp` varchar(6) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `register_otp` varchar(6) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `users` (`id`, `fname`, `lname`, `email`, `password`, `phone`, `login_otp`, `register_otp`, `remember_token`, `status`, `created_at`, `updated_at`) VALUES
(1,	'Admin',	'',	'admin@admin.com',	'$2y$10$JCJ6HuLpoDYa0obD88w0buwVOYjjK5/M59CxfPM/UDqtJHLb2uK5O',	'9413347010',	NULL,	NULL,	'oR0VdWIzuCfEzcswqcvYX6Jihn4guxNdkTLgKAfEdoziTICsUdSWdkCJukVb',	1,	'2018-09-01 08:17:09',	'2019-09-28 08:22:03'),
(2,	'Goverment',	NULL,	NULL,	'$2y$10$JCJ6HuLpoDYa0obD88w0buwVOYjjK5/M59CxfPM/UDqtJHLb2uK5O',	'9413145945',	NULL,	NULL,	'bXmTLRdeFyqjBGw1kJBhffU8PXZewz3CsUyOHuzXl0NKflzVQFgbSYOXmqGb',	1,	'2019-01-05 13:06:59',	'2019-02-26 01:39:03'),
(5,	'R K warehouse',	NULL,	'sanjayagarwalcacs@gmail.com',	'$2y$10$XSJQ9mtbDPE0UDKdI.dX.u5KehBZlmcqyA00KMD0l19PaOsJs0KTK',	'9413347010',	NULL,	NULL,	'MuYVoHdlml5md0nzAwe5Gsg8crFTdKe7acIhhRdlEx2910Al9xIm7w4ETm89',	1,	'2019-01-19 02:42:24',	'2019-09-17 04:36:47'),
(6,	'Trader ABC',	NULL,	NULL,	'$2y$10$.kBcaFkVq8ILwq.IhKEtneSYCcIIY/9nkpwnwqstgWUggth7kWu9a',	'9314142089',	NULL,	NULL,	'hU1COa79S2b0NduYqe2tf4UDVGbKiW6362XO7GZN1DviplxesP4ijl3kg31R',	1,	'2019-01-19 02:45:07',	'2019-10-01 03:12:02'),
(7,	'Trader XYZ',	NULL,	NULL,	'$2y$10$YXIAZMfvTIc3l3KNFuMi.uQEwDLI965oeLbOE0Z705J2pkAy8Trqu',	'8005731068',	NULL,	NULL,	'XSMTbd2XM4Sd1nLENpGl6i6HDiiv461zUD2tWx3RvUpJwWROndT4PApjzPua',	1,	'2019-01-19 02:49:00',	'2019-04-13 23:46:22'),
(8,	'PANKAJ LUHADIA',	NULL,	NULL,	'$2y$10$UTU.LlaDZEuB7ej11GF4euk5wYRVbcKZU5MozFQXBsqbSl7q.OeuS',	'9414074775',	NULL,	NULL,	'm6IZGOZtS5C6dnNYzsCnjRrXO6Mdw5HY5khhotJb3pc5IP6f2JtqsydogdEG',	1,	'2019-01-21 22:26:06',	'2019-04-15 20:39:52'),
(9,	'Chiraag Logistics Pvt Ltd',	NULL,	NULL,	'$2y$10$PsRBo0XuAgKEw4fHdOIFD..wcEyLPgCYi6L1lxRG2JCC7gZXymXBu',	'9667739497',	NULL,	NULL,	'3xn7HQVCFdRmm9wJoN2RpJn9Yn7Y4zbC5SBJX6hjF9aYx8cjlhx8nnNWrQTE',	1,	'2019-01-22 03:05:14',	'2019-08-28 23:16:58'),
(10,	'Mohan Trader',	NULL,	NULL,	'$2y$10$LiM8cHfQDqXEFoXJxivD/.N/wQjWJqxbI19SbI7CNTSj1C6MtzFbi',	'7340662089',	NULL,	NULL,	'zmyppgh3E4Xb9uNWCwj7iF6erOtSzXfI3FlK9eQgljD0QRpkhyhgQdvHer3g',	1,	'2019-01-22 03:05:15',	'2019-09-06 00:05:14'),
(11,	'shri guru trading company',	NULL,	NULL,	'$2y$10$UQt17o7sEFGnuPgDSea7cuzjN49Mf/5ZC3.0j4QXpJ6ygJ0BawtLG',	'8290049333',	NULL,	NULL,	'tqlmPpxMeVUcLV2GFTcIxW6ycinqJ02SBSW0RwCPfm1tXouf4hl2rWZo4rP1',	1,	'2019-01-22 23:35:09',	'2019-01-22 23:35:09'),
(12,	'Girish',	NULL,	NULL,	'$2y$10$R.PBD1U3nLNz5X/vcNHppeXO2IC014BwpkWA9vQaHTSQtriZq9ou6',	'9829066878',	NULL,	NULL,	'AjwBP1Jdde8dztv39rycqIwsO4F8SU3cm4K7ihuP56MJgB2hpL9xD657m6jM',	1,	'2019-01-24 23:26:58',	'2019-04-06 23:53:41'),
(13,	'Rekha Agarwal',	NULL,	NULL,	'$2y$10$Xyf6NrD4EhJQTY6bIa01We3w0Y/p9oE9RZYbxBBytY0.mDjCX6rgO',	'9352983232',	NULL,	NULL,	'2mNMOmJczbJOpWSW6uBGplu1GWApi2yB8nKWUZRAkfTxlfThIQDVCnxYf7XI',	1,	'2019-01-28 18:19:22',	'2019-09-01 17:34:02'),
(14,	'S.K.INDUSTRIES',	NULL,	NULL,	'$2y$10$3LRIjbGBWGGM8xi6mS7XbuwWG7d8oakB5wuRR3kBOEc9JXPCubv2G',	'9414016828',	NULL,	NULL,	NULL,	1,	'2019-02-22 18:53:59',	'2019-02-22 18:54:34'),
(15,	'Santosh',	NULL,	NULL,	'$2y$10$9TUDY8mVGPoKfCSxka4THezyTm6z1ANW3VwETRXfwZErQeN/MDrGq',	'9461375475',	NULL,	NULL,	NULL,	1,	'2019-03-05 20:31:09',	'2019-03-05 20:33:01'),
(16,	'MADAM',	NULL,	NULL,	'$2y$10$kYibN/VJgdc.ITKeCB52KOQ8x0AHDO5VINpcoe9NktNd3JOq3DXHq',	'9571780716',	NULL,	NULL,	NULL,	1,	'2019-03-05 20:36:38',	'2019-03-05 20:36:38'),
(20,	'trader abc',	NULL,	NULL,	'$2y$10$5NNnHpevVGcnse2D82e5BuzZFigQ1KjtYoYeGYKrDQnUqHpLfmg4e',	'9314142089',	NULL,	NULL,	'yBa3U4etqz16aRPWzUaLtU4G8nR2ciqmur2jaQOlhchTheeUGoxBS9bVwdJe',	1,	'2019-03-05 21:10:30',	'2019-10-01 03:12:02'),
(21,	'S R Traders',	NULL,	'anilkumarskr@gmail.com',	'$2y$10$oOcyMFBorIwSEcc7nMtqr.fKHR3zC0SOIgTY7NkCyrBZ9ydoh1P/G',	'9602047010',	NULL,	NULL,	'ViefZ1i6IUhFOCLLEEKheYYN6jNKlBLQtPPc7YDUDxRs2VKUB34xLf2p3nGv',	1,	'2019-03-05 21:19:27',	'2019-10-01 20:21:59'),
(22,	'naresh kumar ji',	NULL,	NULL,	'$2y$10$1D7y2naWwZIkZpa/.ALwDuthJbAM1TUpVb1qn2Rrk1u/Oy6auTph2',	'9818445400',	NULL,	NULL,	NULL,	1,	'2019-03-13 18:26:14',	'2019-04-13 23:02:07'),
(23,	'bhagwan das maheshwari',	NULL,	NULL,	'$2y$10$v.2sODNgIBySCwM9ZZR43erOPm9YIU917pe.zld6Ii9t4XCr17cla',	'9425928223',	NULL,	NULL,	NULL,	1,	'2019-03-20 18:24:39',	'2019-03-20 18:25:54'),
(24,	'anil kumar agarwal',	NULL,	NULL,	'$2y$10$7G/iUWptLbYDHNyWq4vlPO/LxGmcnzRpN1nnwwJog.Tb.kmyQSc3y',	'9001464041',	NULL,	NULL,	NULL,	1,	'2019-03-23 17:33:35',	'2019-03-23 17:33:49'),
(25,	'VINOD KUMAR JAIN',	NULL,	NULL,	'$2y$10$gBLj0.E7Yp4V9n7yyIl0fuRnMFl77PyQOjk6onad1AtcmqcXmojoS',	'9414077237',	NULL,	NULL,	NULL,	1,	'2019-03-25 21:45:52',	'2019-03-25 21:47:02'),
(26,	'poonam singh bhati',	NULL,	NULL,	'$2y$10$gSmbN2eWZjgfGqwlko.Bae.tYsfp1TPiTpAKz39B9gK21FUWbcLve',	'9636303151',	NULL,	NULL,	NULL,	1,	'2019-03-27 02:08:48',	'2019-03-27 02:08:57'),
(27,	'laxmi narayan and company',	NULL,	NULL,	'$2y$10$dXav4A9tjmjcBiKLL3NHQO51cPAOuA1SomTy85z9k6mbr8XRDOh9y',	'9829090760',	NULL,	NULL,	'nw2SYVDYYm1SZowQWgKlqCvq9BeweuBozpvYKgZ36c04fXtu8UCwsQXDYhro',	1,	'2019-04-04 17:23:33',	'2019-04-13 22:59:57'),
(28,	'MANISHJI',	NULL,	NULL,	'$2y$10$7GR0UdQQzp.drYRCeGGzoumNnobPnsDwtbPVOmfyGCZrOIGiZNLae',	'9991106445',	NULL,	NULL,	'iqQzEqqymraMJIZS6b948iNi6TpHXyyNiPvNpp9Zp3ixguPUCLkRict9mRbw',	1,	'2019-04-04 20:00:40',	'2019-04-13 23:01:05'),
(29,	'Sourav Agarwal',	NULL,	NULL,	'$2y$10$H6m2YbY8vL3NmIcErqMc9.Y.yavIge.1MrNER6DEpxn2GQZPQt4R6',	'9782752769',	NULL,	NULL,	'0NeJIKRpGaA8AXB3jt43FvwJJxNXdj8tCIDDTX6H0jrER9I21tW3nd3zHmvt',	1,	'2019-04-04 21:31:48',	'2019-04-18 19:57:59'),
(30,	'PAPRIWAL SADAN',	NULL,	NULL,	'$2y$10$06hBQtS1U77b3vpxbjoopuQoJsG9O3GJxR9nvSsy1avuTWfs0W1ua',	'9314475122',	NULL,	NULL,	'BqdYnYHCzJmAhjfqmLp6y59ZyE5ufAMGEfpWolYFbUB1tP0YQeE76vifqrHU',	1,	'2019-04-04 21:44:46',	'2019-04-27 00:41:05'),
(31,	'Mohan',	NULL,	NULL,	'$2y$10$qexAq6N.LG5vkb3AsypJj.NsLSqLI3y/WOCVUDiTbFQMCdVZdAiBi',	'8209012850',	NULL,	NULL,	'Uyl5TLUWJYCFGQTcqB40u5RMIJV1xGox14pJJKtNTgeIar5q9tn29CeCYyKo',	1,	'2019-04-04 22:25:35',	'2019-04-04 22:58:40'),
(32,	'M/S Mahanand Ram Balu ram',	NULL,	NULL,	'$2y$10$vRLhUszNF/QFDaonq72cfOhzkR0Slmnn1g9EpoBVWDBMQsC/pLviS',	'9910346906',	NULL,	NULL,	'AUO0oVlIbnP9YNawehego8wfZGo2wRW4mCywACIHbUwTCC27NusLlZHMCTMQ',	1,	'2019-04-04 23:34:47',	'2019-04-18 21:21:36'),
(33,	'ramchander ji agarwal',	NULL,	NULL,	'$2y$10$eSyKVJy7Z8HWbrkPMK9CzeaVxcvx/kmQIHH2dYdhloGztwb/ndwyW',	'9414681300',	NULL,	NULL,	'GAN0NOcM5ZhIzqsIC1qX16MxNOhDu7iaAr9i5t4XhnsIcLq6XTQU55spuWRg',	1,	'2019-04-06 22:54:35',	'2019-04-15 20:40:20'),
(34,	'Seller Shree Shyam Trading comapny',	NULL,	NULL,	'$2y$10$I8WIOduAAmVyc0GvTwN4vu5p8XspkrW0dsihG9IKUwxImvbqVfDtG',	'8005542731',	NULL,	NULL,	'cDZMTiwxgRPSiPhMApvIY49yJpBebFGU0WoB7zDntNOQtGAsTMCekyH5Av1F',	1,	'2019-04-06 23:11:39',	'2019-04-18 19:05:31'),
(35,	'RAM GUPTA',	NULL,	NULL,	'$2y$10$kiA.ZMmekrl5Hen5JlHTeOcn6woeHRylvp17jrCEDAVLzuBoL3FRG',	'9829064704',	NULL,	NULL,	NULL,	1,	'2019-04-13 20:17:32',	'2019-04-14 01:58:26'),
(36,	'HITESH GOYAL',	NULL,	NULL,	'$2y$10$8liGLJt5WwEBSLTZ0RzkWOVf58Tsb5Sbk4tl5cxs4lv7zMdnm9oRS',	'9929999521',	NULL,	NULL,	NULL,	1,	'2019-04-13 22:30:42',	'2019-04-15 20:38:59'),
(37,	'brijendra singh',	NULL,	NULL,	'$2y$10$Nr2602F7drfqv08KTX/U4u..mral5lveB48XSfwbIefhkIjCxv166',	'9414060735',	NULL,	NULL,	'17VhOsi9UaZLxrOspjrF5TSmelOcRDo2y8nBYkeC6HZnkGQ7UgpHOl9L4J45',	1,	'2019-04-13 23:27:26',	'2019-04-13 23:27:56'),
(38,	'Omprakash agarwal',	NULL,	NULL,	'$2y$10$461qeFUldaoXzSv7aiBWiOn2/.RXDeEF5YkigG3AgfcMxPlzcT902',	'9829052569',	NULL,	NULL,	NULL,	1,	'2019-04-14 00:23:03',	'2019-04-14 00:23:22'),
(39,	'gajanand',	NULL,	NULL,	'$2y$10$nAdEcU4YHtbbv1rxALMjaeoBBvEe9vAZFuJcKO5FYGPcHL001xTyC',	'9829147405',	NULL,	NULL,	NULL,	1,	'2019-04-18 21:38:51',	'2019-04-18 21:39:31'),
(40,	'mohanji mandi',	NULL,	NULL,	'$2y$10$dzpJtqs13jxQ1YNb8t1neurMyEEWA4YjEkdkzq9uqdZTJpAyt8/L6',	'9414219121',	NULL,	NULL,	'U1KSqeJfxhKBWutxdcV7FYgWt53xHvMWpGl3LBMgfi9IYjRlrLs9FUnYKFq3',	1,	'2019-04-30 20:41:10',	'2019-04-30 23:30:18'),
(41,	'piyush poddar',	NULL,	NULL,	'$2y$10$.4JaF267jw5Awb2MMezUJOogFYa3elINF6N9YBFFMsF5yUg4FrnX2',	'9460441600',	NULL,	NULL,	NULL,	1,	'2019-05-11 20:34:39',	'2019-05-11 20:34:56'),
(42,	'Giriraj Ji',	NULL,	NULL,	'$2y$10$QeyIA5BmK64P.Y42Gs5a1ePeyvLc6JUPdVu2.y7UD3XJD2f/0ZpjK',	'9314289736',	NULL,	NULL,	NULL,	1,	'2019-06-06 22:17:31',	'2019-06-06 22:17:44'),
(46,	'Rama Agro Solutions',	NULL,	'rkbhatia@pearlmalt.com',	'$2y$10$RR9GRSqtFPQvtlRRJohaKe4esflgeVK9xrOjGGwN6YRzO73O1.br.',	'9650572211',	NULL,	NULL,	NULL,	1,	'2019-09-04 21:40:31',	'2019-09-16 22:12:04'),
(47,	'Manoj Kumar Agrawal',	NULL,	NULL,	'$2y$10$jksdMtppkW5qJtWVuv9XrOcfU3usC2CqVPJechU9niKUuCJ.CPzRi',	'9414565500',	NULL,	NULL,	'QQU2aFwkT8bq950R1V4U3RDDRapOKjqWhaIlWO9CW4Ix0FwDvjlXFn6kH1Jy',	1,	'2019-09-05 23:26:59',	'2019-09-06 00:18:12'),
(49,	'Anish',	NULL,	NULL,	'$2y$10$LKd2qcLVYIKUjB3UAsitje8l3eB4Hz4ZgpJXmg8j9JO.ZeX9zw9kW',	'9314927902',	NULL,	NULL,	NULL,	1,	'2019-09-11 00:50:28',	'2019-09-11 00:50:38'),
(90,	'sanjay agarwal',	NULL,	NULL,	'$2y$10$4PX2IkWWKAECmT/D5vOfVuKPlySSzL1f7TFYLmznPNy0w/V1GSffa',	'9314142089',	NULL,	NULL,	NULL,	1,	'2019-09-16 20:14:27',	'2019-10-01 03:12:02'),
(94,	'vaibhav',	NULL,	NULL,	'$2y$10$8vmYky3mNuRFmRv8SUGNIOfPaqPXp/xRN6aI/6LHcxJBD.g47sKLu',	'9591873983',	NULL,	NULL,	NULL,	1,	'2019-09-17 03:59:33',	'2019-09-17 03:59:33'),
(95,	'Rekha Agarwal',	NULL,	NULL,	'$2y$10$tGUaHCZj.9h1bwrfkpBYq.FlnnkO5y..AHXfEjUl0py9xXkR4SJK2',	'9352983232',	NULL,	NULL,	NULL,	1,	'2019-09-17 04:02:25',	'2019-09-17 04:02:25'),
(97,	'sanjay agarwal',	NULL,	NULL,	'$2y$10$ecK7dl6dyjnqch3pR5gpMO63tAsanNFCpO1ZK/V4L4v0Xb465Rk/u',	'9314142089',	NULL,	NULL,	NULL,	1,	'2019-09-17 06:05:52',	'2019-10-01 03:12:02'),
(101,	'suresh kumar jakhar',	NULL,	NULL,	'$2y$10$zHaKThiPzbSApos0dSOl2.w7dgMQev82nOq/bJK6lmyhRaKVB0Qq2',	'9414329304',	NULL,	NULL,	NULL,	1,	'2019-09-17 17:12:04',	'2019-09-17 17:12:04'),
(102,	'vimal ji',	NULL,	NULL,	'$2y$10$yXR.dvCGTj0nL0S.yD09juncVdis97kFcN/Y1/0zaxhthLUD7B.xO',	'9414550800',	NULL,	NULL,	NULL,	1,	'2019-09-17 18:06:28',	'2019-09-17 18:06:28'),
(103,	'sunil',	NULL,	NULL,	'$2y$10$m8LphQPjYuQdDSAtEvLBXeNj0tu9gPkr8tMlBUvG7cKC1kWsnBf5G',	'9799540379',	NULL,	NULL,	NULL,	1,	'2019-09-17 19:50:41',	'2019-09-17 19:50:41'),
(106,	'a k',	NULL,	NULL,	'$2y$10$xCcEHvT86.c.wsUSBvFWx.z7ZsL7HbASHkJYCie.X7eO7GP8T4GHa',	'9887907173',	NULL,	NULL,	NULL,	1,	'2019-09-19 16:37:39',	'2019-09-19 16:37:39'),
(108,	'Dinesh',	NULL,	NULL,	'$2y$10$hRWPxbreoh48VwwFsQ08ROMt0zHQwIB6BAyvTjVjUjMpkaOTSic5y',	'9784350571',	NULL,	NULL,	'jACAzsCWv5JMwkfLY0gE2APX99opqarc93S3MjrpqqmhQrbGb1bdjoslLAPY',	1,	'2019-09-19 19:20:15',	'2019-09-19 21:38:17'),
(111,	'SURESH KUMAR JAKHAR',	NULL,	NULL,	'$2y$10$HRrwBO5KMYc9C9SSlebU.OU5iIkLC5Jkg2muOHzm19OC8sdMutcra',	'9414329304',	NULL,	NULL,	NULL,	1,	'2019-09-21 03:43:59',	'2019-09-21 03:43:59'),
(114,	'sunil Kumar gupta',	NULL,	NULL,	'$2y$10$yJAEa.g9KL/G5eTNPTEeAOT1RUgkhC2WyBlW2SrxCMGsmVOBxL9bW',	'9799540379',	NULL,	NULL,	NULL,	1,	'2019-09-22 01:08:56',	'2019-09-22 01:08:56'),
(116,	'sitaram Agarwal',	NULL,	NULL,	'$2y$10$HApUWOkzCTak.sSUgOE5su5i2aUgABffXeVDc44li.PXznCXQg0X2',	'9414079824',	NULL,	NULL,	NULL,	1,	'2019-09-22 16:20:59',	'2019-09-22 16:20:59'),
(119,	'ASHOK SINGH SHEKHAWAT',	NULL,	NULL,	'$2y$10$2E8834/FQVPOJYE7hPllou8VvrpB49QZP2LUfjbHuGWvyQf1fICO6',	'9828126169',	NULL,	NULL,	NULL,	1,	'2019-09-23 20:13:28',	'2019-09-23 20:13:28'),
(120,	'pradeep agarwal',	NULL,	NULL,	'$2y$10$Y0GT4cwIMKfWOpFA2WS2yObS.B/1ZbGkqVtqfE8rjyYdc8Hf.XurS',	'9833596060',	NULL,	NULL,	NULL,	1,	'2019-09-23 23:01:41',	'2019-09-23 23:01:41'),
(219,	'prem',	NULL,	NULL,	'$2y$10$dHMUInX7X9dXjMtzCWevs.0RR6PyMYt2tJp4oi6xmDT1gSfU8g7te',	'8005609866',	NULL,	NULL,	NULL,	1,	'2019-10-01 20:38:55',	'2019-10-01 20:38:55');

DROP TABLE IF EXISTS `user_details`;
CREATE TABLE `user_details` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
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
  `profile_image` text COLLATE utf8mb4_unicode_ci,
  `aadhar_image` text COLLATE utf8mb4_unicode_ci,
  `cheque_image` text COLLATE utf8mb4_unicode_ci,
  `firm_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` longtext COLLATE utf8mb4_unicode_ci,
  `mandi_license` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `latitude` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `longitude` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `user_details` (`id`, `user_id`, `fname`, `lname`, `email`, `phone`, `father_name`, `category`, `gst_number`, `khasra_no`, `village`, `tehsil`, `district`, `image`, `power`, `aadhar_no`, `bank_name`, `bank_branch`, `bank_acc_no`, `bank_ifsc_code`, `profile_image`, `aadhar_image`, `cheque_image`, `firm_name`, `address`, `mandi_license`, `latitude`, `longitude`, `status`, `created_at`, `updated_at`) VALUES
(3,	5,	'R K warehouse',	NULL,	'sanjayagarwalcacs@gmail.com',	'9413347010',	'dummy',	1,	NULL,	NULL,	'dummy',	NULL,	'dummy',	'user.png',	'1',	'8236482',	'dummy',	'dummy',	'4823648273',	'dummy',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	1,	'2019-01-19 02:42:24',	'2019-04-07 00:21:40'),
(4,	6,	'Trader ABC',	NULL,	NULL,	'9314142089',	NULL,	2,	'7426374',	NULL,	NULL,	NULL,	NULL,	'user.png',	'1',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'Trader ABC',	'dummy',	'dummy',	NULL,	NULL,	1,	'2019-01-19 02:45:07',	'2019-04-13 23:07:08'),
(5,	7,	'Trader XYZ',	NULL,	NULL,	'8005731068',	NULL,	2,	'874638746',	NULL,	NULL,	NULL,	NULL,	'user.png',	'1',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'Trader XYZ',	'dummy',	'dummy',	NULL,	NULL,	1,	'2019-01-19 02:49:00',	'2019-04-13 23:07:35'),
(6,	8,	'PANKAJ LUHADIA',	NULL,	NULL,	'9414074775',	NULL,	2,	'08AAGCK5273Q1ZS',	NULL,	NULL,	NULL,	NULL,	'user.png',	'4100000',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'KISSAN AGROVET  PRIVATE LIMITED',	'F17-18, RICCO INDUSTRIAL AREA\r\nDUDU',	'DD/TD/140',	NULL,	NULL,	1,	'2019-01-21 22:26:06',	'2019-04-15 20:39:52'),
(7,	9,	'Chiraag Logistics Pvt Ltd',	NULL,	NULL,	'9667739497',	'CHOTU RAM JAT',	1,	NULL,	NULL,	NULL,	NULL,	NULL,	'user.png',	'1',	NULL,	'ASADSGFGJHJGH',	'GFHJFJHK',	'12132121212332',	'JJGJHG443543',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	1,	'2019-01-22 03:05:14',	'2019-04-17 23:13:18'),
(8,	10,	'Mohan Trader',	NULL,	NULL,	'7340662089',	NULL,	2,	'dummy',	NULL,	NULL,	NULL,	NULL,	'user.png',	'1',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'Mohan Trader',	'dummy',	'dummy',	NULL,	NULL,	1,	'2019-01-22 03:05:15',	'2019-04-13 23:01:45'),
(9,	11,	'shri guru trading company',	NULL,	NULL,	'8290049333',	'Shri devendra kumar agarwal',	NULL,	NULL,	NULL,	'khatushyam',	NULL,	'sikar',	'user.png',	'1',	NULL,	'axis bank',	'khatushyam',	'911020020279526',	'utib0001427',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	1,	'2019-01-22 23:35:09',	'2019-01-22 23:35:09'),
(10,	12,	'Girish',	NULL,	NULL,	'9829066878',	'-',	NULL,	NULL,	NULL,	'-',	NULL,	'-',	'user.png',	'1',	'123',	'-',	'-',	'-345',	'-',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	1,	'2019-01-24 23:26:58',	'2019-01-24 23:26:58'),
(11,	13,	'Rekha Agarwal',	NULL,	NULL,	'9352983232',	'G.L.Pansari',	NULL,	NULL,	NULL,	'chokri',	NULL,	'sikar',	'user.png',	'1',	'35655455',	'hdfc',	'vkia',	'502675325',	'HDFC000374',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	1,	'2019-01-28 18:19:22',	'2019-01-28 18:19:22'),
(12,	14,	'S.K.INDUSTRIES',	NULL,	NULL,	'9414016828',	NULL,	NULL,	'08AAWFS7606Q1Z1',	NULL,	NULL,	NULL,	NULL,	'user.png',	'1',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'S.K.INDUSTRIES',	'1,O.I.A.',	'RAJASTHAN',	NULL,	NULL,	1,	'2019-02-22 18:53:59',	'2019-02-22 18:53:59'),
(13,	15,	'Santosh',	NULL,	NULL,	'9461375475',	'Dummy',	NULL,	NULL,	NULL,	'Dummy',	NULL,	'Dummy',	'user.png',	'1',	'2513645798',	'Dummy',	'Dummy',	'563782885388',	'Dummy',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	1,	'2019-03-05 20:31:09',	'2019-03-05 20:31:09'),
(14,	16,	'MADAM',	NULL,	NULL,	'9571780716',	'DUMMY',	NULL,	NULL,	NULL,	'PANT BHAWAN',	NULL,	'JAIPUR',	'user.png',	'1',	'21235445421324',	'HDFC BANK',	'VKIA branch',	'00861020000834',	'hdfc3774',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	1,	'2019-03-05 20:36:38',	'2019-03-05 20:36:38'),
(18,	20,	'trader abc',	NULL,	NULL,	'9314142089',	NULL,	2,	'dummy',	NULL,	NULL,	NULL,	NULL,	'user.png',	'1',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'trader abc',	'dummy',	'dummy',	NULL,	NULL,	1,	'2019-03-05 21:10:30',	'2019-04-13 23:07:20'),
(19,	21,	'S R Traders',	NULL,	'anilkumarskr@gmail.com',	'9602047010',	NULL,	2,	NULL,	NULL,	'Jaipur',	'Jaipur',	'Jaipur',	'user.png',	'3000000',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'Trader Xyz',	'dummy',	'dummy',	NULL,	NULL,	1,	'2019-03-05 21:19:27',	'2019-09-05 19:46:35'),
(20,	22,	'naresh kumar ji',	NULL,	NULL,	'9818445400',	NULL,	2,	NULL,	NULL,	NULL,	NULL,	NULL,	'user.png',	'1',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'Mahanand ram baluram',	'heli mandi',	NULL,	NULL,	NULL,	1,	'2019-03-13 18:26:13',	'2019-04-13 23:02:07'),
(21,	23,	'bhagwan das maheshwari',	NULL,	NULL,	'9425928223',	NULL,	NULL,	'23AIXPM2152Q1ZL',	NULL,	NULL,	NULL,	NULL,	'user.png',	'1',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'maheshwari corporation',	'near the jain  mandir, bajrang chouk, khandwa (mp)',	'357',	NULL,	NULL,	1,	'2019-03-20 18:24:39',	'2019-03-20 18:24:39'),
(22,	24,	'anil kumar agarwal',	NULL,	NULL,	'9001464041',	NULL,	NULL,	'08BLVPA7838P1Z3',	NULL,	NULL,	NULL,	NULL,	'user.png',	'1',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'anil kirana store',	'village ghatwari, via post ghatwari, tehsil jamwaramgarh jaipur',	'111111',	NULL,	NULL,	1,	'2019-03-23 17:33:35',	'2019-03-23 17:33:35'),
(23,	25,	'VINOD KUMAR JAIN',	NULL,	NULL,	'9414077237',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'user.png',	'1',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'VINOD AND COMPANY',	'KK\\G-08, KRISHNA KRIPA 1ST, SUBHASH NAGAR. JAIPUR',	NULL,	NULL,	NULL,	1,	'2019-03-25 21:45:51',	'2019-03-25 21:45:51'),
(24,	26,	'poonam singh bhati',	NULL,	NULL,	'9636303151',	'Prithvi Singh Bhati',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'user.png',	'1',	NULL,	'hdfc bank',	'jaipur',	'12121131',	'hjdvhc',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	1,	'2019-03-27 02:08:48',	'2019-03-27 02:08:48'),
(25,	27,	'laxmi narayan and company',	NULL,	NULL,	'9829090760',	NULL,	2,	NULL,	NULL,	NULL,	NULL,	NULL,	'user.png',	'1',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'puneet agarwal',	NULL,	NULL,	NULL,	NULL,	1,	'2019-04-04 17:23:32',	'2019-04-13 22:59:57'),
(26,	28,	'MANISHJI',	NULL,	NULL,	'9991106445',	NULL,	2,	NULL,	NULL,	NULL,	NULL,	NULL,	'user.png',	'1',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'KISHORI LAL OMPRAKASH',	NULL,	NULL,	NULL,	NULL,	1,	'2019-04-04 20:00:40',	'2019-04-13 23:01:05'),
(27,	29,	'Sourav Agarwal',	NULL,	NULL,	'9782752769',	NULL,	2,	'08ADVFS4937L1Z2',	NULL,	NULL,	NULL,	NULL,	'user.png',	'1',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'Shree Shyam Trading Company',	'I-17, Rajdhani Krishi Mandi, Kukerkheda, Sikar road Jaipur -302013',	'CP/JT-3',	NULL,	NULL,	1,	'2019-04-04 21:31:48',	'2019-04-13 23:06:53'),
(28,	30,	'PAPRIWAL SADAN',	NULL,	NULL,	'9314475122',	NULL,	2,	'08AAMCS0191B1ZI',	NULL,	NULL,	NULL,	NULL,	'user.png',	'1',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'SUPERIOR MALT PVT LTD',	'OUT SIDE KATLA MARKET',	'RAJASTHAN',	NULL,	NULL,	1,	'2019-04-04 21:44:46',	'2019-04-09 22:19:06'),
(29,	31,	'Mohan',	NULL,	NULL,	'8209012850',	'Chhotu Ram Jat',	NULL,	NULL,	NULL,	'manpura',	NULL,	'jaipur',	'user.png',	'1',	'610920397873',	'Canara Bank',	'Vidhyadhar Nagar',	'2877108001305',	'CNRB0002877',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	1,	'2019-04-04 22:25:35',	'2019-04-04 22:25:35'),
(30,	32,	'M/S Mahanand Ram Balu ram',	NULL,	NULL,	'9910346906',	NULL,	2,	NULL,	NULL,	NULL,	NULL,	NULL,	'user.png',	'4100000',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'Naresh Aggarwal',	'Haily mandi',	'Haryana',	NULL,	NULL,	1,	'2019-04-04 23:34:47',	'2019-04-18 21:21:36'),
(31,	33,	'ramchander ji agarwal',	NULL,	NULL,	'9414681300',	NULL,	2,	NULL,	NULL,	NULL,	NULL,	NULL,	'user.png',	'4100000',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'rashtriya khadyaan',	'alwar',	NULL,	NULL,	NULL,	1,	'2019-04-06 22:54:35',	'2019-04-15 20:40:20'),
(32,	34,	'Seller Shree Shyam Trading comapny',	NULL,	NULL,	'8005542731',	'Dummy',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'user.png',	'1',	NULL,	'SBI',	'Jaipur',	'54654',	'SBIN00',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	1,	'2019-04-06 23:11:39',	'2019-04-06 23:11:39'),
(33,	35,	'RAM GUPTA',	NULL,	NULL,	'9829064704',	NULL,	2,	NULL,	NULL,	NULL,	NULL,	NULL,	'user.png',	'1',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'S.R.INDUSTRIES',	'138,\r\n,UDYOG VIHAR,JETPURA ,JAIPUR',	'11',	NULL,	NULL,	1,	'2019-04-13 20:17:31',	'2019-04-14 01:58:26'),
(34,	36,	'HITESH GOYAL',	NULL,	NULL,	'9929999521',	NULL,	2,	'08AAVFA8237E1Z4',	NULL,	NULL,	NULL,	NULL,	'user.png',	'4100000',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'AGARWAL AGRO INDUSTRIES',	'F 74 & 73 C, AGRO FOOD PARK , MIA , ALWAR',	'773',	NULL,	NULL,	1,	'2019-04-13 22:30:42',	'2019-04-15 20:38:59'),
(35,	37,	'brijendra singh',	NULL,	NULL,	'9414060735',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'user.png',	'1',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'abusaria enterprises',	'vkia, jaipur',	'11',	NULL,	NULL,	1,	'2019-04-13 23:27:25',	'2019-04-13 23:27:25'),
(36,	38,	'Omprakash agarwal',	NULL,	NULL,	'9829052569',	NULL,	NULL,	'08abmpa6817e2zr',	NULL,	NULL,	NULL,	NULL,	'user.png',	'1',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'gripwel industries',	'jhotara, jaipur',	'11',	NULL,	NULL,	1,	'2019-04-14 00:23:03',	'2019-04-14 00:23:03'),
(37,	39,	'gajanand',	NULL,	NULL,	'9829147405',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'user.png',	'1',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'Gupta Agaro',	'C/O Gajanand Gupta, d-148 (b), ambabari, , , Amba Bari',	'RAJASTHAN',	NULL,	NULL,	1,	'2019-04-18 21:38:51',	'2019-04-18 21:38:51'),
(38,	40,	'mohanji mandi',	NULL,	NULL,	'9414219121',	'banshidhar sharma',	NULL,	NULL,	NULL,	'devthala',	NULL,	'jaipur',	'user.png',	'1',	'373320157672',	'sbi',	'mandi chomu',	'61052760910',	'sbin0032024',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	1,	'2019-04-30 20:41:10',	'2019-04-30 20:41:10'),
(39,	41,	'piyush poddar',	NULL,	NULL,	'9460441600',	'rahu veer gupta',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'user.png',	'1',	NULL,	'rrrrr',	'ttt',	'I 66',	'ffr',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	1,	'2019-05-11 20:34:39',	'2019-05-11 20:34:39'),
(40,	42,	'Giriraj Ji',	NULL,	NULL,	'9314289736',	NULL,	NULL,	'xyz',	NULL,	NULL,	NULL,	NULL,	'user.png',	'1',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'Shri Ram Industries',	'Phulera',	'abc',	NULL,	NULL,	1,	'2019-06-06 22:17:31',	'2019-06-06 22:17:31'),
(41,	43,	'q',	NULL,	NULL,	'1234567890',	'q',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'user.png',	'1',	NULL,	'qq',	'q',	'q',	'q',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	1,	'2019-08-21 23:52:01',	'2019-08-21 23:52:01'),
(42,	44,	'FA',	NULL,	NULL,	'9874561224',	'AF',	NULL,	NULL,	NULL,	'SF',	NULL,	'AF',	'user.png',	'1',	'15548461315',	'FAS',	'AS',	'1111000022223',	'ASD21510',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	1,	'2019-08-29 22:14:54',	'2019-08-29 22:14:54'),
(43,	45,	'DADF',	NULL,	NULL,	'9874563210',	'ASD',	NULL,	NULL,	NULL,	'1SD',	NULL,	'SD',	'user.png',	'1',	'123654794111',	'DF',	'FSDF',	'1231548454611',	'SD151313',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	1,	'2019-08-29 22:15:40',	'2019-08-29 22:15:40'),
(44,	46,	'Rama Agro Solutions',	NULL,	'rkbhatia@pearlmalt.com',	'9650572211',	NULL,	2,	'08ACCPB9238R1Z3',	NULL,	NULL,	NULL,	NULL,	'user.png',	'103080',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'RK',	'Kotputli',	NULL,	NULL,	NULL,	1,	'2019-09-04 21:40:31',	'2019-09-06 02:02:42'),
(45,	47,	'Manoj Kumar Agrawal',	NULL,	NULL,	'9414565500',	NULL,	NULL,	'08AGRPA9964G1ZV',	NULL,	NULL,	NULL,	NULL,	'user.png',	'1',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'Shri Balaji Enterprises',	'9A1 Anand choraha, Opp Tata Steel Yard \r\nNiwaru Road, Jhotwara, Jaipur',	NULL,	NULL,	NULL,	1,	'2019-09-05 23:26:59',	'2019-09-05 23:26:59'),
(46,	48,	'softtrade',	NULL,	NULL,	'9829957850',	'jaipur',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'user.png',	'1',	NULL,	'abc',	'jpr',	'01234567890',	'punb0123',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	1,	'2019-09-11 00:47:27',	'2019-09-11 00:47:27'),
(47,	49,	'Anish',	NULL,	NULL,	'9314927902',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'user.png',	'1',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'softtrade',	'C-58A, Ambabari\r\nJaipur',	'Rajasthan',	NULL,	NULL,	1,	'2019-09-11 00:50:28',	'2019-09-11 00:50:28'),
(50,	58,	'zjjzgzk',	NULL,	NULL,	'shhsbz',	'zgzhjs',	NULL,	NULL,	NULL,	'znznb',	NULL,	'xnnzb',	NULL,	'1',	'zjzjb',	'snmzb',	'znjzb',	'zjzkbzv',	'zjzjvz',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	1,	'2019-09-12 07:00:00',	'2019-09-12 07:00:00'),
(51,	59,	'ch hbono',	NULL,	NULL,	'xhvhjvhc',	'gcvjhbj',	NULL,	NULL,	NULL,	'fvnj',	NULL,	'cjbcj',	NULL,	'1',	'fhjbv',	'fhjb',	'vcnk',	'duhvj',	'cvhjj',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	1,	'2019-09-13 07:00:00',	'2019-09-13 07:00:00'),
(52,	60,	'sbsmnzn',	NULL,	NULL,	'ehhdbd',	'dmxxn',	NULL,	NULL,	NULL,	'dklxnxn',	NULL,	'dlkxnzb',	NULL,	'1',	'xmlxnxbxmx',	'xkkznzb',	'xlkznzb',	'xkkznbz',	'xkmznbz',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	1,	'2019-09-13 07:00:00',	'2019-09-13 07:00:00'),
(53,	61,	'sjjsbsbs',	NULL,	NULL,	'nsksn',	'jsjsjjshsh',	NULL,	NULL,	NULL,	'shshhsshsjjs',	NULL,	'hshjsjs',	NULL,	'1',	'shhshdbs',	'shsjns',	'shskms',	'shdnms',	'shdkks',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	1,	'2019-09-13 07:00:00',	'2019-09-13 07:00:00'),
(54,	62,	'vgjjkk',	NULL,	NULL,	'nggnk',	'vhjjvvh',	NULL,	NULL,	NULL,	'bknn',	NULL,	'vkmn',	NULL,	'1',	'vvjnj',	'fjn',	'vknb',	'gknb',	'vkkbg',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	1,	'2019-09-13 07:00:00',	'2019-09-13 07:00:00'),
(55,	71,	'nzjdmnx',	NULL,	NULL,	'2783837859',	'djxjnxnkxxk',	NULL,	NULL,	NULL,	'xnjxnxmmx',	NULL,	'xnjxnxmxb',	NULL,	'1',	'dnjxjnxbxm',	'dnjxnsbdb',	'fnkdndbsb',	'377447849',	'xhjxnxbbxx',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	1,	'2019-09-13 07:00:00',	'2019-09-13 07:00:00'),
(56,	72,	'zjjsznsm',	NULL,	NULL,	'8233493679',	'sgshjs dkdkv shsjsh',	NULL,	NULL,	NULL,	'37838+3',	NULL,	'zhhzvz dndjdn',	NULL,	'1',	'sjsjh',	'dbhxhssv',	'djzz',	'xbnzbzvz',	'shshd dnsjdb',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	1,	'2019-09-13 07:00:00',	'2019-09-13 07:00:00'),
(57,	73,	'mohan',	NULL,	NULL,	'8890801632',	'nanak ram',	NULL,	NULL,	NULL,	'khora',	NULL,	'jaipur',	NULL,	'1',	'63837347',	'syndicate',	'khora',	'737382828282882',	'7373 yu jdjs',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	1,	'2019-09-13 07:00:00',	'2019-09-13 07:00:00'),
(58,	74,	'hfhsjs',	NULL,	NULL,	'0987654321',	'msn n',	NULL,	NULL,	NULL,	'jdhxns',	NULL,	'fjcnc',	NULL,	'1',	'1294764829183',	'cncjx',	'cnnccn',	'ncmccn',	'ncmcncxs7',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	1,	'2019-09-13 07:00:00',	'2019-09-13 07:00:00'),
(59,	75,	'amit',	NULL,	NULL,	'8003947560',	'ashok',	NULL,	NULL,	NULL,	'jsjsjsj',	NULL,	'shzhhz',	NULL,	'1',	'gshshsh',	'zhzhhz',	'hzbzv',	'hzhzbz',	'zhhzgz',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	1,	'2019-09-13 07:00:00',	'2019-09-13 07:00:00'),
(60,	76,	'thuluntju',	NULL,	NULL,	'4567889998',	'ghulam lyk',	NULL,	NULL,	NULL,	'dhjjhggg',	NULL,	'dyukoo',	NULL,	'1',	'fnykyj',	'fghio',	'dryjo',	'dfguj',	'dgujo',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	1,	'2019-09-14 07:00:00',	'2019-09-14 07:00:00'),
(61,	77,	'njdndnxnnx',	NULL,	NULL,	'8233492653',	'cghbvvcccvv',	NULL,	NULL,	NULL,	'vvhvv',	NULL,	'bhvbkk',	NULL,	'1',	'vvvjnnbvv',	'gbvbb',	'cbjn',	'858896282',	'gjjgbk',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	1,	'2019-09-14 07:00:00',	'2019-09-14 07:00:00'),
(62,	78,	'sheetal',	NULL,	NULL,	'8233496823',	'mahendra singh',	NULL,	NULL,	NULL,	'ajmer',	NULL,	'ajmer',	NULL,	'1',	'692300903550',	'icici',	'ajmer',	'856431225464855646',	'ajmerifsc',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	1,	'2019-09-15 07:00:00',	'2019-09-15 07:00:00'),
(63,	79,	'ussuvsskv',	NULL,	NULL,	'7014432414',	'jsbebeb',	NULL,	NULL,	NULL,	'nsbdbdhdh',	NULL,	'sjdjdbddb',	NULL,	'1',	'272762',	'gshsh',	'heheueb',	'646568',	'bxjdjx',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	1,	'2019-09-15 07:00:00',	'2019-09-28 08:10:56'),
(64,	80,	'prem',	NULL,	NULL,	'8005609866',	'father',	NULL,	NULL,	NULL,	'banwas',	NULL,	'jhunjhunu',	NULL,	'1',	'sbdhhj',	'sbi',	'ktn',	'61145255685',	'snjdvdb',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	1,	'2019-09-15 07:00:00',	'2019-09-15 07:00:00'),
(65,	81,	'sheetal',	NULL,	NULL,	'8233493056',	'mahendra singh',	NULL,	NULL,	NULL,	'ajmer',	NULL,	'ajmer',	NULL,	'1',	'692300903550',	'icici',	'ajmer',	'8234651789455',	'jaipur',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	1,	'2019-09-15 07:00:00',	'2019-09-15 07:00:00'),
(66,	82,	'sheetal',	NULL,	NULL,	'8233493056',	'mahendra singh',	NULL,	NULL,	NULL,	'ajmer',	NULL,	'ajmer',	NULL,	'1',	'692300903550',	'icici',	'ajmer',	'8234651789455',	'jaipur',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	1,	'2019-09-15 07:00:00',	'2019-09-15 07:00:00'),
(67,	83,	'gagshzb',	NULL,	NULL,	'8233493049',	'avzhzb',	NULL,	NULL,	NULL,	'zvvzjavc',	NULL,	'sfgzhzvzv',	NULL,	'1',	'7554316757846',	'Vgzjbzvbzjz',	'sggshvvznzg',	'8243551678545',	'svgshzvzvgzb',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	1,	'2019-09-15 07:00:00',	'2019-09-15 07:00:00'),
(68,	84,	'fhb',	NULL,	NULL,	'8233499685',	'fgb',	NULL,	NULL,	NULL,	'dhbb',	NULL,	'chbb',	NULL,	'1',	'58998658',	'chb',	'chnb',	'86988',	'cjnvv',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	1,	'2019-09-15 07:00:00',	'2019-09-15 07:00:00'),
(69,	85,	'zvBz',	NULL,	NULL,	'8244352945',	'zvzbzzvzz',	NULL,	NULL,	NULL,	'zbzx',	NULL,	'xbsnd',	NULL,	'1',	'79797',	'ddbxx',	'xbshd',	'88946545',	'dbsnx',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	1,	'2019-09-15 07:00:00',	'2019-09-15 07:00:00'),
(70,	86,	'sheetal',	NULL,	NULL,	'8233496823',	'papa',	NULL,	NULL,	NULL,	'ajmer',	NULL,	'ajmer',	NULL,	'1',	'823445167945',	'agjxjxb',	'zvvdhsbab',	'45816724546',	'aggjdbzczb',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	1,	'2019-09-15 07:00:00',	'2019-09-15 07:00:00'),
(71,	87,	'sheetal',	NULL,	NULL,	'8233493016',	'mahendra',	NULL,	NULL,	NULL,	'ajmer',	NULL,	'ajmer',	NULL,	'1',	'5623456285',	'icici',	'jaipur',	'85629956235485623',	'jaipur',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	1,	'2019-09-16 07:00:00',	'2019-09-16 07:00:00'),
(72,	88,	'cfgg',	NULL,	NULL,	'9602947878',	'vvvg',	NULL,	NULL,	NULL,	'ggh',	NULL,	'ggh',	NULL,	'1',	'8889',	'ggg',	'vgh',	'999',	'vgh',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	1,	'2019-09-16 07:00:00',	'2019-09-30 02:10:42'),
(74,	90,	'sanjay agarwal',	NULL,	NULL,	'9314142089',	'sitaram agarwal',	NULL,	NULL,	NULL,	'singod',	NULL,	'jaipur',	NULL,	'1',	'872814017110',	'hdfc bank',	'vkia branch',	'00861020000834',	'HDFC0003774',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	1,	'2019-09-16 07:00:00',	'2019-09-16 07:00:00'),
(76,	92,	'dagags',	NULL,	NULL,	'9414079824',	'shshshs',	NULL,	NULL,	NULL,	'ahwhshs',	NULL,	'hsshhss',	NULL,	'1',	'49494948',	'shwuehhes',	'shshhss',	'4646646464',	'shshhshd',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	1,	'2019-09-16 07:00:00',	'2019-09-16 07:00:00'),
(77,	93,	'vwgavss',	NULL,	NULL,	'9314142089',	'sbshhab',	NULL,	NULL,	NULL,	'sbahsh',	NULL,	'sgsgag',	NULL,	'1',	'799797',	'shshsh',	'sgshsh',	'7576776797',	'zvzggz',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	1,	'2019-09-16 07:00:00',	'2019-09-16 07:00:00'),
(78,	94,	'vaibhav',	NULL,	NULL,	'9591873983',	'yohesh',	NULL,	NULL,	NULL,	'hsjsj',	NULL,	'jdjsjs',	NULL,	'1',	'191976868654',	'sbi',	'bhilwara',	'646464',	'dhsj2347',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	1,	'2019-09-16 07:00:00',	'2019-09-16 07:00:00'),
(79,	95,	'Rekha Agarwal',	NULL,	NULL,	'9352983232',	'Girdhari Lal Pansari',	NULL,	NULL,	NULL,	'jaipur',	NULL,	'jaipur',	NULL,	'1',	NULL,	'Hdfc Bank',	'C Scheme',	'123412241234',	'HDFC00001234',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	1,	'2019-09-16 07:00:00',	'2019-09-16 07:00:00'),
(80,	96,	'd',	NULL,	NULL,	'1234567890',	'r',	NULL,	NULL,	NULL,	'f',	NULL,	'f',	NULL,	'1',	'5',	'g',	'f',	'5',	'e',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	1,	'2019-09-16 07:00:00',	'2019-09-16 07:00:00'),
(81,	97,	'sanjay agarwal',	NULL,	NULL,	'9314142089',	'sitaram',	NULL,	NULL,	NULL,	'vsvsgs',	NULL,	'whhehss',	NULL,	'1',	'454548484',	'bsehbebd',	'hshshs',	'44555',	'ssd',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	1,	'2019-09-16 07:00:00',	'2019-09-16 07:00:00'),
(82,	98,	'cd',	NULL,	NULL,	'9352983232',	'vhjgh',	NULL,	NULL,	NULL,	'cvb',	NULL,	'vvbb',	NULL,	'1',	'899',	'vvbb',	'vvbbn',	'999',	'by',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	1,	'2019-09-16 07:00:00',	'2019-09-16 07:00:00'),
(83,	99,	'vinod swami',	NULL,	NULL,	'9571089183',	'kishan lal swami',	NULL,	NULL,	NULL,	'kanarpura',	NULL,	'jaipur',	NULL,	'1',	'111111111',	'obc',	'kaladera',	'112121542454',	'obc',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	1,	'2019-09-17 07:00:00',	'2019-09-17 07:00:00'),
(84,	100,	'vinod swami',	NULL,	NULL,	'9571089183',	'kishan lal swami',	NULL,	NULL,	NULL,	'kanarpura',	NULL,	'jaipur',	NULL,	'1',	'111111111',	'obc',	'kaladera',	'112121542454',	'obc',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	1,	'2019-09-17 07:00:00',	'2019-09-17 07:00:00'),
(85,	101,	'suresh kumar jakhar',	NULL,	NULL,	'9414329304',	'shivpal jakhar',	NULL,	NULL,	NULL,	'gsvs',	NULL,	'zzs',	NULL,	'1',	'111',	'dds',	'ddd',	'888',	'sdx',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	1,	'2019-09-17 07:00:00',	'2019-09-17 07:00:00'),
(86,	102,	'vimal ji',	NULL,	NULL,	'9414550800',	'dhdhd',	NULL,	NULL,	NULL,	'd',	NULL,	'ddd',	NULL,	'1',	'858',	'dd',	'dd',	'8',	'd',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	1,	'2019-09-17 07:00:00',	'2019-09-17 07:00:00'),
(87,	103,	'sunil',	NULL,	NULL,	'9799540379',	'sanwar mal',	NULL,	NULL,	NULL,	'khandelsar',	NULL,	'sikar',	NULL,	'1',	'111111',	'dummy',	'dummy',	'999999',	'dummy',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	1,	'2019-09-17 07:00:00',	'2019-09-17 07:00:00'),
(88,	104,	'Andy',	NULL,	NULL,	'1231231211',	'Louis',	NULL,	NULL,	NULL,	'Hkajsa',	NULL,	'Mandi',	'user.png',	'1',	'829220202',	'82922020202020',	'icic',	'7333003033',	'icici09191911',	NULL,	'178e75.jpg',	'41fe8c.jpg',	NULL,	NULL,	NULL,	NULL,	NULL,	1,	'2019-09-18 19:17:33',	'2019-09-18 19:17:33'),
(89,	105,	'Andy',	NULL,	NULL,	'9876543214',	'Louis',	NULL,	NULL,	NULL,	'Hkajsa',	NULL,	'Mandi',	'user.png',	'1',	'829220202',	'82922020202020',	'icic',	'7333003033',	'icici09191911',	NULL,	'35362b.jpg',	'8c599f.jpg',	NULL,	NULL,	NULL,	NULL,	NULL,	1,	'2019-09-18 19:23:04',	'2019-09-18 19:23:04'),
(90,	106,	'a k',	NULL,	NULL,	'9887907173',	'd k',	NULL,	NULL,	NULL,	'fghj',	NULL,	'fhjk',	NULL,	'1',	'00895632569',	'ghjk',	'fhjk',	'859325698',	'fguhvf',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	1,	'2019-09-19 07:00:00',	'2019-09-19 07:00:00'),
(91,	107,	'adagagaws',	NULL,	NULL,	'9876543210',	'sss',	NULL,	NULL,	NULL,	'a',	NULL,	'a',	NULL,	'1',	'4',	'w',	'w',	'4',	'q',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	1,	'2019-09-19 07:00:00',	'2019-09-19 07:00:00'),
(92,	108,	'Dinesh',	NULL,	NULL,	'9784350571',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'user.png',	'1',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'Dinesh Enterprises',	NULL,	NULL,	NULL,	NULL,	1,	'2019-09-19 19:20:15',	'2019-09-19 19:20:15'),
(93,	109,	'Test',	NULL,	NULL,	'8209864519',	'Test father',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'user.png',	'1',	NULL,	'ICICI',	'KOTA',	'12356498700',	'ICICI000235',	NULL,	'd0736d.png',	'f47be1.png',	NULL,	NULL,	NULL,	NULL,	NULL,	1,	'2019-09-19 19:49:33',	'2019-09-19 19:49:33'),
(94,	110,	'udu',	NULL,	NULL,	'9314142098',	'a',	NULL,	NULL,	NULL,	'd',	NULL,	'f',	NULL,	'1',	'4',	'd',	'd',	'8',	'd',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	1,	'2019-09-19 07:00:00',	'2019-09-19 07:00:00'),
(95,	111,	'SURESH KUMAR JAKHAR',	NULL,	NULL,	'9414329304',	'SHIVPAL JAKHAR',	NULL,	NULL,	NULL,	'LIKHAMAKABAS',	NULL,	'SIKAR',	NULL,	'1',	'715269316865',	'AXIS BANK',	'KHATUSHYAMJI',	'912010022003417',	'UTIB0001427',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	1,	'2019-09-20 07:00:00',	'2019-09-20 07:00:00'),
(96,	112,	'TRIAL',	NULL,	NULL,	'7698811928',	NULL,	NULL,	'TRIAL',	NULL,	NULL,	NULL,	NULL,	'user.png',	'1',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'VIVEK VYAS TRIAL',	'TRIAL',	'TRIAL',	NULL,	NULL,	1,	'2019-09-21 17:47:13',	'2019-09-21 17:47:13'),
(97,	113,	'a',	NULL,	NULL,	'9876543210',	'a',	NULL,	NULL,	NULL,	'w',	NULL,	'e',	NULL,	'1',	'4',	'3',	'q',	'2',	'4',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	1,	'2019-09-21 07:00:00',	'2019-09-21 07:00:00'),
(98,	114,	'sunil Kumar gupta',	NULL,	NULL,	'9799540379',	'sanwar mal gupta',	NULL,	NULL,	NULL,	'khandelsar',	NULL,	'sikar',	NULL,	'1',	'741090907631',	'sbi',	'ranoli',	'61149160686',	'SBIN0032023',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	1,	'2019-09-21 07:00:00',	'2019-09-21 07:00:00'),
(99,	115,	'Sitaram Agarwal',	NULL,	NULL,	'9414079824',	'Govind Ram Agarwal',	NULL,	NULL,	NULL,	'Jaipur',	NULL,	'Jaipur',	NULL,	'1',	'1234567890',	'HDFC Bank',	'abc',	'123',	'ajs91',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	1,	'2019-09-22 07:00:00',	'2019-09-22 07:00:00'),
(100,	116,	'sitaram Agarwal',	NULL,	NULL,	'9414079824',	'Govind Ram Agarwal',	NULL,	NULL,	NULL,	'singod',	NULL,	'jaipur',	NULL,	'1',	'2077299',	'hdc',	'vki',	'7282',	'khgf',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	1,	'2019-09-22 07:00:00',	'2019-09-22 07:00:00'),
(101,	117,	'prem',	NULL,	NULL,	'9602947878',	'father',	NULL,	NULL,	NULL,	'jaipur',	NULL,	'jaipur',	NULL,	'1',	'9632587410',	'sbi',	'jaipur',	'64425856395',	'hfh',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	1,	'2019-09-22 07:00:00',	'2019-09-30 02:10:42'),
(102,	118,	'yg6',	NULL,	NULL,	'6666666666',	'6',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'1',	NULL,	'hdfc',	'sector 6',	'55',	'ggg',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	1,	'2019-09-22 07:00:00',	'2019-09-22 07:00:00'),
(103,	119,	'ASHOK SINGH SHEKHAWAT',	NULL,	NULL,	'9828126169',	'DEEN SINGH SHEKHAWAT',	NULL,	NULL,	NULL,	'Khandelsar',	NULL,	'Sikar',	NULL,	'1',	'825783931152',	'SBI',	'Ranoli',	'61131559997',	'SBIN0032023',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	1,	'2019-09-23 07:00:00',	'2019-09-23 07:00:00'),
(104,	120,	'pradeep agarwal',	NULL,	NULL,	'9833596060',	'aa',	NULL,	NULL,	NULL,	'f',	NULL,	'f',	NULL,	'1',	'8',	't',	'f',	'5',	'f',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	1,	'2019-09-23 07:00:00',	'2019-09-23 07:00:00'),
(157,	219,	'prem',	NULL,	NULL,	'8005609866',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'1',	NULL,	NULL,	NULL,	NULL,	NULL,	'a8b2bd.jpg',	'bd86f0.jpg',	'aa7eb83c.jpg',	NULL,	NULL,	NULL,	'26.9600873',	'75.7785622',	1,	'2019-10-01 07:00:00',	'2019-10-01 07:00:00');

DROP TABLE IF EXISTS `user_roles`;
CREATE TABLE `user_roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `user_roles` (`id`, `user_id`, `role_id`, `created_at`, `updated_at`) VALUES
(1,	1,	1,	'2018-09-06 08:26:31',	'2018-09-06 08:26:31'),
(21,	2,	4,	'2019-01-05 13:22:33',	'2019-01-05 13:22:33'),
(24,	5,	5,	'2019-01-19 02:42:24',	'2019-01-19 02:42:24'),
(25,	6,	6,	'2019-01-19 02:45:07',	'2019-01-19 02:45:07'),
(26,	7,	6,	'2019-01-19 02:49:00',	'2019-01-19 02:49:00'),
(27,	8,	6,	'2019-01-21 22:26:06',	'2019-01-21 22:26:06'),
(28,	9,	5,	'2019-01-22 03:05:14',	'2019-01-22 03:05:14'),
(29,	10,	6,	'2019-01-22 03:05:15',	'2019-01-22 03:05:15'),
(30,	11,	5,	'2019-01-22 23:35:09',	'2019-01-22 23:35:09'),
(31,	12,	5,	'2019-01-24 23:26:58',	'2019-01-24 23:26:58'),
(32,	13,	5,	'2019-01-28 18:19:22',	'2019-01-28 18:19:22'),
(33,	14,	6,	'2019-02-22 18:53:59',	'2019-02-22 18:53:59'),
(34,	15,	5,	'2019-03-05 20:31:09',	'2019-03-05 20:31:09'),
(35,	16,	5,	'2019-03-05 20:36:38',	'2019-03-05 20:36:38'),
(36,	17,	5,	'2019-03-05 21:01:45',	'2019-03-05 21:01:45'),
(37,	18,	5,	'2019-03-05 21:03:59',	'2019-03-05 21:03:59'),
(38,	19,	5,	'2019-03-05 21:04:28',	'2019-03-05 21:04:28'),
(39,	20,	6,	'2019-03-05 21:10:30',	'2019-03-05 21:10:30'),
(40,	21,	6,	'2019-03-05 21:19:27',	'2019-03-05 21:19:27'),
(41,	22,	6,	'2019-03-13 18:26:13',	'2019-03-13 18:26:13'),
(42,	23,	6,	'2019-03-20 18:24:39',	'2019-03-20 18:24:39'),
(43,	24,	6,	'2019-03-23 17:33:35',	'2019-03-23 17:33:35'),
(44,	25,	6,	'2019-03-25 21:45:51',	'2019-03-25 21:45:51'),
(45,	26,	5,	'2019-03-27 02:08:48',	'2019-03-27 02:08:48'),
(46,	27,	6,	'2019-04-04 17:23:32',	'2019-04-04 17:23:32'),
(47,	28,	6,	'2019-04-04 20:00:40',	'2019-04-04 20:00:40'),
(48,	29,	6,	'2019-04-04 21:31:48',	'2019-04-04 21:31:48'),
(49,	30,	6,	'2019-04-04 21:44:46',	'2019-04-04 21:44:46'),
(50,	31,	5,	'2019-04-04 22:25:35',	'2019-04-04 22:25:35'),
(51,	32,	6,	'2019-04-04 23:34:47',	'2019-04-04 23:34:47'),
(52,	33,	6,	'2019-04-06 22:54:35',	'2019-04-06 22:54:35'),
(53,	34,	5,	'2019-04-06 23:11:39',	'2019-04-06 23:11:39'),
(54,	35,	6,	'2019-04-13 20:17:31',	'2019-04-13 20:17:31'),
(55,	36,	6,	'2019-04-13 22:30:42',	'2019-04-13 22:30:42'),
(56,	37,	6,	'2019-04-13 23:27:25',	'2019-04-13 23:27:25'),
(57,	38,	6,	'2019-04-14 00:23:03',	'2019-04-14 00:23:03'),
(58,	39,	6,	'2019-04-18 21:38:51',	'2019-04-18 21:38:51'),
(59,	40,	5,	'2019-04-30 20:41:10',	'2019-04-30 20:41:10'),
(60,	41,	5,	'2019-05-11 20:34:39',	'2019-05-11 20:34:39'),
(61,	42,	6,	'2019-06-06 22:17:31',	'2019-06-06 22:17:31'),
(62,	43,	5,	'2019-08-21 23:52:01',	'2019-08-21 23:52:01'),
(63,	44,	5,	'2019-08-29 22:14:54',	'2019-08-29 22:14:54'),
(64,	45,	5,	'2019-08-29 22:15:40',	'2019-08-29 22:15:40'),
(65,	46,	6,	'2019-09-04 21:40:31',	'2019-09-04 21:40:31'),
(66,	47,	6,	'2019-09-05 23:26:59',	'2019-09-05 23:26:59'),
(67,	48,	5,	'2019-09-11 00:47:27',	'2019-09-11 00:47:27'),
(68,	49,	6,	'2019-09-11 00:50:28',	'2019-09-11 00:50:28'),
(69,	50,	5,	'2019-09-11 23:52:47',	'2019-09-11 23:52:47'),
(70,	51,	5,	'2019-09-11 23:58:21',	'2019-09-11 23:58:21'),
(71,	52,	5,	'2019-09-12 02:36:03',	'2019-09-12 02:36:03'),
(72,	53,	5,	'2019-09-12 07:00:00',	'2019-09-12 07:00:00'),
(73,	54,	5,	'2019-09-12 07:00:00',	'2019-09-12 07:00:00'),
(74,	55,	5,	'2019-09-12 07:00:00',	'2019-09-12 07:00:00'),
(75,	56,	5,	'2019-09-12 07:00:00',	'2019-09-12 07:00:00'),
(76,	57,	5,	'2019-09-12 07:00:00',	'2019-09-12 07:00:00'),
(77,	58,	5,	'2019-09-12 07:00:00',	'2019-09-12 07:00:00'),
(78,	59,	5,	'2019-09-13 07:00:00',	'2019-09-13 07:00:00'),
(79,	60,	5,	'2019-09-13 07:00:00',	'2019-09-13 07:00:00'),
(80,	61,	5,	'2019-09-13 07:00:00',	'2019-09-13 07:00:00'),
(81,	62,	5,	'2019-09-13 07:00:00',	'2019-09-13 07:00:00'),
(82,	71,	5,	'2019-09-13 07:00:00',	'2019-09-13 07:00:00'),
(83,	72,	5,	'2019-09-13 07:00:00',	'2019-09-13 07:00:00'),
(84,	73,	5,	'2019-09-13 07:00:00',	'2019-09-13 07:00:00'),
(85,	74,	5,	'2019-09-13 07:00:00',	'2019-09-13 07:00:00'),
(86,	75,	5,	'2019-09-13 07:00:00',	'2019-09-13 07:00:00'),
(87,	76,	5,	'2019-09-14 07:00:00',	'2019-09-14 07:00:00'),
(88,	77,	5,	'2019-09-14 07:00:00',	'2019-09-14 07:00:00'),
(89,	78,	5,	'2019-09-15 07:00:00',	'2019-09-15 07:00:00'),
(90,	79,	5,	'2019-09-15 07:00:00',	'2019-09-15 07:00:00'),
(91,	80,	5,	'2019-09-15 07:00:00',	'2019-09-15 07:00:00'),
(92,	81,	5,	'2019-09-15 07:00:00',	'2019-09-15 07:00:00'),
(93,	82,	5,	'2019-09-15 07:00:00',	'2019-09-15 07:00:00'),
(94,	83,	5,	'2019-09-15 07:00:00',	'2019-09-15 07:00:00'),
(95,	84,	5,	'2019-09-15 07:00:00',	'2019-09-15 07:00:00'),
(96,	85,	5,	'2019-09-15 07:00:00',	'2019-09-15 07:00:00'),
(97,	86,	5,	'2019-09-15 07:00:00',	'2019-09-15 07:00:00'),
(98,	87,	5,	'2019-09-16 07:00:00',	'2019-09-16 07:00:00'),
(99,	88,	5,	'2019-09-16 07:00:00',	'2019-09-16 07:00:00'),
(100,	89,	5,	'2019-09-16 07:00:00',	'2019-09-16 07:00:00'),
(101,	90,	5,	'2019-09-16 07:00:00',	'2019-09-16 07:00:00'),
(102,	91,	5,	'2019-09-16 07:00:00',	'2019-09-16 07:00:00'),
(103,	92,	5,	'2019-09-16 07:00:00',	'2019-09-16 07:00:00'),
(104,	93,	5,	'2019-09-16 07:00:00',	'2019-09-16 07:00:00'),
(105,	94,	5,	'2019-09-16 07:00:00',	'2019-09-16 07:00:00'),
(106,	95,	5,	'2019-09-16 07:00:00',	'2019-09-16 07:00:00'),
(107,	96,	5,	'2019-09-16 07:00:00',	'2019-09-16 07:00:00'),
(108,	97,	5,	'2019-09-16 07:00:00',	'2019-09-16 07:00:00'),
(109,	98,	5,	'2019-09-16 07:00:00',	'2019-09-16 07:00:00'),
(110,	99,	5,	'2019-09-17 07:00:00',	'2019-09-17 07:00:00'),
(111,	100,	5,	'2019-09-17 07:00:00',	'2019-09-17 07:00:00'),
(112,	101,	5,	'2019-09-17 07:00:00',	'2019-09-17 07:00:00'),
(113,	102,	5,	'2019-09-17 07:00:00',	'2019-09-17 07:00:00'),
(114,	103,	5,	'2019-09-17 07:00:00',	'2019-09-17 07:00:00'),
(115,	104,	5,	'2019-09-18 19:17:33',	'2019-09-18 19:17:33'),
(116,	105,	5,	'2019-09-18 19:23:04',	'2019-09-18 19:23:04'),
(117,	106,	5,	'2019-09-19 07:00:00',	'2019-09-19 07:00:00'),
(118,	107,	5,	'2019-09-19 07:00:00',	'2019-09-19 07:00:00'),
(119,	108,	6,	'2019-09-19 19:20:15',	'2019-09-19 19:20:15'),
(120,	109,	5,	'2019-09-19 19:49:33',	'2019-09-19 19:49:33'),
(121,	110,	5,	'2019-09-19 07:00:00',	'2019-09-19 07:00:00'),
(122,	111,	5,	'2019-09-20 07:00:00',	'2019-09-20 07:00:00'),
(123,	112,	6,	'2019-09-21 17:47:13',	'2019-09-21 17:47:13'),
(124,	113,	5,	'2019-09-21 07:00:00',	'2019-09-21 07:00:00'),
(125,	114,	5,	'2019-09-21 07:00:00',	'2019-09-21 07:00:00'),
(126,	115,	5,	'2019-09-22 07:00:00',	'2019-09-22 07:00:00'),
(127,	116,	5,	'2019-09-22 07:00:00',	'2019-09-22 07:00:00'),
(128,	117,	5,	'2019-09-22 07:00:00',	'2019-09-22 07:00:00'),
(129,	118,	5,	'2019-09-22 07:00:00',	'2019-09-22 07:00:00'),
(130,	119,	5,	'2019-09-23 07:00:00',	'2019-09-23 07:00:00'),
(131,	120,	5,	'2019-09-23 07:00:00',	'2019-09-23 07:00:00'),
(132,	121,	5,	'2019-09-23 07:00:00',	'2019-09-23 07:00:00'),
(133,	138,	5,	'2019-09-27 03:59:36',	'2019-09-27 03:59:36'),
(134,	139,	5,	'2019-09-27 04:01:01',	'2019-09-27 04:01:01'),
(135,	140,	5,	'2019-09-27 04:06:32',	'2019-09-27 04:06:32'),
(136,	141,	5,	'2019-09-27 06:36:41',	'2019-09-27 06:36:41'),
(137,	142,	5,	'2019-09-27 07:04:02',	'2019-09-27 07:04:02'),
(138,	143,	5,	'2019-09-27 07:06:27',	'2019-09-27 07:06:27'),
(139,	144,	5,	'2019-09-27 07:12:38',	'2019-09-27 07:12:38'),
(140,	145,	5,	'2019-09-27 07:18:47',	'2019-09-27 07:18:47'),
(141,	146,	5,	'2019-09-27 07:19:46',	'2019-09-27 07:19:46'),
(142,	147,	5,	'2019-09-27 07:30:59',	'2019-09-27 07:30:59'),
(143,	148,	5,	'2019-09-27 07:31:58',	'2019-09-27 07:31:58'),
(144,	149,	5,	'2019-09-27 07:32:48',	'2019-09-27 07:32:48'),
(145,	150,	5,	'2019-09-27 07:34:17',	'2019-09-27 07:34:17'),
(146,	151,	5,	'2019-09-27 07:44:30',	'2019-09-27 07:44:30'),
(147,	152,	5,	'2019-09-27 07:47:35',	'2019-09-27 07:47:35'),
(148,	153,	5,	'2019-09-27 07:49:17',	'2019-09-27 07:49:17'),
(149,	154,	5,	'2019-09-27 07:52:41',	'2019-09-27 07:52:41'),
(150,	155,	5,	'2019-09-27 07:54:29',	'2019-09-27 07:54:29'),
(151,	156,	5,	'2019-09-27 07:58:23',	'2019-09-27 07:58:23'),
(152,	157,	5,	'2019-09-27 08:00:09',	'2019-09-27 08:00:09'),
(153,	158,	5,	'2019-09-27 08:02:30',	'2019-09-27 08:02:30'),
(154,	159,	5,	'2019-09-27 08:03:50',	'2019-09-27 08:03:50'),
(155,	160,	5,	'2019-09-27 16:08:46',	'2019-09-27 16:08:46'),
(156,	161,	5,	'2019-09-27 16:14:13',	'2019-09-27 16:14:13'),
(157,	162,	5,	'2019-09-27 16:27:32',	'2019-09-27 16:27:32'),
(158,	163,	5,	'2019-09-27 20:25:16',	'2019-09-27 20:25:16'),
(159,	168,	5,	'2019-09-28 03:58:55',	'2019-09-28 03:58:55'),
(160,	169,	5,	'2019-09-28 04:20:47',	'2019-09-28 04:20:47'),
(161,	170,	5,	'2019-09-28 04:26:44',	'2019-09-28 04:26:44'),
(162,	171,	5,	'2019-09-28 04:31:03',	'2019-09-28 04:31:03'),
(163,	173,	5,	'2019-09-28 04:46:36',	'2019-09-28 04:46:36'),
(164,	176,	5,	'2019-09-28 05:44:28',	'2019-09-28 05:44:28'),
(165,	177,	5,	'2019-09-28 05:56:53',	'2019-09-28 05:56:53'),
(166,	178,	5,	'2019-09-28 06:08:05',	'2019-09-28 06:08:05'),
(167,	179,	5,	'2019-09-28 06:13:22',	'2019-09-28 06:13:22'),
(168,	180,	5,	'2019-09-28 06:34:56',	'2019-09-28 06:34:56'),
(169,	181,	5,	'2019-09-28 06:38:50',	'2019-09-28 06:38:50'),
(170,	182,	5,	'2019-09-28 06:45:44',	'2019-09-28 06:45:44'),
(171,	183,	5,	'2019-09-28 06:48:14',	'2019-09-28 06:48:14'),
(172,	184,	5,	'2019-09-28 06:56:07',	'2019-09-28 06:56:07'),
(173,	185,	5,	'2019-09-28 06:57:52',	'2019-09-28 06:57:52'),
(174,	186,	5,	'2019-09-28 08:07:30',	'2019-09-28 08:07:30'),
(175,	187,	5,	'2019-09-28 08:10:32',	'2019-09-28 08:10:32'),
(176,	188,	6,	'2019-09-28 08:16:31',	'2019-09-28 08:16:31'),
(177,	191,	5,	'2019-09-28 22:32:31',	'2019-09-28 22:32:31'),
(178,	193,	5,	'2019-09-28 22:34:29',	'2019-09-28 22:34:29'),
(179,	194,	5,	'2019-09-28 22:44:27',	'2019-09-28 22:44:27'),
(180,	195,	5,	'2019-09-28 22:46:52',	'2019-09-28 22:46:52'),
(181,	196,	5,	'2019-09-28 22:49:37',	'2019-09-28 22:49:37'),
(182,	197,	5,	'2019-09-29 01:03:29',	'2019-09-29 01:03:29'),
(183,	199,	5,	'2019-09-29 05:14:08',	'2019-09-29 05:14:08'),
(184,	200,	5,	'2019-09-30 02:10:24',	'2019-09-30 02:10:24'),
(185,	204,	5,	'2019-10-01 03:07:57',	'2019-10-01 03:07:57'),
(186,	205,	5,	'2019-10-01 03:16:20',	'2019-10-01 03:16:20'),
(187,	210,	5,	'2019-10-01 06:19:55',	'2019-10-01 06:19:55'),
(188,	212,	5,	'2019-10-01 07:54:03',	'2019-10-01 07:54:03'),
(189,	213,	5,	'2019-10-01 18:09:42',	'2019-10-01 18:09:42'),
(190,	211,	5,	'2019-10-01 18:16:11',	'2019-10-01 18:16:11'),
(191,	214,	5,	'2019-10-01 18:16:31',	'2019-10-01 18:16:31'),
(192,	215,	5,	'2019-10-01 18:22:11',	'2019-10-01 18:22:11'),
(193,	216,	5,	'2019-10-01 18:46:22',	'2019-10-01 18:46:22'),
(194,	217,	5,	'2019-10-01 18:46:31',	'2019-10-01 18:46:31'),
(195,	218,	5,	'2019-10-01 18:49:27',	'2019-10-01 18:49:27'),
(196,	219,	5,	'2019-10-01 20:39:06',	'2019-10-01 20:39:06');

DROP TABLE IF EXISTS `warehouses`;
CREATE TABLE `warehouses` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `village` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `capacity` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `items` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facility_ids` text COLLATE utf8mb4_unicode_ci,
  `image` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `warehouses` (`id`, `name`, `village`, `capacity`, `items`, `facility_ids`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1,	'Sharda Devi Warehouse',	'Morija',	'3000',	'null',	'0',	NULL,	1,	'2019-01-18 19:52:09',	'2019-04-17 16:45:12'),
(2,	'Chiraag Logistics',	'Manda',	'3000',	'null',	'0',	NULL,	1,	'2019-01-18 19:52:31',	'2019-01-18 19:52:31'),
(3,	'B 97',	'Palsana',	'1500',	'null',	'0',	NULL,	1,	'2019-01-18 19:53:02',	'2019-01-18 19:53:02'),
(4,	'Raka Triphati',	'Jhunjhunu',	'1000',	'null',	'0',	NULL,	1,	'2019-01-18 19:53:39',	'2019-01-18 19:53:39'),
(5,	'Giriraj Dharan',	'Ajeetgarh',	'1500',	'null',	'0',	NULL,	1,	'2019-01-18 19:54:01',	'2019-01-18 19:54:01'),
(6,	'Genus Warehouse',	'Keshwana, Kotputli ( Near Bar Malt)',	'75000',	'null',	'0',	NULL,	1,	'2019-04-06 16:13:54',	'2019-04-17 16:44:13'),
(7,	'R K Warehouse',	'Manda',	'3000',	'null',	'0',	NULL,	1,	'2019-04-17 16:45:47',	'2019-04-17 16:45:47');

DROP TABLE IF EXISTS `warehouse_rent_rates`;
CREATE TABLE `warehouse_rent_rates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `warehouse_id` int(11) DEFAULT NULL,
  `address` text,
  `location` varchar(100) DEFAULT NULL,
  `area` varchar(100) DEFAULT NULL,
  `district` varchar(100) DEFAULT NULL,
  `area_sqr_ft` varchar(10) DEFAULT NULL,
  `rent_per_month` varchar(10) DEFAULT NULL,
  `capacity_in_mt` varchar(10) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `warehouse_rent_rates` (`id`, `warehouse_id`, `address`, `location`, `area`, `district`, `area_sqr_ft`, `rent_per_month`, `capacity_in_mt`, `status`, `created_at`, `updated_at`) VALUES
(2,	NULL,	'Genus Power',	'Keshwana',	'Kotputli',	'Jaipur',	'42000',	'94',	'7560',	1,	'2019-09-11 15:58:52',	'2019-09-11 15:58:52'),
(3,	NULL,	'R K Warehouse',	'Morija',	'Chomu',	'Jaipur',	'20000',	'100',	'3600',	1,	'2019-09-11 15:59:29',	'2019-09-11 15:59:29'),
(4,	NULL,	'Chiraag Logistics',	'Manda',	'Khatushyam',	'Sikar',	'20000',	'100',	'3600',	1,	'2019-09-11 16:00:02',	'2019-09-11 16:00:02'),
(5,	NULL,	'R K Warehouse',	'Manda',	'Khatushyam',	'Sikar',	'16000',	'100',	'2880',	1,	'2019-09-11 16:00:51',	'2019-09-11 16:00:51'),
(6,	NULL,	'Maharshi Export',	'Palsana',	'Palsana',	'Sikar',	'13000',	'90',	'2340',	1,	'2019-09-11 16:06:47',	'2019-09-11 16:06:47'),
(7,	NULL,	'Giriraj Dharan Industries',	'Ajeetgarh',	'Ajeetgarh',	'Sikar',	'10000',	'100',	'1800',	1,	'2019-09-11 16:07:17',	'2019-09-11 16:07:17'),
(8,	NULL,	'National Industries',	'Reengas',	'Reengas',	'Sikar',	'6000',	'90',	'1080',	1,	'2019-09-11 16:17:37',	'2019-09-11 16:17:37'),
(9,	NULL,	'Raka Tripathi',	'Jhunjhunu',	'Jhunjhunu',	'Jhunjhunu',	'4500',	'100',	'810',	1,	'2019-09-11 16:18:05',	'2019-09-11 16:18:05'),
(10,	NULL,	'Agarwal Industries',	'Palsana',	'Palsana',	'Sikar',	'4200',	'90',	'756',	1,	'2019-09-11 16:18:38',	'2019-09-11 16:18:38'),
(11,	NULL,	'Shah Industries',	'Palsana',	'Palsana',	'Sikar',	'4200',	'90',	'756',	1,	'2019-09-11 16:19:19',	'2019-09-11 16:19:19'),
(12,	NULL,	'Savita Devi',	'Rampura',	'Jaipur',	'Jaipur',	'3000',	'80',	'540',	1,	'2019-09-11 16:19:55',	'2019-09-11 16:19:55'),
(13,	NULL,	'Nature Fresh Agro Industries',	'Muhana',	'Muhana',	'Jaipur',	'20000',	'150',	'2000',	1,	'2019-09-17 19:45:54',	'2019-09-17 19:45:54');

-- 2019-10-01 08:21:13
