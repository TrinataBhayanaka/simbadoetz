<?php
include "../../../config/database.php";

$link = mysqli_connect($CONFIG['default']['db_host'],$CONFIG['default']['db_user'],$CONFIG['default']['db_pass'],$CONFIG['default']['db_name']) or die("Error " . mysqli_error($link)); 

$skpd = $argv[1];
echo "SKPD : ".$skpd."\n\n";

//tahun ruangan
$tahun = '2016';
//start process
$time_start = microtime(true); 

$tabel = array("mesin","asetlain");
//$tabel = array("mesin");
foreach ($tabel as $key => $value) {
	# code...
	//fetch data dari tabel kib 
	$sql = "SELECT Aset_ID,kodeRuangan,NilaiPerolehan FROM {$value} WHERE 
			kodeSatker = '{$skpd}' AND Status_Validasi_Barang = '1' 
			AND StatusTampil = '1' ORDER BY kodeRuangan";
	$result = $link->query($sql); 
	//echo "Query : ".$sql."\n\n";

	$kodeRuangan = '';
	$Aset_ID = '';

	while($row = mysqli_fetch_assoc($result)) {
		//cek ruangan 
		$kodeRuangan = $row['kodeRuangan'];
		$Aset_ID 	 = $row['Aset_ID'];

		$sqlCeck = "SELECT COUNT(Satker_ID) as jml FROM `satker` WHERE kode = '{$skpd}' AND Kd_Ruang is NOT null AND Tahun = '{$tahun}' AND Kd_Ruang = '{$kodeRuangan}'";
		$resultCeck = $link->query($sqlCeck); 
		//echo "Query : ".$sqlCeck."\n\n";
		$rows = mysqli_fetch_assoc($resultCeck);
		//print_r($rows);

		echo "Aset_ID : ".$Aset_ID."\n\n";
		
		if($rows['jml'] == 0){
			echo "ruangan tdk tersedia : ".$kodeRuangan."\n\n";

			/*
			//update tabel kib dan aset ruangan = null atau 0
			$sqlRuanganAst = "UPDATE aset SET kodeRuangan = NULL 
							WHERE Aset_ID = {$Aset_ID}" 
							or die("Error in the consult.." . mysqli_error($link));	
			$execRuanganAst = $link->query($sqlRuanganAst);
			echo "Query update ruangan aset : ".$sqlRuanganAst."\n\n";
		
			$sqlRuanganKib = "UPDATE {$value} SET kodeRuangan = NULL 
							WHERE Aset_ID = {$Aset_ID}" 
							or die("Error in the consult.." . mysqli_error($link));	
			$execRuanganKib = $link->query($sqlRuanganKib);
			echo "Query update ruangan kib : ".$sqlRuanganKib."\n\n";*/
		
			//update tabel aset 
			$sqlRuanganAst = "UPDATE aset SET kodeRuangan = '{$kodeRuangan}' 
							WHERE Aset_ID = {$Aset_ID}" 
							or die("Error in the consult.." . mysqli_error($link));	
			$execRuanganAst = $link->query($sqlRuanganAst);
			echo "Query update ruangan kib : ".$sqlRuanganAst."\n\n";
			
		}else{

			echo "ruangan tersedia : ".$kodeRuangan."\n\n";

			//update tabel aset 
			$sqlRuanganAst = "UPDATE aset SET kodeRuangan = '{$kodeRuangan}' 
							WHERE Aset_ID = {$Aset_ID}" 
							or die("Error in the consult.." . mysqli_error($link));	
			$execRuanganAst = $link->query($sqlRuanganAst);
			echo "Query update ruangan kib : ".$sqlRuanganAst."\n\n";					
		}

		echo "==============================================="."\n\n";
	}
	

}

$time_end = microtime(true);

//dividing with 60 will give the execution time in minutes other wise seconds
$execution_time = ($time_end - $time_start)/60;

//execution time of the script
echo '<b>Total Execution Time:</b> '.$execution_time.' Mins\n\n';

echo "=================== Process Complete. Thank you ===================\n\n";

?>
