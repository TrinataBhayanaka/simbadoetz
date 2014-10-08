<?php

include "../../config/config.php"; 
                                    /*
                                    $nama_aset=$_POST['peman_penet_nama_aset'];
                                    $no=$_POST['peman_penet_eks_nopenet'];
                                    $tgl=$_POST['peman_penet_eks_tglpenet'];
                                    $tipe=$_POST['peman_penet_eks_tipe'];
                                    $ket=$_POST['peman_penet_eks_ket'];
                                    $nama_partner=$_POST['peman_penet_eks_nmpartner'];
                                    $alamat_partner=$_POST['peman_penet_eks_alamatpartner'];
                                    $tgl_mulai=$_POST['peman_penet_eks_tglmulai'];
                                    $tgl_selesai=$_POST['peman_penet_eks_tglselesai'];
                                    $jangka_waktu=$_POST['peman_penet_eks_jangkawaktu'];
                                    */
                                  

$UserNm=$_SESSION['ses_uname'];// usernm akan diganti jika session di implementasikan
$nmaset=$_POST['peman_penet_nama_aset'];
$asset_id=Array();
$no_reg=Array();
$nm_barang=Array();

$panjang=count($nmaset);

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

$pemanfaatan_id=get_auto_increment("Pemanfaatan");
 $query="insert into Pemanfaatan (Pemanfaatan_ID, NoSKKDH, TipePemanfaatan, AlamatPartner, 
                                    Keterangan, TglSKKDH, NamaPartner, UserNm, TglUpdate, 
                                    TglMulai, TglSelesai, JangkaWaktu, FixPemanfaatan, Status) 
                                values (null,'$no','$tipe','$alamat_partner',
                                       '$ket','$olah_tgl','$nama_partner','$UserNm','$olah_tgl',
                                        '$olah_tgl_mulai','$olah_tgl_selesai','$jangka_waktu','1','0')";
 
 $result=  mysql_query($query) or die(mysql_error());
 
 
 
for($i=0;$i<$panjang;$i++){
    
    $tmp=$nmaset[$i];
    $tmp_olah=explode("<br/>",$tmp);
    $asset_id[$i]=$tmp_olah[0];
    $no_reg[$i]=$tmp_olah[1];
    $nm_barang[$i]=$tmp_olah[2];
    /*echo  "No= $i <br/>
            Asset ID =$asset_id[$i] <br/>
            No register=$no_reg[$i] <br/>
            Nama barang =$nm_barang[$i] <br/>";
     * 
     */
    
    $query="insert into PemanfaatanAset(Pemanfaatan_ID,Aset_ID,Status,StatusPengembalian) values('$pemanfaatan_id','$asset_id[$i]','0','0')";
    $result=  mysql_query($query) or die(mysql_error());

    /*untuk penambahan usulan_id di table aset
    $query2="UPDATE Aset SET LastUsulan_ID='$menganggur_id' WHERE Aset_ID='$asset_id[$i]'";
    $result2=mysql_query($query2) or die(mysql_error());
    */
    $query2="UPDATE UsulanAset SET StatusPenetapan=1, Penetapan_ID='$pemanfaatan_id' WHERE Aset_ID='$asset_id[$i]' AND Jenis_Usulan='MNF'";
    $result2=mysql_query($query2) or die(mysql_error());

    $query3="UPDATE Aset SET CurrentPemanfaatan_ID='$pemanfaatan_id', LastPemanfaatan_ID='$pemanfaatan_id' WHERE Aset_ID='$asset_id[$i]'";
    $result3=mysql_query($query3) or die(mysql_error());
}

$query_hapus_apl="DELETE FROM apl_userasetlist WHERE aset_action='PenetapanPemanfaatan' AND UserSes='$_SESSION[ses_uid]'";
$exec_hapus=  mysql_query($query_hapus_apl) or die(mysql_error());

echo "<script>alert('Data Sudah Terkirim.. !!!'); document.location='$url_rewrite/module/pemanfaatan/pemanfaatan_penetapan_daftar.php';</script>";





/*
$noskkdh=$_POST['penggu_penet_eks_nopenet'];
$tglskkdh=$_POST['penggu_penet_eks_tglpenet'];
$ketskkdh=$_POST['penggu_penet_eks_ket'];

$submit=$_POST['penggunaan_eks'];

$N = count($nmaset);

echo "$N".'<br>';   
for($i=0; $i < $N; $i++){
    $no=$i+1;
    
echo "$no";
echo "$nmaset[$i]";
}

echo "$noskkdh";
*/
?>
