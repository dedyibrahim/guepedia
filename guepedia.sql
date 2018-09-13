-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 13 Sep 2018 pada 16.48
-- Versi Server: 10.1.9-MariaDB
-- PHP Version: 5.5.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `guepedia`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `akun_penulis`
--

CREATE TABLE `akun_penulis` (
  `id_akun_penulis` int(11) NOT NULL,
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
  `status_akun` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `akun_penulis`
--

INSERT INTO `akun_penulis` (`id_akun_penulis`, `id_account`, `nama_lengkap`, `nama_pena`, `nomor_kontak`, `alamat_lengkap`, `email`, `password`, `nama_pemilik_rekening`, `nomor_rekening`, `nama_bank`, `royalti_diperoleh`, `status_akun`) VALUES
(4923, '000001', 'Dedyibrahym', 'Dedy23', '081289903664', 'Kp.Sumurwangi Kel.Kayumanis Kota Bogor', 'dedyibrahym23@gmail.com', '21232f297a57a5a743894a0e4a801fc3', NULL, NULL, NULL, '0', 'aktif'),
(4924, '000002', 'Sinta Masnah', 'Sinta2222', '081289903664', 'BKIPM MANTAP', 'sintamasnah@gmail.com', '21232f297a57a5a743894a0e4a801fc3', NULL, NULL, NULL, '0', 'tidak'),
(4927, '000005', 'Jumas', NULL, NULL, NULL, 'jumas@gmail.com', '21232f297a57a5a743894a0e4a801fc3', NULL, NULL, NULL, '0', 'aktif');

-- --------------------------------------------------------

--
-- Struktur dari tabel `buku_terlaris`
--

CREATE TABLE `buku_terlaris` (
  `id_buku_terlaris` int(11) NOT NULL,
  `id_file_naskah` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `buku_terlaris`
--

INSERT INTO `buku_terlaris` (`id_buku_terlaris`, `id_file_naskah`) VALUES
(2, '10'),
(1, '11');

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_alamat`
--

CREATE TABLE `data_alamat` (
  `id_data_alamat` int(11) NOT NULL,
  `id_account_toko` varchar(100) NOT NULL,
  `nama_kota` varchar(100) NOT NULL,
  `nomor_kontak` varchar(100) NOT NULL,
  `nama_kecamatan` varchar(100) NOT NULL,
  `city_id` varchar(100) NOT NULL,
  `subdistrict_id` varchar(100) NOT NULL,
  `nama_provinsi` varchar(100) NOT NULL,
  `kode_pos` varchar(100) NOT NULL,
  `alamat_lengkap` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `data_alamat`
--

INSERT INTO `data_alamat` (`id_data_alamat`, `id_account_toko`, `nama_kota`, `nomor_kontak`, `nama_kecamatan`, `city_id`, `subdistrict_id`, `nama_provinsi`, `kode_pos`, `alamat_lengkap`) VALUES
(28, '000001', 'Kota Bogor', '081289903664', 'Bogor Selatan - Kota', '79', '1063', 'Jawa Barat', '16119', 'Kp.Sumurwangi Kel.kayumanis RT.01 RW.07');

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_customer`
--

CREATE TABLE `data_customer` (
  `id_customer` int(11) NOT NULL,
  `nama_customer` varchar(100) DEFAULT NULL,
  `nomor_kontak` varchar(100) DEFAULT NULL,
  `alamat_lengkap` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `data_customer`
--

INSERT INTO `data_customer` (`id_customer`, `nama_customer`, `nomor_kontak`, `alamat_lengkap`) VALUES
(1, 'Dedy ibrahim', '081289903664', 'Kp.Sumurwangi Ke.Kayumanis Kec.Tanah Sareal Kota Bogor'),
(2, 'Komar', '08789478893', 'Sumurwangi Kel.Kayumanis Kec.Tanah Sareal Kota Bogor');

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_jumlah_penjualan`
--

CREATE TABLE `data_jumlah_penjualan` (
  `id_data_jumlah_penjualan` int(11) NOT NULL,
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
  `tanggal_transaksi` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Trigger `data_jumlah_penjualan`
--
DELIMITER $$
CREATE TRIGGER `TAMBAHKAN ROYALTI` AFTER INSERT ON `data_jumlah_penjualan` FOR EACH ROW BEGIN 
   UPDATE akun_penulis SET royalti_diperoleh = royalti_diperoleh + NEW.royalti
   WHERE id_account = NEW.id_account_penulis;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_jumlah_penjualan_toko`
--

CREATE TABLE `data_jumlah_penjualan_toko` (
  `id_penjualan_toko` int(11) NOT NULL,
  `id_account` varchar(100) DEFAULT NULL,
  `invoices_toko` varchar(100) DEFAULT NULL,
  `nama_kota` varchar(100) DEFAULT NULL,
  `nomor_kontak` varchar(100) DEFAULT NULL,
  `nama_kecamatan` varchar(100) DEFAULT NULL,
  `nama_provinsi` varchar(100) DEFAULT NULL,
  `kode_pos` varchar(100) DEFAULT NULL,
  `alamat_lengkap` text,
  `nilai_kupon` varchar(100) DEFAULT NULL,
  `hasil_kupon` varchar(100) DEFAULT NULL,
  `nama_kupon` varchar(100) DEFAULT NULL,
  `ongkir` varchar(100) DEFAULT NULL,
  `kurir` varchar(100) DEFAULT NULL,
  `service` varchar(100) DEFAULT NULL,
  `metode_pembayaran` varchar(100) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `total_belanja` varchar(100) DEFAULT NULL,
  `total_bayar` varchar(100) DEFAULT NULL,
  `nomor_resi` varchar(100) DEFAULT NULL,
  `bukti_transfer` varchar(100) DEFAULT NULL,
  `nilai_transfer` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `data_jumlah_penjualan_toko`
--

INSERT INTO `data_jumlah_penjualan_toko` (`id_penjualan_toko`, `id_account`, `invoices_toko`, `nama_kota`, `nomor_kontak`, `nama_kecamatan`, `nama_provinsi`, `kode_pos`, `alamat_lengkap`, `nilai_kupon`, `hasil_kupon`, `nama_kupon`, `ongkir`, `kurir`, `service`, `metode_pembayaran`, `status`, `total_belanja`, `total_bayar`, `nomor_resi`, `bukti_transfer`, `nilai_transfer`) VALUES
(11, '000001', 'INV/ST/000000', 'Kota Bogor', '081289903664', 'Bogor Selatan - Kota', 'Jawa Barat', '16119', 'Kp.Sumurwangi Kel.kayumanis RT.01 RW.07', '50', '34500', 'guepedia', '18000', 'Jalur Nugraha Ekakurir (JNE)', 'CTCYES ( JNE City Courier )', 'Bank Transfer', 'pending', '69000', '52500', NULL, NULL, NULL),
(12, '000001', 'INV/ST/000001', 'Kota Bogor', '081289903664', 'Bogor Selatan - Kota', 'Jawa Barat', '16119', 'Kp.Sumurwangi Kel.kayumanis RT.01 RW.07', '50', '34500', 'guepedia', '18000', 'Jalur Nugraha Ekakurir (JNE)', 'CTCYES ( JNE City Courier )', 'Bank Transfer', 'pending', '69000', '52500', NULL, NULL, NULL),
(13, '000001', 'INV/ST/000002', 'Kota Bogor', '081289903664', 'Bogor Selatan - Kota', 'Jawa Barat', '16119', 'Kp.Sumurwangi Kel.kayumanis RT.01 RW.07', '50', '34500', 'guepedia', '18000', 'Jalur Nugraha Ekakurir (JNE)', 'CTCYES ( JNE City Courier )', 'Bank Transfer', 'pending', '69000', '52500', NULL, NULL, NULL),
(14, '000001', 'INV/ST/000003', 'Kota Bogor', '081289903664', 'Bogor Selatan - Kota', 'Jawa Barat', '16119', 'Kp.Sumurwangi Kel.kayumanis RT.01 RW.07', '50', '34500', 'guepedia', '18000', 'Jalur Nugraha Ekakurir (JNE)', 'CTCYES ( JNE City Courier )', 'Bank Transfer', 'pending', '69000', '52500', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_kota`
--

CREATE TABLE `data_kota` (
  `id_data_kota` int(11) NOT NULL,
  `city_id` varchar(100) DEFAULT NULL,
  `province_id` varchar(100) DEFAULT NULL,
  `province` varchar(100) DEFAULT NULL,
  `city_name` varchar(100) DEFAULT NULL,
  `type` varchar(100) DEFAULT NULL,
  `postal_code` varchar(100) NOT NULL,
  `nama_kota` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `data_kota`
--

INSERT INTO `data_kota` (`id_data_kota`, `city_id`, `province_id`, `province`, `city_name`, `type`, `postal_code`, `nama_kota`) VALUES
(1, '1', '21', 'Nanggroe Aceh Darussalam (NAD)', 'Aceh Barat', 'Kabupaten', '23681', 'Kabupaten Aceh Barat'),
(2, '2', '21', 'Nanggroe Aceh Darussalam (NAD)', 'Aceh Barat Daya', 'Kabupaten', '23764', 'Kabupaten Aceh Barat Daya'),
(3, '3', '21', 'Nanggroe Aceh Darussalam (NAD)', 'Aceh Besar', 'Kabupaten', '23951', 'Kabupaten Aceh Besar'),
(4, '4', '21', 'Nanggroe Aceh Darussalam (NAD)', 'Aceh Jaya', 'Kabupaten', '23654', 'Kabupaten Aceh Jaya'),
(5, '5', '21', 'Nanggroe Aceh Darussalam (NAD)', 'Aceh Selatan', 'Kabupaten', '23719', 'Kabupaten Aceh Selatan'),
(6, '6', '21', 'Nanggroe Aceh Darussalam (NAD)', 'Aceh Singkil', 'Kabupaten', '24785', 'Kabupaten Aceh Singkil'),
(7, '7', '21', 'Nanggroe Aceh Darussalam (NAD)', 'Aceh Tamiang', 'Kabupaten', '24476', 'Kabupaten Aceh Tamiang'),
(8, '8', '21', 'Nanggroe Aceh Darussalam (NAD)', 'Aceh Tengah', 'Kabupaten', '24511', 'Kabupaten Aceh Tengah'),
(9, '9', '21', 'Nanggroe Aceh Darussalam (NAD)', 'Aceh Tenggara', 'Kabupaten', '24611', 'Kabupaten Aceh Tenggara'),
(10, '10', '21', 'Nanggroe Aceh Darussalam (NAD)', 'Aceh Timur', 'Kabupaten', '24454', 'Kabupaten Aceh Timur'),
(11, '11', '21', 'Nanggroe Aceh Darussalam (NAD)', 'Aceh Utara', 'Kabupaten', '24382', 'Kabupaten Aceh Utara'),
(12, '12', '32', 'Sumatera Barat', 'Agam', 'Kabupaten', '26411', 'Kabupaten Agam'),
(13, '13', '23', 'Nusa Tenggara Timur (NTT)', 'Alor', 'Kabupaten', '85811', 'Kabupaten Alor'),
(14, '14', '19', 'Maluku', 'Ambon', 'Kota', '97222', 'Kota Ambon'),
(15, '15', '34', 'Sumatera Utara', 'Asahan', 'Kabupaten', '21214', 'Kabupaten Asahan'),
(16, '16', '24', 'Papua', 'Asmat', 'Kabupaten', '99777', 'Kabupaten Asmat'),
(17, '17', '1', 'Bali', 'Badung', 'Kabupaten', '80351', 'Kabupaten Badung'),
(18, '18', '13', 'Kalimantan Selatan', 'Balangan', 'Kabupaten', '71611', 'Kabupaten Balangan'),
(19, '19', '15', 'Kalimantan Timur', 'Balikpapan', 'Kota', '76111', 'Kota Balikpapan'),
(20, '20', '21', 'Nanggroe Aceh Darussalam (NAD)', 'Banda Aceh', 'Kota', '23238', 'Kota Banda Aceh'),
(21, '21', '18', 'Lampung', 'Bandar Lampung', 'Kota', '35139', 'Kota Bandar Lampung'),
(22, '22', '9', 'Jawa Barat', 'Bandung', 'Kabupaten', '40311', 'Kabupaten Bandung'),
(23, '23', '9', 'Jawa Barat', 'Bandung', 'Kota', '40111', 'Kota Bandung'),
(24, '24', '9', 'Jawa Barat', 'Bandung Barat', 'Kabupaten', '40721', 'Kabupaten Bandung Barat'),
(25, '25', '29', 'Sulawesi Tengah', 'Banggai', 'Kabupaten', '94711', 'Kabupaten Banggai'),
(26, '26', '29', 'Sulawesi Tengah', 'Banggai Kepulauan', 'Kabupaten', '94881', 'Kabupaten Banggai Kepulauan'),
(27, '27', '2', 'Bangka Belitung', 'Bangka', 'Kabupaten', '33212', 'Kabupaten Bangka'),
(28, '28', '2', 'Bangka Belitung', 'Bangka Barat', 'Kabupaten', '33315', 'Kabupaten Bangka Barat'),
(29, '29', '2', 'Bangka Belitung', 'Bangka Selatan', 'Kabupaten', '33719', 'Kabupaten Bangka Selatan'),
(30, '30', '2', 'Bangka Belitung', 'Bangka Tengah', 'Kabupaten', '33613', 'Kabupaten Bangka Tengah'),
(31, '31', '11', 'Jawa Timur', 'Bangkalan', 'Kabupaten', '69118', 'Kabupaten Bangkalan'),
(32, '32', '1', 'Bali', 'Bangli', 'Kabupaten', '80619', 'Kabupaten Bangli'),
(33, '33', '13', 'Kalimantan Selatan', 'Banjar', 'Kabupaten', '70619', 'Kabupaten Banjar'),
(34, '34', '9', 'Jawa Barat', 'Banjar', 'Kota', '46311', 'Kota Banjar'),
(35, '35', '13', 'Kalimantan Selatan', 'Banjarbaru', 'Kota', '70712', 'Kota Banjarbaru'),
(36, '36', '13', 'Kalimantan Selatan', 'Banjarmasin', 'Kota', '70117', 'Kota Banjarmasin'),
(37, '37', '10', 'Jawa Tengah', 'Banjarnegara', 'Kabupaten', '53419', 'Kabupaten Banjarnegara'),
(38, '38', '28', 'Sulawesi Selatan', 'Bantaeng', 'Kabupaten', '92411', 'Kabupaten Bantaeng'),
(39, '39', '5', 'DI Yogyakarta', 'Bantul', 'Kabupaten', '55715', 'Kabupaten Bantul'),
(40, '40', '33', 'Sumatera Selatan', 'Banyuasin', 'Kabupaten', '30911', 'Kabupaten Banyuasin'),
(41, '41', '10', 'Jawa Tengah', 'Banyumas', 'Kabupaten', '53114', 'Kabupaten Banyumas'),
(42, '42', '11', 'Jawa Timur', 'Banyuwangi', 'Kabupaten', '68416', 'Kabupaten Banyuwangi'),
(43, '43', '13', 'Kalimantan Selatan', 'Barito Kuala', 'Kabupaten', '70511', 'Kabupaten Barito Kuala'),
(44, '44', '14', 'Kalimantan Tengah', 'Barito Selatan', 'Kabupaten', '73711', 'Kabupaten Barito Selatan'),
(45, '45', '14', 'Kalimantan Tengah', 'Barito Timur', 'Kabupaten', '73671', 'Kabupaten Barito Timur'),
(46, '46', '14', 'Kalimantan Tengah', 'Barito Utara', 'Kabupaten', '73881', 'Kabupaten Barito Utara'),
(47, '47', '28', 'Sulawesi Selatan', 'Barru', 'Kabupaten', '90719', 'Kabupaten Barru'),
(48, '48', '17', 'Kepulauan Riau', 'Batam', 'Kota', '29413', 'Kota Batam'),
(49, '49', '10', 'Jawa Tengah', 'Batang', 'Kabupaten', '51211', 'Kabupaten Batang'),
(50, '50', '8', 'Jambi', 'Batang Hari', 'Kabupaten', '36613', 'Kabupaten Batang Hari'),
(51, '51', '11', 'Jawa Timur', 'Batu', 'Kota', '65311', 'Kota Batu'),
(52, '52', '34', 'Sumatera Utara', 'Batu Bara', 'Kabupaten', '21655', 'Kabupaten Batu Bara'),
(53, '53', '30', 'Sulawesi Tenggara', 'Bau-Bau', 'Kota', '93719', 'Kota Bau-Bau'),
(54, '54', '9', 'Jawa Barat', 'Bekasi', 'Kabupaten', '17837', 'Kabupaten Bekasi'),
(55, '55', '9', 'Jawa Barat', 'Bekasi', 'Kota', '17121', 'Kota Bekasi'),
(56, '56', '2', 'Bangka Belitung', 'Belitung', 'Kabupaten', '33419', 'Kabupaten Belitung'),
(57, '57', '2', 'Bangka Belitung', 'Belitung Timur', 'Kabupaten', '33519', 'Kabupaten Belitung Timur'),
(58, '58', '23', 'Nusa Tenggara Timur (NTT)', 'Belu', 'Kabupaten', '85711', 'Kabupaten Belu'),
(59, '59', '21', 'Nanggroe Aceh Darussalam (NAD)', 'Bener Meriah', 'Kabupaten', '24581', 'Kabupaten Bener Meriah'),
(60, '60', '26', 'Riau', 'Bengkalis', 'Kabupaten', '28719', 'Kabupaten Bengkalis'),
(61, '61', '12', 'Kalimantan Barat', 'Bengkayang', 'Kabupaten', '79213', 'Kabupaten Bengkayang'),
(62, '62', '4', 'Bengkulu', 'Bengkulu', 'Kota', '38229', 'Kota Bengkulu'),
(63, '63', '4', 'Bengkulu', 'Bengkulu Selatan', 'Kabupaten', '38519', 'Kabupaten Bengkulu Selatan'),
(64, '64', '4', 'Bengkulu', 'Bengkulu Tengah', 'Kabupaten', '38319', 'Kabupaten Bengkulu Tengah'),
(65, '65', '4', 'Bengkulu', 'Bengkulu Utara', 'Kabupaten', '38619', 'Kabupaten Bengkulu Utara'),
(66, '66', '15', 'Kalimantan Timur', 'Berau', 'Kabupaten', '77311', 'Kabupaten Berau'),
(67, '67', '24', 'Papua', 'Biak Numfor', 'Kabupaten', '98119', 'Kabupaten Biak Numfor'),
(68, '68', '22', 'Nusa Tenggara Barat (NTB)', 'Bima', 'Kabupaten', '84171', 'Kabupaten Bima'),
(69, '69', '22', 'Nusa Tenggara Barat (NTB)', 'Bima', 'Kota', '84139', 'Kota Bima'),
(70, '70', '34', 'Sumatera Utara', 'Binjai', 'Kota', '20712', 'Kota Binjai'),
(71, '71', '17', 'Kepulauan Riau', 'Bintan', 'Kabupaten', '29135', 'Kabupaten Bintan'),
(72, '72', '21', 'Nanggroe Aceh Darussalam (NAD)', 'Bireuen', 'Kabupaten', '24219', 'Kabupaten Bireuen'),
(73, '73', '31', 'Sulawesi Utara', 'Bitung', 'Kota', '95512', 'Kota Bitung'),
(74, '74', '11', 'Jawa Timur', 'Blitar', 'Kabupaten', '66171', 'Kabupaten Blitar'),
(75, '75', '11', 'Jawa Timur', 'Blitar', 'Kota', '66124', 'Kota Blitar'),
(76, '76', '10', 'Jawa Tengah', 'Blora', 'Kabupaten', '58219', 'Kabupaten Blora'),
(77, '77', '7', 'Gorontalo', 'Boalemo', 'Kabupaten', '96319', 'Kabupaten Boalemo'),
(78, '78', '9', 'Jawa Barat', 'Bogor', 'Kabupaten', '16911', 'Kabupaten Bogor'),
(79, '79', '9', 'Jawa Barat', 'Bogor', 'Kota', '16119', 'Kota Bogor'),
(80, '80', '11', 'Jawa Timur', 'Bojonegoro', 'Kabupaten', '62119', 'Kabupaten Bojonegoro'),
(81, '81', '31', 'Sulawesi Utara', 'Bolaang Mongondow (Bolmong)', 'Kabupaten', '95755', 'Kabupaten Bolaang Mongondow (Bolmong)'),
(82, '82', '31', 'Sulawesi Utara', 'Bolaang Mongondow Selatan', 'Kabupaten', '95774', 'Kabupaten Bolaang Mongondow Selatan'),
(83, '83', '31', 'Sulawesi Utara', 'Bolaang Mongondow Timur', 'Kabupaten', '95783', 'Kabupaten Bolaang Mongondow Timur'),
(84, '84', '31', 'Sulawesi Utara', 'Bolaang Mongondow Utara', 'Kabupaten', '95765', 'Kabupaten Bolaang Mongondow Utara'),
(85, '85', '30', 'Sulawesi Tenggara', 'Bombana', 'Kabupaten', '93771', 'Kabupaten Bombana'),
(86, '86', '11', 'Jawa Timur', 'Bondowoso', 'Kabupaten', '68219', 'Kabupaten Bondowoso'),
(87, '87', '28', 'Sulawesi Selatan', 'Bone', 'Kabupaten', '92713', 'Kabupaten Bone'),
(88, '88', '7', 'Gorontalo', 'Bone Bolango', 'Kabupaten', '96511', 'Kabupaten Bone Bolango'),
(89, '89', '15', 'Kalimantan Timur', 'Bontang', 'Kota', '75313', 'Kota Bontang'),
(90, '90', '24', 'Papua', 'Boven Digoel', 'Kabupaten', '99662', 'Kabupaten Boven Digoel'),
(91, '91', '10', 'Jawa Tengah', 'Boyolali', 'Kabupaten', '57312', 'Kabupaten Boyolali'),
(92, '92', '10', 'Jawa Tengah', 'Brebes', 'Kabupaten', '52212', 'Kabupaten Brebes'),
(93, '93', '32', 'Sumatera Barat', 'Bukittinggi', 'Kota', '26115', 'Kota Bukittinggi'),
(94, '94', '1', 'Bali', 'Buleleng', 'Kabupaten', '81111', 'Kabupaten Buleleng'),
(95, '95', '28', 'Sulawesi Selatan', 'Bulukumba', 'Kabupaten', '92511', 'Kabupaten Bulukumba'),
(96, '96', '16', 'Kalimantan Utara', 'Bulungan (Bulongan)', 'Kabupaten', '77211', 'Kabupaten Bulungan (Bulongan)'),
(97, '97', '8', 'Jambi', 'Bungo', 'Kabupaten', '37216', 'Kabupaten Bungo'),
(98, '98', '29', 'Sulawesi Tengah', 'Buol', 'Kabupaten', '94564', 'Kabupaten Buol'),
(99, '99', '19', 'Maluku', 'Buru', 'Kabupaten', '97371', 'Kabupaten Buru'),
(100, '100', '19', 'Maluku', 'Buru Selatan', 'Kabupaten', '97351', 'Kabupaten Buru Selatan'),
(101, '101', '30', 'Sulawesi Tenggara', 'Buton', 'Kabupaten', '93754', 'Kabupaten Buton'),
(102, '102', '30', 'Sulawesi Tenggara', 'Buton Utara', 'Kabupaten', '93745', 'Kabupaten Buton Utara'),
(103, '103', '9', 'Jawa Barat', 'Ciamis', 'Kabupaten', '46211', 'Kabupaten Ciamis'),
(104, '104', '9', 'Jawa Barat', 'Cianjur', 'Kabupaten', '43217', 'Kabupaten Cianjur'),
(105, '105', '10', 'Jawa Tengah', 'Cilacap', 'Kabupaten', '53211', 'Kabupaten Cilacap'),
(106, '106', '3', 'Banten', 'Cilegon', 'Kota', '42417', 'Kota Cilegon'),
(107, '107', '9', 'Jawa Barat', 'Cimahi', 'Kota', '40512', 'Kota Cimahi'),
(108, '108', '9', 'Jawa Barat', 'Cirebon', 'Kabupaten', '45611', 'Kabupaten Cirebon'),
(109, '109', '9', 'Jawa Barat', 'Cirebon', 'Kota', '45116', 'Kota Cirebon'),
(110, '110', '34', 'Sumatera Utara', 'Dairi', 'Kabupaten', '22211', 'Kabupaten Dairi'),
(111, '111', '24', 'Papua', 'Deiyai (Deliyai)', 'Kabupaten', '98784', 'Kabupaten Deiyai (Deliyai)'),
(112, '112', '34', 'Sumatera Utara', 'Deli Serdang', 'Kabupaten', '20511', 'Kabupaten Deli Serdang'),
(113, '113', '10', 'Jawa Tengah', 'Demak', 'Kabupaten', '59519', 'Kabupaten Demak'),
(114, '114', '1', 'Bali', 'Denpasar', 'Kota', '80227', 'Kota Denpasar'),
(115, '115', '9', 'Jawa Barat', 'Depok', 'Kota', '16416', 'Kota Depok'),
(116, '116', '32', 'Sumatera Barat', 'Dharmasraya', 'Kabupaten', '27612', 'Kabupaten Dharmasraya'),
(117, '117', '24', 'Papua', 'Dogiyai', 'Kabupaten', '98866', 'Kabupaten Dogiyai'),
(118, '118', '22', 'Nusa Tenggara Barat (NTB)', 'Dompu', 'Kabupaten', '84217', 'Kabupaten Dompu'),
(119, '119', '29', 'Sulawesi Tengah', 'Donggala', 'Kabupaten', '94341', 'Kabupaten Donggala'),
(120, '120', '26', 'Riau', 'Dumai', 'Kota', '28811', 'Kota Dumai'),
(121, '121', '33', 'Sumatera Selatan', 'Empat Lawang', 'Kabupaten', '31811', 'Kabupaten Empat Lawang'),
(122, '122', '23', 'Nusa Tenggara Timur (NTT)', 'Ende', 'Kabupaten', '86351', 'Kabupaten Ende'),
(123, '123', '28', 'Sulawesi Selatan', 'Enrekang', 'Kabupaten', '91719', 'Kabupaten Enrekang'),
(124, '124', '25', 'Papua Barat', 'Fakfak', 'Kabupaten', '98651', 'Kabupaten Fakfak'),
(125, '125', '23', 'Nusa Tenggara Timur (NTT)', 'Flores Timur', 'Kabupaten', '86213', 'Kabupaten Flores Timur'),
(126, '126', '9', 'Jawa Barat', 'Garut', 'Kabupaten', '44126', 'Kabupaten Garut'),
(127, '127', '21', 'Nanggroe Aceh Darussalam (NAD)', 'Gayo Lues', 'Kabupaten', '24653', 'Kabupaten Gayo Lues'),
(128, '128', '1', 'Bali', 'Gianyar', 'Kabupaten', '80519', 'Kabupaten Gianyar'),
(129, '129', '7', 'Gorontalo', 'Gorontalo', 'Kabupaten', '96218', 'Kabupaten Gorontalo'),
(130, '130', '7', 'Gorontalo', 'Gorontalo', 'Kota', '96115', 'Kota Gorontalo'),
(131, '131', '7', 'Gorontalo', 'Gorontalo Utara', 'Kabupaten', '96611', 'Kabupaten Gorontalo Utara'),
(132, '132', '28', 'Sulawesi Selatan', 'Gowa', 'Kabupaten', '92111', 'Kabupaten Gowa'),
(133, '133', '11', 'Jawa Timur', 'Gresik', 'Kabupaten', '61115', 'Kabupaten Gresik'),
(134, '134', '10', 'Jawa Tengah', 'Grobogan', 'Kabupaten', '58111', 'Kabupaten Grobogan'),
(135, '135', '5', 'DI Yogyakarta', 'Gunung Kidul', 'Kabupaten', '55812', 'Kabupaten Gunung Kidul'),
(136, '136', '14', 'Kalimantan Tengah', 'Gunung Mas', 'Kabupaten', '74511', 'Kabupaten Gunung Mas'),
(137, '137', '34', 'Sumatera Utara', 'Gunungsitoli', 'Kota', '22813', 'Kota Gunungsitoli'),
(138, '138', '20', 'Maluku Utara', 'Halmahera Barat', 'Kabupaten', '97757', 'Kabupaten Halmahera Barat'),
(139, '139', '20', 'Maluku Utara', 'Halmahera Selatan', 'Kabupaten', '97911', 'Kabupaten Halmahera Selatan'),
(140, '140', '20', 'Maluku Utara', 'Halmahera Tengah', 'Kabupaten', '97853', 'Kabupaten Halmahera Tengah'),
(141, '141', '20', 'Maluku Utara', 'Halmahera Timur', 'Kabupaten', '97862', 'Kabupaten Halmahera Timur'),
(142, '142', '20', 'Maluku Utara', 'Halmahera Utara', 'Kabupaten', '97762', 'Kabupaten Halmahera Utara'),
(143, '143', '13', 'Kalimantan Selatan', 'Hulu Sungai Selatan', 'Kabupaten', '71212', 'Kabupaten Hulu Sungai Selatan'),
(144, '144', '13', 'Kalimantan Selatan', 'Hulu Sungai Tengah', 'Kabupaten', '71313', 'Kabupaten Hulu Sungai Tengah'),
(145, '145', '13', 'Kalimantan Selatan', 'Hulu Sungai Utara', 'Kabupaten', '71419', 'Kabupaten Hulu Sungai Utara'),
(146, '146', '34', 'Sumatera Utara', 'Humbang Hasundutan', 'Kabupaten', '22457', 'Kabupaten Humbang Hasundutan'),
(147, '147', '26', 'Riau', 'Indragiri Hilir', 'Kabupaten', '29212', 'Kabupaten Indragiri Hilir'),
(148, '148', '26', 'Riau', 'Indragiri Hulu', 'Kabupaten', '29319', 'Kabupaten Indragiri Hulu'),
(149, '149', '9', 'Jawa Barat', 'Indramayu', 'Kabupaten', '45214', 'Kabupaten Indramayu'),
(150, '150', '24', 'Papua', 'Intan Jaya', 'Kabupaten', '98771', 'Kabupaten Intan Jaya'),
(151, '151', '6', 'DKI Jakarta', 'Jakarta Barat', 'Kota', '11220', 'Kota Jakarta Barat'),
(152, '152', '6', 'DKI Jakarta', 'Jakarta Pusat', 'Kota', '10540', 'Kota Jakarta Pusat'),
(153, '153', '6', 'DKI Jakarta', 'Jakarta Selatan', 'Kota', '12230', 'Kota Jakarta Selatan'),
(154, '154', '6', 'DKI Jakarta', 'Jakarta Timur', 'Kota', '13330', 'Kota Jakarta Timur'),
(155, '155', '6', 'DKI Jakarta', 'Jakarta Utara', 'Kota', '14140', 'Kota Jakarta Utara'),
(156, '156', '8', 'Jambi', 'Jambi', 'Kota', '36111', 'Kota Jambi'),
(157, '157', '24', 'Papua', 'Jayapura', 'Kabupaten', '99352', 'Kabupaten Jayapura'),
(158, '158', '24', 'Papua', 'Jayapura', 'Kota', '99114', 'Kota Jayapura'),
(159, '159', '24', 'Papua', 'Jayawijaya', 'Kabupaten', '99511', 'Kabupaten Jayawijaya'),
(160, '160', '11', 'Jawa Timur', 'Jember', 'Kabupaten', '68113', 'Kabupaten Jember'),
(161, '161', '1', 'Bali', 'Jembrana', 'Kabupaten', '82251', 'Kabupaten Jembrana'),
(162, '162', '28', 'Sulawesi Selatan', 'Jeneponto', 'Kabupaten', '92319', 'Kabupaten Jeneponto'),
(163, '163', '10', 'Jawa Tengah', 'Jepara', 'Kabupaten', '59419', 'Kabupaten Jepara'),
(164, '164', '11', 'Jawa Timur', 'Jombang', 'Kabupaten', '61415', 'Kabupaten Jombang'),
(165, '165', '25', 'Papua Barat', 'Kaimana', 'Kabupaten', '98671', 'Kabupaten Kaimana'),
(166, '166', '26', 'Riau', 'Kampar', 'Kabupaten', '28411', 'Kabupaten Kampar'),
(167, '167', '14', 'Kalimantan Tengah', 'Kapuas', 'Kabupaten', '73583', 'Kabupaten Kapuas'),
(168, '168', '12', 'Kalimantan Barat', 'Kapuas Hulu', 'Kabupaten', '78719', 'Kabupaten Kapuas Hulu'),
(169, '169', '10', 'Jawa Tengah', 'Karanganyar', 'Kabupaten', '57718', 'Kabupaten Karanganyar'),
(170, '170', '1', 'Bali', 'Karangasem', 'Kabupaten', '80819', 'Kabupaten Karangasem'),
(171, '171', '9', 'Jawa Barat', 'Karawang', 'Kabupaten', '41311', 'Kabupaten Karawang'),
(172, '172', '17', 'Kepulauan Riau', 'Karimun', 'Kabupaten', '29611', 'Kabupaten Karimun'),
(173, '173', '34', 'Sumatera Utara', 'Karo', 'Kabupaten', '22119', 'Kabupaten Karo'),
(174, '174', '14', 'Kalimantan Tengah', 'Katingan', 'Kabupaten', '74411', 'Kabupaten Katingan'),
(175, '175', '4', 'Bengkulu', 'Kaur', 'Kabupaten', '38911', 'Kabupaten Kaur'),
(176, '176', '12', 'Kalimantan Barat', 'Kayong Utara', 'Kabupaten', '78852', 'Kabupaten Kayong Utara'),
(177, '177', '10', 'Jawa Tengah', 'Kebumen', 'Kabupaten', '54319', 'Kabupaten Kebumen'),
(178, '178', '11', 'Jawa Timur', 'Kediri', 'Kabupaten', '64184', 'Kabupaten Kediri'),
(179, '179', '11', 'Jawa Timur', 'Kediri', 'Kota', '64125', 'Kota Kediri'),
(180, '180', '24', 'Papua', 'Keerom', 'Kabupaten', '99461', 'Kabupaten Keerom'),
(181, '181', '10', 'Jawa Tengah', 'Kendal', 'Kabupaten', '51314', 'Kabupaten Kendal'),
(182, '182', '30', 'Sulawesi Tenggara', 'Kendari', 'Kota', '93126', 'Kota Kendari'),
(183, '183', '4', 'Bengkulu', 'Kepahiang', 'Kabupaten', '39319', 'Kabupaten Kepahiang'),
(184, '184', '17', 'Kepulauan Riau', 'Kepulauan Anambas', 'Kabupaten', '29991', 'Kabupaten Kepulauan Anambas'),
(185, '185', '19', 'Maluku', 'Kepulauan Aru', 'Kabupaten', '97681', 'Kabupaten Kepulauan Aru'),
(186, '186', '32', 'Sumatera Barat', 'Kepulauan Mentawai', 'Kabupaten', '25771', 'Kabupaten Kepulauan Mentawai'),
(187, '187', '26', 'Riau', 'Kepulauan Meranti', 'Kabupaten', '28791', 'Kabupaten Kepulauan Meranti'),
(188, '188', '31', 'Sulawesi Utara', 'Kepulauan Sangihe', 'Kabupaten', '95819', 'Kabupaten Kepulauan Sangihe'),
(189, '189', '6', 'DKI Jakarta', 'Kepulauan Seribu', 'Kabupaten', '14550', 'Kabupaten Kepulauan Seribu'),
(190, '190', '31', 'Sulawesi Utara', 'Kepulauan Siau Tagulandang Biaro (Sitaro)', 'Kabupaten', '95862', 'Kabupaten Kepulauan Siau Tagulandang Biaro (Sitaro)'),
(191, '191', '20', 'Maluku Utara', 'Kepulauan Sula', 'Kabupaten', '97995', 'Kabupaten Kepulauan Sula'),
(192, '192', '31', 'Sulawesi Utara', 'Kepulauan Talaud', 'Kabupaten', '95885', 'Kabupaten Kepulauan Talaud'),
(193, '193', '24', 'Papua', 'Kepulauan Yapen (Yapen Waropen)', 'Kabupaten', '98211', 'Kabupaten Kepulauan Yapen (Yapen Waropen)'),
(194, '194', '8', 'Jambi', 'Kerinci', 'Kabupaten', '37167', 'Kabupaten Kerinci'),
(195, '195', '12', 'Kalimantan Barat', 'Ketapang', 'Kabupaten', '78874', 'Kabupaten Ketapang'),
(196, '196', '10', 'Jawa Tengah', 'Klaten', 'Kabupaten', '57411', 'Kabupaten Klaten'),
(197, '197', '1', 'Bali', 'Klungkung', 'Kabupaten', '80719', 'Kabupaten Klungkung'),
(198, '198', '30', 'Sulawesi Tenggara', 'Kolaka', 'Kabupaten', '93511', 'Kabupaten Kolaka'),
(199, '199', '30', 'Sulawesi Tenggara', 'Kolaka Utara', 'Kabupaten', '93911', 'Kabupaten Kolaka Utara'),
(200, '200', '30', 'Sulawesi Tenggara', 'Konawe', 'Kabupaten', '93411', 'Kabupaten Konawe'),
(201, '201', '30', 'Sulawesi Tenggara', 'Konawe Selatan', 'Kabupaten', '93811', 'Kabupaten Konawe Selatan'),
(202, '202', '30', 'Sulawesi Tenggara', 'Konawe Utara', 'Kabupaten', '93311', 'Kabupaten Konawe Utara'),
(203, '203', '13', 'Kalimantan Selatan', 'Kotabaru', 'Kabupaten', '72119', 'Kabupaten Kotabaru'),
(204, '204', '31', 'Sulawesi Utara', 'Kotamobagu', 'Kota', '95711', 'Kota Kotamobagu'),
(205, '205', '14', 'Kalimantan Tengah', 'Kotawaringin Barat', 'Kabupaten', '74119', 'Kabupaten Kotawaringin Barat'),
(206, '206', '14', 'Kalimantan Tengah', 'Kotawaringin Timur', 'Kabupaten', '74364', 'Kabupaten Kotawaringin Timur'),
(207, '207', '26', 'Riau', 'Kuantan Singingi', 'Kabupaten', '29519', 'Kabupaten Kuantan Singingi'),
(208, '208', '12', 'Kalimantan Barat', 'Kubu Raya', 'Kabupaten', '78311', 'Kabupaten Kubu Raya'),
(209, '209', '10', 'Jawa Tengah', 'Kudus', 'Kabupaten', '59311', 'Kabupaten Kudus'),
(210, '210', '5', 'DI Yogyakarta', 'Kulon Progo', 'Kabupaten', '55611', 'Kabupaten Kulon Progo'),
(211, '211', '9', 'Jawa Barat', 'Kuningan', 'Kabupaten', '45511', 'Kabupaten Kuningan'),
(212, '212', '23', 'Nusa Tenggara Timur (NTT)', 'Kupang', 'Kabupaten', '85362', 'Kabupaten Kupang'),
(213, '213', '23', 'Nusa Tenggara Timur (NTT)', 'Kupang', 'Kota', '85119', 'Kota Kupang'),
(214, '214', '15', 'Kalimantan Timur', 'Kutai Barat', 'Kabupaten', '75711', 'Kabupaten Kutai Barat'),
(215, '215', '15', 'Kalimantan Timur', 'Kutai Kartanegara', 'Kabupaten', '75511', 'Kabupaten Kutai Kartanegara'),
(216, '216', '15', 'Kalimantan Timur', 'Kutai Timur', 'Kabupaten', '75611', 'Kabupaten Kutai Timur'),
(217, '217', '34', 'Sumatera Utara', 'Labuhan Batu', 'Kabupaten', '21412', 'Kabupaten Labuhan Batu'),
(218, '218', '34', 'Sumatera Utara', 'Labuhan Batu Selatan', 'Kabupaten', '21511', 'Kabupaten Labuhan Batu Selatan'),
(219, '219', '34', 'Sumatera Utara', 'Labuhan Batu Utara', 'Kabupaten', '21711', 'Kabupaten Labuhan Batu Utara'),
(220, '220', '33', 'Sumatera Selatan', 'Lahat', 'Kabupaten', '31419', 'Kabupaten Lahat'),
(221, '221', '14', 'Kalimantan Tengah', 'Lamandau', 'Kabupaten', '74611', 'Kabupaten Lamandau'),
(222, '222', '11', 'Jawa Timur', 'Lamongan', 'Kabupaten', '64125', 'Kabupaten Lamongan'),
(223, '223', '18', 'Lampung', 'Lampung Barat', 'Kabupaten', '34814', 'Kabupaten Lampung Barat'),
(224, '224', '18', 'Lampung', 'Lampung Selatan', 'Kabupaten', '35511', 'Kabupaten Lampung Selatan'),
(225, '225', '18', 'Lampung', 'Lampung Tengah', 'Kabupaten', '34212', 'Kabupaten Lampung Tengah'),
(226, '226', '18', 'Lampung', 'Lampung Timur', 'Kabupaten', '34319', 'Kabupaten Lampung Timur'),
(227, '227', '18', 'Lampung', 'Lampung Utara', 'Kabupaten', '34516', 'Kabupaten Lampung Utara'),
(228, '228', '12', 'Kalimantan Barat', 'Landak', 'Kabupaten', '78319', 'Kabupaten Landak'),
(229, '229', '34', 'Sumatera Utara', 'Langkat', 'Kabupaten', '20811', 'Kabupaten Langkat'),
(230, '230', '21', 'Nanggroe Aceh Darussalam (NAD)', 'Langsa', 'Kota', '24412', 'Kota Langsa'),
(231, '231', '24', 'Papua', 'Lanny Jaya', 'Kabupaten', '99531', 'Kabupaten Lanny Jaya'),
(232, '232', '3', 'Banten', 'Lebak', 'Kabupaten', '42319', 'Kabupaten Lebak'),
(233, '233', '4', 'Bengkulu', 'Lebong', 'Kabupaten', '39264', 'Kabupaten Lebong'),
(234, '234', '23', 'Nusa Tenggara Timur (NTT)', 'Lembata', 'Kabupaten', '86611', 'Kabupaten Lembata'),
(235, '235', '21', 'Nanggroe Aceh Darussalam (NAD)', 'Lhokseumawe', 'Kota', '24352', 'Kota Lhokseumawe'),
(236, '236', '32', 'Sumatera Barat', 'Lima Puluh Koto/Kota', 'Kabupaten', '26671', 'Kabupaten Lima Puluh Koto/Kota'),
(237, '237', '17', 'Kepulauan Riau', 'Lingga', 'Kabupaten', '29811', 'Kabupaten Lingga'),
(238, '238', '22', 'Nusa Tenggara Barat (NTB)', 'Lombok Barat', 'Kabupaten', '83311', 'Kabupaten Lombok Barat'),
(239, '239', '22', 'Nusa Tenggara Barat (NTB)', 'Lombok Tengah', 'Kabupaten', '83511', 'Kabupaten Lombok Tengah'),
(240, '240', '22', 'Nusa Tenggara Barat (NTB)', 'Lombok Timur', 'Kabupaten', '83612', 'Kabupaten Lombok Timur'),
(241, '241', '22', 'Nusa Tenggara Barat (NTB)', 'Lombok Utara', 'Kabupaten', '83711', 'Kabupaten Lombok Utara'),
(242, '242', '33', 'Sumatera Selatan', 'Lubuk Linggau', 'Kota', '31614', 'Kota Lubuk Linggau'),
(243, '243', '11', 'Jawa Timur', 'Lumajang', 'Kabupaten', '67319', 'Kabupaten Lumajang'),
(244, '244', '28', 'Sulawesi Selatan', 'Luwu', 'Kabupaten', '91994', 'Kabupaten Luwu'),
(245, '245', '28', 'Sulawesi Selatan', 'Luwu Timur', 'Kabupaten', '92981', 'Kabupaten Luwu Timur'),
(246, '246', '28', 'Sulawesi Selatan', 'Luwu Utara', 'Kabupaten', '92911', 'Kabupaten Luwu Utara'),
(247, '247', '11', 'Jawa Timur', 'Madiun', 'Kabupaten', '63153', 'Kabupaten Madiun'),
(248, '248', '11', 'Jawa Timur', 'Madiun', 'Kota', '63122', 'Kota Madiun'),
(249, '249', '10', 'Jawa Tengah', 'Magelang', 'Kabupaten', '56519', 'Kabupaten Magelang'),
(250, '250', '10', 'Jawa Tengah', 'Magelang', 'Kota', '56133', 'Kota Magelang'),
(251, '251', '11', 'Jawa Timur', 'Magetan', 'Kabupaten', '63314', 'Kabupaten Magetan'),
(252, '252', '9', 'Jawa Barat', 'Majalengka', 'Kabupaten', '45412', 'Kabupaten Majalengka'),
(253, '253', '27', 'Sulawesi Barat', 'Majene', 'Kabupaten', '91411', 'Kabupaten Majene'),
(254, '254', '28', 'Sulawesi Selatan', 'Makassar', 'Kota', '90111', 'Kota Makassar'),
(255, '255', '11', 'Jawa Timur', 'Malang', 'Kabupaten', '65163', 'Kabupaten Malang'),
(256, '256', '11', 'Jawa Timur', 'Malang', 'Kota', '65112', 'Kota Malang'),
(257, '257', '16', 'Kalimantan Utara', 'Malinau', 'Kabupaten', '77511', 'Kabupaten Malinau'),
(258, '258', '19', 'Maluku', 'Maluku Barat Daya', 'Kabupaten', '97451', 'Kabupaten Maluku Barat Daya'),
(259, '259', '19', 'Maluku', 'Maluku Tengah', 'Kabupaten', '97513', 'Kabupaten Maluku Tengah'),
(260, '260', '19', 'Maluku', 'Maluku Tenggara', 'Kabupaten', '97651', 'Kabupaten Maluku Tenggara'),
(261, '261', '19', 'Maluku', 'Maluku Tenggara Barat', 'Kabupaten', '97465', 'Kabupaten Maluku Tenggara Barat'),
(262, '262', '27', 'Sulawesi Barat', 'Mamasa', 'Kabupaten', '91362', 'Kabupaten Mamasa'),
(263, '263', '24', 'Papua', 'Mamberamo Raya', 'Kabupaten', '99381', 'Kabupaten Mamberamo Raya'),
(264, '264', '24', 'Papua', 'Mamberamo Tengah', 'Kabupaten', '99553', 'Kabupaten Mamberamo Tengah'),
(265, '265', '27', 'Sulawesi Barat', 'Mamuju', 'Kabupaten', '91519', 'Kabupaten Mamuju'),
(266, '266', '27', 'Sulawesi Barat', 'Mamuju Utara', 'Kabupaten', '91571', 'Kabupaten Mamuju Utara'),
(267, '267', '31', 'Sulawesi Utara', 'Manado', 'Kota', '95247', 'Kota Manado'),
(268, '268', '34', 'Sumatera Utara', 'Mandailing Natal', 'Kabupaten', '22916', 'Kabupaten Mandailing Natal'),
(269, '269', '23', 'Nusa Tenggara Timur (NTT)', 'Manggarai', 'Kabupaten', '86551', 'Kabupaten Manggarai'),
(270, '270', '23', 'Nusa Tenggara Timur (NTT)', 'Manggarai Barat', 'Kabupaten', '86711', 'Kabupaten Manggarai Barat'),
(271, '271', '23', 'Nusa Tenggara Timur (NTT)', 'Manggarai Timur', 'Kabupaten', '86811', 'Kabupaten Manggarai Timur'),
(272, '272', '25', 'Papua Barat', 'Manokwari', 'Kabupaten', '98311', 'Kabupaten Manokwari'),
(273, '273', '25', 'Papua Barat', 'Manokwari Selatan', 'Kabupaten', '98355', 'Kabupaten Manokwari Selatan'),
(274, '274', '24', 'Papua', 'Mappi', 'Kabupaten', '99853', 'Kabupaten Mappi'),
(275, '275', '28', 'Sulawesi Selatan', 'Maros', 'Kabupaten', '90511', 'Kabupaten Maros'),
(276, '276', '22', 'Nusa Tenggara Barat (NTB)', 'Mataram', 'Kota', '83131', 'Kota Mataram'),
(277, '277', '25', 'Papua Barat', 'Maybrat', 'Kabupaten', '98051', 'Kabupaten Maybrat'),
(278, '278', '34', 'Sumatera Utara', 'Medan', 'Kota', '20228', 'Kota Medan'),
(279, '279', '12', 'Kalimantan Barat', 'Melawi', 'Kabupaten', '78619', 'Kabupaten Melawi'),
(280, '280', '8', 'Jambi', 'Merangin', 'Kabupaten', '37319', 'Kabupaten Merangin'),
(281, '281', '24', 'Papua', 'Merauke', 'Kabupaten', '99613', 'Kabupaten Merauke'),
(282, '282', '18', 'Lampung', 'Mesuji', 'Kabupaten', '34911', 'Kabupaten Mesuji'),
(283, '283', '18', 'Lampung', 'Metro', 'Kota', '34111', 'Kota Metro'),
(284, '284', '24', 'Papua', 'Mimika', 'Kabupaten', '99962', 'Kabupaten Mimika'),
(285, '285', '31', 'Sulawesi Utara', 'Minahasa', 'Kabupaten', '95614', 'Kabupaten Minahasa'),
(286, '286', '31', 'Sulawesi Utara', 'Minahasa Selatan', 'Kabupaten', '95914', 'Kabupaten Minahasa Selatan'),
(287, '287', '31', 'Sulawesi Utara', 'Minahasa Tenggara', 'Kabupaten', '95995', 'Kabupaten Minahasa Tenggara'),
(288, '288', '31', 'Sulawesi Utara', 'Minahasa Utara', 'Kabupaten', '95316', 'Kabupaten Minahasa Utara'),
(289, '289', '11', 'Jawa Timur', 'Mojokerto', 'Kabupaten', '61382', 'Kabupaten Mojokerto'),
(290, '290', '11', 'Jawa Timur', 'Mojokerto', 'Kota', '61316', 'Kota Mojokerto'),
(291, '291', '29', 'Sulawesi Tengah', 'Morowali', 'Kabupaten', '94911', 'Kabupaten Morowali'),
(292, '292', '33', 'Sumatera Selatan', 'Muara Enim', 'Kabupaten', '31315', 'Kabupaten Muara Enim'),
(293, '293', '8', 'Jambi', 'Muaro Jambi', 'Kabupaten', '36311', 'Kabupaten Muaro Jambi'),
(294, '294', '4', 'Bengkulu', 'Muko Muko', 'Kabupaten', '38715', 'Kabupaten Muko Muko'),
(295, '295', '30', 'Sulawesi Tenggara', 'Muna', 'Kabupaten', '93611', 'Kabupaten Muna'),
(296, '296', '14', 'Kalimantan Tengah', 'Murung Raya', 'Kabupaten', '73911', 'Kabupaten Murung Raya'),
(297, '297', '33', 'Sumatera Selatan', 'Musi Banyuasin', 'Kabupaten', '30719', 'Kabupaten Musi Banyuasin'),
(298, '298', '33', 'Sumatera Selatan', 'Musi Rawas', 'Kabupaten', '31661', 'Kabupaten Musi Rawas'),
(299, '299', '24', 'Papua', 'Nabire', 'Kabupaten', '98816', 'Kabupaten Nabire'),
(300, '300', '21', 'Nanggroe Aceh Darussalam (NAD)', 'Nagan Raya', 'Kabupaten', '23674', 'Kabupaten Nagan Raya'),
(301, '301', '23', 'Nusa Tenggara Timur (NTT)', 'Nagekeo', 'Kabupaten', '86911', 'Kabupaten Nagekeo'),
(302, '302', '17', 'Kepulauan Riau', 'Natuna', 'Kabupaten', '29711', 'Kabupaten Natuna'),
(303, '303', '24', 'Papua', 'Nduga', 'Kabupaten', '99541', 'Kabupaten Nduga'),
(304, '304', '23', 'Nusa Tenggara Timur (NTT)', 'Ngada', 'Kabupaten', '86413', 'Kabupaten Ngada'),
(305, '305', '11', 'Jawa Timur', 'Nganjuk', 'Kabupaten', '64414', 'Kabupaten Nganjuk'),
(306, '306', '11', 'Jawa Timur', 'Ngawi', 'Kabupaten', '63219', 'Kabupaten Ngawi'),
(307, '307', '34', 'Sumatera Utara', 'Nias', 'Kabupaten', '22876', 'Kabupaten Nias'),
(308, '308', '34', 'Sumatera Utara', 'Nias Barat', 'Kabupaten', '22895', 'Kabupaten Nias Barat'),
(309, '309', '34', 'Sumatera Utara', 'Nias Selatan', 'Kabupaten', '22865', 'Kabupaten Nias Selatan'),
(310, '310', '34', 'Sumatera Utara', 'Nias Utara', 'Kabupaten', '22856', 'Kabupaten Nias Utara'),
(311, '311', '16', 'Kalimantan Utara', 'Nunukan', 'Kabupaten', '77421', 'Kabupaten Nunukan'),
(312, '312', '33', 'Sumatera Selatan', 'Ogan Ilir', 'Kabupaten', '30811', 'Kabupaten Ogan Ilir'),
(313, '313', '33', 'Sumatera Selatan', 'Ogan Komering Ilir', 'Kabupaten', '30618', 'Kabupaten Ogan Komering Ilir'),
(314, '314', '33', 'Sumatera Selatan', 'Ogan Komering Ulu', 'Kabupaten', '32112', 'Kabupaten Ogan Komering Ulu'),
(315, '315', '33', 'Sumatera Selatan', 'Ogan Komering Ulu Selatan', 'Kabupaten', '32211', 'Kabupaten Ogan Komering Ulu Selatan'),
(316, '316', '33', 'Sumatera Selatan', 'Ogan Komering Ulu Timur', 'Kabupaten', '32312', 'Kabupaten Ogan Komering Ulu Timur'),
(317, '317', '11', 'Jawa Timur', 'Pacitan', 'Kabupaten', '63512', 'Kabupaten Pacitan'),
(318, '318', '32', 'Sumatera Barat', 'Padang', 'Kota', '25112', 'Kota Padang'),
(319, '319', '34', 'Sumatera Utara', 'Padang Lawas', 'Kabupaten', '22763', 'Kabupaten Padang Lawas'),
(320, '320', '34', 'Sumatera Utara', 'Padang Lawas Utara', 'Kabupaten', '22753', 'Kabupaten Padang Lawas Utara'),
(321, '321', '32', 'Sumatera Barat', 'Padang Panjang', 'Kota', '27122', 'Kota Padang Panjang'),
(322, '322', '32', 'Sumatera Barat', 'Padang Pariaman', 'Kabupaten', '25583', 'Kabupaten Padang Pariaman'),
(323, '323', '34', 'Sumatera Utara', 'Padang Sidempuan', 'Kota', '22727', 'Kota Padang Sidempuan'),
(324, '324', '33', 'Sumatera Selatan', 'Pagar Alam', 'Kota', '31512', 'Kota Pagar Alam'),
(325, '325', '34', 'Sumatera Utara', 'Pakpak Bharat', 'Kabupaten', '22272', 'Kabupaten Pakpak Bharat'),
(326, '326', '14', 'Kalimantan Tengah', 'Palangka Raya', 'Kota', '73112', 'Kota Palangka Raya'),
(327, '327', '33', 'Sumatera Selatan', 'Palembang', 'Kota', '31512', 'Kota Palembang'),
(328, '328', '28', 'Sulawesi Selatan', 'Palopo', 'Kota', '91911', 'Kota Palopo'),
(329, '329', '29', 'Sulawesi Tengah', 'Palu', 'Kota', '94111', 'Kota Palu'),
(330, '330', '11', 'Jawa Timur', 'Pamekasan', 'Kabupaten', '69319', 'Kabupaten Pamekasan'),
(331, '331', '3', 'Banten', 'Pandeglang', 'Kabupaten', '42212', 'Kabupaten Pandeglang'),
(332, '332', '9', 'Jawa Barat', 'Pangandaran', 'Kabupaten', '46511', 'Kabupaten Pangandaran'),
(333, '333', '28', 'Sulawesi Selatan', 'Pangkajene Kepulauan', 'Kabupaten', '90611', 'Kabupaten Pangkajene Kepulauan'),
(334, '334', '2', 'Bangka Belitung', 'Pangkal Pinang', 'Kota', '33115', 'Kota Pangkal Pinang'),
(335, '335', '24', 'Papua', 'Paniai', 'Kabupaten', '98765', 'Kabupaten Paniai'),
(336, '336', '28', 'Sulawesi Selatan', 'Parepare', 'Kota', '91123', 'Kota Parepare'),
(337, '337', '32', 'Sumatera Barat', 'Pariaman', 'Kota', '25511', 'Kota Pariaman'),
(338, '338', '29', 'Sulawesi Tengah', 'Parigi Moutong', 'Kabupaten', '94411', 'Kabupaten Parigi Moutong'),
(339, '339', '32', 'Sumatera Barat', 'Pasaman', 'Kabupaten', '26318', 'Kabupaten Pasaman'),
(340, '340', '32', 'Sumatera Barat', 'Pasaman Barat', 'Kabupaten', '26511', 'Kabupaten Pasaman Barat'),
(341, '341', '15', 'Kalimantan Timur', 'Paser', 'Kabupaten', '76211', 'Kabupaten Paser'),
(342, '342', '11', 'Jawa Timur', 'Pasuruan', 'Kabupaten', '67153', 'Kabupaten Pasuruan'),
(343, '343', '11', 'Jawa Timur', 'Pasuruan', 'Kota', '67118', 'Kota Pasuruan'),
(344, '344', '10', 'Jawa Tengah', 'Pati', 'Kabupaten', '59114', 'Kabupaten Pati'),
(345, '345', '32', 'Sumatera Barat', 'Payakumbuh', 'Kota', '26213', 'Kota Payakumbuh'),
(346, '346', '25', 'Papua Barat', 'Pegunungan Arfak', 'Kabupaten', '98354', 'Kabupaten Pegunungan Arfak'),
(347, '347', '24', 'Papua', 'Pegunungan Bintang', 'Kabupaten', '99573', 'Kabupaten Pegunungan Bintang'),
(348, '348', '10', 'Jawa Tengah', 'Pekalongan', 'Kabupaten', '51161', 'Kabupaten Pekalongan'),
(349, '349', '10', 'Jawa Tengah', 'Pekalongan', 'Kota', '51122', 'Kota Pekalongan'),
(350, '350', '26', 'Riau', 'Pekanbaru', 'Kota', '28112', 'Kota Pekanbaru'),
(351, '351', '26', 'Riau', 'Pelalawan', 'Kabupaten', '28311', 'Kabupaten Pelalawan'),
(352, '352', '10', 'Jawa Tengah', 'Pemalang', 'Kabupaten', '52319', 'Kabupaten Pemalang'),
(353, '353', '34', 'Sumatera Utara', 'Pematang Siantar', 'Kota', '21126', 'Kota Pematang Siantar'),
(354, '354', '15', 'Kalimantan Timur', 'Penajam Paser Utara', 'Kabupaten', '76311', 'Kabupaten Penajam Paser Utara'),
(355, '355', '18', 'Lampung', 'Pesawaran', 'Kabupaten', '35312', 'Kabupaten Pesawaran'),
(356, '356', '18', 'Lampung', 'Pesisir Barat', 'Kabupaten', '35974', 'Kabupaten Pesisir Barat'),
(357, '357', '32', 'Sumatera Barat', 'Pesisir Selatan', 'Kabupaten', '25611', 'Kabupaten Pesisir Selatan'),
(358, '358', '21', 'Nanggroe Aceh Darussalam (NAD)', 'Pidie', 'Kabupaten', '24116', 'Kabupaten Pidie'),
(359, '359', '21', 'Nanggroe Aceh Darussalam (NAD)', 'Pidie Jaya', 'Kabupaten', '24186', 'Kabupaten Pidie Jaya'),
(360, '360', '28', 'Sulawesi Selatan', 'Pinrang', 'Kabupaten', '91251', 'Kabupaten Pinrang'),
(361, '361', '7', 'Gorontalo', 'Pohuwato', 'Kabupaten', '96419', 'Kabupaten Pohuwato'),
(362, '362', '27', 'Sulawesi Barat', 'Polewali Mandar', 'Kabupaten', '91311', 'Kabupaten Polewali Mandar'),
(363, '363', '11', 'Jawa Timur', 'Ponorogo', 'Kabupaten', '63411', 'Kabupaten Ponorogo'),
(364, '364', '12', 'Kalimantan Barat', 'Pontianak', 'Kabupaten', '78971', 'Kabupaten Pontianak'),
(365, '365', '12', 'Kalimantan Barat', 'Pontianak', 'Kota', '78112', 'Kota Pontianak'),
(366, '366', '29', 'Sulawesi Tengah', 'Poso', 'Kabupaten', '94615', 'Kabupaten Poso'),
(367, '367', '33', 'Sumatera Selatan', 'Prabumulih', 'Kota', '31121', 'Kota Prabumulih'),
(368, '368', '18', 'Lampung', 'Pringsewu', 'Kabupaten', '35719', 'Kabupaten Pringsewu'),
(369, '369', '11', 'Jawa Timur', 'Probolinggo', 'Kabupaten', '67282', 'Kabupaten Probolinggo'),
(370, '370', '11', 'Jawa Timur', 'Probolinggo', 'Kota', '67215', 'Kota Probolinggo'),
(371, '371', '14', 'Kalimantan Tengah', 'Pulang Pisau', 'Kabupaten', '74811', 'Kabupaten Pulang Pisau'),
(372, '372', '20', 'Maluku Utara', 'Pulau Morotai', 'Kabupaten', '97771', 'Kabupaten Pulau Morotai'),
(373, '373', '24', 'Papua', 'Puncak', 'Kabupaten', '98981', 'Kabupaten Puncak'),
(374, '374', '24', 'Papua', 'Puncak Jaya', 'Kabupaten', '98979', 'Kabupaten Puncak Jaya'),
(375, '375', '10', 'Jawa Tengah', 'Purbalingga', 'Kabupaten', '53312', 'Kabupaten Purbalingga'),
(376, '376', '9', 'Jawa Barat', 'Purwakarta', 'Kabupaten', '41119', 'Kabupaten Purwakarta'),
(377, '377', '10', 'Jawa Tengah', 'Purworejo', 'Kabupaten', '54111', 'Kabupaten Purworejo'),
(378, '378', '25', 'Papua Barat', 'Raja Ampat', 'Kabupaten', '98489', 'Kabupaten Raja Ampat'),
(379, '379', '4', 'Bengkulu', 'Rejang Lebong', 'Kabupaten', '39112', 'Kabupaten Rejang Lebong'),
(380, '380', '10', 'Jawa Tengah', 'Rembang', 'Kabupaten', '59219', 'Kabupaten Rembang'),
(381, '381', '26', 'Riau', 'Rokan Hilir', 'Kabupaten', '28992', 'Kabupaten Rokan Hilir'),
(382, '382', '26', 'Riau', 'Rokan Hulu', 'Kabupaten', '28511', 'Kabupaten Rokan Hulu'),
(383, '383', '23', 'Nusa Tenggara Timur (NTT)', 'Rote Ndao', 'Kabupaten', '85982', 'Kabupaten Rote Ndao'),
(384, '384', '21', 'Nanggroe Aceh Darussalam (NAD)', 'Sabang', 'Kota', '23512', 'Kota Sabang'),
(385, '385', '23', 'Nusa Tenggara Timur (NTT)', 'Sabu Raijua', 'Kabupaten', '85391', 'Kabupaten Sabu Raijua'),
(386, '386', '10', 'Jawa Tengah', 'Salatiga', 'Kota', '50711', 'Kota Salatiga'),
(387, '387', '15', 'Kalimantan Timur', 'Samarinda', 'Kota', '75133', 'Kota Samarinda'),
(388, '388', '12', 'Kalimantan Barat', 'Sambas', 'Kabupaten', '79453', 'Kabupaten Sambas'),
(389, '389', '34', 'Sumatera Utara', 'Samosir', 'Kabupaten', '22392', 'Kabupaten Samosir'),
(390, '390', '11', 'Jawa Timur', 'Sampang', 'Kabupaten', '69219', 'Kabupaten Sampang'),
(391, '391', '12', 'Kalimantan Barat', 'Sanggau', 'Kabupaten', '78557', 'Kabupaten Sanggau'),
(392, '392', '24', 'Papua', 'Sarmi', 'Kabupaten', '99373', 'Kabupaten Sarmi'),
(393, '393', '8', 'Jambi', 'Sarolangun', 'Kabupaten', '37419', 'Kabupaten Sarolangun'),
(394, '394', '32', 'Sumatera Barat', 'Sawah Lunto', 'Kota', '27416', 'Kota Sawah Lunto'),
(395, '395', '12', 'Kalimantan Barat', 'Sekadau', 'Kabupaten', '79583', 'Kabupaten Sekadau'),
(396, '396', '28', 'Sulawesi Selatan', 'Selayar (Kepulauan Selayar)', 'Kabupaten', '92812', 'Kabupaten Selayar (Kepulauan Selayar)'),
(397, '397', '4', 'Bengkulu', 'Seluma', 'Kabupaten', '38811', 'Kabupaten Seluma'),
(398, '398', '10', 'Jawa Tengah', 'Semarang', 'Kabupaten', '50511', 'Kabupaten Semarang'),
(399, '399', '10', 'Jawa Tengah', 'Semarang', 'Kota', '50135', 'Kota Semarang'),
(400, '400', '19', 'Maluku', 'Seram Bagian Barat', 'Kabupaten', '97561', 'Kabupaten Seram Bagian Barat'),
(401, '401', '19', 'Maluku', 'Seram Bagian Timur', 'Kabupaten', '97581', 'Kabupaten Seram Bagian Timur'),
(402, '402', '3', 'Banten', 'Serang', 'Kabupaten', '42182', 'Kabupaten Serang'),
(403, '403', '3', 'Banten', 'Serang', 'Kota', '42111', 'Kota Serang'),
(404, '404', '34', 'Sumatera Utara', 'Serdang Bedagai', 'Kabupaten', '20915', 'Kabupaten Serdang Bedagai'),
(405, '405', '14', 'Kalimantan Tengah', 'Seruyan', 'Kabupaten', '74211', 'Kabupaten Seruyan'),
(406, '406', '26', 'Riau', 'Siak', 'Kabupaten', '28623', 'Kabupaten Siak'),
(407, '407', '34', 'Sumatera Utara', 'Sibolga', 'Kota', '22522', 'Kota Sibolga'),
(408, '408', '28', 'Sulawesi Selatan', 'Sidenreng Rappang/Rapang', 'Kabupaten', '91613', 'Kabupaten Sidenreng Rappang/Rapang'),
(409, '409', '11', 'Jawa Timur', 'Sidoarjo', 'Kabupaten', '61219', 'Kabupaten Sidoarjo'),
(410, '410', '29', 'Sulawesi Tengah', 'Sigi', 'Kabupaten', '94364', 'Kabupaten Sigi'),
(411, '411', '32', 'Sumatera Barat', 'Sijunjung (Sawah Lunto Sijunjung)', 'Kabupaten', '27511', 'Kabupaten Sijunjung (Sawah Lunto Sijunjung)'),
(412, '412', '23', 'Nusa Tenggara Timur (NTT)', 'Sikka', 'Kabupaten', '86121', 'Kabupaten Sikka'),
(413, '413', '34', 'Sumatera Utara', 'Simalungun', 'Kabupaten', '21162', 'Kabupaten Simalungun'),
(414, '414', '21', 'Nanggroe Aceh Darussalam (NAD)', 'Simeulue', 'Kabupaten', '23891', 'Kabupaten Simeulue'),
(415, '415', '12', 'Kalimantan Barat', 'Singkawang', 'Kota', '79117', 'Kota Singkawang'),
(416, '416', '28', 'Sulawesi Selatan', 'Sinjai', 'Kabupaten', '92615', 'Kabupaten Sinjai'),
(417, '417', '12', 'Kalimantan Barat', 'Sintang', 'Kabupaten', '78619', 'Kabupaten Sintang'),
(418, '418', '11', 'Jawa Timur', 'Situbondo', 'Kabupaten', '68316', 'Kabupaten Situbondo'),
(419, '419', '5', 'DI Yogyakarta', 'Sleman', 'Kabupaten', '55513', 'Kabupaten Sleman'),
(420, '420', '32', 'Sumatera Barat', 'Solok', 'Kabupaten', '27365', 'Kabupaten Solok'),
(421, '421', '32', 'Sumatera Barat', 'Solok', 'Kota', '27315', 'Kota Solok'),
(422, '422', '32', 'Sumatera Barat', 'Solok Selatan', 'Kabupaten', '27779', 'Kabupaten Solok Selatan'),
(423, '423', '28', 'Sulawesi Selatan', 'Soppeng', 'Kabupaten', '90812', 'Kabupaten Soppeng'),
(424, '424', '25', 'Papua Barat', 'Sorong', 'Kabupaten', '98431', 'Kabupaten Sorong'),
(425, '425', '25', 'Papua Barat', 'Sorong', 'Kota', '98411', 'Kota Sorong'),
(426, '426', '25', 'Papua Barat', 'Sorong Selatan', 'Kabupaten', '98454', 'Kabupaten Sorong Selatan'),
(427, '427', '10', 'Jawa Tengah', 'Sragen', 'Kabupaten', '57211', 'Kabupaten Sragen'),
(428, '428', '9', 'Jawa Barat', 'Subang', 'Kabupaten', '41215', 'Kabupaten Subang'),
(429, '429', '21', 'Nanggroe Aceh Darussalam (NAD)', 'Subulussalam', 'Kota', '24882', 'Kota Subulussalam'),
(430, '430', '9', 'Jawa Barat', 'Sukabumi', 'Kabupaten', '43311', 'Kabupaten Sukabumi'),
(431, '431', '9', 'Jawa Barat', 'Sukabumi', 'Kota', '43114', 'Kota Sukabumi'),
(432, '432', '14', 'Kalimantan Tengah', 'Sukamara', 'Kabupaten', '74712', 'Kabupaten Sukamara'),
(433, '433', '10', 'Jawa Tengah', 'Sukoharjo', 'Kabupaten', '57514', 'Kabupaten Sukoharjo'),
(434, '434', '23', 'Nusa Tenggara Timur (NTT)', 'Sumba Barat', 'Kabupaten', '87219', 'Kabupaten Sumba Barat'),
(435, '435', '23', 'Nusa Tenggara Timur (NTT)', 'Sumba Barat Daya', 'Kabupaten', '87453', 'Kabupaten Sumba Barat Daya'),
(436, '436', '23', 'Nusa Tenggara Timur (NTT)', 'Sumba Tengah', 'Kabupaten', '87358', 'Kabupaten Sumba Tengah'),
(437, '437', '23', 'Nusa Tenggara Timur (NTT)', 'Sumba Timur', 'Kabupaten', '87112', 'Kabupaten Sumba Timur'),
(438, '438', '22', 'Nusa Tenggara Barat (NTB)', 'Sumbawa', 'Kabupaten', '84315', 'Kabupaten Sumbawa'),
(439, '439', '22', 'Nusa Tenggara Barat (NTB)', 'Sumbawa Barat', 'Kabupaten', '84419', 'Kabupaten Sumbawa Barat'),
(440, '440', '9', 'Jawa Barat', 'Sumedang', 'Kabupaten', '45326', 'Kabupaten Sumedang'),
(441, '441', '11', 'Jawa Timur', 'Sumenep', 'Kabupaten', '69413', 'Kabupaten Sumenep'),
(442, '442', '8', 'Jambi', 'Sungaipenuh', 'Kota', '37113', 'Kota Sungaipenuh'),
(443, '443', '24', 'Papua', 'Supiori', 'Kabupaten', '98164', 'Kabupaten Supiori'),
(444, '444', '11', 'Jawa Timur', 'Surabaya', 'Kota', '60119', 'Kota Surabaya'),
(445, '445', '10', 'Jawa Tengah', 'Surakarta (Solo)', 'Kota', '57113', 'Kota Surakarta (Solo)'),
(446, '446', '13', 'Kalimantan Selatan', 'Tabalong', 'Kabupaten', '71513', 'Kabupaten Tabalong'),
(447, '447', '1', 'Bali', 'Tabanan', 'Kabupaten', '82119', 'Kabupaten Tabanan'),
(448, '448', '28', 'Sulawesi Selatan', 'Takalar', 'Kabupaten', '92212', 'Kabupaten Takalar'),
(449, '449', '25', 'Papua Barat', 'Tambrauw', 'Kabupaten', '98475', 'Kabupaten Tambrauw'),
(450, '450', '16', 'Kalimantan Utara', 'Tana Tidung', 'Kabupaten', '77611', 'Kabupaten Tana Tidung'),
(451, '451', '28', 'Sulawesi Selatan', 'Tana Toraja', 'Kabupaten', '91819', 'Kabupaten Tana Toraja'),
(452, '452', '13', 'Kalimantan Selatan', 'Tanah Bumbu', 'Kabupaten', '72211', 'Kabupaten Tanah Bumbu'),
(453, '453', '32', 'Sumatera Barat', 'Tanah Datar', 'Kabupaten', '27211', 'Kabupaten Tanah Datar'),
(454, '454', '13', 'Kalimantan Selatan', 'Tanah Laut', 'Kabupaten', '70811', 'Kabupaten Tanah Laut'),
(455, '455', '3', 'Banten', 'Tangerang', 'Kabupaten', '15914', 'Kabupaten Tangerang'),
(456, '456', '3', 'Banten', 'Tangerang', 'Kota', '15111', 'Kota Tangerang'),
(457, '457', '3', 'Banten', 'Tangerang Selatan', 'Kota', '15332', 'Kota Tangerang Selatan'),
(458, '458', '18', 'Lampung', 'Tanggamus', 'Kabupaten', '35619', 'Kabupaten Tanggamus'),
(459, '459', '34', 'Sumatera Utara', 'Tanjung Balai', 'Kota', '21321', 'Kota Tanjung Balai'),
(460, '460', '8', 'Jambi', 'Tanjung Jabung Barat', 'Kabupaten', '36513', 'Kabupaten Tanjung Jabung Barat'),
(461, '461', '8', 'Jambi', 'Tanjung Jabung Timur', 'Kabupaten', '36719', 'Kabupaten Tanjung Jabung Timur'),
(462, '462', '17', 'Kepulauan Riau', 'Tanjung Pinang', 'Kota', '29111', 'Kota Tanjung Pinang'),
(463, '463', '34', 'Sumatera Utara', 'Tapanuli Selatan', 'Kabupaten', '22742', 'Kabupaten Tapanuli Selatan'),
(464, '464', '34', 'Sumatera Utara', 'Tapanuli Tengah', 'Kabupaten', '22611', 'Kabupaten Tapanuli Tengah'),
(465, '465', '34', 'Sumatera Utara', 'Tapanuli Utara', 'Kabupaten', '22414', 'Kabupaten Tapanuli Utara'),
(466, '466', '13', 'Kalimantan Selatan', 'Tapin', 'Kabupaten', '71119', 'Kabupaten Tapin'),
(467, '467', '16', 'Kalimantan Utara', 'Tarakan', 'Kota', '77114', 'Kota Tarakan'),
(468, '468', '9', 'Jawa Barat', 'Tasikmalaya', 'Kabupaten', '46411', 'Kabupaten Tasikmalaya'),
(469, '469', '9', 'Jawa Barat', 'Tasikmalaya', 'Kota', '46116', 'Kota Tasikmalaya'),
(470, '470', '34', 'Sumatera Utara', 'Tebing Tinggi', 'Kota', '20632', 'Kota Tebing Tinggi'),
(471, '471', '8', 'Jambi', 'Tebo', 'Kabupaten', '37519', 'Kabupaten Tebo'),
(472, '472', '10', 'Jawa Tengah', 'Tegal', 'Kabupaten', '52419', 'Kabupaten Tegal'),
(473, '473', '10', 'Jawa Tengah', 'Tegal', 'Kota', '52114', 'Kota Tegal'),
(474, '474', '25', 'Papua Barat', 'Teluk Bintuni', 'Kabupaten', '98551', 'Kabupaten Teluk Bintuni'),
(475, '475', '25', 'Papua Barat', 'Teluk Wondama', 'Kabupaten', '98591', 'Kabupaten Teluk Wondama'),
(476, '476', '10', 'Jawa Tengah', 'Temanggung', 'Kabupaten', '56212', 'Kabupaten Temanggung'),
(477, '477', '20', 'Maluku Utara', 'Ternate', 'Kota', '97714', 'Kota Ternate'),
(478, '478', '20', 'Maluku Utara', 'Tidore Kepulauan', 'Kota', '97815', 'Kota Tidore Kepulauan'),
(479, '479', '23', 'Nusa Tenggara Timur (NTT)', 'Timor Tengah Selatan', 'Kabupaten', '85562', 'Kabupaten Timor Tengah Selatan'),
(480, '480', '23', 'Nusa Tenggara Timur (NTT)', 'Timor Tengah Utara', 'Kabupaten', '85612', 'Kabupaten Timor Tengah Utara'),
(481, '481', '34', 'Sumatera Utara', 'Toba Samosir', 'Kabupaten', '22316', 'Kabupaten Toba Samosir'),
(482, '482', '29', 'Sulawesi Tengah', 'Tojo Una-Una', 'Kabupaten', '94683', 'Kabupaten Tojo Una-Una'),
(483, '483', '29', 'Sulawesi Tengah', 'Toli-Toli', 'Kabupaten', '94542', 'Kabupaten Toli-Toli'),
(484, '484', '24', 'Papua', 'Tolikara', 'Kabupaten', '99411', 'Kabupaten Tolikara'),
(485, '485', '31', 'Sulawesi Utara', 'Tomohon', 'Kota', '95416', 'Kota Tomohon'),
(486, '486', '28', 'Sulawesi Selatan', 'Toraja Utara', 'Kabupaten', '91831', 'Kabupaten Toraja Utara'),
(487, '487', '11', 'Jawa Timur', 'Trenggalek', 'Kabupaten', '66312', 'Kabupaten Trenggalek'),
(488, '488', '19', 'Maluku', 'Tual', 'Kota', '97612', 'Kota Tual'),
(489, '489', '11', 'Jawa Timur', 'Tuban', 'Kabupaten', '62319', 'Kabupaten Tuban'),
(490, '490', '18', 'Lampung', 'Tulang Bawang', 'Kabupaten', '34613', 'Kabupaten Tulang Bawang'),
(491, '491', '18', 'Lampung', 'Tulang Bawang Barat', 'Kabupaten', '34419', 'Kabupaten Tulang Bawang Barat'),
(492, '492', '11', 'Jawa Timur', 'Tulungagung', 'Kabupaten', '66212', 'Kabupaten Tulungagung'),
(493, '493', '28', 'Sulawesi Selatan', 'Wajo', 'Kabupaten', '90911', 'Kabupaten Wajo'),
(494, '494', '30', 'Sulawesi Tenggara', 'Wakatobi', 'Kabupaten', '93791', 'Kabupaten Wakatobi'),
(495, '495', '24', 'Papua', 'Waropen', 'Kabupaten', '98269', 'Kabupaten Waropen'),
(496, '496', '18', 'Lampung', 'Way Kanan', 'Kabupaten', '34711', 'Kabupaten Way Kanan'),
(497, '497', '10', 'Jawa Tengah', 'Wonogiri', 'Kabupaten', '57619', 'Kabupaten Wonogiri'),
(498, '498', '10', 'Jawa Tengah', 'Wonosobo', 'Kabupaten', '56311', 'Kabupaten Wonosobo'),
(499, '499', '24', 'Papua', 'Yahukimo', 'Kabupaten', '99041', 'Kabupaten Yahukimo'),
(500, '500', '24', 'Papua', 'Yalimo', 'Kabupaten', '99481', 'Kabupaten Yalimo'),
(501, '501', '5', 'DI Yogyakarta', 'Yogyakarta', 'Kota', '55222', 'Kota Yogyakarta');

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_kupon`
--

CREATE TABLE `data_kupon` (
  `id_data_kupon` int(11) NOT NULL,
  `kupon` varchar(100) DEFAULT NULL,
  `nilai_kupon` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `data_kupon`
--

INSERT INTO `data_kupon` (`id_data_kupon`, `kupon`, `nilai_kupon`) VALUES
(1, 'guepedia', '50'),
(2, 'buku', '100');

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_penjualan`
--

CREATE TABLE `data_penjualan` (
  `id_data_penjualan` int(11) NOT NULL,
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
  `resi_pengiriman` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_penjualan_toko`
--

CREATE TABLE `data_penjualan_toko` (
  `id_data_penjualan_toko` int(11) NOT NULL,
  `invoices_toko` varchar(100) DEFAULT NULL,
  `nama_buku` varchar(100) DEFAULT NULL,
  `harga_buku` varchar(100) DEFAULT NULL,
  `qty` varchar(100) DEFAULT NULL,
  `subtotal` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `data_penjualan_toko`
--

INSERT INTO `data_penjualan_toko` (`id_data_penjualan_toko`, `invoices_toko`, `nama_buku`, `harga_buku`, `qty`, `subtotal`) VALUES
(2, 'INV/ST/000000', 'Membuat Laptop', '20000', '3', '60000'),
(3, 'INV/ST/000000', 'Ajax Jquery', '9000', '1', '9000'),
(4, 'INV/ST/000001', 'Membuat Laptop', '20000', '3', '60000'),
(5, 'INV/ST/000001', 'Ajax Jquery', '9000', '1', '9000'),
(6, 'INV/ST/000002', 'Membuat Laptop', '20000', '3', '60000'),
(7, 'INV/ST/000002', 'Ajax Jquery', '9000', '1', '9000'),
(8, 'INV/ST/000003', 'Membuat Laptop', '20000', '3', '60000'),
(9, 'INV/ST/000003', 'Ajax Jquery', '9000', '1', '9000');

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_transfer_royalti`
--

CREATE TABLE `data_transfer_royalti` (
  `id_data_transfer_royalti` int(11) NOT NULL,
  `royalti` decimal(10,0) NOT NULL,
  `id_account` varchar(100) NOT NULL,
  `biaya_admin` decimal(10,0) NOT NULL,
  `royalti_bersih` decimal(10,0) NOT NULL,
  `bukti_transfer` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Trigger `data_transfer_royalti`
--
DELIMITER $$
CREATE TRIGGER `kurangi_royalti` AFTER INSERT ON `data_transfer_royalti` FOR EACH ROW BEGIN 
   UPDATE akun_penulis SET royalti_diperoleh = royalti_diperoleh - NEW.royalti
   WHERE id_account = NEW.id_account;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `file_naskah_penulis`
--

CREATE TABLE `file_naskah_penulis` (
  `id_file_naskah` int(11) NOT NULL,
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
  `jumlah_lembar` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `file_naskah_penulis`
--

INSERT INTO `file_naskah_penulis` (`id_file_naskah`, `id_account`, `judul`, `penulis`, `file_naskah`, `file_cover`, `sinopsis`, `id_kategori_naskah`, `tanggal_upload`, `harga`, `status`, `berat_buku`, `jumlah_lembar`) VALUES
(10, '000001', 'Ajax Jquery', 'Dedyibrahym', NULL, '2011e742f8e06b4bcda748088540a1f8.jpg', 'Sinopsis', 'N_014', '05/09/2018', '9000', 'Publish', '1000', '100'),
(11, '000002', 'Membuat Laptop', 'Sinta Masnah', NULL, '71053821e13f0b20d0d1ab899f79d6d7.jpg', 'Laptop', 'N_014', '05/09/2018', '20000', 'Publish', '100', '100');

-- --------------------------------------------------------

--
-- Struktur dari tabel `id_penulis`
--

CREATE TABLE `id_penulis` (
  `id_total_penulis` int(11) NOT NULL,
  `id_account` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `id_penulis`
--

INSERT INTO `id_penulis` (`id_total_penulis`, `id_account`) VALUES
(1, '000000'),
(2, '000001'),
(3, '000002'),
(4, '000003'),
(5, '000004'),
(6, '000005');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori_naskah`
--

CREATE TABLE `kategori_naskah` (
  `id_kategori` int(11) NOT NULL,
  `id_kategori_naskah` varchar(100) DEFAULT NULL,
  `nama_kategori` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kategori_naskah`
--

INSERT INTO `kategori_naskah` (`id_kategori`, `id_kategori_naskah`, `nama_kategori`) VALUES
(28, 'N_000', 'Agama'),
(29, 'N_001', 'Anak-anak'),
(31, 'N_002', 'Bisnis dan Ekonomi'),
(32, 'N_003', 'Fiksi Populer'),
(33, 'N_004', 'Finansial'),
(34, 'N_005', 'Gaya Hidup'),
(35, 'N_006', 'Hukum'),
(36, 'N_007', 'Humor'),
(37, 'N_008', 'Ilmu Sosial'),
(38, 'N_009', 'Kamus'),
(39, 'N_010', 'Keluarga'),
(40, 'N_011', 'Kesehatan'),
(41, 'N_012', 'Keterampilan Sosial'),
(42, 'N_013', 'Komik'),
(43, 'N_014', 'Komputer '),
(45, 'N_015', 'Masakan dan Makanan'),
(46, 'N_016', 'Matematika'),
(47, 'N_017', 'Novel'),
(48, 'N_018', 'Pendidikan'),
(49, 'N_019', 'Pengembangan Diri'),
(50, 'N_020', 'Persiapan Ujian'),
(51, 'N_021', 'Pertanian'),
(52, 'N_022', 'Psikologi'),
(53, 'N_023', 'Sains'),
(54, 'N_024', 'Sastra'),
(55, 'N_025', 'Sejarah'),
(56, 'N_026', 'Seni '),
(57, 'N_027', 'Spiritualitas'),
(58, 'N_028', 'Teknik'),
(59, 'N_029', 'Travel'),
(60, 'N_030', 'Kategori lain-lain'),
(61, 'N_031', 'Hobi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_admin` int(11) NOT NULL,
  `nama_admin` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_admin`, `nama_admin`, `email`, `password`) VALUES
(4, 'Admin guepedia', 'admin@guepedia.com', 'a35b7b79104ca17dc3b97b2eb457ab16');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akun_penulis`
--
ALTER TABLE `akun_penulis`
  ADD PRIMARY KEY (`id_akun_penulis`),
  ADD KEY `id_account` (`id_account`);

--
-- Indexes for table `buku_terlaris`
--
ALTER TABLE `buku_terlaris`
  ADD PRIMARY KEY (`id_buku_terlaris`),
  ADD KEY `id_file_naskah` (`id_file_naskah`);

--
-- Indexes for table `data_alamat`
--
ALTER TABLE `data_alamat`
  ADD PRIMARY KEY (`id_data_alamat`),
  ADD KEY `id_account_toko` (`id_account_toko`);

--
-- Indexes for table `data_customer`
--
ALTER TABLE `data_customer`
  ADD PRIMARY KEY (`id_customer`);

--
-- Indexes for table `data_jumlah_penjualan`
--
ALTER TABLE `data_jumlah_penjualan`
  ADD PRIMARY KEY (`id_data_jumlah_penjualan`),
  ADD KEY `no_invoices` (`no_invoices`),
  ADD KEY `id_account_penulis` (`id_account_penulis`);

--
-- Indexes for table `data_jumlah_penjualan_toko`
--
ALTER TABLE `data_jumlah_penjualan_toko`
  ADD PRIMARY KEY (`id_penjualan_toko`),
  ADD KEY `id_account` (`id_account`),
  ADD KEY `invoices_toko` (`invoices_toko`);

--
-- Indexes for table `data_kota`
--
ALTER TABLE `data_kota`
  ADD PRIMARY KEY (`id_data_kota`);

--
-- Indexes for table `data_kupon`
--
ALTER TABLE `data_kupon`
  ADD PRIMARY KEY (`id_data_kupon`);

--
-- Indexes for table `data_penjualan`
--
ALTER TABLE `data_penjualan`
  ADD PRIMARY KEY (`id_data_penjualan`),
  ADD KEY `no_invoices` (`no_invoices`);

--
-- Indexes for table `data_penjualan_toko`
--
ALTER TABLE `data_penjualan_toko`
  ADD PRIMARY KEY (`id_data_penjualan_toko`),
  ADD KEY `invoices_toko` (`invoices_toko`);

--
-- Indexes for table `data_transfer_royalti`
--
ALTER TABLE `data_transfer_royalti`
  ADD PRIMARY KEY (`id_data_transfer_royalti`),
  ADD KEY `id_account` (`id_account`);

--
-- Indexes for table `file_naskah_penulis`
--
ALTER TABLE `file_naskah_penulis`
  ADD PRIMARY KEY (`id_file_naskah`),
  ADD KEY `id_account` (`id_account`),
  ADD KEY `id_kategeori_naskah` (`id_kategori_naskah`);

--
-- Indexes for table `id_penulis`
--
ALTER TABLE `id_penulis`
  ADD PRIMARY KEY (`id_total_penulis`);

--
-- Indexes for table `kategori_naskah`
--
ALTER TABLE `kategori_naskah`
  ADD PRIMARY KEY (`id_kategori`),
  ADD KEY `id_kategeori_naskah` (`id_kategori_naskah`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_admin`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `akun_penulis`
--
ALTER TABLE `akun_penulis`
  MODIFY `id_akun_penulis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4928;
--
-- AUTO_INCREMENT for table `buku_terlaris`
--
ALTER TABLE `buku_terlaris`
  MODIFY `id_buku_terlaris` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `data_alamat`
--
ALTER TABLE `data_alamat`
  MODIFY `id_data_alamat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `data_customer`
--
ALTER TABLE `data_customer`
  MODIFY `id_customer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `data_jumlah_penjualan`
--
ALTER TABLE `data_jumlah_penjualan`
  MODIFY `id_data_jumlah_penjualan` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `data_jumlah_penjualan_toko`
--
ALTER TABLE `data_jumlah_penjualan_toko`
  MODIFY `id_penjualan_toko` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `data_kota`
--
ALTER TABLE `data_kota`
  MODIFY `id_data_kota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=502;
--
-- AUTO_INCREMENT for table `data_kupon`
--
ALTER TABLE `data_kupon`
  MODIFY `id_data_kupon` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `data_penjualan`
--
ALTER TABLE `data_penjualan`
  MODIFY `id_data_penjualan` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `data_penjualan_toko`
--
ALTER TABLE `data_penjualan_toko`
  MODIFY `id_data_penjualan_toko` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `data_transfer_royalti`
--
ALTER TABLE `data_transfer_royalti`
  MODIFY `id_data_transfer_royalti` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `file_naskah_penulis`
--
ALTER TABLE `file_naskah_penulis`
  MODIFY `id_file_naskah` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `id_penulis`
--
ALTER TABLE `id_penulis`
  MODIFY `id_total_penulis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `kategori_naskah`
--
ALTER TABLE `kategori_naskah`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `data_alamat`
--
ALTER TABLE `data_alamat`
  ADD CONSTRAINT `data_alamat_ibfk_1` FOREIGN KEY (`id_account_toko`) REFERENCES `akun_penulis` (`id_account`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `data_jumlah_penjualan`
--
ALTER TABLE `data_jumlah_penjualan`
  ADD CONSTRAINT `data_jumlah_penjualan_ibfk_1` FOREIGN KEY (`id_account_penulis`) REFERENCES `akun_penulis` (`id_account`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `data_jumlah_penjualan_toko`
--
ALTER TABLE `data_jumlah_penjualan_toko`
  ADD CONSTRAINT `data_jumlah_penjualan_toko_ibfk_1` FOREIGN KEY (`id_account`) REFERENCES `akun_penulis` (`id_account`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `data_penjualan`
--
ALTER TABLE `data_penjualan`
  ADD CONSTRAINT `data_penjualan_ibfk_1` FOREIGN KEY (`no_invoices`) REFERENCES `data_jumlah_penjualan` (`no_invoices`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `data_penjualan_toko`
--
ALTER TABLE `data_penjualan_toko`
  ADD CONSTRAINT `data_penjualan_toko_ibfk_1` FOREIGN KEY (`invoices_toko`) REFERENCES `data_jumlah_penjualan_toko` (`invoices_toko`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `data_transfer_royalti`
--
ALTER TABLE `data_transfer_royalti`
  ADD CONSTRAINT `data_transfer_royalti_ibfk_1` FOREIGN KEY (`id_account`) REFERENCES `akun_penulis` (`id_account`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `file_naskah_penulis`
--
ALTER TABLE `file_naskah_penulis`
  ADD CONSTRAINT `file_naskah_penulis_ibfk_2` FOREIGN KEY (`id_kategori_naskah`) REFERENCES `kategori_naskah` (`id_kategori_naskah`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `file_naskah_penulis_ibfk_3` FOREIGN KEY (`id_account`) REFERENCES `akun_penulis` (`id_account`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
