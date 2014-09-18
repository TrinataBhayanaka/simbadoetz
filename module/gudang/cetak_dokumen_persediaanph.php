<?php
include "../../config/config.php";
open_connection();

$gdg_cdgperph_tahun=$_POST['gdg_cdgperph_tahun'];
$skpd_id4=$_POST['skpd_id4'];
$kelompok_id4=$_POST['kelompok_id4'];
$gdg_cdgperph_tglreport=$_POST['gdg_cdgperph_tglreport'];

echo $gdg_cdgperph_tahun;
echo $skpd_id4;
echo $kelompok_id4;
echo $gdg_cdgperph_tglreport;
?>