<?php
  include "../../config/database.php";  
  open_connection();
function balik_tanggal($tgl){
     $temp=explode("-",$tgl);
     return $temp[2]."/". $temp[1]."/".$temp[0];
}

$id=$_GET['id'];
 $query_dokumen=" select * from SP2D where SP2D_ID='$id'";
// echo "$query_dokumen";
                                                               $result_dokumen=mysql_query($query_dokumen) or die(mysql_error());
                                                               while ($row_dokumen=mysql_fetch_object($result_dokumen)){
                                                                    $NoSP2D=$row_dokumen->NoSP2D;
                                                                    $TglSP2D=balik_tanggal($row_dokumen->TglSP2D);
                                                                     $NilaiSP2D=$row_dokumen-> NilaiSP2D;
                                                                    
                                                                      
                                                                        $hasil= "$NoSP2D|$TglSP2D|$NilaiSP2D";
                                                                        $hasil2=trim($hasil);
                                                                        
                                                                    }
                                                                    echo $hasil2;
                                                                    
?>