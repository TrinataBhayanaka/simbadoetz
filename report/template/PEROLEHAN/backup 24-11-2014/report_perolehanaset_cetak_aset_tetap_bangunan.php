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
$skpd_id = $_REQUEST['kodeSatker3'];
$tahun = $_REQUEST['tahun_bangunan'];
$tipe=$_REQUEST['tipe_file'];

// pr($_REQUEST);
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

$satker = $skpd_id;

	if ($tahun !='')
	{
		$get_satker = $REPORT->validasi_data_satker_id($satker);
		
	}
	
$paramGol = '03';
$resultParamGol = $REPORT->ceckGol($get_satker,$tahun,$paramGol);

//set gambar untuk laporan
$gambar = $FILE_GAMBAR_KABUPATEN;

//retrieve html
$html=$REPORT->retrieve_html_asetTetapGedung($resultParamGol,$gambar);

/*$count = count($html);
	for ($i = 0; $i < $count; $i++) {
		 echo $html[$i];     
	}
exit;*/
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
$namafile="$path/report/output/Daftar Aset Tetap Bangunan $waktu.pdf";
$mpdf->Output("$namafile",'F');
$namafile_web="$url_rewrite/report/output/Daftar Aset Tetap Bangunan $waktu.pdf";
echo "<script>window.location.href='$namafile_web';</script>";
exit;
?>
