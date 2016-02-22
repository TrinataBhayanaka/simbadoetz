<?php

include "../../config/config.php"; 

$PENGHAPUSAN = new RETRIEVE_PENGHAPUSAN;

$menu_id = 40;
$SessionUser = $SESSION->get_session_user();
($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
$USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);
$submit=$_POST['submit'];
$ses_uid=$_SESSION['ses_uid'];

$parameter=array('submit'=>$submit, 'ses_uid'=>$ses_uid);
// $data=$UPDATE->update_validasi_penghapusan($parameter);

        $data_post=$PENGHAPUSAN->apl_userasetlistHPS("VLDUSPMD");
        // pr($data_post);
        $POST=$_POST;
        // //pr($POST);
        $POST_data=$PENGHAPUSAN->apl_userasetlistHPS_filter($data_post);
        $POST['ValidasiPenghapusan']=$POST_data;
		// pr($_POST);
  //       pr($POST);
  //       exit;
		$data = $PENGHAPUSAN->update_validasi_penghapusan_pmd($_POST);

        if($data_post){
         $data_delete=$PENGHAPUSAN->apl_userasetlistHPS_del("VLDUSPMD");
        }
/*

$query = "SELECT aset_list FROM apl_userasetlist WHERE aset_action = 'ValidasiPenghapusan' AND UserSes = '$_SESSION[ses_uid]'";
//print_r($query);
$result = mysql_query($query) or die (mysql_error());


$numRows = mysql_num_rows($result);
if ($numRows)
{
    $dataID = mysql_fetch_object($result);
}

    $explodeID = explode(',',$dataID->aset_list);
    

    $cnt=count($explodeID);
    echo "$cnt";

for ($i=0; $i<$cnt; $i++){
    echo "$i";
    echo "$id[$i]";
    if($explodeID!=""){
    
    $query="UPDATE Penghapusan SET Status=1 WHERE Penghapusan_ID='$explodeID[$i]'";
    $exec=mysql_query($query) or die(mysql_error());
    
    $query2="UPDATE PenghapusanAset SET Status=1 WHERE Penghapusan_ID='$explodeID[$i]'";
    $exec=mysql_query($query2) or die(mysql_error());
    }
}

$query_hapus_apl="DELETE FROM apl_userasetlist WHERE aset_action='ValidasiPenghapusan' AND UserSes='$_SESSION[ses_uid]'";
$exec_hapus=  mysql_query($query_hapus_apl) or die(mysql_error());
 * 
 */

echo "<script>alert('Data Telah Divalidasi'); document.location='$url_rewrite/module/penghapusan/dftr_validasi_pmd.php?pid=1';</script>";


?>
