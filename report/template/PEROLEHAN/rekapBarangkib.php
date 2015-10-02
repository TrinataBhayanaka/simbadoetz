<?php

include "../../../config/config.php";
include "../../report_engine.php";
// echo "masukk";
$modul = $_REQUEST['menuID'];
$mode = $_REQUEST['mode'];
$tab = $_REQUEST['tab'];
$tahun = $_REQUEST['tahun_rekap'];
$skpd_id = $_REQUEST['kodeSatker16'];
// $tglcetak = $_REQUEST['tglCetakRekapKib'];
// $kelompok=$_REQUEST['bidang'];
$tipe=$_REQUEST['tipe_file'];
$rekap_barang = $_REQUEST['rekap_barang'];
$pemilik = $_REQUEST['pemilik'];
// pr($_REQUEST);
// exit;
$data=array(
    "modul"=>$modul,
    "mode"=>$mode,
    "rekap_barang"=>$rekap_barang,
    "tahun"=>$tahun,
    "skpd_id"=>$skpd_id,
	 "pemilik"=>$pemilik,
    // "kelompok"=>$kelompok,
    "tab"=>$tab
);

// print_r($_POST);
// exit;

$paramater_url="menuID=$modul&mode=$mode&tab=$tab&skpd_id=$skpd_id&&pemilik=$pemilik&rekap_barang=$rekap_barang&tahun=$tahun&tipe_file=";
// echo $paramater_url;
if(isset($rekap_barang))
{
    $REPORT=new report_engine();
    switch ($rekap_barang)
    {
        case 'RekapBarangKIB-A':
            {
				// echo $paramater_url;
                // echo"masuk a";
				// exit;
                $url="report_perolehanaset_cetak_kiba_rekap_barang.php?$paramater_url";
				//include 'report_perolehanaset_cetak_kiba.php';
//                echo "<script>window.location.href='$namafile_web';</script>";

            }
            break;
        case 'RekapBarangKIB-B':
            {
				
				// echo $paramater_url;
                // echo"masuk b";
				// exit;
				$url="report_perolehanaset_cetak_kibb_rekap_barang.php?$paramater_url";
                //include 'report_perolehanaset_cetak_kibb.php';
            }
            break;
        case 'RekapBarangKIB-C':
            {
				
				// echo $paramater_url;
                // echo"masuk c";
				// exit;
				$url="report_perolehanaset_cetak_kibc_rekap_barang.php?$paramater_url";	
                //include 'report_perolehanaset_cetak_kibc.php';
            }
            break;
        case 'RekapBarangKIB-D':
            {
				
				// echo $paramater_url;
                // echo"masuk d";
				// exit;
				$url="report_perolehanaset_cetak_kibd_rekap_barang.php?$paramater_url";
                //include 'report_perolehanaset_cetak_kibd.php';
            }
            break;
        case 'RekapBarangKIB-E':
            {
				
				// echo $paramater_url;
                // echo"masuk e";
				// exit;
				$url="report_perolehanaset_cetak_kibe_rekap_barang.php?$paramater_url";
               // include 'report_perolehanaset_cetak_kibe.php';
            }
            break;
        case 'RekapBarangKIB-F':
            {
				
				// echo $paramater_url;
                // echo"masuk f";
				// exit;
				$url="report_perolehanaset_cetak_kibf_rekap_barang.php?$paramater_url";
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

 
