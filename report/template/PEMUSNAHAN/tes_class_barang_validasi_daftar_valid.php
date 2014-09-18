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

//query daftar yag akan diMUSNAHKAN
$query="SELECT BAPA.Aset_ID, BAP.NoBAPemusnahan, A.NamaAset, A.LastSatker_ID, A.Info, A.AsalUsul, A.Alamat, L.KodeLokasi,
                L.NamaLokasi, A.Tahun, T.LuasTotal, B.Konstruksi,A.NomorReg,
                S.NamaSatker, K.Uraian, K.Kode, KDS.Baik, KDS.RusakRingan, KDS.RusakBerat
                FROM BAPemusnahanAset AS BAPA
                LEFT JOIN BAPemusnahan AS BAP ON BAP.BAPemusnahan_ID=BAPA.BAPemusnahan_ID
                LEFT JOIN Aset AS A ON A.Aset_ID=BAPA.Aset_ID
                LEFT JOIN Lokasi AS L ON A.Lokasi_ID=L.Lokasi_ID
                LEFT JOIN Satker AS S ON A.LastSatker_ID=S.Satker_ID
                LEFT JOIN Kelompok AS K ON A.Kelompok_ID=K.Kelompok_ID
                LEFT JOIN Kondisi AS KDS ON A.LastKondisi_ID=KDS.Kondisi_ID
                LEFT JOIN Tanah AS T ON A.Aset_ID=T.Aset_ID
                LEFT JOIN Bangunan AS B ON A.Aset_ID=B.Aset_ID
                WHERE BAP.FixPemusnahan=1 AND BAP.Status=1 AND
                BAP.BAPemusnahan_ID='$id'";
//mengenerate query
$result_query=$REPORT->retrieve_query($query);

//set gambar untuk laporan
$gambar = $FILE_GAMBAR_KABUPATEN;

//retrieve html
$html=$REPORT->retrieve_html_barang_validasi_daftar_valid($result_query, $gambar);

//print html
$count = count($html);
    
for ($i = 0; $i < $count; $i++) {
        //echo $html[$i];     
    }

//cetak reporting
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
           $mpdf->AddPage('L','','','','',15,15,16,16,9,9);//$mpdf->AddPage();
           $mpdf->WriteHTML($html[$i]);
           
     }
}

$waktu=date("d-m-y_h-i-s");
$namafile="$path/report/output/Daftar penetapan pemusnahan aset tervalidasi $waktu.pdf";
$mpdf->Output("$namafile",'F');
$namafile_web= "$url_rewrite/report/output/Daftar penetapan pemusnahan aset tervalidasi $waktu.pdf";
echo "<script>window.location.href='$namafile_web';</script>";
exit;
?>

