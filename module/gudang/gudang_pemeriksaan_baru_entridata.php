<?php
include "../../config/config.php";


$menu_id = 17;
$SessionUser = $SESSION->get_session_user();
$USERAUTH->FrontEnd_check_akses_menu($menu_id,$SessionUser);



$aset=$_POST['aset'];
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
$dataArr = $STORE->store_gudang_pemeriksaan_baru
		(
		$aset,
		$gdg_dbedb_nobapemeriksa,
		$gdg_dbedb_tglpemeriksa,
		$gdg_dbedb_alasanpemeriksa,
		$gdg_dbedb_nama,
		$gdg_dbedb_pangkat_gol,
		$gdg_dbedb_nip,
		$gdg_dbedb_jabatan,
		$aset_tidak_ditemukan,
		$gdg_dbedb_kondisi,
		$gdg_dbedb_tindaklanjut,
		$tanggal, $bulan, $tahun,
		$baik,
		$rusak_ringan,$rusak_berat
		);
// exit;
echo "<script>alert('Data Berhasil Disimpan');document.location='gudang_pemeriksaan_baru.php?id=$aset&pid=1';</script>";


?>