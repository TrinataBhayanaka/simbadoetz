<?php
include "../../../config/config.php";
// pr($_POST);
$pmlrnID = $_POST['pmlrnID'];
$UraianPemeliharaan = $_POST['uraian'];
$keterangan = $_POST['keterangan'];
$Lokasi = $_POST['lokasi'];
$Harga = explode('.',$_POST['hargaPemeliharaan']);
$HargaSatuan = intval(preg_replace('/[^\d.]/','',$Harga[0]));
$kodeRekening = $_POST['kdRekening'];
$TglPemeliharaan = $_POST['tglPemeliharaan'];
$createdDate = $_POST['createDate'];
$UserNm = $_POST['UserNm'];
$urlParam = $_POST['urlParam'];

$query = "UPDATE rencana_pemeliharaan SET 
		  UraianPemeliharaan = '".addslashes($UraianPemeliharaan)."', keterangan = '".addslashes($keterangan)."',
		  TglPemeliharaan = '$TglPemeliharaan', Lokasi = '$Lokasi', HargaSatuan = '$HargaSatuan', 
		  kodeRekening ='$kodeRekening',createdDate = '$createdDate',UserNm = '$UserNm' WHERE RencanaPemeliharaan_ID = '$pmlrnID'";

// pr($query);
// exit;
$exequery = $DBVAR->query($query);			
 echo "<script>
			alert('Data Berhasil Dirubah');
		</script>";	
redirect($url_rewrite.'/module/perencanaan/rencana/prcn_pemeliharaan_dftr_aset_pmlhrn_rev.php?url='.$urlParam);			
?>