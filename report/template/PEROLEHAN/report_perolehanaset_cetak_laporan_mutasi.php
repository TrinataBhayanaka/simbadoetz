<?php
ob_start();
require_once('../../../config/config.php');
include ('../../../function/tanggal/tanggal.php');

define("_JPGRAPH_PATH", "$path/function/mpdf/jpgraph/src/"); // must define this before including mpdf.php file
$JpgUseSVGFormat = true;
define('_MPDF_URI',"$url_rewrite/function/mpdf/"); 	// must be  a relative or absolute URI - not a file system path

include "../../report_engine.php";
require_once('../../../function/mpdf/mpdf.php');

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
$tglcetak=$_GET['tglcetak'];
// pr($_GET);
// exit;
$REPORT=new report_engine();

$data=array(
    "modul"=>$modul,
	"tglawalperolehan"=>$tglawalperolehan,
    "tglakhirperolehan"=>$tglakhirperolehan,
    "skpd_id"=>$skpd_id,
    "mode"=>$mode,
    "tab"=>$tab,
    "bukuInv"=>"bukuInv"
);

//mendeklarasikan report_engine. FILE utama untuk reporting
$REPORT=new report_engine();

//menggunakan api untuk query berdasarkan variable yg telah dimasukan
$REPORT->set_data($data);

/*$hit = 2;
$flag = '';
$TypeRprtr = 'mutasi';
$Info = 'mutasi';
$exeTempTable = $REPORT->TempTable($hit,$flag,$TypeRprtr,$Info,$tglawalperolehan,$tglakhirperolehan,$skpd_id);*/
// exit;
//mendapatkan jenis query yang digunakan
$result=$REPORT->MutasiBarangSmpl($skpd_id,$tglawalperolehan,$tglakhirperolehan);
// pr($result);
// exit;
//set gambar untuk laporan
$gambar = $FILE_GAMBAR_KABUPATEN;

if($tglcetak != ''){
	$tanggalCetak = format_tanggal($tglcetak);	
	$thnPejabat =substr($tglcetak,0,4);
}else{
	$tglcetak = date("Y-m-d");
	$tanggalCetak = format_tanggal($tglcetak);
	$thnPejabat =substr($tglcetak,0,4);	
}


// pr($result);
// exit;
$html=$REPORT->retrieve_html_laporan_mutasi($result,$skpd_id,$gambar,$tglawalperolehan,$tglakhirperolehan,$tanggalCetak,$thnPejabat);
/*$count = count($html);

	 for ($i = 0; $i < $count; $i++) {
		 
		 echo $html[$i];     
	}
exit;*/
if($tipe==1){
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
$namafile="$path/report/output/Laporan Mutasi_$waktu.pdf";
$mpdf->Output("$namafile",'F');
$namafile_web="$url_rewrite/report/output/Laporan Mutasi_$waktu.pdf";
echo "<script>window.location.href='$namafile_web';</script>";
exit;
}
else
{
	
	$waktu=date("d-m-y_h:i:s");
	$filename ="Laporan_Mutasi_$waktu.xls";
	header('Content-type: application/ms-excel');
	header('Content-Disposition: attachment; filename='.$filename);
	$count = count($html);
	for ($i = 0; $i < $count; $i++) {
           echo "$html[$i]";
           
     }
     
	
}


?>
