<?php
	include "../../config/config.php";
	$menu_id = 64;

	$SessionUser = $SESSION->get_session_user();
	($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
	$USERAUTH->FrontEnd_check_akses_menu($menu_id, $Session);

	include"$path/meta.php";
	include"$path/header.php";
	include"$path/menu.php";
	$Penyusutan_ID =$_GET['idPenyusutan'];
	$Satker_ID =$_GET['satker'];
?>
	<script>
	jQuery(function($){
	   $("select").select2();
	   
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
				<a class="shortcut-link" href="<?=$url_rewrite?>/module/penyusutan/validasi_pnystn.php">
					<span class="fa-stack fa-lg">
				      <i class="fa fa-circle fa-stack-2x"></i>
				      <i class="fa fa-inverse fa-stack-1x">3</i>
				    </span>
					<span class="text">Validasi Penyusutan</span>
				</a>
			</div>		
		<section class="formLegend">
			
			<form method="POST" action="<?php echo"$url_rewrite"?>/module/penyusutan/dftr_penetapan_pnystn_filter.php?idPenyusutan=<?=$Penyusutan_ID?>&satker=<?=$Satker_ID?>">
				<ul>
					<li>
						<i>
						*)
						<u>
						Kosongkan isian 
						<strong class="blink_text_red">No Usulan</strong>
						untuk menampilkan seluruh Usulan
						</u>
						</i>
					</li>
					<li>&nbsp</li>
					<li>&nbsp</li>
					<li>
						<span class="span2">No Usulan</span>
						<input type="text" name="Usulan_ID">
					</li>  
						<input type="hidden" name="Penyusutan_ID" value="<?=$Penyusutan_ID?>" />
						<input type="hidden" name="Satker_ID" value="<?=$Satker_ID?>" />
					<li>
						<span class="span2">&nbsp;</span>
						<input type="submit" id="submit" name="submit" class="btn btn-primary" value="Tampilkan Data" />
						
						<input type="reset" name="reset" class="btn" value="Bersihkan Data">
					</li>
				</ul>
			</form>
			    
		</section> 
		
	</section>
	
<?php
	include"$path/footer.php";
?>