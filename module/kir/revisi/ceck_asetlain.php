<?php
/*
skenario
1. simbada_pkl_kir (kir fix)
- satker fix
2. simbada_pkl_penyusutan (penyusutan fix)
- satker unfix
*/

//connect db
$hostname = 'localhost'; //192.168.254.52
$username = 'root'; //simbada_web_remote
$password = 'root123root'; //@#S/FBnq4^i9*2*NM]7b4r+[
$conn = mysql_connect($hostname,$username,$password);

//source db
$db1 = "simbada_pekalongan_v3"; //simbada_main_2016_auditied

//destination db
$db2 = "simbada_pekalongan_final"; //simbada_main_2018_final	 

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
/*
SDN Kandang Panjang 10 : 08.01.01.75
SMP N 04			   : 08.01.05.01

ceck query : SELECT COUNT(Aset_ID),SUM(NilaiPerolehan) FROM `neraca_asetlain2017` WHERE kodeSatker = '08.01.01.75' AND Status_Validasi_Barang = 1 AND StatusTampil = 1 AND kondisi != 3 AND kondisi != 4 AND kondisi != 5
*/
$kodeSatker = '08.01.05.01';

$query = "SELECT Aset_ID,NilaiPerolehan FROM $db1.neraca_asetlain2017 WHERE kodeSatker = '$kodeSatker' AND Status_Validasi_Barang = 1 AND StatusTampil = 1 AND kondisi != 3 AND kondisi != 4 AND kondisi != 5 ";

$exe_select = mysql_query($query);
$jumlah = 0;
$data = array();
while($row = mysql_fetch_assoc($exe_select)) {
	$data[] = $row['Aset_ID']; 
	$jumlah += $row['NilaiPerolehan'];
}

echo "Jumlah NP Data Asal : ".$jumlah."\n\n";
echo "Jumlah Data Asal : ".count($data)."\n\n";

//db($data);
$query2 = "SELECT Aset_ID,NilaiPerolehan FROM $db2.neraca_asetlain2017 WHERE kodeSatker = '$kodeSatker' AND Status_Validasi_Barang = 1 AND StatusTampil = 1 AND kondisi != 3 AND kondisi != 4 AND kondisi != 5 ";

$exe_select2 = mysql_query($query2);
$jumlah2 = 0;
$data2 = array();
while($row2 = mysql_fetch_assoc($exe_select2)) {
	$data2[] = $row2['Aset_ID']; 
	$jumlah2 += $row2['NilaiPerolehan'];
}

echo "Jumlah NP Data Final : ".$jumlah2."\n\n";
echo "Jumlah Data Final : ".count($data2)."\n\n";
//db($data2);
//exit();
//data acuan final 
if($data2){
	$ListAsetFix = array();
	foreach(array_values($data2) as $v){
    	$ListAsetFix[$v] = 1;
	}
}
//db($ListAsetFix);

$dataAccept = array();
$dataReject = array();
if($data2){
	//list Aset
    foreach($data as $asetidAset){
        //list Aset_ID yang pernah diusulkan
        $needle = $asetidAset;
        //print_r($needle);
       //exit();
        //matching
        if ($ListAsetFix[$needle]){
            
            //echo "Aset_ID Tolak : ".$needle."\n\n";
            $dataReject[] = $needle;
            //list aset yg ditolak
        }else{
        	$dataAccept[] = $needle;
        	//echo "Aset_ID Terima : ".$needle."\n\n";	
        	$FixAsetID = $needle.',';
        }                        
    }    
}	
echo "dataAccept : ".count($dataAccept)."\n\n";
echo "dataReject : ".count($dataReject)."\n\n";
$implode = implode(',', $dataAccept);
//db($implode);
logFile($implode,'ceck-AsetTetapLain'.'-'.$kodeSatker.'-'.date('Y-m-d'));
echo "=====done=====";

exit;

?>