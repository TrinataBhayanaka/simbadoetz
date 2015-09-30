<?php
ob_start();
include "../config/config.php";

$id=$_SESSION['user_id'];//Nanti diganti
// echo  $id;
// echo "masukkkkkk";
// exit;
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
 /*SELECT a.Aset_ID,a.kodeKelompok,pr.kodeSatker,a.Tahun,k.Uraian,s.NamaSatker from aset a 
 inner join kelompok as k on k.Kode = a.kodeKelompok 
 inner join satker as s on s.kode = pr.kodeSatker 
 where a.tahun = '2014' and pr.kodeSatker = '01.01.01.01' and a.kodekelompok like '02%' limit 1 */
 
 // echo "masuk aja dulu";
 // pr($_GET);
 // exit;
$aColumns = array('pr.PemeliharaanAset_ID,pr.Aset_ID,pr.JenisPemeliharaan','pr.Biaya','pr.keterangan');
$test = count($aColumns);
  
// echo $aColumns; 
/* Indexed column (used for fast and accurate table cardinality) */
$sIndexColumn = "pr.PemeliharaanAset_ID";

/* DB table to use */
$sTable = "pemeliharaan_aset as pr";
// pr($_GET);
//variabel ajax
$Aset_ID 		= $_GET['Aset_ID'];
$PmlhrnID 		= $_GET['PmlhrnID'];
$tahun			= $_GET['tahun'];
$satker			= $_GET['satker'];
$kodeKelompok   = $_GET['kodeKelompok'];
$tipeAset  		= $_GET['tipeAset'];
$Reg_aw  		= $_GET['Reg_aw'];
$Reg_ak  		= $_GET['Reg_ak'];
// echo $tahun;
$par_data_table="Aset_ID={$Aset_ID}&PmlhrnID={$PmlhrnID}";
$add_param_filter="tahun={$tahun}&satker={$satker}&kodeKelompok={$kodeKelompok}&tipeAset={$tipeAset}&Reg_aw={$Reg_aw}&Reg_ak={$Reg_ak}";
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

if ($Aset_ID  != ''  ){
	$sWhere=" WHERE pr.Aset_ID ='$Aset_ID' ";
}

if (isset($_GET['sSearch']) && $_GET['sSearch'] != "") {
     //$sWhere = "WHERE (";
	 if ($Aset_ID  != ''  ){
		$sWhere=" WHERE pr.Aset_ID ='$Aset_ID'  AND (";
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
               $sWhere = "WHERE pr.Aset_ID ='$Aset_ID' ";
          } else {
               $sWhere .= " AND pr.Aset_ID ='$Aset_ID' ";
          }
          $sWhere .= "" . $aColumns[$i] . " LIKE '%" . mysql_real_escape_string($_GET['sSearch_' . $i]) . "%' ";
     }
}
// echo $sWhere;

/*
 * SQL queries
 * Get data to display
 */
 /*SELECT a.Aset_ID,a.kodeKelompok,pr.kodeSatker,a.Tahun,k.Uraian,s.NamaSatker from aset a 
 inner join kelompok as k on k.Kode = a.kodeKelompok 
 inner join satker as s on s.kode = pr.kodeSatker 
 where a.tahun = '2014' and pr.kodeSatker = '01.01.01.01' and a.kodekelompok like '02%' limit 1 */
 
 

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
if($kodeKelompok != '' && $reg_aw  != '' && $reg_ak  != ''){
	$sQuery = "
		SELECT COUNT(" . $sIndexColumn . ")
		FROM   $sTable 
		$sWhere ";
}
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
while ($aRow = $DBVAR->fetch_array($rResult)) {
		// pr($aRow);
		//DAFTAR FIELD 'pr.kodeRekening','pr.HargaSatuan','pr.UraianPemeliharaan','pr.Lokasi','pr.keketerangan'
		$row = array();
		$prId =  $aRow['PemeliharaanAset_ID'];
		$Aset_ID = $aRow['Aset_ID'];
		// $TipeAset = $aRow['TipeAset'];
		$JenisPemeliharaan = $aRow['JenisPemeliharaan'];
		$Biaya = $aRow['Biaya'];
		$keterangan = $aRow['keterangan'];
		
		//get kode kelompok,Uraian,noRegister
		$queryData = "select a.kodeKelompok,k.Uraian,a.noRegister,a.TipeAset,a.kodeSatker from aset as a 
					inner join kelompok as k ON k.Kode = a.kodeKelompok
					where a.Aset_ID = '$Aset_ID' limit 1";
		// echo $queryData;			
		$exequeryData = $DBVAR->query($queryData);
		$GetData = $DBVAR->fetch_array($exequeryData);			
		$kodeKelompok = $GetData['kodeKelompok'];		
		$Uraian = $GetData['Uraian'];		
		$noRegister = $GetData['noRegister'];
		$TipeAset = $GetData['TipeAset'];
		$kodeSatker = $GetData['kodeSatker'];
		//cek merk by tipe aset
		if($TipeAset == 'B'){
			$queryTipe = "select Merk from mesin where Aset_ID = '$Aset_ID' limit 1";
			// pr($queryTipe);
			$exequeryTipe = $DBVAR->query($queryTipe);
			$GetDataTipe = $DBVAR->fetch_array($exequeryTipe);
			// pr($GetDataTipe);
			$Merk = $GetDataTipe['Merk'];
		}else{
			$Merk = "";
		}
		
		 $identity = "id=$prId";
		 $addUrl = encode($identity);
		 $addUrlScnd = encode($par_data_table);
		 $filterUrl = encode($add_param_filter);
		 $skUrl = encode($kodeSatker);
		  $edit ="<center><a href=\"pemeliharaan_edit_rincian.php?url=$addUrl&surl=$addUrlScnd&turl=$filterUrl&skUrl=$skUrl\" class=\"btn btn-warning btn-small\">
			<i class=\"fa fa-pencil\" align=\"center\"></i>&nbsp;&nbsp;Edit</a></center>";
		
		  $hapus="<center><a onclick=\"return confirm('Hapus Data?')\" href=\"pemeliharaan_hapus_rincian_proses.php?url=$addUrl&surl=$addUrlScnd&turl=$filterUrl&skUrl=$skUrl\" class=\"btn btn-danger btn-circle\">
			<i class=\"fa fa-trash simbol\">&nbsp;Hapus</i></a></center>"; 
			
		  
					
		  $row[] ="<center>".$no."</center>";
		  $row[] ="[".$kodeKelompok."]"."<br>".$Uraian;
		  $row[] =$Merk;
		  $row[] ="<center>".sprintf('%04s',$noRegister)."</center>";
		  $row[] ="<center>".number_format($Biaya,2,",",".")."</center>";
		  $row[] =$JenisPemeliharaan;
		  $row[] =$keterangan;
		  $row[] =$edit."&nbsp;".$hapus;
		  
		  
		  
		$no++;
		 $output['aaData'][] = $row;
	}
echo json_encode($output);

?>

