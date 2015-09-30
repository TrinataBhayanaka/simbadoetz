<?php
include "../../../config/config.php";
include "../../report_engine.php";

$modul = $_REQUEST['menuID'];
$mode = $_REQUEST['mode'];
$tab = $_REQUEST['tab'];
$tanggalAwal = $_REQUEST['TanggalAwal'];
$tanggalAkhir = $_REQUEST['TanggalAkhir'];
$skpd_id = $_REQUEST['kodeSatker2'];
$tglcetak = $_REQUEST['tglCetakPemeliharaan'];
// pr($_REQUEST);
$paramater_url="menuID=$modul&mode=$mode&tab=$tab&skpd_id=$skpd_id&tanggalAwal=$tanggalAwal&tanggalAkhir=$tanggalAkhir&tglcetak=$tglcetak&tipe_file=$tipe";
$REPORT=new report_engine();
$url = "report_perencanaan_cetak_pemeliharaan_barang.php?$paramater_url";
$REPORT->show_pilih_download($url);  

?>
 
