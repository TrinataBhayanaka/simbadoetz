<?php
$modul = $_REQUEST['menuID'];
$mode = $_REQUEST['mode'];
$skpd_id = $_REQUEST['skpd_id'];
$tab = $_REQUEST['tab'];

$tahun = $_REQUEST['tahun'];
$kelompok=$_REQUEST['kelompok'];

$tglawal = $_REQUEST['tglawal'];
$tglakhir = $_REQUEST['tglakhir'];

$tglTransfer = $_REQUEST['tglTransfer'];

include 'report_gudang_cetak_kartubaranginventaris.php';
?>
