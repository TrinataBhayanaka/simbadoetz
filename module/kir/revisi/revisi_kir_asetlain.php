<?php
/*
skenario
1. simbada_pkl_kir (kir fix)
- satker fix
2. simbada_pkl_penyusutan (penyusutan fix)
- satker unfix
*/
// include "../../../config/database.php";
//connect db
$hostname = 'localhost';
$username = 'root';
$password = 'root123root';
$conn = mysql_connect($hostname,$username,$password);

//source db
$db1 = "simbada_kir";
//destination db
$db2 = "simbada_penyusutan";	

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

//example : RSUD BENDAN
$skpd 			= "07.02.01.01";
//$exp = explode(".", $skpd);
//$KodeSektor 	= $exp[0];
//$KodeSatker 	= $exp[0].'.'.$exp[1];
//$KodeUnit		= $exp[2];
//$Gudang			= $exp[3];
$tahun 			= "2015";

//log (function logfile)
include "../../../config/config.php";

//hapus tabel satker
$query_select_ruangan_fix ="delete from $db2.satker where kode = '$skpd' 
							and Tahun = '$tahun' 
							and Kd_Ruang is not null"; 
$exec =  mysql_query($query_select_ruangan_fix);

//select Kd_Ruang dan NamaSatker dari tabel satker (simbada_kir)
$query = "SELECT Satker_ID,Tahun,KodeSektor,KodeSatker,kode,KodeUnit,Gudang,NamaSatker,Kd_Ruang 
		FROM $db1.satker WHERE Tahun = '$tahun' 
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
						VALUES ('$tahun','$KodeSektor','$KodeSatker','$KodeUnit','$Gudang','$kode','$Kd_Ruang','$NamaSatker')";
	//db($QuerySatker);
	$exe_kd_ruang = mysql_query($QuerySatker);	
	//exit;
}


$table = "aset";
$tableKib = "asetlain";
$tableLog = "log_asetlain";

//select data mesin 
$query_kib_simbada_kir = "SELECT * FROM $db1.$tableKib WHERE kodeSatker ='$skpd' 
			  			  and Status_Validasi_Barang = 1  and StatusTampil = 1 limit 2";
//echo $query_kib;
$exe_select_kib = mysql_query($query_kib_simbada_kir);
//$asetlist = array();
while($row_kib = mysql_fetch_assoc($exe_select_kib)) {
	//$Aset_ID = $row_kib[Aset_ID];
	//$kodeKel = $row_kib[kodeKelompok];
	
	//echo "ID == $row_kib[Aset_ID]";
	//echo "\n";
	//db($row_kib);
	//exit;
	//$asetlist[] = $row_kib;
	//$lastArray = end($asetlist);
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
		//foreach ($lastArray as $key => $val) {
		foreach ($row_kib_simbada_penyusutan as $key => $val) {
			//db($row_kib_simbada_penyusutan);
			//db($val);
            $tmpField[] = $key;
			if ($val =='' || $val == NULL){
				$tmpVal[] = 'NULL';
			}else{
				$tmpVal[] = $sign.addslashes($val).$sign;
			}


		}
	//db($tmpField);
	//db($tmpVal);
	//exit;	
	
	$implodeField = implode (',',$tmpField);
	//db($implodeField);
	$implodeVal = implode (',',$tmpVal);
	//db($implodeVal);
	
	$AddField = "action,changeDate,TglPerubahan,NilaiPerolehan_Awal,Kd_Riwayat";
	$action = "Rev_Ruangan_".$row_kib[kodeSatker].'_'.$row_kib[kodeRuangan];
	$changeDate = date('Y-m-d');
	$tgl = '2015-12-31';
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
	
	logFile($row_kib[Aset_ID]." ".$row_kib[kodeKelompok]." ".$row_kib[Tahun]." ".$row_kib[NilaiPerolehan]." ",'revisi-kir-E'.'-'.$skpd.'-'.date('Y-m-d'));

}

echo "=====done=====";

exit;

?>