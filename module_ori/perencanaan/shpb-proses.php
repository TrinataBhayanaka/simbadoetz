<?php
ob_start();
include "../../config/config.php";
$menu_id = 3;
$SessionUser = $SESSION->get_session_user();
$USERAUTH->FrontEnd_check_akses_menu($menu_id,$SessionUser);

if (isset ($_POST['submit_pem'])) {
	$dataArr = $UPDATE->update_shpb_pemeliharaan_edit(array('param'=>$_POST, 'menuID'=>$menu_id, 'type'=>'', 'paging'=>''));
	header ("location:shpb_tambah_data.php");
}

if (isset ($_POST['submit_edit'])) {
	$dataArr = $UPDATE->update_shpb_edit(array('param'=>$_POST, 'menuID'=>$menu_id, 'type'=>'', 'paging'=>''));
	header ("location:shpb_daftar_data.php");
}

if (isset ($_POST['submit_hapus'])){
		$dataArr = $UPDATE->update_shpb_hapus(array('param'=>$_POST, 'menuID'=>$menu_id, 'type'=>'', 'paging'=>''));
		header ("location:shpb_daftar_data.php");
}

?>