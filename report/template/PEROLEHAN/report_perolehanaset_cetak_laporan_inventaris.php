<?php
ob_start();
require_once('../../../config/config.php');
include ('../../../function/tanggal/tanggal.php');

define("_JPGRAPH_PATH", "$path/function/mpdf/jpgraph/src/"); // must define this before including mpdf.php file
$JpgUseSVGFormat = true;
define('_MPDF_URI',"$url_rewrite/function/mpdf/"); 	// must be  a relative or absolute URI - not a file system path

include "../../report_engine.php";
require_once('../../../function/mpdf/mpdf.php');

$skpd_id = $_POST['kodeSatker17'];
$kelompok = $_POST['kodeKelompok'];

$tglPrlhn = $_POST['tglawalPerolehan_li'];
if($tglPrlhn != ''){
	$tglperolehan = $tglPrlhn;
}else{
	$tglperolehan = '';
}

$tglPmbkuan = $_POST['tglpembukuan_li'];
if($tglPmbkuan != ''){
	$tglpembukuan = $tglPmbkuan;
}else{
	$tglpembukuan = '';
}

// pr($_POST);
// exit;

//mendeklarasikan report_engine. FILE utama untuk reporting
$REPORT=new report_engine();

$hit = count($query);
$flag = '';
$TypeRprtr = '';
$Info = '';
/*$exeTempTable = $REPORT->TempTable($hit,$flag,$TypeRprtr,$Info,$tglawalperolehan,$tglakhirperolehan,
$skpd_id);*/
// exit;

$GetData = $REPORT->LaporanInventaris($skpd_id,$kelompok,$tglperolehan,$tglpembukuan);
//set gambar untuk laporan
$gambar = $FILE_GAMBAR_KABUPATEN;


$html=$REPORT->retrieve_html_laporan_inventaris($GetData,$gambar);
/*$count = count($html);
	for ($i = 0; $i < $count; $i++) {
		 echo $html[$i];     
	}
exit;*/
$REPORT->show_status_download_kib();
$mpdf=new mPDF('','','','',15,15,16,16,9,9,'L');
$mpdf->AddPage('L','','','','',15,15,16,16,9,9);
$mpdf->setFooter('{PAGENO}') ;
$mpdf->progbar_heading = '';
$mpdf->StartProgressBarOutput(2);
$mpdf->useGraphs = true;
$mpdf->list_number_suffix = ')';
$mpdf->hyphenate = true;

$count = count($html);

	for ($i = 0; $i < $count; $i++) {
		 if($i==0)
			{ 
			$mpdf->WriteHTML($html[$i]);
			}
		 else
		 {
			   $mpdf->AddPage('L','','','','',15,15,16,16,9,9);
			   $mpdf->WriteHTML($html[$i]);
			   
		 }
	}

$waktu=date("d-m-y_h-i-s");
$namafile="$path/report/output/Laporan Inventaris $waktu.pdf";
$mpdf->Output("$namafile",'F');
$namafile_web="$url_rewrite/report/output/Laporan Inventaris $waktu.pdf";
echo "<script>window.location.href='$namafile_web';</script>";
exit;


?>
