<?php
include "../../../config/config.php";
	// $menu_id = 62;
	$menu_id = 61;
	$SessionUser = $SESSION->get_session_user();
	($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
	$USERAUTH->FrontEnd_check_akses_menu($menu_id, $Session);
// pr($SessionUser);
include"$path/meta.php";
include"$path/header.php";
include"$path/menu.php";

?>

	<script type="text/javascript">
		jQuery(function($){
	   $("#Tahun").mask("9999");
	   $("select").select2();
	});
	</script>
	<section id="main">
		<ul class="breadcrumb">
			  <li><a href="#"><i class="fa fa-home fa-2x"></i>  Home</a> <span class="divider"><b>&raquo;</b></span></li>
			  <li><a href="#">Perencanaan</a><span class="divider"><b>&raquo;</b></span></li>
			  <li class="active">Rencana Pemeliharaan</li>
			  <?php SignInOut();?>
			</ul>
			<div class="breadcrumb">
				<div class="title">Rencana Pemeliharaan</div>
				<div class="subtitle">Buat Rencana Pemeliharaan</div>
			</div>	

			<div class="grey-container shortcut-wrapper">
				<a class="shortcut-link active" href="<?=$url_rewrite?>/module/perencanaan/rencana/prcn_pemeliharaan_filter_rev.php">
					<span class="fa-stack fa-lg">
				      <i class="fa fa-circle fa-stack-2x"></i>
				      <i class="fa fa-inverse fa-stack-1x">1</i>
				    </span>
					<span class="text">Buat Rencana Pemeliharaan</span>
				</a>
				<a class="shortcut-link " href="<?=$url_rewrite?>/module/perencanaan/rencana/prcn_pemeliharaan_filter_data_rev.php">
					<span class="fa-stack fa-lg">
				      <i class="fa fa-circle fa-stack-2x"></i>
				      <i class="fa fa-inverse fa-stack-1x">2</i>
				    </span>
					<span class="text">Data Rencana Pemeliharaan</span>
				</a>
			</div>		

		<section class="formLegendInve">
			<form name="myform" method="post" action="<?=$url_rewrite?>/module/perencanaan/rencana/prcn_pemeliharaan_dftr_aset_rev.php">
			<ul>
				<li>
					<span class="span2">Tahun Perolehan</span>
					<input name="Tahun" id="Tahun" class="span1"  type="text" required>
				</li>
				<?=selectSatker('kodeSatker','235',true,false,'required');?>
				<li>&nbsp;</li>
				<?php selectAset('kodeKelompok','235',true,false); ?>
				<li>&nbsp;</li>
				<li>
					<span class="span2">Kode Register</span>
					<input type="number" name="register_aw" id="" class="span1"  type="text" value = "1">
					s/d
					<input type="number" name="register_ak" id="" class="span1"  type="text" value = "1">
				</li>
				<li>
					<span class="span2">Tipe Aset</span>
					<select name="tipeAset" id="tipeAset" style="width:170px">
						<option value="tanah">Tanah</option>
						<option value="mesin">Mesin</option>
						<option value="bangunan">Bangunan</option>
						<option value="jaringan">Jaringan</option>
						<option value="asetlain">Aset Lain</option>
						<option value="kdp">KDP</option>
					</select>
				</li>
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

