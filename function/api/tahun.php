<?php
include "../../config/database.php";  
open_connection();  
		
	$term = $_GET['term'];
	$sess = $_GET['sess'];
	if($sess=="") $limit = "LIMIT 10"; else $limit="";
	$cond = "Tahun is NOT NULL AND Tahun != 0 AND";
	if($_GET['free'] == 0) $cond = "";
	$sql = mysql_query("SELECT distinct(Tahun) FROM satker WHERE {$cond} Kd_Ruang IS NOT NULL AND kode LIKE '{$sess}%' AND (Tahun LIKE '{$term}%' OR Tahun LIKE '%{$term}%') ORDER BY Satker_ID ASC {$limit}");	
	// $sql_pr = ("SELECT distinct(Tahun) FROM satker WHERE {$cond} Kd_Ruang IS NOT NULL AND kode LIKE '{$sess}%' AND (Tahun LIKE '{$term}%' OR Tahun LIKE '%{$term}%') ORDER BY Satker_ID ASC {$limit}");	
	// echo "sql =".$sql_pr; 
	while ($row = mysql_fetch_assoc($sql)){
				$data[] = $row;
			}
	// print_r($data);		
	if(!$data){

		$data[] = array("Tahun"=>"No Results Found..");
	
	}		
	
	echo json_encode($data);

exit;

?>