<?php

include "../../config/config.php";

$menu_id = 30;
($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
$SessionUser = $SESSION->get_session_user();
$USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);

$PENGGUNAAN = new RETRIEVE_PENGGUNAAN;

$data=$PENGGUNAAN->delete_daftar_penetapan_penggunaan($_GET);

/*
$query="UPDATE Penggunaan SET FixPenggunaan=0 WHERE Penggunaan_ID='$id'";
$exec=mysql_query($query) or die(mysql_error());

$query2="UPDATE Aset SET NotUse=0 WHERE LastPenggunaan_ID='$id'";
$exec2=mysql_query($query2) or die(mysql_error());

$query3="DELETE FROM PenggunaanAset WHERE Penggunaan_ID='$id' AND Status=0 AND StatusMenganggur=0";
$exec3=mysql_query($query3) or die(mysql_error());

$query4="UPDATE Aset SET LastPenggunaan_ID=NULL WHERE LastPenggunaan_ID='$id'";
$exec4=mysql_query($query4) or die(mysql_error());
*/

echo "<script>alert('Data Berhasil Dihapus'); document.location='$url_rewrite/module/penggunaan/penggunaan_penetapan_daftar.php?pid=1';</script>";
?>