<?php

include "../../config/config.php"; 

$PENGHAPUSAN = new RETRIEVE_PENGHAPUSAN;
//pr("here");
//pr($_POST);
//exit;
$menu_id = 39;
($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
$SessionUser = $SESSION->get_session_user();
$USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);

$no=$_POST['bup_pp_noskpenghapusan'];
$tgl=$_POST['bup_pp_tanggal'];
$olah_tgl=  format_tanggal_db2($tgl);
$keterangan=$_POST['bup_pp_get_keterangan'];	
$UserNm=$_SESSION['ses_uoperatorid'];// usernm akan diganti jika session di implementasikan
$nmaset=$_POST['penghapusan_nama_aset'];
$ses_uid=$_SESSION[ses_uid];
$penghapusan_id=get_auto_increment("penghapusan");

$data_post=$PENGHAPUSAN->apl_userasetlistHPS("PTUSPMS");
$POST=$_POST;
$POST_data=$PENGHAPUSAN->apl_userasetlistHPS_filter($data_post);
$POST['penghapusan_nama_aset']=$POST_data;
$data = $PENGHAPUSAN->store_penetapan_penghapusan_pms($POST);

$data_delete=$PENGHAPUSAN->apl_userasetlistHPS_del("RVWPTUSPMS");

$data_delete=$PENGHAPUSAN->apl_userasetlistHPS_del("PTUSPMS");

echo "<script>alert('Data Berhasil Disimpan'); document.location='dftr_penetapan_pms.php?pid=1';</script>";

?>
