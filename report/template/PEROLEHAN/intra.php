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
$Flag = $_REQUEST['Flag2'];
//pr($_REQUEST);
$paramater_url="menuID=$modul&mode=$mode&tab=$tab&skpd_id=$skpd_id&tglawalperolehan=$tglawalperolehan&tglakhirperolehan=$tglakhirperolehan&intra=$intra&tglcetak=$tglcetak&Flag=$Flag&tipe_file=$tipe";
$REPORT=new report_engine();
if($Flag == 1){
	$url = "report_perolehanaset_cetak_bukuinventarisIntra.php?$paramater_url";
}else{
	$url = "report_perolehanaset_cetak_bukuinventarisIntraRev.php?$paramater_url";
}

$REPORT->show_pilih_download($url);  




?>
 
