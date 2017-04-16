-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 16, 2017 at 03:03 PM
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
-- Table structure for table `aset`
--

CREATE TABLE `aset` (
  `Aset_ID` int(11) NOT NULL,
  `kodeKelompok` varchar(150) DEFAULT NULL,
  `kodeSatker` varchar(150) DEFAULT NULL,
  `kodeLokasi` varchar(255) DEFAULT NULL,
  `noRegister` int(11) DEFAULT NULL,
  `noKontrak` varchar(150) DEFAULT NULL,
  `TglPerolehan` date NOT NULL DEFAULT '0000-00-00',
  `TglPembukuan` date NOT NULL DEFAULT '0000-00-00',
  `SumberDana` varchar(200) DEFAULT NULL,
  `NilaiPerolehan` decimal(50,4) DEFAULT NULL,
  `Alamat` text,
  `RTRW` varchar(30) DEFAULT NULL,
  `kondisi` tinyint(1) DEFAULT '1',
  `TglInventarisasi` date DEFAULT NULL,
  `BAST_ID` int(11) DEFAULT NULL,
  `BASP_ID` int(11) DEFAULT NULL,
  `Kuantitas` double DEFAULT '0',
  `Satuan` varchar(50) DEFAULT NULL,
  `Bersejarah` tinyint(1) DEFAULT '0',
  `Info` text,
  `Dihapus` tinyint(1) DEFAULT '0',
  `UserNm` varchar(30) DEFAULT NULL,
  `FixAset` tinyint(1) DEFAULT '0',
  `NotUse` tinyint(1) DEFAULT NULL,
  `Tahun` int(4) DEFAULT NULL,
  `AsalUsul` varchar(100) DEFAULT NULL,
  `Dipindah` tinyint(4) DEFAULT NULL,
  `StatusValidasi` tinyint(4) DEFAULT NULL,
  `CaraPerolehan` varchar(20) DEFAULT NULL,
  `Status_Validasi_Barang` tinyint(1) DEFAULT NULL,
  `kodeData` int(11) NOT NULL DEFAULT '0',
  `kodeKA` int(11) DEFAULT '0',
  `kodeRuangan` varchar(20) DEFAULT NULL,
  `TipeAset` varchar(5) DEFAULT NULL,
  `statusPemanfaatan` int(11) NOT NULL DEFAULT '0',
  `MasaManfaat` int(11) DEFAULT NULL,
  `AkumulasiPenyusutan` decimal(50,4) DEFAULT NULL,
  `PenyusutanPertaun` decimal(50,4) DEFAULT NULL,
  `fixPenggunaan` int(11) NOT NULL DEFAULT '0',
  `GUID` varchar(100) DEFAULT NULL,
  `NilaiBuku` decimal(50,4) DEFAULT NULL,
  `UmurEkonomis` int(11) DEFAULT NULL,
  `TahunPenyusutan` int(11) DEFAULT NULL,
  `nilai_kapitalisasi` decimal(50,4) DEFAULT NULL,
  `prosentase` decimal(50,4) DEFAULT NULL,
  `penambahan_masa_manfaat` decimal(50,4) DEFAULT NULL,
  `jenis_belanja` int(11) NOT NULL DEFAULT '0',
  `kodeKelompokReklasAsal` varchar(150) DEFAULT NULL,
  `kodeKelompokReklasTujuan` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `aset`
--

INSERT INTO `aset` (`Aset_ID`, `kodeKelompok`, `kodeSatker`, `kodeLokasi`, `noRegister`, `noKontrak`, `TglPerolehan`, `TglPembukuan`, `SumberDana`, `NilaiPerolehan`, `Alamat`, `RTRW`, `kondisi`, `TglInventarisasi`, `BAST_ID`, `BASP_ID`, `Kuantitas`, `Satuan`, `Bersejarah`, `Info`, `Dihapus`, `UserNm`, `FixAset`, `NotUse`, `Tahun`, `AsalUsul`, `Dipindah`, `StatusValidasi`, `CaraPerolehan`, `Status_Validasi_Barang`, `kodeData`, `kodeKA`, `kodeRuangan`, `TipeAset`, `statusPemanfaatan`, `MasaManfaat`, `AkumulasiPenyusutan`, `PenyusutanPertaun`, `fixPenggunaan`, `GUID`, `NilaiBuku`, `UmurEkonomis`, `TahunPenyusutan`, `nilai_kapitalisasi`, `prosentase`, `penambahan_masa_manfaat`, `jenis_belanja`, `kodeKelompokReklasAsal`, `kodeKelompokReklasTujuan`) VALUES
(1797738, '04.13.01.03.06', '05.01.01.01', '12.11.33.05.01.14.01.01', 5, '050/031/III/2014 ', '2014-03-27', '2014-12-31', NULL, '3732945200.0000', 'Jalan Akses Teknopolitan Kota Pekalongan', NULL, 1, NULL, NULL, NULL, 1, '2712166200', 0, 'Jalan Akses Teknopolitan Kota Pekalongan', 0, '329', 0, 1, 2014, 'Pembelian', NULL, 1, NULL, 1, 0, 0, '', 'D', 0, 10, '672537291.0000', '340045323.0000', 1, NULL, '3060407909.0000', 9, 2016, NULL, NULL, NULL, 0, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aset`
--
ALTER TABLE `aset`
  ADD PRIMARY KEY (`Aset_ID`),
  ADD KEY `Kelompok_ID` (`kodeKelompok`),
  ADD KEY `LastSatker_ID` (`kodeSatker`),
  ADD KEY `LastKondisi_ID` (`kondisi`),
  ADD KEY `BAST_ID` (`BAST_ID`),
  ADD KEY `BASP_ID` (`BASP_ID`),
  ADD KEY `TglPerolehan` (`TglPerolehan`),
  ADD KEY `kodeKelompok` (`kodeKelompok`),
  ADD KEY `kodeKelompok_2` (`kodeKelompok`),
  ADD KEY `kodeSatker` (`kodeSatker`),
  ADD KEY `kodeLokasi` (`kodeLokasi`),
  ADD KEY `kodeRuangan` (`kodeRuangan`),
  ADD KEY `TipeAset` (`TipeAset`),
  ADD KEY `Tahun` (`Tahun`),
  ADD KEY `StatusValidasi` (`StatusValidasi`),
  ADD KEY `Status_Validasi_Barang` (`Status_Validasi_Barang`),
  ADD KEY `noKontrak` (`noKontrak`),
  ADD KEY `TglPerolehan_2` (`TglPerolehan`),
  ADD KEY `TglPembukuan` (`TglPembukuan`),
  ADD KEY `kondisi` (`kondisi`),
  ADD KEY `kodeKA` (`kodeKA`),
  ADD KEY `fixPenggunaan` (`fixPenggunaan`),
  ADD KEY `NotUse` (`NotUse`),
  ADD KEY `kodeKelompokReklasAsal` (`kodeKelompokReklasAsal`),
  ADD KEY `kodeKelompokReklasTujuan` (`kodeKelompokReklasTujuan`),
  ADD KEY `jenis_belanja` (`jenis_belanja`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aset`
--
ALTER TABLE `aset`
  MODIFY `Aset_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7471846;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
