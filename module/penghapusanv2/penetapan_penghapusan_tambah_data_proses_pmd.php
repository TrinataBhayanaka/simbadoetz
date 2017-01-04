<?php

include "../../config/config.php"; 

$PENGHAPUSAN = new RETRIEVE_PENGHAPUSAN;
//exit;
$menu_id = 74;
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

	$id = $_POST['Penghapusan_ID'];
	$idUsl = $_POST['Usulan_ID'];
	$log = "penetapan_aset_pmd_".$id;
	$data_delete=$PENGHAPUSAN->apl_userasetlistHPS_del("PTUSPMD");
	$data_delete=$PENGHAPUSAN->apl_userasetlistHPS_del("RVWPTUSPMD");
	$data_delete=$PENGHAPUSAN->apl_userasetlistHPS_del("DELASPMD");
	
	$status=exec("php penetapan_aset_pmd_helper_all.php $id $idUsl > ../../log/$log.txt 2>&1 &");
	echo "<meta http-equiv=\"Refresh\" content=\"0; url={$url_rewrite}/module/penghapusanv2/dftr_penetapan_pmd.php\">";    
    exit;
}else{	
	/*start background process
	ket : param
	id = id usulan penghapusan pmd
	data = list aset  
	idUsl = list aset  
	*/
	$id = $_POST['Penghapusan_ID'];
	$idUsl = $_POST['Usulan_ID'];
	$log = "penetapan_aset_pmd_".$id;

	$apl_userasetlistHPS = $PENGHAPUSAN->apl_userasetlistHPS("PTUSPMD");
	//$data = $apl_userasetlistHPS['0']['aset_list'];
	$addExplode = explode(",",$apl_userasetlistHPS[0]['aset_list']);
	$cleanArray = array_filter($addExplode);
	$implodeAset_ID = implode(",",$cleanArray);
	$arr = array("0"=>$implodeAset_ID);
	$data = $arr['0'];
	//pr($data);
	//exit;
	$data_delete=$PENGHAPUSAN->apl_userasetlistHPS_del("PTUSPMD");
	$data_delete=$PENGHAPUSAN->apl_userasetlistHPS_del("RVWPTUSPMD");
	$data_delete=$PENGHAPUSAN->apl_userasetlistHPS_del("DELASPMD");
	
$status=exec("php penetapan_aset_pmd_helper.php $id $data $idUsl > ../../log/$log.txt 2>&1 &");
echo "<meta http-equiv=\"Refresh\" content=\"0; url={$url_rewrite}/module/penghapusanv2/dftr_penetapan_pmd.php\">";  
    exit;
}
?>
