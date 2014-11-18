
<?php

include "../../../config/config.php";
include "../../report_engine.php";
// echo "masukk";
$modul = $_REQUEST['menuID'];
$mode = $_REQUEST['mode'];
$tab = $_REQUEST['tab'];
$tahun = $_REQUEST['tahun'];
$skpd_id = $_REQUEST['kodeSatker'];
$kelompok=$_REQUEST['bidang'];
$tipe=$_REQUEST['tipe_file'];
$kib = $_REQUEST['kib'];

// pr($_REQUEST);
$data=array(
    "modul"=>$modul,
    "mode"=>$mode,
    "kib"=>$kib,
    "tahun"=>$tahun,
    "skpd_id"=>$skpd_id,
    "kelompok"=>$kelompok,
    "tab"=>$tab
);

// print_r($_POST);
// exit;

$paramater_url="menuID=$modul&mode=$mode&tab=$tab&skpd_id=$skpd_id&tahun=$tahun&kib=$kib&bidang=$kelompok&tipe_file=";
// echo $paramater_url;
if(isset($kib))
{
    $REPORT=new report_engine();
    switch ($kib)
    {
        case 'KIB-A':
            {
                
                $url="report_perolehanaset_cetak_kiba.php?$paramater_url";
				//include 'report_perolehanaset_cetak_kiba.php';
//                echo "<script>window.location.href='$namafile_web';</script>";

            }
            break;
        case 'KIB-B':
            {
				$url="report_perolehanaset_cetak_kibb.php?$paramater_url";
                //include 'report_perolehanaset_cetak_kibb.php';
            }
            break;
        case 'KIB-C':
            {
				$url="report_perolehanaset_cetak_kibc.php?$paramater_url";	
                //include 'report_perolehanaset_cetak_kibc.php';
            }
            break;
        case 'KIB-D':
            {
				$url="report_perolehanaset_cetak_kibd.php?$paramater_url";
                //include 'report_perolehanaset_cetak_kibd.php';
            }
            break;
        case 'KIB-E':
            {
				$url="report_perolehanaset_cetak_kibe.php?$paramater_url";
               // include 'report_perolehanaset_cetak_kibe.php';
            }
            break;
        case 'KIB-F':
            {
				$url="report_perolehanaset_cetak_kibf.php?$paramater_url";
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

 

