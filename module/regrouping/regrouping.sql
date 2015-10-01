-- phpMyAdmin SQL Dump
-- version 4.1.14.8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 01, 2015 at 02:31 PM
-- Server version: 10.0.15-MariaDB-log
-- PHP Version: 5.6.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `simbada_2014_full_v1-01oktober2015`
--

-- --------------------------------------------------------

--
-- Table structure for table `regrouping`
--

CREATE TABLE IF NOT EXISTS `regrouping` (
  `id_regrouping` int(11) NOT NULL AUTO_INCREMENT,
  `satker_lama` varchar(255) NOT NULL,
  `nama_satker_lama` tinytext NOT NULL,
  `satker_baru` varchar(255) NOT NULL,
  `nama_satker_baru` tinytext NOT NULL,
  `status_proses` int(11) NOT NULL,
  `informasi` tinytext NOT NULL,
  `tgl_proses` datetime NOT NULL,
  PRIMARY KEY (`id_regrouping`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
