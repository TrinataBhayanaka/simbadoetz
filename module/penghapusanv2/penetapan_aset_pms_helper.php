<?php
///include "../../../config/config.php";
include "../../config/database.php";

$link = mysqli_connect($CONFIG['default']['db_host'],$CONFIG['default']['db_user'],$CONFIG['default']['db_pass'],$CONFIG['default']['db_name']) or die("Error " . mysqli_error($link)); 

$idPenghapusan = $argv[1];
echo "Id Penghapusan : ".$idPenghapusan."\n\n";

$ListAset = $argv[2];
$sample = array($ListAset);
$expl = explode(",", $sample[0]);
$clearList = array_filter($expl);
echo "Total Data List Aset : ".count($clearList)."\n\n";

$ListUsul = $argv[3];
echo "List Usulan : ".$ListUsul."\n\n";

//start process
$time_start = microtime(true); 

//update usulan masih salah ga bisa pake in
$quertUS = "UPDATE usulan SET StatusPenetapan = '1' , Penetapan_ID = '{$idPenghapusan}'
			WHERE Usulan_ID IN ({$ListUsul})"
			or die("Error in the consult.." . mysqli_error($link));  
$execUS = $link->query($quertUS);	

//echo "quertUS : ".$quertUS."\n\n";

//update penghapusan
$queryPnghps = "UPDATE penghapusan SET FixPenghapusan = '1',Usulan_ID = '{$ListUsul}' 
				WHERE Penghapusan_ID = '{$idPenghapusan}'" or die("Error in the consult.." . mysqli_error($link));
$execPnghps = $link->query($queryPnghps);	
//echo "queryPnghps : ".$queryPnghps."\n\n";

$temp = array();
foreach ($clearList as $val) {
    # code...
    //counting process loop
	//get jenis_hapus
    $sql = "SELECT jenis_hapus FROM usulanaset where Usulan_ID in ({$ListUsul}) 
    		AND Aset_ID ='{$val}'";
	$result = $link->query($sql); 
	while($row = mysqli_fetch_assoc($result)) {
		  $jns_hps = $row['jenis_hapus'];
	} 

	$jenis_hapus = $jns_hps;

    echo "Aset_ID : ".$val."\n\n";
    
    //insert penghapusan aset			
	$fieldPA = "Penghapusan_ID,Aset_ID,Status,jenis_hapus,jenis_penghapusan";
    $valuePA = "'{$idPenghapusan}','{$val}','0','PMS','{$jenis_hapus}'";
    $queryPA = "INSERT INTO penghapusanaset ({$fieldPA}) VALUES ({$valuePA})" or die("Error in the consult.." . mysqli_error($link));	
    $execPA = $link->query($queryPA);	
    //echo "queryPA : ".$queryPA."\n\n";

    //update usulan aset
	$quertUSA = "UPDATE usulanaset SET StatusPenetapan='1', Penetapan_ID='{$idPenghapusan}',StatusKonfirmasi = '1'
			WHERE Aset_ID = '{$val}' AND Jenis_Usulan = 'PMS' 
			AND Usulan_ID IN ({$ListUsul})" or die("Error in the consult.." . mysqli_error($link));	
	$execUSA = $link->query($quertUSA);	
	//echo "quertUS : ".$quertUSA."\n\n";

	//update aset
	$quertAST = "UPDATE aset SET Dihapus='1'
		WHERE Aset_ID = '{$val}'" or die("Error in the consult.." . mysqli_error($link));	
	$execAST = $link->query($quertAST);	
	//echo "quertAST : ".$quertAST."\n\n";

	//temp array untk matching data
	$temp[] = $val;
}
//print_r($temp);
//reverse array penetapan
if($temp){
	$ListAsetFix = array();
	foreach(array_values($temp) as $v){
    	$ListAsetFix[$v] = 1;
	}
	//print_r($ListAsetFix);
	$sqlLsUS = "SELECT Aset_ID FROM usulanaset where Usulan_ID in ({$ListUsul})";
	$resultLsUS = $link->query($sqlLsUS);
	$ListAsetTotal =array(); 
	while($rows = mysqli_fetch_assoc($resultLsUS)) {
		  $ListAsetTotal[] = $rows['Aset_ID'];
	}
	//print_r($ListAsetTotal);
	 
	if($ListAsetTotal){
		//list Aset
        foreach($ListAsetTotal as $asetidAset){
            //list Aset_ID yang pernah diusulkan
            $needle = $asetidAset;
            //print_r($needle);
            //matching
            if (!isset($ListAsetFix[$needle])){
                
                echo "Aset_ID Tolak : ".$needle."\n\n";
                
                //list aset yg ditolak
            	//update usulan aset
				$quertUSATlk = "UPDATE usulanaset SET StatusPenetapan = '1', StatusKonfirmasi = '2',Penetapan_ID = '{$idPenghapusan}'
						WHERE Aset_ID = '{$needle}' AND Jenis_Usulan = 'PMS'
						AND Usulan_ID IN ({$ListUsul})
						" or die("Error in the consult.." . mysqli_error($link));	 
				$execUSATlk = $link->query($quertUSATlk);	
				//echo "quertUSATlk : ".$quertUSATlk."\n\n";
            }else{

            	 echo "Aset_ID Terima : ".$needle."\n\n";	
            }                        
        }    
	}

}

$time_end = microtime(true);

//dividing with 60 will give the execution time in minutes other wise seconds
$execution_time = ($time_end - $time_start)/60;

//execution time of the script
echo '<b>Total Execution Time:</b> '.$execution_time.' Mins\n\n';

echo "=================== Process Complete. Thank you ===================\n\n";

?>
