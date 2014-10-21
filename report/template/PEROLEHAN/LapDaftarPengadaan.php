<?php
include "../../../config/config.php";
include "../../report_engine.php";

$modul = $_REQUEST['menuID'];
$mode = $_REQUEST['mode'];
$tab = $_REQUEST['tab'];
$skpd_id = $_REQUEST['kodeSatkerPengadaan'];
$tglawalperolehan = $_REQUEST['tglPerolehanAwalPengadaan'];
$tglakhirperolehan = $_REQUEST['tglPerolehanAkhirPengadaan'];
$tglcetak = $_REQUEST['tglCetakPengadaan'];
$tipe=$_REQUEST['tipe_file'];
// pr($_REQUEST);
$paramater_url="tglcetak=$tglcetak&menuID=$modul&mode=$mode&tab=$tab&skpd_id=$skpd_id&tglawalperolehan=$tglawalperolehan&tglakhirperolehan=$tglakhirperolehan&tipe_file=$tipe";
// echo $paramater_url;
// exit;
$REPORT=new report_engine();
$url = "report_perolehan_daftar_pengadaan.php?$paramater_url";
$REPORT->show_pilih_download($url);  




?>
 
