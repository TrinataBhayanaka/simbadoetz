<?php
	include "../../config/database.php";  
	open_connection();  
	
	$kelompok=$_GET['kelompok'];
	$spesifikasi=$_GET['spesifikasi'];
	$tahun=$_GET['tahun'];
	
	$query="SELECT NilaiStandar FROM StandarHarga WHERE Kelompok_ID='$kelompok' AND Spesifikasi='$spesifikasi' AND TglUpdate like '$tahun%'";
	//echo $query;
	$result=mysql_query($query)or die(mysql_error());
	
	$hsl	= mysql_fetch_array($result);
	//print_r ($hsl);
	$hrg	= $hsl['NilaiStandar'];
	
	echo "$hrg";
  
  ?>
