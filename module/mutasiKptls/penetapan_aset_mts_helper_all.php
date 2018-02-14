<?php
///include "../../../config/config.php";
include "../../config/database.php";

$link = mysqli_connect($CONFIG['default']['db_host'],$CONFIG['default']['db_user'],$CONFIG['default']['db_pass'],$CONFIG['default']['db_name']) or die("Error " . mysqli_error($link)); 

$Mutasi_ID = $argv[1];
echo "Id Mutasi : ".$Mutasi_ID."\n\n";

$ListUsul = $argv[2];
echo "List Usulan : ".$ListUsul."\n\n";

//start process
$time_start = microtime(true); 

//update usulan masih salah ga bisa pake in
$quertUS = "UPDATE usulan SET StatusPenetapan = '1' , 
				Penetapan_ID = '{$Mutasi_ID}'
			WHERE Usulan_ID IN ({$ListUsul})"
			or die("Error in the consult.." . mysqli_error($link));  
$execUS = $link->query($quertUS);	
//echo "quertUS : ".$quertUS."\n\n";

$sqlSelUsulan = "SELECT SatkerTujuan FROM usulan where Usulan_ID IN ({$ListUsul})";
$resultSelUsulan = $link->query($sqlSelUsulan);
while($rowSelUsulan = mysqli_fetch_assoc($resultSelUsulan)) {
	  $ListSatkerTujuan[] = $rowSelUsulan['SatkerTujuan'];
}

$tmp = array_unique($ListSatkerTujuan);
$LstSatkerTujuan = implode(',', $tmp);

//update mutasi
$queryPnghps = "UPDATE mutasi SET Usulan_ID = '{$ListUsul}', SatkerTujuan = '{$LstSatkerTujuan}' 
				WHERE Mutasi_ID = '{$Mutasi_ID}'" or die("Error in the consult.." . mysqli_error($link));
$execPnghps = $link->query($queryPnghps);	
//echo "queryPnghps : ".$queryPnghps."\n\n";

//get all aset
$sqlAst = "SELECT Aset_ID FROM usulanaset where 
			Usulan_ID in ({$ListUsul})";
//echo "sqlAst : ".$sqlAst."\n\n";

$result = $link->query($sqlAst); 
$data = array();
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
    
     //field untuk mutasiaset
    $sqlUsulan = "SELECT Usulan_ID FROM usulanaset where Aset_ID = '{$Aset_ID}' AND Usulan_ID IN ({$ListUsul})";
	$resultUsulan = $link->query($sqlUsulan);
	while($rowUsulan = mysqli_fetch_assoc($resultUsulan)) {
		  $ListUsulan = $rowUsulan['Usulan_ID'];
	}
	
	//Data SatkerAwal, SatkerAwal
    $sqlUsulan2 = "SELECT * FROM usulan where Usulan_ID = '{$ListUsulan}'";
	$resultUsulan2 = $link->query($sqlUsulan2);
	while($rowUsulan2 = mysqli_fetch_assoc($resultUsulan2)) {
		  $dataAll = $rowUsulan2;
	}

	$SatkerAwal = $dataAll['SatkerUsul'];
	$SatkerTujuan = $dataAll['SatkerTujuan'];
	$Aset_ID_Tujuan = $dataAll['Aset_ID'];

	//NamaSatker
	$sqlSatker = "SELECT NamaSatker FROM satker where kode = '{$SatkerAwal}'";
	$resultSatker = $link->query($sqlSatker);
	$rowSatker = mysqli_fetch_assoc($resultSatker); 
	$NamaSatkerAwal = $rowSatker['NamaSatker'];

	//NomorRegAwal
	$sqlAset = "SELECT * FROM aset where Aset_ID = '{$Aset_ID}'";
	$resultAset = $link->query($sqlAset);
	$detailAset = mysqli_fetch_assoc($resultAset);
	$NomorRegAwal = $detailAset['noRegister'];
	

    //insert mutasi aset			
	$fieldPA = "Mutasi_ID,Aset_ID,Status,NamaSatkerAwal,SatkerAwal,SatkerTujuan,NomorRegAwal,Aset_ID_Tujuan";
    $valuePA = "'{$Mutasi_ID}','{$Aset_ID}','0','{$NamaSatkerAwal}','{$SatkerAwal}','{$SatkerTujuan}','{$NomorRegAwal}','{$Aset_ID_Tujuan}'";
    $queryPA = "INSERT INTO mutasiaset ({$fieldPA}) VALUES ({$valuePA})" or die("Error in the consult.." . mysqli_error($link));	
   	//echo "queryPA : ".$queryPA."\n\n";
    $execPA = $link->query($queryPA);	
    //echo "queryPA : ".$queryPA."\n\n";	
   
    //update usulan aset
	$quertUSA = "UPDATE usulanaset SET StatusPenetapan='1', Penetapan_ID='{$Mutasi_ID}',StatusKonfirmasi = '1'
			WHERE Aset_ID = '{$Aset_ID}' AND Jenis_Usulan = 'MTSKPTLS' 
			AND Usulan_ID IN ({$ListUsul})" or die("Error in the consult.." . mysqli_error($link));	
	$execUSA = $link->query($quertUSA);	
	//echo "quertUS : ".$quertUSA."\n\n";

	
}

$time_end = microtime(true);

//dividing with 60 will give the execution time in minutes other wise seconds
$execution_time = ($time_end - $time_start)/60;

//execution time of the script
echo '<b>Total Execution Time:</b> '.$execution_time.' Mins\n\n';

echo "=================== Process Complete. Thank you ===================\n\n";

?>
