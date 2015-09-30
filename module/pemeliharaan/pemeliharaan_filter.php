<?php
include "../../config/config.php";

$USERAUTH = new UserAuth();

$SESSION = new Session();

// $menu_id = 60;
$menu_id = 63;
$SessionUser = $SESSION->get_session_user();
$USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);
// pr($SessionUser);

	include"$path/meta.php";
	include"$path/header.php";
	include"$path/menu.php";
	

?>
	<script>
	jQuery(function($){
	   $("#tglPemeliharaanAwal,#tglPemeliharaanAkhir").mask('9999-99-99');
	   $("#tglPemeliharaanAwal,#tglPemeliharaanAkhir" ).datepicker({ dateFormat: 'yy-mm-dd' });
	   $("select").select2();
	});
	
	</script>
	<section id="main">
		<ul class="breadcrumb">
		  <li><a href="#"><i class="fa fa-home fa-2x"></i>  Home</a> <span class="divider"><b>&raquo;</b></span></li>
		  <li><a href="#">Pemeliharaan</a><span class="divider"></span></li>
		  <?php SignInOut();?>
		</ul>
		<div class="breadcrumb">
			<div class="title">Pemeliharaan</div>
			<div class="subtitle">Buat Data Pemeliharaan</div>
		</div>
		<!--<div class="grey-container shortcut-wrapper">
				<a class="shortcut-link active" href="<?=$url_rewrite?>/module/pemeliharaan/pemeliharaan_filter.php">
					<span class="fa-stack fa-lg">
				      <i class="fa fa-circle fa-stack-2x"></i>
				      <i class="fa fa-inverse fa-stack-1x">1</i>
				    </span>
					<span class="text">Buat Data Pemeliharaan</span>
				</a>
				<a class="shortcut-link " href="<?=$url_rewrite?>/module/pemeliharaan/">
					<span class="fa-stack fa-lg">
				      <i class="fa fa-circle fa-stack-2x"></i>
				      <i class="fa fa-inverse fa-stack-1x">2</i>
				    </span>
					<span class="text">Data Pemeliharaan</span>
				</a>
			</div>-->	
		<section class="formLegend">
			
		<form name="myform" method="post" action="<?=$url_rewrite?>/module/pemeliharaan/pemeliharaan_dftr_sp2d.php">
			<ul>
				<li>
					<span class="span2">Tanggal Awal Pemeliharaan</span>
					<input name="tglPemeliharaanAwal" id="tglPemeliharaanAwal" class=""  type="text" required>
				</li>
				<li>
					<span class="span2">Tanggal Akhir Pemeliharaan</span>
					<input name="tglPemeliharaanAkhir" id="tglPemeliharaanAkhir" class=""  type="text" required>
				</li>
				<?=selectSatker('kodeSatker','235',true,false,'required');?>
				<li>&nbsp;</li>
				<li>
					<span class="span2">&nbsp;</span>
					<input type="submit" class="btn btn-primary" value="Tampilkan Data" id="submit" />
					<input type="reset" name="reset" class="btn" value="Bersihkan Data">
				</li>
			</ul>
		</form>

		</section>     
	</section>
	
<?php
	include"$path/footer.php";
?>