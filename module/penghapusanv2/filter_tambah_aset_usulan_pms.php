<?php
include "../../config/config.php";
$menu_id = 75;
$SessionUser = $SESSION->get_session_user();
($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->	get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
$USERAUTH->FrontEnd_check_akses_menu($menu_id, $Session);

include"$path/meta.php";
include"$path/header.php";
include"$path/menu.php";

?>

	<script>
	jQuery(function($){
	   $("select").select2();
	   $("#bup_tahun").mask('9999');
	});
	</script>
	<section id="main">
		<ul class="breadcrumb">
			  <li><a href="#"><i class="fa fa-home fa-2x"></i>  Home</a> <span class="divider"><b>&raquo;</b></span></li>
			  <li><a href="#">Penghapusan</a><span class="divider"><b>&raquo;</b></span></li>
			  <li class="active">Daftar Usulan Penghapusan Pemusnahan</li>
			  <?php SignInOut();?>
			</ul>
			<div class="breadcrumb">
				<div class="title">Usulan Penghapusan Pemusnahan</div>
				<div class="subtitle">Filter Aset Data </div>
			</div>	

		<div class="grey-container shortcut-wrapper">
				<a class="shortcut-link active" href="<?=$url_rewrite?>/module/penghapusanv2/dftr_usulan_pms.php">
					<span class="fa-stack fa-lg">
				      <i class="fa fa-circle fa-stack-2x"></i>
				      <i class="fa fa-inverse fa-stack-1x">1</i>
				    </span>
					<span class="text">Usulan Penghapusan</span>
				</a>
				<a class="shortcut-link" href="<?=$url_rewrite?>/module/penghapusanv2/dftr_penetapan_pms.php">
					<span class="fa-stack fa-lg">
				      <i class="fa fa-circle fa-stack-2x"></i>
				      <i class="fa fa-inverse fa-stack-1x">2</i>
				    </span>
					<span class="text">Penetapan Penghapusan</span>
				</a>
				<a class="shortcut-link" href="<?=$url_rewrite?>/module/penghapusanv2/dftr_validasi_pms.php">
					<span class="fa-stack fa-lg">
				      <i class="fa fa-circle fa-stack-2x"></i>
				      <i class="fa fa-inverse fa-stack-1x">3</i>
				    </span>
					<span class="text">Validasi Penghapusan</span>
				</a>
			</div>		

		<section class="formLegend">
			
	<form method="POST" action="<?php echo"$url_rewrite"?>/module/penghapusanv2/dftr_aset_usulan_pms.php">
			<ul>
				<li>&nbsp;</li>
				<li><i>*) <u>cukup isi field <strong class="blink_text_red" >Tipe Aset</strong> & <strong class="blink_text_red">Kode Satker</strong> untuk menampilkan seluruh data </u></i></li>
				<li>&nbsp;</li>
				<li>
					<span class="span2">Tahun Perolehan</span>
					<input type='text' id="bup_tahun" maxlength="4" name="bup_tahun" placeholder="" />
				</li>
				<li>&nbsp;</li>
				<li>

					<span class="span2">Kode Pemilik</span>
					<select id="kodepemilik" name="kodepemilik" style="width:255px" class="full">
						<option value="00">00 Pemerintah Pusat</option>
						<option value="11">11 Pemerintah Provinsi</option>
						<option value="12" selected>12 Pemerintah Kabupaten/Kota</option>
						<option value="13">13 Pemerintah Provinsi Lain</option>
						<option value="14">14 Pemerintah Kabupaten/Kota Lain</option>
						<option value="15">15 Non Pemerintah</option>
					</select>

                </li>  
                <li>&nbsp;</li>

				<?php selectAset('kodeKelompok','235',true,false); ?>

                <li>&nbsp;</li>
				<li>

					<span class="span2">Tipe Aset</span>
					<select name="jenisaset" style="width:170px" id="jenisaset" required="">

						<option value="">Pilih Tipe Aset</option>
						<option value="1">Tanah</option>
						<option value="2">Mesin</option>
						<option value="3">Bangunan</option>
						<option value="4">Jaringan</option>
						<option value="5">Aset Tetap Lain</option>
						<option value="6">KDP</option>
					</select>
				 </li>  
                <li>&nbsp;</li>
				<?=selectSatker('kodeSatker','250',true,false,'required');?>
                <li>&nbsp;</li>
				<li>
				<span class="span2">&nbsp;</span>
				<input type="submit" name="submit" class="btn btn-primary" value="Tampilkan Data" />
				<!--<input type="hidden" name="filterAsetUsulan" value="1" />-->
				<input type="hidden" name="usulanID" value="<?=$_GET[usulanID]?>" />
				<input type="reset" name="reset" class="btn" value="Bersihkan Data">
				</li>
			</ul>
		</form>	    
		</section> 
		
	</section>
	
<?php
	include"$path/footer.php";
?>