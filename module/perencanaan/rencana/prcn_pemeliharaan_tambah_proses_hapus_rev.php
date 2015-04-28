<?php
include "../../../config/config.php";
// pr($_POST);
$getUrl = decode($_GET['url']);
$id =explode('=',$getUrl);
// pr($getUrl);
$urlParam = $_GET['surl'];
// exit;
$query = "DELETE FROM `rencana_pemeliharaan` WHERE RencanaPemeliharaan_ID = $id[1]";
// pr($query);
// exit;
$exequery = $DBVAR->query($query);			
 echo "<script>
			alert('Data Berhasil Dihapus');
		</script>";	
redirect($url_rewrite.'/module/perencanaan/rencana/prcn_pemeliharaan_dftr_aset_pmlhrn_rev.php?url='.$urlParam);			
?>