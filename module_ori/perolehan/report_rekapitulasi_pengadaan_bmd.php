<?php
ob_start();
require_once('../../config/config.php');
include ('../../function/tanggal/tanggal.php');
include "../report_engine.php";
require_once('../../function/mpdf/mpdf.php');

$modul = $_REQUEST['menuID'];
$mode = $_REQUEST['mode'];
$rekapitulasi_pengadaan_bmd = $_REQUEST['rekapitulasi_pengadaan_bmd'];
$tahun = $_REQUEST['tahun'];
$tanggal_perolehan = $_REQUEST['tanggal_perolehan'];
$nama_satker = $_REQUEST['Satker_ID'];
$skpd_id = $_REQUEST['skpd_id'];
$tanggal_cetak_report = $_REQUEST['tanggal_cetak_report'];
$tab = $_REQUEST['tab'];


$data=array(
    "modul"=>$modul,
    "mode"=>$mode,
    "rekapitulasi_pengadaan_bmd"=>$rekapitulasi_pengadaan_bmd,
    "tahun"=>$tahun,
	"tanggal_perolehan"=>$tanggal_perolehan,
    "nama_satker"=>$nama_satker,
    "skpd_id"=>$skpd_id,
    "tab"=>$tab
);

//mendeklarasikan report_engine. FILE utama untuk reporting
$REPORT=new report_engine();

//menggunakan api untuk query berdasarkan variable yg telah dimasukan
$REPORT->set_data($data);

//mendapatkan jenis query yang digunakan
$query=$REPORT->list_query();

//mengenerate query
$result_query=$REPORT->retrieve_query($query);

//set gambar untuk laporan
$gambar=$REPORT->getLogo('bireun', $url_rewrite);

//retrieve html
$html=$REPORT->retrieve_html_rekapitulasi_pengadaan_bmd($result_query, $gambar);


//print html
$count = count($html);
//echo "$query=$query<br/>Count ==$count";
for ($i = 0; $i < $count; $i++) {
     
     echo $html[$i];     
}


//cetak reporting
$mpdf=new mPDF(); 
$count = count($html);
for ($i = 0; $i < $count; $i++) {
     if($i==0)
          $mpdf->WriteHTML($html[$i]);
     else
     {
           $mpdf->WriteHTML($html[$i]);
           $mpdf->AddPage();
     }
}
$mpdf->Output();
exit;

?>
