<?php
include "../../config/config.php";
$menu_id = 10;
            $SessionUser = $SESSION->get_session_user();
            ($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
            $USERAUTH->FrontEnd_check_akses_menu($menu_id, $Session);


	 $sql = mysql_query("SELECT * FROM aset WHERE kodeKelompok = '{$_GET['idKel']}' AND kodeLokasi = '{$_GET['idLok']}'");
	    while ($dataAset = mysql_fetch_assoc($sql)){
	        $aset[] = $dataAset;
	    } 

	$dataArr = $DELETE->delete_aset($aset);

	echo "<meta http-equiv=\"Refresh\" content=\"0; url={$url_rewrite}/module/perolehan/kontrak_barang.php?id={$_GET['tmpthis']}\">";

?>