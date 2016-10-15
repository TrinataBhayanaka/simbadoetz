<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function open_connection(){ 
 $db_host="localhost"; 
 $db_user="root";
 $db_pass="new-password";
 $link=mysql_connect($db_host,$db_user,$db_pass)  
 or die ("Koneksi Database gagal"); 
 mysql_select_db("simbada_2014_full_v1_29feb2016");
 return $link; 
}
open_connection();

$query="select log_id,Aset_ID,UmurEkonomis,Tahun,TahunPenyusutan,"
        . "((TahunPenyusutan-Tahun)+1) as rentang,MasaManfaat,"
        . "if((MasaManfaat-((TahunPenyusutan-Tahun)+1)) <0,0,(MasaManfaat-((TahunPenyusutan-Tahun)+1)))as hasil "
        . "from log_bangunan where Kd_riwayat=50 and TahunPenyusutan='2014' ;";

$result=  mysql_query($query) or die(mysql_error());
while($row= mysql_fetch_object($result)){
    $log_id=$row->log_id;
    $Aset_ID=$row->Aset_ID;
    $UmurEkonomis=$row->UmurEkonomis;
    $rentang=$row->rentang;
    $MasaManfaat=$row->MasaManfaat;
    $hasil=$row->hasil;
    
    echo "update log_bangunan set UmurEkonomis=$hasil where log_id='$log_id';\n";
    
    
}