<?php
include "../../config/config.php";
pr("here");
exit();
$PENGHAPUSAN = new RETRIEVE_PENGHAPUSAN;

$menu_id = 75;
($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
$SessionUser = $SESSION->get_session_user();
$USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);

/*$data = $PENGHAPUSAN->delete_daftar_usulan_penghapusan_pmd_rev($_GET);

echo "<script>alert('Data Sudah Terhapus'); document.location='$url_rewrite/module/penghapusanv2/dftr_usulan_pmd.php?pid=1';</script>";*/
//$id = $_POST['usulanID'];
$id=$_GET['id'];
//pr($id);
$log = "usulan_pms_".$id;	
pr("here");
exit;
$status=exec("php hapus_usulan_pms_helper.php $id > ../../log/$log.txt 2>&1 &");
echo "<meta http-equiv=\"Refresh\" content=\"0; url={$url_rewrite}/module/penghapusanv2/dftr_usulan_pms.php\">";    
    exit;
?>
