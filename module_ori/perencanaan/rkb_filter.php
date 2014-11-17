<?php
include "../../config/config.php";

$USERAUTH = new UserAuth();
$SESSION = new Session();
$menu_id = 5;
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
							Buat Rencana Kebutuhan Barang
						</div>
						
						<div id="bottomright">
							<div id="perencanaan_new">
								<!--Form Pencarian -->
								<form name="pencarian" action="<?php echo "$url_rewrite/module/perencanaan/"; ?>rkb_daftar_data.php?pid=1" method="post">
									<table>
									<script type="text/javascript" src="../../JS/tabel.js"></script>
										<tr>
											<td>&nbsp;</td>
										</tr>
										<tr>
											<td>Tahun</td>
											<td>
												<input type="text" size="4" name="rkb_thn" value="">
											</td>
										</tr>
										<tr>
											<td>&nbsp;</td>
										</tr>
										<tr>
											<td>SKPD</td>
											<td>
													<input type="text" name="rkb_skpd" id="rkb_skpd" class="w450" readonly="readonly" value="<?php echo $_SESSION['ses_satkername'] ; ?>">
													<input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" value="Pilih" onclick = "showSpoiler(this);">
													<div class="inner" style="display:none;">
														
														<?php
															$alamat_simpul_skpd="$url_rewrite/function/dropdown/radio_simpul_skpd.php";
															$alamat_search_skpd="$url_rewrite/function/dropdown/radio_search_skpd.php";
															js_radioskpd($alamat_simpul_skpd, $alamat_search_skpd,"rkb_skpd","skpd_id",'skpd','rkbskpdfilter');
															$style2="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
															radiopengadaanskpd($style2,"skpd_id",'skpd','rkbskpdfilter');
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
												<input type="text" name="rkb_lokasi" id="rkb_lokasi" class="w450" readonly="readonly" value="">
												<input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" value="Pilih" onclick = "showSpoiler(this);">
												<div class="inner" style="display:none;">
													
													<?php
														$alamat_simpul_lokasi="$url_rewrite/function/dropdown/radio_simpul_lokasi_pengadaan.php";
														$alamat_search_lokasi="$url_rewrite/function/dropdown/radio_search_lokasi_pengadaan.php";

														js_radiopengadaanlokasi($alamat_simpul_lokasi, $alamat_search_lokasi,"rkb_lokasi","lokasi_id",'lokasi','p_provinsi','p_kabupaten','p_kecamatan','p_desa','lok');
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
											<td>Nama/Jenis Barang</td>
											<td>
													<input type="text" name="rkb_njb" id="rkb_njb" class="w450" readonly="readonly" value="">
													<input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" value="Pilih" onclick = "showSpoiler(this);">
													<div class="inner" style="display:none;">
														
														<?php
															$alamat_simpul_kelompok="$url_rewrite/function/dropdown/radio_simpul_kelompok.php";
															$alamat_search_kelompok="$url_rewrite/function/dropdown/radio_search_kelompok.php";
															js_radiokelompok($alamat_simpul_kelompok, $alamat_search_kelompok,"rkb_njb","kelompok_id",'kelompok','rkbkelompokfilter');
															$style="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
															radiokelompok($style,"kelompok_id",'kelompok','rkbkelompokfilter');
															
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
									<table border=0 cellspacing="6" style="display: none">
                                                <tr>
                                                    <td>Desa</td>
                                                    <td>Kecamatan</td> 
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <input type="text" id="p_desa" name="p_desa" value="" size="45"  readonly="readonly">
                                                    </td>
                                                    <td>
                                                        <input type="text" id="p_kecamatan" name="p_kecamatan" value="" size="45" readonly="readonly" >
                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td>Kabupaten</td>
                                                    <td>Provinsi</td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <input type="text" id="p_kabupaten" name="p_kabupaten" value=""size="45" readonly="readonly" >
                                                    </td>
                                                    <td>
                                                        <input type="text" id="p_provinsi" name="p_provinsi" value=""size="45" readonly="readonly" >
                                                    </td>
                                                    <td></td>
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
