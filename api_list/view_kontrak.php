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
 /*SELECT a.Aset_ID,a.kodeKelompok,a.kodeSatker,a.Tahun,k.Uraian,s.NamaSatker from aset a 
 inner join kelompok as k on k.Kode = a.kodeKelompok 
 inner join satker as s on s.kode = a.kodeSatker 
 where a.tahun = '2014' and a.kodeSatker = '01.01.01.01' and a.kodekelompok like '02%' limit 1 */
 
 // echo "masuk aja dulu";
 // pr($_GET);
 // exit;
$aColumns = array('id','noKontrak','kodeSatker','tglKontrak',
				 'tipeAset','tipe_kontrak','nilai','n_status');
$test = count($aColumns);
  
// echo $aColumns; 
/* Indexed column (used for fast and accurate table cardinality) */
$sIndexColumn = "id";

/* DB table to use */
$sTable = "kontrak";
// $sTable_inner_join_kelompok = "satker as k";
// $cond_kelompok ="k.kode = a.kodeSatker AND Kd_Ruang IS NULL";

$kodeSatker 		= $_GET['kodeSatker'];
$jabatan			= $_GET['jabatan'];


	if($kodeSatker != "") $condtn = "kodeSatker LIKE '$kodeSatker' "; else $condtn = "1";



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
          $sOrder = "ORDER BY tglKontrak";
          // $sOrder = "";
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
if (isset($_GET['sSearch']) && $_GET['sSearch'] != "") {
     //$sWhere = "WHERE (";
     $sWhere ="WHERE (";
     for ($i = 0; $i < count($aColumns); $i++) {
          if (isset($_GET['bSearchable_' . $i]) && $_GET['bSearchable_' . $i] == "true") {
               $sWhere .= "" . $aColumns[$i] . " LIKE '%" . mysql_real_escape_string($_GET['sSearch']) . "%' OR ";
          }
     }
     $sWhere = substr_replace($sWhere, "", -3);
     $sWhere .= ')';
} else {
	$sWhere = "WHERE ".$condtn;
}

/* Individual column filtering */
for ($i = 0; $i < count($aColumns); $i++) {
     if (isset($_GET['bSearchable_' . $i]) && $_GET['bSearchable_' . $i] == "true" && $_GET['sSearch_' . $i] != '') {
          if ($sWhere == "") {
        //       $sWhere = "WHERE ";
               $tidakdipakai=0;
          } else {
               $sWhere .= " AND ";
          }
          $sWhere .= "`" . $aColumns[$i] . "` LIKE '%" . mysql_real_escape_string($_GET['sSearch_' . $i]) . "%' ";
     }
}

// if($sWhere != "") $where = "WHERE ".$sWhere; else $where = "";
/*
 * SQL queries
 * Get data to display
 */

$sQuery = "
		SELECT SQL_CALC_FOUND_ROWS " . str_replace(" , ", " ", implode(", ", $aColumns)) . "
		FROM   {$sTable} 
		{$sWhere}
		{$sOrder}
		{$sLimit}
		";
// echo $sQuery;

// $rResult = $DBVAR->query($sQuery) or fatal_error('MySQL Error: ' . mysql_errno());
//get data all
$rResultGetDataApluserlist = $DBVAR->fetch($sQuery,1);
// pr($rResultGetDataApluserlist);


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
		FROM   $sTable $sWhere";

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


	
		$data=$rResultGetDataApluserlist;
	
	
if (!empty($data)){
	foreach ($data as $key => $aRow)
	{
		$row = array();
		$sql = "SELECT NamaSatker FROM satker WHERE kode = '{$aRow['kodeSatker']}' AND Kd_Ruang IS NULL";
		$exec = $DBVAR->query($sql) or fatal_error('MySQL Error: ' . mysql_errno());
		$NamaSatker = $DBVAR->fetch_array($exec);
		
		$noKontrak = $aRow['noKontrak'];
		$tglKontrak = $aRow['tglKontrak'];
		$nilai = $aRow['nilai'];
		if($aRow['tipeAset'] == 1) $tipeAset = 'Aset Baru';
        elseif ($aRow['tipeAset'] == 2) $tipeAset = 'Kapitalisasi';
        elseif ($aRow['tipeAset'] == 3) $tipeAset = 'Perubahan Status';

        if($aRow['tipe_kontrak'] == 1) {
        	$jenisKontrak = 'Kontrak';
        	$link = "kontrakedit";
        }
        elseif ($aRow['tipe_kontrak'] == 2) {
        	$jenisKontrak = 'Pembelian Langsung';
        	$link = "pledit";
        }

		if($aRow['n_status'] != 1)
		{
			$edit = "<a href=\"{$link}.php?id={$aRow['id']}\" class=\"btn btn-warning btn-small\"><i class=\"icon-edit icon-white\"></i>&nbsp;Ubah</a>";
			$del = "<a href=\"kontrakhapus.php?id={$aRow['id']}\" class=\"btn btn-danger btn-small\"><i class=\"icon-trash icon-white\"></i>&nbsp;Hapus</a>";
			$act = "";
		} else 
		{
			$edit = "";
			$del = "";
			$act = "<span class='label label-Success'>Sudah di posting</span>";
		}
		
		
		
		  $row[] ="<center>".$no."</center>";
		  $row[] =$NamaSatker['NamaSatker'];
		  $row[] =$noKontrak;
		  $row[] =$tglKontrak;
		  $row[] =$jenisKontrak;
		  $row[] =$tipeAset;
		  $row[] ="<center>".number_format($nilai,2)."</center>";
		  $row[] ="<center>".$edit." ".$del.$act."</center>";
		 
		  
		$no++;
		 $output['aaData'][] = $row;
	}
}
echo json_encode($output);

?>

