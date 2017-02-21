<?php
include "../../config/config.php";

$PENGHAPUSAN = new RETRIEVE_PENGHAPUSAN;

$menu_id = 76;
($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
$SessionUser = $SESSION->get_session_user();
$USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);
//exit();
//pr($_POST);
if($_POST['cekAll'] == 1){
	/*start background process
	ket : param
	id = id usulan penghapusan pmd
	filter :
	[bup_tahun],[kodepemilik],[kodeKelompok],[jenisaset],[kodeSatker],
	*/
	$id = $_POST['Penggunaan_ID'];
	$log = "usulan_penggunaan_".$id;
	$tahun = $_POST['bup_tahun'];
	$kodePemilik = $_POST['kodepemilik'];
	$kodeKelompok = $_POST['kodeKelompok'];
	$jenisaset = $_POST['jenisaset'];
	$kodeSatker = $_POST['kodeSatker'];
	
	if($kodeSatker) $filterkontrak .="kodeSatker={$kodeSatker}"."-";
	if($kodePemilik) $filterkontrak .="kodeLokasi={$kodePemilik}"."-";
	if($tahun) $filterkontrak .="Tahun={$tahun}"."-";
	if($kodeKelompok) $filterkontrak .="kodeKelompok={$kodeKelompok}"."-";
	if($jenisaset) $filterkontrak .="TipeAset={$jenisaset}";
	
	$data_delete=$PENGHAPUSAN->apl_userasetlistHPS_del("RVWUSPNG");
	$data_delete=$PENGHAPUSAN->apl_userasetlistHPS_del("DELUSPNG");

	$status=exec("php usulan_aset_penggunaan_helper_all.php $id $filterkontrak > ../../log/$log.txt 2>&1 &");
echo "<meta http-equiv=\"Refresh\" content=\"0; url={$url_rewrite}/module/penggunaanv2/dftr_usulan_penggunaan.php\">";    
    exit;
}else{	
	/*start background process
	ket : param
	id = id usulan penghapusan pmd
	data = list aset  
	*/
	$id = $_POST['Penggunaan_ID'];
	$log = "usulan_penggunaan_".$id;

	$apl_userasetlistHPS = $PENGHAPUSAN->apl_userasetlistHPS("RVWUSPNG");
	$addExplode = explode(",",$apl_userasetlistHPS[0]['aset_list']);
	$cleanArray = array_filter($addExplode);
	$implodeAset_ID = implode(",",$cleanArray);
	$arr = array("0"=>$implodeAset_ID);
	/*pr($apl_userasetlistHPS);
	pr($cleanArray);
	pr($implodeAset_ID);*/
	$data = $arr['0'];
	//pr($data);
	//exit;
	$kodeSatker = $kodeSatker = $_POST['kodeSatker'];
	$data_delete=$PENGHAPUSAN->apl_userasetlistHPS_del("RVWUSPNG");
	$data_delete=$PENGHAPUSAN->apl_userasetlistHPS_del("DELUSPNG");
	//exit;

$status=exec("php usulan_aset_penggunaan_helper.php $id $data $kodeSatker > ../../log/$log.txt 2>&1 &");
echo "<meta http-equiv=\"Refresh\" content=\"0; url={$url_rewrite}/module/penggunaanv2/dftr_usulan_penggunaan.php\">";    
    exit;
}

    
?>
