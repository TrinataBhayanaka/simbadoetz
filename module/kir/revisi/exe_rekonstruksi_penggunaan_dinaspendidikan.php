<?php

include "../../../config/config.php"; 
//pr($_GET);
//exit;

/*start background process
*/
$log = "rekonstruksi_penggunaan_DinasPendidikan_AllImport";
//pr($id);
//exit;	
$status=exec("php rekonstruksi_penggunaan_dinaspendidikan.php > ../../../log/$log.txt 2>&1 &");
/*echo "<meta http-equiv=\"Refresh\" content=\"0; url={$url_rewrite}/module/penghapusanv2/dftr_penetapan_validasi_pmd.php\">";  
    exit;*/

?>
