<?php
ob_start();
require_once('../../../config/config.php');
include ('../../../function/tanggal/tanggal.php');

define("_JPGRAPH_PATH", "$path/function/mpdf/jpgraph/src/"); // must define this before including mpdf.php file
$JpgUseSVGFormat = true;
define('_MPDF_URI',"$url_rewrite/function/mpdf/"); 	// must be  a relative or absolute URI - not a file system path

include "../../report_engine_daftar.php";
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
$REPORT=new report_engine_daftar();

$data=array(
    "modul"=>"",
	"tglawalperolehan"=>$tglawalperolehan,
    "tglakhirperolehan"=>$tglakhirperolehan,
    "skpd_id"=>$skpd_id,
    "mode"=>$mode,
    "tab"=>$tab,
    "bukuInv"=>"bukuInv"
);
//pr($data);

$REPORT_RETRIEVE=new RETRIEVE_REPORT();

//pengadaan kontrak aset non kapitalisasi
$data_non_kapitalisasi=$REPORT_RETRIEVE->daftar_pengadaan_berdasarkan_skpd($skpd_id,$tglawalperolehan,$tglakhirperolehan);
//pr($data_non_kapitalisasi);

//pengadaan kontrak aset kapitalisasi
$data_kapitalisasi=$REPORT_RETRIEVE->daftar_pengadaan_kapitalisasi_berdasarkan_skpd($skpd_id,$tglawalperolehan,$tglakhirperolehan);
//pr($data_kapitalisasi);
$data =array();
if($data_non_kapitalisasi != '' && $data_kapitalisasi != ''){
	$data = array_merge($data_non_kapitalisasi,$data_kapitalisasi);
}elseif($data_non_kapitalisasi != '' && $data_kapitalisasi == ''){
	$data = $data_non_kapitalisasi;
}elseif($data_non_kapitalisasi == '' && $data_kapitalisasi != ''){
	$data = $data_kapitalisasi;
}elseif($data_non_kapitalisasi == '' && $data_kapitalisasi == ''){
	$data ='';
}
//pr($data);
//exit;
$tglPerolehanAwal=  format_tanggal($tglawalperolehan);
$tglPerolehanAkhir=  format_tanggal($tglakhirperolehan);
$tglcetak=  format_tanggal($tglcetak);

$gambar = $FILE_GAMBAR_KABUPATEN;
$html=$REPORT->report_daftar_pengadaan($data, $gambar,$tglPerolehanAwal,$tglPerolehanAkhir,$tglcetak) ;
//pr($html);
//exit;

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
$namafile="$path/report/output/Daftar_Pengadaan_$waktu.pdf";
$mpdf->Output("$namafile",'F');
$namafile_web="$url_rewrite/report/output/Daftar_Pengadaan_$waktu.pdf";
echo "<script>window.location.href='$namafile_web';</script>";
exit;
}
else
{
	
	$waktu=date("d-m-y_h:i:s");
	$filename ="Daftar_Pengadaan_$waktu.xls";
	header('Content-type: application/ms-excel');
	header('Content-Disposition: attachment; filename='.$filename);
	$count = count($html);
	for ($i = 0; $i < $count; $i++) {
           echo "$html[$i]";
           
     }
     
	
}


?>
