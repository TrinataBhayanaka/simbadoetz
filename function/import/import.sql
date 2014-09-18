-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 01, 2012 at 07:58 PM
-- Server version: 5.1.41
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `import`
--
CREATE DATABASE `import` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `import`;

-- --------------------------------------------------------

--
-- Table structure for table `harga_barang`
--

CREATE TABLE IF NOT EXISTS `harga_barang` (
  `nama_aset` varchar(30) DEFAULT NULL,
  `tanggal` varchar(20) DEFAULT NULL,
  `merk` varchar(30) DEFAULT NULL,
  `bahan` varchar(30) DEFAULT NULL,
  `keterangan` text,
  `harga` varchar(30) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `harga_barang`
--


-- --------------------------------------------------------

--
-- Table structure for table `mhs`
--

CREATE TABLE IF NOT EXISTS `mhs` (
  `nim` varchar(10) NOT NULL DEFAULT '',
  `namamhs` varchar(30) NOT NULL,
  `alamat` text NOT NULL,
  PRIMARY KEY (`nim`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mhs`
--

INSERT INTO `mhs` (`nim`, `namamhs`, `alamat`) VALUES
('M0001', 'AAAA', 'DEPOK'),
('M0002', 'BBBB', 'JAKARTA'),
('M0003', 'CCCC', 'SOLO'),
('M0004', 'DDDD', 'JOGJA'),
('M0005', 'EEEE', 'ACEH'),
('M0006', 'FFFFF', 'MEDAN'),
('', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `rkb`
--

CREATE TABLE IF NOT EXISTS `rkb` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tahun` varchar(10) DEFAULT NULL,
  `skpd` varchar(10) DEFAULT NULL,
  `lokasi` varchar(50) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `merk` varchar(50) DEFAULT NULL,
  `kode_brg` varchar(50) DEFAULT NULL,
  `jumlah` varchar(50) DEFAULT NULL,
  `harga` varchar(50) DEFAULT NULL,
  `total` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `rkb`
--

INSERT INTO `rkb` (`id`, `tahun`, `skpd`, `lokasi`, `nama`, `merk`, `kode_brg`, `jumlah`, `harga`, `total`) VALUES
(1, '2009', '123', 'Nias', 'mobil', 'honda', '123.321.12.6', '10', 'Rp. 100.000.000', 'Rp. 1000.000.000'),
(2, '2009', '123', 'Nias', 'mobil', 'honda', '123.321.12.6', '10', 'Rp. 100.000.000', 'Rp. 1000.000.000'),
(3, '2009', '123', 'Nias', 'mobil', 'honda', '123.321.12.6', '10', 'Rp. 100.000.000', 'Rp. 1000.000.000'),
(4, '2009', '123', 'Nias', 'mobil', 'honda', '123.321.12.6', '10', 'Rp. 100.000.000', 'Rp. 1000.000.000');

-- --------------------------------------------------------

--
-- Table structure for table `rkpb`
--

CREATE TABLE IF NOT EXISTS `rkpb` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tahun` varchar(10) DEFAULT NULL,
  `skpd` varchar(30) DEFAULT NULL,
  `lokasi` varchar(50) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `merk` varchar(50) DEFAULT NULL,
  `kode` varchar(50) DEFAULT NULL,
  `jumlah` varchar(10) DEFAULT NULL,
  `harga` varchar(50) DEFAULT NULL,
  `total` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `rkpb`
--

INSERT INTO `rkpb` (`id`, `tahun`, `skpd`, `lokasi`, `nama`, `merk`, `kode`, `jumlah`, `harga`, `total`) VALUES
(1, '2009', '123', 'Nias', 'mobil', 'honda', '123.321.12.6', '10', 'Rp. 100.000.000', 'Rp. 1000.000.000');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
