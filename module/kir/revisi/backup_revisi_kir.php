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

$db1 = "simbada_kir";
$db2 = "simbada_penyusutan";

$link_db1 = mysql_select_db($db1,$conn);
$link_db2 =  mysql_select_db($db2,$conn);

$link_connect=mysql_connect($hostname,$username,$password)  or die ("Koneksi Database gagal"); 
 

function db($data,$exit=1){
	echo "<pre>";
	print_r($data);
	echo "</pre>";
	// if($exit == 1) exit;
}
$skpd 			= "21.01.01.01";
$exp = explode(".", $skpd);
$KodeSektor 	= $exp[0];
$KodeSatker 	= $exp[0].'.'.$exp[1];
$KodeUnit		= $exp[2];
$Gudang			= $exp[3];
$tahun 			= "2015";
//exit;
/*
//cek list ruangan 
$query_kir = "SELECT count(Satker_ID) as jml FROM $db1.satker WHERE Tahun = 2015 and kode like '$skpd%' and Kd_Ruang is not null";
echo $query_kir;
$exe = mysql_fetch_assoc(mysql_query($query_kir));
db($exe); 
//exit;

$query_penyusutan = "SELECT count(Satker_ID) as jml FROM $db2.satker WHERE Tahun = 2015 and kode like '$skpd%' and Kd_Ruang is not null";
echo $query_penyusutan;
$exe2 = mysql_fetch_assoc(mysql_query($query_penyusutan));
db($exe2); 
//exit;

$query_sel_ruangan = "select Kd_Ruang,NamaSatker from $db1.satker where 
					  kode like '$skpd%' and Tahun = '$tahun'";  
echo $query_sel_ruangan;

$exe_select = mysql_query($query_sel_ruangan);
$head="<table border=1>
		<tr>
			<td>Kode Ruangan</td>
			<td>Nama Ruangan</td>
		</tr>";
while($row = mysql_fetch_assoc($exe_select)) {
  $asetlist[] = $row;
  $head.="<tr>
			<td>{$row[Kd_Ruang]}</td>
			<td>{$row[NamaSatker]}</td>
		</tr>";
}
$head.="</table>";
echo $head;
db($asetlist);
exit;*/

//sinkronisasi tabel satker dengan cara dihapus
$query_select_ruangan_fix ="delete from $db2.satker where kode like '$skpd%' and Tahun = '$tahun' 
and Tahun is not null and and Kd_Ruang is not null"; 
// $exec =  mysql_query($query_select_ruangan_fix);

//select Kd_Ruang dan NamaSatker dari tabel satker (simbada_kir)
$query = "SELECT Satker_ID,Tahun,NamaSatker,Kd_Ruang FROM $db1.satker WHERE Tahun = '$tahun' 
		  and kode like '$skpd%' and Kd_Ruang is not null";
//echo $query;
$exe_select = mysql_query($query);
/*$head="<table border=1>
		<tr>
			<td>Kode Ruangan</td>
			<td>Nama Ruangan</td>
		</tr>";*/
while($row = mysql_fetch_assoc($exe_select)) {
  	/*$asetlist[] = $row;
  	$head.="<tr>
			<td>{$row[Kd_Ruang]}</td>
			<td>{$row[NamaSatker]}</td>
		</tr>";*/
	//db($row);
	$Kd_Ruang = trim($row[Kd_Ruang]);
	$NamaSatker = trim($row[NamaSatker]);

	//update ruangan 
	$QuerySatker	  = "INSERT INTO $db2.satker(Tahun, KodeSektor, KodeSatker,KodeUnit,Gudang, kode,
										Kd_Ruang,NamaSatker) 
							VALUES ('$tahun','$KodeSektor','$KodeSatker','$KodeUnit','$Gudang','$skpd',
							        '$Kd_Ruang','$NamaSatker')";
	//db($QuerySatker);
	//$exe_kd_ruang = mysql_query($QuerySatker);	
	//exit;
}
//$head.="</table>";
//echo $head;

//select data mesin
$table = "mesin";
$tableLog = "log_mesin";
//Aset_ID,kodeRuangan
$query_kib = "SELECT * FROM $db1.$table WHERE kodeSatker like '$skpd%' 
			  and Status_Validasi_Barang = 1  and StatusTampil = 1 limit 1";
//echo $query_kib;
$exe_select_kib = mysql_query($query_kib);
$asetlist = array();
while($row_kib = mysql_fetch_assoc($exe_select_kib)) {
	$asetlist[] = $row_kib;
	$lastArray = end($asetlist);

	//update tabel mesin simbada_penyusutan
	$mesin_penyusutan = "UPDATE $db2.$table SET kodeRuangan = '$row_kib[kodeRuangan]' 
					     where Aset_ID = '$row_kib[Aset_ID]'";
	//db($mesin_penyusutan);			     
	//$exe_mesin_penyusutan = mysql_query($mesin_penyusutan);  
	
	//insert log
	$tmpField = array();
	$tmpVal = array();	
		$sign = "'"; 
		foreach ($lastArray as $key => $val) {
            $tmpField[] = $key;
			if ($val =='' || $val == NULL){
				$tmpVal[] = 'NULL';
			}else{
				$tmpVal[] = $sign.addslashes($val).$sign;
			}


		}
	//db($tmpField);
	//db($tmpVal);

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
	//$exe_log_mesin= mysql_query($QueryLog);  
	
}


db($asetlist);

exit;

?>