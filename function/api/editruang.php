<?php
include "../../config/database.php";  
open_connection();  
		
	$id = $_POST['id'];
	
	$sql = mysql_query("SELECT NamaSatker FROM satker WHERE Satker_ID = '{$id}' ");
	
	while ($row = mysql_fetch_assoc($sql)){
				$data = $row;
			}
		echo $data['NamaSatker'];

	exit;

?>