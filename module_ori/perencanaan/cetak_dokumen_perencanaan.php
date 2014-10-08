<?php
include "../../config/config.php";
?>

<html>
        <?php
        include "$path/header.php";
        ?>

        <script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/tabber.js"></script>
        <link rel="stylesheet" href="<?php echo "$url_rewrite/"; ?>css/tabber.css" TYPE="text/css" MEDIA="screen">
        
        
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
                            Cetak Dokumen Perencanaan
                            </div>
                            <div id="bottomright">
                            
                            

                            <div class="tabber">

                                <div class="tabbertab">
								<form name="form" method="POST" action="<?php echo "$url_rewrite/report/template/PERENCANAAN/report_perencanaan_cetak_standarhargabarang.php"; ?>"target="_blank"> 
                                    <h2>Standar Harga Barang</h2>
                                    <p><br><h1>Standar Harga Barang</h1><br>
									
                                    <div id="perencanaan_new">
                                        <!--Form Cetak SHB -->
                                        
											<table border="0">
												<script type="text/javascript" src="../../JS/tabel.js"></script>
												
												<tr>
														<!--<td>Tahun</td>
														<td>
															<input type="integer" name="cdp_shb_tahun" id="cdp_shb_tahun" size="4" value="" />
														</td>-->
														<td>Tahun</td>
														<td>
															<select name="tahun_1" >
															<?php for ($thn=1;$thn<50;$thn++){ ?>
															<option value="<?php echo(2000+$thn);?>">
															<?php echo (2000+$thn);?></option>
															<?php } ?>
															</select>
														</td>
												</tr>
												
												<tr>
														<td>Nama/Jenis Barang</td>
														<td>
															<input type="hidden" name="idgetkelompok" id="idgetkelompok" value="">
															<input type="text" name="lda_kelompok1" id="lda_kelompok1" class="w480" readonly="readonly" value="(semua Kelompok)">
															<input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" value="Pilih" onclick = "showSpoiler(this);">
															<div class="inner" style="display:none;"> 
															

															<?php
															$alamat_simpul_kelompok="$url_rewrite/function/dropdown/radio_simpul_kelompok.php";
															$alamat_search_kelompok="$url_rewrite/function/dropdown/radio_search_kelompok.php";
															js_radiokelompok($alamat_simpul_kelompok, $alamat_search_kelompok,"lda_kelompok1","kelompok_id1",'kelompok1','skl1');
															$style="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
															radiokelompok($style,"kelompok_id1",'kelompok1','skl1');
															?>
															</div>
														</td>
												</tr>
												
												<tr>
														<td>Keterangan</td>
														<td>
															<input type="text" name="cdp_shb_ket" id="cdp_shb_ket" size="51" value="" />
														</td>
												</tr>
												<tr>
														<td>&nbsp;</td>
												</tr>
												<tr>
														<td></td>
														<td>
															<input type="submit" name="submit" value="Tampilkan Data" />
															<input type="reset" name="reset" value="Bersihkan Data" />
														</td>
												</tr>
											</table>
											<input type="hidden" name="menuID" value="9">
											<input type="hidden" name="mode" value="1">
											<input type="hidden" name="tab" value="1">
                                        </form>
                                    <!--Akhir Form Cetak SHB -->
                                    </div>
									</p>
                                </div>


                                <div class="tabbertab">
								<form name="form" method="POST" action="<?php echo "$url_rewrite/report/template/PERENCANAAN/report_perencanaan_cetak_standarhargapemeliharaan.php"; ?>"target="_blank"> 
                                    <h2>Standar Harga Pemeliharaan</h2>
                                    <p>
                                        <br><h1>Standar Harga Pemeliharaan Barang</h1><br>
                                    <div id="perencanaan_new">

                            
											<table>
											<script type="text/javascript" src="../../JS/tabel.js"></script>
												<tr>
														<!--<td>Tahun</td>
														<td>
															<input type="integer" name="cdp_shpb_tahun" id="cdp_shpb_tahun" size="4" value="">
														</td>-->
														<td>Tahun</td>
														<td>
															<select name="tahun_2" >
															<?php for ($thn=1;$thn<50;$thn++){ ?>
															<option value="<?php echo(2000+$thn);?>">
															<?php echo (2000+$thn);?></option>
															<?php } ?>
															</select>
														</td>
												</tr>
												
												<tr>
														<td>Nama/Jenis Barang</td>
														<td>
															<input type="hidden" name="idgetkelompok" id="idgetkelompok" value="">
															<input type="text" name="lda_kelompok2" id="lda_kelompok2" class="w480" readonly="readonly" value="(semua Kelompok)">
															<input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" value="Pilih" onclick = "showSpoiler(this);">
															<div class="inner" style="display:none;"> 
															
															<?php
															$alamat_simpul_kelompok="$url_rewrite/function/dropdown/radio_simpul_kelompok.php";
															$alamat_search_kelompok="$url_rewrite/function/dropdown/radio_search_kelompok.php";
															js_radiokelompok($alamat_simpul_kelompok, $alamat_search_kelompok,"lda_kelompok2","kelompok_id2",'kelompok2','skl2');
															$style="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
															radiokelompok($style,"kelompok_id2",'kelompok2','skl2');
															?>
															</div>
														</td>
												</tr>
												<tr>
														<td>Keterangan</td>
														<td>
															<input type="text" name="cdp_shpb_ket" size="51" value="">
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
											<input type="hidden" name="menuID" value="9">
											<input type="hidden" name="mode" value="1">
											<input type="hidden" name="tab" value="2">
										</form>
										<!--Akhir Form Cetak SHPB -->
                                    </div>
                                    </p>
                                </div>

                                <div class="tabbertab">
								<form name="form" method="POST" action="<?php echo "$url_rewrite/report/template/PERENCANAAN/report_perencanaan_cetak_standarkebutuhanbarang.php"; ?>"> 
                                    <h2>Standar Kebutuhan Barang</h2>
                                    <p>
                                        <br><h1>Standar Kebutuhan Barang</h1><br>
                                    <div id="perencanaan_new">

                                        
											<table>
											<script type="text/javascript" src="../../JS/tabel.js"></script>
												<tr>
														<td>&nbsp;</td>
												</tr>
												<tr>
														<td>Nama/Jenis Barang</td>
														<td>
															<input type="hidden" name="idgetkelompok" id="idgetkelompok" value="">
															<input type="text" name="lda_kelompok3" id="lda_kelompok3" class="w480" readonly="readonly" value="(semua Kelompok)">
															<input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" value="Pilih" onclick = "showSpoiler(this);">
															<div class="inner" style="display:none;"> 
												
															<?php
															
															$alamat_simpul_kelompok="$url_rewrite/function/dropdown/radio_simpul_kelompok.php";
															$alamat_search_kelompok="$url_rewrite/function/dropdown/radio_search_kelompok.php";
															js_radiokelompok($alamat_simpul_kelompok, $alamat_search_kelompok,"lda_kelompok3","kelompok_id3",'kelompok3','skl3');
															$style="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
															radiokelompok($style,"kelompok_id3",'kelompok3','skl3');
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
														<input type="hidden" name="idgetkelompok" id="idgetkelompok" value="">
														<input type="text" name="lda_skpd1" id="lda_skpd1" class="w450" readonly="readonly" value="(semua SKPD)">
														<input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" value="Pilih" onclick = "showSpoiler(this);">
														<div class="inner" style="display:none;">
														
														<?php
														$alamat_simpul_skpd="$url_rewrite/function/dropdown/radio_simpul_skpd.php";
														$alamat_search_skpd="$url_rewrite/function/dropdown/radio_search_skpd.php";
														js_radioskpd($alamat_simpul_skpd, $alamat_search_skpd,"lda_skpd1","skpd_id1",'skpd1','sk1');
														$style2="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
														radiopengadaanskpd($style2,"skpd_id1",'skpd1','sk1');
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
														<input type="hidden" name="idgetlokasi" id="idgetlokasi" value="">
														<input type="text" name="rkb_lokasi" id="rkb_lokasi" class="w450" readonly="readonly" value="(semua Lokasi)">
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
														<td></td>
														<td>
															<input type="submit" name="submit" value="Tampilkan Data" />
															<input type="reset" name="reset" value="Bersihkan Data">
														</td>
												</tr>
											</table>
											<input type="hidden" name="menuID" value="9">
											<input type="hidden" name="mode" value="1">
											<input type="hidden" name="tab" value="3">
                                        </form>
										<!--Akhir Form Cetak SKB -->
                                    </div>
                                    </p>
                                </div>


                                <div class="tabbertab">
								<form name="form" method="POST" action="<?php echo "$url_rewrite/report/template/PERENCANAAN/report_perencanaan_cetak_rkbu.php"; ?>"target="_blank"> 
                                    <h2>RKB</h2>
                                    <p>
                                        <br><h1>Rencana Kebutuhan Barang</h1><br>
                                    <div id="perencanaan_new">

                                      
											<table>
											<script type="text/javascript" src="../../JS/tabel.js"></script>
												<tr>
													<td>&nbsp;</td>
												</tr>
												<tr>
													<!--<td>Tahun</td>
													<td>
														<input type="text" size="4" name="cdp_rkb_thn" id="cdp_rkb_thn" value="">
													</td>-->
													<td>Tahun</td>
														<td>
															<select name="tahun_3" >
															<?php for ($thn=1;$thn<50;$thn++){ ?>
															<option value="<?php echo(2000+$thn);?>">
															<?php echo (2000+$thn);?></option>
															<?php } ?>
															</select>
													</td>
												</tr>
												<tr>
													<td>&nbsp;</td>
												</tr>
												<tr>
													<td>SKPD</td>
													<td>
														<input type="hidden" name="idgetkelompok" id="idgetkelompok" value="">
														<input type="text" name="lda_skpd2" id="lda_skpd2" class="w450" readonly="readonly" value="(semua SKPD)">
														<input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" value="Pilih" onclick = "showSpoiler(this);">
														<div class="inner" style="display:none;">
														
														<?php
														$alamat_simpul_skpd="$url_rewrite/function/dropdown/radio_simpul_skpd.php";
														$alamat_search_skpd="$url_rewrite/function/dropdown/radio_search_skpd.php";
														js_radioskpd($alamat_simpul_skpd, $alamat_search_skpd,"lda_skpd2","skpd_id2",'skpd2','sk2');
														$style2="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
														radiopengadaanskpd($style2,"skpd_id2",'skpd2','sk2');
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
														<input type="hidden" name="idgetlokasi" id="idgetlokasi" value="">
														<input type="text" name="rkb_lokasi2" id="rkb_lokasi2" class="w450" readonly="readonly" value="(semua Lokasi)">
														<input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" value="Pilih" onclick = "showSpoiler(this);">
														<div class="inner" style="display:none;">
															
															<?php
																$alamat_simpul_lokasi="$url_rewrite/function/dropdown/radio_simpul_lokasi_pengadaan.php";
																$alamat_search_lokasi="$url_rewrite/function/dropdown/radio_search_lokasi_pengadaan.php";

																js_radiopengadaanlokasi($alamat_simpul_lokasi, $alamat_search_lokasi,"rkb_lokasi2","lokasi_id2",'lokasi2','p_provinsi2','p_kabupaten2','p_kecamatan2','p_desa2','lok2');
																$style1="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
																radiopengadaanlokasi($style1,"lokasi_id2",'lokasi2',"lok2");
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
															<input type="hidden" name="idgetkelompok" id="idgetkelompok" value="">
															<input type="text" name="lda_kelompok4" id="lda_kelompok4" class="w480" readonly="readonly" value="(semua Kelompok)">
															<input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" value="Pilih" onclick = "showSpoiler(this);">
															<div class="inner" style="display:none;"> 
															

															<?php
															$alamat_simpul_kelompok="$url_rewrite/function/dropdown/radio_simpul_kelompok.php";
															$alamat_search_kelompok="$url_rewrite/function/dropdown/radio_search_kelompok.php";
															js_radiokelompok($alamat_simpul_kelompok, $alamat_search_kelompok,"lda_kelompok4","kelompok_id4",'kelompok4','skl4');
															$style="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
															radiokelompok($style,"kelompok_id4",'kelompok4','skl4');
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
											<input type="hidden" name="menuID" value="9">
											<input type="hidden" name="mode" value="1">
											<input type="hidden" name="tab" value="4">
                                        </form>
										<!--Akhir Form Cetak RKB -->
                                    </div>
                                    </p>
                                </div>

                                <div class="tabbertab">
								<form name="form" method="POST" action="<?php echo "$url_rewrite/report/template/PERENCANAAN/report_perencanaan_cetak_rkpbu.php"; ?>"target="_blank"> 
                                    <h2>RKPB</h2>
                                    <p>
                                        <br><h1>Rencana Kebutuhan Pemeliharaan Barang</h1><br>
                                    <div id="perencanaan_new">

                                        
												<table>
												<script type="text/javascript" src="../../JS/tabel.js"></script>
														<tr>
																<td>&nbsp;</td>
														</tr>
														<tr>
																<!--<td>Tahun</td>
																<td>
																	<input type="text" size="4" name="cdp_rkpb_thn" id="cdp_rkpb_thn" value="">
																</td>-->
																	<td>Tahun</td>
																	<td>
																		<select name="tahun_4" >
																		<?php for ($thn=1;$thn<50;$thn++){ ?>
																		<option value="<?php echo(2000+$thn);?>">
																		<?php echo (2000+$thn);?></option>
																		<?php } ?>
																		</select>
																	</td>
																
														</tr>
																<tr>
																<td>&nbsp;</td>
																</tr>
														<tr>
																<td>SKPD</td>
																<td>
																	<input type="hidden" name="idgetkelompok" id="idgetkelompok" value="">
																	<input type="text" name="lda_skpd3" id="lda_skpd3" class="w450" readonly="readonly" value="(semua SKPD)">
																	<input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" value="Pilih" onclick = "showSpoiler(this);">
																	<div class="inner" style="display:none;">
																	
																	<?php
																	$alamat_simpul_skpd="$url_rewrite/function/dropdown/radio_simpul_skpd.php";
																	$alamat_search_skpd="$url_rewrite/function/dropdown/radio_search_skpd.php";
																	js_radioskpd($alamat_simpul_skpd, $alamat_search_skpd,"lda_skpd3","skpd_id3",'skpd3','sk3');
																	$style2="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
																	radiopengadaanskpd($style2,"skpd_id3",'skpd3','sk3');
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
																	<input type="hidden" name="idgetlokasi" id="idgetlokasi" value="">
																	<input type="text" name="rkb_lokasi3" id="rkb_lokasi3" class=""w450" readonly="readonly" value="(semua Lokasi)">
																	<input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" value="Pilih" onclick = "showSpoiler(this);">
																	<div class="inner" style="display:none;">
																		
																		<?php
																			$alamat_simpul_lokasi="$url_rewrite/function/dropdown/radio_simpul_lokasi_pengadaan.php";
																			$alamat_search_lokasi="$url_rewrite/function/dropdown/radio_search_lokasi_pengadaan.php";

																			js_radiopengadaanlokasi($alamat_simpul_lokasi, $alamat_search_lokasi,"rkb_lokasi3","lokasi_id3",'lokasi3','p_provinsi3','p_kabupaten3','p_kecamatan3','p_desa3','lok3');
																			$style1="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
																			radiopengadaanlokasi($style1,"lokasi_id3",'lokasi3',"lok3");
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
																	<input type="hidden" name="idgetkelompok" id="idgetkelompok" value="">
																	<input type="text" name="lda_kelompok5" id="lda_kelompok5" class="w480" readonly="readonly" value="(semua Kelompok)">
																	<input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" value="Pilih" onclick = "showSpoiler(this);">
																	<div class="inner" style="display:none;"> 
																	

																	<?php
																	$alamat_simpul_kelompok="$url_rewrite/function/dropdown/radio_simpul_kelompok.php";
																	$alamat_search_kelompok="$url_rewrite/function/dropdown/radio_search_kelompok.php";
																	js_radiokelompok($alamat_simpul_kelompok, $alamat_search_kelompok,"lda_kelompok5","kelompok_id5",'kelompok5','skl5');
																	$style="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
																	radiokelompok($style,"kelompok_id5",'kelompok5','skl5');
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
												<input type="hidden" name="menuID" value="9">
												<input type="hidden" name="mode" value="1">
												<input type="hidden" name="tab" value="5">
                                            </form>
										<!--Akhir Form Cetak RKPB -->
                                    </div>
                                    </p>
                                </div>

                                <div class="tabbertab">
								<form name="form" method="POST" action="<?php echo "$url_rewrite/report/template/PERENCANAAN/report_perencanaan_cetak_rtb.php"; ?>"target="_blank"> 
                                    <h2>RTB</h2>
                                    <p>
                                        <br><h1>Rencana Tahunan Barang</h1><br>
                                    <div id="perencanaan_new">

                                       
											<table>
											<script type="text/javascript" src="../../JS/tabel.js"></script>
													<tr>
															<td>&nbsp;</td>
													</tr>
													<tr>
															<!--<td>Tahun</td>
															<td>
																<input type="text" size="4" name="cdp_rtb_thn" id="cdp_rtb_tahun" value="" />
															</td>-->
															<td>Tahun</td>
																	<td>
																		<select name="tahun_5" >
																		<?php for ($thn=1;$thn<50;$thn++){ ?>
																		<option value="<?php echo(2000+$thn);?>">
																		<?php echo (2000+$thn);?></option>
																		<?php } ?>
																		</select>
															</td>
													</tr>
															<tr>
															<td>&nbsp;</td>
															</tr>
													<tr>
															<td>SKPD</td>
															<td>
																	<input type="hidden" name="idgetkelompok" id="idgetkelompok" value="">
																	<input type="text" name="lda_skpd4" id="lda_skpd4" class="w450" readonly="readonly" value="(semua SKPD)">
																	<input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" value="Pilih" onclick = "showSpoiler(this);">
																	<div class="inner" style="display:none;">
																	
																	<?php
																	$alamat_simpul_skpd="$url_rewrite/function/dropdown/radio_simpul_skpd.php";
																	$alamat_search_skpd="$url_rewrite/function/dropdown/radio_search_skpd.php";
																	js_radioskpd($alamat_simpul_skpd, $alamat_search_skpd,"lda_skpd4","skpd_id4",'skpd4','sk4');
																	$style2="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
																	radiopengadaanskpd($style2,"skpd_id4",'skpd4','sk4');
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
																	<input type="hidden" name="idgetlokasi" id="idgetlokasi" value="">
																	<input type="text" name="rkb_lokasi4" id="rkb_lokasi4" class="w450" readonly="readonly" value="(semua Lokasi)">
																	<input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" value="Pilih" onclick = "showSpoiler(this);">
																	<div class="inner" style="display:none;">
																		
																		<?php
																			$alamat_simpul_lokasi="$url_rewrite/function/dropdown/radio_simpul_lokasi_pengadaan.php";
																			$alamat_search_lokasi="$url_rewrite/function/dropdown/radio_search_lokasi_pengadaan.php";

																			js_radiopengadaanlokasi($alamat_simpul_lokasi, $alamat_search_lokasi,"rkb_lokasi4","lokasi_id4",'lokasi4','p_provinsi4','p_kabupaten4','p_kecamatan4','p_desa4','lok4');
																			$style1="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
																			radiopengadaanlokasi($style1,"lokasi_id4",'lokasi4',"lok4");
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
																	<input type="hidden" name="idgetkelompok" id="idgetkelompok" value="">
																	<input type="text" name="lda_kelompok6" id="lda_kelompok6" class="w480"readonly="readonly" value="(semua Kelompok)">
																	<input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" value="Pilih" onclick = "showSpoiler(this);">
																	<div class="inner" style="display:none;"> 
																	

																	<?php
																	$alamat_simpul_kelompok="$url_rewrite/function/dropdown/radio_simpul_kelompok.php";
																	$alamat_search_kelompok="$url_rewrite/function/dropdown/radio_search_kelompok.php";
																	js_radiokelompok($alamat_simpul_kelompok, $alamat_search_kelompok,"lda_kelompok6","kelompok_id6",'kelompok6','skl6');
																	$style="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
																	radiokelompok($style,"kelompok_id6",'kelompok6','skl6');
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
																<input type="reset" name="reset" value="Bersihkan Data" />
															</td>
													</tr>

											</table>
												<input type="hidden" name="menuID" value="9">
												<input type="hidden" name="mode" value="1">
												<input type="hidden" name="tab" value="6">
                                        </form>
										<!--Akhir Form Cetak RTB -->
                                    </div>
                                    </p>
                                </div>

                                <div class="tabbertab">
								<form name="form" method="POST" action="<?php echo "$url_rewrite/report/template/PERENCANAAN/report_perencanaan_cetak_rtpb.php"; ?>"target="_blank">
                                    <h2>RTPB</h2>
                                    <p>
                                        <br><h1>Rencana Tahunan Pemeliharaan Barang</h1><br>
                                    <div id="perencanaan_new">

                                       
											<table>
											<script type="text/javascript" src="../../JS/tabel.js"></script>
													<tr>
														<td>&nbsp;</td>
													</tr>
													<tr>
														<!--<td>Tahun</td>
														<td>
															<input type="text" size="4" name="cdp_rtpb_thn" id="cdp_rtpb_tahun" value="" />
														</td>-->
														<td>Tahun</td>
																	<td>
																		<select name="tahun_6" >
																		<?php for ($thn=1;$thn<50;$thn++){ ?>
																		<option value="<?php echo(2000+$thn);?>">
																		<?php echo (2000+$thn);?></option>
																		<?php } ?>
																		</select>
														</td>
														
													</tr>
														<tr>
														<td>&nbsp;</td>
														</tr>
													<tr>
														<td>SKPD</td>
														<td>
																	<input type="hidden" name="idgetkelompok" id="idgetkelompok" value="">
																	<input type="text" name="lda_skpd5" id="lda_skpd5" class="w450" readonly="readonly" value="(semua SKPD)">
																	<input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" value="Pilih" onclick = "showSpoiler(this);">
																	<div class="inner" style="display:none;">
																	
																	<?php
																	$alamat_simpul_skpd="$url_rewrite/function/dropdown/radio_simpul_skpd.php";
																	$alamat_search_skpd="$url_rewrite/function/dropdown/radio_search_skpd.php";
																	js_radioskpd($alamat_simpul_skpd, $alamat_search_skpd,"lda_skpd5","skpd_id5",'skpd5','sk5');
																	$style2="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
																	radiopengadaanskpd($style2,"skpd_id5",'skpd5','sk5');
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
																	<input type="hidden" name="idgetlokasi" id="idgetlokasi" value="">
																	<input type="text" name="rkb_lokasi5" id="rkb_lokasi5" class="w450" readonly="readonly" value="(semua Lokasi)">
																	<input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" value="Pilih" onclick = "showSpoiler(this);">
																	<div class="inner" style="display:none;">
																		
																		<?php
																			$alamat_simpul_lokasi="$url_rewrite/function/dropdown/radio_simpul_lokasi_pengadaan.php";
																			$alamat_search_lokasi="$url_rewrite/function/dropdown/radio_search_lokasi_pengadaan.php";

																			js_radiopengadaanlokasi($alamat_simpul_lokasi, $alamat_search_lokasi,"rkb_lokasi5","lokasi_id5",'lokasi5','p_provinsi5','p_kabupaten5','p_kecamatan5','p_desa5','lok5');
																			$style1="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
																			radiopengadaanlokasi($style1,"lokasi_id5",'lokasi5',"lok5");
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
																	<input type="hidden" name="idgetkelompok" id="idgetkelompok" value="">
																	<input type="text" name="lda_kelompok7" id="lda_kelompok7" class="w480" readonly="readonly" value="(semua Kelompok)">
																	<input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" value="Pilih" onclick = "showSpoiler(this);">
																	<div class="inner" style="display:none;"> 
																	

																	<?php
																	$alamat_simpul_kelompok="$url_rewrite/function/dropdown/radio_simpul_kelompok.php";
																	$alamat_search_kelompok="$url_rewrite/function/dropdown/radio_search_kelompok.php";
																	js_radiokelompok($alamat_simpul_kelompok, $alamat_search_kelompok,"lda_kelompok7","kelompok_id7",'kelompok7','skl7');
																	$style="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
																	radiokelompok($style,"kelompok_id7",'kelompok7','skl7');
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
															<input type="reset" name="reset" value="Bersihkan Data" />
														</td>
													</tr>

											</table>
												<input type="hidden" name="menuID" value="9">
												<input type="hidden" name="mode" value="1">
												<input type="hidden" name="tab" value="7">
                                        </form>
										<!--Akhir Form Cetak RTPB -->
                                    </div>
                                    </p>
                                </div>

                                <div class="tabbertab">
								<form name="form" method="POST" action="<?php echo "$url_rewrite/report/template/PERENCANAAN/report_perencanaan_cetak_dkbmd.php"; ?>"target="_blank">
                                    <h2>DKBMD</h2>
                                    <p>
                                        <br><h1>Daftar Kebutuhan Barang Milik Daerah</h1><br>
                                    <div id="perencanaan_new">

                                       
											<table>
											<script type="text/javascript" src="../../JS/tabel.js"></script>
												<tr>
													<td>&nbsp;</td>
												</tr>
												<tr>
													<!--<td>Tahun</td>
														<td>
															<input type="text" size="4" name="cdp_rtpb_thn" id="cdp_rtpb_tahun" value="" />
														</td>-->
													<td>Tahun</td>
																<td>
																	<select name="tahun_7" >
																	<?php for ($thn=1;$thn<50;$thn++){ ?>
																	<option value="<?php echo(2000+$thn);?>">
																	<?php echo (2000+$thn);?></option>
																	<?php } ?>
																	</select>
													</td>
												</tr>
												<tr>
													<td>&nbsp;</td>
												</tr>
												<tr>
													<td>SKPD</td>
													<td>
																	<input type="hidden" name="idgetkelompok" id="idgetkelompok" value="">
																	<input type="text" name="lda_skpd6" id="lda_skpd6" class="w450" readonly="readonly" value="(semua SKPD)">
																	<input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" value="Pilih" onclick = "showSpoiler(this);">
																	<div class="inner" style="display:none;">
																	
																	<?php
																	$alamat_simpul_skpd="$url_rewrite/function/dropdown/radio_simpul_skpd.php";
																	$alamat_search_skpd="$url_rewrite/function/dropdown/radio_search_skpd.php";
																	js_radioskpd($alamat_simpul_skpd, $alamat_search_skpd,"lda_skpd6","skpd_id6",'skpd6','sk6');
																	$style2="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
																	radiopengadaanskpd($style2,"skpd_id6",'skpd6','sk6');
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
														<input type="hidden" name="idgetlokasi" id="idgetlokasi" value="">
														<input type="text" name="rkb_lokasi6" id="rkb_lokasi6" class="w450" readonly="readonly" value="(semua Lokasi)">
														<input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" value="Pilih" onclick = "showSpoiler(this);">
														<div class="inner" style="display:none;">
															
															<?php
																$alamat_simpul_lokasi="$url_rewrite/function/dropdown/radio_simpul_lokasi_pengadaan.php";
																$alamat_search_lokasi="$url_rewrite/function/dropdown/radio_search_lokasi_pengadaan.php";

																js_radiopengadaanlokasi($alamat_simpul_lokasi, $alamat_search_lokasi,"rkb_lokasi6","lokasi_id6",'lokasi6','p_provinsi6','p_kabupaten6','p_kecamatan6','p_desa6','lok6');
																$style1="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
																radiopengadaanlokasi($style1,"lokasi_id6",'lokasi6',"lok6");
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
																	<input type="hidden" name="idgetkelompok" id="idgetkelompok" value="">
																	<input type="text" name="lda_kelompok8" id="lda_kelompok8" class="w480" readonly="readonly" value="(semua Kelompok)">
																	<input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" value="Pilih" onclick = "showSpoiler(this);">
																	<div class="inner" style="display:none;"> 
																	
																	<?php
																	$alamat_simpul_kelompok="$url_rewrite/function/dropdown/radio_simpul_kelompok.php";
																	$alamat_search_kelompok="$url_rewrite/function/dropdown/radio_search_kelompok.php";
																	js_radiokelompok($alamat_simpul_kelompok, $alamat_search_kelompok,"lda_kelompok8","kelompok_id8",'kelompok8','skl8');
																	$style="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
																	radiokelompok($style,"kelompok_id8",'kelompok8','skl8');
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
														<input type="reset" name="reset" value="Bersihkan Data" />
													</td>
												</tr>
											</table>
												<input type="hidden" name="menuID" value="9">
												<input type="hidden" name="mode" value="1">
												<input type="hidden" name="tab" value="8">
                                        </form>
										
                                    </div>
                                    </p>
                                </div>

                                <div class="tabbertab">
								<form name="form" method="POST" action="<?php echo "$url_rewrite/report/template/PERENCANAAN/report_perencanaan_cetak_dkpbmd.php"; ?>"target="_blank">
                                    <h2>DKPBMD</h2>
                                    <p>
                                        <br><h1>Daftar Kebutuhan Pemeliharaan Barang Milik Daerah</h1><br>
                                    <div id="perencanaan_new">
                                        
											<table>
											<script type="text/javascript" src="../../JS/tabel.js"></script>
												<tr>
													<td>&nbsp;</td>
												</tr>
												<tr>
													<!--<td>Tahun</td>
														<td>
															<input type="text" size="4" name="cdp_rtpb_thn" id="cdp_rtpb_tahun" value="" />
														</td>-->
													<td>Tahun</td>
													<td>
														<select name="tahun_8" >
														<?php for ($thn=1;$thn<50;$thn++){ ?>
														<option value="<?php echo(2000+$thn);?>">
														<?php echo (2000+$thn);?></option>
														<?php } ?>
														</select>
													</td>
												</tr>
												<tr>
													<td>&nbsp;</td>
												</tr>
												<tr>
													<td>SKPD</td>
													<td>
																	<input type="hidden" name="idgetkelompok" id="idgetkelompok" value="">
																	<input type="text" name="lda_skpd7" id="lda_skpd7" class="w450" readonly="readonly" value="(semua SKPD)">
																	<input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" value="Pilih" onclick = "showSpoiler(this);">
																	<div class="inner" style="display:none;">
																	

																	<?php
																	$alamat_simpul_skpd="$url_rewrite/function/dropdown/radio_simpul_skpd.php";
																	$alamat_search_skpd="$url_rewrite/function/dropdown/radio_search_skpd.php";
																	js_radioskpd($alamat_simpul_skpd, $alamat_search_skpd,"lda_skpd7","skpd_id7",'skpd7','sk7');
																	$style2="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
																	radiopengadaanskpd($style2,"skpd_id7",'skpd7','sk7');
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
														<input type="hidden" name="idgetlokasi" id="idgetlokasi" value="">
														<input type="text" name="rkb_lokasi7" id="rkb_lokasi7" class="w450" readonly="readonly" value="(semua Lokasi)">
														<input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" value="Pilih" onclick = "showSpoiler(this);">
														<div class="inner" style="display:none;">
															
															<?php
																$alamat_simpul_lokasi="$url_rewrite/function/dropdown/radio_simpul_lokasi_pengadaan.php";
																$alamat_search_lokasi="$url_rewrite/function/dropdown/radio_search_lokasi_pengadaan.php";

																js_radiopengadaanlokasi($alamat_simpul_lokasi, $alamat_search_lokasi,"rkb_lokasi7","lokasi_id7",'lokasi7','p_provinsi7','p_kabupaten7','p_kecamatan7','p_desa7','lok7');
																$style1="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
																radiopengadaanlokasi($style1,"lokasi_id7",'lokasi7',"lok7");
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
																	<input type="hidden" name="idgetkelompok" id="idgetkelompok" value="">
																	<input type="text" name="lda_kelompok9" id="lda_kelompok9" class="w480" readonly="readonly" value="(semua Kelompok)">
																	<input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" value="Pilih" onclick = "showSpoiler(this);">
																	<div class="inner" style="display:none;"> 
																	

																	<?php
																	$alamat_simpul_kelompok="$url_rewrite/function/dropdown/radio_simpul_kelompok.php";
																	$alamat_search_kelompok="$url_rewrite/function/dropdown/radio_search_kelompok.php";
																	js_radiokelompok($alamat_simpul_kelompok, $alamat_search_kelompok,"lda_kelompok9","kelompok_id9",'kelompok9','skl9');
																	$style="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
																	radiokelompok($style,"kelompok_id9",'kelompok9','skl9');
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
														<input type="reset" name="reset" value="Bersihkan Data" />
													</td>
												</tr>
											</table>
												<input type="hidden" name="menuID" value="9">
												<input type="hidden" name="mode" value="1">
												<input type="hidden" name="tab" value="9">
                                        </form>
                                    <!--Akhir Form Cetak DKPBMD -->
                                    </div>
                                    </p>
                                </div>
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
