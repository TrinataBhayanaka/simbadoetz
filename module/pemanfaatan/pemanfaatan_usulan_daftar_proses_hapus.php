<?php

include "../../config/config.php";

$id=$_GET['id'];

// exit;
$query="UPDATE Usulan SET FixUsulan=0 WHERE Usulan_ID='$id'";
$exec=mysql_query($query) or die(mysql_error());

$query2="UPDATE MenganggurAset SET StatusUsulan=0 WHERE Usulan_ID='$id'";
$exec2=mysql_query($query2) or die(mysql_error());

$query3="DELETE FROM UsulanAset WHERE Usulan_ID='$id'";
$exec3=mysql_query($query3) or die(mysql_error());

$query4="UPDATE Aset SET Usulan_Pemanfaatan_ID=NULL WHERE Usulan_Pemanfaatan_ID='$id'";
$exec4=mysql_query($query4) or die(mysql_error());

echo "<script>alert('Data Sudah Terhapus'); document.location='pemanfaatan_usulan_daftar_usulan.php';</script>";
?>
