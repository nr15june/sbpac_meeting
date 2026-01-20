-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 20, 2026 at 09:51 AM
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
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'admin',
  `department_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `email`, `password`, `role`, `department_id`, `created_at`, `updated_at`) VALUES
(1, 'admin1@sbpac.go.th', '$2y$12$tx7c6UYE9AlajJrKZo3pleDXwVnQOmLwJcWYK0RcpZMjWoRs80iwS', 'admin', 1, '2025-12-18 19:43:30', '2025-12-18 19:43:30'),
(2, 'admin2@sbpac.go.th', '$2y$12$/DYjOF8qEI5/ZRhrqZwJRelA.PsrphWhAgAfntY75mDzHDV13Vg0e', 'admin', 2, '2025-12-18 19:43:30', '2025-12-18 19:43:30'),
(3, 'admin3@sbpac.go.th', '$2y$12$tPBjDgxEv4OjcQAazmAsLuS4J4fF9hIQG2fW2zv5wRb5KxVoSiBZ6', 'admin', 3, '2025-12-18 19:43:30', '2025-12-18 19:43:30'),
(4, 'admin4@sbpac.go.th', '$2y$12$8brDUvIxFdeia8laKettou2OPsxvalo.A5c.c7ns7igThGZnyLKVG', 'admin', 4, '2025-12-18 19:43:30', '2025-12-18 19:43:30');

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
(1, 'รอซาลินา', 'สาและ', '0812345674', NULL, 'กลุ่มงานบริหารงบประมาณ', 'หัวข้อการประชุม', '2025-12-19 10:00:00', '2025-12-19 11:00:00', 1, 4, '2025-12-18 20:27:07', '2025-12-18 20:27:07'),
(2, 'มูฮำหมัดอามีน', 'บาโงย', '0812345673', NULL, 'กลุ่มงานบริหารงบประมาณ', 'หัวข้อการประชุม', '2025-12-19 07:40:00', '2025-12-19 07:50:00', 1, 3, '2025-12-18 20:28:28', '2025-12-18 21:38:37'),
(3, 'รอซาลินา', 'สาและ', '0812345674', NULL, 'กลุ่มงานบริหารงบประมาณ', 'หัวข้อการประชุม', '2025-12-19 09:00:00', '2025-12-19 09:50:00', 1, 4, '2025-12-18 21:15:42', '2025-12-18 21:15:42'),
(4, 'มูฮำหมัดอามีน', 'บาโงย', '0812345673', NULL, 'กลุ่มงานบริหารงบประมาณ', 'หัวข้อการประชุม', '2025-12-19 08:00:00', '2025-12-19 08:50:00', 1, 3, '2025-12-18 21:26:21', '2025-12-18 21:26:21'),
(5, 'มูฮำหมัดอามีน', 'บาโงย', '0812345673', NULL, 'กลุ่มงานบริหารงบประมาณ', 'หัวข้อการประชุม', '2025-12-19 05:00:00', '2025-12-19 05:50:00', 1, 3, '2025-12-18 21:35:05', '2025-12-18 21:43:17'),
(6, 'รอซาลินา', 'สาและ', '0812345674', NULL, 'กลุ่มงานบริหารงบประมาณ', 'หัวข้อการประชุม', '2025-12-22 14:20:00', '2025-12-22 15:20:00', 1, 4, '2025-12-19 00:21:01', '2025-12-19 00:21:01'),
(7, 'ฟารีดา', 'เจ๊ะมะ', '0812345672', NULL, 'กลุ่มงานบริหารยุทธศาสตร์การพัฒนาจังหวัดชายแดนภาคใต้', 'ไม่มี', '2025-12-25 10:00:00', '2025-12-25 11:40:00', 1, 2, '2025-12-21 19:38:56', '2025-12-21 19:38:56'),
(8, 'ฟารีดา', 'เจ๊ะมะ', '0812345672', NULL, 'กลุ่มงานบริหารยุทธศาสตร์การพัฒนาจังหวัดชายแดนภาคใต้', 'ไม่มี', '2025-12-29 11:30:00', '2025-12-29 12:30:00', 1, 2, '2025-12-28 20:30:44', '2025-12-28 20:30:44'),
(9, 'ฟารีดา', 'เจ๊ะมะ', '0812345672', NULL, 'กลุ่มงานบริหารยุทธศาสตร์การพัฒนาจังหวัดชายแดนภาคใต้', '-', '2025-12-30 16:05:00', '2025-12-30 17:05:00', 1, 2, '2025-12-29 22:05:57', '2025-12-29 22:29:39'),
(10, 'ฟารีดา', 'เจ๊ะมะ', '0812345672', NULL, 'กลุ่มงานบริหารยุทธศาสตร์การพัฒนาจังหวัดชายแดนภาคใต้', '-', '2026-01-02 10:00:00', '2026-01-02 11:00:00', 1, 2, '2025-12-29 23:23:51', '2025-12-29 23:23:51');

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
(1, 'STR', 'กลุ่มงานบริหารยุทธศาสตร์การพัฒนาจังหวัดชายแดนภาคใต้', '2025-12-18 19:44:50', '2025-12-18 19:44:50'),
(2, 'BUD', 'กลุ่มงานบริหารงบประมาณ', '2025-12-18 19:44:50', '2025-12-18 19:44:50'),
(3, 'ADM', 'กลุ่มงานอำนวยการและบริหาร', '2025-12-18 19:44:50', '2025-12-18 19:44:50'),
(4, 'COM', 'กลุ่มงานบริหารยุทธศาสตร์การสื่อสารสร้างความเข้าใจที่ดี', '2025-12-18 19:44:50', '2025-12-18 19:44:50');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `card_id` varchar(13) NOT NULL,
  `email` varchar(255) NOT NULL,
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

INSERT INTO `employees` (`id`, `card_id`, `email`, `password`, `first_name`, `last_name`, `phone`, `department_id`, `created_at`, `updated_at`) VALUES
(2, '1101700234562', 'fareeda.j@sbpac.go.th', '$2y$12$iQx3XJgJ2P/TypHtZ0SNc.Y/LIosLvdjk3NyBtopTXNZ8fUP9bh/i', 'ฟารีดา', 'เจ๊ะมะ', '0812345672', 1, '2025-12-18 19:49:57', '2025-12-18 19:49:57'),
(3, '1101700234563', 'muhammad.a@sbpac.go.th', '$2y$12$VPy80IH17TyTVRAY.8s.Ne8ewMQZbRdbqJ2TMaDyTyoqf4/xV7z8y', 'มูฮำหมัดอามีน', 'บาโงย', '0812345673', 2, '2025-12-18 20:24:22', '2025-12-18 20:24:22'),
(4, '1101700234564', 'rosalina.s@sbpac.go.th', '$2y$12$UEAfPTPoSxMNpnwK/cMNleg0ETeRWEQAA2CwIJyy.DMTiQi8chrWW', 'รอซาลินา', 'สาและ', '0812345674', 2, '2025-12-18 20:25:27', '2025-12-18 20:25:27'),
(5, '1234567898521', 'jnpnc@sbpac.go.th', '$2y$12$3s5cZCugSBNC7Kg5mmZrh.T0I4vU.Gz/L95wCHO4S7Ax4qppGGGp.', 'จูเนียร์', 'ปณชัย', '0987654321', 4, '2025-12-22 19:57:51', '2025-12-22 19:57:51'),
(6, '1234567890123', 'hanan@sbpac.go.th', '$2y$12$QBUnHYBJwZgGWjAZTOOhFObcz3gYeHMJnMoAjZKuTr2jImswPJLim', 'ฮานัน', 'สาเระ', '0987456321', 1, '2025-12-28 21:00:02', '2025-12-28 21:00:02'),
(7, '1987874563123', 'nuree@sbpac.go.th', '$2y$12$lx7gDdGhGDvutN4UnjLq1u62FNBg0qS1zdY9BcnPdDENlV8xD3i1y', 'นูรี', 'เจะลง', '0987454574', 1, '2025-12-28 23:38:30', '2025-12-28 23:38:30');

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
(15, '2025_12_23_025101_rename_citizen_id_to_card_id_in_employees_table', 2);

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
(1, 'ห้องประชุม 1', 'กบย', 5, 'ไม่มี', 'rooms/zuhXvsLu4RyKwjnummxcRH2uomePvoFgAFCi5w9e.jpg', '2025-12-18 20:26:15', '2025-12-18 20:26:15');

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
('0sk1aoemxNWpuEA7sYs5ws2Foaaa4BE6UBdZKOWs', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36 Edg/128.0.0.0', 'YToxMTp7czo2OiJfdG9rZW4iO3M6NDA6IjVFTUpZUlpvZkd6OHg2YTQ1SHRGdTZXOEoxUzc2aHR5QlA3S0RycmIiO3M6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjM4OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvY3JlYXRlX2Jvb2tpbmcvMSI7czo1OiJyb3V0ZSI7czoxNDoiY3JlYXRlX2Jvb2tpbmciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjE0OiJ1c2VyX2xvZ2dlZF9pbiI7YjoxO3M6MTE6ImVtcGxveWVlX2lkIjtpOjI7czo5OiJ1c2VyX25hbWUiO3M6Mzc6IuC4n+C4suC4o+C4teC4lOC4siDguYDguIjguYrguLDguKHguLAiO3M6MTA6ImZpcnN0X25hbWUiO3M6MTg6IuC4n+C4suC4o+C4teC4lOC4siI7czo5OiJsYXN0X25hbWUiO3M6MTg6IuC5gOC4iOC5iuC4sOC4oeC4sCI7czo1OiJwaG9uZSI7czoxMDoiMDgxMjM0NTY3MiI7czoxMzoiZGVwYXJ0bWVudF9pZCI7aToxO3M6MTU6ImRlcGFydG1lbnRfbmFtZSI7czoxNTM6IuC4geC4peC4uOC5iOC4oeC4h+C4suC4meC4muC4o+C4tOC4q+C4suC4o+C4ouC4uOC4l+C4mOC4qOC4suC4quC4leC4o+C5jOC4geC4suC4o+C4nuC4seC4kuC4meC4suC4iOC4seC4h+C4q+C4p+C4seC4lOC4iuC4suC4ouC5geC4lOC4meC4oOC4suC4hOC5g+C4leC5iSI7fQ==', 1768269136),
('875eSKuxJ7OCnwteUsuLPSaiVhPDSbVcLkjflXOA', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36 Edg/128.0.0.0', 'YToxNDp7czo2OiJfdG9rZW4iO3M6NDA6IlF1dGpqdzA2cGdWcFJBWE9VZXRZVHl4Z3dTc0N6c2FlaW1zU0VOM3oiO3M6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjQyOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvdXNlci9oaXN0b3J5X2Jvb2tpbmciO3M6NToicm91dGUiO3M6MjA6InVzZXJfaGlzdG9yeV9ib29raW5nIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czoxNToiYWRtaW5fbG9nZ2VkX2luIjtiOjE7czo4OiJhZG1pbl9pZCI7aToxO3M6MTk6ImFkbWluX2RlcGFydG1lbnRfaWQiO2k6MTtzOjE0OiJ1c2VyX2xvZ2dlZF9pbiI7YjoxO3M6MTE6ImVtcGxveWVlX2lkIjtpOjI7czo5OiJ1c2VyX25hbWUiO3M6Mzc6IuC4n+C4suC4o+C4teC4lOC4siDguYDguIjguYrguLDguKHguLAiO3M6MTA6ImZpcnN0X25hbWUiO3M6MTg6IuC4n+C4suC4o+C4teC4lOC4siI7czo5OiJsYXN0X25hbWUiO3M6MTg6IuC5gOC4iOC5iuC4sOC4oeC4sCI7czo1OiJwaG9uZSI7czoxMDoiMDgxMjM0NTY3MiI7czoxMzoiZGVwYXJ0bWVudF9pZCI7aToxO3M6MTU6ImRlcGFydG1lbnRfbmFtZSI7czoxNTM6IuC4geC4peC4uOC5iOC4oeC4h+C4suC4meC4muC4o+C4tOC4q+C4suC4o+C4ouC4uOC4l+C4mOC4qOC4suC4quC4leC4o+C5jOC4geC4suC4o+C4nuC4seC4kuC4meC4suC4iOC4seC4h+C4q+C4p+C4seC4lOC4iuC4suC4ouC5geC4lOC4meC4oOC4suC4hOC5g+C4leC5iSI7fQ==', 1767075839),
('9B336LNYwC4p2raCpn4M43Z2eTsg5RjtpZWMysSG', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36 Edg/128.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiN0RZaWY2QTNDSkVVNlpXTlVaclQ5ZWpLVEc2M0tsVHR2MG1OazdIRyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NTA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC91c2VyL2NhbGVuZGFyL2RheS8yMDI2LTAxLTA1IjtzOjU6InJvdXRlIjtzOjE3OiJ1c2VyX2NhbGVuZGFyX2RheSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1767665207),
('9VUqafw5Waj9EEiW9a2zviL6Hv8eO07GvHrwgXpL', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36 Edg/128.0.0.0', 'YToxNDp7czo2OiJfdG9rZW4iO3M6NDA6Ikd1VlZwNnpjTGdTOGMxc3phUzVtWFJxRFVoRDVCSERpWlRPeGdUQ2QiO3M6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjM1OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvdXNlci9jYWxlbmRhciI7czo1OiJyb3V0ZSI7czoxMzoidXNlcl9jYWxlbmRhciI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6MTU6ImFkbWluX2xvZ2dlZF9pbiI7YjoxO3M6ODoiYWRtaW5faWQiO2k6MTtzOjE5OiJhZG1pbl9kZXBhcnRtZW50X2lkIjtpOjE7czoxNDoidXNlcl9sb2dnZWRfaW4iO2I6MTtzOjExOiJlbXBsb3llZV9pZCI7aToyO3M6OToidXNlcl9uYW1lIjtzOjM3OiLguJ/guLLguKPguLXguJTguLIg4LmA4LiI4LmK4Liw4Lih4LiwIjtzOjEwOiJmaXJzdF9uYW1lIjtzOjE4OiLguJ/guLLguKPguLXguJTguLIiO3M6OToibGFzdF9uYW1lIjtzOjE4OiLguYDguIjguYrguLDguKHguLAiO3M6NToicGhvbmUiO3M6MTA6IjA4MTIzNDU2NzIiO3M6MTM6ImRlcGFydG1lbnRfaWQiO2k6MTtzOjE1OiJkZXBhcnRtZW50X25hbWUiO3M6MTUzOiLguIHguKXguLjguYjguKHguIfguLLguJnguJrguKPguLTguKvguLLguKPguKLguLjguJfguJjguKjguLLguKrguJXguKPguYzguIHguLLguKPguJ7guLHguJLguJnguLLguIjguLHguIfguKvguKfguLHguJTguIrguLLguKLguYHguJTguJnguKDguLLguITguYPguJXguYkiO30=', 1767075767),
('b6iooo6YrmvWOp2ZeCUcPzcVhvUof3L0yhz6ThmI', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUFhlMkViWjFvSUZhV2ZJSzdDUUNiZ1lwM2lBUVZ4MmN4Qmd6cHMwRiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTY6Imh0dHA6Ly8xMjcuMC4wLjEiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1768797965),
('f9iZNcKNcJMLHyOjzbCp8FPNxvTrT8oQ0D64qHYF', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZHlMMFhGRFpuU1Q3eXpyUENZUGozY096NU4wbERMVEJrSjBPdGRHaiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTY6Imh0dHA6Ly9sb2NhbGhvc3QiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1768797983),
('GWmsWyuFvvjvq66XW2WRzm6aFwQyDqaWr0ZkwKoZ', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36 Edg/128.0.0.0', 'YToxNDp7czo2OiJfdG9rZW4iO3M6NDA6InFQQ201UnJtbnNDUU55alZtYmFSMXBjTVRmVFdLbmp3T3Yyd2ZkZ0kiO3M6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjM1OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvdXNlci9jYWxlbmRhciI7czo1OiJyb3V0ZSI7czoxMzoidXNlcl9jYWxlbmRhciI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6MTU6ImFkbWluX2xvZ2dlZF9pbiI7YjoxO3M6ODoiYWRtaW5faWQiO2k6MTtzOjE5OiJhZG1pbl9kZXBhcnRtZW50X2lkIjtpOjE7czoxNDoidXNlcl9sb2dnZWRfaW4iO2I6MTtzOjExOiJlbXBsb3llZV9pZCI7aTo3O3M6OToidXNlcl9uYW1lIjtzOjI4OiLguJnguLnguKPguLUg4LmA4LiI4Liw4Lil4LiHIjtzOjEwOiJmaXJzdF9uYW1lIjtzOjEyOiLguJnguLnguKPguLUiO3M6OToibGFzdF9uYW1lIjtzOjE1OiLguYDguIjguLDguKXguIciO3M6NToicGhvbmUiO3M6MTA6IjA5ODc0NTQ1NzQiO3M6MTM6ImRlcGFydG1lbnRfaWQiO2k6MTtzOjE1OiJkZXBhcnRtZW50X25hbWUiO3M6MTUzOiLguIHguKXguLjguYjguKHguIfguLLguJnguJrguKPguLTguKvguLLguKPguKLguLjguJfguJjguKjguLLguKrguJXguKPguYzguIHguLLguKPguJ7guLHguJLguJnguLLguIjguLHguIfguKvguKfguLHguJTguIrguLLguKLguYHguJTguJnguKDguLLguITguYPguJXguYkiO30=', 1767081510),
('lFSS6xbngeusyaXvDMPfG9LBxMysOsQTAlu98ciF', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36 Edg/128.0.0.0', 'YToxMTp7czo2OiJfdG9rZW4iO3M6NDA6ImZmSlByQVVlVzNhSU1IN1VBNnFtTDJBWEtnSG9oanE3RG9RZ2lXNEwiO3M6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjQyOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvdXNlci9oaXN0b3J5X2Jvb2tpbmciO3M6NToicm91dGUiO3M6MjA6InVzZXJfaGlzdG9yeV9ib29raW5nIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czoxNDoidXNlcl9sb2dnZWRfaW4iO2I6MTtzOjExOiJlbXBsb3llZV9pZCI7aToyO3M6OToidXNlcl9uYW1lIjtzOjM3OiLguJ/guLLguKPguLXguJTguLIg4LmA4LiI4LmK4Liw4Lih4LiwIjtzOjEwOiJmaXJzdF9uYW1lIjtzOjE4OiLguJ/guLLguKPguLXguJTguLIiO3M6OToibGFzdF9uYW1lIjtzOjE4OiLguYDguIjguYrguLDguKHguLAiO3M6NToicGhvbmUiO3M6MTA6IjA4MTIzNDU2NzIiO3M6MTM6ImRlcGFydG1lbnRfaWQiO2k6MTtzOjE1OiJkZXBhcnRtZW50X25hbWUiO3M6MTUzOiLguIHguKXguLjguYjguKHguIfguLLguJnguJrguKPguLTguKvguLLguKPguKLguLjguJfguJjguKjguLLguKrguJXguKPguYzguIHguLLguKPguJ7guLHguJLguJnguLLguIjguLHguIfguKvguKfguLHguJTguIrguLLguKLguYHguJTguJnguKDguLLguITguYPguJXguYkiO30=', 1767075932),
('rfuLs4KOab2o0fmitn894X1bS0hsUydNqvSHn9sc', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36 Edg/128.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUFpuaWNycTZrSW1KVUlEZUVwUUQwdVprZUtrUjFTY0FvSktObFB3SSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC91c2VyL2NhbGVuZGFyIjtzOjU6InJvdXRlIjtzOjEzOiJ1c2VyX2NhbGVuZGFyIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1768795107),
('XbM7gQ0N27AvRCMSL2igKyU8Ttv7499JNd2KLpuq', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36 Edg/128.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiOFhITEo3QUk2Vnl0NHRGZlFUODFYZjU5eUppM0czc0w2MzkwTUNFOSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC91c2VyL2NhbGVuZGFyIjtzOjU6InJvdXRlIjtzOjEzOiJ1c2VyX2NhbGVuZGFyIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1768269142);

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
(1, 'Test User', 'test@example.com', '2025-12-18 19:31:49', '$2y$12$R6GVN7t2.7sPfHLpALL9KuVPDfmqsDymZXCeQBgo/6EU0jfuy28Eq', 'm3S6gBHVO1', '2025-12-18 19:31:49', '2025-12-18 19:31:49');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

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
  ADD UNIQUE KEY `employees_citizen_id_unique` (`card_id`),
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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `booking_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `room_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
