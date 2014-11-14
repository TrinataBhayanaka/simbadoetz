<?php
ob_start();
require_once('../../../config/config.php');
//include ('../../../function/tanggal/tanggal.php');
include "../../report_engine.php";
require_once('../../../function/mpdf/mpdf.php');


$modul = $_REQUEST['menuID'];
$mode = $_REQUEST['mode'];
$tab = $_REQUEST['tab'];
$skpd_id = $_REQUEST['skpd_id'];

$kib = $_REQUEST['kib'];
$tahun = $_REQUEST['tahun'];
//$kelompok=$_REQUEST['kelompok'];
$kelompok = $_REQUEST['bidang'];


$data=array(
    "modul"=>$modul,
    "mode"=>$mode,
    "kib"=>$kib,
    "tahun"=>$tahun,
    "skpd_id"=>$skpd_id,
    "kelompok"=>$kelompok,
    "tab"=>$tab
);

//mendeklarasikan report_engine. FILE utama untuk reporting
$REPORT=new report_engine();

//menggunakan api untuk query berdasarkan variable yg telah dimasukan
$REPORT->set_data($data);

//mendapatkan jenis query yang digunakan
$query=$REPORT->list_query($data);

//echo $query;
//exit;

//kibc
//============================
/*$query="select A.Aset_ID, A.LastSatker_ID,A.Lokasi_ID,A.NomorReg, A.NamaAset,A.NilaiPerolehan, A.Info, A.Tahun,A.AsalUsul, A.Alamat, 
B.JumlahLantai, B.Beton, B.LuasLantai,B.NoIMB,B.TglIMB,B.StatusTanah,  
C.KodeSatker,  C.Satker_ID, C.KodeUnit,C.NamaSatker, 
D.Kode, D.Uraian, D.Satuan, 
E.Baik, E.RusakRingan, E.RusakBerat, 
F.LuasTotal 
from Aset A 
left outer join Bangunan B on A.Aset_ID=B.Aset_ID
left outer join Satker C on A.LastSatker_ID=C.Satker_ID
left outer join Kelompok D on A.Kelompok_ID=D.Kelompok_ID
left outer join Kondisi E on A.Aset_ID=E.Aset_ID
left outer join Tanah F on A.Aset_ID=F.Aset_ID
left outer join Tanah Z on B.Aset_ID=Z.Aset_ID
where  A.TipeAset='C'order by C.KodeSatker, C.KodeUnit, D.Kode, A.NomorReg limit 20";*/
//=============================


//mengenerate query
$result_query=$REPORT->retrieve_query($query);
//set gambar untuk laporan
$gambar=$REPORT->getLogo('bireun', $url_rewrite);


$html=$REPORT->retrieve_html_kib_c($result_query, $gambar);


$count = count($html);
//echo "$query ";


for ($i = 0; $i < $count; $i++) {
     
     //echo $html[$i];     
}

//list($nip,$nama_jabatan)=$REPORT->get_jabatan('474',"3");
									
//cetak reporting
//$mpdf=new mPDF(); 


$mpdf=new mPDF('','','','',15,15,16,16,9,9,'L');
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
$namafile="$path/report/output/Kartu Inventaris C_$waktu.pdf";

$mpdf->Output("$namafile",'F');
$REPORT->show_status_download();
$namafile_web="$url_rewrite/report/output/Kartu Inventaris C_$waktu.pdf";
echo "<script>window.location.href='$namafile_web';</script>";
exit;

?>
