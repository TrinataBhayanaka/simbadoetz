<?php

include "../../../config/config.php";
include "../../report_engine.php";

//print_r($_REQUEST);
$modul 	  = $_REQUEST['menuID'];
$mode 	  = $_REQUEST['mode'];
$kelompok = $_REQUEST['kelompok_id'];
$tab 	  = $_REQUEST['tab'];
$tglawalperolehan = $_REQUEST['tglawalPerolehan_bis'];
$tglakhirperolehan = $_REQUEST['tglakhirPerolehan_bis'];;
$tglcetak = $_REQUEST['tglCetakKib'];
$skpd_id  = $_REQUEST['kodeSatker3'];
$bukuInv  = $_REQUEST['bukuInv'];
// pr($_REQUEST);
$penanda  ='1';
$tipe	  = $_REQUEST['tipe_file'];

$paramater_url="menuID=$modul&mode=$mode&tab=$tab&skpd_id=$skpd_id&tglawalperolehan=$tglawalperolehan&tglakhirperolehan=$tglakhirperolehan&kelompok_id=$kelompok&penanda=$penanda&bukuinv=$bukuInv&tglcetak=$tglcetak&tipe_file=";

$REPORT=new report_engine();
  
$url="report_perolehanaset_cetak_bukuinventarisSKPD.php?$paramater_url";
    
$REPORT->show_pilih_download($url);    

?>

 
