<?phpNULL
include "../../../config/database.php";

$link = mysqli_connect($CONFIG['default']['db_host'],$CONFIG['default']['db_user'],$CONFIG['default']['db_pass'],$CONFIG['default']['db_name']) or die("Error " . mysqli_error($link)); 

//start process
$time_start = microtime(true); 

//ambil Aset_ID
$sqllistAset_ID = "SELECT Aset_ID FROM `log_asetlain` WHERE `kodeSatker` LIKE '07.02.01.01' AND `action` LIKE 'Rev_Ruangan_%' 
	            AND `Kd_Riwayat` = 4 AND TglPerubahan = '2017-09-01'";

echo "Query : ".$sqllistAset_ID."\n\n";

$result = $link->query($sqllistAset_ID); 

while($row = mysqli_fetch_assoc($result)) {
  	$Aset_ID = $row['Aset_ID'];
  	
  	$sqllistkodeRuangan = "SELECT log_id,kodeRuangan FROM `log_asetlain` WHERE `Aset_ID` = '{$Aset_ID}' 
  						   AND Kd_Riwayat != 4 ORDER BY log_id DESC limit 1";

  	$res = $link->query($sqllistkodeRuangan); 
  	while($data = mysqli_fetch_assoc($res)) {
  		//update aset
  		$quertAST = "UPDATE aset 
  					SET kodeRuangan = {$data['kodeRuangan']}
					WHERE Aset_ID = {$Aset_ID}" or die("Error in the consult.." . mysqli_error($link));	
		$execAST = $link->query($quertAST);	
		echo "quertAST : ".$quertAST."\n\n";
		
		//update mesin
		$quertMesin = "UPDATE asetlain 
  					SET kodeRuangan = {$data['kodeRuangan']}
					WHERE Aset_ID = {$Aset_ID}" or die("Error in the consult.." . mysqli_error($link));	
		$execMSN = $link->query($quertMesin);	
		echo "quertMSN : ".$quertMesin."\n\n";

		//update log_asetlain
		$quertLogMesin = "UPDATE log_asetlain 
  					SET TglPerubahan = null
					WHERE Aset_ID = {$Aset_ID}
					AND `Kd_Riwayat` = 4 AND TglPerubahan = '2017-09-01'" or die("Error in the consult.." . mysqli_error($link));	
		$execMSN = $link->query($quertLogMesin);	
		echo "quertMSN : ".$quertLogMesin."\n\n";

	}
}
  	
$time_end = microtime(true);

//dividing with 60 will give the execution time in minutes other wise seconds
$execution_time = ($time_end - $time_start)/60;

//execution time of the script
echo '<b>Total Execution Time:</b> '.$execution_time.' Mins\n\n';

echo "=================== Process Complete. Thank you ===================\n\n";

?>
