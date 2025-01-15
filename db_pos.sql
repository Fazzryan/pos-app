-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 14 Jan 2025 pada 16.00
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_pos`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id` int(11) NOT NULL,
  `nm_kategori` varchar(30) NOT NULL,
  `tgl_dibuat` timestamp NOT NULL DEFAULT current_timestamp(),
  `tgl_diubah` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id`, `nm_kategori`, `tgl_dibuat`, `tgl_diubah`) VALUES
(1, 'Coffe', '2024-09-29 06:08:38', '2024-09-29 06:24:31'),
(2, 'Non Coffe', '2024-09-29 06:22:31', '2024-09-29 06:24:36'),
(4, 'Milk Based', '2024-09-29 06:25:34', '2024-09-29 06:25:34'),
(5, 'Drink', '2024-09-29 06:26:41', '2024-09-29 06:26:41'),
(6, 'Food', '2024-09-29 06:28:07', '2024-09-29 06:28:07');

-- --------------------------------------------------------

--
-- Struktur dari tabel `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `kategori_id` int(11) NOT NULL,
  `nm_menu` varchar(100) NOT NULL,
  `harga` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `foto` varchar(50) NOT NULL,
  `tgl_dibuat` timestamp NOT NULL DEFAULT current_timestamp(),
  `tgl_diubah` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `menu`
--

INSERT INTO `menu` (`id`, `kategori_id`, `nm_menu`, `harga`, `stok`, `foto`, `tgl_dibuat`, `tgl_diubah`) VALUES
(1, 6, 'Ayam Geprek', 15000, 82, 'menu-650844143.jpeg', '2024-09-29 09:51:12', '2024-10-05 07:06:01'),
(2, 6, 'Nasi Pecel', 10000, 90, 'menu-484738947.jpg', '2024-09-29 10:16:18', '2024-10-05 06:11:53'),
(3, 6, 'Sate Ayam', 8000, 87, 'menu-1378159204.jpeg', '2024-09-29 10:17:18', '2024-10-04 14:40:02'),
(8, 5, 'Jus Alpukat', 11000, 49, 'menu-1161580619.jpg', '2024-10-05 06:07:46', '2024-10-05 06:41:53'),
(9, 5, 'Es Cincau', 8000, 20, 'menu-1306848211.jpg', '2024-10-05 06:09:51', '2024-10-05 07:06:01'),
(10, 6, 'Sayur Asem', 7000, 99, 'menu-1663051735.jpeg', '2024-10-05 06:10:28', '2024-10-05 06:41:53'),
(11, 1, 'Espreso', 25000, 98, 'menu-1924659814.jpg', '2024-10-05 06:32:10', '2025-01-12 14:36:35'),
(12, 6, 'Pecel Lele', 12000, 47, 'menu-757018905.jpeg', '2024-10-05 06:35:45', '2024-10-05 07:06:01'),
(13, 1, 'Macchiato', 25000, 25, 'menu-1387414818.jpeg', '2024-10-05 06:37:43', '2025-01-12 14:36:51'),
(14, 1, 'Americano', 28000, 35, 'menu-1916866375.jpeg', '2024-10-05 06:38:31', '2025-01-12 14:36:51');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int(11) NOT NULL,
  `kd_trans` varchar(30) NOT NULL,
  `user_id` int(11) NOT NULL,
  `nm_pelanggan` varchar(100) NOT NULL,
  `tgl_trans` date NOT NULL,
  `jam` time NOT NULL,
  `total_trans` int(11) NOT NULL,
  `total_bayar` int(11) NOT NULL,
  `kembalian` int(11) NOT NULL,
  `tgl_dibuat` timestamp NOT NULL DEFAULT current_timestamp(),
  `tgl_diubah` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id`, `kd_trans`, `user_id`, `nm_pelanggan`, `tgl_trans`, `jam`, `total_trans`, `total_bayar`, `kembalian`, `tgl_dibuat`, `tgl_diubah`) VALUES
(59, 'TRS-20241005399', 1, 'Dian', '2024-10-05', '13:05:51', 15000, 15000, 0, '2024-10-05 06:06:03', '2024-10-05 06:06:03'),
(60, 'TRS-20241005668', 1, 'Yusuf', '2024-10-05', '13:10:35', 41000, 50000, 9000, '2024-10-05 06:11:53', '2024-10-05 06:11:53'),
(61, 'TRS-2024100594', 1, 'Yayan', '2024-10-05', '13:40:26', 78000, 100000, 22000, '2024-10-05 06:40:42', '2024-10-05 06:40:42'),
(63, 'TRS-20241005232', 1, 'Maya', '2024-10-05', '14:05:37', 35000, 100000, 65000, '2024-10-05 07:06:01', '2024-10-05 07:06:01'),
(64, 'TRS-20241005235', 1, 'De', '2024-10-05', '14:54:47', 28000, 1000000, 692000, '2024-10-05 07:56:12', '2024-10-05 07:56:12'),
(65, 'TRS-20241005274', 1, 'Dede', '2024-10-05', '15:24:49', 28000, 30000, 2000, '2024-10-05 08:25:23', '2024-10-05 08:25:23'),
(67, 'TRS-20241005491', 1, 'Awd', '2024-10-05', '15:27:10', 28000, 30000, 2000, '2024-10-05 08:27:33', '2024-10-05 08:27:33'),
(68, 'TRS-20241005409', 1, 'Dani', '2024-10-05', '15:30:38', 28000, 30000, 2000, '2024-10-05 08:31:16', '2024-10-05 08:31:16'),
(69, 'TRS-2024102557', 1, 'Mayasari', '2024-10-25', '14:10:11', 53000, 100000, 47000, '2024-10-25 07:32:03', '2024-10-25 07:32:03'),
(70, 'TRS-2025010835', 3, 'Dede', '2025-01-08', '15:48:57', 81000, 100000, 19000, '2025-01-08 08:49:24', '2025-01-08 08:49:24'),
(71, 'TRS-20250112227', 3, 'Dinda', '2025-01-12', '21:35:44', 28000, 30000, 2000, '2025-01-12 14:35:56', '2025-01-12 14:35:56'),
(72, 'TRS-20250112233', 3, 'Dinda', '2025-01-12', '21:36:26', 25000, 30000, 5000, '2025-01-12 14:36:35', '2025-01-12 14:36:35'),
(73, 'TRS-20250112410', 3, 'Yani', '2025-01-12', '21:36:26', 53000, 60000, 7000, '2025-01-12 14:36:51', '2025-01-12 14:36:51');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi_list`
--

CREATE TABLE `transaksi_list` (
  `id` int(11) NOT NULL,
  `kd_trans` varchar(30) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `total_harga` int(11) NOT NULL,
  `tgl_dibuat` timestamp NOT NULL DEFAULT current_timestamp(),
  `tgl_diubah` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `transaksi_list`
--

INSERT INTO `transaksi_list` (`id`, `kd_trans`, `menu_id`, `harga`, `qty`, `total_harga`, `tgl_dibuat`, `tgl_diubah`) VALUES
(78, 'TRS-20241005399', 1, 15000, 1, 15000, '2024-10-05 06:06:03', '2024-10-05 06:06:03'),
(79, 'TRS-20241005668', 9, 8000, 2, 16000, '2024-10-05 06:11:53', '2024-10-05 06:11:53'),
(80, 'TRS-20241005668', 1, 15000, 1, 15000, '2024-10-05 06:11:53', '2024-10-05 06:11:53'),
(81, 'TRS-20241005668', 2, 10000, 1, 10000, '2024-10-05 06:11:53', '2024-10-05 06:11:53'),
(82, 'TRS-2024100594', 14, 28000, 1, 28000, '2024-10-05 06:40:42', '2024-10-05 06:40:42'),
(83, 'TRS-2024100594', 13, 25000, 1, 25000, '2024-10-05 06:40:42', '2024-10-05 06:40:42'),
(84, 'TRS-2024100594', 11, 25000, 1, 25000, '2024-10-05 06:40:42', '2024-10-05 06:40:42'),
(89, 'TRS-20241005232', 9, 8000, 1, 8000, '2024-10-05 07:06:01', '2024-10-05 07:06:01'),
(90, 'TRS-20241005232', 12, 12000, 1, 12000, '2024-10-05 07:06:01', '2024-10-05 07:06:01'),
(91, 'TRS-20241005232', 1, 15000, 1, 15000, '2024-10-05 07:06:01', '2024-10-05 07:06:01'),
(92, 'TRS-20241005235', 14, 28000, 1, 28000, '2024-10-05 07:56:12', '2024-10-05 07:56:12'),
(93, 'TRS-20241005274', 14, 28000, 1, 28000, '2024-10-05 08:25:23', '2024-10-05 08:25:23'),
(95, 'TRS-20241005491', 14, 28000, 1, 28000, '2024-10-05 08:27:33', '2024-10-05 08:27:33'),
(96, 'TRS-20241005409', 14, 28000, 1, 28000, '2024-10-05 08:31:16', '2024-10-05 08:31:16'),
(97, 'TRS-2024102557', 14, 28000, 1, 28000, '2024-10-25 07:32:03', '2024-10-25 07:32:03'),
(98, 'TRS-2024102557', 13, 25000, 1, 25000, '2024-10-25 07:32:03', '2024-10-25 07:32:03'),
(99, 'TRS-2025010835', 14, 28000, 2, 56000, '2025-01-08 08:49:24', '2025-01-08 08:49:24'),
(100, 'TRS-2025010835', 13, 25000, 1, 25000, '2025-01-08 08:49:24', '2025-01-08 08:49:24'),
(101, 'TRS-20250112227', 14, 28000, 1, 28000, '2025-01-12 14:35:56', '2025-01-12 14:35:56'),
(102, 'TRS-20250112233', 11, 25000, 1, 25000, '2025-01-12 14:36:35', '2025-01-12 14:36:35'),
(103, 'TRS-20250112410', 14, 28000, 1, 28000, '2025-01-12 14:36:51', '2025-01-12 14:36:51'),
(104, 'TRS-20250112410', 13, 25000, 1, 25000, '2025-01-12 14:36:51', '2025-01-12 14:36:51');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nm_lengkap` varchar(100) NOT NULL DEFAULT 'guest',
  `alamat` varchar(255) NOT NULL DEFAULT '-',
  `nohp` varchar(15) NOT NULL DEFAULT '-',
  `jk` enum('Laki-Laki','Perempuan') NOT NULL DEFAULT 'Laki-Laki',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `nm_lengkap`, `alamat`, `nohp`, `jk`, `created_at`, `updated_at`) VALUES
(1, 'Nadya Astrid S', 'Cihideung, Tasikmalaya', '087878872812', 'Perempuan', '2024-09-21 16:01:34', '2024-10-05 06:50:38'),
(3, 'Zidan Ramadhan', 'Kertaharja, Ciamis', '0878788728123', 'Laki-Laki', '2024-09-30 05:09:40', '2024-10-05 06:14:27'),
(5, 'Sukma Eka', 'Cihideung, Tasikmalaya', '087633123817', 'Perempuan', '2024-09-30 05:26:41', '2024-09-30 05:26:51'),
(6, 'Admin', 'Tasikmalaya', '081234567890', 'Laki-Laki', '2025-01-14 12:20:22', '2025-01-14 12:20:22');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_autentikasi`
--

CREATE TABLE `user_autentikasi` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(150) NOT NULL,
  `pass` varchar(100) NOT NULL,
  `role` enum('admin','kasir') NOT NULL DEFAULT 'admin',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user_autentikasi`
--

INSERT INTO `user_autentikasi` (`id`, `user_id`, `username`, `password`, `pass`, `role`, `created_at`, `updated_at`) VALUES
(1, 1, 'nadia', '$2y$10$2W0.E/42xY4CXPJPcr6N4.8ctxcKsh41ZMqG6abAkrJSB8y5LMSTq', 'nadia', 'admin', '2024-09-21 09:06:15', '2025-01-12 13:53:16'),
(2, 3, 'zidan', '$2y$10$mYEoKS19q7AzcLnEE7CxBewqC0xHs1dAnN6akZL8AauLBsF9FHqGC', 'zidan', 'admin', '2024-09-30 05:09:40', '2024-09-30 05:09:40'),
(4, 5, 'sukma', '$2y$10$83JrDvi7amccuwfv8M9tXuP3X84nKqLaB4.J7rksr.0HZzWLOLRTO', 'sukma', 'kasir', '2024-09-30 05:26:41', '2024-10-04 14:12:49'),
(5, 6, 'admin', '$2y$10$xMXLLyWw4bJG6AeLQESiK.6bVJpRtcvf4JrdRaCMAg7rvXstOlBq6', 'admin', 'admin', '2025-01-14 12:20:22', '2025-01-14 12:20:22');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `transaksi_list`
--
ALTER TABLE `transaksi_list`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_autentikasi`
--
ALTER TABLE `user_autentikasi`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT untuk tabel `transaksi_list`
--
ALTER TABLE `transaksi_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `user_autentikasi`
--
ALTER TABLE `user_autentikasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
