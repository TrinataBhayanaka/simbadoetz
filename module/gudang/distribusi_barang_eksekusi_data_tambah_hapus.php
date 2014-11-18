<?php
include "../../config/config.php";

$trsid=$_GET['id'];

$dataArr = $DELETE->delete_distribusi_barang($trsid);


echo "<script>alert('Data Berhasil Dihapus'); document.location='distribusi_barang_daftar.php';</script>";



?>
