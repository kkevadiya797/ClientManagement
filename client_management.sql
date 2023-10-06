-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 11, 2023 at 01:09 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `client_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2023_02_02_120549_create_settings_table', 1),
(5, '2023_02_02_120621_create_projects_table', 1);

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
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `budget` int(11) NOT NULL DEFAULT 0,
  `complete_status` tinyint(4) NOT NULL DEFAULT 0,
  `delete_status` tinyint(4) NOT NULL DEFAULT 0,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `s_id` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `c_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `title`, `description`, `budget`, `complete_status`, `delete_status`, `start_date`, `end_date`, `s_id`, `c_id`, `created_at`, `updated_at`) VALUES
(2, 'Demo', 'Demo', 100, 1, 0, '2023-02-06', '2023-02-10', '[\"6\",\"7\"]', 4, '2023-02-05 11:15:05', '2023-02-05 11:31:41'),
(3, 'Ecommerce', 'ecommerce Project', 500, 0, 0, '2023-02-07', '2023-02-10', '[\"6\"]', 4, '2023-02-06 15:24:49', '2023-02-06 15:24:49');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `url` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `system_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `login_page_title` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `copyrights` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `favicon` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `login_logo` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `url`, `company_name`, `system_title`, `login_page_title`, `copyrights`, `favicon`, `logo`, `login_logo`, `created_at`, `updated_at`) VALUES
(1, 'http://127.0.0.1:8000/dashboard', 'Team Work', 'Client Management', 'Client Management', 'Copyright © 2023  Developed by Team 10', 'uploads/logos/favicon.ico', 'uploads/logos/logo.png', 'uploads/logos/logo.png', '2023-02-08 15:01:59', '2023-02-08 16:42:09');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profile_pic` text COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '\'uploads/profile/avatar.png\'',
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` bigint(20) DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `postcode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NOT NULL DEFAULT '2023-02-03 11:14:26',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` int(11) NOT NULL,
  `delete_status` tinyint(4) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `title`, `profile_pic`, `email`, `phone`, `city`, `state`, `country`, `postcode`, `email_verified_at`, `password`, `role_id`, `delete_status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'Mr.', 'uploads/profile/avatar.png', 'admin@gmail.com', 17645678985, 'Mainz', 'Rhineland-Palatinate', 'Germany', '55129', '2023-02-03 11:14:26', '$2a$12$yjOMASyHCjyiuk87HbvopeqFK6OkZa7MwdZ5vWmj9MGFi0P6.gpB2', 1, 0, 'beCC1F5sR0sc32PcS2Akuiy3iWDYlQeeBFgiFBLxK0EvmVpIV4Pt2wfe185t', '2023-02-03 12:14:39', '2023-02-03 12:14:39'),
(3, 'Bhautik Radadiya', 'Mr.', 'uploads/profile/Bhautik RabtcrS_images_.png', 'bk@gmail.com', 7485968574, 'Mainz', 'Rheinland', 'Germany', '55129', '2023-02-03 11:14:26', '$2y$10$osVtIKc7rFcbb7ARmdqocuZbY9er2tAj3DK/7EjkD.Pfbtr.NedZa', 3, 0, NULL, '2023-02-04 14:42:11', '2023-02-04 14:42:11'),
(4, 'Demo', 'Mr.', 'uploads/profile/Demoj1GZJ_images_.png', 'demo@gmail.com', 7485968574, 'demo', 'dmo', 'demo', '74854', '2023-02-03 11:14:26', '$2y$10$BnNHQ.AnGuaSEhYhVtIhF.Y3NFlcKBDFYtuyO6Nkj5cUVdFffOF3m', 3, 0, NULL, '2023-02-04 15:48:55', '2023-02-04 15:48:55'),
(6, 'Arpit Jivani', 'Mr.', 'uploads/profile/Arpit JivaRw6jr_images_.png', 'arpit@gmail.com', 176748596885, 'Mainz', 'Rhineland-Palatinate', 'Germany', '55129', '2023-02-03 11:14:26', '$2y$10$i3OdhXXSPZtAwyW27edVpOiDMk57vqA/.K5uh0u.cSLr7GOsTrHRW', 2, 0, NULL, '2023-02-04 22:39:20', '2023-02-04 22:39:20'),
(7, 'Miraj', 'Mr.', 'uploads/profile/Miraj8GkBd_images_.png', 'miraj@gmail.com', 176857485965, 'Mainz', 'Rhineland-Palatinate', 'Germany', '55131', '2023-02-03 11:14:26', '$2y$10$1spTlZqQj5bBQhp6dyPDt.UoQc/v57FTqyiAwGv8oRH2MOLBj/odi', 2, 0, NULL, '2023-02-04 22:40:06', '2023-02-04 22:40:06');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `projects_c_id_foreign` (`c_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `projects`
--
ALTER TABLE `projects`
  ADD CONSTRAINT `projects_c_id_foreign` FOREIGN KEY (`c_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
