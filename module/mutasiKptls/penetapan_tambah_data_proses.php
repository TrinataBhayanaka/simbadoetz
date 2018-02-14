<?php

include "../../config/config.php"; 

$MUTASI = new RETRIEVE_MUTASI_KAPITALISASI;
//exit;
$menu_id = 79;
($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
$SessionUser = $SESSION->get_session_user();
$USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);

//pr($_POST);
//exit;
if($_POST['cekAll'] == 1){
	/*start background process
	id = id usulan penghapusan pmd
	idUsl = list aset  
	*/
	//pr("here");
	//exit;

	$id = $_POST['Mutasi_ID'];
	$idUsl = $_POST['Usulan_ID'];
	$log = "penetapan_aset_mtskptls_".$id;
	$data_delete=$MUTASI->apl_userasetlistHPS_del("PTUSMTSKPTLS");
	$data_delete=$MUTASI->apl_userasetlistHPS_del("RVWPTUSMTSKPTLS");
	$data_delete=$MUTASI->apl_userasetlistHPS_del("DELASMTSKPTLS");
	
	$status=exec("php penetapan_aset_mts_helper_all.php $id $idUsl > ../../log/$log.txt 2>&1 &");
	echo "<meta http-equiv=\"Refresh\" content=\"0; url={$url_rewrite}/module/mutasiKptls/list_penetapan.php\">";    
    exit;
}else{	
	/*start background process
	ket : param
	id = id usulan penghapusan pmd
	data = list aset  
	idUsl = list aset  
	*/
	$id = $_POST['Mutasi_ID'];
	$idUsl = $_POST['Usulan_ID'];
	$log = "penetapan_aset_mtskptls_".$id;

	$apl_userasetlistHPS = $MUTASI->apl_userasetlistHPS("PTUSMTSKPTLS");
	//$data = $apl_userasetlistHPS['0']['aset_list'];
	$addExplode = explode(",",$apl_userasetlistHPS[0]['aset_list']);
	$cleanArray = array_filter($addExplode);
	$implodeAset_ID = implode(",",$cleanArray);
	$arr = array("0"=>$implodeAset_ID);
	$data = $arr['0'];
	//pr($data);
	//exit;
	$data_delete=$MUTASI->apl_userasetlistHPS_del("PTUSMTSKPTLS");
	$data_delete=$MUTASI->apl_userasetlistHPS_del("RVWPTUSMTSKPTLS");
	$data_delete=$MUTASI->apl_userasetlistHPS_del("DELASMTSKPTLS");
	
$status=exec("php penetapan_aset_mts_helper.php $id $data $idUsl > ../../log/$log.txt 2>&1 &");
echo "<meta http-equiv=\"Refresh\" content=\"0; url={$url_rewrite}/module/mutasiKptls/list_penetapan.php\">";  
    exit;
}
?>
