<?php
include "../../config/config.php";
$menu_id = 10;
            $SessionUser = $SESSION->get_session_user();
            ($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
            $USERAUTH->FrontEnd_check_akses_menu($menu_id, $Session);


	$dataArr = $DELETE->delete_trs_rinc($_GET['id'],$_GET['tmpthis']);

	echo "<meta http-equiv=\"Refresh\" content=\"0; url={$url_rewrite}/module/gudang/distribusi_rinc.php?id={$_GET['tmpthis']}\">";

?>