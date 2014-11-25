<?php
ob_start();
require_once('../../../config/config.php');
//include ('../../../function/tanggal/tanggal.php');
include "../report_engine.php";
require_once('../../../function/mpdf/mpdf.php');


$modul = $_REQUEST['menuID'];
$mode = $_REQUEST['mode'];
$tab = $_REQUEST['tab'];

$tahun = $_REQUEST['tahun'];
$skpd_id = $_REQUEST['skpd_id'];
//$kelompok=$_REQUEST['kelompok'];
//$tgltransfer=$_REQUEST['tgltransfer'];

$data=array(
    "modul"=>$modul,
    "mode"=>$mode,
    "tahun"=>$tahun,
    "skpd_id"=>$skpd_id,
    //"kelompok"=>$kelompok,
    //"tgltransfer"=>$tgltransfer,
    "tab"=>$tab
);

//mendeklarasikan report_engine. FILE utama untuk reporting
$REPORT=new report_engine();

//menggunakan api untuk query berdasarkan variable yg telah dimasukan
$REPORT->set_data($data);

//mendapatkan jenis query yang digunakan
$query=$REPORT->list_query($data);


//DAFTAR PENERIMAN BARANG DARI PIHAK KETIGA
//===========================
/*$query="select A.LastSatker_ID, A.NomorReg, A.NamaAset, A.Pemilik, A.SumberAset, A.NilaiPerolehan, A.Alamat, A.LastSatker_ID, O.NamaSatker as NamaDonor, A.Kuantitas,A.Tahun, CC.KodeSatker, CC.NamaSatker, CC.KodeUnit, D.Kode, D.Uraian, D.Satuan, E.Baik, E.RusakRingan, E.RusakBerat, MS.Merk, MS.Model, MS.NoRangka, MS.NoMesin, MS.NoBPKB, MS.Material from Aset A left join Mesin MS on A.Aset_ID=MS.Aset_ID left outer join Satker O on A.OrigSatker_ID=O.Satker_ID left outer join Satker CC on A.LastSatker_ID=CC.Satker_ID left outer join Kelompok D on A.Kelompok_ID=D.Kelompok_ID left outer join Kondisi E on E.Kondisi_ID=A.LastKondisi_ID where
 A.SumberAset = 'hibah' order by A.LastSatker_ID limit 20";*/
//==================================================================================================


//mengenerate query
$result_query=$REPORT->retrieve_query($query);
//set gambar untuk laporan
$gambar=$REPORT->getLogo('bireun', $url_rewrite);


$html=$REPORT->retrieve_html_daftarpenerimaanbarangpihaktiga($result_query, $gambar);


$count = count($html);
//echo "$query ";


for ($i = 0; $i < $count; $i++) {
     
     echo $html[$i];     
}

//list($nip,$nama_jabatan)=$REPORT->get_jabatan('474',"3");
									
//cetak reporting
//$mpdf=new mPDF(); 

/*
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
$namafile="$path/report/output/Rekapitulasi Daftar Penerimaan Barang Dari Pihak Ketiga_$waktu.pdf";

$mpdf->Output("$namafile",'F');
$namafile_web="$url_rewrite/report/output/Rekapitulasi Daftar Penerimaan Barang Dari Pihak Ketiga_$waktu.pdf";
echo "<script>window.location.href='$namafile_web';</script>";
exit;
*/

?>
