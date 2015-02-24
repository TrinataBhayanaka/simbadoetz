<?php
ob_start();
require_once('../../../config/config.php');

define("_JPGRAPH_PATH", "$path/function/mpdf/jpgraph/src/"); // must define this before including mpdf.php file
$JpgUseSVGFormat = true;
define('_MPDF_URI',"$url_rewrite/function/mpdf/"); 	// must be  a relative or absolute URI - not a file system path

include "../../report_engine.php";
require ('../../../function/mpdf/mpdf.php');

/*$modul = $_GET['menuID'];
$mode = $_GET['mode'];
$tab = $_GET['tab'];*/
$skpd_id = $_GET['skpd_id'];
$tipe=$_GET['tipe_file'];
$tglawal = $_GET['tglawalperolehan'];
if($tglawal != ''){
	$tglawalperolehan = $tglawal;
}else{
	$tglawalperolehan = '0000-00-00';
}
$tglakhirperolehan = $_GET['tglakhirperolehan'];
// pr($_GET);
// exit;
//tgl Akhir Mutasi awal
$split = explode('-',$tglakhirperolehan);
$tglMutasi = $split[2];
$blnMutasi = $split[1];
$ThnMutasi = $split[0] - 1;
$tglAkhirMutasiAwal = $ThnMutasi.'-'.$blnMutasi.'-'.$tglMutasi;
// echo "tglAkhirMutasiAwal =".$tglAkhirMutasiAwal;
// echo "<br>";
// exit;
$REPORT=new report_engine();

$gambar = $FILE_GAMBAR_KABUPATEN;

//create temp table
$hit = 2;
$flag = '';
$TypeRprtr = 'neraca';
$Info = '';
$exeTempTable = $REPORT->TempTable($hit,$flag,$TypeRprtr,$Info,$tglawalperolehan,$tglAkhirMutasiAwal,
$skpd_id);
// exit;
$resultParamGol = $REPORT->ceckneraca($skpd_id,$tglawalperolehan,$tglAkhirMutasiAwal);	
// pr($resultParamGol);
// exit;	

//retrieve html
$html=$REPORT->retrieve_html_rekap_mutasi($resultParamGol,$gambar,$skpd_id,
$tglawalperolehan,$tglAkhirMutasiAwal,$tglakhirperolehan);
/*$count = count($html);
	for ($i = 0; $i < $count; $i++) {
		 
		 echo $html[$i];     
	}
exit;*/

if($tipe!="2"){
$REPORT->show_status_download_kib();
$mpdf=new mPDF('','','','',15,15,16,16,9,9,'L');
$mpdf->AddPage('L','','','','',15,15,16,16,9,9);
$mpdf->setFooter('{PAGENO}') ;
$mpdf->progbar_heading = '';
$mpdf->StartProgressBarOutput(2);
$mpdf->useGraphs = true;
$mpdf->list_number_suffix = ')';
$mpdf->hyphenate = true;
//$mpdf->debug = true;
$count = count($html);

	for ($i = 0; $i < $count; $i++) {
		 if($i==0)
			  $mpdf->WriteHTML($html[$i]);
		 else
		 {
			   $mpdf->AddPage('L','','','','',15,15,16,16,9,9);
			   $mpdf->WriteHTML($html[$i]);
			   
		 }
	}

$waktu=date("d-m-y_h-i-s");
$namafile="$path/report/output/Rekapitulasi Barang Ke Neraca_$waktu.pdf";
$mpdf->Output("$namafile",'F');
$namafile_web="$url_rewrite/report/output/Rekapitulasi Barang Ke Neraca_$waktu.pdf";
echo "<script>window.location.href='$namafile_web';</script>";
exit;
}
else
{
	$waktu=date("d-m-y_h:i:s");
	$filename ="Rekapitulasi_Barang_Ke_Neraca_$waktu.xls";
	header('Content-type: application/ms-excel');
	header('Content-Disposition: attachment; filename='.$filename);
	$count = count($html);
	for ($i = 0; $i < $count; $i++) {
           echo "$html[$i]";
           
     }
}


?>
