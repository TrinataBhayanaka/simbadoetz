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
// echo (decode($urlParam)); 
$query = "INSERT INTO pemeliharaan (kodeSatker,nosp2d,tglsp2d,nokontrak,tglkontrak,NamaPenyediaJasa,
									tglPemeliharaan,KeteranganPemeliharaan,createdDate,UserNm)
			VALUES ('$kodeSatker','".addslashes($nosp2d)."','$tglsp2d','".addslashes($nokontrak)."',
			'$tglkontrak','".addslashes($NamaPenyediaJasa)."','$tglPemeliharaan','".addslashes($KeteranganPemeliharaan)."',
			'$createdDate','$UserNm')";
// pr($query);
// exit;
$exequery = $DBVAR->query($query);			
 echo "<script>
			alert('Data Berhasil Disimpan');
		</script>";	
redirect($url_rewrite.'/module/pemeliharaan/pemeliharaan_dftr_sp2d.php?url='.$urlParam);			
?>