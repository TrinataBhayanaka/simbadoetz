<?php
include "../../../config/config.php"; 

$PERENCANAAN = new RETRIEVE_PERENCANAAN;

// pr($_POST);
// exit;
$dataStore = $PERENCANAAN->store_rencanaPengadaan($_POST);
echo "<script>alert('Data Sudah Disimpan'); document.location='prcn_pengadaan_tambah.php';</script>";

?>