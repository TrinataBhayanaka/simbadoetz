<?php
include "../../../config/config.php";
include "../../report_engine.php";

// pr($_GET);
$no_kontrak = $_GET['no_kontrak]'];
$tahun = $_GET['tahun'];
$Satker_ID = $_GET['Satker_ID'];
$status = $_GET['status'];
$jns_aset = $_GET['jns_aset'];
$tipe=$_REQUEST['tipe_file'];
// pr($_REQUEST);
$paramater_url="no_kontrak=$no_kontrak&tahun=$tahun&Satker_ID=$Satker_ID&status=$status&jns_aset=$jns_aset&tipe=$tipe";
// echo $paramater_url;
// exit;
$REPORT=new report_engine();
$url = "report_perolehanaset_cetak_liat_daftar_aset.php?$paramater_url";
$REPORT->show_pilih_download_cstm($url);  




?>
 
