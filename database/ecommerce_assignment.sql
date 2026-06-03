-- Dumping database structure for ecommerce_assignment
DROP DATABASE IF EXISTS `ecommerce_assignment`;
CREATE DATABASE IF NOT EXISTS `ecommerce_assignment` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `ecommerce_assignment`;

-- Dumping structure for table ecommerce_assignment.cache
DROP TABLE IF EXISTS `cache`;
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ecommerce_assignment.cache: ~0 rows (approximately)

-- Dumping structure for table ecommerce_assignment.cache_locks
DROP TABLE IF EXISTS `cache_locks`;
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ecommerce_assignment.cache_locks: ~0 rows (approximately)

-- Dumping structure for table ecommerce_assignment.categories
DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ecommerce_assignment.categories: ~9 rows (approximately)
INSERT INTO `categories` (`id`, `name`, `description`, `category_image`, `created_at`, `updated_at`) VALUES
	(1, 'Pizza', 'Pizza', 'storage/categories/pizza.png', '2025-02-12 09:15:53', '2025-02-12 09:15:53'),
	(2, 'Burger', 'Burger', 'storage/categories/burger.png', '2025-02-12 09:15:53', '2025-02-12 09:15:53'),
	(3, 'Chicken', 'Chicken', 'storage/categories/chicken.png', '2025-02-12 09:15:53', '2025-02-12 09:15:53'),
	(4, 'Sushi', 'Sushi', 'storage/categories/sushi.png', '2025-02-12 09:15:53', '2025-02-12 09:15:53'),
	(5, 'Meat', 'Meat', 'storage/categories/meat.png', '2025-02-12 09:15:53', '2025-02-12 09:15:53'),
	(6, 'Hotdog', 'Hotdog', 'storage/categories/hotdog.png', '2025-02-12 09:15:53', '2025-02-12 09:15:53'),
	(7, 'Drink', 'Drink', 'storage/categories/drink.png', '2025-02-12 09:15:53', '2025-02-12 09:15:53'),
	(8, 'Coffee', 'Coffee', 'storage/categories/coffee.png', '2025-02-12 09:15:53', '2025-02-12 09:15:53'),
	(9, 'More', 'More', 'storage/categories/more.png', '2025-02-12 09:15:53', '2025-02-12 09:15:53');

-- Dumping structure for table ecommerce_assignment.failed_jobs
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ecommerce_assignment.failed_jobs: ~0 rows (approximately)

-- Dumping structure for table ecommerce_assignment.jobs
DROP TABLE IF EXISTS `jobs`;
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ecommerce_assignment.jobs: ~0 rows (approximately)

-- Dumping structure for table ecommerce_assignment.job_batches
DROP TABLE IF EXISTS `job_batches`;
CREATE TABLE IF NOT EXISTS `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ecommerce_assignment.job_batches: ~0 rows (approximately)

-- Dumping structure for table ecommerce_assignment.migrations
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ecommerce_assignment.migrations: ~0 rows (approximately)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '0001_01_01_000001_create_cache_table', 1),
	(2, '0001_01_01_000002_create_jobs_table', 1),
	(3, '2025_01_09_040417_create_personal_access_tokens_table', 1),
	(4, '2025_01_10_080352_create_roles_table', 1),
	(5, '2025_01_10_080527_create_users_table', 1),
	(6, '2025_01_10_080844_create_categories_table', 1),
	(7, '2025_01_10_080958_create_products_table', 1),
	(8, '2025_01_10_081027_create_orders_table', 1),
	(9, '2025_01_10_081103_create_sliders_table', 1),
	(10, '2025_01_14_102931_create_order_details_table', 1),
	(11, '2025_01_14_160215_create_posts_table', 1),
	(12, '2025_05_27_053459_add_avatar_to_users', 2);

-- Dumping structure for table ecommerce_assignment.orders
DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `order_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `orders_user_id_foreign` (`user_id`),
  CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=126 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ecommerce_assignment.orders: ~125 rows (approximately)
INSERT INTO `orders` (`id`, `user_id`, `order_date`, `created_at`, `updated_at`) VALUES
	(1, 9, '2003-02-02', '2025-02-12 09:15:58', '2025-02-12 09:15:58'),
	(2, 14, '2015-06-25', '2025-02-12 09:15:58', '2025-02-12 09:15:58'),
	(3, 9, '1984-05-03', '2025-02-12 09:15:58', '2025-02-12 09:15:58'),
	(4, 2, '2008-01-02', '2025-02-12 09:15:58', '2025-02-12 09:15:58'),
	(5, 16, '1998-10-24', '2025-02-12 09:15:58', '2025-02-12 09:15:58'),
	(6, 16, '2018-07-22', '2025-02-12 09:15:58', '2025-02-12 09:15:58'),
	(7, 11, '2008-08-07', '2025-02-12 09:15:58', '2025-02-12 09:15:58'),
	(8, 13, '1999-01-12', '2025-02-12 09:15:58', '2025-02-12 09:15:58'),
	(9, 18, '1993-05-03', '2025-02-12 09:15:58', '2025-02-12 09:15:58'),
	(10, 3, '2012-03-18', '2025-02-12 09:15:58', '2025-02-12 09:15:58'),
	(11, 8, '2010-02-07', '2025-02-12 09:15:58', '2025-02-12 09:15:58'),
	(12, 1, '2017-09-03', '2025-02-12 09:15:58', '2025-02-12 09:15:58'),
	(13, 20, '2018-08-26', '2025-02-12 09:15:58', '2025-02-12 09:15:58'),
	(14, 13, '1970-09-06', '2025-02-12 09:15:58', '2025-02-12 09:15:58'),
	(15, 15, '1993-11-12', '2025-02-12 09:15:58', '2025-02-12 09:15:58'),
	(16, 7, '1991-04-12', '2025-02-12 09:15:58', '2025-02-12 09:15:58'),
	(17, 14, '2019-09-03', '2025-02-12 09:15:58', '2025-02-12 09:15:58'),
	(18, 2, '2018-08-18', '2025-02-12 09:15:58', '2025-02-12 09:15:58'),
	(19, 17, '1985-10-14', '2025-02-12 09:15:58', '2025-02-12 09:15:58'),
	(20, 10, '1990-06-13', '2025-02-12 09:15:58', '2025-02-12 09:15:58'),
	(21, 5, '1980-01-10', '2025-02-12 09:15:58', '2025-02-12 09:15:58'),
	(22, 14, '2001-06-20', '2025-02-12 09:15:58', '2025-02-12 09:15:58'),
	(23, 15, '2002-09-20', '2025-02-12 09:15:58', '2025-02-12 09:15:58'),
	(24, 3, '1981-03-14', '2025-02-12 09:15:58', '2025-02-12 09:15:58'),
	(25, 20, '1991-01-16', '2025-02-12 09:15:58', '2025-02-12 09:15:58'),
	(26, 14, '2016-10-13', '2025-02-12 09:15:58', '2025-02-12 09:15:58'),
	(27, 17, '2016-02-16', '2025-02-12 09:15:58', '2025-02-12 09:15:58'),
	(28, 12, '1976-06-04', '2025-02-12 09:15:58', '2025-02-12 09:15:58'),
	(29, 9, '2021-05-26', '2025-02-12 09:15:58', '2025-02-12 09:15:58'),
	(30, 17, '1978-01-02', '2025-02-12 09:15:58', '2025-02-12 09:15:58'),
	(31, 18, '1989-01-31', '2025-02-12 09:15:58', '2025-02-12 09:15:58'),
	(32, 15, '2023-02-24', '2025-02-12 09:15:58', '2025-02-12 09:15:58'),
	(33, 20, '1990-06-05', '2025-02-12 09:15:58', '2025-02-12 09:15:58'),
	(34, 12, '1996-07-02', '2025-02-12 09:15:58', '2025-02-12 09:15:58'),
	(35, 16, '2010-04-26', '2025-02-12 09:15:58', '2025-02-12 09:15:58'),
	(36, 13, '1973-08-09', '2025-02-12 09:15:58', '2025-02-12 09:15:58'),
	(37, 13, '2001-11-22', '2025-02-12 09:15:58', '2025-02-12 09:15:58'),
	(38, 12, '1990-01-13', '2025-02-12 09:15:58', '2025-02-12 09:15:58'),
	(39, 5, '2014-06-12', '2025-02-12 09:15:58', '2025-02-12 09:15:58'),
	(40, 5, '1988-07-10', '2025-02-12 09:15:58', '2025-02-12 09:15:58'),
	(41, 14, '1972-11-19', '2025-02-12 09:15:58', '2025-02-12 09:15:58'),
	(42, 4, '2016-05-17', '2025-02-12 09:15:58', '2025-02-12 09:15:58'),
	(43, 20, '2007-09-09', '2025-02-12 09:15:58', '2025-02-12 09:15:58'),
	(44, 3, '2019-02-02', '2025-02-12 09:15:58', '2025-02-12 09:15:58'),
	(45, 19, '2008-08-27', '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(46, 17, '2001-08-08', '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(47, 19, '1971-02-28', '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(48, 4, '2013-08-06', '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(49, 4, '1970-07-21', '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(50, 12, '1995-09-27', '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(51, 18, '1990-01-27', '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(52, 3, '1995-12-27', '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(53, 19, '1984-03-16', '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(54, 10, '2008-02-02', '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(55, 11, '1970-03-09', '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(56, 17, '2022-05-07', '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(57, 12, '1991-01-15', '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(58, 19, '1976-04-07', '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(59, 4, '1980-06-02', '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(60, 9, '1984-01-08', '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(61, 10, '2003-04-17', '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(62, 10, '2006-01-25', '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(63, 7, '1992-02-25', '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(64, 9, '2019-05-19', '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(65, 8, '1983-07-25', '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(66, 5, '1973-09-08', '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(67, 13, '1987-01-05', '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(68, 14, '2020-09-07', '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(69, 18, '1988-09-28', '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(70, 3, '1996-04-22', '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(71, 10, '2018-12-13', '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(72, 17, '1990-04-30', '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(73, 18, '1987-09-01', '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(74, 3, '2010-10-22', '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(75, 16, '2009-06-07', '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(76, 20, '2007-03-30', '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(77, 15, '1990-04-22', '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(78, 18, '1992-07-28', '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(79, 3, '2001-06-13', '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(80, 12, '2001-11-13', '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(81, 8, '1971-11-19', '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(82, 13, '2005-07-19', '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(83, 12, '2007-07-02', '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(84, 8, '1970-04-09', '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(85, 14, '2002-03-01', '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(86, 10, '1996-04-26', '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(87, 8, '1994-11-28', '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(88, 14, '2014-10-02', '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(89, 14, '1987-01-25', '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(90, 10, '2012-07-17', '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(91, 2, '1985-05-24', '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(92, 14, '2020-09-09', '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(93, 19, '2001-12-09', '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(94, 2, '1996-12-06', '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(95, 5, '2004-01-24', '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(96, 13, '1972-03-03', '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(97, 1, '2003-01-03', '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(98, 19, '1992-07-01', '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(99, 1, '1999-08-27', '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(100, 14, '2002-10-07', '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(101, 12, '2016-01-30', '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(102, 8, '1998-02-08', '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(103, 10, '2004-09-28', '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(104, 9, '2005-05-21', '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(105, 20, '1996-08-06', '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(106, 17, '2013-11-09', '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(107, 4, '1970-08-20', '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(108, 3, '2024-03-28', '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(109, 18, '2013-07-24', '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(110, 8, '1994-11-01', '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(111, 19, '2019-09-10', '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(112, 1, '1973-03-17', '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(113, 3, '2013-05-31', '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(114, 13, '2017-05-12', '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(115, 6, '1970-07-28', '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(116, 9, '1971-03-29', '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(117, 16, '1996-07-06', '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(118, 5, '2007-01-02', '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(119, 10, '1979-11-25', '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(120, 18, '1975-04-19', '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(121, 16, '1976-11-29', '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(122, 15, '1984-08-29', '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(123, 19, '1974-08-30', '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(124, 19, '2017-07-29', '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(125, 16, '1987-11-21', '2025-02-12 09:15:59', '2025-02-12 09:15:59');

-- Dumping structure for table ecommerce_assignment.order_details
DROP TABLE IF EXISTS `order_details`;
CREATE TABLE IF NOT EXISTS `order_details` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `order_id` bigint unsigned NOT NULL,
  `product_id` bigint unsigned DEFAULT NULL,
  `qty` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_details_order_id_foreign` (`order_id`),
  KEY `order_details_product_id_foreign` (`product_id`),
  CONSTRAINT `order_details_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  CONSTRAINT `order_details_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ecommerce_assignment.order_details: ~100 rows (approximately)
INSERT INTO `order_details` (`id`, `order_id`, `product_id`, `qty`, `created_at`, `updated_at`) VALUES
	(1, 101, 10, 6, '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(2, 101, 5, 10, '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(3, 101, 11, 1, '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(4, 101, 4, 1, '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(5, 102, 10, 5, '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(6, 102, 2, 1, '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(7, 102, 19, 6, '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(8, 102, 19, 10, '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(9, 103, 6, 10, '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(10, 103, 13, 7, '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(11, 103, 9, 4, '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(12, 103, 8, 5, '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(13, 104, 5, 5, '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(14, 104, 2, 2, '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(15, 104, 5, 1, '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(16, 104, 19, 9, '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(17, 105, 11, 1, '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(18, 105, 4, 5, '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(19, 105, 13, 8, '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(20, 105, 15, 6, '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(21, 106, 11, 7, '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(22, 106, 17, 4, '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(23, 106, 1, 8, '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(24, 106, 6, 4, '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(25, 107, 5, 2, '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(26, 107, 12, 10, '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(27, 107, 18, 7, '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(28, 107, 5, 8, '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(29, 108, 4, 6, '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(30, 108, 17, 5, '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(31, 108, 18, 2, '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(32, 108, 5, 4, '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(33, 109, 4, 6, '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(34, 109, 17, 9, '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(35, 109, 18, 8, '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(36, 109, 6, 2, '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(37, 110, 16, 5, '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(38, 110, 4, 6, '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(39, 110, 8, 6, '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(40, 110, 15, 8, '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(41, 111, 13, 9, '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(42, 111, 17, 3, '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(43, 111, 4, 7, '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(44, 111, 7, 1, '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(45, 112, 7, 8, '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(46, 112, 8, 7, '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(47, 112, 3, 10, '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(48, 112, 11, 8, '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(49, 113, 5, 4, '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(50, 113, 1, 2, '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(51, 113, 14, 7, '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(52, 113, 17, 9, '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(53, 114, 19, 7, '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(54, 114, 17, 9, '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(55, 114, 11, 1, '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(56, 114, 3, 2, '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(57, 115, 10, 2, '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(58, 115, 13, 2, '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(59, 115, 6, 6, '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(60, 115, 3, 3, '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(61, 116, 17, 6, '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(62, 116, 6, 5, '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(63, 116, 13, 8, '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(64, 116, 8, 8, '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(65, 117, 13, 5, '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(66, 117, 11, 1, '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(67, 117, 13, 8, '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(68, 117, 18, 4, '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(69, 118, 18, 7, '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(70, 118, 6, 2, '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(71, 118, 19, 3, '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(72, 118, 11, 3, '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(73, 119, 9, 8, '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(74, 119, 12, 3, '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(75, 119, 17, 7, '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(76, 119, 2, 5, '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(77, 120, 10, 9, '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(78, 120, 16, 8, '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(79, 120, 13, 8, '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(80, 120, 4, 6, '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(81, 121, 18, 6, '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(82, 121, 13, 7, '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(83, 121, 9, 1, '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(84, 121, 15, 4, '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(85, 122, 3, 4, '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(86, 122, 13, 10, '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(87, 122, 12, 4, '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(88, 122, 17, 1, '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(89, 123, 15, 3, '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(90, 123, 4, 9, '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(91, 123, 7, 1, '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(92, 123, 5, 6, '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(93, 124, 5, 1, '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(94, 124, 17, 4, '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(95, 124, 3, 9, '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(96, 124, 14, 10, '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(97, 125, 5, 7, '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(98, 125, 5, 5, '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(99, 125, 2, 9, '2025-02-12 09:15:59', '2025-02-12 09:15:59'),
	(100, 125, 12, 5, '2025-02-12 09:15:59', '2025-02-12 09:15:59');

-- Dumping structure for table ecommerce_assignment.password_reset_tokens
DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ecommerce_assignment.password_reset_tokens: ~0 rows (approximately)

-- Dumping structure for table ecommerce_assignment.personal_access_tokens
DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ecommerce_assignment.personal_access_tokens: ~4 rows (approximately)
INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
	(1, 'App\\Models\\User', 1, 'auth_token', '7ba1cc5cbdd3e18df28dd212156e35fe3fda64f9d1e7989879ea6df704846158', '["*"]', NULL, NULL, '2025-02-12 09:15:53', '2025-02-12 09:15:53'),
	(2, 'App\\Models\\User', 2, 'auth_token', 'cbf57a55abec84a64ed6fc643574ff90390664298577ce5bde2e715ec8fa4ebe', '["*"]', NULL, NULL, '2025-02-12 09:15:53', '2025-02-12 09:15:53'),
	(11, 'App\\Models\\User', 2, 'auth_token', '44c2810418fc2869fbdf1836f0b1a47afb2ffceaf3a235d8ebc53a068b9551e6', '["*"]', '2025-03-29 01:35:16', NULL, '2025-03-29 01:34:17', '2025-03-29 01:35:16'),
	(14, 'App\\Models\\User', 2, 'auth_token', 'b04d951e3f05101e6674ce1ce7d1e44118b8bb82c3091de24b690b902c16241e', '["*"]', '2025-04-04 18:35:58', NULL, '2025-04-04 18:35:31', '2025-04-04 18:35:58');

-- Dumping structure for table ecommerce_assignment.posts
DROP TABLE IF EXISTS `posts`;
CREATE TABLE IF NOT EXISTS `posts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_path` text COLLATE utf8mb4_unicode_ci,
  `image_url` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ecommerce_assignment.posts: ~0 rows (approximately)

-- Dumping structure for table ecommerce_assignment.products
DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `qty` int NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `star` decimal(3,2) NOT NULL,
  `time_value` int NOT NULL,
  `product_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `products_category_id_foreign` (`category_id`),
  CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=70 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ecommerce_assignment.products: ~66 rows (approximately)
INSERT INTO `products` (`id`, `product_name`, `product_description`, `qty`, `price`, `star`, `time_value`, `product_image`, `category_id`, `created_at`, `updated_at`) VALUES
	(1, 'Margherita', 'Margherita', 150, 29.99, 4.50, 60, 'storage/products/margherita.jpg', 1, '2025-02-12 09:15:53', '2025-02-12 09:15:53'),
	(2, 'Bacon and Cheese Heaven', 'Bacon and Cheese Heaven', 75, 89.99, 4.70, 120, 'storage/products/bacon_and_cheese_heaven.jpg', 1, '2025-02-12 09:15:53', '2025-02-12 09:15:53'),
	(3, 'Bacon-Wrapped Filet Mignon', 'Bacon-Wrapped Filet Mignon', 300, 19.99, 4.00, 30, 'storage/products/bacon_wrapped_filet_mignon.jpg', 2, '2025-02-12 09:15:53', '2025-02-12 09:15:53'),
	(4, 'BBQ Chicken Delight', 'BBQ Chicken Delight', 120, 59.99, 4.60, 90, 'storage/products/bbq_chicken_delight.jpg', 3, '2025-02-12 09:15:53', '2025-02-12 09:15:53'),
	(5, 'BBQ Ranch Delight', 'BBQ Ranch Delight', 200, 39.99, 4.30, 60, 'storage/products/bbq_ranch_delight.jpg', 4, '2025-02-12 09:15:53', '2025-02-12 09:15:53'),
	(6, 'Beef Stir-Fry with Broccoli', 'Beef Stir-Fry with Broccoli', 85, 149.99, 4.80, 150, 'storage/products/beef_stir_fry_with_broccoli.jpg', 5, '2025-02-12 09:15:53', '2025-02-12 09:15:53'),
	(7, 'Berry Blast Smoothie', 'Berry Blast Smoothie', 220, 99.99, 4.70, 90, 'storage/products/berry_blast_smoothie.jpg', 6, '2025-02-12 09:15:53', '2025-02-12 09:15:53'),
	(8, 'California Roll', 'California Roll', 100, 79.99, 4.50, 100, 'storage/products/california_roll.jpg', 7, '2025-02-12 09:15:53', '2025-02-12 09:15:53'),
	(9, 'Chicago Style Hot Dog', 'Chicago Style Hot Dog', 250, 25.99, 4.20, 45, 'storage/products/chicago_style_hot_dog.jpg', 8, '2025-02-12 09:15:53', '2025-02-12 09:15:53'),
	(10, 'Chicken Avocado Bliss', 'Chicken Avocado Bliss', 50, 299.99, 4.60, 180, 'storage/products/chicken_avocado_bliss.jpg', 1, '2025-02-12 09:15:53', '2025-02-12 09:15:53'),
	(11, 'Chili Cheese Dog', 'Chili Cheese Dog', 180, 24.99, 4.40, 70, 'storage/products/chili_cheese_dog.jpg', 1, '2025-02-12 09:15:53', '2025-02-12 09:15:53'),
	(12, 'Classic Beef Burger', 'Classic Beef Burger', 500, 9.99, 4.10, 20, 'storage/products/classic_beef_burger.jpg', 2, '2025-02-12 09:15:53', '2025-02-12 09:15:53'),
	(13, 'Classic Beef Hot Dog', 'Classic Beef Hot Dog', 40, 199.99, 4.80, 180, 'storage/products/classic_beef_hot_dog.jpg', 3, '2025-02-12 09:15:53', '2025-02-12 09:15:53'),
	(14, 'Coconut Water', 'Coconut Water', 300, 14.99, 4.20, 30, 'storage/products/coconut_water.jpg', 4, '2025-02-12 09:15:53', '2025-02-12 09:15:53'),
	(15, 'Dragon Roll', 'Dragon Roll', 200, 19.99, 4.30, 60, 'storage/products/dragon_roll.jpg', 5, '2025-02-12 09:15:53', '2025-02-12 09:15:53'),
	(16, 'Espresso Martini', 'Espresso Martini', 150, 34.99, 4.40, 80, 'storage/products/espresso_martini.jpg', 6, '2025-02-12 09:15:53', '2025-02-12 09:15:53'),
	(17, 'Four Cheese Delight', 'Four Cheese Delight', 120, 39.99, 4.50, 100, 'storage/products/four_cheese_delight.jpg', 7, '2025-02-12 09:15:53', '2025-02-12 09:15:53'),
	(18, 'Fresh Orange Juice', 'Fresh Orange Juice', 200, 49.99, 4.70, 120, 'storage/products/fresh_orange_juice.jpg', 8, '2025-02-12 09:15:53', '2025-02-12 09:15:53'),
	(19, 'Garlic Parmesan Chicken', 'Garlic Parmesan Chicken', 80, 79.99, 4.60, 150, 'storage/products/garlic_parmesan_chicken.jpg', 9, '2025-02-12 09:15:53', '2025-02-12 09:15:53'),
	(20, 'Green Tea Latte', 'Green Tea Latte', 80, 79.99, 4.60, 150, 'storage/products/green_tea_latte.jpg', 9, '2025-02-12 09:15:53', '2025-02-12 09:15:53'),
	(21, 'Grilled Ribeye Steak', 'Grilled Ribeye Steak', 80, 79.99, 4.60, 150, 'storage/products/grilled_ribeye_steak.jpg', 9, '2025-02-12 09:15:53', '2025-02-12 09:15:53'),
	(22, 'Green Tea Latte', 'Green Tea Latte', 90, 89.99, 3.60, 150, 'storage/products/green_tea_latte.jpg', 9, '2025-02-12 09:15:53', '2025-02-12 09:15:53'),
	(23, 'Grilled Ribeye Steak', 'Grilled Ribeye Steak', 90, 89.99, 3.60, 150, 'storage/products/grilled_ribeye_steak.jpg', 9, '2025-02-12 09:15:53', '2025-02-12 09:15:53'),
	(24, 'Hawaiian BBQ Dog', 'Hawaiian BBQ Dog', 90, 89.99, 3.60, 150, 'storage/products/hawaiian_bbq_dog.jpg', 9, '2025-02-12 09:15:53', '2025-02-12 09:15:53'),
	(25, 'Hawaiian Paradise', 'Hawaiian Paradise', 90, 89.99, 3.60, 150, 'storage/products/hawaiian_paradise.jpg', 9, '2025-02-12 09:15:53', '2025-02-12 09:15:53'),
	(26, 'Honey Mustard Glazed Tenders', 'Honey Mustard Glazed Tenders', 90, 89.99, 3.60, 150, 'storage/products/honey_mustard_glazed_tenders.jpg', 9, '2025-02-12 09:15:53', '2025-02-12 09:15:53'),
	(27, 'Iced Caramel Macchiato', 'Iced Caramel Macchiato', 90, 89.99, 3.60, 150, 'storage/products/iced_caramel_macchiato.jpg', 9, '2025-02-12 09:15:53', '2025-02-12 09:15:53'),
	(28, 'Kimchi Hot Dog', 'Kimchi Hot Dog', 90, 89.99, 3.60, 150, 'storage/products/kimchi_hot_dog.jpg', 9, '2025-02-12 09:15:53', '2025-02-12 09:15:53'),
	(29, 'Korean BBQ Short Ribs', 'Korean BBQ Short Ribs', 90, 89.99, 3.60, 150, 'storage/products/korean_bbq_short_ribs.jpg', 9, '2025-02-12 09:15:53', '2025-02-12 09:15:53'),
	(30, 'Korean Fried Chicken', 'Korean Fried Chicken', 90, 89.99, 3.60, 150, 'storage/products/korean_fried_chicken.jpg', 9, '2025-02-12 09:15:53', '2025-02-12 09:15:53'),
	(31, 'Lemon Pepper Chicken', 'Lemon Pepper Chicken', 90, 89.99, 3.60, 150, 'storage/products/lemon_pepper_chicken.jpg', 9, '2025-02-12 09:15:53', '2025-02-12 09:15:53'),
	(32, 'Mango Tango Slush', 'Mango Tango Slush', 90, 89.99, 3.60, 150, 'storage/products/mango_tango_slush.jpg', 9, '2025-02-12 09:15:53', '2025-02-12 09:15:53'),
	(33, 'Margherita Flatbread', 'Margherita Flatbread', 90, 89.99, 3.60, 150, 'storage/products/margherita_flatbread.jpg', 9, '2025-02-12 09:15:53', '2025-02-12 09:15:53'),
	(34, 'Margherita', 'Margherita', 90, 89.99, 3.60, 150, 'storage/products/margherita.jpg', 9, '2025-02-12 09:15:53', '2025-02-12 09:15:53'),
	(35, 'Reuben Style Hot Dog', 'Reuben Style Hot Dog', 90, 89.99, 3.60, 150, 'storage/products/reuben_style_hot_dog.jpg', 9, '2025-02-12 09:15:53', '2025-02-12 09:15:53'),
	(36, 'Salmon Nigiri', 'Salmon Nigiri', 70, 69.99, 3.60, 150, 'storage/products/salmon_nigiri.jpg', 9, '2025-02-12 09:15:53', '2025-02-12 09:15:53'),
	(37, 'Sashimi Platter', 'Sashimi Platter', 90, 59.99, 4.60, 150, 'storage/products/sashimi_platter.jpg', 9, '2025-02-12 09:15:53', '2025-02-12 09:15:53'),
	(38, 'Shrimp Scampi', 'Shrimp Scampi', 100, 62.99, 4.60, 150, 'storage/products/shrimp_scampi.jpg', 9, '2025-02-12 09:15:53', '2025-02-12 09:15:53'),
	(39, 'Smoked BBQ Brisket', 'Smoked BBQ Brisket', 75, 85.99, 4.60, 150, 'storage/products/smoked_bbq_brisket.jpg', 9, '2025-02-12 09:15:53', '2025-02-12 09:15:53'),
	(40, 'Southern-Style Chicken Biscuit', 'Southern-Style Chicken Biscuit', 80, 79.99, 4.60, 150, 'storage/products/southern_style_chicken_biscuit.jpg', 9, '2025-02-12 09:15:53', '2025-02-12 09:15:53'),
	(41, 'Spicy Buffalo Wings', 'Spicy Buffalo Wings', 80, 79.99, 4.60, 150, 'storage/products/spicy_buffalo_wings.jpg', 9, '2025-02-12 09:15:53', '2025-02-12 09:15:53'),
	(42, 'Spicy Jalapeño Burger', 'Spicy Jalapeño Burger', 80, 45.99, 4.60, 150, 'storage/products/spicy_jalapeno_burger.jpg', 9, '2025-02-12 09:15:53', '2025-02-12 09:15:53'),
	(43, 'Spicy Moroccan Lamb Chops', 'Spicy Moroccan Lamb Chops', 80, 78.99, 4.60, 150, 'storage/products/spicy_moroccan_lamb_chops.jpg', 9, '2025-02-12 09:15:53', '2025-02-12 09:15:53'),
	(44, 'Spicy Tuna Roll', 'Spicy Tuna Roll', 80, 87.99, 4.60, 150, 'storage/products/spicy_tuna_roll.jpg', 9, '2025-02-12 09:15:53', '2025-02-12 09:15:53'),
	(45, 'Spinach and Feta Stuffed Chicken', 'Spinach and Feta Stuffed Chicken', 80, 63.99, 4.60, 150, 'storage/products/spinach_and_feta_stuffed_chicken.jpg', 9, '2025-02-12 09:15:53', '2025-02-12 09:15:53'),
	(46, 'Stuffed Bell Peppers with Ground Turkey', 'Stuffed Bell Peppers with Ground Turkey', 80, 52.99, 4.60, 150, 'storage/products/stuffed_bell_peppers_with_ground_turkey.jpg', 9, '2025-02-12 09:15:53', '2025-02-12 09:15:53'),
	(47, 'Tempura Shrimp Roll', 'Tempura Shrimp Roll', 80, 61.99, 4.60, 150, 'storage/products/tempura_shrimp_roll.jpg', 9, '2025-02-12 09:15:53', '2025-02-12 09:15:53'),
	(48, 'Teriyaki Chicken Wings', 'Teriyaki Chicken Wings', 80, 76.99, 4.60, 150, 'storage/products/teriyaki_chicken_wings.jpg', 9, '2025-02-12 09:15:53', '2025-02-12 09:15:53'),
	(49, 'Teriyaki Glazed Chicken Thighs', 'Teriyaki Glazed Chicken Thighs', 80, 68.99, 4.60, 150, 'storage/products/teriyaki_glazed_chicken_thighs.jpg', 9, '2025-02-12 09:15:53', '2025-02-12 09:15:53'),
	(50, 'Teriyaki Pineapple Pleasure', 'Teriyaki Pineapple Pleasure', 80, 77.99, 4.60, 150, 'storage/products/teriyaki_pineapple_pleasure.jpg', 9, '2025-02-12 09:15:53', '2025-02-12 09:15:53'),
	(51, 'Thai Red Curry', 'Thai Red Curry', 80, 96.99, 4.60, 150, 'storage/products/thai_red_curry.jpg', 9, '2025-02-12 09:15:53', '2025-02-12 09:15:53'),
	(52, 'Vegetarian Pad Thai', 'Vegetarian Pad Thai', 80, 95.99, 4.60, 150, 'storage/products/vegetarian_pad_thai.jpg', 9, '2025-02-12 09:15:53', '2025-02-12 09:15:53'),
	(53, 'Veggie Dog with Sauerkraut', 'Veggie Dog with Sauerkraut', 80, 93.99, 4.60, 150, 'storage/products/veggie_dog_with_sauerkraut.jpg', 9, '2025-02-12 09:15:53', '2025-02-12 09:15:53'),
	(54, 'Veggie Extravaganza', 'Veggie Extravaganza', 80, 45.99, 4.60, 150, 'storage/products/veggie_extravaganza.jpg', 9, '2025-02-12 09:15:53', '2025-02-12 09:15:53'),
	(55, 'Veggie Roll', 'Veggie Roll', 80, 78.99, 4.60, 150, 'storage/products/veggie_roll.jpg', 9, '2025-02-12 09:15:53', '2025-02-12 09:15:53'),
	(56, 'Meat Feast pizza', 'Meat Feast pizza', 150, 25.80, 4.30, 60, 'storage/products/meat_feast_pizza.jpg', 4, '2025-02-12 09:15:53', '2025-02-12 09:15:53'),
	(57, 'Mediterranean Joy', 'Mediterranean Joy', 130, 43.00, 5.00, 50, 'storage/products/mediterranean_joy.jpg', 4, '2025-02-12 09:15:53', '2025-02-12 09:15:53'),
	(58, 'Mint Lemonade', 'Mint Lemonade', 160, 23.00, 3.50, 50, 'storage/products/mint_lemonade.jpg', 4, '2025-02-12 09:15:53', '2025-02-12 09:15:53'),
	(59, 'Mushroom Swiss Delight', 'Mushroom Swiss Delight', 430, 43.00, 4.50, 50, 'storage/products/mushroom_swiss_delight.jpg', 4, '2025-02-12 09:15:53', '2025-02-12 09:15:53'),
	(60, 'Original Crispy Chicken', 'Original Crispy Chicken', 250, 41.00, 4.50, 50, 'storage/products/original_crispy_chicken.jpg', 4, '2025-02-12 09:15:53', '2025-02-12 09:15:53'),
	(61, 'Pan Seared Garlic Butter Sirloin', 'Pan Seared Garlic Butter Sirloin', 200, 40.00, 4.50, 50, 'storage/products/pan_seared_garlic_butter_sirloin.jpg', 4, '2025-02-12 09:15:53', '2025-02-12 09:15:53'),
	(62, 'Pasta Carbonara', 'Pasta Carbonara', 240, 37.00, 4.50, 50, 'storage/products/pasta_carbonara.jpg', 4, '2025-02-12 09:15:53', '2025-02-12 09:15:53'),
	(63, 'Pepperoni Lovers', 'Pepperoni Lovers', 140, 32.00, 4.50, 50, 'storage/products/pepperoni_lovers.jpg', 4, '2025-02-12 09:15:53', '2025-02-12 09:15:53'),
	(64, 'Pretzel Bun Dog', 'Pretzel Bun Dog', 260, 33.00, 4.50, 50, 'storage/products/pretzel_bun_dog.jpg', 4, '2025-02-12 09:15:53', '2025-02-12 09:15:53'),
	(65, 'Quinoa Salad Bowl.jpg', 'Quinoa Salad Bowl', 278, 37.00, 5.00, 50, 'storage/products/quinoa_salad_bowl.jpg', 4, '2025-02-12 09:15:53', '2025-02-12 09:15:53'),
	(66, 'Rainbow Roll', 'Rainbow Roll', 278, 37.00, 5.00, 50, 'storage/products/rainbow_roll.jpg', 4, '2025-02-12 09:15:53', '2025-02-12 09:15:53'),
	(67, 'bbbbbb', 'aaaa Description', 10, 100.00, 5.00, 10, 'storage/products/aaaaaaaa_67aec1a45f558.jpg', 1, '2025-02-12 09:17:32', '2025-02-13 22:19:05');

-- Dumping structure for table ecommerce_assignment.roles
DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ecommerce_assignment.roles: ~2 rows (approximately)
INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
	(1, 'Admin', '2025-02-12 09:15:52', '2025-02-12 09:15:52'),
	(2, 'User', '2025-02-12 09:15:52', '2025-02-12 09:15:52');

-- Dumping structure for table ecommerce_assignment.sessions
DROP TABLE IF EXISTS `sessions`;
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ecommerce_assignment.sessions: ~0 rows (approximately)
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
	('g2U7WxJO871RSlQhw6JakA16V2JqzJusdqfRI5Pe', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiaEJjNm9rZnRMZ3J6NTEzZ1FyWms1UzlnVXdiNGR3N0dYUEZwaklJUCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC91c2Vycy9jcmVhdGUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1748326918);

-- Dumping structure for table ecommerce_assignment.sliders
DROP TABLE IF EXISTS `sliders`;
CREATE TABLE IF NOT EXISTS `sliders` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `slider_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slider_description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ecommerce_assignment.sliders: ~6 rows (approximately)
INSERT INTO `sliders` (`id`, `slider_image`, `slider_description`, `created_at`, `updated_at`) VALUES
	(1, 'storage/sliders/slider1.jpg', 'Slider 1', '2025-02-12 09:15:53', '2025-02-12 09:15:53'),
	(2, 'storage/sliders/slider2.jpg', 'Slider 2', '2025-02-12 09:15:53', '2025-02-12 09:15:53'),
	(3, 'storage/sliders/slider3.jpg', 'Slider 3', '2025-02-12 09:15:53', '2025-02-12 09:15:53'),
	(4, 'storage/sliders/slider4.jpg', 'Slider 4', '2025-02-12 09:15:53', '2025-02-12 09:15:53'),
	(5, 'storage/sliders/slider5.jpg', 'Slider 5', '2025-02-12 09:15:53', '2025-02-12 09:15:53'),
	(6, 'storage/sliders/slider6.jpg', 'Slider 6', '2025-02-12 09:15:53', '2025-02-12 09:15:53');

-- Dumping structure for table ecommerce_assignment.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profile_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role_id` bigint unsigned NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_phone_unique` (`phone`),
  KEY `users_role_id_foreign` (`role_id`),
  CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ecommerce_assignment.users: ~22 rows (approximately)
INSERT INTO `users` (`id`, `name`, `username`, `email`, `phone`, `email_verified_at`, `password`, `address`, `profile_image`, `remember_token`, `role_id`, `status`, `created_at`, `updated_at`) VALUES
	(1, 'Super Admin', 'supperadmin', 'admin@login.com', '078343143', NULL, '$2y$12$5M4XLyenEcPF35wg/Qph0eWGBwvn3kNzuazonIisYxsIbFoVVae6K', NULL, NULL, NULL, 1, 1, '2025-02-12 09:15:53', '2025-02-12 09:15:53'),
	(2, 'Customer', 'customer', 'customer@login.com', '012555666', NULL, '$2y$12$SmfBIxNEM/yUvG8L3I6HP.v2k/bIEa6nKpFBT3e14b3dDmjDHvDBi', NULL, NULL, NULL, 2, 1, '2025-02-12 09:15:53', '2025-02-12 09:15:53'),
	(3, 'Nathan Greenfelder', 'oemmerich', 'yhansen@example.net', '+1-440-483-9924', '2025-02-12 09:15:53', '$2y$12$PIzjKFYpn6Cwu0lemF/n8OIFdZrUh38KiE/sxVN7TzQjgff3gIyau', '231 Lang Freeway\nHaskellborough, VT 21547', 'https://via.placeholder.com/200x200.png/003388?text=people+necessitatibus', '2nsvcKhG3X', 2, 1, '2025-02-12 09:15:58', '2025-02-12 09:15:58'),
	(4, 'Norwood Corwin', 'jed.ernser', 'franco67@example.org', '346-264-3119', '2025-02-12 09:15:53', '$2y$12$/q8Vjo2wo9OBZIqg9oU00u/3gHM7R3C02xDf6N6P7MQGCjoIRx1ci', '1497 Green Estates Apt. 695\nBricetown, IL 96111', 'https://via.placeholder.com/200x200.png/0011dd?text=people+aut', 'Dznx6YCjQx', 2, 1, '2025-02-12 09:15:58', '2025-02-12 09:15:58'),
	(5, 'Elias Hammes', 'maya.schulist', 'dklocko@example.org', '747-554-3296', '2025-02-12 09:15:54', '$2y$12$jlrPTKz103UFRfylCIqph.5qAgivEdeMFxpvIAZf0EtpKXaQcw8pm', '8754 Tianna Pines Suite 709\nWest Coty, KY 32734', 'https://via.placeholder.com/200x200.png/0088bb?text=people+libero', 'QsLddydAbp', 2, 1, '2025-02-12 09:15:58', '2025-02-12 09:15:58'),
	(6, 'Adolphus Reichel', 'bradley.bogan', 'reichert.elfrieda@example.com', '1-681-977-1132', '2025-02-12 09:15:54', '$2y$12$WW98xVjOkgg9WDwEHZGFouI1pQDzf8Q9G9BWjQr.U7vleyBg/7Zni', '63537 Eliane Shoals Apt. 745\nEast Garret, CA 39864-8736', 'https://via.placeholder.com/200x200.png/00dd11?text=people+ullam', 'oJCuh8O41K', 2, 1, '2025-02-12 09:15:58', '2025-02-12 09:15:58'),
	(7, 'Gerda Kshlerin DDS', 'jaylan.goldner', 'kobe50@example.net', '276.222.7245', '2025-02-12 09:15:54', '$2y$12$S2iRQF0dWfXEXAghd/wGoeJHTmskn5J6.HRVUgcTHqi3FngMYBDki', '104 Ruecker Field Suite 143\nNorth Lavernehaven, TX 36885-7253', 'https://via.placeholder.com/200x200.png/005555?text=people+veniam', 'G1sTBGg6dc', 2, 1, '2025-02-12 09:15:58', '2025-02-12 09:15:58'),
	(8, 'Joannie Medhurst', 'elody15', 'lottie.schinner@example.net', '907-263-2273', '2025-02-12 09:15:54', '$2y$12$6dV4i9X5LvxLqUot6fraxOs//VppQQAumFhREASy4s92k.WW/amQS', '23556 Ronaldo Inlet Suite 144\nMaximilliatown, MA 15526-1619', 'https://via.placeholder.com/200x200.png/008877?text=people+voluptatem', 'cikF1MythU', 2, 1, '2025-02-12 09:15:58', '2025-02-12 09:15:58'),
	(9, 'Dr. Edmond D\'Amore', 'corrine35', 'becker.johnny@example.net', '(445) 779-2119', '2025-02-12 09:15:55', '$2y$12$y.vHn1prR6Q8wwE7oi6uzOZpNBQexLX/j1GsCt9LhcOugKldsdwoy', '669 Sophie Isle Apt. 614\nThielview, IN 45432', 'https://via.placeholder.com/200x200.png/00dd22?text=people+cumque', 'uEndHHKbTF', 2, 1, '2025-02-12 09:15:58', '2025-02-12 09:15:58'),
	(10, 'Brycen Bergnaum', 'karl89', 'kamron31@example.com', '231.543.3180', '2025-02-12 09:15:55', '$2y$12$jc8YpaGvQIGn/vso7ecuCuMP69CHy62PV7rCnpuQM/yAQkrTGWDbG', '55950 Russel Hill Apt. 224\nSouth Alysonstad, IA 44952-4414', 'https://via.placeholder.com/200x200.png/0077cc?text=people+est', 'e8jprZtPJW', 2, 1, '2025-02-12 09:15:58', '2025-02-12 09:15:58'),
	(11, 'Gisselle Kuphal', 'zakary.kulas', 'ikemmer@example.net', '828-598-6468', '2025-02-12 09:15:55', '$2y$12$9h5c0PhVJenFoFkfrfuuq.yt9P1GV56Zr6NFDEAnlm1TA3.OUfqPq', '71012 Hill Dale Suite 162\nNorth Monserratview, NE 58462', 'https://via.placeholder.com/200x200.png/007700?text=people+maxime', '4NKjGMQyxM', 2, 1, '2025-02-12 09:15:58', '2025-02-12 09:15:58'),
	(12, 'Prof. Leonard Hettinger Jr.', 'stroman.ezra', 'mozelle.cummings@example.org', '+1-404-223-1102', '2025-02-12 09:15:55', '$2y$12$p8BA0JovlgYvAtfCNPaai.QCmVE4g7X7bn9KUv8kZGQtcOThWdOlq', '1627 Devon Estates\nPort Casimershire, CA 48247-7803', 'https://via.placeholder.com/200x200.png/00cc88?text=people+et', 'nKtrPos2sO', 2, 1, '2025-02-12 09:15:58', '2025-02-12 09:15:58'),
	(13, 'Dock Farrell PhD', 'axel.stehr', 'dbailey@example.org', '(743) 906-0903', '2025-02-12 09:15:56', '$2y$12$YgIt9W50s92k4brNeA5TguR2.FclVyE7RDXYrVf1kd900Le1iKF/W', '181 Ubaldo Points Apt. 122\nPort Shayna, MD 98486', 'https://via.placeholder.com/200x200.png/00bbee?text=people+molestias', 'VYHZs5QqFo', 2, 1, '2025-02-12 09:15:58', '2025-02-12 09:15:58'),
	(14, 'Nicholaus Lehner', 'dicki.kirstin', 'beier.cornell@example.org', '239-952-3682', '2025-02-12 09:15:56', '$2y$12$RKhg6ZzPfp4WXNchWy5kK.IJLDUaOgfhfIHENFmjw3JEJWEClUS.6', '3957 Guillermo Key Suite 830\nNew Laceyport, NE 74638', 'https://via.placeholder.com/200x200.png/00bb00?text=people+ullam', 'deP117EVZB', 2, 1, '2025-02-12 09:15:58', '2025-02-12 09:15:58'),
	(15, 'Maximus Fahey', 'rachelle.schroeder', 'langworth.georgette@example.org', '+1-206-864-4764', '2025-02-12 09:15:56', '$2y$12$NptUlDQdAOj6gq.WyJ3LwuTA9DHpDpH416X8Mnlgi1rO3QbHHDgMW', '235 Baumbach Estates Apt. 234\nKeeblerborough, MO 56799-9639', 'https://via.placeholder.com/200x200.png/00ddbb?text=people+suscipit', 'fhk8TGGPrp', 2, 1, '2025-02-12 09:15:58', '2025-02-12 09:15:58'),
	(16, 'Mrs. Christiana Bartell', 'hkessler', 'hamill.alexandre@example.com', '860-732-1923', '2025-02-12 09:15:56', '$2y$12$.cayvTsxPM/0smqToDhOjOm2dRGjTXULnY5Bl0HFqrM1f8OoFoe52', '5645 Jacobs Mountain Apt. 640\nPort Halle, WV 52657-5009', 'https://via.placeholder.com/200x200.png/0055ee?text=people+in', 'rlORz8w0sj', 2, 1, '2025-02-12 09:15:58', '2025-02-12 09:15:58'),
	(17, 'Prof. Tito Schmitt DDS', 'keeling.may', 'donato.tromp@example.com', '+1.580.253.1540', '2025-02-12 09:15:57', '$2y$12$nI.VDFfFEeyEMDp88zHJR.HvageQhFEDJOJ/7VybYshKLAdfEfLZm', '71590 Adams Hills\nRatkehaven, SC 79862-2689', 'https://via.placeholder.com/200x200.png/00ff55?text=people+voluptatem', '04kfZGIGP3', 2, 1, '2025-02-12 09:15:58', '2025-02-12 09:15:58'),
	(18, 'Quinten Murphy', 'cmaggio', 'gay.jones@example.net', '+18786884340', '2025-02-12 09:15:57', '$2y$12$UDGTudsVjbC8ypW5oaWY4.dPgAE.wK5z5NHi0tnDisn/Cr3H8w3um', '3153 Rath Junctions\nSouth Jordi, OH 46569-6028', 'https://via.placeholder.com/200x200.png/00dd33?text=people+molestiae', 'pZA5xEQlKd', 2, 1, '2025-02-12 09:15:58', '2025-02-12 09:15:58'),
	(19, 'Cara Green', 'mariana.bednar', 'henriette11@example.com', '(726) 330-7908', '2025-02-12 09:15:57', '$2y$12$Ql.4XQuzQf2bqq9Sp5QZSOLSM.VEW9U4W4wJ/jxm1IzNG80PcIz2C', '22288 Kamryn Crest\nAltheahaven, VA 79575-1241', 'https://via.placeholder.com/200x200.png/0055cc?text=people+et', 'XUmo7bY0Gz', 2, 1, '2025-02-12 09:15:58', '2025-02-12 09:15:58'),
	(20, 'Granville Becker', 'bergstrom.jalyn', 'dejuan.davis@example.net', '1-256-476-8663', '2025-02-12 09:15:58', '$2y$12$eJuE6JLCqKBYVDO.GVz9m.m30fr07OWD1PGzwyzq0k./dNuNRjhFK', '280 Satterfield Mills\nWest Kaela, NM 00532-2675', 'https://via.placeholder.com/200x200.png/0044ff?text=people+ut', 'ydOjY10PcB', 2, 1, '2025-02-12 09:15:58', '2025-02-12 09:15:58'),
	(21, 'Dillan Kertzmann PhD', 'geraldine.grady', 'eliza.lakin@example.com', '+1-607-341-3799', '2025-02-12 09:15:58', '$2y$12$RlzdLSeES/AoxxDt4n8lHusUHRmYe5cJHkBdgkM1PCiDsHJzs0xX6', '27730 Leffler Burg Apt. 983\nEmiliebury, TX 16017-7020', 'https://via.placeholder.com/200x200.png/00aa88?text=people+pariatur', '4Ajx3G5hY6', 2, 1, '2025-02-12 09:15:58', '2025-02-12 09:15:58'),
	(22, 'Erwin Pollich', 'sporer.rahul', 'adams.graciela@example.net', '559.809.2629', '2025-02-12 09:15:58', '$2y$12$U5FsJwePIAk58IDF.I6AnexYswxZ5S.aFZsxLfF.kdKDg3CDPNsjC', '3440 Arielle Valleys\nGailmouth, OH 78094-5158', 'https://via.placeholder.com/200x200.png/009900?text=people+aspernatur', 'CVU3Gj6mz1', 2, 1, '2025-02-12 09:15:58', '2025-02-12 09:15:58');
