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

$dataParam['jenisaset'][0]=$_GET['jenisaset'];
if($_GET['jenisaset']=="2")
     $merk="m.Merk";
else
     $merk="";
$aColumns = array('a.Aset_ID','a.Aset_ID','a.noRegister','a.noKontrak','k.Uraian','a.kodeSatker','a.TglPerolehan','a.NilaiPerolehan','a.kondisi',$merk,);

/* Indexed column (used for fast and accurate table cardinality) */
$sIndexColumn = "Aset_ID";

/* DB table to use */
$sTable = "aset";
$dataParam['nokontrak']=$_GET['nokontrak'];
$dataParam['jenisaset'][0]=$_GET['jenisaset'];
$dataParam['kodesatker']=$_GET['kodesatker'];
$dataParam['page']=$_GET['page'];

$PENGGUNAAN = new RETRIEVE_PENGGUNAAN;

//pr($data);
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
$data = $PENGGUNAAN->retrieve_penetapan_penggunaan($dataParam);	
//pr($data);
//exit;
//$rResult = $DBVAR->query($sQuery);

/* Data set length after filtering */
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
//pr($aResultTotal );
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

///pr($output);
//exit;
$no=$_GET['iDisplayStart']+1;
  if (!empty($data))
					{
foreach ($data as $key => $value)
						{
							// pr($get_data_filter);
							if($value[kondisi]==2){
								$kondisi="Rusak Ringan";
							}elseif($value[kondisi]==3){
								$kondisi="Rusak Berat";
							}elseif($value[kondisi]==1){
								$kondisi="Baik";
							}
							// pr($value[TglPerolehan]);
							$TglPerolehanTmp=explode("-", $value[TglPerolehan]);
							// pr($TglPerolehanTmp);
							$TglPerolehan=$TglPerolehanTmp[2]."/".$TglPerolehanTmp[1]."/".$TglPerolehanTmp[0];
                                          

                             $row = array();
                             
                             $checkbox="<input type=\"checkbox\" id=\"checkbox\" class=\"checkbox\" onchange=\"enable()\" name=\"Penggunaan[]\" value=\"{$value['Aset_ID']}\">";
                             $row[]=$no;
                             $row[]=$checkbox;
                             $row[]=$value['noRegister'] ;
                             $row[]=$value['noKontrak'];
                             $row[]="{$value[kodeKelompok]}<br/>{$value[Uraian]}";
                             $row[]="[".$value[kodeSatker] ."]". $value[NamaSatker];
                             $row[]=$TglPerolehan;
                             $row[]=number_format($value[NilaiPerolehan]);
                             $row[]=$kondisi. ' - ' .$value[AsalUsul];
                             $row[]="{$value[Merk]}$value[Model] ";
                             
                             $output['aaData'][] = $row;
                              $no++;
                    }
              }

echo json_encode($output);

?>

