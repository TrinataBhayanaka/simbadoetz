<?php
include "../../config/database.php";  
open_connection();  
		
	$kodesatker = $_POST['kodesatker'];
	$ruangan = $_POST['ruangan'];

	$sql = mysql_query("DELETE FROM satker WHERE kode = '{$kodesatker}' AND Kd_Ruang = '{$ruangan}'");

	echo 1;

	exit;

?>