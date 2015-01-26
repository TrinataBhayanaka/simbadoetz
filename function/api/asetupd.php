<?php
include "../../config/database.php";  
open_connection();  
		
	$term = $_POST['term'];
	$cond = "Bidang is NOT NULL AND Kelompok is NOT NULL AND Sub is NOT NULL AND SubSub is NOT NULL";

	$sql = mysql_query("SELECT Uraian FROM kelompok WHERE {$cond} AND (Uraian LIKE '%{$term}%' OR Kode LIKE '{$term}%') ORDER BY Kelompok_ID ASC LIMIT 30");	
	
	while ($row = mysql_fetch_assoc($sql)){
				$data = $row;
			}	
	
	echo $data['Uraian'];

exit;

?>