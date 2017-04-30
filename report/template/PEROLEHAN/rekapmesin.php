<?php
include "../../../config/config.php";
include "../../report_engine.php";
//pr($_REQUEST);
$modul = $_REQUEST['menuID'];
$mode = $_REQUEST['mode'];
$tab = $_REQUEST['tab'];
$skpd_id = $_REQUEST['kodeSatker50'];
$tglawalperolehan = $_REQUEST['tglPerolehanAwalrekapmesin'];
$tglakhirperolehan = $_REQUEST['tglPerolehanAkhirrekapmesin'];
// pr($_REQUEST);
$paramater_url="menuID=$modul&mode=$mode&tab=$tab&skpd_id=$skpd_id&tglawalperolehan=$tglawalperolehan&tglakhirperolehan=$tglakhirperolehan&tipe_file=$tipe";
// echo $paramater_url;
// exit;
$REPORT=new report_engine();
$url = "report_rekap_mesin.php?$paramater_url";
$REPORT->show_pilih_download_detail($url);  




?>
 
