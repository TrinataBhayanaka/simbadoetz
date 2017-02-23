<?php
include "../../../config/config.php";
include "../../report_engine.php";

// pr($_GET);
$tahun = $_GET['tahun'];
$jenisaset = $_GET['jenisaset'];
$kodeSatker = $_GET['kodeSatker'];
$kodepemilik = $_GET['kodepemilik'];
$kodeKelompok= $_GET['kodeKelompok'];
$statusaset=$_GET['statusaset'];

$tipe=$_REQUEST['tipe_file'];
// pr($_REQUEST);
$paramater_url ="tahun={$tahun}&jenisaset={$jenisaset}&kodeSatker={$kodeSatker}&kodepemilik={$kodepemilik}&kodeKelompok={$kodeKelompok}&statusaset={$statusaset}&tipe=$tipe";

//$paramater_url="no_kontrak=$no_kontrak&tahun=$tahun&Satker_ID=$Satker_ID&status=$status&jns_aset=$jns_aset&tipe=$tipe";
// echo $paramater_url;
// exit;
$REPORT=new report_engine();
$url = "report_perolehanaset_cetak_liat_daftar_aset.php?$paramater_url";
$REPORT->show_pilih_download_cstm($url);  




?>
 
