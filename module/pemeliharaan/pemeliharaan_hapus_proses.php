<?php
include "../../config/config.php";
// pr($_POST);
$urlParam = $_GET['url'];
$getUrl = decode($urlParam);
$exp = explode('&',$getUrl);
$id =explode('=',$exp[0]);
$urlParamfilter = $_GET['surl'];
// pr(decode($urlParamfilter));
//cek data Pemeliharaan_ID di tabel pemeliharaan_aset (depend)
$ceck = "SELECT COUNT(Pemeliharaan_ID) as count from pemeliharaan_aset where Pemeliharaan_ID = '$id[1]'";
// pr($ceck);
$exequery = $DBVAR->query($ceck);	
$num = mysql_fetch_object($exequery);		
$count = $num->count; 
if($count != 0){
// echo "data sedang digunakan";
echo "<script>
			alert('Data Sedang Digunakan');
		</script>";	
redirect($url_rewrite.'/module/pemeliharaan/pemeliharaan_dftr_sp2d.php?url='.$urlParamfilter);	
}else{
// echo "data tidak sedang digunakan";
$query = "DELETE FROM pemeliharaan WHERE Pemeliharaan_ID = '$id[1]'";
$exequery = $DBVAR->query($query);			

echo "<script>
			alert('Data Berhasil Dihapus');
		</script>";	
redirect($url_rewrite.'/module/pemeliharaan/pemeliharaan_dftr_sp2d.php?url='.$urlParamfilter);		
}	
?>