<?php
  include "../../config/database.php";  
  open_connection();  
function balik_tanggal($tgl){
     $temp=explode("-",$tgl);
     return $temp[2]."/". $temp[1]."/".$temp[0];
}
function show_kode_kelompok($kelompok_id){
      $query="select Kode from Kelompok where Kelompok_ID='$kelompok_id'";
      $result_query= mysql_query($query) or die(mysql_error());
      while($row=  mysql_fetch_object($result_query))
      {
           $kode=$row->Kode;
     }
     return $kode;
 }
 
 function show_kode_satker($satker_id){
      $query="select KodeSatker from Satker where Satker_ID='$satker_id'";
      $result_query= mysql_query($query) or die(mysql_error());
      while($row=  mysql_fetch_object($result_query))
      {
           $kode=$row->KodeSatker;
     }
     return $kode;
 }
 
 
$id=$_GET['aset'];
 $query_dokumen=" SELECT T.Tanah_ID as Tanah_ID, A.NamaAset as NamaAset, A.Pemilik as Pemilik, A.LastSatker_ID as LastSatker,
                    A.Kelompok_ID as Kelompok_ID FROM Tanah as T, Aset as A where T.Aset_ID=A.Aset_ID and T.Tanah_ID='$id
                    ORDER BY A.LastSatker_ID ASC '";
$result_dokumen=mysql_query($query_dokumen) or die(mysql_error());
while ($row_dokumen=mysql_fetch_object($result_dokumen)){
     $kode=  show_kode_kelompok($row_dokumen->Kelompok_ID);
    $hasil= "$kode";
     $hasil2=trim($hasil);
     
     }
     echo $hasil2;
     
     
                                                                     
?>