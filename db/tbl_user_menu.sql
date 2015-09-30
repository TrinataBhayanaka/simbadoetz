-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 15, 2015 at 12:12 PM
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
-- Table structure for table `tbl_user_menu`
--

CREATE TABLE IF NOT EXISTS `tbl_user_menu` (
`menuID` int(2) NOT NULL,
  `menuDesc` varchar(50) DEFAULT NULL,
  `menuParent` int(2) DEFAULT NULL,
  `menuPath` varchar(100) DEFAULT NULL,
  `menuStatus` int(11) NOT NULL,
  `menuAksesLogin` int(11) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=65 ;

--
-- Dumping data for table `tbl_user_menu`
--

INSERT INTO `tbl_user_menu` (`menuID`, `menuDesc`, `menuParent`, `menuPath`, `menuStatus`, `menuAksesLogin`) VALUES
(1, 'Lihat Daftar Aset', 1, 'layanan/lihat_aset_filter.php', 1, 1),
(2, 'Buat Standar Harga Barang', 2, 'perencanaan/shb_filter.php', 0, 0),
(3, 'Buat Standar Harga Pemeliharaan', 2, 'perencanaan/shpb_filter.php', 0, 0),
(4, 'Buat Standar Kebutuhan Barang', 2, 'perencanaan/skb_filter.php', 0, 0),
(5, 'Buat RKB', 2, 'perencanaan/rkb_filter.php', 0, 0),
(6, 'Buat RKPB', 2, 'perencanaan/rkpb_filter.php', 0, 0),
(7, 'Buat RTB', 2, 'perencanaan/rtb_filter.php', 0, 0),
(8, 'Buat RTPB', 2, 'perencanaan/rtpb_filter.php', 0, 0),
(63, 'Pemeliharaan', 18, 'pemeliharaan/pemeliharaan_filter.php', 1, 1),
(10, 'Kontrak', 3, 'perolehan/kontrak_simbada.php', 1, 1),
(13, 'Cetak Dokumen Pengadaan', 3, 'perolehan/cetak_dokumen_pengadaan.php', 1, 1),
(14, 'Cetak Dokumen Inventaris', 3, 'perolehan/cetak_dokumen_inventaris.php', 1, 1),
(15, 'Distribusi Barang', 4, 'gudang/distribusi_barang.php', 1, 1),
(16, 'Validasi', 4, 'gudang/validasi.php', 1, 1),
(18, 'Cetak Dokumen Gudang', 4, 'gudang/cetak_dokumen_gudang.php', 1, 1),
(21, 'Koreksi Data Aset', 6, 'koreksi/koreksi_data_aset.php', 1, 1),
(22, 'Transfer Antar SKPD', 7, 'mutasi/transfer_antar_skpd.php', 1, 1),
(23, 'Cetak Dokumen Mutasi', 7, 'mutasi/cetak_dokumen_mutasi.php', 1, 1),
(24, 'Laporan Mutasi Barang SKPD Semesteran', 7, 'mutasi/laporan_mutasi_barang_skpd_semesteran.php', 1, 1),
(25, 'Daftar Mutasi Barang SKPD Tahunan', 7, 'mutasi/daftar_mutasi_barang_skpd_tahunan.php', 1, 1),
(26, 'Rekapitulasi LMB Daerah Semesteran', 7, 'mutasi/rekapitulasi_lmb_daerah_semesteran.php', 1, 1),
(27, 'Rekapitulasi DMB Daerah Tahunan', 7, 'mutasi/rekapitulasi_dmb_daerah_tahunan.php', 1, 1),
(28, 'Entri Hasil Inventarisasi', 8, 'inventarisasi/entri/entri_hasil_inventarisasi.php', 1, 1),
(29, 'Cetak Laporan Inventarisasi', 8, 'inventarisasi/cetak/cetak_laporan_inventarisasi.php', 1, 1),
(30, 'Penetapan Penggunaan', 9, 'penggunaan/penggunaan_penetapan_filter.php', 1, 1),
(31, 'Validasi', 9, 'penggunaan/penggunaan_validasi_filter.php', 1, 1),
(33, 'Daftar Usulan Pemanfaatan', 10, 'pemanfaatan/pemanfaatan_usulan_filter.php', 1, 1),
(34, 'Penetapan Pemanfaatan', 10, 'pemanfaatan/pemanfaatan_penetapan_filter.php', 1, 1),
(35, 'Validasi', 10, 'pemanfaatan/pemanfaatan_validasi_filter.php', 1, 1),
(36, 'Pengambilan Pemanfaatan', 10, 'pemanfaatan/pemanfaatan_pengembalian_filter.php', 1, 1),
(37, 'Cetak Daftar Pemanfaatan', 10, 'pemanfaatan/pemanfaatan_cetak_filter.php', 1, 1),
(38, 'Usulan Penghapusan Pemindahtanganan', 11, 'penghapusan/dftr_usulan_pmd.php', 1, 1),
(39, 'Usulan Penghapusan Pemusnahan', 11, 'penghapusan/dftr_usulan_pms.php', 1, 1),
(41, 'Penetapan Penghapusan', 11, 'penghapusan/penetapan_penghapusan_filter.php', 1, 1),
(42, 'Validasi ', 11, 'penghapusan/validasi_filter.php', 0, 0),
(55, 'Daftar Usulan Pemindahtanganan', 12, 'pemindahtanganan/pemindahtanganan.php', 0, 1),
(43, 'Penetapan Pemindahtanganan', 12, 'pemindahtanganan/penetapan_pemindahtanganan.php', 0, 1),
(44, 'Validasi', 12, 'pemindahtanganan/validasi_pemindahtanganan.php', 0, 1),
(45, 'Cetak Daftar Pemindahtanganan', 12, 'pemindahtanganan/cetak_daftar_pemindahtanganan.php', 0, 1),
(46, 'Daftar Usulan Pemusnahan', 13, 'pemusnahan/daftar_usulan_pemusnahan_filter.php', 0, 1),
(47, 'Penetapan Pemusnahan Filter', 13, 'pemusnahan/penetapan_pemusnahan_filter.php', 0, 1),
(48, 'Validasi', 13, 'pemusnahan/validasi_pemusnahan_filter.php', 0, 1),
(49, 'Cetak Daftar Pemusnahan', 13, 'pemusnahan/cetak_daftar_pemusnahan_filter.php', 0, 1),
(50, 'Entri Hasil Penilaian', 14, 'penilaian/entri_penilaian_filter.php', 0, 0),
(51, 'Katalog Aset', 15, 'katalog/katalog_aset.php', 0, 0),
(52, 'GIS', 16, 'gis/gis.php', 0, 0),
(53, 'Penyusutan', 17, 'penyusutan/index.php', 1, 1),
(40, 'Usulan Penghapusan Sebagian', 11, 'penghapusan/dftr_usulan_psb.php', 1, 1),
(57, 'Validasi Transfer Antar SKPD', 7, 'mutasi/validasi_transfer_antar_skpd.php', 1, 1),
(58, 'Ubah Data', 6, 'koreksi/ubah_data_aset.php', 1, 1),
(59, 'KIR', 3, 'kir/filter_ruangan.php', 1, 1),
(60, 'Rencana Pengadaan', 2, 'perencanaan/rencana/prcn_pengadaan_tambah.php', 1, 1),
(61, 'Rencana Pemeliharaan', 2, 'perencanaan/rencana/prcn_pemeliharaan_filter_rev.php', 1, 1),
(62, 'Cetak Dokumen Perencanaan', 2, 'perencanaan/rencana/cetak_dokumen_perencanaan.php', 1, 1),
(64, 'Penyusutan Custom', 17, 'penyusutan/dftr_usulan_pnystn.php', 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_user_menu`
--
ALTER TABLE `tbl_user_menu`
 ADD PRIMARY KEY (`menuID`), ADD KEY `menuID` (`menuID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_user_menu`
--
ALTER TABLE `tbl_user_menu`
MODIFY `menuID` int(2) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=65;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
