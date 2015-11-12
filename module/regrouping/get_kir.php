<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
#This code provided by:
#Andreas Hadiyono (andre.hadiyono@gmail.com)
#Gunadarma University

//untuk regrouping yang kode lokasinya belum di update
include "../../config/config.php";

$tgl_proses = date("Y-m-d H:i:s");
$id_regrouping=$argv[1];
$time_start = microtime_float();

//echo "Start: $tgl_proses  \n ";
echo "<br/>";
$query = "select * from regrouping where status_proses=2";
$result = $DBVAR->query($query)or die($DBVAR->error());
//$data= $DBVAR->_fetch_object($result);
//print_r($data);
 while ($row= $DBVAR->fetch_object($result)){
     $status_regrouping = $row->status_proses; 
$satker_lama = $row->satker_lama;
$satker_baru = $row->satker_baru;
$nama_satker_lama = $row->nama_satker_lama;
$nama_satker_baru = $row->nama_satker_baru;

$kode_like.="kode like '$satker_lama' or ";
$query_update.="update satket set kodeSatker='$satker_baru' where kodeSatker='$satker_lama'; <br> ";
}

echo "$kode_like <br/><br/>$query_update";
  function microtime_float()
{
    list($usec, $sec) = explode(" ", microtime());
    return ((float)$usec + (float)$sec);
}

?>
