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

//ketinggalan 1
//tanah
$query="update log_tanah set kodeSatker='$satker_baru' where kodeSatker='$satker_lama' ;";
echo "$query <br/>";
//aset
$query="update aset set kodeLokasi=concat(SUBSTRING_INDEX(kodeLokasi, '.', 3),'.',SUBSTRING_INDEX(kodeSatker, '.', 2),'.',substring(kodeLokasi,16,2),'.',SUBSTRING_INDEX(kodeSatker, '.', -2))
 WHERE `kodeSatker` LIKE '$satker_baru' and kodeLokasi not like '0%'; ";
echo "$query <br/>";
$query="update aset set kodeLokasi=concat(SUBSTRING_INDEX(kodeLokasi, '.', 3),'.',SUBSTRING_INDEX(kodeSatker, '.', 2),'.',substring(kodeLokasi,15,2),'.',SUBSTRING_INDEX(kodeSatker, '.', -2))
WHERE `kodeSatker` LIKE '$satker_baru' and kodeLokasi  like '0%'; ";
echo "$query <br/>";
//tanah
$query="update tanah set kodeLokasi=concat(SUBSTRING_INDEX(kodeLokasi, '.', 3),'.',SUBSTRING_INDEX(kodeSatker, '.', 2),'.',substring(kodeLokasi,16,2),'.',SUBSTRING_INDEX(kodeSatker, '.', -2))
 WHERE `kodeSatker` LIKE '$satker_baru' and kodeLokasi not like '0%'; ";
echo "$query <br/>";
$query="update tanah set kodeLokasi=concat(SUBSTRING_INDEX(kodeLokasi, '.', 3),'.',SUBSTRING_INDEX(kodeSatker, '.', 2),'.',substring(kodeLokasi,15,2),'.',SUBSTRING_INDEX(kodeSatker, '.', -2))
WHERE `kodeSatker` LIKE '$satker_baru' and kodeLokasi  like '0%'; ";
echo "$query <br/>";

$query="update mesin set kodeLokasi=concat(SUBSTRING_INDEX(kodeLokasi, '.', 3),'.',SUBSTRING_INDEX(kodeSatker, '.', 2),'.',substring(kodeLokasi,16,2),'.',SUBSTRING_INDEX(kodeSatker, '.', -2))
 WHERE `kodeSatker` LIKE '$satker_baru' and kodeLokasi not like '0%'; ";
echo "$query <br/>";
$query="update mesin set kodeLokasi=concat(SUBSTRING_INDEX(kodeLokasi, '.', 3),'.',SUBSTRING_INDEX(kodeSatker, '.', 2),'.',substring(kodeLokasi,15,2),'.',SUBSTRING_INDEX(kodeSatker, '.', -2))
WHERE `kodeSatker` LIKE '$satker_baru' and kodeLokasi  like '0%'; ";
echo "$query <br/>";

$query="update bangunan set kodeLokasi=concat(SUBSTRING_INDEX(kodeLokasi, '.', 3),'.',SUBSTRING_INDEX(kodeSatker, '.', 2),'.',substring(kodeLokasi,16,2),'.',SUBSTRING_INDEX(kodeSatker, '.', -2))
 WHERE `kodeSatker` LIKE '$satker_baru' and kodeLokasi not like '0%'; ";
echo "$query <br/>";
$query="update bangunan set kodeLokasi=concat(SUBSTRING_INDEX(kodeLokasi, '.', 3),'.',SUBSTRING_INDEX(kodeSatker, '.', 2),'.',substring(kodeLokasi,15,2),'.',SUBSTRING_INDEX(kodeSatker, '.', -2))
WHERE `kodeSatker` LIKE '$satker_baru' and kodeLokasi  like '0%'; ";
echo "$query <br/>";

$query="update jaringan set kodeLokasi=concat(SUBSTRING_INDEX(kodeLokasi, '.', 3),'.',SUBSTRING_INDEX(kodeSatker, '.', 2),'.',substring(kodeLokasi,16,2),'.',SUBSTRING_INDEX(kodeSatker, '.', -2))
 WHERE `kodeSatker` LIKE '$satker_baru' and kodeLokasi not like '0%'; ";
echo "$query <br/>";
$query="update jaringan set kodeLokasi=concat(SUBSTRING_INDEX(kodeLokasi, '.', 3),'.',SUBSTRING_INDEX(kodeSatker, '.', 2),'.',substring(kodeLokasi,15,2),'.',SUBSTRING_INDEX(kodeSatker, '.', -2))
WHERE `kodeSatker` LIKE '$satker_baru' and kodeLokasi  like '0%'; ";
echo "$query <br/>";

$query="update kdp set kodeLokasi=concat(SUBSTRING_INDEX(kodeLokasi, '.', 3),'.',SUBSTRING_INDEX(kodeSatker, '.', 2),'.',substring(kodeLokasi,16,2),'.',SUBSTRING_INDEX(kodeSatker, '.', -2))
 WHERE `kodeSatker` LIKE '$satker_baru' and kodeLokasi not like '0%'; ";
echo "$query <br/>";
$query="update kdp set kodeLokasi=concat(SUBSTRING_INDEX(kodeLokasi, '.', 3),'.',SUBSTRING_INDEX(kodeSatker, '.', 2),'.',substring(kodeLokasi,15,2),'.',SUBSTRING_INDEX(kodeSatker, '.', -2))
WHERE `kodeSatker` LIKE '$satker_baru' and kodeLokasi  like '0%'; ";
echo "$query <br/>";

$query="update asetlain set kodeLokasi=concat(SUBSTRING_INDEX(kodeLokasi, '.', 3),'.',SUBSTRING_INDEX(kodeSatker, '.', 2),'.',substring(kodeLokasi,16,2),'.',SUBSTRING_INDEX(kodeSatker, '.', -2))
 WHERE `kodeSatker` LIKE '$satker_baru' and kodeLokasi not like '0%'; ";
echo "$query <br/>";
$query="update asetlain set kodeLokasi=concat(SUBSTRING_INDEX(kodeLokasi, '.', 3),'.',SUBSTRING_INDEX(kodeSatker, '.', 2),'.',substring(kodeLokasi,15,2),'.',SUBSTRING_INDEX(kodeSatker, '.', -2))
WHERE `kodeSatker` LIKE '$satker_baru' and kodeLokasi  like '0%'; ";
echo "$query <br/>";


//tanah
$query="update log_tanah set kodeLokasi=concat(SUBSTRING_INDEX(kodeLokasi, '.', 3),'.',SUBSTRING_INDEX(kodeSatker, '.', 2),'.',substring(kodeLokasi,16,2),'.',SUBSTRING_INDEX(kodeSatker, '.', -2))
 WHERE `kodeSatker` LIKE '$satker_baru' and kodeLokasi not like '0%'; ";
echo "$query <br/>";
$query="update log_tanah set kodeLokasi=concat(SUBSTRING_INDEX(kodeLokasi, '.', 3),'.',SUBSTRING_INDEX(kodeSatker, '.', 2),'.',substring(kodeLokasi,15,2),'.',SUBSTRING_INDEX(kodeSatker, '.', -2))
WHERE `kodeSatker` LIKE '$satker_baru' and kodeLokasi  like '0%'; ";
echo "$query <br/>";
$query="update log_mesin set kodeLokasi=concat(SUBSTRING_INDEX(kodeLokasi, '.', 3),'.',SUBSTRING_INDEX(kodeSatker, '.', 2),'.',substring(kodeLokasi,16,2),'.',SUBSTRING_INDEX(kodeSatker, '.', -2))
 WHERE `kodeSatker` LIKE '$satker_baru' and kodeLokasi not like '0%'; ";
echo "$query <br/>";
$query="update log_mesin set kodeLokasi=concat(SUBSTRING_INDEX(kodeLokasi, '.', 3),'.',SUBSTRING_INDEX(kodeSatker, '.', 2),'.',substring(kodeLokasi,15,2),'.',SUBSTRING_INDEX(kodeSatker, '.', -2))
WHERE `kodeSatker` LIKE '$satker_baru' and kodeLokasi  like '0%'; ";
echo "$query <br/>";

$query="update log_bangunan set kodeLokasi=concat(SUBSTRING_INDEX(kodeLokasi, '.', 3),'.',SUBSTRING_INDEX(kodeSatker, '.', 2),'.',substring(kodeLokasi,16,2),'.',SUBSTRING_INDEX(kodeSatker, '.', -2))
 WHERE `kodeSatker` LIKE '$satker_baru' and kodeLokasi not like '0%'; ";
echo "$query <br/>";
$query="update log_bangunan set kodeLokasi=concat(SUBSTRING_INDEX(kodeLokasi, '.', 3),'.',SUBSTRING_INDEX(kodeSatker, '.', 2),'.',substring(kodeLokasi,15,2),'.',SUBSTRING_INDEX(kodeSatker, '.', -2))
WHERE `kodeSatker` LIKE '$satker_baru' and kodeLokasi  like '0%'; ";
echo "$query <br/>";

$query="update log_jaringan set kodeLokasi=concat(SUBSTRING_INDEX(kodeLokasi, '.', 3),'.',SUBSTRING_INDEX(kodeSatker, '.', 2),'.',substring(kodeLokasi,16,2),'.',SUBSTRING_INDEX(kodeSatker, '.', -2))
 WHERE `kodeSatker` LIKE '$satker_baru' and kodeLokasi not like '0%'; ";
echo "$query <br/>";
$query="update log_jaringan set kodeLokasi=concat(SUBSTRING_INDEX(kodeLokasi, '.', 3),'.',SUBSTRING_INDEX(kodeSatker, '.', 2),'.',substring(kodeLokasi,15,2),'.',SUBSTRING_INDEX(kodeSatker, '.', -2))
WHERE `kodeSatker` LIKE '$satker_baru' and kodeLokasi  like '0%'; ";
echo "$query <br/>";

$query="update log_kdp set kodeLokasi=concat(SUBSTRING_INDEX(kodeLokasi, '.', 3),'.',SUBSTRING_INDEX(kodeSatker, '.', 2),'.',substring(kodeLokasi,16,2),'.',SUBSTRING_INDEX(kodeSatker, '.', -2))
 WHERE `kodeSatker` LIKE '$satker_baru' and kodeLokasi not like '0%'; ";
echo "$query <br/>";
$query="update log_kdp set kodeLokasi=concat(SUBSTRING_INDEX(kodeLokasi, '.', 3),'.',SUBSTRING_INDEX(kodeSatker, '.', 2),'.',substring(kodeLokasi,15,2),'.',SUBSTRING_INDEX(kodeSatker, '.', -2))
WHERE `kodeSatker` LIKE '$satker_baru' and kodeLokasi  like '0%'; ";
echo "$query <br/>";

$query="update log_asetlain set kodeLokasi=concat(SUBSTRING_INDEX(kodeLokasi, '.', 3),'.',SUBSTRING_INDEX(kodeSatker, '.', 2),'.',substring(kodeLokasi,16,2),'.',SUBSTRING_INDEX(kodeSatker, '.', -2))
 WHERE `kodeSatker` LIKE '$satker_baru' and kodeLokasi not like '0%'; ";
echo "$query <br/>";
$query="update log_asetlain set kodeLokasi=concat(SUBSTRING_INDEX(kodeLokasi, '.', 3),'.',SUBSTRING_INDEX(kodeSatker, '.', 2),'.',substring(kodeLokasi,15,2),'.',SUBSTRING_INDEX(kodeSatker, '.', -2))
WHERE `kodeSatker` LIKE '$satker_baru' and kodeLokasi  like '0%'; ";
echo "$query <br/>";

echo "<br/><br/>";
}
  function microtime_float()
{
    list($usec, $sec) = explode(" ", microtime());
    return ((float)$usec + (float)$sec);
}

?>
