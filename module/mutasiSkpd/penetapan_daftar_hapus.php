<?php
include "../../config/config.php"; 


$MUTASI = new RETRIEVE_MUTASI;

$menu_id = 78;
($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
$SessionUser = $SESSION->get_session_user();
$USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);

//$data = $PENGHAPUSAN->delete_daftar_penetapan_penghapusan($id);
$id=$_GET['id'];
$log = "hapus_penetapan_mts_".$id;
//pr("here");
//exit;
$status=exec("php hapus_penetapan_mts_helper.php $id > ../../log/$log.txt 2>&1 &");
echo "<meta http-equiv=\"Refresh\" content=\"0; url={$url_rewrite}/module/mutasiSkpd/list_penetapan.php\">";    
    exit;
?>
