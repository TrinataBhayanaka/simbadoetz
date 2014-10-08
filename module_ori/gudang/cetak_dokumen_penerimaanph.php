<?php
include "../../config/config.php";
open_connection();

$skpd_id6=$_POST['skpd_id6'];
$kelompok_id6=$_POST['kelompok_id6'];
$gdg_cdgpenph_tglawal=$_POST['gdg_cdgpenph_tglawal'];
$gdg_cdgpenphakhir=$_POST['gdg_cdgpenphakhir'];
$gdg_cp_ph_tglreport=$_POST['gdg_cp_ph_tglreport'];

echo $skpd_id6;
echo $kelompok_id6;
echo $gdg_cdgpenph_tglawal;
echo $gdg_cdgpenphakhir;
echo $gdg_cp_ph_tglreport;	 
?>