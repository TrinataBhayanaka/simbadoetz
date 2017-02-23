<?php
///include "../../../config/config.php";
include "../../config/database.php";

$link = mysqli_connect($CONFIG['default']['db_host'],$CONFIG['default']['db_user'],$CONFIG['default']['db_pass'],$CONFIG['default']['db_name']) or die("Error " . mysqli_error($link)); 

$kodeSatker = $argv[1];
echo "kodeSatker : ".$kodeSatker."\n\n";
$ListAset  = $argv[2];
echo "ListAset : ".$ListAset."\n\n";
$table	   = $argv[3];
echo "table : ".$table."\n\n";
$tableLog  = $argv[4];
echo "tableLog : ".$tableLog."\n\n";

$sample    = array($ListAset);
$expl      = explode(",", $sample[0]);
$clearList = array_filter($expl);
echo "Total Data List Aset : ".count($clearList)."\n\n";

$time_start = microtime(true); 

foreach ($clearList as $value) {
    # code...
    //counting process loop
    echo "Aset_ID : ".$value."\n\n";
    $Aset_ID = ''; 
	$Aset_ID = $value;
    
    //update aset
    $queryAset = "UPDATE aset SET 
    						StatusValidasi = '77',
   							Status_Validasi_Barang = '77'
				WHERE Aset_ID = '{$Aset_ID}'" 
				or die("Error in the consult.." . mysqli_error($link));
	$execAset = $link->query($queryAset);	
	//echo "queryAset : ".$queryAset."\n\n"; 

	//get all param to log
	$sqlKIB = "SELECT * FROM {$table} where 
				Aset_ID = '{$Aset_ID}'" 
				or die("Error in the consult.." . mysqli_error($link));;
	//echo "sqlKIB : ".$sqlKIB."\n\n";
	$result = $link->query($sqlKIB); 
	$ListParam = array();
	while($rows = mysqli_fetch_assoc($result)) {
		$ListParam = $rows;
	} 
	//print_r($ListParam);
	//update kib
	$queryKib = "UPDATE {$table} SET 
    						StatusValidasi = '77',
   							Status_Validasi_Barang = '77',
   							StatusTampil = '77'
				WHERE Aset_ID = '{$Aset_ID}'" 
				or die("Error in the consult.." . mysqli_error($link));
	$execKib = $link->query($queryKib);	
	//echo "queryKib : ".$queryKib."\n\n"; 

	$tmpField = array();
	$tmpVal = array();
	$sign = "'"; 	
	foreach ($ListParam as $key => $val) {
		//print_r($ListParam);
		//print_r($key);
		//print_r($val);
		$tmpField[] = $key;
		if ($val =='' || $val == NULL){
			$tmpVal[] = 'NULL';
		}else{
			$tmpVal[] = $sign.addslashes($val).$sign;
		}
	}

	$implodeField = implode (',',$tmpField);
	$implodeVal = implode (',',$tmpVal);

	$AddField = "action,changeDate,TglPerubahan,Kd_Riwayat";
	$action = "77";
	$changeDate = date('Y-m-d');
	$TglPerubahan = $changeDate;
	$Kd_Riwayat = '77';
	//insert log
	$QueryLog  = "INSERT INTO {$tableLog} ($implodeField,$AddField)
					VALUES ($implodeVal,'$action','$changeDate','$TglPerubahan','$Kd_Riwayat')" or die("Error in the consult.." . mysqli_error($link));
	
	$execLog = $link->query($QueryLog);	
	//echo "QueryLog : ".$QueryLog."\n\n";

}

$time_end = microtime(true);

//dividing with 60 will give the execution time in minutes other wise seconds
$execution_time = ($time_end - $time_start)/60;

//execution time of the script
echo '<b>Total Execution Time:</b> '.$execution_time.' Mins\n\n';

echo "=================== Process Complete. Thank you ===================\n\n";

?>
