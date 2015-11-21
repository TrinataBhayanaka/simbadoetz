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

$kib 	= $argv[1];
$tahun 	= $argv[2];
$kodeSatker=$argv[3];
$id=$argv[4];

/*if($tahun == 2014 || $tahun == 2015){
	$newTahun = '2014';
}else{
	$newTahun = $tahun - 1; 
}*/
$newTahun = $tahun - 1; 

$aColumns = array('a.Aset_ID','a.kodeKelompok','k.Uraian','a.Tahun','a.Info','a.NilaiPerolehan','a.noRegister','a.PenyusutanPerTaun','a.AkumulasiPenyusutan','a.TipeAset','a.kodeSatker','a.StatusValidasi','a.Status_Validasi_Barang');
$fieldCustom = str_replace(" , ", " ", implode(", ", $aColumns));
$sTable = "aset as a";
$sTable_inner_join_kelompok = "kelompok as k";
$cond_kelompok ="k.Kode = a.kodeKelompok ";
$status = "a.StatusValidasi = 1 AND a.Status_Validasi_Barang = 1 AND";


if($kib == 'B'){ 
	$flagKelompok = '02';
	$AddCondtn_1 = "AND a.kodeLokasi like '12%' AND a.kondisi !='3' AND a.kodeKA = '1'
					AND a.TglPerolehan >='0000-00-00' AND a.TglPerolehan < '2008-01-01'
					AND a.TglPembukuan >='0000-00-00' AND a.TglPembukuan <= '$newTahun-12-31'";
			
	$AddCondtn_2 = "AND a.kodeLokasi like '12%' AND a.kondisi !='3' AND (a.NilaiPerolehan >=300000 OR kodeKA = '1') 
					AND a.TglPerolehan >='2008-01-01' AND a.TglPerolehan < '$newTahun-12-31'
					AND a.TglPembukuan >='0000-00-00' AND a.TglPembukuan <= '$newTahun-12-31'";				   
}elseif($kib == 'C'){
	$flagKelompok = '03';
	$AddCondtn_1 = "AND a.kodeLokasi like '12%' AND a.kondisi !='3' AND a.kodeKA = '1'
					AND a.TglPerolehan >='0000-00-00' AND a.TglPerolehan < '2008-01-01'
					AND a.TglPembukuan >='0000-00-00' AND a.TglPembukuan <= '$newTahun-12-31'";
			
	$AddCondtn_2 = "AND a.kodeLokasi like '12%' AND a.kondisi !='3' AND (a.NilaiPerolehan >=10000000 OR kodeKA = '1') 
					AND a.TglPerolehan >='2008-01-01' AND a.TglPerolehan < '$newTahun-12-31'
					AND a.TglPembukuan >='0000-00-00' AND a.TglPembukuan <= '$newTahun-12-31'";
}elseif($kib == 'D'){
	$flagKelompok = '04';
	$AddCondtn_1 = "AND a.kodeLokasi like '12%' AND a.kondisi !='3'
							AND a.TglPerolehan <= '$newTahun-12-31'
							AND a.TglPembukuan <= '$newTahun-12-31'";
	$AddCondtn_2 = "";
}


$sWhere=" WHERE $status a.AkumulasiPenyusutan IS NOT NULL AND a.PenyusutanPerTaun IS NOT NULL  
			  AND a.kodeSatker='$kodeSatker' AND a.kodeKelompok like '$flagKelompok%'";

if($kib == 'B' || $kib == 'C'){ 				   
$sQuery = "
		SELECT $fieldCustom
			FROM   $sTable 
			INNER JOIN $sTable_inner_join_kelompok ON $cond_kelompok
			$sWhere
			$AddCondtn_1 
		UNION ALL
			SELECT $fieldCustom
			FROM   $sTable 
			INNER JOIN $sTable_inner_join_kelompok ON $cond_kelompok
			$sWhere
			$AddCondtn_2 ";	
}elseif($kib == 'D'){
$sQuery = "
		SELECT $fieldCustom
			FROM   $sTable 
			INNER JOIN $sTable_inner_join_kelompok ON $cond_kelompok
			$sWhere
			$AddCondtn_1";
}			
// $time_start = microtime_float();
//select Tgl Penyusutan
$ExeQuery = $DBVAR->query($sQuery) or die($DBVAR->error());
while($Data = $DBVAR->fetch_array($ExeQuery)){
		$Aset_ID = $Data['Aset_ID'];
		
		//proses perhitungan penyusutan
		$kodeKelompok=$Data['kodeKelompok'];
        $tmp_kode= explode(".", $kodeKelompok);
		$NilaiPerolehan=$Data['NilaiPerolehan'];
        $Tahun=$Data['Tahun'];
  
		//cek untuk rollback
			//$ceck = $tahun - 2015;
			
			if($tahun == 2014){
			//update AkumulasiPenyusutan,penyusutan_per_tahun,MasaManfaat
			$QueryAset	  = "UPDATE aset SET MasaManfaat = NULL,
											 AkumulasiPenyusutan = NULL,	
											 PenyusutanPerTaun = NULL,
											 NilaiBuku = NULL,
											 UmurEkonomis = NULL
							WHERE Aset_ID = '$Aset_ID'";
			$ExeQueryAset = $DBVAR->query($QueryAset);
			//untuk log txt
			echo "$Aset_ID \t $kodeKelompok \t $NilaiPerolehan \t $Tahun \t $masa_manfaat \t $AkumulasiPenyusutan \t $NilaiBuku  \t $penyusutan_per_tahun \n";
		 
			//update AkumulasiPenyusutan,penyusutan_per_tahun,MasaManfaat,NilaiBuku
			if($Data['TipeAset'] == 'B'){
				$tableKib = 'mesin';
				$tableLog = 'log_mesin';
				$QueryKib	  = "UPDATE $tableKib SET MasaManfaat = NULL,
											 AkumulasiPenyusutan = NULL,	
											 PenyusutanPerTahun = NULL,
											 NilaiBuku = NULL,
											 UmurEkonomis = NULL
								WHERE Aset_ID = '$Aset_ID'";
				$ExeQueryKib = $DBVAR->query($QueryKib);
				
			}elseif($Data['TipeAset'] == 'C'){
				$tableKib = 'bangunan';
				$tableLog = 'log_bangunan';
				$QueryKib	  = "UPDATE $tableKib SET MasaManfaat = NULL,
											 AkumulasiPenyusutan = NULL,	
											 PenyusutanPerTahun = NULL,
											 NilaiBuku = NULL,
											 UmurEkonomis = NULL
								WHERE Aset_ID = '$Aset_ID'";
				$ExeQueryKib = $DBVAR->query($QueryKib);
				
			}elseif($Data['TipeAset'] == 'D'){
				$tableKib = 'jaringan';
				$tableLog = 'log_jaringan';
				$QueryKib	  = "UPDATE $tableKib SET MasaManfaat = NULL,
											 AkumulasiPenyusutan = NULL,	
											 PenyusutanPerTahun = NULL,
											 NilaiBuku = NULL,
											 UmurEkonomis = NULL
								WHERE Aset_ID = '$Aset_ID'";
				$ExeQueryKib = $DBVAR->query($QueryKib);
			}

		
			$action = "Penyusutan_".$tahun."_".$Data['kodeSatker'];
			
			//insert log
			// $QueryLog ="DELETE FROM $tableLog WHERE  Aset_ID = '{$Aset_ID}' and Kd_Riwayat = '50' and kodeSatker = '{$Data[kodeSatker]}' and action ='{$action}' and YEAR(TglPerubahan) = {$tahun}";
			$QueryLog ="DELETE FROM $tableLog WHERE  Aset_ID = '{$Aset_ID}' and Kd_Riwayat = '50' and kodeSatker = '{$Data[kodeSatker]}' and action ='{$action}'";
			$exeQueryLog = $DBVAR->query($QueryLog);
		}elseif($tahun >= 2015){
				$QueryLogSelect = "select PenyusutanPerTahun_Awal,AkumulasiPenyusutan_Awal,NilaiBuku_Awal,MasaManfaat,UmurEkonomis from $tableLog where Aset_ID = {$Aset_ID} order by log_id desc limit 1";
				$exeQueryLogSelect = $DBVAR->query($QueryLogSelect);
				$resultQueryLogSelect = $DBVAR->fetch_array($exeQueryLogSelect);
			
				$AkumulasiPenyusutan_Awal = $resultQueryLogSelect['AkumulasiPenyusutan_Awal'];
				$NilaiBuku_Awal = $resultQueryLogSelect['NilaiBuku_Awal'];
				$PenyusutanPerTahun_Awal = $resultQueryLogSelect['PenyusutanPerTahun_Awal'];
				$MasaManfaat_Awal = $resultQueryLogSelect['MasaManfaat'];
				$UmurEkonomis = $resultQueryLogSelect['UmurEkonomis'];
				
				//update AkumulasiPenyusutan,penyusutan_per_tahun,MasaManfaat
				$QueryAset	  = "UPDATE aset SET MasaManfaat = '{$MasaManfaat_Awal}',
												 AkumulasiPenyusutan = '{$AkumulasiPenyusutan_Awal}',	
												 PenyusutanPerTaun = '{$PenyusutanPerTahun_Awal}',
												 NilaiBuku = '{$NilaiBuku_Awal}',
												 UmurEkonomis = '{$UmurEkonomis}'
								WHERE Aset_ID = '$Aset_ID'";
				$ExeQueryAset = $DBVAR->query($QueryAset);
				
				//update AkumulasiPenyusutan,penyusutan_per_tahun,MasaManfaat,NilaiBuku
				if($Data['TipeAset'] == 'B'){
					$tableKib = 'mesin';
					$tableLog = 'log_mesin';
					$QueryKib	  = "UPDATE $tableKib SET MasaManfaat = '{$MasaManfaat_Awal}',
												 AkumulasiPenyusutan = '{$AkumulasiPenyusutan_Awal}',	
												 PenyusutanPerTahun = '{$PenyusutanPerTahun_Awal}',
												 NilaiBuku = '{$NilaiBuku_Awal}',
												 UmurEkonomis = '{$UmurEkonomis}'
									WHERE Aset_ID = '{$Aset_ID}'";
					$ExeQueryKib = $DBVAR->query($QueryKib);
					
				}elseif($Data['TipeAset'] == 'C'){
					$tableKib = 'bangunan';
					$tableLog = 'log_bangunan';
					$QueryKib	  = "UPDATE $tableKib SET MasaManfaat = '{$MasaManfaat_Awal}',
												 AkumulasiPenyusutan = '{$AkumulasiPenyusutan_Awal}',	
												 PenyusutanPerTahun = '{$PenyusutanPerTahun_Awal}',
												 NilaiBuku = '{$NilaiBuku_Awal}',
												 UmurEkonomis = '{$UmurEkonomis}'
									WHERE Aset_ID = '{$Aset_ID}'";
					$ExeQueryKib = $DBVAR->query($QueryKib);
					
				}elseif($Data['TipeAset'] == 'D'){
					$tableKib = 'jaringan';
					$tableLog = 'log_jaringan';
					$QueryKib	  = "UPDATE $tableKib SET MasaManfaat = '{$MasaManfaat_Awal}',
												 AkumulasiPenyusutan = '{$AkumulasiPenyusutan_Awal}',	
												 PenyusutanPerTahun = '{$PenyusutanPerTahun_Awal}',
												 NilaiBuku = '{$NilaiBuku_Awal}',
												 UmurEkonomis = '{$UmurEkonomis}'
									WHERE Aset_ID = '{$Aset_ID}'";
					$ExeQueryKib = $DBVAR->query($QueryKib);
				}
				$action = "Penyusutan_".$tahun."_".$Data['kodeSatker'];
				// $QueryLog ="DELETE FROM $tableLog WHERE  Aset_ID = '{$Aset_ID}' and Kd_Riwayat = '50' and kodeSatker = '{$Data[kodeSatker]}' and action ='{$action}' and YEAR(TglPerubahan) = {$tahun}";
				$QueryLog ="DELETE FROM $tableLog WHERE  Aset_ID = '{$Aset_ID}' and Kd_Riwayat = '50' and kodeSatker = '{$Data[kodeSatker]}' and action ='{$action}' ";
				$exeQueryLog = $DBVAR->query($QueryLog);
		
			}
		
		
		}
		
	
		// exit;
	
	 
    //update table status untuk penyusutan
     $query="update penyusutan_tahun  set StatusRunning=0 where id=$id";
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
