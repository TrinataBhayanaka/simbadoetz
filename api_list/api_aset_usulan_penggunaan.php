<?php
ob_start();
include "../config/config.php";



$id=$_SESSION['user_id'];//Nanti diganti

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
#This code //provided by:
#Andreas Hadiyono (andre.hadiyono@gmail.com)
#Gunadarma University

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * Easy set variables
 */

/* Array of database columns which should be read and sent back to DataTables. Use a space where
 * you want to insert a non-database field (for example a counter or static image)
 */

$dataParam['jenisaset']=$_GET['jenisaset'];
if($_GET['jenisaset']=="2")
     $merk="m.Merk";
else
     $merk="ast.Aset_ID";
$aColumns = array('ast.Aset_ID','ast.kodeKelompok','ast.noRegister','ast.noKontrak','k.Uraian','ast.kodeSatker','ast.TglPerolehan','ast.NilaiPerolehan','ast.AsalUsul',$merk);

/* Indexed column (used for fast and accurate table cardinality) */
$sIndexColumn = "Aset_ID";

/* DB table to use */
$sTable = "aset";
$dataParam['bup_tahun']=$_GET['bup_tahun'];
$dataParam['jenisaset']=$_GET['jenisaset'];
$dataParam['kodeSatker']=$_GET['kodeSatker'];
$dataParam['kodeKelompok']=$_GET['kodeKelompok'];
$dataParam['kodepemilik']=$_GET['kodepemilik'];
//pr($dataParam);

$PENGHAPUSAN = new RETRIEVE_PENGHAPUSAN;
$PENGGUNAAN = new RETRIEVE_PENGGUNAAN;

//////pr($data);
//exit;
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
          $sOrder = "ORDER BY ast.kodeKelompok,ast.noRegister";
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

$dataParam['condition']="$sWhere ";
$dataParam['order']=$sOrder;  
$dataParam['limit']="$sLimit";

$dataSESSION = $PENGGUNAAN->retrieve_usulan_penggunaan($dataParam); 
//pr($dataSESSION);
//exit;
// /* Data set length after filtering */
if($dataSESSION[data]){
  $sQuery = "
    SELECT FOUND_ROWS()
  ";
  $rResultFilterTotal = $DBVAR->query($sQuery);
  $aResultFilterTotal = $DBVAR->fetch_array($rResultFilterTotal);
  $iFilteredTotal = $aResultFilterTotal[0];
}else{
  $iFilteredTotal = 0 ;
}


//echo $iFilteredTotal ;

/* Total data set length */
if($dataSESSION[count]){
  $sQuery = "
    SELECT COUNT(`" . $sIndexColumn . "`)
    FROM   $sTable where Aset_ID IN ($dataSESSION[count])";
  //echo "$sQuery";
  $rResultTotal = $DBVAR->query($sQuery);
  $aResultTotal = $DBVAR->fetch_array($rResultTotal);
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

///////pr($output);
//exit;

$data_post=$PENGHAPUSAN->apl_userasetlistHPS("RVWUSPNG");

$POST=$PENGHAPUSAN->apl_userasetlistHPS_filter($data_post);
$POST['penghapusanfilter']=$POST;
    if($POST){
      // ////////pr($_SESSION['reviewAsetUsulan']['penghapusanfilter']);
      foreach ($dataSESSION['data'] as $keySESSION => $valueSESSION) {
        // ////////pr($valueSESSION['Aset_ID']);
        if(!in_array($valueSESSION['Aset_ID'], $POST['penghapusanfilter'])){
          // echo "stringnot";
          $data[]=$valueSESSION;
          $data[$keySESSION]['checked']="";
        }else{

          $data[]=$valueSESSION;
          $data[$keySESSION]['checked']="checked";
        }
      }
    
    }
$no=$_GET['iDisplayStart']+1;
  if (!empty($data))
					{
foreach ($data as $key => $value)
						{
							// ////pr($get_data_filter);
              $NamaSatker=$PENGHAPUSAN->getNamaSatker($value[kodeSatker]);
							if($value[kondisi]==2){
								$kondisi="Rusak Ringan";
							}elseif($value[kondisi]==3){
								$kondisi="Rusak Berat";
							}elseif($value[kondisi]==1){
								$kondisi="Baik";
							}
							// ////pr($value[TglPerolehan]);
							$TglPerolehanTmp=explode("-", $value[TglPerolehan]);
							// ////pr($TglPerolehanTmp);
							$TglPerolehan=$TglPerolehanTmp[2]."/".$TglPerolehanTmp[1]."/".$TglPerolehanTmp[0];
                                          
                 $row = array();
                 
                 $checkbox="<input type=\"checkbox\" id=\"checkbox\" class=\"icheck-input checkbox\" onchange=\"return AreAnyCheckboxesChecked();\" name=\"penghapusanfilter[]\" value=\"{$value['Aset_ID']}\" {$value['checked']}>";
                 $row[]=$no;
                 $row[]=$checkbox;
                 $row[]="<center>".$value['noRegister']."</center>" ;
                 $row[]=$value['noKontrak'];
                 /*$row[]="{$value[kodeLokasi]}<br/>[{$value[kodeKelompok]}]<br/>{$value[Uraian]}";*/
                 $row[]="[{$value[kodeKelompok]}]<br/>{$value[Uraian]}";
                 $row[]="[".$value[kodeSatker] ."]<br/>". $NamaSatker[0]['NamaSatker'];
                 $row[]="<center>".$TglPerolehan."</center>";
                 $row[]=number_format($value[NilaiPerolehan],4);
                 $row[]=$kondisi. ' - ' .$value[AsalUsul];
                 $row[]="{$value[Merk]}$value[Model] ";
                 
                 $output['aaData'][] = $row;
                  $no++;
                    }
              }
echo json_encode($output);

?>

