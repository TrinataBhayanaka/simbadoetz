<?php
include "../../config/config.php";
// pr($_POST);

$kodeSatker = $_POST['kodeSatker'];
$nosp2d = $_POST['nosp2d'];
$tglsp2d = $_POST['tglsp2d'];
$nokontrak = $_POST['nokontrak'];
$tglkontrak = $_POST['tglkontrak'];
$NamaPenyediaJasa = $_POST['namaPenyedia'];
$tglPemeliharaan = $_POST['tglpemeliharaan'];
$KeteranganPemeliharaan = $_POST['keterangan'];
$createdDate = $_POST['createddate'];
$UserNm = $_POST['userNm'];

$urlParam = $_POST['urlParam'];
$getUrl = decode($urlParam);
$id =explode('=',$getUrl);

$urlParamfilter = $_POST['urlParamfilter'];
$query = "UPDATE pemeliharaan SET kodeSatker = '$kodeSatker',nosp2d = '".addslashes($nosp2d)."',tglsp2d = '$tglsp2d',nokontrak = '".addslashes($nokontrak)."',
								  tglkontrak = '$tglkontrak',NamaPenyediaJasa = '".addslashes($NamaPenyediaJasa)."',tglPemeliharaan = '$tglPemeliharaan',
                                  KeteranganPemeliharaan = '".addslashes($KeteranganPemeliharaan)."',createdDate = '$createdDate',UserNm = '$UserNm'  								  
	      WHERE Pemeliharaan_ID = '$id[1]'";

// pr($query);
// exit;
$exequery = $DBVAR->query($query);			
 echo "<script>
			alert('Data Berhasil Dirubah');
		</script>";	
redirect($url_rewrite.'/module/pemeliharaan/pemeliharaan_dftr_sp2d.php?url='.$urlParamfilter);			
?>