<?php

error_reporting(0);
include "../../config/config.php";

$time_start = microtime(true); 

$tgl=date('Y-m-d');
echo "Tanggal Validasi Gudang ";
$no_transfer = $argv[1];
$data_aset=array();
$data_aset['aset']=explode(",",$no_transfer);

$dataArr = $STORE->store_trs_validasi_cli($data_aset);

$time_end = microtime(true);

//dividing with 60 will give the execution time in minutes other wise seconds
$execution_time = ($time_end - $time_start)/60;

//execution time of the script
echo '<b>Total Execution Time:</b> '.$execution_time.' Mins\n\n';

echo "\n\n=================== Process Complete. Thank you ===================\n\n"
?>