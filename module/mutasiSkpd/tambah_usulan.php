<?php
include "../../config/config.php";

//$PENGHAPUSAN = new RETRIEVE_PENGHAPUSAN;
$menu_id = 78;
$SessionUser = $SESSION->get_session_user();
($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
$USERAUTH->FrontEnd_check_akses_menu($menu_id, $Session);

include"$path/meta.php";
include"$path/header.php";
include"$path/menu.php";
	
?>

	<script>
        $(function()
        {
       		$('#tanggal1').datepicker($.datepicker.regional['id']);
       		$("select").select2();

        });
	</script>
	<section id="main">
		<ul class="breadcrumb">
			  <li><a href="#"><i class="fa fa-home fa-2x"></i>  Home</a> <span class="divider"><b>&raquo;</b></span></li>
			  <li><a href="#">Transfer SKPD</a><span class="divider"><b>&raquo;</b></span></li>
			  <li class="active">Daftar Usulan Transfer SKPD</li>
			  <?php SignInOut();?>
			</ul>
			<div class="breadcrumb">
				<div class="title">Usulan Transfer SKPD</div>
				<div class="subtitle">Input Usulan Transfer SKPD</div>
			</div>	

		<div class="grey-container shortcut-wrapper">
				<a class="shortcut-link active" href="<?=$url_rewrite?>/module/mutasiSkpd/list_usulan.php">
					<span class="fa-stack fa-lg">
				      <i class="fa fa-circle fa-stack-2x"></i>
				      <i class="fa fa-inverse fa-stack-1x">1</i>
				    </span>
					<span class="text">Usulan Transfer SKPD</span>
				</a>
				<a class="shortcut-link" href="<?=$url_rewrite?>/module/mutasiSkpd/list_penetapan.php">
					<span class="fa-stack fa-lg">
				      <i class="fa fa-circle fa-stack-2x"></i>
				      <i class="fa fa-inverse fa-stack-1x">2</i>
				    </span>
					<span class="text">Penetapan Transfer SKPD</span>
				</a>
				<a class="shortcut-link" href="<?=$url_rewrite?>/module/mutasiSkpd/list_validasi.php">
					<span class="fa-stack fa-lg">
				      <i class="fa fa-circle fa-stack-2x"></i>
				      <i class="fa fa-inverse fa-stack-1x">3</i>
				    </span>
					<span class="text">Validasi Transfer SKPD</span>
				</a>
			</div>		

		<section class="formLegend">
			<form method="POST" ID="Form2" action="<?php echo "$url_rewrite/module/mutasiSkpd/"; ?>usul_proses.php"> 
			
			<div class="row">
				<ul>
					<?=selectSatker('SatkerUsul','260',true,false,'required','Kode Satker Asal');?>
					<br/>
					<?=selectAllSatker('SatkerTujuan','260',true,false,'required',false,1,'Kode Satker Tujuan');?>
					<br/>
					<li>
						<span  class="labelInfo span2">No Usulan</span>
						<input type="text" class="span3" name="NoUsulan" value="" required/>
					</li>
					<li>
						<span  class="labelInfo span2">Tanggal Usulan</span>
						<input name="TglUpdate" class="span3" type="text" id="datepicker" <?php echo $disabledForm;?> required/>
					</li>
					<li>
						<span class="labelInfo span2">Keterangan usulan</span>
						<textarea rows="3" class="span3" cols="100" name="KetUsulan" required ></textarea>
					</li>
					<li>
						<span class="labelInfo span2">&nbsp;</span>
						<input  class="btn btn-primary" type="submit" name="submit" value="simpan">
					</li>
				</ul>			
			</div>
			</form>
			<div class="spacer"></div>
			    
		</section> 
		     
	</section>
	
<?php
	include"$path/footer.php";
?>