<?php
include "../../../config/config.php";
include "../../report_engine.php";

$modul = $_REQUEST['menuID'];
$mode = $_REQUEST['mode'];
$tab = $_REQUEST['tab'];
$skpd_id = $_REQUEST['kodeSatker1'];
$tglperolehan = $_REQUEST['tglPerolehanTanah'];
$tipe=$_REQUEST['tipe_file'];
// pr($_REQUEST);
$paramater_url="menuID=$modul&mode=$mode&tab=$tab&skpd_id=$skpd_id&tglperolehan=$tglperolehan&tipe_file=$tipe";
// echo $paramater_url;
// exit;
$REPORT=new report_engine();
$url = "report_perolehanaset_cetak_aset_tetap_tanah.php?$paramater_url";
$REPORT->show_pilih_download($url);  




?>
 
