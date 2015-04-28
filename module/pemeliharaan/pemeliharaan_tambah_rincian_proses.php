<?php
include "../../config/config.php";
// pr($_POST);
$Pemeliharaan_ID = $_POST['Pemeliharaan_ID'];
$Aset_ID = $_POST['Aset_ID'];
$JenisPemeliharaan = $_POST['JenisPemeliharaan'];
$Harga = explode('.',$_POST['Biaya']);
$Biaya = intval(preg_replace('/[^\d.]/','',$Harga[0]));
$keterangan = $_POST['keterangan'];
$createdDate = $_POST['createdDate'];
$urlParam = $_POST['urlParam'];
$pmlhrnID = encode($Pemeliharaan_ID);
$sk = encode($_POST['satker']);
// pr(decode($sk));
// pr($pmlhrnID);
$query = "INSERT INTO pemeliharaan_aset (Pemeliharaan_ID,Aset_ID,JenisPemeliharaan,Biaya,keterangan,
									createdDate)
			VALUES ('$Pemeliharaan_ID','$Aset_ID','$JenisPemeliharaan',
			'$Biaya','".addslashes($keterangan)."',
			'$createdDate')";
// pr($query);
// echo $url_rewrite.'/module/pemeliharaan/pemeliharaan_dftr_rincian.php?id=.'$pmlhrnID'.&url='.$urlParam;
// exit;
$exequery = $DBVAR->query($query);			
 echo "<script>
			alert('Data Berhasil Disimpan');
		</script>";	
redirect($url_rewrite.'/module/pemeliharaan/pemeliharaan_dftr_rincian.php?id='.$pmlhrnID."&sk=".$sk."&url=".$urlParam);			
?>