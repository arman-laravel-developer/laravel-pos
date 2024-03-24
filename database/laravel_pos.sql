-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 24, 2024 at 05:24 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel_pos`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart_items`
--

CREATE TABLE `cart_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2014_10_12_200000_add_two_factor_columns_to_users_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2022_10_25_092552_create_sessions_table', 1),
(7, '2024_03_22_052937_create_products_table', 2),
(10, '2024_03_22_064214_create_cart_items_table', 3),
(11, '2024_03_24_033232_create_order_details_table', 4),
(12, '2024_03_22_053257_create_orders_table', 5);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `qty` int(11) DEFAULT NULL,
  `order_total` double(8,2) DEFAULT NULL,
  `payable_amount` double(8,2) DEFAULT NULL,
  `payment_type` varchar(255) NOT NULL,
  `order_code` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `customer_name`, `qty`, `order_total`, `payable_amount`, `payment_type`, `order_code`, `created_at`, `updated_at`) VALUES
(2, 'Walk-in Customer', 1, 246.96, 246.96, 'Cash', 'ORD20240324-0001', '2024-03-24 10:08:44', '2024-03-24 10:08:44'),
(3, 'Walk-in Customer', 6, 4102.76, 4102.76, 'Cash', 'ORD20240324-0002', '2024-03-23 10:18:19', '2024-03-24 10:18:20'),
(4, 'Walk-in Customer', 4, 2830.22, 2830.22, 'Cash', 'ORD20240324-0003', '2024-03-24 10:18:26', '2024-03-24 10:18:26'),
(5, 'Walk-in Customer', 6, 4042.92, 4042.92, 'Cash', 'ORD20240324-0004', '2024-03-22 10:18:31', '2024-03-24 10:18:31'),
(6, 'Walk-in Customer', 5, 1077.00, 1077.00, 'Cash', 'ORD20240324-0005', '2024-03-24 10:18:41', '2024-03-24 10:18:41'),
(7, 'Walk-in Customer', 4, 1360.64, 1360.64, 'Cash', 'ORD20240324-0006', '2024-03-20 10:18:50', '2024-03-24 10:18:51'),
(8, 'Walk-in Customer', 4, 3329.76, 3329.76, 'Cash', 'ORD20240324-0007', '2024-03-18 10:18:57', '2024-03-24 10:18:57'),
(9, 'Walk-in Customer', 8, 4766.79, 4766.79, 'Cash', 'ORD20240324-0008', '2024-03-24 10:20:22', '2024-03-24 10:20:22'),
(10, 'Walk-in Customer', 7, 3114.60, 3114.60, 'Cash', 'ORD20240324-0009', '2024-03-18 10:20:28', '2024-03-24 10:20:28'),
(11, 'Walk-in Customer', 5, 2629.84, 2629.84, 'Cash', 'ORD20240324-0010', '2024-03-24 10:20:36', '2024-03-24 10:20:36'),
(12, 'Walk-in Customer', 6, 4861.71, 4861.71, 'Cash', 'ORD20240324-0011', '2024-03-24 10:21:52', '2024-03-24 10:21:52');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `unit_price` decimal(10,2) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `tax_amount` decimal(10,2) NOT NULL,
  `discount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `product_id`, `quantity`, `unit_price`, `total_price`, `tax_amount`, `discount`, `created_at`, `updated_at`) VALUES
(2, 2, 6, 1, 235.20, 246.96, 11.76, 4.80, '2024-03-24 10:08:44', '2024-03-24 10:08:44'),
(3, 3, 12, 1, 436.50, 453.96, 17.46, 13.50, '2024-03-24 10:18:19', '2024-03-24 10:18:19'),
(4, 3, 13, 1, 650.00, 650.00, 0.00, 0.00, '2024-03-24 10:18:20', '2024-03-24 10:18:20'),
(5, 3, 14, 4, 816.00, 2998.80, 142.80, 136.00, '2024-03-24 10:18:20', '2024-03-24 10:18:20'),
(6, 4, 15, 1, 811.80, 852.39, 40.59, 8.20, '2024-03-24 10:18:26', '2024-03-24 10:18:26'),
(7, 4, 16, 1, 940.80, 940.80, 0.00, 39.20, '2024-03-24 10:18:26', '2024-03-24 10:18:26'),
(8, 4, 17, 1, 368.60, 387.03, 18.43, 11.40, '2024-03-24 10:18:26', '2024-03-24 10:18:26'),
(9, 4, 13, 1, 650.00, 650.00, 0.00, 0.00, '2024-03-24 10:18:26', '2024-03-24 10:18:26'),
(10, 5, 16, 4, 940.80, 3292.80, 0.00, 156.80, '2024-03-24 10:18:31', '2024-03-24 10:18:31'),
(11, 5, 17, 2, 368.60, 750.12, 35.72, 22.80, '2024-03-24 10:18:31', '2024-03-24 10:18:31'),
(12, 6, 19, 3, 199.00, 597.00, 0.00, 0.00, '2024-03-24 10:18:41', '2024-03-24 10:18:41'),
(13, 6, 18, 2, 245.00, 480.00, 0.00, 10.00, '2024-03-24 10:18:41', '2024-03-24 10:18:41'),
(14, 7, 13, 1, 650.00, 650.00, 0.00, 0.00, '2024-03-24 10:18:50', '2024-03-24 10:18:50'),
(15, 7, 6, 3, 235.20, 710.64, 33.84, 14.40, '2024-03-24 10:18:50', '2024-03-24 10:18:50'),
(16, 8, 14, 2, 816.00, 1642.20, 78.20, 68.00, '2024-03-24 10:18:57', '2024-03-24 10:18:57'),
(17, 8, 15, 2, 811.80, 1687.56, 80.36, 16.40, '2024-03-24 10:18:57', '2024-03-24 10:18:57'),
(18, 9, 14, 1, 816.00, 856.80, 40.80, 34.00, '2024-03-24 10:20:22', '2024-03-24 10:20:22'),
(19, 9, 15, 3, 811.80, 2505.51, 119.31, 24.60, '2024-03-24 10:20:22', '2024-03-24 10:20:22'),
(20, 9, 17, 4, 368.60, 1404.48, 66.88, 45.60, '2024-03-24 10:20:22', '2024-03-24 10:20:22'),
(21, 10, 6, 3, 235.20, 710.64, 33.84, 14.40, '2024-03-24 10:20:28', '2024-03-24 10:20:28'),
(22, 10, 13, 3, 650.00, 1950.00, 0.00, 0.00, '2024-03-24 10:20:28', '2024-03-24 10:20:28'),
(23, 10, 12, 1, 436.50, 453.96, 17.46, 13.50, '2024-03-24 10:20:28', '2024-03-24 10:20:28'),
(24, 11, 13, 1, 650.00, 650.00, 0.00, 0.00, '2024-03-24 10:20:36', '2024-03-24 10:20:36'),
(25, 11, 12, 2, 436.50, 879.84, 33.84, 27.00, '2024-03-24 10:20:36', '2024-03-24 10:20:36'),
(26, 11, 11, 2, 550.00, 1100.00, 0.00, 0.00, '2024-03-24 10:20:36', '2024-03-24 10:20:36'),
(27, 12, 15, 3, 811.80, 2505.51, 119.31, 24.60, '2024-03-24 10:21:52', '2024-03-24 10:21:52'),
(28, 12, 14, 3, 816.00, 2356.20, 112.20, 102.00, '2024-03-24 10:21:52', '2024-03-24 10:21:52');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `sku` varchar(255) NOT NULL,
  `unit` varchar(255) NOT NULL,
  `unit_value` double(8,2) NOT NULL,
  `selling_price` double(8,2) NOT NULL,
  `purchase_price` double(8,2) NOT NULL,
  `discount` double(8,2) NOT NULL DEFAULT 0.00,
  `tax` double(8,2) NOT NULL DEFAULT 0.00,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `sku`, `unit`, `unit_value`, `selling_price`, `purchase_price`, `discount`, `tax`, `image`, `created_at`, `updated_at`) VALUES
(6, 'Mini Rechargeable Travel Portable Fan', 'Fan', 'pieces', 1.00, 240.00, 230.00, 2.00, 5.00, 'product-images/mini-rechargeable-travel-portable-fan-.660050007d2a6.webp', '2024-03-22 09:14:12', '2024-03-24 10:08:32'),
(11, 'Tiktok Ring Light with Ring Light Stand 6.8 feet', '234', 'pieces', 1.00, 550.00, 540.00, 0.00, 0.00, 'product-images/tiktok-ring-light-with-ring-light-stand-68-feet-.65ff17bf198b5.webp', '2024-03-23 11:56:15', '2024-03-24 10:09:14'),
(12, 'Sound Box Mini KTS 1057 Wireless Bluetooth Speaker Bluetooth Speakers for home', '247', 'pieces', 1.00, 450.00, 440.00, 3.00, 4.00, 'product-images/sound-box-mini-kts-1057-wireless-bluetooth-speaker-bluetooth-speakers-for-home-.660050db506f1.webp', '2024-03-24 10:12:11', '2024-03-24 10:12:11'),
(13, 'Kemei KM-2516 Rechargeable Beard Trimmer For Man', '268', 'pieces', 1.00, 650.00, 630.00, 0.00, 0.00, 'product-images/kemei-km-2516-rechargeable-beard-trimmer-for-man-.660051179c738.webp', '2024-03-24 10:13:11', '2024-03-24 10:13:11'),
(14, 'Wireless Bluetooth Speaker KTS 1097 4\" Karaoke High Sound Quality Speaker', '762', 'pieces', 2.00, 850.00, 840.00, 4.00, 5.00, 'product-images/wireless-bluetooth-speaker-kts-1097-4-karaoke-high-sound-quality-speaker-.66005142be896.webp', '2024-03-24 10:13:54', '2024-03-24 10:13:54'),
(15, 'SENXIN Portable Smart Speaker with HD Sound and Bass & Mini Wireless Stereo Outdoor Speaker with Volume Booster', '821', 'pieces', 1.00, 820.00, 800.00, 1.00, 5.00, 'product-images/senxin-portable-smart-speaker-with-hd-sound-and-bass-mini-wireless-stereo-outdoor-speaker-with-volume-booster-.66005178ee856.webp', '2024-03-24 10:14:48', '2024-03-24 10:14:48'),
(16, 'Microlab X9 Mini BT 2.0 Bluetooth Speaker', '751', 'pieces', 1.00, 980.00, 960.00, 4.00, 0.00, 'product-images/microlab-x9-mini-bt-20-bluetooth-speaker-.66005199e8824.webp', '2024-03-24 10:15:21', '2024-03-24 10:15:21'),
(17, 'Tripod 3110/ 40.2 Inch Portable Camera and Mobile Stand', '317', 'pieces', 1.00, 380.00, 350.00, 3.00, 5.00, 'product-images/tripod-3110-402-inch-portable-camera-and-mobile-stand-.660051c0e57fd.webp', '2024-03-24 10:16:00', '2024-03-24 10:16:00'),
(18, 'WS-887 Mini Bluetooth Wireless Speaker', '602', 'pieces', 2.00, 250.00, 230.00, 2.00, 0.00, 'product-images/ws-887-mini-bluetooth-wireless-speaker-.660051ecf0fb5.webp', '2024-03-24 10:16:44', '2024-03-24 10:16:44'),
(19, 'Mango Shaped mini wireless Bluetooth in ear head phone', '860', 'pieces', 1.00, 199.00, 180.00, 0.00, 0.00, 'product-images/mango-shaped-mini-wireless-bluetooth-in-ear-head-phone-.6600521a4c7f4.webp', '2024-03-24 10:17:30', '2024-03-24 10:17:30');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('Csc0zKMOPPOY4eSqBp2RCZmJ2C9TShinpKEd9nEx', 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiQVRVZlhlNkMxNXVHdldDY3RLNDJaUTA5Mkl6Z216cktnTTNlb1kwcSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTE6Imh0dHA6Ly9sb2NhbGhvc3QvbGFyYXZlbC1wb3MvcHVibGljL3Byb2R1Y3RzL21hbmFnZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7czoyMToicGFzc3dvcmRfaGFzaF9zYW5jdHVtIjtzOjYwOiIkMnkkMTAkTGNFeEZ3RGZPWndDY3dlY0FYTlk3ZThkNDE0SHFDNC9VelpqL2xybEY3ckxBajV5d2FhNXkiO3M6NToiYWxlcnQiO2E6MDp7fX0=', 1711216810),
('newsuXz8ocKfxs4IKCtKU79dedkdUbHkRPYQS4Pk', 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36', 'YTo3OntzOjY6Il90b2tlbiI7czo0MDoidnRSMTl1MXhDdnRNNFpNSjlsS202M09RV2NERE00dzhKOVp5ZEVOaiI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjQyOiJodHRwOi8vbG9jYWxob3N0L2xhcmF2ZWwtcG9zL3B1YmxpYy9vcmRlcnMiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO3M6MjE6InBhc3N3b3JkX2hhc2hfc2FuY3R1bSI7czo2MDoiJDJ5JDEwJExjRXhGd0RmT1p3Q2N3ZWNBWE5ZN2U4ZDQxNEhxQzQvVXpaai9scmxGN3JMQWo1eXdhYTV5IjtzOjU6ImFsZXJ0IjthOjA6e319', 1711297385);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `two_factor_secret` text DEFAULT NULL,
  `two_factor_recovery_codes` text DEFAULT NULL,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `current_team_id` bigint(20) UNSIGNED DEFAULT NULL,
  `profile_photo_path` varchar(2048) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `current_team_id`, `profile_photo_path`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'admin@gmail.com', '2024-03-21 23:24:30', '$2y$10$LcExFwDfOZwCcwecAXNY7e8d414HqC4/UzZj/lrlF7rLAj5ywaa5y', NULL, NULL, NULL, '79XMHzlkWVNzSeR4Hyda0CNf9dURh6y6BPYqaD0VwFrXTQFsWx54yTGV0GSx', NULL, NULL, '2024-03-21 23:24:30', '2024-03-21 23:24:30');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cart_items_product_id_foreign` (`product_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_details_order_id_foreign` (`order_id`),
  ADD KEY `order_details_product_id_foreign` (`product_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_sku_unique` (`sku`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD CONSTRAINT `cart_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_details_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
