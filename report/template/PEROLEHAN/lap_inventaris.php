<?php
include "../../../config/config.php";
include "../../report_engine.php";

$skpd_id = $_REQUEST['kodeSatker17'];
$tgl = $_REQUEST['tglpembukuan_li'];
$kode = $_REQUEST['kodeKelompok55'];
$tipe=$_REQUEST['tipe_file'];
//pr($_REQUEST);
$paramater_url="skpd_id=$skpd_id&tgl=$tgl&kode=$kode&tipe_file=$tipe";
// echo $paramater_url;
// exit;
$REPORT=new report_engine();
$url = "report_perolehanaset_cetak_laporan_inventaris.php?$paramater_url";
$REPORT->show_pilih_download($url);  




?>
 
