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


$aColumns = array('P.Penghapusan_ID','P.Usulan_ID','P.SatkerUsul','P.SatkerUsul','P.NoSKHapus','P.TglHapus','P.AlasanHapus','P.Penghapusan_ID');

/* Indexed column (used for fast and accurate table cardinality) */
$sIndexColumn = "Penghapusan_ID";

/* DB table to use */
$sTable = "penghapusan";
$dataParam['tahun']=$_GET['tahun'];
//pr($dataParam);
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

//echo $sWhere;
$dataParam['condition']="$sWhere ";
$dataParam['order']=$sOrder;  
$dataParam['limit']="$sLimit";
// pr($dataParam);
// list($data,$iFilteredTotal ) = $PENGHAPUSAN->retrieve_daftar_usulan_penghapusan_pmd($dataParam);	

$data = $PENGHAPUSAN->retrieve_daftar_penetapan_penghapusan_pms_rev($dataParam); 
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
if(trim($dataParam['tahun'])){
  $cond = " WHERE FixPenghapusan=1 AND Jenis_Hapus='PMS'  AND YEAR(TglHapus) ='{$dataParam[tahun]}'";
}else{
  $cond = " WHERE FixPenghapusan=1 AND Jenis_Hapus='PMS'";
}
/* Total data set length */
$sQuery = "
		SELECT COUNT(`" . $sIndexColumn . "`)
		FROM   $sTable {$cond}
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
							$NamaSatker=$PENGHAPUSAN->getNamaSatker($value[SatkerUsul]);

              $jmlh=explode(",", $value[Usulan_ID]);
              $jmlUsul=0;
              foreach ($jmlh as $keyjmlUsul => $valuekeyjmlUsul) {
                if($valuekeyjmlUsul){
                  $jmlUsul=$jmlUsul+1;
                }
              }
              if($jmlUsul==0){
                $jmlUsul="-";
              }
              // $jumlahAset=count($jmlh);
              $change=$value[TglHapus]; 
              $change2=  format_tanggal_db3($change); 
              // echo "$change2";
            
              if($value['Status']==0){
                $label="warning";
                $text="Belum Divalidasi";
              }elseif($value['Status']==1){
                $label="success";
                $text="sudah Divalidasi";
              }elseif($value['Status']==2){
                $label="info";
                $text="proses pemasukan data";
             
             }elseif($value['Status']==3){
                $label="info";
                $text="proses validasi data";
              }
              
                  if($value['Status']==0){
              
                      if($_SESSION['ses_ujabatan']==1){
                           $tindakan="<a href=\"{$url_rewrite}/module/penghapusanv2/dftr_review_edit_aset_penetapan_pms.php?id={$value[Penghapusan_ID]}\" class=\"btn btn-success btn-small\" style=\"margin-top:3px\"><i class=\"fa fa-pencil-square-o\"></i> View</a>&nbsp;
                            <a href=\"$url_rewrite/module/penghapusanv2/penetapan_penghapusan_daftar_hapus_pms.php?id={$value[Penghapusan_ID]}\" class=\"btn btn-danger btpenetapanl\" style=\"margin-top:3px\"> <i class=\"fa fa-trash\"></i>Hapus</a>";
                      }else{
                          $tindakan="<a href=\"{$url_rewrite}/module/penghapusanv2/dftr_review_edit_penetapan_usulan_pms.php?id={$value[Penghapusan_ID]}\" class=\"btn btn-success btn-small\" style=\"margin-top:3px\"><i class=\"fa fa-pencil-square-o\"></i> View</a>";
                      }
                 
                    
                    
                }elseif($value['Status']==1){
                 if($value['Usulan_ID']!=""){
                   $tindakan="<a href=\"{$url_rewrite}/module/penghapusanv2/dftr_review_edit_aset_penetapan_pms.php?id={$value[Penghapusan_ID]}\" class=\"btn btn-success btn-small\" style=\"margin-top:3px\"><i class=\"fa fa-pencil-square-o\"></i> View</a>&nbsp;

              <a target=\"_blank\" href=\"{$url_rewrite}/report/template/PENGHAPUSAN/cetak_sk_penghapusan.php?idpenetapan={$value[Penghapusan_ID]}&sk={$value[NoSKHapus]}&tglHapus={$value[TglHapus]}\" class=\"btn btn-info btn-small\" style=\"margin-top:3px\"><i class=\"fa fa-file-pdf-o\"></i> Pdf</a>&nbsp;
              <a target=\"_blank\" href=\"{$url_rewrite}/report/template/PENGHAPUSAN/cetak_sk_penghapusan.php?idpenetapan={$value[Penghapusan_ID]}&sk={$value[NoSKHapus]}&tglHapus={$value[TglHapus]}&tipe_file=2\" class=\"btn btn-info btn-small\" style=\"margin-top:3px\"><i class=\"fa fa-file-excel-o\"></i> Excel</a>&nbsp;";
                }else{
                 $tindakan=" <a target=\"_blank\" href=\"{$url_rewrite}/report/template/PENGHAPUSAN/cetak_sk_penghapusan.php?idpenetapan={$value[Penghapusan_ID]}&sk={$value[NoSKHapus]}&tglHapus={$value[TglHapus]}\" class=\"btn btn-info btn-small\" style=\"margin-top:3px\"><i class=\"fa fa-file-pdf-o\"></i> Report</a>&nbsp;
                 <a target=\"_blank\" href=\"{$url_rewrite}/report/template/PENGHAPUSAN/cetak_sk_penghapusan.php?idpenetapan={$value[Penghapusan_ID]}&sk={$value[NoSKHapus]}&tglHapus={$value[TglHapus]}&tipe_file=2\" class=\"btn btn-info btn-small\" style=\"margin-top:3px\"><i class=\"fa fa-file-excel-o\"></i> Excel</a>&nbsp;";
               
                }  

              }
              $NilaiASet=$PENGHAPUSAN->totalNilaiPenghapusanAset($value['Penghapusan_ID']);
              // pr($NilaiASet);
              
              $Asetditerima=$PENGHAPUSAN->totalDataPenghapusanAset($value['Penghapusan_ID']);
              if($Asetditerima){
                $TotalAset=count($Asetditerima);  
              }else{
                $TotalAset = 0;
              }
              $row = array();
                             
              $row[]=$no;
              $row[]=$value['NoSKHapus'] ;
              $row[]="[".$value['SatkerUsul']."]"."<br/>".$value['NamaSatker'];
              $row[]=$jmlUsul;
              $row[]= $TotalAset;
              $row[]=$change2;
              $row[]=number_format($NilaiASet['TotalNilaiPerolehan'],4);
              $row[]=$value[AlasanHapus];
              $row[]="<span class=\"label label-{$label}\" >{$text}</span>";
                             $row[]=$tindakan;
              $output['aaData'][] = $row;
              $no++;
                }
        }
echo json_encode($output);

?>

