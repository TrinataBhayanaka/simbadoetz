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
$aColumns = array('Usl.Usulan_ID','Usl.NoUsulan','Usl.SatkerUsul','Usl.SatkerUsul','Usl.TglUpdate','Usl.SatkerUsul','Usl.KetUsulan','Usl.SatkerUsul','Usl.SatkerUsul');

/* Indexed column (used for fast and accurate table cardinality) */
$sIndexColumn = "Usulan_ID";

/* DB table to use */
$sTable = "usulan";
$dataParam['bup_nokontrak']=$_GET['bup_nokontrak'];
$dataParam['jenisaset'][0]=$_GET['jenisaset'];
$dataParam['kodeSatker']=$_GET['kodeSatker'];
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
          $sOrder = "ORDER BY Usulan_ID desc";
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
// pr($dataParam);
// list($data,$iFilteredTotal ) = $PENGHAPUSAN->retrieve_daftar_usulan_penghapusan_pmd($dataParam);	

$data = $PENGHAPUSAN->retrieve_daftar_usulan_penghapusan_pms($dataParam); 
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

// echo $iFilteredTotal ;

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

// $data_post=$PENGHAPUSAN->apl_userasetlistHPS("RVWUSPMD");

// $POST=$PENGHAPUSAN->apl_userasetlistHPS_filter($data_post);
// $POST['penghapusanfilter']=$POST;
//     if($POST){
//       // //////pr($_SESSION['reviewAsetUsulan']['penghapusanfilter']);
//       foreach ($dataSESSION as $keySESSION => $valueSESSION) {
//         // //////pr($valueSESSION['Aset_ID']);
//         if(!in_array($valueSESSION['Aset_ID'], $POST['penghapusanfilter'])){
//           // echo "stringnot";
//           $data[]=$valueSESSION;
//           $data[$keySESSION]['checked']="";
//         }else{

//           $data[]=$valueSESSION;
//           $data[$keySESSION]['checked']="checked";
//         }
//       }
    
//     }
$no=$_GET['iDisplayStart']+1;
  if (!empty($data))
					{
foreach ($data as $key => $value)
						{
							// //pr($get_data_filter);
							// if($value[kondisi]==2){
							// 	$kondisi="Rusak Ringan";
							// }elseif($value[kondisi]==3){
							// 	$kondisi="Rusak Berat";
							// }elseif($value[kondisi]==1){
							// 	$kondisi="Baik";
							// }

              $NamaSatker=$PENGHAPUSAN->getNamaSatker($value[SatkerUsul]);
              $totalNilaiPerolehan=$PENGHAPUSAN->TotalNilaiPerolehan($value[Aset_ID]); 
              // pr($totalNilaiPerolehan);
              $jmlh=explode(",", $value[Aset_ID]);
              $jumlahAset=0;
              foreach ($jmlh as $keyJMlaset => $valuekeyJMlaset) {
                if($valuekeyJMlaset){
                  $jumlahAset=$jumlahAset+1;
                }
              }
              // $jumlahAset=count($jmlh);
              $change=$value[TglUpdate]; 
              $change2=  format_tanggal_db3($change); 
              // echo "$change2";
            
              if($value['SatkerUsul']){ 
                $SatkerUsul="[".$value['SatkerUsul']."] ".$NamaSatker[0]['NamaSatker'];
               // echo ;
              }else{
                $SatkerUsul=$NamaSatker[0]['NamaSatker'];
              }

              if($value['StatusPenetapan']==0){
                  $label="warning";
                  $text="<span class=\"label label-{$label}\" >belum diproses</span>";
                }elseif($value['StatusPenetapan']==1){
                  $label="info";
                  $text="<span class=\"label label-{$label}\" >sudah ditetapkan</span>";
                }

                if($value['Penetapan_ID']==0){
                  $textvalid="";
                }else{
                   $textvalid="<span class=\"label\" style=\"margin-top:3px\">Belum Validasi</span>";
                   if($value['Penetapan_ID']){
                     $datastatus=$PENGHAPUSAN->DataPenetapan($value['Penetapan_ID']);
                      if($datastatus[0]['Status']==1){
                        $textvalid="<span class=\"label label-success\" style=\"margin-top:3px\">Sudah Validasi</span>";
                   
                      }
                   }
                }
							// //pr($value[TglPerolehan]);
							// $TglPerolehanTmp=explode("-", $value[TglPerolehan]);
							// // //pr($TglPerolehanTmp);
							// $TglPerolehan=$TglPerolehanTmp[2]."/".$TglPerolehanTmp[1]."/".$TglPerolehanTmp[0];
              if($value['StatusPenetapan']==0){
              
                  
                      $tindakan="<a href=\"{$url_rewrite}/module/penghapusan/penghapusan_usulan_daftar_proses_hapus_pms.php?id={$value[Usulan_ID]}\" class=\"btn btn-danger btn-small\" onclick=\"return confirm('Hapus Data');\" style=\"margin-top:3px\"><i class=\"fa fa-trash\"></i>&nbsp;Hapus</a>
                      <a href=\"{$url_rewrite}/module/penghapusan/dftr_review_edit_aset_usulan_pms.php?id={$value[Usulan_ID]}\" class=\"btn btn-success btn-small\" onclick=\"return confirm('View Data');\" style=\"margin-top:3px\"><i class=\"fa fa-pencil-square-o\"></i>&nbsp;View</a>

                    <a target=\"_blank\" href=\"{$url_rewrite}/report/template/PENGHAPUSAN/cetak_usulan_penghapusan.php?idusulan={$value[Usulan_ID]}&noUsul={$value[NoUsulan]}&tglHapus={$value[TglUpdate]}\" class=\"btn btn-info btn-small\"style=\"margin-top:3px\"><i class=\"fa fa-file-pdf-o\"></i> Pdf</a>&nbsp
                     <a target=\"_blank\" href=\"{$url_rewrite}/report/template/PENGHAPUSAN/cetak_usulan_penghapusan.php?idusulan={$value[Usulan_ID]}&noUsul={$value[NoUsulan]}&tglHapus={$value[TglUpdate]}&tipe_file=2\" class=\"btn btn-info btn-small\" style=\"margin-top:3px\"><i class=\"fa fa-file-excel-o\"></i> Excel</a>&nbsp";
                  
                 
                    
                    
                }elseif($value['StatusPenetapan']==1){
                 
                   $tindakan="<a href=\"{$url_rewrite}/module/penghapusan/dftr_review_edit_aset_usulan_pms.php?id={$value[Usulan_ID]}\" class=\"btn btn-success btn-small\" onclick=\"return confirm('View Data');\" style=\"margin-top:3px\"><i class=\"fa fa-pencil-square-o\"></i>&nbsp;View</a>
                    <a target=\"_blank\" href=\"{$url_rewrite}/report/template/PENGHAPUSAN/cetak_usulan_penghapusan.php?idusulan={$value[Usulan_ID]}&noUsul={$value[NoUsulan]}&tglHapus={$value[TglUpdate]}\" class=\"btn btn-info btn-small\" style=\"margin-top:3px\"><i class=\"fa fa-file-pdf-o\"></i> Pdf</a>&nbsp
                     <a target=\"_blank\" href=\"{$url_rewrite}/report/template/PENGHAPUSAN/cetak_usulan_penghapusan.php?idusulan={$value[Usulan_ID]}&noUsul={$value[NoUsulan]}&tglHapus={$value[TglUpdate]}&tipe_file=2\" class=\"btn btn-info btn-small\" style=\"margin-top:3px\"><i class=\"fa fa-file-excel-o\"></i> Excel</a>&nbsp";
                
               
                }  

                $NoUsulan=explode("/", $value['NoUsulan']);

                $hasilNoUsulan=implode("/ ", $NoUsulan);
                
                             $row = array();
                             
                             // $checkbox="<input type=\"checkbox\" id=\"checkbox\" class=\"icheck-input checkbox\" onchange=\"return AreAnyCheckboxesChecked();\" name=\"penghapusanfilter[]\" value=\"{$value['Aset_ID']}\" {$value['checked']}>";
                             $row[]=$no;
                             // $row[]=$checkbox;
                             $row[]=$hasilNoUsulan ;
                             $row[]=$SatkerUsul;
                             $row[]=$jumlahAset;
                             $row[]=$change2;
                             $row[]=number_format($totalNilaiPerolehan[TotalNilaiPerolehan],4);
                             $row[]=$value[KetUsulan];
                             $row[]=$text.$textvalid;
                             $row[]=$tindakan;
                             
                             $output['aaData'][] = $row;
                              $no++;
                    }
              }
echo json_encode($output);

?>

