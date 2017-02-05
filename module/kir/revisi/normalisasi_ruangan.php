<?php
include "../../../config/database.php";

$link = mysqli_connect($CONFIG['default']['db_host'],$CONFIG['default']['db_user'],$CONFIG['default']['db_pass'],$CONFIG['default']['db_name']) or die("Error " . mysqli_error($link)); 

$skpd = $argv[1];
echo "SKPD : ".$skpd."\n\n";
echo "==============================================="."\n\n";
//tahun ruangan
$tahun = '2016';
//start process
$time_start = microtime(true); 

$tabel = array("mesin","asetlain");
//$tabel = array("mesin");
$kodeBarang = array();
//$i = 0;
$jml = 0;
$jmlAll = 0;
$TotAll = 0;
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
	$i = 0;
	$ruangan=array();
	while($row = mysqli_fetch_assoc($result)) {
		//cek ruangan 
		$kodeRuangan = $row['kodeRuangan'];
		$Aset_ID 	 = $row['Aset_ID'];
		$NilaiPerolehan = $row['NilaiPerolehan'];
		
		$sqlCeck = "SELECT COUNT(Satker_ID) as jml FROM `satker` WHERE kode = '{$skpd}' AND Kd_Ruang is NOT null AND Tahun = '{$tahun}' AND Kd_Ruang = '{$kodeRuangan}'";
		$resultCeck = $link->query($sqlCeck); 
		//echo "Query : ".$sqlCeck."\n\n";
		$rows = mysqli_fetch_assoc($resultCeck);
		//print_r($rows);

		/*echo "Aset_ID : ".$Aset_ID."\n\n";
		echo "kodeKelompok : ".$kode."\n\n";
		echo "NilaiPerolehan : ".$NilaiPerolehan."\n\n";*/

		if($rows['jml'] == 0){
			//echo "ruangan tdk tersedia : ".$kodeRuangan."\n\n";

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
			//echo "Query update ruangan kib : ".$sqlRuanganAst."\n\n";
			
		}else{

			//echo "ruangan tersedia : ".$kodeRuangan."\n\n";

			//update tabel aset 
			$sqlRuanganAst = "UPDATE aset SET kodeRuangan = '{$kodeRuangan}' 
							WHERE Aset_ID = {$Aset_ID}" 
							or die("Error in the consult.." . mysqli_error($link));	
			$execRuanganAst = $link->query($sqlRuanganAst);
			//echo "Query update ruangan kib : ".$sqlRuanganAst."\n\n";					
		}
		$ruangan[] = $kodeRuangan;
		//$kodeBarang[] = $kode;
		//echo "i : ".$i."\n\n";
		if($i == 0 ){
			if($value == 'mesin'){
				echo "KIB ".$value."\n\n";
				echo "ruangan : ".$kodeRuangan."\n\n";
				$jml = $jml + $NilaiPerolehan;
				$jmlAll = $jmlAll + $NilaiPerolehan;
				
				//echo "jml 1 : ".$jmlAll."\n\n";
				//echo "TotAll 1 : ".$TotAll."\n\n";
			}else{
				echo "Total : ".$jml."\n\n";
				echo "Total All Mesin: ".$jmlAll."\n\n";
				$sqlStatus = "SELECT sum(NilaiPerolehan) as jml from mesin WHERE 
						kodeSatker = '{$skpd}' AND Status_Validasi_Barang = '1' AND StatusTampil = '1'";
				$resultStatus = $link->query($sqlStatus); 
				$rows = mysqli_fetch_assoc($resultStatus);
				/*print_r($jmlAll);
				echo ""."\n\n";
				print_r($rows['jml']);
				echo ""."\n\n";*/
				//echo "KIB : ".$rows['jml']."\n\n";
				echo "KIB : ".number_format($rows['jml'], 4, '.', '')."\n\n";
				//echo "KIR : ".$jmlAll."\n\n";
				echo "KIR : ".number_format($jmlAll, 4, '.', '')."\n\n";
				
				/*if($rows['jml'] ==  $jmlAll){
					$status = 'KIB dan KIR sama';
				}else{
					$status = 'KIB dan KIR tidak sama';
				}*/
				if(number_format($rows['jml'], 4, '.', '') ==  number_format($jmlAll, 4, '.', '')){
					$status = 'KIB dan KIR sama';
				}else{
					$status = 'KIB dan KIR tidak sama';
				}
				echo "STATUS ".$status."\n\n";
				
				echo "==============================================="."\n\n";
				$jmlAll = 0;
				echo "KIB ".$value."\n\n";
				echo "ruangan : ".$kodeRuangan."\n\n";
				$jml = $jml + $NilaiPerolehan;
				$jmlAll = $jmlAll + $NilaiPerolehan;
			}
			
		}else{

			//kode ruangan	
			$last = end($ruangan);
			//echo "last : ".$last."\n\n";
			$prev = prev($ruangan);
			//echo "prev : ".$prev."\n\n";
		
			if($prev != $last){
				echo "Total : ".$jml."\n\n";
				$jml = 0;
				echo "ruangan : ".$kodeRuangan."\n\n";				
				$jml = $jml + $NilaiPerolehan;
				$jmlAll = $jmlAll + $NilaiPerolehan;
				
				//echo "jml 3 : ".$jmlAll."\n\n";
				//echo "TotAll 3 : ".$TotAll."\n\n";
			}else{
				$jml = $jml + $NilaiPerolehan;
				$jmlAll = $jmlAll + $NilaiPerolehan;
				
				//echo "jml 2 : ".$jmlAll."\n\n";
				//echo "TotAll 2 : ".$TotAll."\n\n";
			}
		}

		$i++;
	}
	

}
echo "Total : ".$jml."\n\n";
echo "Total All AsetLain: ".$jmlAll."\n\n";
$sqlStatus = "SELECT sum(NilaiPerolehan) as jml from asetlain WHERE 
			  kodeSatker = '{$skpd}' AND Status_Validasi_Barang = '1' AND StatusTampil = '1'";
$resultStatus = $link->query($sqlStatus); 
$rows = mysqli_fetch_assoc($resultStatus);
/*print_r($jmlAll);
echo ""."\n\n";
print_r($rows['jml']);
echo ""."\n\n";*/
//echo "KIB : ".$rows['jml']."\n\n";
echo "KIB : ".number_format($rows['jml'], 4, '.', '')."\n\n";
//echo "KIR : ".$jmlAll."\n\n";				
echo "KIR : ".number_format($jmlAll, 4, '.', '')."\n\n";				
/*if($rows['jml'] ==  $jmlAll){
	$status = 'KIB dan KIR sama';
}else{
	$status = 'KIB dan KIR tidak sama';
}*/
if(number_format($rows['jml'], 4, '.', '') ==  number_format($jmlAll, 4, '.', '')){
	$status = 'KIB dan KIR sama';
}else{
	$status = 'KIB dan KIR tidak sama';
}
echo "STATUS ".$status."\n\n";
echo "==============================================="."\n\n";
$time_end = microtime(true);

//dividing with 60 will give the execution time in minutes other wise seconds
$execution_time = ($time_end - $time_start)/60;

//execution time of the script
echo '<b>Total Execution Time:</b> '.$execution_time.' Mins\n\n';

echo "=================== Process Complete. Thank you ===================\n\n";

?>
