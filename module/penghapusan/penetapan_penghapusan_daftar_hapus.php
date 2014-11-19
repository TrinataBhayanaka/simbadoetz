<?php
include "../../config/config.php"; 


$PENGHAPUSAN = new RETRIEVE_PENGHAPUSAN;

$menu_id = 39;
($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
$SessionUser = $SESSION->get_session_user();
$USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);

$id=$_GET['id'];

// $data=$DELETE->delete_daftar_penetapan_penghapusan($id);
		$data = $PENGHAPUSAN->delete_daftar_penetapan_penghapusan($id);
// pr($id);exit;
/*
$querytampil="SELECT * FROM PenghapusanAset WHERE Penghapusan_ID='$id'";
$exectampil=  mysql_query($querytampil) or die(mysql_error());
while($row=  mysql_fetch_array($exectampil)){

$asetid = $row['Aset_ID'];

$query4="UPDATE Aset SET Dihapus=0 WHERE Aset_ID='$asetid'";
$exec4=mysql_query($query4) or die(mysql_error());
}   

$query="UPDATE Penghapusan SET FixPenghapusan=0 WHERE Penghapusan_ID='$id'";
$exec=mysql_query($query) or die(mysql_error());

$query2="UPDATE UsulanAset SET StatusPenetapan=0 WHERE Penetapan_ID='$id' AND Jenis_Usulan='HPS'";
$exec2=mysql_query($query2) or die(mysql_error());

$query3="DELETE FROM PenghapusanAset WHERE Penghapusan_ID='$id' AND Status=0";
$exec3=mysql_query($query3) or die(mysql_error());


*/
echo "<script>alert('Data Sudah Terhapus'); document.location='penetapan_penghapusan_daftar_isi.php?pid=1';</script>";
?>
