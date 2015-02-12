<?php

include "../../config/config.php"; 

$PENGHAPUSAN = new RETRIEVE_PENGHAPUSAN;

$menu_id = 39;
($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
$SessionUser = $SESSION->get_session_user();
$USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);

$no=$_POST['bup_pp_noskpenghapusan'];
$tgl=$_POST['bup_pp_tanggal'];
$olah_tgl=  format_tanggal_db2($tgl);
$keterangan=$_POST['bup_pp_get_keterangan'];	
$UserNm=$_SESSION['ses_uoperatorid'];// usernm akan diganti jika session di implementasikan
$nmaset=$_POST['penghapusan_nama_aset'];
$ses_uid=$_SESSION[ses_uid];
$penghapusan_id=get_auto_increment("penghapusan");
// pr($_POST);
// pr($nmaset);
// exit;

    // $data=$STORE->store_penetapan_penghapusan
    // (
            // $no,-
            // $tgl,-
            // $olah_tgl,
            // $keterangan,-
            // $UserNm,
            // $nmaset,-
            // $ses_uid,
            // $penghapusan_id
    // );
		// pr($_POST);
        
        $data_post=$PENGHAPUSAN->apl_userasetlistHPS("PTUSPSB");
        $POST=$_POST;
        // pr($POST);
        $POST_data=$PENGHAPUSAN->apl_userasetlistHPS_filter($data_post);
        $POST['penghapusan_nama_aset']=$POST_data;
        // pr($POST);
        // pr($_POST);
  //       exit;
		$data = $PENGHAPUSAN->store_penetapan_penghapusan_psb($_POST);
        

        $data_delete=$PENGHAPUSAN->apl_userasetlistHPS_del("RVWPTUSPSB");

        $data_delete=$PENGHAPUSAN->apl_userasetlistHPS_del("PTUSPSB");
/*
$asset_id=Array();
$no_reg=Array();
$nm_barang=Array();

$panjang=count($nmaset);

$penghapusan_id=get_auto_increment("Penghapusan");
 $query="INSERT INTO Penghapusan (Penghapusan_ID, NoSKHapus, TglHapus, AlasanHapus, Status, UserNm, FixPenghapusan) 
                                values ('','$no', '$olah_tgl', '$keterangan', '0','$UserNm', '1')";
 $result=  mysql_query($query) or die(mysql_error());
 
 
 
for($i=0;$i<$panjang;$i++){
    
    $tmp=$nmaset[$i];
    $tmp_olah=explode("<br/>",$tmp);
    $asset_id[$i]=$tmp_olah[0];
    $no_reg[$i]=$tmp_olah[1];
    $nm_barang[$i]=$tmp_olah[2];
    echo  "No= $i <br/>
            Asset ID =$asset_id[$i] <br/>
            No register=$no_reg[$i] <br/>
            Nama barang =$nm_barang[$i] <br/>";
    
    $query="insert into PenghapusanAset(Penghapusan_ID,Aset_ID,Status) values('$penghapusan_id','$asset_id[$i]','0')";
    $result=  mysql_query($query) or die(mysql_error());

    $query2="UPDATE UsulanAset SET StatusPenetapan=1, Penetapan_ID='$penghapusan_id' WHERE Aset_ID='$asset_id[$i]' AND Jenis_Usulan='HPS'";
    $result2=mysql_query($query2) or die(mysql_error());

    $query3="UPDATE Aset SET Dihapus='1' WHERE Aset_ID='$asset_id[$i]'";
    $result3=mysql_query($query3) or die(mysql_error());
}

$query_hapus_apl="DELETE FROM apl_userasetlist WHERE aset_action='PenetapanPenghapusan' AND UserSes='$_SESSION[ses_uid]'";
$exec_hapus=  mysql_query($query_hapus_apl) or die(mysql_error());
*/

echo "<script>alert('Data Berhasil Disimpan'); document.location='dftr_penetapan_psb.php?pid=1';</script>";





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
