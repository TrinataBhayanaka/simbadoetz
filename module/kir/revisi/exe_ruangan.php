<?php

include "../../../config/config.php"; 
//pr($_GET);
//exit;

/*start background process
ket : param
id = id usulan penghapusan pmd
*/
$skpd  = "50.02.09.01";
$log = "normalisasi_ruangan_".$skpd;
//pr($id);
//exit;	
$status=exec("php normalisasi_ruangan.php $skpd > ../../../log/$log.txt 2>&1 &");
/*echo "<meta http-equiv=\"Refresh\" content=\"0; url={$url_rewrite}/module/penghapusanv2/dftr_penetapan_validasi_pmd.php\">";  
    exit;*/

?>
