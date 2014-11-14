<?php

include "../../../config/config.php";
include "../../report_engine.php";

//print_r($_REQUEST);
$modul = $_REQUEST['menuID'];
$mode = $_REQUEST['mode'];
$kelompok = $_REQUEST['kelompok_id2'];
$tahun = $_REQUEST['tahun_buku_induk_inventaris'];
$tab = $_REQUEST['tab'];
$tipe	=$_REQUEST['tipe_file'];

$paramater_url="menuID=$modul&mode=$mode&tab=$tab&tahun_buku_induk_inventaris=$tahun&kelompok_id2=$kelompok&tipe_file=";

$REPORT=new report_engine();
  
$url="report_perolehanaset_cetak_bukuindukinventarisdaerah.php?$paramater_url";
//include 'report_perolehanaset_cetak_kiba.php';
//echo "<script>window.location.href='$namafile_web';</script>";
    
$REPORT->show_pilih_download($url);    
/*echo "Download File $kib A tersedia dalam bentuk:<br/>";
echo "1. <a href=\"$url"."1\">PDF</a><br/>";
echo "2. <a href=\"$url"."2\">Micorosoft Excel</a>";
*/


?>

 
