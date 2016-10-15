<?php
include "../../../config/config.php";
// pr($_POST);
$Aset_ID = $_POST['Aset_ID'];
$UraianPemeliharaan = $_POST['uraian'];
$keterangan = $_POST['keterangan'];
$Lokasi = $_POST['lokasi'];
$Harga = explode('.',$_POST['hargaPemeliharaan']);
$HargaSatuan = intval(preg_replace('/[^\d.]/','',$Harga[0]));
$kodeRekening = $_POST['kdRekening'];
$TglPemeliharaan = $_POST['tglPemeliharaan'];
$createdDate = $_POST['createDate'];
$urlParam = $_POST['urlParam'];
$kodeSatker = $_POST['kodeSatker'];
$TipeAset = $_POST['TipeAset'];
$UserNm = $_POST['UserNm'];

$query = "INSERT INTO rencana_pemeliharaan (Aset_ID,UraianPemeliharaan,Lokasi,HargaSatuan,kodeRekening,TglPemeliharaan,createdDate,	keterangan,kodeSatker,TipeAset,UserNm)
			VALUES ('$Aset_ID','".addslashes($UraianPemeliharaan)."','".addslashes($Lokasi)."','$HargaSatuan',
			'$kodeRekening','$TglPemeliharaan','$createdDate','".addslashes($keterangan)."','$kodeSatker','$TipeAset','$UserNm')";
// pr($query);
// exit;
$exequery = $DBVAR->query($query);			
 echo "<script>
			alert('Data Berhasil Disimpan');
		</script>";	
redirect($url_rewrite.'/module/perencanaan/rencana/prcn_pemeliharaan_dftr_aset_rev.php?url='.$urlParam);			
?>