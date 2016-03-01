-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 15, 2015 at 04:32 PM
-- Server version: 5.5.40-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_bpom`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity`
--

CREATE TABLE IF NOT EXISTS `activity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `activityValue` varchar(100) DEFAULT NULL,
  `n_status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `activity`
--

INSERT INTO `activity` (`id`, `activityValue`, `n_status`) VALUES
(1, 'surf', 1),
(2, 'welcome', 1),
(3, 'article', 1),
(4, 'register', 1),
(5, 'share', 1);

-- --------------------------------------------------------

--
-- Table structure for table `activity_log`
--

CREATE TABLE IF NOT EXISTS `activity_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `activityId` int(11) NOT NULL,
  `activityDesc` text NOT NULL,
  `source` varchar(20) NOT NULL,
  `datetimes` datetime NOT NULL,
  `n_status` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=49 ;

--
-- Dumping data for table `activity_log`
--

INSERT INTO `activity_log` (`id`, `userid`, `activityId`, `activityDesc`, `source`, `datetimes`, `n_status`) VALUES
(1, 10068, 1, 'home', '127.0.0.1', '2014-08-20 10:58:34', 1),
(2, 10068, 1, 'home', '127.0.0.1', '2014-08-20 10:58:59', 1),
(3, 10068, 2, 'login success', '127.0.0.1', '2014-08-20 11:09:09', 1),
(4, 10068, 2, 'login success', '127.0.0.1', '2014-08-20 11:12:23', 1),
(5, 10068, 1, 'pilih frame', '127.0.0.1', '2014-08-20 11:16:18', 1),
(6, 10068, 1, 'pilih frame', '127.0.0.1', '2014-08-20 11:16:43', 1),
(7, 10068, 2, 'login success', '127.0.0.1', '2014-08-20 16:36:09', 1),
(8, 10068, 2, 'login success', '127.0.0.1', '2014-08-20 17:16:03', 1),
(9, 10068, 1, 'pilih frame', '127.0.0.1', '2014-08-20 17:32:44', 1),
(10, 10068, 2, 'login success', '127.0.0.1', '2014-08-20 17:33:55', 1),
(11, 10068, 1, 'pilih frame', '127.0.0.1', '2014-08-20 17:33:57', 1),
(12, 10068, 2, 'login success', '127.0.0.1', '2014-08-20 17:34:29', 1),
(13, 10068, 1, 'pilih frame', '127.0.0.1', '2014-08-20 17:34:55', 1),
(14, 10068, 2, 'login success', '127.0.0.1', '2014-08-21 17:48:31', 1),
(15, 10068, 1, 'pilih frame', '127.0.0.1', '2014-08-21 17:48:32', 1),
(16, 10068, 1, 'upload foto', '127.0.0.1', '2014-08-21 17:48:36', 1),
(17, 10068, 2, 'login success', '127.0.0.1', '2014-08-21 20:16:56', 1),
(18, 10068, 1, 'pilih frame', '127.0.0.1', '2014-08-21 20:16:58', 1),
(19, 10068, 1, 'upload foto', '127.0.0.1', '2014-08-21 20:17:01', 1),
(20, 10068, 1, 'upload foto', '127.0.0.1', '2014-08-21 20:35:19', 1),
(21, 10068, 1, 'pilih frame', '127.0.0.1', '2014-08-21 20:35:22', 1),
(22, 10068, 1, 'pilih frame', '127.0.0.1', '2014-08-21 20:35:29', 1),
(23, 10068, 1, 'pilih frame', '127.0.0.1', '2014-08-21 20:39:21', 1),
(24, 10068, 1, 'pilih frame', '127.0.0.1', '2014-08-21 20:40:39', 1),
(25, 10068, 1, 'pilih frame', '127.0.0.1', '2014-08-21 20:45:51', 1),
(26, 10068, 1, 'upload foto', '127.0.0.1', '2014-08-21 20:46:01', 1),
(27, 10068, 1, 'upload foto', '127.0.0.1', '2014-08-21 20:48:13', 1),
(28, 10068, 1, 'pilih frame', '127.0.0.1', '2014-08-21 20:48:14', 1),
(29, 10068, 1, 'pilih frame', '127.0.0.1', '2014-08-21 20:52:40', 1),
(30, 10068, 1, 'pilih frame', '127.0.0.1', '2014-08-21 20:53:47', 1),
(31, 10068, 1, 'pilih frame', '127.0.0.1', '2014-08-21 20:53:57', 1),
(32, 10068, 1, 'pilih frame', '127.0.0.1', '2014-08-21 20:55:24', 1),
(33, 10068, 1, 'pilih frame', '127.0.0.1', '2014-08-21 20:55:31', 1),
(34, 10068, 1, 'pilih frame', '127.0.0.1', '2014-08-21 20:56:27', 1),
(35, 10068, 1, 'pilih frame', '127.0.0.1', '2014-08-21 20:57:07', 1),
(36, 10068, 1, 'pilih frame', '127.0.0.1', '2014-08-21 20:57:13', 1),
(37, 10068, 1, 'pilih frame', '127.0.0.1', '2014-08-21 20:57:40', 1),
(38, 10068, 1, 'pilih frame', '127.0.0.1', '2014-08-21 20:58:17', 1),
(39, 10068, 1, 'pilih frame', '127.0.0.1', '2014-08-21 20:58:55', 1),
(40, 10068, 1, 'upload foto', '127.0.0.1', '2014-08-21 21:02:02', 1),
(41, 10069, 2, 'login success', '127.0.0.1', '2014-08-21 21:15:51', 1),
(42, 10068, 2, 'login success', '127.0.0.1', '2014-08-21 21:47:10', 1),
(43, 10068, 1, 'pilih frame', '127.0.0.1', '2014-08-21 21:47:12', 1),
(44, 10068, 1, 'upload foto', '127.0.0.1', '2014-08-21 21:47:17', 1),
(45, 10068, 1, 'upload foto', '127.0.0.1', '2014-08-21 21:52:44', 1),
(46, 10068, 1, 'upload foto', '127.0.0.1', '2014-08-21 21:53:11', 1),
(47, 10068, 1, 'upload foto', '127.0.0.1', '2014-08-21 21:55:04', 1),
(48, 10068, 1, 'upload foto', '127.0.0.1', '2014-08-21 21:55:07', 1);

-- --------------------------------------------------------

--
-- Table structure for table `admin_member`
--

CREATE TABLE IF NOT EXISTS `admin_member` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `name` varchar(46) DEFAULT NULL,
  `nickname` varchar(50) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `register_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `menu_akses` varchar(300) DEFAULT NULL,
  `username` varchar(46) DEFAULT NULL,
  `type` int(11) NOT NULL DEFAULT '0' COMMENT '1:admin, 2:verifikator, 3:evaluator, 4: balai',
  `salt` varchar(200) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `n_status` int(3) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `admin_member`
--

INSERT INTO `admin_member` (`id`, `name`, `nickname`, `email`, `register_date`, `menu_akses`, `username`, `type`, `salt`, `password`, `n_status`) VALUES
(1, 'admin', 'admin', 'admin@example.com', '2014-08-07 22:56:36', '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24', 'admin', 1, 'codekir v3.0', 'b2e982d12c95911b6abeacad24e256ff3fa47fdb', 1),
(2, 'verifikator', 'admin', 'admin@example.com', '2014-08-07 22:56:36', '3,7,8,16', 'verifikator', 2, 'codekir v3.0', 'b2e982d12c95911b6abeacad24e256ff3fa47fdb', 1),
(3, 'evaluator', 'admin', 'admin@example.com', '2014-08-07 22:56:36', '7,8', 'evaluator', 3, 'codekir v3.0', 'b2e982d12c95911b6abeacad24e256ff3fa47fdb', 1),
(4, 'balai', 'admin', 'admin@example.com', '2014-08-07 22:56:36', '3,7,8,16,25', 'balai', 4, 'codekir v3.0', 'b2e982d12c95911b6abeacad24e256ff3fa47fdb', 1);

-- --------------------------------------------------------

--
-- Table structure for table `bpom_category`
--

CREATE TABLE IF NOT EXISTS `bpom_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(200) DEFAULT NULL,
  `description` varchar(300) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `relation` int(11) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `n_status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `bpom_category`
--

INSERT INTO `bpom_category` (`id`, `category_name`, `description`, `image`, `relation`, `create_date`, `n_status`) VALUES
(1, 'IT', 'Dunia teknologi', NULL, NULL, '2014-07-25 12:23:11', 1),
(2, 'Ekonomi', 'Dunia Ekonomi', NULL, NULL, '2014-07-25 12:23:11', 1);

-- --------------------------------------------------------

--
-- Table structure for table `bpom_evaluasi`
--

CREATE TABLE IF NOT EXISTS `bpom_evaluasi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `produkID` int(11) DEFAULT '0',
  `tanggalBeli` date DEFAULT NULL,
  `lokasiBeli` text,
  `jenisGambar` int(11) DEFAULT NULL COMMENT 'ref to product_image_type',
  `luasPeringatan_depan` varchar(5) DEFAULT NULL,
  `luasPeringatan_belakang` varchar(5) DEFAULT NULL,
  `warnaGambar` varchar(11) DEFAULT NULL,
  `namaProdusen` varchar(100) DEFAULT NULL,
  `evaluasiPeringatan` varchar(5) DEFAULT NULL COMMENT 'MK/TMK',
  `kadarNikotin` varchar(10) DEFAULT NULL,
  `kadarTar` varchar(10) DEFAULT NULL,
  `kadarPenulisan_sisi` varchar(50) DEFAULT NULL,
  `kadarTulisan` varchar(250) DEFAULT NULL,
  `pernyataanUtama` varchar(11) DEFAULT NULL,
  `kodeProduksi` varchar(50) DEFAULT NULL,
  `tanggalProduksi` date DEFAULT NULL,
  `pernyataanBatas_aman` varchar(11) DEFAULT NULL,
  `pernyataanZat_kimia` varchar(11) DEFAULT NULL,
  `kataPromotif` varchar(11) DEFAULT NULL,
  `evaluasiInformasi` varchar(5) DEFAULT NULL,
  `kesimpulan` varchar(255) DEFAULT NULL,
  `keterangan` varchar(200) DEFAULT NULL,
  `tahun` varchar(4) DEFAULT NULL,
  `harga` varchar(10) DEFAULT NULL,
  `tanggalEvaluasi` datetime DEFAULT NULL,
  `userid` int(11) DEFAULT NULL,
  `balaiID` int(11) DEFAULT NULL,
  `provinsi` varchar(10) DEFAULT NULL,
  `n_status` int(11) DEFAULT NULL COMMENT '1:import, 2:approve_balai, 3:reject, 4:approve_bpom',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=45 ;

--
-- Dumping data for table `bpom_evaluasi`
--

INSERT INTO `bpom_evaluasi` (`id`, `produkID`, `tanggalBeli`, `lokasiBeli`, `jenisGambar`, `luasPeringatan_depan`, `luasPeringatan_belakang`, `warnaGambar`, `namaProdusen`, `evaluasiPeringatan`, `kadarNikotin`, `kadarTar`, `kadarPenulisan_sisi`, `kadarTulisan`, `pernyataanUtama`, `kodeProduksi`, `tanggalProduksi`, `pernyataanBatas_aman`, `pernyataanZat_kimia`, `kataPromotif`, `evaluasiInformasi`, `kesimpulan`, `keterangan`, `tahun`, `harga`, `tanggalEvaluasi`, `userid`, `balaiID`, `provinsi`, `n_status`) VALUES
(1, 1, '2014-07-04', 'DKI Jakarta', 3, '39.13', '39.13', 'S', NULL, 'MK', '1.8', '32', 'S', 'S', 'Ada', '9142043133', '2014-06-23', 'Tidak Ada', 'Tidak Ada', 'Tidak Ada', 'MK', 'MK', NULL, '2014', '9,500', '2014-10-22 10:15:39', 1, 1, '29', 3),
(2, 2, '2014-07-04', 'DKI Jakarta', 2, '39.13', '39.13', 'S', NULL, 'MK', '1.8', '32', 'S', 'S', 'Ada', '(0631047121)', '2014-06-28', 'Tidak Ada', 'Tidak Ada', 'Tidak Ada', 'MK', 'MK', NULL, '2014', '12,400', '2014-10-22 10:15:39', 1, 1, '29', 1),
(3, 2, '2014-07-04', 'DKI Jakarta', 4, '39.13', '39.13', 'S', NULL, 'MK', '1.8', '32', 'S', 'S', 'Ada', '\n(0631047121)', '2014-06-28', 'Tidak Ada', 'Tidak Ada', 'Tidak Ada', 'MK', 'MK', NULL, '2014', '12,400', '2014-10-22 10:15:39', 1, 1, '29', 1),
(4, 2, '2014-07-04', 'DKI Jakarta', 1, '39.13', '39.13', 'S', NULL, 'MK', '1.8', '32', 'S', 'S', 'Ada', '\n(0631047121)', '2014-06-28', 'Tidak Ada', 'Tidak Ada', 'Tidak Ada', 'MK', 'MK', NULL, '2014', '12,400', '2014-10-22 10:15:39', 1, 1, '29', 2),
(5, 3, '2014-07-04', 'DKI Jakarta', 4, '40.23', '41.38', 'S', NULL, 'MK', '0.7', '8', 'S', 'S', 'Ada', '\n(HCD07C05)', '0000-00-00', 'Tidak Ada', 'Tidak Ada', 'Tidak Ada', 'TMK', 'TMK', NULL, '2014', '15,500', '2014-10-22 10:15:39', 1, 1, '29', 1),
(6, 3, '2014-07-04', 'DKI Jakarta', 1, '40.23', '41.38', 'S', NULL, 'MK', '0.7', '8', 'S', 'S', 'Ada', '\n(HCD07B05)', '0000-00-00', 'Tidak Ada', 'Tidak Ada', 'Tidak Ada', 'TMK', 'TMK', NULL, '2014', '15,500', '2014-10-22 10:15:39', 1, 1, '29', 1),
(7, 0, '2014-07-04', 'DKI Jakarta', 1, '40.22', '40.22', 'S', NULL, 'MK', '1.1', '18', 'S', 'S', 'Ada', '\n(ED44416606)', '2014-06-15', 'Tidak Ada', 'Tidak Ada', 'Tidak Ada', 'MK', 'MK', NULL, '2014', '13,475', '2014-10-22 10:15:39', 1, 1, '29', 3),
(8, 0, '2014-07-04', 'DKI Jakarta', 2, '40.22', '39.78', 'S', NULL, 'MK', '1.1', '18', 'S', 'S', 'Ada', '\n(ED44416046)', '2014-06-13', 'Tidak Ada', 'Tidak Ada', 'Tidak Ada', 'MK', 'MK', NULL, '2014', '13,475', '2014-10-22 10:15:39', 1, 1, '29', 3),
(9, 0, '2014-07-04', 'DKI Jakarta', 3, '40.22', '40.22', 'S', NULL, 'MK', '1.1', '18', 'S', 'S', 'Ada', '\n(ED44416604)', '2014-06-15', 'Tidak Ada', 'Tidak Ada', 'Tidak Ada', 'MK', 'MK', NULL, '2014', '13,475', '2014-10-22 10:15:39', 1, 1, '29', 3),
(10, 0, '2014-07-04', 'DKI Jakarta', 4, '40.22', '39.78', 'S', NULL, 'MK', '1.1', '18', 'S', 'S', 'Ada', '\n(ED44416406)', '2014-06-13', 'Tidak Ada', 'Tidak Ada', 'Tidak Ada', 'MK', 'MK', NULL, '2014', '13,475', '2014-10-22 10:15:39', 1, 1, '29', 3),
(11, 0, '2014-07-04', 'DKI Jakarta', 5, '40.22', '40.22', 'S', NULL, 'MK', '1.1', '18', 'S', 'S', 'Ada', '\n(ED44416406)', '2014-06-13', 'Tidak Ada', 'Tidak Ada', 'Tidak Ada', 'MK', 'MK', NULL, '2014', '13,475', '2014-10-22 10:15:39', 1, 1, '29', 3),
(12, 1, '2014-07-04', 'DKI Jakarta', 3, '39.13', '39.13', 'S', NULL, 'MK', '1.8', '32', 'S', 'S', 'Ada', '\n(9142043133)', '2014-06-23', 'Tidak Ada', 'Tidak Ada', 'Tidak Ada', 'MK', 'MK', NULL, '2014', '9,500', '2014-10-23 00:36:00', 1, 1, '26', 1),
(13, 2, '2014-07-04', 'DKI Jakarta', 1, '39.13', '39.13', 'S', NULL, 'MK', '1.8', '32', 'S', 'S', 'Ada', '\n(0631047121)', '2014-06-28', 'Tidak Ada', 'Tidak Ada', 'Tidak Ada', 'MK', 'MK', NULL, '2014', '12,400', '2014-10-23 00:36:00', 1, 1, '26', 1),
(14, 2, '2014-07-04', 'DKI Jakarta', 4, '39.13', '39.13', 'S', NULL, 'MK', '1.8', '32', 'S', 'S', 'Ada', '\n(0631047121)', '2014-06-28', 'Tidak Ada', 'Tidak Ada', 'Tidak Ada', 'MK', 'MK', NULL, '2014', '12,400', '2014-10-23 00:36:00', 1, 1, '26', 1),
(15, 2, '2014-07-04', 'DKI Jakarta', 1, '39.13', '39.13', 'S', NULL, 'MK', '1.8', '32', 'S', 'S', 'Ada', '\n(0631047121)', '2014-06-28', 'Tidak Ada', 'Tidak Ada', 'Tidak Ada', 'MK', 'MK', NULL, '2014', '12,400', '2014-10-23 00:36:00', 1, 1, '26', 1),
(16, 3, '2014-07-04', 'DKI Jakarta', 4, '40.23', '41.38', 'S', NULL, 'MK', '0.7', '8', 'S', 'S', 'Ada', '\n(HCD07C05)', '0000-00-00', 'Tidak Ada', 'Tidak Ada', 'Tidak Ada', 'TMK', 'TMK', NULL, '2014', '15,500', '2014-10-23 00:36:00', 1, 1, '26', 1),
(17, 3, '2014-07-04', 'DKI Jakarta', 1, '40.23', '41.38', 'S', NULL, 'MK', '0.7', '8', 'S', 'S', 'Ada', '\n(HCD07B05)', '0000-00-00', 'Tidak Ada', 'Tidak Ada', 'Tidak Ada', 'TMK', 'TMK', NULL, '2014', '15,500', '2014-10-23 00:36:00', 1, 1, '26', 1),
(18, 0, '2014-07-04', 'DKI Jakarta', 1, '40.22', '40.22', 'S', NULL, 'MK', '1.1', '18', 'S', 'S', 'Ada', '\n(ED44416606)', '2014-06-15', 'Tidak Ada', 'Tidak Ada', 'Tidak Ada', 'MK', 'MK', NULL, '2014', '13,475', '2014-10-23 00:36:00', 1, 1, '26', 1),
(19, 0, '2014-07-04', 'DKI Jakarta', 2, '40.22', '39.78', 'S', NULL, 'MK', '1.1', '18', 'S', 'S', 'Ada', '\n(ED44416046)', '2014-06-13', 'Tidak Ada', 'Tidak Ada', 'Tidak Ada', 'MK', 'MK', NULL, '2014', '13,475', '2014-10-23 00:36:00', 1, 1, '26', 1),
(20, 0, '2014-07-04', 'DKI Jakarta', 3, '40.22', '40.22', 'S', NULL, 'MK', '1.1', '18', 'S', 'S', 'Ada', '\n(ED44416604)', '2014-06-15', 'Tidak Ada', 'Tidak Ada', 'Tidak Ada', 'MK', 'MK', NULL, '2014', '13,475', '2014-10-23 00:36:00', 1, 1, '26', 1),
(21, 0, '2014-07-04', 'DKI Jakarta', 4, '40.22', '39.78', 'S', NULL, 'MK', '1.1', '18', 'S', 'S', 'Ada', '\n(ED44416406)', '2014-06-13', 'Tidak Ada', 'Tidak Ada', 'Tidak Ada', 'MK', 'MK', NULL, '2014', '13,475', '2014-10-23 00:36:00', 1, 1, '26', 1),
(22, 0, '2014-07-04', 'DKI Jakarta', 5, '40.22', '40.22', 'S', NULL, 'MK', '1.1', '18', 'S', 'S', 'Ada', '\n(ED44416406)', '2014-06-13', 'Tidak Ada', 'Tidak Ada', 'Tidak Ada', 'MK', 'MK', NULL, '2014', '13,475', '2014-10-23 00:36:00', 1, 1, '26', 1),
(23, 1, '2014-07-04', 'DKI Jakarta', 3, '39.13', '39.13', 'S', NULL, 'MK', '1.8', '32', 'S', 'S', 'Ada', '\n(9142043133)', '2014-06-23', 'Tidak Ada', 'Tidak Ada', 'Tidak Ada', 'MK', 'MK', NULL, '2014', '9,500', '2014-10-23 00:36:00', 1, 1, '26', 1),
(24, 2, '2014-07-04', 'DKI Jakarta', 1, '39.13', '39.13', 'S', NULL, 'MK', '1.8', '32', 'S', 'S', 'Ada', '\n(0631047121)', '2014-06-28', 'Tidak Ada', 'Tidak Ada', 'Tidak Ada', 'MK', 'MK', NULL, '2014', '12,400', '2014-10-23 00:36:00', 1, 1, '26', 1),
(25, 2, '2014-07-04', 'DKI Jakarta', 4, '39.13', '39.13', 'S', NULL, 'MK', '1.8', '32', 'S', 'S', 'Ada', '\n(0631047121)', '2014-06-28', 'Tidak Ada', 'Tidak Ada', 'Tidak Ada', 'MK', 'MK', NULL, '2014', '12,400', '2014-10-23 00:36:00', 1, 1, '26', 1),
(26, 2, '2014-07-04', 'DKI Jakarta', 1, '39.13', '39.13', 'S', NULL, 'MK', '1.8', '32', 'S', 'S', 'Ada', '\n(0631047121)', '2014-06-28', 'Tidak Ada', 'Tidak Ada', 'Tidak Ada', 'MK', 'MK', NULL, '2014', '12,400', '2014-10-23 00:36:00', 1, 1, '26', 1),
(27, 3, '2014-07-04', 'DKI Jakarta', 4, '40.23', '41.38', 'S', NULL, 'MK', '0.7', '8', 'S', 'S', 'Ada', '\n(HCD07C05)', '0000-00-00', 'Tidak Ada', 'Tidak Ada', 'Tidak Ada', 'TMK', 'TMK', NULL, '2014', '15,500', '2014-10-23 00:36:00', 1, 1, '26', 1),
(28, 3, '2014-07-04', 'DKI Jakarta', 1, '40.23', '41.38', 'S', NULL, 'MK', '0.7', '8', 'S', 'S', 'Ada', '\n(HCD07B05)', '0000-00-00', 'Tidak Ada', 'Tidak Ada', 'Tidak Ada', 'TMK', 'TMK', NULL, '2014', '15,500', '2014-10-23 00:36:00', 1, 1, '26', 1),
(29, 0, '2014-07-04', 'DKI Jakarta', 1, '40.22', '40.22', 'S', NULL, 'MK', '1.1', '18', 'S', 'S', 'Ada', '\n(ED44416606)', '2014-06-15', 'Tidak Ada', 'Tidak Ada', 'Tidak Ada', 'MK', 'MK', NULL, '2014', '13,475', '2014-10-23 00:36:00', 1, 1, '26', 1),
(30, 0, '2014-07-04', 'DKI Jakarta', 2, '40.22', '39.78', 'S', NULL, 'MK', '1.1', '18', 'S', 'S', 'Ada', '\n(ED44416046)', '2014-06-13', 'Tidak Ada', 'Tidak Ada', 'Tidak Ada', 'MK', 'MK', NULL, '2014', '13,475', '2014-10-23 00:36:00', 1, 1, '26', 1),
(31, 0, '2014-07-04', 'DKI Jakarta', 3, '40.22', '40.22', 'S', NULL, 'MK', '1.1', '18', 'S', 'S', 'Ada', '\n(ED44416604)', '2014-06-15', 'Tidak Ada', 'Tidak Ada', 'Tidak Ada', 'MK', 'MK', NULL, '2014', '13,475', '2014-10-23 00:36:00', 1, 1, '26', 1),
(32, 0, '2014-07-04', 'DKI Jakarta', 4, '40.22', '39.78', 'S', NULL, 'MK', '1.1', '18', 'S', 'S', 'Ada', '\n(ED44416406)', '2014-06-13', 'Tidak Ada', 'Tidak Ada', 'Tidak Ada', 'MK', 'MK', NULL, '2014', '13,475', '2014-10-23 00:36:16', 1, 2, '26', 1),
(33, 0, '2014-07-04', 'DKI Jakarta', 5, '40.22', '40.22', 'S', NULL, 'MK', '1.1', '18', 'S', 'S', 'Ada', '\n(ED44416406)', '2014-06-13', 'Tidak Ada', 'Tidak Ada', 'Tidak Ada', 'MK', 'MK', NULL, '2014', '13,475', '2014-10-23 00:36:16', 1, 2, '26', 1),
(34, 1, '2014-07-04', 'DKI Jakarta', 3, '39.13', '39.13', 'S', NULL, 'MK', '1.8', '32', 'S', 'S', 'Ada', '\n(9142043133)', '2014-06-23', 'Tidak Ada', 'Tidak Ada', 'Tidak Ada', 'MK', 'MK', NULL, '2014', '9,500', '2014-10-23 12:22:17', 1, 1, '01', 1),
(35, 2, '2014-07-04', 'DKI Jakarta', 1, '39.13', '39.13', 'S', NULL, 'MK', '1.8', '32', 'S', 'S', 'Ada', '\n(0631047121)', '2014-06-28', 'Tidak Ada', 'Tidak Ada', 'Tidak Ada', 'MK', 'MK', NULL, '2014', '12,400', '2014-10-23 12:22:17', 1, 1, '01', 1),
(36, 2, '2014-07-04', 'DKI Jakarta', 4, '39.13', '39.13', 'S', NULL, 'MK', '1.8', '32', 'S', 'S', 'Ada', '\n(0631047121)', '2014-06-28', 'Tidak Ada', 'Tidak Ada', 'Tidak Ada', 'MK', 'MK', NULL, '2014', '12,400', '2014-10-23 12:22:17', 1, 1, '01', 1),
(37, 2, '2014-07-04', 'DKI Jakarta', 1, '39.13', '39.13', 'S', NULL, 'MK', '1.8', '32', 'S', 'S', 'Ada', '\n(0631047121)', '2014-06-28', 'Tidak Ada', 'Tidak Ada', 'Tidak Ada', 'MK', 'MK', NULL, '2014', '12,400', '2014-10-23 12:22:17', 1, 1, '01', 1),
(38, 3, '2014-07-04', 'DKI Jakarta', 4, '40.23', '41.38', 'S', NULL, 'MK', '0.7', '8', 'S', 'S', 'Ada', '\n(HCD07C05)', '0000-00-00', 'Tidak Ada', 'Tidak Ada', 'Tidak Ada', 'TMK', 'TMK', NULL, '2014', '15,500', '2014-10-23 12:22:17', 1, 1, '01', 1),
(39, 3, '2014-07-04', 'DKI Jakarta', 1, '40.23', '41.38', 'S', NULL, 'MK', '0.7', '8', 'S', 'S', 'Ada', '\n(HCD07B05)', '0000-00-00', 'Tidak Ada', 'Tidak Ada', 'Tidak Ada', 'TMK', 'TMK', NULL, '2014', '15,500', '2014-10-23 12:22:17', 1, 1, '01', 1),
(40, 0, '2014-07-04', 'DKI Jakarta', 1, '40.22', '40.22', 'S', NULL, 'MK', '1.1', '18', 'S', 'S', 'Ada', '\n(ED44416606)', '2014-06-15', 'Tidak Ada', 'Tidak Ada', 'Tidak Ada', 'MK', 'MK', NULL, '2014', '13,475', '2014-10-23 12:22:17', 1, 1, '01', 1),
(41, 0, '2014-07-04', 'DKI Jakarta', 2, '40.22', '39.78', 'S', NULL, 'MK', '1.1', '18', 'S', 'S', 'Ada', '\n(ED44416046)', '2014-06-13', 'Tidak Ada', 'Tidak Ada', 'Tidak Ada', 'MK', 'MK', NULL, '2014', '13,475', '2014-10-23 12:22:17', 1, 1, '01', 1),
(42, 0, '2014-07-04', 'DKI Jakarta', 3, '40.22', '40.22', 'S', NULL, 'MK', '1.1', '18', 'S', 'S', 'Ada', '\n(ED44416604)', '2014-06-15', 'Tidak Ada', 'Tidak Ada', 'Tidak Ada', 'MK', 'MK', NULL, '2014', '13,475', '2014-10-23 12:22:17', 1, 1, '01', 1),
(43, 0, '2014-07-04', 'DKI Jakarta', 4, '40.22', '39.78', 'S', NULL, 'MK', '1.1', '18', 'S', 'S', 'Ada', '\n(ED44416406)', '2014-06-13', 'Tidak Ada', 'Tidak Ada', 'Tidak Ada', 'MK', 'MK', NULL, '2014', '13,475', '2014-10-23 12:22:17', 1, 1, '01', 1),
(44, 0, '2014-07-04', 'DKI Jakarta', 5, '40.22', '40.22', 'S', NULL, 'MK', '1.1', '18', 'S', 'S', 'Ada', '\n(ED44416406)', '2014-06-13', 'Tidak Ada', 'Tidak Ada', 'Tidak Ada', 'MK', 'MK', NULL, '2014', '13,475', '2014-10-23 12:22:17', 1, 1, '01', 1);

-- --------------------------------------------------------

--
-- Table structure for table `bpom_industri`
--

CREATE TABLE IF NOT EXISTS `bpom_industri` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `namaIndustri` varchar(100) DEFAULT NULL,
  `namaPimpinan` varchar(100) DEFAULT NULL,
  `noKTP` varchar(30) DEFAULT NULL,
  `jenisKelamin` int(11) DEFAULT NULL,
  `alamatPimpinan` varchar(255) DEFAULT NULL,
  `alamatPerusanaan` varchar(255) DEFAULT NULL,
  `provinsi` varchar(10) DEFAULT NULL,
  `kecamatan` varchar(50) DEFAULT NULL,
  `desa` varchar(50) DEFAULT NULL,
  `kodePos` varchar(10) DEFAULT NULL,
  `jalanRTRW` varchar(255) DEFAULT NULL,
  `noTelepon` varchar(20) DEFAULT NULL,
  `noFax` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `npwp` varchar(30) DEFAULT NULL,
  `createDate` datetime DEFAULT NULL,
  `n_status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `namaIndustri` (`namaIndustri`,`namaPimpinan`,`noKTP`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `bpom_industri`
--

INSERT INTO `bpom_industri` (`id`, `namaIndustri`, `namaPimpinan`, `noKTP`, `jenisKelamin`, `alamatPimpinan`, `alamatPerusanaan`, `provinsi`, `kecamatan`, `desa`, `kodePos`, `jalanRTRW`, `noTelepon`, `noFax`, `email`, `npwp`, `createDate`, `n_status`) VALUES
(1, 'csacac', 'ovan pulu', '11111', 1, 'pondok cina', NULL, '0402', 'kecamatan', 'desa', '12312', 'nama jalan', '000111', '121010', 'alamatemail@yahoo.com', '123-1111-3456-9089', '2014-11-04 12:15:09', 1),
(2, '', 'sacasa', 'cascascac', 1, 'ascsaca', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2014-11-13 18:44:01', 1),
(3, 'casca', 'csaca', '131', 1, 'acscaca', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2014-11-19 15:42:22', 1),
(4, 'dwqdwq', 'dwqdwq', 'dwqd', 1, 'dwqd', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2014-11-19 15:47:29', 1),
(6, 'casca', 'csacas', 'csac', 1, 'caca', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2014-11-19 15:50:00', 1),
(7, 'casca', 'csacas', 'csacsa', 1, 'csacas', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2014-11-19 15:50:49', 1),
(8, 'csacsa', 'csaca', 'cacsa', 1, 'csacsa', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2014-11-19 15:52:42', 1),
(9, 'casca', 'csaca', 'cascas', 1, 'casc', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2014-11-19 15:54:23', 1),
(11, 'dsadas', 'dsadas', 'dsadas', 1, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2014-11-19 15:55:33', 1),
(12, 'caca', 'cacas', 'casca', 1, 'caca', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2014-11-19 16:03:35', 1),
(13, 'csaca', 'csaca', 'csaca', 1, 'casca', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2014-11-19 16:11:24', 1),
(14, 'cascac', 'cacas', 'cacas', 1, 'caca', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2014-11-19 16:42:00', 1),
(15, 'PT ABC', 'Lana', '1231321', 1, 'asada', NULL, '0151', 'Kecamatan Kramat', 'senen', '111', 'Jl. Kramat', '111', '111', 'submit.ovan@gmail.com', '123131', '2014-11-21 15:09:16', 1),
(16, 'Trinata Teknologi', 'Ovan', '111', 1, 'depok', NULL, '0154', 'Pasar Minggu', 'Pejaten', '12345', 'Jalan Pejaten', '081234', '12345678', 'o.pulu@yahoo.com', '123131', '2014-12-03 11:43:50', 1),
(17, '', '', '', 1, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2014-12-04 10:11:56', 1),
(18, 'PT. maju mundur', 'Iswandi', '13214125314616', 1, 'jl percetajkan', NULL, '0601', 'testes', 'coba', '123345', 'Jl. raya', '08891503992', '', 'iswandizen@gmail.com', '563653546455644', '2015-09-10 14:32:22', 1),
(19, 'csasa', 'csaca', 'csacas', 1, 'casas', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2015-09-10 14:34:28', 1),
(20, 'pt nusantara', 'sugeng riyadi', '123456789012345', 1, 'jl. percetakan negara 23', NULL, '0151', 'gambir', 'duri pulo', '13910', 'jl. kh zainul arifin', '021 4244356', '0214244356', 'nusantara@gmail.com', '1237891234', '2015-09-10 14:36:29', 1),
(22, 'PT Napa', 'Direktur', '33503253734291112', 1, 'Johar Baru', NULL, '0151', 'cempaka putih', 'Rawasari', '10560', 'Percetakan negara 23', '0212422530', '0212422530', 'email@gmail.com', '', '2015-09-10 14:45:53', 1);

-- --------------------------------------------------------

--
-- Table structure for table `bpom_industri_pabrik`
--

CREATE TABLE IF NOT EXISTS `bpom_industri_pabrik` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `industriID` int(11) DEFAULT NULL,
  `provinsi` varchar(10) DEFAULT NULL,
  `kecamatan` varchar(50) DEFAULT NULL,
  `desa` varchar(50) DEFAULT NULL,
  `kodePos` varchar(20) DEFAULT NULL,
  `namaJalan` varchar(255) DEFAULT NULL,
  `noNPPBKC` varchar(100) DEFAULT NULL,
  `files` varchar(100) DEFAULT NULL,
  `data` text,
  `createDate` datetime DEFAULT NULL,
  `n_status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `bpom_industri_pabrik`
--

INSERT INTO `bpom_industri_pabrik` (`id`, `industriID`, `provinsi`, `kecamatan`, `desa`, `kodePos`, `namaJalan`, `noNPPBKC`, `files`, `data`, `createDate`, `n_status`) VALUES
(1, 1, '', 'dasdad', 'dsada', 'dsadada', 'dsadsasd', '1231.3.1.3132', '13f0621d6a5475d1cbfcb42d68fbaf7d.pdf', 'a:1:{s:8:"origFile";s:10:"pkti2a.pdf";}', '2014-11-13 19:44:36', 2),
(2, 1, '3002', 'sadasa', 'sada', 'dsadsa', 'dsada', 'dsada', '8c873177388d90479cd2a0840bff69b1.pdf', NULL, '2014-11-13 19:46:35', 1),
(3, 3, '3002', '0', '0', 'dsadsa', 'dsada', 'dsada', '1049749dafdeb51962334f26400dd454.pdf', NULL, '2014-11-13 19:50:43', 1),
(4, 4, '3002', 'saca', 'saca', 'dsadsa', 'dsada', 'dsada', '', NULL, '2014-11-13 19:51:55', 1),
(5, 0, '0252', 'bogor', 'bogor selatan', '111', ' jalan jalan', '0606130395', NULL, NULL, '2014-11-21 16:14:08', 1),
(6, 15, '0214', 'Kecamatan Kramat', 'casca', '2221321', 'cacacsa', '1231321311', NULL, NULL, '2014-11-21 16:20:07', 1),
(7, 15, '3003', 'Kecamatan Kramat', 'dsada', 'dsada', 'dsada', 'ewqeadw', NULL, NULL, '2014-11-21 16:38:40', 1),
(8, 16, '0154', 'Pasar Minggu', 'Pejaten', '12345', 'jalan pasar minggu', '123456', '', NULL, '2014-12-03 11:48:30', 1),
(9, 9, '2207', 'dasda', 'dsada', 'acsac', 'dsasada', '231312', '32b983ef956a32367f71f138ef5b2416.pdf', NULL, '2015-07-07 11:15:14', 1),
(10, 1, '', 'ada', 'dsada', 'acsac', 'aa', 'aaa', NULL, NULL, '2015-07-07 11:46:34', 2),
(11, 0, '1406', 'katingan', 'kel katingan', '111', 'jalan katingan', '12121212121', '', NULL, '2015-09-09 17:38:21', 1),
(12, 0, '0509', 'kecamatan', 'kel katingan', '12312', 'jalan katingan', '12121212121', NULL, NULL, '2015-09-09 17:39:09', 1),
(13, 0, '0509', 'kecamatan', 'kel katingan', '12312', 'jalan katingan', '12121212121', '', NULL, '2015-09-09 17:40:39', 1),
(14, 0, '0509', 'kecamatan', 'kel katingan', '12312', 'jalan katingan', '12121212121', '', NULL, '2015-09-09 17:41:04', 1),
(15, 0, '0509', 'kecamatan', 'kel katingan', '12312', 'jalan katingan', '12121212121', NULL, NULL, '2015-09-09 17:41:27', 1),
(16, 0, '0509', 'kecamatan', 'kel katingan', '12312', 'jalan katingan', '12121212121', NULL, NULL, '2015-09-09 17:42:34', 1),
(17, 0, '0318', 'kecamatan', 'kel katingan', '12312', 'jalan katingan', '12121212121', '8b48c2c8663714b8decd66f4e7b6c6a5.pdf', NULL, '2015-09-09 17:43:29', 1),
(18, 1, '0401', 'kecamatan', 'kel katingan', '12312', 'dsasada', '1111111111', '8d17cf4e8848df260e531a987fb8c160.pdf', NULL, '2015-09-09 17:47:12', 1),
(19, 18, '', 'ksadnjhd', 'jkdfjf', '13654', 'jl. hghdhvf', '3726.5.8.1258', '10e42d02cfb203ffd2b3a07f27381798.pdf', 'a:1:{s:8:"origFile";s:16:"boardingPass.pdf";}', '2015-09-10 15:14:20', 1),
(20, 18, '', 'hgghdghg', 'hdfsgfhsdgf', '1426257', 'jl.kjkhsjgjfh', '6567.5.6.7657', '159efa3dc00613f140a8049039b61e2b.pdf', 'a:1:{s:8:"origFile";s:16:"boardingPass.pdf";}', '2015-09-10 15:31:45', 1),
(21, 1, '-Pilih Kab', '', '', '', '', '1213.1.2.3131', NULL, NULL, '2015-09-10 15:36:17', 2),
(22, 1, '-Pilih Kab', '', '', '', '', '1213.1.2.3131', '75863dd367651cebd92b91398029ab17.pdf', 'a:1:{s:8:"origFile";s:10:"pkti2a.pdf";}', '2015-09-10 15:36:41', 2),
(23, 20, '0322', 'banyurip', 'sukowaten', '11112', 'jl. sekar wengi', '1234.1.3.2345', '389de6c7b9e5ce8666e30ad2399ca753.pdf', 'a:1:{s:8:"origFile";s:17:"Note Tambahan.pdf";}', '2015-09-10 15:36:45', 1),
(24, 1, '', 'aaaaa', 'aaacc', '212311231', 'nama jalan baru', '1213.1.2.3121', 'c0e7656e48b8c2a711b515eb58d05a7c.pdf', 'a:1:{s:8:"origFile";s:10:"pkti2a.pdf";}', '2015-09-11 14:47:28', 1);

-- --------------------------------------------------------

--
-- Table structure for table `bpom_lab`
--

CREATE TABLE IF NOT EXISTS `bpom_lab` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) DEFAULT NULL,
  `alamat` varchar(300) DEFAULT NULL,
  `penanggungjawab` varchar(100) DEFAULT NULL,
  `n_status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `bpom_lab`
--

INSERT INTO `bpom_lab` (`id`, `nama`, `alamat`, `penanggungjawab`, `n_status`) VALUES
(1, 'UPT Pengujian Sertifikasi Mutu Barang - Lembaga Tembakau', 'Jakarta', 'Lana', 1);

-- --------------------------------------------------------

--
-- Table structure for table `bpom_news_content`
--

CREATE TABLE IF NOT EXISTS `bpom_news_content` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parentid` int(11) NOT NULL,
  `lid` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `brief` text NOT NULL,
  `content` text NOT NULL,
  `image` varchar(200) NOT NULL,
  `thumbnail_image` varchar(200) NOT NULL,
  `slider_image` varchar(200) NOT NULL,
  `categoryid` int(11) NOT NULL,
  `articleType` int(11) NOT NULL,
  `url` varchar(200) NOT NULL,
  `sourceurl` varchar(100) NOT NULL,
  `file` varchar(200) NOT NULL,
  `created_date` datetime NOT NULL,
  `expired_date` datetime NOT NULL,
  `posted_date` datetime NOT NULL,
  `fromwho` int(11) NOT NULL DEFAULT '0' COMMENT '0:web or admin ;1:user ;2:pages',
  `filesize` int(11) NOT NULL,
  `can_save` int(11) NOT NULL,
  `tags` text NOT NULL COMMENT 'format serialize tags',
  `authorid` int(11) NOT NULL,
  `n_status` int(11) NOT NULL DEFAULT '0',
  `topcontent` int(11) NOT NULL DEFAULT '0' COMMENT '0;standart;1:featured;2:review;3:interview',
  PRIMARY KEY (`id`),
  KEY `title` (`title`),
  KEY `categoryid` (`categoryid`),
  KEY `created_date` (`created_date`),
  KEY `posted_date` (`posted_date`),
  KEY `n_status` (`n_status`),
  KEY `articleTypeID` (`articleType`),
  KEY `image` (`image`),
  KEY `parentID` (`parentid`),
  KEY `lid` (`lid`),
  KEY `online` (`fromwho`),
  KEY `expired_date` (`expired_date`),
  KEY `url` (`url`),
  KEY `aid` (`authorid`),
  KEY `file` (`file`),
  KEY `slider_image` (`slider_image`),
  KEY `sourceurl` (`filesize`),
  KEY `thumbnail_image` (`thumbnail_image`),
  KEY `topcontent` (`topcontent`),
  KEY `sourceurl_2` (`sourceurl`),
  KEY `can_save` (`can_save`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `bpom_news_content`
--

INSERT INTO `bpom_news_content` (`id`, `parentid`, `lid`, `title`, `brief`, `content`, `image`, `thumbnail_image`, `slider_image`, `categoryid`, `articleType`, `url`, `sourceurl`, `file`, `created_date`, `expired_date`, `posted_date`, `fromwho`, `filesize`, `can_save`, `tags`, `authorid`, `n_status`, `topcontent`) VALUES
(1, 0, 0, '1 Tips si kecil tidur nyenyak hingga lelap dan lahap sampai selamanya', '', '&lt;span class=&quot;brief&quot;&gt;Usia Balita merupakan periode emas tumbuh kembang Si Kecil. Untuk mendukung pertumbuhansi kecil secara&lt;/span&gt;', '7f97ab29b00bc87ba72226b1f13cc4b3.jpg', '', '', 0, 0, '', '', 'http://localhost/nestle/nestle/public_assets/7f97ab29b00bc87ba72226b1f13cc4b3.jpg', '2014-08-10 15:47:02', '0000-00-00 00:00:00', '2014-09-01 22:23:17', 0, 0, 0, '', 1, 1, 0),
(2, 0, 0, '2 Tips si kecil tidur nyenyak hingga lelap dan lahap sampai selamanya', '', '&lt;span class=&quot;brief&quot;&gt;Usia Balita merupakan periode emas tumbuh kembang Si Kecil. Untuk mendukung pertumbuhansi kecil secara&lt;/span&gt;', '1d15a439732ff4756b0ea121e05ffa81.jpg', '', '', 0, 0, '', '', 'http://localhost/nestle/nestle/public_assets/1d15a439732ff4756b0ea121e05ffa81.jpg', '2014-08-10 15:47:02', '0000-00-00 00:00:00', '2014-09-01 22:23:25', 0, 0, 0, '', 1, 1, 0),
(3, 0, 0, '3 Tips si kecil tidur nyenyak hingga lelap dan lahap sampai selamanya', '', '&lt;span class=&quot;brief&quot;&gt;Usia Balita merupakan periode emas tumbuh kembang Si Kecil. Untuk mendukung pertumbuhansi kecil secara&lt;/span&gt;', '83badbf45943ed06a978e79baf77224a.jpg', '', '', 0, 0, '', '', 'http://localhost/nestle/nestle/public_assets/83badbf45943ed06a978e79baf77224a.jpg', '2014-08-10 15:47:02', '0000-00-00 00:00:00', '2014-09-01 22:23:33', 0, 0, 0, '', 1, 1, 0),
(4, 0, 0, '4 Tips si kecil tidur nyenyak hingga lelap dan lahap sampai selamanya', '', '&lt;span class=&quot;brief&quot;&gt;Usia Balita merupakan periode emas tumbuh kembang Si Kecil. Untuk mendukung pertumbuhansi kecil secara&lt;/span&gt;', 'db5086d7fa346198edea68b2d72f0d1f.jpg', '', '', 0, 0, '', '', 'http://localhost/nestle/nestle/public_assets/db5086d7fa346198edea68b2d72f0d1f.jpg', '2014-08-10 15:47:02', '0000-00-00 00:00:00', '2014-09-01 22:23:41', 0, 0, 0, '', 1, 1, 0),
(5, 0, 0, 'testing', 'csacsa', 'cascsasacac', '', '', '', 0, 0, '', '', '', '2014-10-22 14:19:15', '0000-00-00 00:00:00', '2014-10-21 00:00:00', 0, 0, 0, '', 1, 1, 0),
(6, 0, 0, 'adadadada mantab', 'csasacsa', 'csacaascas', '874dd9d3d522bea86dab39f580d818d8.png', '', '', 0, 1, '', '', 'http://localhost/bpom/public_assets/874dd9d3d522bea86dab39f580d818d8.png', '2014-10-22 14:35:57', '0000-00-00 00:00:00', '2014-12-04 07:42:58', 0, 0, 0, '', 0, 1, 0),
(7, 0, 0, 'kontak', 'kontak', 'kontak', '', '', '', 0, 0, '', '', '', '2014-10-22 14:42:30', '0000-00-00 00:00:00', '2014-10-14 00:00:00', 0, 0, 0, '', 0, 0, 0),
(8, 0, 0, 'aaa', 'aaa', 'aaa', '', '', '', 0, 0, '', '', '', '2014-10-22 14:43:41', '0000-00-00 00:00:00', '2014-10-15 00:00:00', 0, 0, 0, '', 0, 0, 0),
(9, 0, 0, 'b', 'bbbbbbbbbbb', 'bbbb', '', '', '', 0, 2, '', '', '', '2014-10-22 14:45:23', '0000-00-00 00:00:00', '2014-10-22 14:46:50', 0, 0, 0, '', 0, 1, 0),
(10, 0, 0, 'test input', 'Kini, makin banyak beredar rokok elektronik atau personal vapour. Penjualannya makin marak di internet, dan kini mulai merambah di pusat-pusat perbelanjaan. Sehingga, saat ini makin mudah melihat orang menghisap rokok elektronik (vaping). Hingga kini, Indonesia memang belum memiliki regulasi yang mengatur tentang penggunaan rokok elektronik.', '&lt;style type=&quot;text/css&quot;&gt;p { margin-bottom: 0.1in; direction: ltr; line-height: 120%; text-align: left; widows: 2; orphans: 2; }&lt;/style&gt;&lt;p style=&quot;margin-bottom: 0.11in; line-height: 108%&quot; align=&quot;justify&quot;&gt;Kini,makin banyak beredar rokok elektronik atau personal vapour.Penjualannya makin marak di internet,  dan kini mulai merambah dipusat-pusat perbelanjaan. Sehingga, saat ini makin mudah melihatorang menghisap rokok elektronik (vaping). Hingga kini, Indonesiamemang belum memiliki regulasi yang mengatur tentang penggunaan rokokelektronik.&lt;/p&gt;&lt;p style=&quot;margin-bottom: 0.11in; line-height: 108%&quot; align=&quot;justify&quot;&gt;BadanPengawas Obat dan Makanan (BPOM) sudah mendiskusikan hal ini bersamadengan Kementerian Kesehatan dalam beberapa waktu terakhirmembicarakan apa risiko serta manfaatnya. &quot;Kita tunggu aturanatau regulasi hal ini dari Kementerian Kesehatan. Tunggu tanggalmainnya saja,&quot; terang Kepala BPOM Dr. Ir. Roy AlexanderSparringa, M.App.Sc saat dihubungi oleh Health-Liputan6.com padaKamis (16/10/2014).&lt;/p&gt;&lt;p style=&quot;margin-bottom: 0.11in; line-height: 108%&quot; align=&quot;justify&quot;&gt;&quot;Nantijika sudah ada regulasinya kami akan bergerak sesuai regulasitersebut,&quot; terang Roy.&lt;/p&gt;&lt;p style=&quot;margin-bottom: 0.11in; line-height: 108%&quot; align=&quot;justify&quot;&gt;Bukanhanya Indonesia saja yang belum memiliki aturan jelas tentangpenggunaan vaping, negara-negara di Eropa umumnya belum memilikinya.Namun, Roy menjelaskan, bahwa negara tetangga seperti Australia,Singapura, dan Thailand dengan tegas melarang penggunaan rokokelektronik.&lt;/p&gt;&lt;p style=&quot;margin-bottom: 0.11in; line-height: 108%&quot; align=&quot;justify&quot;&gt;&quot;Bahkan,di negeri asalnya yakni Tiongkok dilarang,&quot; ujar pria kelahiranSidoarjo, 1 Mei 1962 ini.&lt;/p&gt;&lt;p style=&quot;margin-bottom: 0.11in; line-height: 108%&quot; align=&quot;justify&quot;&gt;Menurutnya,tak lama lagi Indonesia pun sudah akan mengeluarkan kejelasan tentangkeberadaan rokok elektronik ini. &lt;/p&gt;&lt;p style=&quot;margin-bottom: 0.11in; line-height: 108%&quot; align=&quot;justify&quot;&gt;(Sumber: Liputan6.com Jakarta 17 Oktober 2014)&lt;/p&gt;', '1a0687b834920126dd003a90319f52c1.png', '', '', 0, 0, '', '', 'http://localhost/bpom/public_assets/1a0687b834920126dd003a90319f52c1.png', '2014-12-04 06:56:27', '0000-00-00 00:00:00', '2014-12-04 10:29:22', 0, 0, 0, '', 1, 1, 0),
(11, 0, 0, 'visi misi', 'visi misi', 'visi misi', '6ba36484347032639da43649a4659693.jpg', '', '', 0, 3, '', '', 'http://localhost/bpom/public_assets/6ba36484347032639da43649a4659693.jpg', '2014-12-04 07:53:19', '0000-00-00 00:00:00', '2014-12-04 00:00:00', 0, 0, 0, '', 0, 1, 0),
(12, 0, 0, 'Tugas pokok', 'Tugas pokok', 'Tugas pokok', '4d455bdafcb2fe4789eac4bef3d71019.jpg', '', '', 0, 4, '', '', 'http://localhost/bpom/public_assets/4d455bdafcb2fe4789eac4bef3d71019.jpg', '2014-12-04 08:01:46', '0000-00-00 00:00:00', '2014-12-04 00:00:00', 0, 0, 0, '', 0, 1, 0),
(13, 0, 0, 'Publikasi peraturan', 'Publikasi peraturan', '&lt;b&gt;Lorem Ipsum&lt;/b&gt; is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.&lt;br&gt;&lt;br&gt;Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32.&lt;br&gt;', '2ca5f98729d8f92c8e08c7decfa03914.png', '', '', 0, 5, '', '', 'http://localhost/bpom/public_assets/2ca5f98729d8f92c8e08c7decfa03914.png', '2014-12-04 08:11:50', '0000-00-00 00:00:00', '2014-12-12 11:23:38', 0, 0, 0, '', 0, 1, 0),
(14, 0, 0, 'publikasi penelitian', 'publikasi penelitian', 'publikasi penelitian', 'c1ac25fac592429cd0506668b875109a.pdf', '', '', 0, 6, '', '', 'http://localhost/bpom/public_assets/c1ac25fac592429cd0506668b875109a.pdf', '2014-12-04 08:12:24', '0000-00-00 00:00:00', '2014-12-12 16:59:23', 0, 0, 0, '', 0, 1, 0),
(15, 0, 0, 'Data pengaduan', 'Data pengaduan', 'Data pengaduan', '', '', '', 0, 8, '', '', '', '2014-12-04 08:28:20', '0000-00-00 00:00:00', '2014-12-04 00:00:00', 0, 0, 0, '', 0, 1, 0),
(16, 0, 0, 'data faq', 'data faq', 'data faq', '', '', '', 0, 7, '', '', '', '2014-12-04 08:34:31', '0000-00-00 00:00:00', '2014-12-04 00:00:00', 0, 0, 0, '', 0, 1, 0),
(17, 0, 0, 'data prosedur', 'data prosedur', 'data prosedur', '', '', '', 0, 9, '', '', '', '2014-12-04 08:34:58', '0000-00-00 00:00:00', '2014-12-04 00:00:00', 0, 0, 0, '', 0, 1, 0),
(18, 0, 0, 'What is lorem ipsum 1', 'What is lorem ipsum 1', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32.', '', '', '', 0, 10, '', '', '', '2014-12-12 11:30:09', '0000-00-00 00:00:00', '2014-12-12 00:00:00', 0, 0, 0, '', 0, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `bpom_news_content_comment`
--

CREATE TABLE IF NOT EXISTS `bpom_news_content_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `contentid` int(11) NOT NULL,
  `comment` text NOT NULL,
  `date` datetime NOT NULL,
  `n_status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `date` (`date`),
  KEY `userid` (`userid`),
  KEY `contentid` (`contentid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `bpom_news_content_repo`
--

CREATE TABLE IF NOT EXISTS `bpom_news_content_repo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `brief` text NOT NULL,
  `content` text NOT NULL,
  `typealbum` int(11) NOT NULL COMMENT '1:local,4:fb,5:twitter',
  `gallerytype` int(11) NOT NULL COMMENT '1:frame,2:cover',
  `files` varchar(200) NOT NULL COMMENT 'can be image or song',
  `thumbnail` varchar(200) NOT NULL,
  `fromwho` int(11) NOT NULL COMMENT '0;admin;1:user;2:pages',
  `otherid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `n_status` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `otherid` (`otherid`),
  KEY `IDX_typeAlbum` (`typealbum`),
  KEY `IDX_Album_ID` (`gallerytype`),
  KEY `IDX_FROM_WHO` (`fromwho`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=360 ;

--
-- Dumping data for table `bpom_news_content_repo`
--

INSERT INTO `bpom_news_content_repo` (`id`, `title`, `brief`, `content`, `typealbum`, `gallerytype`, `files`, `thumbnail`, `fromwho`, `otherid`, `userid`, `created_date`, `n_status`) VALUES
(1, 'Upload foto from local store', '', '', 1, 0, 'da8de22919f7bcaa242758f4ded9bef6.jpeg', '', 0, 0, 10044, '2014-08-11 00:41:05', 1),
(2, 'Upload foto from local store', '', '', 1, 0, '69fe11d4347836d5945ef8e1e80d78b8.jpeg', '', 0, 0, 10044, '2014-08-11 00:43:24', 1),
(3, 'Upload foto from local store', '', '', 1, 0, '7f6dd5c9e93ac5ed2e7ea7a529e888d1.jpg', '', 0, 0, 10044, '2014-08-11 00:45:49', 1),
(4, 'Upload foto from local store', '', '', 1, 0, 'a7ac056a20b7adbc38f54da9657636e5.jpeg', '', 0, 0, 10044, '2014-08-11 00:47:27', 1),
(5, 'Upload foto from local store', '', '', 1, 0, '4919bdde439abe3e3a93ffd0f57db36a.jpeg', '', 0, 0, 10044, '2014-08-11 10:11:37', 1),
(6, 'frame', '', '', 1, 1, 'frame.png', '', 0, 0, 10044, '2014-08-11 10:11:37', 0),
(7, 'frame', '', '', 1, 1, 'frame2.png', '', 0, 0, 10044, '2014-08-11 10:11:37', 0),
(8, 'Upload foto from local store', '', '', 1, 0, 'd8350005ec6aafd2414b2ed8f5a6dd46.jpg', 'd8350005ec6aafd2414b2ed8f5a6dd46.jpg', 0, 0, 10044, '2014-08-11 11:23:17', 1),
(9, 'Upload foto from local store', '', '', 1, 0, 'ece8c207d4b48dd89dbc9441639782d8.jpg', 'ece8c207d4b48dd89dbc9441639782d8.jpg', 0, 0, 10044, '2014-08-11 11:30:13', 1),
(10, 'Upload foto from local store', '', '', 1, 0, '2421d170dff9a0e8200063ace7771ed7.jpg', '2421d170dff9a0e8200063ace7771ed7.jpg', 0, 0, 10044, '2014-08-11 11:37:57', 1),
(11, 'Upload foto from local store', '', '', 1, 0, 'c5cb9816ec8dfb53a4245c70fdb9ba54.jpg', 'c5cb9816ec8dfb53a4245c70fdb9ba54.jpg', 0, 0, 10044, '2014-08-11 11:43:26', 1),
(12, 'Upload foto from local store', '', '', 1, 0, '9da89522834ddcea363cf49b42ec59e9.jpg', '9da89522834ddcea363cf49b42ec59e9.jpg', 0, 0, 10044, '2014-08-11 11:45:18', 1),
(13, 'Upload foto from local store', '', '', 1, 0, '93bf6e98726ddadb3cfde4aca9644de5.jpg', '93bf6e98726ddadb3cfde4aca9644de5.jpg', 0, 0, 10044, '2014-08-11 11:59:59', 1),
(14, 'Upload foto from local store', '', '', 1, 0, '537c8c6336533c1c916253e88d611647.jpg', '537c8c6336533c1c916253e88d611647.jpg', 0, 0, 10044, '2014-08-11 12:02:01', 1),
(15, 'Upload foto from local store', '', '', 1, 0, '0234e1bb56e433e850bccf796fca8a94.jpg', '0234e1bb56e433e850bccf796fca8a94.jpg', 0, 0, 10046, '2014-08-11 12:18:40', 1),
(16, 'Upload foto from local store', '', '', 1, 0, 'a01dc2c47e3ac25e6fe09ce4a0d930a8.jpg', 'a01dc2c47e3ac25e6fe09ce4a0d930a8.jpg', 0, 0, 10046, '2014-08-11 13:03:32', 1),
(17, 'Upload foto from local store', '', '', 1, 0, 'a3146ae293e88564ac4b8b0023fffc4c.jpg', 'a3146ae293e88564ac4b8b0023fffc4c.jpg', 0, 0, 10046, '2014-08-11 13:06:39', 1),
(18, 'Upload foto from local store', '', '', 1, 0, 'e755652b9e8ff43e8c0b051184b1fea7.jpg', 'e755652b9e8ff43e8c0b051184b1fea7.jpg', 0, 0, 10044, '2014-08-11 13:07:46', 1),
(19, 'Upload foto from local store', '', '', 1, 0, '0b8c54a03ede9ba66b1e75bc7b6db4d0.jpg', '0b8c54a03ede9ba66b1e75bc7b6db4d0.jpg', 0, 0, 10044, '2014-08-11 13:09:45', 1),
(20, 'Upload foto from local store', '', '', 1, 0, '97ac1121dc6e00f584a478b7a5e27a32.jpg', '', 0, 0, 10044, '2014-08-11 13:14:05', 1),
(21, 'Upload foto from local store', '', '', 1, 0, '', '', 0, 0, 10044, '2014-08-11 13:14:51', 1),
(22, 'Upload foto from local store', '', '', 1, 0, '180ec3b88a7f8ca84c4a7f0afb36905f.png', '180ec3b88a7f8ca84c4a7f0afb36905f.png', 0, 0, 10044, '2014-08-11 13:15:32', 1),
(23, 'Upload foto from local store', '', '', 1, 0, '43699265a5b16e89f083daf30de2dd59.png', '43699265a5b16e89f083daf30de2dd59.png', 0, 0, 10044, '2014-08-11 15:23:50', 1),
(24, 'Upload foto from local store', '', '', 1, 0, '80c36fcd04b401a5e627b8b2d6e8afa0.jpg', '80c36fcd04b401a5e627b8b2d6e8afa0.jpg', 0, 0, 10050, '2014-08-11 19:32:10', 1),
(25, 'Upload foto from local store', '', '', 1, 0, 'fe0908073054564d204942f970302340.png', 'fe0908073054564d204942f970302340.png', 0, 0, 10044, '2014-08-11 19:35:02', 1),
(26, 'Upload foto from local store', '', '', 1, 0, '20e307bd9fcb7b4079786fa2b807ba8c.png', '20e307bd9fcb7b4079786fa2b807ba8c.png', 0, 0, 10050, '2014-08-11 19:36:41', 1),
(27, 'Upload foto from local store', '', '', 1, 0, '277c86a5f1dd51fe5fb55eebd7d68060.jpg', '277c86a5f1dd51fe5fb55eebd7d68060.jpg', 0, 0, 10044, '2014-08-11 19:43:35', 1),
(28, 'Upload foto from local store', '', '', 1, 0, '6f27e33e5365308e0b64615dbca8535e.png', '6f27e33e5365308e0b64615dbca8535e.png', 0, 0, 10065, '2014-08-11 21:19:45', 1),
(29, '', '', '', 2, 0, 'http://localhost/nestle/nestle/', '', 0, 0, 0, '2014-08-12 09:13:29', 1),
(30, '', '', '', 0, 1, 'http://localhost/nestle/nestle/', '', 0, 0, 0, '2014-08-12 09:21:10', 0),
(31, 'frame2.png', '', 'd99f9ca16180052619e7074bd9815c4c.png', 0, 1, 'http://localhost/nestle/nestle/public_assets/frame/d99f9ca16180052619e7074bd9815c4c.png', '', 0, 0, 0, '2014-08-12 09:22:30', 0),
(32, 'frame2.png', '', 'http://localhost/nestle/nestle/public_assets/frame/dd8a660b65edf0d1987cd419de7d6a6f.png', 0, 1, 'dd8a660b65edf0d1987cd419de7d6a6f.png', '', 0, 0, 0, '2014-08-12 09:29:42', 0),
(33, 'frame2.png', '', 'http://localhost/nestle/nestle/public_assets/frame/d009bb15ac8765a39ff20b10221d8832.png', 0, 1, 'd009bb15ac8765a39ff20b10221d8832.png', '', 0, 0, 0, '2014-08-12 09:32:42', 0),
(34, 'frame.png', '', 'http://localhost/nestle/nestle/public_assets/frame/bcb444784f2b409babb3183b1f927721.png', 0, 1, 'bcb444784f2b409babb3183b1f927721.png', '', 0, 0, 0, '2014-08-12 09:33:16', 0),
(35, 'nestle-activgro-profpic-2.png', '', 'http://localhost/nestle/nestle/public_assets/frame/f7ccd75d691f8e1511f121544976a346.png', 0, 1, 'f7ccd75d691f8e1511f121544976a346.png', '', 0, 0, 0, '2014-08-12 09:35:40', 0),
(36, 'nestle-activgro-profpic-1.png', '', 'http://localhost/nestle/nestle/public_assets/frame/ecca3bb5126cd9db8305ad8c6f647797.png', 0, 1, 'nestle-activgro-profpic-1.png', '', 0, 0, 0, '2014-08-12 09:35:52', 0),
(37, 'Upload foto from local store', '', '', 1, 0, '7c93a11e6ab61daf988b00a899c8c503.jpg', '', 0, 0, 10044, '2014-08-12 09:36:43', 1),
(38, 'Upload foto from local store', '', '', 1, 0, '855dbdfa1ac543914903e6be17a0eaf6.png', '', 0, 0, 10044, '2014-08-12 09:58:23', 1),
(39, 'Upload foto from album facebook', '', '', 1, 0, '/home/ovancop/Data/htdocs/nestle/nestle/public_assets/e0bee9fd6b213787e452ce0e218cf83c2e44cfc3jpg', '', 0, 0, 10044, '2014-08-12 12:27:58', 1),
(40, 'Upload foto from album facebook', '', '', 1, 0, 'e337e8e28fef7e634710e07f8125af0bb85d8fc4jpg', 'e337e8e28fef7e634710e07f8125af0bb85d8fc4jpg', 0, 0, 10044, '2014-08-12 12:29:44', 1),
(41, 'Upload foto from album facebook', '', '', 1, 0, 'a8aa8f3057d1699c76f6cf2311a3efa2d914a9c2jpg', 'a8aa8f3057d1699c76f6cf2311a3efa2d914a9c2jpg', 0, 0, 10044, '2014-08-12 12:30:59', 1),
(42, 'Upload foto from album facebook', '', '', 1, 0, '8a441ae82cbfbcc35995108b95a4bad65a0383f2jpg', '', 0, 0, 10044, '2014-08-12 12:31:21', 1),
(43, 'Upload foto from album facebook', '', '', 1, 0, '7633f534ac238e1e76dfbb74b2d4b2ca0ee0c63c.jpg', '7633f534ac238e1e76dfbb74b2d4b2ca0ee0c63c.jpg', 0, 0, 10044, '2014-08-12 12:33:27', 1),
(44, 'Upload foto from album facebook', '', '', 1, 0, '614b29219e30bbc1460b1b15df0532bf43cc109b.jpg', '', 0, 0, 10044, '2014-08-12 12:43:52', 1),
(45, 'Upload foto from local store', '', '', 1, 0, 'fc6c06a79e95ded2474d87bc4b165f06.png', '', 0, 0, 10044, '2014-08-12 18:12:08', 1),
(46, 'Upload foto from local store', '', '', 1, 0, '319c5590847b12876782282a5b037b9c.png', '', 0, 0, 10044, '2014-08-12 20:11:50', 1),
(47, 'Upload foto from local store', '', '', 1, 0, '39b12b30b3672e70a98f0b2f66bc5b08.png', '', 0, 0, 10044, '2014-08-12 20:13:15', 1),
(48, 'Upload foto from local store', '', '', 1, 0, '33150c033356e0c1de8c89bd3cd2f190.png', '', 0, 0, 10044, '2014-08-12 20:14:13', 1),
(49, 'Upload foto from local store', '', '', 1, 0, 'ecdd97890ce7849b000db8674d0c05c8.png', '', 0, 0, 10044, '2014-08-12 20:15:05', 1),
(50, 'Upload foto from local store', '', '', 1, 0, '84a7609f6418b84a612bbac955f7dfed.png', '', 0, 0, 10044, '2014-08-12 20:15:31', 1),
(51, 'Upload foto from local store', '', '', 1, 0, '1671d53ddfd2fd8244274ee4626f6f84.png', '', 0, 0, 10044, '2014-08-12 20:17:46', 1),
(52, 'Upload foto from local store', '', '', 1, 0, '9dee0e87629bdc16333aa6bb76e1ad3b.png', '', 0, 0, 10044, '2014-08-12 20:18:03', 1),
(53, 'nestle-activgro-profpic-1.png', '', 'http://localhost/nestle/nestle/public_assets/frame/ecca3bb5126cd9db8305ad8c6f647797.png', 0, 2, 'nestle-activgro-cover-1.jpg', '', 0, 36, 0, '2014-08-12 09:35:52', 1),
(54, 'nestle-activgro-profpic-2.png', '', 'http://localhost/nestle/nestle/public_assets/frame/f7ccd75d691f8e1511f121544976a346.png', 0, 2, 'nestle-activgro-cover-2.jpg', '', 0, 35, 0, '2014-08-12 09:35:40', 1),
(55, 'Upload foto from local store', '', '', 1, 0, '0b994d2e496b70b5fcae12226993c9da.png', '', 0, 0, 10044, '2014-08-13 13:09:08', 1),
(56, 'Upload foto from local store', '', '', 1, 0, '204587a242157e0c9cb5d3474660f153.png', '', 0, 0, 10044, '2014-08-13 13:14:25', 1),
(57, 'Upload foto from local store', '', '', 1, 0, 'a2e48b6725db9c375b34181b92bbaa75.png', '', 0, 0, 10044, '2014-08-13 13:31:00', 1),
(58, 'Upload foto from album facebook', '', '', 1, 0, '3c69e224f358c3139b32fef4954b6e448323cd0d.jpg', '', 0, 0, 10044, '2014-08-13 16:02:43', 1),
(59, 'Upload foto from local store', '', '', 1, 0, '30d4841794c43fa635dc73755085b8db.jpg', '', 0, 0, 10044, '2014-08-13 17:32:38', 1),
(60, 'Upload foto from local store', '', '', 1, 0, '90c6734d96d70c91b41a5ae945655c3a.png', '', 0, 0, 10044, '2014-08-13 17:51:38', 1),
(61, 'Upload foto from local store', '', '', 1, 0, '00ebe8ea57b6d8e34ea353be47969dfe.png', '', 0, 0, 10044, '2014-08-13 19:02:25', 1),
(62, 'Upload foto from local store', '', '', 1, 0, '3a6c6d0e6fe839ff65855654aebf9bb5.jpg', '', 0, 0, 10044, '2014-08-13 19:32:54', 1),
(63, 'Upload foto from local store', '', '', 1, 0, 'ca24981f1ea05adc9c1b12de6e752cee.jpg', '', 0, 0, 10044, '2014-08-13 20:03:33', 1),
(64, 'Upload foto from local store', '', '', 1, 0, '9b07c18281f296295b564869f3d8cf0c.png', '', 0, 0, 10044, '2014-08-13 20:27:50', 1),
(65, 'Upload foto from local store', '', '', 1, 0, '50874f0d21603d58a2303b465c522136.jpg', '', 0, 0, 10044, '2014-08-13 20:28:34', 1),
(66, 'Upload foto from local store', '', '', 1, 0, '966b09902fe835c24f6c813deccc4b8d.jpg', '', 0, 0, 10044, '2014-08-13 23:17:42', 1),
(67, 'Upload foto from local store', '', '', 1, 0, '17659664fb47908bf583d728766e7cf9.png', '', 0, 0, 10044, '2014-08-13 23:28:11', 1),
(68, 'Upload foto from local store', '', '', 1, 0, '944c48a131c4bc96eb6dabdbb8279118.png', '', 0, 0, 10044, '2014-08-13 23:33:08', 1),
(69, 'Upload foto from local store', '', '', 1, 0, 'e3c5d9ef7407da9a4efd7f686cfa9804.jpg', '', 0, 0, 10044, '2014-08-13 23:36:14', 1),
(70, 'Upload foto from local store', '', '', 1, 0, '31a5a95795db45d7f00b13d1bfb75158.png', '', 0, 0, 10044, '2014-08-14 00:26:29', 1),
(71, 'Upload foto from local store', '', '', 1, 0, '01caea4aaff355e332c2935430ce3554.jpg', 'cropped_01caea4aaff355e332c2935430ce3554.jpg', 0, 0, 10044, '2014-08-14 00:26:40', 1),
(72, 'Upload foto from local store', '', '', 1, 0, '6a50e3c0c147c57de43d4f0322fff5ad.jpg', 'cropped_6a50e3c0c147c57de43d4f0322fff5ad.jpg', 0, 0, 10044, '2014-08-14 00:29:45', 1),
(73, 'Upload foto from local store', '', '', 1, 0, '166e923e71665ae334fbaa3558e02c2b.jpg', 'cropped_166e923e71665ae334fbaa3558e02c2b.jpg', 0, 0, 10044, '2014-08-14 00:30:33', 1),
(74, 'Upload foto from local store', '', '', 1, 0, 'f28318ce7744dd757dba4fdbe5e4c3d4.jpg', 'cropped_f28318ce7744dd757dba4fdbe5e4c3d4.jpg', 0, 0, 10044, '2014-08-14 00:31:24', 1),
(75, 'Upload foto from local store', '', '', 1, 0, '5af14a45d96af07bc6000e7124a6cbe4.png', 'cropped_5af14a45d96af07bc6000e7124a6cbe4.png', 0, 0, 10044, '2014-08-14 00:32:00', 1),
(76, 'Upload foto from local store', '', '', 1, 0, '14294fdedb34b4d7fa84a53f92fd8de7.png', 'cropped_14294fdedb34b4d7fa84a53f92fd8de7.png', 0, 0, 10044, '2014-08-14 00:32:55', 1),
(77, 'Upload foto from local store', '', '', 1, 0, '38d0788343f37315d2b1b9d188254f17.png', 'cropped_38d0788343f37315d2b1b9d188254f17.png', 0, 0, 10044, '2014-08-14 00:33:54', 1),
(78, 'Upload foto from local store', '', '', 1, 0, 'a2cab3976cbe6a5e946acb9a36140602.png', 'cropped_a2cab3976cbe6a5e946acb9a36140602.png', 0, 0, 10044, '2014-08-14 00:35:21', 1),
(79, 'Upload foto from local store', '', '', 1, 0, '5754692794cc5ee2444ae14dd162dfa3.png', 'cropped_5754692794cc5ee2444ae14dd162dfa3.png', 0, 0, 10044, '2014-08-14 00:35:57', 1),
(80, 'Upload foto from local store', '', '', 1, 0, '9e3592f3759abede5490c798ffef0218.png', 'cropped_9e3592f3759abede5490c798ffef0218.png', 0, 0, 10044, '2014-08-14 00:41:16', 1),
(81, 'Upload foto from local store', '', '', 1, 0, '005cf4d0d08a9b45191d00fdc49e1f21.png', 'cropped_005cf4d0d08a9b45191d00fdc49e1f21.png', 0, 0, 10044, '2014-08-14 00:49:25', 1),
(82, 'Upload foto from local store', '', '', 1, 0, '32fb2b04db2cb75bf263bfa493fc80f8.jpg', 'cropped_32fb2b04db2cb75bf263bfa493fc80f8.jpg', 0, 0, 10044, '2014-08-14 00:51:49', 1),
(83, 'Upload foto from local store', '', '', 1, 0, 'c1fa3ec033258a6f9ba8fa7563d4d65c.jpg', '', 0, 0, 10044, '2014-08-14 01:18:20', 1),
(84, 'Upload foto from local store', '', '', 1, 0, 'b96dc4694c3e36d3c988b17fa5b5b0f5.jpg', '', 0, 0, 10044, '2014-08-14 01:18:43', 1),
(85, 'Upload foto from local store', '', '', 1, 0, '70761957f4286282eb99ac9bdb18ed87.jpg', 'cropped_70761957f4286282eb99ac9bdb18ed87.jpg', 0, 0, 10044, '2014-08-14 01:19:27', 1),
(86, 'Upload foto from local store', '', '', 1, 0, 'bd8655360c0ac264386bc3dafa9916d8.jpg', 'cropped_bd8655360c0ac264386bc3dafa9916d8.jpg', 0, 0, 10044, '2014-08-14 01:31:36', 1),
(87, 'Upload foto from local store', '', '', 1, 0, 'b37b0f7340eb2d9251bc1a751988da2f.png', 'cropped_b37b0f7340eb2d9251bc1a751988da2f.png', 0, 0, 10044, '2014-08-14 01:44:51', 1),
(88, 'Upload foto from local store', '', '', 1, 0, '4ad8b65884e23b3421499843cf3c1fc5.png', 'cropped_4ad8b65884e23b3421499843cf3c1fc5.png', 0, 0, 10044, '2014-08-14 02:18:19', 1),
(89, 'Upload foto from local store', '', '', 1, 0, '03783fca272c7643459994f324dec880.jpg', 'cropped_03783fca272c7643459994f324dec880.jpg', 0, 0, 10044, '2014-08-14 02:19:43', 1),
(90, 'Upload foto from local store', '', '', 1, 0, '2c9f04eca5c8830dd45a538c4ba57bcb.jpg', '', 0, 0, 10044, '2014-08-14 02:27:55', 1),
(91, 'Upload foto from local store', '', '', 1, 0, '56e835af5b26104cc19d49b0b6d7bbb4.jpg', 'cropped_56e835af5b26104cc19d49b0b6d7bbb4.jpg', 0, 0, 10044, '2014-08-14 02:28:21', 1),
(92, 'Upload foto from local store', '', '', 1, 0, '6c314dab7538e464f797e75659157792.jpg', 'cropped_6c314dab7538e464f797e75659157792.jpg', 0, 0, 10044, '2014-08-14 02:29:36', 1),
(93, 'Upload foto from local store', '', '', 1, 0, 'b601c835b94525f423d9f78a79338242.png', 'cropped_b601c835b94525f423d9f78a79338242.png', 0, 0, 10044, '2014-08-14 02:36:23', 1),
(94, 'Upload foto from local store', '', '', 1, 0, '984f60073585ad03611ac8d63803b964.png', '', 0, 0, 10044, '2014-08-14 02:37:49', 1),
(95, 'Upload foto from local store', '', '', 1, 0, 'e89c19bcde2f45efb6bac1f45d3248a3.png', 'cropped_e89c19bcde2f45efb6bac1f45d3248a3.png', 0, 0, 10044, '2014-08-14 02:50:39', 1),
(96, 'Upload foto from local store', '', '', 1, 0, '6be6843322a3c15d65451bc1e9eb7d34.jpg', 'cropped_6be6843322a3c15d65451bc1e9eb7d34.jpg', 0, 0, 10044, '2014-08-14 08:15:00', 1),
(97, 'Upload foto from local store', '', '', 1, 0, '54f8d81fbf3a1dfb75bfa738c27718c9.png', 'cropped_54f8d81fbf3a1dfb75bfa738c27718c9.png', 0, 0, 10044, '2014-08-14 08:28:18', 1),
(98, 'Upload foto from local store', '', '', 1, 0, '62e0516f26bb018459d505abee7493d4.png', '', 0, 0, 10044, '2014-08-14 08:41:49', 1),
(99, 'Upload foto from local store', '', '', 1, 0, '92ba8ad88b0b90be5d410cbb7a34526f.png', '', 0, 0, 10044, '2014-08-14 08:48:49', 1),
(100, 'Upload foto from local store', '', '', 1, 0, 'c4107a7477c0fafeebacf5ae2e1d6d5d.png', '', 0, 0, 10044, '2014-08-14 08:51:15', 1),
(101, 'Upload foto from local store', '', '', 1, 0, 'fb992a0a66c70909b74118b1b414e321.png', '', 0, 0, 10044, '2014-08-14 08:52:34', 1),
(102, 'Upload foto from local store', '', '', 1, 0, 'ade9ff7334f50208d19f71eb0ee92b21.png', '', 0, 0, 10044, '2014-08-14 08:53:45', 1),
(103, 'Upload foto from local store', '', '', 1, 0, '11c869f0532c244c84b4c11b5ea4cca8.png', '', 0, 0, 10044, '2014-08-14 09:15:54', 1),
(104, 'Upload foto from local store', '', '', 1, 0, '2660b504a991503bc1a896020a1e5b70.png', '', 0, 0, 10044, '2014-08-14 09:20:39', 1),
(105, 'Upload foto from local store', '', '', 1, 0, 'c52fffff16736f9d0588b1bec498cd5e.png', '', 0, 0, 10044, '2014-08-14 09:21:27', 1),
(106, 'Upload foto from local store', '', '', 1, 0, '85ad96232d55284c1245d8c92b248925.png', '', 0, 0, 10044, '2014-08-14 09:28:40', 1),
(107, 'nestle-activgro-profpic-1.png', '', 'de67dd8684bd5af086dc3334c71a6136.png', 2, 1, 'http://localhost/nestle/nestle/public_assets/frame/de67dd8684bd5af086dc3334c71a6136.png', '', 0, 0, 0, '2014-08-14 10:19:37', 0),
(108, 'Upload foto from local store', '', '', 1, 0, '6f9f913eec76d9a4c9f210fdeb75d461.jpg', '', 0, 0, 10046, '2014-08-14 11:57:57', 1),
(109, 'Upload foto from local store', '', '', 1, 0, '391ac9dd2a8466618290e4b6b6035f87.jpeg', '', 0, 0, 10044, '2014-08-15 11:25:09', 1),
(110, 'Upload foto from local store', '', '', 1, 0, 'c441ecf8564aee19701a8ec988d99c6f.jpeg', '', 0, 0, 10044, '2014-08-15 11:45:44', 1),
(111, 'Upload foto from local store', '', '', 1, 0, '74e4baf85dfbf853ca518c7a7739b486.jpeg', '', 0, 0, 10044, '2014-08-15 11:46:15', 1),
(112, 'Upload foto from local store', '', '', 1, 0, '57c86d7dded34df6f1369c724c1d44c2.jpeg', '', 0, 0, 10044, '2014-08-15 12:16:09', 1),
(113, 'Upload foto from local store', '', '', 1, 0, '608d8fd77105face306f75437e382f96.jpeg', '', 0, 0, 10044, '2014-08-15 12:18:06', 1),
(114, 'Upload foto from local store', '', '', 1, 0, '51551877dbfce44c43b65e58005f8234.jpeg', '', 0, 0, 10044, '2014-08-15 12:20:23', 1),
(115, 'Upload foto from local store', '', '', 1, 0, 'e2b9048027d06a35f00a7989687c7def.jpeg', '', 0, 0, 10044, '2014-08-15 12:25:35', 1),
(116, 'Upload foto from local store', '', '', 1, 0, '67fdccd16c7cfecc8b0dd8d3cf151acd.png', '', 0, 0, 10044, '2014-08-15 13:36:19', 1),
(117, 'Upload foto from local store', '', '', 1, 0, 'e4d75f2ad16e82f1cb90fdf7bbf33f56.jpeg', '', 0, 0, 10044, '2014-08-15 13:44:53', 1),
(118, 'Upload foto from local store', '', '', 1, 0, '911f418f892888ac04f2ce2959a6acee.png', '', 0, 0, 10044, '2014-08-19 19:17:42', 1),
(119, 'Upload foto from local store', '', '', 1, 0, '78e3fa55833cccec7cb21f2e284014d9.png', '', 0, 0, 10044, '2014-08-20 09:11:53', 1),
(120, 'Upload foto from local store', '', '', 1, 0, 'd72a1816c7f98223c53a3cbd5eb50514.jpg', '', 0, 0, 10069, '2014-08-20 10:09:53', 1),
(121, 'Upload foto from local store', '', '', 1, 0, '1cccb8500946b53636da8cff67457c5f.png', '', 0, 0, 10068, '2014-08-21 17:48:46', 1),
(122, 'Upload foto from local store', '', '', 1, 0, 'a6ca9431abc571e712e632d72c8e3173.png', '', 0, 0, 10068, '2014-08-21 20:17:08', 1),
(123, 'Upload foto from local store', '', '', 1, 0, 'a48da439c9fb0ea220d0ffacf530c2de.png', '', 0, 0, 10068, '2014-08-21 20:46:09', 1),
(124, 'Upload foto from local store', '', '', 1, 0, 'cce02794093cc799938e174f5be557ac.png', '', 0, 0, 10068, '2014-08-21 21:02:08', 1),
(125, 'Upload foto from local store', '', '', 1, 0, 'fc9d8bd201f70aba7da3f483abc82184.png', '', 0, 0, 10068, '2014-08-21 21:47:26', 1),
(126, 'Upload foto from local store', '', '', 1, 0, '4d3bef4a41f5e720e244195eea0b9b39.png', '', 0, 0, 10068, '2014-08-21 21:53:18', 1),
(127, 'Upload foto from local store', '', '', 1, 0, '9701bb3d010180a7c125184a93784fae.png', '', 0, 0, 10068, '2014-08-21 21:55:14', 1),
(128, 'Upload foto from local store', '', '', 1, 0, 'f6a394d99ed21935a0b0095e4af32c08.jpg', '', 0, 0, 10068, '2014-08-22 09:46:12', 1),
(129, 'Upload foto from local store', '', '', 1, 0, '766bc61edbcfba4930a3ed0ede8dcc59.jpg', '', 0, 0, 10068, '2014-08-22 10:00:31', 1),
(130, 'Upload foto from local store', '', '', 1, 0, '5219ce698ede79914a419c05a572cdcd.jpg', '', 0, 0, 10068, '2014-08-22 10:01:57', 1),
(131, 'Upload foto from local store', '', '', 1, 0, '2c4be5b49756792a14ba4d7daf89d16c.jpg', '', 0, 0, 10068, '2014-08-22 10:12:53', 1),
(132, 'Upload foto from local store', '', '', 1, 0, '15831c6c8b4d8e9d315e79fb7f513004.jpg', '', 0, 0, 10068, '2014-08-22 10:46:53', 1),
(133, 'Upload foto from local store', '', '', 1, 0, 'a1adf3a77a6483f7dc244ed8b8bca5ae.jpg', '', 0, 0, 10068, '2014-08-22 10:58:00', 1),
(134, 'Upload foto from local store', '', '', 1, 0, '79827175d41d8a949bf2c5d175290888.png', '', 0, 0, 10068, '2014-08-22 12:19:54', 1),
(135, 'Upload foto from local store', '', '', 1, 0, 'f1d58bfbcbc7c0b893edacbf5f42497f.png', '', 0, 0, 10068, '2014-08-22 13:38:53', 1),
(136, 'Upload foto from local store', '', '', 1, 0, 'd194a5df903795d3d33e919aa91e702e.png', '', 0, 0, 10068, '2014-08-22 15:21:07', 1),
(137, 'Upload foto from local store', '', '', 1, 0, 'f30637dd716c1b5e899215dd615a1216.png', '', 0, 0, 10068, '2014-08-22 15:27:33', 1),
(138, 'Upload foto from local store', '', '', 1, 0, '754da719a45b7043bc6759b484190e18.jpg', '', 0, 0, 10068, '2014-08-22 16:23:29', 1),
(139, 'Upload foto from local store', '', '', 1, 0, 'd970e19cbb5e3bafc3e0639c36f23dd8.png', '', 0, 0, 10068, '2014-08-22 16:49:32', 1),
(140, 'creative', '', 'ad8beac50ccb17340e2aceaa8fce3cfc.png', 4, 1, 'ad8beac50ccb17340e2aceaa8fce3cfc.png', '', 0, 0, 0, '2014-08-23 16:50:44', 1),
(141, 'creative', '', '46fb8dd5a2d3f2b19f70e61570357c04.jpg', 4, 2, '46fb8dd5a2d3f2b19f70e61570357c04.jpg', '', 0, 140, 0, '2014-08-23 16:50:44', 1),
(142, 'music', '', 'e2fd032d59adf5ff324125e8154398cc.png', 4, 1, 'e2fd032d59adf5ff324125e8154398cc.png', '', 0, 0, 0, '2014-08-23 16:51:37', 1),
(143, 'music', '', '8664e58e195cbdc57752f2e34ed75726.jpg', 4, 2, '8664e58e195cbdc57752f2e34ed75726.jpg', '', 0, 142, 0, '2014-08-23 16:51:37', 1),
(144, 'outdoor', '', '15af537619441d1c9179f773cca5c356.png', 4, 1, '15af537619441d1c9179f773cca5c356.png', '', 0, 0, 0, '2014-08-23 16:52:13', 0),
(145, 'outdoor', '', '70d60deed9a330f97e16eea6bc8404af.jpg', 4, 2, '70d60deed9a330f97e16eea6bc8404af.jpg', '', 0, 144, 0, '2014-08-23 16:52:13', 1),
(146, 'promo', '', '161197201ba5f556eeb8e12977badefc.png', 4, 1, '161197201ba5f556eeb8e12977badefc.png', '', 0, 0, 0, '2014-08-23 16:52:36', 0),
(147, 'promo', '', '0020229e51c6548d74ae5a2877895203.jpg', 4, 2, '0020229e51c6548d74ae5a2877895203.jpg', '', 0, 146, 0, '2014-08-23 16:52:36', 1),
(148, 'animal', '', 'a13de5ba065c6baf86ba36387b33caac.png', 5, 1, 'a13de5ba065c6baf86ba36387b33caac.png', '', 0, 0, 0, '2014-08-23 16:53:39', 0),
(149, 'animal', '', '1d11c7ff171bb3d6f9688271b0c387fe.jpg', 5, 2, '1d11c7ff171bb3d6f9688271b0c387fe.jpg', '', 0, 148, 0, '2014-08-23 16:53:39', 1),
(150, 'creative', '', 'd1d489c2b22b46bd20184bea22ccb59e.png', 5, 1, 'd1d489c2b22b46bd20184bea22ccb59e.png', '', 0, 0, 0, '2014-08-23 16:53:58', 0),
(151, 'creative', '', '24d40143ffeb2ff08fe09b1d69f20917.jpg', 5, 2, '24d40143ffeb2ff08fe09b1d69f20917.jpg', '', 0, 150, 0, '2014-08-23 16:53:58', 1),
(152, 'music', '', '8d7e80b94d24004b845b3f195b1bc80f.png', 5, 1, '8d7e80b94d24004b845b3f195b1bc80f.png', '', 0, 0, 0, '2014-08-23 16:54:14', 0),
(153, 'music', '', 'c06e8f6a689d8694567ff2ff8f6340d6.jpg', 5, 2, 'c06e8f6a689d8694567ff2ff8f6340d6.jpg', '', 0, 152, 0, '2014-08-23 16:54:14', 1),
(154, 'outdoor', '', 'c06ba243c3653d3d654c0c5a8511c6ff.png', 5, 1, 'c06ba243c3653d3d654c0c5a8511c6ff.png', '', 0, 0, 0, '2014-08-23 16:54:30', 0),
(155, 'outdoor', '', '49b2237c137b9de8e860fe0a3c381496.jpg', 5, 2, '49b2237c137b9de8e860fe0a3c381496.jpg', '', 0, 154, 0, '2014-08-23 16:54:30', 1),
(156, 'Upload foto from local store', '', '', 1, 0, '7f8949866d368f9d9450f80aa4aaf662.jpg', '', 0, 0, 10068, '2014-08-23 21:36:38', 1),
(157, 'Upload foto from local store', '', '', 1, 0, '93fe73d36c042153882eef6d626f03bf.png', '', 0, 0, 10068, '2014-08-23 22:06:27', 1),
(158, 'Upload foto from local store', '', '', 1, 0, '9aacfebea3815bf8d7d80d37cadad56c.png', '', 0, 0, 10068, '2014-08-23 22:06:47', 1),
(159, 'Upload foto from local store', '', '', 1, 0, 'caffbe40364c947980825e136a4a7e4c.png', '', 0, 0, 10068, '2014-08-23 22:07:06', 1),
(160, 'Upload foto from local store', '', '', 1, 0, 'd9921a85305aa6d8bc22eb4a7f9dd82c.png', '', 0, 0, 10068, '2014-08-23 22:07:18', 1),
(161, 'Upload foto from local store', '', '', 1, 0, '0e8458fb62aa691ad039d616cb8fdafa.png', '', 0, 0, 10068, '2014-08-23 22:07:46', 1),
(162, 'Upload foto from local store', '', '', 1, 0, '3140fbe960c35b650a115f39e79517d8.png', '', 0, 0, 10068, '2014-08-23 22:47:09', 1),
(163, 'Upload foto from local store', '', '', 1, 0, '8321f3c1d82255304cb341293de1410d.jpg', '', 0, 0, 10068, '2014-08-23 23:07:51', 1),
(164, 'Upload foto from local store', '', '', 1, 0, '4ce2171d29d07c662a5beae3e96854fb.png', '', 0, 0, 10068, '2014-08-23 23:08:06', 1),
(165, 'Upload foto from local store', '', '', 1, 0, '2d7ce3cae9732866c87c9dfee948fad3.jpg', '', 0, 0, 10068, '2014-08-23 23:14:21', 1),
(166, 'Upload foto from local store', '', '', 1, 0, '4a094109b858db9126f37091c534ec9d.png', '', 0, 0, 10068, '2014-08-23 23:15:41', 1),
(167, 'Upload foto from local store', '', '', 1, 0, '66b85edfeb838560cfbb6c6bd9bab18d.jpg', '', 0, 0, 10068, '2014-08-23 23:16:41', 1),
(168, 'Upload foto from local store', '', '', 1, 0, 'd32bff479f9c0d7ea949ce20f96e8db6.jpg', '', 0, 0, 10068, '2014-08-23 23:17:04', 1),
(169, 'Upload foto from local store', '', '', 1, 0, '09615b10b8e4ff4f3353ef8a65ad2640.jpg', '', 0, 0, 10068, '2014-08-23 23:17:45', 1),
(170, 'Upload foto from local store', '', '', 1, 0, '3273ca82c88e3e7b548c186457085faa.jpg', '', 0, 0, 10068, '2014-08-23 23:18:25', 1),
(171, 'Upload foto from local store', '', '', 1, 0, '75f5624b827956d2a4493260813612ed.jpg', '', 0, 0, 10068, '2014-08-23 23:19:28', 1),
(172, 'Upload foto from local store', '', '', 1, 0, 'cbae6f2f07ee2825ee1fa4cb3c74ab48.jpg', '', 0, 0, 10068, '2014-08-23 23:19:49', 1),
(173, 'Upload foto from local store', '', '', 1, 0, 'a846d067287d0edfc8a6287be8cd23aa.png', '', 0, 0, 10068, '2014-08-23 23:20:02', 1),
(174, 'Upload foto from local store', '', '', 1, 0, '3cb7eb35a9a64d10935efe58cecdc334.png', '', 0, 0, 10068, '2014-08-23 23:20:40', 1),
(175, 'Upload foto from local store', '', '', 1, 0, 'a8283ec6ed55ffe9a9b362eb49dd79d3.png', '', 0, 0, 10068, '2014-08-23 23:28:49', 1),
(176, 'Upload foto from local store', '', '', 1, 0, 'a161a164a8c539c2bd877dd59add3f52.png', '', 0, 0, 10068, '2014-08-23 23:33:09', 1),
(177, 'Upload foto from local store', '', '', 1, 0, '2bacb6c68690749a98f94e26dbc4466a.png', '', 0, 0, 10068, '2014-08-23 23:33:49', 1),
(178, 'Upload foto from local store', '', '', 1, 0, 'ba97edc71502fe3e17c77c50518da2a8.png', '', 0, 0, 10068, '2014-08-23 23:34:11', 1),
(179, 'Upload foto from local store', '', '', 1, 0, '71d2a1efe07b93ddd76db27922fc1a5a.png', '', 0, 0, 10068, '2014-08-23 23:34:49', 1),
(180, 'Upload foto from local store', '', '', 1, 0, '96842058e71c8e9331906ed5d17c7ea2.png', '', 0, 0, 10068, '2014-08-23 23:37:39', 1),
(181, 'Upload foto from local store', '', '', 1, 0, '550ea7ef36eb5c0ca77f477baadb1ec1.png', '', 0, 0, 10068, '2014-08-23 23:47:15', 1),
(182, 'Upload foto from local store', '', '', 1, 0, '908ce331f381fc3e16955cbca369a2ca.png', '', 0, 0, 10068, '2014-08-23 23:48:08', 1),
(183, 'Upload foto from local store', '', '', 1, 0, '90470e454aae75182eb3a6f085f689bd.jpg', '', 0, 0, 10068, '2014-08-23 23:49:39', 1),
(184, 'Upload foto from local store', '', '', 1, 0, '34adcd6217181ab45c12d5f8b74013e4.png', '', 0, 0, 10068, '2014-08-23 23:49:54', 1),
(185, 'Upload foto from local store', '', '', 1, 0, '9d0c561b703fc90332ac61395a15143e.png', '', 0, 0, 10068, '2014-08-23 23:50:25', 1),
(186, 'Upload foto from local store', '', '', 1, 0, '9926fdd7d21c1ccebc8ce7e9757602d4.png', '', 0, 0, 10068, '2014-08-23 23:53:36', 1),
(187, 'Upload foto from local store', '', '', 1, 0, 'a259536ddcae59f40e64f1505cf6cc4b.png', '', 0, 0, 10068, '2014-08-23 23:55:49', 1),
(188, 'Upload foto from local store', '', '', 1, 0, '1c78098f0a944ac41f4eb5e294c7b59e.png', '', 0, 0, 10068, '2014-08-23 23:57:20', 1),
(189, 'Upload foto from local store', '', '', 1, 0, '4d62cac30ee9a8b4f28a208250ab65e6.png', '', 0, 0, 10068, '2014-08-24 00:01:00', 1),
(190, 'Upload foto from local store', '', '', 1, 0, '6ad04f7fb62d71231a4a4e15839fe551.png', '', 0, 0, 10068, '2014-08-24 00:01:11', 1),
(191, 'Upload foto from local store', '', '', 1, 0, '63c7485913ce3367f07866d76997bc9e.png', '', 0, 0, 10068, '2014-08-24 00:05:18', 1),
(192, 'Upload foto from local store', '', '', 1, 0, 'f952a8945d95e9836a44c3320155b3bb.png', '', 0, 0, 10068, '2014-08-24 00:07:01', 1),
(193, 'Upload foto from local store', '', '', 1, 0, '424d0d3e3c485c159f74c7c204dcfa95.png', '', 0, 0, 10068, '2014-08-24 00:09:03', 1),
(194, 'Upload foto from local store', '', '', 1, 0, '17179ce7898c536a05341c6709256371.jpg', '', 0, 0, 10068, '2014-08-24 00:20:41', 1),
(195, 'Upload foto from local store', '', '', 1, 0, '54611878ded5d2dcbef8ae44fe0c450f.jpg', '', 0, 0, 10068, '2014-08-24 00:20:59', 1),
(196, 'Upload foto from local store', '', '', 1, 0, 'a23cbf60a4b857d28c7a14e9e120d1f2.png', '', 0, 0, 10068, '2014-08-24 00:21:11', 1),
(197, 'Upload foto from local store', '', '', 1, 0, 'bac2bb0b1c340a5b7906d79c03822413.png', '', 0, 0, 10068, '2014-08-24 00:21:42', 1),
(198, 'Upload foto from local store', '', '', 1, 0, 'c38ec52ade36e5f40339d25a8b99d64c.png', '', 0, 0, 10068, '2014-08-24 00:23:04', 1),
(199, 'Upload foto from local store', '', '', 1, 0, 'ace70d02ccbb9fbd490976ca371e9378.png', '', 0, 0, 10068, '2014-08-24 00:23:25', 1),
(200, 'Upload foto from local store', '', '', 1, 0, '5aaafe65c1876480787a850a34e5d019.png', '', 0, 0, 10068, '2014-08-24 00:23:46', 1),
(201, 'Upload foto from local store', '', '', 1, 0, '5ca81e8ac8dfa025db4aa34d684eccdd.png', '', 0, 0, 10068, '2014-08-24 00:24:07', 1),
(202, 'Upload foto from local store', '', '', 1, 0, 'ca5a06a4509e13d68d3ffbc5cccc34cf.png', '', 0, 0, 10068, '2014-08-24 00:28:20', 1),
(203, 'Upload foto from local store', '', '', 1, 0, 'de5b3ac1e90639c490676530954b2af6.png', '', 0, 0, 10069, '2014-08-24 00:30:06', 1),
(204, 'Upload foto from local store', '', '', 1, 0, '416f557b169e165cd73b4133e2621e07.png', '', 0, 0, 10069, '2014-08-24 00:39:15', 1),
(205, 'Upload foto from local store', '', '', 1, 0, '8109989e65afc0f265333756f48ec309.png', '', 0, 0, 10069, '2014-08-24 00:41:05', 1),
(206, 'Upload foto from local store', '', '', 1, 0, '43fc4219adb62c43ff8d862dbfd5bc68.png', '', 0, 0, 10069, '2014-08-24 00:41:59', 1),
(207, 'Upload foto from local store', '', '', 1, 0, 'f7cad9e9a96a84810de1f3d44a761f3b.png', '', 0, 0, 10069, '2014-08-24 00:46:11', 1),
(208, 'Upload foto from local store', '', '', 1, 0, 'a118d87723b865ed52e39a1c9df24647.png', '', 0, 0, 10069, '2014-08-24 00:48:30', 1),
(209, 'Upload foto from local store', '', '', 1, 0, '850b30b7a053c0e647f36690550e9611.png', '', 0, 0, 10069, '2014-08-24 00:49:46', 1),
(210, 'Upload foto from local store', '', '', 1, 0, 'baac8bf34f44af2f1e4e0bf983dc1fcd.png', '', 0, 0, 10069, '2014-08-24 00:55:50', 1),
(211, 'Upload foto from local store', '', '', 1, 0, 'fead71b5de1373c1a7c3f229af0b91fc.png', '', 0, 0, 10069, '2014-08-24 00:56:04', 1),
(212, 'Upload foto from local store', '', '', 1, 0, '195eeab61350f24c2586d890cb6ea2fb.png', '', 0, 0, 10069, '2014-08-24 00:59:01', 1),
(213, 'Upload foto from local store', '', '', 1, 0, '6f61eed267552826241a75cfcd12a6ab.png', '', 0, 0, 10069, '2014-08-24 00:59:38', 1),
(214, 'Upload foto from local store', '', '', 1, 0, 'a082c1009eeae0b1673ebc55a3202c39.png', '', 0, 0, 10069, '2014-08-24 01:00:45', 1),
(215, 'Upload foto from local store', '', '', 1, 0, 'ef3969c460663759582b9f218819a689.png', '', 0, 0, 10069, '2014-08-24 01:01:55', 1),
(216, 'Upload foto from local store', '', '', 1, 0, 'cb4f987747226728fe764648f2690a8e.png', '', 0, 0, 10069, '2014-08-24 01:02:27', 1),
(217, 'Upload foto from local store', '', '', 1, 0, '83a0ef07a83c7650f817a69d224f3fee.png', '', 0, 0, 10069, '2014-08-24 01:02:58', 1),
(218, 'Upload foto from local store', '', '', 1, 0, '984324b192f5fdfb80398bd8d31a7f4d.png', '', 0, 0, 10069, '2014-08-24 01:14:11', 1),
(219, 'Upload foto from local store', '', '', 1, 0, '292c562df030fb893d052a3fade4d800.png', '', 0, 0, 10069, '2014-08-24 01:27:09', 1),
(220, 'Upload foto from local store', '', '', 1, 0, 'f90360fd1c6c71e90f296bd98cdd0c61.png', '', 0, 0, 10069, '2014-08-24 01:27:25', 1),
(221, 'Upload foto from local store', '', '', 1, 0, '6e7e4e27476fa40eefcf4a33ad1460aa.png', '', 0, 0, 10070, '2014-08-24 01:34:57', 1),
(222, 'Upload foto from local store', '', '', 1, 0, '7df8b7fdf14fcba93a12f15e8370c10e.png', '', 0, 0, 10069, '2014-08-24 11:57:32', 1),
(223, 'Upload foto from local store', '', '', 1, 0, 'f1ee15007731b6a236410ef992f92f4f.png', '', 0, 0, 10071, '2014-08-26 12:33:34', 1),
(224, 'Upload foto from local store', '', '', 1, 0, '40ca0bd6c35247c6b63ab933ce48f309.png', '', 0, 0, 10071, '2014-08-26 15:26:31', 1),
(225, 'Upload foto from local store', '', '', 1, 0, 'f6aa62526efde6585b8652c245042a9c.jpeg', '', 0, 0, 10072, '2014-08-26 15:45:55', 1),
(226, 'Upload foto from local store', '', '', 1, 0, '8f2434e6f62e1232f9ff55351af82b6c.png', '', 0, 0, 10072, '2014-08-26 15:46:06', 1),
(227, 'Upload foto from album facebook', '', '', 1, 0, 'ffd3d62204209c6b6970b2d2f6891ad5549bca0d.jpg', '', 0, 0, 10071, '2014-08-26 17:48:53', 1),
(228, 'Upload foto from album facebook', '', '', 1, 0, '8a4074e87e0ea2b6f4e257d23abd8fc15725310a.jpg', '', 0, 0, 10071, '2014-08-26 17:51:15', 1),
(229, 'Upload foto from album facebook', '', '', 1, 0, 'ffd3d62204209c6b6970b2d2f6891ad5549bca0d.jpg', '', 0, 0, 10071, '2014-08-26 17:51:59', 1),
(230, 'Upload foto from album facebook', '', '', 1, 0, 'f2ffb77d4b0c4f3476f636023c633ddf0e8bb0d4.jpg', '', 0, 0, 10071, '2014-08-26 17:54:59', 1),
(231, 'Upload foto from album facebook', '', '', 1, 0, 'f2ffb77d4b0c4f3476f636023c633ddf0e8bb0d4.jpg', '', 0, 0, 10071, '2014-08-26 17:56:02', 1),
(232, 'Upload foto from album facebook', '', '', 1, 0, '65b99303c504e8fdb58cdee41f05e7dcb66d69fa.jpg', '', 0, 0, 10071, '2014-08-26 17:59:59', 1),
(233, 'Upload foto from album facebook', '', '', 1, 0, 'e02f85118b5752aa16c90fa3a67d6e427400c9a3.jpg', '', 0, 0, 10071, '2014-08-26 18:21:47', 1),
(234, 'Upload foto from album facebook', '', '', 1, 0, '3c69e224f358c3139b32fef4954b6e448323cd0d.jpg', '', 0, 0, 10071, '2014-08-26 19:52:46', 1),
(235, 'Upload foto from local store', '', '', 1, 0, '1efc70b22bbb3279d33484288c1800b4.jpeg', '', 0, 0, 10071, '2014-08-26 19:58:11', 1),
(236, 'Upload foto from local store', '', '', 1, 0, '91d4de4154a1613e06f46b8a4d382d15.png', '', 0, 0, 10071, '2014-08-27 10:56:26', 1),
(237, 'Upload foto from local store', '', '', 1, 0, 'de28637b7f706f5ce07599722d5b7b66.png', '', 0, 0, 10071, '2014-08-27 11:05:11', 1),
(238, 'Upload foto from local store', '', '', 1, 0, '5d4fa0b2f64d55f8c4435d7121f64998.png', '', 0, 0, 10071, '2014-08-27 11:06:00', 1),
(239, 'Upload foto from local store', '', '', 1, 0, '707ddf9f466d330f39d2503a8814045a.png', '', 0, 0, 10071, '2014-08-27 12:53:05', 1),
(240, 'Upload foto from local store', '', '', 1, 0, '7fa1f43aa3ba666db17cdcf50a144be2.png', '', 0, 0, 10071, '2014-09-01 01:42:29', 1),
(241, 'Upload foto from local store', '', '', 1, 0, '4c1e1691672cd11a73c206c3da724d1c.png', '', 0, 0, 10072, '2014-09-01 01:54:58', 1),
(242, 'Upload foto from local store', '', '', 1, 0, '647248bd3fdba6c5ab20f1450c2ff876.png', '', 0, 0, 10072, '2014-09-01 01:55:13', 1),
(243, 'Upload foto from local store', '', '', 1, 0, '4fd3e66ad07b379c406f507e00500516.png', '', 0, 0, 10071, '2014-09-02 01:21:57', 1),
(244, 'Upload foto from local store', '', '', 1, 0, 'cefe75c31388d730144042111d5eea34.png', '', 0, 0, 10072, '2014-09-02 12:57:56', 1),
(245, 'Creative', '', '76b8e6de15f12d52cfa165d42665aea7.png', 5, 1, '76b8e6de15f12d52cfa165d42665aea7.png', '', 0, 0, 0, '2014-09-02 13:01:58', 1),
(246, 'Creative', '', '7ac3b5755dccaa863be59b8db3c688e6.jpg', 5, 2, '7ac3b5755dccaa863be59b8db3c688e6.jpg', '', 0, 245, 0, '2014-09-02 13:01:58', 1),
(247, 'Upload foto from local store', '', '', 1, 0, 'd340b191f26678ca1a4db76070e48b86.png', '', 0, 0, 10072, '2014-09-02 13:02:30', 1),
(248, 'Upload foto from local store', '', '', 1, 0, '3a9d79a8800f04fe285b36cacc301166.jpeg', '', 0, 0, 10071, '2014-09-02 13:36:08', 1),
(249, 'Upload foto from local store', '', '', 1, 0, '820e222e0ba1913b42dacdf4cf2fd098.png', '', 0, 0, 10071, '2014-09-02 16:03:43', 1),
(250, 'Upload foto from local store', '', '', 1, 0, '7330d2a40efd9faecf87eec3989b8b37.jpg', '', 0, 0, 10072, '2014-09-02 20:54:06', 1),
(251, 'Upload foto from local store', '', '', 1, 0, 'ec5d2f4f3a898c7ff6d3fba547f49706.jpg', '', 0, 0, 10072, '2014-09-02 20:54:45', 1),
(252, 'Upload foto from local store', '', '', 1, 0, '276dc8471a5fc440a76656a6e54884ea.jpg', '', 0, 0, 10071, '2014-09-02 22:58:26', 1),
(253, 'Upload foto from local store', '', '', 1, 0, 'a116470acf6b3fb285a46696ad021bb9.png', '', 0, 0, 10071, '2014-09-03 17:16:54', 1),
(254, 'Upload foto from local store', '', '', 1, 0, 'a4b49fa23deec298075d25702369264c.png', '', 0, 0, 10071, '2014-09-04 16:34:52', 1),
(255, 'Upload foto from local store', '', '', 1, 0, '63c6009a5ee0484e95d31de12f4cb1d1.png', '', 0, 0, 10071, '2014-09-04 16:34:52', 1),
(256, 'Upload foto from local store', '', '', 1, 0, '694a1c0511c7a770ca568419174fa860.jpg', '', 0, 0, 10072, '2014-09-04 17:42:03', 1),
(257, 'Upload foto from local store', '', '', 1, 0, 'ab4ca6141cb24dc1273d77e357b72ba3.jpg', '', 0, 0, 10072, '2014-09-04 17:42:04', 1),
(258, 'Upload foto from local store', '', '', 1, 0, 'ea77281b6ff71fea712e9c0238b727c6.png', '', 0, 0, 10072, '2014-09-04 18:52:50', 1),
(259, 'Upload foto from local store', '', '', 1, 0, 'e1f587d2d13ce4b42c2511a52f4d388e.png', '', 0, 0, 10072, '2014-09-04 18:52:51', 1),
(260, 'Upload foto from local store', '', '', 1, 0, '7a46e7e04448aeed8fd4561932153284.png', '', 0, 0, 10072, '2014-09-04 21:44:33', 1),
(261, 'Upload foto from local store', '', '', 1, 0, '2f6c0936eee6bd7eed227e297e338391.png', '', 0, 0, 10072, '2014-09-04 21:44:33', 1),
(262, 'Upload foto from album facebook', '', '', 1, 0, 'ffd3d62204209c6b6970b2d2f6891ad5549bca0d.jpg', '', 0, 0, 10071, '2014-09-05 09:39:27', 1),
(263, 'Upload foto from local store', '', '', 1, 0, 'c3005b67cbcdda492ab0666453def94f.png', '', 0, 0, 10071, '2014-09-05 09:41:24', 1),
(264, 'Upload foto from local store', '', '', 1, 0, '95e91f741ff70e13fe71f36929a037fe.png', '', 0, 0, 10071, '2014-09-05 09:41:25', 1),
(265, 'Upload foto from local store', '', '', 1, 0, 'db126ac843f81b969b3ea1e3521e1de3.png', '', 0, 0, 10071, '2014-09-05 16:31:25', 1),
(266, 'Upload foto from local store', '', '', 1, 0, '990e8ce858d24c650a66b7bbe00b182b.png', '', 0, 0, 10071, '2014-09-05 16:31:25', 1),
(267, 'Upload foto from local store', '', '', 1, 0, '2f7e04da10983444815efde9a5dc67a6.png', '', 0, 0, 10071, '2014-09-05 17:09:19', 1),
(268, 'Upload foto from local store', '', '', 1, 0, '133f4e182f18acd2eb6bf2522a1830e5.png', '', 0, 0, 10071, '2014-09-05 17:09:20', 1),
(269, 'Upload foto from local store', '', '', 1, 0, '835ffc92e3e2abe218cde6d39b6af0c0.png', '', 0, 0, 10071, '2014-09-05 17:51:11', 1),
(270, 'Upload foto from local store', '', '', 1, 0, '5377f2820e27b222ac2a3b7c838327d9.png', '', 0, 0, 10071, '2014-09-05 17:51:11', 1),
(271, 'Upload foto from local store', '', '', 1, 0, 'ecab44ef27e4cddae39284066dc9ac61.png', '', 0, 0, 10071, '2014-09-05 17:51:53', 1),
(272, 'Upload foto from local store', '', '', 1, 0, '23dfe37276bdd122dcea392f164e41af.png', '', 0, 0, 10071, '2014-09-05 17:51:54', 1),
(273, 'Upload foto from local store', '', '', 1, 0, '821ec1971ac84f85ffe62c3fd66468fd.png', '', 0, 0, 10071, '2014-09-05 17:52:48', 1),
(274, 'Upload foto from local store', '', '', 1, 0, '18ceac29d476d6b17715b8623261d408.png', '', 0, 0, 10071, '2014-09-05 17:52:49', 1),
(275, 'Upload foto from local store', '', '', 1, 0, '7997948a624ed1ea73521c51759e71e8.png', '', 0, 0, 10071, '2014-09-05 19:51:36', 1),
(276, 'Upload foto from local store', '', '', 1, 0, '86e3239d91435ae5617b08ad7d878d00.png', '', 0, 0, 10071, '2014-09-05 19:51:38', 1),
(277, 'Upload foto from local store', '', '', 1, 0, 'c827bd36125b6d29eaa64c878f424dab.png', '', 0, 0, 10072, '2014-09-05 19:58:55', 1),
(278, 'Upload foto from local store', '', '', 1, 0, 'f182dd2576d2d951381ae0b528a951ea.png', '', 0, 0, 10072, '2014-09-05 19:58:56', 1),
(279, 'Upload foto from local store', '', '', 1, 0, '92de039a2e127d5760cbd365df88e376.png', '', 0, 0, 10071, '2014-09-05 20:05:38', 1),
(280, 'Upload foto from local store', '', '', 1, 0, '06c8e6b97b4ccce09551f9985bcaf696.png', '', 0, 0, 10071, '2014-09-05 20:05:38', 1),
(281, 'Upload foto from local store', '', '', 1, 0, '0e7b5f100731cce1cb52bdc16207a0f1.png', '', 0, 0, 10072, '2014-09-07 23:21:34', 1),
(282, 'Upload foto from local store', '', '', 1, 0, 'a36599e75a09fef412cf5de5c544931c.png', '', 0, 0, 10072, '2014-09-07 23:21:34', 1),
(283, 'Upload foto from local store', '', '', 1, 0, 'd54ba0740893c757182683e747e71e34.png', '', 0, 0, 10072, '2014-09-07 23:32:35', 1),
(284, 'Upload foto from local store', '', '', 1, 0, 'bdf3f799c9c9881da2b4ef2d892b3a8a.png', '', 0, 0, 10072, '2014-09-07 23:32:36', 1),
(285, 'Upload foto from local store', '', '', 1, 0, 'bd7a35254d1c61097ac6a25d7454b4ad.png', '', 0, 0, 10072, '2014-09-07 23:33:16', 1),
(286, 'Upload foto from local store', '', '', 1, 0, '71b55f2891a07a3252939d33a1b64eb6.png', '', 0, 0, 10072, '2014-09-07 23:33:17', 1),
(287, 'Upload foto from local store', '', '', 1, 0, '342cf71703e802c8cfcf4da9f0ac749f.png', '', 0, 0, 10072, '2014-09-07 23:34:27', 1),
(288, 'Upload foto from local store', '', '', 1, 0, '1d1c0d1dcac045988e154f60456d6d1d.png', '', 0, 0, 10072, '2014-09-07 23:34:27', 1),
(289, 'Upload foto from local store', '', '', 1, 0, '079c69abe3fd4c2a4fde00c41f03014c.png', '', 0, 0, 10072, '2014-09-07 23:36:05', 1),
(290, 'Upload foto from local store', '', '', 1, 0, 'f438735719aae91f0b1e420d728b8eb1.png', '', 0, 0, 10072, '2014-09-07 23:37:01', 1),
(291, 'Upload foto from local store', '', '', 1, 0, 'de329d962522669c9069481782e3fdd2.jpg', '', 0, 0, 10072, '2014-09-11 15:57:25', 1),
(292, 'animal', '', 'a68f5768ff5425cb6193fea979c773a0.png', 5, 1, 'a68f5768ff5425cb6193fea979c773a0.png', '', 0, 0, 0, '2014-09-19 14:07:39', 1),
(293, 'animal', '', '3170d43332b2d8c4512ae00a64cc8932.jpg', 5, 2, '3170d43332b2d8c4512ae00a64cc8932.jpg', '', 0, 292, 0, '2014-09-19 14:07:39', 1),
(294, 'Upload foto from local store', '', '', 1, 0, '8970fdc3ed374e1678788dfbe42dbc15.jpg', '', 0, 0, 10072, '2014-09-19 15:30:35', 1),
(295, 'Upload foto from local store', '', '', 1, 0, '7b6fdc09991f23f28d0357c8a650c809.jpg', '', 0, 0, 10072, '2014-09-19 15:35:43', 1),
(296, 'Upload foto from local store', '', '', 1, 0, '12e2c8b9cf9db15a244ad1726b35fa6f.jpg', '', 0, 0, 10072, '2014-09-19 17:44:02', 1),
(297, 'Upload foto from local store', '', '', 1, 0, '18d76aed2d9ed8ece8e19a99e05ca674.jpg', '', 0, 0, 10072, '2014-09-19 18:30:55', 1),
(298, 'Upload foto from local store', '', '', 1, 0, '2c947ef3c3aebd7b3166c86db590dc4e.png', '', 0, 0, 10072, '2014-09-19 18:48:04', 1),
(299, 'Upload foto from local store', '', '', 1, 0, '89b508f7b171539fc1286014526fbf3a.png', '', 0, 0, 10072, '2014-09-19 18:55:26', 1),
(300, 'Upload foto from local store', '', '', 1, 0, 'bef912cf6d451da40a3ff15b07210887.png', '', 0, 0, 10072, '2014-09-19 19:06:12', 1),
(301, 'Upload foto from local store', '', '', 1, 0, 'c4ce04aa3115b285de15759d0c0ea8ca.png', '', 0, 0, 10072, '2014-09-19 19:06:52', 1),
(302, 'Upload foto from local store', '', '', 1, 0, '2d903724f3837241b5f50d7b1dd807c8.jpg', '', 0, 0, 10072, '2014-09-19 19:07:47', 1),
(303, 'Upload foto from local store', '', '', 1, 0, '87c22792d3de72846ee004f858f71feb.png', '', 0, 0, 10072, '2014-09-19 19:09:04', 1),
(304, 'Upload foto from local store', '', '', 1, 0, '1e8b521c027c8583874aca7f576fa1c0.jpg', '', 0, 0, 10072, '2014-09-19 19:09:33', 1),
(305, 'Upload foto from local store', '', '', 1, 0, 'b12b84164e9cb1ec45f337e170ac19d7.jpg', '', 0, 0, 10072, '2014-09-19 19:27:40', 1),
(306, 'Upload foto from local store', '', '', 1, 0, '3991e684c8a2369c1196253f484eb8e9.jpg', '', 0, 0, 10072, '2014-09-19 19:28:01', 1),
(307, 'Upload foto from local store', '', '', 1, 0, '88f9600c4ce87c2df981d7d2ece93d7c.jpg', '', 0, 0, 10072, '2014-09-19 19:28:54', 1),
(308, 'Upload foto from local store', '', '', 1, 0, 'c59165fab3d6ad1e851631cf97a7a4dc.jpg', '', 0, 0, 10072, '2014-09-19 19:31:49', 1),
(309, 'Upload foto from local store', '', '', 1, 0, 'bf4d1a97a89c2413e3d55e3551305709.png', '', 0, 0, 10072, '2014-09-19 19:48:53', 1),
(310, 'Upload foto from local store', '', '', 1, 0, 'c578269d952fa928bac937ba47034528.png', '', 0, 0, 10072, '2014-09-19 19:50:04', 1),
(311, 'Upload foto from local store', '', '', 1, 0, '5a2b57834653289d9ffd9feb39875b96.png', '', 0, 0, 10072, '2014-09-19 19:53:23', 1),
(312, 'Upload foto from local store', '', '', 1, 0, '7a8d38783c62b2a0ff19b1f5b6bef4fc.png', '', 0, 0, 10072, '2014-09-19 19:54:12', 1),
(313, 'Upload foto from local store', '', '', 1, 0, '12b6aff3b36da63715220011024635cf.png', '', 0, 0, 10072, '2014-09-19 19:55:25', 1),
(314, 'Upload foto from local store', '', '', 1, 0, '1726b6aa3d43d10f1f9f3c5b02e58926.jpg', '', 0, 0, 10072, '2014-09-20 10:02:35', 1),
(315, 'Upload foto from local store', '', '', 1, 0, '1cc25e3ca0e03b3efac0be3668ce6c95.jpg', '', 0, 0, 10072, '2014-09-20 10:04:03', 1),
(316, 'Upload foto from local store', '', '', 1, 0, 'd261d1845c1d698fd9164a500def571e.png', '', 0, 0, 10072, '2014-09-23 08:50:29', 1),
(317, 'Upload foto from local store', '', '', 1, 0, 'd720cdf5a4f2051d16c75d25f46165b0.png', '', 0, 0, 10072, '2014-09-23 09:36:16', 1),
(318, 'Upload foto from local store', '', '', 1, 0, 'e08cb76b73e23c213f47ec196d50b28e.jpg', '', 0, 0, 10072, '2014-09-23 09:53:22', 1),
(319, 'Upload foto from local store', '', '', 1, 0, '54632708b0f51a036dbca3bff9746115.png', '', 0, 0, 10072, '2014-09-23 10:01:24', 1),
(320, 'Upload foto from local store', '', '', 1, 0, '4ced7f1e10a9bb25845c742a48f78b42.png', '', 0, 0, 10072, '2014-09-23 13:24:28', 1),
(321, 'Upload foto from local store', '', '', 1, 0, 'aa06dafbb289b45d7aaf2b78f97bf385.png', '', 0, 0, 10072, '2014-09-23 13:29:33', 1),
(322, 'Upload foto from local store', '', '', 1, 0, 'f35cfc2e504bb545be179c2bb53ad76b.png', '', 0, 0, 10076, '2014-09-23 16:00:59', 1),
(323, 'Upload foto from local store', '', '', 1, 0, '3f3c7cfa20fe43614b8755138961c917.png', '', 0, 0, 10076, '2014-09-23 16:01:55', 1),
(324, 'Upload foto from local store', '', '', 1, 0, '278122b9709b34d1972890e8c89f151e.png', '', 0, 0, 10079, '2014-09-23 16:27:32', 1),
(325, 'Upload foto from local store', '', '', 1, 0, '98ffb60571cccfaa2b73ddc53a9d2e7a.png', '', 0, 0, 10079, '2014-09-23 16:50:48', 1),
(326, 'Upload foto from local store', '', '', 1, 0, '425924a46d7745c6a70ac8237f4fbbd6.png', '', 0, 0, 10079, '2014-09-24 15:19:33', 1),
(327, 'Upload foto from local store', '', '', 1, 0, '162d3ce85f4226003cd0fbfc3d54382f.png', '', 0, 0, 10079, '2014-09-24 15:23:52', 1),
(328, 'Upload foto from local store', '', '', 1, 0, '896f5c428d88053762c6ef0f8b9079af.jpeg', '', 0, 0, 10079, '2014-09-25 23:23:08', 1),
(329, 'Upload foto from local store', '', '', 1, 0, '53f9cc2869f14f2f9f361a547afe2881.png', '', 0, 0, 10079, '2014-09-25 23:23:29', 1),
(330, 'Upload foto from local store', '', '', 1, 0, '49c96e8b3804267f72aafccd61064dc2.png', '', 0, 0, 10079, '2014-09-25 23:23:54', 1),
(331, 'Upload foto from local store', '', '', 1, 0, 'd3888d0dc56ae80c0955af4486038556.png', '', 0, 0, 10079, '2014-09-25 23:28:06', 1),
(332, 'Upload foto from local store', '', '', 1, 0, '65c2048cf233d652e107c955236da167.png', '', 0, 0, 10079, '2014-09-25 23:36:39', 1),
(333, 'Upload foto from album facebook', '', '', 1, 0, '2bbae3e014075be730047a5fe4c52e49a6f3baf5.jpg', '', 0, 0, 10071, '2014-09-25 23:38:01', 1),
(334, 'Upload foto from album facebook', '', '', 1, 0, 'fc3014733498dcf219e9c513e31762f41ca9c806.jpg', '', 0, 0, 10071, '2014-09-25 23:40:36', 1),
(335, 'Upload foto from album facebook', '', '', 1, 0, 'e6c5a7f7de5a21512521bf85e0e830747a96926d.jpg', '', 0, 0, 10071, '2014-09-27 20:46:54', 1),
(336, 'Upload foto from album facebook', '', '', 1, 0, 'd1e338746ca79950eaa197e7f68bc022b175531b.jpg', '', 0, 0, 10071, '2014-09-27 22:45:32', 1),
(337, 'Upload foto from local store', '', '', 1, 0, 'd8787340056e06666ce4f9a3f7595eea.png', '', 0, 0, 10079, '2014-09-27 23:08:04', 1),
(338, 'Upload foto from local store', '', '', 1, 0, '66c3985c0052d2d4b8e33985f7c419b1.png', '', 0, 0, 10079, '2014-09-27 23:09:39', 1),
(339, 'Upload foto from local store', '', '', 1, 0, '085289daa9186eb3d02f321907ae00b9.png', '', 0, 0, 10079, '2014-09-28 14:29:34', 1),
(340, 'Upload foto from local store', '', '', 1, 0, 'c17a524bec3bf623d2e168b9472cc379.jpg', '', 0, 0, 10079, '2014-09-29 20:23:26', 1),
(341, 'Upload foto from local store', '', '', 1, 0, '2256fbdcabb485a6dfce9d6e9d99df2d.png', '', 0, 0, 10079, '2014-09-29 20:24:06', 1),
(342, 'Upload foto from local store', '', '', 1, 0, '2df35b729843c2ffdb29cc2028a30c12.jpg', '', 0, 0, 10079, '2014-09-29 20:35:15', 1),
(343, 'Upload foto from local store', '', '', 1, 0, '55a8effd4cbbc8554ea0195096711095.png', '', 0, 0, 10079, '2014-09-29 20:44:37', 1),
(344, 'Upload foto from local store', '', '', 1, 0, 'b7e3d13f2b2580ae5b622365411412fb.png', '', 0, 0, 10079, '2014-09-29 20:47:20', 1),
(345, 'Upload foto from local store', '', '', 1, 0, '93d8e19a3806cc061b93da5b8084087a.jpg', '', 0, 0, 10079, '2014-09-29 20:54:17', 1),
(346, 'Upload foto from local store', '', '', 1, 0, 'f79bfd51ffc2126d726e2188d1e8b39c.png', '', 0, 0, 10079, '2014-09-29 20:58:51', 1),
(347, 'Upload foto from local store', '', '', 1, 0, 'ea903c4199d210d88df8178748c9ac56.jpg', '', 0, 0, 10079, '2014-09-29 21:01:10', 1),
(348, 'Upload foto from local store', '', '', 1, 0, 'f89ffe596e4e281ca5398b2d412ffdfe.png', '', 0, 0, 10079, '2014-09-29 21:17:55', 1),
(349, 'Upload foto from local store', '', '', 1, 0, '9b0c1a0b6e0df9b95aecf8ba262cb8bf.jpg', '', 0, 0, 10079, '2014-10-01 14:16:07', 1),
(350, 'Upload foto from local store', '', '', 1, 0, 'e83ee88c7b788acdc1d2792c245904d1.png', '', 0, 0, 10079, '2014-10-01 14:16:16', 1),
(351, 'Upload foto from local store', '', '', 1, 0, '7a4f6e7a250fb192b35298a82d07c1a9.jpg', '', 0, 0, 10079, '2014-10-01 14:30:38', 1);
INSERT INTO `bpom_news_content_repo` (`id`, `title`, `brief`, `content`, `typealbum`, `gallerytype`, `files`, `thumbnail`, `fromwho`, `otherid`, `userid`, `created_date`, `n_status`) VALUES
(352, 'Upload foto from local store', '', '', 1, 0, 'a47dd8dbecc3a9b524929db389fe647d.jpg', '', 0, 0, 10079, '2014-10-01 14:45:45', 1),
(353, 'Upload foto from local store', '', '', 1, 0, '05e1c778ca879ae1e658997339101dfd.png', '', 0, 0, 10079, '2014-10-01 15:16:09', 1),
(354, 'Upload foto from local store', '', '', 1, 0, 'b1626edda1f21fd6c7ea1e4f9ad5eaf8.png', '', 0, 0, 10079, '2014-10-01 15:51:54', 1),
(355, 'Upload foto from local store', '', '', 1, 0, '027f33b3eb24bc50a38f2da409005f64.jpg', '', 0, 0, 10079, '2014-10-01 19:38:03', 1),
(356, 'Upload foto from local store', '', '', 1, 0, '7dc5df8557b7a7f2ee60f853958867f1.jpeg', '', 0, 0, 10079, '2014-10-03 18:58:44', 1),
(357, 'Upload foto from local store', '', '', 1, 0, 'a5f6f57883c1801e9596d06398270c87.jpeg', '', 0, 0, 10079, '2014-10-03 19:11:04', 1),
(358, 'Upload foto from local store', '', '', 1, 0, '0a100e32d0a0992f2b5c90d172feb113.jpeg', '', 0, 0, 10079, '2014-10-03 19:13:13', 1),
(359, 'Upload foto from local store', '', '', 1, 0, '27779f2fcd638054ba2e8f3eb64aaeed.jpg', '', 0, 0, 10079, '2014-10-07 09:24:17', 1);

-- --------------------------------------------------------

--
-- Table structure for table `bpom_pelaporan_kemasan`
--

CREATE TABLE IF NOT EXISTS `bpom_pelaporan_kemasan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `industriID` int(11) NOT NULL DEFAULT '0',
  `pabrikID` int(11) NOT NULL DEFAULT '0',
  `merek` int(11) NOT NULL DEFAULT '0',
  `jenis` int(11) NOT NULL DEFAULT '0',
  `isi` int(11) NOT NULL DEFAULT '0',
  `satuan` int(11) NOT NULL DEFAULT '0',
  `bentuKemasan` int(11) NOT NULL DEFAULT '0',
  `jenisGambar` int(11) NOT NULL DEFAULT '0',
  `tulisanPeringatan` int(11) NOT NULL DEFAULT '0',
  `luasDepan` varchar(10) DEFAULT NULL,
  `luasBelakang` varchar(10) DEFAULT NULL,
  `suratPengantar` varchar(100) DEFAULT NULL,
  `namaDan_alamat` int(11) NOT NULL DEFAULT '0',
  `kodeProduksi` varchar(50) DEFAULT NULL,
  `tglProduksi` date DEFAULT NULL,
  `kadarNikotin` varchar(10) DEFAULT NULL,
  `kadarTar` varchar(10) DEFAULT NULL,
  `pernyataanDilarang_menjual` varchar(50) DEFAULT NULL,
  `pernyataanTidak_aman` varchar(50) DEFAULT NULL,
  `pernyataanZat_kimia` varchar(50) DEFAULT NULL,
  `fotoDepan` varchar(100) DEFAULT NULL,
  `fotoBelakang` varchar(100) DEFAULT NULL,
  `fotoKiri` varchar(100) DEFAULT NULL,
  `fotoKanan` varchar(100) DEFAULT NULL,
  `fotoAtas` varchar(100) DEFAULT NULL,
  `fotoBawah` varchar(100) DEFAULT NULL,
  `kesimpulan` int(11) NOT NULL DEFAULT '0',
  `catatanDitolak` varchar(300) DEFAULT NULL,
  `lokasiBeli` varchar(100) DEFAULT NULL,
  `tglBeli` date DEFAULT NULL,
  `tahunCukai` varchar(4) DEFAULT NULL,
  `hargaBungkus` varchar(15) DEFAULT NULL,
  `hargaBatang` varchar(15) DEFAULT NULL,
  `createDate` datetime NOT NULL,
  `evaluator` int(11) NOT NULL DEFAULT '0',
  `verifikator` int(11) NOT NULL DEFAULT '0',
  `updateDate` datetime DEFAULT NULL,
  `n_status` int(11) NOT NULL DEFAULT '0' COMMENT '1: evaluasi, 2:verifikasi, 3:approved, 7:evaluasi balai',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=34 ;

--
-- Dumping data for table `bpom_pelaporan_kemasan`
--

INSERT INTO `bpom_pelaporan_kemasan` (`id`, `industriID`, `pabrikID`, `merek`, `jenis`, `isi`, `satuan`, `bentuKemasan`, `jenisGambar`, `tulisanPeringatan`, `luasDepan`, `luasBelakang`, `suratPengantar`, `namaDan_alamat`, `kodeProduksi`, `tglProduksi`, `kadarNikotin`, `kadarTar`, `pernyataanDilarang_menjual`, `pernyataanTidak_aman`, `pernyataanZat_kimia`, `fotoDepan`, `fotoBelakang`, `fotoKiri`, `fotoKanan`, `fotoAtas`, `fotoBawah`, `kesimpulan`, `catatanDitolak`, `lokasiBeli`, `tglBeli`, `tahunCukai`, `hargaBungkus`, `hargaBatang`, `createDate`, `evaluator`, `verifikator`, `updateDate`, `n_status`) VALUES
(15, 1, 1, 1, 1, 1, 0, 1, 1, 3, '11', NULL, NULL, 1, 'qwqwq', '2014-12-03', NULL, NULL, '1', '1', NULL, '2ae828159480c084c2afe0c487604689.JPG', 'e4ef5786fa2c9beae0420f754b251b07.JPG', '1eabb6059c9a4915ac012d347bf5d522.JPG', 'f96665517454d43069953ef416cddb16.JPG', 'a4f6e126c5c279ed6da8d712ee1bb72e.JPG', '208b6ce30c5d495c06a089cd703b5309.JPG', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-11-24 14:17:38', 0, 0, NULL, 0),
(16, 1, 1, 1, 1, 10, 3, 3, 3, 6, '12', '212', 'e34f38f33c0bd998541cd654bc8bfe10.jpg', 0, 'dadsas', '2014-12-03', '1121', '212', '1', '1', '1', '4613ed9a42e551108cac3629d6b81dca.png', '626559c0737cd0e09972f022b33cf980.png', '96969ec30e72fb5437661adb25bb9435.png', 'e647a3c8e8bcbf5301fccab2fa32533b.png', 'e4fbe3431d3ca16ca4c2c792d9031565.png', '7079ad375164cca556c7b48b5ffdaa96.png', 0, NULL, NULL, NULL, NULL, NULL, NULL, '2014-12-03 08:59:14', 0, 0, NULL, 1),
(17, 1, 24, 0, 4, 10, 4, 3, 5, 5, NULL, NULL, '30eeb815b046a8c27d36b3869fc7c8f7.png', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '7faf16e41c6174071447598f562ff9b4.png', '8a37ba80b191ad092f546ba40da5b0d2.png', 'c70cfe48b7112adb20ae79b3486d8f0b.png', '98ffdef6583206cd010d8440b8c1fcd8.png', '1923032fa4e6016f71c56ad3a7cb68a4.png', '0724adf941efe92769b3d66b75776978.png', 0, NULL, NULL, NULL, NULL, NULL, NULL, '2014-12-03 09:43:25', 0, 0, NULL, 0),
(18, 1, 1, 3, 1, 1, 0, 1, 1, 1, NULL, NULL, 'e0f033941e6433685d95a9943bb15a6b.png', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'd0a1f8df44fbfa87f745cb85c449e272.JPG', '64a16e6f5581ea32ef1ebc7af4d6a493.JPG', 'f38f2b58b9421b785f2440d49f592abb.JPG', 'f65ca41421ae606c2ff50eab04bd29ca.JPG', '18fe1848247284724d3def0587db2ab0.JPG', '0e9b79dadc49b2d2461f376361ce3192.JPG', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-12-03 14:55:26', 0, 0, NULL, 0),
(19, 8, 8, 2, 1, 1, 0, 1, 1, 1, '11', '11', '9a53c84a82a7fa80a9f448ab3705deb7.png', 1, '1231321', '2014-12-04', '12', '13', '1', '1', NULL, 'b4b400db377643a01f4dd567f4708e0a.JPG', '5d65dd5bcc309e1f71aa715251e12cd0.JPG', 'e97d6101813ff1c1eeaf75eb2be0697a.JPG', 'fb3fec5bb95f11ed15774afe4f8c2643.JPG', '65cdd4f3e1611b58ee17f2ecd3ec41de.JPG', 'f189584754fb630d07c74dca21badbf5.JPG', 0, 'ditolak laporan', NULL, NULL, NULL, NULL, NULL, '2014-12-03 15:09:25', 0, 0, NULL, 2),
(20, 16, 8, 2, 1, 1, 0, 1, 1, 1, NULL, NULL, 'de7b36074efd107efd68980b189f7a05.jpg', 0, NULL, NULL, '1', '12', '1', NULL, NULL, 'bd94d629edb2795d7a5d5f6c74f3e47b.jpg', '40d2c4cb32b03f0e4d2be1034820ac8e.png', '27b0c7572342b0ffe7b1710753de80ae.jpeg', '385551b67ce737f751234dd01b751e3b.jpg', '9e4ab758083eaec372fd1591e212e983.jpg', 'e9245f803954d4b681ac50370f1f1a68.jpg', 0, NULL, NULL, NULL, NULL, NULL, NULL, '2014-12-05 10:02:20', 0, 0, NULL, 2),
(21, 16, 8, 1, 1, 1, 0, 1, 0, 1, NULL, NULL, NULL, 0, '1111', '2014-12-03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 'depok', '2014-12-03', '2014', '111111', '1111', '2014-12-06 01:07:34', 0, 0, NULL, 7),
(22, 16, 8, 1, 1, 1, 0, 1, 1, 1, NULL, NULL, NULL, 0, '', '0000-00-00', NULL, NULL, NULL, NULL, NULL, 'eca7eee929a82d2168c1b0d5f4548d7e.jpg', 'e86389d951e60c5c7db612e907fcf300.jpg', '4b1bcdeefc7134333aa02251006b5827.jpg', '1cbad90e0e47440883dfcd37adcddf2f.jpg', 'd6ee13fa916456656a7ac95d397a372d.jpg', '83b32ea1da20a3da59ecb6597e4e38e7.jpg', 1, NULL, '', '0000-00-00', '', '', '', '2014-12-06 01:12:10', 0, 0, NULL, 2),
(23, 18, 19, 1, 1, 20, 0, 1, 0, 1, NULL, NULL, 'ddc9fe992c09ec5de6a11e943cee0da8.jpg', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'db3dc65bf5d07d664dbbc364f83ba875.png', NULL, '1b9354750571ecc64743273838508589.jpg', '2108aba648aba75c54a33d489f9876a9.jpg', '1971277cdeafc76437b70dcc4ae5a0f7.jpg', '5cd18231e95e8b4896196da2d9af0511.png', 0, NULL, NULL, NULL, NULL, NULL, NULL, '2015-09-10 16:21:37', 0, 0, NULL, 1),
(24, 1, 24, 0, 1, 0, 0, 1, 0, 1, NULL, NULL, '932f66ed55b245e131bd10d396283b3d.jpg', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '5323cda21cf3f35f07641cb478a85c07.png', '41cc086ce56ea648ca5bc3d91dbbf4df.png', 'b13d0f743a988604c1d0a3d5fbf07329.png', 'feb639d3999b69ce43e2e6ba28a18172.png', 'b25fc9010cd6e25030663cd862eeaff6.png', 'f9335c2ff8f25c37655f9fc315d13dc2.png', 0, NULL, NULL, NULL, NULL, NULL, NULL, '2015-09-10 16:25:38', 0, 0, NULL, 0),
(25, 1, 18, 1, 1, 12, 0, 1, 0, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2015-09-11 15:00:09', 0, 0, NULL, 0),
(26, 1, 24, 0, 1, 0, 0, 1, 0, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2015-09-11 15:16:06', 0, 0, NULL, 0),
(27, 1, 24, 0, 1, 0, 0, 1, 0, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', 0, 0, NULL, 0),
(28, 1, 18, 2, 3, 10, 4, 3, 3, 5, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', 0, 0, NULL, 0),
(29, 1, 24, 2, 5, 10, 3, 2, 5, 3, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', 0, 0, NULL, 0),
(30, 1, 24, 2, 1, 0, 1, 1, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', 0, 0, NULL, 0),
(31, 1, 24, 2, 1, 0, 1, 1, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', 0, 0, NULL, 0),
(32, 1, 24, 2, 1, 0, 1, 1, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', 0, 0, NULL, 0),
(33, 1, 18, 2, 1, 12, 2, 3, 1, 2, NULL, NULL, 'e57ce33b65f65eb6fe2adf2d5cc2ad28.jpg', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ed31cc6562d0445be2b4b240c12812a8.jpg', 'f45e6be5b793547929256d02c2bfe9b0.jpg', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', 0, 0, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `bpom_pelaporan_nikotin`
--

CREATE TABLE IF NOT EXISTS `bpom_pelaporan_nikotin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `industriID` int(11) NOT NULL DEFAULT '0',
  `pabrikID` int(11) NOT NULL DEFAULT '0',
  `merek` int(11) NOT NULL DEFAULT '0',
  `jenis` int(11) NOT NULL DEFAULT '0',
  `isiKemasan` int(11) NOT NULL DEFAULT '0',
  `satuan` int(11) NOT NULL DEFAULT '0',
  `kodeProduksi` varchar(50) DEFAULT NULL,
  `kodeSample` varchar(50) DEFAULT NULL,
  `labID` int(11) NOT NULL DEFAULT '0',
  `noSertifikat` varchar(100) DEFAULT NULL,
  `tanggalUji` date DEFAULT NULL,
  `kadarNikotin` int(20) DEFAULT NULL,
  `kadarTar` int(20) DEFAULT NULL,
  `kadarKretek` varchar(20) DEFAULT NULL,
  `sertifikat` varchar(100) DEFAULT NULL,
  `catatanDitolak` varchar(300) DEFAULT NULL,
  `createdDate` datetime DEFAULT NULL,
  `n_status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `bpom_pelaporan_nikotin`
--

INSERT INTO `bpom_pelaporan_nikotin` (`id`, `industriID`, `pabrikID`, `merek`, `jenis`, `isiKemasan`, `satuan`, `kodeProduksi`, `kodeSample`, `labID`, `noSertifikat`, `tanggalUji`, `kadarNikotin`, `kadarTar`, `kadarKretek`, `sertifikat`, `catatanDitolak`, `createdDate`, `n_status`) VALUES
(6, 1, 1, 1, 1, 1, 0, 'csaa', 'cascsa', 1, 'csaca', '0000-00-00', 0, 0, 'csacas', 'ab826fd6d05d8420fcf7c5ad80ee0436.png', NULL, '2014-11-14 09:46:48', 0),
(7, 1, 2, 2, 1, 1, 0, 'fasfasf', 'fafsa', 1, 'fasfa', '0000-00-00', 0, 0, 'fasfasfsa', '6146e4e58c715bdaea4821f5a9efbde7.png', NULL, '2014-11-14 10:01:32', 0),
(8, 1, 24, 1, 1, 10, 1, '121aw', '1111112222', 1, '213131', '2014-11-11', 12, 121, '121', 'd48b5f1ff13c06e97d2d95f0aa769984.jpg', NULL, '2014-12-03 09:48:53', 1),
(9, 1, 1, 1, 1, 1, 0, '2131', '213213', 1, '1231', '2014-11-11', 12, 12, '12', '2afa7e3755efe41eae9c776c2d319487.png', NULL, '2014-12-03 10:32:10', 0),
(10, 16, 8, 2, 1, 1, 0, '1111', '111dasa', 1, '12313', '2014-11-11', 12, 31, '12', 'a126ea996b71d411b3cd83d8ad25d35c.jpg', 'gk cocok nih', '2014-12-05 17:24:15', 1),
(11, 16, 8, 1, 1, 1, 0, '', '', 1, '123456', '2014-11-11', 3, 3, '3,47', NULL, NULL, '2014-12-12 16:11:51', 1),
(12, 16, 8, 1, 1, 1, 0, '1231', '23131', 1, '123456', '2014-11-11', 3, 3, '3,47', '4b34df1f5c83020761b7867f623e8c3e.png', NULL, '2014-12-12 16:12:31', 1),
(13, 0, 0, 1, 1, 1, 0, 'csaa', 'cascsa', 0, 'csaca', '0000-00-00', 0, 0, 'csacas', NULL, NULL, '2015-07-07 14:07:55', 1),
(14, 1, 18, 3, 1, 10, 1, '121212', 'dsafasdafa', 1, '231321', '2015-01-01', 1, 1, 'dsada', '2f7a7d9fd0b6ed2846561714977d0845.jpg', NULL, NULL, 0),
(15, 1, 2, 2, 4, 11, 1, '121212', '212121', 1, '212121', '2015-01-01', 11, 21, '13', 'f900ca7f79cef3bdba55ca39607e56cc.jpg', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `bpom_peringatan_kesehatan`
--

CREATE TABLE IF NOT EXISTS `bpom_peringatan_kesehatan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(300) DEFAULT NULL,
  `n_status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `bpom_peringatan_kesehatan`
--

INSERT INTO `bpom_peringatan_kesehatan` (`id`, `title`, `n_status`) VALUES
(1, 'Merokok sebabkan kanker mulut', 1),
(2, 'Merokok membunuhmu', 1),
(3, 'Merokok sebabkan kanker tenggorokan', 1),
(4, 'Merokok dekat anak berbahaya bagi mereka', 1),
(5, 'Merokok sebabkan kanker paru-paru dan bronkitis kronik', 1),
(6, 'Semua tulisan peringatan kesehatan', 1);

-- --------------------------------------------------------

--
-- Table structure for table `bpom_product`
--

CREATE TABLE IF NOT EXISTS `bpom_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `merek` varchar(100) DEFAULT NULL,
  `produsen` varchar(100) DEFAULT NULL,
  `alamat` text,
  `jenis` varchar(10) DEFAULT NULL,
  `n_status` int(11) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `bpom_product`
--

INSERT INTO `bpom_product` (`id`, `merek`, `produsen`, `alamat`, `jenis`, `n_status`) VALUES
(1, 'Clavo Premio Filter 12', 'PT Djarum', 'test', 'SKM', 1),
(2, 'Djarum Black 16', 'PT Djarum', NULL, 'SKM', 1),
(3, 'Camel White 20', 'PT Djarum', NULL, 'SKM', 1);

-- --------------------------------------------------------

--
-- Table structure for table `bpom_product_image_type`
--

CREATE TABLE IF NOT EXISTS `bpom_product_image_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `typeGambar` varchar(255) DEFAULT NULL,
  `tulisanGambar` varchar(255) DEFAULT NULL,
  `n_status` int(11) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `bpom_product_image_type`
--

INSERT INTO `bpom_product_image_type` (`id`, `typeGambar`, `tulisanGambar`, `n_status`) VALUES
(1, 'gambar kanker mulut', 'Merokok Sebabkan Kanker Mulut', 1),
(2, 'gambar orang merokok dengan asap yang membentuk tengkorak', 'Merokok Membunuhmu', 1),
(3, 'gambar kanker tenggorokan', 'Merokok Sebabkan Kanker Tenggorokan', 1),
(4, 'gambar orang merokok dengan anak didekatnya', 'Merokok Dekat Anak Berbahaya Bagi Mereka', 1),
(5, 'gambar paru-paru yang menghitam karena kanker', 'Merokok Sebabkan Kanker Paru-paru dan Bronkitis Kronis', 1);

-- --------------------------------------------------------

--
-- Table structure for table `bpom_product_type`
--

CREATE TABLE IF NOT EXISTS `bpom_product_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jenis` varchar(20) DEFAULT NULL,
  `n_status` int(11) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `bpom_product_type`
--

INSERT INTO `bpom_product_type` (`id`, `jenis`, `n_status`) VALUES
(1, 'SKT', 1),
(2, 'SKM', 1),
(3, 'SPM', 1),
(4, 'SKTF', 1),
(5, 'TIS', 1),
(6, 'CRT', 1);

-- --------------------------------------------------------

--
-- Table structure for table `social_member`
--

CREATE TABLE IF NOT EXISTS `social_member` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `industri_id` varchar(50) NOT NULL,
  `name` varchar(46) DEFAULT NULL,
  `nickname` varchar(50) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `register_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `verified_date` datetime NOT NULL,
  `img` varchar(200) DEFAULT NULL COMMENT 'GIID Image',
  `image_profile` varchar(200) NOT NULL,
  `small_img` varchar(200) DEFAULT NULL,
  `username` varchar(46) DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `city` int(11) DEFAULT NULL,
  `zipcode` int(10) NOT NULL,
  `sex` varchar(11) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `description` text,
  `link` text,
  `middle_name` varchar(46) DEFAULT NULL,
  `last_name` varchar(46) DEFAULT NULL,
  `StreetName` varchar(150) DEFAULT NULL,
  `phone_number` varchar(15) DEFAULT NULL,
  `n_status` int(3) NOT NULL DEFAULT '0' COMMENT '0:pending, 1:approved, 2:delete',
  `login_count` int(11) NOT NULL DEFAULT '0',
  `verified` tinyint(3) DEFAULT '0' COMMENT '0->no hp blm verified, 1->sudah verified.',
  `usertype` int(11) NOT NULL COMMENT '1:industri, 2:balai, 3:balaiverificator, 4:bpom, 5:bpomverivicator',
  `email_token` varchar(50) DEFAULT NULL,
  `photo_moderation` int(11) NOT NULL,
  `salt` varchar(200) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10105 ;

--
-- Dumping data for table `social_member`
--

INSERT INTO `social_member` (`id`, `industri_id`, `name`, `nickname`, `email`, `register_date`, `verified_date`, `img`, `image_profile`, `small_img`, `username`, `last_login`, `city`, `zipcode`, `sex`, `birthday`, `description`, `link`, `middle_name`, `last_name`, `StreetName`, `phone_number`, `n_status`, `login_count`, `verified`, `usertype`, `email_token`, `photo_moderation`, `salt`, `password`) VALUES
(10071, '1', 'Ovan Pulu', NULL, 'o.pulu@yahoo.com', '2014-08-25 00:57:35', '0000-00-00 00:00:00', NULL, '', NULL, NULL, '2015-09-15 14:17:53', NULL, 0, 'male', NULL, 'direktur utama', 'https://www.facebook.com/app_scoped_user_id/10202304338879140/', 'Sunarto', 'Pulu', 'depok', '12345', 1, 51, 1, 1, '1234', 0, 'ovancop2014', '5b4dbf8a00bec804e7ace8cc400b1837cdcc05e4'),
(10097, '14', 'csac', NULL, 'ovan89@gmail.com', '2014-11-19 09:42:00', '0000-00-00 00:00:00', NULL, '', NULL, NULL, NULL, NULL, 0, NULL, NULL, 'casca', NULL, NULL, 'csacsa', 'cacas', 'cacas', 0, 0, 0, 1, 'dhUtXRxoGyFveqV0mM6uLWInjcNr8B', 0, 'ovancop2014', 'YOUR PASSWORD'),
(10100, '17', '', NULL, '', '2014-12-04 03:11:56', '0000-00-00 00:00:00', NULL, '', NULL, NULL, NULL, NULL, 0, NULL, NULL, '', NULL, NULL, '', '', '', 0, 0, 0, 1, 'awkAinu3UIv1VqrbzxFQJY5Z0gco7K', 0, 'ovancop2014', 'YOUR PASSWORD'),
(10101, '18', 'iswandi', NULL, 'iswandizen@gmail.com', '2015-09-10 07:32:22', '0000-00-00 00:00:00', NULL, '', NULL, NULL, '2015-09-10 14:42:08', NULL, 0, NULL, NULL, 'direktur palsu', NULL, NULL, 'zen', 'Jl Percetakan Negara 23', '08891503992', 1, 1, 1, 1, 'HbwtA9I8aEhCNX6x3ro7Yc0uyRVSmk', 0, 'ovancop2014', '5b4dbf8a00bec804e7ace8cc400b1837cdcc05e4'),
(10102, '19', 'csasa', NULL, 'submit.ovan@gmail.com', '2015-09-10 07:34:28', '0000-00-00 00:00:00', NULL, '', NULL, NULL, NULL, NULL, 0, NULL, NULL, 'csacsa', NULL, NULL, 'cascsa', 'csacsa', 'csasac', 0, 0, 0, 1, '4LgtHhJjwZGC3TzpqlIxXr25vfaKSo', 0, 'ovancop2014', 'YOUR PASSWORD'),
(10103, '20', 'sugeng', NULL, 'sugengriyadi@gmail.com', '2015-09-10 07:36:29', '0000-00-00 00:00:00', NULL, '', NULL, NULL, '2015-09-10 14:54:00', NULL, 0, NULL, NULL, 'direktur perusahaan', NULL, NULL, 'riyadi', 'jl. percetakan negara 23 jakarta pusat', '085772723434', 1, 3, 1, 1, '8pw93jvah4InfNz16CWZKYA7ilc5LG', 0, 'ovancop2014', '5b4dbf8a00bec804e7ace8cc400b1837cdcc05e4'),
(10104, '22', 'Sammy', NULL, 'sumimultim@gmail.com', '2015-09-10 07:45:53', '0000-00-00 00:00:00', NULL, '', NULL, NULL, '2015-09-10 14:46:30', NULL, 0, NULL, NULL, 'Rokok', NULL, NULL, 'mintir', 'Percetakan Negara', '02198336435437', 1, 1, 1, 1, 'qUpRvLnzXH01OoQPG7VsAFhMr693fu', 0, 'ovancop2014', '5b4dbf8a00bec804e7ace8cc400b1837cdcc05e4');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_balai`
--

CREATE TABLE IF NOT EXISTS `tbl_balai` (
  `kodeBalai` int(11) NOT NULL AUTO_INCREMENT,
  `namaBalai` varchar(200) DEFAULT NULL,
  `parent` int(11) DEFAULT '0',
  PRIMARY KEY (`kodeBalai`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tbl_balai`
--

INSERT INTO `tbl_balai` (`kodeBalai`, `namaBalai`, `parent`) VALUES
(1, 'Balai Besar POM di Jakarta', 0),
(2, 'Balai Besar POM di Medan', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_menu`
--

CREATE TABLE IF NOT EXISTS `tbl_user_menu` (
  `menuID` int(2) NOT NULL AUTO_INCREMENT,
  `menuDesc` varchar(50) DEFAULT NULL,
  `menuParent` int(2) DEFAULT NULL,
  `menuPath` varchar(100) DEFAULT NULL,
  `menuIcon` varchar(100) DEFAULT NULL,
  `menuStatus` int(11) NOT NULL,
  `menuAksesLogin` int(11) NOT NULL,
  PRIMARY KEY (`menuID`),
  KEY `menuID` (`menuID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=69 ;

--
-- Dumping data for table `tbl_user_menu`
--

INSERT INTO `tbl_user_menu` (`menuID`, `menuDesc`, `menuParent`, `menuPath`, `menuIcon`, `menuStatus`, `menuAksesLogin`) VALUES
(1, 'Tambah User', 6, 'user/add', 'fa fa-user', 1, 0),
(2, 'List User', 6, 'user', 'fa fa-list', 1, 0),
(3, 'Evaluasi Kemasan', 2, 'evaluasi/label', 'fa fa-list', 1, 0),
(4, 'Evaluasi Iklan MLR', 2, 'evaluasi/iklanmlr', 'fa fa-list', 1, 0),
(5, 'Evaluasi Iklan TV', 2, 'evaluasi/iklantv', 'fa fa-list', 1, 0),
(6, 'Evaluasi PHW', 2, 'evaluasi/iklanphw', 'fa fa-list', 1, 0),
(7, 'Kemasan', 3, 'pelaporan/kemasan', 'fa fa-list', 1, 0),
(8, 'Nikotin dan TAR', 3, 'pelaporan/nikotin', 'fa fa-list', 1, 0),
(9, 'Data Evaluasi', 4, 'import', 'fa fa-list', 1, 0),
(10, 'Data Merek', 4, 'import/merek', 'fa fa-list', 1, 0),
(11, 'Data Laboratorium', 5, 'reference/lab', 'fa fa-list', 1, 0),
(12, 'Tambah Artikel', 1, 'article/addarticle', 'fa fa-plus', 1, 0),
(13, 'List Artikel', 1, 'home', 'fa fa-list-alt', 1, 0),
(14, 'Profil', 7, 'article/profil', 'fa fa-list', 1, 0),
(15, 'Kontak', 1, 'article/kontak', 'fa fa-list', 1, 0),
(16, 'Evaluasi N & T', 2, 'evaluasi/nikotin', 'fa fa-list', 1, 0),
(17, 'Visi Misi', 7, 'article/visimisi', 'fa fa-list', 1, 0),
(18, 'Tugas Pokok', 7, 'article/tupoksi', 'fa fa-list', 1, 0),
(19, 'Peraturan', 8, 'article/peraturan', 'fa fa-list', 1, 0),
(20, 'Penelitian', 8, 'article/penelitian', 'fa fa-list', 1, 0),
(21, 'FAQ', 9, 'article/faq', 'fa fa-list', 1, 0),
(22, 'Saran dan Pengaduan', 9, 'article/saran', 'fa fa-list', 1, 0),
(23, 'Alur Prosedur', 10, 'article/alurprosedur', 'fa fa-list', 1, 0),
(24, 'Petunjuk', 10, 'article/petunjuk', 'fa fa-list', 1, 0),
(25, 'Buat Pelaporan', 3, 'pelaporan/buatlaporan', 'fa fa-list', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_menu_parent`
--

CREATE TABLE IF NOT EXISTS `tbl_user_menu_parent` (
  `menuParentID` int(2) NOT NULL AUTO_INCREMENT,
  `menuParentDesc` varchar(20) DEFAULT NULL,
  `menuOrder` int(11) NOT NULL,
  PRIMARY KEY (`menuParentID`),
  KEY `menuParentID` (`menuParentID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `tbl_user_menu_parent`
--

INSERT INTO `tbl_user_menu_parent` (`menuParentID`, `menuParentDesc`, `menuOrder`) VALUES
(1, 'Artikel', 1),
(2, 'Hasil Evaluasi', 2),
(3, 'Evaluasi Pelaporan', 3),
(4, 'Importing', 4),
(5, 'Data Reference', 5),
(6, 'User Management', 6),
(10, 'Sistem Pelaporan', 10),
(9, 'Informasi', 9),
(8, 'Publikasi', 8),
(7, 'Profil', 7);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_wilayah`
--

CREATE TABLE IF NOT EXISTS `tbl_wilayah` (
  `kode_wilayah` varchar(255) DEFAULT NULL,
  `nama_wilayah` varchar(255) DEFAULT NULL,
  `parent` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_wilayah`
--

INSERT INTO `tbl_wilayah` (`kode_wilayah`, `nama_wilayah`, `parent`) VALUES
('01', 'DKI JAKARTA', '0'),
('0151', 'KOTA JAKARTA PUSAT', '01'),
('0152', 'KOTA JAKARTA UTARA', '01'),
('0153', 'KOTA JAKARTA BARAT', '01'),
('0154', 'KOTA JAKARTA SELATAN', '01'),
('0155', 'KOTA JAKARTA TIMUR', '01'),
('0156', 'KEPULAUAN SERIBU', '01'),
('02', 'JAWA BARAT', '0'),
('0205', 'KAB.BOGOR', '02'),
('0206', 'KAB.SUKABUMI', '02'),
('0207', 'KAB.CIANJUR', '02'),
('0208', 'KAB.BEKASI', '02'),
('0209', 'KAB.KERAWANG', '02'),
('0210', 'KAB.PURWAKARTA', '02'),
('0211', 'KAB. SUBANG', '02'),
('0212', 'KAB. BANDUNG', '02'),
('0213', 'KAB. SUMEDANG', '02'),
('0214', 'KAB. G A R U T', '02'),
('0215', 'KAB. TASIKMALAYA', '02'),
('0216', 'KAB. CIAMIS', '02'),
('0217', 'KAB. CIREBON', '02'),
('0218', 'KAB. KUNINGAN', '02'),
('0219', 'KAB. INDRAMAYU', '02'),
('0220', 'KAB. MAJALENGKA', '02'),
('0221', 'KAB. BANDUNG BARAT', '02'),
('0251', 'KOTA BANDUNG', '02'),
('0252', 'KOTA BOGOR', '02'),
('0253', 'KOTA SUKABUMI', '02'),
('0254', 'KOTA CIREBON', '02'),
('0257', 'KOTA BEKASI', '02'),
('0258', 'KOTA DEPOK', '02'),
('0260', 'KOTA TASIKMALAYA', '02'),
('0261', 'KOTA CIMAHI', '02'),
('0262', 'KOTA BANJAR', '02'),
('03', 'JAWA TENGAH', '0'),
('0301', 'KAB. SEMARANG', '03'),
('0302', 'KAB. KENDAL', '03'),
('0303', 'KAB. DEMAK', '03'),
('0304', 'KAB. GROBOGAN', '03'),
('0305', 'KAB. PEKALONGAN', '03'),
('0306', 'KAB. BATANG', '03'),
('0307', 'KAB. TEGAL', '03'),
('0308', 'KAB. BREBES', '03'),
('0309', 'KAB. PATI', '03'),
('0310', 'KAB. KUDUS', '03'),
('0311', 'KAB. PEMALANG', '03'),
('0312', 'KAB. JEPARA', '03'),
('0313', 'KAB. REMBANG', '03'),
('0314', 'KAB. BLORA', '03'),
('0315', 'KAB. BANYUMAS', '03'),
('0316', 'KAB. CILACAP', '03'),
('0317', 'KAB. PURBALINGGA', '03'),
('0318', 'KAB. BANJARNEGARA', '03'),
('0319', 'KAB. MAGELANG', '03'),
('0320', 'KAB. TEMANGGUNG', '03'),
('0321', 'KAB. WONOSOBO', '03'),
('0322', 'KAB. PURWOREJO', '03'),
('0323', 'KAB. KEBUMEN', '03'),
('0324', 'KAB. KLATEN', '03'),
('0325', 'KAB. BOYOLALI', '03'),
('0326', 'KAB. SRAGEN', '03'),
('0327', 'KAB. SUKOHARJO', '03'),
('0328', 'KAB. KARANGANYAR', '03'),
('0329', 'KAB. WONOGIRI', '03'),
('0330', 'KAB. CEPU', '03'),
('0351', 'KOTA SEMARANG', '03'),
('0352', 'KOTA SALATIGA', '03'),
('0353', 'KOTA PEKALONGAN', '03'),
('0354', 'KOTA TEGAL', '03'),
('0355', 'KOTA MAGELANG', '03'),
('0356', 'KOTA SURAKARTA', '03'),
('04', 'DI YOGYAKARTA', '0'),
('0401', 'KAB. BANTUL', '04'),
('0402', 'KAB. SLEMAN', '04'),
('0403', 'KAB. GUNUNGKIDUL', '04'),
('0404', 'KAB. KULONPROGO', '04'),
('0451', 'KOTA YOGYAKARTA', '04'),
('05', 'JAWA TIMUR', '0'),
('0501', 'KAB. GRESIK', '05'),
('0502', 'KAB. MOJOKERTO', '05'),
('0503', 'KAB. SIDOARJO', '05'),
('0504', 'KAB. JOMBANG', '05'),
('0505', 'KAB. SAMPANG', '05'),
('0506', 'KAB. PAMEKASAN', '05'),
('0507', 'KAB. SUMENEP', '05'),
('0508', 'KAB. BANGKALAN', '05'),
('0509', 'KAB. BONDOWOSO', '05'),
('0510', 'KAB. SITUBONDO', '05'),
('0511', 'KAB. BANYUWANGI', '05'),
('0512', 'KAB. JEMBER', '05'),
('0513', 'KAB. MALANG', '05'),
('0514', 'KAB. PASURUAN', '05'),
('0515', 'KAB. PROBOLINGGO', '05'),
('0516', 'KAB. LUMAJANG', '05'),
('0517', 'KAB. KEDIRI', '05'),
('0518', 'KAB. TULUNGAGUNG', '05'),
('0519', 'KAB. NGANJUK', '05'),
('0520', 'KAB. TRENGGALEK', '05'),
('0521', 'KAB. BLITAR', '05'),
('0522', 'KAB. MADIUN', '05'),
('0523', 'KAB. NGAWI', '05'),
('0524', 'KAB. MAGETAN', '05'),
('0525', 'KAB. PONOROGO', '05'),
('0526', 'KAB. PACITAN', '05'),
('0527', 'KAB. BOJONEGORO', '05'),
('0528', 'KAB. TUBAN', '05'),
('0529', 'KAB. LAMONGAN', '05'),
('0551', 'KOTA SURABAYA', '05'),
('0552', 'KOTA MOJOKERTO', '05'),
('0553', 'KOTA MALANG', '05'),
('0554', 'KOTA PASURUAN', '05'),
('0555', 'KOTA PROBOLINGGO', '05'),
('0556', 'KOTA BLITAR', '05'),
('0557', 'KOTA KEDIRI', '05'),
('0558', 'KOTA MADIUN', '05'),
('0559', 'KOTA BATU', '05'),
('06', 'ACEH', '0'),
('0601', 'KAB. ACEH BESAR', '06'),
('0602', 'KAB. P I D I E', '06'),
('0603', 'KAB. ACEH UTARA', '06'),
('0604', 'KAB. ACEH TIMUR', '06'),
('0605', 'KAB. ACEH SELATAN', '06'),
('0606', 'KAB. ACEH BARAT', '06'),
('0607', 'KAB. ACEH TENGAH', '06'),
('0608', 'KAB. ACEH TENGGARA', '06'),
('0609', 'KAB. SIMEULEU', '06'),
('0610', 'KAB. ACEH SINGKIL', '06'),
('0611', 'KAB. BIREUN', '06'),
('0612', 'KAB. ACEH BARAT DAYA', '06'),
('0613', 'KAB. ACEH GAYO LUES', '06'),
('0614', 'KAB. ACEH JAYA', '06'),
('0615', 'KAB. NAGAN RAYA', '06'),
('0616', 'KAB. ACEH TAMIANG', '06'),
('0617', 'KAB. BENER MERIAH', '06'),
('0618', 'KAB. PIDIE JAYA', '06'),
('0651', 'KOTA BANDA ACEH', '06'),
('0652', 'KOTA SABANG', '06'),
('0653', 'KOTA LANGSA', '06'),
('0654', 'KOTA LHOKSEUMAWE', '06'),
('0655', 'KOTA MEULABOH', '06'),
('0656', 'KOTA SUMBULUSSALAM', '06'),
('07', 'SUMATERA UTARA', '0'),
('0701', 'KAB. DELISERDANG', '07'),
('0702', 'KAB. KARO', '07'),
('0703', 'KAB. LANGKAT', '07'),
('0704', 'KAB. TAPANULI TENGAH', '07'),
('0705', 'KAB. SIMALUNGUN', '07'),
('0706', 'KAB. LABUHANBATU', '07'),
('0707', 'KAB. D A I R I', '07'),
('0708', 'KAB. TAPANULI UTARA', '07'),
('0709', 'KAB. TAPANULI SELATAN', '07'),
('0710', 'KAB. ASAHAN', '07'),
('0711', 'KAB. N I A S', '07'),
('0712', 'KAB. SAMOSIR', '07'),
('0713', 'KAB. MANDAILING NATAL', '07'),
('0714', 'KAB. NIAS SELATAN', '07'),
('0715', 'KAB. PAKPAK BARAT', '07'),
('0716', 'KAB. HUMBANG HASUNDUTAN', '07'),
('0717', 'KAB. TOBA SAMOSIR', '07'),
('0718', 'KAB. TARUTUNG', '07'),
('0720', 'KAB. SERDANG BEDAGAI', '07'),
('0721', 'KAB. BATUBARA', '07'),
('0722', 'KAB. PADANG LAWAS', '07'),
('0723', 'KAB. PADANG LAWAS UTARA', '07'),
('0724', 'KAB. LABUHAN BATU SELATAN', '07'),
('0725', 'KAB. LABUHAN BATU UTARA', '07'),
('0726', 'KAB. NIAS UTARA', '07'),
('0727', 'KAB. NIAS BARAT', '07'),
('0751', 'KOTA MEDAN', '07'),
('0752', 'KOTA TEBINGTINGGI', '07'),
('0753', 'KOTA B I N J A I', '07'),
('0754', 'KOTA PEMATANGSIANTAR', '07'),
('0755', 'KOTA TANJUNGBALAI', '07'),
('0756', 'KOTA SIBOLGA', '07'),
('0757', 'KOTA PADANG SIDEMPUAN', '07'),
('0758', 'KOTA STABAT', '07'),
('0759', 'KOTA LUBUK PAKAM', '07'),
('0760', 'KOTA SIDI KALANG', '07'),
('0761', 'KOTA GUNUNG SITOLI', '07'),
('08', 'SUMATERA BARAT', '0'),
('0801', 'KAB. A G A M', '08'),
('0802', 'KAB. PASAMAN', '08'),
('0803', 'KAB. LIMAPULUH KOTA', '08'),
('0804', 'KAB. S O L O K', '08'),
('0805', 'KAB. PADANG PARIAMAN', '08'),
('0806', 'KAB. PESISIR SELATAN', '08'),
('0807', 'KAB. TANAH DATAR', '08'),
('0808', 'KAB. SAWAHLUNTO', '08'),
('0809', 'KAB. KEPULAUAN MENTAWAI', '08'),
('0810', 'KAB. DHARMAS RAYA', '08'),
('0811', 'KAB. SOLOK SELATAN', '08'),
('0812', 'KAB. PASAMAN BARAT', '08'),
('0813', 'KAB. SIJUNJUNG', '08'),
('0814', 'KAB. SAWAHLUNTO SIJUNJUNG', '08'),
('0851', 'KOTA BUKITTINGGI', '08'),
('0852', 'KOTA PADANG PANJANG', '08'),
('0853', 'KOTA S O L O K', '08'),
('0854', 'KOTA SAWAHLUNTO', '08'),
('0855', 'KOTA PADANG', '08'),
('0856', 'KOTA PAYAKUMBUH', '08'),
('0857', 'KOTA PARIAMAN', '08'),
('0858', 'KOTA LUBUK SIKAPING', '08'),
('0859', 'KOTA PAINAN', '08'),
('09', 'RIAU', '0'),
('0901', 'KAB. KAMPAR', '09'),
('0902', 'KAB. BENGKALIS', '09'),
('0904', 'KAB. INDRAGIRI HULU', '09'),
('0905', 'KAB. INDRAGIRI HILIR', '09'),
('0906', 'KAB. PELALAWAN', '09'),
('0907', 'KAB. ROKAN HULU', '09'),
('0908', 'KAB. ROKAN HILIR', '09'),
('0909', 'KAB. SIAK', '09'),
('0912', 'KAB. KUANTAN SINGINGI', '09'),
('0913', 'KAB. KEPULAUAN MERANTI', '09'),
('0951', 'KOTA PEKANBARU', '09'),
('0953', 'KOTA DUMAI', '09'),
('0954', 'KOTA RENGAT', '09'),
('0955', 'OTORITA BATAM', '09'),
('10', 'JAMBI', '0'),
('1001', 'KAB. BATANGHARI', '10'),
('1002', 'KAB. TANJUNG JABUNG BARAT', '10'),
('1003', 'KAB. BUNGO', '10'),
('1004', 'KAB. SAROLANGUN', '10'),
('1005', 'KAB. KERINCI', '10'),
('1006', 'KAB. MERANGIN', '10'),
('1007', 'KAB. TANJUNG JABUNG TIMUR', '10'),
('1008', 'KAB. T E B O', '10'),
('1009', 'KAB. MUARO JAMBI', '10'),
('1051', 'KOTA JAMBI', '10'),
('1052', 'KOTA SUNGAI PENUH', '10'),
('11', 'SUMATERA SELATAN', '0'),
('1103', 'KAB. MUSI BANYU ASIN', '11'),
('1104', 'KAB. OGAN KOMERING ULU', '11'),
('1105', 'KAB. MUARA ENIM', '11'),
('1106', 'KAB. L A H A T', '11'),
('1107', 'KAB. MUSI RAWAS', '11'),
('1108', 'KAB. OGAN KOMERING ILIR', '11'),
('1109', 'KAB. BANYUASIN', '11'),
('1110', 'KAB. OKU TIMUR', '11'),
('1111', 'KAB. OKU SELATAN', '11'),
('1112', 'KAB. OGAN ILIR', '11'),
('1113', 'KAB. OKU UTARA', '11'),
('1115', 'KAB. IDRALAYA', '11'),
('1116', 'KAB. BATU RAJA', '11'),
('1117', 'KAB. EMPAT LAWANG', '11'),
('1151', 'KOTA PALEMBANG', '11'),
('1153', 'KOTA PRABUMULIH', '11'),
('1154', 'KOTA PAGAR ALAM', '11'),
('1155', 'KOTA LUBUK LINGGAU', '11'),
('12', 'LAMPUNG', '0'),
('1201', 'KAB. LAMPUNG SELATAN', '12'),
('1202', 'KAB. LAMPUNG TENGAH', '12'),
('1203', 'KAB. LAMPUNG UTARA', '12'),
('1204', 'KAB. LAMPUNG BARAT', '12'),
('1205', 'KAB. TULANG BAWANG', '12'),
('1206', 'KAB. TANGGAMUS', '12'),
('1207', 'KAB. LAMPUNG TIMUR', '12'),
('1208', 'KAB. WAY KANAN', '12'),
('1209', 'KAB. PESAWARAN', '12'),
('1210', 'KAB. PRINGSEWU', '12'),
('1211', 'KAB. MESUJI', '12'),
('1212', 'KAB. TULANG BAWANG BARAT', '12'),
('1251', 'KOTA BANDAR LAMPUNG', '12'),
('1252', 'KOTA METRO', '12'),
('13', 'KALIMANTAN BARAT', '0'),
('1301', 'KAB. SAMBAS', '13'),
('1302', 'KAB. SANGGAU', '13'),
('1303', 'KAB. SINTANG', '13'),
('1304', 'KAB. PONTIANAK', '13'),
('1305', 'KAB. KAPUAS HULU', '13'),
('1306', 'KAB. KETAPANG', '13'),
('1307', 'KAB. BENGKAYANG', '13'),
('1308', 'KAB. LANDAK', '13'),
('1309', 'KAB. MELAWI', '13'),
('1310', 'KAB. SEKADAU', '13'),
('1311', 'KAB. KAYONG UTARA', '13'),
('1312', 'KAB. KUBU RAYA', '13'),
('1351', 'KOTA PONTIANAK', '13'),
('1352', 'KOTA SINGKAWANG', '13'),
('14', 'KALIMANTAN TENGAH', '0'),
('1401', 'KAB. KAPUAS', '14'),
('1402', 'KAB. BARITO UTARA', '14'),
('1403', 'KAB. BARITO SELATAN', '14'),
('1404', 'KAB. KOTAWARINGIN TIMUR', '14'),
('1405', 'KAB. KOTAWARINGIN BARAT', '14'),
('1406', 'KAB. KATINGAN', '14'),
('1407', 'KAB. SERUYAN', '14'),
('1408', 'KAB. SUKAMARA', '14'),
('1409', 'KAB. LAMANDAU', '14'),
('1410', 'KAB. GUNUNG MAS', '14'),
('1411', 'KAB. PULANG PISAU', '14'),
('1412', 'KAB. MURUNG RAYA', '14'),
('1413', 'KAB. BARITO TIMUR', '14'),
('1451', 'KOTA PALANGKARAYA', '14'),
('15', 'KALIMANTAN SELATAN', '0'),
('1501', 'KAB. BANJAR', '15'),
('1502', 'KAB. TANAH LAUT', '15'),
('1503', 'KAB. TAPIN', '15'),
('1504', 'KAB. HULU SUNGAI SELATAN', '15'),
('1505', 'KAB. HULU SUNGAI TENGAH', '15'),
('1506', 'KAB. BARITO KUALA', '15'),
('1507', 'KAB. TABALONG', '15'),
('1508', 'KAB. KOTABARU', '15'),
('1509', 'KAB. HULU SUNGAI UTARA', '15'),
('1510', 'KAB. TANAH BUMBU', '15'),
('1511', 'KAB. BALANGAN', '15'),
('1551', 'KOTA BANJARMASIN', '15'),
('1552', 'KOTA BANJARBARU', '15'),
('16', 'KALIMANTAN TIMUR', '0'),
('1601', 'KAB. K U T A I', '16'),
('1602', 'KAB. P A S E R', '16'),
('1603', 'KAB. BULUNGAN', '16'),
('1604', 'KAB. B E R A U', '16'),
('1605', 'KAB. NUNUKAN', '16'),
('1606', 'KAB. MALINAU', '16'),
('1607', 'KAB. KUTAI BARAT', '16'),
('1608', 'KAB. KUTAI TIMUR', '16'),
('1609', 'KAB. PENAJAM PASER UTARA', '16'),
('1610', 'KAB. KUTAI KERTANEGARA', '16'),
('1611', 'TENGGARONG', '16'),
('1612', 'KAB. TANA TIDUNG', '16'),
('1651', 'KOTA SAMARINDA', '16'),
('1652', 'KOTA BALIKPAPAN', '16'),
('1653', 'KOTA TARAKAN', '16'),
('1654', 'KOTA BONTANG', '16'),
('17', 'SULAWESI UTARA', '0'),
('1702', 'KAB. MINAHASA', '17'),
('1703', 'KAB. BOLAANG MONGONDOW', '17'),
('1704', 'KAB. KEPULAUAN SANGIHE', '17'),
('1705', 'KAB. KEPULAUAN TALAUD', '17'),
('1706', 'KAB. MINAHASA SELATAN', '17'),
('1707', 'KAB. TOMOHON', '17'),
('1708', 'KAB. MINAHASA UTARA', '17'),
('1709', 'KAB. KEP.SANGIHE TALAUD', '17'),
('1710', 'KAB. MINAHASA TENGGARA', '17'),
('1711', 'KAB. BOLAANG MONGONDOW UTARA', '17'),
('1712', 'KAB. KEP. SIAU TAGULANDANG BIARO', '17'),
('1713', 'KAB. BOLAANG MONGONDOW SELATAN', '17'),
('1714', 'KAB. BOLAANG MONGONDOW TIMUR', '17'),
('1751', 'KOTA MANADO', '17'),
('1752', 'KOTA TOMOHON', '17'),
('1753', 'KOTA BITUNG', '17'),
('1754', 'KOTA KOTAMOBAGO', '17'),
('18', 'SULAWESI TENGAH', '0'),
('1801', 'KAB. P O S O', '18'),
('1802', 'KAB. DONGGALA', '18'),
('1803', 'KAB. TOLI-TOLI', '18'),
('1804', 'KAB. BANGGAI', '18'),
('1805', 'KAB. B U O L', '18'),
('1806', 'KAB. MOROWALI', '18'),
('1807', 'KAB. BANGGAI KEPULAUAN', '18'),
('1808', 'KAB. PARIGI MOUTONG', '18'),
('1809', 'KAB. TOJO UNA-UNA', '18'),
('1812', 'KAB. SIGI', '18'),
('1851', 'KOTA PALU', '18'),
('19', 'SULAWESI SELATAN', '0'),
('1901', 'KAB. PINRANG', '19'),
('1902', 'KAB. GOWA', '19'),
('1903', 'KAB. WAJO', '19'),
('1905', 'KAB. BONE', '19'),
('1906', 'KAB. TANATORAJA', '19'),
('1907', 'KAB. MAROS', '19'),
('1909', 'KAB. LUWU', '19'),
('1910', 'KAB. SINJAI', '19'),
('1911', 'KAB. BULUKUMBA', '19'),
('1912', 'KAB. BANTAENG', '19'),
('1913', 'KAB. JENEPONTO', '19'),
('1914', 'KAB. KEPULAUAN SELAYAR', '19'),
('1915', 'KAB. TAKALAR', '19'),
('1916', 'KAB. BARRU', '19'),
('1917', 'KAB. SIDENRENG RAPPANG', '19'),
('1918', 'KAB. PANGKAJENE KEPULAUAN', '19'),
('1919', 'KAB. SOPPENG', '19'),
('1921', 'KAB. ENREKANG', '19'),
('1922', 'KAB. LUWU UTARA', '19'),
('1924', 'KAB. LUWU TIMUR', '19'),
('1925', 'KAB. TORAJA UTARA', '19'),
('1951', 'KOTA MAKASSAR', '19'),
('1952', 'KOTA PARE-PARE', '19'),
('1953', 'KOTA PALOPO', '19'),
('20', 'SULAWESI TENGGARA', '0'),
('2001', 'KAB. KENDARI (SDH TIDAK ADA)', '20'),
('2002', 'KAB. BUTON', '20'),
('2003', 'KAB. MUNA', '20'),
('2004', 'KAB. KOLAKA', '20'),
('2005', 'KAB. KONAWE SELATAN', '20'),
('2006', 'KAB. BOMBANA', '20'),
('2007', 'KAB. WAKATOBI', '20'),
('2008', 'KAB. KOLAKA UTARA', '20'),
('2009', 'KAB. KONAWE', '20'),
('2010', 'KAB. KONAWE UTARA', '20'),
('2011', 'KAB. BUTON UTARA', '20'),
('2051', 'KOTA KENDARI', '20'),
('2052', 'KOTA BAU-BAU', '20'),
('21', 'MALUKU', '0'),
('2101', 'KAB. MALUKU TENGAH', '21'),
('2102', 'KAB. MALUKU TENGGARA', '21'),
('2103', 'KAB. MALUKU TENGGARA BARAT', '21'),
('2104', 'KAB. PULAU BURU', '21'),
('2105', 'KAB. KEPULAUAN ARU', '21'),
('2106', 'KAB. SERAM BAGIAN BARAT', '21'),
('2107', 'KAB. SERAM BAGIAN TIMUR', '21'),
('2108', 'KAB. MALUKU', '21'),
('2109', 'KAB. MALUKU BARAT DAYA', '21'),
('2110', 'KAB. BURU SELATAN', '21'),
('2151', 'KOTA AMBON', '21'),
('2152', 'KOTA TUAL', '21'),
('22', 'BALI', '0'),
('2201', 'KAB. BULELENG', '22'),
('2202', 'KAB. JEMBRANA', '22'),
('2203', 'KAB. KLUNGKUNG', '22'),
('2204', 'KAB. GIANYAR', '22'),
('2205', 'KAB. KARANGASEM', '22'),
('2206', 'KAB. BANGLI', '22'),
('2207', 'KAB. BADUNG', '22'),
('2208', 'KAB. TABANAN', '22'),
('2209', 'KAB. NEGARA', '22'),
('2251', 'KOTA DENPASAR', '22'),
('23', 'NUSA TENGGARA BARAT', '0'),
('2301', 'KAB. LOMBOK BARAT', '23'),
('2302', 'KAB. LOMBOK TENGAH', '23'),
('2303', 'KAB. LOMBOK TIMUR', '23'),
('2304', 'KAB. B I M A', '23'),
('2305', 'KAB. SUMBAWA', '23'),
('2306', 'KAB. DOMPU', '23'),
('2307', 'KAB. SUMBAWA BARAT', '23'),
('2308', 'KAB. LOMBOK UTARA', '23'),
('2351', 'KOTA MATARAM', '23'),
('2352', 'KOTA BIMA', '23'),
('24', 'NUSA TENGGARA TIMUR', '0'),
('2401', 'KAB. KUPANG', '24'),
('2402', 'KAB. B E L U', '24'),
('2403', 'KAB. TIMOR TENGAH UTARA', '24'),
('2404', 'KAB. TIMOR TENGAH SELATAN', '24'),
('2405', 'KAB. A L O R', '24'),
('2406', 'KAB. S I K K A', '24'),
('2407', 'KAB. FLORES TIMUR', '24'),
('2408', 'KAB. E N D E', '24'),
('2409', 'KAB. NGADA', '24'),
('2410', 'KAB. MANGGARAI', '24'),
('2411', 'KAB. SUMBA TIMUR', '24'),
('2412', 'KAB. SUMBA BARAT', '24'),
('2413', 'KAB. LEMBATA', '24'),
('2414', 'KAB. ROTE NDAO', '24'),
('2415', 'KAB. MANGGARAI BARAT', '24'),
('2416', 'KAB. TIMOR', '24'),
('2417', 'KAB. NAGEKEO', '24'),
('2418', 'KAB. SUMBA TENGAH', '24'),
('2419', 'KAB. SUMBA BARAT DAYA', '24'),
('2420', 'MANGGARAI TIMUR', '24'),
('2421', 'KAB. SABU RAIJUA', '24'),
('2451', 'KOTA KUPANG', '24'),
('2453', 'KAB. RUTENG', '24'),
('25', 'PAPUA', '0'),
('2501', 'KAB. JAYAPURA', '25'),
('2502', 'KAB. BIAK-NUMFOR', '25'),
('2504', 'KAB. KEPULAUAN YAPEN', '25'),
('2507', 'KAB. MERAUKE', '25'),
('2508', 'KAB. JAYAWIJAYA', '25'),
('2509', 'KAB. PANIAI', '25'),
('2510', 'KAB. NABIRE', '25'),
('2511', 'KAB. PUNCAK JAYA', '25'),
('2512', 'KAB. MIMIKA', '25'),
('2513', 'KAB. MAPPI', '25'),
('2514', 'KAB. ASMAT', '25'),
('2515', 'KAB. BOVEN DIGOEL', '25'),
('2516', 'KAB. SARMI', '25'),
('2517', 'KAB. KEEROM', '25'),
('2518', 'KAB. TOLIKARA', '25'),
('2519', 'KAB. PEGUNUNGAN BINTANG', '25'),
('2520', 'KAB. MAMBERAMO RAYA', '25'),
('2523', 'KAB. WAROPEN', '25'),
('2524', 'KAB. YAHUKIMO', '25'),
('2527', 'KAB. SUPIORI', '25'),
('2528', 'MAMBERAMO TENGAH', '25'),
('2529', 'KAB. LANNY JAYA', '25'),
('2530', 'KAB.DOGIYAI', '25'),
('2531', 'KAB.YALIMO', '25'),
('2532', 'KAB.NDUGA', '25'),
('2533', 'KAB. PUNCAK', '25'),
('2534', 'KAB. DAYAI', '25'),
('2535', 'KAB. INTAN JAYA', '25'),
('2536', 'KAB. DEIYAI', '25'),
('2551', 'KOTA JAYAPURA', '25'),
('26', 'BENGKULU', '0'),
('2601', 'KAB. BENGKULU UTARA', '26'),
('2602', 'KAB. BENGKULU SELATAN', '26'),
('2603', 'KAB. REJANG LEBONG', '26'),
('2604', 'KAB. SELUMA', '26'),
('2605', 'KAB. K A U R', '26'),
('2606', 'KAB. MUKO-MUKO', '26'),
('2607', 'KAB. LEBONG', '26'),
('2608', 'KAB. KEPAHIANG', '26'),
('2609', 'KAB. BENGKULU TENGAH', '26'),
('2651', 'KOTA BENGKULU', '26'),
('28', 'MALUKU UTARA', '0'),
('2801', 'KAB. MALUKU UTARA', '28'),
('2802', 'KAB. HALMAHERA TENGAH', '28'),
('2803', 'KAB. HALMAHERA UTARA', '28'),
('2804', 'KAB. HALMAHERA SELATAN', '28'),
('2805', 'KAB. KEPULAUAN SULA', '28'),
('2806', 'KAB. HALMAHERA TIMUR', '28'),
('2807', 'KAB. HALMAHERA BARAT', '28'),
('2808', 'KAB. PULAU MOROTAI', '28'),
('2851', 'KOTA TERNATE', '28'),
('2852', 'KOTA TIDORE', '28'),
('2853', 'KOTA TIDORE KEPULAUAN', '28'),
('29', 'BANTEN', '0'),
('2901', 'KAB. SERANG', '29'),
('2902', 'KAB. PANDEGLANG', '29'),
('2903', 'KAB. LEBAK', '29'),
('2904', 'KAB. TANGERANG', '29'),
('2951', 'KOTA TANGERANG', '29'),
('2952', 'KOTA CILEGON', '29'),
('2953', 'KOTA SERANG', '29'),
('2954', 'KOTA TANGERANG SELATAN', '29'),
('30', 'BANGKA BELITUNG', '0'),
('3001', 'KAB. BELITUNG', '30'),
('3002', 'KAB. BANGKA', '30'),
('3003', 'KAB. BANGKA BARAT', '30'),
('3004', 'KAB. BANGKA TENGAH', '30'),
('3005', 'KAB. BANGKA SELATAN', '30'),
('3006', 'KAB. BELITUNG TIMUR', '30'),
('3007', 'KAB. SUNGAI LIAT', '30'),
('3051', 'KOTA PANGKALPINANG', '30'),
('31', 'GORONTALO', '0'),
('3101', 'KAB. GORONTALO', '31'),
('3102', 'KAB. BOALEMO', '31'),
('3103', 'KAB. POHUWATO', '31'),
('3104', 'KAB. BONE BOLANGO', '31'),
('3105', 'KAB. LIMBOTO', '31'),
('3106', 'KAB. MARISA', '31'),
('3107', 'KAB. GORONTALO UTARA', '31'),
('3151', 'KOTA GORONTALO', '31'),
('32', 'KEPULAUAN RIAU', '0'),
('3201', 'KAB. BINTAN', '32'),
('3202', 'KAB. KARIMUN', '32'),
('3203', 'KAB. NATUNA', '32'),
('3204', 'KAB. LINGGA', '32'),
('3205', 'KAB. ANAMBAS', '32'),
('3206', 'KAB. BARELANG', '32'),
('3207', 'KAB. MERANTI', '32'),
('3251', 'KOTA BATAM', '32'),
('3252', 'KOTA TANJUNG PINANG', '32'),
('33', 'PAPUA BARAT', '0'),
('3301', 'KAB. MANOKWARI', '33'),
('3302', 'KAB. SORONG', '33'),
('3303', 'KAB. FAK FAK', '33'),
('3304', 'KAB. SORONG SELATAN', '33'),
('3305', 'KAB. RAJA AMPAT', '33'),
('3306', 'KAB. TELUK BINTUNI', '33'),
('3307', 'KAB. TELUK WONDAMA', '33'),
('3308', 'KAB. KAIMANA', '33'),
('3309', 'KAB. TAMBRAUW', '33'),
('3310', 'KAB. MAYBRAT', '33'),
('34', 'SULAWESI BARAT', '0'),
('3401', 'KAB. MAJENE', '34'),
('3402', 'KAB. MAMUJU', '34'),
('3403', 'KAB. MAMUJU UTARA', '34'),
('3404', 'KAB. POLEWALI MANDAR', '34'),
('3405', 'KAB. MAMASA', '34'),
('3451', 'KOTA.MAMUJU', '34');

-- --------------------------------------------------------

--
-- Table structure for table `tmp_import`
--

CREATE TABLE IF NOT EXISTS `tmp_import` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `no` varchar(200) DEFAULT NULL,
  `merek` varchar(200) DEFAULT NULL,
  `produsen` varchar(200) DEFAULT NULL,
  `nppbkc` varchar(200) DEFAULT NULL,
  `kode_status` varchar(200) DEFAULT NULL,
  `alamat` varchar(200) DEFAULT NULL,
  `kota` varchar(200) DEFAULT NULL,
  `prov` varchar(200) DEFAULT NULL,
  `telp` varchar(200) DEFAULT NULL,
  `fax` varchar(200) DEFAULT NULL,
  `pemilik` varchar(200) DEFAULT NULL,
  `jenis_rokok` varchar(200) DEFAULT NULL,
  `isi` varchar(200) DEFAULT NULL,
  `satuan_kemasan` varchar(200) DEFAULT NULL,
  `bentuk_kemasan` varchar(200) DEFAULT NULL,
  `jenis_gambar` varchar(200) DEFAULT NULL,
  `tulisan_peringatan` varchar(200) DEFAULT NULL,
  `phw_depan` varchar(200) DEFAULT NULL,
  `kemasan_depan` varchar(200) DEFAULT NULL,
  `luas_phw_depan` varchar(200) DEFAULT NULL,
  `phw_belakang` varchar(200) DEFAULT NULL,
  `kemasan_belakang` varchar(200) DEFAULT NULL,
  `luas_phw_belakang` varchar(200) DEFAULT NULL,
  `nikotin` varchar(200) DEFAULT NULL,
  `tar` varchar(200) DEFAULT NULL,
  `sisi` varchar(200) DEFAULT NULL,
  `tulisan` varchar(200) DEFAULT NULL,
  `dilarang_menjual` varchar(200) DEFAULT NULL,
  `kode_produksi` varchar(200) DEFAULT NULL,
  `tgl_produksi` varchar(200) DEFAULT NULL,
  `alamat_produsen` varchar(200) DEFAULT NULL,
  `tidak_aman` varchar(200) DEFAULT NULL,
  `zat_kimia` varchar(200) DEFAULT NULL,
  `kata_promotif` varchar(200) DEFAULT NULL,
  `jenis_kata_promotif` varchar(200) DEFAULT NULL,
  `evaluasi` varchar(200) DEFAULT NULL,
  `kesimpulan_label` varchar(200) DEFAULT NULL,
  `lab` varchar(200) DEFAULT NULL,
  `alamat_lab` varchar(200) DEFAULT NULL,
  `telp_lab` varchar(200) DEFAULT NULL,
  `fax_lab` varchar(200) DEFAULT NULL,
  `account_lab` varchar(200) DEFAULT NULL,
  `kode_produksi_lab` varchar(200) DEFAULT NULL,
  `kode_sampel` varchar(200) DEFAULT NULL,
  `nomor_lab` varchar(200) DEFAULT NULL,
  `tgl_uji` varchar(200) DEFAULT NULL,
  `nikotin_uji` varchar(200) DEFAULT NULL,
  `tar_uji` varchar(200) DEFAULT NULL,
  `tar_sni_uji` varchar(200) DEFAULT NULL,
  `phw_ditemukan` varchar(200) DEFAULT NULL,
  `harga_bungkus` varchar(200) DEFAULT NULL,
  `harga_batang` varchar(200) DEFAULT NULL,
  `tahun_pengawsan` varchar(200) DEFAULT NULL,
  `berkas_penilaian` varchar(200) DEFAULT NULL,
  `contoh_kemasan` varchar(200) DEFAULT NULL,
  `gambar_depan` varchar(200) DEFAULT NULL,
  `gambar_belakang` varchar(200) DEFAULT NULL,
  `gambar_kanan` varchar(200) DEFAULT NULL,
  `gambar_kiri` varchar(200) DEFAULT NULL,
  `gambar_atas` varchar(200) DEFAULT NULL,
  `gambar_bawah` varchar(200) DEFAULT NULL,
  `keterangan` varchar(200) DEFAULT NULL,
  `session` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `tmp_import`
--

INSERT INTO `tmp_import` (`id`, `no`, `merek`, `produsen`, `nppbkc`, `kode_status`, `alamat`, `kota`, `prov`, `telp`, `fax`, `pemilik`, `jenis_rokok`, `isi`, `satuan_kemasan`, `bentuk_kemasan`, `jenis_gambar`, `tulisan_peringatan`, `phw_depan`, `kemasan_depan`, `luas_phw_depan`, `phw_belakang`, `kemasan_belakang`, `luas_phw_belakang`, `nikotin`, `tar`, `sisi`, `tulisan`, `dilarang_menjual`, `kode_produksi`, `tgl_produksi`, `alamat_produsen`, `tidak_aman`, `zat_kimia`, `kata_promotif`, `jenis_kata_promotif`, `evaluasi`, `kesimpulan_label`, `lab`, `alamat_lab`, `telp_lab`, `fax_lab`, `account_lab`, `kode_produksi_lab`, `kode_sampel`, `nomor_lab`, `tgl_uji`, `nikotin_uji`, `tar_uji`, `tar_sni_uji`, `phw_ditemukan`, `harga_bungkus`, `harga_batang`, `tahun_pengawsan`, `berkas_penilaian`, `contoh_kemasan`, `gambar_depan`, `gambar_belakang`, `gambar_kanan`, `gambar_kiri`, `gambar_atas`, `gambar_bawah`, `keterangan`, `session`) VALUES
(1, '2992', 'Oepet Oe Sps Biru Putih 10', 'Ongkowidjojo, PT', '0706.1.3.0088', '1', 'Jl. Kolonel Sugiono 80 Malang 65148', 'Malang', 'Jawa Timur', '(0341) 362211', '(0341) 328139', 'Adrian Suharko', 'SKT', '10', 'btg/bgks', 'Kotak Persegi Panjang', '1', NULL, '3.2', '7.8', '41.03', '3.2', '7.8', '41.03', '1.7', '31.5', 'S', 'S', 'S', NULL, '', 'PT Ongkowidjojo, Malang', 'A', 'A', 'A', '', 'MK', 'MK', 'Laboratorium Penguji PT Bentoel Prima', 'Jl. Raya Karanglo - Singosari, Malang, Jawa Timur', '(0341) 490000', '(0341) 493697', 'NN Bhayangkari', '', '0405/KTb/E/04', '0405/SY/05/04', '06 0505 2004', '1.7', '31.5', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'kgd8eb43k598vpeec1mbvsqvf3'),
(2, '2993', 'Oepet Oe Sps Biru Putih 10', 'Ongkowidjojo, PT', '0706.1.3.0088', '1', 'Jl. Kolonel Sugiono 80 Malang 65149', 'Malang', 'Jawa Timur', '(0341) 362211', '(0341) 328139', 'Adrian Suharko', 'SKT', '10', 'btg/bgks', 'Kotak Persegi Panjang', '2', NULL, '3.2', '7.8', '41.03', '3.2', '7.8', '41.03', '1.7', '31.5', 'S', 'S', 'S', NULL, '', 'PT Ongkowidjojo, Malang', 'A', 'A', 'A', '', 'MK', 'MK', 'Laboratorium Penguji PT Bentoel Prima', 'Jl. Raya Karanglo - Singosari, Malang, Jawa Timur', '(0341) 490000', '(0341) 493697', 'NN Bhayangkari', '', '0405/KTb/E/04', '0405/SY/05/04', '06 0505 2004', '1.7', '31.5', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'kgd8eb43k598vpeec1mbvsqvf3'),
(3, '2994', 'Oepet Oe Sps Biru Putih 10', 'Ongkowidjojo, PT', '0706.1.3.0088', '1', 'Jl. Kolonel Sugiono 80 Malang 65150', 'Malang', 'Jawa Timur', '(0341) 362211', '(0341) 328139', 'Adrian Suharko', 'SKT', '10', 'btg/bgks', 'Kotak Persegi Panjang', '3', NULL, '3.2', '7.8', '41.03', '3.2', '7.8', '41.03', '1.7', '31.5', 'S', 'S', 'S', NULL, '', 'PT Ongkowidjojo, Malang', 'A', 'A', 'A', '', 'MK', 'MK', 'Laboratorium Penguji PT Bentoel Prima', 'Jl. Raya Karanglo - Singosari, Malang, Jawa Timur', '(0341) 490000', '(0341) 493697', 'NN Bhayangkari', '', '0405/KTb/E/04', '0405/SY/05/04', '06 0505 2004', '1.7', '31.5', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'kgd8eb43k598vpeec1mbvsqvf3'),
(4, '2995', 'Oepet Oe Sps Biru Putih 10', 'Ongkowidjojo, PT', '0706.1.3.0088', '1', 'Jl. Kolonel Sugiono 80 Malang 65151', 'Malang', 'Jawa Timur', '(0341) 362211', '(0341) 328139', 'Adrian Suharko', 'SKT', '10', 'btg/bgks', 'Kotak Persegi Panjang', '4', NULL, '3.2', '7.8', '41.03', '3.2', '7.8', '41.03', '1.7', '31.5', 'S', 'S', 'S', NULL, '', 'PT Ongkowidjojo, Malang', 'A', 'A', 'A', '', 'MK', 'MK', 'Laboratorium Penguji PT Bentoel Prima', 'Jl. Raya Karanglo - Singosari, Malang, Jawa Timur', '(0341) 490000', '(0341) 493697', 'NN Bhayangkari', '', '0405/KTb/E/04', '0405/SY/05/04', '06 0505 2004', '1.7', '31.5', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'kgd8eb43k598vpeec1mbvsqvf3'),
(5, '2996', 'Oepet Oe Sps Biru Putih 10', 'Ongkowidjojo, PT', '0706.1.3.0088', '1', 'Jl. Kolonel Sugiono 80 Malang 65152', 'Malang', 'Jawa Timur', '(0341) 362211', '(0341) 328139', 'Adrian Suharko', 'SKT', '10', 'btg/bgks', 'Kotak Persegi Panjang', '5', NULL, '3.2', '7.8', '41.03', '3.2', '7.8', '41.03', '1.7', '31.5', 'S', 'S', 'S', NULL, '', 'PT Ongkowidjojo, Malang', 'A', 'A', 'A', '', 'MK', 'MK', 'Laboratorium Penguji PT Bentoel Prima', 'Jl. Raya Karanglo - Singosari, Malang, Jawa Timur', '(0341) 490000', '(0341) 493697', 'NN Bhayangkari', '', '0405/KTb/E/04', '0405/SY/05/04', '06 0505 2004', '1.7', '31.5', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'kgd8eb43k598vpeec1mbvsqvf3'),
(6, '2997', 'Oepet Extra Special 12', 'Ongkowidjojo, PT', '0706.1.3.0088', '1', 'Jl. Kolonel Sugiono 80 Malang 65153', 'Malang', 'Jawa Timur', '(0341) 362211', '(0341) 328139', 'Adrian Suharko', 'SKT', '12', 'btg/bgks', 'Kotak Persegi Panjang', '1', NULL, '3.4', '8.4', '40.48', '3.4', '8.4', '40.48', '1.8', '35.3', 'S', 'S', 'S', NULL, '', 'PT Ongkowidjojo, Malang', 'A', 'A', 'A', '', 'MK', 'MK', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'kgd8eb43k598vpeec1mbvsqvf3'),
(7, '2998', 'Oepet Extra Special 12', 'Ongkowidjojo, PT', '0706.1.3.0088', '1', 'Jl. Kolonel Sugiono 80 Malang 65153', 'Malang', 'Jawa Timur', '(0341) 362211', '(0341) 328139', 'Adrian Suharko', 'SKT', '12', 'btg/bgks', 'Kotak Persegi Panjang', '2', NULL, '3.4', '8.4', '40.48', '3.4', '8.4', '40.48', '1.8', '35.3', 'S', 'S', 'S', NULL, '', 'PT Ongkowidjojo, Malang', 'A', 'A', 'A', '', 'MK', 'MK', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'kgd8eb43k598vpeec1mbvsqvf3'),
(8, '2999', 'Oepet Extra Special 12', 'Ongkowidjojo, PT', '0706.1.3.0088', '1', 'Jl. Kolonel Sugiono 80 Malang 65153', 'Malang', 'Jawa Timur', '(0341) 362211', '(0341) 328139', 'Adrian Suharko', 'SKT', '12', 'btg/bgks', 'Kotak Persegi Panjang', '3', NULL, '3.4', '8.4', '40.48', '3.4', '8.4', '40.48', '1.8', '35.3', 'S', 'S', 'S', NULL, '', 'PT Ongkowidjojo, Malang', 'A', 'A', 'A', '', 'MK', 'MK', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'kgd8eb43k598vpeec1mbvsqvf3'),
(9, '3000', 'Oepet Extra Special 12', 'Ongkowidjojo, PT', '0706.1.3.0088', '1', 'Jl. Kolonel Sugiono 80 Malang 65153', 'Malang', 'Jawa Timur', '(0341) 362211', '(0341) 328139', 'Adrian Suharko', 'SKT', '12', 'btg/bgks', 'Kotak Persegi Panjang', '4', NULL, '3.4', '8.4', '40.48', '3.4', '8.4', '40.48', '1.8', '35.3', 'S', 'S', 'S', NULL, '', 'PT Ongkowidjojo, Malang', 'A', 'A', 'A', '', 'MK', 'MK', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'kgd8eb43k598vpeec1mbvsqvf3'),
(10, '3001', 'Oepet Extra Special 12', 'Ongkowidjojo, PT', '0706.1.3.0088', '1', 'Jl. Kolonel Sugiono 80 Malang 65153', 'Malang', 'Jawa Timur', '(0341) 362211', '(0341) 328139', 'Adrian Suharko', 'SKT', '12', 'btg/bgks', 'Kotak Persegi Panjang', '5', NULL, '3.4', '8.4', '40.48', '3.4', '8.4', '40.48', '1.8', '35.3', 'S', 'S', 'S', NULL, '', 'PT Ongkowidjojo, Malang', 'A', 'A', 'A', '', 'MK', 'MK', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'kgd8eb43k598vpeec1mbvsqvf3');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
