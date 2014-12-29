<?php
include "../../../config/config.php";
include "../../report_engine.php";

$modul = $_REQUEST['menuID'];
$mode = $_REQUEST['mode'];
$tab = $_REQUEST['tab'];
$tglawalperolehan = $_REQUEST['tglPerolehan_awal_intra'];
$tglakhirperolehan = $_REQUEST['tglPerolehan_akhir_intra'];
$tglcetak = $_REQUEST['tglCetakIntra'];
$skpd_id = $_REQUEST['kodeSatker11'];
$intra = $_REQUEST['intra'];
// pr($_REQUEST);
$paramater_url="menuID=$modul&mode=$mode&tab=$tab&skpd_id=$skpd_id&tglawalperolehan=$tglawalperolehan&tglakhirperolehan=$tglakhirperolehan&intra=$intra&tglcetak=$tglcetak&tipe_file=$tipe";
$REPORT=new report_engine();
$url = "report_perolehanaset_cetak_bukuinventarisIntra.php?$paramater_url";
$REPORT->show_pilih_download($url);  




?>
 
