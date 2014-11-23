<?php
include "../../config/database.php";  
open_connection();  
		
	$term = $_GET['term'];
	if($term=="") $term = "dummybabyyeah";
	$cond = "KodeSatker is NOT NULL AND KodeUnit is NOT NULL AND Gudang is NOT NULL AND Kd_Ruang is NULL";

	$sql = mysql_query("SELECT * FROM satker WHERE kode LIKE '{$term}%' ORDER BY Satker_ID ASC");	
	
	while ($row = mysql_fetch_assoc($sql)){
				$data[] = $row;
			}
	if(!$data){

		$data[] = array("kode"=>"","NamaSatker"=>"No Results Found..");
	
	}		
	
	echo json_encode($data);

exit;

?>