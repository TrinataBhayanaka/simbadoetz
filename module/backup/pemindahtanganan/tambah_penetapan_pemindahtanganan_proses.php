<?php

include "../../config/config.php"; 
                   
$menu_id = 43;
($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
$SessionUser = $SESSION->get_session_user();
$USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);

$pemindahtanganan_id=get_auto_increment("BASP");
$UserNm=$_SESSION['ses_uname'];// usernm akan diganti jika session di implementasikan
$guid=$_SESSION['ses_uid'];
$nmaset=$_POST['pemindahtanganan_penet_nama_aset'];

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

if(isset($submit)){
$dataArr = $STORE->store_penetapan_pemindahtanganan(
                $pemindahtanganan_id,
                $UserNm,
                $guid,
                $nmaset,
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
}

/*
$asset_id=Array();
$no_reg=Array();
$nm_barang=Array();

$panjang=count($nmaset);

if(isset($submit)){

if($nmaset!="" && $no_penetapan!="" && $tgl_penetapan!="" && $no_bast!="" && $tgl_bast!="" && $lokasi_basp!=""
        && $tipe_pemindahtanganan!="" && $peruntukan!="" && $alamat_pihak_kedua!="" && $nama1!=""
        && $jabatan1!="" && $nip1!="" && $lokasi1!="" && $nama2!="" && $jabatan2!="" && $nip2!="" && $lokasi2!=""){
    
    echo "<script>var r=confirm('Data Sudah Benar ???');
                            if(r==false){
                            document.location='tambah_penetapan_pemindahtanganan.php';
                            }
            </script>";
}


$pemindahtanganan_id=get_auto_increment("BASP");
 $query="insert into BASP (BASP_ID, NoBASP, TglBASP, NamaPihak1, JabatanPihak1, NIPPihak1,
                                                            NamaPihak2, JabatanPihak2, NIPPihak2, UserNm, LokasiPihak1, LokasiPihak2, TglUpdate,
                                                            LokasiBASP, BASP_Ket, BASP_Tahun, BASP_Nilai, BASP_Instansi, BASP_Kab, X, TipePemindahtanganan, GUID,
                                                            TglSKPenetapan, NoSKPenetapan, NoSKPenghapusan, TglSKPenghapusan, Peruntukan, Alamat_Pihak_2,
                                                            FixPemindahtanganan, Status) 
                                values ('','$no_bast','$olah_tgl_bast','$nama1','$jabatan1','$nip1','$nama2','$jabatan2','$nip2','$UserNm',
                                       '$lokasi1','$lokasi2','$olah_tgl_penetapan','$lokasi_basp','','','','','','','$tipe_pemindahtanganan','$guid',
                                        '$olah_tgl_penetapan','$no_penetapan','','','$peruntukan','$alamat_pihak_kedua','1','0')";
 
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
    
    $query="insert into BASPAset(BASP_ID,Aset_ID,Status) values('$pemindahtanganan_id','$asset_id[$i]','0')";
    $result=  mysql_query($query) or die(mysql_error());
    
    
    
    $query2="UPDATE UsulanAset SET StatusPenetapan=1, Penetapan_ID='$pemindahtanganan_id' WHERE Aset_ID='$asset_id[$i]' AND Jenis_Usulan='PDH'";
    $result2=mysql_query($query2) or die(mysql_error());


    $query3="UPDATE Aset SET BASP_ID='$pemindahtanganan_id' WHERE Aset_ID='$asset_id[$i]'";
    $result3=mysql_query($query3) or die(mysql_error());
    
    $query_tampil="SELECT NomorReg FROM Aset WHERE Aset_ID='$asset_id[$i]'";
    $result_tampil=mysql_query($query_tampil) or die(mysql_error());
    $exec_tampil=mysql_fetch_array($result_tampil);
    
    $param=$exec_tampil['NomorReg'];
    
    
    $pecah=explode(".",$param);
    $pecah1=$pecah[0];
    $pecah2=$pecah[1];
    $pecah3=$pecah[2];
    $pecah4=$pecah[3];
    $pecah5=$pecah[4];
    $pecah6=$pecah[5];
    $pecah7=$pecah[6];
    
    $array=array($peruntukan,$pecah2,$pecah3,$pecah4,$pecah5,$pecah6,$pecah7);
    $gabung=implode(".",$array);
   
    echo "$gabung";
    
    $query5="UPDATE Aset SET NomorReg='$gabung' WHERE Aset_ID='$asset_id[$i]'";
    $result5=mysql_query($query5) or die(mysql_error());

    $query_update_baspaset="UPDATE BASPAset SET NomorRegOrigin='$param' WHERE Aset_ID='$asset_id[$i]]'";
    $result_update_baspaset=mysql_query($query_update_baspaset) or die(mysql_error());
}

$query_hapus_apl="DELETE FROM apl_userasetlist WHERE aset_action='PemindahtangananPenetapan' AND UserSes='$_SESSION[ses_uid]'";
$exec_hapus=  mysql_query($query_hapus_apl) or die(mysql_error());
*/
echo "<script>alert('Data Sudah Terkirim.. !!!'); document.location='$url_rewrite/module/pemindahtanganan/tampil_penetapan_pemindahtanganan.php?pid=1';</script>";




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