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

--
-- Dumping data for table `jaringan`
--

INSERT INTO `jaringan` (`Jaringan_ID`, `Aset_ID`, `kodeKelompok`, `kodeSatker`, `kodeLokasi`, `noRegister`, `TglPerolehan`, `TglPembukuan`, `kodeData`, `kodeKA`, `kodeRuangan`, `StatusValidasi`, `Status_Validasi_Barang`, `StatusTampil`, `Tahun`, `NilaiPerolehan`, `Alamat`, `Info`, `AsalUsul`, `kondisi`, `CaraPerolehan`, `Konstruksi`, `Panjang`, `Lebar`, `NoDokumen`, `TglDokumen`, `StatusTanah`, `NoSertifikat`, `TglSertifikat`, `Tanah_ID`, `KelompokTanah_ID`, `GUID`, `TanggalPemakaian`, `LuasJaringan`, `MasaManfaat`, `AkumulasiPenyusutan`, `NilaiBuku`, `PenyusutanPerTahun`, `UmurEkonomis`, `TahunPenyusutan`, `nilai_kapitalisasi`, `prosentase`, `penambahan_masa_manfaat`, `jenis_belanja`, `kodeKelompokReklasAsal`, `kodeKelompokReklasTujuan`) VALUES
(2017, 1797738, '04.13.01.03.06', '05.01.01.01', '12.11.33.05.01.14.01.01', 5, '2014-03-27', '2014-12-31', NULL, 0, 0, 1, 1, 1, 2014, '3732945200.0000', 'Jalan Akses Teknopolitan Kota Pekalongan', 'Jalan Akses Teknopolitan Kota Pekalongan', 'Pembelian', 1, NULL, '', 0, 0, '', '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 10, '672537291.0000', '3060407909.0000', '340045323.0000', 9, 2016, NULL, NULL, NULL, 0, NULL, NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
