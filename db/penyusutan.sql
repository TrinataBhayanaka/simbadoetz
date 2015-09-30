-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 15, 2015 at 12:00 PM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `simbada_revisi_v2`
--

-- --------------------------------------------------------

--
-- Table structure for table `penyusutan`
--

CREATE TABLE IF NOT EXISTS `penyusutan` (
`Penyusutan_ID` int(11) NOT NULL,
  `SatkerUsul` varchar(150) DEFAULT NULL,
  `NoSKPenyusutan` varchar(50) DEFAULT NULL,
  `TglPenyusutan` date DEFAULT NULL,
  `AlasanPenyusutan` text,
  `Status` tinyint(4) DEFAULT NULL,
  `UserNm` varchar(50) DEFAULT NULL,
  `FixPenyusutan` tinyint(4) DEFAULT NULL,
  `Tahun` varchar(5) DEFAULT NULL,
  `Usulan_ID` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `penyusutan`
--
ALTER TABLE `penyusutan`
 ADD PRIMARY KEY (`Penyusutan_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `penyusutan`
--
ALTER TABLE `penyusutan`
MODIFY `Penyusutan_ID` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
