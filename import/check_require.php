<?php
if($kd_brg==""){
$require_brg="style='background-color:#F75D59;border:2px solid #C11B17;'";
}else { $require_brg=""; }
if($tahun_pengadaan==""){
$require_thn="style='background-color:#F75D59;border:2px solid #C11B17;'";
}else { $require_thn=""; }
if($harga==""){
$require_harga="style='background-color:#F75D59;border:2px solid #C11B17;'";
}else { $require_harga=""; }

if($kd_brg=="" || $tahun_pengadaan=="" || $harga==""){
$require="name='' disabled ";
}else{
$require="name='formDoor[]'";
}
?>
