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
$skpd_id = $_GET['skpd_id'];
$kb = $_GET['kb'];
$kelompok = $_GET['kelompok'];
$noregAwal = $_GET['noregAwal'];
$noregAkhir = $_GET['noregAkhir'];
/*$tglawal = $_GET['tglawalperolehan'];
if($tglawal != ''){
	$tglawalperolehan = $tglawal;
}else{
	$tglawalperolehan = '0000-00-00';
}*/
$tglakhirperolehan = $_GET['tglakhirperolehan'];
$tahun = $_GET['tahun'];
$tglcetak = $_GET['tglcetak'];
$tipe=$_GET['tipe_file'];
// pr($_GET);
// exit;
$data=array(
    "modul"=>$modul,
    "mode"=>$mode,
    "kb"=>$kb,
	"tahun"=>$tahun,
    // "tglawalperolehan"=>$tglawalperolehan,
    // "tglakhirperolehan"=>$tglakhirperolehan,
    "skpd_id"=>$skpd_id,
    "kelompok"=>$kelompok,
    "noregAwal"=>$noregAwal,
    "noregAkhir"=>$noregAkhir,
    "tab"=>$tab
);

//mendeklarasikan report_engine. FILE utama untuk reporting
$REPORT=new report_engine();

//menggunakan api untuk query berdasarkan variable yg telah dimasukan
$REPORT->set_data($data);

//mendapatkan jenis query yang digunakan
$query=$REPORT->list_query($data);
// pr($query);
// exit;
$hit = count($query);
if($kb == 'KB-D'){
	$flag = 'D';
}
$TypeRprtr = 'kartu';
$Info = '';
$exeTempTable = $REPORT->TempTable($hit,$flag,$TypeRprtr,$Info,$tglawalperolehan,$tglakhirperolehan,
$skpd_id);
// exit;
$resQuery=$REPORT->kartuBarang($query);
// pr($resQuery);
// exit;
//mengenerate query
// $result_query=$REPORT->retrieve_query($query);
// pr($result_query);
// exit;
//set gambar untuk laporan
$gambar = $FILE_GAMBAR_KABUPATEN;
// exit;
//retrieve html
$html=$REPORT->retrieve_html_kb_rev_general($resQuery,$gambar,$skpd_id,$tglakhirperolehan,$flag);
// exit;
/*$count = count($html);
	for ($i = 0; $i < $count; $i++) {
		 echo $html[$i];     
	}*/
// exit;
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
$namafile="$path/report/output/Kartu Barang D_$waktu.pdf";
$mpdf->Output("$namafile",'F');
$namafile_web="$url_rewrite/report/output/Kartu Barang D_$waktu.pdf";
echo "<script>window.location.href='$namafile_web';</script>";
exit;
}
else
{
	// echo $DATABARU;*/
	$waktu=date("d-m-y_h:i:s");
	$filename ="Kartu_Barang_D_$waktu.xls";
	header('Content-type: application/ms-excel');
	header('Content-Disposition: attachment; filename='.$filename);
	$count = count($html);
	for ($i = 0; $i < $count; $i++) {
           echo "$html[$i]";
           
     }
	
}
?>
