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
$kib = $_GET['kib'];
$tglawal = $_GET['tglawalperolehan'];
if($tglawal != ''){
	$tglawalperolehan = $tglawal;
}else{
	$tglawalperolehan = '0000-00-00';
}
$tglakhirperolehan = $_GET['tglakhirperolehan'];
$tglcetak = $_GET['tglcetak'];
$tipe=$_GET['tipe_file'];
$pemilik = $_GET['pemilik'];
// pr($_GET);
// echo $tipe;
// pr($_GET);
// exit;
$data=array(
    "modul"=>$modul,
    "mode"=>$mode,
    "kib"=>$kib,
    "tglawalperolehan"=>$tglawalperolehan,
    "tglakhirperolehan"=>$tglakhirperolehan,
    "skpd_id"=>$skpd_id,
	"pemilik"=>$pemilik,
    "kelompok"=>$kelompok,
    "tab"=>$tab
);

//mendeklarasikan report_engine. FILE utama untuk reporting
$REPORT=new report_engine();

//menggunakan api untuk query berdasarkan variable yg telah dimasukan
$REPORT->set_data($data);

//mendapatkan jenis query yang digunakan
$query=$REPORT->list_query($data);

$hit = count($query);
$flag = 'A';
$TypeRprtr = '';
$Info = '';
$exeTempTable = $REPORT->TempTable($hit,$flag,$TypeRprtr,$Info,$tglawalperolehan,$tglakhirperolehan,
$skpd_id);
// exit;
//mengenerate query
$result_query=$REPORT->retrieve_query($query);
// pr($result_query);
// exit;
//set gambar untuk laporan
$gambar = $FILE_GAMBAR_KABUPATEN;
// pr($gambar);
// exit;
//retrieve html
if($tglcetak != ''){
	$tanggalCetak = format_tanggal($tglcetak);	
	$thnPejabat =substr($tglcetak,0,4);
}else{
	$tglcetak = date("Y-m-d");
	$tanggalCetak = format_tanggal($tglcetak);	
	$thnPejabat =substr($tglcetak,0,4);
}

$html=$REPORT->retrieve_html_kib_a($result_query,$gambar,$tanggalCetak,$thnPejabat,$tipe);

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
$namafile="$path/report/output/Kartu Inventaris Barang A $waktu.pdf";
$mpdf->Output("$namafile",'F');
$namafile_web="$url_rewrite/report/output/Kartu Inventaris Barang A $waktu.pdf";
echo "<script>window.location.href='$namafile_web';</script>";
exit;
	/*ob_clean();
	$waktu=date("d-m-y_h-i-s");
	$filename ="Kartu_Inventaris_Barang_A_$waktu.html";
	// $filename ="$path/report/output/Kartu_Inventaris_Barang_A_$waktu.html";
	// $filename="$url_rewrite/report/output/Kartu_Inventaris_Barang_A_$waktu.html";
	$count = count($html);
	$DATABARU = "";
		for ($i = 0; $i < $count; $i++) {
			   $DATABARU .= "$html[$i]";
		}
    $a = fopen($filename, 'w');
	fwrite($a, $DATABARU);
	fclose($a);
	header("Content-Type: application/pdf");
	header("Content-Disposition: attachment; filename=".$filename);
	flush();
	# Run HTMLDOC to provide the PDF file to the user...
	passthru("htmldoc -t pdf --quiet --jpeg --webpage --landscape −−no−strict '$filename'");
	
	// $namafile_web="$url_rewrite/report/output/Kartu_Inventaris_Barang_A_$waktu.html";
	// $namafile_web="$url_rewrite/report/template/PEROLEHAN/Kartu_Inventaris_Barang_A_$waktu.html";
	// echo "<script>window.location.href='$namafile_web';</script>";
	exit;*/
}
else
{
	/*ob_clean();
	$waktu=date("d-m-y_h-i-s");
	$filename ="Kartu_Inventaris_Barang_A_$waktu.xls";
	// header('Content-type: application/ms-excel');
	// header('Content-Disposition: attachment; filename='.$filename);
	$count = count($html);
	$DATABARU = "";
	for ($i = 0; $i < $count; $i++) {
           $DATABARU .= "$html[$i]";
           // $DATABARU .= "test aja";
           
     }
    
	$a = fopen($filename, 'w');
	fwrite($a, $DATABARU);
	fclose($a);
	
	echo "<script>window.location.href='$url_rewrite/report/template/PEROLEHAN/$filename';</script>";
	exit;
	// echo $DATABARU;*/
	$waktu=date("d-m-y_h:i:s");
	$filename ="Kartu_Inventaris_Barang_A_$waktu.xls";
	header('Content-type: application/ms-excel');
	header('Content-Disposition: attachment; filename='.$filename);
	$count = count($html);
	for ($i = 0; $i < $count; $i++) {
           echo "$html[$i]";
           
     }
	
}
?>
