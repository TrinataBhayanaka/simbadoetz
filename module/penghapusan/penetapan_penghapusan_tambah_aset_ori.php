<?php
 include "../../config/config.php";
     
    include"$path/title.php";
    include"$path/menu.php";
    
    $menu_id = 39;
    $SessionUser = $SESSION->get_session_user();
    ($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
    $USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);
?>
<html>
    <?php
    include"$path/header.php";
    ?>
	
		<!--[if IE]>
		<link rel="stylesheet" type="text/css" href="ie_office.css" />
		<![endif]-->
	
	<body>
	
			
                        <div id="tengah1">	
                                <div id="frame_tengah1">
                                        <div id="frame_gudang">
                                                <div id="topright">
                                                        Penetapan Penghapusan
                                                </div>
                                                        <div id="bottomright">
														<strong>
															<u>Seleksi Pencarian:</u>
														</strong>
                                                           <form method="POST" action="<?php echo"$url_rewrite";?>/module/penghapusan/penetapan_penghapusan_tambah_lanjut.php?pid=1">
															<table border="0" cellpadding="1" cellspacing="1" width="100%">
															<tbody><tr><td style="height: 5px;"><!-- just give a space --></td></tr>
																	<tr>
																			<td>ID&nbsp;Aset&nbsp;(System&nbsp;ID)<br>
																					<input style="width: 200px;" id="bup_pp_sp_asetid" name="bup_pp_sp_asetid" type="text" ></td>
																	</tr>
																	<tr>
																			<td>Nama&nbsp;Aset<br>
																						<input isdatepicker="true" style="width: 480px;"  name="bup_pp_sp_namaaset"  type="text"></td>
																	</tr>
																	<tr>
																			<td>Nomor&nbsp;Kontrak<br>
																						<input isdatepicker="true" style="width: 200px;" id="bup_pp_sp_nokontrak" name="bup_pp_sp_nokontrak"  type="text"></td>
																	</tr>
																	<tr>
																			<td>Tahun&nbsp;Perolehan<br>
																			<input name="bup_pp_sp_tahun" id="bup_pp_sp_tahun"  type="text" ></td>
																					
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
																						js_radiokelompok($alamat_simpul_kelompok, $alamat_search_kelompok,"pem_kelompok","kelompok_id",'kelompok','pemkelompokfilter');
																						$style="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
																						radiokelompok($style,"kelompok_id",'kelompok','pemkelompokfilter');
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
																		<td>
																			<table style="display: none">
																				<tr>
																					<td><input type="text" id="p_skpd" name="p_skpd" value="" readonly="readonly"></td>
																					<td><input type="text" id="p_noreg_satker" name="p_noreg_satker" value="00.00"  size=5 maxlength="5"  id="posisiKolom3" readonly="readonly"/></td>
																				</tr>
																			</table>
																			</tr>
																		</td>
																	<tr>
																		<td>
																			SKPD
																				<br>
																					<!---->
																					<input type="text" name="lda_skpd" id="lda_skpd" style="width:480px;" readonly="readonly" placeholder="<?php echo $_SESSION['ses_satkername'] ; ?>">
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
																							js_radioskpd($alamat_simpul_skpd, $alamat_search_skpd,"lda_skpd","skpd_id",'skpd1','sk');
																							$style2="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
																							radioskpd($style2,"skpd_id",'skpd1','sk');
																						?>
																					</div>
																		</td>
																	</tr> 
																	<!--<tr>
																			<td>
																				NGO
																					<br>
																							<input type="text" name="lda_ngo" id="lda_ngo10"style="width:480px;"readonly="readonly" placeholder="(Semua NGO)">
																							<input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" value="Pilih"onclick = "showSpoiler(this);">
																		
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
																					/*$alamat_simpul_ngo="$url_rewrite/function/dropdown/radio_simpul_ngo.php";
																					$alamat_search_ngo="$url_rewrite/function/dropdown/radio_search_ngo.php";
																					js_radiongo($alamat_simpul_ngo, $alamat_search_ngo,"lda_ngo10","ngo_id",'ngo','su');
																					$style3="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
																					radiongo($style3,"ngo_id",'ngo','su');*/
																					?>         
																				</div>

																		</td>
																</tr>-->
																<tr>
																	<td align="left" valign="top">
																		<script>
																			
																					/*function sendit(){
																					alert("lihat koreksi data aset");
																					//document.location="pengadaan_proses.php";
																					document.forms[0].submit(); // ini yang bener//
																					
																					}*/
																			
																		</script>
																		<input type='submit' value='Lanjut'  name="submit"/>
																	</td>
																</tr>	
															</tbody>
														 </table>
															</form>
                                                    </div>
                                            </div>
                                    </div>
                            </div>
                    
        <?php
            include"$path/footer.php";
        ?>
</body>
</html>	
