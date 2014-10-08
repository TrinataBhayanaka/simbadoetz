<?php
include "../../config/config.php";
open_connection();

$gdg_cdgper1_tahun=$_POST['gdg_cdgper1_tahun'];
$skpd_id3=$_POST['skpd_id3'];
$kelompok_id3=$_POST['kelompok_id3'];
$gdg_cdgper1_tglreport=$_POST['gdg_cdgper1_tglreport'];

echo $gdg_cdgper1_tahun;
echo $skpd_id3;
echo $kelompok_id3;
echo $gdg_cdgper1_tglreport;
?>