<?php
include "../../../config/database.php";
/*echo "<pre>";
print_r($CONFIG);
echo "</pre>";*/
$link = mysqli_connect($CONFIG['default']['db_host'],$CONFIG['default']['db_user'],$CONFIG['default']['db_pass'],$CONFIG['default']['db_name']) or die("Error " . mysqli_error($link)); 
/*if($link){
	echo "Konek";
}else{
	echo "not Konek";
}*/

//start process
$time_start = microtime(true); 

$list = array(2834172,2834173,2834174,2834175,2834176,2834177,2834178,2834179,2834180,2834181,2834182,2834183,2834184,2834185,2834186,2834187,
2834188,2834189,2834190,2834191,2834192,2834193,2834194,2834195,2834196,2834197,2834198,2834199,2834200,2834201,2834202,2834203,2834204,
2834205,2834206,2834207,2834208,2834209,2834210,2834211,2834212,2834213,2834214,2834215,2834216,2834217,2834218,2834219,2834220,
2834221,2834222,2834223,2834224,2834225,2834226,2834227,2834228,2834229);
$noReg = '61';
$data = array();
foreach ($list as $key => $value) {
	$data[] = $key;
	$sqlAset  = "UPDATE `aset` SET noRegister = '{$noReg}' WHERE Aset_ID = '{$value}'" or die("Error in the consult.." . mysqli_error($link));
	$execAST = $link->query($sqlAset);
	
	$sqlMesin = "UPDATE `mesin` SET noRegister = '{$noReg}' WHERE Aset_ID = '{$value}'" or die("Error in the consult.." . mysqli_error($link));
	$execMSN = $link->query($sqlMesin);
	
	$sqlLogMesin = "UPDATE `log_mesin` SET noRegister = '{$noReg}' WHERE Aset_ID = '{$value}'" or die("Error in the consult.." . mysqli_error($link));
	$execLogMSN = $link->query($sqlLogMesin);
	
	$noReg++;	
}
echo "Total Data List Aset : ".count($data)."\n\n";
$time_end = microtime(true);
//dividing with 60 will give the execution time in minutes other wise seconds
$execution_time = ($time_end - $time_start)/60;

//execution time of the script
echo '<b>Total Execution Time:</b> '.$execution_time.' Mins\n\n';

echo "=================== Process Complete. Thank you ===================\n\n";

?>
