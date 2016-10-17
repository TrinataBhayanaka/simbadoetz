<?php
include "../../config/database.php";  
open_connection();  
	
	$NamaJabatan = $_POST['NamaJabatan'];
	$tahun = $_POST['tahun'];
	$satker = $_POST['satker'];

	$sql = mysql_query("SELECT COUNT(*) as total FROM pejabat WHERE 
		NamaJabatan ='{$NamaJabatan}' AND Satker_ID = '{$satker}' 
		AND Tahun = '{$tahun}'");
	while ($row = mysql_fetch_assoc($sql)){
		$list = $row['total'];
	}
	//exit;
	// echo json_encode($list);
	if($list){
		echo 1;
	}else {
		echo 0;
	}

exit;

?>