<?php
include "../../config/config.php"; 
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$UserNm=$_SESSION['ses_uname'];// usernm akan diganti jika session di implementasikan
$guid=$_SESSION['ses_uid'];
$id=$_POST['id'];
$no_penetapan=$_POST['NoBASP'];
$tgl_penetapan=$_POST['TglBAST'];
$no_bast=$_POST['bupt_bast_nobast'];
$tgl_bast=$_POST['bupt_bast_tglbast'];
$olah_tgl_penetapan=  format_tanggal_db2($tgl_penetapan);
$olah_tgl_bast=  format_tanggal_db2($tgl_bast);
$lokasi_basp=$_POST['LokasiBASP'];
$tipe_pemindahtanganan=$_POST['bupt_bast_tipepemindahtanganan'];
$peruntukan=$_POST['bupt_bast_peruntukan'];
$alamat_pihak_kedua=$_POST['bupt_bast_alamat'];	
$nama1=$_POST['bupt_bast_nama_1'];
$jabatan1=$_POST['bupt_bast_jabatan_1'];
$nip1=$_POST['bupt_bast_nip_1'];
$lokasi1=$_POST['bupt_bast_lokasi_1'];
$nama2=$_POST['bupt_bast_nama_2'];
$jabatan2=$_POST['bupt_bast_jabatan_2'];
$nip2=$_POST['bupt_bast_nip_2'];
$lokasi2=$_POST['bupt_bast_lokasi_2'];
$submit=$_POST['btn_action'];

$data=$UPDATE->update_daftar_penetapan_pemindahtanganan
        (
            $UserNm,
            $guid,
            $id,
            $no_penetapan,
            $tgl_penetapan,
            $no_bast,
            $tgl_bast,
            $olah_tgl_penetapan,
            $olah_tgl_bast,
            $lokasi_basp,
            $tipe_pemindahtanganan,
            $peruntukan,
            $alamat_pihak_kedua,
            $nama1,
            $jabatan1,
            $nip1,
            $lokasi1,
            $nama2,
            $jabatan2,
            $nip2,
            $lokasi2,
            $submit
        );
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
    $query="UPDATE BASP SET NoBASP='$no_bast', TglBASP='$olah_tgl_bast', NamaPihak1='$nama1', JabatanPihak1='$jabatan1',
                    NIPPihak1='$nip1', NamaPihak2='$nama2', JabatanPihak2='$jabatan2', NIPPihak2='$nip2', UserNm='$UserNm',
                    LokasiPihak1='$lokasi1', LokasiPihak2='$lokasi2', TglUpdate='$olah_tgl_penetapan', LokasiBASP='$lokasi_basp', TipePemindahtanganan='$tipe_pemindahtanganan',
                    GUID='$guid', TglSKPenetapan='$olah_tgl_penetapan', NoSKPenetapan='$no_penetapan', Peruntukan='$peruntukan', Alamat_Pihak_2='$alamat_pihak_kedua'
                    WHERE BASP_ID='$id'";
    $exec=mysql_query($query) or die(mysql_error());
 * 
 */
    echo "<script>alert('Data Sudah di Edit !!!'); document.location='$url_rewrite/module/pemindahtanganan/tampil_penetapan_pemindahtanganan.php?pid=1';</script>";

 
?>
