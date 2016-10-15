<?php
include "../../../config/config.php"; 

$KEBUTUHAN = new RETRIEVE_KEBUTUHAN;

// pr($_POST);
// exit;
$dataStore = $KEBUTUHAN->store_rencanaPemeliharaan($_POST);
echo "<script>alert('Data Sudah Disimpan'); document.location='prcn_pemeliharaan_buat_filter.php';</script>";

?>