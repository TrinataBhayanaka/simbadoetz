    <?php
        include "../../config/config.php"; 
    ?>

<html>
    <?php
        include "$path/header.php";
    ?>
        
                <!--buat number only-->
                <style>
                    #errmsg { color:red; }
                    #errmsg2 { color:red; }
                </style>
                <script src="<?php echo "$url_rewrite/"; ?>JS/jquery-latest.js"></script>
                <script src="<?php echo "$url_rewrite/"; ?>JS/jquery.js"></script>
                <script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/jquery.min.js"></script>
                <script type="text/javascript" src="<?php echo "$url_rewrite/";?>JS/ajax_checkbox.js"></script>
                <script type="text/javascript">
                    $(document).ready(function(){

                        //called when key is pressed in textbox
                            $("#posisiKolom").keypress(function (e)  
                            { 
                            //if the letter is not digit then display error and don't type anything
                            if( e.which!=8 && e.which!=0 && (e.which<48 || e.which>57))
                            {
                                    //display error message
                                    $("#errmsg").html("Hanya Bisa Input Angka").show().fadeOut("slow"); 
                                return false;
                        }	
                            });
                    });
                </script>
                <script type="text/javascript">
                    $(document).ready(function(){

                        //called when key is pressed in textbox
                            $("#posisiKolom2").keypress(function (e)  
                            { 
                            //if the letter is not digit then display error and don't type anything
                            if( e.which!=8 && e.which!=0 && (e.which<48 || e.which>57))
                            {
                                    //display error message
                                    $("#errmsg2").html("Hanya Bisa Input Angka").show().fadeOut("slow"); 
                                return false;
                        }	
                            });
                    });
                </script>
                
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
                                Penetapan Pemanfaatan
                            </div>
                            <div id="bottomright">
                                <strong>
									<u>Seleksi Pencarian:</u>
								</strong>
                                <form name="form" method="POST" action="<?php echo "$url_rewrite/module/pemanfaatan/"; ?>pemanfaatan_penetapan_tambah_data.php?pid=1">
                                <table>
                                    <script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/tabel.js"></script>
                                    <tr>
                                        <td>Aset ID<br>
										<input type="text" name="peman_penet_filt_add_idaset" placeholder="" style="width:200px;"></td>
                                    </tr>
                                    <tr>
                                        <td>Nama Aset<br>
										<input type="text" name="peman_penet_filt_add_nmaset" placeholder="" style="width:480px;"></td>
                                    </tr>
                                    <tr>
                                        <td>Nomor Kontrak<br><input type="text" name="peman_penet_filt_add_nokontrak" placeholder="" style="width:200px;" id="">&nbsp;<span id="errmsg"></span>
                                        </td>
                                    </tr>
									<tr>
                                        <td>Tahun Perolehan<br><input type="text" name="peman_penet_filt_add_thn" placeholder="" style="" id="">&nbsp;<span id="errmsg"></span>
                                        </td>
                                    </tr>
									<tr>
														<td>
															Kelompok<br>
																<input type="text" name="pem_kelompok" id="pem_kelompok" style="width:480px;" readonly="readonly" value="">
																<input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" value="Pilih" onclick = "showSpoiler(this);">
																<div class="inner" style="display:none;">
																	<style>
																		.tabel th {
																			background-color: #eeeeee;
																			border: 1px solid #dddddd;
																		}
																		.tabel td {
																			border: 1px solid #dddddd;
																		}
																	</style>
																	<?php
																		//include "$path/function/dropdown/function_kelompok.php";
																		$alamat_simpul_kelompok="$url_rewrite/function/dropdown/radio_simpul_kelompok.php";
																		$alamat_search_kelompok="$url_rewrite/function/dropdown/radio_search_kelompok.php";
																		js_radiokelompok($alamat_simpul_kelompok, $alamat_search_kelompok,"pem_kelompok","kelompok_id5",'kelompok','pemkelompokfilter');
																		$style="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
																		radiokelompok($style,"kelompok_id5",'kelompok','pemkelompokfilter');
																	?>
																</div>
														</td>
													</tr>
													<tr>
														<td>
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
														</td>
													</tr>
													<tr>
														<td colspan=2>Pilih Lokasi</td>
                                                    </tr>
                                                    <tr>
														<td>
															<input type="text" name="entri_lokasi" id="entri_lokasi" style="width:480px;" readonly="readonly" placeholder="(Semua Kelompok)">
															<input type="button" name="idbtnlookuplokasi" id="idbtnlookuplokasi" value="Pilih" onclick = "showSpoiler(this);">
																<div class="inner" style="display:none;">
																		<style>
																				.tabel th {
																						background-color: #eeeeee;
																						border: 1px solid #dddddd;
																				}
																				.tabel td {
																						border: 1px solid #dddddd;
																				}
																		</style>
																				<?php
																			   // include "$path/function/dropdown/radio_function_lokasi_pengadaan.php";
																				$alamat_simpul_lokasi="$url_rewrite/function/dropdown/radio_simpul_lokasi_pengadaan.php";
																				$alamat_search_lokasi="$url_rewrite/function/dropdown/radio_search_lokasi_pengadaan.php";
																				js_radiopengadaanlokasi($alamat_simpul_lokasi, $alamat_search_lokasi,"entri_lokasi","lokasi_id",'lokasi','p_provinsi','p_kabupaten','p_kecamatan','p_desa','lok');
																				$style1="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
																				radiopengadaanlokasi($style1,"lokasi_id",'lokasi',"lok");
																				?>
																	</div>
									   
														</td>
                                                    </tr>
                                    <tr>
                                        <td valign="top">Satker<br>
                                            <input type="text" name="lda_skpd" id="lda_skpd" style="width:480px;" readonly="readonly" placeholder="(Semua SKPD)" value="<?php echo $_SESSION['ses_satkername'] ; ?>">
                                            <input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" value="Pilih" onclick = "showSpoiler(this);">
                                            <div class="inner" style="display:none;">
                                                <style>
                                                    .tabel th {
                                                        background-color: #eeeeee;
                                                        border: 1px solid #dddddd;
                                                    }
                                                    .tabel td {
                                                        border: 1px solid #dddddd;
                                                    }
                                                </style>
                                                            <?php
                                                            
                                                            $alamat_simpul_skpd="$url_rewrite/function/dropdown/radio_simpul_skpd.php";
                                                            $alamat_search_skpd="$url_rewrite/function/dropdown/radio_search_skpd.php";
                                                            js_radioskpd($alamat_simpul_skpd, $alamat_search_skpd,"lda_skpd","skpd_id",'skpd','yuda');
                                                            $style2="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
                                                            radioskpd($style2,"skpd_id",'skpd','yuda');
                                                            ?>
                                            </div>
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <td colspan="2"><input type="submit" name="tampil_filter_add" value="Lanjut"></td>
                                        <td></td>
                                    </tr>
                                    
                                </table>
                                </form>
                                    
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="footer">Sistem Informasi Barang Daerah ver. 0.x.x <br />
			Powered by BBSDM Team 2012
            </div>
        </body>
</html>	

