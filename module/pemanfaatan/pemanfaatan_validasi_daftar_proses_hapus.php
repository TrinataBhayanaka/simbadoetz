<?php
    include "../../config/config.php";
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$PEMANFAATAN = new RETRIEVE_PEMANFAATAN;
   

$data = $PEMANFAATAN->pemanfaatan_validasi_daftar_hapus($_GET);
if ($data){
	echo "<script>alert('Data Berhasil Dihapus'); document.location='pemanfaatan_validasi_daftar_valid.php?pid=1';</script>";
}
exit;
    $id=$_GET['id'];
    //echo "$id";

    $query="UPDATE Pemanfaatan SET Status=0 WHERE Pemanfaatan_ID='$id'";
    $exec=mysql_query($query) or die(mysql_error());
    
    $query2="UPDATE PemanfaatanAset SET Status=0 WHERE Pemanfaatan_ID='$id' AND StatusPengembalian=0";
    $exec=mysql_query($query2) or die(mysql_error());
    
    echo "<script>alert('Data Berhasil Dihapus'); document.location='pemanfaatan_validasi_daftar_valid.php?pid=1';</script>";
?>
