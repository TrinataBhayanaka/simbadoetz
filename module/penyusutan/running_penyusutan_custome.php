<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
#This code provided by:
#Andreas Hadiyono (andre.hadiyono@gmail.com)
#Gunadarma University
include "../../config/config.php";

$Penyusutan_ID = $_GET['idPenyusutan'];	
$queryPenyusutan = "SELECT Penyusutan_ID,StatusRunning FROM penyusutan_pertahun WHERE Penyusutan_ID	='{$Penyusutan_ID}'";
$exePenyusutan = $DBVAR->query($queryPenyusutan) or die($DBVAR->error());
$data = $DBVAR->fetch_object($exePenyusutan);	
$status_running = $data->StatusRunning;
				 
session_write_close();                    
// if($status_running==0){
	if($status_running==0){
		$query="update  penyusutan_pertahun  set StatusRunning=1 where Penyusutan_ID=$Penyusutan_ID";
		$DBVAR->query($query) or die($DBVAR->error());
		 
		$status=exec("php running_penyusutan_server_custome.php $Penyusutan_ID > log/penyusutan-custome.txt 2>&1 &");
		header('Location: validasi_pnystn.php?pid=1');
	}
	 // else if($status_running==1 || $status_running==2){
		// redirect($url_rewrite.'/module/penyusutan/validasi_pnystn.php?pid=1');
	// }
	
	/*$query="update  penyusutan_pertahun  set StatusRunning=1 where Penyusutan_ID=$Penyusutan_ID";
	$DBVAR->query($query) or die($DBVAR->error());
	// $status=exec("php running_penyusutan_server_custome.php $Penyusutan_ID > log/penyusutan-custome.txt &");
	
	//dummy
	$Penyusutan_ID=$data->Penyusutan_ID;
	//select Tgl Penyusutan
	$queryTglPenyusutan = "SELECT TglPenyusutan FROM penyusutan WHERE Penyusutan_ID	='{$Penyusutan_ID}'";	
	$exeTglPenyusutan = $DBVAR->query($queryTglPenyusutan) or die($DBVAR->error());
	$TglPenyusutan = $DBVAR->fetch_object($exeTglPenyusutan);
	//select Penyusutan_ID
	$queryPenyusutan = "SELECT Aset_ID FROM penyusutan_pertahun WHERE Penyusutan_ID	='{$Penyusutan_ID}'";	
	$exePenyusutan = $DBVAR->query($queryPenyusutan) or die($DBVAR->error());
	$data = $DBVAR->fetch_array($exePenyusutan);
	$ArrData = explode(',',$data['Aset_ID']);
	// pr($ArrData);
	$hitung = count($ArrData);
	for($i = 0; $i < $hitung; $i++){
			$Aset_ID = $ArrData[$i];
			// pr($Aset_ID);
			$queryTipeAset = "SELECT TipeAset,kodeKelompok,NilaiPerolehan,Tahun,kodeSatker FROM aset WHERE Aset_ID = '$Aset_ID'";
			// echo $queryTipeAset;
			$exequeryTipeAset = $DBVAR->query($queryTipeAset);
			$resultqueryTipeAset = $DBVAR->fetch_array($exequeryTipeAset);
			// pr($resultqueryTipeAset);
			//proses perhitungan penyusutan
			$kodeKelompok=$resultqueryTipeAset['kodeKelompok'];
			// pr($kodeKelompok);
			$tmp_kode= explode(".", $kodeKelompok);
			// pr($tmp_kode);
			$NilaiPerolehan=$resultqueryTipeAset['NilaiPerolehan'];
			// pr($NilaiPerolehan);
			$Tahun=$resultqueryTipeAset['Tahun'];
			// pr($Tahun);
			$masa_manfaat=  cek_masamanfaat($tmp_kode[0], $tmp_kode[1], $tmp_kode[2], $DBVAR);
			// pr($masa_manfaat);
			
			if ($masa_manfaat!=""){
					   $penyusutan_per_tahun=round($NilaiPerolehan/$masa_manfaat)  ;
					   $Tahun_Aktif=date("Y");
					   $rentang_tahun_penyusutan=$Tahun_Aktif - $Tahun;
					   // pr("rt".$rentang_tahun_penyusutan);
					   if($rentang_tahun_penyusutan>=$masa_manfaat){
							//$AkumulasiPenyusutan=$masa_manfaat*$penyusutan_per_tahun;
							$AkumulasiPenyusutan=$NilaiPerolehan;
							$NilaiBuku = $NilaiPerolehan;
					   }else{
							$AkumulasiPenyusutan=$rentang_tahun_penyusutan*$penyusutan_per_tahun;
							$NilaiBuku=$NilaiPerolehan-$AkumulasiPenyusutan;
					   }
						// pr("pp".$penyusutan_per_tahun);
						// pr("ap".$AkumulasiPenyusutan);
						// pr("nb".$NilaiBuku);
						// exit;
						//update AkumulasiPenyusutan,penyusutan_per_tahun,MasaManfaat
						$QueryAset	  = "UPDATE aset SET MasaManfaat = '$masa_manfaat' ,
														 AkumulasiPenyusutan = '$AkumulasiPenyusutan',	
														 PenyusutanPerTaun = '$penyusutan_per_tahun'
										WHERE Aset_ID = '$Aset_ID'";
						// echo 		$QueryAset;		
						$ExeQueryAset = $DBVAR->query($QueryAset);
						//untuk log txt
						// echo "$Aset_ID \t $kodeKelompok \t $NilaiPerolehan \t $Tahun \t $masa_manfaat \t $AkumulasiPenyusutan \t $NilaiBuku  \t $penyusutan_per_tahun \n";
						// exit; 
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
														 PenyusutanPerTaun = '$penyusutan_per_tahun',
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
						// pr($resultqueryKibSelect);
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
						// exit;
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
	// $time_end = microtime_float();
    // $time = $time_end - $time_start;
    // echo "Waktu proses: $time seconds ";
    
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
	redirect($url_rewrite.'/module/penyusutan/validasi_pnystn.php?pid=1');
// }  
 */
?>
