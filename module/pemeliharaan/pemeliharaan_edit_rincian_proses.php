<?php
include "../../config/config.php";
// pr($_POST);
//param u/ tabel pemeliharaan_aset
$JenisPemeliharaan = $_POST['JenisPemeliharaan'];
$Harga = explode('.',$_POST['Biaya']);
$Biaya = intval(preg_replace('/[^\d.]/','',$Harga[0]));
$keterangan = $_POST['keterangan'];
$createdDate = $_POST['createdDate'];
$PemeliharaanAset_ID = $_POST['PemeliharaanAset_ID'];

//param url
$urlParam = encode($_POST['urlParam']);
$surlParam = encode($_POST['surlParam']);
$turlParam = encode($_POST['turlParam']);
$skurlParam = encode($_POST['skurlParam']);
// pr(decode($urlParam));
/*echo $urlParam;
echo "<br>";
echo $surlParam;
echo "<br>";
echo $turlParam;
echo "<br>";*/

$urlParamfilter = $_POST['urlParamfilter'];
$query = "UPDATE pemeliharaan_aset SET JenisPemeliharaan = '$JenisPemeliharaan',Biaya = '$Biaya',
                                  keterangan = '".addslashes($keterangan)."',createdDate = '$createdDate' 								  
	      WHERE PemeliharaanAset_ID = '$PemeliharaanAset_ID'";

// pr($query);
// exit;
$exequery = $DBVAR->query($query);			
 echo "<script>
			alert('Data Berhasil Dirubah');
		</script>";	
redirect($url_rewrite.'/module/pemeliharaan/pemeliharaan_detail.php?url='.$urlParam.'&surl='.$surlParam.'&turl='.$turlParam.'&skUrl='.$skurlParam);			
?>