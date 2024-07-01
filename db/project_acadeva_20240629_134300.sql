-- MySQL dump 10.13  Distrib 5.5.62, for Linux (x86_64)
--
-- Host: localhost    Database: project_acadeva
-- ------------------------------------------------------
-- Server version	5.5.62-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nama_pengguna` varchar(20) NOT NULL,
  `kata_sandi` varchar(250) NOT NULL,
  `email` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` VALUES (1,'admin','$2y$10$OktPsqsUWIFSXqlDU7AETOgg8/ZomDkwS85qyFseoAlPdgmHae0tm','adminac@gmail.com');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dosen`
--

DROP TABLE IF EXISTS `dosen`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dosen` (
  `nidn` varchar(15) CHARACTER SET latin1 NOT NULL,
  `nama_pengguna` varchar(50) CHARACTER SET latin1 NOT NULL,
  `nama_lengkap` varchar(80) CHARACTER SET latin1 NOT NULL,
  `email` varchar(50) CHARACTER SET latin1 NOT NULL,
  `kata_sandi` varchar(250) CHARACTER SET latin1 NOT NULL,
  `kelamin` enum('pria','wanita') CHARACTER SET latin1 NOT NULL DEFAULT 'pria',
  `alamat` varchar(100) CHARACTER SET latin1 NOT NULL,
  `no_telpon` varchar(20) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`nidn`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dosen`
--

LOCK TABLES `dosen` WRITE;
/*!40000 ALTER TABLE `dosen` DISABLE KEYS */;
INSERT INTO `dosen` VALUES ('1122','zaki.1122','zaki ','zaki1122@gmail.com','$2y$10$mJgQDJHNfa2z7EhLEeVLj.E7MJAidwp9UYaPshEqYkY7/MFZiVd6.','pria','batam','1221122112'),('22334455','ahmadi.22334455','Ahmadi  Irmansyah Lubis','ahmadi@gmail.com','$2y$10$7IP9zNGpOrOCqeHPLyFTqu8CPMgsbMi3.wQ980vCMK1kIEMlgXkDy','pria','Batam Center','082387436427');
/*!40000 ALTER TABLE `dosen` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jadwal_ujian`
--

DROP TABLE IF EXISTS `jadwal_ujian`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jadwal_ujian` (
  `id_jadwal` int(11) NOT NULL AUTO_INCREMENT,
  `waktu_mulai` time NOT NULL,
  `tanggal` date NOT NULL,
  `waktu_selesai` time NOT NULL,
  `kode_matkul` varchar(15) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  PRIMARY KEY (`id_jadwal`),
  KEY `kode_matkul` (`kode_matkul`),
  KEY `id_kelas` (`id_kelas`),
  CONSTRAINT `jadwal_ujian_ibfk_1` FOREIGN KEY (`kode_matkul`) REFERENCES `matakuliah` (`kode_matkul`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `jadwal_ujian_ibfk_2` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jadwal_ujian`
--

LOCK TABLES `jadwal_ujian` WRITE;
/*!40000 ALTER TABLE `jadwal_ujian` DISABLE KEYS */;
INSERT INTO `jadwal_ujian` VALUES (25,'12:00:00','2024-06-26','12:22:00','PBDTRPL02',18),(26,'00:00:00','2024-06-27','23:59:00','MTKTRPL02',18),(31,'14:00:00','2024-06-28','20:00:00','PYTRPL02',18);
/*!40000 ALTER TABLE `jadwal_ujian` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kelas`
--

DROP TABLE IF EXISTS `kelas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kelas` (
  `id_kelas` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kelas` varchar(50) NOT NULL,
  `kode_prodi` varchar(10) NOT NULL,
  PRIMARY KEY (`id_kelas`),
  KEY `kode_prodi` (`kode_prodi`),
  CONSTRAINT `kelas_ibfk_1` FOREIGN KEY (`kode_prodi`) REFERENCES `prodi` (`kode_prodi`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kelas`
--

LOCK TABLES `kelas` WRITE;
/*!40000 ALTER TABLE `kelas` DISABLE KEYS */;
INSERT INTO `kelas` VALUES (18,'TRPL 2A Pagi','TRPL');
/*!40000 ALTER TABLE `kelas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mahasiswa`
--

DROP TABLE IF EXISTS `mahasiswa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mahasiswa` (
  `nim` varchar(15) NOT NULL,
  `nama_pengguna` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `nama_lengkap` varchar(80) NOT NULL,
  `kata_sandi` varchar(250) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `no_telpon` varchar(15) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `kelamin` enum('pria','wanita') NOT NULL DEFAULT 'pria',
  `semester` int(11) NOT NULL,
  PRIMARY KEY (`nim`),
  KEY `id_kelas` (`id_kelas`),
  CONSTRAINT `mahasiswa_ibfk_1` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mahasiswa`
--

LOCK TABLES `mahasiswa` WRITE;
/*!40000 ALTER TABLE `mahasiswa` DISABLE KEYS */;
INSERT INTO `mahasiswa` VALUES ('1111','zaki.1111','zaki@gmail.com','zaki ','$2y$10$jgaepMjqxK.FNak/Jm3J5ufH9gb1NBjHcBgWj0MNVfyEgi9FGZwwe','batam','11221122112','2004-01-25',18,'pria',2),('1234','demo.1234','demo@gmail.com','demo ','$2y$10$S/bgrN6d4SffWG9SqgNV1OhwOw8zC.ZiyNArEJ8ouV/vh.7GNGpnu','batam','123456789','2024-06-26',18,'pria',2),('4342301015','muhammad.4342301015','mafifalfawwaz@gmail.com','Muhammad Afif Alfawwaz','$2y$10$mfzKiMMn1KDnnAWhNk0LEuf5OMDBZbPf43VmbWpOgGN6gaVZB.QdC','Jakarta','085646643646','2024-06-19',18,'pria',2);
/*!40000 ALTER TABLE `mahasiswa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `matakuliah`
--

DROP TABLE IF EXISTS `matakuliah`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `matakuliah` (
  `kode_matkul` varchar(15) NOT NULL,
  `nama_matkul` varchar(50) NOT NULL,
  `nidn` varchar(15) NOT NULL,
  `kode_prodi` varchar(10) NOT NULL,
  PRIMARY KEY (`kode_matkul`),
  KEY `id_kelas` (`kode_prodi`),
  KEY `nidn` (`nidn`),
  CONSTRAINT `matakuliah_ibfk_2` FOREIGN KEY (`nidn`) REFERENCES `dosen` (`nidn`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `matakuliah_ibfk_3` FOREIGN KEY (`kode_prodi`) REFERENCES `prodi` (`kode_prodi`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `matakuliah`
--

LOCK TABLES `matakuliah` WRITE;
/*!40000 ALTER TABLE `matakuliah` DISABLE KEYS */;
INSERT INTO `matakuliah` VALUES ('MTKTRPL02','Matematika','22334455','TRPL'),('PBDTRPL02','Pemrograman Berbasis Data','22334455','TRPL'),('PYTRPL02','Python','1122','TRPL');
/*!40000 ALTER TABLE `matakuliah` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pilihan_jwb`
--

DROP TABLE IF EXISTS `pilihan_jwb`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pilihan_jwb` (
  `id_pilihan` int(11) NOT NULL AUTO_INCREMENT,
  `ktrngan_pilihan` varchar(100) NOT NULL,
  `benar_salah` enum('Benar','Salah') NOT NULL,
  `id_soal` int(11) NOT NULL,
  PRIMARY KEY (`id_pilihan`),
  KEY `id_soal` (`id_soal`),
  CONSTRAINT `pilihan_jwb_ibfk_1` FOREIGN KEY (`id_soal`) REFERENCES `soal_ujian` (`id_soal`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pilihan_jwb`
--

LOCK TABLES `pilihan_jwb` WRITE;
/*!40000 ALTER TABLE `pilihan_jwb` DISABLE KEYS */;
INSERT INTO `pilihan_jwb` VALUES (1,'BCNF','Benar',24),(2,'1 NF','Salah',24),(3,'UnNormalized','Salah',24),(4,'2 NF','Salah',24),(5,'3 NF','Salah',24),(6,'2','Benar',25),(7,'4','Salah',25),(8,'6','Salah',25),(9,'1','Salah',25),(10,'7','Salah',25),(11,'25','Benar',26),(12,'5','Salah',26),(13,'250000','Salah',26),(14,'Rp25000','Salah',26),(15,'1','Salah',26),(16,'0','Benar',27),(17,'12','Salah',27),(18,'283476','Salah',27),(19,'293049859','Salah',27),(20,'00,00','Salah',27),(21,'4','Benar',28),(22,'5','Salah',28),(23,'9','Salah',28),(24,'1','Salah',28),(25,'22','Salah',28),(26,'10','Benar',29),(27,'25','Salah',29),(28,'21','Salah',29),(29,'20','Salah',29),(30,'26','Salah',29),(51,'2','Benar',34),(52,'1','Salah',34),(53,'3','Salah',34),(54,'4','Salah',34),(55,'5','Salah',34),(56,'4','Benar',35),(57,'1','Salah',35),(58,'2','Salah',35),(59,'3','Salah',35),(60,'5','Salah',35);
/*!40000 ALTER TABLE `pilihan_jwb` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `prodi`
--

DROP TABLE IF EXISTS `prodi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `prodi` (
  `kode_prodi` varchar(10) NOT NULL,
  `nama_prodi` varchar(50) NOT NULL,
  PRIMARY KEY (`kode_prodi`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prodi`
--

LOCK TABLES `prodi` WRITE;
/*!40000 ALTER TABLE `prodi` DISABLE KEYS */;
INSERT INTO `prodi` VALUES ('TRPL','Teknologi Rekayasa Perangkat Lunak');
/*!40000 ALTER TABLE `prodi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rekapitulasi`
--

DROP TABLE IF EXISTS `rekapitulasi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rekapitulasi` (
  `id_rekapitulasi` int(11) NOT NULL AUTO_INCREMENT,
  `total_nilai` int(11) NOT NULL,
  `waktu_selesai` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `nim` varchar(15) NOT NULL,
  `id_sesi` int(11) NOT NULL,
  `kode_matkul` varchar(15) NOT NULL,
  PRIMARY KEY (`id_rekapitulasi`),
  KEY `id_sesi` (`id_sesi`),
  KEY `kode_matkul` (`kode_matkul`),
  KEY `nim` (`nim`),
  CONSTRAINT `rekapitulasi_ibfk_1` FOREIGN KEY (`id_sesi`) REFERENCES `sesi` (`id_sesi`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `rekapitulasi_ibfk_2` FOREIGN KEY (`kode_matkul`) REFERENCES `matakuliah` (`kode_matkul`) ON DELETE CASCADE,
  CONSTRAINT `rekapitulasi_ibfk_3` FOREIGN KEY (`nim`) REFERENCES `mahasiswa` (`nim`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rekapitulasi`
--

LOCK TABLES `rekapitulasi` WRITE;
/*!40000 ALTER TABLE `rekapitulasi` DISABLE KEYS */;
INSERT INTO `rekapitulasi` VALUES (1,100,'2024-06-26 05:20:14','1234',21,'PBDTRPL02'),(3,100,'2024-06-28 09:50:12','1111',26,'PYTRPL02');
/*!40000 ALTER TABLE `rekapitulasi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sesi`
--

DROP TABLE IF EXISTS `sesi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sesi` (
  `id_sesi` int(11) NOT NULL AUTO_INCREMENT,
  `nama_sesi` varchar(50) NOT NULL,
  `passing_grade` int(11) NOT NULL,
  `keterangan_sesi` varchar(100) NOT NULL,
  `id_jadwal` int(11) NOT NULL,
  PRIMARY KEY (`id_sesi`),
  KEY `id_jadwal` (`id_jadwal`),
  CONSTRAINT `sesi_ibfk_1` FOREIGN KEY (`id_jadwal`) REFERENCES `jadwal_ujian` (`id_jadwal`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sesi`
--

LOCK TABLES `sesi` WRITE;
/*!40000 ALTER TABLE `sesi` DISABLE KEYS */;
INSERT INTO `sesi` VALUES (21,'Materi Normalisasi',100,'Normalisasi',25),(22,'Materi 1',100,'materi 1 matematika',26),(26,'sesi 1 py',100,'sesi 1',31);
/*!40000 ALTER TABLE `sesi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `soal_ujian`
--

DROP TABLE IF EXISTS `soal_ujian`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `soal_ujian` (
  `id_soal` int(11) NOT NULL AUTO_INCREMENT,
  `soal` text NOT NULL,
  `poin` int(11) NOT NULL,
  `id_sesi` int(11) NOT NULL,
  PRIMARY KEY (`id_soal`),
  KEY `id_sesi` (`id_sesi`),
  CONSTRAINT `soal_ujian_ibfk_1` FOREIGN KEY (`id_sesi`) REFERENCES `sesi` (`id_sesi`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `soal_ujian`
--

LOCK TABLES `soal_ujian` WRITE;
/*!40000 ALTER TABLE `soal_ujian` DISABLE KEYS */;
INSERT INTO `soal_ujian` VALUES (24,'normalisasi sampai berapa NF',100,21),(25,'1 + 1 =',25,22),(26,'5 x 5 =',25,22),(27,'283476 x 0 = ',25,22),(28,'2 + 2 =',25,22),(29,'5 + 5 =',25,22),(34,'1+1',50,26),(35,'2+2',50,26);
/*!40000 ALTER TABLE `soal_ujian` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'project_acadeva'
--

--
-- Dumping routines for database 'project_acadeva'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-06-29 13:43:01
