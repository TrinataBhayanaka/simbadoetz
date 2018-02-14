<?php
ob_start();
include "../../config/config.php";

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
//$aColumns = array('a.Aset_ID','a.noRegister','a.TglPerolehan','a.Tahun','a.Info','a.kodeKelompok','k.Uraian','a.kodeSatker','a.NilaiPerolehan','a.TipeAset');
$aColumns = array('a.Aset_ID','a.noRegister','a.TglPerolehan','a.Info','a.TglPembukuan','a.kodeKelompok','k.Uraian','a.kodeSatker','a.NilaiPerolehan','a.kondisi');

/* Indexed column (used for fast and accurate table cardinality) */
$sIndexColumn = "a.Aset_ID";
//pr($_GET);
$satker       = $_GET['kodeSatker'];
$kodeKelompok = $_GET['kodeKelompok'];

/* DB table to use */
$sTable = "aset as a";
$sTable_inner_join_kelompok = "kelompok as k";
$cond_kelompok ="k.Kode = a.kodeKelompok ";
$status = "a.Status_Validasi_Barang = 1 AND";

$tipeAset = explode('.', $kodeKelompok);
if($tipeAset['0'] == '01'){
  $sTable_inner_join_kib ="tanah as kib";
  $cond_kib ="kib.Aset_ID = a.Aset_ID";
}elseif($tipeAset['0'] == '02'){
  $sTable_inner_join_kib ="mesin as kib";
  $cond_kib ="kib.Aset_ID = a.Aset_ID";
  $aColumns = array('a.noRegister','a.TglPerolehan','a.Info','a.NilaiPerolehan','kib.Merk','a.kondisi','a.kodeKelompok','k.Uraian','a.kodeSatker','kib.NoSeri','kib.NoRangka','kib.NoSTNK','a.TglPembukuan','a.Aset_ID');  
}elseif($tipeAset['0'] == '03'){
  $sTable_inner_join_kib ="bangunan as kib";
  $cond_kib ="kib.Aset_ID = a.Aset_ID";
}elseif($tipeAset['0'] == '04'){
  $sTable_inner_join_kib ="jaringan as kib";
  $cond_kib ="kib.Aset_ID = a.Aset_ID";
}elseif($tipeAset['0'] == '05'){
  $sTable_inner_join_kib ="asetlain as kib";
  $cond_kib ="kib.Aset_ID = a.Aset_ID";
}elseif($tipeAset['0'] == '06'){
  $sTable_inner_join_kib ="kdp as kib";
  $cond_kib ="kib.Aset_ID = a.Aset_ID";
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
               $sOrder .= "`" . $aColumns[intval($_GET['iSortCol_' . $i])] . "` " .
                       ($_GET['sSortDir_' . $i] === 'asc' ? 'asc' : 'desc') . ", ";
          }
     }

     $sOrder = substr_replace($sOrder, "", -2);
     if ($sOrder == "ORDER BY") {
          $sOrder = "ORDER BY a.kodeKelompok,a.noRegister asc";
     }
}

$sWhere = "";
if ($satker != '' AND $kodeKelompok != ''){
  $sWhere=" WHERE $status a.kodeSatker='$satker' AND a.kodeKelompok='$kodeKelompok'";
}

/*
 * Filtering
 * NOTE this does not match the built-in DataTables filtering which does it
 * word by word on any field. It's possible to do here, but concerned about efficiency
 * on very large tables, and MySQL's regex functionality is very limited
 */

//$sWhere = "";
if (isset($_GET['sSearch']) && $_GET['sSearch'] != "") {
     //$sWhere = "WHERE (";
    if ($satker != '' AND $kodeKelompok != ''){
      $sWhere =" WHERE $status a.kodeSatker='$satker' AND a.kodeKelompok='$kodeKelompok' AND (";
    }

     for ($i = 0; $i < count($aColumns); $i++) {
          if (isset($_GET['bSearchable_' . $i]) && $_GET['bSearchable_' . $i] == "true") {
               $sWhere .= "" . $aColumns[$i] . " LIKE '%" . mysql_real_escape_string($_GET['sSearch']) . "%' OR ";
          }
     }
     $sWhere = substr_replace($sWhere, "", -3);
     $sWhere .= ')';
     //pr($sWhere);
}

/*
 * SQL queries
 * Get data to display
 */
//echo $sWhere;
     
$sQuery = "
    SELECT SQL_CALC_FOUND_ROWS " . str_replace(" , ", " ", implode(", ", $aColumns)) . "
    FROM   $sTable 
    INNER JOIN $sTable_inner_join_kelompok ON $cond_kelompok
    INNER JOIN $sTable_inner_join_kib ON $cond_kib
    $sWhere 
    $sOrder
    $sLimit
    ";
//echo $sQuery;
$rResult = $DBVAR->_fetch_array($sQuery, 1);

/* Data set length after filtering */
$sQuery = "
		SELECT FOUND_ROWS()
	";
$rResultFilterTotal = $DBVAR->query($sQuery);
$aResultFilterTotal =$DBVAR->fetch_array($rResultFilterTotal);
$iFilteredTotal = $aResultFilterTotal[0];

/* Total data set length */
if($satker != '' AND $kodeKelompok != ''){
  //pr("1");
  $sQuery = "
    SELECT COUNT(" . $sIndexColumn . ")
    FROM $sTable WHERE $status a.kodeSatker='$satker' 
    AND a.kodeKelompok='$kodeKelompok'";
}
/*$sQuery = "
		SELECT COUNT(`" . $sIndexColumn . "`)
		FROM   $sTable
	";*/
$rResultTotal = $DBVAR->query($sQuery);
$aResultTotal = $DBVAR->fetch_array($rResultTotal);
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

foreach ($rResult as $key => $aRow) {
    $row = array();

    $Aset_ID=$aRow['Aset_ID'];
    $noRegister=$aRow['noRegister'];
    $kodeKelompok=$aRow['kodeKelompok'];
    $Uraian = $aRow['Uraian'];
    $kodeSatker=$aRow['kodeSatker']; 
    $NamaSatker = $aRow['NamaSatker']; 
    $TglPerolehan=$aRow['TglPerolehan'];  
    $NilaiPerolehan=$aRow['NilaiPerolehan'];  
    $Info=$aRow['Info'];
    if($aRow['kondisi'] == 1){
      $kondisi = 'Baik';
    }elseif($aRow['kondisi'] == 2){
      $kondisi = 'Rusak Ringan';
    }elseif($aRow['kondisi'] == 3){
      $kondisi = 'Rusak Berat';
    }

    if($aRow['Merk']){
      $Merk = $aRow['Merk'];
    }else{
      $Merk = '-';
    }
    if($aRow['NoSeri']){
      $NoSeri = $aRow['NoSeri'];
    }else{
      $NoSeri = '-';
    }
    if($aRow['NoRangka']){
      $NoRangka = $aRow['NoRangka'];
    }else{
      $NoRangka = '-';
    } 
    
    if($aRow['NoSTNK']){
      $NoSTNK = $aRow['NoSTNK'];
    }else{
      $NoSTNK = '-';
    }
    if($tipeAset['0'] == '02'){
        $pilihan="<input type=\"button\" id=\"checkbox\"  "
            . " onclick=\"set_aset($Aset_ID)\""
            . " id=\"tanah_$tanah_id\""
             . "name=\"tanah_id$tanah_id\" value=\"ok\" > 
              <input type=\"hidden\" id='nilai_aset_id$Aset_ID' name='Aset_ID' value=\"$Aset_ID|$noRegister|$TglPerolehan|$NilaiPerolehan|$Info|$kodeSatker|$kodeKelompok|$aRow[kondisi]|$aRow[TglPembukuan]|$aRow[Merk]|$aRow[NoSeri]|$aRow[NoSTNK]|$aRow[NoRangka]\" >
             ";
    }else{
        $pilihan="<input type=\"button\" id=\"checkbox\"  "
            . " onclick=\"set_aset($Aset_ID)\""
            . " id=\"tanah_$tanah_id\""
             . "name=\"tanah_id$tanah_id\" value=\"ok\" > 
              <input type=\"hidden\" id='nilai_aset_id$Aset_ID' name='Aset_ID' value=\"$Aset_ID|$noRegister|$TglPerolehan|$NilaiPerolehan|$Info|$kodeSatker|$kodeKelompok|$aRow[kondisi]|$aRow[TglPembukuan]\" >
             ";
    }
    
      
    $row[]="<center>".$pilihan."</center>";
    $row[]="<center>".$noRegister."</center>";
    $row[]="$kodeKelompok <br/> $Uraian";
    $row[]=$TglPerolehan;
    $row[]=number_format($NilaiPerolehan);
    $row[]=$kondisi;
    $row[]=$Merk."/ ".$NoSeri." - ".$NoSTNK." / ".$NoRangka;
    $row[]=$Info;
    $output['aaData'][] = $row;
}

echo json_encode($output);

?>

