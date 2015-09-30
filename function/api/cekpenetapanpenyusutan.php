<?php
include "../../config/database.php";  
open_connection();  
		
	$tahun = $_POST['tahun'];
	$kodesatker = $_POST['kodesatker'];
	$sql = mysql_query("SELECT count(1) as jml FROM penyusutan WHERE SatkerUsul = '{$kodesatker}' AND YEAR(TglPenyusutan) = {$tahun} ");
	
	while ($row = mysql_fetch_assoc($sql)){
				$data = $row;
			}
		echo $data['jml'];

	exit;

?>