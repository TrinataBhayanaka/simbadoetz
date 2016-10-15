<?php
include "../../../config/config.php"; 

$KEBUTUHAN = new RETRIEVE_KEBUTUHAN;

// pr($_POST);
// exit;
$dataStore = $KEBUTUHAN->store_rencanaKebutuhan($_POST);
echo "<script>alert('Data Sudah Disimpan'); document.location='prcn_pengadaan_tambah.php';</script>";

?>