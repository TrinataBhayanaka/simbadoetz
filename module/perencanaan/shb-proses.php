<?php
ob_start();
include "../../config/config.php";
$menu_id = 2;
$SessionUser = $SESSION->get_session_user();
$USERAUTH->FrontEnd_check_akses_menu($menu_id,$SessionUser);
if (isset($_POST['submit_edit']))
{	
$get_data_filter = $UPDATE->update_shb_data(array('param'=>$_POST, 'menuID'=>$menu_id, 'type'=>'', 'paging'=>''));
header ("location:shb_daftar_data.php");
}

if (isset ($_POST['submit_hapus'])){
$get_data_filter = $DELETE->delete_shb_data(array('param'=>$_POST, 'menuID'=>$menu_id, 'type'=>'', 'paging'=>''));
header ("location:shb_daftar_data.php");
}

?>