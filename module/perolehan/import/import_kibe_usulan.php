<?php
//echo $argv[1];
include "../../../config/database.php";
$set = ini_set('memory_limit', '8192M'); 
error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED);
/*echo "<pre>";
print_r($CONFIG);
echo "</pre>";*/
$link = mysqli_connect($CONFIG['default']['db_host'],$CONFIG['default']['db_user'],$CONFIG['default']['db_pass'],$CONFIG['default']['db_name']) or die("Error " . mysqli_error($link)); 

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
					$listAsset[]=$Aset_ID;
					//echo $no."."."Aset_ID : ".$Aset_ID."\n\n"; 
					$sqlCreateUsulanAset = "INSERT INTO usulanaset(Usulan_ID, Aset_ID, Jenis_Usulan) 
											VALUES  ('{$IDUsulan}','{$Aset_ID}','{$Jenis_Usulan}')" 
											or die("Error in the consult.." . mysqli_error($link));
					//echo "sqlCreateUsulanAset : ".$sqlCreateUsulanAset."\n\n";						
					$execCreateUsulanAset = $link->query($sqlCreateUsulanAset);

					//NamaSatker
					$sqlSatker = "SELECT NamaSatker FROM satker where kode = '{$SatkerUsul}'";
					//echo "sqlSatker : ".$sqlSatker."\n\n";	
					$resultSatker = $link->query($sqlSatker);
					$rowSatker = mysqli_fetch_assoc($resultSatker); 
					$NamaSatkerAwal = $rowSatker['NamaSatker'];

					//NomorRegAwal
					$sqlAset = "SELECT * FROM aset where Aset_ID = '{$Aset_ID}'";
					//echo "sqlAset : ".$sqlAset."\n\n";	
					$resultAset = $link->query($sqlAset);
					$detailAset = mysqli_fetch_assoc($resultAset);
					$NomorRegAwal = $detailAset['noRegister'];

					//insert mutasi aset			
					$fieldPA = "Mutasi_ID,Aset_ID,Status,NamaSatkerAwal,SatkerAwal,SatkerTujuan,NomorRegAwal";
				    $valuePA = "'{$IDPenetapanMTS}','{$Aset_ID}','0','{$NamaSatkerAwal}','{$SatkerUsul}','{$SatkerTujuan}','{$NomorRegAwal}'";
				    $queryPA = "INSERT INTO mutasiaset ({$fieldPA}) VALUES ({$valuePA})" or die("Error in the consult.." . mysqli_error($link));	
				   	//echo "queryPA : ".$queryPA."\n\n";
				    $execPA = $link->query($queryPA);	
				
				$no++;
				}
			}
			echo "Jumlah Aset : ".$no."\n\n";
			$DetailListAsset = implode(',', $listAsset);
			echo "List Aset : ".$DetailListAsset."\n\n";
			
			//update usulan
			$quertUS = "UPDATE usulan SET StatusPenetapan = '1' , Penetapan_ID = '{$IDPenetapanMTS}'
						WHERE Usulan_ID = '{$IDUsulan}'"
						or die("Error in the consult.." . mysqli_error($link));  
			//echo "quertUS : ".$quertUS."\n\n";			
			$execUS = $link->query($quertUS);	

			//update data usulan
			$quertUSA = "UPDATE usulanaset SET Penetapan_ID='{$IDPenetapanMTS}', StatusPenetapan ='1', StatusKonfirmasi ='1'
					WHERE Jenis_Usulan = 'MTS' AND Usulan_ID = '{$IDUsulan}'" or die("Error in the consult.." . mysqli_error($link));
			//echo "quertUSA : ".$quertUSA."\n\n";				
			$execUSA = $link->query($quertUSA);	

			echo "========================================================================================================="."\n\n";
		$num++;		
		}	
	}




