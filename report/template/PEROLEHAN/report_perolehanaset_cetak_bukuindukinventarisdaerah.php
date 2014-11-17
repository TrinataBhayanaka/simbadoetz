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
$kelompok=$_GET['kelompok_id2'];
$mode = $_GET['mode'];
$tahun = $_GET['tahun_buku_induk_inventaris'];
$tab = $_GET['tab'];
$tipe	=$_GET['tipe_file'];
$bukuIndk  = $_GET['bukuIndk'];
$data=array(
    "modul"=>$modul,
    "kelompok"=>$kelompok,
    "mode"=>$mode,
    "tahun"=>$tahun,
    "tab"=>$tab,
	"bukuIndk"=>$bukuIndk
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

//mengenerate query
echo $query;
$result_query=$REPORT->QueryBinv($query);

$result = arrayToObject($result_query);
//set gambar untuk laporan
$gambar = $FILE_GAMBAR_KABUPATEN;

//retrieve html
$html=$REPORT->retrieve_html_bukuiindukskpd($result, $gambar);
/*$count = count($html);
	for ($i = 0; $i < $count; $i++) {
		 
		 echo $html[$i];     
	}
exit;*/
if($tipe!="2"){
$REPORT->show_status_download_kib();	
$mpdf=new mPDF('win-1252','','','',15,15,16,16,9,9,'L');
$mpdf->AddPage('L','','','','',15,15,16,16,9,9);
$mpdf->setFooter('{PAGENO}') ;

$mpdf->progbar_heading = '';
$mpdf->StartProgressBarOutput(2);
$mpdf->useGraphs = true;
$mpdf->list_number_suffix = ')';
$mpdf->hyphenate = true;

$mpdf->useOnlyCoreFonts = true;
$count = count($html);

for ($i = 0; $i < $count; $i++) {
//$nomor=sprintf('%010d', $i);
//$namafile="$path/report/output/Buku Induk Inventaris Daerah $waktu-$nomor.pdf";
  
     if($i==0)
          $mpdf->WriteHTML($html[$i]);
     else
     {	
	   $mpdf->AddPage('L','','','','',15,15,16,16,9,9);
           $mpdf->WriteHTML($html[$i]);
//	  $mpdf->Output("$namafile",'F');
          
           
     }
}
$waktu=date("d-m-y_h-i-s");
$namafile="$path/report/output/Buku Induk Inventaris Daerah $waktu.pdf";
$mpdf->Output("$namafile",'F');
exit;
$namafile_web="$url_rewrite/report/output/Buku Induk Inventaris Daerah $waktu.pdf";
echo "<script>window.location.href='$namafile_web';</script>";
exit;
}
else 
{
$namafile="$path/report/output/Buku Induk Inventaris Daerah.txt";
$fp = fopen("$namafile", 'w');
$count = count($html);
	for ($i = 0; $i < $count; $i++) {
           fwrite($fp,$html[$i]);
           
     }
fclose($fp);
	/*$waktu=date("d-m-y_h:i:s");
	$filename ="Buku_Induk_Inventaris_$waktu.xls";
	header('Content-type: application/ms-excel');
	header('Content-Disposition: attachment; filename='.$filename);*/
header('Content-Description: File Transfer');
header('Content-Type: application/ms-excel');
header('Content-Disposition: attachment; filename='."tes.xls");
header('Content-Transfer-Encoding: binary');
header('Expires: 0');
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
header('Pragma: public');
header('Content-Length: ' . filesize($namafile));
ob_clean();
flush();
readfile($namafile);
	/*$count = count($html);
	for ($i = 0; $i < $count; $i++) {
           echo "$html[$i]";
           
     }*/
}
?>//http://stackoverflow.com/questions/14848933/read-and-parse-contents-of-very-large-file
