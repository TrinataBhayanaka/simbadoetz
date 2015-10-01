
<?php

mysql_connect('192.168.254.52','remote','margonda100');  
mysql_select_db('simbada_latihan');

$sql = "INSERT INTO help (skpd, nama, masalah) VALUES ('{$_POST['skpd']}','{$_POST['nama']}','{$_POST['masalah']}')";
$res = mysql_query($sql);
if ($res){
	echo '<script type=text/javascript>alert("Terima Kasih atas partisipasinya untuk SIMBADA");window.location.href="http://simbada.pekalongankota.go.id/latihan";</script>';
}
?>
<form method="post" action="">

	SKPD <input type="text" name="skpd">
	Nama Operator <input type="text" name="nama">
	Permasalahan <input type="text" name="masalah">
	<input type="submit" name="submit">
</form>