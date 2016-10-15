<?php
include "../../../config/config.php"; 

$KEBUTUHAN = new RETRIEVE_KEBUTUHAN;

// pr($_POST);
// exit;
$dataStore = $KEBUTUHAN->update_rencanaKebutuhan($_POST);
echo "<script>alert('Data Sudah Disimpan'); document.location='prcn_pengadaan_edit.php?id=".$_POST['IDRENCANA']."&tipe=".$_POST['TipeAset']."';</script>";

?>