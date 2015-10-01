
<?php

mysql_connect('192.168.254.52','remote','margonda100');  
mysql_select_db('simbada_latihan');

if (isset($_POST['submit'])){
	$sql = "INSERT INTO help (skpd, nama, masalah, nourut) VALUES ('{$_POST['skpd']}','{$_POST['nama']}','{$_POST['masalah']}','{$_POST['nourut']}')";
	$res = mysql_query($sql);
	if ($res){
		echo '<script type=text/javascript>alert("Terima Kasih atas partisipasinya untuk SIMBADA");window.location.href="http://simbada.pekalongankota.go.id/latihan";</script>';
	}
}

?>
<form method="post" action="">

	SKPD <input type="text" name="skpd">
	Nama Operator <input type="text" name="nama">
	Permasalahan <input type="text" name="masalah">
	No urut <input type="text" name="nourut">
	<input type="submit" name="submit">
</form>