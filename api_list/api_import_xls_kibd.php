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


$aColumns = array('temp_Jaringan_ID','temp_Jaringan_ID','kodeKelompok','uraian','kodeLokasi','Jumlah','NilaiPerolehan','temp_Jaringan_ID');

/* Indexed column (used for fast and accurate table cardinality) */
$sIndexColumn = "temp_Jaringan_ID";

/* DB table to use */
$sTable = "tmp_jaringan";
$dataParam['bup_nokontrak']=$_GET['bup_nokontrak'];
$dataParam['jenisaset'][0]=$_GET['jenisaset'];
$dataParam['kodeSatker']=$_GET['kodeSatker'];
$dataParam['page']=$_GET['page'];

$RETRIEVE_PEROLEHAN = new RETRIEVE_PEROLEHAN;
$PENGHAPUSAN = new RETRIEVE_PENGHAPUSAN;

////pr($data);
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
          $sOrder = "";
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

/*$sQuery="select SQL_CALC_FOUND_ROWS M.*,I.*,U.*,S.*,J.*,M.tgl_update as tgl_ubah
               from mahasiswa M left  join  ijin I on I.mahasiswa_idmahasiswa=M.idmahasiswa
               left join universitas U on U.kodeUniversitas=M.universitas_iduniversitas
               left join status S on S.idstatus=I.status_idstatus 
               left join jurusan J on J.idjurusan=M.jurusan_idjurusan 
               left join prodi F on F.idprodi=M.prodi_idprodi
                $sWhere
	$sOrder
	$sLimit";*/
//echo $sQuery;

//echo $sWhere;
$dataParam['condition']="$sWhere ";
$dataParam['order']=$sOrder;  
$dataParam['limit']="$sLimit";
//pr($dataParam);
// list($dataSESSION,$iFilteredTotal ) = $PENGHAPUSAN->retrieve_usulan_penghapusan_pmd($dataParam);	

$dataSESSION = $RETRIEVE_PEROLEHAN->get_tmpData($dataParam,'tmp_jaringan'); 
//pr($dataSESSION);
//exit;
//$rResult = $DBVAR->query($sQuery);

// /* Data set length after filtering */
$sQuery = "
		SELECT FOUND_ROWS()
	";
$rResultFilterTotal = $DBVAR->query($sQuery);
$aResultFilterTotal = $DBVAR->fetch_array($rResultFilterTotal);
$iFilteredTotal = $aResultFilterTotal[0];

//echo $iFilteredTotal ;

/* Total data set length */
$sQuery = "
		SELECT COUNT(`" . $sIndexColumn . "`)
		FROM   $sTable
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

/////pr($output);
//exit;

$data_post=$PENGHAPUSAN->apl_userasetlistHPS("XLSIMPD");

$POST=$PENGHAPUSAN->apl_userasetlistHPS_filter($data_post);

if($POST){
  foreach ($POST as $key => $value) {
    $tmp = explode("|", $value);
    $newlist[$key] = $tmp[0];
  }
} else {
  $newlist = array();
}
    
      // //////pr($_SESSION['reviewAsetUsulan']['penghapusanfilter']);
      foreach ($dataSESSION as $keySESSION => $valueSESSION) {
        // //////pr($valueSESSION['Aset_ID']);
        if(!in_array($valueSESSION['temp_Jaringan_ID'], $newlist)){
          // echo "stringnot";
          $data[]=$valueSESSION;
          $data[$keySESSION]['checked']="";
        }else{

          $data[]=$valueSESSION;
          $data[$keySESSION]['checked']="checked";
        }
      }
    
    
    // pr($data);
$no=$_GET['iDisplayStart']+1;
  if (!empty($data))
					{
foreach ($data as $key => $value)
						{
							
                                          
               $row = array();
               
               $checkbox="<input {$value['style']} type=\"{$value['other']}\" {$value['checked']} id=\"check_{$no}\" class=\"icheck-input\" name=\"aset[]\" 
                      value=\"{$value['temp_Jaringan_ID']}|{$value['NilaiTotal']}\" onchange=\"return AreAnyCheckboxesChecked();\">";
               $row[]=$no;
               $row[]=$checkbox;
               $row[]=$value['kodeKelompok'] ;
               $row[]=$value['uraian'];
               $row[]=$value['kodeLokasi'];
               $row[]=$value['Jumlah'];
               $row[]=number_format($value['NilaiPerolehan']);
               $row[]=number_format($value['NilaiTotal']);
               
               $output['aaData'][] = $row;
                $no++;
            }
              }
echo json_encode($output);

?>

