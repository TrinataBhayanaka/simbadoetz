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

<?php
	include"$path/meta.php";
	include"$path/header.php";
	include"$path/menu.php";
	
	 $menu_id = 1;
     $SessionUser = $SESSION->get_session_user();
     ($SessionUser['ses_uid'] != '') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title' => 'GuestMenu', 'ses_name' => 'menu_without_login'));
     $USERAUTH->FrontEnd_check_akses_menu($menu_id, $Session);
	 $resetDataView = $DBVAR->is_table_exists('lihat_daftar_aset_'.$SessionUser['ses_uoperatorid'], 0);
	
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
	
	<section id="main">
		<ul class="breadcrumb">
		  <li><a href="#"><i class="fa fa-home fa-2x"></i>  Home</a> <span class="divider"><b>&raquo;</b></span></li>
		  <li><a href="#">Perencanaan</a><span class="divider"><b>&raquo;</b></span></li>
		  <li class="active">Buat Standar Harga Barang</li>
		  <?php SignInOut();?>
		</ul>
		<div class="breadcrumb">
			<div class="title">Buat Standar Harga Barang</div>
			<div class="subtitle">Tambah Data </div>
		</div>
		<section class="formLegend">
			
			<div class="detailright">
				<a href="<?php echo "$url_rewrite/module/perencanaan/"; ?>shb_daftar_data.php" class="btn">
					Kembali ke Halaman Sebelumnya</a>
							
			</div>
			
			<div style="height:5px;width:100%;clear:both"></div>
			<form method="POST" action="">
			<ul>
							
							<li>
								<span class="span2">Nama/Jenis Barang</span>
								<div class="input-append">
									<input type="text" name="shb_add_njb" id="shb_add_njb" class="span6" value="" required="required" readonly="readonly" />
									<input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" class="btn" value="Pilih" onclick = "showSpoiler(this);" />
									<div class="inner" style="display:none;">
										<?php
											
											$alamat_simpul_kelompok="$url_rewrite/function/dropdown/radio_simpul_kelompok.php";
											$alamat_search_kelompok="$url_rewrite/function/dropdown/radio_search_kelompok.php";		
											js_radiokelompok($alamat_simpul_kelompok, $alamat_search_kelompok,"shb_add_njb","shb_add_njb_id",'kelompok','shbkelompokadd');
											$style="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
											radiokelompok($style,"shb_add_njb_id",'kelompok','shbkelompokadd');
										?>
									</div>
								</div>
							</li>
							<li>
								<span class="span2">Merk/Tipe</span>
								<input class="span4" name="shb_add_mat" id="shb_add_mat" type="text" value="" required="required" />
							</li>
							<li>
								<span class="span2">Tanggal</span>
								<input type="text"  style="text-align:center;" name="shb_add_tgl" value="" id="tanggal12" required="required"  class="span3" readonly="readonly"/>
							</li>
							<li>
								<span class="span2">Spesifikasi</span>
								<input class="span4" name="shb_add_bhn" id="shb_add_bhn" type="text" value="" required="required" />
							</li>
							<li>
								<span class="span2">Satuan</span>
								<input class="span2" name="shb_add_satuan" id="shb_add_satuan" type="text" value="" required="required" />
							</li>
							<li>
								<span class="span2">Keterangan</span>
								<textarea rows="3" class="span6" name="shb_add_ket" id="shb_add_ket"></textarea>
							</li>
								<script src="accounting.js"></script>

														<script type="text/javascript">
															function format_nilai(){
															var get_nilai = document.getElementById('p_perolehan_nilai');
															document.getElementById('p_perolehan_nilai1').value=get_nilai.value;
															nilai = accounting.formatMoney(get_nilai.value, "", 2, ".", ",");
															get_nilai.value=nilai;
															
														}
														</script>
							<li>
								<span class="span2">Harga</span>
								<input type="text" name="shb_add_hrg1" id="p_perolehan_nilai" class="span3" value="" onchange="return format_nilai();";>
											<input type="hidden" name="shb_add_hrg" id="p_perolehan_nilai1"> 
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