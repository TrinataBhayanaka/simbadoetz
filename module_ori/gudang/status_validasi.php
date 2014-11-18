<?php
ob_start();
include "../../config/config.php";

$menu_id = 16;
$SessionUser = $SESSION->get_session_user();
$USERAUTH->FrontEnd_check_akses_menu($menu_id,$SessionUser);

	$gudang = $_POST['validasiGudang'];
	// pr($_POST);
	// exit;
	if(empty($gudang))
	{
	echo "tidak ada data yang dipilih";
	}
	else
	{
	$N = count($gudang);
	for ($i=0; $i < $N; $i++)
	{
	
$dataArr = $UPDATE->update_gudang_validasi($gudang[$i]);
}
}
// header('location:validasi.php');	
?>
<script type="text/javascript" charset="utf-8">
alert('Validasi Data Berhasil');
document.location="<?php echo "$url_rewrite/module/gudang/";?>validasi.php";																		
</script>";

