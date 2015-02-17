<?php
include "../../config/database.php";  
open_connection();  

	$UserNm = $_POST['UserNm'];

	//final
	$sql = mysql_query("SELECT Sess FROM tmp_asetlain WHERE UserNm = '{$UserNm}' LIMIT 1");
	while ($row = mysql_fetch_assoc($sql)){
		$total = $row['Sess'];
	}

	// $sql = "SELECT COUNT(*) AS count FROM tmp_asetlain WHERE UserNm = '{$UserNm}'";
	// while ($row = mysql_fetch_assoc($sql)){
	// 	$count = $row['count'];
	// }

	$myfile = fopen("{$url_rewrite}/module/perolehan/import/count.txt", "r") or die("{$url_rewrite}/module/perolehan/import/count.txt");
	$data =  fread($myfile,filesize("count.txt"));
	fclose($myfile);
	
	
	echo json_encode(array('count' =>$data ,'total' =>$total ));
	

exit;

?>