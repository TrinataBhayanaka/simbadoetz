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

$Tahun=$_POST["tahun"];
$kodeSatker=$_POST["kodeSatker"];
$KelompokAset=$_POST["KelompokAset"];
$StatusRunning=$_POST["status_daftar"];
$UserNm = $_POST["UserNm"];
// exit;
// if($status_daftar=="1"){
     $query="insert into penyusutan_tahun(kodeSatker,KelompokAset,Tahun,StatusRunning,UserNm) "
             . " values ('{$kodeSatker}','{$KelompokAset}','{$Tahun}','0','{$UserNm}')";
     $DBVAR->query($query) or die($DBVAR->error());
     echo "<script>alert('Data tahun $Tahun penyusutan telah di masukkan');"
     . "       window.location.href=\"$url_rewrite/module/penyusutan/penyusutan.php\"</script>";
/*}else{
     echo "<script>alert('Maaf tidak ada data');"
     . "       history,back()</script>";
}*/
?>
