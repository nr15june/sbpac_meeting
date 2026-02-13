-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 13, 2026 at 05:48 AM
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
-- Database: `sbpac_meetingroom68_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'admin',
  `department_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`, `role`, `department_id`, `created_at`, `updated_at`) VALUES
(1, 'adminit', '$2y$12$l3jI3pnnDo9POgw9JrvHpOE6/fJSkCTpDXbL1sJ6T.snJXj1QrICS', 'admin', 1, '2026-02-11 02:13:38', '2026-02-11 02:13:38');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `booking_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `department` varchar(255) NOT NULL,
  `meeting_topic` varchar(255) NOT NULL,
  `start_time` datetime NOT NULL,
  `end_time` datetime NOT NULL,
  `room_id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`booking_id`, `name`, `lastname`, `phone`, `email`, `department`, `meeting_topic`, `start_time`, `end_time`, `room_id`, `employee_id`, `created_at`, `updated_at`) VALUES
(1, 'yuttasat', 'sbpac', '073203740', NULL, 'กลุ่มงานบริหารยุทธศาสตร์การพัฒนาจังหวัดชายแดนภาคใต้', 'หัวข้อการประชุม', '2026-02-16 10:30:00', '2026-02-16 11:00:00', 1, NULL, '2026-02-12 18:46:55', '2026-02-12 18:46:55');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `code`, `name`, `created_at`, `updated_at`) VALUES
(1, 'SBPAC-1', 'กลุ่มงานบริหารยุทธศาสตร์การพัฒนาจังหวัดชายแดนภาคใต้', '2026-02-11 19:14:58', '2026-02-11 19:14:58'),
(2, 'SBPAC-2', 'กลุ่มงานบริหารงบประมาณ', '2026-02-11 19:14:58', '2026-02-11 19:14:58'),
(3, 'SBPAC-3', 'กลุ่มงานอํานวยการและบริหาร', '2026-02-11 19:14:58', '2026-02-11 19:14:58'),
(4, 'SBPAC-4', 'กลุ่มงานบริหารยุทธศาสตร์การสื่อสารสร้างความเข้าใจที่ดี', '2026-02-11 19:14:58', '2026-02-11 19:14:58');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `card_id` varchar(13) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `department_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `card_id`, `username`, `email`, `password`, `first_name`, `last_name`, `phone`, `department_id`, `created_at`, `updated_at`) VALUES
(3, '1987456321523', '1987456321523', NULL, '$2y$12$D3iFGSd2egvq9rHU2V3wmOqO8KDOPt8hU5ydpW7.Cq14m/KSB3OJG', 'นูรี', 'เจะลง', '073203740', 1, '2026-02-12 21:42:47', '2026-02-12 21:45:25'),
(4, '1987456321545', '1987456321545', NULL, '$2y$12$.BqGrTK2rHRnaBqMUmhGROCyrO5sQ/aF57uz5OFavcf3CGkm/N/p.', 'ฮานัน', 'สาเระ', '073274112', 2, '2026-02-12 21:46:16', '2026-02-12 21:46:16');

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
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
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
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_12_02_072429_create_bookings_table', 1),
(5, '2025_12_02_080935_create_admins_table', 1),
(6, '2025_12_04_041157_create_rooms_table', 1),
(7, '2025_12_09_021618_remove_status_from_bookings_table', 1),
(8, '2025_12_16_024904_add_department_id_to_admins_table', 1),
(9, '2025_12_16_041246_create_employees_table', 1),
(10, '2025_12_16_070003_create_departments_table', 1),
(11, '2025_12_16_081337_add_email_password_to_employees_table', 1),
(12, '2025_12_18_041840_update_bookings_add_user_id_and_nullable_email', 1),
(13, '2025_12_18_044904_drop_user_id_from_bookings_table', 1),
(14, '2025_12_18_045234_add_employee_id_to_bookings_table', 1),
(15, '2026_02_11_090404_add_username_to_admins_table', 1),
(16, '2026_02_12_042105_make_email_nullable_on_employees', 2),
(17, '2026_02_12_043634_add_username_to_employees_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `room_id` bigint(20) UNSIGNED NOT NULL,
  `room_name` varchar(255) NOT NULL,
  `building` varchar(255) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `room_image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`room_id`, `room_name`, `building`, `quantity`, `description`, `room_image`, `created_at`, `updated_at`) VALUES
(1, 'ห้องประชุม', 'กบย', 5, NULL, 'rooms/k3zBqAJueE496lgfdCazxNa0LCcW7Efqb7doIkbh.jpg', '2026-02-11 21:38:28', '2026-02-11 21:38:28');

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
('jzulSLLj1TdjW9OWTXTNJROzocN4W7OgIWxk3GSi', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36 Edg/128.0.0.0', 'YToxNDp7czo2OiJfdG9rZW4iO3M6NDA6InF2N0RDYnd2N05uQ2ZhOU9pd2ZDSFg3azQ3eDM2WEREMnA5UnEwUVoiO3M6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjM4OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvY3JlYXRlX2Jvb2tpbmcvMSI7czo1OiJyb3V0ZSI7czoxNDoiY3JlYXRlX2Jvb2tpbmciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjE1OiJhZG1pbl9sb2dnZWRfaW4iO2I6MTtzOjg6ImFkbWluX2lkIjtpOjE7czoxOToiYWRtaW5fZGVwYXJ0bWVudF9pZCI7aToxO3M6MTQ6InVzZXJfbG9nZ2VkX2luIjtiOjE7czoxMToiZW1wbG95ZWVfaWQiO2k6MTtzOjk6InVzZXJfbmFtZSI7czoxMDoibmFtd2FuIHdhbiI7czoxMDoiZmlyc3RfbmFtZSI7czo2OiJuYW13YW4iO3M6OToibGFzdF9uYW1lIjtzOjM6IndhbiI7czo1OiJwaG9uZSI7czoxMDoiMDY1OTg2NDU4OSI7czoxMzoiZGVwYXJ0bWVudF9pZCI7aTozO3M6MTU6ImRlcGFydG1lbnRfbmFtZSI7czo3ODoi4LiB4Lil4Li44LmI4Lih4LiH4Liy4LiZ4Lit4LmN4Liy4LiZ4Lin4Lii4LiB4Liy4Lij4LmB4Lil4Liw4Lia4Lij4Li04Lir4Liy4LijIjt9', 1770871158),
('lBBFFQbItnyhHKNAYHK9sAevWnfaJhgCVrw9hROa', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36 Edg/128.0.0.0', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiVDRlazB3cVp4eWRVTTkweDk4VmFWZzJLa1BSYzFWQUpDOWRNMTBHSCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9oaXN0b3J5X2Jvb2tpbmciO3M6NToicm91dGUiO3M6MjE6ImFkbWluX2hpc3RvcnlfYm9va2luZyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6MTU6ImFkbWluX2xvZ2dlZF9pbiI7YjoxO3M6ODoiYWRtaW5faWQiO2k6MTtzOjE5OiJhZG1pbl9kZXBhcnRtZW50X2lkIjtpOjE7fQ==', 1770947254),
('o5quuaYM9Fxp4EJFChLnMpZ3LYKVqElyT3lpF2eQ', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36 Edg/128.0.0.0', 'YToxMTp7czo2OiJfdG9rZW4iO3M6NDA6IklENVJTaVRkMm8ydk43ZlNoV2I0RFJuOEJZdTNCano2cFFLeVhNZjEiO3M6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjQyOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvdXNlci9oaXN0b3J5X2Jvb2tpbmciO3M6NToicm91dGUiO3M6MjA6InVzZXJfaGlzdG9yeV9ib29raW5nIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czoxNDoidXNlcl9sb2dnZWRfaW4iO2I6MTtzOjExOiJlbXBsb3llZV9pZCI7aToyO3M6OToidXNlcl9uYW1lIjtzOjE0OiJ5dXR0YXNhdCBzYnBhYyI7czoxMDoiZmlyc3RfbmFtZSI7czo4OiJ5dXR0YXNhdCI7czo5OiJsYXN0X25hbWUiO3M6NToic2JwYWMiO3M6NToicGhvbmUiO3M6OToiMDczMjAzNzQwIjtzOjEzOiJkZXBhcnRtZW50X2lkIjtpOjE7czoxNToiZGVwYXJ0bWVudF9uYW1lIjtzOjE1Mzoi4LiB4Lil4Li44LmI4Lih4LiH4Liy4LiZ4Lia4Lij4Li04Lir4Liy4Lij4Lii4Li44LiX4LiY4Lio4Liy4Liq4LiV4Lij4LmM4LiB4Liy4Lij4Lie4Lix4LiS4LiZ4Liy4LiI4Lix4LiH4Lir4Lin4Lix4LiU4LiK4Liy4Lii4LmB4LiU4LiZ4Lig4Liy4LiE4LmD4LiV4LmJIjt9', 1770947215),
('W7871RjVkHQldBZfIm210dwx9TrnPkgzePFHhjnM', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36 Edg/128.0.0.0', 'YToxMTp7czo2OiJfdG9rZW4iO3M6NDA6IkpVSEQ3ODhINU41eVJQd0JZbjFMWUhXSWYxUnhFbmlLUjdlU0FEWDQiO3M6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjM1OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvdXNlci9jYWxlbmRhciI7czo1OiJyb3V0ZSI7czoxMzoidXNlcl9jYWxlbmRhciI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6MTQ6InVzZXJfbG9nZ2VkX2luIjtiOjE7czoxMToiZW1wbG95ZWVfaWQiO2k6NDtzOjk6InVzZXJfbmFtZSI7czozMToi4Liu4Liy4LiZ4Lix4LiZIOC4quC4suC5gOC4o+C4sCI7czoxMDoiZmlyc3RfbmFtZSI7czoxNToi4Liu4Liy4LiZ4Lix4LiZIjtzOjk6Imxhc3RfbmFtZSI7czoxNToi4Liq4Liy4LmA4Lij4LiwIjtzOjU6InBob25lIjtzOjk6IjA3MzI3NDExMiI7czoxMzoiZGVwYXJ0bWVudF9pZCI7aToyO3M6MTU6ImRlcGFydG1lbnRfbmFtZSI7czo2Njoi4LiB4Lil4Li44LmI4Lih4LiH4Liy4LiZ4Lia4Lij4Li04Lir4Liy4Lij4LiH4Lia4Lib4Lij4Liw4Lih4Liy4LiTIjt9', 1770957990);

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
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Test User', 'test@example.com', '2026-02-11 02:12:31', '$2y$12$.pi4HKssb2hefUx9YRWnSe.cIqF1cvzpiSrnH.zLcX9rr1XOU6TgC', 'kgVWDEjCHq', '2026-02-11 02:12:31', '2026-02-11 02:12:31');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_username_unique` (`username`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `bookings_employee_id_foreign` (`employee_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `departments_code_unique` (`code`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `employees_card_id_unique` (`card_id`),
  ADD UNIQUE KEY `employees_username_unique` (`username`),
  ADD UNIQUE KEY `employees_email_unique` (`email`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`room_id`);

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
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `booking_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `room_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
