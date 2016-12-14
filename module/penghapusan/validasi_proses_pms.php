<?php

include "../../config/config.php"; 

$PENGHAPUSAN = new RETRIEVE_PENGHAPUSAN;

$menu_id = 40;
$SessionUser = $SESSION->get_session_user();
($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
$USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);
$submit=$_POST['submit'];
$ses_uid=$_SESSION['ses_uid'];

$parameter=array('submit'=>$submit, 'ses_uid'=>$ses_uid);
// $data=$UPDATE->update_validasi_penghapusan($parameter);

         $data_post=$PENGHAPUSAN->apl_userasetlistHPS("VLDUSPMS");
        // pr($data_post);
        $POST=$_POST;
        // //pr($POST);
        $POST_data=$PENGHAPUSAN->apl_userasetlistHPS_filter($data_post);
        $POST['ValidasiPenghapusan']=$POST_data;
		// pr($_POST);
		$data = $PENGHAPUSAN->update_validasi_penghapusan_pms($_POST);

        if($data_post){
         $data_delete=$PENGHAPUSAN->apl_userasetlistHPS_del("VLDUSPMS");
        }

echo "<script>alert('Data Telah Divalidasi'); document.location='$url_rewrite/module/penghapusan/dftr_validasi_pms.php?pid=1';</script>";


?>
