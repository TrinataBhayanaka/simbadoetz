<?php
include "../../config/config.php"; 

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$id=$_POST['id'];
$satker=$_POST['skpd_id'];
$nodok=$_POST['mutasi_trans_eks_nodok'];
$tgl=$_POST['mutasi_trans_eks_tglproses'];
$olah_tgl=  format_tanggal_db2($tgl);
$alasan=$_POST['mutasi_trans_eks_alasan'];


$UserNm="admin";// usernm akan diganti jika session di implementasikan


 $query="UPDATE Mutasi SET NoSKKDH='$nodok', TglSKKDH='$olah_tgl', Keterangan='$alasan', SatkerTujuan='$satker' WHERE Mutasi_ID='$id'";

 $result=  mysql_query($query) or die(mysql_error());
 

 /*
 $pecah=explode('.',$satker);
 $sektor=$pecah[0];
 $satker=$pecah[1];
 $unit=$pecah[2];
 
  * 
  */
 /*
 echo "$sektor".'<br>';
 echo "$satker".'<br>';
 echo "$unit";
  */
 /*
 $gabung=array($sektor, $satker);
 $exe=implode('.', $gabung);
 
  * 
  */
 /*
$query7="SELECT * FROM Satker WHERE KodeSatker = '$exe' AND KodeUnit = '$unit'";
$result7=  mysql_query($query7) or die(mysql_error());
$row2 =  mysql_fetch_array($result7);
$Satker_ID=$row2['Satker_ID'];
*/

/*
$nmaset=$_POST['mutasi_nama_aset'];
$asset_id=Array();
$no_reg=Array();
$nm_barang=Array();

$panjang=count($nmaset);
 
*/
/*
for($i=0;$i<$panjang;$i++){
    
    $tmp=$nmaset[$i];
    $tmp_olah=explode("<br>",$tmp);
    $asset_id[$i]=$tmp_olah[0];
    $no_reg[$i]=$tmp_olah[1];
    $nm_barang[$i]=$tmp_olah[2];
    echo  "No= $i <br/>
            Asset ID =$asset_id[$i] <br/>
            No register=$no_reg[$i] <br/>
            Nama barang =$nm_barang[$i] <br/>";
*/
    
    $query3="UPDATE Aset SET LastSatker_ID='$satker' WHERE LastMutasi_ID='$id'";
    $result3=mysql_query($query3) or die(mysql_error());
    

    
// }



echo "<script>alert('Data Sudah di Ubah.. !!!'); document.location='transfer_hasil_daftar.php';</script>";
?>
