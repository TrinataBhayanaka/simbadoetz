<?php
include "../../../config/config.php";
include "../../report_engine.php";

$modul = $_REQUEST['menuID'];
$mode = $_REQUEST['mode'];
$tab = $_REQUEST['tab'];
$tahun = $_REQUEST['tahun_rencana'];
$skpd_id = $_REQUEST['kodeSatker'];
$tglcetak = $_REQUEST['tglCetakPengadaan'];
// pr($_REQUEST);
$paramater_url="menuID=$modul&mode=$mode&tab=$tab&skpd_id=$skpd_id&tahun=$tahun&tglcetak=$tglcetak&tipe_file=$tipe";
$REPORT=new report_engine();
$url = "report_perencanaan_cetak_pengadaan_barang.php?$paramater_url";
$REPORT->show_pilih_download($url);  

?>
 
