<?php
include "../../../config/config.php"; 

$PERENCANAAN = new RETRIEVE_PERENCANAAN;

// pr($_POST);
// exit;
$dataStore = $PERENCANAAN->update_rencanaPengadaan($_POST);
echo "<script>alert('Data Sudah Disimpan'); document.location='prcn_pengadaan_edit.php?id=".$_POST['IDRENCANA']."&tipe=".$_POST['TipeAset']."';</script>";

?>