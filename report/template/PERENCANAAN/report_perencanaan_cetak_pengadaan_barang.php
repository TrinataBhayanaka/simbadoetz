<?php
ob_start();
require_once('../../../config/config.php');
include ('../../../function/tanggal/tanggal.php');

define("_JPGRAPH_PATH", "$path/function/mpdf/jpgraph/src/"); // must define this before including mpdf.php file
$JpgUseSVGFormat = true;
define('_MPDF_URI',"$url_rewrite/function/mpdf/"); 	// must be  a relative or absolute URI - not a file system path

include "../../report_engine.php";
require_once('../../../function/mpdf/mpdf.php');

$modul = $_GET['modul'];
$mode = $_GET['mode'];
$tab = $_GET['tab'];
$tahun=$_GET['tahun'];
$skpd_id = $_GET['skpd_id'];
$tglcetak = $_GET['tglcetak'];
$tipe=$_GET['tipe_file'];
// pr($_GET);
// exit;
$data=array(
    "modul"=>$modul,
    "mode"=>$mode,
    "tahun"=>$tahun,
    "skpd_id"=>$skpd_id,
    "tab"=>$tab
);

//mendeklarasikan report_engine. FILE utama untuk reporting
$REPORT=new report_engine();

//menggunakan api untuk query berdasarkan variable yg telah dimasukan
$REPORT->set_data($data);

//mendapatkan jenis query yang digunakan
// $query=$REPORT->list_query();

//mengenerate query
// $result_query=$REPORT->retrieve_query($query);
// exit;
$rencana = $REPORT->perencanaan($skpd_id,$tahun);
// pr($REPORT->perencanaan($skpd_id,$tahun));
// pr($rencana);
// exit;
if($tglcetak != ''){
	$tanggalCetak = format_tanggal($tglcetak);	
	$thnPejabat =substr($tglcetak,0,4);
}else{
	$tglcetak = date("Y-m-d");
	$tanggalCetak = format_tanggal($tglcetak);	
	$thnPejabat =substr($tglcetak,0,4);
}

//set gambar untuk laporan
$gambar = $FILE_GAMBAR_KABUPATEN;

//retrieve html
$html=$REPORT->retrieve_html_rencana_pengadaan_barang($rencana,$gambar,$skpd_id,$thnPejabat,$tanggalCetak);
// exit;
//print html
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
$namafile="$path/report/output/Daftar_Rencana_pengadaan_$waktu.pdf";
$mpdf->Output("$namafile",'F');
$namafile_web="$url_rewrite/report/output/Daftar_Rencana_pengadaan_$waktu.pdf";
echo "<script>window.location.href='$namafile_web';</script>";
exit;
}
else
{
	
	$waktu=date("d-m-y_h:i:s");
	$filename ="Daftar_Rencana_pengadaan_$waktu.xls";
	header('Content-type: application/ms-excel');
	header('Content-Disposition: attachment; filename='.$filename);
	$count = count($html);
	
	for ($i = 0; $i < $count; $i++) {
           echo "$html[$i]";
           
     }
     
	
}


?>
