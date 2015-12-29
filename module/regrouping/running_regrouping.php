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
session_write_close();
//echo "masuk";
$regrouping = $_GET['regrouping'];
$query = "select * from regrouping where id_regrouping='$regrouping' limit 1";
$result = $DBVAR->query($query)or die($DBVAR->error());
$row = $DBVAR->fetch_object($result);
$status_regrouping = $row->status_proses;
$satker_lama = $row->satker_lama;
$satker_baru = $row->satker_baru;
$nama_satker_lama = $row->nama_satker_lama;
$nama_satker_baru = $row->nama_satker_baru;
if ($status_regrouping == 0) {
     
     $query = "select NamaSatker from satker where kode='$satker_baru' limit 1";
     $result = $DBVAR->query($query)or die($DBVAR->error());
     $row = $DBVAR->fetch_object($result);
     $NamaSatkerBaru = $row->NamaSatker;
     if ($NamaSatkerBaru == "") {
          //running
          $query = "update  regrouping  set status_proses=1 where id_regrouping=$regrouping";
          $DBVAR->query($query) or die($DBVAR->error());
          $status = exec("php running_regrouping_server.php $regrouping > $path/log/regrouping/regrouping-$satker_lama-$satker_baru-$regrouping.txt &");
          echo "<script>alert('Data Regouping Satker $nama_satker_lama ($satker_lama) -->$nama_satker_baru ($satker_baru) Telah Di Proses');"
                  . "       window.location.href=\"$url_rewrite/module/regrouping/index.php\"</script>";
          
     } else {
          echo "<script>alert('Maaf data satker baru sudah memiliki nama nama di sistem mohon pindahkan ke kode baru"
          . "  terlebih dahulu $NamaSatkerBaru ---$cek_satker');"
          . "       window.location.href=\"$url_rewrite/module/regrouping/index.php\"</script>";
     }
} else {
     echo "<script>alert('Maaf data regrouping telah selesai atau sedang berjalan');"
     . "       window.location.href=\"$url_rewrite/module/regrouping/index.php\"</script>";
}
?>
