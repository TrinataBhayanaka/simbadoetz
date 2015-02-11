<?php
include "../../../config/config.php";
include "../../report_engine.php";

$modul = $_REQUEST['menuID'];
$mode = $_REQUEST['mode'];
$tab = $_REQUEST['tab'];
$skpd_id = $_REQUEST['kodeSatker10'];
$tglawalperolehan = $_REQUEST['tglPerolehanAwalLapMutasiSkpd'];
$tglakhirperolehan = $_REQUEST['tglPerolehanAkhirLapMutasiSkpd'];
$tipe=$_REQUEST['tipe_file'];
$tglcetak = $_REQUEST['tglCetakMutasiskpd'];
// pr($_REQUEST);
// exit;
$paramater_url="menuID=$modul&mode=$mode&tab=$tab&skpd_id=$skpd_id&tglawalperolehan=$tglawalperolehan&tglakhirperolehan=$tglakhirperolehan&tglcetak=$tglcetak&tipe_file=$tipe";
// echo $paramater_url;
// exit;
$REPORT=new report_engine();
$url = "report_perolehanaset_cetak_laporan_mutasi_skpd.php?$paramater_url";
$REPORT->show_pilih_download($url);  




?>
 
