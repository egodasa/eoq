-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 03, 2018 at 12:18 PM
-- Server version: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_amsterdam`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE IF NOT EXISTS `barang` (
  `kd_barang` varchar(10) NOT NULL,
  `nama_barang` varchar(50) NOT NULL,
  `nm_supp` varchar(10) NOT NULL,
  `hrg_beli` int(11) NOT NULL,
  `hrg_jual` int(11) NOT NULL,
  `stok_awal` int(11) unsigned NOT NULL,
  `stok_ak` int(11) unsigned NOT NULL,
  `biaya_pesan` int(11) NOT NULL,
  `biaya_simpan` int(11) NOT NULL,
  `lead_time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`kd_barang`, `nama_barang`, `nm_supp`, `hrg_beli`, `hrg_jual`, `stok_awal`, `stok_ak`, `biaya_pesan`, `biaya_simpan`, `lead_time`) VALUES
('BR001', 'Disk Ps2', 'Multi game', 5000, 7000, 50, 25, 0, 0, 0),
('BR002', 'Memory Ps2', 'Elvandini ', 35000, 50000, 50, 38, 0, 0, 0),
('BR003', 'Stick Ps2 Biasa', 'Elvandini ', 35000, 45000, 100, 98, 0, 0, 0),
('BR004', 'Playstation 3 HDD 500 GB', 'Multi game', 5000000, 6500000, 2, 0, 0, 0, 0),
('BR005', 'Flasdisk', 'Multi game', 50000, 55000, 10, 0, 0, 0, 0),
('Br006', 'svfdv', 'sdcsd', 8000, 8000, 80, 60, 500, 500, 7);

-- --------------------------------------------------------

--
-- Table structure for table `eoq`
--

CREATE TABLE IF NOT EXISTS `eoq` (
  `id_eoq` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `kd_barang` varchar(10) NOT NULL,
  `nama_barang` varchar(50) NOT NULL,
  `biaya_pesan` int(11) NOT NULL,
  `biaya_simpan` int(11) NOT NULL,
  `lead_time` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `rqp` int(11) NOT NULL,
  `eoq` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `eoq`
--

INSERT INTO `eoq` (`id_eoq`, `tanggal`, `kd_barang`, `nama_barang`, `biaya_pesan`, `biaya_simpan`, `lead_time`, `jumlah`, `rqp`, `eoq`) VALUES
(26, '2018-06-28', 'BR001', 'Disk Ps2', 2500, 20, 14, 250, 52500, 4),
(27, '2018-06-30', 'BR003', 'Stick Ps2 Biasa', 2000, 15, 30, 250, 112500, 1),
(35, '2018-07-03', 'Br006', 'svfdv', 500, 500, 7, 40, 11200, 0),
(37, '2018-07-03', 'Br006', 'svfdv', 500, 500, 7, 40, 14, 9),
(38, '2018-07-03', 'Br006', 'svfdv', 500, 500, 7, 20, 7, 7);

-- --------------------------------------------------------

--
-- Table structure for table `pembelian`
--

CREATE TABLE IF NOT EXISTS `pembelian` (
  `id_pembelian` int(11) NOT NULL,
  `no_transaksi` varchar(10) NOT NULL,
  `tgl_transaksi` date NOT NULL,
  `kd_supp` varchar(10) NOT NULL,
  `petugas` varchar(50) NOT NULL,
  `kd_barang` varchar(10) NOT NULL,
  `nama_brg` varchar(50) NOT NULL,
  `jumlah` int(10) unsigned NOT NULL,
  `harga` int(10) unsigned NOT NULL,
  `total` int(10) unsigned NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembelian`
--

INSERT INTO `pembelian` (`id_pembelian`, `no_transaksi`, `tgl_transaksi`, `kd_supp`, `petugas`, `kd_barang`, `nama_brg`, `jumlah`, `harga`, `total`) VALUES
(3, 'C23445', '2018-06-28', '', '', 'BR001', 'Disk Ps2', 4, 5000, 20000),
(5, 'TR344', '2018-06-28', '', '', 'BR002', 'Memory Ps2', 5, 10000, 50000),
(6, 'gsdd', '2018-07-03', '', '', 'Br006', 'svfdv', 9, 5000, 45000);

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE IF NOT EXISTS `penjualan` (
  `id_penjualan` int(11) NOT NULL,
  `petugas` varchar(50) NOT NULL,
  `no_faktur` varchar(10) NOT NULL,
  `tgl_faktur` date NOT NULL,
  `kd_barang` varchar(10) NOT NULL,
  `nama_brg` varchar(50) NOT NULL,
  `jumlah` int(11) unsigned NOT NULL,
  `harga` int(11) unsigned NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penjualan`
--

INSERT INTO `penjualan` (`id_penjualan`, `petugas`, `no_faktur`, `tgl_faktur`, `kd_barang`, `nama_brg`, `jumlah`, `harga`, `total`) VALUES
(38, '', 'FT001', '2018-06-28', 'BR001', 'Disk Ps2', 5, 7000, 35000),
(39, '', 'FT001', '2018-06-28', 'BR002', 'Memory Ps2', 2, 50000, 100000),
(40, '', 'FT001', '2018-06-28', 'BR003', 'Stick Ps2 Biasa', 2, 45000, 90000),
(41, '', 'FT001', '2018-06-28', 'BR002', 'Memory Ps2', 4, 50000, 200000),
(42, '', 'FT012', '2018-06-30', 'BR002', 'Memory Ps2', 2, 50000, 100000),
(43, '', 'FT122', '2018-06-30', 'BR005', 'Flasdisk', 5, 55000, 275000),
(44, '', 'jjjkjljl', '2018-07-03', 'BR001', 'Disk Ps2', 20, 7000, 140000),
(45, '', 'hhhhh', '2018-07-03', 'Br006', 'svfdv', 20, 8000, 160000),
(46, '', 'hhhhh', '2018-07-03', 'BR004', 'Playstation 3 HDD 500 GB', 2, 6500000, 13000000);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE IF NOT EXISTS `supplier` (
  `kd_supp` varchar(10) NOT NULL,
  `nama_supp` varchar(50) NOT NULL,
  `alamat_supp` varchar(100) NOT NULL,
  `telp_supp` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`kd_supp`, `nama_supp`, `alamat_supp`, `telp_supp`) VALUES
('EK', 'Elvandini Komputer', 'padang', '089898'),
('MG001', 'Multi Game', 'Padang', '0805454');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(3) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `level` int(3) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `nama`, `level`) VALUES
(1, 'baggudang', 'baggudang', 'baggudang', 1),
(5, 'karyawan', 'karyawan', 'karyawan', 2),
(6, 'pimpinan', 'pimpinan', 'pimpinan', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`kd_barang`);

--
-- Indexes for table `eoq`
--
ALTER TABLE `eoq`
  ADD PRIMARY KEY (`id_eoq`);

--
-- Indexes for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`id_pembelian`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`id_penjualan`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`kd_supp`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `eoq`
--
ALTER TABLE `eoq`
  MODIFY `id_eoq` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT for table `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `id_pembelian` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `id_penjualan` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=47;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
