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
                                  

$UserNm=$_SESSION['ses_uoperatorid'];// usernm akan diganti jika session di implementasikan
$nmaset=$_POST['peman_pengem_eks_aset'];
$asset_id=Array();
$no_reg=Array();
$nm_barang=Array();

$panjang=count($nmaset);
// echo "panjang =".$panjang;
$no=$_POST['peman_pengem_eks_nobast'];
$tgl=$_POST['peman_pengem_eks_tglbast'];
$olah_tgl=  format_tanggal_db2($tgl);
$lokasi=$_POST['peman_pengem_eks_lokasi_serah_terima'];
$nama1=$_POST['peman_pengem_eks_nm1'];
$nama2=$_POST['peman_pengem_eks_nm2'];
$jabatan1=$_POST['peman_pengem_eks_jabatan1'];
$jabatan2=$_POST['peman_pengem_eks_jabatan2'];
$nip1=$_POST['peman_pengem_eks_nip1'];
$nip2=$_POST['peman_pengem_eks_nip2'];
$lokasi1=$_POST['peman_pengem_eks_lokasi1'];
$lokasi2=$_POST['peman_pengem_eks_lokasi2'];
// pr($_POST);
// exit; 

    $pengembalian_id=get_auto_increment("bast_pengembalian");
    $query="insert into bast_pengembalian (BAST_Pengembalian_ID, NoBAST, TglBAST, NamaPihak1, 
                                    JabatanPihak1, NIPPihak1, NamaPihak2, JabatanPihak2, NIPPihak2, UserNm,
                                    TglUpdate, LokasiPihak1, LokasiPihak2, LokasiBAST, GUID, FixPengembalian) 
                                values ('','$no','$olah_tgl','$nama1','$jabatan1','$nip1',
                                       '$nama2','$jabatan2','$nip2','$UserNm','$olah_tgl',
                                        '$lokasi1','$lokasi2','$lokasi','','1')";
	// pr($query);
 $result=  mysql_query($query) or die(mysql_error());
 
for($i=0;$i<$panjang;$i++){
    
    $tmp=$nmaset[$i];
    // pr($tmp);
	$tmp_olah=explode("<br/>",$tmp);
	// pr($tmp_olah);
    $asset_id[$i]=$tmp_olah[0];
	// pr($asset_id);
    $no_reg[$i]=$tmp_olah[1];
    // pr($no_reg);
	$nm_barang[$i]=$tmp_olah[2];
    
    /*
            echo  "No= $i <br/>
            Asset ID =$asset_id[$i] <br/>
            No register=$no_reg[$i] <br/>
            Nama barang =$nm_barang[$i] <br/>";
     * 
     */
    
    $query="insert into bast_pengembalianaset(BAST_Pengembalian_ID,Aset_ID) values('$pengembalian_id','$asset_id[$i]')";
    $result=  mysql_query($query) or die(mysql_error());

    /*untuk penambahan pengembalian_id di table aset
    $query2="UPDATE Aset SET LastPengembalian_ID='$pengembalian_id' WHERE Aset_ID='$asset_id[$i]'";
    $result2=mysql_query($query2) or die(mysql_error());
    */


    $query2="UPDATE PemanfaatanAset SET StatusPengembalian=1, BAST_Pengembalian_ID='$pengembalian_id' WHERE Aset_ID='$asset_id[$i]'";
    $result2=mysql_query($query2) or die(mysql_error());
    
    $query3="UPDATE Aset SET NotUse=0, CurrentPemanfaatan_ID=NULL, LastPengembalian_ID='$pengembalian_id' WHERE Aset_ID='$asset_id[$i]'";
    $result3=mysql_query($query3) or die(mysql_error());
}

$query_hapus_apl="DELETE FROM apl_userasetlist WHERE aset_action='PengembalianPemanfaatan[]' AND UserSes='$_SESSION[ses_uid]'";
$exec_hapus=  mysql_query($query_hapus_apl) or die(mysql_error());
// exit;
echo "<script>alert('Data Berhasil Disimpan'); document.location='$url_rewrite/module/pemanfaatan/pemanfaatan_pengembalian_daftar.php?pid=1';</script>";





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
