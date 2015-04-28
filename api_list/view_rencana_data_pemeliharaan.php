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
$aColumns = array('a.Aset_ID','a.noRegister','a.kodeKelompok','k.Uraian',
			      'pr.RencanaPemeliharaan_ID','pr.kodeRekening','pr.HargaSatuan','pr.UraianPemeliharaan','pr.keterangan','pr.Lokasi','pr.TipeAset');
$test = count($aColumns);
  
// echo $aColumns; 
/* Indexed column (used for fast and accurate table cardinality) */
$sIndexColumn = "a.Aset_ID";

/* DB table to use */
$sTable = "aset as a";
$sTable_inner_join_kelompok = "kelompok as k";
$sTable_inner_join_pemeliharaan ="rencana_pemeliharaan as pr";
$cond_kelompok ="k.Kode = a.kodeKelompok ";
$cond_pemeliharaan ="pr.Aset_ID = a.Aset_ID";
// $cond_satker ="s.kode = a.kodeSatker";
// = "a.StatusValidasi = 1 AND a.Status_Validasi_Barang = 1 AND";
//variabel ajax
$tglPemeliharaanAwal 		= $_GET['tglAw'];
$tglPemeliharaanAkhir 		= $_GET['tglAk'];
$satker 				= $_GET['satker'];
// $par_data_table="tahun=$tahun&satker=$satker";
$par_data_table="tglAw=$tglPemeliharaanAwal&tglAk=$tglPemeliharaanAkhir&satker=$satker";

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

if ($satker != '' AND $tglPemeliharaanAwal != '' AND  $tglPemeliharaanAkhir != ''){
	$sWhere=" WHERE pr.TglPemeliharaan >='$tglPemeliharaanAwal' AND pr.TglPemeliharaan <='$tglPemeliharaanAkhir'  AND a.kodeSatker='$satker'";
}

if (isset($_GET['sSearch']) && $_GET['sSearch'] != "") {
     //$sWhere = "WHERE (";
	 if ($satker != '' AND $tglPemeliharaanAwal != '' AND  $tglPemeliharaanAkhir != ''){
		$sWhere=" WHERE pr.TglPemeliharaan >='$tglPemeliharaanAwal' AND pr.TglPemeliharaan <='$tglPemeliharaanAkhir'  AND a.kodeSatker='$satker' AND (";
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
               $sWhere = "WHERE pr.TglPemeliharaan >='$tglPemeliharaanAwal' AND pr.TglPemeliharaan <='$tglPemeliharaanAkhir'  AND a.kodeSatker='$satker'";
          } else {
               $sWhere .= " AND pr.TglPemeliharaan >='$tglPemeliharaanAwal' AND pr.TglPemeliharaan <='$tglPemeliharaanAkhir'  AND a.kodeSatker='$satker'";
          }
          $sWhere .= "" . $aColumns[$i] . " LIKE '%" . mysql_real_escape_string($_GET['sSearch_' . $i]) . "%' ";
     }
}
// echo $sWhere;

/*
 * SQL queries
 * Get data to display
 */
 /*SELECT a.Aset_ID,a.kodeKelompok,a.kodeSatker,a.Tahun,k.Uraian,s.NamaSatker from aset a 
 inner join kelompok as k on k.Kode = a.kodeKelompok 
 inner join satker as s on s.kode = a.kodeSatker 
 where a.tahun = '2014' and a.kodeSatker = '01.01.01.01' and a.kodekelompok like '02%' limit 1 */
 
 

$sQuery = "
		SELECT SQL_CALC_FOUND_ROWS " . str_replace(" , ", " ", implode(", ", $aColumns)) . "
		FROM   $sTable 
		INNER JOIN $sTable_inner_join_kelompok ON $cond_kelompok
		INNER JOIN $sTable_inner_join_pemeliharaan ON $cond_pemeliharaan
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
		INNER JOIN $sTable_inner_join_pemeliharaan ON $cond_pemeliharaan
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
		$id =  $aRow['Aset_ID'];
		$Tahun = $aRow['Tahun'];
		$Kd_Kelompok = $aRow['kodeKelompok'];
		$Uraian = $aRow['Uraian'];
		$noRegister = $aRow['noRegister'];
		
		$prId = $aRow['RencanaPemeliharaan_ID'];
		$kodeRekening = $aRow['kodeRekening'];
		$HargaSatuan = $aRow['HargaSatuan'];
		$UraianPemeliharaan = $aRow['UraianPemeliharaan'];
		$Lokasi = $aRow['Lokasi'];
		$keterangan = $aRow['keterangan'];
		$TipeAset = $aRow['TipeAset'];
		
		//cek merk by tipe aset
		if($TipeAset == 'B'){
			$queryTipe = "select Merk from mesin where kodeSatker ='$satker' and Aset_ID = '$id' limit 1";
			// pr($queryTipe);
			$exequeryTipe = $DBVAR->query($queryTipe);
			$GetDataTipe = $DBVAR->fetch_array($exequeryTipe);
			// pr($GetDataTipe);
			$Merk = $GetDataTipe['Merk'];
		}else{
			$Merk = "";
		}
		//cek keterangan 
		$queryRek = "select NamaRekening from kodeRekening where kodeRekening ='$kodeRekening' limit 1";
		// pr($queryTipe);
		$exequeryRek = $DBVAR->query($queryRek);
		$GetDataRek = $DBVAR->fetch_array($exequeryRek);
		$NamaRek = $GetDataRek['NamaRekening'];
		 
		 $identity = "id=$prId";
		 $addUrl = encode($identity);
		 $filterUrl = encode($par_data_table);
		 
		 // $addUrl2 = decode($addUrl);
		 // $addUrl = encode(id=$id&tipe=$TipeAset&$par_data_table);
		 $edit ="<center><a href=\"prcn_pemeliharaan_edit_rev.php?url=$addUrl&surl=$filterUrl\" class=\"btn btn-warning btn-small\">
			<i class=\"fa fa-pencil\" align=\"center\"></i>&nbsp;&nbsp;Edit</a></center>";
		 $hapus="<center><a onclick=\"return confirm('Hapus Data?')\" href=\"prcn_pemeliharaan_tambah_proses_hapus_rev.php?url=$addUrl&surl=$filterUrl\" class=\"btn btn-danger btn-circle\">
			<i class=\"fa fa-trash simbol\">&nbsp;Hapus</i></a></center>"; 
			// onclick="return confirm('Hapus SP2D?')" href="sp2dterminhapus.php?id=97&idsp2d=2079"
					
		  $row[] ="<center>".$no."</center>";
		  $row[] ="[".$Kd_Kelompok."]"."<br>".$Uraian;
		  $row[] =$Merk;
		  $row[] ="<center>".sprintf('%04s',$noRegister)."</center>";
		  $row[] ="[".$kodeRekening."]"."<br>".$NamaRek;
		  $row[] ="<center>".number_format($HargaSatuan,2,",",".")."</center>";
		  $row[] =$UraianPemeliharaan;
		  $row[] =$Lokasi;
		  $row[] =$keterangan;
		  $row[] =$edit."<br>".$hapus;
		  
		  
		  
		$no++;
		 $output['aaData'][] = $row;
	}
echo json_encode($output);

?>

