<?php

include "../../config/config.php";

$menu_id = 33;
($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
$SessionUser = $SESSION->get_session_user();
$USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);
// pr($_POST);
$nmaset=$_POST['peman_usul_nama_aset'];
$asetID=implode(",",$nmaset);
$UserNm=$_SESSION['ses_uoperatorid'];// usernm akan diganti jika session di implementasikan
$usulan_id=get_auto_increment("Usulan");
$date=date('Y-m-d');
$ses_uid=$_SESSION['ses_uid'];
// exit;
$asset_id=Array();
$no_reg=Array();
$nm_barang=Array();

$panjang=count($nmaset);

$query="insert into Usulan (Usulan_ID, Aset_ID, Penetapan_ID, 
                                    Jenis_Usulan, UserNm, TglUpdate, 
                                    GUID, FixUsulan) 
                                values ('', '$asetID', '', 'MNF', '$UserNm', '$date', '$ses_uid', '1')";
$result=  mysql_query($query) or die(mysql_error());

 
for($i=0;$i<$panjang;$i++){
    
    $tmp=$nmaset[$i];
    $tmp_olah=explode("<br/>",$tmp);
    $asset_id[$i]=$tmp_olah[0];
    $no_reg[$i]=$tmp_olah[1];
    $nm_barang[$i]=$tmp_olah[2];
    
    $query1="insert into UsulanAset(Usulan_ID,Penetapan_ID,Aset_ID,Jenis_Usulan,StatusPenetapan) values('$usulan_id','','$asset_id[$i]','MNF','0')";
    $result=  mysql_query($query1) or die(mysql_error());
    
    $query3="UPDATE Aset SET Usulan_Pemanfaatan_ID='$usulan_id' WHERE Aset_ID='$asset_id[$i]'";
    $result3=mysql_query($query3) or die(mysql_error());
    
    
    $query2="UPDATE MenganggurAset SET StatusUsulan=1, Usulan_ID='$usulan_id' WHERE Aset_ID='$asset_id[$i]'";
    $result2=mysql_query($query2) or die(mysql_error());
}

$query_hapus_apl="DELETE FROM apl_userasetlist WHERE aset_action='usulan_pemanfaatan_aset[]' AND UserSes='$ses_uid'";
$exec_hapus=  mysql_query($query_hapus_apl) or die(mysql_error());

echo "<script>
            alert('Data Berhasil Disimpan');
            document.location='$url_rewrite/module/pemanfaatan/pemanfaatan_usulan_eksekusi_data_proses.php?usulan_id=$usulan_id';
            </script>";
?>
