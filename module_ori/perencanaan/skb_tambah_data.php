<?php
include "../../config/config.php";
$menu_id = 4;
$SessionUser = $SESSION->get_session_user();
$USERAUTH->FrontEnd_check_akses_menu($menu_id,$SessionUser);

if (isset($_POST['submit']))
{	
$get_data_filter = $STORE->store_skb_data(array('param'=>$_POST, 'menuID'=>$menu_id, 'type'=>'', 'paging'=>''));
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
		<script>
			$(function()
			{
			$('#tanggal1').datepicker($.datepicker.regional['id']);
			$('#tanggal2').datepicker($.datepicker.regional['id']);
			$('#tanggal3').datepicker($.datepicker.regional['id']);
			$('#tanggal4').datepicker($.datepicker.regional['id']);
			$('#tanggal5').datepicker($.datepicker.regional['id']);
			$('#tanggal6').datepicker($.datepicker.regional['id']);
			$('#tanggal7').datepicker($.datepicker.regional['id']);
			$('#tanggal8').datepicker($.datepicker.regional['id']);
			$('#tanggal9').datepicker($.datepicker.regional['id']);
			$('#tanggal10').datepicker($.datepicker.regional['id']);
			$('#tanggal11').datepicker($.datepicker.regional['id']);
			$('#tanggal12').datepicker($.datepicker.regional['id']);
			$('#tanggal13').datepicker($.datepicker.regional['id']);
			$('#tanggal14').datepicker($.datepicker.regional['id']);
			$('#tanggal15').datepicker($.datepicker.regional['id']);
			}
			);
		</script>   
		<link href="<?php echo "$url_rewrite/"; ?>css/jquery-ui.css" type="text/css" rel="stylesheet">
        <!-- Script Tangggal -->
	
	<script type="text/javascript" src="<?php echo "$url_rewrite";?>/JS/ajax_radio.js"></script>
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
							Buat Standar Kebutuhan Barang
						</div>
						<div id="bottomright">                                                                                                      
                            <div>
								<table border=0 width=100%>
									<tr>		
										<td width=50%></td>
										<td width=25% align="right">
											<a href="<?php echo "$url_rewrite/module/perencanaan/"; ?>skb_daftar_data.php">
											<input type="button" value="Kembali ke Halaman Sebelumnya" >
										</td>
									</tr>
								</table>
                            </div>
                                                                                        
                            <div id="perencanaan_new">
															
								<!-- Form Tambah Data -->
								
								<form action="" method="post">
									<table width="100%" class="style1">
										<tr bgcolor="#004933">
											<td class="white" colspan="2" align=left>Tambah Data Baru</td>
										</tr>
										<tr>
											<td align="center" class="style6">Nama/Jenis Barang</td>
											<td><input class="w300" name="skb_add_njb" id="skb_add_njb" type="text" value=""  required="required" readonly="readonly"/>
												<input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" value="Pilih" onclick = "showSpoiler(this);">
												<div class="inner" style="display:none;">
													
													<?php
														
														$alamat_simpul_kelompok="$url_rewrite/function/dropdown/radio_simpul_kelompok.php";
														$alamat_search_kelompok="$url_rewrite/function/dropdown/radio_search_kelompok.php";
														js_radiokelompok($alamat_simpul_kelompok, $alamat_search_kelompok,"skb_add_njb","kelompok_id",'kelompok','skbkelompokadd');
														$style="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
														radiokelompok($style,"kelompok_id",'kelompok','skbkelompokadd');
													?>
												</div>
											</td>
										</tr>
										<tr>
											<td align="center" class="style6">SKPD</td>
											<td><input class="w300" name="skb_add_skpd" id="skb_add_skpd" type="text" value="<?php echo $_SESSION['ses_satkername'] ; ?>"  required="required" readonly="readonly"/>
												<input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" value="Pilih" onclick = "showSpoiler(this);">
												<div class="inner" style="display:none;">
													
													<?php
														//include "$path/function/dropdown/radio_function_skpd.php";
														$alamat_simpul_skpd="$url_rewrite/function/dropdown/radio_simpul_skpd.php";
														$alamat_search_skpd="$url_rewrite/function/dropdown/radio_search_skpd.php";
														js_radioskpd($alamat_simpul_skpd, $alamat_search_skpd,"skb_add_skpd","skpd_id",'skpd','skbskpdadd');
														$style2="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
														radioskpd($style2,"skpd_id",'skpd','skbskpdadd');
													?>
												</div>
											</td>
										</tr>
										<tr>
										<td align="center" class="style6">Lokasi</td>
											<td><input class="w300" name="skb_add_lokasi" id="skb_add_lokasi" type="text" value=""  required="required" readonly="readonly"/>
												<input type="button" name="idbtnlookuplokasi" id="idbtnlookuplokasi" value="Pilih" onclick = "showSpoiler(this);">
												<div class="inner" style="display:none;">
												
													<?php
														$alamat_simpul_lokasi="$url_rewrite/function/dropdown/radio_simpul_lokasi_pengadaan.php";
														$alamat_search_lokasi="$url_rewrite/function/dropdown/radio_search_lokasi_pengadaan.php";

														js_radiopengadaanlokasi($alamat_simpul_lokasi, $alamat_search_lokasi,"skb_add_lokasi","lokasi_id",'lokasi','p_provinsi','p_kabupaten','p_kecamatan','p_desa','lok');
														$style1="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
														radiopengadaanlokasi($style1,"lokasi_id",'lokasi',"lok");
													?>
												</div>
											</td>
										</tr>
										<tr>
											<td align="center" class="style6">Tanggal</td>
											<td>
												<input type="text"  style="text-align:center;" name="skb_add_tgl" value="" id="tanggal12" required="required" readonly="readonly"/>
											</td>
										</tr>
										<tr>
											<td align="center" class="style6">Keterangan</td>
											<td><textarea rows=4 cols="100" name="skb_add_ket" value=""></textarea></td>
										</tr>
										<tr>
											<td align="center" class="style6">Jumlah Barang</td>
											<td><input class="w30" name="skb_add_jml" type="integer" value="" required="required">
											</td>
										</tr>
										<tr>
											<td colspan=2  class="style6" align=right>
												<input type="submit" name="submit" value="Simpan" />
												<input type="reset" name="reset" value="reset" />
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

