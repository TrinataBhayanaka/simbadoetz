<?php
/*
skenario
1. simbada_pkl_kir (kir fix)
- satker fix
2. simbada_pkl_penyusutan (penyusutan fix)
- satker unfix
*/

//connect db
$hostname = '192.168.254.52'; //192.168.254.52
$username = 'simbada_web_remote'; //simbada_web_remote
$password = '@#S/FBnq4^i9*2*NM]7b4r+['; //@#S/FBnq4^i9*2*NM]7b4r+[
$conn = mysql_connect($hostname,$username,$password);

//source db
$db1 = "simbada_main_2016_auditied"; //simbada_main_2016_auditied

//destination db
$db2 = "simbada_main_2018_final"; //simbada_main_2018_final	 

$link_db1 = mysql_select_db($db1,$conn);
$link_db2 =  mysql_select_db($db2,$conn);

$link_connect=mysql_connect($hostname,$username,$password)  or die ("Koneksi Database gagal"); 
 

function db($data,$exit=1){
	echo "<pre>";
	echo "<pre>";
	print_r($data);
	echo "</pre>";
	// if($exit == 1) exit;
}

//log (function logfile)
include "../../../config/config.php";

//Tahun Ruangan
$tahunAsal 	= "2016";
$tahunTujuan = "2017"; 
$satker = array("07.01.02.02","07.01.02.10","07.01.02.33","07.01.02.07","07.01.02.40","07.01.01.03");

foreach ($satker as $key => $skpd) {
	
	echo "SKPD : ".$skpd."\n\n";
		
		//hapus tabel satker
		$query_select_ruangan_fix ="delete from $db2.satker where kode = '$skpd' 
									and Tahun = '$tahunTujuan' 
									and Kd_Ruang is not null"; 
		$exec =  mysql_query($query_select_ruangan_fix);

		//select Kd_Ruang dan NamaSatker dari tabel satker (simbada_kir)
		$query = "SELECT Satker_ID,Tahun,KodeSektor,KodeSatker,kode,KodeUnit,Gudang,NamaSatker,Kd_Ruang 
				FROM $db1.satker WHERE Tahun = '$tahunAsal' 
				and kode like '$skpd%' and Kd_Ruang is not null";
		//echo $query;
		$exe_select = mysql_query($query);
		while($row = mysql_fetch_assoc($exe_select)) {
			//db($row);
			$KodeSektor 	= $row[KodeSektor];
			$KodeSatker 	= $row[KodeSatker];
			$KodeUnit		= $row[KodeUnit];
			$Gudang			= $row[Gudang];
			$kode			= $row[kode];
			$Kd_Ruang 		= trim($row[Kd_Ruang]);
			$NamaSatker 	= trim($row[NamaSatker]);

			//update ruangan
			$QuerySatker	  = "INSERT INTO $db2.satker(
									Tahun,KodeSektor,KodeSatker,KodeUnit,Gudang, kode,
									Kd_Ruang,NamaSatker) 
								VALUES ('$tahunTujuan','$KodeSektor','$KodeSatker','$KodeUnit','$Gudang','$kode','$Kd_Ruang','$NamaSatker')";
			//db($QuerySatker);
			$exe_kd_ruang = mysql_query($QuerySatker);	
			//exit;
		}


		$table = "aset";
		$tableKib = "mesin";
		$tableLog = "log_mesin";

		//select data mesin 
		$query_kib_simbada_kir = "SELECT * FROM $db1.$tableKib WHERE kodeSatker ='$skpd' 
					  			  and Status_Validasi_Barang = 1  and StatusTampil = 1";
		//echo $query_kib;
		$exe_select_kib = mysql_query($query_kib_simbada_kir);
		while($row_kib = mysql_fetch_assoc($exe_select_kib)) {
			
			if($row_kib[kodeRuangan]){
				$kodeRuangan = $row_kib[kodeRuangan];
			}else{
				$kodeRuangan = 'NULL';
			}
			
			//update tabel aset simbada_penyusutan dengan kodeRuangan di simbada_kir
			$aset_penyusutan = "UPDATE $db2.$table SET kodeRuangan = $kodeRuangan 
							     where Aset_ID = '$row_kib[Aset_ID]'";
			//db($aset_penyusutan);			     
			$exe_aset_penyusutan = mysql_query($aset_penyusutan);  
			
			//update tabel mesin simbada_penyusutan dengan kodeRuangan di simbada_kir
			$mesin_penyusutan = "UPDATE $db2.$tableKib SET kodeRuangan = $kodeRuangan 
							     where Aset_ID = '$row_kib[Aset_ID]'";
			//db($mesin_penyusutan);			     
			$exe_mesin_penyusutan = mysql_query($mesin_penyusutan);  
			
			//select data kib  simbada_penyusutan
		    $query_kib_simbada_penyusutan = "SELECT * FROM $db2.$tableKib WHERE kodeSatker ='$skpd' 
					  			  			and Status_Validasi_Barang = 1  and StatusTampil = 1 
					  			  			and Aset_ID = '$row_kib[Aset_ID]'";
			//db($query_kib_simbada_penyusutan);	
			//echo $query_kib;
			$exe_select_kib_simbada_penyusutan = mysql_query($query_kib_simbada_penyusutan);
			$row_kib_simbada_penyusutan = mysql_fetch_assoc($exe_select_kib_simbada_penyusutan);

			//insert log
			$tmpField = array();
			$tmpVal = array();	
				$sign = "'"; 
				foreach ($row_kib_simbada_penyusutan as $key => $val) {
					$tmpField[] = $key;
					if ($val =='' || $val == NULL){
						$tmpVal[] = 'NULL';
					}else{
						$tmpVal[] = $sign.addslashes($val).$sign;
					}
				}
			
			$implodeField = implode (',',$tmpField);
			$implodeVal = implode (',',$tmpVal);
			
			$AddField = "action,changeDate,TglPerubahan,NilaiPerolehan_Awal,Kd_Riwayat";
			$action = "Rev_Ruangan_".$row_kib[kodeSatker].'_'.$row_kib[kodeRuangan];
			$changeDate = date('Y-m-d');
			//$tgl = $changeDate;
			$tgl = '2017-12-31';
			$TglPerubahan = $tgl;
			$NilaiPerolehan_Awal = $row_kib[NilaiPerolehan];
			$Kd_Riwayat = '4';
				
			//insert log
			$QueryLog  = "INSERT INTO $db2.$tableLog ($implodeField,$AddField)
						VALUES ($implodeVal,'$action','$changeDate','$TglPerubahan','$NilaiPerolehan_Awal',
						       '$Kd_Riwayat')";

			//db($QueryLog);			       
			//exit;
			$exe_log_mesin= mysql_query($QueryLog);  
			//exit;
			
			logFile($row_kib[Aset_ID]."-".$row_kib[kodeKelompok]."-".$row_kib[Tahun]."-".$row_kib[NilaiPerolehan]."-".$row_kib[kodeRuangan],'revisi-kir-B'.'-'.$skpd.'-'.date('Y-m-d'));

		}
}

echo "=====done=====";

exit;

?>