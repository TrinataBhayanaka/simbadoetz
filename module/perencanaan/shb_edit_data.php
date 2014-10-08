<?php
include "../../config/config.php";
$menu_id = 2;
$SessionUser = $SESSION->get_session_user();
$USERAUTH->FrontEnd_check_akses_menu($menu_id,$SessionUser);

if (isset($_POST['edit']))
	    {
			
		unset($_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$SessionUser->UserSes['ses_uid']]);
						
		// parameter yang dimasukan adalah menuID, type, post dan paging
		$get_data_filter = $RETRIEVE->retrieve_shb_edit_data(array('param'=>$_POST, 'menuID'=>$menu_id, 'type'=>'', 'paging'=>$paging));
		
	    }
	    

foreach ($get_data_filter as $key => $hsl_data)

//while($hsl_data=mysql_fetch_array($exec))
	{		
		
		$select_njb	= $hsl_data->Kelompok_ID;
		$select_mat	= $hsl_data->Merk;
		$select_bhn	= $hsl_data->Spesifikasi;
		$select_satuan	= $hsl_data->Satuan;

		$tanggal	= explode("-",$hsl_data->TglUpdate);
		$select_tgl	= $tanggal[2]."/".$tanggal[1]."/".$tanggal[0];

		$select_ket	= $hsl_data->Keterangan;
		$select_hrg	= $hsl_data->NilaiStandar;
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
			<div class="subtitle">Edit Data </div>
		</div>
		<section class="formLegend">
			<div class="titleLegend"><span class="label label-info Legendtitle">Buat Standar Harga Barang</span></div>
			<p>&nbsp;</p>
			<div class="detailright">
				<a href="<?php echo "$url_rewrite/module/perencanaan/"; ?>shb_daftar_data.php" class="btn">
					Kembali ke Halaman Sebelumnya</a>
							
			</div>
			
			<div style="height:5px;width:100%;clear:both"></div>
			<form name="shbeditdata" method="POST" action="<?php echo "$url_rewrite/module/perencanaan/"; ?>shb-proses.php" method="post">
			<ul>
							
							<li>
								<span class="span2">Nama/Jenis Barang</span>
								<div class="input-append">
									 <input type="text" name="shb_add_njb" id="shb_add_njb" class="span6" value="<?php echo show_kelompok($select_njb); ?>" required="required" readonly="readonly" />
									<input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" class="btn" value="Pilih" onclick = "showSpoiler(this);" />
									<div class="inner" style="display:none;">
										<?php
											
											$alamat_simpul_kelompok="$url_rewrite/function/dropdown/radio_simpul_kelompok.php";
											$alamat_search_kelompok="$url_rewrite/function/dropdown/radio_search_kelompok.php";
											js_radiokelompok($alamat_simpul_kelompok, $alamat_search_kelompok,"shb_add_njb","kelompok_id",'kelompok','shbkelompokadd');
											$style="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
											radiokelompok($style,"kelompok_id",'kelompok',"shbkelompokadd|$select_njb");
										?>
									</div>
								</div>
							</li>
							<li>
								<span class="span2">Merk/Tipe</span>
								<input class="span4" name="shb_add_mat" id="shb_add_mat" type="text" value="<?php echo $select_mat; ?>" required="required" />
							</li>
							<li>
								<span class="span2">Tanggal</span>
								<input type="text"  class="span3" style="text-align:center;" name="shb_add_tgl" value="<?php echo $select_tgl; ?>" id="tanggal12" required="required"  class="span3" readonly="readonly"/>
							</li>
							<li>
								<span class="span2">Spesifikasi</span>
								<input class="span4" name="shb_add_bhn" id="shb_add_bhn" type="text" value="<?php echo $select_bhn; ?>" required="required" />
							</li>
							<li>
								<span class="span2">Satuan</span>
								<input class="span2" name="shb_add_satuan" id="shb_add_satuan" type="text" value="<?php echo $select_satuan; ?>" required="required" />
							</li>
							<li>
								<span class="span2">Keterangan</span>
								<textarea rows="3" class="span6" name="shb_add_ket" id="shb_add_ket"><?php echo $select_ket; ?></textarea>
							</li>
								 <script src="accounting.js"></script>
														<script type="text/javascript">
														function format_nilai(){
														
														var get_nilai = document.getElementById('shb_add_hrg2');
														document.getElementById('shb_add_hrg').value=get_nilai.value;
														nilai = accounting.formatMoney(get_nilai.value, "", 2, ".", ",");
														get_nilai.value=nilai;
													}
																							</script>
							<li>
								<span class="span2">Harga</span>
								<input type="text" onchange="return format_nilai()"; name="shb_add_hrg2" id="shb_add_hrg2" class="span3" required=" required"  value="<?php echo number_format($select_hrg,2,',','.')?>">
											<input type="hidden" name="shb_add_hrg" id="shb_add_hrg" value="<?php echo $select_hrg; ?>" onload="return format_nilai();">
							</li>
							<li>
								<span class="span2">&nbsp;</span>
								<input type="hidden" name="ID" value="<?php echo $_POST['ID'];?>">
								<input type="submit" class="btn btn-primary" name="submit_edit" value="Edit" onclick=""/>
								<input type="reset" class="btn" name="reset" value="reset" />
							</li>
						</ul>
						</form>
			
		</section>     
	</section>
	
<?php
	include"$path/footer.php";
?>