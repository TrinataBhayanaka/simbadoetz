<?php
include "../../config/config.php";

$LAYANAN = new RETRIEVE_LAYANAN;

?>

<?php
	include"$path/meta.php";
	include"$path/header.php";
	include"$path/menu.php";
	
	$data = $LAYANAN->remove_data_aset($_POST);	
	if ($data){
		?>
		<script>
		alert('Aset sudah dihapus');
		document.location="<?php echo "$url_rewrite/module/layanan/"; ?>lihat_aset_daftar.php";
        
        </script>
		<?php
	}
	// pr($data);
?>
	