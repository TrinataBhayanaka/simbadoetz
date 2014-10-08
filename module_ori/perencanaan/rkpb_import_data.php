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
							Buat Rencana Kebutuhan Pemeliharaan Barang
						</div>
							
						<div id="bottomright">
							<p>
							<br>
							<a href="<?php echo"$url_rewrite/module/perencanaan/rkpb_daftar_data.php";?>">
								<input type="button" value="Kembali ke Halaman Sebelumnya" >
							</a>
                            
							<div id="upload">		
								<fieldset>
									<?php include "../../function/import/module/rkpb/index.php"; ?>	
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

