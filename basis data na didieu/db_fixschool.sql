-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 26 Apr 2026 pada 12.28
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
(49, 3, 'Anda mendapatkan tugas baru', 'belum', NULL, '2026-04-26 13:06:52');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengaduan`
--

CREATE TABLE `pengaduan` (
  `id_pengaduan` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_jenis` int(11) DEFAULT NULL,
  `judul` varchar(150) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `lokasi` varchar(100) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `status` enum('menunggu','diproses','selesai','ditolak') DEFAULT 'menunggu',
  `tanggal` datetime DEFAULT current_timestamp(),
  `alasan_ditolak` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(5, 6, 'akun gw sampah', 'sddaw', 'closed', '2026-04-26 13:12:37');

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

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('admin','teknisi','pelapor') DEFAULT 'pelapor',
  `foto` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id_user`, `nama`, `email`, `username`, `password`, `role`, `foto`, `created_at`) VALUES
(1, 'Atmin Real', NULL, 'real_admin', '$2y$10$zMK6iiH4U9dt3vDy.h.2pO0kg6b9jD4XrUpN.nW7cZZNmZeszrr1K', 'admin', '1777199148_b488b88b868f368a84ba.jpg', '2026-04-11 17:27:43'),
(3, 'Jamboadz', NULL, 'teknisi_jamz', '$2y$10$hTmBZ5JfDKFVVsVgkLkAVuZGEp3AQRffpN.PiLntIqa5ujPriDOMO', 'teknisi', '1777199173_d67b6c23f88d39c551e7.jpg', '2026-04-11 17:53:27');

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
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_jenis` (`id_jenis`);

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
  ADD PRIMARY KEY (`id_user`);

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
  MODIFY `id_notifikasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT untuk tabel `pengaduan`
--
ALTER TABLE `pengaduan`
  MODIFY `id_pengaduan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `penugasan`
--
ALTER TABLE `penugasan`
  MODIFY `id_penugasan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `support`
--
ALTER TABLE `support`
  MODIFY `id_support` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
  MODIFY `id_tanggapan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
  ADD CONSTRAINT `pengaduan_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE,
  ADD CONSTRAINT `pengaduan_ibfk_2` FOREIGN KEY (`id_jenis`) REFERENCES `jenis_pelapor` (`id_jenis`);

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
