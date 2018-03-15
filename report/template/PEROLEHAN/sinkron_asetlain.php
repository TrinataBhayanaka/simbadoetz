<?php
/**
 * Created by PhpStorm.
 * User: andreas
 * Date: 3/15/18
 * Time: 5:44 PM
 */
ob_start ();
require_once ('../../../config/config.php');
$query="select * from satker where KodeSatker is NOT NULL AND KodeUnit is NOT NULL AND Gudang is NOT NULL 
  AND Kd_Ruang is NULL AND Kd_Ruang IS NULL AND kode LIKE '08%'  ";
$resultfinal = mysql_query ($query) or die(mysql_error());

foreach ($resultfinal as $value) {
    $kode = $value->kode;
    exec("php sinkronisasi_laporan_v1.php asetlain $kode > asetlain_$kode &");
        sleep(120);
}
?>