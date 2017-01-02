<?php
    include "../../config/config.php";
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */ 
$PENGHAPUSAN = new RETRIEVE_PENGHAPUSAN;

$menu_id = 75;
($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
$SessionUser = $SESSION->get_session_user();
$USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);

$id=$_POST['usulanID'];
$data = $PENGHAPUSAN->update_usulan_penghapusan_asetid_pmd($_POST);

echo "<script>alert('Data Berhasil DiUpdate'); document.location='$url_rewrite/module/penghapusanv2/dftr_review_edit_aset_usulan_pms.php?id=$id';</script>";
?>
