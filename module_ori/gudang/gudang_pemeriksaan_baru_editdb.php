<?php
include "../../config/config.php";

$aset=$_POST['aset'];
$gudang_id=$_POST['gudang_id'];
$gdg_dbedb_nobapemeriksa=$_POST['gdg_dbedb_nobapemeriksa'];
$gdg_dbedb_tglpemeriksa=$_POST['gdg_dbedb_tglpemeriksa'];
$gdg_dbedb_alasanpemeriksa=$_POST['gdg_dbedb_alasanpemeriksa'];
$gdg_dbedb_nama=$_POST['gdg_dbedb_nama'];
$gdg_dbedb_pangkat_gol=$_POST['gdg_dbedb_pangkat_gol'];
$gdg_dbedb_nip=$_POST['gdg_dbedb_nip'];
$gdg_dbedb_jabatan=$_POST['gdg_dbedb_jabatan'];
$aset_tidak_ditemukan=$_POST['aset_tidak_ditemukan'];
$gdg_dbedb_kondisi=$_POST['gdg_dbedb_kondisi'];
$gdg_dbedb_tindaklanjut=$_POST['gdg_dbedb_tindaklanjut'];

if($gdg_dbedb_kondisi=="-")
{
$baik=0;
$rusak_ringan=0;
$rusak_berat=0;
}
elseif ($gdg_dbedb_kondisi=="Baik")
{
$baik=1;
$rusak_ringan=0;
$rusak_berat=0;
}
elseif ($gdg_dbedb_kondisi=="Rusak Ringan")
{
$baik=0;
$rusak_ringan=1;
$rusak_berat=0;
}

elseif ($gdg_dbedb_kondisi=="Rusak Berat")
{
$baik=0;
$rusak_ringan=0;
$rusak_berat=1;
}

if($aset_tidak_ditemukan=='on')
$aset_tidak_ditemukan=1;
else $aset_tidak_ditemukan=0;

list($tanggal, $bulan, $tahun) = explode('/', $gdg_dbedb_tglpemeriksa);

$dataArr = $UPDATE->update_pemeriksaan_gudang_edit
		(
		$aset,
		$gudang_id,
		$gdg_dbedb_nobapemeriksa,
		$gdg_dbedb_tglpemeriksa,
		$gdg_dbedb_alasanpemeriksa,
		$gdg_dbedb_nama,
		$gdg_dbedb_pangkat_gol,
		$gdg_dbedb_nip,
		$gdg_dbedb_jabatan,
		$aset_tidak_ditemukan,
		$baik,
		$rusak_ringan,
		$rusak_berat,
		$gdg_dbedb_tindaklanjut,
		$tanggal, $bulan, $tahun
		);
echo "<script>alert('Data Berhasil Disimpan')</script>";
echo "<script>document.location='gudang_pemeriksaan_baru.php?id=$aset&pid=1';</script>";


?>