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
$aColumns = array('p.Penggunaan_ID','p.NoSKKDH','p.TglSKKDH','p.Keterangan','p.FixPenggunaan','p.Status');

/* Indexed column (used for fast and accurate table cardinality) */
$sIndexColumn = "p.Penggunaan_ID";

/* DB table to use */
$sTable = "penggunaan as p";
$dataParam['tahun']=$_GET['tahun'];
$PENGGUNAAN = new RETRIEVE_PENGGUNAAN;

$sLimit = "";
if (isset($_GET['iDisplayStart']) && $_GET['iDisplayLength'] != '-1') {
     $sLimit = " " . intval($_GET['iDisplayStart']) . ", " .
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
          $sOrder = "ORDER BY p.Penggunaan_ID desc";
     }
}


/*
 * Filtering
 * NOTE this does not match the built-in DataTables filtering which does it
 * word by word on any field. It's possible to do here, but concerned about efficiency
 * on very large tables, and MySQL's regex functionality is very limited
 */
//$sWhere = "";
if (isset($_GET['sSearch']) && $_GET['sSearch'] != "") {
     //$sWhere = "WHERE (";
     $sWhere ="(";
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
        //       $sWhere = "WHERE ";
               $tidakdipakai=0;
          } else {
               $sWhere .= " AND ";
          }
          $sWhere .= "`" . $aColumns[$i] . "` LIKE '%" . mysql_real_escape_string($_GET['sSearch_' . $i]) . "%' ";
     }
}


/*
 * SQL queries
 * Get data to display
 */
$dataParam['condition']="$sWhere ";
$dataParam['order']=$sOrder;  
$dataParam['limit']="$sLimit";

$data = $PENGGUNAAN->retrieve_daftar_penetapan_penggunaan_validasi($dataParam); 
//pr($data);
// /* Data set length after filtering */
if($data){
  $sQuery = "
    SELECT FOUND_ROWS()";
  $rResultFilterTotal = $DBVAR->query($sQuery);
  $aResultFilterTotal = $DBVAR->fetch_array($rResultFilterTotal);
  $iFilteredTotal = $aResultFilterTotal[0];
}else{
   $iFilteredTotal = 0;
}

// echo $iFilteredTotal ;

/* Total data set length */
if($data){
  $tahun = $_GET['tahun'];
  $paramfilter = "AND p.FixPenggunaan = 1   
                  AND p.Status = 1
                  AND p.NoSKKDH NOT LIKE '%Migrasi%'";
  if($_SESSION['ses_uaksesadmin']==1){

      $filter .= " YEAR(p.TglSKKDH) ='{$tahun}' $paramWhere";
  }else{
      $UserName=$_SESSION['ses_uoperatorid'];
     
      if ($UserName) $filter .= " p.UserNm LIKE '{$UserName}%' AND YEAR(p.TglSKKDH) ='{$tahun}'";
  }
  $thnParam = trim($dataParam['tahun']); 

  if($thnParam!= ''){
    $paramCount = " WHERE {$filter}"; 
  }else{
    $paramCount = "";
  }
  $sQuery = "
      SELECT COUNT(" . $sIndexColumn . ")
      FROM   $sTable $paramCount $paramfilter 
    ";
  //echo "$sQuery";
  $rResultTotal = $DBVAR->query($sQuery);
  $aResultTotal = $DBVAR->fetch_array($rResultTotal);
  ////pr($aResultTotal );
  $iTotal = $aResultTotal[0];

}else{
  $iTotal = 0;
}


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
  if (!empty($data))
					{
foreach ($data as $key => $value)
						{      
              if($value['Status']==1){
                  $label="info";
                  $text="<span class=\"label label-{$label}\" >sudah divalidasi</span>";
                  
              }else{
                  $label="warning";
                  $text="<span class=\"label label-{$label}\" >belum divalidasi</span>";
              }
              
              $change=$value[TglSKKDH]; 
              $change2=  format_tanggal_db3($change);
               
              //cek ruangan 
              if($value['Penggunaan_ID']){
                $query = "select count(Aset_ID) as jml from penggunaanaset where Penggunaan_ID ='$value[Penggunaan_ID]'";
                $exe = $DBVAR->query($query);
                $GetData = $DBVAR->fetch_array($exe);
                $total = $GetData['jml'];
              }else{
                $total = "";
              }  
              $row = array();
              

              $row[]="<center>".$no."</center>";
              $row[]=$value['NoSKKDH'];
              $row[]="<center>".$total."</center>";
              $row[]="<center>".$change2."</center>";
              $row[]=$value['Keterangan'];
              $row[]=$text.$textvalid;
              $row[]=$tindakan;
               
              $output['aaData'][] = $row;
              $no++;
            }
      }
echo json_encode($output);

?>

