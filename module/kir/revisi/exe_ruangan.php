<?php

include "../../../config/config.php"; 
//pr($_GET);
//exit;

/*start background process
ket : param
id = id usulan penghapusan pmd
*/
$skpd = array("01.01.01.01","04.01.01.05","04.01.09.01","07.01.01.01","07.02.01.01",
			  "08.01.01.01","09.01.01.01","10.01.01.01","10.02.01.01","13.01.01.01",
			  "15.01.01.01","19.01.01.01","21.01.01.01","50.01.02.01","50.01.03.01",
			  "50.01.10.01","50.02.04.01","50.02.09.01","50.03.08.01","50.04.02.01");
//$skpd  = "50.02.09.01";
foreach ($skpd as $value) {
	# code...
	$log = "normalisasi_ruangan_".$value;
	$status=exec("php normalisasi_ruangan.php $value > ../../../log/$log.txt 2>&1 &");
	sleep(3);
}

//$log = "normalisasi_ruangan_".$skpd;
//pr($id);
//exit;	
//$status=exec("php normalisasi_ruangan.php $skpd > ../../../log/$log.txt 2>&1 &");
/*echo "<meta http-equiv=\"Refresh\" content=\"0; url={$url_rewrite}/module/penghapusanv2/dftr_penetapan_validasi_pmd.php\">";  
    exit;*/

?>
