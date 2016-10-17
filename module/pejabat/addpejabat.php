<?php
include "../../config/config.php";
//update pejabat
$query	  = "INSERT INTO pejabat (NamaJabatan,NIPPejabat,NamaPejabat,GUID,Tahun,Satker_ID) 
			VALUES ('$_POST[NamaJabatan]','$_POST[NIPPejabat]',
					'$_POST[NamaPejabat]','$_POST[GUID]',
					'$_POST[tahun]','$_POST[satker]')";

$exec =  mysql_query($query);
  	echo "<script>
			alert('Data Berhasil Disimpan');
		</script>";
	
	echo "<script>
	window.location = '{$url_rewrite}/module/pejabat/daftar_pejabat.php?tahun={$_POST['tahun']}&satker={$_POST['satker']}'
	</script>";	
?>