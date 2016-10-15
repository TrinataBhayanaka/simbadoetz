-- phpMyAdmin SQL Dump
-- version 4.4.15
-- http://www.phpmyadmin.net
--
-- Host: 192.168.254.52
-- Generation Time: Mar 03, 2016 at 03:38 AM
-- Server version: 10.0.21-MariaDB-log
-- PHP Version: 5.5.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `simbada_2014_full_v1`
--

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_cek_usulan`
--
CREATE TABLE IF NOT EXISTS `view_cek_usulan` (
`Aset_ID` int(11)
,`kodeKelompok` varchar(150)
,`kodeSatker` varchar(150)
,`kodeLokasi` varchar(255)
,`noRegister` int(11)
,`noKontrak` varchar(150)
,`TglPerolehan` date
,`TglPembukuan` date
,`SumberDana` varchar(200)
,`NilaiPerolehan` decimal(50,4)
,`Alamat` text
,`RTRW` varchar(30)
,`kondisi` tinyint(1)
,`TglInventarisasi` date
,`BAST_ID` int(11)
,`BASP_ID` int(11)
,`Kuantitas` double
,`Satuan` varchar(50)
,`Bersejarah` tinyint(1)
,`Info` text
,`Dihapus` tinyint(1)
,`UserNm` varchar(30)
,`FixAset` tinyint(1)
,`NotUse` tinyint(1)
,`Tahun` int(4)
,`AsalUsul` varchar(100)
,`Dipindah` tinyint(4)
,`CaraPerolehan` varchar(20)
,`Status_Validasi_Barang` tinyint(1)
,`kodeData` int(11)
,`kodeKA` int(11)
,`kodeRuangan` varchar(20)
,`TipeAset` varchar(5)
,`statusPemanfaatan` int(11)
,`MasaManfaat` int(11)
,`AkumulasiPenyusutan` decimal(50,4)
,`PenyusutanPerTaun` decimal(50,4)
,`fixPenggunaan` int(11)
,`Usulan_ID` int(11)
,`Penetapan_ID` int(11)
,`Jenis_Usulan` varchar(11)
,`StatusPenetapan` tinyint(1)
,`StatusValidasi` tinyint(4)
,`StatusKonfirmasi` tinyint(4)
,`NilaiPerolehanTmp` decimal(50,4)
,`kondisiTmp` tinyint(4)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_hapus_aset`
--
CREATE TABLE IF NOT EXISTS `view_hapus_aset` (
`Aset_ID` int(11)
,`kodeKelompok` varchar(150)
,`kodeSatker` varchar(150)
,`kodeLokasi` varchar(255)
,`noRegister` int(11)
,`noKontrak` varchar(150)
,`TglPerolehan` date
,`TglPembukuan` date
,`SumberDana` varchar(200)
,`NilaiPerolehan` decimal(50,4)
,`Alamat` text
,`RTRW` varchar(30)
,`kondisi` tinyint(1)
,`TglInventarisasi` date
,`BAST_ID` int(11)
,`BASP_ID` int(11)
,`Kuantitas` double
,`Satuan` varchar(50)
,`Bersejarah` tinyint(1)
,`Info` text
,`Dihapus` tinyint(1)
,`UserNm` varchar(30)
,`FixAset` tinyint(1)
,`NotUse` tinyint(1)
,`Tahun` int(4)
,`AsalUsul` varchar(100)
,`Dipindah` tinyint(4)
,`StatusValidasi` tinyint(4)
,`CaraPerolehan` varchar(20)
,`Status_Validasi_Barang` tinyint(1)
,`kodeData` int(11)
,`kodeKA` int(11)
,`kodeRuangan` varchar(20)
,`TipeAset` varchar(5)
,`statusPemanfaatan` int(11)
,`MasaManfaat` int(11)
,`AkumulasiPenyusutan` decimal(50,4)
,`PenyusutanPerTaun` decimal(50,4)
,`fixPenggunaan` int(11)
,`NoSKHapus` varchar(50)
,`TglHapus` date
,`Status` tinyint(4)
,`Jenis_Hapus` varchar(3)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_hapus_asetlain`
--
CREATE TABLE IF NOT EXISTS `view_hapus_asetlain` (
`NoSKHapus` varchar(50)
,`TglHapus` date
,`Status` tinyint(4)
,`Jenis_Hapus` varchar(3)
,`AsetLain_ID` int(11)
,`Aset_ID` int(11)
,`kodeKelompok` varchar(255)
,`kodeSatker` varchar(255)
,`kodeLokasi` varchar(255)
,`noRegister` int(11)
,`TglPerolehan` date
,`TglPembukuan` date
,`kodeData` int(11)
,`kodeKA` int(11)
,`kodeRuangan` int(11)
,`StatusValidasi` tinyint(4)
,`Status_Validasi_Barang` tinyint(4)
,`StatusTampil` tinyint(4)
,`Tahun` int(11)
,`Alamat` text
,`Info` text
,`AsalUsul` varchar(100)
,`kondisi` tinyint(1)
,`CaraPerolehan` varchar(20)
,`Judul` text
,`AsalDaerah` varchar(50)
,`Pengarang` varchar(100)
,`Penerbit` varchar(50)
,`Spesifikasi` varchar(200)
,`TahunTerbit` int(11)
,`ISBN` varchar(50)
,`Material` varchar(50)
,`Ukuran` varchar(20)
,`GUID` varchar(100)
,`MasaManfaat` int(11)
,`AkumulasiPenyusutan` decimal(50,0)
,`NilaiBuku` decimal(50,0)
,`PenyusutanPerTahun` decimal(50,0)
,`NilaiPerolehan` decimal(50,4)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_hapus_bangunan`
--
CREATE TABLE IF NOT EXISTS `view_hapus_bangunan` (
`NoSKHapus` varchar(50)
,`TglHapus` date
,`Status` tinyint(4)
,`Jenis_Hapus` varchar(3)
,`Bangunan_ID` int(11)
,`Aset_ID` int(11)
,`kodeKelompok` varchar(255)
,`kodeSatker` varchar(255)
,`kodeLokasi` varchar(255)
,`noRegister` int(11)
,`TglPerolehan` date
,`TglPembukuan` date
,`kodeData` int(11)
,`kodeKA` int(11)
,`kodeRuangan` int(11)
,`StatusValidasi` tinyint(4)
,`Status_Validasi_Barang` tinyint(4)
,`StatusTampil` tinyint(4)
,`Tahun` int(11)
,`Alamat` text
,`Info` text
,`AsalUsul` varchar(100)
,`kondisi` tinyint(1)
,`CaraPerolehan` varchar(20)
,`TglPakai` date
,`Konstruksi` varchar(2)
,`Beton` tinyint(1)
,`JumlahLantai` int(11)
,`LuasLantai` double
,`Dinding` varchar(100)
,`Lantai` varchar(100)
,`LangitLangit` varchar(100)
,`Atap` varchar(100)
,`NoSurat` varchar(50)
,`TglSurat` date
,`NoIMB` varchar(50)
,`TglIMB` date
,`StatusTanah` varchar(20)
,`NoSertifikat` varchar(50)
,`TglSertifikat` date
,`Tanah_ID` int(11)
,`Tmp_Tingkat` varchar(50)
,`Tmp_Beton` varchar(50)
,`Tmp_Luas` double
,`KelompokTanah_ID` varchar(20)
,`GUID` varchar(100)
,`TglPembangunan` date
,`MasaManfaat` int(11)
,`AkumulasiPenyusutan` decimal(50,4)
,`NilaiBuku` decimal(50,4)
,`PenyusutanPerTahun` decimal(50,4)
,`NilaiPerolehan` decimal(50,4)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_hapus_jaringan`
--
CREATE TABLE IF NOT EXISTS `view_hapus_jaringan` (
`NoSKHapus` varchar(50)
,`TglHapus` date
,`Status` tinyint(4)
,`Jenis_Hapus` varchar(3)
,`Jaringan_ID` int(11)
,`Aset_ID` int(11)
,`kodeKelompok` varchar(255)
,`kodeSatker` varchar(255)
,`kodeLokasi` varchar(255)
,`noRegister` int(11)
,`TglPerolehan` date
,`TglPembukuan` date
,`kodeData` int(11)
,`kodeKA` int(11)
,`kodeRuangan` int(11)
,`StatusValidasi` tinyint(4)
,`Status_Validasi_Barang` tinyint(4)
,`StatusTampil` tinyint(4)
,`Tahun` int(11)
,`Alamat` text
,`Info` text
,`AsalUsul` varchar(100)
,`kondisi` tinyint(1)
,`CaraPerolehan` varchar(20)
,`Konstruksi` varchar(50)
,`Panjang` int(11)
,`Lebar` int(11)
,`NoDokumen` varchar(50)
,`TglDokumen` date
,`StatusTanah` varchar(50)
,`NoSertifikat` varchar(200)
,`TglSertifikat` date
,`Tanah_ID` int(11)
,`KelompokTanah_ID` varchar(20)
,`GUID` varchar(100)
,`TanggalPemakaian` date
,`LuasJaringan` int(11)
,`MasaManfaat` int(11)
,`AkumulasiPenyusutan` decimal(50,4)
,`NilaiBuku` decimal(50,4)
,`PenyusutanPerTahun` decimal(50,4)
,`NilaiPerolehan` decimal(50,4)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_hapus_kdp`
--
CREATE TABLE IF NOT EXISTS `view_hapus_kdp` (
`NoSKHapus` varchar(50)
,`TglHapus` date
,`Status` tinyint(4)
,`Jenis_Hapus` varchar(3)
,`KDP_ID` int(11)
,`Aset_ID` int(11)
,`kodeKelompok` varchar(255)
,`kodeSatker` varchar(255)
,`kodeLokasi` varchar(255)
,`noRegister` int(11)
,`TglPerolehan` date
,`TglPembukuan` date
,`kodeData` int(11)
,`kodeKA` int(11)
,`kodeRuangan` int(11)
,`StatusValidasi` tinyint(4)
,`Status_Validasi_Barang` tinyint(4)
,`StatusTampil` tinyint(4)
,`Tahun` int(11)
,`Alamat` text
,`Info` text
,`AsalUsul` varchar(100)
,`kondisi` tinyint(1)
,`CaraPerolehan` varchar(20)
,`Konstruksi` varchar(2)
,`Beton` tinyint(1)
,`JumlahLantai` int(11)
,`LuasLantai` double
,`TglMulai` date
,`StatusTanah` varchar(2)
,`NoSertifikat` varchar(30)
,`TglSertifikat` date
,`Tanah_ID` int(11)
,`KelompokTanah_ID` int(11)
,`GUID` varchar(100)
,`NilaiPerolehan` decimal(50,4)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_hapus_mesin`
--
CREATE TABLE IF NOT EXISTS `view_hapus_mesin` (
`NoSKHapus` varchar(50)
,`TglHapus` date
,`Status` tinyint(4)
,`Jenis_Hapus` varchar(3)
,`Mesin_ID` int(11)
,`Aset_ID` int(11)
,`kodeKelompok` varchar(255)
,`kodeSatker` varchar(255)
,`kodeLokasi` varchar(255)
,`noRegister` int(11)
,`TglPerolehan` date
,`TglPembukuan` date
,`kodeData` int(11)
,`kodeKA` int(11)
,`kodeRuangan` int(11)
,`StatusValidasi` tinyint(4)
,`Status_Validasi_Barang` tinyint(4)
,`StatusTampil` tinyint(4)
,`Tahun` int(11)
,`Alamat` text
,`Info` text
,`AsalUsul` varchar(100)
,`kondisi` tinyint(1)
,`CaraPerolehan` varchar(20)
,`Merk` varchar(100)
,`Model` varchar(100)
,`Ukuran` varchar(50)
,`Silinder` varchar(50)
,`MerkMesin` varchar(50)
,`JumlahMesin` int(11)
,`Material` varchar(100)
,`NoSeri` varchar(25)
,`NoRangka` varchar(100)
,`NoMesin` varchar(100)
,`NoSTNK` varchar(50)
,`TglSTNK` date
,`NoBPKB` varchar(50)
,`TglBPKB` date
,`NoDokumen` varchar(50)
,`TglDokumen` date
,`Pabrik` varchar(50)
,`TahunBuat` int(11)
,`BahanBakar` varchar(20)
,`NegaraAsal` varchar(20)
,`NegaraRakit` varchar(20)
,`Kapasitas` int(11)
,`Bobot` int(11)
,`GUID` varchar(100)
,`MasaManfaat` int(11)
,`AkumulasiPenyusutan` decimal(50,4)
,`NilaiBuku` decimal(50,4)
,`PenyusutanPerTahun` decimal(50,4)
,`NilaiPerolehan` decimal(50,4)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_hapus_tanah`
--
CREATE TABLE IF NOT EXISTS `view_hapus_tanah` (
`NoSKHapus` varchar(50)
,`TglHapus` date
,`Status` tinyint(4)
,`Jenis_Hapus` varchar(3)
,`Tanah_ID` int(11)
,`Aset_ID` int(11)
,`kodeKelompok` varchar(255)
,`kodeSatker` varchar(255)
,`kodeLokasi` varchar(255)
,`noRegister` int(11)
,`TglPerolehan` date
,`TglPembukuan` date
,`kodeData` int(11)
,`kodeKA` int(11)
,`kodeRuangan` int(11)
,`StatusValidasi` tinyint(4)
,`Status_Validasi_Barang` tinyint(4)
,`StatusTampil` tinyint(4)
,`Tahun` int(11)
,`Alamat` text
,`Info` text
,`AsalUsul` varchar(100)
,`kondisi` tinyint(1)
,`CaraPerolehan` varchar(20)
,`LuasTotal` double
,`LuasBangunan` double
,`LuasSekitar` double
,`LuasKosong` double
,`HakTanah` varchar(20)
,`NoSertifikat` varchar(50)
,`TglSertifikat` date
,`Penggunaan` text
,`BatasUtara` varchar(100)
,`BatasSelatan` varchar(100)
,`BatasBarat` varchar(100)
,`BatasTimur` varchar(100)
,`Tmp_Hak` varchar(100)
,`GUID` varchar(100)
,`MasaManfaat` int(11)
,`AkumulasiPenyusutan` decimal(50,0)
,`PenyusutanPerTahun` decimal(50,0)
,`NilaiPerolehan` decimal(50,4)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_mutasi_aset`
--
CREATE TABLE IF NOT EXISTS `view_mutasi_aset` (
`Mutasi_ID` int(11)
,`Aset_ID` int(11)
,`SatkerAwal` varchar(100)
,`SatkerTujuan` varchar(100)
,`Aset_ID_Tujuan` int(11)
,`Status` int(11)
,`NoSKKDH` varchar(30)
,`TglSKKDH` date
,`NomorRegAwal` varchar(100)
,`NomorRegbaru` varchar(100)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_mutasi_aset2`
--
CREATE TABLE IF NOT EXISTS `view_mutasi_aset2` (
`Mutasi_ID` int(11)
,`Aset_ID` int(11)
,`SatkerAwal` varchar(100)
,`SatkerTujuan` varchar(100)
,`Aset_ID_Tujuan` int(11)
,`Status` int(11)
,`NoSKKDH` varchar(30)
,`TglSKKDH` date
,`NomorRegAwal` varchar(100)
,`NomorRegbaru` varchar(100)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_mutasi_asetlain`
--
CREATE TABLE IF NOT EXISTS `view_mutasi_asetlain` (
`AsetLain_ID` int(11)
,`Aset_ID` int(11)
,`kodeKelompok` varchar(255)
,`kodeSatker` varchar(255)
,`kodeLokasi` varchar(255)
,`noRegister` int(11)
,`TglPerolehan` date
,`TglPembukuan` date
,`kodeData` int(11)
,`kodeKA` int(11)
,`kodeRuangan` int(11)
,`StatusValidasi` int(1)
,`Status_Validasi_Barang` int(1)
,`StatusTampil` int(1)
,`Tahun` int(11)
,`NilaiPerolehan` decimal(50,4)
,`Alamat` text
,`Info` text
,`AsalUsul` varchar(100)
,`kondisi` tinyint(1)
,`CaraPerolehan` varchar(20)
,`Judul` text
,`AsalDaerah` varchar(50)
,`Pengarang` varchar(100)
,`Penerbit` varchar(50)
,`Spesifikasi` varchar(200)
,`TahunTerbit` int(11)
,`ISBN` varchar(50)
,`Material` varchar(50)
,`Ukuran` varchar(20)
,`GUID` varchar(100)
,`MasaManfaat` int(11)
,`AkumulasiPenyusutan` decimal(50,0)
,`NilaiBuku` decimal(50,0)
,`PenyusutanPerTahun` decimal(50,0)
,`Mutasi_ID` int(11)
,`SatkerAwal` varchar(100)
,`SatkerTujuan` varchar(100)
,`Aset_ID_Tujuan` int(11)
,`Status` int(11)
,`NoSKKDH` varchar(30)
,`TglSKKDH` date
,`NomorRegAwal` varchar(100)
,`NomorRegbaru` varchar(100)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_mutasi_aset_full`
--
CREATE TABLE IF NOT EXISTS `view_mutasi_aset_full` (
`Aset_ID` int(11)
,`kodeKelompok` varchar(150)
,`kodeSatker` varchar(150)
,`kodeLokasi` varchar(255)
,`noRegister` int(11)
,`noKontrak` varchar(150)
,`TglPerolehan` date
,`TglPembukuan` date
,`SumberDana` varchar(200)
,`NilaiPerolehan` decimal(50,4)
,`Alamat` text
,`RTRW` varchar(30)
,`kondisi` tinyint(1)
,`TglInventarisasi` date
,`BAST_ID` int(11)
,`BASP_ID` int(11)
,`Kuantitas` double
,`Satuan` varchar(50)
,`Bersejarah` tinyint(1)
,`Info` text
,`Dihapus` tinyint(1)
,`UserNm` varchar(30)
,`FixAset` tinyint(1)
,`NotUse` tinyint(1)
,`Tahun` int(4)
,`AsalUsul` varchar(100)
,`Dipindah` tinyint(4)
,`StatusValidasi` tinyint(4)
,`CaraPerolehan` varchar(20)
,`Status_Validasi_Barang` tinyint(1)
,`kodeData` int(11)
,`kodeKA` int(11)
,`kodeRuangan` varchar(20)
,`TipeAset` varchar(5)
,`statusPemanfaatan` int(11)
,`MasaManfaat` int(11)
,`AkumulasiPenyusutan` decimal(50,4)
,`PenyusutanPerTaun` decimal(50,4)
,`fixPenggunaan` int(11)
,`Mutasi_ID` int(11)
,`SatkerAwal` varchar(100)
,`SatkerTujuan` varchar(100)
,`Aset_ID_Tujuan` int(11)
,`Status` int(11)
,`NoSKKDH` varchar(30)
,`TglSKKDH` date
,`NomorRegAwal` varchar(100)
,`NomorRegbaru` varchar(100)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_mutasi_bangunan`
--
CREATE TABLE IF NOT EXISTS `view_mutasi_bangunan` (
`Bangunan_ID` int(11)
,`Aset_ID` int(11)
,`kodeKelompok` varchar(255)
,`kodeSatker` varchar(255)
,`kodeLokasi` varchar(255)
,`noRegister` int(11)
,`TglPerolehan` date
,`TglPembukuan` date
,`kodeData` int(11)
,`kodeKA` int(11)
,`kodeRuangan` int(11)
,`StatusValidasi` int(1)
,`Status_Validasi_Barang` int(1)
,`StatusTampil` int(1)
,`Tahun` int(11)
,`NilaiPerolehan` decimal(50,4)
,`Alamat` text
,`Info` text
,`AsalUsul` varchar(100)
,`kondisi` tinyint(1)
,`CaraPerolehan` varchar(20)
,`TglPakai` date
,`Konstruksi` varchar(2)
,`Beton` tinyint(1)
,`JumlahLantai` int(11)
,`LuasLantai` double
,`Dinding` varchar(100)
,`Lantai` varchar(100)
,`LangitLangit` varchar(100)
,`Atap` varchar(100)
,`NoSurat` varchar(50)
,`TglSurat` date
,`NoIMB` varchar(50)
,`TglIMB` date
,`StatusTanah` varchar(20)
,`NoSertifikat` varchar(50)
,`TglSertifikat` date
,`Tanah_ID` int(11)
,`Tmp_Tingkat` varchar(50)
,`Tmp_Beton` varchar(50)
,`Tmp_Luas` double
,`KelompokTanah_ID` varchar(20)
,`GUID` varchar(100)
,`TglPembangunan` date
,`MasaManfaat` int(11)
,`AkumulasiPenyusutan` decimal(50,4)
,`NilaiBuku` decimal(50,4)
,`PenyusutanPerTahun` decimal(50,4)
,`Mutasi_ID` int(11)
,`SatkerAwal` varchar(100)
,`SatkerTujuan` varchar(100)
,`Aset_ID_Tujuan` int(11)
,`Status` int(11)
,`NoSKKDH` varchar(30)
,`TglSKKDH` date
,`NomorRegAwal` varchar(100)
,`NomorRegbaru` varchar(100)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_mutasi_jaringan`
--
CREATE TABLE IF NOT EXISTS `view_mutasi_jaringan` (
`Jaringan_ID` int(11)
,`Aset_ID` int(11)
,`kodeKelompok` varchar(255)
,`kodeSatker` varchar(255)
,`kodeLokasi` varchar(255)
,`noRegister` int(11)
,`TglPerolehan` date
,`TglPembukuan` date
,`kodeData` int(11)
,`kodeKA` int(11)
,`kodeRuangan` int(11)
,`StatusValidasi` int(1)
,`Status_Validasi_Barang` int(1)
,`StatusTampil` int(1)
,`Tahun` int(11)
,`NilaiPerolehan` decimal(50,4)
,`Alamat` text
,`Info` text
,`AsalUsul` varchar(100)
,`kondisi` tinyint(1)
,`CaraPerolehan` varchar(20)
,`Konstruksi` varchar(50)
,`Panjang` int(11)
,`Lebar` int(11)
,`NoDokumen` varchar(50)
,`TglDokumen` date
,`StatusTanah` varchar(50)
,`NoSertifikat` varchar(200)
,`TglSertifikat` date
,`Tanah_ID` int(11)
,`KelompokTanah_ID` varchar(20)
,`GUID` varchar(100)
,`TanggalPemakaian` date
,`LuasJaringan` int(11)
,`MasaManfaat` int(11)
,`AkumulasiPenyusutan` decimal(50,4)
,`NilaiBuku` decimal(50,4)
,`PenyusutanPerTahun` decimal(50,4)
,`Mutasi_ID` int(11)
,`SatkerAwal` varchar(100)
,`SatkerTujuan` varchar(100)
,`Aset_ID_Tujuan` int(11)
,`Status` int(11)
,`NoSKKDH` varchar(30)
,`TglSKKDH` date
,`NomorRegAwal` varchar(100)
,`NomorRegbaru` varchar(100)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_mutasi_kdp`
--
CREATE TABLE IF NOT EXISTS `view_mutasi_kdp` (
`KDP_ID` int(11)
,`Aset_ID` int(11)
,`kodeKelompok` varchar(255)
,`kodeSatker` varchar(255)
,`kodeLokasi` varchar(255)
,`noRegister` int(11)
,`TglPerolehan` date
,`TglPembukuan` date
,`kodeData` int(11)
,`kodeKA` int(11)
,`kodeRuangan` int(11)
,`StatusValidasi` int(1)
,`Status_Validasi_Barang` int(1)
,`StatusTampil` int(1)
,`Tahun` int(11)
,`NilaiPerolehan` decimal(50,4)
,`Alamat` text
,`Info` text
,`AsalUsul` varchar(100)
,`kondisi` tinyint(1)
,`CaraPerolehan` varchar(20)
,`Konstruksi` varchar(2)
,`Beton` tinyint(1)
,`JumlahLantai` int(11)
,`LuasLantai` double
,`TglMulai` date
,`StatusTanah` varchar(2)
,`NoSertifikat` varchar(30)
,`TglSertifikat` date
,`Tanah_ID` int(11)
,`KelompokTanah_ID` int(11)
,`GUID` varchar(100)
,`Mutasi_ID` int(11)
,`SatkerAwal` varchar(100)
,`SatkerTujuan` varchar(100)
,`Aset_ID_Tujuan` int(11)
,`Status` int(11)
,`NoSKKDH` varchar(30)
,`TglSKKDH` date
,`NomorRegAwal` varchar(100)
,`NomorRegbaru` varchar(100)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_mutasi_mesin`
--
CREATE TABLE IF NOT EXISTS `view_mutasi_mesin` (
`Mesin_ID` int(11)
,`Aset_ID` int(11)
,`kodeKelompok` varchar(255)
,`kodeSatker` varchar(255)
,`kodeLokasi` varchar(255)
,`noRegister` int(11)
,`TglPerolehan` date
,`TglPembukuan` date
,`kodeData` int(11)
,`kodeKA` int(11)
,`kodeRuangan` int(11)
,`StatusValidasi` int(1)
,`Status_Validasi_Barang` int(1)
,`StatusTampil` int(1)
,`Tahun` int(11)
,`NilaiPerolehan` decimal(50,4)
,`Alamat` text
,`Info` text
,`AsalUsul` varchar(100)
,`kondisi` tinyint(1)
,`CaraPerolehan` varchar(20)
,`Merk` varchar(100)
,`Model` varchar(100)
,`Ukuran` varchar(50)
,`Silinder` varchar(50)
,`MerkMesin` varchar(50)
,`JumlahMesin` int(11)
,`Material` varchar(100)
,`NoSeri` varchar(25)
,`NoRangka` varchar(100)
,`NoMesin` varchar(100)
,`NoSTNK` varchar(50)
,`TglSTNK` date
,`NoBPKB` varchar(50)
,`TglBPKB` date
,`NoDokumen` varchar(50)
,`TglDokumen` date
,`Pabrik` varchar(50)
,`TahunBuat` int(11)
,`BahanBakar` varchar(20)
,`NegaraAsal` varchar(20)
,`NegaraRakit` varchar(20)
,`Kapasitas` int(11)
,`Bobot` int(11)
,`GUID` varchar(100)
,`MasaManfaat` int(11)
,`AkumulasiPenyusutan` decimal(50,4)
,`NilaiBuku` decimal(50,4)
,`PenyusutanPerTahun` decimal(50,4)
,`Mutasi_ID` int(11)
,`SatkerAwal` varchar(100)
,`SatkerTujuan` varchar(100)
,`Aset_ID_Tujuan` int(11)
,`Status` int(11)
,`NoSKKDH` varchar(30)
,`TglSKKDH` date
,`NomorRegAwal` varchar(100)
,`NomorRegbaru` varchar(100)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_mutasi_tanah`
--
CREATE TABLE IF NOT EXISTS `view_mutasi_tanah` (
`Tanah_ID` int(11)
,`Aset_ID` int(11)
,`kodeKelompok` varchar(255)
,`kodeSatker` varchar(255)
,`kodeLokasi` varchar(255)
,`noRegister` int(11)
,`TglPerolehan` date
,`TglPembukuan` date
,`kodeData` int(11)
,`kodeKA` int(11)
,`kodeRuangan` int(11)
,`StatusValidasi` int(1)
,`Status_Validasi_Barang` int(1)
,`StatusTampil` int(1)
,`Tahun` int(11)
,`NilaiPerolehan` decimal(50,4)
,`Alamat` text
,`Info` text
,`AsalUsul` varchar(100)
,`kondisi` tinyint(1)
,`CaraPerolehan` varchar(20)
,`LuasTotal` double
,`LuasBangunan` double
,`LuasSekitar` double
,`LuasKosong` double
,`HakTanah` varchar(20)
,`NoSertifikat` varchar(50)
,`TglSertifikat` date
,`Penggunaan` text
,`BatasUtara` varchar(100)
,`BatasSelatan` varchar(100)
,`BatasBarat` varchar(100)
,`BatasTimur` varchar(100)
,`Tmp_Hak` varchar(100)
,`GUID` varchar(100)
,`MasaManfaat` int(11)
,`AkumulasiPenyusutan` decimal(50,0)
,`PenyusutanPerTahun` decimal(50,0)
,`Mutasi_ID` int(11)
,`SatkerAwal` varchar(100)
,`SatkerTujuan` varchar(100)
,`Aset_ID_Tujuan` int(11)
,`Status` int(11)
,`NoSKKDH` varchar(30)
,`TglSKKDH` date
,`NomorRegAwal` varchar(100)
,`NomorRegbaru` varchar(100)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_penghapusan_aset`
--
CREATE TABLE IF NOT EXISTS `view_penghapusan_aset` (
`Usulan_ID` text
,`NoSKHapus` varchar(50)
,`TglHapus` date
,`Status` tinyint(4)
,`Jenis_Hapus` varchar(3)
,`Aset_ID` int(11)
);

-- --------------------------------------------------------

--
DROP TABLE IF EXISTS `view_cek_usulan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_cek_usulan` AS select `a`.`Aset_ID` AS `Aset_ID`,`a`.`kodeKelompok` AS `kodeKelompok`,`a`.`kodeSatker` AS `kodeSatker`,`a`.`kodeLokasi` AS `kodeLokasi`,`a`.`noRegister` AS `noRegister`,`a`.`noKontrak` AS `noKontrak`,`a`.`TglPerolehan` AS `TglPerolehan`,`a`.`TglPembukuan` AS `TglPembukuan`,`a`.`SumberDana` AS `SumberDana`,`a`.`NilaiPerolehan` AS `NilaiPerolehan`,`a`.`Alamat` AS `Alamat`,`a`.`RTRW` AS `RTRW`,`a`.`kondisi` AS `kondisi`,`a`.`TglInventarisasi` AS `TglInventarisasi`,`a`.`BAST_ID` AS `BAST_ID`,`a`.`BASP_ID` AS `BASP_ID`,`a`.`Kuantitas` AS `Kuantitas`,`a`.`Satuan` AS `Satuan`,`a`.`Bersejarah` AS `Bersejarah`,`a`.`Info` AS `Info`,`a`.`Dihapus` AS `Dihapus`,`a`.`UserNm` AS `UserNm`,`a`.`FixAset` AS `FixAset`,`a`.`NotUse` AS `NotUse`,`a`.`Tahun` AS `Tahun`,`a`.`AsalUsul` AS `AsalUsul`,`a`.`Dipindah` AS `Dipindah`,`a`.`CaraPerolehan` AS `CaraPerolehan`,`a`.`Status_Validasi_Barang` AS `Status_Validasi_Barang`,`a`.`kodeData` AS `kodeData`,`a`.`kodeKA` AS `kodeKA`,`a`.`kodeRuangan` AS `kodeRuangan`,`a`.`TipeAset` AS `TipeAset`,`a`.`statusPemanfaatan` AS `statusPemanfaatan`,`a`.`MasaManfaat` AS `MasaManfaat`,`a`.`AkumulasiPenyusutan` AS `AkumulasiPenyusutan`,`a`.`PenyusutanPertaun` AS `PenyusutanPerTaun`,`a`.`fixPenggunaan` AS `fixPenggunaan`,`us`.`Usulan_ID` AS `Usulan_ID`,`us`.`Penetapan_ID` AS `Penetapan_ID`,`us`.`Jenis_Usulan` AS `Jenis_Usulan`,`us`.`StatusPenetapan` AS `StatusPenetapan`,`us`.`StatusValidasi` AS `StatusValidasi`,`us`.`StatusKonfirmasi` AS `StatusKonfirmasi`,`us`.`NilaiPerolehanTmp` AS `NilaiPerolehanTmp`,`us`.`kondisiTmp` AS `kondisiTmp` from (`aset` `a` join `usulanaset` `us` on((`us`.`Aset_ID` = `a`.`Aset_ID`)));

-- --------------------------------------------------------

--
-- Structure for view `view_hapus_aset`
--
DROP TABLE IF EXISTS `view_hapus_aset`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_hapus_aset` AS select `a`.`Aset_ID` AS `Aset_ID`,`a`.`kodeKelompok` AS `kodeKelompok`,`a`.`kodeSatker` AS `kodeSatker`,`a`.`kodeLokasi` AS `kodeLokasi`,`a`.`noRegister` AS `noRegister`,`a`.`noKontrak` AS `noKontrak`,`a`.`TglPerolehan` AS `TglPerolehan`,`a`.`TglPembukuan` AS `TglPembukuan`,`a`.`SumberDana` AS `SumberDana`,`a`.`NilaiPerolehan` AS `NilaiPerolehan`,`a`.`Alamat` AS `Alamat`,`a`.`RTRW` AS `RTRW`,`a`.`kondisi` AS `kondisi`,`a`.`TglInventarisasi` AS `TglInventarisasi`,`a`.`BAST_ID` AS `BAST_ID`,`a`.`BASP_ID` AS `BASP_ID`,`a`.`Kuantitas` AS `Kuantitas`,`a`.`Satuan` AS `Satuan`,`a`.`Bersejarah` AS `Bersejarah`,`a`.`Info` AS `Info`,`a`.`Dihapus` AS `Dihapus`,`a`.`UserNm` AS `UserNm`,`a`.`FixAset` AS `FixAset`,`a`.`NotUse` AS `NotUse`,`a`.`Tahun` AS `Tahun`,`a`.`AsalUsul` AS `AsalUsul`,`a`.`Dipindah` AS `Dipindah`,`a`.`StatusValidasi` AS `StatusValidasi`,`a`.`CaraPerolehan` AS `CaraPerolehan`,`a`.`Status_Validasi_Barang` AS `Status_Validasi_Barang`,`a`.`kodeData` AS `kodeData`,`a`.`kodeKA` AS `kodeKA`,`a`.`kodeRuangan` AS `kodeRuangan`,`a`.`TipeAset` AS `TipeAset`,`a`.`statusPemanfaatan` AS `statusPemanfaatan`,`a`.`MasaManfaat` AS `MasaManfaat`,`a`.`AkumulasiPenyusutan` AS `AkumulasiPenyusutan`,`a`.`PenyusutanPertaun` AS `PenyusutanPerTaun`,`a`.`fixPenggunaan` AS `fixPenggunaan`,`v`.`NoSKHapus` AS `NoSKHapus`,`v`.`TglHapus` AS `TglHapus`,`v`.`Status` AS `Status`,`v`.`Jenis_Hapus` AS `Jenis_Hapus` from (`view_penghapusan_aset` `v` join `aset` `a` on((`a`.`Aset_ID` = `v`.`Aset_ID`)));

-- --------------------------------------------------------

--
-- Structure for view `view_hapus_asetlain`
--
DROP TABLE IF EXISTS `view_hapus_asetlain`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_hapus_asetlain` AS select `v`.`NoSKHapus` AS `NoSKHapus`,`v`.`TglHapus` AS `TglHapus`,`v`.`Status` AS `Status`,`v`.`Jenis_Hapus` AS `Jenis_Hapus`,`a`.`AsetLain_ID` AS `AsetLain_ID`,`a`.`Aset_ID` AS `Aset_ID`,`a`.`kodeKelompok` AS `kodeKelompok`,`a`.`kodeSatker` AS `kodeSatker`,`a`.`kodeLokasi` AS `kodeLokasi`,`a`.`noRegister` AS `noRegister`,`a`.`TglPerolehan` AS `TglPerolehan`,`a`.`TglPembukuan` AS `TglPembukuan`,`a`.`kodeData` AS `kodeData`,`a`.`kodeKA` AS `kodeKA`,`a`.`kodeRuangan` AS `kodeRuangan`,`a`.`StatusValidasi` AS `StatusValidasi`,`a`.`Status_Validasi_Barang` AS `Status_Validasi_Barang`,`a`.`StatusTampil` AS `StatusTampil`,`a`.`Tahun` AS `Tahun`,`a`.`Alamat` AS `Alamat`,`a`.`Info` AS `Info`,`a`.`AsalUsul` AS `AsalUsul`,`a`.`kondisi` AS `kondisi`,`a`.`CaraPerolehan` AS `CaraPerolehan`,`a`.`Judul` AS `Judul`,`a`.`AsalDaerah` AS `AsalDaerah`,`a`.`Pengarang` AS `Pengarang`,`a`.`Penerbit` AS `Penerbit`,`a`.`Spesifikasi` AS `Spesifikasi`,`a`.`TahunTerbit` AS `TahunTerbit`,`a`.`ISBN` AS `ISBN`,`a`.`Material` AS `Material`,`a`.`Ukuran` AS `Ukuran`,`a`.`GUID` AS `GUID`,`a`.`MasaManfaat` AS `MasaManfaat`,`a`.`AkumulasiPenyusutan` AS `AkumulasiPenyusutan`,`a`.`NilaiBuku` AS `NilaiBuku`,`a`.`PenyusutanPerTahun` AS `PenyusutanPerTahun`,if((`l`.`NilaiPerolehan_Awal` <> 0),`l`.`NilaiPerolehan_Awal`,`a`.`NilaiPerolehan`) AS `NilaiPerolehan` from ((`view_penghapusan_aset` `v` join `asetlain` `a` on((`a`.`Aset_ID` = `v`.`Aset_ID`))) left join `log_asetlain` `l` on(((`l`.`Aset_ID` = `v`.`Aset_ID`) and ((`l`.`Kd_Riwayat` = 7) or (`l`.`Kd_Riwayat` = 26) or (`l`.`Kd_Riwayat` = 27)))));

-- --------------------------------------------------------

--
-- Structure for view `view_hapus_bangunan`
--
DROP TABLE IF EXISTS `view_hapus_bangunan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_hapus_bangunan` AS select `v`.`NoSKHapus` AS `NoSKHapus`,`v`.`TglHapus` AS `TglHapus`,`v`.`Status` AS `Status`,`v`.`Jenis_Hapus` AS `Jenis_Hapus`,`b`.`Bangunan_ID` AS `Bangunan_ID`,`b`.`Aset_ID` AS `Aset_ID`,`b`.`kodeKelompok` AS `kodeKelompok`,`b`.`kodeSatker` AS `kodeSatker`,`b`.`kodeLokasi` AS `kodeLokasi`,`b`.`noRegister` AS `noRegister`,`b`.`TglPerolehan` AS `TglPerolehan`,`b`.`TglPembukuan` AS `TglPembukuan`,`b`.`kodeData` AS `kodeData`,`b`.`kodeKA` AS `kodeKA`,`b`.`kodeRuangan` AS `kodeRuangan`,`b`.`StatusValidasi` AS `StatusValidasi`,`b`.`Status_Validasi_Barang` AS `Status_Validasi_Barang`,`b`.`StatusTampil` AS `StatusTampil`,`b`.`Tahun` AS `Tahun`,`b`.`Alamat` AS `Alamat`,`b`.`Info` AS `Info`,`b`.`AsalUsul` AS `AsalUsul`,`b`.`kondisi` AS `kondisi`,`b`.`CaraPerolehan` AS `CaraPerolehan`,`b`.`TglPakai` AS `TglPakai`,`b`.`Konstruksi` AS `Konstruksi`,`b`.`Beton` AS `Beton`,`b`.`JumlahLantai` AS `JumlahLantai`,`b`.`LuasLantai` AS `LuasLantai`,`b`.`Dinding` AS `Dinding`,`b`.`Lantai` AS `Lantai`,`b`.`LangitLangit` AS `LangitLangit`,`b`.`Atap` AS `Atap`,`b`.`NoSurat` AS `NoSurat`,`b`.`TglSurat` AS `TglSurat`,`b`.`NoIMB` AS `NoIMB`,`b`.`TglIMB` AS `TglIMB`,`b`.`StatusTanah` AS `StatusTanah`,`b`.`NoSertifikat` AS `NoSertifikat`,`b`.`TglSertifikat` AS `TglSertifikat`,`b`.`Tanah_ID` AS `Tanah_ID`,`b`.`Tmp_Tingkat` AS `Tmp_Tingkat`,`b`.`Tmp_Beton` AS `Tmp_Beton`,`b`.`Tmp_Luas` AS `Tmp_Luas`,`b`.`KelompokTanah_ID` AS `KelompokTanah_ID`,`b`.`GUID` AS `GUID`,`b`.`TglPembangunan` AS `TglPembangunan`,`l`.`MasaManfaat` AS `MasaManfaat`,`l`.`AkumulasiPenyusutan` AS `AkumulasiPenyusutan`,`l`.`NilaiBuku` AS `NilaiBuku`,`l`.`PenyusutanPerTahun` AS `PenyusutanPerTahun`,if((`l`.`NilaiPerolehan_Awal` <> 0),`l`.`NilaiPerolehan_Awal`,`b`.`NilaiPerolehan`) AS `NilaiPerolehan` from ((`view_penghapusan_aset` `v` join `bangunan` `b` on((`b`.`Aset_ID` = `v`.`Aset_ID`))) left join `log_bangunan` `l` on(((`l`.`Aset_ID` = `v`.`Aset_ID`) and ((`l`.`Kd_Riwayat` = 7) or (`l`.`Kd_Riwayat` = 26) or (`l`.`Kd_Riwayat` = 27)))));

-- --------------------------------------------------------

--
-- Structure for view `view_hapus_jaringan`
--
DROP TABLE IF EXISTS `view_hapus_jaringan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_hapus_jaringan` AS select `v`.`NoSKHapus` AS `NoSKHapus`,`v`.`TglHapus` AS `TglHapus`,`v`.`Status` AS `Status`,`v`.`Jenis_Hapus` AS `Jenis_Hapus`,`j`.`Jaringan_ID` AS `Jaringan_ID`,`j`.`Aset_ID` AS `Aset_ID`,`j`.`kodeKelompok` AS `kodeKelompok`,`j`.`kodeSatker` AS `kodeSatker`,`j`.`kodeLokasi` AS `kodeLokasi`,`j`.`noRegister` AS `noRegister`,`j`.`TglPerolehan` AS `TglPerolehan`,`j`.`TglPembukuan` AS `TglPembukuan`,`j`.`kodeData` AS `kodeData`,`j`.`kodeKA` AS `kodeKA`,`j`.`kodeRuangan` AS `kodeRuangan`,`j`.`StatusValidasi` AS `StatusValidasi`,`j`.`Status_Validasi_Barang` AS `Status_Validasi_Barang`,`j`.`StatusTampil` AS `StatusTampil`,`j`.`Tahun` AS `Tahun`,`j`.`Alamat` AS `Alamat`,`j`.`Info` AS `Info`,`j`.`AsalUsul` AS `AsalUsul`,`j`.`kondisi` AS `kondisi`,`j`.`CaraPerolehan` AS `CaraPerolehan`,`j`.`Konstruksi` AS `Konstruksi`,`j`.`Panjang` AS `Panjang`,`j`.`Lebar` AS `Lebar`,`j`.`NoDokumen` AS `NoDokumen`,`j`.`TglDokumen` AS `TglDokumen`,`j`.`StatusTanah` AS `StatusTanah`,`j`.`NoSertifikat` AS `NoSertifikat`,`j`.`TglSertifikat` AS `TglSertifikat`,`j`.`Tanah_ID` AS `Tanah_ID`,`j`.`KelompokTanah_ID` AS `KelompokTanah_ID`,`j`.`GUID` AS `GUID`,`j`.`TanggalPemakaian` AS `TanggalPemakaian`,`j`.`LuasJaringan` AS `LuasJaringan`,`l`.`MasaManfaat` AS `MasaManfaat`,`l`.`AkumulasiPenyusutan` AS `AkumulasiPenyusutan`,`l`.`NilaiBuku` AS `NilaiBuku`,`l`.`PenyusutanPerTahun` AS `PenyusutanPerTahun`,if((`l`.`NilaiPerolehan_Awal` <> 0),`l`.`NilaiPerolehan_Awal`,`j`.`NilaiPerolehan`) AS `NilaiPerolehan` from ((`view_penghapusan_aset` `v` join `jaringan` `j` on((`j`.`Aset_ID` = `v`.`Aset_ID`))) left join `log_jaringan` `l` on(((`l`.`Aset_ID` = `v`.`Aset_ID`) and ((`l`.`Kd_Riwayat` = 7) or (`l`.`Kd_Riwayat` = 26) or (`l`.`Kd_Riwayat` = 27)))));

-- --------------------------------------------------------

--
-- Structure for view `view_hapus_kdp`
--
DROP TABLE IF EXISTS `view_hapus_kdp`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_hapus_kdp` AS select `v`.`NoSKHapus` AS `NoSKHapus`,`v`.`TglHapus` AS `TglHapus`,`v`.`Status` AS `Status`,`v`.`Jenis_Hapus` AS `Jenis_Hapus`,`k`.`KDP_ID` AS `KDP_ID`,`k`.`Aset_ID` AS `Aset_ID`,`k`.`kodeKelompok` AS `kodeKelompok`,`k`.`kodeSatker` AS `kodeSatker`,`k`.`kodeLokasi` AS `kodeLokasi`,`k`.`noRegister` AS `noRegister`,`k`.`TglPerolehan` AS `TglPerolehan`,`k`.`TglPembukuan` AS `TglPembukuan`,`k`.`kodeData` AS `kodeData`,`k`.`kodeKA` AS `kodeKA`,`k`.`kodeRuangan` AS `kodeRuangan`,`k`.`StatusValidasi` AS `StatusValidasi`,`k`.`Status_Validasi_Barang` AS `Status_Validasi_Barang`,`k`.`StatusTampil` AS `StatusTampil`,`k`.`Tahun` AS `Tahun`,`k`.`Alamat` AS `Alamat`,`k`.`Info` AS `Info`,`k`.`AsalUsul` AS `AsalUsul`,`k`.`kondisi` AS `kondisi`,`k`.`CaraPerolehan` AS `CaraPerolehan`,`k`.`Konstruksi` AS `Konstruksi`,`k`.`Beton` AS `Beton`,`k`.`JumlahLantai` AS `JumlahLantai`,`k`.`LuasLantai` AS `LuasLantai`,`k`.`TglMulai` AS `TglMulai`,`k`.`StatusTanah` AS `StatusTanah`,`k`.`NoSertifikat` AS `NoSertifikat`,`k`.`TglSertifikat` AS `TglSertifikat`,`k`.`Tanah_ID` AS `Tanah_ID`,`k`.`KelompokTanah_ID` AS `KelompokTanah_ID`,`k`.`GUID` AS `GUID`,if((`l`.`NilaiPerolehan_Awal` <> 0),`l`.`NilaiPerolehan_Awal`,`k`.`NilaiPerolehan`) AS `NilaiPerolehan` from ((`view_penghapusan_aset` `v` join `kdp` `k` on((`k`.`Aset_ID` = `v`.`Aset_ID`))) left join `log_asetlain` `l` on(((`l`.`Aset_ID` = `v`.`Aset_ID`) and ((`l`.`Kd_Riwayat` = 7) or (`l`.`Kd_Riwayat` = 26) or (`l`.`Kd_Riwayat` = 27)))));

-- --------------------------------------------------------

--
-- Structure for view `view_hapus_mesin`
--
DROP TABLE IF EXISTS `view_hapus_mesin`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_hapus_mesin` AS select `v`.`NoSKHapus` AS `NoSKHapus`,`v`.`TglHapus` AS `TglHapus`,`v`.`Status` AS `Status`,`v`.`Jenis_Hapus` AS `Jenis_Hapus`,`m`.`Mesin_ID` AS `Mesin_ID`,`m`.`Aset_ID` AS `Aset_ID`,`m`.`kodeKelompok` AS `kodeKelompok`,`m`.`kodeSatker` AS `kodeSatker`,`m`.`kodeLokasi` AS `kodeLokasi`,`m`.`noRegister` AS `noRegister`,`m`.`TglPerolehan` AS `TglPerolehan`,`m`.`TglPembukuan` AS `TglPembukuan`,`m`.`kodeData` AS `kodeData`,`m`.`kodeKA` AS `kodeKA`,`m`.`kodeRuangan` AS `kodeRuangan`,`m`.`StatusValidasi` AS `StatusValidasi`,`m`.`Status_Validasi_Barang` AS `Status_Validasi_Barang`,`m`.`StatusTampil` AS `StatusTampil`,`m`.`Tahun` AS `Tahun`,`m`.`Alamat` AS `Alamat`,`m`.`Info` AS `Info`,`m`.`AsalUsul` AS `AsalUsul`,`m`.`kondisi` AS `kondisi`,`m`.`CaraPerolehan` AS `CaraPerolehan`,`m`.`Merk` AS `Merk`,`m`.`Model` AS `Model`,`m`.`Ukuran` AS `Ukuran`,`m`.`Silinder` AS `Silinder`,`m`.`MerkMesin` AS `MerkMesin`,`m`.`JumlahMesin` AS `JumlahMesin`,`m`.`Material` AS `Material`,`m`.`NoSeri` AS `NoSeri`,`m`.`NoRangka` AS `NoRangka`,`m`.`NoMesin` AS `NoMesin`,`m`.`NoSTNK` AS `NoSTNK`,`m`.`TglSTNK` AS `TglSTNK`,`m`.`NoBPKB` AS `NoBPKB`,`m`.`TglBPKB` AS `TglBPKB`,`m`.`NoDokumen` AS `NoDokumen`,`m`.`TglDokumen` AS `TglDokumen`,`m`.`Pabrik` AS `Pabrik`,`m`.`TahunBuat` AS `TahunBuat`,`m`.`BahanBakar` AS `BahanBakar`,`m`.`NegaraAsal` AS `NegaraAsal`,`m`.`NegaraRakit` AS `NegaraRakit`,`m`.`Kapasitas` AS `Kapasitas`,`m`.`Bobot` AS `Bobot`,`m`.`GUID` AS `GUID`,`l`.`MasaManfaat` AS `MasaManfaat`,`l`.`AkumulasiPenyusutan` AS `AkumulasiPenyusutan`,`l`.`NilaiBuku` AS `NilaiBuku`,`l`.`PenyusutanPerTahun` AS `PenyusutanPerTahun`,if((`l`.`NilaiPerolehan_Awal` <> 0),`l`.`NilaiPerolehan_Awal`,`m`.`NilaiPerolehan`) AS `NilaiPerolehan` from ((`view_penghapusan_aset` `v` join `mesin` `m` on((`m`.`Aset_ID` = `v`.`Aset_ID`))) left join `log_mesin` `l` on(((`l`.`Aset_ID` = `v`.`Aset_ID`) and ((`l`.`Kd_Riwayat` = 7) or (`l`.`Kd_Riwayat` = 26) or (`l`.`Kd_Riwayat` = 27)))));

-- --------------------------------------------------------

--
-- Structure for view `view_hapus_tanah`
--
DROP TABLE IF EXISTS `view_hapus_tanah`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_hapus_tanah` AS select `v`.`NoSKHapus` AS `NoSKHapus`,`v`.`TglHapus` AS `TglHapus`,`v`.`Status` AS `Status`,`v`.`Jenis_Hapus` AS `Jenis_Hapus`,`t`.`Tanah_ID` AS `Tanah_ID`,`t`.`Aset_ID` AS `Aset_ID`,`t`.`kodeKelompok` AS `kodeKelompok`,`t`.`kodeSatker` AS `kodeSatker`,`t`.`kodeLokasi` AS `kodeLokasi`,`t`.`noRegister` AS `noRegister`,`t`.`TglPerolehan` AS `TglPerolehan`,`t`.`TglPembukuan` AS `TglPembukuan`,`t`.`kodeData` AS `kodeData`,`t`.`kodeKA` AS `kodeKA`,`t`.`kodeRuangan` AS `kodeRuangan`,`t`.`StatusValidasi` AS `StatusValidasi`,`t`.`Status_Validasi_Barang` AS `Status_Validasi_Barang`,`t`.`StatusTampil` AS `StatusTampil`,`t`.`Tahun` AS `Tahun`,`t`.`Alamat` AS `Alamat`,`t`.`Info` AS `Info`,`t`.`AsalUsul` AS `AsalUsul`,`t`.`kondisi` AS `kondisi`,`t`.`CaraPerolehan` AS `CaraPerolehan`,`t`.`LuasTotal` AS `LuasTotal`,`t`.`LuasBangunan` AS `LuasBangunan`,`t`.`LuasSekitar` AS `LuasSekitar`,`t`.`LuasKosong` AS `LuasKosong`,`t`.`HakTanah` AS `HakTanah`,`t`.`NoSertifikat` AS `NoSertifikat`,`t`.`TglSertifikat` AS `TglSertifikat`,`t`.`Penggunaan` AS `Penggunaan`,`t`.`BatasUtara` AS `BatasUtara`,`t`.`BatasSelatan` AS `BatasSelatan`,`t`.`BatasBarat` AS `BatasBarat`,`t`.`BatasTimur` AS `BatasTimur`,`t`.`Tmp_Hak` AS `Tmp_Hak`,`t`.`GUID` AS `GUID`,`t`.`MasaManfaat` AS `MasaManfaat`,`t`.`AkumulasiPenyusutan` AS `AkumulasiPenyusutan`,`t`.`PenyusutanPerTahun` AS `PenyusutanPerTahun`,if((`l`.`NilaiPerolehan_Awal` <> 0),`l`.`NilaiPerolehan_Awal`,`t`.`NilaiPerolehan`) AS `NilaiPerolehan` from ((`view_penghapusan_aset` `v` join `tanah` `t` on((`t`.`Aset_ID` = `v`.`Aset_ID`))) left join `log_tanah` `l` on(((`l`.`Aset_ID` = `v`.`Aset_ID`) and ((`l`.`Kd_Riwayat` = 7) or (`l`.`Kd_Riwayat` = 26) or (`l`.`Kd_Riwayat` = 27)))));

-- --------------------------------------------------------

--
-- Structure for view `view_mutasi_aset`
--
DROP TABLE IF EXISTS `view_mutasi_aset`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_mutasi_aset` AS select `a`.`Mutasi_ID` AS `Mutasi_ID`,`a`.`Aset_ID` AS `Aset_ID`,`a`.`SatkerAwal` AS `SatkerAwal`,`a`.`SatkerTujuan` AS `SatkerTujuan`,`a`.`Aset_ID_Tujuan` AS `Aset_ID_Tujuan`,`a`.`Status` AS `Status`,`m`.`NoSKKDH` AS `NoSKKDH`,`m`.`TglSKKDH` AS `TglSKKDH`,`a`.`NomorRegAwal` AS `NomorRegAwal`,`a`.`NomorRegBaru` AS `NomorRegbaru` from (`mutasiaset` `a` left join `mutasi` `m` on((`m`.`Mutasi_ID` = `a`.`Mutasi_ID`))) where ((`a`.`Status` = 1) and (`a`.`Aset_ID` <> 0) and (`a`.`Aset_ID_Tujuan` = 0));

-- --------------------------------------------------------

--
-- Structure for view `view_mutasi_aset2`
--
DROP TABLE IF EXISTS `view_mutasi_aset2`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_mutasi_aset2` AS select `a`.`Mutasi_ID` AS `Mutasi_ID`,`a`.`Aset_ID` AS `Aset_ID`,`a`.`SatkerAwal` AS `SatkerAwal`,`a`.`SatkerTujuan` AS `SatkerTujuan`,`a`.`Aset_ID_Tujuan` AS `Aset_ID_Tujuan`,`a`.`Status` AS `Status`,`m`.`NoSKKDH` AS `NoSKKDH`,`m`.`TglSKKDH` AS `TglSKKDH`,`a`.`NomorRegAwal` AS `NomorRegAwal`,`a`.`NomorRegBaru` AS `NomorRegbaru` from (`mutasiaset` `a` left join `mutasi` `m` on((`m`.`Mutasi_ID` = `a`.`Mutasi_ID`))) where ((`a`.`Status` = 1) and (`a`.`Aset_ID` <> 0) and (`a`.`Aset_ID_Tujuan` = 0));

-- --------------------------------------------------------

--
-- Structure for view `view_mutasi_asetlain`
--
DROP TABLE IF EXISTS `view_mutasi_asetlain`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_mutasi_asetlain` AS select `a`.`AsetLain_ID` AS `AsetLain_ID`,`a`.`Aset_ID` AS `Aset_ID`,`a`.`kodeKelompok` AS `kodeKelompok`,`a`.`kodeSatker` AS `kodeSatker`,`a`.`kodeLokasi` AS `kodeLokasi`,`a`.`noRegister` AS `noRegister`,`a`.`TglPerolehan` AS `TglPerolehan`,`l`.`TglPembukuan` AS `TglPembukuan`,`a`.`kodeData` AS `kodeData`,`a`.`kodeKA` AS `kodeKA`,`a`.`kodeRuangan` AS `kodeRuangan`,if((`a`.`StatusValidasi` <> 1),1,1) AS `StatusValidasi`,if((`a`.`Status_Validasi_Barang` <> 1),1,1) AS `Status_Validasi_Barang`,if((`a`.`StatusTampil` <> 1),1,1) AS `StatusTampil`,`a`.`Tahun` AS `Tahun`,`l`.`NilaiPerolehan` AS `NilaiPerolehan`,`a`.`Alamat` AS `Alamat`,`a`.`Info` AS `Info`,`a`.`AsalUsul` AS `AsalUsul`,`a`.`kondisi` AS `kondisi`,`a`.`CaraPerolehan` AS `CaraPerolehan`,`a`.`Judul` AS `Judul`,`a`.`AsalDaerah` AS `AsalDaerah`,`a`.`Pengarang` AS `Pengarang`,`a`.`Penerbit` AS `Penerbit`,`a`.`Spesifikasi` AS `Spesifikasi`,`a`.`TahunTerbit` AS `TahunTerbit`,`a`.`ISBN` AS `ISBN`,`a`.`Material` AS `Material`,`a`.`Ukuran` AS `Ukuran`,`a`.`GUID` AS `GUID`,`a`.`MasaManfaat` AS `MasaManfaat`,`a`.`AkumulasiPenyusutan` AS `AkumulasiPenyusutan`,`a`.`NilaiBuku` AS `NilaiBuku`,`a`.`PenyusutanPerTahun` AS `PenyusutanPerTahun`,`m`.`Mutasi_ID` AS `Mutasi_ID`,`m`.`SatkerAwal` AS `SatkerAwal`,`m`.`SatkerTujuan` AS `SatkerTujuan`,`m`.`Aset_ID_Tujuan` AS `Aset_ID_Tujuan`,`m`.`Status` AS `Status`,`m`.`NoSKKDH` AS `NoSKKDH`,`m`.`TglSKKDH` AS `TglSKKDH`,`m`.`NomorRegAwal` AS `NomorRegAwal`,`m`.`NomorRegbaru` AS `NomorRegbaru` from ((`view_mutasi_aset` `m` join `asetlain` `a` on((`a`.`Aset_ID` = `m`.`Aset_ID`))) join `log_asetlain` `l` on(((`m`.`Aset_ID` = `l`.`Aset_ID`) and (`l`.`Kd_Riwayat` = 3))));

-- --------------------------------------------------------

--
-- Structure for view `view_mutasi_aset_full`
--
DROP TABLE IF EXISTS `view_mutasi_aset_full`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_mutasi_aset_full` AS select `a`.`Aset_ID` AS `Aset_ID`,`a`.`kodeKelompok` AS `kodeKelompok`,`a`.`kodeSatker` AS `kodeSatker`,`a`.`kodeLokasi` AS `kodeLokasi`,`a`.`noRegister` AS `noRegister`,`a`.`noKontrak` AS `noKontrak`,`a`.`TglPerolehan` AS `TglPerolehan`,`a`.`TglPembukuan` AS `TglPembukuan`,`a`.`SumberDana` AS `SumberDana`,`a`.`NilaiPerolehan` AS `NilaiPerolehan`,`a`.`Alamat` AS `Alamat`,`a`.`RTRW` AS `RTRW`,`a`.`kondisi` AS `kondisi`,`a`.`TglInventarisasi` AS `TglInventarisasi`,`a`.`BAST_ID` AS `BAST_ID`,`a`.`BASP_ID` AS `BASP_ID`,`a`.`Kuantitas` AS `Kuantitas`,`a`.`Satuan` AS `Satuan`,`a`.`Bersejarah` AS `Bersejarah`,`a`.`Info` AS `Info`,`a`.`Dihapus` AS `Dihapus`,`a`.`UserNm` AS `UserNm`,`a`.`FixAset` AS `FixAset`,`a`.`NotUse` AS `NotUse`,`a`.`Tahun` AS `Tahun`,`a`.`AsalUsul` AS `AsalUsul`,`a`.`Dipindah` AS `Dipindah`,`a`.`StatusValidasi` AS `StatusValidasi`,`a`.`CaraPerolehan` AS `CaraPerolehan`,`a`.`Status_Validasi_Barang` AS `Status_Validasi_Barang`,`a`.`kodeData` AS `kodeData`,`a`.`kodeKA` AS `kodeKA`,`a`.`kodeRuangan` AS `kodeRuangan`,`a`.`TipeAset` AS `TipeAset`,`a`.`statusPemanfaatan` AS `statusPemanfaatan`,`a`.`MasaManfaat` AS `MasaManfaat`,`a`.`AkumulasiPenyusutan` AS `AkumulasiPenyusutan`,`a`.`PenyusutanPertaun` AS `PenyusutanPerTaun`,`a`.`fixPenggunaan` AS `fixPenggunaan`,`m`.`Mutasi_ID` AS `Mutasi_ID`,`m`.`SatkerAwal` AS `SatkerAwal`,`m`.`SatkerTujuan` AS `SatkerTujuan`,`m`.`Aset_ID_Tujuan` AS `Aset_ID_Tujuan`,`m`.`Status` AS `Status`,`m`.`NoSKKDH` AS `NoSKKDH`,`m`.`TglSKKDH` AS `TglSKKDH`,`m`.`NomorRegAwal` AS `NomorRegAwal`,`m`.`NomorRegbaru` AS `NomorRegbaru` from (`view_mutasi_aset` `m` join `aset` `a` on((`a`.`Aset_ID` = `m`.`Aset_ID`)));

-- --------------------------------------------------------

--
-- Structure for view `view_mutasi_bangunan`
--
DROP TABLE IF EXISTS `view_mutasi_bangunan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_mutasi_bangunan` AS select `b`.`Bangunan_ID` AS `Bangunan_ID`,`b`.`Aset_ID` AS `Aset_ID`,`b`.`kodeKelompok` AS `kodeKelompok`,`b`.`kodeSatker` AS `kodeSatker`,`b`.`kodeLokasi` AS `kodeLokasi`,`b`.`noRegister` AS `noRegister`,`b`.`TglPerolehan` AS `TglPerolehan`,`l`.`TglPembukuan` AS `TglPembukuan`,`b`.`kodeData` AS `kodeData`,`b`.`kodeKA` AS `kodeKA`,`b`.`kodeRuangan` AS `kodeRuangan`,if((`b`.`StatusValidasi` <> 1),1,1) AS `StatusValidasi`,if((`b`.`Status_Validasi_Barang` <> 1),1,1) AS `Status_Validasi_Barang`,if((`b`.`StatusTampil` <> 1),1,1) AS `StatusTampil`,`b`.`Tahun` AS `Tahun`,`l`.`NilaiPerolehan` AS `NilaiPerolehan`,`b`.`Alamat` AS `Alamat`,`b`.`Info` AS `Info`,`b`.`AsalUsul` AS `AsalUsul`,`b`.`kondisi` AS `kondisi`,`b`.`CaraPerolehan` AS `CaraPerolehan`,`b`.`TglPakai` AS `TglPakai`,`b`.`Konstruksi` AS `Konstruksi`,`b`.`Beton` AS `Beton`,`b`.`JumlahLantai` AS `JumlahLantai`,`b`.`LuasLantai` AS `LuasLantai`,`b`.`Dinding` AS `Dinding`,`b`.`Lantai` AS `Lantai`,`b`.`LangitLangit` AS `LangitLangit`,`b`.`Atap` AS `Atap`,`b`.`NoSurat` AS `NoSurat`,`b`.`TglSurat` AS `TglSurat`,`b`.`NoIMB` AS `NoIMB`,`b`.`TglIMB` AS `TglIMB`,`b`.`StatusTanah` AS `StatusTanah`,`b`.`NoSertifikat` AS `NoSertifikat`,`b`.`TglSertifikat` AS `TglSertifikat`,`b`.`Tanah_ID` AS `Tanah_ID`,`b`.`Tmp_Tingkat` AS `Tmp_Tingkat`,`b`.`Tmp_Beton` AS `Tmp_Beton`,`b`.`Tmp_Luas` AS `Tmp_Luas`,`b`.`KelompokTanah_ID` AS `KelompokTanah_ID`,`b`.`GUID` AS `GUID`,`b`.`TglPembangunan` AS `TglPembangunan`,`l`.`MasaManfaat` AS `MasaManfaat`,`l`.`AkumulasiPenyusutan` AS `AkumulasiPenyusutan`,`l`.`NilaiBuku` AS `NilaiBuku`,`l`.`PenyusutanPerTahun` AS `PenyusutanPerTahun`,`m`.`Mutasi_ID` AS `Mutasi_ID`,`m`.`SatkerAwal` AS `SatkerAwal`,`m`.`SatkerTujuan` AS `SatkerTujuan`,`m`.`Aset_ID_Tujuan` AS `Aset_ID_Tujuan`,`m`.`Status` AS `Status`,`m`.`NoSKKDH` AS `NoSKKDH`,`m`.`TglSKKDH` AS `TglSKKDH`,`m`.`NomorRegAwal` AS `NomorRegAwal`,`m`.`NomorRegbaru` AS `NomorRegbaru` from ((`view_mutasi_aset` `m` join `bangunan` `b` on((`b`.`Aset_ID` = `m`.`Aset_ID`))) join `log_bangunan` `l` on(((`m`.`Aset_ID` = `l`.`Aset_ID`) and (`l`.`Kd_Riwayat` = 3))));

-- --------------------------------------------------------

--
-- Structure for view `view_mutasi_jaringan`
--
DROP TABLE IF EXISTS `view_mutasi_jaringan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_mutasi_jaringan` AS select `j`.`Jaringan_ID` AS `Jaringan_ID`,`j`.`Aset_ID` AS `Aset_ID`,`j`.`kodeKelompok` AS `kodeKelompok`,`j`.`kodeSatker` AS `kodeSatker`,`j`.`kodeLokasi` AS `kodeLokasi`,`j`.`noRegister` AS `noRegister`,`j`.`TglPerolehan` AS `TglPerolehan`,`l`.`TglPembukuan` AS `TglPembukuan`,`j`.`kodeData` AS `kodeData`,`j`.`kodeKA` AS `kodeKA`,`j`.`kodeRuangan` AS `kodeRuangan`,if((`j`.`StatusValidasi` <> 1),1,1) AS `StatusValidasi`,if((`j`.`Status_Validasi_Barang` <> 1),1,1) AS `Status_Validasi_Barang`,if((`j`.`StatusTampil` <> 1),1,1) AS `StatusTampil`,`j`.`Tahun` AS `Tahun`,`l`.`NilaiPerolehan` AS `NilaiPerolehan`,`j`.`Alamat` AS `Alamat`,`j`.`Info` AS `Info`,`j`.`AsalUsul` AS `AsalUsul`,`j`.`kondisi` AS `kondisi`,`j`.`CaraPerolehan` AS `CaraPerolehan`,`j`.`Konstruksi` AS `Konstruksi`,`j`.`Panjang` AS `Panjang`,`j`.`Lebar` AS `Lebar`,`j`.`NoDokumen` AS `NoDokumen`,`j`.`TglDokumen` AS `TglDokumen`,`j`.`StatusTanah` AS `StatusTanah`,`j`.`NoSertifikat` AS `NoSertifikat`,`j`.`TglSertifikat` AS `TglSertifikat`,`j`.`Tanah_ID` AS `Tanah_ID`,`j`.`KelompokTanah_ID` AS `KelompokTanah_ID`,`j`.`GUID` AS `GUID`,`j`.`TanggalPemakaian` AS `TanggalPemakaian`,`j`.`LuasJaringan` AS `LuasJaringan`,`l`.`MasaManfaat` AS `MasaManfaat`,`l`.`AkumulasiPenyusutan` AS `AkumulasiPenyusutan`,`l`.`NilaiBuku` AS `NilaiBuku`,`l`.`PenyusutanPerTahun` AS `PenyusutanPerTahun`,`m`.`Mutasi_ID` AS `Mutasi_ID`,`m`.`SatkerAwal` AS `SatkerAwal`,`m`.`SatkerTujuan` AS `SatkerTujuan`,`m`.`Aset_ID_Tujuan` AS `Aset_ID_Tujuan`,`m`.`Status` AS `Status`,`m`.`NoSKKDH` AS `NoSKKDH`,`m`.`TglSKKDH` AS `TglSKKDH`,`m`.`NomorRegAwal` AS `NomorRegAwal`,`m`.`NomorRegbaru` AS `NomorRegbaru` from ((`view_mutasi_aset` `m` join `jaringan` `j` on((`j`.`Aset_ID` = `m`.`Aset_ID`))) join `log_jaringan` `l` on(((`m`.`Aset_ID` = `l`.`Aset_ID`) and (`l`.`Kd_Riwayat` = 3))));

-- --------------------------------------------------------

--
-- Structure for view `view_mutasi_kdp`
--
DROP TABLE IF EXISTS `view_mutasi_kdp`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_mutasi_kdp` AS select `k`.`KDP_ID` AS `KDP_ID`,`k`.`Aset_ID` AS `Aset_ID`,`k`.`kodeKelompok` AS `kodeKelompok`,`k`.`kodeSatker` AS `kodeSatker`,`k`.`kodeLokasi` AS `kodeLokasi`,`k`.`noRegister` AS `noRegister`,`k`.`TglPerolehan` AS `TglPerolehan`,`l`.`TglPembukuan` AS `TglPembukuan`,`k`.`kodeData` AS `kodeData`,`k`.`kodeKA` AS `kodeKA`,`k`.`kodeRuangan` AS `kodeRuangan`,if((`k`.`StatusValidasi` <> 1),1,1) AS `StatusValidasi`,if((`k`.`Status_Validasi_Barang` <> 1),1,1) AS `Status_Validasi_Barang`,if((`k`.`StatusTampil` <> 1),1,1) AS `StatusTampil`,`k`.`Tahun` AS `Tahun`,`l`.`NilaiPerolehan` AS `NilaiPerolehan`,`k`.`Alamat` AS `Alamat`,`k`.`Info` AS `Info`,`k`.`AsalUsul` AS `AsalUsul`,`k`.`kondisi` AS `kondisi`,`k`.`CaraPerolehan` AS `CaraPerolehan`,`k`.`Konstruksi` AS `Konstruksi`,`k`.`Beton` AS `Beton`,`k`.`JumlahLantai` AS `JumlahLantai`,`k`.`LuasLantai` AS `LuasLantai`,`k`.`TglMulai` AS `TglMulai`,`k`.`StatusTanah` AS `StatusTanah`,`k`.`NoSertifikat` AS `NoSertifikat`,`k`.`TglSertifikat` AS `TglSertifikat`,`k`.`Tanah_ID` AS `Tanah_ID`,`k`.`KelompokTanah_ID` AS `KelompokTanah_ID`,`k`.`GUID` AS `GUID`,`m`.`Mutasi_ID` AS `Mutasi_ID`,`m`.`SatkerAwal` AS `SatkerAwal`,`m`.`SatkerTujuan` AS `SatkerTujuan`,`m`.`Aset_ID_Tujuan` AS `Aset_ID_Tujuan`,`m`.`Status` AS `Status`,`m`.`NoSKKDH` AS `NoSKKDH`,`m`.`TglSKKDH` AS `TglSKKDH`,`m`.`NomorRegAwal` AS `NomorRegAwal`,`m`.`NomorRegbaru` AS `NomorRegbaru` from ((`view_mutasi_aset` `m` join `kdp` `k` on((`k`.`Aset_ID` = `m`.`Aset_ID`))) join `log_kdp` `l` on(((`m`.`Aset_ID` = `l`.`Aset_ID`) and (`l`.`Kd_Riwayat` = 3))));

-- --------------------------------------------------------

--
-- Structure for view `view_mutasi_mesin`
--
DROP TABLE IF EXISTS `view_mutasi_mesin`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_mutasi_mesin` AS select `mes`.`Mesin_ID` AS `Mesin_ID`,`mes`.`Aset_ID` AS `Aset_ID`,`mes`.`kodeKelompok` AS `kodeKelompok`,`mes`.`kodeSatker` AS `kodeSatker`,`mes`.`kodeLokasi` AS `kodeLokasi`,`mes`.`noRegister` AS `noRegister`,`mes`.`TglPerolehan` AS `TglPerolehan`,`l`.`TglPembukuan` AS `TglPembukuan`,`mes`.`kodeData` AS `kodeData`,`mes`.`kodeKA` AS `kodeKA`,`mes`.`kodeRuangan` AS `kodeRuangan`,if((`mes`.`StatusValidasi` <> 1),1,1) AS `StatusValidasi`,if((`mes`.`Status_Validasi_Barang` <> 1),1,1) AS `Status_Validasi_Barang`,if((`mes`.`StatusTampil` <> 1),1,1) AS `StatusTampil`,`mes`.`Tahun` AS `Tahun`,`l`.`NilaiPerolehan` AS `NilaiPerolehan`,`mes`.`Alamat` AS `Alamat`,`mes`.`Info` AS `Info`,`mes`.`AsalUsul` AS `AsalUsul`,`mes`.`kondisi` AS `kondisi`,`mes`.`CaraPerolehan` AS `CaraPerolehan`,`mes`.`Merk` AS `Merk`,`mes`.`Model` AS `Model`,`mes`.`Ukuran` AS `Ukuran`,`mes`.`Silinder` AS `Silinder`,`mes`.`MerkMesin` AS `MerkMesin`,`mes`.`JumlahMesin` AS `JumlahMesin`,`mes`.`Material` AS `Material`,`mes`.`NoSeri` AS `NoSeri`,`mes`.`NoRangka` AS `NoRangka`,`mes`.`NoMesin` AS `NoMesin`,`mes`.`NoSTNK` AS `NoSTNK`,`mes`.`TglSTNK` AS `TglSTNK`,`mes`.`NoBPKB` AS `NoBPKB`,`mes`.`TglBPKB` AS `TglBPKB`,`mes`.`NoDokumen` AS `NoDokumen`,`mes`.`TglDokumen` AS `TglDokumen`,`mes`.`Pabrik` AS `Pabrik`,`mes`.`TahunBuat` AS `TahunBuat`,`mes`.`BahanBakar` AS `BahanBakar`,`mes`.`NegaraAsal` AS `NegaraAsal`,`mes`.`NegaraRakit` AS `NegaraRakit`,`mes`.`Kapasitas` AS `Kapasitas`,`mes`.`Bobot` AS `Bobot`,`mes`.`GUID` AS `GUID`,`l`.`MasaManfaat` AS `MasaManfaat`,`l`.`AkumulasiPenyusutan` AS `AkumulasiPenyusutan`,`l`.`NilaiBuku` AS `NilaiBuku`,`l`.`PenyusutanPerTahun` AS `PenyusutanPerTahun`,`m`.`Mutasi_ID` AS `Mutasi_ID`,`m`.`SatkerAwal` AS `SatkerAwal`,`m`.`SatkerTujuan` AS `SatkerTujuan`,`m`.`Aset_ID_Tujuan` AS `Aset_ID_Tujuan`,`m`.`Status` AS `Status`,`m`.`NoSKKDH` AS `NoSKKDH`,`m`.`TglSKKDH` AS `TglSKKDH`,`m`.`NomorRegAwal` AS `NomorRegAwal`,`m`.`NomorRegbaru` AS `NomorRegbaru` from ((`view_mutasi_aset` `m` join `mesin` `mes` on((`mes`.`Aset_ID` = `m`.`Aset_ID`))) join `log_mesin` `l` on(((`m`.`Aset_ID` = `l`.`Aset_ID`) and (`l`.`Kd_Riwayat` = 3))));

-- --------------------------------------------------------

--
-- Structure for view `view_mutasi_tanah`
--
DROP TABLE IF EXISTS `view_mutasi_tanah`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_mutasi_tanah` AS select `t`.`Tanah_ID` AS `Tanah_ID`,`t`.`Aset_ID` AS `Aset_ID`,`t`.`kodeKelompok` AS `kodeKelompok`,`t`.`kodeSatker` AS `kodeSatker`,`t`.`kodeLokasi` AS `kodeLokasi`,`t`.`noRegister` AS `noRegister`,`t`.`TglPerolehan` AS `TglPerolehan`,`l`.`TglPembukuan` AS `TglPembukuan`,`t`.`kodeData` AS `kodeData`,`t`.`kodeKA` AS `kodeKA`,`t`.`kodeRuangan` AS `kodeRuangan`,if((`t`.`StatusValidasi` <> 1),1,1) AS `StatusValidasi`,if((`t`.`Status_Validasi_Barang` <> 1),1,1) AS `Status_Validasi_Barang`,if((`t`.`StatusTampil` <> 1),1,1) AS `StatusTampil`,`t`.`Tahun` AS `Tahun`,`l`.`NilaiPerolehan` AS `NilaiPerolehan`,`t`.`Alamat` AS `Alamat`,`t`.`Info` AS `Info`,`t`.`AsalUsul` AS `AsalUsul`,`t`.`kondisi` AS `kondisi`,`t`.`CaraPerolehan` AS `CaraPerolehan`,`t`.`LuasTotal` AS `LuasTotal`,`t`.`LuasBangunan` AS `LuasBangunan`,`t`.`LuasSekitar` AS `LuasSekitar`,`t`.`LuasKosong` AS `LuasKosong`,`t`.`HakTanah` AS `HakTanah`,`t`.`NoSertifikat` AS `NoSertifikat`,`t`.`TglSertifikat` AS `TglSertifikat`,`t`.`Penggunaan` AS `Penggunaan`,`t`.`BatasUtara` AS `BatasUtara`,`t`.`BatasSelatan` AS `BatasSelatan`,`t`.`BatasBarat` AS `BatasBarat`,`t`.`BatasTimur` AS `BatasTimur`,`t`.`Tmp_Hak` AS `Tmp_Hak`,`t`.`GUID` AS `GUID`,`t`.`MasaManfaat` AS `MasaManfaat`,`t`.`AkumulasiPenyusutan` AS `AkumulasiPenyusutan`,`t`.`PenyusutanPerTahun` AS `PenyusutanPerTahun`,`m`.`Mutasi_ID` AS `Mutasi_ID`,`m`.`SatkerAwal` AS `SatkerAwal`,`m`.`SatkerTujuan` AS `SatkerTujuan`,`m`.`Aset_ID_Tujuan` AS `Aset_ID_Tujuan`,`m`.`Status` AS `Status`,`m`.`NoSKKDH` AS `NoSKKDH`,`m`.`TglSKKDH` AS `TglSKKDH`,`m`.`NomorRegAwal` AS `NomorRegAwal`,`m`.`NomorRegbaru` AS `NomorRegbaru` from ((`view_mutasi_aset` `m` join `tanah` `t` on((`t`.`Aset_ID` = `m`.`Aset_ID`))) join `log_tanah` `l` on(((`m`.`Aset_ID` = `l`.`Aset_ID`) and (`l`.`Kd_Riwayat` = 3))));

-- --------------------------------------------------------

--
-- Structure for view `view_penghapusan_aset`
--
DROP TABLE IF EXISTS `view_penghapusan_aset`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_penghapusan_aset` AS select `p`.`Usulan_ID` AS `Usulan_ID`,`p`.`NoSKHapus` AS `NoSKHapus`,`p`.`TglHapus` AS `TglHapus`,`p`.`Status` AS `Status`,`a`.`Jenis_Hapus` AS `Jenis_Hapus`,`a`.`Aset_ID` AS `Aset_ID` from (`penghapusanaset` `a` left join `penghapusan` `p` on((`p`.`Penghapusan_ID` = `a`.`Penghapusan_ID`))) where (`a`.`Status` = 1);
