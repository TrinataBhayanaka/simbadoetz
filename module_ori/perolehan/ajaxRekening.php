<?php
include "../../config/database.php";  
open_connection();  
		
if ($_POST['id']){
	
	$id = $_POST['id'];

	if($_POST['idhtml'] == 'tipe'){
		$cond = "Tipe = '{$id}' AND Kelompok is not NULL AND Jenis is NULL AND Objek is NULL AND RincianObjek is NULL";
	} elseif ($_POST['idhtml'] == 'kelompok') {
		list($tipe, $kelompok) = explode(".", $id);
		$cond = "Tipe = '{$tipe}' AND Kelompok = '{$kelompok}' AND Jenis is not NULL AND Objek is NULL AND RincianObjek is NULL";
	} elseif ($_POST['idhtml'] == 'jenis') {
		list($tipe, $kelompok, $jenis) = explode(".", $id);
		$cond = "Tipe = '{$tipe}' AND Kelompok = '{$kelompok}' AND Jenis = '{$jenis}' AND Objek is not NULL AND RincianObjek is NULL";
	} elseif ($_POST['idhtml'] == 'objek') {
		list($tipe, $kelompok, $jenis, $objek) = explode(".", $id);
		$cond = "Tipe = '{$tipe}' AND Kelompok = '{$kelompok}' AND Jenis = '{$jenis}' AND Objek = '{$objek}' AND RincianObjek is not NULL";
	}

	$sql = mysql_query("SELECT * FROM koderekening WHERE {$cond} ORDER BY KodeRekening_ID DESC");	
	
	while ($row = mysql_fetch_assoc($sql)){
				$data[] = $row;
			}

	echo json_encode($data);
}
exit;

?>