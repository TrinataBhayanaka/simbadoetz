<?php
include "../../config/config.php";


$id=$_GET['id'];
list($aset,$gudang_id)=explode ('|', $id);
// exit;
$dataArr = $DELETE->delete_gudang_pemeriksaan($aset,$gudang_id);

echo "<script>alert('Data Berhasil Dihapus'); document.location='gudang_pemeriksaan_baru.php?id=$aset&pid=1';</script>";
?>