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
$KelompokAset=$_GET[par];
$get_data_penyusutan= $PENYUSUTAN->getStatusPenyusutan($KelompokAset);

foreach($get_data_penyusutan as $val){
     $status_running=$val['StatusRunning'];
     $id=$val['id'];
     $kelompok=$val['KelompokAset'];
 }
 echo "ID====$id";
     
	 
                    $KelompokAset=array("0"=>"Peralatan dan Mesin (B)",
                                           "1"=>"Gedung dan Bangunan (C)",
                                             "2"=>"Jalan, Irigrasi, dan Jaringan (D)",
                                             "3"=>"Aset Tetap Lainnya (E)");
                    
  if($status_running==0){
          switch ($kelompok) {
               case "Peralatan dan Mesin (B)":
                    $query="update  penyusutan_tahun_pertama  set StatusRunning=1 where id=$id";
                    $DBVAR->query($query) or die($DBVAR->error());
                   // $status=exec("php running_penyusutan_server.php B $id > log/penyusutan-B.txt &");
					  $status=exec("php running_penyusutan_server.php B $id ");

                   break;

              case "Gedung dan Bangunan (C)":
                   $query="update  penyusutan_tahun_pertama  set StatusRunning=1 where id=$id";
                    $DBVAR->query($query) or die($DBVAR->error());
                    $status=   exec("php running_penyusutan_server.php C $id > log/penyusutan-C.txt &");
                   break;

              case "Jalan, Irigrasi, dan Jaringan (D)":
                   $query="update  penyusutan_tahun_pertama  set StatusRunning=1 where id=$id";
                    $DBVAR->query($query) or die($DBVAR->error());
                    $status=   exec("php running_penyusutan_server.php D $id > log/penyusutan-D.txt &");
                   break;

              case "Aset Tetap Lainnya (E)":
                   $query="update  penyusutan_tahun_pertama  set StatusRunning=1 where id=$id";
                    $DBVAR->query($query) or die($DBVAR->error());
                    $status=   exec("php running_penyusutan_server.php E $id > log/penyusutan-E.txt &");
                   break;
         }
         echo $status;
 }
 else if($status_running==1){
        echo "<script>alert('Data $kelompok sedang disusutkan');"
     . "       window.location.href=\"$url_rewrite/module/penyusutan/index.php\"</script>";
 }
 else if($status_running==2){
              echo "<script>alert('Data $kelompok telah berhasil disusutkan');"
     . "       window.location.href=\"$url_rewrite/module/penyusutan/index.php\"</script>";

 }
?>
