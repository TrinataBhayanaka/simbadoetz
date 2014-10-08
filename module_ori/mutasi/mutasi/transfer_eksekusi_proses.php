<?php

include "../../config/config.php";



$satker=$_POST['skpd_id']; 
$nodok=$_POST['mutasi_trans_eks_nodok'];
$tgl=$_POST['mutasi_trans_eks_tglproses'];
$olah_tgl=  format_tanggal_db2($tgl);
$alasan=$_POST['mutasi_trans_eks_alasan'];
$pemakai=$_POST['mutasi_trans_eks_pemakai'];


$UserNm=$_SESSION['ses_uname'];// usernm akan diganti jika session di implementasikan
$nmaset=$_POST['mutasi_nama_aset'];
$asset_id=Array();
$no_reg=Array();
$nm_barang=Array();

$panjang=count($nmaset);


$mutasi_id=get_auto_increment("Mutasi");


//Insert ke Mutasi
 $query="INSERT INTO Mutasi (Mutasi_ID, NoSKKDH , TglSKKDH, 
                                    Keterangan, SatkerTujuan, NotUse, TglUpdate, 
                                    UserNm, FixMutasi, Pemakai)
                                values ('','$nodok','$olah_tgl',
                                       '$alasan','$satker','','$olah_tgl','$UserNm','1','$pemakai')";
 
 $result=  mysql_query($query) or die(mysql_error());
 
//dapetin kode satker dan kode unit
 $query_satker_id="SELECT * FROM Satker WHERE Satker_ID='$satker'";
 $exec_query_satker_id=mysql_query($query_satker_id) or die(mysql_error());
 $hsl_query_satker_id=mysql_fetch_array($exec_query_satker_id);
 $row_kode_satker=$hsl_query_satker_id['KodeSatker'];
 $row_kode_unit=$hsl_query_satker_id['KodeUnit'];
 
 if($row_kode_unit==NULL){
     $row_kode_unit='00';
 }elseif($row_kode_unit!=""){
     $row_kode_unit=$row_kode_unit;
 }
 
 
for($i=0;$i<$panjang;$i++){
    
    $tmp=$nmaset[$i];
    $tmp_olah=explode("<br/>",$tmp);
    $asset_id[$i]=$tmp_olah[0];
    $no_reg[$i]=$tmp_olah[1];
    $nm_barang[$i]=$tmp_olah[2];
    
        //Tampilkan LastSatker_ID
        $query_prev_satker="SELECT LastSatker_ID
                                            FROM Aset WHERE Aset_ID=$asset_id[$i]";
        $exec_prev_satker=mysql_query($query_prev_satker) or die(mysql_error());
        $row_prev_satker=mysql_fetch_array($exec_prev_satker);
        $hsl_satker=$row_prev_satker['LastSatker_ID'];
        
        //Tampilkan Nama Satker
        $query_nm_satker_awal="SELECT NamaSatker FROM Satker WHERE Satker_ID='$hsl_satker'";
        $exec_query_nm_satker_awal=mysql_query($query_nm_satker_awal) or die(mysql_error());
        $row_query_nm_satker_awal=mysql_fetch_array($exec_query_nm_satker_awal);
        $hsl_nm_satker=$row_query_nm_satker_awal['NamaSatker'];
        
        //Tampilkan nomor registrasi untuk awal
    $query5="select * from Aset where Aset_ID='$asset_id[$i]'";
    $result5=  mysql_query($query5) or die(mysql_error());
    $row=  mysql_fetch_array($result5);
    $reg=$row['NomorReg'];
    
    //echo "$reg";
    
    $pecah=explode(".",$reg);
    $pemilik=$pecah[0];
    $provinsi=$pecah[1];
    $kabupaten=$pecah[2];
    $tahun=$pecah[5];
    
    //buat gabung nomor registrasi akhir
    $array=array($pemilik,$provinsi,$kabupaten,$row_kode_satker,$tahun,$row_kode_unit);
    $gabung_nomor_reg_tujuan=implode(".",$array);
    /*
    echo "<pre>";
    print_r($gabung);
    echo "</pre>";
    */

  
    //Insert ke mutasi aset
    $query="INSERT INTO MutasiAset(Mutasi_ID,Aset_ID,NamaSatkerAwal, NomorRegAwal,NomorRegBaru,SatkerAwal,SatkerTujuan) values('$mutasi_id','$asset_id[$i]','$hsl_nm_satker','$reg','$gabung_nomor_reg_tujuan','$hsl_satker','$satker')";
    $result=  mysql_query($query) or die(mysql_error());

    // Update Aset
    $query3="UPDATE Aset SET LastMutasi_ID='$mutasi_id', LastSatker_ID='$satker',NomorReg='$gabung_nomor_reg_tujuan' WHERE Aset_ID='$asset_id[$i]'";
    $result3=mysql_query($query3) or die(mysql_error());
    
    //Update PenggunaanAset
    $query2="UPDATE PenggunaanAset SET StatusMutasi=1, Mutasi_ID='$mutasi_id' WHERE Aset_ID='$asset_id[$i]'";
    $result2=mysql_query($query2) or die(mysql_error());
    
    //tambahan sedikit
    $query_update_notuse_and_lastpenggunaan_id="UPDATE Aset SET NotUse=0, LastPenggunaan_ID=NULL WHERE Aset_ID='$asset_id[$i]'";
    $result_update_notuse_and_lastpenggunaan_id=mysql_query($query_update_notuse_and_lastpenggunaan_id) or die(mysql_error());
}

//Buat hapus apl-userasetlist
$query_hapus_apl="DELETE FROM apl_userasetlist WHERE aset_action='Mutasi' AND UserSes='$_SESSION[ses_uid]'";
$exec_hapus=  mysql_query($query_hapus_apl) or die(mysql_error());


echo "<script>alert('Data Sudah Terkirim.. !!!'); document.location='$url_rewrite/module/mutasi/transfer_hasil_daftar.php';</script>";



?>
