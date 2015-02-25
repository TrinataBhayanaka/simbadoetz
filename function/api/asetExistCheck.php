<?php
include "../../config/database.php";  
open_connection();  
		
	$data = $_POST['data'];
	$noreg = $_POST['noreg'];

	$sql = mysql_query("SELECT COUNT(*) as total FROM aset WHERE kodeKelompok LIKE '{$data[0]}' AND kodeLokasi LIKE '{$data[1]}' AND noRegister = '{$noreg}'");
	while ($row = mysql_fetch_assoc($sql)){
		$list = $row['total'];
	}

	if($list){
		echo 1;
	}else {
		echo 0;
	}

exit;

?>