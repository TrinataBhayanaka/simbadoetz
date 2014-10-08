<?php
include "../../config/config.php";
open_connection();

$skpd_id=$_POST['skpd_id'];
$kelompok_id=$_POST['kelompok_id'];
$gdg_cdgkar1_tglawal=$_POST['gdg_cdgkar1_tglawal'];
$gdg_cdgkar1_tglakhir=$_POST['gdg_cdgkar1_tglakhir'];
$gdg_cdgkar1_tglreport=$_POST['gdg_cdgkar1_tglreport'];

echo $skpd_id;
echo $kelompok_id;
echo $gdg_cdgkar1_tglawal;
echo $gdg_cdgkar1_tglakhir;
echo $gdg_cdgkar1_tglreport;

?>