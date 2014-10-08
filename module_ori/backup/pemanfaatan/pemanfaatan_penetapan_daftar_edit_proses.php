<?php
include "../../config/config.php"; 
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$id=$_POST['id'];
$no=$_POST['peman_penet_eks_nopenet'];
$tgl=$_POST['peman_penet_eks_tglpenet'];
$olah_tgl=  format_tanggal_db2($tgl);
$tipe=$_POST['peman_penet_eks_tipe'];
$ket=$_POST['peman_penet_eks_ket'];
$nama_partner=$_POST['peman_penet_eks_nmpartner'];
$alamat_partner=$_POST['peman_penet_eks_alamatpartner'];
$tgl_mulai=$_POST['peman_penet_eks_tglmulai'];
$olah_tgl_mulai=  format_tanggal_db2($tgl_mulai);
$tgl_selesai=$_POST['peman_penet_eks_tglselesai'];
$olah_tgl_selesai=  format_tanggal_db2($tgl_selesai);
$jangka_waktu=$_POST['peman_penet_eks_jangkawaktu'];
$submit=$_POST['submit'];

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
 * 
 */


if(isset($submit)){
    $query="UPDATE Pemanfaatan SET NoSKKDH='$no', TglSKKDH='$olah_tgl', TipePemanfaatan='$tipe', Keterangan='$ket',
                NamaPartner='$nama_partner', AlamatPartner='$alamat_partner', TglMulai='$olah_tgl_mulai', TglSelesai='$olah_tgl_selesai', JangkaWaktu='$jangka_waktu' WHERE Pemanfaatan_ID='$id'";
    $exec=mysql_query($query) or die(mysql_error());
    echo "<script>alert('Data Sudah di Edit !!!'); document.location='$url_rewrite/module/pemanfaatan/pemanfaatan_penetapan_daftar.php';</script>";
}
 
 
?>
