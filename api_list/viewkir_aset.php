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
$tahun_aw 		= $_GET['tahun_aw'];
$tahun_ak 		= $_GET['tahun_ak'];
$reg_aw 		= $_GET['Reg_aw'];
$reg_ak 		= $_GET['Reg_ak'];
$satker 		= $_GET['satker'];
$kodeKelompok	= $_GET['kodeKelompok'];
$kodeLokasi		= $_GET['kodeLokasi'];
$tipeAset		= $_GET['tipeAset'];
$thnR			= $_GET['thnR'];
$kd_ruangan		= $_GET['ruangan'];
 // echo "masuk aja dulu";
 //pr($_GET);
 // exit;
 if($tipeAset == 'mesin'){
 	$aColumns = array('a.Aset_ID','a.kodeKelompok','k.Uraian','a.Tahun','a.kodeSatker',
				 'a.NilaiPerolehan','a.noRegister','kib.Merk','a.kodeLokasi',
				 'a.kodeRuangan','a.TipeAset','a.Status_Validasi_Barang',);
 	
 }else{
	$aColumns = array('a.Aset_ID','a.kodeKelompok','k.Uraian','a.Tahun','a.kodeSatker',
				 'a.kodeLokasi','a.NilaiPerolehan','a.noRegister','a.kodeRuangan','a.TipeAset','a.Status_Validasi_Barang');

 }
//$test = count($aColumns);
  
// echo $aColumns; 
/* Indexed column (used for fast and accurate table cardinality) */
$sIndexColumn = "a.Aset_ID";

/* DB table to use */
$sTable = "aset as a";
$sTable_inner_join_kelompok = "kelompok as k";
$cond_kelompok ="k.Kode = a.kodeKelompok ";
//$status = "a.StatusValidasi = 1 AND a.Status_Validasi_Barang = 1 AND";
$status = "a.Status_Validasi_Barang = 1 AND";
//variabel ajax

// pr($_GET);

if($tipeAset == 'tanah'){
	$tipe = '01';
	$sTable_inner_join_kib ="tanah as kib";
	$cond_kib ="kib.Aset_ID = a.Aset_ID";
}elseif($tipeAset == 'mesin'){
	$tipe = '02';
	$sTable_inner_join_kib ="mesin as kib";
	$cond_kib ="kib.Aset_ID = a.Aset_ID";
}elseif($tipeAset == 'bangunan'){
	$tipe = '03';
	$sTable_inner_join_kib ="bangunan as kib";
	$cond_kib ="kib.Aset_ID = a.Aset_ID";
}elseif($tipeAset == 'jaringan'){
	$tipe = '04';
	$sTable_inner_join_kib ="jaringan as kib";
	$cond_kib ="kib.Aset_ID = a.Aset_ID";
}elseif($tipeAset == 'asetlain'){
	$tipe = '05';
	$sTable_inner_join_kib ="asetlain as kib";
	$cond_kib ="kib.Aset_ID = a.Aset_ID";
}elseif($tipeAset == 'kdp'){
	$tipe = '06';
	$sTable_inner_join_kib ="kdp as kib";
	$cond_kib ="kib.Aset_ID = a.Aset_ID";
}

//handle untuk kir
if($kd_ruangan == ''){
	$tmp = array();
	$queryRuangan = "SELECT Kd_Ruang from satker where  Kd_Ruang is NOT null 
					AND kode = '{$satker}' AND Tahun ='{$thnR}'";
	//pr($queryRuangan);
	$res = $DBVAR->fetch($queryRuangan,1);
	foreach ($res as $key => $value) {
		# code...
		$tmp[] = $value['Kd_Ruang'];
	}
	//pr($tmp);
	$listRuangan = implode(',', $tmp);
	//pr($list);
}else{

}
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

if ($satker != '' AND $tahun_aw != '' AND $tahun_ak != ''  AND $tipeAset != '' AND $kodeKelompok != '' AND $reg_aw  != '' AND $reg_ak  != '' AND $kd_ruangan == 'all' 
	AND $kodeLokasi !=''){
	$sWhere=" WHERE $status a.Tahun >='$tahun_aw' AND a.Tahun <='$tahun_ak'  AND a.kodeSatker='$satker' AND a.kodeKelompok='$kodeKelompok' AND a.noRegister BETWEEN '$reg_aw' AND '$reg_ak' AND a.kodeLokasi LIKE '$kodeLokasi%'";
}
elseif($satker != '' AND $tahun_aw != '' AND $tahun_ak != '' AND $tipeAset != '' AND $kodeKelompok == '' AND $reg_aw  != '' AND $reg_ak  != '' AND $kd_ruangan == 'all' AND $kodeLokasi !=''){
	
	$sWhere=" WHERE $status a.Tahun >='$tahun_aw' AND a.Tahun <='$tahun_ak' AND a.kodeSatker='$satker' AND a.noRegister BETWEEN '$reg_aw' AND '$reg_ak' AND a.kodeKelompok like '$tipe%'
		AND a.kodeLokasi LIKE '$kodeLokasi%' ";
}
//yang lama
else if ($satker != '' AND $tahun_aw != '' AND $tahun_ak != ''  AND $tipeAset != '' AND $kodeKelompok != '' AND $reg_aw  != '' AND $reg_ak  != '' AND $kd_ruangan != ''
	AND $kodeLokasi !=''){
	$sWhere=" WHERE $status a.Tahun >='$tahun_aw' AND a.Tahun <='$tahun_ak'  AND a.kodeSatker='$satker' AND a.kodeKelompok='$kodeKelompok' AND a.noRegister BETWEEN '$reg_aw' AND '$reg_ak' AND kodeRuangan ='$kd_ruangan' AND a.kodeLokasi LIKE '$kodeLokasi%'";
}
elseif($satker != '' AND $tahun_aw != '' AND $tahun_ak != '' AND $tipeAset != '' AND $kodeKelompok != '' AND $reg_aw  != '' AND $reg_ak  != '' AND $kd_ruangan == '' AND $kodeLokasi !=''){
	$sWhere=" WHERE $status a.Tahun >='$tahun_aw' AND a.Tahun <='$tahun_ak'  AND a.kodeSatker='$satker' AND a.noRegister BETWEEN '$reg_aw' AND '$reg_ak' AND a.kodeKelompok='$kodeKelompok' AND (a.kodeRuangan='' or a.kodeRuangan=0 or a.kodeRuangan is null or a.kodeRuangan NOT in ($listRuangan)) AND a.kodeLokasi LIKE '$kodeLokasi%'";
	//or a.kodeRuangan NOT in (1,2,3,4,5,6,7,8,9,10,11,12,13) listRuangan
}
elseif($satker != '' AND $tahun_aw != '' AND $tahun_ak != '' AND $tipeAset != '' AND $kodeKelompok == '' AND $reg_aw  != '' AND $reg_ak  != '' AND $kd_ruangan != '' AND $kodeLokasi !=''){
	
	$sWhere=" WHERE $status a.Tahun >='$tahun_aw' AND a.Tahun <='$tahun_ak' AND a.kodeSatker='$satker' AND a.kodeKelompok like '$tipe%' AND a.noRegister BETWEEN '$reg_aw' AND '$reg_ak' AND kodeRuangan ='$kd_ruangan' AND a.kodeLokasi LIKE '$kodeLokasi%'";
}
elseif($satker != '' AND $tahun_aw != '' AND $tahun_ak != '' AND $tipeAset != '' AND $kodeKelompok == '' AND $reg_aw  != '' AND $reg_ak  != '' AND $kd_ruangan == '' AND $kodeLokasi !=''){
	
	$sWhere=" WHERE $status a.Tahun >='$tahun_aw' AND a.Tahun <='$tahun_ak' AND a.kodeSatker='$satker' AND a.noRegister BETWEEN '$reg_aw' AND '$reg_ak' AND a.kodeKelompok like '$tipe%' AND (a.kodeRuangan='' or a.kodeRuangan=0 or a.kodeRuangan is null or a.kodeRuangan NOT in ($listRuangan)) AND a.kodeLokasi LIKE '$kodeLokasi%'";
	//or a.kodeRuangan NOT in (1,2,3,4,5,6,7,8,9,10,11,12,13)	
}
//revisi
elseif ($satker != '' AND $tahun_aw != '' AND $tahun_ak != '' AND $tipeAset != '' AND $kodeKelompok == '' AND $kd_ruangan == '' AND $kodeLokasi !='') {
	# code...
	$sWhere=" WHERE $status a.Tahun >='$tahun_aw' AND a.Tahun <='$tahun_ak' AND a.kodeSatker='$satker' AND a.kodeKelompok like '$tipe%' AND (a.kodeRuangan='' or a.kodeRuangan=0 or a.kodeRuangan is null or a.kodeRuangan NOT in ($listRuangan)) AND a.kodeLokasi LIKE '$kodeLokasi%'";
	
}elseif ($satker != '' AND $tahun_aw != '' AND $tahun_ak != '' AND $tipeAset != '' AND $kodeKelompok != '' AND $kd_ruangan == '' AND $kodeLokasi !='') {
	# code...
	$sWhere=" WHERE $status a.Tahun >='$tahun_aw' AND a.Tahun <='$tahun_ak' AND a.kodeSatker='$satker' AND a.kodeKelompok='$kodeKelompok' AND (a.kodeRuangan='' or a.kodeRuangan=0 or a.kodeRuangan is null or a.kodeRuangan NOT in ($listRuangan)) AND a.kodeLokasi LIKE '$kodeLokasi%'";
	
}elseif ($satker != '' AND $tahun_aw != '' AND $tahun_ak != '' AND $tipeAset != '' AND $kodeKelompok == '' AND $kd_ruangan != '' AND $kodeLokasi !='') {
	# code...
	$sWhere=" WHERE $status a.Tahun >='$tahun_aw' AND a.Tahun <='$tahun_ak' AND a.kodeSatker='$satker' AND a.kodeKelompok like '$tipe%' AND kodeRuangan ='$kd_ruangan' AND a.kodeLokasi LIKE '$kodeLokasi%'";
	
}elseif ($satker != '' AND $tahun_aw != '' AND $tahun_ak != '' AND $tipeAset != '' AND $kodeKelompok != '' AND $kd_ruangan != '' AND $kodeLokasi !='') {
	# code...
	$sWhere=" WHERE $status a.Tahun >='$tahun_aw' AND a.Tahun <='$tahun_ak' AND a.kodeSatker='$satker' AND a.kodeKelompok='$kodeKelompok' AND kodeRuangan ='$kd_ruangan' AND a.kodeLokasi LIKE '$kodeLokasi%'";
	
}

if (isset($_GET['sSearch']) && $_GET['sSearch'] != "") {
     //$sWhere = "WHERE (";
	 if ($satker != '' AND $tahun_aw != '' AND $tahun_ak != '' AND $tipeAset != '' AND $kodeKelompok != '' AND $reg_aw  != '' AND $reg_ak  != '' AND $kd_ruangan != ''           
	 	 AND $kodeLokasi !=''){
		$sWhere=" WHERE $status a.Tahun >='$tahun_aw' AND a.Tahun <='$tahun_ak' AND a.kodeSatker='$satker' AND a.kodeKelompok='$kodeKelompok' AND a.noRegister BETWEEN '$reg_aw' AND '$reg_ak' AND kodeRuangan ='$kd_ruangan' AND a.kodeLokasi LIKE '$kodeLokasi%' AND (";
	}elseif($satker != '' AND $tahun_aw != '' AND $tahun_ak != '' AND $tipeAset != '' AND $kodeKelompok != '' AND $reg_aw  != '' AND $reg_ak  != '' AND $kd_ruangan == '' 
		AND $kodeLokasi !=''){
		$sWhere=" WHERE $status a.Tahun >='$tahun_aw' AND a.Tahun <='$tahun_ak'  AND a.kodeSatker='$satker' AND a.kodeKelompok='$kodeKelompok' AND a.noRegister BETWEEN '$reg_aw' AND '$reg_ak' AND (a.kodeRuangan='' or a.kodeRuangan=0 or a.kodeRuangan is null or a.kodeRuangan NOT in ($listRuangan)) AND a.kodeLokasi LIKE '$kodeLokasi%' AND (";

	//or a.kodeRuangan NOT in (1,2,3,4,5,6,7,8,9,10,11,12,13)
	}
	elseif($satker != '' AND $tahun_aw != '' AND $tahun_ak != '' AND $tipeAset != '' AND $kodeKelompok == '' AND $reg_aw  != '' AND $reg_ak  != '' AND $kd_ruangan != '' 
		AND $kodeLokasi !=''){
		$sWhere=" WHERE $status a.Tahun >='$tahun_aw' AND a.Tahun <='$tahun_ak' AND a.kodeSatker='$satker' AND a.kodeKelompok like '$tipe%' AND a.noRegister BETWEEN '$reg_aw' AND '$reg_ak' AND kodeRuangan ='$kd_ruangan'  AND a.kodeLokasi LIKE '$kodeLokasi%' AND (";
	}
	elseif($satker != '' AND $tahun_aw != '' AND $tahun_ak != '' AND $tipeAset != '' AND $kodeKelompok == '' AND $reg_aw  != '' AND $reg_ak  != '' AND $kd_ruangan == ''
		AND $kodeLokasi !=''){
		$sWhere=" WHERE $status a.Tahun >='$tahun_aw' AND a.Tahun <='$tahun_ak' AND a.kodeSatker='$satker' AND a.kodeKelompok like '$tipe%'AND a.noRegister BETWEEN '$reg_aw' AND '$reg_ak' AND (a.kodeRuangan='' or a.kodeRuangan=0 or a.kodeRuangan is null or a.kodeRuangan NOT in ($listRuangan))  AND a.kodeLokasi LIKE '$kodeLokasi%' AND (";

	//or a.kodeRuangan NOT in (1,2,3,4,5,6,7,8,9,10,11,12,13)
	}
	//revisi
	elseif ($satker != '' AND $tahun_aw != '' AND $tahun_ak != '' AND $tipeAset != '' AND $kodeKelompok == '' AND $kd_ruangan == '' AND $kodeLokasi !='') {
		# code...
		$sWhere=" WHERE $status a.Tahun >='$tahun_aw' AND a.Tahun <='$tahun_ak' AND a.kodeSatker='$satker' AND a.kodeKelompok like '$tipe%' AND (a.kodeRuangan='' or a.kodeRuangan=0 or a.kodeRuangan is null or a.kodeRuangan NOT in ($listRuangan)) AND a.kodeLokasi LIKE '$kodeLokasi%' AND (";
		
	}elseif ($satker != '' AND $tahun_aw != '' AND $tahun_ak != '' AND $tipeAset != '' AND $kodeKelompok != '' AND $kd_ruangan == '' AND $kodeLokasi !='') {
		# code...
		$sWhere=" WHERE $status a.Tahun >='$tahun_aw' AND a.Tahun <='$tahun_ak' AND a.kodeSatker='$satker' AND a.kodeKelompok='$kodeKelompok' AND (a.kodeRuangan='' or a.kodeRuangan=0 or a.kodeRuangan is null or a.kodeRuangan NOT in ($listRuangan)) AND a.kodeLokasi LIKE '$kodeLokasi%' AND (";
		
	}elseif ($satker != '' AND $tahun_aw != '' AND $tahun_ak != '' AND $tipeAset != '' AND $kodeKelompok == '' AND $kd_ruangan != '' AND $kodeLokasi !='') {
		# code...
		$sWhere=" WHERE $status a.Tahun >='$tahun_aw' AND a.Tahun <='$tahun_ak' AND a.kodeSatker='$satker' AND a.kodeKelompok like '$tipe%' AND kodeRuangan ='$kd_ruangan' AND a.kodeLokasi LIKE '$kodeLokasi%' AND (";
		
	}elseif ($satker != '' AND $tahun_aw != '' AND $tahun_ak != '' AND $tipeAset != '' AND $kodeKelompok != '' AND $kd_ruangan != '' AND $kodeLokasi !='') {
		# code...
		$sWhere=" WHERE $status a.Tahun >='$tahun_aw' AND a.Tahun <='$tahun_ak' AND a.kodeSatker='$satker' AND a.kodeKelompok='$kodeKelompok' AND kodeRuangan ='$kd_ruangan' AND a.kodeLokasi LIKE '$kodeLokasi%' AND (";
		
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
/*for ($i = 0; $i < count($aColumns); $i++) {
     if (isset($_GET['bSearchable_' . $i]) && $_GET['bSearchable_' . $i] == "true" && $_GET['sSearch_' . $i] != '') {
          if ($sWhere == "") {
               $sWhere = "WHERE $status a.Tahun >='$tahun_aw' AND a.Tahun <='$tahun_ak' AND a.kodeSatker='$satker' AND a.kodeKelompok like '$tipe%'";
          } else {
               $sWhere .= " AND $status a.Tahun >='$tahun_aw' AND a.Tahun <='$tahun_ak' AND a.kodeSatker='$satker' AND a.kodeKelompok='$kodeKelompok' AND a.noRegister BETWEEN '$reg_aw' AND '$reg_ak'";
          }
          $sWhere .= "" . $aColumns[$i] . " LIKE '%" . mysql_real_escape_string($_GET['sSearch_' . $i]) . "%' ";
     }
}*/
// echo $sWhere;

/*
 * SQL queries
 * Get data to display
 */
 /*SELECT a.Aset_ID,a.kodeKelompok,a.kodeSatker,a.Tahun,k.Uraian,s.NamaSatker from aset a 
 inner join kelompok as k on k.Kode = a.kodeKelompok 
 inner join satker as s on s.kode = a.kodeSatker 
 where a.tahun = '2014' and a.kodeSatker = '01.01.01.01' and a.kodekelompok like '02%' limit 1 */
 
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
if($satker != '' AND $tahun_aw != '' AND $tahun_ak != ''  AND $tipeAset != '' AND $kodeKelompok != '' AND $reg_aw  != '' AND $reg_ak  != '' AND $kd_ruangan != '' AND $kodeLokasi !=''){
	//pr("1");
	$sQuery = "
		SELECT COUNT(" . $sIndexColumn . ")
		FROM   $sTable WHERE $status a.Tahun >='$tahun_aw' AND a.Tahun <='$tahun_ak' AND a.kodeSatker='$satker' 
		AND a.kodeKelompok='$kodeKelompok'
		AND a.noRegister BETWEEN '$reg_aw' AND '$reg_ak'
		AND kodeRuangan ='$kd_ruangan' AND a.kodeLokasi LIKE '$kodeLokasi%'";
}elseif($satker != '' AND $tahun_aw != '' AND $tahun_ak != '' AND $tipeAset != '' AND $kodeKelompok != '' AND $reg_aw  != '' AND $reg_ak  != '' AND $kd_ruangan == '' 
	AND $kodeLokasi !=''){
	//pr("2");
	$sQuery = "
		SELECT COUNT(" . $sIndexColumn . ")
		FROM   $sTable WHERE $status a.Tahun >='$tahun_aw' AND a.Tahun <='$tahun_ak' AND a.kodeSatker='$satker'
		AND a.kodeKelompok='$kodeKelompok'
		AND a.noRegister BETWEEN '$reg_aw' AND '$reg_ak'
		AND (a.kodeRuangan='' or a.kodeRuangan=0 or a.kodeRuangan is null or a.kodeRuangan NOT in ($listRuangan))
		AND a.kodeLokasi LIKE '$kodeLokasi%'
		";

	//or a.kodeRuangan NOT in (1,2,3,4,5,6,7,8,9,10,11,12,13)
}elseif($satker != '' AND $tahun_aw != '' AND $tahun_ak != '' AND $tipeAset != '' AND $kodeKelompok == '' AND $reg_aw  != '' AND $reg_ak  != '' AND $kd_ruangan != '' 
	AND $kodeLokasi !=''){
	//pr("3");
	$sQuery = "
		SELECT COUNT(" . $sIndexColumn . ")
		FROM   $sTable WHERE $status a.Tahun >='$tahun_aw' AND a.Tahun <='$tahun_ak' AND a.kodeSatker='$satker' 
		AND a.kodeKelompok like '$tipe%' 
		AND a.noRegister BETWEEN '$reg_aw' AND '$reg_ak'
		AND kodeRuangan ='$kd_ruangan' AND a.kodeLokasi LIKE '$kodeLokasi%'";
}elseif($satker != '' AND $tahun_aw != '' AND $tahun_ak != '' AND $tipeAset != '' AND $kodeKelompok == '' AND $reg_aw  != '' AND $reg_ak  != '' AND $kd_ruangan == '' 
	AND $kodeLokasi !=''){
	//pr("4");
	$sQuery = "
		SELECT COUNT(" . $sIndexColumn . ")
		FROM   $sTable WHERE $status a.Tahun >='$tahun_aw' AND a.Tahun <='$tahun_ak' AND a.kodeSatker='$satker' 	
		AND a.kodeKelompok like '$tipe%'
		AND a.noRegister BETWEEN '$reg_aw' AND '$reg_ak'
		AND (a.kodeRuangan='' or a.kodeRuangan=0 or a.kodeRuangan is null or a.kodeRuangan NOT in ($listRuangan)) AND a.kodeLokasi LIKE '$kodeLokasi%'";
		
	//or a.kodeRuangan NOT in (1,2,3,4,5,6,7,8,9,10,11,12,13)
}elseif ($satker != '' AND $tahun_aw != '' AND $tahun_ak != '' AND $tipeAset != '' AND $kodeKelompok == '' AND $kd_ruangan == '' AND $kodeLokasi !='') {
	# code...
	$sQuery = "
		SELECT COUNT(" . $sIndexColumn . ")
		FROM   $sTable WHERE $status a.Tahun >='$tahun_aw' AND a.Tahun <='$tahun_ak' AND a.kodeSatker='$satker' AND a.kodeKelompok like '$tipe%' AND (a.kodeRuangan='' or a.kodeRuangan=0 or a.kodeRuangan is null or a.kodeRuangan NOT in ($listRuangan)) AND a.kodeLokasi LIKE '$kodeLokasi%'";

	
}elseif ($satker != '' AND $tahun_aw != '' AND $tahun_ak != '' AND $tipeAset != '' AND $kodeKelompok != '' AND $kd_ruangan == '' AND $kodeLokasi !='') {
	# code...
	$sQuery = "
		SELECT COUNT(" . $sIndexColumn . ")
		FROM   $sTable WHERE $status a.Tahun >='$tahun_aw' AND a.Tahun <='$tahun_ak' AND a.kodeSatker='$satker' AND a.kodeKelompok='$kodeKelompok' AND (a.kodeRuangan='' or a.kodeRuangan=0 or a.kodeRuangan is null or a.kodeRuangan NOT in ($listRuangan)) AND a.kodeLokasi LIKE '$kodeLokasi%'";
	
	
	
}elseif ($satker != '' AND $tahun_aw != '' AND $tahun_ak != '' AND $tipeAset != '' AND $kodeKelompok == '' AND $kd_ruangan != '' AND $kodeLokasi !='') {
	# code...
	$sQuery = "
		SELECT COUNT(" . $sIndexColumn . ")
		FROM   $sTable WHERE $status a.Tahun >='$tahun_aw' AND a.Tahun <='$tahun_ak' AND a.kodeSatker='$satker' AND a.kodeKelompok like '$tipe%' AND kodeRuangan ='$kd_ruangan' AND a.kodeLokasi LIKE '$kodeLokasi%'";
	
	
	
}elseif ($satker != '' AND $tahun_aw != '' AND $tahun_ak != '' AND $tipeAset != '' AND $kodeKelompok != '' AND $kd_ruangan != '' AND $kodeLokasi !='') {
	# code...
	$sQuery = "
		SELECT COUNT(" . $sIndexColumn . ")
		FROM   $sTable WHERE $status a.Tahun >='$tahun_aw' AND a.Tahun <='$tahun_ak' AND a.kodeSatker='$satker' AND a.kodeKelompok='$kodeKelompok' AND kodeRuangan ='$kd_ruangan' AND a.kodeLokasi LIKE '$kodeLokasi%'";

	
	
}
//echo $sQuery;
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
$data_post=$PENGHAPUSAN->apl_userasetlistHPS("KIRASET");
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
		$kodeLokasi = $aRow['kodeLokasi'];
		$Uraian = $aRow['Uraian'];
		$noRegister = $aRow['noRegister'];
		$NilaiPerolehan = $aRow['NilaiPerolehan'];
		$kodeRuangan = $aRow['kodeRuangan'];
		$TipeAset = $aRow['TipeAset'];
		//cek ruangan 
		if($kodeRuangan != ''){
			$queryRuangan = "select NamaSatker from satker where kode ='$Kd_Satker' and Tahun = '$thnR' and Kd_Ruang= '$kodeRuangan' limit 1";
			// echo $queryRuangan;
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
		
		$checkbox   = "<input type=\"checkbox\" class =\"icheck-input checkbox\" name=\"id_aset[]\" value=\"$id\" onchange=\"return AreAnyCheckboxesChecked();\" $aRow[checked]>";
						 
		  $row[] ="<center>".$no."</center>";
		  $row[] ="<center>".$checkbox."</center>";
		  $row[] =$Kd_Satker;
		  $row[] =$kodeLokasi;
		  $row[] =$Kd_Kelompok;
		  $row[] =$Uraian;
		  $row[] =$Merk;
		  $row[] ="<center>".sprintf('%04s',$noRegister)."</center>";
		  $row[] ="<center>".number_format($NilaiPerolehan,2,",",".")."</center>";
		  $row[] =$NamaRuangan;
		  $row[] ="<center>".$Tahun."</center>";
		 
		  
		$no++;
		 $output['aaData'][] = $row;
	}
}
echo json_encode($output);

?>

