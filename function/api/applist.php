<?php
include "../../config/database.php";  
open_connection();  
		
	$data = $_POST['data'];
	$UserNm = $_POST['UserNm'];
	$act = $_POST['act'];
	$sess = $_POST['sess'];

	$sql = "DELETE FROM apl_userasetlist WHERE UserNm = '{$UserNm}' AND aset_action = '{$act}' AND UserSes = '{$sess}'";
	$exec = mysql_query($sql);

	$sql = "INSERT INTO apl_userasetlist (UserNm,aset_action,aset_list,UserSes) VALUES ('{$UserNm}','{$act}','{$data}','{$sess}')";
	
	$exec = mysql_query($sql);
	
	echo 1;

exit;

?>