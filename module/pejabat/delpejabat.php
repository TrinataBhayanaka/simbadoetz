<?php
include "../../config/config.php";
$id = $_GET['id'];
$tahun = $_GET['tahun'];
$satker = $_GET['satker'];

//delete pejabat
$query ="delete from pejabat where Pejabat_ID = '$id'"; 
$exec =  mysql_query($query);
  	echo "<script>
			alert('Data Berhasil Dihapus');
		</script>";
	
	echo "<script>
	window.location = '{$url_rewrite}/module/pejabat/daftar_pejabat.php?tahun={$tahun}&satker={$satker}'
	</script>";		
?>