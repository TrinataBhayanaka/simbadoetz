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
                   
// $time_start = microtime_float();
//select Tgl Penyusutan
$queryTglPenyusutan = "SELECT TglPenyusutan FROM penyusutan WHERE Penyusutan_ID	='{$Penyusutan_ID}'";	
$exeTglPenyusutan = $DBVAR->query($queryTglPenyusutan) or die($DBVAR->error());
$TglPenyusutan = $DBVAR->fetch_object($exeTglPenyusutan);
// pr($TglPenyusutan);
//select Penyusutan_ID
$queryPenyusutan = "SELECT Aset_ID FROM penyusutan_pertahun WHERE Penyusutan_ID	='{$Penyusutan_ID}'";	
$exePenyusutan = $DBVAR->query($queryPenyusutan) or die($DBVAR->error());
$data = $DBVAR->fetch_object($exePenyusutan);
// pr($data);
$ArrData = explode(',',$data->Aset_ID);
$hitung = count($ArrData);
 // exit;
for($i = 0; $i < $hitung; $i++){
		$Aset_ID = $ArrData[$i];
		$queryTipeAset = "SELECT TipeAset,kodeKelompok,NilaiPerolehan,Tahun,kodeSatker FROM aset WHERE Aset_ID = '$Aset_ID'";
		$exequeryTipeAset = $DBVAR->query($queryTipeAset);
		$resultqueryTipeAset = $DBVAR->fetch_array($exequeryTipeAset);
		
		//proses perhitungan penyusutan
		$kodeKelompok=$resultqueryTipeAset['kodeKelompok'];
        $tmp_kode= explode(".", $kodeKelompok);
		$NilaiPerolehan=$resultqueryTipeAset['NilaiPerolehan'];
        $Tahun=$resultqueryTipeAset['Tahun'];
        $masa_manfaat=  cek_masamanfaat($tmp_kode[0], $tmp_kode[1], $tmp_kode[2], $DBVAR);
		
		if ($masa_manfaat!=""){
                   $penyusutan_per_tahun=round($NilaiPerolehan/$masa_manfaat)  ;
                   $Tahun_Aktif=date("Y");
                   $rentang_tahun_penyusutan=$Tahun_Aktif-$Tahun;
                   if($rentang_tahun_penyusutan>=$masa_manfaat){
                        //$AkumulasiPenyusutan=$masa_manfaat*$penyusutan_per_tahun;
                        $AkumulasiPenyusutan=$NilaiPerolehan;
						$NilaiBuku = 0;
                   }else{
                        $AkumulasiPenyusutan=$rentang_tahun_penyusutan*$penyusutan_per_tahun;
						$NilaiBuku=$NilaiPerolehan-$AkumulasiPenyusutan;
				   }
                    
					//update AkumulasiPenyusutan,penyusutan_per_tahun,MasaManfaat
					$QueryAset	  = "UPDATE aset SET MasaManfaat = '$masa_manfaat' ,
													 AkumulasiPenyusutan = '$AkumulasiPenyusutan',	
													 PenyusutanPerTaun = '$penyusutan_per_tahun'
									WHERE Aset_ID = '$Aset_ID'";
					$ExeQueryAset = $DBVAR->query($QueryAset);
					//untuk log txt
					echo "$Aset_ID \t $kodeKelompok \t $NilaiPerolehan \t $Tahun \t $masa_manfaat \t $AkumulasiPenyusutan \t $NilaiBuku  \t $penyusutan_per_tahun \n";
                     
					//update AkumulasiPenyusutan,penyusutan_per_tahun,MasaManfaat,NilaiBuku
					if($resultqueryTipeAset['TipeAset'] == 'A'){
						$tableKib = 'tanah';
						$tableLog = 'log_tanah';
					}elseif($resultqueryTipeAset['TipeAset'] == 'B'){
						$tableKib = 'mesin';
						$tableLog = 'log_mesin';
						$QueryKib	  = "UPDATE $tableKib SET MasaManfaat = '$masa_manfaat' ,
													 AkumulasiPenyusutan = '$AkumulasiPenyusutan',	
													 PenyusutanPerTahun = '$penyusutan_per_tahun',
													 NilaiBuku = '$NilaiBuku'
										WHERE Aset_ID = '$Aset_ID'";
						$ExeQueryKib = $DBVAR->query($QueryKib);
						
					}elseif($resultqueryTipeAset['TipeAset'] == 'C'){
						$tableKib = 'bangunan';
						$tableLog = 'log_bangunan';
						$QueryKib	  = "UPDATE $tableKib SET MasaManfaat = '$masa_manfaat' ,
													 AkumulasiPenyusutan = '$AkumulasiPenyusutan',	
													 PenyusutanPerTahun = '$penyusutan_per_tahun',
													 NilaiBuku = '$NilaiBuku'
										WHERE Aset_ID = '$Aset_ID'";
						$ExeQueryKib = $DBVAR->query($QueryKib);
						
					}elseif($resultqueryTipeAset['TipeAset'] == 'D'){
						$tableKib = 'jaringan';
						$tableLog = 'log_jaringan';
						$QueryKib	  = "UPDATE $tableKib SET MasaManfaat = '$masa_manfaat' ,
													 AkumulasiPenyusutan = '$AkumulasiPenyusutan',	
													 PenyusutanPerTahun = '$penyusutan_per_tahun',
													 NilaiBuku = '$NilaiBuku'
										WHERE Aset_ID = '$Aset_ID'";
						$ExeQueryKib = $DBVAR->query($QueryKib);
						
					}elseif($resultqueryTipeAset['TipeAset'] == 'E'){
						$tableKib = 'asetlain';
						$tableLog = 'log_asetlain';
					}elseif($resultqueryTipeAset['TipeAset'] == 'F'){
						$tableKib = 'kdp';
						$tableLog = 'log_kdp';
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
					
					$AddField = "action,changeDate,TglPerubahan,NilaiPerolehan_Awal,Kd_Riwayat";
					$action = "Penyusutan_".$resultqueryTipeAset['kodeSatker'].'_'.$Penyusutan_ID;
					$changeDate = date('Y-m-d');
					$TglPerubahan = $TglPenyusutan->TglPenyusutan;
					$NilaiPerolehan_Awal = $resultqueryKibSelect->NilaiPerolehan;
					$Kd_Riwayat = '50';
					// echo "sampe sini";
				   //insert log
					$QueryLog ="INSERT INTO $tableLog ($implodeField,$AddField) VALUES ($implodeVal,'$action','$changeDate','$TglPerubahan','$NilaiPerolehan_Awal','$Kd_Riwayat')";
					// pr($QueryLog);
					// exit;
					$exeQueryLog = $DBVAR->query($QueryLog);
		}
		// exit;
	}
	 
    //update table status untuk penyusutan
     $query="update  penyusutan_pertahun  set StatusRunning=2 where Penyusutan_ID=$Penyusutan_ID";
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
