<?php
	include "../../config/database.php";  
	open_connection();  
	
	$id=$_GET['kelompok'];
	$tahun=$_GET['tahun'];
	
	$query="select Spesifikasi from StandarHarga where Kelompok_ID='$id' and TglUpdate like '$tahun%'";
	$result=mysql_query($query)or die(mysql_error()); 	
	echo "<select name='Spesifikasi' onClick=\"get_data_hrg(this,'kelompok_id','rkb_add_hrg','tahun_id')\">";
	echo "<option value=''>--None--</option>";
	while ($row=mysql_fetch_object($result)){
		$spesifikasi=$row->Spesifikasi;
		echo "<option value='$spesifikasi'>$spesifikasi</option>";	
	}
	echo "</select>";
  
  ?>
