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
$aColumns = array('Penghapusan_ID','SatkerUsul','NoSKHapus','TglHapus','AlasanHapus');

/* Indexed column (used for fast and accurate table cardinality) */
$sIndexColumn = "Penghapusan_ID";

/* DB table to use */
$sTable = "penghapusan";
$dataParam['tahun']=$_GET['tahun'];
$PENGHAPUSAN = new RETRIEVE_PENGHAPUSAN;

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
          $sOrder = "ORDER BY Penghapusan_ID desc";
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

$data = $PENGHAPUSAN->retrieve_list_validasi_pms_rev($dataParam); 
//pr($data);
// /* Data set length after filtering */
$sQuery = "
    SELECT FOUND_ROWS()
  ";
$rResultFilterTotal = $DBVAR->query($sQuery);
$aResultFilterTotal = $DBVAR->fetch_array($rResultFilterTotal);
$iFilteredTotal = $aResultFilterTotal[0];

// echo $iFilteredTotal ;

/* Total data set length */
$thnParam = trim($dataParam['tahun']); 
if($thnParam!= ''){
  $paramCount = " WHERE YEAR(TglHapus) ='{$thnParam}' AND FixPenghapusan=1 AND Jenis_Hapus='PMS' AND Status = '1'"; 
}else{
  $paramCount = "";
}
$sQuery = "
    SELECT COUNT(`" . $sIndexColumn . "`)
    FROM   $sTable $paramCount
  ";

//echo "$sQuery";
$rResultTotal = $DBVAR->query($sQuery);
$aResultTotal = $DBVAR->fetch_array($rResultTotal);
////pr($aResultTotal );
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
  if (!empty($data))
          {
foreach ($data as $key => $value)
            {
              //pr($value);
              $NamaSatker = $PENGHAPUSAN->getNamaSatker($value['SatkerUsul']); 
              //pr($NamaSatker);
              $Satker="[".$value[SatkerUsul]."]"."<br/>".$NamaSatker['0']['NamaSatker'];
              $change=$value[TglHapus]; 
              $change2=  format_tanggal_db3($change); 
              $row = array();
              
              $count = explode(',', $value['Usulan_ID']);
              $clearArr = array_filter($count);
              $fixCount = count($clearArr);

              /*<a href="<?php echo "$url_rewrite/module/penghapusan/"; ?>dftr_review_edit_penetapan_usulan_validasi_pmd.php?id=<?php echo "$row[Penghapusan_ID]";?>" class="btn btn-success"><i class="fa fa-pencil-square-o"></i> View</a>&nbsp;*/
              $tindakan = "<a href=\"{$url_rewrite}/module/penghapusanv2/dftr_review_edit_penetapan_usulan_validasi_pms.php?id={$value[Penghapusan_ID]}\" class=\"btn btn-success btn-small\" onclick=\"return confirm('View Data');\"style=\"margin-top:3px\"><i class=\"fa fa-pencil-square-o\"></i>&nbsp;View</a>";

              $row[]=$no;
              $row[]=$value['NoSKHapus'];
              $row[]=$Satker;
              $row[]="<center>".$fixCount."</center>";
              $row[]="<center>".$change2."</center>";
              $row[]=$value['AlasanHapus'];
              $row[]="<center>".$tindakan."</center>";
               
              $output['aaData'][] = $row;
              $no++;
            }
      }
echo json_encode($output);

?>

