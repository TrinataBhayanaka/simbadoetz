<?php
	
	include "../../../config/config.php";

	$usr = $_SESSION['ses_uoperatorid'];
	$id = $_GET['id'];
	$status=exec("php import_kibb_helper.php $usr $id > ../../inventarisasi/import/log_import/import_kib.txt 2>&1 &");
	echo "<meta http-equiv=\"Refresh\" content=\"0; url={$url_rewrite}/module/inventarisasi/import/history.php\">";    
    exit;
?>