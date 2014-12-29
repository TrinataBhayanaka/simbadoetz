<?php

include "../../../config/config.php";
include "../../report_engine.php";
// echo "masukk";
$modul = $_REQUEST['menuID'];
$mode = $_REQUEST['mode'];
$tab = $_REQUEST['tab'];
// $tahun = $_REQUEST['tahun'];
$skpd_id = $_REQUEST['kodeSatker7'];
$tglcetak = $_REQUEST['tglCetakRekapKib'];
// $kelompok=$_REQUEST['bidang'];
$tipe=$_REQUEST['tipe_file'];
$rekap = $_REQUEST['rekap'];

// pr($_REQUEST);
$data=array(
    "modul"=>$modul,
    "mode"=>$mode,
    "rekap"=>$rekap,
    // "tahun"=>$tahun,
    "skpd_id"=>$skpd_id,
    // "kelompok"=>$kelompok,
    "tab"=>$tab
);

// print_r($_POST);
// exit;

$paramater_url="menuID=$modul&mode=$mode&tab=$tab&skpd_id=$skpd_id&rekap=$rekap&tglcetak=$tglcetak&tipe_file=";
// echo $paramater_url;
if(isset($rekap))
{
    $REPORT=new report_engine();
    switch ($rekap)
    {
        case 'RekapKIB-A':
            {
				// echo $paramater_url;
                // echo"masuk a";
				// exit;
                $url="report_perolehanaset_cetak_kiba_rekap.php?$paramater_url";
				//include 'report_perolehanaset_cetak_kiba.php';
//                echo "<script>window.location.href='$namafile_web';</script>";

            }
            break;
        case 'RekapKIB-B':
            {
				
				// echo $paramater_url;
                // echo"masuk b";
				// exit;
				$url="report_perolehanaset_cetak_kibb_rekap.php?$paramater_url";
                //include 'report_perolehanaset_cetak_kibb.php';
            }
            break;
        case 'RekapKIB-C':
            {
				
				// echo $paramater_url;
                // echo"masuk c";
				// exit;
				$url="report_perolehanaset_cetak_kibc_rekap.php?$paramater_url";	
                //include 'report_perolehanaset_cetak_kibc.php';
            }
            break;
        case 'RekapKIB-D':
            {
				
				// echo $paramater_url;
                // echo"masuk d";
				// exit;
				$url="report_perolehanaset_cetak_kibd_rekap.php?$paramater_url";
                //include 'report_perolehanaset_cetak_kibd.php';
            }
            break;
        case 'RekapKIB-E':
            {
				
				// echo $paramater_url;
                // echo"masuk e";
				// exit;
				$url="report_perolehanaset_cetak_kibe_rekap.php?$paramater_url";
               // include 'report_perolehanaset_cetak_kibe.php';
            }
            break;
        case 'RekapKIB-F':
            {
				
				// echo $paramater_url;
                // echo"masuk f";
				// exit;
				$url="report_perolehanaset_cetak_kibf_rekap.php?$paramater_url";
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

 
