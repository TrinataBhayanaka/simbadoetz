<?php
ob_start();
include "../config/config.php";
$id=$_SESSION['user_id'];//Nanti diganti

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

$usernm = $_GET['usernm'];
$akses = $_GET['akses'];

/*echo 'usernm ='.$usernm; 
echo '<br>';
echo 'akses ='.$akses;*/ 

$aColumns = array('p.Penyusutan_ID','p.NoSKPenyusutan','p.SatkerUsul','p.TglPenyusutan','p.AlasanPenyusutan','p.Status','pp.StatusRunning','pp.Tahun');

/* Indexed column (used for fast and accurate table cardinality) */
$sIndexColumn = "p.Penyusutan_ID";

/* DB table to use */
$sTable = "penyusutan as p";
$sTable_inner_join = "penyusutan_pertahun as pp";
$cond ="pp.Penyusutan_ID = p.Penyusutan_ID";
$sLimit = "";
if (isset($_GET['iDisplayStart']) && $_GET['iDisplayLength'] != '-1') {
     $sLimit = "LIMIT " . intval($_GET['iDisplayStart']) . ", " .
             intval($_GET['iDisplayLength']);
}

$extCondt = "AND pp.StatusRunning != 3";
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
          $sOrder = "ORDER BY p.Penyusutan_ID desc";
     }
}


/*
 * Filtering
 * NOTE this does not match the built-in DataTables filtering which does it
 * word by word on any field. It's possible to do here, but concerned about efficiency
 * on very large tables, and MySQL's regex functionality is very limited
 */
$sWhere = "";
if ($akses == 1){
	$sWhere = "";
}else{
	$sWhere = "WHERE p.UserNM ={$usernm}";
}
if (isset($_GET['sSearch']) && $_GET['sSearch'] != "") {
     if ($akses == 1){
	$sWhere = "WHERE (";
}else{
	$sWhere = "WHERE p.UserNM ={$usernm} AND (";
}
	 for ($i = 0; $i < count($aColumns); $i++) {
          if (isset($_GET['bSearchable_' . $i]) && $_GET['bSearchable_' . $i] == "true") {
               $sWhere .= "" . $aColumns[$i] . " LIKE '%" . mysql_real_escape_string($_GET['sSearch']) . "%' OR ";
          }
     }
     $sWhere = substr_replace($sWhere, "", -3);
     $sWhere .= ')';
}

/*
 * SQL queries
 * Get data to display
 */

$sQuery = "
		SELECT SQL_CALC_FOUND_ROWS " . str_replace(" , ", " ", implode(", ", $aColumns)) . "
		FROM   $sTable INNER JOIN $sTable_inner_join ON $cond
		$sWhere $extCondt
		$sOrder
		$sLimit
		";
// echo $sQuery;
 		
$rResult = $DBVAR->query($sQuery);
// /* Data set length after filtering */
$sQuery = "
		SELECT FOUND_ROWS()
	";
$rResultFilterTotal = $DBVAR->query($sQuery) or fatal_error('MySQL Error: ' . mysql_errno());
$aResultFilterTotal = $DBVAR->fetch_array($rResultFilterTotal);
$iFilteredTotal = $aResultFilterTotal[0];

// echo $iFilteredTotal ;

/* Total data set length */
$sQuery = "
		SELECT COUNT(" . $sIndexColumn . ")
		FROM   $sTable INNER JOIN $sTable_inner_join ON $cond $sWhere $extCondt
	";
// echo $sQuery;
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

$PENYUSUTAN = new RETRIEVE_PENYUSUTAN;

$no=$_GET['iDisplayStart']+1;
while ($value = $DBVAR->fetch_array($rResult)) {
	// pr($value);
		$NamaSatker=$PENYUSUTAN->getNamaSatker($value['SatkerUsul']);
		$jumlahAset=$PENYUSUTAN->getJmlAset($value['Penyusutan_ID']);
		if($jumlahAset[0] == 0){
			$FixjmlAset = 0;
		}else{
			$FixjmlAset = $jumlahAset[0];
		}
		// pr($jumlahAset);
		  $change=$value['TglPenyusutan']; 
		  $change2=  format_tanggal_db3($change); 
		  // echo "$change2";
            
		  if($value['SatkerUsul']){ 
			$SatkerUsul="[".$value['SatkerUsul']."] ".$NamaSatker[0]['NamaSatker'];
		   // echo ;
		  }else{
			$SatkerUsul=$NamaSatker[0]['NamaSatker'];
		  }

		  if($value['StatusRunning']==0){
			  $label="warning";
			  $text="belum disusutkan";
			}elseif($value['StatusRunning']==1){
			  $label="info";
			  $text="sedang disusutkan";
			}elseif($value['StatusRunning']==2){
			  $label="success";
			  $text="selesai penyusutan";
			}else{
			  $label="info";
			  $text="batal disusutkan";
			}
			$tahunAktif = date('Y');
			// $message = $label."&nbsp".$text;	
		   $message = "<span class=\"label label-$label\">$text</span>";	
			
			if($value['StatusRunning']==0){
				if($_SESSION['ses_uaksesadmin'] == 1){	
					$tindakan="<a href=\"{$url_rewrite}/module/penyusutan/running_penyusutan_custome.php?idPenyusutan={$value[Penyusutan_ID]}\" class=\"btn btn-danger btn-small\"><i class=\"icon-plus-sign icon-white\"></i>&nbsp;Penyusutan</a>";
					
				}  
			}elseif($value['StatusRunning']==2){
				if($_SESSION['ses_uaksesadmin'] == 1){	
					if($tahunAktif == $value['Tahun']){
						$tindakan="<a href=\"{$url_rewrite}/module/penyusutan/running_penyusutan_batal.php?idPenyusutan={$value[Penyusutan_ID]}&satker={$value[SatkerUsul]}\" class=\"btn btn-danger btn-small\"><i class=\"fa fa-reply\"></i></i>&nbsp;Batal Penyusutan</a>";
					}
				}	
			}  
                
			$NoSKPenyusutan=explode("/", $value['NoSKPenyusutan']);

			$hasilNoSKPenyusutan=implode("/ ", $NoSKPenyusutan);
                
			 $row = array();
			 
			 $row[]=$no;
			 $row[]=$hasilNoSKPenyusutan ;
			 $row[]=$SatkerUsul;
			 $row[]="<center>".$FixjmlAset."</center>";
			 $row[]=$change2;
			 // $row[]=number_format($totalNilaiPerolehan[TotalNilaiPerolehan],4);
			 $row[]=$value['AlasanPenyusutan'];
			 $row[]=$value['Tahun'];
			 $row[]=$message;
			 $row[]=$tindakan;

	$no++;
     $output['aaData'][] = $row;
}
	  
echo json_encode($output);

?>

