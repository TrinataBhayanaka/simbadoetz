<?php

include "../../config/config.php"; 

        $menu_id = 47;
        $SessionUser = $SESSION->get_session_user();
        ($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
        $USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);
                                  

$UserNm=$_SESSION['ses_uname'];// usernm akan diganti jika session di implementasikan
$nmaset=$_POST['pemusnahan_penet_nama_aset'];
$pemusnahan_id=get_auto_increment("BAPemusnahan");
$ses_uid=$_SESSION['ses_uid'];

$no=$_POST['pemusnahan_penet_eks_nopenet'];
$tgl=$_POST['pemusnahan_penet_eks_tglpenet'];
$olah_tgl=  format_tanggal_db2($tgl);
$penanda_tangan=$_POST['pemusnahan_penet_eks_penandatangan'];
$jabatan_penanda_tangan=$_POST['pemusnahan_penet_eks_jabatan'];
$nip=$_POST['pemusnahan_penet_eks_nip'];


$data=$STORE->store_penetapan_pemusnahan
    (
            $UserNm,
            $nmaset,
            $pemusnahan_id,
            $ses_uid,
            $no,
            $tgl,
            $olah_tgl,
            $penanda_tangan,
            $jabatan_penanda_tangan,
            $nip
    );


/*
$asset_id=Array();
$no_reg=Array();
$nm_barang=Array();

$panjang=count($nmaset);
 $query="insert into BAPemusnahan (BAPemusnahan_ID, NoBAPemusnahan, TglBAPemusnahan, NamaPenandatangan, UserNm, 
                                    TglUpdate, NIPPenandatangan, JabatanPenandatangan, GUID, FixPemusnahan, Status) 
                                values ('','$no','$olah_tgl','$penanda_tangan',
                                       '$UserNm','$olah_tgl','$nip','$jabatan_penanda_tangan','$_SESSION[ses_uid]','1','0')";
 
 $result=  mysql_query($query) or die(mysql_error());
 
 
 
for($i=0;$i<$panjang;$i++){
    
    $tmp=$nmaset[$i];
    $tmp_olah=explode("<br>",$tmp);
    $asset_id[$i]=$tmp_olah[0];
    $no_reg[$i]=$tmp_olah[1];
    $nm_barang[$i]=$tmp_olah[2];
    echo  "No= $i <br/>
            Asset ID =$asset_id[$i] <br/>
            No register=$no_reg[$i] <br/>
            Nama barang =$nm_barang[$i] <br/>";
    
    $query="insert into BAPemusnahanAset(BAPemusnahan_ID,Aset_ID,Status) values('$pemusnahan_id','$asset_id[$i]','0')";
    $result=  mysql_query($query) or die(mysql_error());
    $query2="UPDATE UsulanAset SET StatusPenetapan=1, Penetapan_ID='$pemusnahan_id' WHERE Aset_ID='$asset_id[$i]' AND Jenis_Usulan='MSN'";
    $result2=mysql_query($query2) or die(mysql_error());

    $query3="UPDATE Aset SET BAPemusnahan_ID='$pemusnahan_id' WHERE Aset_ID='$asset_id[$i]'";
    $result3=mysql_query($query3) or die(mysql_error());
}

$query_hapus_apl="DELETE FROM apl_userasetlist WHERE aset_action='PemusnahanPenetapan' AND UserSes='$_SESSION[ses_uid]'";
$exec_hapus=  mysql_query($query_hapus_apl) or die(mysql_error());
 * 
 */

echo "<script>alert('Data Sudah Terkirim.. !!!'); document.location='$url_rewrite/module/pemusnahan/penetapan_pemusnahan_daftar_kosong.php?pid=1';</script>";





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