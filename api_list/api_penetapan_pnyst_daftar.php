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
$Penyusutan_ID = $_GET['Penyusutan_ID'];
$Satker_ID = $_GET['Satker_ID'];
/*echo 'usernm ='.$usernm; 
echo '<br>';
echo 'akses ='.$akses;*/ 

$aColumns = array('Usulan_ID','NoUsulan','SatkerUsul','TglUpdate','KetUsulan','Aset_ID');

/* Indexed column (used for fast and accurate table cardinality) */
$sIndexColumn = "Usulan_ID";

/* DB table to use */
$sTable = "Usulan";

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
          $sOrder = "ORDER BY Usulan_ID desc";
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
	$sWhere = "WHERE Jenis_Usulan = 'PNY' AND SatkerUsul ='{$Satker_ID}'";
}else{
	$sWhere = "WHERE UserNM ={$usernm} AND Jenis_Usulan = 'PNY' AND SatkerUsul ='{$Satker_ID}'";
}
// ECHO $sWhere;
if (isset($_GET['sSearch']) && $_GET['sSearch'] != "") {
	if ($akses == 1){
		$sWhere = "WHERE Jenis_Usulan = 'PNY' AND SatkerUsul ='{$Satker_ID}' AND(";
	}else{
		$sWhere = "WHERE UserNM ={$usernm} AND Jenis_Usulan = 'PNY' AND SatkerUsul ='{$Satker_ID}' AND(";
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
		FROM   $sTable 
		$sWhere
		$sOrder
		$sLimit
		";
// echo $sQuery;
 		
$rResultGetDataApluserlist = $DBVAR->fetch($sQuery,1);
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
		SELECT COUNT(`" . $sIndexColumn . "`)
		FROM   $sTable $sWhere
	";

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

//ini buat apluserlist
$PENYUSUTAN = new RETRIEVE_PENYUSUTAN;
$data_post=$PENYUSUTAN->apl_userasetlistHPS("PNTPNUSULASET");
// pr($data_post);
$POST=$PENYUSUTAN->apl_userasetlistHPS_filter($data_post);
// pr($POST);
// $POST['kirfilter']=$POST;

// pr($POST);
	if($POST){
			foreach ($rResultGetDataApluserlist as $key => $value) {
				if(!in_array($value['Usulan_ID'], $POST)){
				  $data[]=$value;
				  $data[$key]['checked']="";
				}else{
				  $data[]=$value;
				  $data[$key]['checked']="checked";
				}
		  }
			
		// }
    }else{
		$data=$rResultGetDataApluserlist;
	
	}
	
if (!empty($data)){
	foreach ($data as $key => $aRow)
	{
		
		// pr($aRow);
		//DAFTAR FIELD
		$row = array();
		$NamaSatker=$PENYUSUTAN->getNamaSatker($aRow[SatkerUsul]);
		$id=$aRow[Usulan_ID];
		// pr($NamaSatker);
		      // pr($totalNilaiPerolehan);
		 if(!empty($aRow[Aset_ID])){
			$jmlh=explode(",", $aRow[Aset_ID]);
			$jumlahAset=count($jmlh);
		 }else{
			$jumlahAset=0;
		 }			
		  $change=$aRow[TglUpdate]; 
		  $change2=  format_tanggal_db3($change); 
		  // echo "$change2";
                
		 $NoUsulan=$aRow['NoUsulan'];

		 $checkbox   = "<input type=\"checkbox\" class =\"icheck-input checkbox\" name=\"id_usulanPenetapan[]\" value=\"$id\" onchange=\"return AreAnyCheckboxesChecked();\" $aRow[checked]>";
						 
		 $row[] ="<center>".$no."</center>";
		 $row[] ="<center>".$checkbox."</center>";
		 $row[]=$NoUsulan;
		 $row[]="<center>".$jumlahAset."</center>";
		 $row[]=$change2;
		 $row[]=$aRow[KetUsulan];
		 
		  
		$no++;
		 $output['aaData'][] = $row;
	}
}	  
echo json_encode($output);

?>

