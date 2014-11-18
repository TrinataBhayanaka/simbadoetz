<?php
include "../../config/config.php";

$USERAUTH = new UserAuth();

$SESSION = new Session();

$menu_id = 13;
$SessionUser = $SESSION->get_session_user();
$USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);

?>

<?php
	include"$path/meta.php";
	include"$path/header.php";
	include"$path/menu.php";
	
?>
  
	<section id="main">
		<ul class="breadcrumb">
			  <li><a href="#"><i class="fa fa-home fa-2x"></i>  Home</a> <span class="divider"><b>&raquo;</b></span></li>
			  <li><a href="#">Perolehan</a><span class="divider"><b>&raquo;</b></span></li>
			  <li class="active"> Cetak Dokumen Pengadaan</li>
			  <?php SignInOut();?>
			</ul>
			<div class="breadcrumb">
				<div class="title"> Cetak Dokumen Pengadaan</div>
				<div class="subtitle">Cetak Dokumen</div>
			</div>	
		<section class="formLegend">
			<script>
				$(document).ready(function() {
					$('#tahun_tanah,#tahun_mesin,#tahun_bangunan,#tahun_jaringan,#tahun_tetaplainnya,#tahun_kdp,#tahun_lainnya,#tahun_neraca').keydown(function (e) {
						// Allow: backspace, delete, tab, escape, enter and .
						if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
							 // Allow: Ctrl+A
							(e.keyCode == 65 && e.ctrlKey === true) || 
							 // Allow: home, end, left, right
							(e.keyCode >= 35 && e.keyCode <= 39)) {
								 // let it happen, don't do anything
								 return;
						}
						// Ensure that it is a number and stop the keypress
						if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
							e.preventDefault();
						}
					});
				
					
				
				});
				
			</script>
			<div class="tabbable" style="margin-bottom: 18px;">
					  <ul class="nav nav-tabs">
						<li class="active"><a href="#pbmd" data-toggle="tab">Daftar Aset Tetap - Tanah</a></li>
						<li><a href="#rpbmd" data-toggle="tab">Daftar Aset Tetap - Peralatan dan Mesin</a></li>
						<li><a href="#pmbmd" data-toggle="tab">Daftar Aset Tetap - Gedung dan Bangunan</a></li>
						<li><a href="#rpmbmd" data-toggle="tab">Daftar Aset Tetap - Jalan, Irigasi dan Jaringan</a></li>
						<li><a href="#bdp3" data-toggle="tab">Daftar Aset Tetap - Aset Tetap Lainnya</a></li>
						<li><a href="#rbdp3" data-toggle="tab">Daftar Aset Tetap - Konstruksi Dalam Pengerjaan</a></li>
						<li><a href="#lainnya" data-toggle="tab">Daftar Aset Lainnya</a></li>
						<li><a href="#neraca" data-toggle="tab">Rekapitulasi Barang Ke Neraca</a></li>
					  </ul>
					  
					  <div class="tab-content" style="padding-bottom: 9px; border-bottom: 1px solid #ddd;">
						<div class="tab-pane active" id="pbmd">
						<div class="breadcrumb">
							<div class="titleTab">Daftar Aset Tetap - Tanah</div>
						</div>
						 <form method="post" name="form" action="<?php echo "$url_rewrite/report/template/PEROLEHAN/report_perolehanaset_cetak_aset_tetap_tanah.php"; ?>">
						<ul>
							<li>
								<span class="span2">Tahun</span>
								<input name="tahun_tanah" id ="tahun_tanah" type="text" maxlength='4' value="<?php echo date('Y')?>" required>
							</li>
							<?php selectSatker('kodeSatker1','255',true,false); ?>
							<br>
							<li>
								<span class="span2">&nbsp;</span>
								<input type="submit" name="pengadaanbmd" class="btn btn-primary" value="Lanjut" />&nbsp;
								<input type="reset" name="reset" class="btn" value="Bersihkan Filter" />
							</li>
						</ul>
						</form>
						</div>
						
						<div class="tab-pane" id="rpbmd">
						<div class="breadcrumb">
							<div class="titleTab">Daftar Aset Tetap - Peralatan dan Mesin</div>
						</div>
						 <form method="post" name="form" action="<?php echo "$url_rewrite/report/template/PEROLEHAN/report_perolehanaset_cetak_aset_tetap_mesin.php"; ?>">
						<ul>
							<li>
								<span class="span2">Tahun</span>
								<input name="tahun_mesin" id ="tahun_mesin" type="text" maxlength='4' value="<?php echo date('Y')?>" required>
							</li>
							<?php selectSatker('kodeSatker2','255',true,false); ?>
							<br>
							<li>
								<span class="span2">&nbsp;</span>
								<input type="submit" name="pengadaanbmd" class="btn btn-primary" value="Lanjut" />&nbsp;
								<input type="reset" name="reset" class="btn" value="Bersihkan Filter" />
							</li>
						</ul>
						</form>
						</div>
						
						<div class="tab-pane" id="pmbmd">
						<div class="breadcrumb">
							<div class="titleTab">Daftar Aset Tetap - Gedung dan Bangunan</div>
						</div>
						 <form method="post" name="form" action="<?php echo "$url_rewrite/report/template/PEROLEHAN/report_perolehanaset_cetak_aset_tetap_bangunan.php"; ?>">
						<ul>
							<li>
								<span class="span2">Tahun</span>
								<input name="tahun_bangunan" id ="tahun_bangunan" type="text" maxlength='4' value="<?php echo date('Y')?>" required>
							</li>
							<?php selectSatker('kodeSatker3','255',true,false); ?>
							<br>
							<li>
								<span class="span2">&nbsp;</span>
								<input type="submit" name="pengadaanbmd" class="btn btn-primary" value="Lanjut" />&nbsp;
								<input type="reset" name="reset" class="btn" value="Bersihkan Filter" />
							</li>
						</ul>
						</form>
						</div>
						
						<div class="tab-pane" id="rpmbmd">
						<div class="breadcrumb">
							<div class="titleTab">Daftar Aset Tetap - Jalan, Irigasi dan Jaringan</div>
						</div>
						 <form method="post" name="form" action="<?php echo "$url_rewrite/report/template/PEROLEHAN/report_perolehanaset_cetak_aset_tetap_jaringan.php"; ?>">
						<ul>
							<li>
								<span class="span2">Tahun</span>
								<input name="tahun_jaringan" id ="tahun_jaringan" type="text" maxlength='4' value="<?php echo date('Y')?>" required>
							</li>
							<?php selectSatker('kodeSatker4','255',true,false); ?>
							<br>
							<li>
								<span class="span2">&nbsp;</span>
								<input type="submit" name="pengadaanbmd" class="btn btn-primary" value="Lanjut" />&nbsp;
								<input type="reset" name="reset" class="btn" value="Bersihkan Filter" />
							</li>
						</ul>
						</form>
						</div>
						
						<div class="tab-pane" id="bdp3">
						<div class="breadcrumb">
							<div class="titleTab">Daftar Aset Tetap - Aset Tetap Lainnya</div>
						</div>
						 <form method="post" name="form" action="<?php echo "$url_rewrite/report/template/PEROLEHAN/report_perolehanaset_cetak_aset_tetap_lainnya.php"; ?>">
						<ul>
							<li>
								<span class="span2">Tahun</span>
								<input name="tahun_tetaplainnya" id ="tahun_tetaplainnya" type="text" maxlength='4' value="<?php echo date('Y')?>" required>
							</li>
							<?php selectSatker('kodeSatker5','255',true,false); ?>
							<br>
							<li>
								<span class="span2">&nbsp;</span>
								<input type="submit" name="pengadaanbmd" class="btn btn-primary" value="Lanjut" />&nbsp;
								<input type="reset" name="reset" class="btn" value="Bersihkan Filter" />
							</li>
						</ul>
						</form>
						</div>
						
						<div class="tab-pane" id="rbdp3">
						<div class="breadcrumb">
							<div class="titleTab">Daftar Aset Tetap - Konstruksi Dalam Pengerjaan</div>
						</div>
						 <form method="post" name="form" action="<?php echo "$url_rewrite/report/template/PEROLEHAN/report_perolehanaset_cetak_aset_tetap_kdp.php"; ?>">
						<ul>
							<li>
								<span class="span2">Tahun</span>
								<input name="tahun_kdp" id ="tahun_kdp" type="text" maxlength='4' value="<?php echo date('Y')?>" required>
							</li>
							<?php selectSatker('kodeSatker6','255',true,false); ?>
							<br>
							<li>
								<span class="span2">&nbsp;</span>
								<input type="submit" name="pengadaanbmd" class="btn btn-primary" value="Lanjut" />&nbsp;
								<input type="reset" name="reset" class="btn" value="Bersihkan Filter" />
							</li>
						</ul>
						</form>
						</div>
						
						<div class="tab-pane" id="lainnya">
						<div class="breadcrumb">
							<div class="titleTab">Daftar Aset Lainnya</div>
						</div>
						 <form method="post" name="form" action="<?php echo "$url_rewrite/report/template/PEROLEHAN/report_perolehanaset_cetak_aset_lainnya.php"; ?>">
						<ul>
							<li>
								<span class="span2">Tahun</span>
								<input name="tahun_lainnya" id ="tahun_lainnya" type="text" maxlength='4' value="<?php echo date('Y')?>" required>
							</li>
							<?php selectSatker('kodeSatker7','255',true,false); ?>
							<br>
							<li>
								<span class="span2">&nbsp;</span>
								<input type="submit" name="pengadaanbmd" class="btn btn-primary" value="Lanjut" />&nbsp;
								<input type="reset" name="reset" class="btn" value="Bersihkan Filter" />
							</li>
						</ul>
						</form>
						</div>
						
						<div class="tab-pane" id="neraca">
						<div class="breadcrumb">
							<div class="titleTab">Rekapitulasi Barang Ke Neraca</div>
						</div>
						 <form method="post" name="form" action="<?php echo "$url_rewrite/report/template/PEROLEHAN/report_perolehanaset_cetak_rekapneraca.php"; ?>">
						<ul>
							<li>
								<span class="span2">Tahun</span>
								<input name="tahun_neraca" id ="tahun_neraca" type="text" maxlength='4' value="<?php echo date('Y')?>" required>
							</li>
							<?php selectSatker('kodeSatker8','255',true,false); ?>
							<br>
							<li>
								<span class="span2">&nbsp;</span>
								<input type="submit" name="pengadaanbmd" class="btn btn-primary" value="Lanjut" />&nbsp;
								<input type="reset" name="reset" class="btn" value="Bersihkan Filter" />
							</li>
						</ul>
						</form>
						</div>
						
						</div>
			</div> 
			
			
		</section>     
	</section>
	
<?php
	include"$path/footer.php";
?>