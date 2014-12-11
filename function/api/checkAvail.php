<?php
include "../../config/database.php";  
open_connection();

	$value = $_POST['value'];

	if ($_POST['value']){
		$sql = mysql_query("SELECT count(*) AS total FROM kontrak WHERE noKontrak = '{$value}'");
		while ($row = mysql_fetch_assoc($sql)){
				$data = $row;
			}
		echo $data['total'];	
	}
	exit;
?>