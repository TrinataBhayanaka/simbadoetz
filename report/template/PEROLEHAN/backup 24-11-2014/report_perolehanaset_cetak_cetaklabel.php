<?php
ob_start();
require_once('../../../config/config.php');
//include ('../../../function/tanggal/tanggal.php');
include "../../report_engine.php";
require_once('../../../function/mpdf/mpdf.php');


$modul = $_REQUEST['menuID'];
$mode = $_REQUEST['mode'];
$tab = $_REQUEST['tab'];
$skpd_id = $_REQUEST['kodeSatker8'];
// $kelompok=$_REQUEST['kelompok'];
$tahun = $_REQUEST['tahun_label'];
$gol = $_REQUEST['gol'];
pr($_REQUEST);
exit;
$data=array(
    "modul"=>$modul,
    "mode"=>$mode,
    "skpd_id"=>$skpd_id,
	"tahun"=>$tahun,
    "gol"=>$gol,
    "tab"=>$tab
);

//mendeklarasikan report_engine. FILE utama untuk reporting
$REPORT=new report_engine();

//menggunakan api untuk query berdasarkan variable yg telah dimasukan
$REPORT->set_data($data);

//mendapatkan jenis query yang digunakan
$query=$REPORT->list_query($data);


//buku inventaris skpd
//===========================
$query="select A.LastSatker_ID, A.NomorReg, A.NamaAset, A.Pemilik, A.SumberAset, A.NilaiPerolehan, 
A.Alamat, A.Kuantitas, A.TipeAset, A.Tahun, CC.KodeSatker, CC.NamaSatker, CC.Satker_ID, CC.KodeUnit,
D.Kode, D.Uraian, D.Satuan, B.Konstruksi, E.Baik, E.RusakRingan, E.RusakBerat, MS.Merk, MS.Model, 
MS.NoRangka, MS.NoMesin, MS.NoBPKB, MS.Material from Aset A 
left join Satker CC on A.LastSatker_ID=CC.Satker_ID 
left join Mesin MS on A.Aset_ID=MS.Aset_ID 
left outer join Bangunan B on A.Aset_ID=B.Aset_ID 
left outer join Kondisi E on E.Kondisi_ID=A.LastKondisi_ID 
left outer join Kelompok D on A.Kelompok_ID=D.Kelompok_ID 
where 1=1 order by A.LastSatker_ID, D.Kode limit 20";


//mengenerate query
$result_query=$REPORT->retrieve_query($query);
//set gambar untuk laporan
$gambar=$REPORT->getLogo('bireun', $url_rewrite);


$html=$REPORT->retrieve_html_kir($result_query, $gambar);
$count = count($html);

//echo "$query ";

/*
for ($i = 0; $i < $count; $i++) {
     
     echo $html[$i];     
}
*/
									
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
$namafile="$path/report/output/Cetak Label $waktu.pdf";
$mpdf->Output("$namafile",'F');
$namafile_web="$url_rewrite/report/output/Cetak Label $waktu.pdf";
echo "<script>window.location.href='$namafile_web';</script>";
exit;


?>