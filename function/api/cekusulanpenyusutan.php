<?php
include "../../config/database.php";  
open_connection();  
		
	$tahun = $_POST['tahun'];
	$kodesatker = $_POST['kodesatker'];
	$sql = mysql_query("SELECT count(1) as jml FROM usulan WHERE SatkerUsul = '{$kodesatker}' AND YEAR(TglUpdate) = {$tahun} AND Jenis_Usulan = 'PNY'");
	
	while ($row = mysql_fetch_assoc($sql)){
				$data = $row;
			}
		echo $data['jml'];

	exit;

?>