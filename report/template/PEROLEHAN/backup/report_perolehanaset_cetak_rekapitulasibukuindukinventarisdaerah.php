<?php
ob_start();
require_once('../../../config/config.php');
include ('../../../function/tanggal/tanggal.php');
include "../../report_engine.php";
require_once('../../../function/mpdf/mpdf.php');

//print_r($_REQUEST);

//exit;
$modul = $_REQUEST['menuID'];
$mode = $_REQUEST['mode'];
$tab = $_REQUEST['tab'];
//$tglperolehan = $_REQUEST['tglperolehan'];

//$tahun = $_REQUEST['tahun'];
//$skpd_id = $_REQUEST['skpd_id7'];
//$kelompok=$_REQUEST['kelompok'];
//$tglawalperolehan=$_REQUEST['tanggalawal_rekap_III'];
//$tglakhirperolehan=$_REQUEST['tanggalakhir_rekap_III'];
$REPORT=new report_engine();

//$date_awal = $REPORT->change_date($tglawalperolehan,'-','year');
//$date_akhir = $REPORT->change_date($tglakhirperolehan,'-','year');

$data=array(
    "modul"=>$modul,
    "mode"=>$mode,
    //"tahun"=>$tahun,
    //"skpd_id"=>$skpd_id,
    //"kelompok"=>$kelompok,
	//"tglperolehan"=>$tglperolehan,
    //"tglawalperolehan"=>$date_awal,
    //"tglakhirperolehan"=>$date_akhir,
    "tab"=>$tab
);
//print_r($data);
//mendeklarasikan report_engine. FILE utama untuk reporting

//print_r($data);
//exit;
//menggunakan api untuk query berdasarkan variable yg telah dimasukan

$REPORT->set_data($data);

//mendapatkan jenis query yang digunakan
$query=$REPORT->list_query();
//echo $query;

//exit;

//exit;
//daftar pengadaan bmd
//===========================

/*
$query="select A.LastSatker_ID, A.NomorReg, A.NamaAset, A.Pemilik, A.SumberAset, A.Kuantitas, 
A.NilaiPerolehan, A.Alamat, A.Info, A.Tahun, CC.KodeSatker, CC.NamaSatker, CC.Satker_ID, CC.KodeUnit,
D.Kode, D.Uraian, D.Satuan, K.TglKontrak, K.NoKontrak, S.TglSP2D, S.NoSP2D from Aset A 
left join Satker CC on A.LastSatker_ID=CC.Satker_ID 
left outer join Kelompok D on A.Kelompok_ID=D.Kelompok_ID 
left outer join KontrakAset KA on KA.Aset_ID= A.Aset_ID 
left outer join Kontrak K on K.Kontrak_ID= KA.Kontrak_ID 
left outer join SP2DAset SP on SP.Aset_ID= A.Aset_ID 
left outer join SP2D S on SP.SP2D_ID= S.SP2D_ID where A.SumberAset = 'sp2d' 
and A.TglPerolehan >= '2012-01-01' and A.TglPerolehan <= '2012-12-31' 
order by A.LastSatker_ID ";
*/

/*catatan A.TglPerolehan >= '2012-01-01' and A.TglPerolehan <= '2012-12-31' mempengaruhi hasil karena termasuk parameter*/


//mengenerate query

//$result_query=$REPORT->retrieve_query($query);
//set gambar untuk laporan
$gambar=$REPORT->getLogo('bireun', $url_rewrite);

$get_satker = $REPORT->_cek_data_satker_($tahun);

/*
echo '<pre>';
print_r($get_satker);
echo '</pre>';
*/
$result_query = $REPORT->get_report_rekap_inv_daerah($get_satker, $date_awal, $date_akhir);

//var_dump($result_query);
//print_r($result_query);
//exit;
$html=$REPORT->retrieve_html_rekapitulasi_bukuinventarisdaerah($result_query, $gambar, $tglawalperolehan, $tglakhirperolehan);


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
$namafile="$path/report/output/Rekapitulasi Buku Induk Inventaris Daerah_$waktu.pdf";

$mpdf->Output("$namafile",'F');
$namafile_web="$url_rewrite/report/output/Rekapitulasi Buku Induk Inventaris Daerah_$waktu.pdf";
echo "<script>window.location.href='$namafile_web';</script>";
exit;



?>
