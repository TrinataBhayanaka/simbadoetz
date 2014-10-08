<?php

include "../../config/config.php";

$UserNm=$_SESSION['ses_uoperatorid'];// usernm akan diganti jika session di implementasikan
$nmaset=$_POST['peman_idle_nama_aset'];
$asset_id=Array();
$no_reg=Array();
$nm_barang=Array();

$panjang=count($nmaset);

$peman_penet_bmd_eks_ket=$_POST['peman_penet_bmd_eks_ket'];	
$peman_penet_bmd_eks_nopenet=$_POST['peman_penet_bmd_eks_nopenet'];	
$peman_penet_bmd_eks_tglpenet=$_POST['peman_penet_bmd_eks_tglpenet'];	
$olah_tgl=  format_tanggal_db2($peman_penet_bmd_eks_tglpenet);

$menganggur_id=get_auto_increment("Menganggur");
 $query="insert into Menganggur (Menganggur_ID, NoSKKDH , TglSKKDH, 
                                    Keterangan, NotUse, TglUpdate, 
                                    UserNm, FixMenganggur) 
                                values (null,'$peman_penet_bmd_eks_nopenet','$olah_tgl',
                                       '$peman_penet_bmd_eks_ket','','$olah_tgl','
                                   $UserNm','1')";
 
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
    
    $query="insert into MenganggurAset(Menganggur_ID,Aset_ID,StatusUsulan) values('$menganggur_id','$asset_id[$i]','0')";
    $result=  mysql_query($query) or die(mysql_error());

    
    $query2="UPDATE Aset SET LastMenganggur_ID='$menganggur_id' WHERE Aset_ID='$asset_id[$i]'";
    $result2=mysql_query($query2) or die(mysql_error());
    
    $query2="UPDATE PenggunaanAset SET StatusMenganggur=1, Menganggur_ID='$menganggur_id' WHERE Aset_ID='$asset_id[$i]'";
    $result2=mysql_query($query2) or die(mysql_error());
}

$query_hapus_apl="DELETE FROM apl_userasetlist WHERE aset_action='pemanfaatan[]' AND UserSes='$_SESSION[ses_uid]'";
$exec_hapus=  mysql_query($query_hapus_apl) or die(mysql_error());

echo "<script>alert('Data Berhasil Disimpan'); document.location='$url_rewrite/module/pemanfaatan/pemanfaatan_penetapan_idle_daftar.php?pid=1';</script>";





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
