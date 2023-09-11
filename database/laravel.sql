-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Generation Time: May 05, 2023 at 05:55 PM
-- Server version: 8.0.32
-- PHP Version: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel`
--

-- --------------------------------------------------------

--
-- Table structure for table `checklists`
--

CREATE TABLE `checklists` (
  `id` int UNSIGNED NOT NULL,
  `checklist` smallint UNSIGNED NOT NULL,
  `id_user` bigint UNSIGNED NOT NULL,
  `id_project` int UNSIGNED NOT NULL,
  `activity` varchar(50) NOT NULL,
  `closureDate` date DEFAULT NULL,
  `deadlineDate` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `checklists`
--

INSERT INTO `checklists` (`id`, `checklist`, `id_user`, `id_project`, `activity`, `closureDate`, `deadlineDate`, `created_at`, `updated_at`) VALUES
(13, 0, 10, 33, 'DESENVOLVIMENTO', NULL, '2023-04-07', '2023-03-30 17:23:01', '2023-03-30 17:23:01');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int UNSIGNED NOT NULL,
  `contact` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `contact`, `created_at`, `updated_at`) VALUES
(4, 'Monique', '2023-03-20 17:35:25', '2023-03-20 17:35:25'),
(5, 'Claudio', '2023-03-20 17:35:30', '2023-03-20 17:35:30'),
(7, 'Teste01', '2023-03-23 16:58:30', '2023-03-23 16:58:30'),
(8, 'SAMUELTEST', '2023-03-23 19:35:55', '2023-03-23 19:35:55'),
(9, 'TRRX', '2023-03-23 19:54:27', '2023-03-23 19:54:27');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int UNSIGNED NOT NULL,
  `customer` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `customer`, `created_at`, `updated_at`) VALUES
(6, 'First Nation', '2023-03-20 17:35:41', '2023-03-20 17:35:41'),
(9, 'TrackTeste01', '2023-03-22 19:15:51', '2023-03-22 19:15:51'),
(10, 'Teste02', '2023-03-22 19:16:05', '2023-03-22 19:16:05'),
(24, 'Teste', '2023-03-23 19:46:14', '2023-03-23 19:46:14');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
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
(6, '2022_12_23_132508_create_sessions_table', 1),
(7, '2022_12_29_181035_create_sizes_table', 2),
(8, '2022_12_29_181103_create_contacts_table', 2),
(9, '2022_12_29_181126_create_costumers_table', 2),
(10, '2022_12_29_181142_create_products_table', 2),
(11, '2022_12_29_181159_create_status_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `id` int NOT NULL,
  `note` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `id_project` int UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `notes`
--

INSERT INTO `notes` (`id`, `note`, `id_project`, `created_at`, `updated_at`) VALUES
(14, 'Teste@teste.exemplo.com', 27, '2023-03-23 13:48:30', '2023-03-23 13:48:30'),
(23, 'REUNIÃO', 33, '2023-03-30 17:23:13', '2023-03-30 17:23:13');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('guilherme.cesar.reis@hotmail.com', '$2y$10$ute8eou6wtXOkT18G.i8PuL51OqGPkgsNm5fHw2z.TQCbcxLOUsA.', '2022-12-27 15:54:20'),
('guilherme.cesar.reis@hotmail.com', '$2y$10$ute8eou6wtXOkT18G.i8PuL51OqGPkgsNm5fHw2z.TQCbcxLOUsA.', '2022-12-27 15:54:20');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
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
  `id` int UNSIGNED NOT NULL,
  `product` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product`, `created_at`, `updated_at`) VALUES
(4, 'Ttrx', '2023-03-20 17:35:49', '2023-03-20 17:35:49'),
(14, 'Trrxteste01', '2023-03-22 19:49:57', '2023-03-22 19:49:57'),
(15, 'Teste02', '2023-03-22 20:02:32', '2023-03-22 20:02:32'),
(19, 'Trrxteste02', '2023-03-22 20:55:50', '2023-03-22 20:55:50'),
(21, 'Trrxteste03', '2023-03-22 20:56:12', '2023-03-22 20:56:12'),
(29, 'Teste2', '2023-03-23 13:43:46', '2023-03-23 13:43:46');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` int UNSIGNED NOT NULL,
  `project` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_status` int UNSIGNED NOT NULL,
  `id_customer` int UNSIGNED NOT NULL,
  `id_product` int UNSIGNED NOT NULL,
  `id_user` bigint UNSIGNED DEFAULT NULL,
  `id_contact` int UNSIGNED NOT NULL,
  `id_size` int UNSIGNED NOT NULL,
  `beginDate` date DEFAULT NULL,
  `closureDate` date DEFAULT NULL,
  `deadlineDate` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `project`, `description`, `id_status`, `id_customer`, `id_product`, `id_user`, `id_contact`, `id_size`, `beginDate`, `closureDate`, `deadlineDate`, `created_at`, `updated_at`, `deleted_at`) VALUES
(27, 'Teste01', 'dhdh dhdhdhdh dhdopohdaodioaid haihdiaodgfd', 1, 9, 15, 12, 7, 9, '2023-02-03', NULL, '2023-04-15', '2023-03-22 20:09:51', '2023-05-05 15:11:48', NULL),
(28, 'Teste04', 'fsfsfsf', 1, 10, 14, 12, 5, 10, '2023-02-03', '2023-04-04', '2023-10-04', '2023-03-22 20:11:48', '2023-03-22 20:11:48', NULL),
(29, 'test@', 'teste', 1, 9, 15, 12, 4, 9, '2023-03-20', '2023-03-30', '2023-04-15', '2023-03-23 14:11:00', '2023-03-23 14:11:00', NULL),
(32, 'teste 2', 'teste de projeto', 1, 6, 15, 12, 5, 10, '2023-03-28', '2023-04-04', '2023-04-07', '2023-03-28 20:15:55', '2023-04-12 15:06:33', NULL),
(33, 'TESTE344334', '5335353553', 2, 6, 4, 12, 4, 10, '2023-03-30', '2023-04-12', '2023-04-14', '2023-03-30 17:21:54', '2023-04-12 15:07:20', NULL),
(34, 'gsdgdgsd', 'gdfgdsfgd', 1, 6, 4, 12, 4, 10, '2023-05-06', NULL, '2023-06-09', '2023-05-04 14:16:49', '2023-05-04 14:16:49', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('6GbUtzDZZquKx7G5mu6Shkg4GvFyBvl43EUgRh0g', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiWXhqSjVSdHYzbGJRZG1PT0xFdmlwbnREQUh2NmZ3ZW1DakNSQ0pKQiI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjIwOiJodHRwOi8vZ3Byb2plY3QudGVzdCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjI7fQ==', 1672253864);

-- --------------------------------------------------------

--
-- Table structure for table `sizes`
--

CREATE TABLE `sizes` (
  `id` int UNSIGNED NOT NULL,
  `size` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sizes`
--

INSERT INTO `sizes` (`id`, `size`, `created_at`, `updated_at`) VALUES
(9, 'Small', '2023-03-20 12:55:34', '2023-03-20 12:55:34'),
(10, 'Big', '2023-03-20 17:35:09', '2023-03-20 17:35:09'),
(20, 'Medium', '2023-03-28 14:42:30', '2023-03-28 14:42:30');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `id` int UNSIGNED NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'New', '2023-01-03 16:46:06', '2023-03-02 14:31:41'),
(2, 'In Progress', '2023-01-03 16:46:27', '2023-03-02 14:30:42'),
(3, 'Done', '2023-01-03 22:51:47', '2023-03-02 14:31:06'),
(4, 'QA Test', '2023-01-24 15:47:17', '2023-03-28 14:43:24'),
(5, 'Canceled', '2023-03-02 14:31:59', '2023-03-02 14:31:59'),
(6, 'Closed', '2023-03-02 14:32:06', '2023-03-02 14:32:06'),
(7, 'Frozen', '2023-03-20 17:36:45', '2023-03-20 17:36:45');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `two_factor_secret` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `two_factor_recovery_codes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_team_id` bigint UNSIGNED DEFAULT NULL,
  `profile_photo_path` varchar(2048) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `profile` smallint NOT NULL,
  `status` smallint NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `current_team_id`, `profile_photo_path`, `created_at`, `updated_at`, `profile`, `status`) VALUES
(2, 'Guilherme', 'guilherme@test', NULL, '$2y$10$jZ14YEqEX4BrDBAFhynmtejZ0C6xCvC.WPwzSFVTlw71ztWuGnzUS', NULL, NULL, NULL, NULL, NULL, NULL, '2022-12-23 16:34:28', '2023-05-05 13:37:13', 0, 1),
(10, 'Mauricio', 'mauricio@teste', NULL, '$2y$10$qHGiUNBhMGQ18LA7RytRz.uiJnimn5UOKIGc1VCEcIgHVEep7kLxe', NULL, NULL, NULL, NULL, NULL, NULL, '2023-02-08 15:51:51', '2023-02-08 15:51:51', 0, 1),
(11, 'Admin', 'admin@admin', NULL, '$2y$10$pmvXERg.IJfEG6lmDTbR1ua5hxVWG350SJJspdN82lverTXlk/5mC', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-21 15:25:35', '2023-03-21 20:01:44', 0, 1),
(12, 'Project', 'project@project', NULL, '$2y$10$9sPmZtPDbD8ywBhqukEVO.1RbrJjEJZZ2gY9XG56cQZf/5QAYe9G.', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-21 20:08:11', '2023-03-22 17:21:01', 1, 1),
(13, 'Samuel', 'samuel@teste', NULL, '$2y$10$CfxXYbvMAjb5LsNuLJkKrO5KVRenYC7g6cAxBVTffXwYBoDXEmhDq', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-22 17:21:45', '2023-03-22 17:22:13', 0, 1),
(14, 'Sergio', 'sergio@teste', NULL, '$2y$10$KKB7pD1t6D6ZZTcVffB2XOOTxgd.SvHQ/Jse3ClK3HejLBpP3YqQe', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-22 17:23:12', '2023-03-22 17:23:12', 0, 1),
(15, 'Julia', 'julia@tracktracerx.com', NULL, '$2y$10$Cdw8J55UdPEZkMgH4myRpuhH8lQMIcrExYq37oDDev235Se1i609G', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-23 16:59:57', '2023-03-29 16:50:48', 0, 1),
(16, 'victor', 'victor@test', NULL, '$2y$10$H2BWcs3MunlZEjHVXlz2kOkEoULPU9ZfLSxeFf2vmkf0CE2whqYyy', NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-03 14:29:13', '2023-04-03 14:29:13', 0, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `checklists`
--
ALTER TABLE `checklists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_checklists_users` (`id_user`),
  ADD KEY `FK_checklists_projects` (`id_project`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `contact` (`contact`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `customer` (`customer`);

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
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_notes_projects` (`id_project`);

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
  ADD UNIQUE KEY `product` (`product`),
  ADD UNIQUE KEY `product_2` (`product`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_projetos_users` (`id_user`) USING BTREE,
  ADD KEY `FK_project_status` (`id_status`) USING BTREE,
  ADD KEY `FK_project_products` (`id_product`) USING BTREE,
  ADD KEY `FK_projects_customers` (`id_customer`) USING BTREE,
  ADD KEY `FK_projects_contacts` (`id_contact`) USING BTREE,
  ADD KEY `FK_projects_sizes` (`id_size`) USING BTREE;

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `sizes`
--
ALTER TABLE `sizes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `size` (`size`),
  ADD UNIQUE KEY `size_2` (`size`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `status` (`status`);

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
-- AUTO_INCREMENT for table `checklists`
--
ALTER TABLE `checklists`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `sizes`
--
ALTER TABLE `sizes`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `checklists`
--
ALTER TABLE `checklists`
  ADD CONSTRAINT `FK_checklists_projects` FOREIGN KEY (`id_project`) REFERENCES `projects` (`id`),
  ADD CONSTRAINT `FK_checklists_users` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

--
-- Constraints for table `notes`
--
ALTER TABLE `notes`
  ADD CONSTRAINT `FK_notes_projects` FOREIGN KEY (`id_project`) REFERENCES `projects` (`id`);

--
-- Constraints for table `projects`
--
ALTER TABLE `projects`
  ADD CONSTRAINT `FK_project_products` FOREIGN KEY (`id_product`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `FK_project_status` FOREIGN KEY (`id_status`) REFERENCES `status` (`id`),
  ADD CONSTRAINT `FK_projects_contacts` FOREIGN KEY (`id_contact`) REFERENCES `contacts` (`id`),
  ADD CONSTRAINT `FK_projects_customers` FOREIGN KEY (`id_customer`) REFERENCES `customers` (`id`),
  ADD CONSTRAINT `FK_projects_sizes` FOREIGN KEY (`id_size`) REFERENCES `sizes` (`id`),
  ADD CONSTRAINT `FK_projetos_users` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;