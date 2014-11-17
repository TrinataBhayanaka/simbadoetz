<?php

include "../../config/config.php";

$menu_id = 42;
($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
$SessionUser = $SESSION->get_session_user();
$USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);

$id=$_GET['id'];

$dataArr = $DELETE->delete_daftar_usulan_pemindahtanganan($id);

/*
$query="UPDATE Usulan SET FixUsulan=0 WHERE Usulan_ID='$id'";
$exec=mysql_query($query) or die(mysql_error());


$query2="UPDATE Aset SET NotUse=0 WHERE Usulan_Pemindahtanganan_ID='$id'";
$exec2=mysql_query($query2) or die(mysql_error());


$query3="DELETE FROM UsulanAset WHERE Usulan_ID='$id'";
$exec3=mysql_query($query3) or die(mysql_error());

$query4="UPDATE Aset SET Usulan_Pemindahtanganan_ID=NULL WHERE Usulan_Pemindahtanganan_ID='$id'";
$exec4=mysql_query($query4) or die(mysql_error());
*/

echo "<script>alert('Data Sudah Terhapus'); document.location='$url_rewrite/module/pemindahtanganan/pemindahtanganan_daftar_aset_fix.php?pid=1';</script>";
?>
