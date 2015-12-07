<?php

include "../../config/config.php";

$PENGGUNAAN = new RETRIEVE_PENGGUNAAN;

$menu_id = 30;
($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
$SessionUser = $SESSION->get_session_user();
$USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);

$submit=$_POST['penggunaan_eks'];

$UserNm=$_SESSION['ses_uoperatorid'];// usernm akan diganti jika session di implementasikan
$nmaset=$_POST['penggu_nama_aset'];
$penggunaan_id=get_auto_increment("Penggunaan");
$ses_uid=$_SESSION['ses_uid'];

$penggu_penet_eks_ket=$_POST['penggu_penet_eks_ket'];	
$penggu_penet_eks_nopenet=$_POST['penggu_penet_eks_nopenet'];	
$penggu_penet_eks_tglpenet=$_POST['penggu_penet_eks_tglpenet'];	
$olah_tgl=  format_tanggal_db2($penggu_penet_eks_tglpenet);
// pr($_POST);
// exit;
$data=$PENGGUNAAN->store_penetapan_penggunaan($_POST);

$DBVAR->log(3, $_POST);

// exit;
/*

$asset_id=Array();
$no_reg=Array();
$nm_barang=Array();

$panjang=count($nmaset);

if(isset($submit)){


 $query="insert into Penggunaan (Penggunaan_ID, NoSKKDH , TglSKKDH, 
                                    Keterangan, NotUse, TglUpdate, UserNm, FixPenggunaan, GUID) 
                                values (null,'$penggu_penet_eks_nopenet','$olah_tgl', '$penggu_penet_eks_ket','','$olah_tgl','$UserNm','1','$ses_uid')";
 //print_r($query);
 $result=  mysql_query($query) or die(mysql_error());
 
for($i=0;$i<$panjang;$i++){
    
    $tmp=$nmaset[$i];
    $tmp_olah=explode("<br/>",$tmp);
    $asset_id[$i]=$tmp_olah[0];
    $no_reg[$i]=$tmp_olah[1];
    $nm_barang[$i]=$tmp_olah[2];
    
    $query="insert into PenggunaanAset(Penggunaan_ID,Aset_ID) values('$penggunaan_id','$asset_id[$i]')  ";
    $result=  mysql_query($query) or die(mysql_error());

    $query2="UPDATE Aset SET NotUse=1, LastPenggunaan_ID='$penggunaan_id' WHERE Aset_ID='$asset_id[$i]'";
    $result2=mysql_query($query2) or die(mysql_error());
}

$query_hapus_apl="DELETE FROM apl_userasetlist WHERE aset_action='Penggunaan' AND UserSes='$ses_uid'";
$exec_hapus=  mysql_query($query_hapus_apl) or die(mysql_error());

echo "<script>alert('Data Sudah Terkirim.. !!!'); document.location='$url_rewrite/module/penggunaan/penggunaan_penetapan_daftar.php?pid=1';</script>";
}
 * 
 */

echo "<script>alert('Data Berhasil Disimpan'); document.location='$url_rewrite/module/penggunaan/penggunaan_penetapan_daftar.php?pid=1';</script>";

?>
