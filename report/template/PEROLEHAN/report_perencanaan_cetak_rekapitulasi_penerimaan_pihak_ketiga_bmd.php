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
$tahun = $_REQUEST['tahun'];
$skpd_id = $_REQUEST['skpd_id7'];
$tglawalperolehan=$_REQUEST['tanggalawal_rekap_3'];
$tglakhirperolehan=$_REQUEST['tanggalakhir_rekap_3'];
$REPORT=new report_engine();
$check_peng_bmd = $_POST['check_rkp_phk_3'];

if (isset($check_peng_bmd)):
$date_awal = $REPORT->change_date($tglawalperolehan,'-','year');
$date_akhir = $REPORT->change_date($tglakhirperolehan,'-','year');
endif;

$data=array(
    "modul"=>$modul,
    "mode"=>$mode,
    "skpd_id"=>$skpd_id,
	"tglperolehan"=>$tglperolehan,
    "tglawalperolehan"=>$date_awal,
    "tglakhirperolehan"=>$date_akhir,
    "tab"=>$tab
);

$REPORT->set_data($data);

//mendapatkan jenis query yang digunakan
$query=$REPORT->list_query();

//set gambar untuk laporan
$gambar = $FILE_GAMBAR_KABUPATEN;

$satker = $skpd_id;

$get_satker = $REPORT->validasi_data_satker_id($satker);

$result_query = $REPORT->get_report_rekap_penerimaan_pihak_ketiga(array('Satker_ID'=>$get_satker,'tanggal_awal'=>$date_awal,'tanggal_akhir'=>$date_akhir));

$html=$REPORT->retrieve_html_rekapitulasi_penerimaan_bmd_skpd($result_query, $gambar, $tglawalperolehan, $tglakhirperolehan);


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
$namafile="$path/report/output/Rekapitulasi Penerimaan Barang Dari Pihak Ketiga $waktu.pdf";
$mpdf->Output("$namafile",'F');
$namafile_web="$url_rewrite/report/output/Rekapitulasi Penerimaan Barang Dari Pihak Ketiga $waktu.pdf";
echo "<script>window.location.href='$namafile_web';</script>";
exit;




?>
