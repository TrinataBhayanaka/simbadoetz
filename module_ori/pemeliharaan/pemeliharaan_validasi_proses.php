<?php

include "../../config/config.php";
open_connection();

$id_pem	= $_GET['id_pem'];
$id		= $_GET['id'];

// print_r($_GET);
// exit;
$query_validasi_pemeliharaan = "UPDATE Pemeliharaan 
								SET Status_Validasi_Pemeliharaan=1 
								WHERE
								Pemeliharaan_ID=".$id_pem;
								
//print_r($query_validasi_pemeliharaan);
$result	= mysql_query($query_validasi_pemeliharaan) or die (mysql_error());
if($result)
	{
	echo "<script type=text/javascript>alert(\"Data Berhasil Divalidasi\");window.location.href=\"$url_rewrite/module/pemeliharaan/pemeliharaan_validasi_pemeliharaan.php?id=$id\";</script>";
	}								

?>