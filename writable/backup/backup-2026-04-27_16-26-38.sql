-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: db_fixschool
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `jenis_pelapor`
--

DROP TABLE IF EXISTS `jenis_pelapor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jenis_pelapor` (
  `id_jenis` int(11) NOT NULL AUTO_INCREMENT,
  `nama_jenis` varchar(50) NOT NULL,
  PRIMARY KEY (`id_jenis`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jenis_pelapor`
--

LOCK TABLES `jenis_pelapor` WRITE;
/*!40000 ALTER TABLE `jenis_pelapor` DISABLE KEYS */;
INSERT INTO `jenis_pelapor` VALUES (1,'Guru'),(2,'Siswa'),(3,'Staff'),(4,'Lainnya');
/*!40000 ALTER TABLE `jenis_pelapor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notifikasi`
--

DROP TABLE IF EXISTS `notifikasi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notifikasi` (
  `id_notifikasi` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) DEFAULT NULL,
  `pesan` text DEFAULT NULL,
  `status` enum('belum','sudah') DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `tanggal` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id_notifikasi`),
  KEY `id_user` (`id_user`),
  CONSTRAINT `notifikasi_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notifikasi`
--

LOCK TABLES `notifikasi` WRITE;
/*!40000 ALTER TABLE `notifikasi` DISABLE KEYS */;
INSERT INTO `notifikasi` VALUES (3,3,'Anda mendapatkan tugas baru!','sudah',NULL,'2026-04-16 11:57:16'),(4,3,'Anda mendapatkan tugas baru!','sudah',NULL,'2026-04-16 11:58:28'),(5,3,'Anda mendapatkan tugas baru','sudah',NULL,'2026-04-16 12:59:02'),(8,NULL,'Pengaduan Anda sedang diproses','belum',NULL,'2026-04-18 13:12:42'),(11,3,'Anda mendapatkan tugas baru','sudah',NULL,'2026-04-19 00:13:47'),(14,NULL,'Pengaduan Anda sedang diproses','belum',NULL,'2026-04-20 11:31:52'),(19,3,'Anda mendapatkan tugas baru','belum',NULL,'2026-04-20 13:52:33'),(24,NULL,'Pengaduan Anda sedang diproses','belum',NULL,'2026-04-20 22:54:28'),(25,3,'Anda mendapatkan tugas baru','belum',NULL,'2026-04-20 22:54:39'),(36,3,'Anda mendapatkan tugas baru','belum',NULL,'2026-04-24 22:35:54'),(47,NULL,'Pengaduan Anda sedang diproses','belum',NULL,'2026-04-26 13:06:11'),(48,NULL,'Pengaduan Anda sedang diproses','belum',NULL,'2026-04-26 13:06:33'),(49,3,'Anda mendapatkan tugas baru','belum',NULL,'2026-04-26 13:06:52'),(60,1,'Pengaduan baru telah dibuat','belum',NULL,'2026-04-27 15:29:56'),(61,NULL,'Pengaduan Anda sedang diproses','belum',NULL,'2026-04-27 16:15:31'),(62,3,'Anda mendapatkan tugas baru','belum',NULL,'2026-04-27 16:15:43'),(63,1,'Status penugasan diperbarui menjadi: dikerjakan','belum',NULL,'2026-04-27 16:17:47'),(64,1,'Status penugasan diperbarui menjadi: dikerjakan','belum',NULL,'2026-04-27 16:18:02'),(65,NULL,'Pengaduan Anda sedang diproses','belum',NULL,'2026-04-27 16:20:00'),(66,7,'Pengaduan Anda telah selesai','belum',NULL,'2026-04-27 16:20:56'),(67,1,'Status penugasan diperbarui menjadi: selesai','belum',NULL,'2026-04-27 16:20:56'),(68,NULL,'Pengaduan Anda sedang diproses','belum',NULL,'2026-04-27 16:22:01');
/*!40000 ALTER TABLE `notifikasi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pengaduan`
--

DROP TABLE IF EXISTS `pengaduan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pengaduan` (
  `id_pengaduan` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) DEFAULT NULL,
  `judul` varchar(150) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `lokasi` varchar(100) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `status` enum('menunggu','diproses','selesai','ditolak') DEFAULT 'menunggu',
  `tanggal` datetime DEFAULT current_timestamp(),
  `alasan_ditolak` text NOT NULL,
  PRIMARY KEY (`id_pengaduan`),
  KEY `id_user` (`id_user`),
  CONSTRAINT `pengaduan_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pengaduan`
--

LOCK TABLES `pengaduan` WRITE;
/*!40000 ALTER TABLE `pengaduan` DISABLE KEYS */;
INSERT INTO `pengaduan` VALUES (22,7,'Kursi Bosok','yeuh beneran, sok','Lab Komputer SMK','1777278596_e8104c9cd11af3b738b5.jpg','diproses','2026-04-27 15:29:56','');
/*!40000 ALTER TABLE `pengaduan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `penugasan`
--

DROP TABLE IF EXISTS `penugasan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `penugasan` (
  `id_penugasan` int(11) NOT NULL AUTO_INCREMENT,
  `id_pengaduan` int(11) DEFAULT NULL,
  `id_tanggapan` int(11) DEFAULT NULL,
  `id_teknisi` int(11) DEFAULT NULL,
  `status` enum('ditugaskan','dikerjakan','selesai') DEFAULT NULL,
  `foto_bukti` varchar(255) DEFAULT NULL,
  `tanggal` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id_penugasan`),
  KEY `id_pengaduan` (`id_pengaduan`),
  KEY `id_tanggapan` (`id_tanggapan`),
  KEY `id_teknisi` (`id_teknisi`),
  CONSTRAINT `penugasan_ibfk_1` FOREIGN KEY (`id_pengaduan`) REFERENCES `pengaduan` (`id_pengaduan`),
  CONSTRAINT `penugasan_ibfk_2` FOREIGN KEY (`id_tanggapan`) REFERENCES `tanggapan` (`id_tanggapan`),
  CONSTRAINT `penugasan_ibfk_3` FOREIGN KEY (`id_teknisi`) REFERENCES `users` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `penugasan`
--

LOCK TABLES `penugasan` WRITE;
/*!40000 ALTER TABLE `penugasan` DISABLE KEYS */;
INSERT INTO `penugasan` VALUES (11,22,NULL,3,'selesai','1777281656_5885fa695be134bd2778.jpg','2026-04-27 16:15:43');
/*!40000 ALTER TABLE `penugasan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `support`
--

DROP TABLE IF EXISTS `support`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `support` (
  `id_support` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) DEFAULT NULL,
  `judul` varchar(255) DEFAULT NULL,
  `pesan` text DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id_support`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `support`
--

LOCK TABLES `support` WRITE;
/*!40000 ALTER TABLE `support` DISABLE KEYS */;
INSERT INTO `support` VALUES (1,4,'tweuuwjs','321361','closed','2026-04-22 06:08:47'),(2,4,'tweuuwjs','321361','closed','2026-04-22 06:09:09'),(3,4,'hai','hai','open','2026-04-23 11:49:03'),(4,4,'fiof','woi','open','2026-04-26 13:02:22'),(5,6,'akun gw sampah','sddaw','closed','2026-04-26 13:12:37');
/*!40000 ALTER TABLE `support` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `support_reply`
--

DROP TABLE IF EXISTS `support_reply`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `support_reply` (
  `id_reply` int(11) NOT NULL AUTO_INCREMENT,
  `id_support` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `pesan` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id_reply`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `support_reply`
--

LOCK TABLES `support_reply` WRITE;
/*!40000 ALTER TABLE `support_reply` DISABLE KEYS */;
INSERT INTO `support_reply` VALUES (1,2,1,'kfjoiwer3w','2026-04-22 06:25:45'),(2,1,1,'sndaa','2026-04-22 06:25:54'),(3,2,4,'huuh siap','2026-04-22 07:04:03'),(4,2,4,'woi min','2026-04-23 04:34:55'),(5,2,1,'naon euy','2026-04-23 11:48:07'),(6,5,1,'naon woi','2026-04-26 13:13:49');
/*!40000 ALTER TABLE `support_reply` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `support_ticket`
--

DROP TABLE IF EXISTS `support_ticket`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `support_ticket` (
  `id_ticket` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) DEFAULT NULL,
  `judul` varchar(255) DEFAULT NULL,
  `pesan` text DEFAULT NULL,
  `status` enum('open','diproses','selesai') DEFAULT 'open',
  `created_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id_ticket`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `support_ticket`
--

LOCK TABLES `support_ticket` WRITE;
/*!40000 ALTER TABLE `support_ticket` DISABLE KEYS */;
INSERT INTO `support_ticket` VALUES (1,4,'tes','12135','open','2026-04-22 11:11:17'),(2,1,'','','open','2026-04-22 11:20:09'),(3,1,'','','open','2026-04-22 11:20:16');
/*!40000 ALTER TABLE `support_ticket` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tanggapan`
--

DROP TABLE IF EXISTS `tanggapan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tanggapan` (
  `id_tanggapan` int(11) NOT NULL AUTO_INCREMENT,
  `id_pengaduan` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `isi_tanggapan` text DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `tanggal` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id_tanggapan`),
  KEY `id_pengaduan` (`id_pengaduan`),
  KEY `id_user` (`id_user`),
  CONSTRAINT `tanggapan_ibfk_1` FOREIGN KEY (`id_pengaduan`) REFERENCES `pengaduan` (`id_pengaduan`) ON DELETE CASCADE,
  CONSTRAINT `tanggapan_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tanggapan`
--

LOCK TABLES `tanggapan` WRITE;
/*!40000 ALTER TABLE `tanggapan` DISABLE KEYS */;
INSERT INTO `tanggapan` VALUES (14,22,1,'akan saya langsung proses yaa',NULL,'2026-04-27 16:15:31'),(15,22,1,'Kursi sedang dikerjakan yaa','1777281600_2729050d29caf430f607.jpg','2026-04-27 16:20:00'),(16,22,1,'Telah diperbaiki yaa','1777281721_c23b0ed91fd8c5780e86.jpg','2026-04-27 16:22:01');
/*!40000 ALTER TABLE `tanggapan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('admin','teknisi','pelapor') DEFAULT 'pelapor',
  `foto` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `id_jenis` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_user`),
  KEY `fk_users_jenis` (`id_jenis`),
  CONSTRAINT `fk_users_jenis` FOREIGN KEY (`id_jenis`) REFERENCES `jenis_pelapor` (`id_jenis`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Atmin Real',NULL,'real_admin','$2y$10$zMK6iiH4U9dt3vDy.h.2pO0kg6b9jD4XrUpN.nW7cZZNmZeszrr1K','admin','1777199148_b488b88b868f368a84ba.jpg','2026-04-11 17:27:43',NULL),(3,'Jamboadz',NULL,'teknisi_jamz','$2y$10$hTmBZ5JfDKFVVsVgkLkAVuZGEp3AQRffpN.PiLntIqa5ujPriDOMO','teknisi','1777199173_d67b6c23f88d39c551e7.jpg','2026-04-11 17:53:27',NULL),(7,'Ahmad Mauludin',NULL,'ahmad','$2y$10$zynB3YUr5m/BYr6F8wFm4ejWcb2qtCqc7Dh6H5f4xBX03cQei6hru','pelapor','1777277533_bbd44cdc0b7cf339f874.jpg','2026-04-27 08:12:13',1);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-04-27 16:26:38
