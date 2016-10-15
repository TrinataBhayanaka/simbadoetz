<?php
include "../../config/config.php";
//update pejabat
$query	  = "UPDATE pejabat SET 
				NamaJabatan 	= '$_POST[NamaJabatan]',
				NIPPejabat 		= '$_POST[NIPPejabat]',
				NamaPejabat 	= '$_POST[NamaPejabat]',
				GUID 			= '$_POST[GUID]'
			WHERE Pejabat_ID 	= '$_POST[Pejabat_ID]'";

$exec =  mysql_query($query);
  	echo "<script>
			alert('Data Berhasil Dirubah');
		</script>";
	
	echo "<script>
	window.location = '{$url_rewrite}/module/pejabat/daftar_pejabat.php?tahun={$_POST['tahun']}&satker={$_POST['satker']}'
	</script>";	
?>