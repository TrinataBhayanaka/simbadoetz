<?php
include "../../config/config.php";
$menu_id = 5;
$SessionUser = $SESSION->get_session_user();
$USERAUTH->FrontEnd_check_akses_menu($menu_id,$SessionUser);

if (isset($_POST['submit']))
{
	$get_data_filter = $STORE->store_rkb_data(array('param'=>$_POST, 'menuID'=>$menu_id, 'type'=>'', 'paging'=>''));
}
?>

<html>
	<?php
        include "$path/header.php";
    ?>
	
	<!-- Script Tangggal -->
		<script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/jquery.min.js"></script>
		<script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/jquery-ui.min.js"></script> 
		<script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/jquery.ui.datepicker-id.js"></script>
	
		<link href="<?php echo "$url_rewrite/"; ?>css/jquery-ui.css" type="text/css" rel="stylesheet">
        <!-- Script Tangggal -->
	
	<script type="text/javascript" src="<?php echo "$url_rewrite";?>/JS/ajax_radio.js"></script>
	<script type="text/javascript" src="<?php echo "$url_rewrite";?>/JS/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo "$url_rewrite";?>/JS/tabel.js"></script>
	
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
                            <div>
								<table border=0 width=100%>
									<tr>		
										<td width=50%></td>
										<td width=25% align="right">
											<a href="<?php echo"$url_rewrite/module/perencanaan/rkb_daftar_data.php";?>">
											<input type="button" value="Kembali ke Halaman Sebelumnya" >
										</td>
									</tr>
								</table>
                            </div>
							
							<div id="perencanaan_new">
								<!-- Form Tambah Data -->
								
								<form name="tambahdata" action="" method="post">
									<table width="100%" class="style1">
										<tr bgcolor="#004933">
											<td class="white" colspan="2" align=left>
												Tambah Data Baru
											</td>
										</tr>
										<tr>
											<td width="25%" class="style6">Tahun</td>
											<td>
												<input class="w50" id="tahun_id" name="rkb_add_thn" type="text" value="" required="required" />
											</td>
										</tr>
										<tr>
											<td width="25%" class="style6">SKPD</td>
											<td>
												<input class="w300" name="rkb_add_skpd" id="rkb_add_skpd" type="text" value="<?php echo $_SESSION['ses_satkername'] ; ?>" required="required" readonly="readonly" />
												<input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" value="Pilih" onclick = "showSpoiler(this);">
												<div class="inner" style="display:none;">
													
													<?php
														$alamat_simpul_skpd="$url_rewrite/function/dropdown/radio_simpul_skpd.php";
														$alamat_search_skpd="$url_rewrite/function/dropdown/radio_search_skpd.php";
														js_radioskpd($alamat_simpul_skpd, $alamat_search_skpd,"rkb_add_skpd","skpd_id",'skpd','rkbskpdadd');
														$style2="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
														radioskpd($style2,"skpd_id",'skpd','rkbskpdadd');
													?>
												</div>
											</td>
										</tr>
										<tr>
											<td width="25%" class="style6">Lokasi</td>
											<td>
												<input class="w300" name="rkb_add_lokasi" id="rkb_add_lokasi" type="text" value="" required="required"  readonly="readonly" />
												<input type="button" name="idbtnlookuplokasi" id="idbtnlookuplokasi" value="Pilih" onclick = "showSpoiler(this);">
												<div class="inner" style="display:none;">
													
													<?php
														$alamat_simpul_lokasi="$url_rewrite/function/dropdown/radio_simpul_lokasi_pengadaan.php";
														$alamat_search_lokasi="$url_rewrite/function/dropdown/radio_search_lokasi_pengadaan.php";

														js_radiopengadaanlokasi($alamat_simpul_lokasi, $alamat_search_lokasi,"rkb_add_lokasi","lokasi_id",'lokasi','p_provinsi','p_kabupaten','p_kecamatan','p_desa','lok');
														$style1="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
														radiopengadaanlokasi($style1,"lokasi_id",'lokasi',"lok");
														
													?>
												</div>
											</td>
										</tr>
										<tr>
											<td width="25%" class="style6">Nama/Jenis Barang</td>
											<td>
												<input class="w300" name="rkb_add_njb" id="rkb_add_njb" type="text" value="" required="required" readonly="readonly" />
												<input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" value="Pilih" onclick = "showSpoiler(this);">
												<div class="inner" style="display:none;">
													
													<?php
														$alamat_simpul_kelompok="$url_rewrite/function/dropdown/radio_simpul_kelompok.php";
														$alamat_search_kelompok="$url_rewrite/function/dropdown/radio_search_kelompok.php";
														js_radiokelompok($alamat_simpul_kelompok, $alamat_search_kelompok,"rkb_add_njb","kelompok_id",'kelompok','rkbkelompokadd');
														$style="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
														radiokelompok($style,"kelompok_id",'kelompok','rkbkelompokadd');
													?>
												</div>
											</td>
										</tr>
										<script>
											function get_data_spesifikasi(kelompok,tahun,data){
											var nilai_kelompok=document.getElementById(kelompok).value;
											var tahun=document.getElementById(tahun).value;
											url="<?php echo $url_rewrite?>/module/perencanaan/api_merek.php?kelompok="+nilai_kelompok+"&tahun="+tahun;
											//alert(url);
											ambilData(url,data);
											
											}
										</script>
										<tr>
											<td width="25%" class="style6">Spesifikasi</td>
											<td>
												<input name="button" name="Show Spesifikasi" type="button" value="Show Spesifikasi" onclick="get_data_spesifikasi('kelompok_id','tahun_id','isi_spesifikasi');" />
												<div id='isi_spesifikasi'></div>
											</td>
										</tr>
										<tr>
										<script>
											function get_data_skb(skpd,lokasi,kelompok,here,data,tahun){
											var tahun = document.getElementById(tahun).value;
											var nilai_skpd=document.getElementById(skpd).value;
											var nilai_lokasi=document.getElementById(lokasi).value;
											var nilai_kelompok=document.getElementById(kelompok).value;
											showSpoiler(here);
											url="<?php echo $url_rewrite?>/module/perencanaan/api_rkb.php?skpd="+nilai_skpd+"&lokasi="+nilai_lokasi+"&kelompok="+nilai_kelompok+"&tahun="+tahun;	
											//alert(url);
											ambilDataPenerimaan(url,data);
											}
											
										</script>
										
										<script>
										function get_data_hrg(id,kelompok,harga,tahun){
											var tahun = document.getElementById(tahun).value;
											var spesifikasi	= id.value;
											var nilai_kelompok=document.getElementById(kelompok).value;
											url="<?php echo $url_rewrite?>/module/perencanaan/api_hrg.php?spesifikasi="+spesifikasi+"&kelompok="+nilai_kelompok+"&tahun="+tahun;
											ambilDataPenerimaan(url,harga);
											
										}
										</script>
											<td colspan="2">
												<div style="margin: 5px;">
												
													<div style="margin-bottom: 2px;"align="left" valign="top" >
														<input type="button" value="View Detail" onclick="get_data_skb('skpd_id','lokasi_id','kelompok_id',this,'rkb_add_jbskb|rkb_add_jbbi|rkb_rkba','tahun_id');" style="vertical-align:middle" />
													<div style="display: none;">

															<table width="100%" class="style1">
																<tbody>
																	<tr>
																		<td width="25%">Jumlah berdasarkan Standar Kebutuhan Barang</td>
																		<td>
																			<input class="w30" id="rkb_add_jbskb" name="rkb_add_jbskb" type="integer" value="" readonly="readonly"/>
																		</td>
																	</tr>
																	<tr>
																		<td width="25%">Jumlah berdasarkan Buku Inventaris</td>
																		<td>
																			<input class="w30" id="rkb_add_jbbi" name="rkb_add_jbbi" type="integer" value="" readonly="readonly"/>
																		</td>
																	</tr>
																	<tr>
																		<td width="25%">RKB yang dianjurkan yaitu <=</td>
																		<td>
																			<input class="w30" id="rkb_rkba" name="rkb_rkba" type="integer" value="" readonly="readonly"/>
																		</td>
																	</tr>
																</tbody>
															</table>

														</div>
													</div>
													
														
													
												</div>
											</td>
										</tr>
										<tr>
											<td width="25%" class="style6">Kode Rekening</td>
											<td>
												<input class="w300" name="rkb_add_rekening" id="rkb_add_rekening" type="text" value="" required="required" readonly="readonly" />
												<input type="button" name="idbtnlookuplokasi" id="idbtnlookuplokasi" value="Pilih" onclick = "showSpoiler(this);">
												<div class="inner" style="display:none;">
													
													<?php
														$alamat_simpul_rekening="$url_rewrite/function/dropdown/radio_simpul_rekening.php";
														$alamat_search_rekening="$url_rewrite/function/dropdown/radio_search_rekening.php";
														js_radiorekening($alamat_simpul_rekening, $alamat_search_rekening,"rkb_add_rekening","rekening_id",'rekening','rek');
														$style1="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
														radiorekening($style1,"rekening_id",'rekening','rek');
													?>
												</div>
											</td>
										</tr>
										<tr>
											<td width="25%" class="style6">Jumlah Barang</td>
											<td>
												<input class="w30" id="rkb_add_jml" name="rkb_add_jml" type="integer" value="" required="required" onchange="total();"/>
											</td>
										</tr>
										
										<tr>
											<td width="25%" class="style6">Harga</td>
											<td>
												<input class="w150" id="rkb_add_hrg" name="rkb_add_hrg" type="integer" value="" required="required" readonly="readonly"/>
											</td>
										</tr>
										<script>
										function total(){
										var jml= document.getElementById("rkb_add_jml").value;
										var harga=document.getElementById("rkb_add_hrg").value;
										var total=jml*harga;
										document.getElementById("rkb_add_thrg").value=total;
										}
										</script>
										<tr>
											<td width="25%" class="style6">Total Harga</td>
											<td>
												<input class="w150" id="rkb_add_thrg" name="rkb_add_thrg" type="integer" value="" required="required" readonly="readonly"/>
											</td>
										</tr>
										<tr>
											<td colspan=2 align=right>
												<input type="submit" name="submit" value="Simpan" onclick="show_confirm()"/>
												<input type="reset" name="reset" value="reset" />
											</td>
										</tr>
									</table>
								</form>
										
							<!-- Akhir Form Tambah Data -->
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

