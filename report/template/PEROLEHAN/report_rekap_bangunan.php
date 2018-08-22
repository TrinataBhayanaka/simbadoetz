<?php
ob_start();
require_once('../../../config/config.php');

define("_JPGRAPH_PATH", "$path/function/mpdf/jpgraph/src/"); // must define this before including mpdf.php file
$JpgUseSVGFormat = true;
define('_MPDF_URI',"$url_rewrite/function/mpdf/"); 	// must be  a relative or absolute URI - not a file system path

include "../../report_engine.php";
require_once('../../../function/mpdf/mpdf.php');
//pr($_GET);
$modul = $_GET['menuID'];
$mode = $_GET['mode'];
$tab = $_GET['tab'];
$skpd_id = $_GET['skpd_id'];
$tglawal = $_GET['tglawalperolehan'];
if($tglawal != ''){
	$tglawalperolehan = $tglawal;
}else{
	$tglawalperolehan = '0000-00-00';
}
$tglakhirperolehan = $_GET['tglakhirperolehan'];
$tipe=$_GET['tipe_file'];
// pr($_REQUEST);
// exit;
$data=array(
    "modul"=>$modul,
    "mode"=>$mode,
	"tglawalperolehan"=>$tglawalperolehan,
    "tglakhirperolehan"=>$tglakhirperolehan,
    "skpd_id"=>$skpd_id,
    "tab"=>$tab
);

//mendeklarasikan report_engine. FILE utama untuk reporting
$REPORT=new report_engine();

//menggunakan api untuk query berdasarkan variable yg telah dimasukan
$REPORT->set_data($data);
//exit;
$satker = $skpd_id;

	if ($tglawalperolehan !='' && $tglakhirperolehan){
		$get_satker = $REPORT->validasi_data_satker_id($satker);
	}

/*
Add $TAHUN_AKTIF
*/
/*$expld = explode('-', $tglakhirperolehan);
$tglCmpr = $TAHUN_AKTIF."-"."12-31";
if($TAHUN_AKTIF == $expld[0] && $tglCmpr == $tglakhirperolehan){

}else{
	$hit = 1;
	$flag = 'C';
	$TypeRprtr = 'ATB';
	$Info = '';
	$exeTempTable = $REPORT->TempTable($hit,$flag,$TypeRprtr,$Info,$tglawalperolehan,$tglakhirperolehan,
	$skpd_id);

}*/

//revisi
$expld = explode('-', $tglakhirperolehan);
$golongan = 'C';
$status = $REPORT->status(1,$golongan,$expld[0]);
$tahunNeraca = $expld[0];
if($status == 1){
	//no temp table
}else{
	//temp table
	$hit = 1;
	$flag = 'C';
	$TypeRprtr = 'ATB';
	$Info = '';
	$exeTempTable = $REPORT->TempTable($hit,$flag,$TypeRprtr,$Info,$tglawalperolehan,$tglakhirperolehan,$skpd_id);
}
// exit;	
$paramGol = '03';
$paramTgl = explode('-', $tglakhirperolehan);
$TAHUN_AKTIF = $paramTgl[0];
//$resultParamGol = $REPORT->ceckRekap($get_satker,$tglawalperolehan,$tglakhirperolehan,$paramGol,$TAHUN_AKTIF);
$resultParamGol = $REPORT->ceckRekap($get_satker,$tglawalperolehan,$tglakhirperolehan,$paramGol,$tahunNeraca,$status);
//pr($resultParamGol);
//exit;
//$serviceJson=json_encode($resultParamGol);
//set gambar untuk laporan
$gambar = $FILE_GAMBAR_KABUPATEN;

//retrieve html
$html=$REPORT->retrieve_rekap_bangunan($resultParamGol,$gambar,$skpd_id,$tglawalperolehan,$tglakhirperolehan);
/*$count = count($html);
	for ($i = 0; $i < $count; $i++) {
		 echo $html[$i];     
	}
exit;*/

if($tipe=="3"){
	echo $serviceJson;
	exit;
}elseif($tipe!="2"){
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
$namafile="$path/report/output/Rekap Bangunan_$waktu.pdf";
$mpdf->Output("$namafile",'F');
$namafile_web="$url_rewrite/report/output/Rekap Bangunan_$waktu.pdf";
echo "<script>window.location.href='$namafile_web';</script>";
exit;
}
else
{
	$waktu=date("d-m-y_h:i:s");
	$filename ="Rekap_Bangunan_$waktu.xls";
	header('Content-type: application/ms-excel');
	header('Content-Disposition: attachment; filename='.$filename);
	$count = count($html);
	for ($i = 0; $i < $count; $i++) {
           echo "$html[$i]";
           
     }
}
?>
