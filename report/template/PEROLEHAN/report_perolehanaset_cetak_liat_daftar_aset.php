<?php

ob_start();
require_once('../../../config/config.php');
include ('../../../function/tanggal/tanggal.php');

define("_JPGRAPH_PATH", "$path/function/mpdf/jpgraph/src/"); // must define this before including mpdf.php file
$JpgUseSVGFormat = true;
define('_MPDF_URI',"$url_rewrite/function/mpdf/"); 	// must be  a relative or absolute URI - not a file system path

include "../../report_engine.php";
require_once('../../../function/mpdf/mpdf.php');
// pr($_GET);
$tahun = $_GET['tahun'];
$jenisaset = $_GET['jenisaset'];
$kodeSatker = $_GET['kodeSatker'];
$kodepemilik = $_GET['kodepemilik'];
$kodeKelompok= $_GET['kodeKelompok'];
$statusaset=$_GET['statusaset'];

$REPORT=new report_engine();

$gambar = $FILE_GAMBAR_KABUPATEN;
$sWhere = "";

if ($tahun != "") {
     if ($sWhere != "")
          $sWhere.=" and tahun ='$tahun' ";
     else
          $sWhere = "Where tahun ='$tahun' ";
     
}
if ($jenisaset != "") {
     if ($sWhere != "")
          $sWhere.=" and TipeAset='$jenisaset' ";
     else
          $sWhere = "Where TipeAset='$jenisaset'  ";
}

if ($kodeSatker != "") {
     if ($sWhere != "")
          $sWhere.=" and kodeSatker like '%$kodeSatker%' ";
     else
          $sWhere = "Where kodeSatker like '%$kodeSatker%' ";
}
if ($kodeKelompok != "") {
     if ($sWhere != "")
          $sWhere.=" and kodeKelompok like '%$kodeKelompok%' ";
     else
          $sWhere = "Where kodeKelompok like '%$kodeKelompok%' ";
}

if($statusaset!=""){
  switch ($statusaset) {
    case "1":
      // code... 
      //masuk neraca  StatusValidasi=1 dan Status_Validasi_Barang=1
      $aset_status= " (StatusValidasi=1 and Status_Validasi_Barang=1)";
      break;
    case "0":
      // code...
      //baru masuk kontrak atau inventarisasi  StatusValidasi=1 dan Status_Validasi_Barang=0
      $aset_status= " (StatusValidasi=1 and Status_Validasi_Barang=0)";
      break;
    case "27":
      // code...
      //baru masuk kontrak atau inventarisasi  StatusValidasi=0 dan Status_Validasi_Barang=0;
      $aset_status= " (StatusValidasi=0 and Status_Validasi_Barang=0)";
      break;
    case "13":
      // code...
      //baru masuk kontrak atau inventarisasi  StatusValidasi not in (0,1) dan Status_Validasi_Barang not in (0,1)
      $aset_status= " (StatusValidasi not in(0,1) or Status_Validasi_Barang not in(0,1)";
      break;
    
   }
   if ($sWhere != "")
          $sWhere.=" and $aset_status ";
     else
          $sWhere = "Where $aset_status ";
}

$expld = explode(',',$jns_aset);
$count = count($expld);
$add ='0';

for ($i = 0; $i < $count; $i++){
	
	if($jns_aset != ''){
		$query_kodekelompok= "kodeKelompok  like '".$add.$expld[$i]."%' ";
	}else{
		$query_kodekelompok= "";
	}
	
	$query = "SELECT noKontrak,noRegister,kodeKelompok,kodeSatker,Info,TglPerolehan,TglPembukuan,Tahun,NilaiPerolehan,Status_Validasi_Barang 
			  from aset $sWhere order by kodeKelompok,noRegister asc";
    	
	$exe = mysql_query($query);
	while ($data = mysql_fetch_object($exe))
	{
		$dataArr[] = $data;
	}
		
}
// pr($dataArr);
// exit;
//mendeklarasikan report_engine. FILE utama untuk reporting
// pr($gambar);
$html=$REPORT->retrieve_html_liat_dftr_aset($dataArr,$kodeSatker,$gambar,$tipe);

/*$count = count($html);
for ($i = 0; $i < $count; $i++) {
		 echo $html[$i];     
	}
exit;*/
if($tipe==1){
$REPORT->show_status_download_kib();
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
			{ 
			$mpdf->WriteHTML($html[$i]);
			}
		 else
		 {
			   $mpdf->AddPage('L','','','','',15,15,16,16,9,9);
			   $mpdf->WriteHTML($html[$i]);
			   
		 }
	}

$waktu=date("d-m-y_h-i-s");
$namafile="$path/report/output/Daftar Aset $waktu.pdf";
$mpdf->Output("$namafile",'F');
$namafile_web="$url_rewrite/report/output/Daftar Aset $waktu.pdf";
echo "<script>window.location.href='$namafile_web';</script>";
exit;	
}
else
{
	
	$waktu=date("d-m-y_h:i:s");
	$filename ="Daftar_Aset_$waktu.xls";
	header('Content-type: application/ms-excel');
	header('Content-Disposition: attachment; filename='.$filename);
	$count = count($html);
	for ($i = 0; $i < $count; $i++) {
           echo "$html[$i]";
           
     }
	
}

?>