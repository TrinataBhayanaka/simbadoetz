<?php

include "../../../config/config.php"; 
//pr($_GET);
//exit;

/*start background process
ket : param
id = id usulan penghapusan pmd
*/
$log = "kib_to_aset";
//pr($id);
//exit;	
$status=exec("php normalisasi_kir.php > ../../../log/$log.txt 2>&1 &");
/*echo "<meta http-equiv=\"Refresh\" content=\"0; url={$url_rewrite}/module/penghapusanv2/dftr_penetapan_validasi_pmd.php\">";  
    exit;*/

?>
