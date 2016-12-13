<?php

include "../../config/config.php"; 
//pr("validasi proses");
//exit;
$PENGHAPUSAN = new RETRIEVE_PENGHAPUSAN;

$menu_id = 40;
$SessionUser = $SESSION->get_session_user();
($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
$USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);
$submit=$_POST['submit'];
$ses_uid=$_SESSION['ses_uid'];

$parameter=array('submit'=>$submit, 'ses_uid'=>$ses_uid);
$data_post=$PENGHAPUSAN->apl_userasetlistHPS("VLDUSPMD");
$POST=$_POST;
$POST_data=$PENGHAPUSAN->apl_userasetlistHPS_filter($data_post);
$POST['ValidasiPenghapusan']=$POST_data;
$data = $PENGHAPUSAN->update_validasi_penghapusan_pmd($_POST);

if($data_post){
    $data_delete=$PENGHAPUSAN->apl_userasetlistHPS_del("VLDUSPMD");
}


echo "<script>alert('Data Telah Divalidasi'); document.location='$url_rewrite/module/penghapusan/dftr_validasi_pmd.php?pid=1';</script>";


?>
