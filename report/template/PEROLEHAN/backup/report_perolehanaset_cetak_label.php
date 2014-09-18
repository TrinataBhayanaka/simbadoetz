<?php
ob_start();
require_once('../../../config/config.php');
//include ('../../../function/tanggal/tanggal.php');
include "../../report_engine.php";
require_once('../../../function/mpdf/mpdf.php');


$modul = $_REQUEST['menuID'];
$mode = $_REQUEST['mode'];
$tab = $_REQUEST['tab'];
//$tglperolehan = $_REQUEST['tglperolehan'];

//$tahun = $_REQUEST['tahun'];
$skpd_id = $_REQUEST['skpd_id4'];
$kelompok=$_REQUEST['kelompok_id'];
//$tglawal=$_REQUEST['tglawal'];
//$tglakhir=$_REQUEST['tglakhir'];

$data=array(
    "modul"=>$modul,
    "mode"=>$mode,
    //"tahun"=>$tahun,
    "skpd_id"=>$skpd_id,
    "kelompok"=>$kelompok,
	//"tglperolehan"=>$tglperolehan,
    //"tglawal"=>$tglawal,
    //"tglakhir"=>$tglakhir,
    "tab"=>$tab
);
//print_r($data);
//mendeklarasikan report_engine. FILE utama untuk reporting
$REPORT=new report_engine();

//menggunakan api untuk query berdasarkan variable yg telah dimasukan
$REPORT->set_data($data);

//mendapatkan jenis query yang digunakan
$query=$REPORT->list_query();

//echo $query;

//daftar pengadaan bmd
//===========================
/*$query="
select a.NamaAset,a.NomorReg,
s.KodeSatker, s.KodeUnit, s.NamaSatker,s.Satker_ID,
k.kode
from Aset a
join Kelompok k on a.Kelompok_ID = k.Kelompok_ID
join Satker s on s.Satker_ID = a.LastSatker_ID
order by s.KodeSatker, s.KodeUnit, k.Kelompok limit 70
";*/

//echo $query;
//mengenerate query
$result_query=$REPORT->retrieve_query($query);
/*echo"<pre>";
print_r ($result_query);
echo"</pre>";*/

//set gambar untuk laporan
$gambar=$REPORT->getLogo('bireun', $url_rewrite);


$html=$REPORT->retrieve_html_cetak_label($result_query, $gambar);


$count = count($html);

/*echo '<pre>';
print_r($html);
echo '</pre>';
*/

/*
for ($i = 0; $i < $count; $i++) {
     
     echo $html[$i];     
}
*/

//list($nip,$nama_jabatan)=$REPORT->get_jabatan('474',"3");
									
//cetak reporting
//$mpdf=new mPDF(); 


$mpdf=new mPDF('','','','',15,15,16,16,9,9,'P');
$mpdf->AddPage('P','','','','',15,15,16,16,9,9);
$mpdf->setFooter('{PAGENO}') ;
$count = count($html);
for ($i = 0; $i < $count; $i++) {
     if($i==0)
			$mpdf->WriteHTML($html[$i]);
     else
     {
           $mpdf->AddPage('P','','','','',15,15,16,16,9,9);
           //$mpdf->AddPage();
           $mpdf->WriteHTML($html[$i]);
           
     }
}


$waktu=date("dymhis");
$namafile="$path/report/output/Cetak Label_$waktu.pdf";

$mpdf->Output("$namafile",'F');
$namafile_web="$url_rewrite/report/output/Cetak Label_$waktu.pdf";
echo "<script>window.location.href='$namafile_web';</script>";
exit;


?>
