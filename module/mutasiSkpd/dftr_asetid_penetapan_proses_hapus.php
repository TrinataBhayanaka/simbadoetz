<?php
    include "../../config/config.php";
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$MUTASI = new RETRIEVE_MUTASI;
    
$menu_id = 78;
($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
$SessionUser = $SESSION->get_session_user();
$USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);
//pr($_POST);
//exit();
if($_POST['cekAll'] == 1){
    $id = $_POST['Mutasi_ID'];
    $log = "hapus_aset_penetapan_mts_".$id;  
    
    $status=exec("php hapus_aset_penetapan_mts_helper_all.php $id > ../../log/$log.txt 2>&1 &");
    echo "<meta http-equiv=\"Refresh\" content=\"0; url={$url_rewrite}/module/mutasiSkpd/dftr_review_edit_aset_penetapan.php?id=$id\">";    
    exit;
}else{
    $id = $_POST['Mutasi_ID'];
    $log = "hapus_aset_penetapan_mts_".$id;

    $apl_userasetlistHPS = $MUTASI->apl_userasetlistHPS("DELASMTS");
    //$data = $apl_userasetlistHPS['0']['aset_list'];
    $addExplode = explode(",",$apl_userasetlistHPS[0]['aset_list']);
    $cleanArray = array_filter($addExplode);
    $implodeAset_ID = implode(",",$cleanArray);
    $arr = array("0"=>$implodeAset_ID);
    $data = $arr['0'];
    //pr($data);
    //exit;
    $data_delete=$MUTASI->apl_userasetlistHPS_del("DELASMTS");
    

    $status=exec("php hapus_aset_penetapan_mts_helper.php $id $data > ../../log/$log.txt 2>&1 &");
    echo "<meta http-equiv=\"Refresh\" content=\"0; url={$url_rewrite}/module/mutasiSkpd/dftr_review_edit_aset_penetapan.php?id=$id\">";    
    exit;
}
    
?>
