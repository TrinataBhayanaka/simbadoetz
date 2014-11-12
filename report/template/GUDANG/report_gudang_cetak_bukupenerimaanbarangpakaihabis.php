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

$skpd_id = $_REQUEST['skpd_id6'];
$tahun = $_REQUEST['tahun'];
$kelompok=$_REQUEST['kelompok_id6'];
$tglawaltransfer = $_REQUEST['gdg_cdgpenph_tglawal'];
$tglakhirtransfer = $_REQUEST['gdg_cdgpenphakhir'];
$tgltransfer = $_REQUEST['tgltransfer'];
$REPORT=new report_engine();

if (($tglawaltransfer!='') and ($tglakhirtransfer !=''))
{

$date_awal = $REPORT->change_date($tglawaltransfer,'-','year');
$date_akhir = $REPORT->change_date($tglakhirtransfer,'-','year');
}

$data=array(
    "modul"=>$modul,
    "mode"=>$mode,
    "tahun"=>$tahun,
    "skpd_id"=>$skpd_id,
    "kelompok"=>$kelompok,
    "tab"=>$tab,
	"tglawaltransfer"=>$date_awal,
	"tglakhirtransfer"=>$date_akhir,
	"tgltransfer"=>$tgltransfer
);

//mendeklarasikan report_engine. FILE utama untuk reporting


//menggunakan api untuk query berdasarkan variable yg telah dimasukan (optional) jika tidak menggunakan parameter
$REPORT->set_data($data);

//mendapatkan jenis query yang digunakan (optional) jika tidak menggunakan parameter
$query=$REPORT->list_query();

//mengenerate query
$result_query=$REPORT->retrieve_query($query);

//set gambar untuk laporan
$gambar = $FILE_GAMBAR_KABUPATEN;

//retrieve_html_bukupenerimaanbarangpakaihabis
$html=$REPORT->retrieve_html_bukupenerimaanbarangpakaihabis($result_query, $gambar);

//print html
$count = count($html);

	for ($i = 0; $i < $count; $i++) {
		 
		//echo $html[$i];     
	}


//cetak reporting
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
for ($i = 0; $i <= $count; $i++) {
     if($i==0)
          $mpdf->WriteHTML($html[$i]);
     else
     {
           $mpdf->AddPage('L','','','','',15,15,16,16,9,9);
           $mpdf->WriteHTML($html[$i]);
           
     }
}

$waktu=date("d-m-y_h-i-s");
$namafile="$path/report/output/Buku Penerimaan Barang Pakai Habis $waktu.pdf";
$mpdf->Output("$namafile",'F');
$namafile_web="$url_rewrite/report/output/Buku Penerimaan Barang Pakai Habis $waktu.pdf";
echo "<script>window.location.href='$namafile_web';</script>";
exit;





?>
