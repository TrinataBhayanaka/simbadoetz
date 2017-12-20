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

$sqlPenghapusan = "SELECT Usulan_ID,Penghapusan_ID FROM `penghapusan` WHERE SatkerUsul LIKE '08%' AND TglHapus >= '2017-01-01' AND (Jenis_Hapus = 'PMS' OR Jenis_Hapus = 'PMD')";
$execPenghapusan =  $link->query($sqlPenghapusan);
while($rowPenghapusan = $execPenghapusan->fetch_assoc()) {
	$tempPenghapusanID[] = $rowPenghapusan['Penghapusan_ID'];
}
//echo "Penghapusan_ID"."\n\n";
foreach ($tempPenghapusanID as $key => $value) {
	//print_r($value);
	//echo ""."\n\n";
	$Penghapusan_ID = $value;
	//select list Aset ID
	$listAsetID = array();
	$sqlPenghapusanAset = "SELECT Aset_ID FROM `penghapusanaset` WHERE Penghapusan_ID = '{$Penghapusan_ID}'";
	//echo $sqlPenghapusanAset."\n\n";
	$execPenghapusanAset =  $link->query($sqlPenghapusanAset);
	while($rowPenghapusanAset = $execPenghapusanAset->fetch_assoc()) {
		$listAsetID[] = $rowPenghapusanAset['Aset_ID'];
	}
	foreach ($listAsetID as $key => $val) {
		# code...
		$Aset_ID = $val; 
		//print_r($Aset_ID);
		//echo ""."\n\n";
		/* skenario
		1. update aset
		2. select tipe aset
		3. update kib(mesin atau asetlain)
		4. hapus log
		*/
		$sqlTipeAset = "SELECT kodeKelompok FROM `aset` WHERE Aset_ID = '{$Aset_ID}'";
		$execTipeAset =  $link->query($sqlTipeAset);
		while($rowTipeAset = $execTipeAset->fetch_assoc()) {
			$kodeKelompok = $rowTipeAset['kodeKelompok'];
		}
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

		$sqlAset  = "UPDATE `aset` SET StatusValidasi = '1', Status_Validasi_Barang = '1'  WHERE Aset_ID = '{$Aset_ID}'" or die("Error in the consult.." . mysqli_error($link));
		//$sqlAset  = "UPDATE `aset` SET StatusValidasi = '1', Status_Validasi_Barang = '1'  WHERE Aset_ID = '{$Aset_ID}'";
		//echo $sqlAset."\n\n";
		$execAST = $link->query($sqlAset);
		
		$sqlKib  = "UPDATE {$tableKib} SET StatusValidasi = '1', Status_Validasi_Barang = '1',StatusTampil = '1' WHERE Aset_ID = '{$Aset_ID}'" or die("Error in the consult.." . mysqli_error($link));
		//$sqlKib  = "UPDATE {$tableKib} SET StatusValidasi = '1', Status_Validasi_Barang = '1',StatusTampil = '1' WHERE Aset_ID = '{$Aset_ID}'";
		//echo $sqlKib."\n\n";
		$execKib = $link->query($sqlKib);
		
		$sqlLog  = "DELETE FROM {$tableLog} WHERE Aset_ID = '{$Aset_ID}' AND (Kd_Riwayat = '26' OR Kd_Riwayat = '27') AND TglPerubahan >='2017-01-01'" or die("Error in the consult.." . mysqli_error($link));
		//$sqlLog  = "DELETE FROM {$tableLog} WHERE Aset_ID = '{$Aset_ID}' AND (Kd_Riwayat = '26' OR Kd_Riwayat = '27') AND TglPerubahan >='2017-01-01'";
		//echo $sqlLog."\n\n";
		$execLog = $link->query($sqlLog);
	}

	/* skenario
	1. hapus penghapusan
	2. hapus penghapusan aset
	*/
	$sqlPenghapusan  = "DELETE FROM penghapusan WHERE Penghapusan_ID = '{$Penghapusan_ID}'" or die("Error in the consult.." . mysqli_error($link));
	//$sqlPenghapusan  = "DELETE FROM penghapusan WHERE Penghapusan_ID = '{$Penghapusan_ID}'";
	//echo $sqlPenghapusan."\n\n";
	$execPenghapusan = $link->query($sqlPenghapusan);

	$sqlPenghapusanAset  = "DELETE FROM penghapusanaset WHERE Penghapusan_ID = '{$Penghapusan_ID}'" or die("Error in the consult.." . mysqli_error($link));
	//$sqlPenghapusanAset  = "DELETE FROM penghapusanaset WHERE Penghapusan_ID = '{$Penghapusan_ID}'";
	//echo $sqlPenghapusanAset."\n\n";
	$execPenghapusanAset = $link->query($sqlPenghapusanAset);

}
/* skenario
	1. update usulan Penetapan_ID = null,StatusPenetapan = 0
	2. update usulanaset StatusPenetapan = null, StatusKonfirmasi = 0 , StatusValidasi = 0
	*/
//echo "=============="."\n\n";
//echo "Usulan_ID"."\n\n";
$sqlUsulan = "SELECT * FROM `usulan` WHERE SatkerUsul LIKE '08%' AND (Jenis_Usulan = 'PMS' OR Jenis_Usulan = 'PMD') 
			  AND TglUpdate >='2017-01-01'";
$execUsulan =  $link->query($sqlUsulan);
while($rowUsulan = $execUsulan->fetch_assoc()) {
	$tempUsulanID[] = $rowUsulan['Usulan_ID'];
}	
foreach ($tempUsulanID as $key => $value) {
	$Usulan_ID = $value; 
	//print_r($Usulan_ID);
	//echo ""."\n\n";

	$sqlUsulan  = "UPDATE usulan SET Penetapan_ID = null, StatusPenetapan = '0' WHERE Usulan_ID = '{$Usulan_ID}'" or die("Error in the consult.." . mysqli_error($link));
	//$sqlUsulan  = "UPDATE usulan SET Penetapan_ID = null, StatusPenetapan = '0' WHERE Usulan_ID = '{$Usulan_ID}'";
	//echo $sqlUsulan."\n\n";
	$execUsulan = $link->query($sqlUsulan);

	$sqlUsulanAset  = "UPDATE usulanaset SET StatusPenetapan = null, StatusKonfirmasi = '0', StatusValidasi = '0'  WHERE Usulan_ID = '{$Usulan_ID}'" or die("Error in the consult.." . mysqli_error($link));
	//$sqlUsulanAset  = "UPDATE usulanaset SET StatusPenetapan = null, StatusKonfirmasi = '0', StatusValidasi = '0'  WHERE Usulan_ID = '{$Usulan_ID}'";
	//echo $sqlUsulanAset."\n\n";
	$execUsulanAset = $link->query($sqlUsulanAset);
}


//echo "Total Data List Aset : ".count($data)."\n\n";
$time_end = microtime(true);
//dividing with 60 will give the execution time in minutes other wise seconds
$execution_time = ($time_end - $time_start)/60;

//execution time of the script
echo '<b>Total Execution Time:</b> '.$execution_time.' Mins\n\n';

echo "=================== Process Complete. Thank you ===================\n\n";
?>
