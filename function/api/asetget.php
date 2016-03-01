<?php
include "../../config/database.php";  
open_connection();  
		
	$kode = $_POST['term'];
		
	$sql = mysql_query("SELECT Uraian FROM kelompok Where Kode = '{$kode}' LIMIT 1");

	while ($row = mysql_fetch_assoc($sql)){
				$sub = $row;
			}
	$part = explode(".", $kode);

	$sql = mysql_query("SELECT Uraian FROM kelompok Where Golongan = '{$part[0]}' LIMIT 1");

	while ($row = mysql_fetch_assoc($sql)){
				$gol = $row;
			}

	$sql = mysql_query("SELECT Uraian FROM kelompok Where Kode = '{$kode}' AND Bidang = '{$part[1]}' LIMIT 1");

	while ($row = mysql_fetch_assoc($sql)){
				$bid = $row;
			}

	$sql = mysql_query("SELECT Uraian FROM kelompok Where Golongan = '{$part[0]}' AND Bidang = '{$part[1]}' AND Kelompok = '{$part[2]}' LIMIT 1");

	while ($row = mysql_fetch_assoc($sql)){
				$kel = $row;
			}

	$sql = mysql_query("SELECT Uraian FROM kelompok Where Golongan = '{$part[0]}' AND Bidang = '{$part[1]}' AND Kelompok = '{$part[2]}' AND Sub = '{$part[3]}' LIMIT 1");

	while ($row = mysql_fetch_assoc($sql)){
				$sub = $row;
			}			
				
	$dataArr[] = array("Sub"=>$sub['Uraian'],"Kelompok"=>$kel['Uraian'],"Bidang"=>$bid['Uraian'],"Golongan"=>$gol['Uraian'],"Bidang"=>$bid['Uraian'],"Golongan"=>$gol['Uraian'],"SubSub"=>$sub['Uraian']);
	echo json_encode($dataArr);

exit;

?>