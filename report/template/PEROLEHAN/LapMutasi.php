<?php
include "../../../config/config.php";
include "../../report_engine.php";

$modul = $_REQUEST['menuID'];
$mode = $_REQUEST['mode'];
$tab = $_REQUEST['tab'];
$tglawalperolehan = $_REQUEST['tglPerolehanAwalLapMutasi'];
$tglakhirperolehan = $_REQUEST['tglPerolehanAkhirLapMutasi'];
$skpd_id = $_REQUEST['kodeSatker9'];
$tglcetak = $_REQUEST['tglCetakMutasi'];
// pr($_REQUEST);
$paramater_url="menuID=$modul&mode=$mode&tab=$tab&skpd_id=$skpd_id&tglawalperolehan=$tglawalperolehan&tglakhirperolehan=$tglakhirperolehan&tglcetak=$tglcetak&tipe_file=$tipe";
$REPORT=new report_engine();
$url = "report_perolehanaset_cetak_laporan_mutasi.php?$paramater_url";
$REPORT->show_pilih_download($url);  




?>
 
