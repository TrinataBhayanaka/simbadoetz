<?php
include "../../../config/database.php";
$set = ini_set('memory_limit', '8192M'); 
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
/*
1. select data penghapusan dan penghapusan aset
2. 
*/
//echo "masuk";

/*
1. select

*/

$sqlMutasi = "SELECT * FROM `mutasi` WHERE SatkerUsul IS not null AND SatkerTujuan IS not null";
$execMutasi =  $link->query($sqlMutasi);
while($rowMutasi = $execMutasi->fetch_assoc()) {
	$tempMutasi_ID[] = $rowMutasi['Mutasi_ID'];
}

if($tempMutasi_ID){
	foreach ($tempMutasi_ID as $key => $value) {
		$Mutasi_ID = $value;
		$sqlMutasiAset = "SELECT ast.*,mts.* FROM aset as ast 
						INNER JOIN mutasiaset as mts on mts.Aset_ID = ast.Aset_ID 
						WHERE mts.Mutasi_ID = '{$Mutasi_ID}' ORDER BY ast.Aset_ID,ast.kodeKelompok";
		$execMutasiAset =  $link->query($sqlMutasiAset);
		$tmpkodeKelompok = array();
		$tmpkodeLokasi = array();
		$count = 1;
		while($rowMutasiAset = $execMutasiAset->fetch_assoc()) {
			$Mutasi_ID 	  = $rowMutasiAset['Mutasi_ID'];
			$Aset_ID 	  = $rowMutasiAset['Aset_ID'];
			$kodeKelompok = $rowMutasiAset['kodeKelompok'];
			$kodeLokasi   = $rowMutasiAset['kodeLokasi'];
			$noRegister   = $rowMutasiAset['noRegister'];
			if($count == 1){
				$tmpkodeKelompok[]  = $rowMutasiAset['kodeKelompok'];
				$tmpkodeLokasi[] 	= $rowMutasiAset['kodeLokasi'];
			}else{
				/*echo $kodeKelompok."\n\n";
				echo end($tmpkodeKelompok)."\n\n";
				echo $kodeLokasi."\n\n";
				echo end($tmpkodeLokasi)."\n\n";*/
				if($kodeKelompok == end($tmpkodeKelompok) && $kodeLokasi == end($tmpkodeLokasi)){
					//noregister +1
					//NomorRegBaru
					//$NomorRegBaru = intval($noRegister) + 1;	
					$sqlAsetNew = "SELECT noRegister FROM aset WHERE kodeKelompok = '{$kodeKelompok}' AND kodeLokasi = '{$kodeLokasi}' ORDER BY noRegister DESC LIMIT 1";
					$resultAsetNew = $link->query($sqlAsetNew);
					$detailAsetNew = mysqli_fetch_assoc($resultAsetNew);
					//echo $detailAsetNew['noRegister']."\n\n";
					if($detailAsetNew['noRegister'] == ''){
				        $startreg = 0; 
				        $NomorRegBaru = $startreg + 1;
				    }else{
				    	$NomorRegBaru = intval($detailAsetNew['noRegister']) + 1;
				    }
					$sqlUpNoReg  = "UPDATE mutasiaset SET NomorRegBaru = '{$NomorRegBaru}' WHERE Mutasi_ID = '{$Mutasi_ID}' AND Aset_ID = '{$Aset_ID}'" or die("Error in the consult.." . mysqli_error($link));
					$execUpNoReg = $link->query($sqlUpNoReg);
					/*$sqlUpNoReg  = "UPDATE mutasiaset SET NomorRegBaru = '{$NomorRegBaru}' WHERE Mutasi_ID = '{$Mutasi_ID}' AND Aset_ID = '{$Aset_ID}'";
					echo $sqlUpNoReg."\n\n";*/

					$sqlUpNoReg_2  = "UPDATE aset SET noRegister = '{$NomorRegBaru}' WHERE Aset_ID = '{$Aset_ID}'" or die("Error in the consult.." . mysqli_error($link));
					$execUpNoReg_2 = $link->query($sqlUpNoReg_2);

					$tipe = explode('.', $kodeKelompok);
					if($tipe['0'] == '01'){
						$tableKib = 'tanah';
						$tableLog = 'log_tanah';
					}elseif($tipe['0'] == '02'){
						$tableKib = 'mesin';
						$tableLog = 'log_mesin';
					}elseif($tipe['0'] == '03'){
						$tableKib = 'bangunan';
						$tableLog = 'log_bangunan';
					}elseif($tipe['0'] == '04'){
						$tableKib = 'jaringan';
						$tableLog = 'log_jaringan';
					}elseif($tipe['0'] == '05'){
						$tableKib = 'asetlain';
						$tableLog = 'log_asetlain';
					}elseif($tipe['0'] == '06'){
						$tableKib = 'kdp';
						$tableLog = 'log_kdp';
					}
					$sqlUpNoReg_3  = "UPDATE {$tableKib} SET noRegister = '{$NomorRegBaru}' WHERE Aset_ID = '{$Aset_ID}'" or die("Error in the consult.." . mysqli_error($link));
					$execUpNoReg_3 = $link->query($sqlUpNoReg_3);

					$sqlUpNoReg_4  = "UPDATE {$tableLog} SET noRegister = '{$NomorRegBaru}' WHERE Aset_ID = '{$Aset_ID}' AND Kd_Riwayat = '3' AND action = 'Sukses Mutasi'" or die("Error in the consult.." . mysqli_error($link));
					$execUpNoReg_3 = $link->query($sqlUpNoReg_4);

				}else{
					//nothing
				}
				$tmpkodeKelompok[]  = $rowMutasiAset['kodeKelompok'];
				$tmpkodeLokasi[] 	= $rowMutasiAset['kodeLokasi'];
			}
		$count++;		
		}	
	}
}
//print_r($tmpkodeKelompok);
//print_r($tmpkodeLokasi);
//echo "Total Data List Aset : ".count($data)."\n\n";
$time_end = microtime(true);
//dividing with 60 will give the execution time in minutes other wise seconds
$execution_time = ($time_end - $time_start)/60;

//execution time of the script
echo '<b>Total Execution Time:</b> '.$execution_time.' Mins\n\n';

echo "=================== Process Complete. Thank you ===================\n\n";
?>
