<?php
ob_start();
require_once('../../../config/config.php');

define("_JPGRAPH_PATH", "$path/function/mpdf/jpgraph/src/"); // must define this before including mpdf.php file
$JpgUseSVGFormat = true;
define('_MPDF_URI',"$url_rewrite/function/mpdf/"); 	// must be  a relative or absolute URI - not a file system path

include "../../report_engine.php";
require_once('../../../function/mpdf/mpdf.php');

$modul = $_REQUEST['menuID'];
$mode = $_REQUEST['mode'];
$tab = $_REQUEST['tab'];
$tahun=$_REQUEST['tahun_rekap_buku_induk_inventaris'];
$REPORT=new report_engine();

$data=array(
    "modul"=>$modul,
    "tahun"=>$tahun,
    "mode"=>$mode,
    "tab"=>$tab
);

$REPORT->set_data($data);

//set gambar untuk laporan
$gambar = $FILE_GAMBAR_KABUPATEN;

$result_query = $REPORT->get_report_rekap_inv_daerah($tahun);

$html=$REPORT->retrieve_html_rekapitulasi_bukuinventarisdaerah($result_query,$gambar);
$count = count($html);

	 for ($i = 0; $i < $count; $i++) {
		 
		 // echo $html[$i];     
	}
// exit;
$REPORT->show_status_download();
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
			  $mpdf->WriteHTML($html[$i]);
		 else
		 {
			   $mpdf->AddPage('L','','','','',15,15,16,16,9,9);
			   $mpdf->WriteHTML($html[$i]);
			   
		 }
	}

$waktu=date("d-m-y_h-i-s");
$namafile="$path/report/output/Rekapitulasi Buku Induk Inventaris Daerah_$waktu.pdf";
$mpdf->Output("$namafile",'F');
$namafile_web="$url_rewrite/report/output/Rekapitulasi Buku Induk Inventaris Daerah_$waktu.pdf";
echo "<script>window.location.href='$namafile_web';</script>";
exit;



?>
