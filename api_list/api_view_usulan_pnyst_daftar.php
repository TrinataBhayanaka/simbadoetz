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
$aColumns = array('ua.Usulan_ID','ua.Aset_ID','a.kodeKelompok','a.noRegister','a.NilaiPerolehan','a.Tahun','a.Info','a.AkumulasiPenyusutan','a.PenyusutanPerTaun','ua.StatusPenetapan','ua.StatusKonfirmasi');
// $test = count($aColumns);
  
// echo $aColumns; 
/* Indexed column (used for fast and accurate table cardinality) */
$sIndexColumn = "ua.Usulan_ID";

/* DB table to use */
$sTable = "usulanaset as ua";
$sTable_inner_join_aset = "aset as a";
$cond_aset ="a.Aset_ID = ua.Aset_ID";

//variabel ajax
//parameter sql
$id_usulanPenetapan = $_GET['Usulan_ID'];

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
          $sOrder = "ORDER BY a.kodeKelompok,a.noRegister asc";
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

$sWhere=" WHERE ua.Usulan_ID in ({$id_usulanPenetapan}) ";


if (isset($_GET['sSearch']) && $_GET['sSearch'] != "") {
     $sWhere = "WHERE ua.Usulan_ID in ({$id_usulanPenetapan}) AND (";
	 for ($i = 0; $i < count($aColumns); $i++) {
          if (isset($_GET['bSearchable_' . $i]) && $_GET['bSearchable_' . $i] == "true") {
               $sWhere .= "" . $aColumns[$i] . " LIKE '%" . mysql_real_escape_string($_GET['sSearch']) . "%' OR ";
          }
     }
     $sWhere = substr_replace($sWhere, "", -3);
     $sWhere .= ')';
}

// echo $sWhere;

/*
 * SQL queries
 * Get data to display
 */
$sQuery = "
		SELECT SQL_CALC_FOUND_ROWS " . str_replace(" , ", " ", implode(", ", $aColumns)) . "
			FROM   $sTable 
			INNER JOIN $sTable_inner_join_aset ON $cond_aset
		$sWhere	
		$sOrder
		$sLimit
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
		FROM   $sTable INNER JOIN $sTable_inner_join_aset ON $cond_aset $sWhere
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
$no=$_GET['iDisplayStart']+1;

//ini buat apluserlist
$PENYUSUTAN = new RETRIEVE_PENYUSUTAN;
$data_post=$PENYUSUTAN->apl_userasetlistHPS("VIEWUSULASET");
$POST=$PENYUSUTAN->apl_userasetlistHPS_filter($data_post);
// $POST['kirfilter']=$POST;

// pr($POST);
	if($POST){
		/*if($rResultGetDataApluserlist){
			  $data[]=$POST;
		}else{*/
			foreach ($rResultGetDataApluserlist as $key => $value) {
				if(!in_array($value['Aset_ID'], $POST)){
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
		 // $noReg = sprintf("%04s", $row->noRegister);
		$row = array();
		$id =  $aRow['Aset_ID'];
		$Kd_Kelompok = $aRow['kodeKelompok'];
		if($Kd_Kelompok !=''){
			$queryKelompok = "select Uraian from kelompok where kode ='$Kd_Kelompok' ";
			// pr($queryTipe);
			$exequeryKelompok = $DBVAR->query($queryKelompok);
			$GetDataKelompok = $DBVAR->fetch_array($exequeryKelompok);
			$Uraian = $GetDataKelompok['Uraian'];
		}	
		
		//cek merk by tipe aset
		if($TipeAset == 'B'){
			$queryTipe = "select Merk from mesin where kodeSatker ='$Satker_ID' and Aset_ID = '$id' limit 1";
			// pr($queryTipe);
			$exequeryTipe = $DBVAR->query($queryTipe);
			$GetDataTipe = $DBVAR->fetch_array($exequeryTipe);
			// pr($GetDataTipe);
			$Merk = $GetDataTipe['Merk'];
		}else{
			$Merk = "";
		}
		
		$noRegister = $aRow['noRegister'];
		$NilaiPerolehan = $aRow['NilaiPerolehan'];
		$Tahun = $aRow['Tahun'];
		$Info = $aRow['Info'];
		$PenyusutanPerTaun = $aRow['PenyusutanPerTaun'];
		$AkumulasiPenyusutan = $aRow['AkumulasiPenyusutan'];
		if($AkumulasiPenyusutan === 'NULL' || $AkumulasiPenyusutan == 0 || $PenyusutanPerTaun === 'NULL' || $PenyusutanPerTaun == 0){
			$NilaiBuku = '';
		}else{
			$NilaiBuku = $NilaiPerolehan - $AkumulasiPenyusutan;
		}
		
		if(empty($aRow['StatusPenetapan']) && $aRow['StatusKonfirmasi'] == 0){
			$status = "<span class=\"label label-warning\">belum diproses</span>";
			$flag = '0';
		}elseif($aRow['StatusPenetapan'] == 1 && $aRow['StatusKonfirmasi'] ==0){
			$status = "<span class=\"label label-danger\">ditolak</span>";
			$flag = '1';
		}elseif($aRow['StatusPenetapan'] == 1 && $aRow['StatusKonfirmasi'] ==1){
			$status = "<span class=\"label label-success\">diterima</span>";
			$flag = '1';
		}
		if($flag == '1'){
			$checkbox = "";
		}else{
			$checkbox   = "<input type=\"checkbox\" class =\"icheck-input checkbox\" name=\"id_aset[]\" value=\"$id\" onchange=\"return AreAnyCheckboxesChecked();\" $aRow[checked]>";
		}
						 
		  $row[] ="<center>".$no."</center>";
		  $row[] ="<center>".$checkbox."</center>";
		  $row[] ="[".$Kd_Kelompok."]"."<br>".$Uraian;
		  $row[] =$Merk;
		  $row[] ="<center>".sprintf('%04s',$noRegister)."</center>";
		  $row[] ="<center>".number_format($NilaiPerolehan,2,",",".")."</center>";
		  $row[] ="<center>".$Tahun."</center>";
		  $row[] =$Info;
		  $row[] =$PenyusutanPerTaun;
		  $row[] =$AkumulasiPenyusutan;
		  $row[] =$NilaiBuku;
		  $row[] =$status;
		 
		  
		$no++;
		 $output['aaData'][] = $row;
	}
}
echo json_encode($output);

?>

