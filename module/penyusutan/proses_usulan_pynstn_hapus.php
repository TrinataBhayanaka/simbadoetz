<?php
include "../../config/config.php";

$data = $_GET['id'];
$PENYUSUTAN = new RETRIEVE_PENYUSUTAN;
$InputUsulan=$PENYUSUTAN->DeleteUsulan($data);
$InputUsulan_2=$PENYUSUTAN->DeleteUsulanAset($data);
  echo "<script>
			alert('Data Berhasil Dihapus');
		</script>";	
redirect($url_rewrite.'/module/penyusutan/dftr_usulan_pnystn.php?pid=1');
?>