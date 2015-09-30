<?php
include "../../config/database.php";  
open_connection();  
		
	$term = $_GET['term'];
	$cond = "(Bidang is NOT NULL OR Bidang is NULL)  AND (Kelompok is NOT NULL OR Kelompok is NULL) AND 
			 (Sub is NOT NULL OR Sub is NULL) AND (SubSub is NOT NULL OR SubSub is NULL)";

	$sql = mysql_query("SELECT * FROM kelompok WHERE {$cond} AND (Uraian LIKE '%{$term}%' OR Kode LIKE '{$term}%') ORDER BY Kelompok_ID ASC LIMIT 30");	
	
	while ($row = mysql_fetch_assoc($sql)){
				$data[] = $row;
			}
	if(!$data){

		$data[] = array("kode"=>"","Uraian"=>"No Results Found..");
	
	}		
	
	echo json_encode($data);

exit;

?>