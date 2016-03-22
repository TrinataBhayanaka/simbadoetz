<?php
include "../../../config/config.php";
include "../../report_engine.php";

$modul = $_REQUEST['menuID'];
$mode = $_REQUEST['mode'];
$tab = $_REQUEST['tab'];
$skpd_id = $_REQUEST['kodeSatkerRincian19'];
$tipeAset = $_REQUEST['tipeAset'];
$levelAset = $_REQUEST['levelAset'];
$tglawalperolehan = $_REQUEST['tglPerolehanAwalRekapNeraca'];
$tglakhirperolehan = $_REQUEST['tglPerolehanAkhirRekapNeraca'];
$tipe=$_REQUEST['tipe_file'];
// pr($_REQUEST);
$paramater_url="menuID=$modul&mode=$mode&tab=$tab&skpd_id=$skpd_id&levelAset=$levelAset&tipeAset=$tipeAset&tglawalperolehan=$tglawalperolehan&tglakhirperolehan=$tglakhirperolehan&tipe_file=$tipe";
// echo $paramater_url;
// exit;
$REPORT=new report_engine();
$url = "rekap_rincian_v2.php?$paramater_url";
$REPORT->show_pilih_download($url);  




?>
 
 
