<?php
ob_start();
include "../config/config.php";

$id=$_SESSION['user_id'];//Nanti diganti
// echo  $id;
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

$aColumns = array('Satker_ID','Tahun','Kd_Ruang','NamaSatker','kode');
$test = count($aColumns);
  
// echo $aColumns; 
/* Indexed column (used for fast and accurate table cardinality) */
$sIndexColumn = "Satker_ID";

/* DB table to use */
$sTable = "satker";
// $sTable_inner = "strukturorganisasi p2";
// $sTable_left_join ="provinsi p3";
// $cond ="unit = P2.unit AND sub_unit = p2.sub_unit AND sub_subunit = p2.sub_subunit";
// $cond_left ="id_provinsi = p3.id_provinsi";

//variabel ajax
$tahun=$_GET['tahun'];
$satker=$_GET['satker'];

// echo $tahun;
/* REMOVE THIS LINE (it just includes my SQL connection user/pass) */
//include( $_SERVER['DOCUMENT_ROOT'] . "/datatables/mysql.php" );


/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * If you just want to use the basic configuration for DataTables with PHP server-side, there is
 * no need to edit below this line
 */

/*
 * Local functions
 */

function fatal_error($sErrorMessage = '') {
     header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error');
     
     die(mysql_error());
}

/*
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
               $sOrder .= "" . $aColumns[intval($_GET['iSortCol_' . $i])] . " " .
                       ($_GET['sSortDir_' . $i] === 'asc' ? 'asc' : 'desc') . ", ";
          }
     }

     $sOrder = substr_replace($sOrder, "", -2);
     if ($sOrder == "ORDER BY") {
          $sOrder = "";
     }
}
// ECHO $sOrder;

/*
 * Filtering
 * NOTE this does not match the built-in DataTables filtering which does it
 * word by word on any field. It's possible to do here, but concerned about efficiency
 * on very large tables, and MySQL's regex functionality is very limited
 */
$sWhere = "";

if ($satker != '' AND $tahun != ''){
	$sWhere=" WHERE tahun='$tahun' AND kode='$satker'";
}
elseif(($satker == '' AND $tahun =='')){
	$sWhere=" WHERE Kd_Ruang != 0 AND Kd_Ruang is not null";
}
elseif ($satker != '' OR $tahun == ''){
	$sWhere=" WHERE kode='$satker' AND Kd_Ruang != 0 AND Kd_Ruang is not null";
}
elseif ($satker == '' OR $tahun !=''){
	$sWhere=" WHERE tahun='$tahun' AND Kd_Ruang != 0 AND Kd_Ruang is not null";
}

if (isset($_GET['sSearch']) && $_GET['sSearch'] != "") {
     //$sWhere = "WHERE (";
	 if ($satker != '' AND $tahun != ''){
	$sWhere=" WHERE tahun='$tahun' AND kode='$satker' AND (";
	}
	elseif(($satker == '' AND $tahun =='')){
		$sWhere=" WHERE Kd_Ruang != 0 AND Kd_Ruang is not null AND (";
	}
	elseif ($satker != '' OR $tahun == ''){
		$sWhere=" WHERE kode='$satker' AND Kd_Ruang != 0 AND Kd_Ruang is not null AND (";
	}
	elseif ($satker == '' OR $tahun !=''){
		$sWhere=" WHERE tahun='$tahun' AND Kd_Ruang != 0 AND Kd_Ruang is not null AND (";
	}
     // $sWhere.="(";
     for ($i = 0; $i < count($aColumns); $i++) {
          if (isset($_GET['bSearchable_' . $i]) && $_GET['bSearchable_' . $i] == "true") {
               $sWhere .= "" . $aColumns[$i] . " LIKE '%" . mysql_real_escape_string($_GET['sSearch']) . "%' OR ";
          }
     }
     $sWhere = substr_replace($sWhere, "", -3);
     $sWhere .= ')';
}

/* Individual column filtering */
for ($i = 0; $i < count($aColumns); $i++) {
     if (isset($_GET['bSearchable_' . $i]) && $_GET['bSearchable_' . $i] == "true" && $_GET['sSearch_' . $i] != '') {
          if ($sWhere == "") {
               $sWhere = "WHERE tahun='$tahun' AND kode='$satker'";
          } else {
               $sWhere .= " AND Kd_Ruang != 0 AND Kd_Ruang is not null";
          }
          $sWhere .= "" . $aColumns[$i] . " LIKE '%" . mysql_real_escape_string($_GET['sSearch_' . $i]) . "%' ";
     }
}
// echo $sWhere;

/*
 * SQL queries
 * Get data to display
 */
$sQuery = "
		SELECT SQL_CALC_FOUND_ROWS " . str_replace(" , ", " ", implode(", ", $aColumns)) . "
		FROM   $sTable 
		$sWhere
		$sOrder
		$sLimit
		";
// echo $sQuery;
$rResult = $DBVAR->query($sQuery) or fatal_error('MySQL Error: ' . mysql_errno());

/* Data set length after filtering */
$sQuery = "
		SELECT FOUND_ROWS()
	";
// echo $sQuery;
$rResultFilterTotal = $DBVAR->query($sQuery) or fatal_error('MySQL Error: ' . mysql_errno());
$aResultFilterTotal = $DBVAR->fetch_array($rResultFilterTotal);
$iFilteredTotal = $aResultFilterTotal[0];

/* Total data set length */
$sQuery = "
		SELECT COUNT(" . $sIndexColumn . ")
		FROM   $sTable WHERE Kd_Ruang != 0 AND Kd_Ruang is not null AND 
		tahun='$tahun' AND kode='$satker'
	";
	// 	echo $sQuery;
$rResultTotal = $DBVAR->query($sQuery) or fatal_error('MySQL Error: ' . mysql_errno());
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
$no=$_GET['iDisplayStart']+1;

while ($aRow = $DBVAR->fetch_array($rResult)) {
    
	//DAFTAR FIELD
	 // array('Satker_ID','Tahun','Kd_Ruang','NamaSatker')
	$row = array();
	$id =  $aRow['Satker_ID'];
    $Tahun = $aRow['Tahun'];
    $Kd_Ruang = $aRow['Kd_Ruang'];
    $Kd_Satker = $aRow['kode'];
	$NamaSatker = $aRow['NamaSatker'];
	
	/*$rincian ="<center><a href=\"filterDetailKir.php?kdS=$Kd_Satker&kdR=$Kd_Ruang&thn=$Tahun\" class=\"btn btn-info btn-small\">
			<i class=\"icon-plus icon-white\"></i>&nbsp;Rincian
			</a></center>";*/
	
	$view ="<center><a href=\"dftr_ruangan_kir_detail.php?kdS=$Kd_Satker&kdR=$Kd_Ruang&thn=$Tahun\" class=\"btn btn-warning\">
			<i class=\"fa fa-eye\"></i>&nbsp;Rincian
			</a></center>";
		
	  $row[] ="<center>".$no."</center>";
	  $row[] ="<center>".$Tahun."</center>";
      $row[] =$Kd_Ruang."&nbsp;".$NamaSatker;
	  $row[] =$view;
	  // $row[] =$rincian."&nbsp;".$view;
	  // $row[] =$rincian."&nbsp;".$view;
      
	$no++;
     $output['aaData'][] = $row;
}

echo json_encode($output);

?>

