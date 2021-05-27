-- Adminer 4.7.6 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1,	'2014_10_12_000000_create_users_table',	1),
(2,	'2019_09_24_053626_create_products_table',	1),
(3,	'2019_11_06_155716_create_orders_table',	1);

DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `product_ids` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_quantities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_price` int(11) DEFAULT NULL,
  `order_status` int(11) NOT NULL COMMENT '0->incomplete,1->complete',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `orders_user_id_foreign` (`user_id`),
  CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `orders` (`id`, `user_id`, `product_ids`, `product_quantities`, `total_price`, `order_status`, `created_at`, `updated_at`) VALUES
(1,	2,	'[\"8\",\"5\",\"7\"]',	'[1,1,1]',	70000,	1,	'2021-05-26 11:28:01',	'2021-05-26 11:28:01'),
(2,	2,	'[\"4\",\"7\"]',	'[1,1]',	38000,	1,	'2021-05-26 11:33:13',	'2021-05-26 11:33:13'),
(3,	2,	'[\"6\"]',	'[1]',	50000,	1,	'2021-05-26 11:35:30',	'2021-05-26 11:35:30'),
(4,	5,	'[\"7\",\"4\"]',	'[1,1]',	38000,	1,	'2021-05-26 11:36:52',	'2021-05-26 11:36:52'),
(5,	2,	'[\"7\"]',	'[1]',	18000,	1,	'2021-05-26 13:22:32',	'2021-05-26 13:22:32');

DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `product_status` int(11) NOT NULL COMMENT '0->inactive,1->active',
  `product_image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `products` (`id`, `name`, `price`, `stock`, `product_status`, `product_image`, `created_at`, `updated_at`) VALUES
(4,	'Mobile',	20000,	48,	1,	'product_image/mobile_1622039784_.jpg',	'2021-05-26 08:36:24',	'2021-05-26 11:36:52'),
(5,	'Monitor',	25000,	39,	1,	'product_image/monitor_1622039917_.jpg',	'2021-05-26 08:38:37',	'2021-05-26 11:28:01'),
(6,	'Laptop',	50000,	19,	1,	'product_image/laptop_1622039950_.jpg',	'2021-05-26 08:39:10',	'2021-05-26 11:35:30'),
(7,	'Headphone',	18000,	26,	1,	'product_image/headphone_1622039978_.jpg',	'2021-05-26 08:39:38',	'2021-05-26 13:22:32'),
(8,	'Monitor Two',	27000,	34,	1,	'product_image/laptop_1622040031_.jpg',	'2021-05-26 08:40:31',	'2021-05-26 11:28:01');

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_type` int(11) NOT NULL DEFAULT 0 COMMENT '0->user,1->admin',
  `provider_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_status` int(11) NOT NULL DEFAULT 1 COMMENT '0->pending,1->active,2->denied',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `users` (`id`, `name`, `email`, `password`, `user_type`, `provider_name`, `provider_id`, `user_status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1,	'system admin',	'admin@system.com',	'$2y$10$5KKjaoo8.9//IAcpmIkn7eOge7NEhXOVgirhI9vdeoJDBk0i8GZ5u',	1,	NULL,	NULL,	1,	NULL,	'2021-05-26 04:12:27',	'2021-05-26 04:12:27'),
(2,	'Ag Rabbee',	'a@b.com',	'$2y$10$/Gnp7X224oQJk76k7ckyfOkipoHlQOiRanNDaNKCQJxsbGWPie07K',	0,	NULL,	NULL,	1,	NULL,	'2021-05-26 04:12:27',	'2021-05-26 04:12:27'),
(5,	'Md. Abdul Goni Rabbee',	'rabbee@batworld.com',	'$2y$10$fd2DvOX7lER5GVl0PBxjH.FLl2f3FapF.SuwT85eftVmWqJzKahjC',	0,	'google',	'116853744725657073875',	1,	NULL,	'2021-05-26 08:58:43',	'2021-05-26 08:58:43'),
(6,	'Rabbee',	'abdulgonirabbee@gmail.com',	'$2y$10$fw0uUozq8dX2NWktYf1Kb.TCM43Xp5SYf2kewKHj0rgYO6LiIlEE.',	0,	'google',	'106379519562137704803',	1,	NULL,	'2021-05-26 09:01:18',	'2021-05-26 09:01:18'),
(7,	'Test user',	'test@user.com',	'$2y$10$j5AOzIcs2NrIYp9qnlVQ../kaBhSpv.H/EuXJOkIl4MRxY6QJvidO',	0,	NULL,	NULL,	1,	NULL,	'2021-05-26 09:04:50',	'2021-05-26 09:04:50'),
(9,	'Rabbee',	'abdulgonirabbee@hotmail.com',	'$2y$10$hq7E2tfKg9Yg.3BeuGAGH.Tipu6JtaNP0c8SzXCr86J7Bkm.xd4Kq',	0,	'facebook',	'1714171178744185',	1,	NULL,	'2021-05-26 22:18:03',	'2021-05-26 22:18:03');

-- 2021-05-27 04:59:07
