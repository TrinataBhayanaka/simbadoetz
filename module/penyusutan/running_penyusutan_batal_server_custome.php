<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
#This code provided by:
#Andreas Hadiyono (andre.hadiyono@gmail.com)
#Gunadarma University
error_reporting(0);
include "../../config/config.php";
$Penyusutan_ID=$argv[1];
$Satker=$argv[2];

//hapus tabel penyusutan
$queryDelPnystn = "DELETE FROM penyusutan WHERE Penyusutan_ID	='{$Penyusutan_ID}'";	
$exeDelPnystn = $DBVAR->query($queryDelPnystn) or die($DBVAR->error());

//hapus tabel penyusutan
$queryDelPnystnAset = "DELETE FROM penyusutanaset WHERE Penyusutan_ID	='{$Penyusutan_ID}'";	
$exeDelPnystnAset = $DBVAR->query($queryDelPnystnAset) or die($DBVAR->error());

//update Penetapan_ID =  NULL dan StatusPenetapan = 0    
$QueryUpdateUsulan	  = "UPDATE usulan SET Penetapan_ID = NULL ,
											 StatusPenetapan = '0'
							WHERE Penetapan_ID = '$Penyusutan_ID'";
$ExeUpdateUsulan = $DBVAR->query($QueryUpdateUsulan);

//update Penetapan_ID =  NULL dan StatusPenetapan = 0    
$QueryUpdateUsulanAset	  = "UPDATE usulanaset SET 	StatusPenetapan = NULL ,
											 StatusKonfirmasi = '0',
											 Penetapan_ID = NULL
							WHERE Penetapan_ID = '$Penyusutan_ID'";
$ExeUpdateUsulanAset = $DBVAR->query($QueryUpdateUsulanAset);

              
//select Penyusutan_ID
$queryPenyusutan = "SELECT Aset_ID,Tahun FROM penyusutan_pertahun WHERE Penyusutan_ID	='{$Penyusutan_ID}'";	
$exePenyusutan = $DBVAR->query($queryPenyusutan) or die($DBVAR->error());
$data = $DBVAR->fetch_object($exePenyusutan);
// pr($data);
$datAset = $data->Aset_ID;
$tahun = $data->Tahun;
$ArrData = explode(',',$datAset);
$hitung = count($ArrData);
 // exit;
for($i = 0; $i < $hitung; $i++){
		$Aset_ID = $ArrData[$i];
			//berlaku untuk penyustan pertama kali saja
			//update AkumulasiPenyusutan,penyusutan_per_tahun,MasaManfaat
			$QueryAset	  = "UPDATE aset SET MasaManfaat = NULL ,
											 AkumulasiPenyusutan = NULL,	
											 PenyusutanPerTaun = NULL
							WHERE Aset_ID = '$Aset_ID'";
			$ExeQueryAset = $DBVAR->query($QueryAset);
			//untuk log txt
			// echo "$Aset_ID  \n";
			
			$queryTipeAset = "SELECT TipeAset FROM aset WHERE Aset_ID = '$Aset_ID'";
			$exequeryTipeAset = $DBVAR->query($queryTipeAset);
			$resultqueryTipeAset = $DBVAR->fetch_array($exequeryTipeAset);
			
			//update AkumulasiPenyusutan,penyusutan_per_tahun,MasaManfaat,NilaiBuku
			if($resultqueryTipeAset['TipeAset'] == 'A'){
				$tableKib = 'tanah';
				$tableLog = 'log_tanah';
			}elseif($resultqueryTipeAset['TipeAset'] == 'B'){
				$tableKib = 'mesin';
				$tableLog = 'log_mesin';
			}elseif($resultqueryTipeAset['TipeAset'] == 'C'){
				$tableKib = 'bangunan';
				$tableLog = 'log_bangunan';
			}elseif($resultqueryTipeAset['TipeAset'] == 'D'){
				$tableKib = 'jaringan';
				$tableLog = 'log_jaringan';
			}elseif($resultqueryTipeAset['TipeAset'] == 'E'){
				$tableKib = 'asetlain';
				$tableLog = 'log_asetlain';
			}elseif($resultqueryTipeAset['TipeAset'] == 'F'){
				$tableKib = 'kdp';
				$tableLog = 'log_kdp';
			}

			$QueryKib	  = "UPDATE $tableKib SET MasaManfaat = NULL ,
												 AkumulasiPenyusutan = NULL,	
												 PenyusutanPerTahun = NULL,
												 NilaiBuku = NULL
							WHERE Aset_ID = '$Aset_ID'";
			$ExeQueryKib = $DBVAR->query($QueryKib);
			
		   //insert log
		    $action = "Penyusutan_".$Satker.'_'.$Penyusutan_ID;
			$QueryLog ="DELETE FROM $tableLog WHERE  Aset_ID = '$Aset_ID' and Kd_Riwayat = '50' and kodeSatker = '$Satker' and action like '$action%' and YEAR(TglPerubahan) = {$tahun}";
			// pr($QueryLog);
			// exit;
			$exeQueryLog = $DBVAR->query($QueryLog);
		// exit;
	}
	 
    //update table status untuk penyusutan
     $query="update  penyusutan_pertahun  set Penyusutan_ID = NUll where Penyusutan_ID=$Penyusutan_ID";
     $DBVAR->query($query) or die($DBVAR->error());
    
    function cek_masamanfaat($kd_aset1,$kd_aset2,$kd_aset3,$DBVAR){
         $query="select * from ref_masamanfaat where kd_aset1='$kd_aset1' "
                 . " and kd_aset2='$kd_aset2' and kd_aset3='$kd_aset3' ";
            $result=$DBVAR->query($query) or die($DBVAR->error());
          while($row=$DBVAR->fetch_object($result)){
               $masa_manfaat=$row->masa_manfaat;
          }
          return $masa_manfaat;
    }
	
    function microtime_float()
{
    list($usec, $sec) = explode(" ", microtime());
    return ((float)$usec + (float)$sec);
}
    
?>
