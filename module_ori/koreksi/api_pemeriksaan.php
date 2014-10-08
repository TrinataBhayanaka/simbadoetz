<?php
  include "../../config/database.php";  
  open_connection();  
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
 // jumlah data yang akan ditampilkan per halaman
/*$dataPerPage = 10;
 
// apabila $_GET['page'] sudah didefinisikan, gunakan nomor halaman tersebut, 
// sedangkan apabila belum, nomor halamannya 1. 
if(isset($_GET['page']))
{
    $noPage = $_GET['page'];
} 
else $noPage = 1;
 
// perhitungan offset
$offset = ($noPage - 1) * $dataPerPage;*/
  
  $tahun=$_GET['tahun'];
//order by TglPemeriksaan desc LIMIT $offset, $dataPerPage
$query_dokumen=" select Penerimaan_ID,NoBAPemeriksaan from Penerimaan where NoBAPemeriksaan is not Null and TglPemeriksaan like '%$tahun%'  ";
                                                               $result_dokumen=mysql_query($query_dokumen) or die(mysql_error());
                                                               $NoBaPemeriksaan="";
                                                               echo "<option value=\"\">-</option>";
                                                                echo " <option value=\"data_baru\" >Data Baru</option>";
                                                                while ($row_dokumen=mysql_fetch_object($result_dokumen)){
                                                                    $Penerimaan_ID=$row_dokumen->Penerimaan_ID;
                                                                    $NoBaPemeriksaan=$row_dokumen->NoBAPemeriksaan;
                                                                    
                                                                    if($NoBaPemeriksaan!="")
                                                                    echo "<option value=\"$Penerimaan_ID\">$NoBaPemeriksaan</option>";
                                                                    //$NoBaPemeriksaan="";
                                                               }
?>
