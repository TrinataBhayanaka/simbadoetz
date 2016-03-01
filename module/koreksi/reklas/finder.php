<?php
	
	include "../../../config/config.php";

	$tabel = $_GET['tbl'];
	$idname = $_GET['id'];

	$status=exec("php rekonstruksi_reklas.php $tabel $idname > ../../../log/rekonstruksi_reklas.txt 2>&1 &");

	echo "======== DONE BRO ============";
	exit;
?>