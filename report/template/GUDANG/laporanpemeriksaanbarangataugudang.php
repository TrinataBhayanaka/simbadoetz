<?php
$modul = $_REQUEST['menuID'];
$mode = $_REQUEST['mode'];
$tab = $_REQUEST['tab'];

$skpd_id = $_REQUEST['skpd_id'];
$tahun = $_REQUEST['tahun'];
$kelompok=$_REQUEST['kelompok'];
$tglawal=$_REQUEST['tglawal'];
$tglakhir=$_REQUEST['tglakhir'];
//$gdg_cdgkar1_tglawal = $_REQUEST['gdg_cdgkar1_tglawal'];
//$gdg_cdgkar1_tglakhir = $_REQUEST['gdg_cdgkar1_tglakhir'];
$tglTransfer = $_REQUEST['tglTransfer'];

include 'report_gudang_cetak_laporanpemeriksaanbarangataugudang.php';
?>
