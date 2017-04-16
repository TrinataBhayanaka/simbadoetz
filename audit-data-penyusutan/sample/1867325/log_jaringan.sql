-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 16, 2017 at 03:37 PM
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
-- Dumping data for table `log_jaringan`
--

INSERT INTO `log_jaringan` (`log_id`, `Jaringan_ID`, `Aset_ID`, `kodeKelompok`, `kodeSatker`, `kodeLokasi`, `noRegister`, `TglPerolehan`, `TglPembukuan`, `kodeData`, `kodeKA`, `kodeRuangan`, `StatusValidasi`, `Status_Validasi_Barang`, `Tahun`, `NilaiPerolehan`, `Alamat`, `Info`, `AsalUsul`, `kondisi`, `CaraPerolehan`, `Konstruksi`, `Panjang`, `Lebar`, `NoDokumen`, `TglDokumen`, `StatusTanah`, `NoSertifikat`, `TglSertifikat`, `Tanah_ID`, `KelompokTanah_ID`, `GUID`, `TanggalPemakaian`, `LuasJaringan`, `changeDate`, `action`, `operator`, `TglPerubahan`, `NilaiPerolehan_Awal`, `Kd_Riwayat`, `No_Dokumen`, `StatusTampil`, `MasaManfaat`, `AkumulasiPenyusutan`, `NilaiBuku`, `PenyusutanPerTahun`, `AkumulasiPenyusutan_Awal`, `NilaiBuku_Awal`, `PenyusutanPerTahun_Awal`, `Aset_ID_Penambahan`, `UmurEkonomis`, `TahunPenyusutan`, `nilai_kapitalisasi`, `prosentase`, `penambahan_masa_manfaat`, `mutasi_ak_tambah`, `mutasi_ak_kurang`, `jenis_belanja`, `kodeKelompokReklasAsal`, `kodeKelompokReklasTujuan`, `jenis_hapus`) VALUES
(201, 2074, 1867325, '04.13.01.03.06', '05.01.01.01', '12.11.33.05.01.14.01.01', '18', '2014-03-03', '0000-00-00', 0, 0, 0, 1, 0, 2014, '72374268.0000', 'Jl. Dr. Wahidin Sisi Timur (Lanjutan) ', 'Rehabilitasi/pemeliharaan trotoir;Rehab Trotoar Jl. Dr. Wahidin Sisi Timur (Lanjutan) ', 'Pembelian', 1, '', '', 0, 0, '', '0000-00-00', '', '', '0000-00-00', 0, '', '', '0000-00-00', 0, '2015-03-02', 'posting', '329', '2014-03-03 00:00:00', '72374268.0000', '0', NULL, 1, NULL, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, NULL, NULL, NULL, NULL, '0.0000', '0.0000', 0, NULL, NULL, NULL),
(63386, 2074, 1867325, '04.13.01.03.06', '05.01.01.01', '12.11.33.05.01.14.01.01', '18', '2014-03-03', '2014-12-31', 0, 0, 0, 1, 1, 2014, '72374268.0000', 'Jl. Dr. Wahidin Sisi Timur (Lanjutan) ', 'Rehabilitasi/pemeliharaan trotoir;Rehab Trotoar Jl. Dr. Wahidin Sisi Timur (Lanjutan) ', 'Pembelian', 1, 'NULL', 'NULL', 0, 0, 'NULL', '0000-00-00', 'NULL', 'NULL', '0000-00-00', 0, 'NULL', 'NULL', '0000-00-00', 0, '2016-01-04', 'Penyusutan_2014_05.01.01.01', NULL, '2015-01-01 00:00:00', '72374268.0000', '49', NULL, 1, 0, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, 0, 0, NULL, NULL, NULL, '0.0000', '0.0000', 0, NULL, NULL, NULL),
(63387, 2074, 1867325, '04.13.01.03.06', '05.01.01.01', '12.11.33.05.01.14.01.01', '18', '2014-03-03', '2014-12-31', 0, 0, 0, 1, 1, 2014, '72374268.0000', 'Jl. Dr. Wahidin Sisi Timur (Lanjutan) ', 'Rehabilitasi/pemeliharaan trotoir;Rehab Trotoar Jl. Dr. Wahidin Sisi Timur (Lanjutan) ', 'Pembelian', 1, 'NULL', 'NULL', 0, 0, 'NULL', '0000-00-00', 'NULL', 'NULL', '0000-00-00', 0, 'NULL', 'NULL', '0000-00-00', 0, '2016-01-04', 'Penyusutan_2014_05.01.01.01', NULL, '2015-01-01 07:07:07', '72374268.0000', '50', NULL, 1, 10, '7237427.0000', '65136841.0000', '7237427.0000', '0.0000', '0.0000', '0.0000', NULL, 9, 2014, NULL, NULL, NULL, '0.0000', '0.0000', 0, NULL, NULL, NULL),
(64600, 2074, 1867325, '04.13.01.03.06', '05.01.01.01', '12.11.33.05.01.14.01.01', '18', '2014-03-03', '2014-12-31', 0, 0, 0, 1, 1, 2014, '2063148268.0000', 'Jl. Dr. Wahidin Sisi Timur (Lanjutan) ', 'Rehabilitasi/pemeliharaan trotoir;Rehab Trotoar Jl. Dr. Wahidin Sisi Timur (Lanjutan) ', 'Pembelian', 1, '', '', 0, 0, '', '0000-00-00', '', '', '0000-00-00', 0, '', '', '0000-00-00', 0, '2016-02-09', '3', '329', '2015-05-07 00:00:00', '72374268.0000', '2', NULL, 1, 10, '7237427.0000', '4046684841.0000', '7237427.0000', '7237427.0000', '2055910841.0000', '0.0000', NULL, 9, 2014, NULL, NULL, NULL, '0.0000', '0.0000', 0, NULL, NULL, NULL),
(103308, 2074, 1867325, '04.13.01.03.06', '05.01.01.01', '12.11.33.05.01.14.01.01', '18', '2014-03-03', '2014-12-31', 0, 0, 0, 1, 1, 2014, '2063148268.0000', 'Jl. Dr. Wahidin Sisi Timur (Lanjutan) ', 'Rehabilitasi/pemeliharaan trotoir;Rehab Trotoar Jl. Dr. Wahidin Sisi Timur (Lanjutan) ', 'Pembelian', 1, 'NULL', 'NULL', 0, 0, 'NULL', '0000-00-00', 'NULL', 'NULL', '0000-00-00', 0, 'NULL', 'NULL', '0000-00-00', 0, '2016-05-18', 'Penyusutan_2015_05.01.01.01', NULL, '2015-12-31 00:00:00', '2063148268.0000', '49', NULL, 1, 10, '7237427.0000', '4046684841.0000', '7237427.0000', '7237427.0000', '4046684841.0000', '7237427.0000', NULL, 9, 2014, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', 0, NULL, NULL, NULL),
(103309, 2074, 1867325, '04.13.01.03.06', '05.01.01.01', '12.11.33.05.01.14.01.01', '18', '2014-03-03', '2014-12-31', 0, 0, 0, 1, 1, 2014, '2063148268.0000', 'Jl. Dr. Wahidin Sisi Timur (Lanjutan) ', 'Rehabilitasi/pemeliharaan trotoir;Rehab Trotoar Jl. Dr. Wahidin Sisi Timur (Lanjutan) ', 'Pembelian', 1, 'NULL', 'NULL', 0, 0, 'NULL', '0000-00-00', 'NULL', 'NULL', '0000-00-00', 0, 'NULL', 'NULL', '0000-00-00', 0, '2016-05-18', 'Penyusutan_2015_05.01.01.01', NULL, '2015-12-31 00:00:00', '2063148268.0000', '51', NULL, 1, 10, '411905911.0000', '1651242357.0000', '404668484.0000', '7237427.0000', '4046684841.0000', '7237427.0000', NULL, 9, 2015, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', 0, NULL, NULL, NULL),
(114212, 2074, 1867325, '04.13.01.03.06', '05.01.01.01', '12.11.33.05.01.14.01.01', '18', '2014-03-03', '2014-12-31', 0, 0, 0, 1, 1, 2014, '2063148268.0000', 'Jl. Dr. Wahidin Sisi Timur (Lanjutan) ', 'Rehabilitasi/pemeliharaan trotoir;Rehab Trotoar Jl. Dr. Wahidin Sisi Timur (Lanjutan) ', 'Pembelian', 1, 'NULL', 'NULL', 0, 0, 'NULL', '0000-00-00', 'NULL', 'NULL', '0000-00-00', 0, 'NULL', 'NULL', '0000-00-00', 0, '2017-03-12', 'Penyusutan_2016_05.01.01.01', NULL, '2016-12-31 00:00:00', '2063148268.0000', '49', NULL, 1, 10, '411905911.0000', '1651242357.0000', '404668484.0000', '411905911.0000', '1651242357.0000', '404668484.0000', NULL, 9, 2015, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', 0, 'NULL', 'NULL', NULL),
(114213, 2074, 1867325, '04.13.01.03.06', '05.01.01.01', '12.11.33.05.01.14.01.01', '18', '2014-03-03', '2014-12-31', 0, 0, 0, 1, 1, 2014, '2063148268.0000', 'Jl. Dr. Wahidin Sisi Timur (Lanjutan) ', 'Rehabilitasi/pemeliharaan trotoir;Rehab Trotoar Jl. Dr. Wahidin Sisi Timur (Lanjutan) ', 'Pembelian', 1, 'NULL', 'NULL', 0, 0, 'NULL', '0000-00-00', 'NULL', 'NULL', '0000-00-00', 0, 'NULL', 'NULL', '0000-00-00', 0, '2017-03-12', 'Penyusutan_2016_05.01.01.01', NULL, '2016-12-31 00:00:00', '2063148268.0000', '50', NULL, 1, 10, '618220738.0000', '1444927530.0000', '206314827.0000', '411905911.0000', '1651242357.0000', '404668484.0000', NULL, 8, 2016, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', 0, 'NULL', 'NULL', NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
