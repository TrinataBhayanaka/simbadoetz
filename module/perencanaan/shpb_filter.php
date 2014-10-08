<?php
include "../../config/config.php";

$USERAUTH = new UserAuth();
$SESSION = new Session();
$menu_id = 3;
$SessionUser = $SESSION->get_session_user();
$USERAUTH->FrontEnd_check_akses_menu($menu_id,$SessionUser);
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
	<script type="text/javascript" src="<?php echo "$url_rewrite";?>/JS/ajax_checkbox.js"></script>
	<script type="text/javascript" src="<?php echo "$url_rewrite";?>/JS/jquery.min.js"></script>    
	
	<section id="main">
			<ul class="breadcrumb">
			  <li><a href="#"><i class="fa fa-home fa-2x"></i>  Home</a> <span class="divider"><b>&raquo;</b></span></li>
			  <li><a href="#">Perencanaan</a><span class="divider"><b>&raquo;</b></span></li>
			  <li class="active">Buat Standar Harga Pemeliharaan Barang</li>
			  <?php SignInOut();?>
			</ul>
			<div class="breadcrumb">
				<div class="title">Buat Standar Harga Pemeliharaan Barang</div>
				<div class="subtitle">Filter Data</div>
			</div>
		<section class="formLegend">
		
			<form name="pencarian" method="post" action="<?php echo "$url_rewrite/module/perencanaan/"; ?>shpb_daftar_data.php?pid=1">
			<ul>
							<li>
								<span class="span2">Tahun</span>
								<input type="text" name="shb_thn" size="4" class="span2" value="">
							</li>
							<li>
								<span class="span2">Nama/Jenis Barang</span>
								<div class="input-append">
									<input type="text" name="shpb_njb" id="shpb_njb" class="span6" value="">
									<input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" class="btn" value="Pilih" onclick = "showSpoiler(this);">
									<div class="inner" style="display:none;">
										<?php
											$alamat_simpul_kelompok="$url_rewrite/function/dropdown/radio_simpul_kelompok.php";
											$alamat_search_kelompok="$url_rewrite/function/dropdown/radio_search_kelompok.php";
											js_radiokelompok($alamat_simpul_kelompok, $alamat_search_kelompok,"shpb_njb","kelompok_id",'kelompok','shpbkelompokfilter');
											$style="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
											radiokelompok($style,"kelompok_id",'kelompok','shpbkelompokfilter');
										?>
									</div>
								</div>
							</li>
							<li>
								<span class="span2">Keterangan</span>
								<input type="text" name="shb_ket" size="51" class="span3" value="">
							</li>
							<li>
								<span class="span2">&nbsp;</span>
								<input type="submit" name="submit" class="btn btn-primary" value="Tampilkan Data" />
								<input type="reset" name="reset" class="btn" value="Bersihkan Data">
							</li>
						</ul>
						</form>
			
		</section>     
	</section>
	
<?php
	include"$path/footer.php";
?>