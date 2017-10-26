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
$data = array();
//buat dokumen penggunaan;
$NoSKKDH = '26/10/2017/import';
$TglSKKDH = '2017-10-26';
$Keterangan = 'All Import Dinas Pendidikan';
$NotUse = '0';
$TglUpdate = '2017-10-26';
$UserNm = '1';
$FixPenggunaan = '1';
$Status = '1';
$sqlCreateDataPenggunaan = "INSERT INTO penggunaan(NoSKKDH, TglSKKDH, Keterangan, NotUse, TglUpdate, UserNm, FixPenggunaan, Status) VALUES ('{$NoSKKDH}','{$TglSKKDH}','{$Keterangan}','{$NotUse}','{$TglUpdate}','{$UserNm}','{$FixPenggunaan}','{$Status}')" or die("Error in the consult.." . mysqli_error($link));
$sql = "INSERT INTO penggunaan(NoSKKDH, TglSKKDH, Keterangan, NotUse, TglUpdate, UserNm, FixPenggunaan, Status) VALUES ('{$NoSKKDH}','{$TglSKKDH}','{$Keterangan}','{$NotUse}','{$TglUpdate}','{$UserNm}','{$FixPenggunaan}','{$Status}')";
//echo "sql = ".$sql; 
$exeSqlCreateDataPenggunaan =  $link->query($sqlCreateDataPenggunaan);


//Id Dokumen Penggunaan
$sqlSelectId = "SELECT Penggunaan_ID FROM `penggunaan` WHERE NoSKKDH = '26/10/2017/import'";
$exesqlSelectId =  $link->query($sqlSelectId);
//while($row = mysql_fetch_assoc($exesqlSelectId)) {
while($row = $exesqlSelectId->fetch_assoc()) {
	$Penggunaan_ID = $row['Penggunaan_ID'];
}
echo "Penggunaan_ID = ".$Penggunaan_ID;

//select data aset
$sqlSelectData = "SELECT * FROM `aset` WHERE kodeSatker LIKE '08%' AND Status_Validasi_Barang = 1 AND Info LIKE '%import%'";
$execaset =  $link->query($sqlSelectData);
//while($rowaset = mysql_fetch_assoc($execaset)) {
while($rowaset = $execaset->fetch_assoc()) {
	echo "Aset_ID : ".$rowaset['Aset_ID']."\n\n";
	$data[] = $rowaset['Aset_ID'];
	$Aset_ID = $rowaset['Aset_ID'];
	$kodeSatker = $rowaset['kodeSatker'];
	$fixPenggunaan = $rowaset['fixPenggunaan'];
	if($fixPenggunaan != 1){
		$sqlAset  = "UPDATE `aset` SET fixPenggunaan = '1' WHERE Aset_ID = '{$Aset_ID}'" or die("Error in the consult.." . mysqli_error($link));
		$execAST = $link->query($sqlAset);
	}else{
		//
	}	
	//list aset
	$sqlCreateListAsetDataPenggunaan = "INSERT INTO penggunaanaset(Penggunaan_ID, Aset_ID, kodeSatker, Status) 
		VALUES ('{$Penggunaan_ID}','{$Aset_ID}','{$kodeSatker}','1')" or die("Error in the consult.." . mysqli_error($link));
	$exesqlCreateListAsetDataPenggunaan =  $link->query($sqlCreateListAsetDataPenggunaan);

}

echo "Total Data List Aset : ".count($data)."\n\n";
$time_end = microtime(true);
//dividing with 60 will give the execution time in minutes other wise seconds
$execution_time = ($time_end - $time_start)/60;

//execution time of the script
echo '<b>Total Execution Time:</b> '.$execution_time.' Mins\n\n';

echo "=================== Process Complete. Thank you ===================\n\n";
?>
