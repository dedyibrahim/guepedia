-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 18 Sep 2018 pada 16.15
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
-- Struktur dari tabel `data_alamat`
--

CREATE TABLE `data_alamat` (
  `id_data_alamat` int(11) NOT NULL,
  `id_account_toko` varchar(100) NOT NULL,
  `nama_kota` varchar(100) NOT NULL,
  `nama_penerima` varchar(100) DEFAULT NULL,
  `nomor_kontak` varchar(100) NOT NULL,
  `nama_kecamatan` varchar(100) NOT NULL,
  `city_id` varchar(100) NOT NULL,
  `subdistrict_id` varchar(100) NOT NULL,
  `nama_provinsi` varchar(100) NOT NULL,
  `kode_pos` varchar(100) NOT NULL,
  `alamat_lengkap` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `nama_penerima` varchar(100) DEFAULT NULL,
  `nomor_kontak` varchar(100) DEFAULT NULL,
  `nama_kecamatan` varchar(100) DEFAULT NULL,
  `nama_provinsi` varchar(100) DEFAULT NULL,
  `kode_pos` varchar(100) DEFAULT NULL,
  `alamat_lengkap` text,
  `nilai_kupon` varchar(100) DEFAULT NULL,
  `hasil_kupon` varchar(100) DEFAULT NULL,
  `nama_kupon` varchar(100) DEFAULT NULL,
  `nama_promo` varchar(100) DEFAULT NULL,
  `nilai_promo` varchar(100) DEFAULT NULL,
  `hasil_promo` varchar(100) DEFAULT NULL,
  `ongkir` varchar(100) DEFAULT NULL,
  `kurir` varchar(100) DEFAULT NULL,
  `service` varchar(100) DEFAULT NULL,
  `metode_pembayaran` varchar(100) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `total_belanja` varchar(100) DEFAULT NULL,
  `total_bayar` varchar(100) DEFAULT NULL,
  `nomor_resi` varchar(100) DEFAULT NULL,
  `bukti_transfer` varchar(100) DEFAULT NULL,
  `nilai_transfer` varchar(100) DEFAULT NULL,
  `alasan_penolakan` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_kode_kupon`
--

CREATE TABLE `data_kode_kupon` (
  `id_data_kupon` int(11) NOT NULL,
  `id_account` varchar(100) DEFAULT NULL,
  `nama_penulis` varchar(100) DEFAULT NULL,
  `email_penulis` varchar(100) DEFAULT NULL,
  `nama_kupon` varchar(100) DEFAULT NULL,
  `nilai_kupon` varchar(100) DEFAULT NULL,
  `syarat_kupon` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_kode_promo`
--

CREATE TABLE `data_kode_promo` (
  `id_data_kode_promo` int(11) NOT NULL,
  `kode_promo` varchar(100) DEFAULT NULL,
  `nilai_promo` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

--
-- Dumping data untuk tabel `data_penjualan`
--

INSERT INTO `data_penjualan` (`id_data_penjualan`, `no_invoices`, `nama_customer`, `nomor_kontak`, `alamat_lengkap`, `jumlah_uang`, `kembalian`, `nama_biaya_lain`, `jumlah_biaya_lain`, `ppn`, `nilai_ppn`, `diskon_total`, `jumlah_diskon_total`, `total`, `total_bersih`, `tanggal_transaksi`, `subtotal`, `jumlah_diskon`, `total_royalti`, `bersih`, `status_penjualan`, `resi_pengiriman`) VALUES
(1, 'INV/18/09/2018/000000', 'Zainudi', '08127892032', 'Kp.bandan jakarta barat tambora', '53435545', '53365545', NULL, NULL, '10', NULL, NULL, NULL, '70000', '59500', '18/09/2018', '70000', '0', '10500', '59500', 'Selesai', '213123123'),
(2, 'INV/18/09/2018/000001', 'Dedy Ibrahim', '081289903664', 'Kp.Sumur Wangi Kel.Kayumanis Kec.Tanah Sareal Kota Bogor RT 01 RQ 07', '378000', '0', NULL, NULL, '10', NULL, NULL, NULL, '378000', '321300', '18/09/2018', '378000', '0', '56700', '321300', 'Pending', ''),
(3, 'INV/18/09/2018/000002', 'Dedy Ibrahim', '081289903664', 'Kp.Sumur Wangi Kel.Kayumanis Kec.Tanah Sareal Kota Bogor RT 01 RQ 07', '442165', '0', 'JNE REG', '18000', '10', NULL, NULL, NULL, '442165', '360540.25', '18/09/2018', '424165', '0', '63624.75', '360540.25', 'Pending', '');

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
-- Dumping data untuk tabel `data_transfer_royalti`
--

INSERT INTO `data_transfer_royalti` (`id_data_transfer_royalti`, `royalti`, `id_account`, `biaya_admin`, `royalti_bersih`, `bukti_transfer`) VALUES
(1, '94500', '004921', '6500', '88000', '9a4b99ca04e69a9ff58409db7616f32b.jpg');

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

--
-- Indexes for dumped tables
--

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
-- Indexes for table `data_kode_kupon`
--
ALTER TABLE `data_kode_kupon`
  ADD PRIMARY KEY (`id_data_kupon`),
  ADD KEY `id_account` (`id_account`);

--
-- Indexes for table `data_kode_promo`
--
ALTER TABLE `data_kode_promo`
  ADD PRIMARY KEY (`id_data_kode_promo`);

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_alamat`
--
ALTER TABLE `data_alamat`
  MODIFY `id_data_alamat` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `data_customer`
--
ALTER TABLE `data_customer`
  MODIFY `id_customer` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `data_jumlah_penjualan`
--
ALTER TABLE `data_jumlah_penjualan`
  MODIFY `id_data_jumlah_penjualan` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `data_jumlah_penjualan_toko`
--
ALTER TABLE `data_jumlah_penjualan_toko`
  MODIFY `id_penjualan_toko` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
--
-- AUTO_INCREMENT for table `data_kode_kupon`
--
ALTER TABLE `data_kode_kupon`
  MODIFY `id_data_kupon` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `data_kode_promo`
--
ALTER TABLE `data_kode_promo`
  MODIFY `id_data_kode_promo` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `data_penjualan`
--
ALTER TABLE `data_penjualan`
  MODIFY `id_data_penjualan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `data_penjualan_toko`
--
ALTER TABLE `data_penjualan_toko`
  MODIFY `id_data_penjualan_toko` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;
--
-- AUTO_INCREMENT for table `data_transfer_royalti`
--
ALTER TABLE `data_transfer_royalti`
  MODIFY `id_data_transfer_royalti` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
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
  ADD CONSTRAINT `data_jumlah_penjualan_ibfk_1` FOREIGN KEY (`no_invoices`) REFERENCES `data_penjualan` (`no_invoices`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `data_jumlah_penjualan_toko`
--
ALTER TABLE `data_jumlah_penjualan_toko`
  ADD CONSTRAINT `data_jumlah_penjualan_toko_ibfk_1` FOREIGN KEY (`id_account`) REFERENCES `akun_penulis` (`id_account`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `data_kode_kupon`
--
ALTER TABLE `data_kode_kupon`
  ADD CONSTRAINT `data_kode_kupon_ibfk_1` FOREIGN KEY (`id_account`) REFERENCES `akun_penulis` (`id_account`) ON DELETE CASCADE ON UPDATE CASCADE;

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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
