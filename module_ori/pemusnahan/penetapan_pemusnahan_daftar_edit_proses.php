<?php
include "../../config/config.php"; 
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$menu_id = 47;
($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
$SessionUser = $SESSION->get_session_user();
$USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);

$id=$_POST['id'];
$no=$_POST['pemusnahan_penet_eks_nopenet'];
$tgl=$_POST['pemusnahan_penet_eks_tglpenet'];
$olah_tgl=  format_tanggal_db2($tgl);
$penanda_tangan=$_POST['pemusnahan_penet_eks_penandatangan'];
$jabatan_penanda_tangan=$_POST['pemusnahan_penet_eks_jabatan'];
$nip=$_POST['pemusnahan_penet_eks_nip'];
$submit=$_POST['submit'];

$data=$UPDATE->update_daftar_penetapan_pemusnahan($id,$no,$tgl,$olah_tgl,$penanda_tangan,$jabatan_penanda_tangan,$nip,$submit);

/*
echo "$id";
echo "$no";
echo "$olah_tgl";
echo "$tipe";
echo "$ket";
echo "$nama_partner";
echo "$alamat_partner";
echo "$olah_tgl_mulai";
echo "$olah_tgl_selesai";
echo "$jangka_waktu";


if(isset($submit)){
    $query="UPDATE BAPemusnahan SET NoBAPemusnahan='$no', TglBAPemusnahan='$olah_tgl', NamaPenandatangan='$penanda_tangan', NIPPenandatangan='$nip', JabatanPenandatangan='$jabatan_penanda_tangan', TglUpdate='$olah_tgl' WHERE BAPemusnahan_ID='$id'";
    $exec=mysql_query($query) or die(mysql_error());
}
 *  * 
 */
    echo "<script>alert('Data Sudah di Edit !!!'); document.location='$url_rewrite/module/pemusnahan/penetapan_pemusnahan_daftar_kosong.php?pid=1';</script>";

 
 
?>
