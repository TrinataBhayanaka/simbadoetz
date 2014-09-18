<?php
ob_start();
require_once('../../../config/config.php');

define("_JPGRAPH_PATH", "$path/function/mpdf/jpgraph/src/"); // must define this before including mpdf.php file
$JpgUseSVGFormat = true;
define('_MPDF_URI',"$url_rewrite/function/mpdf/"); 	// must be  a relative or absolute URI - not a file system path

include ('../../../function/tanggal/tanggal.php');
include "../../report_engine.php";
require_once('../../../function/mpdf/mpdf.php');

//mendeklarasikan report_engine. FILE utama untuk reporting
$REPORT=new report_engine();

//query buat ambil aset id yang di ceklist
$query_ceklist="SELECT * FROM apl_userasetlist WHERE aset_action='UsulanPemanfaatan'";
$exec=mysql_query($query_ceklist);
while($data=mysql_fetch_array($exec)){
    $dataNew=$data['aset_list'];
}


$ambil=  substr($dataNew,0,1);
$panjang=  strlen($dataNew);
if($ambil==','){
    $dataNew=  substr($dataNew,1,$panjang);
}

//query usulan pemindahtanganan
$query= "SELECT A.LastSatker_ID, A.NamaAset, MGRA.Aset_ID, A.NomorReg, 
                KTR.NoKontrak, L.NamaLokasi, K.Kode, S.NamaSatker
                FROM MenganggurAset AS MGRA
                LEFT JOIN Aset AS A ON MGRA.Aset_ID=A.Aset_ID
                LEFT JOIN  KontrakAset AS KTRA ON MGRA.Aset_ID = KTRA.Aset_ID
                LEFT JOIN Kontrak AS KTR ON KTR.Kontrak_ID = KTRA.Kontrak_ID
                LEFT JOIN Lokasi AS L ON A.Lokasi_ID=L.Lokasi_ID
                LEFT JOIN Kelompok AS K ON A.Kelompok_ID=K.Kelompok_ID
                LEFT JOIN Satker AS S ON A.LastSatker_ID=S.Satker_ID
                WHERE MGRA.StatusUsulan=0 AND MGRA.Aset_ID IN ($dataNew)
                ORDER BY MGRA.Aset_ID asc limit 50";

//print_r($query);
//mengenerate query
$result_query=$REPORT->retrieve_query($query);

//set gambar untuk laporan
$gambar = $FILE_GAMBAR_KABUPATEN;

//retrieve html
$html=$REPORT->retrieve_html_usulan_pemanfaatan_dengan_pilihan($result_query, $gambar);

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
           $mpdf->AddPage('L','','','','',15,15,16,16,9,9);
           $mpdf->WriteHTML($html[$i]);
           
     }
}

$waktu=date("d-m-y_h:i:s");
$namafile="$path/report/output/Daftar usulan pemanfaatan cetak dari daftar anda $waktu.pdf";
$mpdf->Output("$namafile",'F');
$namafile_web= "$url_rewrite/report/output/Daftar usulan pemanfaatan cetak dari daftar anda $waktu.pdf";
echo "<script>window.location.href='$namafile_web';</script>";
exit;
?>

