<?php
	include "../../config/config.php";
	$menu_id = 64;

	$SessionUser = $SESSION->get_session_user();
	($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
	$USERAUTH->FrontEnd_check_akses_menu($menu_id, $Session);
	
	include"$path/meta.php";
	include"$path/header.php";
	include"$path/menu.php";
	
	$id = $_GET['id'];
	$PENYUSUTAN = new RETRIEVE_PENYUSUTAN;
	$data = $PENYUSUTAN->editData($id);
?>
	<script>
	jQuery(function($){
	   $("select").select2();
	   $("#TglUpdate").mask('9999-99-99');
	   $("#TglUpdate" ).datepicker({ dateFormat: 'yy-mm-dd' });

	});
	</script>
	<section id="main">
		<ul class="breadcrumb">
			  <li><a href="#"><i class="fa fa-home fa-2x"></i>  Home</a> <span class="divider"><b>&raquo;</b></span></li>
			  <li><a href="#">Penghapusan</a><span class="divider"><b>&raquo;</b></span></li>
			  <li class="active">Daftar Usulan Penyusutan</li>
			  <?php SignInOut();?>
			</ul>
			<div class="breadcrumb">
				<div class="title">Usulan Penghapusan Penyusutan</div>
				<div class="subtitle">Filter Aset Data </div>
			</div>	

		<div class="grey-container shortcut-wrapper">
				<a class="shortcut-link " href="<?=$url_rewrite?>/module/penyusutan/dftr_usulan_pnystn.php">
					<span class="fa-stack fa-lg">
				      <i class="fa fa-circle fa-stack-2x"></i>
				      <i class="fa fa-inverse fa-stack-1x">1</i>
				    </span>
					<span class="text">Usulan Penyusutan</span>
				</a>
				<a class="shortcut-link active" href="<?=$url_rewrite?>/module/penyusutan/dftr_penetapan_pnystn.php">
					<span class="fa-stack fa-lg">
				      <i class="fa fa-circle fa-stack-2x"></i>
				      <i class="fa fa-inverse fa-stack-1x">2</i>
				    </span>
					<span class="text">Penetapan Penyusutan</span>
				</a>
				<a class="shortcut-link" href="<?=$url_rewrite?>/module/penyusutan/.php">
					<span class="fa-stack fa-lg">
				      <i class="fa fa-circle fa-stack-2x"></i>
				      <i class="fa fa-inverse fa-stack-1x">3</i>
				    </span>
					<span class="text">Validasi Penyusutan</span>
				</a>
			</div>	
		<section class="formLegend">
			<form method="POST" action="<?php echo"$url_rewrite"?>/module/penyusutan/proses_usulan_pynstn_edit.php" onsubmit="return requiredFilterHPS(1,1, 'kodeSatker')">
				<ul>
					<li>&nbsp;</li>
						<?=selectSatker('kodeSatker','205',true,$data['SatkerUsul'],'required');?>
					<li>&nbsp;</li>
					<li>
						<span class="span2">No Usulan</span>
						<input type="text" class="" name="noUsulan" id="noUsulan"/ required value="<?=$data['NoUsulan']?>">
					</li>
					<li>
						<span class="span2">Tanggal Usulan</span>
						<input type="text" class="" name="TglUpdate" id="TglUpdate"/ required value="<?=$data['TglUpdate']?>">
					</li>
					<li>
						<span class="span2">Keterangan usulan</span>
						<textarea name="KetUsulan" ><?=$data['KetUsulan']?></textarea>
					</li>
						<input type ="hidden" name="idUsulan" value="<?=$data['Usulan_ID']?>">
					<li>
						<span class="span2">&nbsp;</span>
						<input type="submit" name="simpan" class="btn btn-primary" value="Simpan" />
						<a href="javascript:history.back()"><input type="button" name="batal" class="btn" value="Batal" ></a>
					</li>
				</ul>
			</form>
		</section> 
	</section>
	
<?php
	include"$path/footer.php";
?>