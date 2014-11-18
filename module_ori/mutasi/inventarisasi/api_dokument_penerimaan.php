<?php
  include "../../config/database.php";  
  open_connection();  
function balik_tanggal($tgl){
     $temp=explode("-",$tgl);
     return $temp[2]."/". $temp[1]."/".$temp[0];
}

$id=$_GET['id'];
 $query_dokumen=" select * from Inventarisasi where Inventarisasi_ID='$id'";
// echo "$query_dokumen";
                                                               $result_dokumen=mysql_query($query_dokumen) or die(mysql_error());
                                                               while ($row_dokumen=mysql_fetch_object($result_dokumen)){
                                                                    $NoDokInventarisasi=$row_dokumen->NoDokInventarisasi;
                                                                    $TglDokInventarisasi=balik_tanggal($row_dokumen->TglDokInventarisasi);
                                                                     
                                                                      
                                                                        $hasil= "$NoDokInventarisasi|$TglDokInventarisasi";
                                                                        $hasil2=trim($hasil);
                                                                        
                                                                    }
                                                                    echo $hasil2;
                                                                    
?>