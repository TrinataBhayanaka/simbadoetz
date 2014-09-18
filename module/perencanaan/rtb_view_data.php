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
							Rencana Tahunan Barang
						</div>
						
						<div id="bottomright">                                                                                                       
                            <div>
								<table border=0 width=100%>
									<tr>		
										<td width=50%></td>
										<td width=25% align="right">
											<a href="<?php echo "$url_rewrite/module/perencanaan/"; ?>rkb_daftar_data.php">
											<input type="button" value="Kembali ke Halaman Sebelumnya" >
										</td>
									</tr>							
								</table>
                            </div>
							
							<div id="perencanaan_new">
								<table width="100%" class="style1">
									<tr bgcolor="#004933">
										<td class="white" colspan="2" align=left>Informasi Data RTB</td>
									</tr>
									<tr>
										<td width="25%" class="style6">Tahun</td>
										<td>
											<input class="w50" name="tahun" type="text" value="2013" readonly="readonly">
										</td>
									</tr>
									<tr>
										<td width="25%" class="style6">SKPD</td>
										<td>
											<input class="w300" name="skpd" type="text" value="Kesatuan Bangsa" readonly="readonly"/>
											<input name="button" name="submit" type="button" value="Pilih" />
										</td>
									</tr>
									<tr>
										<td width="25%" class="style6">Nama/Jenis Barang</td>
										<td>
											<input class="w300" name="namajenisbarang" type="text" value="sedan" readonly="readonly">
											<input name="button" name="submit" type="button" value="Pilih" />
										</td>
									</tr>
									<tr>
										<td width="25%" class="style6">Nama Barang</td>
										<td>
											<input class="w300" name="namabarang" type="text" value="Mobil Kantor Gubernur NAD" readonly="readonly"/>
											<input name="button" name="submit" type="button" value="Pilih" />
										</td>
									</tr>
									<tr >
										<td colspan="2">
											<div style="margin: 5px;">
												<div style="margin-bottom: 2px;"align="left" valign="top" >
													<input type="button" value="View Detail" onclick="if (this.parentNode.parentNode.getElementsByTagName('div')[1].getElementsByTagName('div')[0].style.display != '') { this.parentNode.parentNode.getElementsByTagName('div')[1].getElementsByTagName('div')[0].style.display = ''; this.innerText = ''; this.value = 'Tutup Informasi'; } else { this.parentNode.parentNode.getElementsByTagName('div')[1].getElementsByTagName('div')[0].style.display = 'none'; this.innerText = ''; this.value = 'Buka Informasi'; }" style="vertical-align:middle" />
												</div><noscript><a href="http://webgila.com" rel="external">Spoiler Webgila.com</a></noscript>
												<div class="alt2" style="border: 1px inset ; padding: 5px; background-image:url(http://webgila.com/wallpaper/transparant%2010.png)">
													<div style="display: none;">

														<table width="100%" class="style1">
															<tbody>
																<tr>
																	<td width="25%">Jumlah berdasarkan Standar Kebutuhan Barang</td>
																	<td>
																		<input class="w30" name="tahun" type="text" value="10" readonly="readonly">
																	</td>
																</tr>
																<tr>
																	<td width="25%">Jumlah berdasarkan Buku Inventaris</td>
																	<td><input class="w30" name="tahun" type="text" value="7" readonly="readonly"></td>
																</tr>
																<tr>
																	<td width="25%">RKB yang dianjurkan yaitu <=</td>
																	<td><input class="w30" name="tahun" type="text" value="3" readonly="readonly"></td>
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
											<input class="w150" name="koderekening" type="integer" value="111222111" readonly="readonly">
										</td>
									</tr>
									<tr>
										<td width="25%" class="style6">Jumlah Barang</td>
										<td>
											<input class="w30" name="hargabarang" type="integer" value="3" readonly="readonly">
										</td>
									</tr>
									<tr>
										<td width="25%" sclass="style6">Harga</td>
										<td>
											<input class="w150" name="jmhbarang" type="integer" value="Rp. 250.000.000" readonly="readonly"></td>
									</tr>
									<tr>
										<td width="25%" class="style6">Total Harga</td>
										<td>
										<input class="w150" name="totalharga" type="integer" value="Rp. 750.000.000" readonly="readonly"></td>
									</tr>
								</table>
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

