<?php
include "../../config/database.php";  
open_connection();  
	
	$satker = $_POST['satker'];
	$kode = $_POST['kode'];
	$tahun = $_POST['tahun'];
	$sql = mysql_query("SELECT COUNT(*) as total FROM 	penyusutan_tahun_berjalan WHERE kodeSatker ='{$satker}' AND KelompokAset like '{$kode}%' AND Tahun = '{$tahun}'");
	while ($row = mysql_fetch_assoc($sql)){
		$list = $row['total'];
	}
	// echo json_encode($list);
	if($list){
		echo 1;
	}else {
		echo 0;
	}

exit;

?>