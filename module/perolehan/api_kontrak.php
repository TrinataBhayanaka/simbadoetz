<?php
  include "../../config/database.php";  
  open_connection();
function balik_tanggal($tgl){
     $temp=explode("-",$tgl);
     return $temp[2]."/". $temp[1]."/".$temp[0];
}

$id=$_GET['id'];
 $query_dokumen=" select * from Kontrak where Kontrak_ID='$id'";
// echo "$query_dokumen";
                                                               $result_dokumen=mysql_query($query_dokumen) or die(mysql_error());
                                                               while ($row_dokumen=mysql_fetch_object($result_dokumen)){
                                                                    $NoKontrak=$row_dokumen->NoKontrak;
                                                                    $NilaiKontrak=$row_dokumen->NilaiKontrak;
                                                                    $Pekerjaan=$row_dokumen-> Pekerjaan;
                                                                    $TglKontrak=balik_tanggal($row_dokumen->TglKontrak);
                                                                    
                                                                      
                                                                        $hasil= "$NoKontrak|$NilaiKontrak|$Pekerjaan| |$TglKontrak";
                                                                        $hasil2=trim($hasil);
                                                                        
                                                                    }
                                                                    echo $hasil2;
                                                                    
?>