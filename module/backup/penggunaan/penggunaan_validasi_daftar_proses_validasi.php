<?php

include "../../config/config.php"; 

$menu_id = 31;
$SessionUser = $SESSION->get_session_user();
($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
$USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);

$submit=$_POST['submit'];
$ses_uid=$_SESSION['ses_uid'];

$parameter=array('submit'=>$submit, 'ses_uid'=>$ses_uid);
$data=$UPDATE->update_validasi_penggunaan($parameter);

/*
$query = "SELECT aset_list FROM apl_userasetlist WHERE aset_action = 'ValidasiPenggunaan' AND UserSes = '$_SESSION[ses_uid]'";
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
    if($explodeID!=""){
    $query="UPDATE Penggunaan SET Status=1 WHERE Penggunaan_ID='$explodeID[$i]'";
    $exec=mysql_query($query) or die(mysql_error());
    
    $query="UPDATE PenggunaanAset SET Status=1 WHERE Penggunaan_ID='$explodeID[$i]'";
    $exec=mysql_query($query) or die(mysql_error());
    }
}
$query_hapus_apl="DELETE FROM apl_userasetlist WHERE aset_action='ValidasiPenggunaan' AND UserSes='$_SESSION[ses_uid]'";
$exec_hapus=  mysql_query($query_hapus_apl) or die(mysql_error());
 * 
 */

echo "<script>alert('Data Sudah Tervalidasi'); document.location='$url_rewrite/module/penggunaan/penggunaan_validasi_daftar.php?pid=1';</script>";


?>
