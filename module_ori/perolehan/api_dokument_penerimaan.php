<?php
  include "../../config/database.php";  
  open_connection();  
function balik_tanggal($tgl){
     $temp=explode("-",$tgl);
     return $temp[2]."/". $temp[1]."/".$temp[0];
}

$id=$_GET['id'];
 $query_dokumen=" select * from Penerimaan where Penerimaan_ID='$id'";
// echo "$query_dokumen";
                                                               $result_dokumen=mysql_query($query_dokumen) or die(mysql_error());
                                                               while ($row_dokumen=mysql_fetch_object($result_dokumen)){
                                                                    $NoBaPemeriksaan=$row_dokumen->NoBAPemeriksaan;
                                                                    $TglPemeriksaan=balik_tanggal($row_dokumen->TglPemeriksaan);
                                                                     $KetuaPemeriksa=$row_dokumen-> KetuaPemeriksa;
                                                                     $NoBAPenerimaan  =$row_dokumen->NoBAPenerimaan;
                                                                      $TglPenerimaan=balik_tanggal($row_dokumen->TglPenerimaan);
                                                                      $NamaPenyedia=$row_dokumen->NamaPenyedia;
                                                                      $NamaPenyimpan=$row_dokumen->NamaPenyimpan;
                                                                       	$NIPPenyimpan=$row_dokumen-> NIPPenyimpan;
                                                                      
                                                                        $hasil= "$NoBaPemeriksaan|$TglPemeriksaan|$KetuaPemeriksa|$NoBAPenerimaan|$TglPenerimaan|$NamaPenyedia|$NamaPenyimpan|$NIPPenyimpan";
                                                                        $hasil2=trim($hasil);
                                                                        
                                                                    }
                                                                    echo $hasil2;
                                                                    
?>