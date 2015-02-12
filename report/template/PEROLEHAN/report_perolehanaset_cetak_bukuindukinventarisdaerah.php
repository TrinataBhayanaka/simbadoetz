<?php
ob_start();
require_once('../../../config/config.php');
include ('../../../function/tanggal/tanggal.php');
define("_JPGRAPH_PATH", "$path/function/mpdf/jpgraph/src/"); // must define this before including mpdf.php file
$JpgUseSVGFormat = true;
define('_MPDF_URI',"$url_rewrite/function/mpdf/"); // must be a relative or absolute URI - not a file system path
include "../../report_engine.php";
require_once('../../../function/mpdf/mpdf.php');
//pr($_GET);
$modul = $_GET['menuID'];
$kelompok=$_GET['kelompok_id2'];
$mode = $_GET['mode'];
$tglawal = $_GET['tglawalperolehan'];
if($tglawal != ''){
	$tglawalperolehan = $tglawal;
}else{
	$tglawalperolehan = '0000-00-00';
}
$tglakhirperolehan = $_GET['tglakhirperolehan'];
$tglcetak = $_GET['tglcetak'];
$tab = $_GET['tab'];
$tipe	=$_GET['tipe_file'];
$bukuIndk = $_GET['bukuIndk'];
// pr($_GET);
$data=array(
"modul"=>$modul,
"kelompok"=>$kelompok,
"mode"=>$mode,
"tglawalperolehan"=>$tglawalperolehan,
"tglakhirperolehan"=>$tglakhirperolehan,
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
// pr($query);
// exit;
$hit = 2;
$flag = '';
$TypeRprtr = 'BISI';
$Info = 'BISI';
$exeTempTable = $REPORT->TempTable($hit,$flag,$TypeRprtr,$Info,$tglawalperolehan,$tglakhirperolehan,
$skpd_id);
// exit;
//mengenerate query
$result_query=$REPORT->QueryBinv($query);
$result = arrayToObject($result_query);
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
//retrieve html
$html=$REPORT->retrieve_html_bukuiindukskpd($result, $gambar,$tanggalCetak,$thnPejabat);
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
$namafile="$path/report/output/Buku Induk Inventaris Daerah $waktu.pdf";
$mpdf->Output("$namafile",'F');
$namafile_web="$url_rewrite/report/output/Buku Induk Inventaris Daerah $waktu.pdf";
echo "<script>window.location.href='$namafile_web';</script>";
exit;
}
else
{
$waktu=date("d-m-y_h:i:s");
$filename ="Buku_Induk_Inventaris_$waktu.xls";
header('Content-type: application/ms-excel');
header('Content-Disposition: attachment; filename='.$filename);
$count = count($html);
for ($i = 0; $i < $count; $i++) {
echo "$html[$i]";
}
}
?>
