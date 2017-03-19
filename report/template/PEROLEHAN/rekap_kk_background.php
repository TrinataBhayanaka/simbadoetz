<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



//This code provided by:
//Andreas Hadiyono (andre.hadiyono@gmail.com)
//Gunadarma University
ob_start();
require_once '../../../config/config.php';
$modul = $_GET['menuID'];
$mode = $_GET['mode'];
$tab = $_GET['tab'];
$tglawal = $_GET['tglawalperolehan'];
if ( $tglawal != '' ) {
  $tglawalperolehan = $tglawal;
} else {
  $tglawalperolehan = '0000-00-00';
}
$tglakhirperolehan = $_GET['tglakhirperolehan'];
$tglakhirperolehan = $_GET['tglakhirperolehan'];
$skpd_id = $_GET['skpd_id'];
$levelAset = $_GET['levelAset'];
$tipeAset = $_GET['tipeAset'];
$tipe = $_GET['tipe_file'];


echo("php rekap_kk_detail_v2_spout.php 1 $tglakhirperolehan $skpd_id $levelAset $tipeAset > $path/log/hasil-rekap-detail-$tipeAset-$skpd_id.txt &");
$status=   exec("php rekap_kk_detail_v2_spout.php 1 $tglakhirperolehan $skpd_id $levelAset $tipeAset > $path/log/hasil-rekap-detail-$tipeAset-$skpd_id.txt &");
echo $status;




?>
