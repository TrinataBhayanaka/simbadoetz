<?php
ob_start();
require_once('../../../config/config.php');
include ('../../../function/tanggal/tanggal.php');
include "../report_engine.php";
require_once('../../../function/mpdf/mpdf.php');

$modul = $_REQUEST['menuID'];
$mode = $_REQUEST['mode'];
$kib = $_REQUEST['kib'];
$tahun = $_REQUEST['tahun'];
$nama_satker = $_REQUEST['Satker_ID'];
$skpd_id = $_REQUEST['skpd_id'];
$kelompok=$_REQUEST['kelompok'];
$tab = $_REQUEST['tab'];

$data=array(
    "modul"=>$modul,
    "mode"=>$mode,
    "kib"=>$kib,
    "tahun"=>$tahun,
    "nama_satker"=>$nama_satker,
    "skpd_id"=>$skpd_id,
    "kelompok"=>$kelompok,
    "tab"=>$tab
);

//mendeklarasikan report_engine. FILE utama untuk reporting
$REPORT=new report_engine();

//menggunakan api untuk query berdasarkan variable yg telah dimasukan
$REPORT->set_data($data);

//mendapatkan jenis query yang digunakan
$query=$REPORT->list_query();

$query ="SELECT A.NamaAset as namabarang, A.NomorReg as register, A.Tahun as tahun, A.Alamat as alamat, A.AsalUsul as asalusul, T.LuasTotal as LuasTotal, T.HakTanah as HakTanah, 
T.TglSertifikat as tglsertifikat, T.NoSertifikat as nosertifikat, T.Penggunaan as penggunaan, A.NilaiPerolehan as NilaiPerolehan, S.NamaSatker as NamaSatker, A.LastSatker_ID as LastSatker_ID, TR.TglTransfer as TglTransfer
FROM Aset A
LEFT OUTER JOIN Tanah T ON A.Aset_ID = T.Aset_ID
LEFT OUTER JOIN Satker S ON A.LastSatker_ID = S.Satker_ID
LEFT OUTER JOIN Transfer TR ON A.Aset_ID = TR.Aset_ID
WHERE A.Aset_ID = S.Satker_ID
ORDER BY A.LastSatker_ID ASC
LIMIT 0 , 30";


//mengenerate query
$result_query=$REPORT->retrieve_query($query);

//set gambar untuk laporan
$gambar=$REPORT->getLogo('bireun', $url_rewrite);

//retrieve html
$html=$REPORT->retrieve_html_kib_pemindahtanganan($result_query, $gambar);


//print html
$count = count($html);
//echo "$query ";
for ($i = 0; $i < $count; $i++) {
     
     echo $html[$i];     
}


//cetak reporting
//$mpdf=new mPDF(); 
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
$mpdf->Output('Daftar BMD Untuk Dipindahtangankan.pdf','D');
exit;

?>
