-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 28 Apr 2026 pada 11.55
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
-- Database: `db_fixschool`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis_pelapor`
--

CREATE TABLE `jenis_pelapor` (
  `id_jenis` int(11) NOT NULL,
  `nama_jenis` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `jenis_pelapor`
--

INSERT INTO `jenis_pelapor` (`id_jenis`, `nama_jenis`) VALUES
(1, 'Guru'),
(2, 'Siswa'),
(3, 'Staff'),
(4, 'Lainnya');

-- --------------------------------------------------------

--
-- Struktur dari tabel `notifikasi`
--

CREATE TABLE `notifikasi` (
  `id_notifikasi` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `pesan` text DEFAULT NULL,
  `status` enum('belum','sudah') DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `tanggal` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `notifikasi`
--

INSERT INTO `notifikasi` (`id_notifikasi`, `id_user`, `pesan`, `status`, `foto`, `tanggal`) VALUES
(3, 3, 'Anda mendapatkan tugas baru!', 'sudah', NULL, '2026-04-16 11:57:16'),
(4, 3, 'Anda mendapatkan tugas baru!', 'sudah', NULL, '2026-04-16 11:58:28'),
(5, 3, 'Anda mendapatkan tugas baru', 'sudah', NULL, '2026-04-16 12:59:02'),
(8, NULL, 'Pengaduan Anda sedang diproses', 'belum', NULL, '2026-04-18 13:12:42'),
(11, 3, 'Anda mendapatkan tugas baru', 'sudah', NULL, '2026-04-19 00:13:47'),
(14, NULL, 'Pengaduan Anda sedang diproses', 'belum', NULL, '2026-04-20 11:31:52'),
(19, 3, 'Anda mendapatkan tugas baru', 'belum', NULL, '2026-04-20 13:52:33'),
(24, NULL, 'Pengaduan Anda sedang diproses', 'belum', NULL, '2026-04-20 22:54:28'),
(25, 3, 'Anda mendapatkan tugas baru', 'belum', NULL, '2026-04-20 22:54:39'),
(36, 3, 'Anda mendapatkan tugas baru', 'belum', NULL, '2026-04-24 22:35:54'),
(47, NULL, 'Pengaduan Anda sedang diproses', 'belum', NULL, '2026-04-26 13:06:11'),
(48, NULL, 'Pengaduan Anda sedang diproses', 'belum', NULL, '2026-04-26 13:06:33'),
(49, 3, 'Anda mendapatkan tugas baru', 'belum', NULL, '2026-04-26 13:06:52'),
(61, NULL, 'Pengaduan Anda sedang diproses', 'belum', NULL, '2026-04-27 16:15:31'),
(62, 3, 'Anda mendapatkan tugas baru', 'belum', NULL, '2026-04-27 16:15:43'),
(65, NULL, 'Pengaduan Anda sedang diproses', 'belum', NULL, '2026-04-27 16:20:00'),
(66, 7, 'Pengaduan Anda telah selesai', 'belum', NULL, '2026-04-27 16:20:56'),
(68, NULL, 'Pengaduan Anda sedang diproses', 'belum', NULL, '2026-04-27 16:22:01'),
(70, 7, 'Pengaduan Anda telah selesai', 'belum', NULL, '2026-04-27 16:30:18'),
(74, NULL, 'Pengaduan Anda sedang diproses', 'belum', NULL, '2026-04-28 08:35:19'),
(75, 8, 'Pengaduan ditolak: Pake Ai jing', 'belum', NULL, '2026-04-28 08:35:38'),
(77, 8, 'Pengaduan ditolak: gambar gajelas jembot', 'belum', NULL, '2026-04-28 10:38:43'),
(79, 8, 'Pengaduan ditolak: fsfs', 'belum', NULL, '2026-04-28 10:46:01'),
(80, 1, 'Pengaduan baru telah dibuat', 'belum', NULL, '2026-04-28 11:25:17'),
(81, 1, 'Pengaduan baru telah dibuat', 'belum', NULL, '2026-04-28 11:29:04'),
(82, 1, 'Pengaduan baru telah dibuat', 'belum', NULL, '2026-04-28 11:34:13'),
(83, 9, 'Pengaduan ditolak: hthfg', 'belum', NULL, '2026-04-28 11:36:01'),
(84, 9, 'Pengaduan ditolak: fhfh', 'belum', NULL, '2026-04-28 11:36:20'),
(85, 9, 'Pengaduan ditolak: dd', 'belum', NULL, '2026-04-28 11:36:32'),
(86, 1, 'Pengaduan baru telah dibuat', 'belum', NULL, '2026-04-28 11:37:21'),
(87, 1, 'Pengaduan baru telah dibuat', 'belum', NULL, '2026-04-28 11:44:40'),
(88, 1, 'Pengaduan baru telah dibuat', 'belum', NULL, '2026-04-28 11:56:47'),
(89, 9, 'Pengaduan ditolak: gg', 'belum', NULL, '2026-04-28 12:09:46'),
(90, 9, 'Pengaduan ditolak: dhkjidsjis', 'belum', NULL, '2026-04-28 12:09:59'),
(91, 9, 'Pengaduan ditolak: gjjh', 'belum', NULL, '2026-04-28 12:10:09'),
(92, 1, 'Pengaduan baru telah dibuat', 'belum', NULL, '2026-04-28 12:55:18'),
(93, NULL, 'Pengaduan Anda sedang diproses', 'belum', NULL, '2026-04-28 12:55:44'),
(94, 3, 'Anda mendapatkan tugas baru', 'belum', NULL, '2026-04-28 12:56:08'),
(95, 1, 'Status penugasan diperbarui menjadi: dikerjakan', 'belum', NULL, '2026-04-28 12:59:06'),
(96, 9, 'Pengaduan Anda telah selesai', 'belum', NULL, '2026-04-28 13:00:57'),
(97, 1, 'Status penugasan diperbarui menjadi: selesai', 'belum', NULL, '2026-04-28 13:00:57'),
(98, 1, 'Pengaduan baru telah dibuat', 'belum', NULL, '2026-04-28 15:35:50'),
(99, NULL, 'Pengaduan Anda sedang diproses', 'belum', NULL, '2026-04-28 15:36:23'),
(100, 9, 'Pengaduan ditolak: foto na lain plok!!!!!', 'belum', NULL, '2026-04-28 15:36:51'),
(101, NULL, 'Pengaduan Anda sedang diproses', 'belum', NULL, '2026-04-28 15:37:12'),
(102, 9, 'Pengaduan ditolak: dss', 'belum', NULL, '2026-04-28 15:37:24');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengaduan`
--

CREATE TABLE `pengaduan` (
  `id_pengaduan` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `judul` varchar(150) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `lokasi` varchar(100) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `status` enum('menunggu','diproses','selesai','ditolak') DEFAULT 'menunggu',
  `tanggal` datetime DEFAULT current_timestamp(),
  `alasan_ditolak` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pengaduan`
--

INSERT INTO `pengaduan` (`id_pengaduan`, `id_user`, `judul`, `deskripsi`, `lokasi`, `foto`, `status`, `tanggal`, `alasan_ditolak`) VALUES
(22, 7, 'Kursi Bosok', 'yeuh beneran, sok', 'Lab Komputer SMK', '1777278596_e8104c9cd11af3b738b5.jpg', 'selesai', '2026-04-27 15:29:56', ''),
(23, 8, 'Kipas Rusak', 'Ini tolong diperbaiki', 'Lab Komputer SMK', '1777339982_f833dae5f2fd13c430e1.png', 'ditolak', '2026-04-28 08:33:02', 'Pake Ai jing'),
(24, 8, 'PC Tidak Berfungsi', 'ada lah', 'Lab Komputer SMK', '1777347338_23effaef7a21bb7f850f.jpeg', 'ditolak', '2026-04-28 10:35:38', 'gambar gajelas jembot'),
(33, 9, 'Mouse Butut', 'Teu bisa dipake Scroll', 'Lab Komputer', '1777365350_75bd937d64f7c1e40794.jpg', 'ditolak', '2026-04-28 15:35:50', 'dss');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penugasan`
--

CREATE TABLE `penugasan` (
  `id_penugasan` int(11) NOT NULL,
  `id_pengaduan` int(11) DEFAULT NULL,
  `id_tanggapan` int(11) DEFAULT NULL,
  `id_teknisi` int(11) DEFAULT NULL,
  `status` enum('ditugaskan','dikerjakan','selesai') DEFAULT NULL,
  `foto_bukti` varchar(255) DEFAULT NULL,
  `tanggal` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `penugasan`
--

INSERT INTO `penugasan` (`id_penugasan`, `id_pengaduan`, `id_tanggapan`, `id_teknisi`, `status`, `foto_bukti`, `tanggal`) VALUES
(11, 22, NULL, 3, 'selesai', '1777281656_5885fa695be134bd2778.jpg', '2026-04-27 16:15:43');

-- --------------------------------------------------------

--
-- Struktur dari tabel `support`
--

CREATE TABLE `support` (
  `id_support` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `judul` varchar(255) DEFAULT NULL,
  `pesan` text DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `support`
--

INSERT INTO `support` (`id_support`, `id_user`, `judul`, `pesan`, `status`, `created_at`) VALUES
(1, 4, 'tweuuwjs', '321361', 'closed', '2026-04-22 06:08:47'),
(2, 4, 'tweuuwjs', '321361', 'closed', '2026-04-22 06:09:09'),
(3, 4, 'hai', 'hai', 'open', '2026-04-23 11:49:03'),
(4, 4, 'fiof', 'woi', 'open', '2026-04-26 13:02:22'),
(5, 6, 'akun gw sampah', 'sddaw', 'closed', '2026-04-26 13:12:37'),
(6, 8, 'Minta Naik Jabatan', 'Min jadikan gw admin baru', 'open', '2026-04-28 08:20:49');

-- --------------------------------------------------------

--
-- Struktur dari tabel `support_reply`
--

CREATE TABLE `support_reply` (
  `id_reply` int(11) NOT NULL,
  `id_support` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `pesan` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `support_reply`
--

INSERT INTO `support_reply` (`id_reply`, `id_support`, `id_user`, `pesan`, `created_at`) VALUES
(1, 2, 1, 'kfjoiwer3w', '2026-04-22 06:25:45'),
(2, 1, 1, 'sndaa', '2026-04-22 06:25:54'),
(3, 2, 4, 'huuh siap', '2026-04-22 07:04:03'),
(4, 2, 4, 'woi min', '2026-04-23 04:34:55'),
(5, 2, 1, 'naon euy', '2026-04-23 11:48:07'),
(6, 5, 1, 'naon woi', '2026-04-26 13:13:49');

-- --------------------------------------------------------

--
-- Struktur dari tabel `support_ticket`
--

CREATE TABLE `support_ticket` (
  `id_ticket` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `judul` varchar(255) DEFAULT NULL,
  `pesan` text DEFAULT NULL,
  `status` enum('open','diproses','selesai') DEFAULT 'open',
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `support_ticket`
--

INSERT INTO `support_ticket` (`id_ticket`, `id_user`, `judul`, `pesan`, `status`, `created_at`) VALUES
(1, 4, 'tes', '12135', 'open', '2026-04-22 11:11:17'),
(2, 1, '', '', 'open', '2026-04-22 11:20:09'),
(3, 1, '', '', 'open', '2026-04-22 11:20:16');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tanggapan`
--

CREATE TABLE `tanggapan` (
  `id_tanggapan` int(11) NOT NULL,
  `id_pengaduan` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `isi_tanggapan` text DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `tanggal` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tanggapan`
--

INSERT INTO `tanggapan` (`id_tanggapan`, `id_pengaduan`, `id_user`, `isi_tanggapan`, `foto`, `tanggal`) VALUES
(14, 22, 1, 'akan saya langsung proses yaa', NULL, '2026-04-27 16:15:31'),
(15, 22, 1, 'Kursi sedang dikerjakan yaa', '1777281600_2729050d29caf430f607.jpg', '2026-04-27 16:20:00'),
(16, 22, 1, 'Telah diperbaiki yaa', '1777281721_c23b0ed91fd8c5780e86.jpg', '2026-04-27 16:22:01'),
(17, 23, 1, 'Naon etamah pake Ai koplok', '1777340119_e95629c17c21a7655fee.png', '2026-04-28 08:35:19'),
(19, 33, 1, 'buta atawa kumaha?', NULL, '2026-04-28 15:36:23'),
(20, 33, 1, 'reaksi gweh:', '1777365432_bdbce868d8c77f7e2053.png', '2026-04-28 15:37:12');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `no_hp` varchar(20) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('admin','teknisi','pelapor') DEFAULT 'pelapor',
  `foto` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `id_jenis` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id_user`, `nama`, `no_hp`, `username`, `password`, `role`, `foto`, `created_at`, `id_jenis`) VALUES
(1, 'Atmin Real', '6282286869263', 'real_admin', '$2y$10$zMK6iiH4U9dt3vDy.h.2pO0kg6b9jD4XrUpN.nW7cZZNmZeszrr1K', 'admin', '1777199148_b488b88b868f368a84ba.jpg', '2026-04-11 17:27:43', NULL),
(3, 'Jambrudz', '629597960656', 'teknisi_jamz', '$2y$10$hTmBZ5JfDKFVVsVgkLkAVuZGEp3AQRffpN.PiLntIqa5ujPriDOMO', 'teknisi', '1777199173_d67b6c23f88d39c551e7.jpg', '2026-04-11 17:53:27', NULL),
(7, 'Ahmad Mauludin', '6285175017991', 'ahmad', '$2y$10$zynB3YUr5m/BYr6F8wFm4ejWcb2qtCqc7Dh6H5f4xBX03cQei6hru', 'pelapor', '1777277533_bbd44cdc0b7cf339f874.jpg', '2026-04-27 08:12:13', 1),
(8, 'Deriel Arrojab', '6276499429', 'deriel', '$2y$10$QRyocq737Whrt/pO7i9ObenkLqQVEz3pf0TfRvr6NI0cZOdo9PW3e', 'pelapor', '1777338215_5899bccbd6a122389330.jpg', '2026-04-28 01:03:35', 2),
(9, 'Nasrul Rizki Mispalah', '6281212418446', 'nasrul', '$2y$10$kYFBOWeHSqljT1H73tyBPuLLmGoJgxwxBpH1iTZikZs.E5VUXv.9a', 'pelapor', '1777343643_8635f8e03cbae31017ca.png', '2026-04-28 02:34:03', 2);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `jenis_pelapor`
--
ALTER TABLE `jenis_pelapor`
  ADD PRIMARY KEY (`id_jenis`);

--
-- Indeks untuk tabel `notifikasi`
--
ALTER TABLE `notifikasi`
  ADD PRIMARY KEY (`id_notifikasi`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `pengaduan`
--
ALTER TABLE `pengaduan`
  ADD PRIMARY KEY (`id_pengaduan`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `penugasan`
--
ALTER TABLE `penugasan`
  ADD PRIMARY KEY (`id_penugasan`),
  ADD KEY `id_pengaduan` (`id_pengaduan`),
  ADD KEY `id_tanggapan` (`id_tanggapan`),
  ADD KEY `id_teknisi` (`id_teknisi`);

--
-- Indeks untuk tabel `support`
--
ALTER TABLE `support`
  ADD PRIMARY KEY (`id_support`);

--
-- Indeks untuk tabel `support_reply`
--
ALTER TABLE `support_reply`
  ADD PRIMARY KEY (`id_reply`);

--
-- Indeks untuk tabel `support_ticket`
--
ALTER TABLE `support_ticket`
  ADD PRIMARY KEY (`id_ticket`);

--
-- Indeks untuk tabel `tanggapan`
--
ALTER TABLE `tanggapan`
  ADD PRIMARY KEY (`id_tanggapan`),
  ADD KEY `id_pengaduan` (`id_pengaduan`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `fk_users_jenis` (`id_jenis`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `jenis_pelapor`
--
ALTER TABLE `jenis_pelapor`
  MODIFY `id_jenis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `notifikasi`
--
ALTER TABLE `notifikasi`
  MODIFY `id_notifikasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT untuk tabel `pengaduan`
--
ALTER TABLE `pengaduan`
  MODIFY `id_pengaduan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT untuk tabel `penugasan`
--
ALTER TABLE `penugasan`
  MODIFY `id_penugasan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `support`
--
ALTER TABLE `support`
  MODIFY `id_support` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `support_reply`
--
ALTER TABLE `support_reply`
  MODIFY `id_reply` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `support_ticket`
--
ALTER TABLE `support_ticket`
  MODIFY `id_ticket` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tanggapan`
--
ALTER TABLE `tanggapan`
  MODIFY `id_tanggapan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `notifikasi`
--
ALTER TABLE `notifikasi`
  ADD CONSTRAINT `notifikasi_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`);

--
-- Ketidakleluasaan untuk tabel `pengaduan`
--
ALTER TABLE `pengaduan`
  ADD CONSTRAINT `pengaduan_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `penugasan`
--
ALTER TABLE `penugasan`
  ADD CONSTRAINT `penugasan_ibfk_1` FOREIGN KEY (`id_pengaduan`) REFERENCES `pengaduan` (`id_pengaduan`),
  ADD CONSTRAINT `penugasan_ibfk_2` FOREIGN KEY (`id_tanggapan`) REFERENCES `tanggapan` (`id_tanggapan`),
  ADD CONSTRAINT `penugasan_ibfk_3` FOREIGN KEY (`id_teknisi`) REFERENCES `users` (`id_user`);

--
-- Ketidakleluasaan untuk tabel `tanggapan`
--
ALTER TABLE `tanggapan`
  ADD CONSTRAINT `tanggapan_ibfk_1` FOREIGN KEY (`id_pengaduan`) REFERENCES `pengaduan` (`id_pengaduan`) ON DELETE CASCADE,
  ADD CONSTRAINT `tanggapan_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_users_jenis` FOREIGN KEY (`id_jenis`) REFERENCES `jenis_pelapor` (`id_jenis`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
