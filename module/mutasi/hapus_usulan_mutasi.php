<?php

include "../../config/config.php";


// pr($_POST);
	
	$MUTASI = new RETRIEVE_MUTASI;

	if ($_POST['submit']){

		if (count($_POST['aset_id'])>0){

			$data = $MUTASI->hapusUsulanMutasi($_POST);	
		}
		
		redirect("$url_rewrite/module/mutasi/detail_usulan_mutasi.php?id=$_POST[Mutasi_ID]");
	}
	

	// pr($_GET);
    exit;

?>