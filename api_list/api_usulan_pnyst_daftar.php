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
$aColumns = array('a.Aset_ID','a.kodeKelompok','k.Uraian','a.Tahun','a.Info','a.NilaiPerolehan','a.noRegister','a.PenyusutanPerTaun','a.AkumulasiPenyusutan','a.TipeAset','a.kodeSatker','a.StatusValidasi','a.Status_Validasi_Barang');
// $test = count($aColumns);
  
// echo $aColumns; 
/* Indexed column (used for fast and accurate table cardinality) */
$sIndexColumn = "a.Aset_ID";

/* DB table to use */
$sTable = "aset as a";
$sTable_inner_join_kelompok = "kelompok as k";
$cond_kelompok ="k.Kode = a.kodeKelompok ";
$status = "a.StatusValidasi = 1 AND a.Status_Validasi_Barang = 1 AND";

//variabel ajax
//param link
$flagPnystn 	= $_GET['flagPnystn'];
$Usulan_ID 		= $_GET['Usulan_ID'];
//parameter sql
$Satker_ID 		= $_GET['Satker_ID'];
$kodeKelompok	= $_GET['kodeKelompok'];
// pr($_GET);
$AddCondtn_1 = "";
$AddCondtn_2 = "";

//handler double filter or more Aset_ID 
$ceckAset_ID = "select Aset_ID from usulan where Usulan_ID = '{$Usulan_ID}'";
$exeCeckAset_ID = $DBVAR->fetch($ceckAset_ID,1);
$Aset_IDUsulan = $exeCeckAset_ID[0]['Aset_ID'];  
if($exeCeckAset_ID[0]['Aset_ID'] != ''){
	$QueryHandler = "AND a.Aset_ID NOT IN ($Aset_IDUsulan)";
}else{
	$QueryHandler = "";
}

// pr($exeCeckAset_ID);
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
          $sOrder = "ORDER BY Tahun asc";
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
//jika penyusutan tahun pertama
if ($flagPnystn == 1){
	//penyusutan tahun pertama dimulai tahun 2015
	$thnPenyusutan = '2015';
	
	$paramKelompok = explode('.',$kodeKelompok);
	//mesin
	if($paramKelompok[0] == '02'){
		$AddCondtn_1 = "AND a.kodeLokasi like '12%' AND a.kondisi !='3' AND a.kodeKA = '1'
						AND a.TglPerolehan >='0000-00-00' AND a.TglPerolehan < '2008-01-01'
						AND a.TglPembukuan >='0000-00-00' AND a.TglPembukuan <= '2014-12-31'";
		
		$AddCondtn_2 = "AND a.kodeLokasi like '12%' AND a.kondisi !='3' AND (a.NilaiPerolehan >=300000 OR kodeKA = '1') 
						AND a.TglPerolehan >='2008-01-01' AND a.TglPerolehan < '2014-12-31'
						AND a.TglPembukuan >='0000-00-00' AND a.TglPembukuan <= '2014-12-31'";
	//bangunan
	}elseif($paramKelompok[0] == '03'){
		$AddCondtn_1 = "AND a.kodeLokasi like '12%' AND a.kondisi !='3' AND a.kodeKA = '1'
						AND a.TglPerolehan >='0000-00-00' AND a.TglPerolehan < '2008-01-01'
						AND a.TglPembukuan >='0000-00-00' AND a.TglPembukuan <= '2014-12-31'";
		
		$AddCondtn_2 = "AND a.kodeLokasi like '12%' AND a.kondisi !='3' AND (a.NilaiPerolehan >=10000000 OR kodeKA = '1') 
						AND a.TglPerolehan >='2008-01-01' AND a.TglPerolehan < '2014-12-31'
						AND a.TglPembukuan >='0000-00-00' AND a.TglPembukuan <= '2014-12-31'";
	//jaringan
	}elseif($paramKelompok[0] == '04'){
		$AddCondtn_1 = "AND a.kodeLokasi like '12%' AND a.kondisi !='3'
						AND a.TglPerolehan <= '2014-12-31'
						AND a.TglPembukuan <= '2014-12-31'";
		
		$AddCondtn_2 = "";
	}

	if ($Satker_ID != '' AND $kodeKelompok != '' ){
		
		
		$sWhere=" WHERE $status a.AkumulasiPenyusutan IS NULL AND a.PenyusutanPerTaun IS NULL  
			  AND a.kodeSatker='$Satker_ID' AND a.kodeKelompok like '$kodeKelompok%' ";
	}
}else{
	if ($Satker_ID != '' AND $kodeKelompok != '' ){
		$paramTahun = date('Y') - 1;
		$paramKelompok = explode('.',$kodeKelompok);
		//mesin
		if($paramKelompok[0] == '02'){
			$AddCondtn_1 = "AND a.kodeLokasi like '12%' AND a.kondisi !='3' AND a.kodeKA = '1'
							AND a.TglPerolehan >='0000-00-00' AND a.TglPerolehan < '2008-01-01'
							AND a.TglPembukuan >='0000-00-00' AND a.TglPembukuan <= '$paramTahun-12-31'";
			
			$AddCondtn_2 = "AND a.kodeLokasi like '12%' AND a.kondisi !='3' AND (a.NilaiPerolehan >=300000 OR kodeKA = '1') 
							AND a.TglPerolehan >='2008-01-01' AND a.TglPerolehan < '$paramTahun-12-31'
							AND a.TglPembukuan >='0000-00-00' AND a.TglPembukuan <= '$paramTahun-12-31'";
		//bangunan
		}elseif($paramKelompok[0] == '03'){
			$AddCondtn_1 = "AND a.kodeLokasi like '12%' AND a.kondisi !='3' AND a.kodeKA = '1'
							AND a.TglPerolehan >='0000-00-00' AND a.TglPerolehan < '2008-01-01'
							AND a.TglPembukuan >='0000-00-00' AND a.TglPembukuan <= '$paramTahun-12-31'";
			
			$AddCondtn_2 = "AND a.kodeLokasi like '12%' AND a.kondisi !='3' AND (a.NilaiPerolehan >=10000000 OR kodeKA = '1') 
							AND a.TglPerolehan >='2008-01-01' AND a.TglPerolehan < '$paramTahun-12-31'
							AND a.TglPembukuan >='0000-00-00' AND a.TglPembukuan <= '$paramTahun-12-31'";
		//jaringan
		}elseif($paramKelompok[0] == '04'){
			$AddCondtn_1 = "AND a.kodeLokasi like '12%' AND a.kondisi !='3'
							AND a.TglPerolehan <= '$paramTahun-12-31'
							AND a.TglPembukuan <= '$paramTahun-12-31'";
			
			$AddCondtn_2 = "";
		}
		
		$sWhere=" WHERE $status a.AkumulasiPenyusutan IS NOT NULL AND a.PenyusutanPerTaun IS NOT NULL  
			  AND a.kodeSatker='$Satker_ID' AND a.kodeKelompok like '$kodeKelompok%'";
			  
			  
	}
}


if (isset($_GET['sSearch']) && $_GET['sSearch'] != "") {
     //$sWhere = "WHERE (";
	 if ($flagPnystn == 1){
			//penyusutan tahun pertama dimulai tahun 2015
		$thnPenyusutan = '2015';

		if ($Satker_ID != '' AND $kodeKelompok != '' ){
			$sWhere=" WHERE $status a.AkumulasiPenyusutan IS NULL AND a.PenyusutanPerTaun IS NULL  
				  AND a.kodeSatker='$Satker_ID' AND a.kodeKelompok like '$kodeKelompok%' AND(";
		}
		
	}else{
		if ($Satker_ID != '' AND $kodeKelompok != '' ){
			$sWhere=" WHERE $status a.AkumulasiPenyusutan IS NOT NULL AND a.PenyusutanPerTaun IS NOT NULL  
				  AND a.kodeSatker='$Satker_ID' AND a.kodeKelompok like '$kodeKelompok%' AND(";
		}
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
$fieldCustom = str_replace(" , ", " ", implode(", ", $aColumns));
if($paramKelompok[0] == '02' || $paramKelompok[0] == '03'){
	$sQuery = "
		SELECT $fieldCustom
			FROM   $sTable 
			INNER JOIN $sTable_inner_join_kelompok ON $cond_kelompok
			$sWhere
			$AddCondtn_1 $QueryHandler
		UNION ALL
			SELECT $fieldCustom
			FROM   $sTable 
			INNER JOIN $sTable_inner_join_kelompok ON $cond_kelompok
			$sWhere
			$AddCondtn_2 $QueryHandler
		$sOrder
		$sLimit
		";
}elseif($paramKelompok[0] == '04'){
	$sQuery = "
		SELECT $fieldCustom
			FROM   $sTable 
			INNER JOIN $sTable_inner_join_kelompok ON $cond_kelompok
			$sWhere
			$AddCondtn_1 $QueryHandler
		$sOrder
		$sLimit
		";
}


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
if ($Satker_ID != '' AND $kodeKelompok != '' ){
	/*$sQuery = "
		SELECT COUNT(" . $sIndexColumn . ")
		FROM   $sTable 
		WHERE $status ";*/
		
		if($paramKelompok[0] == '02' || $paramKelompok[0] == '03'){
	$sQuery = "
		SELECT COUNT(" . $sIndexColumn . ") as jml
			FROM   $sTable 
			INNER JOIN $sTable_inner_join_kelompok ON $cond_kelompok
			$sWhere
			$AddCondtn_1 $QueryHandler
		UNION ALL
			SELECT COUNT(" . $sIndexColumn . ") as jml
			FROM   $sTable 
			INNER JOIN $sTable_inner_join_kelompok ON $cond_kelompok
			$sWhere
			$AddCondtn_2 $QueryHandler
		";
	}elseif($paramKelompok[0] == '04'){
		$sQuery = "
			SELECT COUNT(" . $sIndexColumn . ") as jml
				FROM   $sTable 
				INNER JOIN $sTable_inner_join_kelompok ON $cond_kelompok
				$sWhere
				$AddCondtn_1 $QueryHandler
			";
	}
}
// echo $sQuery;
$rResultTotal = $DBVAR->query($sQuery) or fatal_error('MySQL Error: ' . mysql_errno());
$jmlData = "";
while($aResultTotal = $DBVAR->fetch_array($rResultTotal)){
	$jmlData = $jmlData + $aResultTotal['jml'];
}
$iTotal = $jmlData;


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
$data_post=$PENYUSUTAN->apl_userasetlistHPS("USULASET");
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
		$Uraian = $aRow['Uraian'];
		
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
		
		$checkbox   = "<input type=\"checkbox\" class =\"icheck-input checkbox\" name=\"id_aset[]\" value=\"$id\" onchange=\"return AreAnyCheckboxesChecked();\" $aRow[checked]>";
						 
		  $row[] ="<center>".$no."</center>";
		  $row[] ="<center>".$checkbox."</center>";
		  $row[] ="[".$Kd_Kelompok."]"."<br>".$Uraian;
		  $row[] =$Merk;
		  $row[] ="<center>".sprintf('%04s',$noRegister)."</center>";
		  $row[] ="<center>".number_format($NilaiPerolehan,2,",",".")."</center>";
		  $row[] ="<center>".$Tahun."</center>";
		  $row[] =$Info;
		  $row[] ="<center>".number_format($PenyusutanPerTaun,2,",",".")."</center>";
		  $row[] ="<center>".number_format($AkumulasiPenyusutan,2,",",".")."</center>";
		  $row[] ="<center>".number_format($NilaiBuku,2,",",".")."</center>";
		 
		  
		$no++;
		 $output['aaData'][] = $row;
	}
}
echo json_encode($output);

?>

