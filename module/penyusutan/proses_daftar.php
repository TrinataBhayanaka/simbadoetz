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

$tahun=date("Y");
$KelompokAset=$_POST["KelompokAset"];
$status_daftar=$_POST["status_daftar"];
if($status_daftar=="1"){
     $query="insert into penyusutan_tahun_pertama(id,KelompokAset,Tahun,StatusRunning) "
             . " values (NULL,'$KelompokAset','$tahun','0')";
     $DBVAR->query($query) or die($DBVAR->error());
     echo "<script>alert('Data tahun pertama penyusutan telah di masukkan');"
     . "       window.location.href=\"$url_rewrite/module/penyusutan/index.php\"</script>";
}else{
     echo "<script>alert('Maaf tidak ada data');"
     . "       history,back()</script>";
}
?>
