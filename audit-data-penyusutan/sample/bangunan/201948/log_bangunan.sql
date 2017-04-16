-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 16, 2017 at 09:24 PM
-- Server version: 10.0.29-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `simbada_pekalongan_2016_20170224`
--

-- --------------------------------------------------------

--
-- Table structure for table `log_bangunan`
--

CREATE TABLE `log_bangunan` (
  `log_id` int(11) NOT NULL,
  `Bangunan_ID` int(11) DEFAULT NULL,
  `Aset_ID` int(11) DEFAULT NULL,
  `kodeKelompok` varchar(255) DEFAULT NULL,
  `kodeSatker` varchar(255) DEFAULT NULL,
  `kodeLokasi` varchar(255) DEFAULT NULL,
  `noRegister` varchar(255) DEFAULT NULL,
  `TglPerolehan` date DEFAULT NULL,
  `TglPembukuan` date DEFAULT NULL,
  `kodeData` int(11) DEFAULT NULL,
  `kodeKA` int(11) DEFAULT NULL,
  `kodeRuangan` int(11) DEFAULT NULL,
  `StatusValidasi` tinyint(4) DEFAULT NULL,
  `Status_Validasi_Barang` tinyint(4) DEFAULT NULL,
  `Tahun` int(11) DEFAULT NULL,
  `NilaiPerolehan` decimal(50,4) DEFAULT NULL,
  `Alamat` text,
  `Info` text,
  `AsalUsul` varchar(100) DEFAULT NULL,
  `kondisi` tinyint(1) DEFAULT NULL,
  `CaraPerolehan` varchar(20) DEFAULT NULL,
  `TglPakai` date DEFAULT NULL,
  `Konstruksi` varchar(2) DEFAULT NULL,
  `Beton` tinyint(1) DEFAULT NULL,
  `JumlahLantai` int(11) DEFAULT NULL,
  `LuasLantai` double DEFAULT NULL,
  `Dinding` varchar(100) DEFAULT NULL,
  `Lantai` varchar(100) DEFAULT NULL,
  `LangitLangit` varchar(100) DEFAULT NULL,
  `Atap` varchar(100) DEFAULT NULL,
  `NoSurat` varchar(50) DEFAULT NULL,
  `TglSurat` date DEFAULT NULL,
  `NoIMB` varchar(50) DEFAULT NULL,
  `TglIMB` date DEFAULT NULL,
  `StatusTanah` varchar(20) DEFAULT NULL,
  `NoSertifikat` varchar(50) DEFAULT NULL,
  `TglSertifikat` date DEFAULT NULL,
  `Tanah_ID` int(11) DEFAULT '0',
  `Tmp_Tingkat` varchar(50) DEFAULT NULL,
  `Tmp_Beton` varchar(50) DEFAULT NULL,
  `Tmp_Luas` double DEFAULT NULL,
  `KelompokTanah_ID` varchar(20) DEFAULT NULL,
  `GUID` varchar(100) DEFAULT NULL,
  `TglPembangunan` date DEFAULT NULL,
  `changeDate` date DEFAULT NULL,
  `action` varchar(50) DEFAULT NULL,
  `operator` varchar(150) DEFAULT NULL,
  `TglPerubahan` datetime DEFAULT NULL,
  `NilaiPerolehan_Awal` decimal(50,4) DEFAULT NULL,
  `Kd_Riwayat` varchar(50) DEFAULT NULL,
  `No_Dokumen` varchar(100) DEFAULT NULL,
  `StatusTampil` tinyint(4) DEFAULT NULL,
  `MasaManfaat` int(11) DEFAULT NULL,
  `AkumulasiPenyusutan` decimal(50,4) DEFAULT NULL,
  `NilaiBuku` decimal(50,4) DEFAULT NULL,
  `PenyusutanPerTahun` decimal(50,4) DEFAULT NULL,
  `AkumulasiPenyusutan_Awal` decimal(50,4) DEFAULT NULL,
  `NilaiBuku_Awal` decimal(50,4) DEFAULT NULL,
  `PenyusutanPerTahun_Awal` decimal(50,4) DEFAULT NULL,
  `Aset_ID_Penambahan` int(11) DEFAULT NULL,
  `UmurEkonomis` int(11) DEFAULT NULL,
  `TahunPenyusutan` int(11) DEFAULT NULL,
  `nilai_kapitalisasi` decimal(50,4) DEFAULT NULL,
  `prosentase` decimal(50,4) DEFAULT NULL,
  `penambahan_masa_manfaat` decimal(50,4) DEFAULT NULL,
  `mutasi_ak_tambah` decimal(50,4) NOT NULL DEFAULT '0.0000',
  `mutasi_ak_kurang` decimal(50,4) NOT NULL DEFAULT '0.0000',
  `jenis_belanja` int(11) NOT NULL DEFAULT '0',
  `kodeKelompokReklasAsal` varchar(150) DEFAULT NULL,
  `kodeKelompokReklasTujuan` varchar(150) DEFAULT NULL,
  `jenis_hapus` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `log_bangunan`
--

INSERT INTO `log_bangunan` (`log_id`, `Bangunan_ID`, `Aset_ID`, `kodeKelompok`, `kodeSatker`, `kodeLokasi`, `noRegister`, `TglPerolehan`, `TglPembukuan`, `kodeData`, `kodeKA`, `kodeRuangan`, `StatusValidasi`, `Status_Validasi_Barang`, `Tahun`, `NilaiPerolehan`, `Alamat`, `Info`, `AsalUsul`, `kondisi`, `CaraPerolehan`, `TglPakai`, `Konstruksi`, `Beton`, `JumlahLantai`, `LuasLantai`, `Dinding`, `Lantai`, `LangitLangit`, `Atap`, `NoSurat`, `TglSurat`, `NoIMB`, `TglIMB`, `StatusTanah`, `NoSertifikat`, `TglSertifikat`, `Tanah_ID`, `Tmp_Tingkat`, `Tmp_Beton`, `Tmp_Luas`, `KelompokTanah_ID`, `GUID`, `TglPembangunan`, `changeDate`, `action`, `operator`, `TglPerubahan`, `NilaiPerolehan_Awal`, `Kd_Riwayat`, `No_Dokumen`, `StatusTampil`, `MasaManfaat`, `AkumulasiPenyusutan`, `NilaiBuku`, `PenyusutanPerTahun`, `AkumulasiPenyusutan_Awal`, `NilaiBuku_Awal`, `PenyusutanPerTahun_Awal`, `Aset_ID_Penambahan`, `UmurEkonomis`, `TahunPenyusutan`, `nilai_kapitalisasi`, `prosentase`, `penambahan_masa_manfaat`, `mutasi_ak_tambah`, `mutasi_ak_kurang`, `jenis_belanja`, `kodeKelompokReklasAsal`, `kodeKelompokReklasTujuan`, `jenis_hapus`) VALUES
(977, 1869, 201948, '03.11.01.04.04', '11.01.01.01', '12.11.33.11.01.10.01.01', '2', '2010-06-14', '2010-06-14', 1, 1, 0, 1, 1, 2010, '800433000.0000', '', '', 'Pembelian', 1, '', '0000-00-00', '', 0, 0, 0, '', '', '', '', '0', '0000-00-00', '', '0000-00-00', '', '', '0000-00-00', 0, '', '', 0, '', '', '0000-00-00', '2015-05-11', 'reklas', '1', '0000-00-00 00:00:00', '0.0000', '30', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0.0000', '0.0000', 0, NULL, NULL, NULL),
(978, 1869, 201948, '03.11.01.04.04', '11.01.01.01', '12.11.33.11.01.10.01.01', '2', '2010-06-14', '2010-06-14', 1, 1, 0, 1, 1, 2010, '800433000.0000', 'kel. Degayu', '', 'Pembelian', 1, '', '0000-00-00', '', 0, 0, 0, '', '', '', '', '0', '0000-00-00', '', '0000-00-00', '', '', '0000-00-00', 0, '', '', 0, '', '', '0000-00-00', '2015-05-11', 'reklas', '1', '2014-12-31 00:00:00', '800433000.0000', '30', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0.0000', '0.0000', 0, NULL, NULL, NULL),
(3292, 1869, 201948, '03.11.01.04.04', '11.01.01.01', '12.11.33.11.01.10.01.01', '2', '2010-06-14', '2010-06-14', 1, 1, 0, 1, 1, 2010, '800433000.0000', 'kel. Degayu', 'NULL', 'Pembelian', 1, 'NULL', '0000-00-00', 'NU', 0, 0, 0, 'NULL', 'NULL', 'NULL', 'NULL', '0', '0000-00-00', 'NULL', '0000-00-00', 'NULL', 'NULL', '0000-00-00', 0, 'NULL', 'NULL', 0, 'NULL', 'NULL', '0000-00-00', '2016-01-14', 'Penyusutan_2014_11.01.01.01', NULL, '2015-01-01 00:00:00', '800433000.0000', '49', NULL, 1, 0, '0.0000', '0.0000', '0.0000', NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, '0.0000', '0.0000', 0, NULL, NULL, NULL),
(3293, 1869, 201948, '03.11.01.04.04', '11.01.01.01', '12.11.33.11.01.10.01.01', '2', '2010-06-14', '2010-06-14', 1, 1, 0, 1, 1, 2010, '800433000.0000', 'kel. Degayu', 'NULL', 'Pembelian', 1, 'NULL', '0000-00-00', 'NU', 0, 0, 0, 'NULL', 'NULL', 'NULL', 'NULL', '0', '0000-00-00', 'NULL', '0000-00-00', 'NULL', 'NULL', '0000-00-00', 0, 'NULL', 'NULL', 0, 'NULL', 'NULL', '0000-00-00', '2016-01-14', 'Penyusutan_2014_11.01.01.01', NULL, '2015-01-01 07:07:07', '800433000.0000', '50', NULL, 1, 50, '80043300.0000', '720389700.0000', '16008660.0000', NULL, NULL, NULL, NULL, 45, 2014, NULL, NULL, NULL, '0.0000', '0.0000', 0, NULL, NULL, NULL),
(4948, 1869, 201948, '03.11.01.04.04', '11.01.01.01', '12.11.33.11.01.10.01.01', '2', '2010-06-14', '2010-06-14', 1, 1, 0, 1, 1, 2010, '1595012583.0000', 'kel. Degayu', '', 'Pembelian', 1, '', '0000-00-00', '', 0, 0, 0, '', '', '', '', '0', '0000-00-00', '', '0000-00-00', '', '', '0000-00-00', 0, '', '', 0, '', '', '0000-00-00', '2016-02-23', '3', '95', '2015-11-11 00:00:00', '800433000.0000', '2', NULL, 1, 50, '80043300.0000', '2309548866.0000', '16008660.0000', '80043300.0000', '1514969283.0000', '0.0000', NULL, 45, 2014, NULL, NULL, NULL, '0.0000', '0.0000', 0, NULL, NULL, NULL),
(28256, 1869, 201948, '03.11.01.04.04', '11.01.01.01', '12.11.33.11.01.10.01.01', '2', '2010-06-14', '2010-06-14', 1, 1, 0, 1, 1, 2010, '1595012583.0000', 'Tambak Degayu', '', 'Pembelian', 1, '', '0000-00-00', '', 0, 0, 0, '', '', '', '', '', '0000-00-00', '', '0000-00-00', '', '', '0000-00-00', 0, '', '', 0, '', 'koreksi alamat', '0000-00-00', '2016-04-29', 'koreksi', '95', '2015-12-30 00:00:00', '1595012583.0000', '18', NULL, 1, 50, '80043300.0000', '1514969283.0000', '16008660.0000', NULL, NULL, NULL, NULL, 45, 2014, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', 0, NULL, NULL, NULL),
(28579, 1869, 201948, '03.11.01.04.04', '11.01.01.01', '12.11.33.11.01.10.01.01', '2', '2010-06-14', '2010-06-14', 1, 1, 0, 1, 1, 2010, '1595012583.0000', 'Tambak Degayu', 'NULL', 'Pembelian', 1, 'NULL', '0000-00-00', 'NU', 0, 0, 0, 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', '0000-00-00', 'NULL', '0000-00-00', 'NULL', 'NULL', '0000-00-00', 0, 'NULL', 'NULL', 0, 'NULL', 'NULL', '0000-00-00', '2016-05-02', 'Penyusutan_2015_11.01.01.01', NULL, '2015-12-31 00:00:00', '1595012583.0000', '49', NULL, 1, 50, '80043300.0000', '2309548866.0000', '16008660.0000', '80043300.0000', '2309548866.0000', '16008660.0000', NULL, 45, 2014, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', 0, NULL, NULL, NULL),
(28580, 1869, 201948, '03.11.01.04.04', '11.01.01.01', '12.11.33.11.01.10.01.01', '2', '2010-06-14', '2010-06-14', 1, 1, 0, 1, 1, 2010, '1595012583.0000', 'Tambak Degayu', 'NULL', 'Pembelian', 1, 'NULL', '0000-00-00', 'NU', 0, 0, 0, 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', '0000-00-00', 'NULL', '0000-00-00', 'NULL', 'NULL', '0000-00-00', 0, 'NULL', 'NULL', 0, 'NULL', 'NULL', '0000-00-00', '2016-05-02', 'Penyusutan_2015_11.01.01.01', NULL, '2015-12-31 00:00:00', '1595012583.0000', '51', NULL, 1, 50, '126234277.0000', '1468778306.0000', '46190977.0000', '80043300.0000', '2309548866.0000', '16008660.0000', NULL, 49, 2015, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', 0, NULL, NULL, NULL),
(32573, 1869, 201948, '03.11.01.04.04', '11.01.01.01', '12.11.33.11.01.10.01.01', '2', '2010-06-14', '2010-06-14', 1, 1, 0, 1, 1, 2010, '1595012583.0000', 'Tambak Degayu', 'NULL', 'Pembelian', 1, 'NULL', '0000-00-00', 'NU', 0, 0, 0, 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', '0000-00-00', 'NULL', '0000-00-00', 'NULL', 'NULL', '0000-00-00', 0, 'NULL', 'NULL', 0, 'NULL', 'NULL', '0000-00-00', '2017-03-17', 'Penyusutan_2016_11.01.01.01', NULL, '2016-12-31 00:00:00', '1595012583.0000', '49', NULL, 1, 50, '126234277.0000', '1468778306.0000', '46190977.0000', '126234277.0000', '1468778306.0000', '46190977.0000', NULL, 49, 2015, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', 0, 'NULL', 'NULL', NULL),
(32574, 1869, 201948, '03.11.01.04.04', '11.01.01.01', '12.11.33.11.01.10.01.01', '2', '2010-06-14', '2010-06-14', 1, 1, 0, 1, 1, 2010, '1595012583.0000', 'Tambak Degayu', 'NULL', 'Pembelian', 1, 'NULL', '0000-00-00', 'NU', 0, 0, 0, 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', '0000-00-00', 'NULL', '0000-00-00', 'NULL', 'NULL', '0000-00-00', 0, 'NULL', 'NULL', 0, 'NULL', 'NULL', '0000-00-00', '2017-03-17', 'Penyusutan_2016_11.01.01.01', NULL, '2016-12-31 00:00:00', '1595012583.0000', '50', NULL, 1, 50, '158134529.0000', '1436878054.0000', '31900252.0000', '126234277.0000', '1468778306.0000', '46190977.0000', NULL, 48, 2016, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', 0, 'NULL', 'NULL', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `log_bangunan`
--
ALTER TABLE `log_bangunan`
  ADD PRIMARY KEY (`log_id`),
  ADD KEY `Aset_ID` (`Aset_ID`),
  ADD KEY `KelompokTanah_ID` (`KelompokTanah_ID`),
  ADD KEY `Tanah_ID` (`Tanah_ID`),
  ADD KEY `kodeKelompok` (`kodeKelompok`,`kodeSatker`,`kodeLokasi`),
  ADD KEY `TglPerubahan` (`TglPerubahan`),
  ADD KEY `StatusValidasi` (`StatusValidasi`),
  ADD KEY `TglPerolehan` (`TglPerolehan`),
  ADD KEY `TglPembukuan` (`TglPembukuan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `log_bangunan`
--
ALTER TABLE `log_bangunan`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35519;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
