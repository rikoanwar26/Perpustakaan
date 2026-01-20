-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 20, 2026 at 12:35 AM
-- Server version: 8.0.30
-- PHP Version: 8.3.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perpustakaan`
--

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `id_buku` bigint UNSIGNED NOT NULL,
  `kode_buku` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_kategori` bigint UNSIGNED NOT NULL,
  `id_penulis` bigint UNSIGNED NOT NULL,
  `harga` int NOT NULL,
  `jumlah_stok` int NOT NULL,
  `stok_pinjam` int NOT NULL DEFAULT '0',
  `stok_jual` int NOT NULL DEFAULT '0',
  `tersedia_pinjam` tinyint(1) NOT NULL DEFAULT '1',
  `tersedia_jual` tinyint(1) NOT NULL DEFAULT '1',
  `penerbit` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`id_buku`, `kode_buku`, `judul`, `id_kategori`, `id_penulis`, `harga`, `jumlah_stok`, `stok_pinjam`, `stok_jual`, `tersedia_pinjam`, `tersedia_jual`, `penerbit`, `foto`, `created_at`, `updated_at`) VALUES
(4, 'BK-G0FPWWCT', 'Psychology of Money', 1, 1, 85000, 15, 5, 10, 1, 1, 'B Media, 2024', 'buku/ms82D57rmS0qv4lMuE802wnKcJo8eW5ZhJX5AOPd.webp', '2026-01-18 20:36:53', '2026-01-19 00:51:12'),
(5, 'BK-3STUTQTF', 'Si Kancil', 3, 2, 30000, 20, 10, 11, 1, 1, 'Perpustakaan, 2026', 'buku/VDHhOZkySfFYJqaleNSOfyrzpozGyoakunn1fbuS.jpg', '2026-01-18 20:57:55', '2026-01-18 21:56:13'),
(6, 'BK-F7PH2SIP', 'The Hobbit', 4, 4, 40000, 13, 5, 8, 1, 1, 'Perpustakaan, 2026', 'buku/rZZT8pBiojmOwFb8MFT3ao2G3muBGdcgGMH3EA4S.jpg', '2026-01-18 20:58:53', '2026-01-18 20:58:53'),
(7, 'BK-79RZXNOW', 'The Art of Money', 1, 4, 70000, 15, 10, 5, 1, 1, 'Perpustakaan, 2026', 'buku/2m0airQgS8mEGHzynEODSiEKstyDtUFjeOIKqIsN.jpg', '2026-01-18 21:00:25', '2026-01-18 21:00:25'),
(8, 'BK-DJ8GJIVL', 'Atomic Habits', 1, 1, 95000, 10, 5, 5, 1, 1, 'Perpustakaan, 2026', 'buku/pemHIqDr8HzuFUmEnIp1XUSvFZYbEWbCSgxmi1ng.webp', '2026-01-18 21:01:21', '2026-01-18 21:01:21'),
(9, 'BK-IZQUVNQV', 'Perahu Kertas', 2, 2, 25000, 15, 5, 10, 1, 1, 'Perpustakaan, 2026', 'buku/2vYj6vFG0R0W5kGAjeodQEnA27gWd4qmLmMzPljR.jpg', '2026-01-18 21:02:43', '2026-01-18 21:02:43'),
(10, 'BK-BE1MJ3OV', 'Bulan', 2, 2, 30000, 7, 5, 2, 1, 1, 'Perpustakaan, 2026', 'buku/z7CBsMKQTyqzl54bv5Ws4C7iamAyd3RwJPRfp2GQ.jpg', '2026-01-18 21:03:42', '2026-01-18 21:03:42');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `detail_transaksi`
--

CREATE TABLE `detail_transaksi` (
  `id_detail_transaksi` bigint UNSIGNED NOT NULL,
  `id_transaksi` bigint UNSIGNED NOT NULL,
  `id_buku` bigint UNSIGNED NOT NULL,
  `jumlah` int NOT NULL,
  `total_harga` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `detail_transaksi`
--

INSERT INTO `detail_transaksi` (`id_detail_transaksi`, `id_transaksi`, `id_buku`, `jumlah`, `total_harga`, `created_at`, `updated_at`) VALUES
(8, 8, 5, 1, 10000, '2026-01-18 21:50:14', '2026-01-18 21:50:14'),
(9, 9, 5, 1, 30000, '2026-01-18 21:56:07', '2026-01-18 21:56:07'),
(10, 10, 4, 1, 10000, '2026-01-19 00:49:55', '2026-01-19 00:49:55');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama`, `created_at`, `updated_at`) VALUES
(1, 'Money', '2026-01-13 22:40:05', '2026-01-13 22:40:05'),
(2, 'Novel', '2026-01-14 21:03:43', '2026-01-14 21:04:19'),
(3, 'Dongeng', '2026-01-14 21:04:03', '2026-01-14 21:04:03'),
(4, 'Fiksi', '2026-01-14 21:04:12', '2026-01-14 21:04:12');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_12_10_032137_create_pengguna_table', 1),
(5, '2025_12_10_032158_create_petugas_table', 1),
(6, '2025_12_10_032210_create_kategori_table', 1),
(7, '2025_12_10_032222_create_penulis_table', 1),
(8, '2025_12_10_032233_create_buku_table', 1),
(9, '2025_12_10_032243_create_transaksi_table', 1),
(10, '2025_12_10_032255_create_detail_transaksi_table', 1),
(11, '2026_01_07_000003_add_delivery_to_transaksi_table', 1),
(12, '2026_01_07_000004_add_jatuh_tempo_to_transaksi', 1),
(13, '2026_01_13_010341_add_tanggal_kembali_to_transaksi_table', 1),
(14, '2026_01_14_035726_create_pengembalian_table', 1),
(15, '2026_01_19_000000_add_stok_fields_to_buku', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pengembalian`
--

CREATE TABLE `pengembalian` (
  `id_pengembalian` bigint UNSIGNED NOT NULL,
  `id_transaksi` bigint UNSIGNED NOT NULL,
  `tanggal_kembali` date NOT NULL,
  `denda` int NOT NULL DEFAULT '0',
  `kondisi_buku` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pengembalian`
--

INSERT INTO `pengembalian` (`id_pengembalian`, `id_transaksi`, `tanggal_kembali`, `denda`, `kondisi_buku`, `created_at`, `updated_at`) VALUES
(1, 1, '2026-01-14', 50000, 'rusak', '2026-01-13 23:02:23', '2026-01-13 23:02:23'),
(2, 4, '2026-01-16', 85000, 'hilang', '2026-01-14 21:00:41', '2026-01-14 21:00:41'),
(3, 6, '2026-01-18', 60000, 'rusak', '2026-01-17 11:01:15', '2026-01-17 11:01:15'),
(4, 10, '2026-01-19', 0, 'baik', '2026-01-19 00:51:12', '2026-01-19 00:51:12');

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `id_pengguna` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`id_pengguna`, `nama`, `email`, `password`, `alamat`, `created_at`, `updated_at`) VALUES
(1, 'satriyo', 'satriyo@example.com', '$2y$12$Mcd9FJ5KSE43swGW.cXxfeiWNFg6gPSZmBk4rksYcNSPIqwZLezCy', 'Kesamben', '2026-01-13 22:41:14', '2026-01-13 22:41:14'),
(2, 'Bu Indah', 'indah12@gmail.com', '$2y$12$n99P/UllXLEPdSzR1Azvneh8g5wsx.gYHxl/70sXvD03y5nraHFfC', 'Pulorejo', '2026-01-14 20:56:09', '2026-01-14 20:56:09'),
(3, 'revand', 'revand@gmail.com', '$2y$12$FvmTzapk94OvuPQJC5AcKOOetjCvWJ4h3.HMLK1SkiHKv0sIUSlbG', 'Kedungsukodani, Balongbendo', '2026-01-18 21:37:18', '2026-01-18 21:37:18');

-- --------------------------------------------------------

--
-- Table structure for table `penulis`
--

CREATE TABLE `penulis` (
  `id_penulis` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `penulis`
--

INSERT INTO `penulis` (`id_penulis`, `nama`, `created_at`, `updated_at`) VALUES
(1, 'Morgan Housel', '2026-01-13 22:40:14', '2026-01-13 22:40:14'),
(2, 'Riko Anwar', '2026-01-14 21:04:30', '2026-01-14 21:04:30'),
(3, 'Revand Pramaditya', '2026-01-14 21:04:44', '2026-01-14 21:04:44'),
(4, 'Satriyo', '2026-01-14 21:04:57', '2026-01-14 21:04:57');

-- --------------------------------------------------------

--
-- Table structure for table `petugas`
--

CREATE TABLE `petugas` (
  `id_petugas` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `petugas`
--

INSERT INTO `petugas` (`id_petugas`, `nama`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'Admin Perpustakaan', 'admin@perpus.com', '$2y$12$h3GjTkjCGItymH6RFaVts.dl0d7kGnb7iZ4jJJpS.INmmUhwl.gam', '2026-01-13 22:39:10', '2026-01-13 22:39:10');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('2lGA1d8qg9T7ipFzlAIb6q7Az4DSsRdAoiNmfsy0', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', 'YTo4OntzOjk6Il9wcmV2aW91cyI7YToyOntzOjM6InVybCI7czoyNjoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2NhcnQiO3M6NToicm91dGUiO3M6NDoiY2FydCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NjoiX3Rva2VuIjtzOjQwOiJyRVhWODk1YXNmUDVkQWdGYmhiVVg1aklQMkNjSTloYkpWaGVDNXN2IjtzOjU6ImxvZ2luIjtiOjE7czoyOiJpZCI7aToxO3M6NDoibmFtYSI7czo3OiJzYXRyaXlvIjtzOjQ6InJvbGUiO3M6NDoidXNlciI7czo0OiJjYXJ0IjthOjI6e3M6NDoianVhbCI7YToxOntpOjY7aToxO31zOjY6InBpbmphbSI7YToxOntpOjU7aToxO319fQ==', 1768802215),
('jUr2XO9CoPuxgVMnxicG9tkP2IEwPsBQlmXR1DEb', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', 'YTo3OntzOjk6Il9wcmV2aW91cyI7YToyOntzOjM6InVybCI7czoyNjoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL3VzZXIiO3M6NToicm91dGUiO3M6MTQ6InVzZXIuZGFzaGJvYXJkIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo2OiJfdG9rZW4iO3M6NDA6InAwVzVhMDd0TmdJM1NKTWJJYVB0RTBhS05CeHZFaEtxUHAwR0dmakciO3M6NToibG9naW4iO2I6MTtzOjI6ImlkIjtpOjE7czo0OiJuYW1hIjtzOjc6InNhdHJpeW8iO3M6NDoicm9sZSI7czo0OiJ1c2VyIjt9', 1768809092);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` bigint UNSIGNED NOT NULL,
  `id_pengguna` bigint UNSIGNED NOT NULL,
  `id_petugas` bigint UNSIGNED DEFAULT NULL,
  `jenis` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal` date NOT NULL,
  `jatuh_tempo` datetime DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `tanggal_kembali` datetime DEFAULT NULL,
  `metode_pengantaran` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `biaya_pengantaran` int NOT NULL DEFAULT '0',
  `biaya_peminjaman` int DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `id_pengguna`, `id_petugas`, `jenis`, `tanggal`, `jatuh_tempo`, `status`, `tanggal_kembali`, `metode_pengantaran`, `biaya_pengantaran`, `biaya_peminjaman`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, 'pinjam', '2026-01-14', '2026-01-19 05:41:37', 'Berhasil', NULL, 'antar', 10000, 0, '2026-01-13 22:41:37', '2026-01-13 22:43:19'),
(2, 1, NULL, 'jual', '2026-01-14', NULL, 'Berhasil', NULL, 'antar', 10000, 0, '2026-01-13 22:42:24', '2026-01-13 22:43:14'),
(3, 2, NULL, 'jual', '2026-01-15', NULL, 'Berhasil', NULL, 'antar', 10000, 0, '2026-01-14 20:57:51', '2026-01-14 20:59:36'),
(4, 2, NULL, 'pinjam', '2026-01-15', '2026-01-20 03:57:51', 'Berhasil', NULL, 'outlet', 0, 0, '2026-01-14 20:57:51', '2026-01-14 20:59:31'),
(5, 2, NULL, 'jual', '2026-01-16', NULL, 'Berhasil', NULL, 'outlet', 0, 0, '2026-01-14 21:14:20', '2026-01-15 23:56:21'),
(6, 2, NULL, 'pinjam', '2026-01-16', '2026-01-20 04:14:20', 'Berhasil', NULL, 'outlet', 0, 0, '2026-01-14 21:14:20', '2026-01-15 23:56:28'),
(7, 1, NULL, 'pinjam', '2026-01-17', '2026-01-22 17:41:50', 'Dibatalkan', NULL, 'outlet', 0, 0, '2026-01-17 10:41:50', '2026-01-17 10:41:56'),
(8, 1, NULL, 'pinjam', '2026-01-19', '2026-01-24 04:50:14', 'Dibatalkan', NULL, 'antar', 0, 10000, '2026-01-18 21:50:14', '2026-01-18 21:50:18'),
(9, 1, NULL, 'jual', '2026-01-19', NULL, 'Dibatalkan', NULL, 'antar', 10000, 0, '2026-01-18 21:56:07', '2026-01-18 21:56:13'),
(10, 1, NULL, 'pinjam', '2026-01-19', '2026-01-24 07:49:55', 'Dikembalikan', NULL, 'antar', 10000, 0, '2026-01-19 00:49:55', '2026-01-19 00:51:12');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id_buku`),
  ADD UNIQUE KEY `buku_kode_buku_unique` (`kode_buku`),
  ADD KEY `buku_id_kategori_foreign` (`id_kategori`),
  ADD KEY `buku_id_penulis_foreign` (`id_penulis`);

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
-- Indexes for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD PRIMARY KEY (`id_detail_transaksi`),
  ADD KEY `detail_transaksi_id_transaksi_foreign` (`id_transaksi`),
  ADD KEY `detail_transaksi_id_buku_foreign` (`id_buku`);

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
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

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
-- Indexes for table `pengembalian`
--
ALTER TABLE `pengembalian`
  ADD PRIMARY KEY (`id_pengembalian`),
  ADD KEY `pengembalian_id_transaksi_foreign` (`id_transaksi`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id_pengguna`),
  ADD UNIQUE KEY `pengguna_email_unique` (`email`);

--
-- Indexes for table `penulis`
--
ALTER TABLE `penulis`
  ADD PRIMARY KEY (`id_penulis`);

--
-- Indexes for table `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`id_petugas`),
  ADD UNIQUE KEY `petugas_email_unique` (`email`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

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
-- AUTO_INCREMENT for table `buku`
--
ALTER TABLE `buku`
  MODIFY `id_buku` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  MODIFY `id_detail_transaksi` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `pengembalian`
--
ALTER TABLE `pengembalian`
  MODIFY `id_pengembalian` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id_pengguna` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `penulis`
--
ALTER TABLE `penulis`
  MODIFY `id_penulis` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `petugas`
--
ALTER TABLE `petugas`
  MODIFY `id_petugas` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `buku`
--
ALTER TABLE `buku`
  ADD CONSTRAINT `buku_id_kategori_foreign` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`) ON DELETE CASCADE,
  ADD CONSTRAINT `buku_id_penulis_foreign` FOREIGN KEY (`id_penulis`) REFERENCES `penulis` (`id_penulis`) ON DELETE CASCADE;

--
-- Constraints for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD CONSTRAINT `detail_transaksi_id_buku_foreign` FOREIGN KEY (`id_buku`) REFERENCES `buku` (`id_buku`) ON DELETE CASCADE,
  ADD CONSTRAINT `detail_transaksi_id_transaksi_foreign` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id_transaksi`) ON DELETE CASCADE;

--
-- Constraints for table `pengembalian`
--
ALTER TABLE `pengembalian`
  ADD CONSTRAINT `pengembalian_id_transaksi_foreign` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id_transaksi`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
