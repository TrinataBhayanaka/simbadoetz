<?php

include "../../../config/config.php";
include "../../report_engine.php";
// echo "masukk";
// exit;
$modul = $_REQUEST['menuID'];
$mode = $_REQUEST['mode'];
$tab = $_REQUEST['tab'];
$tahun = $_REQUEST['tahun_rekap_sensus'];
$skpd_id = $_REQUEST['kodeSatker18'];
// $tglcetak = $_REQUEST['tglCetakRekapKib'];
// $kelompok=$_REQUEST['bidang'];
$tipe=$_REQUEST['tipe_file'];
$rekap_barang_sensus = $_REQUEST['rekap_barang_sensus'];
$pemilik = $_REQUEST['pemilik'];
// pr($_REQUEST);
// exit;
$data=array(
    "modul"=>$modul,
    "mode"=>$mode,
    "rekap_barang_sensus"=>$rekap_barang_sensus,
    "tahun"=>$tahun,
    "skpd_id"=>$skpd_id,
	 "pemilik"=>$pemilik,
    // "kelompok"=>$kelompok,
    "tab"=>$tab
);

// print_r($_POST);
// exit;

$paramater_url="menuID=$modul&mode=$mode&tab=$tab&skpd_id=$skpd_id&&pemilik=$pemilik&rekap_barang_sensus=$rekap_barang_sensus&tahun=$tahun&tipe_file=";
// echo $paramater_url;
if(isset($rekap_barang_sensus))
{
    $REPORT=new report_engine();
    switch ($rekap_barang_sensus)
    {
        case 'RekapBarangSensusKIB-A':
            {
				// echo $paramater_url;
                // echo"masuk a";
				// exit;
                $url="report_perolehanaset_cetak_kiba_rekap_barang_sensus.php?$paramater_url";
				//include 'report_perolehanaset_cetak_kiba.php';
//                echo "<script>window.location.href='$namafile_web';</script>";

            }
            break;
        case 'RekapBarangSensusKIB-B':
            {
				
				// echo $paramater_url;
                // echo"masuk b";
				// exit;
				$url="report_perolehanaset_cetak_kibb_rekap_barang_sensus.php?$paramater_url";
                //include 'report_perolehanaset_cetak_kibb.php';
            }
            break;
        case 'RekapBarangSensusKIB-C':
            {
				
				// echo $paramater_url;
                // echo"masuk c";
				// exit;
				$url="report_perolehanaset_cetak_kibc_rekap_barang_sensus.php?$paramater_url";	
                //include 'report_perolehanaset_cetak_kibc.php';
            }
            break;
        case 'RekapBarangSensusKIB-D':
            {
				
				// echo $paramater_url;
                // echo"masuk d";
				// exit;
				$url="report_perolehanaset_cetak_kibd_rekap_barang_sensus.php?$paramater_url";
                //include 'report_perolehanaset_cetak_kibd.php';
            }
            break;
        case 'RekapBarangSensusKIB-E':
            {
				
				// echo $paramater_url;
                // echo"masuk e";
				// exit;
				$url="report_perolehanaset_cetak_kibe_rekap_barang_sensus.php?$paramater_url";
               // include 'report_perolehanaset_cetak_kibe.php';
            }
            break;
        case 'RekapBarangSensusKIB-F':
            {
				
				// echo $paramater_url;
                // echo"masuk f";
				// exit;
				$url="report_perolehanaset_cetak_kibf_rekap_barang_sensus.php?$paramater_url";
                //include 'report_perolehanaset_cetak_kibf.php';
            }
            break;
    }
    
$REPORT->show_pilih_download($url);    
/*echo "Download File $kib A tersedia dalam bentuk:<br/>";
echo "1. <a href=\"$url"."1\">PDF</a><br/>";
echo "2. <a href=\"$url"."2\">Micorosoft Excel</a>";
*/
}

?>

 
