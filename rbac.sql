-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 30, 2025 at 08:11 AM
-- Server version: 8.0.30
-- PHP Version: 8.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rbac`
--

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text,
  `author` varchar(255) NOT NULL,
  `category` varchar(255) DEFAULT NULL,
  `status` enum('draft','published','archived') NOT NULL DEFAULT 'draft',
  `tags` text,
  `featured_image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `title`, `content`, `author`, `category`, `status`, `tags`, `featured_image`, `created_at`, `updated_at`) VALUES
(3, 'Wisuda Ke-4, 20 Wisudawan UMUKA Karanganyar Raih Cumlaude', 'KBRN, Karanganyar: Universitas Muhammadiyah Karanganyar (UMUKA) menggelar prosesi Wisuda ke-4 bagi 55 mahasiswa di lingkungan kampus UMUKA, Rabu (17/12/2025). Wisudawan kali ini merupakan lulusan perdana dari mahasiswa yang mendaftar sejak UMUKA resmi bertransformasi menjadi universitas.\r\n\r\nRektor UMUKA, Muh Samsuri, menyatakan para lulusan dari Program Studi D3 Produksi Ternak dan D3 Perhotelan ini merupakan \"produk murni\" pertama UMUKA. Ia berharap para lulusan tidak hanya menjadi pencari kerja, melainkan mampu menjadi wirausahawan atau juragan baru di bidangnya.\r\n\r\n\"Hari ini gembira karena diwisuda. Ini merupakan wisuda pertama dari mahasiswa yang kami terima setelah UMUKA berdiri. Harapannya, wisudawan produksi ternak dan perhotelan ini kedepannya menjadi calon-calon juragan,\" ujar Muh Samsuri dalam sambutannya.\r\nBerdasarkan laporan akademik, Wakil Rektor I, Ali Imron Al-Makruf, sebanyak 20 wisudawan berhasil meraih predikat Cumlaude. Febriana Zahro Devi dari prodi Perhotelan meraih IPK tertinggi yakni 3,83, sementara Tarwanto dari prodi Produksi Ternak mencatatkan IPK 3,78. Alif Oktaviani ditetapkan sebagai wisudawan tercepat dengan masa studi 2 tahun 10 bulan.\r\n\r\n\"Lulusan sebelumnya merupakan limpahan dari akademi yang bergabung, namun untuk kali ini adalah produk murni UMUKA. Dengan demikian, total lulusan UMUKA sejak tahun 2022 hingga 2025 kini mencapai 352 orang,\" kata Ali Imron.', 'husendev', 'technology', 'published', 'umuka,wisuda', 'https://cdn.rri.co.id/berita/Surakarta/o/1765967882797-1000838986/9yxojhuuvk4yywn.jpeg', '2025-12-29 10:22:41', '2025-12-29 20:15:11'),
(4, 'Pelantikan Pengurus HIPMI PT UMUKA Periode 2025–2026: “Lead the Change, Build the Future”', 'Dengan mengusung tema “Lead the Change, Build the Future,” kegiatan ini menjadi momentum penting bagi mahasiswa untuk menumbuhkan semangat kepemimpinan, inovasi, dan jiwa kewirausahaan di lingkungan kampus.\r\n\r\nAcara pelantikan berlangsung khidmat di Ruang Anthurium Rumah Dinas Bupati Karanganyar, dihadiri oleh jajaran pimpinan universitas, pembina HIPMI PT UMUKA, serta tamu undangan dari berbagai organisasi mahasiswa.\r\n\r\nDalam sambutannya, Ketua Umum terpilih menyampaikan komitmennya untuk menjadikan HIPMI PT UMUKA sebagai wadah pengembangan potensi mahasiswa di bidang kewirausahaan.\r\n\r\n“Kami ingin menjadikan HIPMI PT UMUKA sebagai ruang kolaborasi dan inovasi bagi generasi muda agar mampu berkontribusi nyata bagi kemajuan ekonomi lokal maupun nasional,” ujarnya.\r\n\r\nSementara itu, Plh. Bupati Karanganyar H. Adhe Eliana, S.E. dalam arahannya menekankan pentingnya mental wirausaha yang tangguh dan keberanian dalam mengambil risiko. Menurutnya, keberhasilan seorang pengusaha tidak hanya diukur dari pencapaian pribadi, tetapi juga dari seberapa besar manfaat yang dapat diberikan kepada masyarakat.', 'ihusen', 'education', 'published', 'umuka,wisuda', 'https://www.karanganyarkab.go.id/wp-content/uploads/2025/10/WhatsApp-Image-2025-10-30-at-16.36.47-e1761831472169.jpeg', '2025-12-29 10:26:07', '2025-12-29 10:26:07');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('admin@trengguli.id|127.0.0.1', 'i:1;', 1766769174),
('admin@trengguli.id|127.0.0.1:timer', 'i:1766769174;', 1766769174),
('editor@example.com|127.0.0.1', 'i:1;', 1767078108),
('editor@example.com|127.0.0.1:timer', 'i:1767078108;', 1767078108),
('spatie.permission.cache', 'a:3:{s:5:\"alias\";a:4:{s:1:\"a\";s:2:\"id\";s:1:\"b\";s:4:\"name\";s:1:\"c\";s:10:\"guard_name\";s:1:\"r\";s:5:\"roles\";}s:11:\"permissions\";a:17:{i:0;a:4:{s:1:\"a\";i:36;s:1:\"b\";s:10:\"view-users\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:10;i:1;i:11;}}i:1;a:4:{s:1:\"a\";i:37;s:1:\"b\";s:12:\"create-users\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:10;}}i:2;a:4:{s:1:\"a\";i:38;s:1:\"b\";s:10:\"edit-users\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:10;}}i:3;a:4:{s:1:\"a\";i:39;s:1:\"b\";s:12:\"delete-users\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:10;}}i:4;a:4:{s:1:\"a\";i:40;s:1:\"b\";s:10:\"view-roles\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:10;i:1;i:11;}}i:5;a:4:{s:1:\"a\";i:41;s:1:\"b\";s:12:\"create-roles\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:10;}}i:6;a:4:{s:1:\"a\";i:42;s:1:\"b\";s:10:\"edit-roles\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:10;}}i:7;a:4:{s:1:\"a\";i:43;s:1:\"b\";s:12:\"delete-roles\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:10;}}i:8;a:4:{s:1:\"a\";i:44;s:1:\"b\";s:16:\"view-permissions\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:10;i:1;i:11;}}i:9;a:4:{s:1:\"a\";i:45;s:1:\"b\";s:18:\"create-permissions\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:10;}}i:10;a:4:{s:1:\"a\";i:46;s:1:\"b\";s:16:\"edit-permissions\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:10;}}i:11;a:4:{s:1:\"a\";i:47;s:1:\"b\";s:18:\"delete-permissions\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:10;}}i:12;a:4:{s:1:\"a\";i:48;s:1:\"b\";s:13:\"view-articles\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:10;i:1;i:11;i:2;i:12;}}i:13;a:4:{s:1:\"a\";i:49;s:1:\"b\";s:15:\"create-articles\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:10;i:1;i:11;}}i:14;a:4:{s:1:\"a\";i:50;s:1:\"b\";s:13:\"edit-articles\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:10;i:1;i:11;}}i:15;a:4:{s:1:\"a\";i:51;s:1:\"b\";s:15:\"delete-articles\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:10;}}i:16;a:4:{s:1:\"a\";i:52;s:1:\"b\";s:10:\"manage-all\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:10;}}}s:5:\"roles\";a:3:{i:0;a:3:{s:1:\"a\";i:10;s:1:\"b\";s:5:\"admin\";s:1:\"c\";s:3:\"web\";}i:1;a:3:{s:1:\"a\";i:11;s:1:\"b\";s:6:\"editor\";s:1:\"c\";s:3:\"web\";}i:2;a:3:{s:1:\"a\";i:12;s:1:\"b\";s:4:\"user\";s:1:\"c\";s:3:\"web\";}}}', 1767153768);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_12_26_171842_create_permission_tables', 2),
(7, '2025_12_29_164922_create_articles_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(10, 'App\\Models\\User', 2),
(11, 'App\\Models\\User', 3),
(12, 'App\\Models\\User', 4),
(12, 'App\\Models\\User', 5);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(36, 'view-users', 'web', '2025-12-29 20:24:07', '2025-12-29 20:24:07'),
(37, 'create-users', 'web', '2025-12-29 20:24:56', '2025-12-29 20:24:56'),
(38, 'edit-users', 'web', '2025-12-29 20:25:36', '2025-12-29 20:25:36'),
(39, 'delete-users', 'web', '2025-12-29 20:25:49', '2025-12-29 20:25:49'),
(40, 'view-roles', 'web', '2025-12-29 20:26:52', '2025-12-29 20:26:52'),
(41, 'create-roles', 'web', '2025-12-29 20:27:08', '2025-12-29 20:27:08'),
(42, 'edit-roles', 'web', '2025-12-29 20:27:22', '2025-12-29 20:27:22'),
(43, 'delete-roles', 'web', '2025-12-29 20:27:36', '2025-12-29 20:27:36'),
(44, 'view-permissions', 'web', '2025-12-29 20:28:24', '2025-12-29 20:28:24'),
(45, 'create-permissions', 'web', '2025-12-29 20:28:36', '2025-12-29 20:28:36'),
(46, 'edit-permissions', 'web', '2025-12-29 20:28:47', '2025-12-29 20:28:47'),
(47, 'delete-permissions', 'web', '2025-12-29 20:29:02', '2025-12-29 20:29:02'),
(48, 'view-articles', 'web', '2025-12-29 20:29:17', '2025-12-29 20:29:17'),
(49, 'create-articles', 'web', '2025-12-29 20:29:29', '2025-12-29 20:29:29'),
(50, 'edit-articles', 'web', '2025-12-29 20:29:43', '2025-12-29 20:29:43'),
(51, 'delete-articles', 'web', '2025-12-29 20:30:00', '2025-12-29 20:30:00'),
(52, 'manage-all', 'web', '2025-12-29 20:35:35', '2025-12-29 20:35:35');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(10, 'admin', 'web', '2025-12-29 11:58:39', '2025-12-29 11:58:39'),
(11, 'editor', 'web', '2025-12-29 11:58:39', '2025-12-29 11:58:39'),
(12, 'user', 'web', '2025-12-29 11:58:39', '2025-12-29 11:58:39');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(36, 10),
(37, 10),
(38, 10),
(39, 10),
(40, 10),
(41, 10),
(42, 10),
(43, 10),
(44, 10),
(45, 10),
(46, 10),
(47, 10),
(48, 10),
(49, 10),
(50, 10),
(51, 10),
(52, 10),
(36, 11),
(40, 11),
(44, 11),
(48, 11),
(49, 11),
(50, 11),
(48, 12);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text,
  `payload` longtext NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('0CpqxHtSrrL7kRuDmcrNNEMJOaUprKRdJY5e4SpD', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiM3RSWWdUckp0SWlDTDFabUJPbWd2bllNMHRRemtVc21SRGFkd094ciI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTY6Imh0dHA6Ly9yYmFjLnRlc3QiO319', 1767081828);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 'yanto', 'admin@example.com', '2025-12-29 11:58:40', '$2y$12$pmk.Uegc1xFLMcYAOEJk7OEBpZYOQBWCvINBXAxlU4KoTA0P1Ig.S', NULL, '2025-12-29 11:58:40', '2025-12-29 13:26:56'),
(3, 'Imam Husen Al Munawaroh', 'editor@example.com', '2025-12-29 11:58:40', '$2y$12$73wcPclpGgghEOFxoB7WmOpRe6pg0ipQ.K1puAa.SGBwFziy75JiC', NULL, '2025-12-29 11:58:40', '2025-12-29 21:57:31'),
(4, 'andi', 'user@example.com', '2025-12-29 11:58:41', '$2y$12$U1933HO8OBBoZaSGNOuMjul.HSZkEM.qgSFOf14sisHeFGFH.qKWu', NULL, '2025-12-29 11:58:41', '2025-12-29 13:20:10'),
(5, 'yanti', 'yanti12@gmail.com', NULL, '$2y$12$ZEKOY4eJjN3DZ5llSY3bNOp.PES4aY61IiR6DDjC4Syueip6GXDW2', NULL, '2025-12-29 20:14:24', '2025-12-29 20:14:24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

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
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
