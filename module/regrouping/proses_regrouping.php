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

//echo "masuk";
$hregrouping = $_GET['hregrouping'];
if ($hregrouping == "") {
     $tahun = date("Y");
     $KodeSatker = $_POST["kodeSatker"];

     $query = "select NamaSatker from satker where kode='$KodeSatker' limit 1";
     $result = $DBVAR->query($query)or die($DBVAR->error());
     $row = $DBVAR->fetch_object($result);
     $NamaSatker = $row->NamaSatker;

     $kode_baru1 = $_POST['kode_baru1'];
     $kode_baru2 = $_POST['kode_baru2'];
     $kode_baru3 = $_POST['kode_baru3'];
     $kode_baru4 = $_POST['kode_baru4'];
     $satker_baru = $kode_baru1 . "." . $kode_baru2 . "." . $kode_baru3 . "." . $kode_baru4;
     $informasi = $_POST['informasi_regrouping'];
     $nama_satker_baru = $_POST['nama_satker_baru'];

     $query = "select NamaSatker from satker where kode='$satker_baru' limit 1";
     $result = $DBVAR->query($query)or die($DBVAR->error());
     $row = $DBVAR->fetch_object($result);
     $NamaSatkerBaru = $row->NamaSatker;

     $query = "select satker_baru from regrouping where satker_baru='$satker_baru' limit 1";
     $result = $DBVAR->query($query)or die($DBVAR->error());
     $row = $DBVAR->fetch_object($result);
     $cek_satker = $row->satker_baru;

     if ($NamaSatkerBaru == "" && $cek_satker == "") {
          $status_daftar = $_POST["status_daftar"];
          $tgl_proses = date("Y-m-d H:i:s");

          $nama_satker_baru = $_POST['nama_satker_baru'];
          $informasi = $_POST['informasi_regrouping'];

          $query_insert = "insert into regrouping set satker_lama='$KodeSatker', nama_satker_lama='$NamaSatker',"
                  . "                 satker_baru='$satker_baru',nama_satker_baru='$nama_satker_baru',"
                  . "               status_proses='0', informasi='$informasi', tgl_proses='$tgl_proses'";
          $result = $DBVAR->query($query_insert)or die($DBVAR->error());
          echo "<script>alert('Data Regrouping Telah ditambahkan');"
          . "       window.location.href=\"$url_rewrite/module/regrouping/index.php\"</script>";
//          echo $query_insert;
     } else {

          echo "<script>alert('Maaf data satker baru sudah memiliki nama nama di sistem mohon pindahkan ke kode baru"
          . "  terlebih dahulu $NamaSatkerBaru ---$cek_satker');"
          . "       window.location.href=\"$url_rewrite/module/regrouping/index.php\"</script>";
     }
}else{
      $query = "select * from regrouping where id_regrouping='$hregrouping' limit 1";
     $result = $DBVAR->query($query)or die($DBVAR->error());
     $row = $DBVAR->fetch_object($result);
     $status_regrouping = $row->status_proses;
     $satker_lama = $row->satker_lama;
     $satker_baru= $row->satker_baru;
     $nama_satker_lama = $row->nama_satker_lama;
     $nama_satker_baru= $row->nama_satker_baru;
    // print_r($row);
     if($status_regrouping==0){
         
            $query = "delete from regrouping where id_regrouping='$hregrouping' ";
            //echo "$query";
     $result = $DBVAR->query($query)or die($DBVAR->error());
      echo "<script>alert('Data regrouping telah dihapus');"
          . "       window.location.href=\"$url_rewrite/module/regrouping/index.php\"</script>";
     }else{
          echo "<script>alert('Maaf data regrouping telah selesai atau sedang berjalan');"
          . "       window.location.href=\"$url_rewrite/module/regrouping/index.php\"</script>";
     }
     echo  "$status_regrouping --> $satker_lama ($nama_satker_lama)---> $satker_baru($nama_satker_baru))";
}
?>
