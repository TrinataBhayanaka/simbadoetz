<?php

include "../../config/config.php"; 
$MUTASI = new RETRIEVE_MUTASI;
//pr($_POST);
//exit;
$menu_id = 78;
$SessionUser = $SESSION->get_session_user();
($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
$USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);
$submit=$_POST['submit'];
$ses_uid=$_SESSION['ses_uid'];

$parameter=array('submit'=>$submit, 'ses_uid'=>$ses_uid);

$data = $MUTASI->create_penetapan($_POST);

echo "<script>alert('Data Berhasil Disimpan'); document.location='$url_rewrite/module/mutasiSkpd/list_penetapan.php';</script>";


?>
