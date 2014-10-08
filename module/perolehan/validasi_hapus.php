<?php
include "../../config/config.php";

$USERAUTH = new UserAuth();

$SESSION = new Session();

$menu_id = 11;
$SessionUser = $SESSION->get_session_user();
$USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);

?>



<?php


$id=$_GET['id'];

$query="update Aset SET StatusValidasi=0 WHERE Aset_ID=$id";
$exec=mysql_query($query) or die(mysql_error());

echo "<script>alert('Data Sudah Terhapus...!!!'); document.location='daftar_validasi_barang.php';</script>";
?>

