<?php
ob_start();
require_once('../../../config/config.php');
include ('../../../function/tanggal/tanggal.php');
include "../../report_engine.php";
require_once('../../../function/mpdf/mpdf.php');

$modul = $_REQUEST['menuID'];
$mode = $_REQUEST['mode'];
$tab = $_REQUEST['tab'];
$kelompok=$_REQUEST['kelompok_id2'];
$tgl_update = $_REQUEST['tahun_2'];

//$namabarang = $_REQUEST['namabarang'];
//$nama_satker = $_REQUEST['Satker_ID'];
//$kib = $_REQUEST['kib'];
//$skpd_id = $_REQUEST['skpd_id'];

$data=array(
    "modul"=>$modul,
    "mode"=>$mode,
    //"kib"=>$kib,
    "tgl_update"=>$tgl_update,
    //"nama_satker"=>$nama_satker,
    "skpd_id"=>$skpd_id,
    "kelompok"=>$kelompok,
    "tab"=>$tab,
    //"namabarang"=>namabarang
);

//mendeklarasikan report_engine. FILE utama untuk reporting
$REPORT=new report_engine();

//menggunakan api untuk query berdasarkan variable yg telah dimasukan
$REPORT->set_data($data);

//mendapatkan jenis query yang digunakan
$query=$REPORT->list_query();

//echo $query;

/*$query ="select PRC.NamaAset,PRC.UraianPemeliharaan,PRC.Merk,PRC.Lokasi_ID,PRC.Kelompok_ID,
PRC.Kuantitas,STD.Pemeliharaan,PRC.KodeRekening,L.Lokasi_ID,L.NamaLokasi,
PRC.Satker_ID,PRC.Kelompok_ID,S.Satker_ID,S.NamaSatker,K.Kelompok_ID,K.Kode,K.Uraian 
from Perencanaan PRC
left outer join Satker S on PRC.Satker_ID=S.Satker_ID
left outer join Kelompok K on PRC.Kelompok_ID=K.Kelompok_ID
join StandarHarga STD on PRC.Kelompok_ID=STD.Kelompok_ID
left outer join Lokasi L on PRC.Lokasi_ID=L.Lokasi_ID
where PRC.StatusPemeliharaan is not nulll";*/


//mengenerate query
$result_query=$REPORT->retrieve_query($query);

//set gambar untuk laporan
$gambar=$REPORT->getLogo('bireun', $url_rewrite);

//retrieve html
$html=$REPORT->retrieve_html_standarhargapemeliharaan($result_query, $gambar);


//print html
$count = count($html);
//echo "$query ";

/*
for ($i = 0; $i < $count; $i++) {
     
     echo $html[$i];     
}
*/
//exit;


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


$waktu=date("dymhis");
$namafile="$path/report/output/Daftar Standar Harga Pemeliharaan Barang_$waktu.pdf";

$mpdf->Output("$namafile",'F');
$REPORT->show_status_download();
$namafile_web="$url_rewrite/report/output/Daftar Standar Harga Pemeliharaan Barang_$waktu.pdf";
echo "<script>window.location.href='$namafile_web';</script>";
exit;


?>
