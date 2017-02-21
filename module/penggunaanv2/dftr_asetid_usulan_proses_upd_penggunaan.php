<?php
    include "../../config/config.php";
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */ 
$PENGGUNAAN = new RETRIEVE_PENGGUNAAN;

$menu_id = 76;
($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
$SessionUser = $SESSION->get_session_user();
$USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);

$id=$_POST['Penggunaan_ID'];
//pr($_POST);

//exit;
$data = $PENGGUNAAN->update_usulan_penghapusan_asetid_penggunaan($_POST);

echo "<script>alert('Data Berhasil DiUpdate'); document.location='$url_rewrite/module/penggunaanv2/dftr_review_usulan_penggunaan.php?id=$id';</script>";
?>
