<?php
	include "../../config/config.php";
	$menu_id = 64;

	$SessionUser = $SESSION->get_session_user();
	($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
	$USERAUTH->FrontEnd_check_akses_menu($menu_id, $Session);

	include"$path/meta.php";
	include"$path/header.php";
	include"$path/menu.php";
	$Usulan_ID =$_GET['idUsulan'];
	$Satker_ID =$_GET['satker'];
	
	$PENYUSUTAN = new RETRIEVE_PENYUSUTAN;
	$data_delete=$PENYUSUTAN->apl_userasetlistHPS_del("USULASET");
?>
	<script>
	jQuery(function($){
	   $("select").select2();
	   
	});
	function check (){
			var kodeKelompok = document.getElementById("kodeKelompok").value;
			var split_str = kodeKelompok.split(".");
			var kodeKelompokSplit = split_str[0];
			// alert(kodeKelompok);
			if(kodeKelompok == ''){
				alert('Pilih Jenis Aset');
				return false;
			}else if(kodeKelompokSplit == '01' || kodeKelompokSplit == '05' || kodeKelompokSplit == '06' || kodeKelompokSplit == '07' || kodeKelompokSplit == '08'){
				alert('Pilih Jenis Aset Yang Sesuai');
				return false;
			}
	   }
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
				<a class="shortcut-link active" href="<?=$url_rewrite?>/module/penyusutan/dftr_usulan_pnystn.php">
					<span class="fa-stack fa-lg">
				      <i class="fa fa-circle fa-stack-2x"></i>
				      <i class="fa fa-inverse fa-stack-1x">1</i>
				    </span>
					<span class="text">Usulan Penyusutan</span>
				</a>
				<a class="shortcut-link" href="<?=$url_rewrite?>/module/penyusutan/dftr_penetapan_pnystn.php">
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
			
			<form method="POST" action="<?php echo"$url_rewrite"?>/module/penyusutan/dftr_usulan_pnystn_filter.php?idUsulan=<?=$Usulan_ID?>&satker=<?=$Satker_ID?>" onsubmit="return check(this)">
				<ul>
					<?php //selectAset('kodeKelompok','235',true,false); ?>
					<!--<li>&nbsp;</li>-->
					
					<?php selectAllAset('kodeKelompok','235',true,false); ?>
					<li>&nbsp;</li>
					
					<li>
						<span class="span2">Penyusutan</span>
						<select name="flagPnystn" style="width:250px" id="jenisaset">
							<option value="1" selected>Penyusutan Tahun Pertama (<?=date('Y')?>)</option>
							<option value="2" >Penyusutan Tahun Selanjutnya</option>
						</select>
					</li>  
					<!--<li>
						<span class="span2">Tipe Aset</span>
						<select name="jenisaset[]" style="width:170px" id="jenisaset">
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
					<?//=selectSatker('kodeSatker',$width='205',$br=true,false);?>-->
					<li>&nbsp;</li>
						<input type="hidden" name="Usulan_ID" value="<?=$Usulan_ID?>" />
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