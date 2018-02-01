<?php
///include "../../../config/config.php";
include "../../config/database.php";

$link = mysqli_connect($CONFIG['default']['db_host'],$CONFIG['default']['db_user'],$CONFIG['default']['db_pass'],$CONFIG['default']['db_name']) or die("Error " . mysqli_error($link)); 

$Mutasi_ID = $argv[1];
echo "Id Mutasi : ".$Mutasi_ID."\n\n";

$ListAset = $argv[2];
$sample = array($ListAset);
$expl = explode(",", $sample[0]);
$clearList = array_filter($expl);
echo "Total Data List Aset : ".count($clearList)."\n\n";

$ListUsul = $argv[3];
echo "List Usulan : ".$ListUsul."\n\n";

//start process
$time_start = microtime(true); 

//update usulan
$quertUS = "UPDATE usulan SET StatusPenetapan = '1' , Penetapan_ID = '{$Mutasi_ID}'
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

$temp = array();
foreach ($clearList as $val) {
    # code...
    //counting process loop

    echo "Aset_ID : ".$val."\n\n";
    
    //field untuk mutasiaset
    $sqlUsulan = "SELECT Usulan_ID FROM usulanaset where Aset_ID = '{$val}' AND Usulan_ID IN ({$ListUsul})";
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

	//NamaSatker
	$sqlSatker = "SELECT NamaSatker FROM satker where kode = '{$SatkerAwal}'";
	$resultSatker = $link->query($sqlSatker);
	$rowSatker = mysqli_fetch_assoc($resultSatker); 
	$NamaSatkerAwal = $rowSatker['NamaSatker'];

	//NomorRegAwal
	$sqlAset = "SELECT * FROM aset where Aset_ID = '{$val}'";
	$resultAset = $link->query($sqlAset);
	$detailAset = mysqli_fetch_assoc($resultAset);
	$NomorRegAwal = $detailAset['noRegister'];
	
	$kodeSatker = explode('.', $SatkerTujuan);

	$kodeLokasi = "12.11.33.".$kodeSatker[0].".".$kodeSatker[1].".".substr($detailAset['Tahun'],-2).".".$kodeSatker[2].".".$kodeSatker[3];

	//NomorRegBaru
	$sqlAsetNew = "SELECT noRegister FROM aset WHERE kodeKelompok = '{$detailAset['kodeKelompok']}' AND kodeLokasi = '{$kodeLokasi}' ORDER BY noRegister DESC LIMIT 1";
	$resultAsetNew = $link->query($sqlAsetNew);
	$detailAsetNew = mysqli_fetch_assoc($resultAsetNew);
	if($detailAsetNew['noRegister'] == ''){
        $startreg = 0; 
        $NomorRegBaru = $startreg + 1;
    }else{
    	$NomorRegBaru = $detailAsetNew['noRegister'] + 1;
    }

    //insert mutasi aset			
	$fieldPA = "Mutasi_ID,Aset_ID,Status,NamaSatkerAwal,SatkerAwal,SatkerTujuan,NomorRegAwal,NomorRegBaru";
    $valuePA = "'{$Mutasi_ID}','{$val}','0','{$NamaSatkerAwal}','{$SatkerAwal}','{$SatkerTujuan}','{$NomorRegAwal}','{$NomorRegBaru}'";
    $queryPA = "INSERT INTO mutasiaset ({$fieldPA}) VALUES ({$valuePA})" or die("Error in the consult.." . mysqli_error($link));	
   	//echo "queryPA : ".$queryPA."\n\n";
    $execPA = $link->query($queryPA);	
    //echo "queryPA : ".$queryPA."\n\n";

    //update usulan aset
	$quertUSA = "UPDATE usulanaset SET StatusPenetapan='1', Penetapan_ID='{$Mutasi_ID}',StatusKonfirmasi = '1'
			WHERE Aset_ID = '{$val}' AND Jenis_Usulan = 'MTS' 
			AND Usulan_ID IN ({$ListUsul})" or die("Error in the consult.." . mysqli_error($link));	
	$execUSA = $link->query($quertUSA);	
	//echo "quertUS : ".$quertUSA."\n\n";

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
				$quertUSATlk = "UPDATE usulanaset SET StatusPenetapan = '1', StatusKonfirmasi = '2',Penetapan_ID = '{$Mutasi_ID}'
						WHERE Aset_ID = '{$needle}' AND Jenis_Usulan = 'MTS'
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
