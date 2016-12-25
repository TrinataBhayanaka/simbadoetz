<?php

include "../../config/config.php"; 
$PENGHAPUSAN = new RETRIEVE_PENGHAPUSAN;
//pr($_POST);
//exit;
$menu_id = 74;
$SessionUser = $SESSION->get_session_user();
($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
$USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);
$submit=$_POST['submit'];
$ses_uid=$_SESSION['ses_uid'];

$parameter=array('submit'=>$submit, 'ses_uid'=>$ses_uid);

$data = $PENGHAPUSAN->create_penetapan_penghapusan_pmd($_POST);

echo "<script>alert('Data Berhasil Disimpan'); document.location='$url_rewrite/module/penghapusanv2/dftr_penetapan_pmd.php';</script>";


?>
