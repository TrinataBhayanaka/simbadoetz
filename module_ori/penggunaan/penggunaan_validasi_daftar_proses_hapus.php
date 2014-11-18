<?php
    include "../../config/config.php";
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
    
    $menu_id = 31;
    ($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
    $SessionUser = $SESSION->get_session_user();
    $USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);
    
    $id=$_GET['id'];
    // pr($id);
	// exit;
    $data=$DELETE->delete_update_daftar_validasi_penggunaan($id);
    
    /*

    $query="UPDATE Penggunaan SET Status=0 WHERE Penggunaan_ID='$id'";
    $exec=mysql_query($query) or die(mysql_error());
    
    $query="UPDATE PenggunaanAset SET Status=0 WHERE Penggunaan_ID='$id' AND StatusMenganggur=0";
    $exec=mysql_query($query) or die(mysql_error());
    
     * 
     */
    
    echo "<script>alert('Data Berhasil Dihapus'); document.location='$url_rewrite/module/penggunaan/penggunaan_validasi_daftar_valid.php?pid=1';</script>";
?>
