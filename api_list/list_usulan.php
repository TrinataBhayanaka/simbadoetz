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
$aColumns = array('Usl.Usulan_ID','Usl.NoUsulan','Usl.TglUpdate','Usl.SatkerUsul','Usl.SatkerTujuan','Usl.KetUsulan','s.NamaSatker');

/* Indexed column (used for fast and accurate table cardinality) */
$sIndexColumn = "Usulan_ID";

/* DB table to use */
$sTable = "usulan as Usl";
$dataParam['tahun']=$_GET['tahun'];
$MUTASI = new RETRIEVE_MUTASI;

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
$dataParam['condition']="$sWhere ";
$dataParam['order']=$sOrder;  
$dataParam['limit']="$sLimit";

$data = $MUTASI->retrieve_daftar_usulan($dataParam); 
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
  $paramCount = " WHERE YEAR(Usl.TglUpdate) ='{$thnParam}' AND Usl.FixUsulan=1 AND Usl.Jenis_Usulan='MTS'"; 
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
							
              $SatkerAsal="[".$value[SatkerUsul]."]"."&nbsp;".$value[NamaSatkerAsal];
              $SatkerTujuan="[".$value[SatkerTujuan]."]"."&nbsp;".$value[NamaSatkerTujuan];
              
              //countUsulan
              $count = $MUTASI->countUsulan($value[Usulan_ID]);
              //pr($count);
              $jumlahAset = $count['count'];
              $totalNilaiPerolehan = $count['nilai'];
              
              $change=$value[TglUpdate]; 
              $change2=  format_tanggal_db3($change); 
              

              if($value['StatusPenetapan']==0){
                  $label="warning";
                  $text="<span class=\"label label-{$label}\" >belum diproses</span>";
                }elseif($value['StatusPenetapan']==1){
                  $label="info";
                  $text="<span class=\"label label-{$label}\" >sudah ditetapkan</span>";
                }
                
                if($value['Penetapan_ID'] == 0){
                  $textvalid="";
                }else{
                   $textvalid="<span class=\"label\" style=\"margin-top:3px\">Belum Validasi</span>";
                   if($value['Status'] == 1){
                        $textvalid="<span class=\"label label-success\" style=\"margin-top:3px\">Sudah Validasi</span>";
                   }
                }
							
              if($value['StatusPenetapan']==0){
              
                  
              $tindakan="<a href=\"{$url_rewrite}/module/mutasiSkpd/penghapusan_usulan_daftar_proses_hapus.php?id={$value[Usulan_ID]}\" class=\"btn btn-danger btn-small\" onclick=\"return confirm('Hapus Data');\" style=\"margin-top:3px\"><i class=\"fa fa-trash\"></i>&nbsp;Hapus</a>
              
              <a href=\"{$url_rewrite}/module/mutasiSkpd/dftr_review_edit_aset_usulan.php?id={$value[Usulan_ID]}\" class=\"btn btn-success btn-small\" style=\"margin-top:3px\"><i class=\"fa fa-pencil-square-o\"></i>&nbsp;View</a>

            <a target=\"_blank\" href=\"{$url_rewrite}/report/template/MUTASI/cetak_usulan_mutasi.php?idusulan={$value[Usulan_ID]}&noUsul={$value[NoUsulan]}&tglHapus={$value[TglUpdate]}\" class=\"btn btn-info btn-small\" style=\"margin-top:3px\"><i class=\"fa fa-file-pdf-o\"></i> Pdf</a>&nbsp
             <a target=\"_blank\" href=\"{$url_rewrite}/report/template/MUTASI/cetak_usulan_mutasi.php?idusulan={$value[Usulan_ID]}&noUsul={$value[NoUsulan]}&tglHapus={$value[TglUpdate]}&tipe_file=2\" class=\"btn btn-info btn-small\" style=\"margin-top:3px\"><i class=\"fa fa-file-excel-o\"></i> Excel</a>&nbsp";
                  
                 
                    
                    
              }elseif($value['StatusPenetapan']==1){
               
                 $tindakan="<a href=\"{$url_rewrite}/module/mutasiSkpd/dftr_review_edit_aset_usulan.php?id={$value[Usulan_ID]}\" class=\"btn btn-success btn-small\" style=\"margin-top:3px\"><i class=\"fa fa-pencil-square-o\"></i>&nbsp;View</a>

                  <a target=\"_blank\" href=\"{$url_rewrite}/report/template/MUTASI/cetak_usulan_mutasi.php?idusulan={$value[Usulan_ID]}&noUsul={$value[NoUsulan]}&tglHapus={$value[TglUpdate]}\" class=\"btn btn-info btn-small\" style=\"margin-top:3px\"><i class=\"fa fa-file-pdf-o\"></i> Pdf</a>&nbsp
                   <a target=\"_blank\" href=\"{$url_rewrite}/report/template/MUTASI/cetak_usulan_mutasi.php?idusulan={$value[Usulan_ID]}&noUsul={$value[NoUsulan]}&tglHapus={$value[TglUpdate]}&tipe_file=2\" class=\"btn btn-info btn-small\" style=\"margin-top:3px\"><i class=\"fa fa-file-excel-o\"></i> Excel</a>&nbsp";
              
             
              }  
                
              $NoUsulan=explode("/", $value['NoUsulan']);

              $hasilNoUsulan=implode("/ ", $NoUsulan);
                
               $row = array();
                             
              $row[]=$no;
              $row[]=$hasilNoUsulan;
              $row[]=$SatkerAsal;
              $row[]=$SatkerTujuan;
              $row[]="<center>".$jumlahAset."</center>";
              $row[]=$change2;
              $row[]=number_format($totalNilaiPerolehan,2,",","."); 
              $row[]=$value[KetUsulan];
              $row[]=$text.$textvalid;
              $row[]=$tindakan;
               
              $output['aaData'][] = $row;
              $no++;
            }
      }
echo json_encode($output);

?>

