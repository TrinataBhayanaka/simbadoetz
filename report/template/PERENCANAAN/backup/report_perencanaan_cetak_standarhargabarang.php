<?php
ob_start();
require_once('../../../config/config.php');
include ('../../../function/tanggal/tanggal.php');
include "../../report_engine.php";
require_once('../../../function/mpdf/mpdf.php');

$modul = $_REQUEST['menuID'];
$mode = $_REQUEST['mode'];
$tab = $_REQUEST['tab'];
$kelompok=$_REQUEST['kelompok_id1'];
$tgl_update = $_REQUEST['tahun_1'];

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
//exit;
/*$query ="select STD.Spesifikasi,STD.NilaiStandar,STD.Keterangan,STD.TglUpdate,K.Kelompok_ID,K.Uraian from StandarHarga as STD 
left outer join Kelompok as K on STD.Kelompok_ID=K.Kelompok_ID  
where STD.StatusPemeliharaan is not null";*/
//echo $query;

//mengenerate query
$result_query=$REPORT->retrieve_query($query);

//set gambar untuk laporan
//echo $url_rewrite;
$gambar=$REPORT->getLogo('bireun', $url_rewrite);

//echo $gambar;
//retrieve html
$html=$REPORT->retrieve_html_standarhargabarang($result_query, $gambar);



//print html
$count = count($html);

//echo "$query ";

/*
for ($i = 0; $i < $count; $i++) {
     
     echo $html[$i];     
}
*/


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
$namafile="$path/report/output/Daftar Standar Harga Barang_$waktu.pdf";

$mpdf->Output("$namafile",'F');
$REPORT->show_status_download();
$namafile_web="$url_rewrite/report/output/Daftar Standar Harga Barang_$waktu.pdf";
echo "<script>window.location.href='$namafile_web';</script>";
exit;


?>
