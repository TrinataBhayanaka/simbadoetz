<?php

include "../../config/config.php"; 
$PENGGUNAAN = new RETRIEVE_PENGGUNAAN;
//pr($_POST);
//exit;
$menu_id = 76;
$SessionUser = $SESSION->get_session_user();
($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
$USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);
$submit=$_POST['submit'];
$ses_uid=$_SESSION['ses_uid'];

$parameter=array('submit'=>$submit, 'ses_uid'=>$ses_uid);

$data = $PENGGUNAAN->create_usulan_penggunaan($_POST);

echo "<script>alert('Data Berhasil Disimpan'); document.location='$url_rewrite/module/penggunaanv2/dftr_usulan_penggunaan.php';</script>";


?>
