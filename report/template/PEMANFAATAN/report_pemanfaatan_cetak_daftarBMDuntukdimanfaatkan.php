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
    "tab"=>$tab,
    
);

//mendeklarasikan report_engine. FILE utama untuk reporting
$REPORT=new report_engine();

//menggunakan api untuk query berdasarkan variable yg telah dimasukan
$REPORT->set_data($data);

//mendapatkan jenis query yang digunakan
$query=$REPORT->list_query();

$query = "select A.Aset_ID, A.Lokasi_ID,A.LastSatker_ID, A.NomorReg, A.NamaAset,A.NilaiPerolehan, A.Alamat, A.Info, A.TglPerolehan,A.Tahun,A.AsalUsul, B.LuasTotal,B.HakTanah, B.NoSertifikat, B.TglSertifikat, B.Penggunaan, C.KodeSatker,C.Satker_ID, C.KodeUnit,C.NamaSatker, D.Kode, D.Uraian, D.Satuan from Aset A left outer join Tanah B on A.Aset_ID=B.Aset_ID left outer join Satker C on A.LastSatker_ID=C.Satker_ID left outer join Kelompok D on A.Kelompok_ID=D.Kelompok_ID where A.TipeAset = 'A' ORDER BY C.KodeSatker, C.KodeUnit, D.Kode, A.NomorReg limit 20";

//mengenerate query
$result_query=$REPORT->retrieve_query($query);

//set gambar untuk laporan
$gambar=$REPORT->getLogo('bireun', $url_rewrite);

//retrieve html
$html=$REPORT->retrieve_html_kib_untukdimanfaatkan($result_query, $gambar);


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
$mpdf->Output('Daftar Barang Milik Daerah Untuk Dimanfaatkan.pdf','D');
exit;

?>
