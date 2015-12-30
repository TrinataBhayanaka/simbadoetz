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
$aColumns = array('a.Aset_ID','a.kodeKelompok','k.Uraian','a.Tahun','a.kodeSatker',
				 'a.StatusValidasi','a.Status_Validasi_Barang','a.NilaiPerolehan','a.noRegister','a.kondisi','a.TipeAset');
$test = count($aColumns);
  
// echo $aColumns; 
/* Indexed column (used for fast and accurate table cardinality) */
$sIndexColumn = "a.Aset_ID";

/* DB table to use */
$sTable = "aset as a";
$sTable_inner_join_kelompok = "kelompok as k";
$cond_kelompok ="k.Kode = a.kodeKelompok ";

$kodeSatker 		= $_GET['kodeSatker'];
$kodeKelompok 		= $_GET['kodeKelompok'];
$Tahun 				= $_GET['Tahun'];
$noRegister_Akhir 	= $_GET['noRegister_Akhir'];
$tipeAset 			= $_GET['tipeAset'];
$kondisi 			= $_GET['kondisi'];

//variabel ajax
if($tipeAset == 'tanah'){
	$tipe = 'A';
}elseif($tipeAset == 'mesin'){
	$tipe = 'B';
}elseif($tipeAset == 'bangunan'){
	$tipe = 'C';
}elseif($tipeAset == 'jaringan'){
	$tipe = 'D';
}elseif($tipeAset == 'asetlain'){
	$tipe = 'E';
}elseif($tipeAset == 'kdp'){
	$tipe = 'F';
}

$status = "a.StatusValidasi = 1 AND a.Status_Validasi_Barang = 1 AND";
$condtn = "a.Tahun = '$Tahun' AND a.kodeSatker='$kodeSatker' AND A.kondisi = '$kondisi' AND ";
$condtn_tp_ast = "a.tipeAset like '$tipe%'";
$condtn_kd_klmp = "a.kodeKelompok='$kodeKelompok'";
$condtn_no_reg = "a.noRegister <='$noRegister_Akhir'";
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
          $sOrder = "ORDER BY a.kodeKelompok and a.noRegister";
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
if($kodeKelompok == '' && $noRegister_Akhir == '')
{
	$sWhere=" WHERE $status $condtn $condtn_tp_ast";
}elseif($kodeKelompok == '' && $noRegister_Akhir != ''){
	$sWhere=" WHERE $status $condtn $condtn_tp_ast AND $condtn_no_reg";
}elseif($kodeKelompok != '' && $noRegister_Akhir == ''){
	$sWhere=" WHERE $status $condtn $condtn_kd_klmp ";
}elseif($kodeKelompok != '' && $noRegister_Akhir != ''){
	$sWhere=" WHERE $status $condtn $condtn_kd_klmp AND $condtn_no_reg";
}

if (isset($_GET['sSearch']) && $_GET['sSearch'] != "") {
	if($kodeKelompok == '' && $noRegister_Akhir == '')
	{
		$sWhere=" WHERE $status $condtn $condtn_tp_ast AND (";
	}elseif($kodeKelompok == '' && $noRegister_Akhir != ''){
		$sWhere=" WHERE $status $condtn $condtn_tp_ast AND $condtn_no_reg AND (";
	}elseif($kodeKelompok != '' && $noRegister_Akhir == ''){
		$sWhere=" WHERE $status $condtn $condtn_kd_klmp AND (";
	}elseif($kodeKelompok != '' && $noRegister_Akhir != ''){
		$sWhere=" WHERE $status $condtn $condtn_kd_klmp AND $condtn_no_reg AND (";
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

// echo $sWhere;

/*
 * SQL queries
 * Get data to display
 */

$sQuery = "
		SELECT SQL_CALC_FOUND_ROWS " . str_replace(" , ", " ", implode(", ", $aColumns)) . "
		FROM   $sTable 
		INNER JOIN $sTable_inner_join_kelompok ON $cond_kelompok
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
	if($kodeKelompok == '' && $noRegister_Akhir == '')
	{
		$sWhere=" WHERE $status $condtn $condtn_tp_ast";
	}elseif($kodeKelompok == '' && $noRegister_Akhir != ''){
		$sWhere=" WHERE $status $condtn $condtn_tp_ast AND $condtn_no_reg";
	}elseif($kodeKelompok != '' && $noRegister_Akhir == ''){
		$sWhere=" WHERE $status $condtn $condtn_kd_klmp ";
	}elseif($kodeKelompok != '' && $noRegister_Akhir != ''){
		$sWhere=" WHERE $status $condtn $condtn_kd_klmp AND $condtn_no_reg";
	}
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

//ini buat apluserlist
$PENGHAPUSAN = new RETRIEVE_PENGHAPUSAN;
$data_post=$PENGHAPUSAN->apl_userasetlistHPS("UBAHKONDISI");
$POST=$PENGHAPUSAN->apl_userasetlistHPS_filter($data_post);
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
		$Tahun = $aRow['Tahun'];
		$Kd_Satker = $aRow['kodeSatker'];
		$NamaSatker = $aRow['NamaSatker'];
		$Kd_Kelompok = $aRow['kodeKelompok'];
		$Uraian = $aRow['Uraian'];
		$noRegister = $aRow['noRegister'];
		$NilaiPerolehan = $aRow['NilaiPerolehan'];
		$kodeRuangan = $aRow['kodeRuangan'];
		$TipeAset = $aRow['TipeAset'];
		//cek ruangan 
		if($kodeRuangan != ''){
			$queryRuangan = "select NamaSatker from satker where kode ='$Kd_Satker' and Tahun = '$tahunRuangan' and Kd_Ruang = '$kodeRuangan' limit 1";
			$exequeryRuangan = $DBVAR->query($queryRuangan);
			$GetData = $DBVAR->fetch_array($exequeryRuangan);
			$NamaRuangan = $GetData['NamaSatker'];
		}else{
			$NamaRuangan = "";
		}
		
		//cek merk by tipe aset
		if($TipeAset == 'B'){
			$queryTipe = "select Merk from mesin where kodeSatker ='$Kd_Satker' and Aset_ID = '$id' limit 1";
			// pr($queryTipe);
			$exequeryTipe = $DBVAR->query($queryTipe);
			$GetDataTipe = $DBVAR->fetch_array($exequeryTipe);
			// pr($GetDataTipe);
			$Merk = $GetDataTipe['Merk'];
		}else{
			$Merk = "";
		}
		
		if($aRow['kondisi'] == 1){
			$kondisi = "Baik";
		}elseif($aRow['kondisi'] == 2){
			$kondisi = "Rusak Ringan";
		}elseif($aRow['kondisi'] == 3){
			$kondisi = "Rusak Berat";
		}
		
		$checkbox   = "<input type=\"checkbox\" class =\"icheck-input checkbox\" name=\"id_aset[]\" value=\"$id\" onchange=\"return AreAnyCheckboxesChecked();\" $aRow[checked]>";
						 
		  $row[] ="<center>".$no."</center>";
		  $row[] ="<center>".$checkbox."</center>";
		  $row[] =$Kd_Kelompok;
		  $row[] =$Uraian;
		  $row[] =$Merk;
		  $row[] ="<center>".sprintf('%04s',$noRegister)."</center>";
		  $row[] ="<center>".number_format($NilaiPerolehan,2,",",".")."</center>";
		  $row[] ="<center>".$Tahun."</center>";
		  $row[] ="<center>".$kondisi."</center>";
		 
		  
		$no++;
		 $output['aaData'][] = $row;
	}
}
echo json_encode($output);

?>

