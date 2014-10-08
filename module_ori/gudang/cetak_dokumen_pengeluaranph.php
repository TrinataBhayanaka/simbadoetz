<?php
include "../../config/config.php";
open_connection();

$skpd_id8=$_POST['skpd_id8'];
$kelompok_id8=$_POST['kelompok_id8'];
$gdg_cdg_pegph_tglawal=$_POST['gdg_cdg_pegph_tglawal'];
$gdg_cdg_pegph_tglakhir=$_POST['gdg_cdg_pegph_tglakhir'];
$gdg_cd_pegph_tglreport=$_POST['gdg_cd_pegph_tglreport'];

echo $skpd_id8;
echo $kelompok_id8;
echo $gdg_cdg_pegph_tglawal;
echo $gdg_cdg_pegph_tglakhir;
echo $gdg_cd_pegph_tglreport;
?>