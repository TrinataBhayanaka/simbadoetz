<?php
include "../../config/database.php";  
open_connection();  
		
	$data = $_POST['data'];
	$undata = $_POST['undata'];
	$UserNm = $_POST['UserNm'];
	$act = $_POST['act'];
	$sess = $_POST['sess'];

	$sql = mysql_query("SELECT aset_list FROM apl_userasetlist WHERE UserNm = '{$UserNm}' AND aset_action = '{$act}' AND UserSes = '{$sess}' LIMIT 1");
	while ($row = mysql_fetch_assoc($sql)){
		$list = $row['aset_list'];
	}
	
	if(count($list) == 0){
		$sql = "INSERT INTO apl_userasetlist (UserNm,aset_action,aset_list,UserSes) VALUES ('{$UserNm}','{$act}','{$data}','{$sess}')";
	
		$exec = mysql_query($sql);	
	} else {
			$newlist = explode(",", $data);
			foreach ($newlist as $key => $value) {
				$temp = explode("|", $value);
				
			}
			$dtlist = explode(",", $list);
			$result = array_diff($newlist, $dtlist);

			if(count($result) != 0){
				$arrlist = array_merge($dtlist, $result);
				$list = implode(",", $arrlist);
				
				$sql = "UPDATE apl_userasetlist SET aset_list = '{$list}' WHERE UserNm = '{$UserNm}' AND aset_action = '{$act}' AND UserSes = '{$sess}'";
				$exec = mysql_query($sql);
			}
			
			if ($undata != "") {
				$remlist = explode(",", $undata);
				$arrlist = explode(",", $list);
				$remresult = array_diff($arrlist, $remlist);

				if(count($remresult) != 0 ){
					$list = implode(",", $remresult);
				
					$sql = "UPDATE apl_userasetlist SET aset_list = '{$list}' WHERE UserNm = '{$UserNm}' AND aset_action = '{$act}' AND UserSes = '{$sess}'";
					$exec = mysql_query($sql);
				}
				
			}

			$sql = mysql_query("SELECT aset_list FROM apl_userasetlist WHERE UserNm = '{$UserNm}' AND aset_action = '{$act}' AND UserSes = '{$sess}' LIMIT 1");
				while ($row = mysql_fetch_assoc($sql)){
					$list = $row['aset_list'];
			}

			if($list == ""){
				$sql = "DELETE FROM apl_userasetlist WHERE UserNm = '{$UserNm}' AND aset_action = '{$act}' AND UserSes = '{$sess}'";
				$exec = mysql_query($sql);
			}
	}
	// pr($sql);
	
	echo 1;

exit;

?>