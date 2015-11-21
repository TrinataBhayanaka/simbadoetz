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
// $newTahun = $tahun - 1; 
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


if($tahun == 2014){
$sWhere=" WHERE $status a.AkumulasiPenyusutan IS NULL AND a.PenyusutanPerTaun IS NULL  
			  AND a.kodeSatker='$kodeSatker' AND a.kodeKelompok like '$flagKelompok%' ";
// echo "tahun = 2015";			  
}elseif($tahun >= 2015){
// echo "tahun > 2015";
$sWhere=" WHERE $status a.AkumulasiPenyusutan IS NOT NULL AND a.PenyusutanPerTaun IS NOT NULL  
			  AND a.kodeSatker='$kodeSatker' AND a.kodeKelompok like '$flagKelompok%'";
}		   
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
// echo $sQuery;		
// $time_start = microtime_float();
//select Tgl Penyusutan
$ExeQuery = $DBVAR->query($sQuery) or die($DBVAR->error());
echo "Aset_ID \t kodeKelompok \t NilaiPerolehan \t Tahun \t masa_manfaat \t AkumulasiPenyusutan \t NilaiBuku  \t penyusutan_per_tahun \n";
                   
while($Data = $DBVAR->fetch_array($ExeQuery)){
		$Aset_ID = $Data['Aset_ID'];
		
		//proses perhitungan penyusutan
		$kodeKelompok=$Data['kodeKelompok'];
        $tmp_kode= explode(".", $kodeKelompok);
		$NilaiPerolehan=$Data['NilaiPerolehan'];
        $Tahun=$Data['Tahun'];
        $masa_manfaat=  cek_masamanfaat($tmp_kode[0], $tmp_kode[1], $tmp_kode[2], $DBVAR);
		
		if ($masa_manfaat!=""){
                   $penyusutan_per_tahun=round($NilaiPerolehan/$masa_manfaat)  ;
                   $Tahun_Aktif= $tahun;
                   // $Tahun_Aktif= $tahun - 1;
                   $rentang_tahun_penyusutan = $Tahun_Aktif-$Tahun;
				   if($rentang_tahun_penyusutan>=$masa_manfaat){
                        $AkumulasiPenyusutan = $NilaiPerolehan;
						$NilaiBuku = 0;
						$UmurEkonomis = 0;
                   }else{
                        $AkumulasiPenyusutan=$rentang_tahun_penyusutan*$penyusutan_per_tahun;
						$NilaiBuku=$NilaiPerolehan-$AkumulasiPenyusutan;
						$UmurEkonomis = $masa_manfaat - $rentang_tahun_penyusutan;
				   }
                    
					//update AkumulasiPenyusutan,penyusutan_per_tahun,MasaManfaat
					$QueryAset	  = "UPDATE aset SET MasaManfaat = '$masa_manfaat' ,
													 AkumulasiPenyusutan = '$AkumulasiPenyusutan',	
													 PenyusutanPerTaun = '$penyusutan_per_tahun',
													 NilaiBuku = '$NilaiBuku',
													 UmurEkonomis = '$UmurEkonomis'
									WHERE Aset_ID = '$Aset_ID'";
					$ExeQueryAset = $DBVAR->query($QueryAset);
					//untuk log txt
					echo "$Aset_ID \t $kodeKelompok \t $NilaiPerolehan \t $Tahun \t $masa_manfaat \t $AkumulasiPenyusutan \t $NilaiBuku  \t $penyusutan_per_tahun \n";
                     
					//update AkumulasiPenyusutan,penyusutan_per_tahun,MasaManfaat,NilaiBuku
					if($Data['TipeAset'] == 'B'){
						$tableKib = 'mesin';
						$tableLog = 'log_mesin';
						$QueryKib	  = "UPDATE $tableKib SET MasaManfaat = '$masa_manfaat' ,
													 AkumulasiPenyusutan = '$AkumulasiPenyusutan',	
													 PenyusutanPerTahun = '$penyusutan_per_tahun',
													 NilaiBuku = '$NilaiBuku',
													 UmurEkonomis = '$UmurEkonomis'
										WHERE Aset_ID = '$Aset_ID'";
						$ExeQueryKib = $DBVAR->query($QueryKib);
						
					}elseif($Data['TipeAset'] == 'C'){
						$tableKib = 'bangunan';
						$tableLog = 'log_bangunan';
						$QueryKib	  = "UPDATE $tableKib SET MasaManfaat = '$masa_manfaat' ,
													 AkumulasiPenyusutan = '$AkumulasiPenyusutan',	
													 PenyusutanPerTahun = '$penyusutan_per_tahun',
													 NilaiBuku = '$NilaiBuku',
													 UmurEkonomis = '$UmurEkonomis'
										WHERE Aset_ID = '$Aset_ID'";
						$ExeQueryKib = $DBVAR->query($QueryKib);
						
					}elseif($Data['TipeAset'] == 'D'){
						$tableKib = 'jaringan';
						$tableLog = 'log_jaringan';
						$QueryKib	  = "UPDATE $tableKib SET MasaManfaat = '$masa_manfaat' ,
													 AkumulasiPenyusutan = '$AkumulasiPenyusutan',	
													 PenyusutanPerTahun = '$penyusutan_per_tahun',
													 NilaiBuku = '$NilaiBuku',
													 UmurEkonomis = '$UmurEkonomis'
										WHERE Aset_ID = '$Aset_ID'";
						$ExeQueryKib = $DBVAR->query($QueryKib);
					}
		
					
					//select field dan value tabel kib
					$QueryKibSelect	  = "SELECT * FROM $tableKib WHERE Aset_ID = '$Aset_ID'";
					$exequeryKibSelect = $DBVAR->query($QueryKibSelect);
					$resultqueryKibSelect = $DBVAR->fetch_object($exequeryKibSelect);
					
					$tmpField = array();
					$tmpVal = array();
					$sign = "'"; 
					foreach ($resultqueryKibSelect as $key => $val) {
						$tmpField[] = $key;
						if ($val ==''){
							$tmpVal[] = $sign."NULL".$sign;
						}else{
							$tmpVal[] = $sign.addslashes($val).$sign;
						}
					}
					
					$implodeField = implode (',',$tmpField);
					$implodeVal = implode (',',$tmpVal);
					if($tahun == 2014){
						$AddField = "action,changeDate,TglPerubahan,NilaiPerolehan_Awal,Kd_Riwayat";
						$action = "Penyusutan_".$tahun."_".$Data['kodeSatker'];
						$changeDate = date('Y-m-d');
						// $TglPerubahan = date('Y-m-d');
						$TglPerubahan = $tahun."-01"."-01";;
						$NilaiPerolehan_Awal = $resultqueryKibSelect->NilaiPerolehan;
						$Kd_Riwayat = '50';
						//insert log
						$QueryLog ="INSERT INTO $tableLog ($implodeField,$AddField) VALUES ($implodeVal,'$action','$changeDate','$TglPerubahan','$NilaiPerolehan_Awal','$Kd_Riwayat')";
						// pr($QueryLog);
						// exit;
						$exeQueryLog = $DBVAR->query($QueryLog);
					}elseif($tahun >= 2015){
						$AddField = "action,changeDate,TglPerubahan,NilaiPerolehan_Awal,AkumulasiPenyusutan_Awal,NilaiBuku_Awal,PenyusutanPerTahun_Awal,Kd_Riwayat";
						$action = "Penyusutan_".$tahun."_".$Data['kodeSatker'];
						$changeDate = date('Y-m-d');
						// $TglPerubahan = date('Y-m-d');
						$TglPerubahan = $tahun."-01"."-01";;
						$NilaiPerolehan_Awal = $resultqueryKibSelect->NilaiPerolehan;
						
						$ceck = $tahun - 2015;
						if($ceck < 1){
							$QueryLogSelect = "select PenyusutanPerTahun,AkumulasiPenyusutan,NilaiBuku from $tableLog where Aset_ID = {$Aset_ID} order by log_id desc limit 1";
							$exeQueryLogSelect = $DBVAR->query($QueryLogSelect);
							$resultQueryLogSelect = $DBVAR->fetch_array($exeQueryLogSelect);
						
							$AkumulasiPenyusutan_Awal = $resultQueryLogSelect['AkumulasiPenyusutan'];
							$NilaiBuku_Awal = $resultQueryLogSelect['NilaiBuku'];
							$PenyusutanPerTahun_Awal = $resultQueryLogSelect['PenyusutanPerTahun'];
						}elseif($ceck == 0 || $ceck > 1){
							$QueryLogSelect = "select PenyusutanPerTahun_Awal,AkumulasiPenyusutan_Awal,NilaiBuku_Awal from $tableLog where Aset_ID = {$Aset_ID} order by log_id desc limit 1";
							$exeQueryLogSelect = $DBVAR->query($QueryLogSelect);
							$resultQueryLogSelect = $DBVAR->fetch_array($exeQueryLogSelect);
						
							$AkumulasiPenyusutan_Awal = $resultQueryLogSelect['AkumulasiPenyusutan_Awal'];
							$NilaiBuku_Awal = $resultQueryLogSelect['NilaiBuku_Awal'];
							$PenyusutanPerTahun_Awal = $resultQueryLogSelect['PenyusutanPerTahun_Awal'];
						}
						
						
						$Kd_Riwayat = '50';
						//insert log
						$QueryLog ="INSERT INTO $tableLog ($implodeField,$AddField) VALUES ($implodeVal,'$action','$changeDate','$TglPerubahan','$NilaiPerolehan_Awal','$AkumulasiPenyusutan_Awal','$NilaiBuku_Awal','$PenyusutanPerTahun_Awal','$Kd_Riwayat')";
						// echo $QueryLog; 
						// pr($QueryLog);
						// exit;
						$exeQueryLog = $DBVAR->query($QueryLog);
					}
					
		}
	}	
	//update table status untuk penyusutan
     $query="update penyusutan_tahun  set StatusRunning=2 where id=$id";
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
