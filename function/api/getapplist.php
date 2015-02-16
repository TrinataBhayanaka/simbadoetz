<?php
include "../../config/database.php";  
open_connection();  

	$UserNm = $_POST['UserNm'];
	$act = $_POST['act'];
	$sess = $_POST['sess'];

	//final
	$sql = mysql_query("SELECT aset_list FROM apl_userasetlist WHERE UserNm = '{$UserNm}' AND aset_action = '{$act}' AND UserSes = '{$sess}' LIMIT 1");
	while ($row = mysql_fetch_assoc($sql)){
		$data = $row;
	}
	
	echo json_encode($data);

exit;

?>