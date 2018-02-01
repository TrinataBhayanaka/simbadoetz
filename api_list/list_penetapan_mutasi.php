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


$aColumns = array('P.Mutasi_ID','P.SatkerUsul','P.SatkerTujuan','P.NoSKKDH','P.TglSKKDH','P.Keterangan');

/* Indexed column (used for fast and accurate table cardinality) */
$sIndexColumn = "Mutasi_ID";

/* DB table to use */
$sTable = "mutasi";
$dataParam['tahun']=$_GET['tahun'];
//pr($dataParam);
$MUTASI = new RETRIEVE_MUTASI;

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
          $sOrder = "ORDER BY Mutasi_ID desc";
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

$data = $MUTASI->retrieve_daftar_penetapan($dataParam); 
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
  $cond = " WHERE FixMutasi=1 AND YEAR(TglSKKDH) ='{$dataParam[tahun]}'";
}else{
  $cond = " WHERE FixMutasi=1 ";
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
							$NamaSatker=$MUTASI->getNamaSatker($value[SatkerUsul]);

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
              $change=$value[TglSKKDH]; 
              $change2=  format_tanggal_db3($change); 
              // echo "$change2";
            
              if($value['FixMutasi']==0){
                $label="warning";
                $text="Belum Divalidasi";
              }elseif($value['FixMutasi']==1){
                $label="success";
                $text="sudah Divalidasi";
              }
               
                  if($value['FixMutasi']==0){
              
                      if($_SESSION['ses_ujabatan']==1){
                           $tindakan="<a href=\"{$url_rewrite}/module/mutasiSkpd/dftr_review_edit_aset_penetapan.php?id={$value[Mutasi_ID]}\" class=\"btn btn-success btn-small\" style=\"margin-top:3px\"><i class=\"fa fa-pencil-square-o\"></i> View</a>&nbsp;
                            <a href=\"$url_rewrite/module/mutasiSkpd/penetapan_daftar_hapus.php?id={$value[Mutasi_ID]}\" class=\"btn btn-danger btpenetapanl\" onclick=\"return confirm('Hapus Data');\" style=\"margin-top:3px\"> <i class=\"fa fa-trash\"></i>Hapus</a>";
                      }else{
                          $tindakan="<a href=\"{$url_rewrite}/module/mutasiSkpd/dftr_review_edit_aset_penetapan.php?id={$value[Mutasi_ID]}\" class=\"btn btn-success btn-small\" style=\"margin-top:3px\"><i class=\"fa fa-pencil-square-o\"></i> View</a>";
                      }
                }elseif($value['FixMutasi']==1){
                 if($value['Usulan_ID']!=""){
                   $tindakan="<a href=\"{$url_rewrite}/module/mutasiSkpd/dftr_review_edit_aset_penetapan.php?id={$value[Mutasi_ID]}\" class=\"btn btn-success btn-small\" style=\"margin-top:3px\"><i class=\"fa fa-pencil-square-o\"></i> View</a>&nbsp;

              <a target=\"_blank\" href=\"{$url_rewrite}/report/template/MUTASI/cetak_penetapan_mutasi.php?idpenetapan={$value[Mutasi_ID]}&sk={$value[NoSKKDH]}&tglHapus={$value[TglSKKDH]}\" class=\"btn btn-info btn-small\" style=\"margin-top:3px\"><i class=\"fa fa-file-pdf-o\"></i> Pdf</a>&nbsp;
              <a target=\"_blank\" href=\"{$url_rewrite}/report/template/MUTASI/cetak_penetapan_mutasi.php?idpenetapan={$value[Mutasi_ID]}&sk={$value[NoSKKDH]}&tglHapus={$value[TglSKKDH]}&tipe_file=2\" class=\"btn btn-info btn-small\" style=\"margin-top:3px\"><i class=\"fa fa-file-excel-o\"></i> Excel</a>&nbsp;";

                }else{
                 $tindakan=" <a target=\"_blank\" href=\"{$url_rewrite}/report/template/MUTASI/cetak_penetapan_mutasi.php?idpenetapan={$value[Mutasi_ID]}&sk={$value[NoSKKDH]}&tglHapus={$value[TglSKKDH]}\" class=\"btn btn-info btn-small\" style=\"margin-top:3px\"><i class=\"fa fa-file-pdf-o\"></i> Report</a>&nbsp;
                 <a target=\"_blank\" href=\"{$url_rewrite}/report/template/MUTASI/cetak_penetapan_mutasi.php?idpenetapan={$value[Mutasi_ID]}&sk={$value[NoSKKDH]}&tglHapus={$value[TglSKKDH]}&tipe_file=2\" class=\"btn btn-info btn-small\" style=\"margin-top:3px\"><i class=\"fa fa-file-excel-o\"></i> Excel</a>&nbsp;";
               
                }  

              }
              $NilaiASet=$MUTASI->totalNilaiMutasiAset($value['Mutasi_ID']);
              // pr($NilaiASet);
              
              $Asetditerima=$MUTASI->totalDataMutasiAset($value['Mutasi_ID']);
              if($Asetditerima){
                $TotalAset=count($Asetditerima);  
              }else{
                $TotalAset = 0;
              }
              $row = array();
                             
              $row[]=$no;
              $row[]=$value['NoSKKDH'] ;
              $row[]="[".$value['SatkerUsul']."]"."<br/>".$value['NamaSatker'];
              $row[]="<center>".$value['SatkerTujuan']."</center>";
              $row[]="<center>".$jmlUsul."</center>";
              $row[]="<center>".$TotalAset."</center>";
              $row[]=$change2;
              $row[]=number_format($NilaiASet['TotalNilaiPerolehan'],4);
              $row[]=$value[Keterangan];
              $row[]="<span class=\"label label-{$label}\" >{$text}</span>";
                             $row[]=$tindakan;
              $output['aaData'][] = $row;
              $no++;
                }
        }
echo json_encode($output);

?>

