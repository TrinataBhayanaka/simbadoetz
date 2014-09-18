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
$skpd_id = $_REQUEST['skpd_id5'];
$kelompok=$_REQUEST['kelompok_id5'];
$tglawaltransfer = $_REQUEST['gdg_cdgpen1_awal'];
$tglakhirtransfer = $_REQUEST['gdg_cdgpen1_akhir'];
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
	"tglawaltransfer"=>$date_awal,
	"tglakhirtransfer"=>$date_akhir,
	"tgltransfer"=>$tgltransfer,
    "tab"=>$tab
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


//retrieve_html_bukupenerimaanbaranginventaris
$html=$REPORT->retrieve_html_bukupenerimaanbaranginventaris($result_query, $gambar);

//print html
$count = count($html);

	for ($i = 0; $i < $count; $i++) {
		 
		//echo $html[$i];     
	}
	
//exit;

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
$namafile="$path/report/output/Buku Penerimaan Barang Inventaris $waktu.pdf";
$mpdf->Output("$namafile",'F');
$namafile_web="$url_rewrite/report/output/Buku Penerimaan Barang Inventaris $waktu.pdf";
echo "<script>window.location.href='$namafile_web';</script>";
exit;



?>
