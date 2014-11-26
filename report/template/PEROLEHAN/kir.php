<?php
include "../../../config/config.php";
include "../../report_engine.php";
$modul = $_REQUEST['menuID'];
$mode = $_REQUEST['mode'];
$tglperolehan = $_REQUEST['tglPerolehan_kir'];
$tab = $_REQUEST['tab'];
$skpd_id = $_REQUEST['kodeSatker2'];
$kir = $_REQUEST['kir'];
// pr($_REQUEST);
$paramater_url="menuID=$modul&mode=$mode&tab=$tab&skpd_id=$skpd_id&tglperolehan=$tglperolehan&kir=$kir&tipe_file=$tipe";
$REPORT=new report_engine();
$url = "report_perolehanaset_cetak_kir.php?$paramater_url";
$REPORT->show_pilih_download($url);  




?>
 
