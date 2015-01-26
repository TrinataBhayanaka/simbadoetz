<?php
include "../../config/database.php";  
open_connection();  
		
	$term = $_POST['term'];
	$sess = $_POST['sess'];
	list($tahun,$kode) = explode("_", $sess);

	if($term=="") $term = "dummybabyyeah";
	$cond = "Kd_Ruang IS NOT NULL";

	$sql = mysql_query("SELECT NamaSatker FROM satker WHERE {$cond} AND  kode LIKE '{$term}%' AND Tahun = '{$tahun}' AND Kd_Ruang = '{$kode}' ORDER BY Satker_ID ASC");	
	while ($row = mysql_fetch_assoc($sql)){
				$data = $row;
			}
	
	echo $data['NamaSatker'];

exit;

?>