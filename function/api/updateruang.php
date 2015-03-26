<?php
include "../../config/database.php";  
open_connection();  
		
	$NamaSatker = $_POST['ruangan'];
	$Satker_ID = $_POST['id'];
	$sql = mysql_query("UPDATE satker SET NamaSatker ='{$NamaSatker}' 
						WHERE Satker_ID = '{$Satker_ID}'");
	echo 1;

	exit;

?>