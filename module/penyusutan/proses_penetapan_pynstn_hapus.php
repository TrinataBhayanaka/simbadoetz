<?php
include "../../config/config.php";

$data = $_GET['id'];
$PENYUSUTAN = new RETRIEVE_PENYUSUTAN;
$InputUsulan=$PENYUSUTAN->DeletePenetapan($data);
$InputUsulan_2=$PENYUSUTAN->DeletePenetapanAset($data);
  echo "<script>
			alert('Data Berhasil Dihapus');
		</script>";	
redirect($url_rewrite.'/module/penyusutan/dftr_penetapan_pnystn.php?pid=1');
?>