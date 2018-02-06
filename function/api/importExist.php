<?php
include "../../config/database.php";  
open_connection();  
	
	$tahun = $_POST['tahun'];
	$KodeSatker = $_POST['KodeSatker'];
	/*$sql = "SELECT COUNT(*) as total FROM rencana WHERE 
		Kode_Satker = '{$KodeSatker}' 
		AND Tahun = '{$tahun}'";
	pr($sql);*/	
	$sql = mysql_query("SELECT COUNT(*) as total FROM rencana WHERE 
		Kode_Satker = '{$KodeSatker}' 
		AND Tahun = '{$tahun}'");
	while ($row = mysql_fetch_assoc($sql)){
		$list = $row['total'];
	}
	//exit;
	// echo json_encode($list);
	if($list == 0){
		echo 0;
	}else {
		echo 1;
	}

exit;

?>