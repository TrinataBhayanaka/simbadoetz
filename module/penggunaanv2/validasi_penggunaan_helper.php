<?php
//include "../../../config/config.php";
include "../../config/database.php";

$link = mysqli_connect($CONFIG['default']['db_host'],$CONFIG['default']['db_user'],$CONFIG['default']['db_pass'],$CONFIG['default']['db_name']) or die("Error " . mysqli_error($link)); 

$idPenggunaan = $argv[1];
echo "Id idPenggunaan : ".$idPenggunaan."\n\n";


//start process
$time_start = microtime(true); 

//get all aset
$sqlAst = "SELECT pa.Aset_ID FROM penggunaanaset as pa 
    INNER JOIN penggunaan as p ON p.Penggunaan_ID = pa.Penggunaan_ID  
    where pa.Penggunaan_ID = '{$idPenggunaan}'" or die("Error in the consult.." . mysqli_error($link));

//echo "sqlAst : ".$sqlAst."\n\n";
$result = $link->query($sqlAst); 
$data =array();
while($row = mysqli_fetch_assoc($result)) {
	$data[] = $row;
} 
//print_r($data);
echo "Total Data List Aset : ".count($data)."\n\n";
//$temp = array();
foreach ($data as $val) {
    
	//clear value
	$Aset_ID = ''; 
	$Aset_ID = $val['Aset_ID'];
    
    echo "Aset_ID : ".$Aset_ID."\n\n";  
   	//update penggunaanaset			
	$queryA = "UPDATE aset SET fixPenggunaan = '1'
				WHERE Aset_ID = '{$Aset_ID}'" 
				or die("Error in the consult.." . mysqli_error($link));
	$execA = $link->query($queryA);	
	//echo "queryA : ".$queryA."\n\n"; 

    
}
//update penggunaanaset			
$queryPA = "UPDATE penggunaanaset SET Status = '1'
			WHERE Penggunaan_ID = '{$idPenggunaan}'" 
			or die("Error in the consult.." . mysqli_error($link));
$execPA = $link->query($queryPA);	
//echo "queryPA : ".$queryPA."\n\n";

//update penggunaan
$quertUS = "UPDATE penggunaan SET FixPenggunaan = '1', Status = '1'
			WHERE Penggunaan_ID IN ($idPenggunaan)"
			or die("Error in the consult.." . mysqli_error($link));  
$execUS = $link->query($quertUS);	
//echo "quertUS : ".$quertUS."\n\n";
//
$time_end = microtime(true);

//dividing with 60 will give the execution time in minutes other wise seconds
$execution_time = ($time_end - $time_start)/60;

//execution time of the script
echo '<b>Total Execution Time:</b> '.$execution_time.' Mins\n\n';

echo "=================== Process Complete. Thank you ===================\n\n";

?>
