<?php
include "../../config/config.php"; 


$menu_id = 43;
($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
$SessionUser = $SESSION->get_session_user();
$USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);

$id=$_GET['id'];

$dataArr = $DELETE->delete_daftar_penetapan_pemindahtanganan($id);
/*
$query="UPDATE BASP SET FixPemindahtanganan=0 WHERE BASP_ID='$id'";
$exec=mysql_query($query) or die(mysql_error());

$query2="UPDATE UsulanAset SET StatusPenetapan=0 WHERE Penetapan_ID='$id' AND Jenis_Usulan='PDH'";
$exec2=mysql_query($query2) or die(mysql_error());


$tampil="SELECT Aset_ID,NomorRegOrigin FROM BASPAset WHERE BASP_ID='$id'";
$exec_tampil=mysql_query($tampil) or die(mysql_error());
while($array=  mysql_fetch_array($exec_tampil)){
        
        $nomorreg=$array['NomorRegOrigin'];
        $asetid=$array['Aset_ID'];
        
        $update="UPDATE Aset Set NomorReg='$nomorreg' WHERE Aset_ID='$asetid'";
        print_r($update);
        $query_update=mysql_query($update) or die(mysql_error());
        if($query_update)
        {
            $status = 1;
        }
        else
        {
            $status = 0;
        }
        
}

if ($status == 1)
{
    echo 'ada';
}

$query3="DELETE FROM BASPAset WHERE BASP_ID='$id' AND Status=0";
$exec3=mysql_query($query3) or die(mysql_error());

$query4="UPDATE Aset SET BASP_ID=0 WHERE BASP_ID='$id'";
$exec4=mysql_query($query4) or die(mysql_error());
*/
echo "<script>alert('Data Sudah Terhapus'); document.location='$url_rewrite/module/pemindahtanganan/tampil_penetapan_pemindahtanganan.php?pid=1';</script>";

?>