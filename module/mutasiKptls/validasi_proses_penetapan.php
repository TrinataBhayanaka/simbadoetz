<?php

include "../../config/config.php"; 

$MUTASI = new RETRIEVE_MUTASI_KAPITALISASI;
//exit;
$menu_id = 79;
($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
$SessionUser = $SESSION->get_session_user();
$USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);

//pr($_GET);
//exit;

/*start background process
ket : param
id = id usulan penghapusan pmd
*/
$id = $_GET['id'];
$tahun = $TAHUN_AKTIF;
$log = "validasi_mtskptls_".$id;
//pr($id);
//pr($tahun);
//exit;	
$status=exec("php validasi_mts_helper.php $id $tahun  > ../../log/$log.txt 2>&1 &");
echo "<meta http-equiv=\"Refresh\" content=\"0; url={$url_rewrite}/module/mutasiKptls/dftr_penetapan_validasi.php\">";  
    exit;

?>
