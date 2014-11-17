<?php
include "../../config/config.php";
$USERAUTH = new UserAuth();
$SESSION = new Session();
$menu_id = 3;
$SessionUser = $SESSION->get_session_user();
$USERAUTH->FrontEnd_check_akses_menu($menu_id,$SessionUser);
?>

<html>
	<?php
	include "$path/header.php";
	?>
    <script type="text/javascript" src="<?php echo "$url_rewrite";?>/JS/ajax_checkbox.js"></script>
	<script type="text/javascript" src="<?php echo "$url_rewrite";?>/JS/jquery.min.js"></script>    
	
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
						Buat Standar Harga Pemeliharaan Barang
						</div>
						<div id="bottomright">
							<div id="perencanaan_new">
								<!--edit isi content-->


										<!--Form Pencarian -->
										<form name="pencarian" method="post" action="<?php echo "$url_rewrite/module/perencanaan/"; ?>shpb_daftar_data.php?pid=1">
											<table>
											<script type="text/javascript" src="../../JS/tabel.js"></script>
												<tr>
													<td>&nbsp;</td>
												</tr>
												<tr>
														<td>Tahun</td>
														<td>
															<input type="integer" name="shb_thn" size="4" value="">
														</td>
												</tr>
												<tr>
														<td>&nbsp;</td>
												</tr>
												<tr>
														<td>Nama/Jenis Barang</td>
														<td>
															<input type="text" name="shpb_njb" id="shpb_njb" class="w450" value="">
															<input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" value="Pilih" onclick = "showSpoiler(this);">
															<div class="inner" style="display:none;">
														
																<?php
																	$alamat_simpul_kelompok="$url_rewrite/function/dropdown/radio_simpul_kelompok.php";
																	$alamat_search_kelompok="$url_rewrite/function/dropdown/radio_search_kelompok.php";
																	js_radiokelompok($alamat_simpul_kelompok, $alamat_search_kelompok,"shpb_njb","kelompok_id",'kelompok','shpbkelompokfilter');
																	$style="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
																	radiokelompok($style,"kelompok_id",'kelompok','shpbkelompokfilter');															
																?>
															</div>
														</td>
												</tr>
												<tr>
														<td>&nbsp;</td>
												</tr>
												<tr>
														<td>Keterangan</td>
														<td>
															<input type="text" name="shb_ket" size="51" value="">
														</td>
												</tr>
												<tr>
														<td>&nbsp;</td>
												</tr>
												<tr>
														<td></td>
														<td>
															  <input type="submit" name="submit" value="Tampilkan Data" />
															  <input type="reset" name="reset" value="Bersihkan Data">
														</td>
												</tr>
											</table>
										</form>
										<!-- Akhir Form Pencarian -->
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
