<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
#This code provided by:
#Andreas Hadiyono (andre.hadiyono@gmail.com)
#Gunadarma University
ob_start();
require_once('../../../config/config.php');
define("_JPGRAPH_PATH", "$path/function/mpdf/jpgraph/src/"); // must define this before including mpdf.php file
$JpgUseSVGFormat = true;
define('_MPDF_URI',"$url_rewrite/function/mpdf/"); 	// must be  a relative or absolute URI - not a file system path
include "../../report_engine.php";
require ('../../../function/mpdf/mpdf.php');
$modul = $_GET['menuID'];
$mode = $_GET['mode'];
$tab = $_GET['tab'];
$tglawal = $_GET['tglawalperolehan'];
if($tglawal != ''){
	$tglawalperolehan = $tglawal;
}else{
	$tglawalperolehan = '0000-00-00';
}
$tglakhirperolehan = $_GET['tglakhirperolehan'];
$skpd_id = $_GET['skpd_id'];
$levelAset=$_GET['levelAset'];
$tipeAset=$_GET['tipeAset'];
$tipe=$_GET['tipe_file'];
//pr($_REQUEST);
//exit;
$ex = explode('-',$tglakhirperolehan);
$tahun_neraca = $ex[0];
$REPORT=new report_engine();
$data=array(
    "modul"=>$modul,
    "mode"=>$mode,
	"tglawalperolehan"=>$tglawalperolehan,
    "tglakhirperolehan"=>$tglakhirperolehan,
    "skpd_id"=>$skpd_id,
	"tab"=>$tab
);
$REPORT->set_data($data);
$nama_kab = $NAMA_KABUPATEN;
$nama_prov = $NAMA_PROVINSI;
$gambar = $FILE_GAMBAR_KABUPATEN;
if($tipe == 1){
	$gmbr = "<img style=\"width: 80px; height: 85px;\" src=\"$gambar\">";
}else{
	$gmbr ="";
}
/*
Add $TAHUN_AKTIF
*/
$expld = explode('-', $tglakhirperolehan);
$tglCmpr = $TAHUN_AKTIF."-"."12-31";
if($TAHUN_AKTIF == $expld[0] && $tglCmpr == $tglakhirperolehan){

}else{
	$hit = 2;
	$flag = '';
	$TypeRprtr = 'intra';
	$Info = '';
	$paramTgl = explode('-', $tglakhirperolehan);
	$TAHUN_AKTIF = $paramTgl[0];
	$exeTempTable = $REPORT->TempTable($hit,$flag,$TypeRprtr,$Info,$tglawalperolehan,$tglakhirperolehan,
	$skpd_id);
}

$tgldefault = "2008-01-01";
$thnDefault ="2008";

$tglAwalDefault = $tglawalperolehan;
$ceckTglAw = explode ('-',$tglAwalDefault);
$thnceck = $ceckTglAw[0];

$tglAkhirDefault = $tglakhirperolehan;
$ceckTgl = explode ('-',$tglAkhirDefault);
$thnFix = $ceckTgl[0];

$tglCmpr = $TAHUN_AKTIF."-"."12-31";
$expld = explode('-', $tglakhirperolehan);

global $tableNeracaTanah;
global $tableNeracaMesin;
global $tableNeracaBangunan;
global $tableNeracaJaringan;
global $tableNeracaAsetLain;
global $tableNeracaKdp;

if($thnFix < $thnDefault || $thnceck >= $thnDefault){
		$tableNeracaTanah 		= "tanahView";
		$tableNeracaMesin 		= 'mesin_ori';
		$tableNeracaBangunan 	= 'bangunan_ori';
		$tableNeracaJaringan 	= "jaringan_ori";
		$tableNeracaAsetLain	= "asetlain_ori";
		$tableNeracaKdp 		= "kdp_ori";
}else{
	if($TAHUN_AKTIF == $expld[0] && $tglCmpr == $tglakhirperolehan){
		$tahun = $TAHUN_AKTIF;
		$tableNeracaTanah 		= "neraca_tanah".$tahun;
		$tableNeracaMesin 		= "neraca_mesin".$tahun;
		$tableNeracaBangunan 	= "neraca_bangunan".$tahun;
		$tableNeracaJaringan 	= "neraca_jaringan".$tahun;
		$tableNeracaAsetLain 	= "neraca_asetlain".$tahun;
		$tableNeracaKdp 		= "neraca_kdp".$tahun;
	}else{
		$tableNeracaTanah 		= "tanahView";
		$tableNeracaMesin 		= 'mesin_ori';
		$tableNeracaBangunan 	= 'bangunan_ori';
		$tableNeracaJaringan 	= "jaringan_ori";
		$tableNeracaAsetLain	= "asetlain_ori";
		$tableNeracaKdp 		= "kdp_ori";
	}	
}

//start
if($tipeAset == 'all'){
	//$data = array('tanahView','mesin_ori','bangunan_ori','jaringan_ori','asetlain_ori','kdp_ori');
	$data = array($tableNeracaTanah,$tableNeracaMesin,$tableNeracaBangunan,$tableNeracaJaringan,$tableNeracaAsetLain,$tableNeracaKdp);
}elseif($tipeAset == 'tanah'){
	//$data = array('tanahView');
	$data = array($tableNeracaTanah);
}elseif($tipeAset == 'mesin'){
	//$data = array('mesin_ori');
	$data = array($tableNeracaMesin);
}elseif($tipeAset == 'bangunan'){
	//$data = array('bangunan_ori');
	$data = array($tableNeracaBangunan);
}elseif($tipeAset == 'jaringan'){
	//$data = array('jaringan_ori');
	$data = array($tableNeracaJaringan);
}elseif($tipeAset == 'asetlain'){
	//$data = array('asetlain_ori');
	$data = array($tableNeracaAsetLain);
}elseif($tipeAset == 'kdp'){
	$data = array($tableNeracaKdp);
}
$hit_loop = count($data);

//exit;
//begin 
//head satker
$detailSatker = $REPORT->get_satker($skpd_id);
// pr($detailSatker);
// exit;
$NoBidang = $detailSatker[0];
$NoUnitOrganisasi = $detailSatker[1];
$NoSubUnitOrganisasi = $detailSatker[2];
$NoUPB = $detailSatker[3];
if($NoBidang !=""){
	$paramKodeLokasi = $NoBidang;
}
if($NoBidang !="" && $NoUnitOrganisasi != ""){
	$paramKodeLokasi = $NoUnitOrganisasi;
}
if($NoBidang !="" && $NoUnitOrganisasi != "" && $NoSubUnitOrganisasi !=""){
	$paramKodeLokasi = $NoUnitOrganisasi.".".$NoSubUnitOrganisasi;
}
if($NoBidang !="" && $NoUnitOrganisasi != "" && $NoSubUnitOrganisasi !="" && $NoUPB !=""){
	$paramKodeLokasi = $NoUnitOrganisasi.".".$NoSubUnitOrganisasi.".".$NoUPB;
}
$Bidang = $detailSatker[4][0];
$UnitOrganisasi = $detailSatker[4][1];
$SubUnitOrganisasi = $detailSatker[4][2];
$UPB = $detailSatker[4][3];
   
$ex = explode('.',$skpd_id);
$hit = count($ex);
if($hit == 1){
	$header = "<tr>
          <td style=\"width: 200px; font-weight: bold; text-align: left;\">BIDANG</td>
          <td style=\"text-align: center; font-weight: bold; width: 10px;\">:</td>
          <td style=\"width: 873px; font-weight: bold;\">$Bidang</td>
        </tr>
		";
}elseif($hit == 2){
	$header = "<tr>
          <td style=\"width: 200px; font-weight: bold; text-align: left;\">BIDANG</td>
          <td style=\"text-align: center; font-weight: bold; width: 10px;\">:</td>
          <td style=\"width: 873px; font-weight: bold;\">$Bidang</td>
        </tr>
		<tr>
          <td style=\"width: 200px; font-weight: bold; text-align: left;\">UNIT ORGANISASI</td>
          <td style=\"text-align: center; font-weight: bold; width: 10px;\">:</td>
          <td style=\"width: 873px; font-weight: bold;\">$UnitOrganisasi</td>
        </tr>";
}elseif($hit == 3){
	$header = "<tr>
          <td style=\"width: 200px; font-weight: bold; text-align: left;\">BIDANG</td>
          <td style=\"text-align: center; font-weight: bold; width: 10px;\">:</td>
          <td style=\"width: 873px; font-weight: bold;\">$Bidang</td>
        </tr>
		<tr>
          <td style=\"width: 200px; font-weight: bold; text-align: left;\">UNIT ORGANISASI</td>
          <td style=\"text-align: center; font-weight: bold; width: 10px;\">:</td>
          <td style=\"width: 873px; font-weight: bold;\">$UnitOrganisasi</td>
        </tr>
		<tr>
          <td style=\"width: 200px; font-weight: bold; text-align: left;\">SUB UNIT ORGANISASI</td>
          <td style=\"text-align: center; font-weight: bold; width: 10px;\">:</td>
          <td style=\"width: 873px; font-weight: bold;\">$SubUnitOrganisasi</td>
        </tr>";
}elseif($hit == 4){
	$header = "<tr>
          <td style=\"width: 200px; font-weight: bold; text-align: left;\">BIDANG</td>
          <td style=\"text-align: center; font-weight: bold; width: 10px;\">:</td>
          <td style=\"width: 873px; font-weight: bold;\">$Bidang</td>
        </tr>
		<tr>
          <td style=\"width: 200px; font-weight: bold; text-align: left;\">UNIT ORGANISASI</td>
          <td style=\"text-align: center; font-weight: bold; width: 10px;\">:</td>
          <td style=\"width: 873px; font-weight: bold;\">$UnitOrganisasi</td>
        </tr>
		<tr>
          <td style=\"width: 200px; font-weight: bold; text-align: left;\">SUB UNIT ORGANISASI</td>
          <td style=\"text-align: center; font-weight: bold; width: 10px;\">:</td>
          <td style=\"width: 873px; font-weight: bold;\">$SubUnitOrganisasi</td>
        </tr>
		<tr>
          <td style=\"width: 200px; font-weight: bold; text-align: left;\">UPB</td>
          <td style=\"text-align: center; font-weight: bold; width: 10px;\">:</td>
          <td style=\"width: 873px; font-weight: bold;\">$UPB</td>
        </tr>";
}
// echo $head;
// exit;
$i = 0;
$head ="<head>
			  <meta content=\"text/html; charset=UTF-8\"http-equiv=\"content-type\">
			  <title></title>
			</head>
			<body>
			<table style=\"text-align: left; width: 100%;\" border=\"0\"
			 cellpadding=\"2\" cellspacing=\"2\">
			  <tbody>
				<tr>
				  <td style=\"width: 150px; text-align: LEFT;\">$gmbr</td>
				  <td style=\"width: 902px; text-align: center;\">
				  <h3>REKAPITULASI RINCIAN BARANG KE NERACA</h3>
				  <h3>TAHUN $tahun_neraca</h3>
				  </td>
				</tr>
			  </tbody>
			</table>
			<br>
			<table style=\"text-align: left; width: 100%;\" border=\"0\" cellpadding=\"2\" cellspacing=\"2\">
			  <tbody>
				<tr>
				  <td style=\"width: 200px; font-weight: bold; text-align: left;\">KABUPATEN / KOTA</td>
				  <td style=\"text-align: center; font-weight: bold; width: 10px;\">:</td>
				  <td style=\"width: 873px; font-weight: bold;\">$nama_kab </td>
				</tr>
				<tr>
				  <td style=\"width: 200px; font-weight: bold; text-align: left;\">PROVINSI</td>
				  <td style=\"text-align: center; font-weight: bold; width: 10px;\">:</td>
				  <td style=\"width: 873px; font-weight: bold;\">$nama_prov</td>
				</tr>
				$header
			  </tbody>
			</table>
				<br>";
$head.=" <table style=\"width: 100%; text-align: left; margin-left: auto; margin-right: auto; border-collapse:collapse\" border=\"1\" cellpadding=\"0\" cellspacing=\"0\; \">
	<tr>
		<td colspan='5' rowspan='2' style=\" text-align: center; font-weight: bold; width: \">Kode</td>
		<td rowspan='2' style=\" text-align: center; font-weight: bold; width: \">Uraian</td>
		<td rowspan='2' style=\" text-align: center; font-weight: bold; width: \">Jumlah</td>
		<td rowspan='2' style=\" text-align: center; font-weight: bold; width: \">Nilai Perolehan Awal</td>
		<td rowspan='2' style=\" text-align: center; font-weight: bold; width: \">Penyusutan PerTahun Awal</td>
		<td rowspan='2' style=\" text-align: center; font-weight: bold; width: \">Akumulasi Penyusutan Awal</td>
		<td rowspan='2' style=\" text-align: center; font-weight: bold; width: \">Nilai Buku Awal</td>
		<td colspan='2' style=\" text-align: center; font-weight: bold; width: \">Nilai Perolehan</td>
		<td colspan='2' style=\" text-align: center; font-weight: bold; width: \">Akumulasi Penyusutan</td>
		<td rowspan='2' style=\" text-align: center; font-weight: bold; width: \">Nilai Perolehan</td>
		<td rowspan='2' style=\" text-align: center; font-weight: bold; width: \">Penyusutan PerTahun</td>
		<td rowspan='2' style=\" text-align: center; font-weight: bold; width: \">Akumulasi Penyusutan</td>
		<td rowspan='2' style=\" text-align: center; font-weight: bold; width: \">Nilai Buku</td>
	</tr>
	<tr>
		<td  style=\" text-align: center; font-weight: bold; width: \">Mutasi Kurang</td>
		<td  style=\" text-align: center; font-weight: bold; width: \">Mutasi Tambah</td>
		<td  style=\" text-align: center; font-weight: bold; width: \">Mutasi Kurang</td>
		<td  style=\" text-align: center; font-weight: bold; width: \">Mutasi Tambah</td>
	</tr>
	<tr>
		   <td style=\" text-align: center; font-weight: bold; width: \">1</td>
		   <td style=\" text-align: center; font-weight: bold; width: \">2</td>
		   <td style=\" text-align: center; font-weight: bold; width: \">3</td>
		   <td style=\" text-align: center; font-weight: bold; width: \">4</td>
		   <td style=\" text-align: center; font-weight: bold; width: \">5</td>
		   <td style=\" text-align: center; font-weight: bold; width: \">6</td>
		   <td style=\" text-align: center; font-weight: bold; width: \">7</td>
		   <td style=\" text-align: center; font-weight: bold; width: \">8</td>
		   <td style=\" text-align: center; font-weight: bold; width: \">9</td>
		   <td style=\" text-align: center; font-weight: bold; width: \">10</td>
		   <td style=\" text-align: center; font-weight: bold; width: \">11</td>
		   <td style=\" text-align: center; font-weight: bold; width: \">12</td>
		   <td style=\" text-align: center; font-weight: bold; width: \">13</td>
		   <td style=\" text-align: center; font-weight: bold; width: \">14</td>
		   <td style=\" text-align: center; font-weight: bold; width: \">15</td>
		   <td style=\" text-align: center; font-weight: bold; width: \">16</td>
		   <td style=\" text-align: center; font-weight: bold; width: \">17</td>
		   <td style=\" text-align: center; font-weight: bold; width: \">18</td>
		   <td style=\" text-align: center; font-weight: bold; width: \">19</td>
	</tr>";	
foreach ($data as $gol) {
// $param_satker = "50.01.08.01";
$param_satker = $skpd_id;
$splitKodeSatker = explode ('.',$param_satker);
	if(count($splitKodeSatker) == 4){	
		$paramSatker = "kodeSatker = '$param_satker'";
	}else{
		$paramSatker = "kodeSatker like '$param_satker%'";
	}
// $param_tgl = "2015-01-01";
$param_tgl = $tglakhirperolehan ;
	if($gol == 'mesin_ori' || $gol == $tableNeracaMesin){
		$param_where = "Status_Validasi_barang !=77 and StatusTampil !=77 and kondisi != '3'  and 
						( (TglPerolehan < '2008-01-01' and TglPembukuan <= '$param_tgl' and kodeLokasi like '12%' and kodeKa=1) or 
						(TglPerolehan >= '2008-01-01' and TglPembukuan <= '$param_tgl'  and kodeLokasi like '12%' and (NilaiPerolehan >=300000 or kodeKa=1)))
						and $paramSatker";
	 
		$sql = "select SUBSTRING_INDEX(kodeKelompok,'.',1) as Golongan,
				sum(NilaiPerolehan)as nilai,count(Aset_ID) as jml,
				sum(PenyusutanPerTahun)as PP,sum(AkumulasiPenyusutan)as AP,sum(NilaiBuku)as NB,
				sum(NilaiPerolehan_Awal)as nilaiAwal,
				sum(PenyusutanPerTahun_Awal)as PPAwal,
				sum(AkumulasiPenyusutan_Awal)as APAwal,sum(NilaiBuku)as NBAwal,
				(select Uraian from kelompok where kode=SUBSTRING_INDEX(kodeKelompok,'.',1)) as Uraian,
				Status_Validasi_barang,kodeSatker from $gol m
				 where $param_where
				group by golongan";	

	}elseif($gol == 'bangunan_ori' || $gol == $tableNeracaBangunan){
		$param_where = "Status_Validasi_barang !=77 and StatusTampil !=77 and kondisi != '3'  and 
						( (TglPerolehan < '2008-01-01' and TglPembukuan <= '$param_tgl' and kodeLokasi like '12%' and kodeKa=1) or 
						(TglPerolehan >= '2008-01-01' and TglPembukuan <= '$param_tgl' and kodeLokasi like '12%' and (NilaiPerolehan >=10000000  or kodeKa=1)))
						and $paramSatker";
		 
		$sql = "select SUBSTRING_INDEX(kodeKelompok,'.',1) as Golongan,
				sum(NilaiPerolehan)as nilai,count(Aset_ID) as jml,
				sum(PenyusutanPerTahun)as PP,sum(AkumulasiPenyusutan)as AP,sum(NilaiBuku)as NB,
				sum(NilaiPerolehan_Awal)as nilaiAwal,
				sum(PenyusutanPerTahun_Awal)as PPAwal,
				sum(AkumulasiPenyusutan_Awal)as APAwal,sum(NilaiBuku)as NBAwal,
				(select Uraian from kelompok where kode=SUBSTRING_INDEX(kodeKelompok,'.',1)) as Uraian,
				Status_Validasi_barang,kodeSatker from $gol m
				 where $param_where
				group by golongan";	
	}else{
		if($gol!="tanahView")
		  $param_where = "Status_Validasi_barang !=77 and StatusTampil !=77 
					 and TglPerolehan <= '$param_tgl' 
					 and TglPembukuan <='$param_tgl' 
					 and kodeLokasi like '12%' 
					 and kondisi != '3'					 
					 and $paramSatker";
		else
		    $param_where = "Status_Validasi_barang !=77 and StatusTampil !=77  
					 and TglPerolehan <= '$param_tgl' 
					 and TglPembukuan <='$param_tgl' 
					 and kodeLokasi like '12%' 
					 and $paramSatker";
		 
		 if($gol == 'jaringan_ori' || $gol == $tableNeracaJaringan){
			$sql = "select SUBSTRING_INDEX(kodeKelompok,'.',1) as Golongan,
					sum(NilaiPerolehan)as nilai,count(Aset_ID) as jml,
					sum(PenyusutanPerTahun)as PP,sum(AkumulasiPenyusutan)as AP,sum(NilaiBuku)as NB,
					sum(NilaiPerolehan_Awal)as nilaiAwal,
					sum(PenyusutanPerTahun_Awal)as PPAwal,
					sum(AkumulasiPenyusutan_Awal)as APAwal,sum(NilaiBuku)as NBAwal,
					(select Uraian from kelompok where kode=SUBSTRING_INDEX(kodeKelompok,'.',1)) as Uraian,
					Status_Validasi_barang,kodeSatker from $gol m
					where $param_where
					group by golongan";
		 }else{
			/*$sql = "select SUBSTRING_INDEX(kodeKelompok,'.',1) as Golongan,
					sum(NilaiPerolehan)as nilai,count(Aset_ID) as jml,
					sum(NilaiPerolehan_Awal)as nilaiAwal,
					sum(PenyusutanPerTahun_Awal)as PPAwal,
					sum(AkumulasiPenyusutan_Awal)as APAwal,sum(NilaiBuku)as NBAwal,
					(select Uraian from kelompok where kode=SUBSTRING_INDEX(kodeKelompok,'.',1)) as Uraian,
					Status_Validasi_barang,kodeSatker from $gol m
					where $param_where
					group by golongan";*/
			$sql = "select SUBSTRING_INDEX(kodeKelompok,'.',1) as Golongan,
					sum(NilaiPerolehan)as nilai,count(Aset_ID) as jml,
					sum(PenyusutanPerTahun)as PP,sum(AkumulasiPenyusutan)as AP,sum(NilaiBuku)as NB,
					sum(NilaiPerolehan_Awal)as nilaiAwal,
					sum(PenyusutanPerTahun_Awal)as PPAwal,
					sum(AkumulasiPenyusutan_Awal)as APAwal,sum(NilaiBuku)as NBAwal,
					(select Uraian from kelompok where kode=SUBSTRING_INDEX(kodeKelompok,'.',1)) as Uraian,
					Status_Validasi_barang,kodeSatker from $gol m
					where $param_where
					group by golongan";		
		 }
	}

 /*echo "<pre>";
 echo "1";
 echo "<br/>";
 print_r($sql); 
 echo "</pre>";*/
$resultparentGol = mysql_query($sql) or die(mysql_error());
$data=array();
//golongan
     while ($data_gol = mysql_fetch_array($resultparentGol)) {
		$kode_golongan = $data_gol[Golongan];
		$ps = $param_satker;
		$pt =$param_tgl;
		$data[$i]=$data_gol;
		$paramLevelGol = $levelAset;
		if($paramLevelGol != 2){
			$data[$i]['Bidang'] = bidang($kode_golongan,$gol,$ps,$pt,$paramLevelGol,$TAHUN_AKTIF);
		}
		//head asal
		
		foreach($data as $gol)
		{	
	   if($gol[AP]==""||$gol[AP]==0)
			$gol[NB]=$gol[nilai];
			$jml_total = $jml_total + $gol[jml];
			$np_total_awal = $np_total_awal + $gol[nilaiAwal];
			$pp_total_awal = $pp_total_awal + $gol[PPAwal];
			$ap_total_awal = $ap_total_awal + $gol[APAwal];
			$nb_total_awal = $nb_total_awal + $gol[NBAwal];
			
			$np_total = $np_total + $gol[nilai];
			$pp_total = $pp_total + $gol[PP];
			$ap_total = $ap_total + $gol[AP];
			$nb_total = $nb_total + $gol[NB];
			
			$mutasi = $gol[nilai] - $gol[nilaiAwal];
			if($mutasi < 0){
				$mutasiTambah = 0;
				$mutasiKurang = abs($mutasi);
			}else{
				$mutasiTambah = abs($mutasi);
				$mutasiKurang = 0;	
			}
			$mutasiTambahTot = $mutasiTambahTot + $mutasiTambah;
			$mutasiKurangTot = $mutasiKurangTot + $mutasiKurang;

			$mutasiAP = $gol[AP] - $gol[APAwal];
			if($mutasiAP < 0){
				$mutasiTambahAP = 0;
				$mutasiKurangAP = abs($mutasiAP);
			}else{
				$mutasiTambahAP = abs($mutasiAP);
				$mutasiKurangAP = 0;	
			}
			$mutasiTambahTotAP = $mutasiTambahTotAP + $mutasiTambahAP;
			$mutasiKurangTotAP = $mutasiKurangTotAP + $mutasiKurangAP;
		$body.="<tr>
					<td style=\"font-weight: bold;\">{$gol[Golongan]}</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td style=\"font-weight: bold;\">{$gol[Uraian]}</td>
					<td style=\"text-align: center; font-weight: bold;\">{$gol[jml]}</td>
					<td style=\"font-weight: bold; text-align: right;\">".number_format($gol[nilaiAwal],2,",",".")."</td>
					<td style=\"font-weight: bold; text-align: right;\">".number_format($gol[PPAwal],2,",",".")."</td>
					<td style=\"font-weight: bold; text-align: right;\">".number_format($gol[APAwal],2,",",".")."</td>
					<td style=\"font-weight: bold; text-align: right;\">".number_format($gol[NBAwal],2,",",".")."</td>

					<td style=\"font-weight: bold; text-align: right;\">".number_format($mutasiKurang,2,",",".")."</td>
					<td style=\"font-weight: bold; text-align: right;\">".number_format($mutasiTambah,2,",",".")."</td>
					
					<td style=\"font-weight: bold; text-align: right;\">".number_format($mutasiKurangAP,2,",",".")."</td>
					<td style=\"font-weight: bold; text-align: right;\">".number_format($mutasiTambahAP,2,",",".")."</td>
					
					<td style=\"font-weight: bold; text-align: right;\">".number_format($gol[nilai],2,",",".")."</td>
					<td style=\"font-weight: bold; text-align: right;\">".number_format($gol[PP],2,",",".")."</td>
					<td style=\"font-weight: bold; text-align: right;\">".number_format($gol[AP],2,",",".")."</td>
					<td style=\"font-weight: bold; text-align: right;\">".number_format($gol[NB],2,",",".")."</td>                                         
				</tr>";	
				
			foreach($gol['Bidang'] as $bidang)
			{	
			   if($bidang[AP]==""||$bidang[AP]==0)
					$bidang[NB]=$bidang[nilai];
					/*$body.="<tr>
								<td>&nbsp;</td>
								<td style=\"font-weight: bold;\">{$bidang[Bidang]}</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td style=\"font-weight: bold;\">{$bidang[Uraian]}</td>
                                <td style=\"text-align: center; font-weight: bold;\">{$bidang[jml]}</td>
                                <td style=\"font-weight: bold; text-align: right;\">".number_format($bidang[nilai],2,",",".")."</td>
                                <td style=\"font-weight: bold; text-align: right;\">".number_format($bidang[PP],2,",",".")."</td>
                                <td style=\"font-weight: bold; text-align: right;\">".number_format($bidang[AP],2,",",".")."</td>
                                <td style=\"font-weight: bold; text-align: right;\">".number_format($bidang[NB],2,",",".")."</td>
							</tr>";*/	

					$mutasi = $bidang[nilai] - $bidang[nilaiAwal];
					if($mutasi < 0){
						$mutasiTambah = 0;
						$mutasiKurang = abs($mutasi);
					}else{
						$mutasiTambah = abs($mutasi);
						$mutasiKurang = 0;	
					}
					$mutasiAP = $bidang[AP] - $bidang[APAwal];
					if($mutasiAP < 0){
						$mutasiTambahAP = 0;
						$mutasiKurangAP = abs($mutasiAP);
					}else{
						$mutasiTambahAP = abs($mutasiAP);
						$mutasiKurangAP = 0;	
					}
					$body.="<tr>
							<td>&nbsp;</td>
							<td style=\"font-weight: bold;\">{$bidang[Bidang]}</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td style=\"font-weight: bold;\">{$bidang[Uraian]}</td>
							<td style=\"text-align: center; font-weight: bold;\">{$bidang[jml]}</td>
							<td style=\"font-weight: bold; text-align: right;\">".number_format($bidang[nilaiAwal],2,",",".")."</td>
							<td style=\"font-weight: bold; text-align: right;\">".number_format($bidang[PPAwal],2,",",".")."</td>
							<td style=\"font-weight: bold; text-align: right;\">".number_format($bidang[APAwal],2,",",".")."</td>
							<td style=\"font-weight: bold; text-align: right;\">".number_format($bidang[NBAwal],2,",",".")."</td>

							<td style=\"font-weight: bold; text-align: right;\">".number_format($mutasiKurang,2,",",".")."</td>
							<td style=\"font-weight: bold; text-align: right;\">".number_format($mutasiTambah,2,",",".")."</td>
							
							<td style=\"font-weight: bold; text-align: right;\">".number_format($mutasiKurangAP,2,",",".")."</td>
							<td style=\"font-weight: bold; text-align: right;\">".number_format($mutasiTambahAP,2,",",".")."</td>
							

							<td style=\"font-weight: bold; text-align: right;\">".number_format($bidang[nilai],2,",",".")."</td>
							<td style=\"font-weight: bold; text-align: right;\">".number_format($bidang[PP],2,",",".")."</td>
							<td style=\"font-weight: bold; text-align: right;\">".number_format($bidang[AP],2,",",".")."</td>
							<td style=\"font-weight: bold; text-align: right;\">".number_format($bidang[NB],2,",",".")."</td>                                         
						</tr>";			


				foreach($bidang['Kelompok'] as $Kelompok)
				{	
				   if($Kelompok[AP]==""||$Kelompok[AP]==0)
							$Kelompok[NB]=$Kelompok[nilai];
					/*$body.="<tr>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td>{$Kelompok[kelompok]}</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td>{$Kelompok[Uraian]}</td>
                                <td style=\"text-align: center;\">{$Kelompok[jml]}</td>
								<td style=\"text-align: right;\">".number_format($Kelompok[nilai],2,",",".")."</td>
								<td style=\"text-align: right;\">".number_format($Kelompok[PP],2,",",".")."</td>
								<td style=\"text-align: right;\">".number_format($Kelompok[AP],2,",",".")."</td>
								<td style=\"text-align: right;\">".number_format($Kelompok[NB],2,",",".")."</td>
							</tr>";*/
					$mutasi = $Kelompok[nilai] - $Kelompok[nilaiAwal];
					if($mutasi < 0){
						$mutasiTambah = 0;
						$mutasiKurang = abs($mutasi);
					}else{
						$mutasiTambah = abs($mutasi);
						$mutasiKurang = 0;	
					}

					$mutasiAP = $Kelompok[AP] - $Kelompok[APAwal];
					if($mutasiAP < 0){
						$mutasiTambahAP = 0;
						$mutasiKurangAP = abs($mutasiAP);
					}else{
						$mutasiTambahAP = abs($mutasiAP);
						$mutasiKurangAP = 0;	
					}

					$body.="<tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td style=\"font-weight: bold;\">{$Kelompok[kelompok]}</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td style=\"font-weight: bold;\">{$Kelompok[Uraian]}</td>
							<td style=\"text-align: center; font-weight: bold;\">{$Kelompok[jml]}</td>
							<td style=\"font-weight: bold; text-align: right;\">".number_format($Kelompok[nilaiAwal],2,",",".")."</td>
							<td style=\"font-weight: bold; text-align: right;\">".number_format($Kelompok[PPAwal],2,",",".")."</td>
							<td style=\"font-weight: bold; text-align: right;\">".number_format($Kelompok[APAwal],2,",",".")."</td>
							<td style=\"font-weight: bold; text-align: right;\">".number_format($Kelompok[NBAwal],2,",",".")."</td>

							<td style=\"font-weight: bold; text-align: right;\">".number_format($mutasiKurang,2,",",".")."</td>
							<td style=\"font-weight: bold; text-align: right;\">".number_format($mutasiTambah,2,",",".")."</td>
							
							<td style=\"font-weight: bold; text-align: right;\">".number_format($mutasiKurangAP,2,",",".")."</td>
							<td style=\"font-weight: bold; text-align: right;\">".number_format($mutasiTambahAP,2,",",".")."</td>
							
							<td style=\"font-weight: bold; text-align: right;\">".number_format($Kelompok[nilai],2,",",".")."</td>
							<td style=\"font-weight: bold; text-align: right;\">".number_format($Kelompok[PP],2,",",".")."</td>
							<td style=\"font-weight: bold; text-align: right;\">".number_format($Kelompok[AP],2,",",".")."</td>
							<td style=\"font-weight: bold; text-align: right;\">".number_format($Kelompok[NB],2,",",".")."</td>                                         
						</tr>";
									
					foreach($Kelompok['Sub'] as $Sub)
					{	
						if($Sub[AP]==""||$Sub[AP]==0)
							$Sub[NB]=$Sub[nilai];
							/*$body.="<tr>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>{$Sub[sub]}</td>
										<td>&nbsp;</td>
										<td>{$Sub[Uraian]}</td>
										<td style=\"text-align: center;\">{$Sub[jml]}</td>
										<td style=\"text-align: right;\">".number_format($Sub[nilai],2,",",".")."</td>
										<td style=\"text-align: right;\">".number_format($Sub[PP],2,",",".")."</td>
										<td style=\"text-align: right;\">".number_format($Sub[AP],2,",",".")."</td>
										<td style=\"text-align: right;\">".number_format($Sub[NB],2,",",".")."</td>
									</tr>";*/
							$mutasi = $Sub[nilai] - $Sub[nilaiAwal];
							if($mutasi < 0){
								$mutasiTambah = 0;
								$mutasiKurang = abs($mutasi);
							}else{
								$mutasiTambah = abs($mutasi);
								$mutasiKurang = 0;	
							}

							$mutasiAP = $Sub[AP] - $Sub[APAwal];
							if($mutasiAP < 0){
								$mutasiTambahAP = 0;
								$mutasiKurangAP = abs($mutasiAP);
							}else{
								$mutasiTambahAP = abs($mutasiAP);
								$mutasiKurangAP = 0;	
							}
							$body.="<tr>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td style=\"font-weight: bold;\">{$Sub[sub]}</td>
									<td>&nbsp;</td>
									<td style=\"font-weight: bold;\">{$Sub[Uraian]}</td>
									<td style=\"text-align: center; font-weight: bold;\">{$Sub[jml]}</td>
									<td style=\"font-weight: bold; text-align: right;\">".number_format($Sub[nilaiAwal],2,",",".")."</td>
									<td style=\"font-weight: bold; text-align: right;\">".number_format($Sub[PPAwal],2,",",".")."</td>
									<td style=\"font-weight: bold; text-align: right;\">".number_format($Sub[APAwal],2,",",".")."</td>
									<td style=\"font-weight: bold; text-align: right;\">".number_format($Sub[NBAwal],2,",",".")."</td>

									<td style=\"font-weight: bold; text-align: right;\">".number_format($mutasiKurang,2,",",".")."</td>
									<td style=\"font-weight: bold; text-align: right;\">".number_format($mutasiTambah,2,",",".")."</td>
									
									<td style=\"font-weight: bold; text-align: right;\">".number_format($mutasiKurangAP,2,",",".")."</td>
									<td style=\"font-weight: bold; text-align: right;\">".number_format($mutasiTambahAP,2,",",".")."</td>
									
									<td style=\"font-weight: bold; text-align: right;\">".number_format($Sub[nilai],2,",",".")."</td>
									<td style=\"font-weight: bold; text-align: right;\">".number_format($Sub[PP],2,",",".")."</td>
									<td style=\"font-weight: bold; text-align: right;\">".number_format($Sub[AP],2,",",".")."</td>
									<td style=\"font-weight: bold; text-align: right;\">".number_format($Sub[NB],2,",",".")."</td>                                         
								</tr>";		
						foreach($Sub['SubSub'] as $SubSub)
						{	 
							if($SubSub[AP]==""||$SubSub[AP]==0)
								$SubSub[NB]=$SubSub[nilai];
								/*$body.="<tr>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
											<td>{$SubSub[subsub]}</td>
											<td>{$SubSub[Uraian]}</td>
                                            <td style=\"text-align: center;\">{$SubSub[jml]}</td>
											<td style=\"text-align: right;\">".number_format($SubSub[nilai],2,",",".")."</td>
											<td style=\"text-align: right;\">".number_format($SubSub[PP],2,",",".")."</td>
											<td style=\"text-align: right;\">".number_format($SubSub[AP],2,",",".")."</td>
											<td style=\"text-align: right;\">".number_format($SubSub[NB],2,",",".")."</td>
										</tr>";*/
								$mutasi = $SubSub[nilai] - $SubSub[nilaiAwal];
								if($mutasi < 0){
									$mutasiTambah = 0;
									$mutasiKurang = abs($mutasi);
								}else{
									$mutasiTambah = abs($mutasi);
									$mutasiKurang = 0;	
								}
								$mutasiAP = $SubSub[AP] - $SubSub[APAwal];
								if($mutasiAP < 0){
									$mutasiTambahAP = 0;
									$mutasiKurangAP = abs($mutasiAP);
								}else{
									$mutasiTambahAP = abs($mutasiAP);
									$mutasiKurangAP = 0;	
								}
								$body.="<tr>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td style=\"font-weight: bold;\">{$SubSub[SubSub]}</td>
										<td style=\"font-weight: bold;\">{$SubSub[Uraian]}</td>
										<td style=\"text-align: center; font-weight: bold;\">{$SubSub[jml]}</td>
										<td style=\"font-weight: bold; text-align: right;\">".number_format($SubSub[nilaiAwal],2,",",".")."</td>
										<td style=\"font-weight: bold; text-align: right;\">".number_format($SubSub[PPAwal],2,",",".")."</td>
										<td style=\"font-weight: bold; text-align: right;\">".number_format($SubSub[APAwal],2,",",".")."</td>
										<td style=\"font-weight: bold; text-align: right;\">".number_format($SubSub[NBAwal],2,",",".")."</td>

										<td style=\"font-weight: bold; text-align: right;\">".number_format($mutasiKurang,2,",",".")."</td>
										<td style=\"font-weight: bold; text-align: right;\">".number_format($mutasiTambah,2,",",".")."</td>

										<td style=\"font-weight: bold; text-align: right;\">".number_format($mutasiKurangAP,2,",",".")."</td>
										<td style=\"font-weight: bold; text-align: right;\">".number_format($mutasiTambahAP,2,",",".")."</td>
										
										<td style=\"font-weight: bold; text-align: right;\">".number_format($SubSub[nilai],2,",",".")."</td>
										<td style=\"font-weight: bold; text-align: right;\">".number_format($SubSub[PP],2,",",".")."</td>
										<td style=\"font-weight: bold; text-align: right;\">".number_format($SubSub[AP],2,",",".")."</td>
										<td style=\"font-weight: bold; text-align: right;\">".number_format($SubSub[NB],2,",",".")."</td>                                         
									</tr>";				
						}
					}
				}
			
			}
		}
	// $foot="</table>";
	// $html =$head.$body.$foot;	
	}
	
	$i++;
	// pr($i);
	// pr($hit_loop);
	if($i == $hit_loop){
		$foot="<tr>
				<td colspan = \"6\" style=\"text-align: center; font-weight: bold;\">Total</td>
				<td style=\"text-align: center; font-weight: bold;\">".number_format($jml_total,0,",",".")."</td>
				<td style=\"text-align: right; font-weight: bold;\">".number_format($np_total_awal,2,",",".")."</td>
				<td style=\"text-align: right; font-weight: bold;\">".number_format($pp_total_awal,2,",",".")."</td>
				<td style=\"text-align: right; font-weight: bold;\">".number_format($ap_total_awal,2,",",".")."</td>
				<td style=\"text-align: right; font-weight: bold;\">".number_format($nb_total_awal,2,",",".")."</td>

				<td style=\"text-align: right; font-weight: bold;\">".number_format($mutasiKurangTot,2,",",".")."</td>
				<td style=\"text-align: right; font-weight: bold;\">".number_format($mutasiTambahTot,2,",",".")."</td>

				<td style=\"text-align: right; font-weight: bold;\">".number_format($mutasiKurangTotAP,2,",",".")."</td>
				<td style=\"text-align: right; font-weight: bold;\">".number_format($mutasiTambahTotAP,2,",",".")."</td>

				<td style=\"text-align: right; font-weight: bold;\">".number_format($np_total,2,",",".")."</td>
				<td style=\"text-align: right; font-weight: bold;\">".number_format($pp_total,2,",",".")."</td>
				<td style=\"text-align: right; font-weight: bold;\">".number_format($ap_total,2,",",".")."</td>
				<td style=\"text-align: right; font-weight: bold;\">".number_format($nb_total,2,",",".")."</td>
			</tr>
		</table>";
	}else{
		$foot= '';
	}
	$html =$head.$body.$foot;
	
  
}
//bidang
function bidang($kode_golongan,$gol,$ps,$pt,$paramLevelGol,$TAHUN_AKTIF) {

global $tableNeracaTanah;
global $tableNeracaMesin;
global $tableNeracaBangunan;
global $tableNeracaJaringan;
global $tableNeracaAsetLain;
global $tableNeracaKdp;

$param_satker = $ps;
$splitKodeSatker = explode ('.',$param_satker);
if(count($splitKodeSatker) == 4){	
	$paramSatker = "kodeSatker = '$param_satker'";
}else{
	$paramSatker = "kodeSatker like '$param_satker%'";
}
$param_tgl = $pt;
if($gol == 'mesin_ori' || $gol == $tableNeracaMesin){
	$param_where = "Status_Validasi_barang !=77 and StatusTampil !=77 and kondisi != '3'  and 
					( (TglPerolehan < '2008-01-01' and TglPembukuan <= '$param_tgl' and kodeLokasi like '12%' and kodeKa=1) or 
					(TglPerolehan >= '2008-01-01' and TglPembukuan <= '$param_tgl'  and kodeLokasi like '12%' and (NilaiPerolehan >=300000 or kodeKa=1)))
					and $paramSatker";
 
	$sql = "select  SUBSTRING_INDEX(kodeKelompok,'.',2) as Bidang,
		   sum(NilaiPerolehan)as nilai,count(Aset_ID) as jml,
		   sum(PenyusutanPerTahun)as PP,sum(AkumulasiPenyusutan)as AP,sum(NilaiBuku)as NB,
		   sum(NilaiPerolehan_Awal)as nilaiAwal,
			sum(PenyusutanPerTahun_Awal)as PPAwal,
			sum(AkumulasiPenyusutan_Awal)as APAwal,sum(NilaiBuku)as NBAwal,
		   (select Uraian from kelompok 
		   where kode= SUBSTRING_INDEX(kodeKelompok,'.',2) 
		   ) as Uraian,
		   Status_Validasi_barang,kodeSatker from $gol m
			where kodeKelompok like '$kode_golongan%' and
			$param_where    
		   group by bidang";   

}elseif($gol == 'bangunan_ori' || $gol == $tableNeracaBangunan){
	$param_where = "Status_Validasi_barang !=77 and StatusTampil !=77 and kondisi != '3'  and 
					( (TglPerolehan < '2008-01-01' and TglPembukuan <= '$param_tgl' and kodeLokasi like '12%' and kodeKa=1) or 
					(TglPerolehan >= '2008-01-01' and TglPembukuan <= '$param_tgl' and kodeLokasi like '12%' and (NilaiPerolehan >=10000000  or kodeKa=1)))
					and $paramSatker";
	 
	$sql = "select  SUBSTRING_INDEX(kodeKelompok,'.',2) as Bidang,
		   sum(NilaiPerolehan)as nilai,count(Aset_ID) as jml,
		   sum(PenyusutanPerTahun)as PP,sum(AkumulasiPenyusutan)as AP,sum(NilaiBuku)as NB,
		   sum(NilaiPerolehan_Awal)as nilaiAwal,
			sum(PenyusutanPerTahun_Awal)as PPAwal,
			sum(AkumulasiPenyusutan_Awal)as APAwal,sum(NilaiBuku)as NBAwal,
		   (select Uraian from kelompok 
		   where kode= SUBSTRING_INDEX(kodeKelompok,'.',2) 
		   ) as Uraian,
		   Status_Validasi_barang,kodeSatker from $gol m
			where kodeKelompok like '$kode_golongan%' and
			 $param_where    
		   group by bidang";   
}else{
	if($gol!="tanahView")
		  $param_where = "Status_Validasi_barang !=77 and StatusTampil !=77 
					 and TglPerolehan <= '$param_tgl' 
					 and TglPembukuan <='$param_tgl' 
					 and kodeLokasi like '12%' 
					 and kondisi != '3'					 
					 and $paramSatker";
		else
		    $param_where = "Status_Validasi_barang !=77 and StatusTampil !=77  
					 and TglPerolehan <= '$param_tgl' 
					 and TglPembukuan <='$param_tgl' 
					 and kodeLokasi like '12%' 
					 and $paramSatker";
	 
	 if($gol == 'jaringan_ori' || $gol == $tableNeracaJaringan){
		$sql = "select  SUBSTRING_INDEX(kodeKelompok,'.',2) as Bidang,
			   sum(NilaiPerolehan)as nilai,count(Aset_ID) as jml,
			   sum(PenyusutanPerTahun)as PP,sum(AkumulasiPenyusutan)as AP,sum(NilaiBuku)as NB,
			   sum(NilaiPerolehan_Awal)as nilaiAwal,
				sum(PenyusutanPerTahun_Awal)as PPAwal,
				sum(AkumulasiPenyusutan_Awal)as APAwal,sum(NilaiBuku)as NBAwal,
			   (select Uraian from kelompok 
			   where kode= SUBSTRING_INDEX(kodeKelompok,'.',2) 
			   ) as Uraian,
			   Status_Validasi_barang,kodeSatker from $gol m
				where kodeKelompok like '$kode_golongan%' and
				 $param_where    
			   group by bidang";   
	 }else{
		/*$sql = "select  SUBSTRING_INDEX(kodeKelompok,'.',2) as Bidang,
			   sum(NilaiPerolehan)as nilai,count(Aset_ID) as jml,
			   sum(NilaiPerolehan_Awal)as nilaiAwal,
				sum(PenyusutanPerTahun_Awal)as PPAwal,
				sum(AkumulasiPenyusutan_Awal)as APAwal,sum(NilaiBuku)as NBAwal,
			   (select Uraian from kelompok 
			   where kode= SUBSTRING_INDEX(kodeKelompok,'.',2) 
			   ) as Uraian,
			   Status_Validasi_barang,kodeSatker from $gol m
				where kodeKelompok like '$kode_golongan%' and
				 $param_where    
			   group by bidang";*/
		$sql = "select  SUBSTRING_INDEX(kodeKelompok,'.',2) as Bidang,
			   sum(NilaiPerolehan)as nilai,count(Aset_ID) as jml,
			   sum(PenyusutanPerTahun)as PP,sum(AkumulasiPenyusutan)as AP,sum(NilaiBuku)as NB,
			   sum(NilaiPerolehan_Awal)as nilaiAwal,
				sum(PenyusutanPerTahun_Awal)as PPAwal,
				sum(AkumulasiPenyusutan_Awal)as APAwal,sum(NilaiBuku)as NBAwal,
			   (select Uraian from kelompok 
			   where kode= SUBSTRING_INDEX(kodeKelompok,'.',2) 
			   ) as Uraian,
			   Status_Validasi_barang,kodeSatker from $gol m
				where kodeKelompok like '$kode_golongan%' and
				 $param_where    
			   group by bidang"; 	   
	 }
}
 /*echo "<pre>";
 echo "==2==";
 echo "<br/>";
 print_r($sql); 
 echo "</pre>";*/
$data=array();
$a=0;
$resultparentBidang = mysql_query($sql) or die(mysql_error());
	while ($data_bidang = mysql_fetch_array($resultparentBidang)) {
		$kode_kelompok = $data_bidang[Bidang];
		$data[$a]=$data_bidang;
		$paramLevelBidang = $paramLevelGol;
		if($paramLevelBidang != 3){
			$data[$a]['Kelompok'] =kelompok($kode_kelompok, $gol,$ps,$pt,$paramLevelBidang,$TAHUN_AKTIF);
		}
		$a++;
		   
	}
  return $data;
}
//kelompok
function kelompok($kode_bidang,$gol,$ps,$pt,$paramLevelBidang,$TAHUN_AKTIF) {
global $tableNeracaTanah;
global $tableNeracaMesin;
global $tableNeracaBangunan;
global $tableNeracaJaringan;
global $tableNeracaAsetLain;
global $tableNeracaKdp;

$param_satker = $ps;
$splitKodeSatker = explode ('.',$param_satker);
if(count($splitKodeSatker) == 4){	
	$paramSatker = "kodeSatker = '$param_satker'";
}else{
	$paramSatker = "kodeSatker like '$param_satker%'";
}
$param_tgl = $pt;
if($gol == 'mesin_ori' || $gol == $tableNeracaMesin){
	$param_where = "Status_Validasi_barang !=77 and StatusTampil !=77 and kondisi != '3'  and 
					( (TglPerolehan < '2008-01-01' and TglPembukuan <= '$param_tgl' and kodeLokasi like '12%' and kodeKa=1) or 
					(TglPerolehan >= '2008-01-01' and TglPembukuan <= '$param_tgl'  and kodeLokasi like '12%' and (NilaiPerolehan >=300000 or kodeKa=1)))
					and $paramSatker";
 
	$sql = "select  SUBSTRING_INDEX(kodeKelompok,'.',3) as kelompok,
			 sum(NilaiPerolehan)as nilai,count(Aset_ID) as jml,
			 sum(PenyusutanPerTahun)as PP,sum(AkumulasiPenyusutan)as AP,sum(NilaiBuku)as NB,
			 sum(NilaiPerolehan_Awal)as nilaiAwal,
			sum(PenyusutanPerTahun_Awal)as PPAwal,
			sum(AkumulasiPenyusutan_Awal)as APAwal,sum(NilaiBuku)as NBAwal,
			 (select Uraian from kelompok 
			 where kode= SUBSTRING_INDEX(kodeKelompok,'.',3) 
			 ) as Uraian,
			 Status_Validasi_barang,kodeSatker from $gol m
			  where kodeKelompok like '$kode_bidang%' and
			   $param_where    
			 group by kelompok";		 

}elseif($gol == 'bangunan_ori' || $gol == $tableNeracaBangunan){
	$param_where = "Status_Validasi_barang !=77 and StatusTampil !=77 and kondisi != '3'  and 
				( (TglPerolehan < '2008-01-01' and TglPembukuan <= '$param_tgl' and kodeLokasi like '12%' and kodeKa=1) or 
				  (TglPerolehan >= '2008-01-01' and TglPembukuan <= '$param_tgl' and kodeLokasi like '12%' and (NilaiPerolehan >=10000000  or kodeKa=1)))
				 and $paramSatker";
	 
	$sql = "select  SUBSTRING_INDEX(kodeKelompok,'.',3) as kelompok,
			 sum(NilaiPerolehan)as nilai,count(Aset_ID) as jml,
			 sum(PenyusutanPerTahun)as PP,sum(AkumulasiPenyusutan)as AP,sum(NilaiBuku)as NB,
			 sum(NilaiPerolehan_Awal)as nilaiAwal,
			sum(PenyusutanPerTahun_Awal)as PPAwal,
			sum(AkumulasiPenyusutan_Awal)as APAwal,sum(NilaiBuku)as NBAwal,
			 (select Uraian from kelompok 
			 where kode= SUBSTRING_INDEX(kodeKelompok,'.',3) 
			 ) as Uraian,
			 Status_Validasi_barang,kodeSatker from $gol m
			  where kodeKelompok like '$kode_bidang%' and
			   $param_where    
			 group by kelompok";		 
}else{
	if($gol!="tanahView")
		  $param_where = "Status_Validasi_barang !=77 and StatusTampil !=77
					 and TglPerolehan <= '$param_tgl' 
					 and TglPembukuan <='$param_tgl' 
					 and kodeLokasi like '12%' 
					 and kondisi != '3'					 
					 and $paramSatker";
		else
		    $param_where = "Status_Validasi_barang !=77 and StatusTampil !=77
					 and TglPerolehan <= '$param_tgl' 
					 and TglPembukuan <='$param_tgl' 
					 and kodeLokasi like '12%' 
					 and $paramSatker";
	 
	 if($gol == 'jaringan_ori' || $gol == $tableNeracaJaringan){
		$sql = "select  SUBSTRING_INDEX(kodeKelompok,'.',3) as kelompok,
			 sum(NilaiPerolehan)as nilai,count(Aset_ID) as jml,
			 sum(PenyusutanPerTahun)as PP,sum(AkumulasiPenyusutan)as AP,sum(NilaiBuku)as NB,
			 sum(NilaiPerolehan_Awal)as nilaiAwal,
			sum(PenyusutanPerTahun_Awal)as PPAwal,
			sum(AkumulasiPenyusutan_Awal)as APAwal,sum(NilaiBuku)as NBAwal,
			 (select Uraian from kelompok 
			 where kode= SUBSTRING_INDEX(kodeKelompok,'.',3) 
			 ) as Uraian,
			 Status_Validasi_barang,kodeSatker from $gol m
			  where kodeKelompok like '$kode_bidang%' and
			   $param_where    
			 group by kelompok"; 
	 }else{
		/*$sql = "select  SUBSTRING_INDEX(kodeKelompok,'.',3) as kelompok,
				 sum(NilaiPerolehan)as nilai,count(Aset_ID) as jml,
				 sum(NilaiPerolehan_Awal)as nilaiAwal,
				sum(PenyusutanPerTahun_Awal)as PPAwal,
				sum(AkumulasiPenyusutan_Awal)as APAwal,sum(NilaiBuku)as NBAwal,
				 (select Uraian from kelompok 
				 where kode= SUBSTRING_INDEX(kodeKelompok,'.',3) 
				 ) as Uraian,
				 Status_Validasi_barang,kodeSatker from $gol m
				  where kodeKelompok like '$kode_bidang%' and
				   $param_where    
				 group by kelompok";*/
		$sql = "select  SUBSTRING_INDEX(kodeKelompok,'.',3) as kelompok,
			 sum(NilaiPerolehan)as nilai,count(Aset_ID) as jml,
			 sum(PenyusutanPerTahun)as PP,sum(AkumulasiPenyusutan)as AP,sum(NilaiBuku)as NB,
			 sum(NilaiPerolehan_Awal)as nilaiAwal,
			sum(PenyusutanPerTahun_Awal)as PPAwal,
			sum(AkumulasiPenyusutan_Awal)as APAwal,sum(NilaiBuku)as NBAwal,
			 (select Uraian from kelompok 
			 where kode= SUBSTRING_INDEX(kodeKelompok,'.',3) 
			 ) as Uraian,
			 Status_Validasi_barang,kodeSatker from $gol m
			  where kodeKelompok like '$kode_bidang%' and
			   $param_where    
			 group by kelompok";		 
	 }
}

 /*echo "<pre>";
 echo "==3==";
 echo "<br/>";
 print_r($sql); 
 echo "</pre>";*/
$data=array();
$b=0;
$resultparentKelompok = mysql_query($sql) or die(mysql_error());
	while ($data_kelompok = mysql_fetch_array($resultparentKelompok)) {
	  
		$kode_kelompok = $data_kelompok[kelompok];
		$data[$b]=$data_kelompok;
		$paramLevelKelompok = $paramLevelBidang;
		if($paramLevelKelompok !=4){
			$data[$b]['Sub'] =sub($kode_kelompok,$gol,$ps,$pt,$paramLevelKelompok,$TAHUN_AKTIF);
		}
		
		
		$b++;
	}
 return $data;
}
//sub
function sub($kodeKelompok,$gol,$ps,$pt,$paramLevelKelompok,$TAHUN_AKTIF) {
global $tableNeracaTanah;
global $tableNeracaMesin;
global $tableNeracaBangunan;
global $tableNeracaJaringan;
global $tableNeracaAsetLain;
global $tableNeracaKdp;

$param_satker = $ps;
$splitKodeSatker = explode ('.',$param_satker);
if(count($splitKodeSatker) == 4){	
	$paramSatker = "kodeSatker = '$param_satker'";
}else{
	$paramSatker = "kodeSatker like '$param_satker%'";
}
$param_tgl = $pt;
if($gol == 'mesin_ori' || $gol == $tableNeracaMesin){
	$param_where = "Status_Validasi_barang !=77 and StatusTampil !=77 and kondisi != '3'  and 
					( (TglPerolehan < '2008-01-01' and TglPembukuan <= '$param_tgl' and kodeLokasi like '12%' and kodeKa=1) or 
					  (TglPerolehan >= '2008-01-01' and TglPembukuan <= '$param_tgl'  and kodeLokasi like '12%' and (NilaiPerolehan >=300000 or kodeKa=1)))
					 and $paramSatker";
 
	$sql = "select  SUBSTRING_INDEX(kodeKelompok,'.',4) as sub,
			sum(NilaiPerolehan)as nilai,count(Aset_ID) as jml,
			sum(PenyusutanPerTahun)as PP,sum(AkumulasiPenyusutan)as AP,sum(NilaiBuku)as NB,
			sum(NilaiPerolehan_Awal)as nilaiAwal,
			sum(PenyusutanPerTahun_Awal)as PPAwal,
			sum(AkumulasiPenyusutan_Awal)as APAwal,sum(NilaiBuku)as NBAwal,
			(select Uraian from kelompok 
			where kode= SUBSTRING_INDEX(kodeKelompok,'.',4) 
			) as Uraian,
			Status_Validasi_barang,kodeSatker from $gol m
			 where kodeKelompok like '$kodeKelompok%' and
			 $param_where     
			group by sub";	
}elseif($gol == 'bangunan_ori' || $gol == $tableNeracaBangunan){
	$param_where = "Status_Validasi_barang !=77 and StatusTampil !=77 and kondisi != '3'  and 
				( (TglPerolehan < '2008-01-01' and TglPembukuan <= '$param_tgl' and kodeLokasi like '12%' and kodeKa=1) or 
				  (TglPerolehan >= '2008-01-01' and TglPembukuan <= '$param_tgl' and kodeLokasi like '12%' and (NilaiPerolehan >=10000000  or kodeKa=1)))
				 and $paramSatker";
	 
	$sql = "select  SUBSTRING_INDEX(kodeKelompok,'.',4) as sub,
			sum(NilaiPerolehan)as nilai,count(Aset_ID) as jml,
			sum(PenyusutanPerTahun)as PP,sum(AkumulasiPenyusutan)as AP,sum(NilaiBuku)as NB,
			sum(NilaiPerolehan_Awal)as nilaiAwal,
			sum(PenyusutanPerTahun_Awal)as PPAwal,
			sum(AkumulasiPenyusutan_Awal)as APAwal,sum(NilaiBuku)as NBAwal,
			(select Uraian from kelompok 
			where kode= SUBSTRING_INDEX(kodeKelompok,'.',4) 
			) as Uraian,
			Status_Validasi_barang,kodeSatker from $gol m
			 where kodeKelompok like '$kodeKelompok%' and
			 $param_where     
			group by sub";		
}else{
	if($gol!="tanahView")
		  $param_where = "Status_Validasi_barang !=77 and StatusTampil !=77  
					 and TglPerolehan <= '$param_tgl' 
					 and TglPembukuan <='$param_tgl' 
					 and kodeLokasi like '12%' 
					 and kondisi != '3'					 
					 and $paramSatker";
		else
		    $param_where = "Status_Validasi_barang !=77 and StatusTampil !=77  
					 and TglPerolehan <= '$param_tgl' 
					 and TglPembukuan <='$param_tgl' 
					 and kodeLokasi like '12%' 
					 and $paramSatker";
				 
	 if($gol == 'jaringan_ori' || $gol == $tableNeracaJaringan){
		$sql = "select  SUBSTRING_INDEX(kodeKelompok,'.',4) as sub,
				sum(NilaiPerolehan)as nilai,count(Aset_ID) as jml,
				sum(PenyusutanPerTahun)as PP,sum(AkumulasiPenyusutan)as AP,sum(NilaiBuku)as NB,
				sum(NilaiPerolehan_Awal)as nilaiAwal,
				sum(PenyusutanPerTahun_Awal)as PPAwal,
				sum(AkumulasiPenyusutan_Awal)as APAwal,sum(NilaiBuku)as NBAwal,
				(select Uraian from kelompok 
				where kode= SUBSTRING_INDEX(kodeKelompok,'.',4) 
				) as Uraian,
				Status_Validasi_barang,kodeSatker from $gol m
				 where kodeKelompok like '$kodeKelompok%' and
				 $param_where     
				group by sub";	
	 }else{
		/*$sql = "select  SUBSTRING_INDEX(kodeKelompok,'.',4) as sub,
				sum(NilaiPerolehan)as nilai,count(Aset_ID) as jml,
				sum(NilaiPerolehan_Awal)as nilaiAwal,
				sum(PenyusutanPerTahun_Awal)as PPAwal,
				sum(AkumulasiPenyusutan_Awal)as APAwal,sum(NilaiBuku)as NBAwal,
				(select Uraian from kelompok 
				where kode= SUBSTRING_INDEX(kodeKelompok,'.',4) 
				) as Uraian,
				Status_Validasi_barang,kodeSatker from $gol m
				 where kodeKelompok like '$kodeKelompok%' and
				 $param_where     
				group by sub";*/
		$sql = "select  SUBSTRING_INDEX(kodeKelompok,'.',4) as sub,
				sum(NilaiPerolehan)as nilai,count(Aset_ID) as jml,
				sum(PenyusutanPerTahun)as PP,sum(AkumulasiPenyusutan)as AP,sum(NilaiBuku)as NB,
				sum(NilaiPerolehan_Awal)as nilaiAwal,
				sum(PenyusutanPerTahun_Awal)as PPAwal,
				sum(AkumulasiPenyusutan_Awal)as APAwal,sum(NilaiBuku)as NBAwal,
				(select Uraian from kelompok 
				where kode= SUBSTRING_INDEX(kodeKelompok,'.',4) 
				) as Uraian,
				Status_Validasi_barang,kodeSatker from $gol m
				 where kodeKelompok like '$kodeKelompok%' and
				 $param_where     
				group by sub";		
	 }
}

 /*echo "<pre>";
 echo "==4==";
 echo "<br/>";
 print_r($sql); 
 echo "</pre>";*/
$data=array();
$c=0;
$resultparentSub = mysql_query($sql) or die(mysql_error());
	 while ($data_sub = mysql_fetch_array($resultparentSub)) {
		$kode_sub = $data_sub[sub];
		$data[$c]=$data_sub;
		$paramLevelSub = $paramLevelKelompok;
		if($paramLevelSub !=5){
			$data[$c]['SubSub'] =subsub($kode_sub,$gol,$ps,$pt,$paramLevelSub,$TAHUN_AKTIF);
		}
		$c++;
	 }
return $data ;
}
//subsub
function subsub($kode_sub,$gol,$ps,$pt,$paramLevelSub,$TAHUN_AKTIF) {
global $tableNeracaTanah;
global $tableNeracaMesin;
global $tableNeracaBangunan;
global $tableNeracaJaringan;
global $tableNeracaAsetLain;
global $tableNeracaKdp;

$param_satker = $ps;
$splitKodeSatker = explode ('.',$param_satker);
if(count($splitKodeSatker) == 4){	
	$paramSatker = "kodeSatker = '$param_satker'";
}else{
	$paramSatker = "kodeSatker like '$param_satker%'";
}
$param_tgl = $pt;   
if($gol == 'mesin_ori' || $gol == $tableNeracaMesin){
	$param_where = "Status_Validasi_barang !=77 and StatusTampil !=77 and kondisi != '3'  and 
				( (TglPerolehan < '2008-01-01' and TglPembukuan <= '$param_tgl' and kodeLokasi like '12%' and kodeKa=1) or 
				  (TglPerolehan >= '2008-01-01' and TglPembukuan <= '$param_tgl'  and kodeLokasi like '12%' and (NilaiPerolehan >=300000 or kodeKa=1)))
				 and $paramSatker";
 
      $sql = "select  SUBSTRING_INDEX(kodeKelompok,'.',5) as subsub,
               sum(NilaiPerolehan)as nilai,count(Aset_ID) as jml,
			   sum(PenyusutanPerTahun)as PP,sum(AkumulasiPenyusutan)as AP,sum(NilaiBuku)as NB,
			   sum(NilaiPerolehan_Awal)as nilaiAwal,
				sum(PenyusutanPerTahun_Awal)as PPAwal,
				sum(AkumulasiPenyusutan_Awal)as APAwal,sum(NilaiBuku)as NBAwal,
               (select Uraian from kelompok 
               where kode= SUBSTRING_INDEX(kodeKelompok,'.',5) 
               ) as Uraian,
               Status_Validasi_barang,kodeSatker from $gol m
                where kodeKelompok like '$kode_sub%' and
                 $param_where    
               group by subsub";    
}elseif($gol == 'bangunan_ori' || $gol == $tableNeracaBangunan){
	$param_where = "Status_Validasi_barang !=77 and StatusTampil !=77 and kondisi != '3'  and 
				( (TglPerolehan < '2008-01-01' and TglPembukuan <= '$param_tgl' and kodeLokasi like '12%' and kodeKa=1) or 
				  (TglPerolehan >= '2008-01-01' and TglPembukuan <= '$param_tgl' and kodeLokasi like '12%' and (NilaiPerolehan >=10000000  or kodeKa=1)))
				 and $paramSatker";
	 
	$sql = "select  SUBSTRING_INDEX(kodeKelompok,'.',5) as subsub,
               sum(NilaiPerolehan)as nilai,count(Aset_ID) as jml,
			   sum(PenyusutanPerTahun)as PP,sum(AkumulasiPenyusutan)as AP,sum(NilaiBuku)as NB,
			   sum(NilaiPerolehan_Awal)as nilaiAwal,
				sum(PenyusutanPerTahun_Awal)as PPAwal,
				sum(AkumulasiPenyusutan_Awal)as APAwal,sum(NilaiBuku)as NBAwal,
               (select Uraian from kelompok 
               where kode= SUBSTRING_INDEX(kodeKelompok,'.',5) 
               ) as Uraian,
               Status_Validasi_barang,kodeSatker from $gol m
                where kodeKelompok like '$kode_sub%' and
                 $param_where    
               group by subsub";        
}else{
	if($gol!="tanahView")
		  $param_where = "Status_Validasi_barang !=77 and StatusTampil !=77
					 and TglPerolehan <= '$param_tgl' 
					 and TglPembukuan <='$param_tgl' 
					 and kodeLokasi like '12%' 
					 and kondisi != '3'					 
					 and $paramSatker";
		else
		    $param_where = "Status_Validasi_barang !=77 and StatusTampil !=77
					 and TglPerolehan <= '$param_tgl' 
					 and TglPembukuan <='$param_tgl' 
					 and kodeLokasi like '12%' 
					 and $paramSatker";
	 
	 if($gol == 'jaringan_ori' || $gol == $tableNeracaJaringan){
		$sql = "select  SUBSTRING_INDEX(kodeKelompok,'.',5) as subsub,
               sum(NilaiPerolehan)as nilai,count(Aset_ID) as jml,
			   sum(PenyusutanPerTahun)as PP,sum(AkumulasiPenyusutan)as AP,sum(NilaiBuku)as NB,
			   sum(NilaiPerolehan_Awal)as nilaiAwal,
				sum(PenyusutanPerTahun_Awal)as PPAwal,
				sum(AkumulasiPenyusutan_Awal)as APAwal,sum(NilaiBuku)as NBAwal,
               (select Uraian from kelompok 
               where kode= SUBSTRING_INDEX(kodeKelompok,'.',5) 
               ) as Uraian,
               Status_Validasi_barang,kodeSatker from $gol m
                where kodeKelompok like '$kode_sub%' and
                 $param_where    
               group by subsub";     
	 }else{
		/*$sql = "select  SUBSTRING_INDEX(kodeKelompok,'.',5) as subsub,
               sum(NilaiPerolehan)as nilai,count(Aset_ID) as jml,
               sum(NilaiPerolehan_Awal)as nilaiAwal,
				sum(PenyusutanPerTahun_Awal)as PPAwal,
				sum(AkumulasiPenyusutan_Awal)as APAwal,sum(NilaiBuku)as NBAwal,
               (select Uraian from kelompok 
               where kode= SUBSTRING_INDEX(kodeKelompok,'.',5) 
               ) as Uraian,
               Status_Validasi_barang,kodeSatker from $gol m
                where kodeKelompok like '$kode_sub%' and
                 $param_where    
               group by subsub";*/
        $sql = "select  SUBSTRING_INDEX(kodeKelompok,'.',5) as subsub,
               sum(NilaiPerolehan)as nilai,count(Aset_ID) as jml,
			   sum(PenyusutanPerTahun)as PP,sum(AkumulasiPenyusutan)as AP,sum(NilaiBuku)as NB,
			   sum(NilaiPerolehan_Awal)as nilaiAwal,
				sum(PenyusutanPerTahun_Awal)as PPAwal,
				sum(AkumulasiPenyusutan_Awal)as APAwal,sum(NilaiBuku)as NBAwal,
               (select Uraian from kelompok 
               where kode= SUBSTRING_INDEX(kodeKelompok,'.',5) 
               ) as Uraian,
               Status_Validasi_barang,kodeSatker from $gol m
                where kodeKelompok like '$kode_sub%' and
                 $param_where    
               group by subsub";       
	 }
}

 /*echo "<pre>";
 echo "==5==";
 echo "<br/>";
 print_r($sql); 
 echo "</pre>";*/
	 
     $resultparentSubSub = mysql_query($sql) or die(mysql_error());
     $data = array();
     while ($data_subsub = mysql_fetch_array($resultparentSubSub)) {
          $data[] = $data_subsub;
     }
     return $data;
}
// pr($resultParamGol);
// exit;	
//untuk web service
// $serviceJson=json_encode($html);
//untuk print output html
//echo $html; 
//exit;
if($tipe=="3"){
	echo $serviceJson;
	exit;
}elseif($tipe!="2"){
$REPORT->show_status_download_kib();
$mpdf=new mPDF('','','','',15,15,16,16,9,9,'L');
$mpdf->AddPage('L','','','','',15,15,16,16,9,9);
$mpdf->setFooter('{PAGENO}') ;
$mpdf->progbar_heading = '';
$mpdf->StartProgressBarOutput(2);
$mpdf->useGraphs = true;
$mpdf->list_number_suffix = ')';
$mpdf->hyphenate = true;
//$mpdf->debug = true;
//print output pdf
$mpdf->WriteHTML($html);
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
$namafile="$path/report/output/Rekapitulasi Rincian Barang Ke Neraca_$waktu.pdf";
$mpdf->Output("$namafile",'F');
$namafile_web="$url_rewrite/report/output/Rekapitulasi Rincian Barang Ke Neraca_$waktu.pdf";
echo "<script>window.location.href='$namafile_web';</script>";
exit;
}
else
{
	$waktu=date("d-m-y_h:i:s");
	$filename ="Rekapitulasi_Rincian_barang_ke_neraca_$waktu.xls";
	header('Content-type: application/ms-excel');
	header('Content-Disposition: attachment; filename='.$filename);
	echo $html; 
}
?>