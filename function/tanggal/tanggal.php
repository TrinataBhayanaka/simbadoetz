<?php
//Array Hari

$array_hari = array(1=>'Senin','Selasa','Rabu','Kamis','Jumat', 'Sabtu','Minggu');

$hari = $array_hari[date('N')];

//Format Tanggal

$f_tanggal = date ('j');

//Array Bulan

$array_bulan = array(1=>'Januari','Februari','Maret', 'April', 'Mei', 'Juni','Juli','Agustus','September','Oktober', 'November','Desember');

$f_bulan = $array_bulan[date('n')];

//Format Tahun

$f_tahun = date('Y');

//Menampilkan hari dan tanggal

//echo $tanggal . "&nbsp;". $bulan . "&nbsp;". $tahun;

?>
