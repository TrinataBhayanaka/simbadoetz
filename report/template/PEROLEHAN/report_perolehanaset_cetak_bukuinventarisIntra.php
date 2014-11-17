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
$tahun=$_REQUEST['ThnbukuIntra'];
$skpd_id = $_REQUEST['kodeSatker5'];
$REPORT=new report_engine();

$data=array(
    "modul"=>$modul,
	"tahun"=>$tahun,
    "skpd_id"=>$skpd_id,
    "mode"=>$mode,
    "tab"=>$tab
);

function arrayToObject($result_query) {
	if (!is_array($result_query)) {
		return $result_query;
	}
	
	$object = new stdClass();
	if (is_array($result_query) && count($result_query) > 0) {
		foreach ($result_query as $name=>$value) {
			// $name = strtolower(trim($name));
			// if (!empty($name)) {
				$object->$name = arrayToObject($value);
			// }
		}
		return $object;
	}
	else {
		return FALSE;
	}
}

//mendeklarasikan report_engine. FILE utama untuk reporting
$REPORT=new report_engine();

//menggunakan api untuk query berdasarkan variable yg telah dimasukan
$REPORT->set_data($data);

//mendapatkan jenis query yang digunakan
$query=$REPORT->list_query($data);
// pr($query);
// exit;

//set gambar untuk laporan
$gambar = $FILE_GAMBAR_KABUPATEN;

$result_query=$REPORT->QueryBinv($query);
// pr($result_query);
// exit;
$result = arrayToObject($result_query);


$html=$REPORT->retrieve_html_bukuinventaris_intra($result,$gambar);
/*$count = count($html);

	 for ($i = 0; $i < $count; $i++) {
		 
		 // echo $html[$i];     
	}
// exit;*/
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
