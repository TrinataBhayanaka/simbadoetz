<?php
include "../../config/config.php"; 
$id=$_GET['id'];
$query5="select * from Aset where LastPengembalian_ID='$id'";
$exec5=mysql_query($query5) or die(mysql_error());

$row=mysql_fetch_array($exec5);

$get_pengembalian_id=$row['LastPemanfaatan_ID'];



$query="UPDATE BAST_Pengembalian SET FixPengembalian=0 WHERE BAST_Pengembalian_ID='$id'";
$exec=mysql_query($query) or die(mysql_error());

$query2="UPDATE PemanfaatanAset SET StatusPengembalian=0 WHERE BAST_Pengembalian_ID='$id'";
$exec2=mysql_query($query2) or die(mysql_error());

$query3="DELETE FROM BAST_PengembalianAset WHERE BAST_Pengembalian_ID='$id'";
$exec3=mysql_query($query3) or die(mysql_error());

$query4="UPDATE Aset SET CurrentPemanfaatan_ID='$get_pengembalian_id', LastPengembalian_ID=NULL, NotUse=1 WHERE LastPengembalian_ID='$id'";
$exec4=mysql_query($query4) or die(mysql_error());

echo "<script>alert('Data Berhasil Dihapus	'); document.location='$url_rewrite/module/pemanfaatan/pemanfaatan_pengembalian_daftar.php';</script>";
 
?>
