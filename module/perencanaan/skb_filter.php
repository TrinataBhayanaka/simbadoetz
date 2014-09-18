<?php
include "../../config/config.php";
$USERAUTH = new UserAuth();
$SESSION = new Session();
$menu_id = 4;
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
						Buat Standar Kebutuhan Barang
						</div>
						<div id="bottomright">
							<div id="perencanaan_new">
								<!edit isi content!>

										<!--Form Pencarian -->
										<form name="pencarian" action="<?php echo "$url_rewrite/module/perencanaan/"; ?>skb_daftar_data.php?pid=1" method="post">
										<table>
										<script type="text/javascript" src="../../JS/tabel.js"></script>
											<tr>
													<td>&nbsp;</td>
											</tr>
											<tr>
													<td>Nama/Jenis Barang</td>
													<td>
															<input type="text" name="skb_njb" id="skb_njb" class="w450" value="">
															<input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" value="Pilih" onclick = "showSpoiler(this);">
															<div class="inner" style="display:none;">
																
																<?php
																	$alamat_simpul_kelompok="$url_rewrite/function/dropdown/radio_simpul_kelompok.php";
																	$alamat_search_kelompok="$url_rewrite/function/dropdown/radio_search_kelompok.php";
																	js_radiokelompok($alamat_simpul_kelompok, $alamat_search_kelompok,"skb_njb","kelompok_id",'kelompok','skbkelompokfilter');
																	$style="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
																	radiokelompok($style,"kelompok_id",'kelompok','skbkelompokfilter');	
																?>
															</div>
														</td>
											</tr>
											<tr>
													<td>&nbsp;</td>
											</tr>
											<tr>
													<td>SKPD</td>
													<td>
															<input type="text" name="skb_skpd" id="skb_skpd" class="w450" value="<?php echo $_SESSION['ses_satkername'] ; ?>" disabled>
															<input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" value="Pilih" onclick = "showSpoiler(this);">
															<div class="inner" style="display:none;">
																
																<?php
																	$alamat_simpul_skpd="$url_rewrite/function/dropdown/radio_simpul_skpd.php";
																	$alamat_search_skpd="$url_rewrite/function/dropdown/radio_search_skpd.php";
																	js_radioskpd($alamat_simpul_skpd, $alamat_search_skpd,"skb_skpd","skpd_id",'skpd','skbskpdfilter');
																	$style2="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
																	radiopengadaanskpd($style2,"skpd_id",'skpd','skbskpdfilter');
																?>
															</div>
													</td>
											</tr>
											<tr>
													<td>&nbsp;</td>
											</tr>
											<tr>
													<td>Lokasi</td>
													<td>
														<input type="text" name="skb_lokasi" id="skb_lokasi" class="w450" value="">
														<input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" value="Pilih" onclick = "showSpoiler(this);">
														<div class="inner" style="display:none;">
															
															<?php
																$alamat_simpul_lokasi="$url_rewrite/function/dropdown/radio_simpul_lokasi_pengadaan.php";
																$alamat_search_lokasi="$url_rewrite/function/dropdown/radio_search_lokasi_pengadaan.php";

																js_radiopengadaanlokasi($alamat_simpul_lokasi, $alamat_search_lokasi,"skb_lokasi","lokasi_id",'lokasi','p_provinsi','p_kabupaten','p_kecamatan','p_desa','lok');
																$style1="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
																radiopengadaanlokasi($style1,"lokasi_id",'lokasi',"lok");
															?>
														</div>
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
