<?php
include "../../config/config.php";
open_connection();

$skpd_id2=$_POST['skpd_id2'];
$kelompok_id2=$_POST['kelompok_id2'];
$gdg_cdgkarph_tglawal=$_POST['gdg_cdgkarph_tglawal'];
$gdg_cdgkarph_tglakhir=$_POST['gdg_cdgkarph_tglakhir'];
$gdg_cdgkarph_tglreport=$_POST['gdg_cdgkarph_tglreport'];

echo $skpd_id2;
echo $kelompok_id2;
echo $gdg_cdgkarph_tglawal;
echo $gdg_cdgkarph_tglakhir;
echo $gdg_cdgkarph_tglreport;

?>