<?php
include "../../config/config.php"; 

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$id=$_POST['Mutasi_ID'];
$satker=$_POST['skpd_id'];
$nodok=$_POST['mutasi_trans_eks_nodok'];
$tgl=$_POST['mutasi_trans_eks_tglproses'];
$olah_tgl=  format_tanggal_db2($tgl);
$alasan=$_POST['mutasi_trans_eks_alasan'];
$pemakai=$_POST['mutasi_trans_eks_pemakai'];
$nmaset=$_POST['mutasi_aset'];
$UserNm=$_SESSION['ses_uname'];// usernm akan diganti jika session di implementasikan

$asset_id=Array();
$no_reg=Array();
$nm_barang=Array();

$panjang=count($nmaset);
// echo "panjang".$panjang;
// pr($_POST);
// exit;

// $UserNm="admin";// usernm akan diganti jika session di implementasikan


 $query="UPDATE Mutasi SET NoSKKDH='$nodok', TglSKKDH='$olah_tgl', Keterangan='$alasan', SatkerTujuan='$satker', 
		Pemakai ='$pemakai' WHERE Mutasi_ID='$id'";
// pr($query);
 $result=  mysql_query($query) or die(mysql_error());
 
//dapetin kode satker dan kode unit
 $query_satker_id="SELECT * FROM Satker WHERE Satker_ID='$satker'";
 // pr($query_satker_id);
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
    
	// echo "asetID =".$asset_id[$i];
    
        //Tampilkan LastSatker_ID
        $query_prev_satker="SELECT LastSatker_ID
                                            FROM Aset WHERE Aset_ID=$asset_id[$i]";
        pr( $query_prev_satker);
		$exec_prev_satker=mysql_query($query_prev_satker) or die(mysql_error());
        $row_prev_satker=mysql_fetch_array($exec_prev_satker);
        $hsl_satker=$row_prev_satker['LastSatker_ID'];
        
        //Tampilkan Nama Satker
        $query_nm_satker_awal="SELECT NamaSatker FROM Satker WHERE Satker_ID='$hsl_satker'";
		pr($query_nm_satker_awal);
        $exec_query_nm_satker_awal=mysql_query($query_nm_satker_awal) or die(mysql_error());
        $row_query_nm_satker_awal=mysql_fetch_array($exec_query_nm_satker_awal);
        $hsl_nm_satker=$row_query_nm_satker_awal['NamaSatker'];
        
        //Tampilkan nomor registrasi untuk awal
    $query5="select * from Aset where Aset_ID='$asset_id[$i]'";
	// pr($query5);
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
    // $query="INSERT INTO MutasiAset(Mutasi_ID,Aset_ID,NamaSatkerAwal, NomorRegAwal,NomorRegBaru,SatkerAwal,SatkerTujuan) values('$mutasi_id','$asset_id[$i]','$hsl_nm_satker','$reg','$gabung_nomor_reg_tujuan','$hsl_satker','$satker')";
	$query="UPDATE MutasiAset SET Aset_ID = '$asset_id[$i]',NamaSatkerAwal ='$hsl_nm_satker',NomorRegAwal = '$reg',NomorRegBaru = '$gabung_nomor_reg_tujuan',SatkerAwal= '$hsl_satker',SatkerTujuan = '$satker' 
		     WHERE Mutasi_ID = '$id' AND Aset_ID = '$asset_id[$i]'";
	// pr($query);
	$result=  mysql_query($query) or die(mysql_error());

    // Update Aset
    // $query3="UPDATE Aset SET LastMutasi_ID='$mutasi_id', LastSatker_ID='$satker',NomorReg='$gabung_nomor_reg_tujuan' WHERE Aset_ID='$asset_id[$i]'";
    $query3="UPDATE Aset SET LastMutasi_ID='$id', LastSatker_ID='$satker',NomorReg='$gabung_nomor_reg_tujuan' WHERE Aset_ID='$asset_id[$i]'";
	// pr($query3);
   $result3=mysql_query($query3) or die(mysql_error());
    
    //Update PenggunaanAset
    $query2="UPDATE PenggunaanAset SET StatusMutasi=1, Mutasi_ID='$id' WHERE Aset_ID='$asset_id[$i]'";
    // pr($query2);
	$result2=mysql_query($query2) or die(mysql_error());
    
    //tambahan sedikit
    $query_update_notuse_and_lastpenggunaan_id="UPDATE Aset SET NotUse=0, LastPenggunaan_ID=NULL WHERE Aset_ID='$asset_id[$i]'";
    // pr($query_update_notuse_and_lastpenggunaan_id);
	$result_update_notuse_and_lastpenggunaan_id=mysql_query($query_update_notuse_and_lastpenggunaan_id) or die(mysql_error());
}
// exit;
 /*
 $pecah=explode('.',$satker);
 $sektor=$pecah[0];
 $satker=$pecah[1];
 $unit=$pecah[2];
 
  * 
  */
 /*
 echo "$sektor".'<br>';
 echo "$satker".'<br>';
 echo "$unit";
  */
 /*
 $gabung=array($sektor, $satker);
 $exe=implode('.', $gabung);
 
  * 
  */
 /*
$query7="SELECT * FROM Satker WHERE KodeSatker = '$exe' AND KodeUnit = '$unit'";
$result7=  mysql_query($query7) or die(mysql_error());
$row2 =  mysql_fetch_array($result7);
$Satker_ID=$row2['Satker_ID'];
*/

/*
$nmaset=$_POST['mutasi_nama_aset'];
$asset_id=Array();
$no_reg=Array();
$nm_barang=Array();

$panjang=count($nmaset);
 
*/
/*
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
*/
    
    // $query3="UPDATE Aset SET LastSatker_ID='$satker' WHERE LastMutasi_ID='$id'";
    // $result3=mysql_query($query3) or die(mysql_error());
    

    
// }

// exit;

echo "<script>alert('Data Berhasil Disimpan'); document.location='transfer_hasil_daftar.php';</script>";
?>
