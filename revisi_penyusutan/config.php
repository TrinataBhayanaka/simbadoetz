<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
#This code provided by:
#Andreas Hadiyono (andre.hadiyono@gmail.com)
#Gunadarma University

$db_host="localhost"; 
$db_user="root";
$db_pass="new-password";
$database="simbada_pekalongan_2015";
//$simda_db="simda_to_mysql2014";
//$simbada_db="simda_to_simbada2014_full";
//$simda_db="simda_kotawaringin_perikanan";
//$simbada_db="simbada_kotawaringin_revisi_kdp";



function open_connection(){ 
 $db_host="localhost"; 
 $db_user="root";
 $db_pass="new-password";
 $link=mysql_connect($db_host,$db_user,$db_pass)  
 or die ("Koneksi Database gagal"); 
 mysql_select_db("simbada_pekalongan_2015",$link);
 return $link; 
}

function get_auto_increment($tablename,$database,$link){
    mysql_select_db("$database",$link);
    $nama_tabel=$database.".".$tablename;
    $next_increment = 0;
    $qShowStatus = "SHOW TABLE STATUS LIKE '$tablename'";
    $qShowStatusResult = mysql_query($qShowStatus,$link) or die ( "Query failed: " . mysql_error() . "<br/>" . $qShowStatus );
    
    $row = mysql_fetch_assoc($qShowStatusResult);
    $next_increment = $row['Auto_increment'];
//echo "$qShowStatus";
    return $next_increment;
}

function get_nama_skpd($satker_id,$nm_database,$link){
     $query="select NamaSatker from $nm_database.satker where kode='$satker_id'";
        $result=  mysql_query($query,$link) or die(mysql_error());
     while($row=  mysql_fetch_object($result)){
          $NamaSatker=$row->NamaSatker;
     }
     return $NamaSatker;
}
function get_skpd($bidang=false,$unit=false,$subunit=false,$upb=false,$nm_database=false,$link=false){
     $KodeSektor=sprintf('%02d', $bidang);
     $KodeSatker=$KodeSektor.".".sprintf('%02d', $unit);
     $KodeUnit=sprintf('%02d', $subunit);
     $Gudang=sprintf('%02d', $upb);
     
     $Satker_ID = null;
     $query="select kode from $nm_database.satker where KodeSektor='$KodeSektor' "
             . "    and KodeSatker='$KodeSatker' and KodeUnit='$KodeUnit' and Gudang='$Gudang' limit 1 ";
     //echo "$query<br/>";
     $result=  mysql_query($query,$link) or die(mysql_error());
     while($row=  mysql_fetch_object($result)){
          $Satker_ID=$row->kode;
     }
     return $Satker_ID;
     
}
function get_skpd_id($bidang=false,$unit=false,$subunit=false,$upb=false,$nm_database=false,$link=false){
     $KodeSektor=sprintf('%02d', $bidang);
     $KodeSatker=$KodeSektor.".".sprintf('%02d', $unit);
     $KodeUnit=sprintf('%02d', $subunit);
     $Gudang=sprintf('%02d', $upb);
     
     $Satker_ID = null;
     $query="select Satker_ID,kode from $nm_database.satker where KodeSektor='$KodeSektor' "
             . "    and KodeSatker='$KodeSatker' and KodeUnit='$KodeUnit' and Gudang='$Gudang' limit 1 ";
     //echo "$query<br/>";
     $result=  mysql_query($query,$link) or die(mysql_error());
     while($row=  mysql_fetch_object($result)){
          $Satker_ID=$row->Satker_ID;
     }
     return $Satker_ID;
     
}
function get_harga($satker,$kelompok,$register,$tableName,$primary,$link){
         $query="Select $primary,Aset_ID,NilaiPerolehan from $tableName where kodeKelompok='$kelompok' "
                 . " and kodeSatker='$satker' and noRegister='$register' limit 1 ";
   // print_r($query);
//    echo "<br/><br/>";
     $result=  mysql_query($query,$link) or die(mysql_error());
     while($row=  mysql_fetch_object($result)){
          $Aset_ID=$row->Aset_ID;
          $hasil_pk=$row->$primary;
          $Nilai_Perolehan=$row->NilaiPerolehan;
          
     }
     
     return array($Aset_ID,$Nilai_Perolehan,$hasil_pk);
}

function get_kelompok($Golongan,$Bidang,$Kelompok,$Sub,$Subsub, $nm_database,$link){
     $Golongan=sprintf('%02d', $Golongan);
     $Bidang=sprintf('%02d', $Bidang);
     $Kelompok=sprintf('%02d', $Kelompok);
     $Sub=sprintf('%02d', $Sub);
     $Subsub=sprintf('%02d', $Subsub);
     $Kelompok_ID = null;
     $query="Select kode from $nm_database.kelompok where Golongan='$Golongan' and BIdang='$Bidang' "
             . "       and Kelompok='$Kelompok' and Sub='$Sub' and Subsub='$Subsub' limit 1 ";
    //print_r($query);
     $result=  mysql_query($query) or die(mysql_error());
     while($row=  mysql_fetch_object($result)){
          $Kelompok_ID=$row->kode;
     }
     return $Kelompok_ID;
     
}

function logFile($comment, $fileName=false, $method=false)
{
	
	/*
		method false = "a"
		method (true)1 = w
	*/
	$path = './log/';
	
	if (!$fileName) $fileName = 'Log-'.date('d-m-Y').'.txt';
	
	if ($method){
		$handle = fopen($path.$fileName, "w");
	}else{
		$handle = fopen($path.$fileName, "a");
	}
	
	fwrite($handle, "{$comment}"."\n\n");
	fclose($handle);
}
?>
