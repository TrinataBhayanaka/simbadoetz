<?php

include "../../../config/config.php";
include "../../report_engine.php";

//print_r($_REQUEST);
$modul = $_REQUEST['menuID'];
$mode = $_REQUEST['mode'];
$kelompok = $_REQUEST['kelompok_id2'];
$tglperolehan = $_REQUEST['tglPerolehan_biid'];
$tab = $_REQUEST['tab'];
$tipe	=$_REQUEST['tipe_file'];
$bukuIndk  = $_REQUEST['bukuIndk'];
// pr($_REQUEST);
$paramater_url="menuID=$modul&mode=$mode&tab=$tab&tglperolehan=$tglperolehan&kelompok_id2=$kelompok&bukuIndk=$bukuIndk&&tipe_file=";

$REPORT=new report_engine();
  
$url="report_perolehanaset_cetak_bukuindukinventarisdaerah.php?$paramater_url";
    
$REPORT->show_pilih_download($url);    



?>

 
