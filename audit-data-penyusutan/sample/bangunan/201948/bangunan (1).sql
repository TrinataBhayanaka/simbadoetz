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

--
-- Dumping data for table `bangunan`
--

INSERT INTO `bangunan` (`Bangunan_ID`, `Aset_ID`, `kodeKelompok`, `kodeSatker`, `kodeLokasi`, `noRegister`, `TglPerolehan`, `TglPembukuan`, `kodeData`, `kodeKA`, `kodeRuangan`, `StatusValidasi`, `Status_Validasi_Barang`, `StatusTampil`, `Tahun`, `NilaiPerolehan`, `Alamat`, `Info`, `AsalUsul`, `kondisi`, `CaraPerolehan`, `TglPakai`, `Konstruksi`, `Beton`, `JumlahLantai`, `LuasLantai`, `Dinding`, `Lantai`, `LangitLangit`, `Atap`, `NoSurat`, `TglSurat`, `NoIMB`, `TglIMB`, `StatusTanah`, `NoSertifikat`, `TglSertifikat`, `Tanah_ID`, `Tmp_Tingkat`, `Tmp_Beton`, `Tmp_Luas`, `KelompokTanah_ID`, `GUID`, `TglPembangunan`, `MasaManfaat`, `AkumulasiPenyusutan`, `NilaiBuku`, `PenyusutanPerTahun`, `UmurEkonomis`, `TahunPenyusutan`, `nilai_kapitalisasi`, `prosentase`, `penambahan_masa_manfaat`, `jenis_belanja`, `kodeKelompokReklasAsal`, `kodeKelompokReklasTujuan`) VALUES
(1869, 201948, '03.11.01.04.04', '11.01.01.01', '12.11.33.11.01.10.01.01', 2, '2010-06-14', '2010-06-14', 1, 1, 0, 1, 1, 1, 2010, '1595012583.0000', 'Tambak Degayu', '', 'Pembelian', 1, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, '', '0000-00-00', NULL, NULL, '', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 50, '158134529.0000', '1436878054.0000', '31900252.0000', 48, 2016, NULL, NULL, NULL, 0, NULL, NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
