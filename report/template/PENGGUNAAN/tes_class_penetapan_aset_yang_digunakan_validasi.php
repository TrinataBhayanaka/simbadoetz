<?php
ob_start();
require_once('../../../config/config.php');

define("_JPGRAPH_PATH", "$path/function/mpdf/jpgraph/src/"); // must define this before including mpdf.php file
$JpgUseSVGFormat = true;
define('_MPDF_URI',"$url_rewrite/function/mpdf/"); 	// must be  a relative or absolute URI - not a file system path

include ('../../../function/tanggal/tanggal.php');
include "../../report_engine.php";
require_once('../../../function/mpdf/mpdf.php');

$id=$_GET['id'];

//mendeklarasikan report_engine. FILE utama untuk reporting
$REPORT=new report_engine();

//query daftar yang dipindahtangankan
$query= "SELECT PGNA.Aset_ID, A.NamaAset, A.LastSatker_ID, A.Info, A.AsalUsul, A.NomorReg,
                A.Alamat, A.NilaiPerolehan, L.KodeLokasi, L.NamaLokasi, A.Tahun, T.LuasTotal,
                B.Konstruksi, PGN.NoSKKDH, S.NamaSatker, K.Uraian, K.Kode,
                KDS.Baik, KDS.RusakRingan, KDS.RusakBerat, M.Merk
                FROM PenggunaanAset AS PGNA
                LEFT JOIN Aset AS A ON PGNA.Aset_ID=A.Aset_ID
                LEFT JOIN Lokasi AS L ON A.Lokasi_ID=L.Lokasi_ID
                LEFT JOIN Penggunaan AS PGN ON PGNA.Penggunaan_ID=PGN.Penggunaan_ID
                LEFT JOIN Satker AS S ON A.LastSatker_ID=S.Satker_ID
                LEFT JOIN Kelompok AS K ON A.Kelompok_ID=K.Kelompok_ID
                LEFT JOIN Kondisi AS KDS ON A.LastKondisi_ID=KDS.Kondisi_ID
                LEFT JOIN Tanah AS T ON A.Aset_ID=T.Aset_ID
                LEFT JOIN Bangunan AS B ON A.Aset_ID=B.Aset_ID
                LEFT JOIN Mesin AS M ON A.Aset_ID=M.Aset_ID
                WHERE PGN.FixPenggunaan=1 AND PGN.Status=1 AND PGN.Penggunaan_ID='$id'
                ORDER BY PGN.Penggunaan_ID asc limit 50";

//mengenerate query
$result_query=$REPORT->retrieve_query($query);

//set gambar untuk laporan
$gambar = $FILE_GAMBAR_KABUPATEN;

//retrieve html
$html=$REPORT->retrieve_html_penetapan_aset_yang_digunakan_tervalidasi($result_query, $gambar);

//print html
$count = count($html);
for ($i = 0; $i < $count; $i++) {
    //echo $html[$i];     
}


//cetak reporting
//$mpdf=new mPDF(); 
$REPORT->show_status_download_kib();
$mpdf=new mPDF('','','','',15,15,16,16,9,9,'L');
$mpdf->debug=true;
$mpdf->AddPage('L','','','','',15,15,16,16,9,9);
$mpdf->setFooter('{PAGENO}') ;
$mpdf->progbar_heading = '';
$mpdf->StartProgressBarOutput(2);
$mpdf->useGraphs = true;
$mpdf->list_number_suffix = ')';
$mpdf->hyphenate = true;

$count = count($html);
for ($i = 0; $i <= $count; $i++) {
     if($i==0)
          $mpdf->WriteHTML($html[$i]);
     else
     {
           $mpdf->AddPage('L','','','','',15,15,16,16,9,9);
           $mpdf->WriteHTML($html[$i]);
           
     }
}

$waktu=date("d-m-y_h-i-s");
$namafile="$path/report/output/Daftar usulan aset yang digunakan tervalidasi $waktu.pdf";
$mpdf->Output("$namafile",'F');
$namafile_web= "$url_rewrite/report/output/Daftar usulan aset yang digunakan tervalidasi $waktu.pdf";
echo "<script>window.location.href='$namafile_web';</script>";
exit;

?>

