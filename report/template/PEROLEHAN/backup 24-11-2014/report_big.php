<?php
ob_start();
require_once('../../../config/config.php');

define("_JPGRAPH_PATH", "$path/function/mpdf/jpgraph/src/"); // must define this before including mpdf.php file
$JpgUseSVGFormat = true;
define('_MPDF_URI',"$url_rewrite/function/mpdf/"); 	// must be  a relative or absolute URI - not a file system path

include "../../report_engine.php";
require_once('../../../function/mpdf/mpdf.php');


$mpdf=new mPDF('win-1252','','','',15,15,16,16,9,9,'L');
$mpdf->AddPage('L','','','','',15,15,16,16,9,9);
$mpdf->setFooter('{PAGENO}') ;

//$mpdf->progbar_heading = '';
//$mpdf->StartProgressBarOutput(2);
//$mpdf->useGraphs = true;
$mpdf->list_number_suffix = ')';
$mpdf->hyphenate = true;

$mpdf->useOnlyCoreFonts = true;
$waktu=date("d-m-y_h-i-s");
$namafile="$path/report/output/tmp/Buku Induk Inventaris Daerah $waktu";

$handle = @fopen("/srv/www/htdocs/simbada_v3/simbadoetz/report/output/Buku_Induk_Inventaris_Daerah.txt", "r");
$no=1;
if ($handle) {
    while (($buffer = fgets($handle, 4096)) !== false) {
      //  $mpdf->WriteHTML($buffer);
        $nomor=sprintf("%5d",$no);
        $mpdf->Output("$namafile-$nomor.pdf",'F');
        $no++;
        var_dump($buffer);
       
    }
    fclose($handle);
}



 
//$mpdf->Output("$namafile",'F');
exit;
//$namafile_web="$url_rewrite/report/output/Buku Induk Inventaris Daerah $waktu.pdf";
//echo "<script>window.location.href='$namafile_web';</script>";



?>