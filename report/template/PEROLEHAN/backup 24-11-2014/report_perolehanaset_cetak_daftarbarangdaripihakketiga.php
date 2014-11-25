<?php
ob_start();
require_once('../../../config/config.php');
include ('../../../function/tanggal/tanggal.php');

define("_JPGRAPH_PATH", "$path/function/mpdf/jpgraph/src/"); // must define this before including mpdf.php file
$JpgUseSVGFormat = true;
define('_MPDF_URI',"$url_rewrite/function/mpdf/"); 	// must be  a relative or absolute URI - not a file system path

include "../../report_engine.php";
require_once('../../../function/mpdf/mpdf.php');


$modul = $_REQUEST['menuID'];
$mode = $_REQUEST['mode'];
$tab = $_REQUEST['tab'];
$tahun = $_REQUEST['tahun'];
$skpd_id = $_REQUEST['skpd_id'];
$kelompok=$_REQUEST['kelompok'];
$tglawalperolehan=$_REQUEST['cdi_rekpembmd_periode1'];
$tglakhirperolehan=$_REQUEST['cdi_rekpembmd_periode2'];

$check_peng_phk_3 = $_POST['check_phk_3'];

$REPORT=new report_engine();

if (isset($check_peng_phk_3)):
$date_awal = $REPORT->change_date($tglawalperolehan,'-','year');
$date_akhir = $REPORT->change_date($tglakhirperolehan,'-','year');
endif;

$data=array(
    "modul"=>$modul,
    "mode"=>$mode,
    "tahun"=>$tahun,
    "skpd_id"=>$skpd_id,
    "kelompok"=>$kelompok,
    "tglawalperolehan"=>$date_awal,
    "tglakhirperolehan"=>$date_akhir,
    "tab"=>$tab
);

//mendeklarasikan report_engine. FILE utama untuk reporting


//menggunakan api untuk query berdasarkan variable yg telah dimasukan
$REPORT->set_data($data);

//mendapatkan jenis query yang digunakan
$query=$REPORT->list_query($data);
// pr($query);
//mengenerate query
$result_query=$REPORT->retrieve_query($query);
// pr($result_query);
//set gambar untuk laporan
$gambar = $FILE_GAMBAR_KABUPATEN;

$html=$REPORT->retrieve_html_daftarpenerimaanbarangpihaktiga($result_query, $gambar);
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
$namafile="$path/report/output/Daftar Penerimaan Barang Dari Pihak Ketiga $waktu.pdf";
$mpdf->Output("$namafile",'F');
$namafile_web="$url_rewrite/report/output/Daftar Penerimaan Barang Dari Pihak Ketiga $waktu.pdf";
echo "<script>window.location.href='$namafile_web';</script>";
exit;

?>
