<table>
<tr> 
										<td colspan=2>SKPD</td>
									</tr>
									<tr>
										<td>
											<input type="text" name="lda_skpd" id="lda_skpd" style="width:450px;" readonly="readonly" placeholder="<?php if ($uraian!=''){echo $uraian;} else {echo '(Semua Jenis Barang)';}?>">
											<input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" value="Pilih" onclick = "showSpoiler(this);"  <?=$disabled; ?>>
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
													$alamat_simpul_skpd="$url_rewrite/function/dropdown/radio_skpd_pageadmin.php";
													$alamat_search_skpd="$url_rewrite/function/dropdown/radio_search_skpd_pageadmin.php";
													 js_radiopengadaanskpd_admin($alamat_simpul_skpd, $alamat_search_skpd,"lda_skpd","skpd_id",'skpd','p_skpd','p_noreg_satker','sk',"$url_rewrite");
                                                                                                                                                           $style2="style=\"width:625px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
                                                                                                                                                           radiopengadaanskpd_admin($style2,"skpd_id",'skpd',"sk|$SKPD_ID");
												?>
                                                                              <input type="hidden" id="p_skpd" name="p_skpd" value="" readonly="readonly" >
                                                                              <input type="hidden" id="p_noreg_satker" name="p_noreg_satker" value="" readonly="readonly" >
											</div>
										</td>
									</tr>	
                                                      </table>

<br/>