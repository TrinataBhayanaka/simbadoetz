<?php
include "../../config/config.php";
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */ 
$MUTASI = new RETRIEVE_MUTASI;

$menu_id = 78;
($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
$SessionUser = $SESSION->get_session_user();
$USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);

$id=$_POST['usulanID'];
$data = $MUTASI->update_usulan_penghapusan_asetid($_POST);
    
echo "<script>alert('Data Berhasil DiUpdate'); document.location='$url_rewrite/module/mutasiSkpd/dftr_review_edit_aset_usulan.php?id=$id';</script>";
?>
