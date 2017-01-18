<?php
include "../../../config/database.php";

$link = mysqli_connect($CONFIG['default']['db_host'],$CONFIG['default']['db_user'],$CONFIG['default']['db_pass'],$CONFIG['default']['db_name']) or die("Error " . mysqli_error($link)); 

//start process
$time_start = microtime(true); 

//sinkronisasi tabel kib dengan aset
$sqllistskpd = "SELECT a.Aset_ID,a.StatusValidasi as svAset,a.Status_Validasi_Barang as svbAset, a.kodeSatker,m.StatusValidasi as svMsn,m.Status_Validasi_Barang as svbMsn,m.StatusTampil FROM aset as a inner join mesin as m on m.Aset_ID = a.Aset_ID WHERE a.Status_Validasi_Barang = 3 AND a.kodeKelompok LIKE '02%' ";

echo "Query : ".$sqllistskpd."\n\n";

$result = $link->query($sqllistskpd); 
$data = array();
$fix = 0;
$unfix = 0;
while($row = mysqli_fetch_assoc($result)) {
  	$data[] = $row;
  	//echo "Aset_ID : ".$row['Aset_ID']."\n\n";

	//menghilangkan flag usulan mutasi
	if($row['svbAset'] == '3' && $row['svbMsn'] == '1'){
		$fix++;
		$quertAST = "UPDATE aset SET 
			StatusValidasi = {$row['svMsn']} ,
			Status_Validasi_Barang = {$row['svbMsn']}
		WHERE Aset_ID = {$row['Aset_ID']}" or die("Error in the consult.." . mysqli_error($link));	
		$execAST = $link->query($quertAST);	
		//echo "quertAST : ".$quertAST."\n\n";
		
		//query reverse
		$quertRvrsAST = "UPDATE aset SET 
			StatusValidasi = {$row['svAset']} ,
			Status_Validasi_Barang = {$row['svbAset']}
		WHERE Aset_ID = {$row['Aset_ID']};" or die("Error in the consult.." . mysqli_error($link));	
		//echo "reverse : ".$quertRvrsAST."\n\n";
		echo $quertRvrsAST."\n\n";
		
	}else{
		//nothing
		$unfix++;
	}
}
//print_r($data);
echo "Total Data List Aset : ".count($data)."\n\n";
echo "Fixing Aset : ".$fix."\n\n";
echo "UnFixing Aset : ".$unfix."\n\n";

$time_end = microtime(true);

//dividing with 60 will give the execution time in minutes other wise seconds
$execution_time = ($time_end - $time_start)/60;

//execution time of the script
echo '<b>Total Execution Time:</b> '.$execution_time.' Mins\n\n';

echo "=================== Process Complete. Thank you ===================\n\n";

?>
