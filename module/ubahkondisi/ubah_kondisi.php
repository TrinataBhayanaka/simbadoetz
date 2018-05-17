<?php
include "../../config/config.php";

$USERAUTH = new UserAuth();

$SESSION = new Session();

$menu_id = 67;
$SessionUser = $SESSION->get_session_user();
$USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);

	include"$path/meta.php";
	include"$path/header.php";
	include"$path/menu.php";
?>
	<script>
	jQuery(function($){
	   $("#Tahun").mask("9999");
	   $("#kodeLokasi").mask("99.99.99.99.99.99.99.99");
	   $("select").select2();
	});
	</script>
	<section id="main">
		<ul class="breadcrumb">
		  <li><a href="#"><i class="fa fa-home fa-2x"></i>  Home</a> <span class="divider"><b>&raquo;</b></span></li>
		  <li><a href="#">Koreksi</a><span class="divider"><b>&raquo;</b></span></li>
		  <li class="active">Ubah Kondisi</li>
		  <?php SignInOut();?>
		</ul>
		<div class="breadcrumb">
			<div class="title">Ubah Kondisi Aset</div>
			<div class="subtitle">Filter Data</div>
		</div>
		<section class="formLegend">
			
		<form name="myform" method="post" action="dftr_aset.php">
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
					<span class="span2">Kode Registrasi</span>
					<input type="number" name="noRegister_Akhir" class="span1" value=''/>
				</li>
				<li>
					<span class="span2"></span>
					*)Sampai Kode Registrasi Yang Dipilih
				</li>
				<li>&nbsp;</li>
				<li>
					<span class="span2">Jenis Aset</span>
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
					<span class="span2">Kondisi</span>
					<select name="kondisi" style="width:155px" >
						<option value="1">Baik</option>
						<option value="2">Rusak Ringan</option>
						<option value="3">Rusak Berat</option>
						<option value="4">Non Aktif</option>
					</select>
				</li>
				<li>&nbsp;</li>
				<li>
					<span class="span2">&nbsp;</span>
					<input type="submit" class="btn btn-primary" value="Tampilkan Data" />
					<input type="reset" name="reset" class="btn" value="Bersihkan Data">
				</li>
			</ul>
		</form>

		</section>     
	</section>
	
<?php
	include"$path/footer.php";
?>