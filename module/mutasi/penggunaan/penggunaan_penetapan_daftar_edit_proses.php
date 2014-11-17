<?php
include "../../config/config.php"; 

$menu_id = 30;
($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
$SessionUser = $SESSION->get_session_user();
$USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);


$id=$_POST['id_hidden'];
$tgl_aset=$_POST['penggu_penet_eks_tglpenet'];
$change_tgl=  format_tanggal_db2($tgl_aset);
$noaset=$_POST['penggu_penet_eks_nopenet'];
$ket=$_POST['penggu_penet_eks_ket'];
$submit=$_POST['penggunaan_edit_eks'];

$data=$UPDATE->update_daftar_penetapan_penggunaan($id,$tgl_aset,$change_tgl,$noaset,$ket,$submit);

/*

if(isset($submit)){
    $query="UPDATE Penggunaan SET TglSKKDH='$change_tgl', NoSKKDH='$noaset', Keterangan='$ket', TglUpdate='$change_tgl' WHERE Penggunaan_ID='$id'";
    $exec=mysql_query($query);
    echo "<script>alert('Data Sudah di Edit !!!'); document.location='$url_rewrite/module/penggunaan/penggunaan_penetapan_daftar.php';</script>";
}
 * 
 */
echo "<script>alert('Data Sudah di Edit !!!'); document.location='$url_rewrite/module/penggunaan/penggunaan_penetapan_daftar.php?pid=1';</script>";
?>
