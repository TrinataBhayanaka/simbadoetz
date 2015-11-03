<?php
include "../../../config/config.php"; 

$PERENCANAAN = new RETRIEVE_PERENCANAAN;

// pr($_POST);
// exit;
$dataStore = $PERENCANAAN->delete_rencanaPengadaan($_GET);
echo "<script>alert('Data Sudah Dihapus'); document.location='prcn_pengadaan_data.php?jenisaset=".$_GET['tipe']."&kodeSatker=".$_GET['satker']."';</script>";

?>