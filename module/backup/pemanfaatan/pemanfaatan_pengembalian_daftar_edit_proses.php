<?php
include "../../config/config.php"; 
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$usernm='admin';
$id=$_POST['id'];
$no=$_POST['peman_pengem_eks_nobast'];
$tgl=$_POST['peman_pengem_eks_tglbast'];
$olah_tgl=format_tanggal_db2($tgl);
$lokasi=$_POST['peman_pengem_eks_lokasi_serah_terima'];
$nama1=$_POST['peman_pengem_eks_nm1'];
$nama2=$_POST['peman_pengem_eks_nm2'];
$jabatan1=$_POST['peman_pengem_eks_jabatan1'];
$jabatan2=$_POST['peman_pengem_eks_jabatan2'];
$nip1=$_POST['peman_pengem_eks_nip1'];
$nip2=$_POST['peman_pengem_eks_nip2'];
$lokasi1=$_POST['peman_pengem_eks_lokasi1'];
$lokasi2=$_POST['peman_pengem_eks_lokasi2'];
$submit=$_POST['submit'];

//echo "$id";

if(isset($submit)){
    $query="UPDATE BAST_Pengembalian SET NoBAST='$no', TglBAST='$olah_tgl', NamaPihak1='$nama1', JabatanPihak1='$jabatan1', NIPPihak1='$nip1', NamaPihak2='$nama2', JabatanPihak2='$jabatan2', NIPPihak2='$nip2', UserNm='$usernm', TglUpdate='$olah_tgl', LokasiPihak1='$lokasi1', LokasiPihak2='$lokasi2', LokasiBAST='$lokasi' WHERE BAST_Pengembalian_ID='$id'";
    $exec=mysql_query($query) or die(mysql_error());
    echo "<script>alert('Data Sudah di Edit !!!'); document.location='pemanfaatan_pengembalian_daftar.php';</script>";
}
?>
