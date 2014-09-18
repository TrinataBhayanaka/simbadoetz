<?php
ob_start();
include "../../config/config.php";


$no_dokumen=$_POST['no_dokumen'];
$tanggal_proses=$_POST['tanggal_proses'];
$alasan=$_POST['alasan'];
$no_spbb=$_POST['no_spbb'];
$tanggal_spbb=$_POST['tgl_spbb'];
$nama_penyimpan=$_POST['nama_penyimpan'];
$nama_pengurus=$_POST['nama_pengurus'];
$pangkat_penyimpan=$_POST['pangkat_penyimpan'];
$pangkat_pengurus=$_POST['pangkat_pengurus'];
$nip_penyimpan=$_POST['nip_penyimpan'];
$nip_pengurus=$_POST['nip_pengurus'];
$nama_atasan=$_POST['nama_atasan'];
$pangkat_atasan_penyimpan=$_POST['pangkat_atasan_penyimpan'];
$nip_atasan_penyimpan=$_POST['nip_atasan_penyimpan'];
$jabatan_penyimpan=$_POST['jabatan_penyimpan'];
$transferke=$_POST['skpd_id'];
$aset=$_POST['aset'];
$fromsatker=$_POST['fromsatker'];
$count = count($aset);
for ($i=0; $i < $count; $i++)
{
list($tanggal, $bulan, $tahun) = explode('/', $tanggal_proses);
list($tgl, $bln, $thn) = explode('/', $tanggal_spbb);




$dataArr = $UPDATE->update_distribusi_barang_edit(
					$no_dokumen,
					$tanggal_proses,
					$alasan,
					$no_spbb,
					$tanggal_spbb,
					$nama_penyimpan,
					$nama_pengurus,
					$pangkat_penyimpan,
					$pangkat_pengurus,
					$nip_penyimpan,
					$nip_pengurus,
					$nama_atasan,
					$pangkat_atasan_penyimpan,
					$nip_atasan_penyimpan,
					$jabatan_penyimpan,
					$transferke,
					$aset[$i],
					$tanggal, $bulan, $tahun,
					$tgl, $bln, $thn,
					$fromsatker
					);

}
echo "<script>alert('Data Berhasil Disimpan'); document.location='distribusi_barang_daftar.php?pid=1';</script>";
// header('location:distribusi_barang.php');

?>
