<?php
include "../../config/config.php";

$USERAUTH = new UserAuth();

$SESSION = new Session();

$menu_id = 59;
$SessionUser = $SESSION->get_session_user();
$USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);

	include"$path/meta.php";
	include"$path/header.php";
	include"$path/menu.php";
	
if (isset($_POST['post'])){
	unset($_SESSION['ses_filter_ruangan_kir']);
	$_SESSION['ses_filter_ruangan_kir'] = $_POST;
	redirect($url_rewrite.'/module/kir/dftr_ruangan_export.php');	
}
?>
	<script>
	jQuery(function($){
	   $("#Tahun,#Tahun2").mask("9999");
	   $("#kodeLokasi").mask("99.99.99.99.99.99.99.99");
	   $("select").select2();
	});
	
	function check_tahun(){
		var tahun_tujuan = document.getElementById("Tahun2");
		var tahun_asal = document.getElementById("Tahun");
		if (tahun_asal.value == tahun_tujuan.value)
		{
			alert('Tahun tidak boleh sama');
			$('#export').attr('disabled','disabled');
            $('#export').css("background","grey");
			
		}
		else if(tahun_asal.value > tahun_tujuan.value){
			alert('Tahun Asal tidak boleh\nlebih besar dari Tahun Asal');
			$('#export').attr('disabled','disabled');
            $('#export').css("background","grey");
		}
		else{
			$('#export').removeAttr('disabled');
		    $('#export').css("background","#04c");
		}
		
	}
	</script>
	<section id="main">
		<ul class="breadcrumb">
		  <li><a href="#"><i class="fa fa-home fa-2x"></i>  Home</a> <span class="divider"><b>&raquo;</b></span></li>
		  <li><a href="#">KIR</a><span class="divider"></span></li>
		  <?php SignInOut();?>
		</ul>
		<div class="breadcrumb">
			<div class="title">Daftar Ruangan UPB</div>
			<div class="subtitle">Filter Ruangan</div>
		</div>
		<div class="grey-container shortcut-wrapper">
				<a class="shortcut-link " href="<?=$url_rewrite?>/module/kir/filter_ruangan.php">
					<span class="fa-stack fa-lg">
				      <i class="fa fa-circle fa-stack-2x"></i>
				      <i class="fa fa-inverse fa-stack-1x">1</i>
				    </span>
					<span class="text">Daftar Ruangan UPB</span>
				</a>
				<a class="shortcut-link active" href="<?=$url_rewrite?>/module/kir/filter_ruangan_export.php">
					<span class="fa-stack fa-lg">
				      <i class="fa fa-circle fa-stack-2x"></i>
				      <i class="fa fa-inverse fa-stack-1x">2</i>
				    </span>
					<span class="text">Export Ruangan</span>
				</a>
				<a class="shortcut-link" href="<?=$url_rewrite?>/module/kir/filter_ruangan_kir.php">
					<span class="fa-stack fa-lg">
				      <i class="fa fa-circle fa-stack-2x"></i>
				      <i class="fa fa-inverse fa-stack-1x">3</i>
				    </span>
					<span class="text">KIR</span>
				</a>
			</div>		
		
		<section class="formLegend">
		<form name="myform" method="post" action="">
			<ul>
				<?php //selectTahun('Tahun','235',true,false,false); ?>
				<li>
					<span class="span2">Tahun Ruangan Asal</span>
					<input name="Tahun" id="Tahun" class="span1"  type="text" required>
				</li>
				<li>
					<span class="span2">Tahun Ruangan Tujuan</span>
					<input name="Tahun2" id="Tahun2" class="span1"  type="text" onblur="return check_tahun(this);" required>
				</li>
				<?=selectSatker('kodeSatker','235',true,false,'required');?>
				<br>
				<li>
					<span class="span2">&nbsp;</span>
					<input type="submit" class="btn btn-primary" id= "export" value="Tampilkan Data" name="post"/>
					<input type="reset" name="reset" class="btn" value="Bersihkan Data">
				</li>
			</ul>
		</form>

		</section>     
	</section>
	
<?php
	include"$path/footer.php";
?>