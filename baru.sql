-- MySQL dump 10.13  Distrib 5.7.23, for Linux (i686)
--
-- Host: localhost    Database: guepedia
-- ------------------------------------------------------
-- Server version	5.7.23-0ubuntu0.16.04.1

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
-- Table structure for table `akun_penulis`
--

DROP TABLE IF EXISTS `akun_penulis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `akun_penulis` (
  `id_akun_penulis` int(11) NOT NULL AUTO_INCREMENT,
  `id_account` varchar(100) DEFAULT NULL,
  `nama_lengkap` varchar(100) DEFAULT NULL,
  `nama_pena` varchar(100) DEFAULT NULL,
  `nomor_kontak` varchar(100) DEFAULT NULL,
  `alamat_lengkap` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `nama_pemilik_rekening` varchar(100) DEFAULT NULL,
  `nomor_rekening` varchar(100) DEFAULT NULL,
  `nama_bank` varchar(100) DEFAULT NULL,
  `royalti_diperoleh` decimal(65,0) NOT NULL,
  `status_akun` varchar(100) NOT NULL,
  PRIMARY KEY (`id_akun_penulis`),
  KEY `id_account` (`id_account`)
) ENGINE=InnoDB AUTO_INCREMENT=4925 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `akun_penulis`
--

LOCK TABLES `akun_penulis` WRITE;
/*!40000 ALTER TABLE `akun_penulis` DISABLE KEYS */;
INSERT INTO `akun_penulis` VALUES (4923,'000001','Dedyibrahym','Dedy23','081289903664','Kp.Sumurwangi Kel.Kayumanis Kota Bogor','dedyibrahym23@gmail.com','21232f297a57a5a743894a0e4a801fc3',NULL,NULL,NULL,0,'aktif'),(4924,'000002','Sinta Masnah','Sinta2222','081289903664','BKIPM MANTAP','sintamasnah@gmail.com','21232f297a57a5a743894a0e4a801fc3',NULL,NULL,NULL,0,'tidak');
/*!40000 ALTER TABLE `akun_penulis` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `buku_terlaris`
--

DROP TABLE IF EXISTS `buku_terlaris`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `buku_terlaris` (
  `id_buku_terlaris` int(11) NOT NULL AUTO_INCREMENT,
  `id_file_naskah` varchar(100) NOT NULL,
  PRIMARY KEY (`id_buku_terlaris`),
  KEY `id_file_naskah` (`id_file_naskah`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `buku_terlaris`
--

LOCK TABLES `buku_terlaris` WRITE;
/*!40000 ALTER TABLE `buku_terlaris` DISABLE KEYS */;
/*!40000 ALTER TABLE `buku_terlaris` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `data_customer`
--

DROP TABLE IF EXISTS `data_customer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `data_customer` (
  `id_customer` int(11) NOT NULL AUTO_INCREMENT,
  `nama_customer` varchar(100) DEFAULT NULL,
  `nomor_kontak` varchar(100) DEFAULT NULL,
  `alamat_lengkap` text,
  PRIMARY KEY (`id_customer`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `data_customer`
--

LOCK TABLES `data_customer` WRITE;
/*!40000 ALTER TABLE `data_customer` DISABLE KEYS */;
INSERT INTO `data_customer` VALUES (1,'Dedy ibrahim','081289903664','Kp.Sumurwangi Ke.Kayumanis Kec.Tanah Sareal Kota Bogor'),(2,'Komar','08789478893','Sumurwangi Kel.Kayumanis Kec.Tanah Sareal Kota Bogor');
/*!40000 ALTER TABLE `data_customer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `data_jumlah_penjualan`
--

DROP TABLE IF EXISTS `data_jumlah_penjualan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `data_jumlah_penjualan` (
  `id_data_jumlah_penjualan` int(11) NOT NULL AUTO_INCREMENT,
  `no_invoices` varchar(100) DEFAULT NULL,
  `judul_buku` varchar(100) DEFAULT NULL,
  `id_account_penulis` varchar(100) DEFAULT NULL,
  `nama_penulis` varchar(100) DEFAULT NULL,
  `qty` varchar(100) DEFAULT NULL,
  `harga` varchar(100) DEFAULT NULL,
  `jumlah` varchar(100) DEFAULT NULL,
  `diskon` varchar(100) DEFAULT NULL,
  `nilai_diskon` varchar(100) DEFAULT NULL,
  `royalti` varchar(100) DEFAULT NULL,
  `bersih` varchar(100) DEFAULT NULL,
  `tanggal_transaksi` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_data_jumlah_penjualan`),
  KEY `no_invoices` (`no_invoices`),
  KEY `id_account_penulis` (`id_account_penulis`),
  CONSTRAINT `data_jumlah_penjualan_ibfk_1` FOREIGN KEY (`id_account_penulis`) REFERENCES `akun_penulis` (`id_account`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `data_jumlah_penjualan_ibfk_2` FOREIGN KEY (`no_invoices`) REFERENCES `data_penjualan` (`no_invoices`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `data_jumlah_penjualan`
--

LOCK TABLES `data_jumlah_penjualan` WRITE;
/*!40000 ALTER TABLE `data_jumlah_penjualan` DISABLE KEYS */;
INSERT INTO `data_jumlah_penjualan` VALUES (34,'INV/05/09/2018/000000','Ajax Jquery','000001','Dedyibrahym','6','9000','54000','0','0','8100','45900','05/09/2018'),(35,'INV/05/09/2018/000001','Ajax Jquery','000001','Dedyibrahym','2','9000','18000','0','0','2700','15300','05/09/2018'),(36,'INV/05/09/2018/000001','Membuat Laptop','000002','Sinta Masnah','2','20000','40000','0','0','6000','34000','05/09/2018'),(37,'INV/05/09/2018/000002','Membuat Laptop','000002','Sinta Masnah','3','20000','60000','0','0','9000','51000','05/09/2018'),(38,'INV/05/09/2018/000002','Ajax Jquery','000001','Dedyibrahym','4','9000','36000','0','0','5400','30600','05/09/2018');
/*!40000 ALTER TABLE `data_jumlah_penjualan` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `TAMBAHKAN ROYALTI` AFTER INSERT ON `data_jumlah_penjualan` FOR EACH ROW BEGIN 
   UPDATE akun_penulis SET royalti_diperoleh = royalti_diperoleh + NEW.royalti
   WHERE id_account = NEW.id_account_penulis;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `data_penjualan`
--

DROP TABLE IF EXISTS `data_penjualan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `data_penjualan` (
  `id_data_penjualan` int(11) NOT NULL AUTO_INCREMENT,
  `no_invoices` varchar(100) DEFAULT NULL,
  `nama_customer` varchar(100) DEFAULT NULL,
  `nomor_kontak` varchar(100) DEFAULT NULL,
  `alamat_lengkap` text,
  `jumlah_uang` varchar(100) DEFAULT NULL,
  `kembalian` varchar(100) DEFAULT NULL,
  `nama_biaya_lain` varchar(100) DEFAULT NULL,
  `jumlah_biaya_lain` varchar(100) DEFAULT NULL,
  `ppn` varchar(100) DEFAULT NULL,
  `nilai_ppn` varchar(100) DEFAULT NULL,
  `diskon_total` varchar(100) DEFAULT NULL,
  `jumlah_diskon_total` varchar(100) DEFAULT NULL,
  `total` varchar(100) DEFAULT NULL,
  `total_bersih` varchar(100) DEFAULT NULL,
  `tanggal_transaksi` varchar(100) DEFAULT NULL,
  `subtotal` varchar(100) DEFAULT NULL,
  `jumlah_diskon` varchar(100) DEFAULT NULL,
  `total_royalti` varchar(100) DEFAULT NULL,
  `bersih` varchar(100) DEFAULT NULL,
  `status_penjualan` varchar(100) DEFAULT NULL,
  `resi_pengiriman` varchar(100) NOT NULL,
  PRIMARY KEY (`id_data_penjualan`),
  KEY `no_invoices` (`no_invoices`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `data_penjualan`
--

LOCK TABLES `data_penjualan` WRITE;
/*!40000 ALTER TABLE `data_penjualan` DISABLE KEYS */;
INSERT INTO `data_penjualan` VALUES (19,'INV/05/09/2018/000000','Komar','08789478893','Sumurwangi Kel.Kayumanis Kec.Tanah Sareal Kota Bogor','63000','0','Ongkir JNE YES','9000','10',NULL,NULL,NULL,'63000','45900','05/09/2018','54000','0','8100','45900','Selesai','0089978893333'),(20,'INV/05/09/2018/000001','Dedy ibrahim','081289903664','Kp.Sumurwangi Ke.Kayumanis Kec.Tanah Sareal Kota Bogor','58000','0',NULL,NULL,'10',NULL,NULL,NULL,'58000','49300','05/09/2018','58000','0','8700','49300','Selesai','348834988274824'),(21,'INV/05/09/2018/000002','Dedy ibrahim','081289903664','Kp.Sumurwangi Ke.Kayumanis Kec.Tanah Sareal Kota Bogor','96000','0',NULL,NULL,'10','9600','10','9600','96000','81600','05/09/2018','96000','0','14400','81600','Pending','');
/*!40000 ALTER TABLE `data_penjualan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `data_transfer_royalti`
--

DROP TABLE IF EXISTS `data_transfer_royalti`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `data_transfer_royalti` (
  `id_data_transfer_royalti` int(11) NOT NULL AUTO_INCREMENT,
  `royalti` decimal(10,0) NOT NULL,
  `id_account` varchar(100) NOT NULL,
  `biaya_admin` decimal(10,0) NOT NULL,
  `royalti_bersih` decimal(10,0) NOT NULL,
  `bukti_transfer` varchar(100) NOT NULL,
  PRIMARY KEY (`id_data_transfer_royalti`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `data_transfer_royalti`
--

LOCK TABLES `data_transfer_royalti` WRITE;
/*!40000 ALTER TABLE `data_transfer_royalti` DISABLE KEYS */;
INSERT INTO `data_transfer_royalti` VALUES (2,10800,'000001',6500,4300,'64612145ac6db2f77698d971bd93f780.jpg'),(3,6000,'000002',3500,2500,'9e18a8c01fac9487efa32c4c618749ea.jpg'),(4,9000,'000002',6500,2500,'af015e819b4a7a1a63c7255a9f470743.jpg'),(5,5400,'000001',2000,3400,'3683ef45700d7fd8fb5835aa52fa5ed3.jpg');
/*!40000 ALTER TABLE `data_transfer_royalti` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `kurangi_royalti` AFTER INSERT ON `data_transfer_royalti` FOR EACH ROW BEGIN 
   UPDATE akun_penulis SET royalti_diperoleh = royalti_diperoleh - NEW.royalti
   WHERE id_account = NEW.id_account;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `file_naskah_penulis`
--

DROP TABLE IF EXISTS `file_naskah_penulis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `file_naskah_penulis` (
  `id_file_naskah` int(11) NOT NULL AUTO_INCREMENT,
  `id_account` varchar(100) DEFAULT NULL,
  `judul` varchar(100) DEFAULT NULL,
  `penulis` varchar(100) DEFAULT NULL,
  `file_naskah` varchar(100) DEFAULT NULL,
  `file_cover` varchar(100) DEFAULT NULL,
  `sinopsis` varchar(100) DEFAULT NULL,
  `id_kategori_naskah` varchar(100) DEFAULT NULL,
  `tanggal_upload` varchar(100) NOT NULL,
  `harga` decimal(65,0) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `berat_buku` decimal(65,0) DEFAULT NULL,
  `jumlah_lembar` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_file_naskah`),
  KEY `id_account` (`id_account`),
  KEY `id_kategeori_naskah` (`id_kategori_naskah`),
  CONSTRAINT `file_naskah_penulis_ibfk_2` FOREIGN KEY (`id_kategori_naskah`) REFERENCES `kategori_naskah` (`id_kategori_naskah`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `file_naskah_penulis_ibfk_3` FOREIGN KEY (`id_account`) REFERENCES `akun_penulis` (`id_account`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `file_naskah_penulis`
--

LOCK TABLES `file_naskah_penulis` WRITE;
/*!40000 ALTER TABLE `file_naskah_penulis` DISABLE KEYS */;
INSERT INTO `file_naskah_penulis` VALUES (10,'000001','Ajax Jquery','Dedyibrahym',NULL,'2011e742f8e06b4bcda748088540a1f8.jpg','Sinopsis','N_014','05/09/2018',9000,'Publish',1000,'100'),(11,'000002','Membuat Laptop','Sinta Masnah',NULL,'71053821e13f0b20d0d1ab899f79d6d7.jpg','Laptop','N_014','05/09/2018',20000,'Publish',100,'100');
/*!40000 ALTER TABLE `file_naskah_penulis` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `id_penulis`
--

DROP TABLE IF EXISTS `id_penulis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `id_penulis` (
  `id_total_penulis` int(11) NOT NULL AUTO_INCREMENT,
  `id_account` varchar(100) NOT NULL,
  PRIMARY KEY (`id_total_penulis`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `id_penulis`
--

LOCK TABLES `id_penulis` WRITE;
/*!40000 ALTER TABLE `id_penulis` DISABLE KEYS */;
INSERT INTO `id_penulis` VALUES (1,'000000'),(2,'000001'),(3,'000002');
/*!40000 ALTER TABLE `id_penulis` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kategori_naskah`
--

DROP TABLE IF EXISTS `kategori_naskah`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kategori_naskah` (
  `id_kategori` int(11) NOT NULL AUTO_INCREMENT,
  `id_kategori_naskah` varchar(100) DEFAULT NULL,
  `nama_kategori` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_kategori`),
  KEY `id_kategeori_naskah` (`id_kategori_naskah`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kategori_naskah`
--

LOCK TABLES `kategori_naskah` WRITE;
/*!40000 ALTER TABLE `kategori_naskah` DISABLE KEYS */;
INSERT INTO `kategori_naskah` VALUES (28,'N_000','Agama'),(29,'N_001','Anak-anak'),(31,'N_002','Bisnis dan Ekonomi'),(32,'N_003','Fiksi Populer'),(33,'N_004','Finansial'),(34,'N_005','Gaya Hidup'),(35,'N_006','Hukum'),(36,'N_007','Humor'),(37,'N_008','Ilmu Sosial'),(38,'N_009','Kamus'),(39,'N_010','Keluarga'),(40,'N_011','Kesehatan'),(41,'N_012','Keterampilan Sosial'),(42,'N_013','Komik'),(43,'N_014','Komputer '),(45,'N_015','Masakan dan Makanan'),(46,'N_016','Matematika'),(47,'N_017','Novel'),(48,'N_018','Pendidikan'),(49,'N_019','Pengembangan Diri'),(50,'N_020','Persiapan Ujian'),(51,'N_021','Pertanian'),(52,'N_022','Psikologi'),(53,'N_023','Sains'),(54,'N_024','Sastra'),(55,'N_025','Sejarah'),(56,'N_026','Seni '),(57,'N_027','Spiritualitas'),(58,'N_028','Teknik'),(59,'N_029','Travel'),(60,'N_030','Kategori lain-lain'),(61,'N_031','Hobi');
/*!40000 ALTER TABLE `kategori_naskah` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id_admin` int(11) NOT NULL AUTO_INCREMENT,
  `nama_admin` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_admin`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (4,'Admin guepedia','admin@guepedia.com','a35b7b79104ca17dc3b97b2eb457ab16');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-09-06  8:42:34
