<?php
include "../../config/config.php"; 


$PENGHAPUSAN = new RETRIEVE_PENGHAPUSAN;

$menu_id = 39;
($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
$SessionUser = $SESSION->get_session_user();
$USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$id=$_POST['id'];
$no=$_POST['bup_pp_noskpenghapusan'];
$tgl=$_POST['bup_pp_tanggal'];
$olah_tgl=  format_tanggal_db2($tgl);
$keterangan=$_POST['bup_pp_get_keterangan'];
$submit=$_POST['btn_action'];
// pr($_POST);
// exit;

// $data=$UPDATE->update_daftar_penetapan_penghapusan($id,$no,$tgl,$olah_tgl,$keterangan,$submit);
	
	$data = $PENGHAPUSAN->update_daftar_penetapan_penghapusan_pmd($_POST);

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
    $query="UPDATE Penghapusan SET NoSKHapus='$no', TglHapus='$olah_tgl', AlasanHapus='$keterangan' WHERE Penghapusan_ID='$id'";
    $exec=mysql_query($query) or die(mysql_error());
}
 *  * 
 */
    echo "<script>alert('Data Berhasil Disimpan'); document.location='$url_rewrite/module/penghapusan/dftr_penetapan_pmd.php?pid=1';</script>";

 
 
?>
