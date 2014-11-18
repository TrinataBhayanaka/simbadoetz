<?php
    include "../../config/config.php";
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
    
    
    $menu_id = 48;
    ($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
    $SessionUser = $SESSION->get_session_user();
    $USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);
    
    $id=$_GET['id'];
    
    $data=$DELETE->delete_update_daftar_validasi_pemusnahan($id);
    
    
    /*
    //echo "$id";

    $query="UPDATE BAPemusnahan SET Status=0 WHERE BAPemusnahan_ID='$id'";
    $exec=mysql_query($query) or die(mysql_error());
    
    $query2="UPDATE BAPemusnahanAset SET Status=0 WHERE BAPemusnahan_ID='$id'";
    $exec=mysql_query($query2) or die(mysql_error());
    
     * 
     */
    
    echo "<script>alert('Data Sudah Terhapus .. !!!'); document.location='$url_rewrite/module/pemusnahan/pemusnahan_validasi_daftar_valid.php?pid=1';</script>";
?>
