<?php
include "../../config/config.php";

include "../../api_list/rollback_helper.php";

$ROLLBACK = new ROLLBACK;
$LAYANAN = new RETRIEVE_LAYANAN;

?>

<?php
	include"$path/meta.php";
	include"$path/header.php";
	include"$path/menu.php";
	
	$data = $ROLLBACK->gotoRollbackData($_GET);	

	// vd($data);
	if ($data){

		?>
		<script>
		alert('Proses Berhasil');
		// document.location='<?php echo "$url_rewrite/module/layanan/detail_aset.php?id={$_GET['idaset']}&jenisaset={$_GET['jenisaset']}"; ?>';
        window.history.back();
        </script>
		<?php
		
	}
	// pr($data);
?>
	
