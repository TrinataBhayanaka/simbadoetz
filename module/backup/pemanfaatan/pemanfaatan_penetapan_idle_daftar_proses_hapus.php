<?php

include "../../config/config.php";

$id=$_GET['id'];


$query="UPDATE Menganggur SET FixMenganggur=0 WHERE Menganggur_ID='$id'";
$exec=mysql_query($query) or die(mysql_error());

$query2="UPDATE PenggunaanAset SET StatusMenganggur=0 WHERE Menganggur_ID='$id'";
$exec2=mysql_query($query2) or die(mysql_error());

$query3="DELETE FROM MenganggurAset WHERE Menganggur_ID='$id'";
$exec3=mysql_query($query3) or die(mysql_error());

$query4="UPDATE Aset SET LastMenganggur_ID=0 WHERE LastMenganggur_ID='$id'";
$exec4=mysql_query($query4) or die(mysql_error());

echo "<script>alert('Data Sudah Terhapus'); document.location='$url_rewrite/module/pemanfaatan/pemanfaatan_penetapan_idle_daftar.php';</script>";
?>
