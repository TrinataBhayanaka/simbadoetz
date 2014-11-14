<?php
ob_start();
require_once('../../../config/config.php');
include ('../../../function/tanggal/tanggal.php');
//include ('../../../function/tanggal/format_tanggal_with_explode.php');
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
$jenisbarang = $_REQUEST['jenisbarang'];
$lokasi = $_REQUEST['lokasi'];
$tgl = $_REQUEST['tgl'];

$data=array(
    "modul"=>$modul,
    "mode"=>$mode,
    "kib"=>$kib,
    "tahun"=>$tahun,
    "nama_satker"=>$nama_satker,
    "skpd_id"=>$skpd_id,
    "kelompok"=>$kelompok,
    "tab"=>$tab,
	"jenisbarang"=>$jenisbarang,
	"lokasi"=>$lokasi,
	"tgl"=>$tgl
);

//mendeklarasikan report_engine. FILE utama untuk reporting
$REPORT=new report_engine();

//menggunakan api untuk query berdasarkan variable yg telah dimasukan (optional) jika tidak menggunakan parameter
$REPORT->set_data($data);

//mendapatkan jenis query yang digunakan (optional) jika tidak menggunakan parameter
$query=$REPORT->list_query();

//query laporan pemeliharaan
$query= "select A.Aset_ID, A.LastSatker_ID, A.NomorReg, A.NamaAset, PML.JenisPemeliharaan, PML.NamaPemelihara, PML.TglPemeliharaan, PML.Biaya, KTR.NoKontrak, A.Tahun,  L.NamaLokasi, K.Kelompok, S.KodeSektor, L.KodeLokasi, PML.NoBAPemeliharaan,
PML.KeteranganPemeliharaan,
S.KodeSatker,  S.Satker_ID, S.KodeUnit,S.NamaSatker,
K.Kode, K.Uraian, K.Satuan 
from Aset A
left outer join Pemeliharaan PML on A.Aset_ID=PML.Aset_ID
left outer join Satker S on A.LastSatker_ID=S.Satker_ID
left outer join Kelompok K on A.Kelompok_ID=K.Kelompok_ID
left outer join KontrakAset KTRA on KTRA.Aset_ID=A.Aset_ID
left outer join Kontrak KTR on KTR.Kontrak_ID=KTRA.Kontrak_ID
left outer join Lokasi L on A.Lokasi_ID=L.Lokasi_ID
order by S.KodeSatker, S.KodeUnit, K.Kode, A.NomorReg limit 300";


//mengenerate query
$result_query=$REPORT->retrieve_query($query);
/*
echo "<pre>";
print_r($result_query);
echo "</pre>";
*/
//set gambar untuk laporan
$gambar=$REPORT->getLogo('bireun', $url_rewrite);


//retrieve_html_laporanpemeliharaan
$html=$REPORT->retrieve_html_laporanpemeliharaan($result_query, $gambar);


//print html

$count = count($html);
for ($i = 0; $i < $count; $i++) {
     //echo "<br/>$i";
    echo $html[$i];     
}


//cetak reporting
//$mpdf=new mPDF(); 
$mpdf=new mPDF('','','','',15,15,16,16,9,9,'L');
$mpdf->AddPage('L','','','','',15,15,16,16,9,9);
$mpdf->setFooter('{PAGENO}') ;
$count = count($html);
for ($i = 0; $i <= $count; $i++) {
     if($i==0)
          $mpdf->WriteHTML($html[$i]);
     else
     {
           $mpdf->AddPage('L','','','','',15,15,16,16,9,9);
           //$mpdf->AddPage();
           $mpdf->WriteHTML($html[$i]);
           
     }
}
$mpdf->Output('laporan pemeliharaan.pdf', 'I');
exit;




?>
