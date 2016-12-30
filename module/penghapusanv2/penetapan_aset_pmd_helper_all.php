<?php
///include "../../../config/config.php";
include "../../config/database.php";

$link = mysqli_connect($CONFIG['default']['db_host'],$CONFIG['default']['db_user'],$CONFIG['default']['db_pass'],$CONFIG['default']['db_name']) or die("Error " . mysqli_error($link)); 

$idPenghapusan = $argv[1];
echo "Id Penghapusan : ".$idPenghapusan."\n\n";

$ListUsul = $argv[2];
echo "List Usulan : ".$ListUsul."\n\n";

//start process
$time_start = microtime(true); 

//update usulan masih salah ga bisa pake in
$quertUS = "UPDATE usulan SET StatusPenetapan = '1' , 
				Penetapan_ID = '{$idPenghapusan}'
			WHERE Usulan_ID IN ({$ListUsul})"
			or die("Error in the consult.." . mysqli_error($link));  
$execUS = $link->query($quertUS);	
//echo "quertUS : ".$quertUS."\n\n";

//update penghapusan
$queryPnghps = "UPDATE penghapusan SET FixPenghapusan = '1',Status='2', 
				Usulan_ID = '{$ListUsul}' 
				WHERE Penghapusan_ID = '{$idPenghapusan}'" or die("Error in the consult.." . mysqli_error($link));
$execPnghps = $link->query($queryPnghps);	
//echo "queryPnghps : ".$queryPnghps."\n\n";

//get all aset
$sqlAst = "SELECT Aset_ID,jenis_hapus FROM usulanaset where 
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
	$Aset_ID = ''; $jenis_hapus = '';
	$Aset_ID = $val['Aset_ID'];
	$jenis_hapus = $val['jenis_hapus'];
    
    echo "Aset_ID : ".$Aset_ID."\n\n";
    
    //insert penghapusan aset			
	$fieldPA = "Penghapusan_ID,Aset_ID,Status,jenis_hapus,jenis_penghapusan";
    $valuePA = "'{$idPenghapusan}','{$Aset_ID}','0','PMD','{$jenis_hapus}'";
    $queryPA = "INSERT INTO penghapusanaset ({$fieldPA}) VALUES ({$valuePA})" or die("Error in the consult.." . mysqli_error($link));	
    $execPA = $link->query($queryPA);	
    //echo "queryPA : ".$queryPA."\n\n";

    //update usulan aset
	$quertUSA = "UPDATE usulanaset SET StatusPenetapan='1', Penetapan_ID='{$idPenghapusan}',StatusKonfirmasi = '1'
			WHERE Aset_ID = '{$Aset_ID}' AND Jenis_Usulan = 'PMD' 
			AND Usulan_ID IN ({$ListUsul})" or die("Error in the consult.." . mysqli_error($link));	
	$execUSA = $link->query($quertUSA);	
	//echo "quertUS : ".$quertUSA."\n\n";

	//update aset
	$quertAST = "UPDATE aset SET Dihapus='1'
		WHERE Aset_ID = '{$Aset_ID}'" or die("Error in the consult.." . mysqli_error($link));	
	$execAST = $link->query($quertAST);	
	//echo "quertAST : ".$quertAST."\n\n";
	//
	//update penghapusan

	
}
$queryPnghps = "UPDATE penghapusan SET FixPenghapusan = '1',Status='0', 
				Usulan_ID = '{$ListUsul}' 
				WHERE Penghapusan_ID = '{$idPenghapusan}'" or die("Error in the consult.." . mysqli_error($link));
$execPnghps = $link->query($queryPnghps);	
$time_end = microtime(true);

//dividing with 60 will give the execution time in minutes other wise seconds
$execution_time = ($time_end - $time_start)/60;

//execution time of the script
echo '<b>Total Execution Time:</b> '.$execution_time.' Mins\n\n';

echo "=================== Process Complete. Thank you ===================\n\n";

?>
