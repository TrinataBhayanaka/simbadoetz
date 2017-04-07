<?php
include "../../../config/database.php";

$link = mysqli_connect($CONFIG['default']['db_host'],$CONFIG['default']['db_user'],$CONFIG['default']['db_pass'],$CONFIG['default']['db_name']) or die("Error " . mysqli_error($link)); 

$skpd = $argv[1];
echo "SKPD : ".$skpd."\n\n";
echo "==============================================="."\n\n";

//start process
$time_start = microtime(true); 

$tabel = array("mesin","asetlain");
foreach ($tabel as $key => $value) {
	# code...
	//fetch data dari tabel kib 
	/*
	SELECT a.Aset_ID,a.TglPerolehan as aTprl,a.TglPembukuan as aTpmbk,m.TglPerolehan as mTprl,
	m.TglPembukuan as mTpmbk,a.StatusValidasi,a.Status_Validasi_Barang,m.StatusValidasi,m.Status_Validasi_Barang FROM `mesin` as m
	INNER JOIN aset as a on a.Aset_ID = m.Aset_ID
	WHERE m.kodeSatker = '08.01.01.03' AND m.Status_Validasi_Barang = 1 and m.StatusTampil = 1 AND m.Tahun = '2016'
	*/
	$sql = "SELECT a.Aset_ID,m.TglPerolehan,m.TglPembukuan,m.StatusValidasi,m.Status_Validasi_Barang FROM {$value} as m 
			INNER JOIN aset as a on a.Aset_ID = m.Aset_ID 
			WHERE m.kodeSatker like '{$skpd}%' AND m.Status_Validasi_Barang = 1 and m.StatusTampil = 1 and m.Tahun = 2016";
	$result = $link->query($sql); 
	//echo "Query : ".$sql."\n\n";

	$Aset_ID = '';
	$TglPerolehan = '';
	$TglPembukuan = '';
	$StatusValidasi = '';
	$Status_Validasi_Barang = '';
	
	$ruangan=array();
	while($row = mysqli_fetch_assoc($result)) {
		//set value kib  
		$Aset_ID 	 			= $row['Aset_ID'];
		$TglPerolehan 			= $row['TglPerolehan'];
		$TglPembukuan 			= $row['TglPembukuan'];
		$StatusValidasi 		= $row['StatusValidasi'];
		$Status_Validasi_Barang = $row['Status_Validasi_Barang'];
		
		$sqlAst = "UPDATE aset SET StatusValidasi = '{$StatusValidasi}' , 
								Status_Validasi_Barang = '{$Status_Validasi_Barang}',
								TglPembukuan = '{$TglPembukuan}',
								TglPerolehan = '{$TglPerolehan}'
					WHERE Aset_ID = {$Aset_ID}" 
							or die("Error in the consult.." . mysqli_error($link));	
		$execAst = $link->query($sqlAst);
		//echo "Query update aset : ".$sqlAst."\n\n";
		echo "Aset_ID : ".$Aset_ID."\n\n";

	}	
}

$time_end = microtime(true);
//dividing with 60 will give the execution time in minutes other wise seconds
$execution_time = ($time_end - $time_start)/60;

//execution time of the script
echo '<b>Total Execution Time:</b> '.$execution_time.' Mins\n\n';

echo "=================== Process Complete. Thank you ===================\n\n";

?>
