<?php
include "../../config/config.php";
$menu_id = 10;
            $SessionUser = $SESSION->get_session_user();
            ($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
            $USERAUTH->FrontEnd_check_akses_menu($menu_id, $Session);

     $idKontrak = $_GET['tmpthis'];
		$sql = mysql_query("SELECT * FROM kontrak WHERE id='{$idKontrak}'");
			while ($dataKontrak = mysql_fetch_assoc($sql)){
					$kontrak[] = $dataKontrak;
				}

		if($kontrak[0]['n_status'] == 1)
		{
			echo "<script>alert('Maaf data tidak dapat dihapus!')</script><meta http-equiv=\"Refresh\" content=\"0; url={$url_rewrite}/module/perolehan/kontrak_barang.php?id={$_GET['tmpthis']}\">";
			exit;
		}

	 $sql = mysql_query("SELECT * FROM aset WHERE kodeKelompok = '{$_GET['idKel']}' AND kodeLokasi = '{$_GET['idLok']}' AND noKontrak = '{$kontrak[0]['noKontrak']}'");
	    while ($dataAset = mysql_fetch_assoc($sql)){
	        $aset[] = $dataAset;
	    } 

	$dataArr = $DELETE->delete_aset($aset);

	echo "<meta http-equiv=\"Refresh\" content=\"0; url={$url_rewrite}/module/perolehan/kontrak_barang.php?id={$_GET['tmpthis']}\">";
	exit;
?>