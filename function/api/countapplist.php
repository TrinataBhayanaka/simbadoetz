<?php
include "../../config/database.php";  
open_connection();  

	$undata = $_POST['undata'];
	$UserNm = $_POST['UserNm'];
	$act = $_POST['act'];
	$rvwact = $_POST['rvwact'];
	$sess = $_POST['sess'];

	//final
	$sql = mysql_query("SELECT aset_list FROM apl_userasetlist WHERE UserNm = '{$UserNm}' AND aset_action = '{$act}' AND UserSes = '{$sess}' LIMIT 1");
	while ($row = mysql_fetch_assoc($sql)){
		$tes = $row['aset_list'];
	}
	
	if($tes){
		$datafinal = explode(",",$tes);
		foreach ($datafinal as $key => $value) {
            if($value!=""){
                $dataku[]=$value;
            }
        }
		$count = count($dataku);	
	} else {
		$datafinal = "";
		$count = 0;
	}

	$rvwsql = mysql_query("SELECT aset_list FROM apl_userasetlist WHERE UserNm = '{$UserNm}' AND aset_action = '{$rvwact}' AND UserSes = '{$sess}' LIMIT 1");
	while ($rowrvw = mysql_fetch_assoc($rvwsql)){
		$tesrvw = $rowrvw['aset_list'];
	}
	if($tesrvw){
		$datafinalrvw = explode(",",$tesrvw);
		foreach ($datafinalrvw as $keyrvw => $valuervw) {
            if($valuervw!=""){
                $datakurvw[]=$valuervw;
            }
        }
		$rvwcount = count($datakurvw);	
	} else {
		$datafinalrvw = "";
		$rvwcount = 0;
	}
	// $count = array('countAset' =>$count ,'totalAset' =>'3'  );
	print json_encode(array('countAset' =>$count ,'totalAset' =>$rvwcount ));
	// echo $count;

exit;

?>