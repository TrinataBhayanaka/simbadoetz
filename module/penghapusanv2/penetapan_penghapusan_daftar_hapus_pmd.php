<?php
include "../../config/config.php"; 


$PENGHAPUSAN = new RETRIEVE_PENGHAPUSAN;

$menu_id = 74;
($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
$SessionUser = $SESSION->get_session_user();
$USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);

//$data = $PENGHAPUSAN->delete_daftar_penetapan_penghapusan($id);
$id=$_GET['id'];
$log = "hapus_penetapan_pmd_".$id;
//pr("here");
//exit;
$status=exec("php hapus_penetapan_pmd_helper.php $id > ../../log/$log.txt 2>&1 &");
echo "<meta http-equiv=\"Refresh\" content=\"0; url={$url_rewrite}/module/penghapusanv2/dftr_penetapan_pmd.php\">";    
    exit;
?>
