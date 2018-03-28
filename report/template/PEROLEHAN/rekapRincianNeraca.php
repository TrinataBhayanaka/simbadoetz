<?php
include "../../../config/config.php";
include "../../report_engine.php";

$modul = $_REQUEST['menuID'];
$mode = $_REQUEST['mode'];
$tab = $_REQUEST['tab'];
$skpd_id = $_REQUEST['kodeSatker18'];
$tipeAset = $_REQUEST['tipeAset'];
$levelAset = $_REQUEST['levelAset'];
$tglawalperolehan = $_REQUEST['tglPerolehanAwalRekapNeraca'];
$tglakhirperolehan = $_REQUEST['tglPerolehanAkhirRekapNeraca'];
$tipe=$_REQUEST['tipe_file'];
$flag=$_REQUEST['Flag'];
// pr($_REQUEST);
$paramater_url="menuID=$modul&mode=$mode&tab=$tab&skpd_id=$skpd_id&levelAset=$levelAset&tipeAset=$tipeAset&tglawalperolehan=$tglawalperolehan&tglakhirperolehan=$tglakhirperolehan&tipe_file=$tipe";
// echo $paramater_url;
// exit;
$REPORT=new report_engine();
if($flag == 1){
	$url = "report_perolehanaset_cetak_rekap_rincian_neraca.php?$paramater_url";
}else{
	$url = "report_perolehanaset_cetak_rekap_rincian_neraca_v2.php?$paramater_url";
}
$REPORT->show_pilih_download($url);  




?>
 
