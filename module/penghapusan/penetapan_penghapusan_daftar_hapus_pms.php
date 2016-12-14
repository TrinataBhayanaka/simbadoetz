<?php
include "../../config/config.php"; 


$PENGHAPUSAN = new RETRIEVE_PENGHAPUSAN;

$menu_id = 39;
($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
$SessionUser = $SESSION->get_session_user();
$USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);

$id=$_GET['id'];

$data = $PENGHAPUSAN->delete_daftar_penetapan_penghapusan($id);

echo "<script>alert('Data Sudah Terhapus'); document.location='dftr_penetapan_pms.php?pid=1';</script>";
?>
