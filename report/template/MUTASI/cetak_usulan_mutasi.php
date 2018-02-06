<?php

ob_start();
require_once('../../../config/config.php');

define("_JPGRAPH_PATH", "$path/function/mpdf/jpgraph/src/"); // must define this before including mpdf.php file
$JpgUseSVGFormat = true;
define('_MPDF_URI', "$url_rewrite/function/mpdf/");  // must be  a relative or absolute URI - not a file system path


include ('../../../function/tanggal/tanggal.php');
include "../../report_engine_daftar.php";
require_once('../../../function/mpdf/mpdf.php');
$id = $_GET['idusulan'];
$sk = $_GET['noUsul'];
$tglHapus = $_GET['tglHapus'];
$tipe=$_GET['tipe_file'];
//mendeklarasikan report_engine. FILE utama untuk reporting
// echo "taiiaaa";
// exit;


$REPORT_DAFTAR = new report_engine_daftar();
// pr($_GET);


if($tglHapus != ''){
	$tanggalCetak = format_tanggal($tglHapus);	
}else{
	$tglcetak = date("Y-m-d");
	$tanggalCetak = format_tanggal($tglcetak);	
}
$gambar = $FILE_GAMBAR_KABUPATEN;
// pr($gambar);
// exit;
$TitleSk="USULAN MUTASI";
$data = $RETRIEVE_REPORT->daftar_barang_berdasarkan_usulan_mutasi($id);
// pr($data);
// exit;
$html=$REPORT_DAFTAR->retrieve_daftar_usulan_mutasi($data, $gambar, $sk,$tanggalCetak,$TitleSk,$tipe);
// pr($html);
// exit;
if($tipe!="2"){
$REPORT_DAFTAR->show_status_download_kib();
$mpdf=new mPDF('','','','',15,15,16,16,9,9,'L');
$mpdf->AddPage('L','','','','',15,15,16,16,9,9);
$mpdf->setFooter('{PAGENO}') ;
$mpdf->progbar_heading = '';
$mpdf->StartProgressBarOutput(2);
$mpdf->useGraphs = true;
$mpdf->list_number_suffix = ')';
$mpdf->hyphenate = true;
$mpdf->debug = true;
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
$namafile="$path/report/output/usulan_sk_mutasi_barang_$waktu.pdf";
$mpdf->Output("$namafile",'F');
$namafile_web="$url_rewrite/report/output/usulan_sk_mutasi_barang_$waktu.pdf";
echo "<script>window.location.href='$namafile_web';</script>";
exit;
}
else
{
	
	$waktu=date("d-m-y_h:i:s");
	$filename ="usulan_sk_mutasi_barang_$waktu.xls";
	header('Content-type: application/ms-excel');
	header('Content-Disposition: attachment; filename='.$filename);
	$count = count($html);
	for ($i = 0; $i < $count; $i++) {
           echo "$html[$i]";
           
     }
}
?>
