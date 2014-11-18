<?php
include "../../config/config.php"; 
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$id=$_POST['id'];
$tgl_aset=$_POST['peman_penet_bmd_eks_tglpenet'];
$change_tgl=  format_tanggal_db2($tgl_aset);
$noaset=$_POST['peman_penet_bmd_eks_nopenet'];
$ket=$_POST['peman_penet_bmd_eks_ket'];
$submit=$_POST['submit'];

if(isset($submit)){
    $query="UPDATE Menganggur 
			SET TglSKKDH='$change_tgl', NoSKKDH='$noaset', Keterangan='$ket', TglUpdate='$change_tgl' WHERE Menganggur_ID='$id'";
    $exec=mysql_query($query);
    echo "<script>alert('Data Berhasil Disimpan'); document.location='pemanfaatan_penetapan_idle_daftar.php?pid=1';</script>";
}
?>
