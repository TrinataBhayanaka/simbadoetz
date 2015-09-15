-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 15, 2015 at 12:01 PM
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
-- Table structure for table `penyusutan_pertahun`
--

CREATE TABLE IF NOT EXISTS `penyusutan_pertahun` (
`id` int(11) NOT NULL,
  `Penyusutan_ID` int(11) DEFAULT NULL,
  `Aset_ID` text,
  `Tahun` int(11) DEFAULT NULL,
  `StatusRunning` tinyint(4) DEFAULT '0'
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `penyusutan_pertahun`
--

INSERT INTO `penyusutan_pertahun` (`id`, `Penyusutan_ID`, `Aset_ID`, `Tahun`, `StatusRunning`) VALUES
(1, 7, '1709604,1709605', 2015, 3),
(2, 1, '711380,711385,711386,711387', 2015, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `penyusutan_pertahun`
--
ALTER TABLE `penyusutan_pertahun`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `penyusutan_pertahun`
--
ALTER TABLE `penyusutan_pertahun`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
