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
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notifikasi`
--

LOCK TABLES `notifikasi` WRITE;
/*!40000 ALTER TABLE `notifikasi` DISABLE KEYS */;
INSERT INTO `notifikasi` VALUES (1,2,'Pengaduan Anda telah selesai dikerjakan','sudah',NULL,'2026-04-16 11:16:21'),(2,2,'Pengaduan ditolak: teu puguh','sudah',NULL,'2026-04-16 11:56:05'),(3,3,'Anda mendapatkan tugas baru!','sudah',NULL,'2026-04-16 11:57:16'),(4,3,'Anda mendapatkan tugas baru!','sudah',NULL,'2026-04-16 11:58:28'),(5,3,'Anda mendapatkan tugas baru','sudah',NULL,'2026-04-16 12:59:02'),(6,2,'Pengaduan Anda telah selesai','sudah',NULL,'2026-04-16 13:15:55'),(7,2,'Pengaduan Anda telah selesai','sudah',NULL,'2026-04-18 09:55:40'),(8,NULL,'Pengaduan Anda sedang diproses','belum',NULL,'2026-04-18 13:12:42'),(9,4,'Pengaduan ditolak: koplok teh, pan geus puguh ngaran aplikasi na oge fix school, lain repair hp plok sateh','sudah',NULL,'2026-04-18 13:13:33'),(10,4,'Pengaduan ditolak: ingkah kaditu ah, hariwang','sudah',NULL,'2026-04-18 23:24:54'),(11,3,'Anda mendapatkan tugas baru','sudah',NULL,'2026-04-19 00:13:47'),(12,1,'Pengaduan baru telah dibuat','sudah',NULL,'2026-04-18 17:33:25'),(13,2,'Pengaduan ditolak: aya aya wae','sudah',NULL,'2026-04-20 11:29:05'),(14,NULL,'Pengaduan Anda sedang diproses','belum',NULL,'2026-04-20 11:31:52'),(15,1,'Status penugasan diperbarui menjadi: ditugaskan','sudah',NULL,'2026-04-20 04:41:15'),(16,1,'Status penugasan diperbarui menjadi: ditugaskan','sudah',NULL,'2026-04-20 04:41:21'),(17,1,'Status penugasan diperbarui menjadi: ditugaskan','sudah',NULL,'2026-04-20 04:41:27'),(18,1,'Pengaduan baru telah dibuat','sudah',NULL,'2026-04-20 06:51:51'),(19,3,'Anda mendapatkan tugas baru','belum',NULL,'2026-04-20 13:52:33'),(20,1,'Status penugasan diperbarui menjadi: ditugaskan','sudah',NULL,'2026-04-20 06:53:13'),(21,1,'Pengaduan baru telah dibuat','sudah',NULL,'2026-04-20 15:47:40'),(22,4,'Pengaduan ditolak: gaje','belum',NULL,'2026-04-20 22:50:53'),(23,1,'Pengaduan baru telah dibuat','belum',NULL,'2026-04-20 15:53:17'),(24,NULL,'Pengaduan Anda sedang diproses','belum',NULL,'2026-04-20 22:54:28'),(25,3,'Anda mendapatkan tugas baru','belum',NULL,'2026-04-20 22:54:39'),(26,1,'Status penugasan diperbarui menjadi: dikerjakan','belum',NULL,'2026-04-20 15:55:52'),(27,4,'Pengaduan Anda telah selesai','belum',NULL,'2026-04-20 22:56:41'),(28,1,'Status penugasan diperbarui menjadi: selesai','belum',NULL,'2026-04-20 15:56:41'),(29,1,'Pengaduan baru telah dibuat','belum',NULL,'2026-04-21 06:21:04');
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
  `id_jenis` int(11) DEFAULT NULL,
  `judul` varchar(150) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `lokasi` varchar(100) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `status` enum('menunggu','diproses','selesai','ditolak') DEFAULT 'menunggu',
  `tanggal` date DEFAULT NULL,
  `alasan_ditolak` text NOT NULL,
  PRIMARY KEY (`id_pengaduan`),
  KEY `id_user` (`id_user`),
  KEY `id_jenis` (`id_jenis`),
  CONSTRAINT `pengaduan_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE,
  CONSTRAINT `pengaduan_ibfk_2` FOREIGN KEY (`id_jenis`) REFERENCES `jenis_pelapor` (`id_jenis`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pengaduan`
--

LOCK TABLES `pengaduan` WRITE;
/*!40000 ALTER TABLE `pengaduan` DISABLE KEYS */;
INSERT INTO `pengaduan` VALUES (1,2,2,'Kursi Bosok','Tos rareyod korsi teh geus wayahna di omean, jelema nu ngadiukan na oge teu nyaman otomatis ngaganggu kana aktipitas, cik omean nya!','Kelas XII','1775974786_3174912535d45e01f890.jpg','selesai','2026-04-12','0'),(2,2,4,'Kursi Bosok','Tos rareyod korsi teh geus wayahna di omean, jelema nu ngadiukan na oge teu nyaman otomatis ngaganggu kana aktipitas, cik omean nya!','Kelas XII','1775975215_62c6fbae15783e76a415.jpg','ditolak','2026-04-12','apalah'),(3,2,2,'AC Lab butut','bocor wae, lantainya jadi bau kaki ','Lab Komputer SMK','1776219253_3832e7e37da48f81973b.jpg','selesai','2026-04-15','0'),(6,2,4,'tes','2323214124123213','tes XII','1776313206_6e8ec55e485f2dbf5672.jpg','ditolak','2026-04-16','aya aya wae'),(8,4,3,'Hape Butut','hape urang ruksak mang, pang benerankeun atuh','Kediaman cecep','1776492624_f564f1c1eee60eb65273.jpg','ditolak','2026-04-18','koplok teh, pan geus puguh ngaran aplikasi na oge fix school, lain repair hp plok sateh'),(10,4,2,'Layar Monitor PC 4','P Layarnya agak ada glitch mengganggu, dan terkadang layar mati lalu hidup kembali dan itu sangat mengganggu terutama disaat pengerjaan aplikasi','Lab Komputer SMK','1776533605_396da756b0afad0f90ee.jpg','diproses',NULL,''),(11,4,2,'Paqih','aman sih','Kediaman paqih','1776667911_f98c868e2e9b35e8d7e7.jpg','diproses',NULL,''),(13,4,2,'Dinding kotor','tolong dicat kembali','Kelas XII','1776700397_662f7d20b6c4fbc7c2b8.png','selesai',NULL,''),(14,4,2,'Info','hayang nyapa admin weeee','Kediaman paqih',NULL,'menunggu',NULL,'');
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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `penugasan`
--

LOCK TABLES `penugasan` WRITE;
/*!40000 ALTER TABLE `penugasan` DISABLE KEYS */;
INSERT INTO `penugasan` VALUES (1,1,2,3,'selesai','1776310510_02e6eddb04f1efcf01fd.jpg','2026-04-15 08:54:08'),(2,3,NULL,3,'ditugaskan','1776320155_16a3fe66736866343268.jpg','2026-04-15 09:41:57'),(6,6,NULL,3,'ditugaskan','1776532564_2efadc9e1c9aa195790a.jpg','2026-04-19 00:13:47'),(7,11,NULL,3,'ditugaskan','1776667993_367191e811d39bee9ffa.jpg','2026-04-20 13:52:33'),(8,13,NULL,3,'selesai',NULL,'2026-04-20 22:54:39');
/*!40000 ALTER TABLE `penugasan` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tanggapan`
--

LOCK TABLES `tanggapan` WRITE;
/*!40000 ALTER TABLE `tanggapan` DISABLE KEYS */;
INSERT INTO `tanggapan` VALUES (2,1,1,'ke kedapoo',NULL,'2026-04-15 08:46:03'),(9,8,1,'koplok teh, pan geus puguh ngaran aplikasi na oge fix school, lain repair hp plok sateh','1776492762_75a48b0a6379da7c685d.png','2026-04-18 13:12:42'),(10,10,1,'baik laporan anda telah diterima, mohon ditunggu info selanjutnya',NULL,'2026-04-20 11:31:52'),(11,13,1,'sabar',NULL,'2026-04-20 22:54:28');
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
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin',NULL,'admin','$2y$10$zMK6iiH4U9dt3vDy.h.2pO0kg6b9jD4XrUpN.nW7cZZNmZeszrr1K','admin','1776304369_34947b3d54a1bdb91c22.png','2026-04-11 17:27:43'),(2,'pelapor',NULL,'pelapor','$2y$10$Lms5Tw3g86uiBPvFEay30ewDVss7FYwDD0a2QNYkLyrDpZa7Gwq/e','pelapor','1775929967_278f8f13b52843fe0210.jpg','2026-04-11 17:52:47'),(3,'teknisi',NULL,'teknisi','$2y$10$hTmBZ5JfDKFVVsVgkLkAVuZGEp3AQRffpN.PiLntIqa5ujPriDOMO','teknisi','1775930007_8c0a5205611f0d9f4c51.jpg','2026-04-11 17:53:27'),(4,'Paqih PKL',NULL,'hikap','$2y$10$Xn.l973KyIkfVKahZJdPWOmBvrTkLwrFxMWzDlVeia9cBLeGuL.qO','pelapor','1776492474_c591346c490a0675d30a.jpg','2026-04-18 06:07:54');
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

-- Dump completed on 2026-04-21 13:36:09
