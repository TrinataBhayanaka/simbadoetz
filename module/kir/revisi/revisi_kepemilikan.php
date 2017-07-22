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
$hostname = '192.168.254.52';
//$hostname = 'localhost';
$username = 'root';
//$username = 'root';
//$password = 'root123root';
$password = 'margonda100';
$conn = mysql_connect($hostname,$username,$password);

//source db
//simbada_pekalongan_2016_20170224_revisi_penyusutanv5
//$db1 = "simbada_pekalongan_v4";
$db1 = "simbada_pekalongan_2016_20170224_revisi_penyusutanv5";

//destination db
//simbada_pekalongan_20170721_hasil_sync
//$db2 = "simbada_pekalongan_v5";	
$db2 = "simbada_pekalongan_20170721_hasil_sync";	

$link_db1 = mysql_select_db($db1,$conn);
$link_db2 =  mysql_select_db($db2,$conn);

$link_connect=mysql_connect($hostname,$username,$password)  or die ("Koneksi Database gagal"); 

//log (function logfile)
include "../../../config/config.php"; 

function db($data,$exit=1){
	echo "<pre>";
	echo "<pre>";
	print_r($data);
	echo "</pre>";
	/*echo "<br/>";
	print_r($data);	
	echo "<br/>";*/
	// if($exit == 1) exit;
}

//SMPN 08
$skpd 			= "08.01.09.01";
$TglPerubahan 	= "2017-05-08 00:00:00";

$listAset_ID    = "129506,130721,130722,130723,130724,130744,130745,130746,130747,130748,130749,130750,130751,130752,130753,130780,130781,130782,130783,130796,130797,130828,130829,130851,130852,130853,130854,130855,130856,130857,131405,131406,131445,131446,131470";

/*normalisasi data dari kodepemilik 12 ke 00*/

//select data dari source db
$queryaset = "select * from $db1.mesin where Aset_ID in ($listAset_ID)";
$execaset =  mysql_query($queryaset);

while($rowaset = mysql_fetch_assoc($execaset)) {
	//db($row);
	$Aset_ID 		= $rowaset[Aset_ID];
	$kodeLokasi 	= $rowaset[kodeLokasi];
	$noRegister		= $rowaset[noRegister];

	//update aset destination db 
	$QueryUpdateAset	  = "UPDATE $db2.aset SET kodeLokasi = '$kodeLokasi', 
											  noRegister = '$noRegister'
					     where Aset_ID = '$Aset_ID'";
	//db($QueryUpdateAset);
	$exeUpdateAset = mysql_query($QueryUpdateAset);	

	//update aset destination db
	$QueryUpdateMesin	  = "UPDATE $db2.mesin SET kodeLokasi = '$kodeLokasi', 
											  noRegister = '$noRegister'
					     where Aset_ID = '$Aset_ID'";
	//db($QueryUpdateMesin);
	$exeUpdateMesin = mysql_query($QueryUpdateMesin);	
	
	//delete log mesin destination db
	$QueryDelLogMesin	  = "DELETE FROM $db2.log_mesin  where Aset_ID = '$Aset_ID'";
	//db($QueryDelLogMesin);
	$exeDelLogMesin = mysql_query($QueryDelLogMesin);	

	//insert log
	//get key and value
	$tmpField = array();
	$tmpVal = array();	
	$sign = "'"; 
	foreach ($rowaset as $key => $value) {
		# code...
		$tmpField[] = $key;
		if ($value =='' || $value == NULL){
			$tmpVal[] = 'NULL';
		}else{
			$tmpVal[] = $sign.addslashes($value).$sign;
		}
	}
	$implodeField = implode (',',$tmpField);
	//db($implodeField);
	$implodeVal = implode (',',$tmpVal);
	//db($implodeVal);
	$AddField = "action,changeDate,TglPerubahan,NilaiPerolehan_Awal,Kd_Riwayat";
	$action = "ubah kepemilikan";
	$changeDate = date('Y-m-d');
	$NilaiPerolehan_Awal = $rowaset[NilaiPerolehan];
	$Kd_Riwayat = '22';
		
	//insert log Mesin
	$QueryInsertLogMesin  = "INSERT INTO $db2.log_mesin ($implodeField,$AddField)
				VALUES ($implodeVal,'$action','$changeDate','$TglPerubahan','$NilaiPerolehan_Awal',
				       '$Kd_Riwayat')";
	//db($QueryInsertLogMesin);
	$exeInsertLogMesin = mysql_query($QueryInsertLogMesin);  			       


	/*update dari kodepemilik 00 ke 12*/
	//select noRegister dari tabel aset db destination
	$QuerySelectRegister = mysql_query("SELECT noRegister FROM $db2.aset WHERE 
										kodeKelompok = '{$rowaset['kodeKelompok']}' AND 
										kodeLokasi = '{$rowaset['kodeLokasi']}' 
										ORDER BY noRegister DESC LIMIT 1") 
							or die(mysql_error()); 
   	$newReg = '';
   	while ($rowSelectRegister = mysql_fetch_assoc($QuerySelectRegister)){
        $startreg = $rowSelectRegister['noRegister'];
    }
    if($startreg == ''){
        $startreg = 0; 
    }
    $newReg = intval($startreg) + 1;
    //manipulasi kodelokasi 
    //contoh : 12.11.33.01.01.10.01.01
    $oldKodeLokasi = $rowaset['kodeLokasi'];
    $manipulateKodeLokasi = substr($oldKodeLokasi,3,20);
    $newKodeLokasi = "12.".$manipulateKodeLokasi;

    //update aset db destination
    $QueryUpdateKodeLokasiAset	  = "UPDATE $db2.aset SET kodeLokasi = '$newKodeLokasi', 
											  		noRegister = '$newReg'
					     			where Aset_ID = '$Aset_ID'";
	//db($QueryUpdateKodeLokasiAset);
	$exeUpdateKodeLokasiAset = mysql_query($QueryUpdateKodeLokasiAset); 

	//update mesin db destination
    $QueryUpdateKodeLokasiMesin	  = "UPDATE $db2.mesin SET kodeLokasi = '$newKodeLokasi', 
											  		noRegister = '$newReg'
					     			where Aset_ID = '$Aset_ID'";
	//db($QueryUpdateKodeLokasiMesin);
	$exeUpdateKodeLokasiAset = mysql_query($QueryUpdateKodeLokasiMesin); 

}

//logFile($row_kib[Aset_ID]." ".$row_kib[kodeKelompok]." ".$row_kib[Tahun]." ".$row_kib[NilaiPerolehan]." ",'revisi-kir-E'.'-'.$skpd.'-'.date('Y-m-d'));
echo "=====done=====";
exit;

?>