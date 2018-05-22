<?php
ob_start();
require_once('../../../config/config.php');

define("_JPGRAPH_PATH", "$path/function/mpdf/jpgraph/src/"); // must define this before including mpdf.php file
$JpgUseSVGFormat = true;
define('_MPDF_URI',"$url_rewrite/function/mpdf/"); 	// must be  a relative or absolute URI - not a file system path

include "../../report_engine.php";
require ('../../../function/mpdf/mpdf.php');

$modul = $_GET['menuID'];
$mode = $_GET['mode'];
$tab = $_GET['tab'];
$tglawal = $_GET['tglawalperolehan'];
if($tglawal != ''){
	$tglawalperolehan = $tglawal;
}else{
	$tglawalperolehan = '0000-00-00';
}
$tglakhirperolehan = $_GET['tglakhirperolehan'];
$skpd_id = $_GET['skpd_id'];
$tipe=$_GET['tipe_file'];
// pr($_GET);
$REPORT=new report_engine();


$data=array(
    "modul"=>$modul,
    "mode"=>$mode,
	"tglawalperolehan"=>$tglawalperolehan,
    "tglakhirperolehan"=>$tglakhirperolehan,
    "skpd_id"=>$skpd_id,
	"tab"=>$tab
);

$REPORT->set_data($data);

$gambar = $FILE_GAMBAR_KABUPATEN;

/*
Add $TAHUN_AKTIF
*/
/*$expld = explode('-', $tglakhirperolehan);
$tglCmpr = $TAHUN_AKTIF."-"."12-31";
if($TAHUN_AKTIF == $expld[0] && $tglCmpr == $tglakhirperolehan){
	$hit = 1;
	$flag = 'Lain';
	$TypeRprtr = 'Lain';
	$Info = '';
	$exeTempTable = $REPORT->TempTable($hit,$flag,$TypeRprtr,$Info,$tglawalperolehan,$tglakhirperolehan,
	$skpd_id);

	$hit = 2;
	$flag = '';
	$TypeRprtr = 'ekstraRev';
	$Info = '';
	$exeTempTable = $REPORT->TempTable($hit,$flag,$TypeRprtr,$Info,$tglawalperolehan,$tglakhirperolehan,
	$skpd_id);

}else{
	$hit = 2;
	$flag = '';
	$TypeRprtr = 'upb';
	$Info = '';
	$exeTempTable = $REPORT->TempTable($hit,$flag,$TypeRprtr,$Info,$tglawalperolehan,$tglakhirperolehan,
	$skpd_id);
}*/
//revisi
$expld = explode('-', $tglakhirperolehan);
$golongan = array('A','B','C','D','E','F');
$status = $REPORT->status(2,$golongan,$expld[0]);
$tahunNeraca = $expld[0];
//exit();
if($status == 1){
	//no temp table
	$hit = 1;
	$flag = 'Lain';
	$TypeRprtr = 'Lain';
	$Info = '';
	$exeTempTable = $REPORT->TempTable($hit,$flag,$TypeRprtr,$Info,$tglawalperolehan,$tglakhirperolehan,
	$skpd_id);

	$hit = 2;
	$flag = '';
	$TypeRprtr = 'ekstraRev';
	$Info = '';
	$exeTempTable = $REPORT->TempTable($hit,$flag,$TypeRprtr,$Info,$tglawalperolehan,$tglakhirperolehan,
	$skpd_id);
}else{
	//temp table
	$hit = 2;
	$flag = '';
	$TypeRprtr = 'upb';
	$Info = '';
	$exeTempTable = $REPORT->TempTable($hit,$flag,$TypeRprtr,$Info,$tglawalperolehan,$tglakhirperolehan,
	$skpd_id);
}

$paramTgl = explode('-', $tglakhirperolehan);
$TAHUN_AKTIF = $paramTgl[0];
//$result = $REPORT->barangupb($skpd_id,$tglawalperolehan,$tglakhirperolehan,$TAHUN_AKTIF);	
$result = $REPORT->barangupb($skpd_id,$tglawalperolehan,$tglakhirperolehan,$tahunNeraca,$status);	
// pr($result);
// exit;	
//retrieve html
//$html=$REPORT->retrieve_html_rekap_barang_upb($result,$gambar,$skpd_id,$tglawalperolehan,$tglakhirperolehan,$TAHUN_AKTIF);
$html=$REPORT->retrieve_html_rekap_barang_upb($result,$gambar,$skpd_id,$tglawalperolehan,$tglakhirperolehan);
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
$namafile="$path/report/output/Rekapitulasi Barang upb_$waktu.pdf";
$mpdf->Output("$namafile",'F');
$namafile_web="$url_rewrite/report/output/Rekapitulasi Barang upb_$waktu.pdf";
echo "<script>window.location.href='$namafile_web';</script>";
exit;
}
else
{
	$waktu=date("d-m-y_h:i:s");
	$filename ="Rekapitulasi_Barang_upb_$waktu.xls";
	header('Content-type: application/ms-excel');
	header('Content-Disposition: attachment; filename='.$filename);
	$count = count($html);
	for ($i = 0; $i < $count; $i++) {
           echo "$html[$i]";
           
     }
}


?>
