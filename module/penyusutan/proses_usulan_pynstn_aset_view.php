<?php
include "../../config/config.php";
	$menu_id = 64;
	($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
	$SessionUser = $SESSION->get_session_user();
	$USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);
	
	// $PENYUSUTAN = new RETRIEVE_PENYUSUTAN;
	$PENYUSUTAN = new RETRIEVE_PENYUSUTAN;
	// pr($_POST);
	
	$noUsulan = $_POST['noUsulan'];
	
	//select Aset_ID dari tabel apl_userasetlist
	$data_post=$PENYUSUTAN->apl_userasetlistHPS("VIEWUSULASET");
	// pr($data_post);
	$addExplode = explode(",",$data_post[0]['aset_list']);
	$cleanArray = array_filter($addExplode);
	$implodeAset_ID = implode(",",$cleanArray);
	// exit;
	if($implodeAset_ID != ''){
		//sql sementara
		$QueryDelUsulanAset	  = "DELETE from usulanaset WHERE Usulan_ID = '$noUsulan' and Aset_ID in ($implodeAset_ID)";
		$ExeDelUsulanAset 	= $DBVAR->query($QueryDelUsulanAset);
		
		//cek field Aset_ID 
		$QueryAsetCek	  = "select Aset_ID from usulan WHERE Usulan_ID = '$noUsulan'";
		$ExeQueryAcek = $DBVAR->query($QueryAsetCek);
		$ResultCek = $DBVAR->fetch_object($ExeQueryAcek);
		
		$arrResultCek = explode(',',$ResultCek->Aset_ID);
		$arrimplodeAset_ID = $cleanArray;
		$arrRemove = array_diff($arrResultCek,$arrimplodeAset_ID);
		$impldarrRemove=implode(',',$arrRemove);
		//update aset di usulan
		$QueryAset	  = "UPDATE usulan SET Aset_ID = '$impldarrRemove' WHERE Usulan_ID = '$noUsulan'";
		$ExeQueryAset = $DBVAR->query($QueryAset);
		
	if($data_post){
	 $data_delete=$PENYUSUTAN->apl_userasetlistHPS_del("VIEWUSULASET");
	}
	// exit;
  echo "<script>
			alert('Data Berhasil Disimpan');
		</script>";	
}
redirect($url_rewrite.'/module/penyusutan/dftr_usulan_pnystn.php?pid=1');
?>