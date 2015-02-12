<?php
    include "../../config/config.php";
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
    
$PENGHAPUSAN = new RETRIEVE_PENGHAPUSAN;

    $menu_id = 40;
    ($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
    $SessionUser = $SESSION->get_session_user();
    $USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);
    
    // $id=$_POST['usulanID'];
     $data_post=$PENGHAPUSAN->apl_userasetlistHPS("DELUSPMS");
    $POST=$_POST;

    $POST_data=$PENGHAPUSAN->apl_userasetlistHPS_filter($data_post);
    $POST['penghapusan_nama_aset']=$POST_data;
    // $data=$DELETE->delete_update_daftar_validasi_penghapusan($id);
	// //pr($_POST);
 //    exit;
		$data = $PENGHAPUSAN->delete_usulan_penghapusan_asetid_pms($POST);
     $id=$POST['usulanID'];

    $data_delete=$PENGHAPUSAN->apl_userasetlistHPS_del("DELUSPMS");
    /*
    
    echo "$id";

    $query="UPDATE Penghapusan SET Status=0 WHERE Penghapusan_ID='$id'";
    $exec=mysql_query($query) or die(mysql_error());
    
    $query2="UPDATE PenghapusanAset SET Status=0 WHERE Penghapusan_ID='$id'";
    $exec=mysql_query($query2) or die(mysql_error());
    */
    echo "<script>alert('Data Berhasil Dihapus'); document.location='$url_rewrite/module/penghapusan/dftr_review_edit_aset_usulan_pms.php?id=$id';</script>";
?>
