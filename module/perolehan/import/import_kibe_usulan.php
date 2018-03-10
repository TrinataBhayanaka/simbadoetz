<?php
//echo $argv[1];
include "../../../config/database.php";
$set = ini_set('memory_limit', '8192M'); 
error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED);
/*echo "<pre>";
print_r($CONFIG);
echo "</pre>";*/
$link = mysqli_connect($CONFIG['default']['db_host'],$CONFIG['default']['db_user'],$CONFIG['default']['db_pass'],$CONFIG['default']['db_name']) or die("Error " . mysqli_error($link)); 

//start process
$time_start = microtime(true); 

$idKontrak = $argv[1];
echo "idKontrak : ".$idKontrak."\n\n";

//get data kontrak
$sqlKontrak = "SELECT * FROM kontrak WHERE id = '{$idKontrak}'";
//echo "sqlKontrak : ".$sqlKontrak."\n\n";
$execKontrak =  $link->query($sqlKontrak);
$rowKontrak = $execKontrak->fetch_assoc();
echo "SATKER AWAL : ".$rowKontrak['kodeSatker']."\n\n";

	//group by satker by  no kontrak from info
	$GroupSatker = array();
	$sqlGroupSatker = "SELECT Info FROM aset WHERE noKontrak = '{$rowKontrak[noKontrak]}' group by Info";
	//echo "sqlGroupSatker : ".$sqlGroupSatker."\n\n";
	$execGroupSatker =  $link->query($sqlGroupSatker);
	while($rowGroupSatker = $execGroupSatker->fetch_assoc()) {
		$GroupSatker[] = $rowGroupSatker;
	}

	if($GroupSatker){
		sort($GroupSatker);
		$num = 1;
		foreach ($GroupSatker as $key => $value) {
			
			$exp = explode(']', $value['Info']);

			$SatkerUsul = $rowKontrak['kodeSatker'];
			$SatkerTujuan = $exp[1]; 
			$Jenis_Usulan = 'MTS';
			$UserNm = '1';
			$TglUpdate  = $rowKontrak['tglKontrak'];
			$FixUsulan = '1';
			$NoUsulan = $value['Info'];
			$KetUsulan = $value['Info'];

			echo "========================================================================================================="."\n\n";
			echo $num."."."SATKER TUJUAN : ".$SatkerTujuan."\n\n";
			echo "INFO : ".$value['Info']."\n\n";
			
			//create dokumen usulan by Info
			$sqlCreateUsulan = "INSERT INTO usulan(SatkerUsul, SatkerTujuan, Jenis_Usulan, UserNm, TglUpdate, FixUsulan, NoUsulan, KetUsulan) VALUES  ('{$SatkerUsul}','{$SatkerTujuan}','{$Jenis_Usulan}','{$UserNm}','{$TglUpdate}','{$FixUsulan}','{$NoUsulan}','{$KetUsulan}')" or die("Error in the consult.." . mysqli_error($link));
			//echo "sqlCreateUsulan : ".$sqlCreateUsulan."\n\n";
			
			$execCreateUsulan = $link->query($sqlCreateUsulan);
			$IDUsulan = mysqli_insert_id($link);
			echo "IDUsulan : ".$IDUsulan."\n\n";
			
			//create dokumen mutasi
			$sqlCreateMutasi = "INSERT INTO mutasi(SatkerUsul, SatkerTujuan, UserNm, TglSKKDH, NoSKKDH, Keterangan,FixMutasi,Usulan_ID) VALUES  ('{$SatkerUsul}','{$SatkerTujuan}','{$UserNm}','{$TglUpdate}','{$NoUsulan}','{$KetUsulan}','0','{$IDUsulan}')" or die("Error in the consult.." . mysqli_error($link));
		    //echo "sqlCreateMutasi : ".$sqlCreateMutasi."\n\n";

			$execCreateMutasi = $link->query($sqlCreateMutasi);
			$IDPenetapanMTS = mysqli_insert_id($link);
			echo "IDPenetapanMTS : ".$IDPenetapanMTS."\n\n";

			//UPDATE FixMutasi PENETAPAN MUTASI DI MUTASI(flag proses input data) 
			$queryUPD = "UPDATE mutasi
				SET FixMutasi = '3'
			where Mutasi_ID = '{$IDPenetapanMTS}' " or die("Error in the consult.." . mysqli_error($link));
			$execUPD = $link->query($queryUPD);

			//select data aset by kodesatker and nokontrak
			$DataAset = array();
			$sqlDataAset = "SELECT * FROM aset WHERE noKontrak = '{$rowKontrak[noKontrak]}' AND Info = '{$value[Info]}'";
			//echo "sqlDataAset : ".$sqlDataAset."\n\n";
			$execDataAset =  $link->query($sqlDataAset);
			while($rowDataAset = $execDataAset->fetch_assoc()) {
				$DataAset[] = $rowDataAset;
			}

			if($DataAset){
				$no = 1;
				$listAsset=array();
				foreach ($DataAset as $key2 => $value2) {
					# code...
					//insert usulanaset 
					$Aset_ID = $value2['Aset_ID'];
					$TpAst = $value2['kodeKelompok'];
					$listAsset[]=$Aset_ID;
					//echo $no."."."Aset_ID : ".$Aset_ID."\n\n"; 
					$sqlCreateUsulanAset = "INSERT INTO usulanaset(Usulan_ID, Aset_ID, Jenis_Usulan) 
											VALUES  ('{$IDUsulan}','{$Aset_ID}','{$Jenis_Usulan}')" 
											or die("Error in the consult.." . mysqli_error($link));
					//echo "sqlCreateUsulanAset : ".$sqlCreateUsulanAset."\n\n";						
					$execCreateUsulanAset = $link->query($sqlCreateUsulanAset);

					//NamaSatker
					$sqlSatker = "SELECT NamaSatker FROM satker where kode = '{$SatkerUsul}' AND Kd_Ruang IS null";
					//echo "sqlSatker : ".$sqlSatker."\n\n";	
					$resultSatker = $link->query($sqlSatker);
					$rowSatker = mysqli_fetch_assoc($resultSatker); 
					$NamaSatkerAwal = $rowSatker['NamaSatker'];

					//NomorRegAwal
					$NomorRegAwal = $value2['noRegister'];

					//insert mutasi aset			
					$fieldPA = "Mutasi_ID,Aset_ID,Status,NamaSatkerAwal,SatkerAwal,SatkerTujuan,NomorRegAwal";
				    $valuePA = "'{$IDPenetapanMTS}','{$Aset_ID}','0','{$NamaSatkerAwal}','{$SatkerUsul}','{$SatkerTujuan}','{$NomorRegAwal}'";
				    $queryPA = "INSERT INTO mutasiaset ({$fieldPA}) VALUES ({$valuePA})" or die("Error in the consult.." . mysqli_error($link));	
				   	//echo "queryPA : ".$queryPA."\n\n";
				    $execPA = $link->query($queryPA);	

				    //get param table
					$exp = explode('.', $TpAst);
					if($exp['0'] == '01'){
						$table = "tanah";
						$tableLog = "log_tanah";
					}elseif ($exp['0'] == '02') {
						$table = "mesin";
						$tableLog = "log_mesin";
					}elseif ($exp['0'] == '03') {
						$table = "bangunan";
						$tableLog = "log_bangunan";
					}elseif ($exp['0'] == '04') {
						$table = "jaringan";
						$tableLog = "log_jaringan";
					}elseif ($exp['0'] == '05') {
						$table = "asetlain";
						$tableLog = "log_asetlain";
					}elseif ($exp['0'] == '06') {
						$table = "kdp";
						$tableLog = "log_kdp";
					}

					$kodeSatker = explode('.', $SatkerTujuan);
				    $kodePemilik = substr($value2['kodeLokasi'], 0,3);
					$kodeLokasi = $kodePemilik."11.33.".$kodeSatker[0].".".$kodeSatker[1].".".substr($value2['Tahun'],-2).".".$kodeSatker[2].".".$kodeSatker[3];

					//NomorRegBaru
					$sqlAsetNew = "SELECT noRegister FROM aset WHERE kodeKelompok = '{$value2['kodeKelompok']}' AND kodeLokasi = '{$kodeLokasi}' ORDER BY noRegister DESC LIMIT 1";
					//echo "queryPA : ".$sqlAsetNew."\n\n";
					$resultAsetNew = $link->query($sqlAsetNew);
					$detailAsetNew = mysqli_fetch_assoc($resultAsetNew);
					//print_r($detailAsetNew);
					if($detailAsetNew['noRegister'] == ''){
				        $startreg = 0; 
				        $NomorRegBaru = $startreg + 1;
				    }else{
				    	$NomorRegBaru = intval($detailAsetNew['noRegister']) + 1;
				    }
    
					//update mutasiaset			
					$queryPA = "UPDATE mutasiaset SET Status = '1',NomorRegBaru = '{$NomorRegBaru}'
								WHERE Mutasi_ID = '{$IDPenetapanMTS}' 
										AND Aset_ID = '{$Aset_ID}'" 
								or die("Error in the consult.." . mysqli_error($link));
					$execPA = $link->query($queryPA);	
					//echo "queryPA : ".$queryPA."\n\n";

					$tgl_mutasi = "2017-12-29";
					
					//get all param to log
					$sqlKIB = "SELECT * FROM {$table} where 
								Aset_ID = '{$Aset_ID}'" 
								or die("Error in the consult.." . mysqli_error($link));;
					//echo "sqlKIB : ".$sqlKIB."\n\n";
					$result = $link->query($sqlKIB); 
					$ListParam = array();
					while($rows = mysqli_fetch_assoc($result)) {
						$ListParam = $rows;
					} 
					//print_r($ListParam);

					// log pertama
					$tmpField = array();
					$tmpVal = array();
					$sign = "'"; 	
					foreach ($ListParam as $key3 => $val3) {
						//print_r($ListParam);
						//print_r($key);
						//print_r($val);
						$tmpField[] = $key3;
						if ($val3 =='' || $val3 == NULL){
							$tmpVal[] = 'NULL';
						}else{
							$tmpVal[] = $sign.addslashes($val3).$sign;
						}
					}

					$implodeField = implode (',',$tmpField);
					$implodeVal = implode (',',$tmpVal);

					$AddField = "action,changeDate,TglPerubahan,Kd_Riwayat,NilaiPerolehan_Awal,No_Dokumen";
					$action = "Data Mutasi sebelum diubah";
					$changeDate = date('Y-m-d');
					$TglPerubahan = $tgl_mutasi;
					$Kd_Riwayat = '3';
					$NilaiPerolehan_Awal = $ListParam['NilaiPerolehan'];
					$No_Dokumen = $NoUsulan;
					
					//insert log
					$QueryLog  = "INSERT INTO {$tableLog} ($implodeField,$AddField)
									VALUES ($implodeVal,'$action','$changeDate','$TglPerubahan','$Kd_Riwayat','$NilaiPerolehan_Awal','$No_Dokumen')" or die("Error in the consult.." . mysqli_error($link));
					//echo "QueryLog1 : ".$QueryLog."\n\n";
					$execLog = $link->query($QueryLog);	
					
					//UPDATE DATA ASET DAN KIB
					$quertAST = "UPDATE aset SET kodeLokasi = '{$kodeLokasi}' ,kodeSatker='{$SatkerTujuan}',noRegister = '{$NomorRegBaru}',TglPembukuan = '{$tgl_mutasi}'
						WHERE Aset_ID = '{$Aset_ID}'" or die("Error in the consult.." . mysqli_error($link));	
					$execAST = $link->query($quertAST);	
					//echo "quertAST : ".$quertAST."\n\n";

					//update tabel sqlKIB
					$quertKIB = "UPDATE {$table} SET kodeLokasi = '{$kodeLokasi}' ,kodeSatker='{$SatkerTujuan}',noRegister = '{$NomorRegBaru}', TglPembukuan = '{$tgl_mutasi}'
						WHERE Aset_ID = '{$Aset_ID}'" or die("Error in the consult.." . mysqli_error($link));	
					$execKIB = $link->query($quertKIB);	
					//echo "quertKIB : ".$quertKIB."\n\n";
	
					//log kedua
					//get all param to log
					$sqlKIB2 = "SELECT * FROM {$table} where 
								Aset_ID = '{$Aset_ID}'" 
								or die("Error in the consult.." . mysqli_error($link));;
					//echo "sqlKIB : ".$sqlKIB."\n\n";
					$result2 = $link->query($sqlKIB2); 
					$ListParam2 = array();
					while($rows2 = mysqli_fetch_assoc($result2)) {
						$ListParam2 = $rows2;
					}

					// log kedua
					$tmpField2 = array();
					$tmpVal2 = array();
					$sign2 = "'"; 	
					foreach ($ListParam2 as $key4 => $val4) {
						//print_r($ListParam);
						//print_r($key);
						//print_r($val);
						$tmpField2[] = $key4;
						if ($val4 =='' || $val4 == NULL){
							$tmpVal2[] = 'NULL';
						}else{
							if($key4 == 'TglPembukuan'){
								$tmpVal2[] = $sign2.addslashes($tgl_mutasi).$sign2;
							}else{
								$tmpVal2[] = $sign2.addslashes($val4).$sign2;			
							}
						}
					}

					$implodeField2 = implode (',',$tmpField2);
					$implodeVal2 = implode (',',$tmpVal2);

					$AddField2 = "action,changeDate,TglPerubahan,Kd_Riwayat,NilaiPerolehan_Awal,No_Dokumen";
					$action2 = "Sukses Mutasi";
					$changeDate2 = date('Y-m-d');
					$TglPerubahan2 = $tgl_mutasi;
					$Kd_Riwayat2 = '3';
					$NilaiPerolehan_Awal2 = $ListParam2['NilaiPerolehan'];
					$No_Dokumen2 = $NoUsulan;
					
					//insert log
					$QueryLog2  = "INSERT INTO {$tableLog} ($implodeField2,$AddField2)
									VALUES ($implodeVal2,'$action2','$changeDate2','$TglPerubahan2','$Kd_Riwayat2','$NilaiPerolehan_Awal2','$No_Dokumen2')" or die("Error in the consult.." . mysqli_error($link));
					
					$execLog2 = $link->query($QueryLog2);	
					//echo "quertAST : ".$QueryLog2."\n\n"; 

				$no++;
				}
			}
			$jml = $no - 1;
			echo "Jumlah Aset : ".$jml."\n\n";
			$DetailListAsset = implode(',', $listAsset);
			echo "List Aset : ".$DetailListAsset."\n\n";
			
			//update penetapan dan validasi pada usulan 
			$quertUS = "UPDATE usulan SET StatusPenetapan = '1' , Penetapan_ID = '{$IDPenetapanMTS}',Status = '1'
						WHERE Usulan_ID = '{$IDUsulan}'"
						or die("Error in the consult.." . mysqli_error($link));  
			//echo "quertUS : ".$quertUS."\n\n";			
			$execUS = $link->query($quertUS);	

			//update data penetapan dan validasi usulan
			$quertUSA = "UPDATE usulanaset SET Penetapan_ID='{$IDPenetapanMTS}', StatusPenetapan ='1', StatusKonfirmasi ='1',StatusValidasi='1'
					WHERE Jenis_Usulan = 'MTS' AND Usulan_ID = '{$IDUsulan}'" or die("Error in the consult.." . mysqli_error($link));
			//echo "quertUSA : ".$quertUSA."\n\n";				
			$execUSA = $link->query($quertUSA);	

			//UPDATE FixMutasi PENETAPAN MUTASI DI MUTASI(flag proses input data selesai) 
			$queryMts = "UPDATE mutasi SET FixMutasi = '1'
							WHERE Mutasi_ID = '{$IDPenetapanMTS}'" or die("Error in the consult.." . mysqli_error($link));
			$execMts = $link->query($queryMts);	


			echo "========================================================================================================="."\n\n";
		$num++;		
		}	
	}

$time_end = microtime(true);

//dividing with 60 will give the execution time in minutes other wise seconds
$execution_time = ($time_end - $time_start)/60;

//execution time of the script
echo "<b>Total Execution Time:</b> ".$execution_time." Mins"."\n\n";

echo "=================== Process Complete. Thank you ===================\n\n";



