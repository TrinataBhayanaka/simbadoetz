<?php
ob_start();
require_once('../../../config/config.php');
include ('../../../function/tanggal/tanggal.php');
include "../../report_engine.php";
require_once('../../../function/mpdf/mpdf.php');

$modul = $_REQUEST['menuID'];
$mode = $_REQUEST['mode'];
//$kib = $_REQUEST['kib'];
$tahun = $_REQUEST['tahun'];
//$nama_satker = $_REQUEST['Satker_ID'];
//$skpd_id = $_REQUEST['skpd_id'];
$kelompok=$_REQUEST['kelompok'];
$keterangan = $_REQUEST['keterangan'];
$tab = $_REQUEST['tab'];
//$namabarang = $_REQUEST['namabarang'];

$data=array(
    "modul"=>$modul,
    "mode"=>$mode,
    //"kib"=>$kib,
    "tahun"=>$tahun,
    //"nama_satker"=>$nama_satker,
    //"skpd_id"=>$skpd_id,
    "kelompok"=>$kelompok,
	"keterangan"=>$keterangan,
    "tab"=>$tab
    //"namabarang"=>namabarang

);

//mendeklarasikan report_engine. FILE utama untuk reporting
$REPORT=new report_engine();

//menggunakan api untuk query berdasarkan variable yg telah dimasukan
$REPORT->set_data($data);

//mendapatkan jenis query yang digunakan
$query=$REPORT->list_query();

$query = "SELECT PRC.NamaAset as namabarang, A.Satuan as LuasTotal, STD.NilaiStandar as NilaiPerolehan, STD.Keterangan as keterangan, STD.Spesifikasi, S.NamaSatker as NamaSatker, S.Satker_ID as Satker_ID
FROM Aset A
LEFT OUTER JOIN Satker S ON A.LastSatker_ID = S.Satker_ID
LEFT OUTER JOIN Perencanaan PRC ON A.Kelompok_ID=PRC.Kelompok_ID
LEFT OUTER JOIN StandarHarga STD ON A.Kelompok_ID=STD.Kelompok_ID
WHERE PRC.Tahun='2011'
LIMIT 0 , 30";

//mengenerate query
$result_query=$REPORT->retrieve_query($query);

//set gambar untuk laporan
$gambar=$REPORT->getLogo('bireun', $url_rewrite);

//retrieve html
$html=$REPORT->retrieve_html_standarhargabarang($result_query, $gambar);


//print html
$count = count($html);
//echo "$query ";
for ($i = 0; $i < $count; $i++) {
     
     echo $html[$i];     
}


//cetak reporting
//$mpdf=new mPDF(); 

/*
$mpdf=new mPDF('','','','',15,15,16,16,9,9,'P');
$mpdf->AddPage('L','','','','',15,15,16,16,9,9);
$mpdf->setFooter('{PAGENO}') ;
$count = count($html);
for ($i = 0; $i < $count; $i++) {
     if($i==0)
          $mpdf->WriteHTML($html[$i]);
     else
     {
           $mpdf->AddPage('L','','','','',15,15,16,16,9,9);
           //$mpdf->AddPage();
           $mpdf->WriteHTML($html[$i]);
           
     }
}
$mpdf->Output();
exit;
*/

?>
