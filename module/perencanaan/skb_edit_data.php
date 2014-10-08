<?php
include "../../config/config.php";
$$menu_id = 4;
$SessionUser = $SESSION->get_session_user();
$USERAUTH->FrontEnd_check_akses_menu($menu_id,$SessionUser);

if (isset($_POST['edit']))
{
unset($_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$SessionUser->UserSes['ses_uid']]);
$get_data_filter = $RETRIEVE->retrieve_skb_edit(array('param'=>$_POST, 'menuID'=>$menu_id, 'type'=>'', 'paging'=>''));
}

//Mengambil data yang akan diedit
foreach ($get_data_filter as $key => $hsl_data)
//while($hsl_data=mysql_fetch_array($exec))
{
$select_njb		= $hsl_data->skb_njb;
$select_skpd	= $hsl_data->skb_skpd;
$select_lokasi	= $hsl_data->skb_lokasi;

$tanggal	= explode("-",$hsl_data->skb_tgl);
$select_tgl	= $tanggal[2]."/".$tanggal[1]."/".$tanggal[0];

$select_ket		= $hsl_data->skb_ket;
$select_jml		= $hsl_data->skb_jml;
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
        <!-- Script Tangggal 
	
	<script type="text/javascript" src="<?php //echo "$url_rewrite";?>/JS/ajax_radio.js"></script>
	<script type="text/javascript" src="<?php //echo "$url_rewrite";?>/JS/tabel.js"></script>
	-->
	<section id="main">
		<ul class="breadcrumb">
		  <li><a href="#"><i class="fa fa-home fa-2x"></i>  Home</a> <span class="divider"><b>&raquo;</b></span></li>
		  <li><a href="#">Perencanaan</a><span class="divider"><b>&raquo;</b></span></li>
		  <li class="active">Buat Standar Kebutuhan Barang</li>
		  <?php SignInOut();?>
		</ul>
		<div class="breadcrumb">
			<div class="title">Buat Standar Kebutuhan Barang</div>
			<div class="subtitle">Edit Data</div>
		</div>
		<section class="formLegend">
			
			<div class="detailright">
				<a href="<?php echo "$url_rewrite/module/perencanaan/"; ?>skb_daftar_data.php" class="btn">
					Kembali ke Halaman Sebelumnya</a>
							
			</div>
			
			<div style="height:5px;width:100%;clear:both"></div>
			<form name="skbedit" action="<?php echo "$url_rewrite/module/perencanaan/"; ?>skb-proses.php" method="post">
			<ul>
							
							<li>
								<span class="span2">Nama/Jenis Barang</span>
								<div class="input-append">
								<input class="span5" name="skb_add_njb" id="skb_add_njb" type="text" value="<?php echo show_kelompok($select_njb); ?>"  required="required" readonly="readonly" />
									<input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" class="btn" value="Pilih" onclick = "showSpoiler(this);">
									<div class="inner" style="display:none;">
										
										<?php
											$alamat_simpul_kelompok="$url_rewrite/function/dropdown/radio_simpul_kelompok.php";
											$alamat_search_kelompok="$url_rewrite/function/dropdown/radio_search_kelompok.php";
											js_radiokelompok($alamat_simpul_kelompok, $alamat_search_kelompok,"skb_add_njb","kelompok_id",'kelompok','skbkelompokedit');
											$style="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
											radiokelompok($style,"kelompok_id",'kelompok',"skbkelompokedit|$select_njb");
										?>
									</div>
								</div>
							</li>
							<li>
								<span class="span2">SKPD</span>
								<div class="input-append">
									<input class="span5" name="skb_add_skpd" id="skb_add_skpd" type="text" value="<?php echo show_skpd($select_skpd); ?>"  required="required" readonly="readonly" />
									<input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" class="btn"  value="Pilih" onclick = "showSpoiler(this);">
									<div class="inner" style="display:none;">
										
												<?php
															$alamat_simpul_skpd="$url_rewrite/function/dropdown/radio_simpul_skpd.php";
															$alamat_search_skpd="$url_rewrite/function/dropdown/radio_search_skpd.php";
															js_radioskpd($alamat_simpul_skpd, $alamat_search_skpd,"skb_add_skpd","skpd_id",'skpd','rtbskpdfilter');
															$style2="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
															radiopengadaanskpd($style2,"skpd_id",'skpd','rtbskpdfilter');
														?>
									</div>
								</div>
							</li>
							<li>
								<span class="span2">Lokasi</span>
								<div class="input-append">
									<input class="span5" id="skb_add_lokasi" name="skb_add_lokasi" type="text" value="<?php echo show_lokasi($select_lokasi); ?>"  required="required" readonly="readonly" />
									<input type="button" name="idbtnlookuplokasi" id="idbtnlookuplokasi" class="btn" value="Pilih" onclick = "showSpoiler(this);">
									<div class="inner" style="display:none;">
										
										<?php
											$alamat_simpul_lokasi="$url_rewrite/function/dropdown/radio_simpul_lokasi_pengadaan.php";
											$alamat_search_lokasi="$url_rewrite/function/dropdown/radio_search_lokasi_pengadaan.php";

											js_radiopengadaanlokasi($alamat_simpul_lokasi, $alamat_search_lokasi,"skb_add_lokasi","lokasi_id",'lokasi','p_provinsi','p_kabupaten','p_kecamatan','p_desa','lok');
											$style1="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
											radiopengadaanlokasi($style1,"lokasi_id",'lokasi',"lok");
										?>
									</div>
								</div>
							</li>
							<li>
								<span class="span2">Tanggal</span>
								<input type="text"  style="text-align:center;" class="span3" name="skb_add_tgl" value="<?php echo $select_tgl; ?>" id="tanggal12" required="required" readonly="readonly" />
							</li>
							<li>
								<span class="span2">Keterangan</span>
								<textarea class="span5" name="skb_add_ket" value="<?php echo $select_ket; ?>" ><?php echo $select_ket; ?></textarea>
							</li>
							<li>
								<span class="span2">Jumlah Barang</span>
								<input class="span1" name="skb_add_jml" type="text" value="<?php echo $select_jml; ?>" required="required">
							</li>
							<li>
								<span class="span2">&nbsp;</span>
								<input type="hidden" name="ID" value="<?php echo $_POST['ID'] ?>" />
								<input type="submit" name="submit_edit" class="btn btn-primary" value="Simpan" />
								<input type="reset" name="reset" class="btn" value="reset" />
							</li>
						</ul>
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
			
		</section>     
	</section>
	
<?php
	include"$path/footer.php";
?>