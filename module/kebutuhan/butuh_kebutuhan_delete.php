<?php
include "../../../config/config.php"; 

$KEBUTUHAN = new RETRIEVE_KEBUTUHAN;

// pr($_POST);
// exit;
$dataStore = $KEBUTUHAN->delete_rencanaKebutuhan($_GET);
echo "<script>alert('Data Sudah Dihapus'); document.location='prcn_pengadaan_data.php?jenisaset=".$_GET['tipe']."&kodeSatker=".$_GET['satker']."';</script>";

?>