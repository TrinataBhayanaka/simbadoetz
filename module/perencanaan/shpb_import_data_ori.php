<?php
include "../../config/config.php";
?>

<html>
	<?php
	include "$path/header.php";
	?>
	
	<body>
		<div id="content">
		<?php
		include "$path/title.php";
		include "$path/menu.php";
		?>
		
			<div id="tengah1">	
				<div id="frame_tengah1">
					<div id="frame_gudang">
						
						<div id="topright">
							Buat Standar Harga Pemeliharaan
						</div>
						
						<div id="bottomright">
							<p>
							<br>
							<a href="<?php echo "$url_rewrite/module/perencanaan/"; ?>shpb_daftar_data.php">
							<input type="button" value="Kembali ke Halaman Sebelumnya" >
							</a>
							<div id="upload">		
								<?php include "../../function/import/module/standar_harga_pemeliharaan/index.php"; ?>	
								</fieldset>
							</div>                                                                                              								
						</div>
					</div>
				</div>
			</div>
		</div>
		
	<?php 
    include "$path/footer.php";
    ?>	
	</body>
</html>	

