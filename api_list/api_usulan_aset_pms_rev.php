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


$aColumns = array('us.Usulan_ID','us.NoUsulan','us.SatkerUsul','us.TglUpdate','us.KetUsulan',);

/* Indexed column (used for fast and accurate table cardinality) */
$sIndexColumn = "us.Usulan_ID";

/* DB table to use */
//pr($_GET);
$sTable = "usulan as us";
$dataParam['bup_pp_sp_nousulan']=$_GET['bup_pp_sp_nousulan'];
$dataParam['bup_pp_sp_tglusul']=$_GET['bup_pp_sp_tglusul'];
$dataParam['kodeSatker']=$_GET['kodeSatker'];

$PENGHAPUSAN = new RETRIEVE_PENGHAPUSAN;

$filter = "";
if ($dataParam['bup_pp_sp_nousulan']) $filter .= " AND us.NoUsulan = '{$dataParam[bup_pp_sp_nousulan]}' ";
if ($dataParam['kodeSatker']) $filter .= " AND us.SatkerUsul LIKE '{$dataParam[kodeSatker]}%' ";
if ($dataParam['bup_pp_sp_tglusul']) $filter .= " AND us.TglUpdate = '{$$dataParam[bup_pp_sp_tglusul]}' ";    

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
          $sOrder = "ORDER BY us.Usulan_ID desc";
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

//echo $sWhere;
$dataParam['condition']="$sWhere ";
$dataParam['order']=$sOrder;  
$dataParam['limit']="$sLimit";
// pr($dataParam);
// list($data,$iFilteredTotal ) = $PENGHAPUSAN->retrieve_daftar_usulan_penghapusan_pmd($dataParam);	

$data = $PENGHAPUSAN->retrieve_penetapan_penghapusan_filter_pms_rev($dataParam); 
//pr($data);
//exit;
//$rResult = $DBVAR->query($sQuery);

// /* Data set length after filtering */
$sQuery = "
		SELECT FOUND_ROWS()
	";
$rResultFilterTotal = $DBVAR->query($sQuery);
$aResultFilterTotal = $DBVAR->fetch_array($rResultFilterTotal);
$iFilteredTotal = $aResultFilterTotal[0];

// echo $iFilteredTotal ;

/* Total data set length */
$sQuery = "
		SELECT COUNT(" . $sIndexColumn . "  ) FROM {$sTable}
    WHERE  us.Jenis_Usulan = 'PMD' AND us.StatusPenetapan = 0
    {$filter} ORDER BY us.Usulan_ID desc";
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
							
              $NamaSatker = $PENGHAPUSAN->getNamaSatker($value[SatkerUsul]);
              $totalNilaiPerolehan = $PENGHAPUSAN->TotalNilaiPerolehanRev($value[Usulan_ID]);
              $change=$value[TglUpdate]; 
              $change2=  format_tanggal_db3($change); 
              // echo "$change2";
              $jumlahAset = $value['jmlaset'];
              if($value['SatkerUsul']){ 
                $SatkerUsul="[".$value['SatkerUsul']."] ".$NamaSatker[0]['NamaSatker'];
               // echo ;
              }else{
                $SatkerUsul=$NamaSatker[0]['NamaSatker'];
              }

              if($value['StatusPenetapan']==0){
                  $label="warning";
                  $text="belum diproses";
                }elseif($value['StatusPenetapan']==1){
                  $label="info";
                  $text="sudah ditetapkan";
                }
							  
                $NoUsulan=explode("/", $value['NoUsulan']);

                $hasilNoUsulan=implode("/ ", $NoUsulan);
                
                 $row = array();
                 
                 $checkbox="<input type=\"checkbox\" id=\"checkbox\" class=\"icheck-input checkbox\" onchange=\"return AreAnyCheckboxesChecked();\" name=\"penetapanpenghapusan[]\" value=\"{$value['Usulan_ID']}\" {$value['checked']}>";
                 $row[]=$no;
                 $row[]=$checkbox;
                 $row[]=$hasilNoUsulan ;
                 $row[]=$SatkerUsul;
                 $row[]="<center>".$jumlahAset."</center>";
                 $row[]="<center>".$change2."</center>";
                 $row[]=number_format($totalNilaiPerolehan,2,",",".");
                 $row[]=$value[KetUsulan];
                 
                 $output['aaData'][] = $row;
                  $no++;
                }
          }
echo json_encode($output);

?>

