<?php
include "../../../config/config.php";
include "../../report_engine.php";

$modul = $_REQUEST['menuID'];
$mode = $_REQUEST['mode'];
$tab = $_REQUEST['tab'];
$tglperolehan=$_REQUEST['tglPerolehan_intra'];
$skpd_id = $_REQUEST['kodeSatker5'];
$intra = $_REQUEST['intra'];
// pr($_REQUEST);
$paramater_url="menuID=$modul&mode=$mode&tab=$tab&skpd_id=$skpd_id&tglperolehan=$tglperolehan&intra=$intra&tipe_file=$tipe";
$REPORT=new report_engine();
$url = "report_perolehanaset_cetak_bukuinventarisIntra.php?$paramater_url";
$REPORT->show_pilih_download($url);  




?>
 
