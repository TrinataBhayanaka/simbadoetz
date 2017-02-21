<?php
    include "../../config/config.php";
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$PENGHAPUSAN = new RETRIEVE_PENGHAPUSAN;
    
$menu_id = 76;
($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
$SessionUser = $SESSION->get_session_user();
$USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);

if($_POST['cekAll'] == 1){
    $id = $_POST['usulanID'];
    $log = "hapus_aset_usulan_penggunaan_".$id;

    $status=exec("php hapus_aset_usulan_penggunaan_helper_all.php $id > ../../log/$log.txt 2>&1 &");
    echo "<meta http-equiv=\"Refresh\" content=\"0; url={$url_rewrite}/module/penggunaanv2/dftr_review_usulan_penggunaan.php?id=$id\">";    
    exit;
}else{
    $id = $_POST['usulanID'];
    $log = "hapus_aset_usulan_penggunaan_".$id;

    $apl_userasetlistHPS = $PENGHAPUSAN->apl_userasetlistHPS("DELUSPNG");
    //pr($apl_userasetlistHPS);
    $addExplode = explode(",",$apl_userasetlistHPS[0]['aset_list']);
    $cleanArray = array_filter($addExplode);
    $implodeAset_ID = implode(",",$cleanArray);
    $arr = array("0"=>$implodeAset_ID);
    /*pr($apl_userasetlistHPS);
    pr($cleanArray);
    pr($implodeAset_ID);
    pr($data);*/
    $data = $arr['0'];
    //pr($data);
    //$data = $apl_userasetlistHPS['0']['aset_list'];
    //pr($data);
    //exit;
    $data_delete=$PENGHAPUSAN->apl_userasetlistHPS_del("DELUSPNG");
    

    $status=exec("php hapus_aset_usulan_penggunaan_helper.php $id $data > ../../log/$log.txt 2>&1 &");
    echo "<meta http-equiv=\"Refresh\" content=\"0; url={$url_rewrite}/module/penggunaanv2/dftr_review_usulan_penggunaan.php?id=$id\">";    
    exit;
}
    
?>
