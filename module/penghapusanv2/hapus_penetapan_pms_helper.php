<?php
///include "../../../config/config.php";
include "../../config/database.php";

$link = mysqli_connect($CONFIG['default']['db_host'],$CONFIG['default']['db_user'],$CONFIG['default']['db_pass'],$CONFIG['default']['db_name']) or die("Error " . mysqli_error($link)); 

$idPenetapan = $argv[1];
echo "Id Penetapan : ".$idPenetapan."\n\n";

$time_start = microtime(true);

//get all aset
$sqlListAst = "SELECT Aset_ID FROM penghapusanaset where 
			Penghapusan_ID = '{$idPenetapan}'";
//echo "sqlListAst : ".$sqlListAst."\n\n";

$result = $link->query($sqlListAst); 
if($result){
	$temp = array();
	while($row = mysqli_fetch_assoc($result)) {
		$temp[] = $row['Aset_ID'];

		$asetid = $row['Aset_ID'];

		 echo "Aset_ID : ".$asetid."\n\n";
		//update aset
		$queryAst = "UPDATE aset SET Dihapus=0 WHERE Aset_ID='$asetid'" 
						or die("Error in the consult.." . mysqli_error($link));
		$execAst = $link->query($queryAst);	
		//echo "queryAst: ".$queryAst."\n\n"; 

		//update usulanaset
		$queryUsAst = "UPDATE usulanaset SET StatusKonfirmasi = '2'
					WHERE Penetapan_ID ='$idPenetapan' and Aset_ID = '{$asetid}'" 
						or die("Error in the consult.." . mysqli_error($link));
		$execUsAst = $link->query($queryUsAst);	
		//echo "queryUsAst: ".$queryUsAst."\n\n"; 

		//update usulan
		/*$queryUs = "UPDATE usulan SET StatusPenetapan = '0',
						Penetapan_ID = NULL 
					WHERE Penetapan_ID='$idPenetapan'" 
						or die("Error in the consult.." . mysqli_error($link));
		$execUs = $link->query($queryUs);*/	
		//echo "queryUs: ".$queryUs."\n\n"; 
	}		
}

echo "Total Data List Aset : ".count($temp)."\n\n";

//HAPUS PENETAPAN PENGHAPUSAN DI PENGHAPUSAN ASET
$queryHPS = "DELETE FROM penghapusan where Penghapusan_ID = '{$idPenetapan}' " or die("Error in the consult.." . mysqli_error($link));
    
echo "queryHPS : ".$queryHPS."\n\n";           
$execHPS = $link->query($queryHPS);


//HAPUS ASET DI PENGHAPUSAN ASET
$queryHPSAST = "DELETE FROM penghapusanaset where Penghapusan_ID = '{$idPenetapan}' " or die("Error in the consult.." . mysqli_error($link));
    
echo "queryHPSAST : ".$queryHPSAST."\n\n";           
$execHPSAST = $link->query($queryHPSAST);

$time_end = microtime(true);

//dividing with 60 will give the execution time in minutes other wise seconds
$execution_time = ($time_end - $time_start)/60;

//execution time of the script
echo '<b>Total Execution Time:</b> '.$execution_time.' Mins\n\n';

echo "=================== Process Complete. Thank you ===================\n\n";

?>
