<?php
include "../../config/database.php";  
open_connection();  
		
	$term = $_GET['term'];
	$tahun = $_GET['tahun'];
	if($term=="") $term = "dummybabyyeah";
	$cond = "Kd_Ruang IS NOT NULL";

	$sql = mysql_query("SELECT * FROM satker WHERE {$cond} AND  kode LIKE '{$term}%' AND Tahun = '{$tahun}' ORDER BY Satker_ID ASC");	
	
	while ($row = mysql_fetch_assoc($sql)){
				$data[] = $row;
			}
	if(!$data){

		$data[] = array("Kd_Ruang"=>"","NamaSatker"=>"No Results Found..");
	
	}		
	
	echo json_encode($data);

exit;

?>