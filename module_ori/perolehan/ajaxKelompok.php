<?php
include "../../config/database.php";  
open_connection();  
		
if ($_POST['id']){
	
	$id = $_POST['id'];

	if($_POST['idhtml'] == 'golongan'){
		$cond = "Golongan = '{$id}' AND Bidang is not NULL AND Kelompok is NULL AND Sub is NULL AND SubSub is NULL";
	} elseif ($_POST['idhtml'] == 'bidang') {
		list($golongan, $bidang) = explode(".", $id);
		$cond = "Golongan = '{$golongan}' AND Bidang = '{$bidang}' AND Kelompok is not NULL AND Sub is NULL AND SubSub is NULL";
	} elseif ($_POST['idhtml'] == 'kelompok') {
		list($golongan, $bidang, $kelompok) = explode(".", $id);
		$cond = "Golongan = '{$golongan}' AND Bidang = '{$bidang}' AND Kelompok = '{$kelompok}' AND Sub is not NULL AND SubSub is NULL";
	} elseif ($_POST['idhtml'] == 'sub') {
		list($golongan, $bidang, $kelompok, $sub) = explode(".", $id);
		$cond = "Golongan = '{$golongan}' AND Bidang = '{$bidang}' AND Kelompok = '{$kelompok}' AND Sub = '{$sub}' AND SubSub is not NULL";
	}

	$sql = mysql_query("SELECT * FROM kelompok WHERE {$cond} ORDER BY Kelompok_ID DESC");	
	
	while ($row = mysql_fetch_assoc($sql)){
				$data[] = $row;
			}

	echo json_encode($data);
}
exit;

?>