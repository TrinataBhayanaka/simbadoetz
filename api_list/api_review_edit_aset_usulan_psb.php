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
     $merk="ast.Aset_ID";
$aColumns = array('a.Aset_ID','a.Aset_ID','a.noRegister','a.noKontrak','k.Uraian','a.kodeSatker','a.TglPerolehan','a.NilaiPerolehan','a.kodeKelompok','a.AsalUsul','a.AsalUsul');

/* Indexed column (used for fast and accurate table cardinality) */
$sIndexColumn = "Aset_ID";

/* DB table to use */
$sTable = "aset";
$dataParam['bup_nokontrak']=$_GET['bup_nokontrak'];
$dataParam['jenisaset'][0]=$_GET['jenisaset'];
$dataParam['kodeSatker']=$_GET['kodeSatker'];
$dataParam['kodeKelompok']=$_GET['kodeKelompok'];
$dataParam['id']=$_GET['id'];
$dataParam['page']=$_GET['page'];

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

$dataSESSION = $PENGHAPUSAN->retrieve_daftar_usulan_penghapusan_edit_data_psb($dataParam); 
// pr($data);
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

// pr($output);
//exit;

$data_post=$PENGHAPUSAN->apl_userasetlistHPS("DELUSPMS");

$POST=$PENGHAPUSAN->apl_userasetlistHPS_filter($data_post);
$POST['penghapusanfilter']=$POST;
    if($POST){
      // //////pr($_SESSION['reviewAsetUsulan']['penghapusanfilter']);
      foreach ($dataSESSION as $keySESSION => $valueSESSION) {
        // //////pr($valueSESSION['Aset_ID']);
        if(!in_array($valueSESSION['Aset_ID'], $POST)){
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
							// pr($value);
              $NamaSatker=$PENGHAPUSAN->getNamaSatker($value[kodeSatker]);


              $SelectKIB=$PENGHAPUSAN->SelectKIB($value[Aset_ID],$value[TipeAset]);
              // pr($SelectKIB);
							if($value[kondisi]==2){
								$kondisi="Rusak Ringan";
							}elseif($value[kondisi]==3){
								$kondisi="Rusak Berat";
							}elseif($value[kondisi]==1){
								$kondisi="Baik";
							}
							// //pr($value[TglPerolehan]);
							$TglPerolehanTmp=explode("-", $value[TglPerolehan]);
							// //pr($TglPerolehanTmp);
							$TglPerolehan=$TglPerolehanTmp[2]."/".$TglPerolehanTmp[1]."/".$TglPerolehanTmp[0];
       
                if($value['StatusKonfirmasi']==0){
                  $label="warning";
                  $text="proses";
                }elseif($value['StatusKonfirmasi']==1){
                  $label="success";
                  $text="Diterima";
                }elseif($value['StatusKonfirmasi']==2){
                  $label="danger";
                  $text="Ditolak";
                }
              
              if($value[StatusValidasi]==1){
                $NilaiPerolehanAwal=$value[NilaiPerolehanTmp];
                $NilaiPerolehanbaru=$value[NilaiPerolehan];
              }else{
                $NilaiPerolehanAwal=$value[NilaiPerolehan];
                $NilaiPerolehanbaru=$value[NilaiPerolehanTmp];
              }
              $StatusKonfirmasi="<span class=\"label label-{$label}\" >{$text}</span>";    
              if($value['StatusPenetapan']==0){              
                 $checkbox="<input type=\"checkbox\" id=\"checkbox\" class=\"icheck-input checkbox\" onchange=\"return AreAnyCheckboxesChecked();\" name=\"penghapusan_nama_aset[]\" value=\"{$value['Aset_ID']}\" {$value['checked']}>";
                }else{
                  $checkbox="&nbsp;";
                }
         
                             $row = array();
                            

                             $row[]=$no;
                             $row[]=$checkbox;
                             $row[]=$value['noRegister'] ;
                             $row[]=$value['noKontrak'];
                             $row[]="{$value[kodeKelompok]}<br/>{$value[Uraian]}";
                             $row[]="[".$value[kodeSatker] ."]<br/>". $NamaSatker[0]['NamaSatker'];
                             $row[]=$TglPerolehan;
                             $row[]=number_format($NilaiPerolehanAwal);
                             $row[]=number_format($NilaiPerolehanbaru);
                             $row[]="{$StatusKonfirmasi}";
                             $row[]="{$SelectKIB[0][Merk]}-{$SelectKIB[0][Model]}";
                             
                             $output['aaData'][] = $row;
                              $no++;
                    }
              }
echo json_encode($output);

?>

