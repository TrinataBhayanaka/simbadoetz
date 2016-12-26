<?php

ob_start();
include "../config/config.php";


/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
#This code provided by:
#Andreas Hadiyono (andre.hadiyono@gmail.com)
#Gunadarma University

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * Easy set variables
 */

/* Array of database columns which should be read and sent back to DataTables. Use a space where
 * you want to insert a non-database field (for example a counter or static image)
 */
//$aColumns = array('Aset_ID', 'a.kodeKelompok', 'a.kodeSatker', 'a.kodeLokasi', 'a.noRegister', 'a.noKontrak', 'a.TglPerolehan', 'a.TglPembukuan', 'a.SumberDana', 'a.NilaiPerolehan', 'a.Alamat', 'a.RTRW', 'a.kondisi', 'a.TglInventarisasi', 'a.BAST_ID', 'a.BASP_ID', 'a.Kuantitas', 'a.Satuan', 'a.Bersejarah', 'a.Info', 'a.Dihapus', 'a.UserNm', 'a.FixAset', 'a.NotUse', 'a.Tahun', 'a.AsalUsul', 'a.Dipindah', 'a.StatusValidasi', 'a.CaraPerolehan', 'a.Status_Validasi_Barang', 'a.kodeData', 'a.kodeKA', 'a.kodeRuangan', 'a.TipeAset', 'a.statusPemanfaatan', 'a.MasaManfaat', 'a.AkumulasiPenyusutan', 'a.PenyusutanPertaun', 'a.fixPenggunaan', 'a.GUID', 'a.NilaiBuku', 'a.UmurEkonomis', 'a.TahunPenyusutan', 'a.nilai_kapitalisasi', 'a.prosentase', 'a.penambahan_masa_manfaat', 'a.jenis_belanja', 'a.kodeKelompokReklasAsal', 'a.kodeKelompokReklasTujuan');
$aColumns=array('Aset_ID', 'kodeKelompok', 'kodeSatker', 'kodeLokasi', 'noRegister', 'noKontrak', 'TglPerolehan', 'TglPembukuan', 'SumberDana', 'NilaiPerolehan',  'kondisi','Info', 'Dihapus', 'UserNm',  'NotUse', 'Tahun', 'AsalUsul',  'StatusValidasi', 'CaraPerolehan', 'Status_Validasi_Barang',  'kodeKA', 'kodeRuangan', 'TipeAset',  'MasaManfaat', 'AkumulasiPenyusutan', 'PenyusutanPertaun', 'fixPenggunaan', 'GUID', 'NilaiBuku', 'UmurEkonomis', 'TahunPenyusutan',   'jenis_belanja', 'kodeKelompokReklasAsal', 'kodeKelompokReklasTujuan');
/* Indexed column (used for fast and accurate table cardinality) */
$sIndexColumn = "Aset_ID";

/* DBVAR table to use */
$sTable = "aset";

$par_data_table ="tahun={$bup_tahun}&jenisaset={$jenisaset}&kodeSatker={$kodeSatker}&kodepemilik={$kodepemilik}&kodeKelompok={$kodeKelompok}&statusaset={$statusaset}";

$tahun = $_GET['tahun'];
$jenisaset = $_GET['jenisaset'];
$kodeSatker = $_GET['kodeSatker'];
$kodepemilik = $_GET['kodepemilik'];
$kodeKelompok= $_GET['kodeKelompok'];
$statusaset=$_GET['statusaset'];


//$document=$_GET["document"];
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

/*
 * Paging
 */
$sLimit = "";
if (isset($_GET['iDisplayStart']) && $_GET['iDisplayLength'] != '-1') {
     $sLimit = "LIMIT " . intval($_GET['iDisplayStart']) . ", " .
             intval($_GET['iDisplayLength']);
}


/*
 * Ordering
 */
$sOrder = "";
if (isset($_GET['iSortCol_0'])) {
     $sOrder = "ORDER BY  ";
     for ($i = 0; $i < intval($_GET['iSortingCols']); $i++) {
          if ($_GET['bSortable_' . intval($_GET['iSortCol_' . $i])] == "true") {
               //$sOrder .= "'" . $aColumns[intval($_GET['iSortCol_' . $i])] . "' " .
               $sOrder .= "" . $aColumns[intval($_GET['iSortCol_' . $i])] . " " .
                       ($_GET['sSortDir_' . $i] === 'asc' ? 'asc' : 'desc') . ", ";
          }
     }

     $sOrder = substr_replace($sOrder, "", -2);
     if ($sOrder == "ORDER BY") {
          $sOrder = "";
     }
}



/*
 * Filtering
 * NOTE this does not match the built-in DataTables filtering which does it
 * word by word on any field. It's possible to do here, but concerned about efficiency
 * on very large tables, and MySQL's regex functionality is very limited
 */
//$sWhere = "";
if (isset($_GET['sSearch']) && $_GET['sSearch'] != "") {
     $sWhere = "WHERE (";
     for ($i = 0; $i < count($aColumns); $i++) {
          if (isset($_GET['bSearchable_' . $i]) && $_GET['bSearchable_' . $i] == "true") {
               $sWhere .= "`" . $aColumns[$i] . "` LIKE '%" . mysql_real_escape_string($_GET['sSearch']) . "%' OR ";
          }
     }
     $sWhere = substr_replace($sWhere, "", -3);
     $sWhere .= ')';
}

/* Individual column filtering */
for ($i = 0; $i < count($aColumns); $i++) {
     if (isset($_GET['bSearchable_' . $i]) && $_GET['bSearchable_' . $i] == "true" && $_GET['sSearch_' . $i] != '') {
          if ($sWhere == "") {
               $sWhere = "WHERE ";
          } else {
               $sWhere .= " AND ";
          }
          $sWhere .= "`" . $aColumns[$i] . "` LIKE '%" . mysql_real_escape_string($_GET['sSearch_' . $i]) . "%' ";
     }
}


$sQuery = "
    SELECT SQL_CALC_FOUND_ROWS `" . str_replace(" , ", " ", implode("`, `", $aColumns)) . "`
    FROM   $sTable
    $sWhere
    $sOrder
    $sLimit
    ";
//echo $sQuery;
$rResult = mysql_query($sQuery) or die(mysql_error());

/* Data set length after filtering */
$sQuery = "
    SELECT FOUND_ROWS()
  ";
$rResultFilterTotal = mysql_query($sQuery) or die(mysql_error());
$aResultFilterTotal = mysql_fetch_array($rResultFilterTotal);
$iFilteredTotal = $aResultFilterTotal[0];

/* Total data set length */
$sQuery = "
    SELECT COUNT(`" . $sIndexColumn . "`)
    FROM   $sTable
  ";
$rResultTotal = mysql_query($sQuery);
$aResultTotal = mysql_fetch_array($rResultTotal);
$iTotal = $aResultTotal[0];


/*
 * Output
 */
$output = array(
    "sEcho" => intval($_GET['sEcho']),
    "iTotalRecords" => $iTotal,
    "iTotalDisplayRecords" => $iFilteredTotal,
    "aaData" => array()
);
//echo "<pre>";
while ($aRow = mysql_fetch_array($rResult)) {
     $row = array();
     $Aset_ID=$aRow['Aset_ID'];
     $noRegister=$aRow['noRegister'];
     $noKontrak=$aRow['noKontrak'];
     $kodeKelompok=$aRow['kodeKelompok'];
     $text_kelompok=get_uraian($kodeKelompok);
     $kodeSatker=$aRow['kodeSatker'];
     $text_satker=get_nama_satker($kodeSatker);
     $info=$aRow['info'];
     $TglPerolehan=$aRow['TglPerolehan'];
     $TglPembukuan=$aRow['TglPembukuan'];
     $kondisi=$aRow['kondisi'];
     $TipeAset=$aRow['TipeAset'];

     $NilaiPerolehan=number_format($aRow['NilaiPerolehan'],2);
     $NilaiBuku=number_format($aRow ['NilaiBuku'],2);
     $PenyusutanPertaun=number_format($aRow ['PenyusutanPertaun'],2);
     $AkumulasiPenyusutan=number_format($aRow ['AkumulasiPenyusutan'],2);

     $StatusValidasi=$aRow['StatusValidasi'];
     $Status_Validasi_Barang=$aRow['Status_Validasi_Barang']; 
     $StatusTampil=$aRow['StatusTampil'];

     list($kunciM,$StatusValidasiM,$Status_Validasi_BarangM,$StatusTampilM,$tableM,$keyM)=get_detail_aset($Aset_ID,$TipeAset);
     $text_sv="";
     $text_svb="";
     
     if($StatusValidasi!=$StatusValidasiM){
      $text_sv="StatusValidasi tdk sama <br/>";
     }

     if($Status_Validasi_Barang!=$Status_Validasi_BarangM){
      $text_svb="Status_Validasi_Barang tdk sama <br/>";
     }

    $href="<a href=\"$url_rewrite/module/log/detail_aset.php?id=$Aset_ID&jenisaset=$TipeAset\"><button> Riwayat</button> </a>";

     $row[] = $noRegister;
     $row[] = $noKontrak;
     $row[]= "$kodeKelompok<br/>$text_kelompok";
     $row[]= "$kodeSatker<br/>$text_satker";
     $row[] = "$info";
     $row[] = "$TglPerolehan <br/> /$TglPembukuan";
     $row[] = "$NilaiPerolehan";
     $row[] = "$text_sv $text_svb";
     $row[] = "$href";
    


     $output['aaData'][] = $row;
}

echo json_encode($output);

function get_uraian( $kode ) {
   $query = "select Uraian from kelompok where Kode like '$kode%' $where limit 1";
  $result = mysql_query( $query ) or die( mysql_error() );
  while ( $row = mysql_fetch_array( $result ) ) {
    $Uraian = $row[Uraian];
  }
  return $Uraian;
}

function get_nama_satker( $satker ) {
    $query = "select NamaSatker from satker where kode like '$satker%' and (Gudang is null or Gudang='') limit 1";
  $result = mysql_query( $query ) or die( mysql_error() );
  while ( $row = mysql_fetch_array( $result ) ) {
    $NamaSatker = $row[NamaSatker];
  }
  return $NamaSatker;
}

function get_detail_aset($Aset_ID,$TipeAset){
  if($TipeAset=="A"){
      $table="tanah";
      $key="Tanah_ID";

  }else if($TipeAset=="B"){
      $table="mesin";
      $key="Mesin_ID";
   }else if($TipeAset=="C"){
      $table="bangunan";
      $key="Bangunan_ID";
   }else if($TipeAset=="D"){
      $table="jaringan";
      $key="jaringan_ID";
     }else if($TipeAset=="E"){
      $table="asetlain";
      $key="AsetLain_ID";
    }else if($TipeAset=="F"){
      $table="kdp";
      $key="KDP_ID";
    }
    
    $query = "select $key as kunci,StatusValidasi,Status_Validasi_Barang,StatusTampil from $table where Aset_ID='$Aset_ID' limit 1";
    //echo $query;
    $result = mysql_query( $query ) or die( mysql_error() );
  while ( $row = mysql_fetch_array( $result ) ) {
    $kunci = $row[kunci];
    $StatusValidasi=$row['StatusValidasi'];
    $Status_Validasi_Barang=$row['Status_Validasi_Barang']; 
    $StatusTampil=$row['StatusTampil'];

  }
  return array($kunci,$StatusValidasi,$Status_Validasi_Barang,$StatusTampil,$table,$key);

}
?>

