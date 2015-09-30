<?php
include "../../config/config.php";

$data = $_POST;

$PENYUSUTAN = new RETRIEVE_PENYUSUTAN;
$InputUsulan=$PENYUSUTAN->UpdateUsulan($data);
  echo "<script>
			alert('Data Berhasil Disimpan');
		</script>";	
redirect($url_rewrite.'/module/penyusutan/dftr_usulan_pnystn.php?pid=1');
?>