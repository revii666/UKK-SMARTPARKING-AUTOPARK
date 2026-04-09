-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 09 Apr 2026 pada 08.35
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
-- Database: `smart_parking`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int(11) NOT NULL,
  `card_id` varchar(50) NOT NULL,
  `checkin_time` datetime DEFAULT NULL,
  `checkout_time` datetime DEFAULT NULL,
  `duration` int(11) DEFAULT NULL,
  `fee` int(11) DEFAULT NULL,
  `status` enum('IN','OUT','DONE') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id`, `card_id`, `checkin_time`, `checkout_time`, `duration`, `fee`, `status`) VALUES
(40, '8C1C37', '2026-04-08 14:10:46', '2026-04-08 14:11:02', 1, 2000, 'DONE'),
(41, '4BFF17', '2026-04-08 14:22:34', '2026-04-08 14:22:43', 1, 2000, 'DONE'),
(42, '8C1C37', '2026-04-08 14:47:32', '2026-04-08 14:47:52', 1, 2000, 'DONE'),
(43, '8C1C37', '2026-04-08 14:48:26', '2026-04-08 14:48:37', 1, 2000, 'DONE'),
(44, '4BFF17', '2026-04-08 14:50:48', '2026-04-08 14:51:59', 1, 2000, 'DONE'),
(45, '8C1C37', '2026-04-08 14:53:42', '2026-04-08 14:53:51', 1, 2000, 'DONE'),
(46, '8C1C37', '2026-04-08 15:03:42', '2026-04-08 15:04:12', 1, 2000, 'DONE'),
(47, '8C1C37', '2026-04-08 15:04:28', '2026-04-08 15:04:39', 1, 2000, 'DONE'),
(48, 'E95AF26', '2026-04-09 12:40:06', '2026-04-09 12:40:35', 1, 2000, 'DONE'),
(49, 'E95AF26', '2026-04-09 12:41:04', '2026-04-09 12:41:15', 1, 2000, 'DONE'),
(50, 'D95D6A6', '2026-04-09 12:41:40', '2026-04-09 12:42:06', 1, 2000, 'DONE'),
(51, 'E95AF26', '2026-04-09 12:57:17', '2026-04-09 12:57:53', 1, 2000, 'DONE'),
(52, 'E95AF26', '2026-04-09 12:58:47', '2026-04-09 12:59:04', 1, 2000, 'DONE'),
(53, '45E2F26', '2026-04-09 13:23:36', '2026-04-09 13:23:50', 1, 2000, 'DONE'),
(54, '9C896A6', '2026-04-09 13:25:03', '2026-04-09 13:25:18', 1, 2000, 'DONE'),
(55, 'E95AF26', '2026-04-09 13:32:01', '2026-04-09 13:32:31', 1, 2000, 'OUT');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
(1, 'petugas', '12345', 'petugas');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
