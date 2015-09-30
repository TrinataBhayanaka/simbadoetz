<?php
include "../../config/config.php";
// pr($_POST);

//get PemeliharaanAset_ID by url
$getUrl = decode($_GET['url']);
// pr($getUrl);
$getID=explode('=',$getUrl);
$PemeliharaanAset_ID =$getID[1];
// echo "PemeliharaanAset_ID =".$PemeliharaanAset_ID;

//get param filter ID by turl
$getUrlParamFilter = $_GET['turl'];
// $getUrlParamFilter = decode($_GET['turl']);
// $urlParam = $_GET['url'];

//get Aset_ID & Pemeliharaan_ID by surl
$getUrlPmlrn = decode($_GET['surl']);
// pr($getUrlPmlrn);
$tempUrl=explode('&',$getUrlPmlrn);
$getID=explode('=',$tempUrl[0]);
$getTipe=explode('=',$tempUrl[1]);
$Aset_ID =$getID[1];
// echo "Aset_ID =".$Aset_ID;
$Pemeliharaan_ID = encode($getTipe[1]);

$sakter = $_GET['skUrl'];
$query = "DELETE FROM pemeliharaan_aset WHERE PemeliharaanAset_ID = '$PemeliharaanAset_ID'";
// pr($query);
// exit;
$exequery = $DBVAR->query($query);			

echo "<script>
			alert('Data Berhasil Dihapus');
		</script>";	

redirect($url_rewrite.'/module/pemeliharaan/pemeliharaan_dftr_rincian.php?id='.$Pemeliharaan_ID."&sk=".$sakter."&url=".$getUrlParamFilter);			
?>