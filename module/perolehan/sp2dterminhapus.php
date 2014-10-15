<?php
include "../../config/config.php";
$menu_id = 10;
            $SessionUser = $SESSION->get_session_user();
            ($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
            $USERAUTH->FrontEnd_check_akses_menu($menu_id, $Session);


	 $sql = mysql_query("SELECT * FROM sp2d WHERE id = '{$_GET['idsp2d']}'");
	    while ($datasp2d = mysql_fetch_assoc($sql)){
	        $sp2d = $datasp2d;
	    }

	$dataArr = $DELETE->delete_sp2d($sp2d,$_GET['id']);

?>