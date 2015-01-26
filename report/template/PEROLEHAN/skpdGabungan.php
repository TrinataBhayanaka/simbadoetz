<?php

include "../../../config/config.php";
include "../../report_engine.php";

//print_r($_REQUEST);
$modul 	  = $_REQUEST['menuID'];
$mode 	  = $_REQUEST['mode'];
$kelompok = $_REQUEST['kelompok_id3'];
$tab 	  = $_REQUEST['tab'];
$tglawalperolehan = $_REQUEST['tglawalPerolehan_bisgab'];
$tglakhirperolehan = $_REQUEST['tglakhirPerolehan_bisgab'];;
$tglcetak = $_REQUEST['tglCetakBivgab'];
$skpd_id  = $_REQUEST['kodeSatker15'];
$bukuInvGab  = $_REQUEST['bukuInvGab'];
$pemilik = $_REQUEST['pemilik']; 
// exit;
$penanda  ='1';
$tipe	  = $_REQUEST['tipe_file'];

$paramater_url="menuID=$modul&mode=$mode&tab=$tab&skpd_id=$skpd_id&tglawalperolehan=$tglawalperolehan&tglakhirperolehan=$tglakhirperolehan&kelompok_id=$kelompok&penanda=$penanda&bukuInvGab=$bukuInvGab&pemilik=$pemilik&tglcetak=$tglcetak&tipe_file=";

$REPORT=new report_engine();
  
$url="report_perolehanaset_cetak_bukuinventarisSKPDGab.php?$paramater_url";
    
$REPORT->show_pilih_download($url);    

?>

 
