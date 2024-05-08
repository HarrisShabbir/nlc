-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 27, 2022 at 01:33 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nlc`
--

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` int(11) NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `weight` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `category_id`, `code`, `name`, `weight`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 1, 'WEF17', 'Pepsi 1.5 lt', '750', 1, 1, '2022-05-25 20:31:52', '2022-05-25 20:35:36'),
(2, 1, '693037', 'Coca Cola 1.5 lt', '750', 1, 1, '2022-05-25 20:32:10', '2022-05-25 20:35:24'),
(3, 2, 'Sz7RJ', 'Sprite 1.5 lt', '750', 1, 1, '2022-05-25 20:33:21', '2022-05-25 20:35:30'),
(4, 2, '22784', 'Mountain Dew 1.5 lt', '750', 1, 1, '2022-05-25 20:33:47', '2022-05-25 20:35:10'),
(5, 2, '592841', 'Sting 1.5 lt', '750', 1, 1, '2022-05-25 20:34:46', '2022-05-25 20:35:17');

-- --------------------------------------------------------

--
-- Table structure for table `article_details`
--

CREATE TABLE `article_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `detailable_id` int(11) NOT NULL,
  `detailable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `article_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total_weight` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `article_details`
--

INSERT INTO `article_details` (`id`, `detailable_id`, `detailable_type`, `article_id`, `quantity`, `total_weight`, `created_at`, `updated_at`) VALUES
(1, 1, 'App\\Models\\InLoad', 1, 10, 7500, NULL, NULL),
(2, 1, 'App\\Models\\InLoad', 2, 10, 7500, NULL, NULL),
(3, 1, 'App\\Models\\InLoad', 3, 10, 7500, NULL, NULL),
(4, 1, 'App\\Models\\InLoad', 4, 10, 7500, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Inload', NULL, NULL),
(2, 'Outload', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `distributors`
--

CREATE TABLE `distributors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `business_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `distributors`
--

INSERT INTO `distributors` (`id`, `name`, `phone_number`, `address`, `business_name`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Asim Khan', '03346306884', 'Barkat Market Lahore', 'ZX Cola', 1, 1, '2022-05-25 21:00:12', '2022-05-25 21:00:31'),
(2, 'Abid Ali', '03324506372', 'Shahdra chowk lahore', 'Umair Drinks', 1, NULL, '2022-05-25 21:01:41', '2022-05-25 21:01:41'),
(3, 'Rizwan Ali', '03336852469', 'Barkat Market Lahore', 'National Drinks', 1, NULL, '2022-05-25 21:02:14', '2022-05-25 21:02:14'),
(4, 'Shahwar', '03326542963', 'Al madina Book shop Lahore', 'Lahore Drinks', 1, NULL, '2022-05-25 21:02:53', '2022-05-25 21:02:53'),
(5, 'Karim Ali', '03025674221', 'Main market Lahore', 'AB Drinks', 1, NULL, '2022-05-25 21:03:25', '2022-05-25 21:03:25');

-- --------------------------------------------------------

--
-- Table structure for table `drivers`
--

CREATE TABLE `drivers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `vehicle_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cnic` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `license_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nationality` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `drivers`
--

INSERT INTO `drivers` (`id`, `vehicle_id`, `name`, `phone_number`, `cnic`, `date_of_birth`, `license_number`, `nationality`, `address`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Bilal Ahmed', '03006306584', '32132-1313213-1', '1990-06-02', '123456', 'Pakistan', 'Barkat Market Lahore', 1, NULL, '2022-05-25 20:08:59', '2022-05-25 20:08:59'),
(2, NULL, 'Asad', '03324506372', '33202-6565645-6', '1980-06-06', '1234635', 'Pakistan', 'Al madina Book shop near tohedia masjid Okara Cantt', 1, NULL, '2022-05-25 20:26:06', '2022-05-25 20:26:06'),
(3, NULL, 'Ali Ahmed', '03323336372', '33532-3692581-1', '1989-09-07', '369456', 'Pakistan', 'Fzala Din Chowk Burewala', 1, NULL, '2022-05-25 20:27:24', '2022-05-25 20:27:24'),
(4, NULL, 'Abid Ali', '0302852694', '32332-3694531-7', '1975-03-25', '98765234', 'Pakistan', 'Kalma Chowk Lahore', 1, NULL, '2022-05-25 20:28:35', '2022-05-25 20:28:35'),
(5, NULL, 'Zubair', '03366903652', '33626-1537717-7', '1985-11-29', '365478', 'Pakistan', 'Harbanspura Chowk street 11 house no 12 Lahore', 1, NULL, '2022-05-25 20:29:47', '2022-05-25 20:29:47'),
(6, 1, 'Harris Shabbir', '03228436062', '3520283420697', '2022-05-27', '32165465987', 'Pakistani', 'Model Town Lahore', 1, 1, '2022-05-27 01:20:09', '2022-05-27 01:25:02');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `in_loads`
--

CREATE TABLE `in_loads` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `distributor_id` int(11) NOT NULL,
  `vendor_pool_id` int(11) NOT NULL,
  `shift_id` int(11) DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `way_bill` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `in_loads`
--

INSERT INTO `in_loads` (`id`, `distributor_id`, `vendor_pool_id`, `shift_id`, `type`, `way_bill`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 'asdasd', 'asdasd', 1, NULL, '2022-05-27 01:45:15', '2022-05-27 01:45:15');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(122, '2014_10_12_000000_create_users_table', 1),
(123, '2014_10_12_100000_create_password_resets_table', 1),
(124, '2019_08_19_000000_create_failed_jobs_table', 1),
(125, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(126, '2022_05_21_204121_create_drivers_table', 1),
(127, '2022_05_21_204724_create_vehicles_table', 1),
(128, '2022_05_21_204739_create_articles_table', 1),
(129, '2022_05_21_204754_create_shifts_table', 1),
(130, '2022_05_21_204807_create_distributors_table', 1),
(131, '2022_05_21_204842_create_vendor_pools_table', 1),
(132, '2022_05_21_204933_create_in_loads_table', 1),
(133, '2022_05_21_204954_create_out_loads_table', 1),
(134, '2022_05_21_205040_create_article_details_table', 1),
(135, '2022_05_21_205103_create_vehicle_details_table', 1),
(136, '2022_05_22_044323_create_permission_tables', 1),
(137, '2022_05_26_044101_create_categories_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1);

-- --------------------------------------------------------

--
-- Table structure for table `out_loads`
--

CREATE TABLE `out_loads` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `distributor_id` int(11) NOT NULL,
  `vendor_pool_id` int(11) NOT NULL,
  `shift_id` int(11) DEFAULT NULL,
  `dispatch_date` date DEFAULT NULL,
  `shipment_number` int(11) DEFAULT NULL,
  `bilti_number` int(11) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `out_loads`
--

INSERT INTO `out_loads` (`id`, `distributor_id`, `vendor_pool_id`, `shift_id`, `dispatch_date`, `shipment_number`, `bilti_number`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, '2022-05-27', 123123211, 12312, 1, NULL, '2022-05-27 01:49:40', '2022-05-27 01:49:40');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'role_view', 'web', '2022-05-27 01:08:06', '2022-05-27 01:08:06'),
(2, 'role_add', 'web', '2022-05-27 01:08:06', '2022-05-27 01:08:06'),
(3, 'role_edit', 'web', '2022-05-27 01:08:06', '2022-05-27 01:08:06'),
(4, 'role_delete', 'web', '2022-05-27 01:08:06', '2022-05-27 01:08:06'),
(5, 'role_has_permission', 'web', '2022-05-27 01:08:06', '2022-05-27 01:08:06'),
(6, 'permission_view', 'web', '2022-05-27 01:08:06', '2022-05-27 01:08:06'),
(7, 'permission_add', 'web', '2022-05-27 01:08:06', '2022-05-27 01:08:06'),
(8, 'permission_edit', 'web', '2022-05-27 01:08:06', '2022-05-27 01:08:06'),
(9, 'permission_delete', 'web', '2022-05-27 01:08:06', '2022-05-27 01:08:06'),
(10, 'user_view', 'web', '2022-05-27 01:08:06', '2022-05-27 01:08:06'),
(11, 'user_add', 'web', '2022-05-27 01:08:06', '2022-05-27 01:08:06'),
(12, 'user_edit', 'web', '2022-05-27 01:08:06', '2022-05-27 01:08:06'),
(13, 'user_delete', 'web', '2022-05-27 01:08:06', '2022-05-27 01:08:06'),
(14, 'user_has_permission', 'web', '2022-05-27 01:08:06', '2022-05-27 01:08:06'),
(15, 'driver_view', 'web', '2022-05-27 01:08:06', '2022-05-27 01:08:06'),
(16, 'driver_add', 'web', '2022-05-27 01:08:06', '2022-05-27 01:08:06'),
(17, 'driver_edit', 'web', '2022-05-27 01:08:06', '2022-05-27 01:08:06'),
(18, 'driver_delete', 'web', '2022-05-27 01:08:06', '2022-05-27 01:08:06'),
(19, 'distributor_view', 'web', '2022-05-27 01:08:06', '2022-05-27 01:08:06'),
(20, 'distributor_add', 'web', '2022-05-27 01:08:06', '2022-05-27 01:08:06'),
(21, 'distributor_edit', 'web', '2022-05-27 01:08:06', '2022-05-27 01:08:06'),
(22, 'distributor_delete', 'web', '2022-05-27 01:08:06', '2022-05-27 01:08:06'),
(23, 'article_view', 'web', '2022-05-27 01:08:06', '2022-05-27 01:08:06'),
(24, 'article_add', 'web', '2022-05-27 01:08:06', '2022-05-27 01:08:06'),
(25, 'article_edit', 'web', '2022-05-27 01:08:06', '2022-05-27 01:08:06'),
(26, 'article_delete', 'web', '2022-05-27 01:08:06', '2022-05-27 01:08:06'),
(27, 'shift_view', 'web', '2022-05-27 01:08:06', '2022-05-27 01:08:06'),
(28, 'shift_add', 'web', '2022-05-27 01:08:06', '2022-05-27 01:08:06'),
(29, 'shift_edit', 'web', '2022-05-27 01:08:06', '2022-05-27 01:08:06'),
(30, 'shift_delete', 'web', '2022-05-27 01:08:06', '2022-05-27 01:08:06'),
(31, 'vehicle_view', 'web', '2022-05-27 01:08:06', '2022-05-27 01:08:06'),
(32, 'vehicle_add', 'web', '2022-05-27 01:08:06', '2022-05-27 01:08:06'),
(33, 'vehicle_edit', 'web', '2022-05-27 01:08:06', '2022-05-27 01:08:06'),
(34, 'vehicle_delete', 'web', '2022-05-27 01:08:06', '2022-05-27 01:08:06'),
(35, 'vendor_pool_view', 'web', '2022-05-27 01:08:06', '2022-05-27 01:08:06'),
(36, 'vendor_pool_add', 'web', '2022-05-27 01:08:06', '2022-05-27 01:08:06'),
(37, 'vendor_pool_edit', 'web', '2022-05-27 01:08:06', '2022-05-27 01:08:06'),
(38, 'vendor_pool_delete', 'web', '2022-05-27 01:08:06', '2022-05-27 01:08:06'),
(39, 'inload_view', 'web', '2022-05-27 01:08:06', '2022-05-27 01:08:06'),
(40, 'inload_add', 'web', '2022-05-27 01:08:06', '2022-05-27 01:08:06'),
(41, 'inload_edit', 'web', '2022-05-27 01:08:06', '2022-05-27 01:08:06'),
(42, 'inload_delete', 'web', '2022-05-27 01:08:06', '2022-05-27 01:08:06'),
(43, 'outload_view', 'web', '2022-05-27 01:08:06', '2022-05-27 01:08:06'),
(44, 'outload_add', 'web', '2022-05-27 01:08:07', '2022-05-27 01:08:07'),
(45, 'outload_edit', 'web', '2022-05-27 01:08:07', '2022-05-27 01:08:07'),
(46, 'outload_delete', 'web', '2022-05-27 01:08:07', '2022-05-27 01:08:07'),
(47, 'category_view', 'web', '2022-05-27 01:08:07', '2022-05-27 01:08:07'),
(48, 'category_add', 'web', '2022-05-27 01:08:07', '2022-05-27 01:08:07'),
(49, 'category_edit', 'web', '2022-05-27 01:08:07', '2022-05-27 01:08:07'),
(50, 'category_delete', 'web', '2022-05-27 01:08:07', '2022-05-27 01:08:07');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'SuperAdmin', 'web', '2022-05-27 01:08:07', '2022-05-27 01:08:07');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(26, 1),
(27, 1),
(28, 1),
(29, 1),
(30, 1),
(31, 1),
(32, 1),
(33, 1),
(34, 1),
(35, 1),
(36, 1),
(37, 1),
(38, 1),
(39, 1),
(40, 1),
(41, 1),
(42, 1),
(43, 1),
(44, 1),
(45, 1),
(46, 1),
(47, 1),
(48, 1),
(49, 1),
(50, 1);

-- --------------------------------------------------------

--
-- Table structure for table `shifts`
--

CREATE TABLE `shifts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `time_from` time NOT NULL,
  `time_to` time NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shifts`
--

INSERT INTO `shifts` (`id`, `title`, `time_from`, `time_to`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Morning - 1st', '06:00:00', '14:00:00', 'Active', 1, NULL, '2022-05-25 20:43:24', '2022-05-25 20:43:24'),
(3, 'Evening - 2nd', '14:00:00', '22:00:00', 'Active', 1, NULL, '2022-05-25 20:58:59', '2022-05-25 20:58:59'),
(4, 'Night - 3rd', '22:00:00', '06:00:00', 'Active', 1, NULL, '2022-05-25 20:59:37', '2022-05-25 20:59:37');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cnic` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `cnic`, `created_by`, `updated_by`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'SuperAdmin', 'superadmin@admin.com', '$2y$10$4O3kJN92u9xlu1jHh63.5udA1czYU9PbUkocHVbhm0f4gPWUQ7qeS', NULL, 1, NULL, NULL, '2022-05-27 01:08:08', '2022-05-27 01:08:08'),
(2, 'Harris Shabbir', 'haristaurus59@gmail.com', '$2y$10$f.ahGswkjJTF1mesIVx5ZOzpyWNX1zUgMhMFxu7xy1uGzqd9qDQdy', '65465479843213', 1, NULL, NULL, '2022-05-27 01:27:52', '2022-05-27 01:27:52');

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

CREATE TABLE `vehicles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `registration_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `maker_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `registration_year` int(11) NOT NULL,
  `vendor_pool_id` int(11) NOT NULL,
  `driver_id` int(11) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vehicles`
--

INSERT INTO `vehicles` (`id`, `registration_number`, `model_number`, `maker_name`, `registration_year`, `vendor_pool_id`, `driver_id`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'SX#2365', 'Heavy Duty Truck HD170~1000', 'Hondai', 2020, 1, 1, 1, 1, '2022-05-25 21:06:17', '2022-05-25 21:12:11'),
(2, 'AB#2398', 'Hino Profia FR1AWHG', 'Hino', 2022, 2, 2, 1, 1, '2022-05-25 21:08:13', '2022-05-25 21:17:18'),
(3, 'SD#3355', 'Volvo FH', 'Volvo Trucks', 2022, 1, 3, 1, NULL, '2022-05-25 21:19:43', '2022-05-25 21:19:43'),
(4, 'QD#6352', 'G210-16/14.2-0.83', 'Mercedes  Benz Trucks', 2022, 2, 4, 1, NULL, '2022-05-25 21:22:51', '2022-05-25 21:22:51'),
(5, 'TR#2211', 'CA1313P2K2L7T4EA80', 'FAW', 2020, 1, 5, 1, NULL, '2022-05-25 21:24:55', '2022-05-25 21:24:55');

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_details`
--

CREATE TABLE `vehicle_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `detailable_id` int(11) NOT NULL,
  `detailable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vehicle_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vehicle_details`
--

INSERT INTO `vehicle_details` (`id`, `detailable_id`, `detailable_type`, `vehicle_id`, `created_at`, `updated_at`) VALUES
(1, 1, 'App\\Models\\InLoad', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vendor_pools`
--

CREATE TABLE `vendor_pools` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vendor_pools`
--

INSERT INTO `vendor_pools` (`id`, `name`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'IAGTC', 'Active', 1, NULL, '2022-05-27 01:32:02', '2022-05-27 01:32:02'),
(2, 'ACS', 'Active', 1, NULL, '2022-05-27 01:32:42', '2022-05-27 01:32:42');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `article_details`
--
ALTER TABLE `article_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `distributors`
--
ALTER TABLE `distributors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `drivers`
--
ALTER TABLE `drivers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `in_loads`
--
ALTER TABLE `in_loads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `out_loads`
--
ALTER TABLE `out_loads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `shifts`
--
ALTER TABLE `shifts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vehicle_details`
--
ALTER TABLE `vehicle_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vendor_pools`
--
ALTER TABLE `vendor_pools`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `article_details`
--
ALTER TABLE `article_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `distributors`
--
ALTER TABLE `distributors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `drivers`
--
ALTER TABLE `drivers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `in_loads`
--
ALTER TABLE `in_loads`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=138;

--
-- AUTO_INCREMENT for table `out_loads`
--
ALTER TABLE `out_loads`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `shifts`
--
ALTER TABLE `shifts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `vehicle_details`
--
ALTER TABLE `vehicle_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `vendor_pools`
--
ALTER TABLE `vendor_pools`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
