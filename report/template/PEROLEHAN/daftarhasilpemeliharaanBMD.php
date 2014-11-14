<?php
$modul = $_REQUEST['menuID'];
$mode = $_REQUEST['mode'];
$tab = $_REQUEST['tab'];
$skpd_id = $_REQUEST['skpd_id'];

$tglawalpemeliharaan=$_REQUEST['cdp_pembmd_periode1'];
$tglakhirpemeliharaan=$_REQUEST['cdp_pembmd_periode2'];
$tglpemeliharaan = $_REQUEST['tglpemeliharaan'];

include 'report_perolehanaset_cetak_daftarhasilpemeliharaanBMD.php';


?>
 
