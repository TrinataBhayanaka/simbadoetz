<?php
include "../../config/database.php";  
open_connection();  
		
	$term = $_GET['term'];
	$cond = "Bidang is NOT NULL AND Kelompok is NOT NULL AND Sub is NOT NULL AND SubSub is NOT NULL";

	$sql = mysql_query("SELECT * FROM kelompok WHERE {$cond} AND Uraian LIKE '%{$term}%' ORDER BY Kelompok_ID ASC LIMIT 5");	
	
	while ($row = mysql_fetch_assoc($sql)){
				$data[] = $row;
			}
	if(!$data){

		$data[] = array("kode"=>"","Uraian"=>"No Results Found..");
	
	}		
	
	echo json_encode($data);

exit;

?>