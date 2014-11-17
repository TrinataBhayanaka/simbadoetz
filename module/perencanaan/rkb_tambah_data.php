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

<?php
	include"$path/meta.php";
	include"$path/header.php";
	include"$path/menu.php";
	
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
	
	<section id="main">
		<ul class="breadcrumb">
		  <li><a href="#"><i class="fa fa-home fa-2x"></i>  Home</a> <span class="divider"><b>&raquo;</b></span></li>
		  <li><a href="#">Perencanaan</a><span class="divider"><b>&raquo;</b></span></li>
		  <li class="active">Buat Rencana Kebutuhan Barang</li>
		  <?php SignInOut();?>
		</ul>
		<div class="breadcrumb">
			<div class="title">Buat Rencana Kebutuhan Barang</div>
			<div class="subtitle">Tambah Data</div>
		</div><section class="formLegend">
			
			<div class="detailright">
				<a href="<?php echo"$url_rewrite/module/perencanaan/rkb_daftar_data.php";?>" class="btn">
					Kembali ke Halaman Sebelumnya</a>
							
			</div>
			
			<div style="height:5px;width:100%;clear:both"></div>
			<form method="POST" action="">
			<ul>
							<li>
								<span class="span2">Tahun</span>
								<input class="span1" id="tahun_id" name="rkb_add_thn" type="text" value="" required="required" />
							</li>
							<li>
								<span class="span2">SKPD</span>
								<div class="input-append">
									<input class="span5" name="rkb_add_skpd" id="rkb_add_skpd" type="text" value="<?php echo $_SESSION['ses_satkername'] ; ?>" required="required" readonly="readonly" />
									<input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" class="btn" value="Pilih" onclick = "showSpoiler(this);">
									<div class="inner" style="display:none;">
										
										<?php
											$alamat_simpul_skpd="$url_rewrite/function/dropdown/radio_simpul_skpd.php";
											$alamat_search_skpd="$url_rewrite/function/dropdown/radio_search_skpd.php";
											js_radioskpd($alamat_simpul_skpd, $alamat_search_skpd,"rkb_add_skpd","skpd_id",'skpd','rkbskpdadd');
											$style2="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
											radioskpd($style2,"skpd_id",'skpd','rkbskpdadd');
										?>
									</div>
								</div>
							</li>
							<li>
								<span class="span2">Lokasi</span>
								<div class="input-append">
									<input class="span5" name="rkb_add_lokasi" id="rkb_add_lokasi" type="text" value="" required="required"  readonly="readonly" />
									<input type="button" name="idbtnlookuplokasi" id="idbtnlookuplokasi" class="btn" value="Pilih" onclick = "showSpoiler(this);">
									<div class="inner" style="display:none;">
										
										<?php
											$alamat_simpul_lokasi="$url_rewrite/function/dropdown/radio_simpul_lokasi_pengadaan.php";
											$alamat_search_lokasi="$url_rewrite/function/dropdown/radio_search_lokasi_pengadaan.php";

											js_radiopengadaanlokasi($alamat_simpul_lokasi, $alamat_search_lokasi,"rkb_add_lokasi","lokasi_id",'lokasi','p_provinsi','p_kabupaten','p_kecamatan','p_desa','lok');
											$style1="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
											radiopengadaanlokasi($style1,"lokasi_id",'lokasi',"lok");
											
										?>
									</div>
								</div>
							</li>
							<li>
								<span class="span2">Nama/Jenis Barang</span>
								<div class="input-append">
									<input class="span5" name="rkb_add_njb" id="rkb_add_njb" type="text" value="" required="required" readonly="readonly" />
									<input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" class="btn" value="Pilih" onclick = "showSpoiler(this);">
									<div class="inner" style="display:none;">
										
										<?php
											$alamat_simpul_kelompok="$url_rewrite/function/dropdown/radio_simpul_kelompok.php";
											$alamat_search_kelompok="$url_rewrite/function/dropdown/radio_search_kelompok.php";
											js_radiokelompok($alamat_simpul_kelompok, $alamat_search_kelompok,"rkb_add_njb","kelompok_id",'kelompok','rkbkelompokadd');
											$style="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
											radiokelompok($style,"kelompok_id",'kelompok','rkbkelompokadd');
										?>
									</div>
								</div>
							</li>
							
										<script>
											function get_data_spesifikasi(kelompok,tahun,data){
											var nilai_kelompok=document.getElementById(kelompok).value;
											var tahun=document.getElementById(tahun).value;
											url="<?php echo $url_rewrite?>/module/perencanaan/api_merek.php?kelompok="+nilai_kelompok+"&tahun="+tahun;
											//alert(url);
											ambilData(url,data);
											
											}
										</script>
										
							<li>
								<span class="span2">Spesifikasi</span>
								<input name="button" name="Show Spesifikasi" type="button" value="Show Spesifikasi" onclick="get_data_spesifikasi('kelompok_id','tahun_id','isi_spesifikasi');" />
							</li>
							<li>
								<span class="span2">&nbsp;</span>
								<div id='isi_spesifikasi'></div>
							</li>
						</ul>
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
							<br/>
							<ul>
								<li>
								<span class="span1">&nbsp;</span>
														<input type="button" value="View Detail" onclick="get_data_skb('skpd_id','lokasi_id','kelompok_id',this,'rkb_add_jbskb|rkb_add_jbbi|rkb_rkba','tahun_id');"  />
													<div style="display: none;">
														<ul>
															<li>
															<table style=" border:1px solid #DDDDDD;">
																<tbody>
																	<tr>
																		<td width="25%">Jumlah berdasarkan Standar Kebutuhan Barang</td>
																		<td>
																			<input class="w30" id="rkb_add_jbskb" name="rkb_add_jbskb" type="text" value="" readonly="readonly"/>
																		</td>
																	</tr>
																	<tr>
																		<td width="25%">Jumlah berdasarkan Buku Inventaris</td>
																		<td>
																			<input class="w30" id="rkb_add_jbbi" name="rkb_add_jbbi" type="text" value="" readonly="readonly"/>
																		</td>
																	</tr>
																	<tr>
																		<td width="25%">RKB yang dianjurkan yaitu <=</td>
																		<td>
																			<input class="w30" id="rkb_rkba" name="rkb_rkba" type="text" value="" readonly="readonly"/>
																		</td>
																	</tr>
																</tbody>
															</table>
														</li>
														</ul>

														</div>
								</li>
							</ul>
							<ul>
							<li>
								<span class="span2">Kode Rekening</span>
								<div class="input-append">
									<input class="span5" name="rkb_add_rekening" id="rkb_add_rekening" type="text" value="" required="required" readonly="readonly" />
									<input type="button" name="idbtnlookuplokasi" id="idbtnlookuplokasi" class="btn" value="Pilih" onclick = "showSpoiler(this);">
									<div class="inner" style="display:none;">
										
										<?php
											$alamat_simpul_rekening="$url_rewrite/function/dropdown/radio_simpul_rekening.php";
											$alamat_search_rekening="$url_rewrite/function/dropdown/radio_search_rekening.php";
											js_radiorekening($alamat_simpul_rekening, $alamat_search_rekening,"rkb_add_rekening","rekening_id",'rekening','rek');
											$style1="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
											radiorekening($style1,"rekening_id",'rekening','rek');
										?>
									</div>
								</div>
							</li>
								
							<li>
								<span class="span2">Jumlah Barang</span>
								<input class="span1" id="rkb_add_jml" name="rkb_add_jml" type="text" value="" required="required" onchange="total();"/>
							</li>	
							<li>
								<span class="span2">Harga</span>				
								<input class="span3" id="rkb_add_hrg" name="rkb_add_hrg" type="text" value="" required="required" readonly="readonly"/>
							</li>
										<script>
											function total(){
											var jml= document.getElementById("rkb_add_jml").value;
											var harga=document.getElementById("rkb_add_hrg").value;
											var total=jml*harga;
											document.getElementById("rkb_add_thrg").value=total;
											}
										</script>
							<li>
								<span class="span2">Total Harga</span>				
								<input class="span3" id="rkb_add_thrg" name="rkb_add_thrg" type="text" value="" required="required" readonly="readonly"/>
							</li>
							<li>
								<span class="span2">&nbsp;</span>
								<input type="submit" name="submit" class="btn btn-primary" value="Simpan" onclick=""/>
								<input type="reset" name="reset" class="btn" value="reset" />
							</li>
						</ul>
						</form>
			
		</section>     
	</section>
	
<?php
	include"$path/footer.php";
?>