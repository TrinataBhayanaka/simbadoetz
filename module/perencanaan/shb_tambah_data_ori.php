<?php
include "../../config/config.php";
$menu_id = 2;
$SessionUser = $SESSION->get_session_user();
$USERAUTH->FrontEnd_check_akses_menu($menu_id,$SessionUser);

if (isset($_POST['submit']))
{	
$get_data_filter = $STORE->store_shb_data(array('param'=>$_POST, 'menuID'=>$menu_id, 'type'=>'', 'paging'=>''));
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
							Buat Standar Harga Barang
						</div>
						<div id="bottomright">                                                                                                      
                            <div>
								<table border=0 width=100%>
									<tr>		
										<td width=50%></td>
										<td width=25% align="right">
											<a href="<?php echo "$url_rewrite/module/perencanaan/"; ?>shb_daftar_data.php">
											<input type="button" value="Kembali ke Halaman Sebelumnya" >
										</td>
									</tr>
								</table>
                            </div>
                                                                                        
							<div id="perencanaan_new">
								
								<!-- Form Tambah Data -->
								<!--
								<form name="tambahdata" action="<?php //echo "$url_rewrite/module/perencanaan/"; ?>shb-proses.php" method="post">
								-->
								<form method="POST" action="">
									<table width="100%" class="style1">
										<!-- script untuk js table dropdown-->
										<script type="text/javascript" src="../../JS/tabel.js"></script> 
										<tr bgcolor="#004933">
											<td class="white" colspan="2" align=left>Tambah Data Baru</td>
										</tr>
										<tr>
											<td width="25%" class="style6">Nama/Jenis Barang</td>
											<td>
												<input type="text" name="shb_add_njb" id="shb_add_njb" class="w450" value="" required="required" readonly="readonly" />
												<input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" value="Pilih" onclick = "showSpoiler(this);" />
												<div class="inner" style="display:none;">
													<?php
														
														$alamat_simpul_kelompok="$url_rewrite/function/dropdown/radio_simpul_kelompok.php";
														$alamat_search_kelompok="$url_rewrite/function/dropdown/radio_search_kelompok.php";		
                                                        js_radiokelompok($alamat_simpul_kelompok, $alamat_search_kelompok,"shb_add_njb","shb_add_njb_id",'kelompok','shbkelompokadd');
														$style="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
														radiokelompok($style,"shb_add_njb_id",'kelompok','shbkelompokadd');
													?>
												</div>
											</td>
										</tr>
										<tr>
											<td width="25%"  class="style6">Merk/Tipe</td>
											<td><input class="w300" name="shb_add_mat" id="shb_add_mat" type="text" value="" required="required" /></td>
										</tr>
										<tr>
											<td width="25%"  class="style6">Tanggal</td>
											<td><input type="text"  style="text-align:center;" name="shb_add_tgl" value="" id="tanggal12" required="required"  readonly="readonly"/></td>
										</tr>
										<tr>
											<td width="25%"  class="style6">Spesifikasi</td>
											<td><input class="w300" name="shb_add_bhn" id="shb_add_bhn" type="text" value="" required="required" /></td>
										</tr>
										<tr>
											<td width="25%"  class="style6">Satuan</td>
											<td><input class="w100" name="shb_add_satuan" id="shb_add_satuan" type="text" value="" required="required" /></td>
										</tr>
										<tr>
											<td width="25%"  class="style6">Keterangan</td>
											<td><textarea rows=4 cols="100" name="shb_add_ket" id="shb_add_ket" value="" ></textarea></td>
										</tr>
										<tr>
											<script src="accounting.js"></script>

														<script type="text/javascript">
															function format_nilai(){
															var get_nilai = document.getElementById('p_perolehan_nilai');
															document.getElementById('p_perolehan_nilai1').value=get_nilai.value;
															nilai = accounting.formatMoney(get_nilai.value, "", 2, ".", ",");
															get_nilai.value=nilai;
															
														}
														</script>
											<td width="25%"  class="style6">Harga</td>
											<!--<td><input style="width: 100px;" name="shb_add_hrg" id="shb_add_hrg" type="integer" value="" required="required" /></td> -->
											
											<td><input type="text" name="shb_add_hrg1" id="p_perolehan_nilai" value="" onchange="return format_nilai();";>
											<input type="hidden" name="shb_add_hrg" id="p_perolehan_nilai1"> </td>
										</tr>
										<tr>
											<td colspan=2 align="right" width="25%"  class="style6">
												<input type="submit" name="submit" value="Simpan" onclick=""/>
												<input type="reset" name="reset" value="reset" />
											</td>
										</tr>
									</table>
								
								<!-- Akhir Form Tambah Data -->
								</form>
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

