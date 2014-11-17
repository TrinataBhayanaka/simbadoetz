<?php
include "../../config/config.php";
$menu_id = 10;
            $SessionUser = $SESSION->get_session_user();
            ($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
            $USERAUTH->FrontEnd_check_akses_menu($menu_id, $Session);


	 $sql = mysql_query("SELECT * FROM kontrak WHERE id = '{$_GET['id']}'");
	    while ($dataKontrak = mysql_fetch_assoc($sql)){
	        $kontrak[] = $dataKontrak;
	    }

	$dataArr = $DELETE->delete_kontrak($kontrak[0],$_GET['id']);

?>