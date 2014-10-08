<?php
ob_start();
include "../../config/config.php";
$menu_id = 5;
$SessionUser = $SESSION->get_session_user();
$USERAUTH->FrontEnd_check_akses_menu($menu_id,$SessionUser);

if (isset ($_POST['submit_edit'])) 
{	
		$get_data_filter = $UPDATE->update_rkb_edit(array('param'=>$_POST, 'menuID'=>$menu_id, 'type'=>'', 'paging'=>''));
		header ("location:rkb_daftar_data.php");
}

if (isset ($_POST['submit_hapus'])){
	$get_data_filter = $DELETE->delete_rkb_data(array('param'=>$_POST, 'menuID'=>$menu_id, 'type'=>'', 'paging'=>''));
	header ("location:rkb_daftar_data.php");
}

?>