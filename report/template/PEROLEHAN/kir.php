<?php
include "../../../config/config.php";
include "../../report_engine.php";
$modul = $_REQUEST['menuID'];
$mode = $_REQUEST['mode'];
$tglawalperolehan = $_REQUEST['tglPerolehan_awal_kir'];
$tglakhirperolehan = $_REQUEST['tglPerolehan_akhir_kir'];
$tglcetak = $_REQUEST['tglCetakKir'];
$tab = $_REQUEST['tab'];
$skpd_id = $_REQUEST['kodeSatker2'];
$kodeRuangan = $_REQUEST['kodeRuangan'];
$pemilik = $_REQUEST['pemilik'];
$kir = $_REQUEST['kir'];
// pr($_REQUEST);
$paramater_url="menuID=$modul&mode=$mode&tab=$tab&skpd_id=$skpd_id&pemilik=$pemilik&tglawalperolehan=$tglawalperolehan&tglakhirperolehan=$tglakhirperolehan&kodeRuangan=$kodeRuangan&kir=$kir&tglcetak=$tglcetak&tipe_file=$tipe";
$REPORT=new report_engine();
$url = "report_perolehanaset_cetak_kir.php?$paramater_url";
$REPORT->show_pilih_download($url);  




?>
 
