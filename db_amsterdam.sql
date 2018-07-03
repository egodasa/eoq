-- Adminer 4.6.2 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `barang`;
CREATE TABLE `barang` (
  `kd_barang` varchar(10) NOT NULL,
  `nama_barang` varchar(50) NOT NULL,
  `nm_supp` varchar(10) NOT NULL,
  `hrg_beli` int(11) NOT NULL,
  `hrg_jual` int(11) NOT NULL,
  `stok` int(11) unsigned NOT NULL,
  `biaya_pesan` int(11) NOT NULL,
  `biaya_simpan` int(11) NOT NULL,
  `lead_time` int(11) NOT NULL,
  PRIMARY KEY (`kd_barang`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `eoq`;
CREATE TABLE `eoq` (
  `id_eoq` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal` date NOT NULL,
  `kd_barang` varchar(10) NOT NULL,
  `nama_barang` varchar(50) NOT NULL,
  `biaya_pesan` int(11) NOT NULL,
  `biaya_simpan` int(11) NOT NULL,
  `lead_time` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `rqp` int(11) NOT NULL,
  `eoq` int(11) NOT NULL,
  PRIMARY KEY (`id_eoq`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `pembelian`;
CREATE TABLE `pembelian` (
  `id_pembelian` int(11) NOT NULL AUTO_INCREMENT,
  `no_transaksi` varchar(10) NOT NULL,
  `tgl_transaksi` date NOT NULL,
  `petugas` varchar(50) NOT NULL,
  `kd_barang` varchar(10) NOT NULL,
  `nama_brg` varchar(50) NOT NULL,
  `jumlah` int(10) unsigned NOT NULL,
  `harga` int(10) unsigned NOT NULL,
  `total` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id_pembelian`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `penjualan`;
CREATE TABLE `penjualan` (
  `id_penjualan` int(11) NOT NULL AUTO_INCREMENT,
  `petugas` varchar(50) NOT NULL,
  `no_faktur` varchar(10) NOT NULL,
  `tgl_faktur` date NOT NULL,
  `kd_barang` varchar(10) NOT NULL,
  `nama_brg` varchar(50) NOT NULL,
  `jumlah` int(11) unsigned NOT NULL,
  `harga` int(11) unsigned NOT NULL,
  `total` int(11) NOT NULL,
  PRIMARY KEY (`id_penjualan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `level` int(3) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- 2018-07-03 15:09:57
