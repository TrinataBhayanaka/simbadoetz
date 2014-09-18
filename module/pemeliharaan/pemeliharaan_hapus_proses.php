<?php

include "../../config/config.php";
open_connection();

if(isset($_GET['idubah']))
{
	$idubah = $_GET['idubah'];	
	$id		= $_GET['id'];	
}
// pr($_GET);
// echo "masuk hapus";
// exit;
$query_hapus1	= "	DELETE FROM Kondisi
					Where 
					Pemeliharaan_ID='$idubah'";
$result_hapus1	= mysql_query($query_hapus1) or die (mysql_error());

if($result_hapus1){
	$query_hapus2	= "	DELETE FROM NilaiAset
					Where 
					Pemeliharaan_ID='$idubah'";
	$result_hapus2	= mysql_query($query_hapus2) or die (mysql_error());
	
	if($result_hapus2){
		$query_hapus3	= "	DELETE FROM Pemeliharaan
							Where 
							Pemeliharaan_ID='$idubah'";
		$result_hapus3	= mysql_query($query_hapus3) or die (mysql_error());
		
		if($result_hapus3){
			$query 	= "SELECT p.Aset_ID FROM Pemeliharaan p, NilaiAset n, Kondisi k WHERE p.Aset_ID=".$id." AND n.Aset_ID=".$id." AND k.Aset_ID=".$id;
			$result	= mysql_query($query);

			$rows	= mysql_num_rows($result);
			if($rows==0){
				$query_update	= "UPDATE Aset Set Status_Pemeliharaan=0 WHERE Aset_ID=".$id;
				$result			= mysql_query($query_update) or die(mysql_error());
			}
			echo "<script type=text/javascript>alert(\"Data Berhasil Dihapus\");window.location.href=\"$url_rewrite/module/pemeliharaan/pemeliharaan_view_detail.php?id=$id&pid=1\";</script>";
		}
	}
}
			
?>