<?php
$modul = $_REQUEST['menuID'];
$mode = $_REQUEST['mode'];
$tab = $_REQUEST['tab'];
$tahun = $_REQUEST['tahun'];
$skpd_id = $_REQUEST['skpd_id'];
$lokasi = $_REQUEST['lokasi'];
$kelompok=$_REQUEST['kelompok'];

include 'report_perencanaan_cetak_rtpb.php';
?>
