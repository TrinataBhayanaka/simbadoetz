<?php
include "../../config/config.php"; 

$PEMANFAATAN = new RETRIEVE_PEMANFAATAN;


$data = $PEMANFAATAN->pemanfaatan_penetapan_hapus_proses($_GET);
if ($data){
	echo "<script>alert('Data Sudah Terhapus'); document.location='$url_rewrite/module/pemanfaatan/pemanfaatan_penetapan_daftar.php';</script>";
}
exit;
$id=$_GET['id'];

$query="UPDATE Pemanfaatan SET FixPemanfaatan=0 WHERE Pemanfaatan_ID='$id'";
$exec=mysql_query($query) or die(mysql_error());

$query2="UPDATE UsulanAset SET StatusPenetapan=0 WHERE Penetapan_ID='$id' AND Jenis_Usulan='MNF'";
$exec2=mysql_query($query2) or die(mysql_error());

$query3="DELETE FROM PemanfaatanAset WHERE Pemanfaatan_ID='$id' AND Status=0 AND StatusPengembalian=0";
$exec3=mysql_query($query3) or die(mysql_error());

$query4="UPDATE Aset SET CurrentPemanfaatan_ID=NULL, LastPemanfaatan_ID=NULL WHERE LastPemanfaatan_ID='$id'";
$exec4=mysql_query($query4) or die(mysql_error());

echo "<script>alert('Data Sudah Terhapus'); document.location='$url_rewrite/module/pemanfaatan/pemanfaatan_penetapan_daftar.php';</script>";
?>
