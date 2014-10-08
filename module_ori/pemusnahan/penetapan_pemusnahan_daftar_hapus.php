<?php
include "../../config/config.php"; 

$menu_id = 47;
($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
$SessionUser = $SESSION->get_session_user();
$USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);


$id=$_GET['id'];

$data=$DELETE->delete_daftar_penetapan_pemusnahan($id);

/*

$query="UPDATE BAPemusnahan SET FixPemusnahan=0 WHERE BAPemusnahan_ID='$id'";
$exec=mysql_query($query) or die(mysql_error());

$query2="UPDATE UsulanAset SET StatusPenetapan=0 WHERE Penetapan_ID='$id' AND Jenis_Usulan='MSN'";
$exec2=mysql_query($query2) or die(mysql_error());

$query3="DELETE FROM BAPemusnahanAset WHERE BAPemusnahan_ID='$id' AND Status=0";
$exec3=mysql_query($query3) or die(mysql_error());

$query4="UPDATE Aset SET BAPemusnahan_ID=0 WHERE BAPemusnahan_ID='$id'";
$exec4=mysql_query($query4) or die(mysql_error());
 * 
 */

echo "<script>alert('Data Sudah Terhapus'); document.location='$url_rewrite/module/pemusnahan/penetapan_pemusnahan_daftar_kosong.php?pid=1';</script>";
?>
