<?php
include "../../config/config.php";

$USERAUTH = new UserAuth();

$SESSION = new Session();

$menu_id = 73;
$SessionUser = $SESSION->get_session_user();
$USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);

include"$path/meta.php";
include"$path/header.php";
include"$path/menu.php";
?>
	<script>
	jQuery(function($){
	   $("#tahunawal,#tahuntujuan").mask("9999");
	   $("select").select2();
	});
	function check_tahun(){
		var tahun_tujuan = document.getElementById("tahuntujuan");
		var tahun_asal = document.getElementById("tahunawal");
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
		  <li><a href="#">Pejabat</a><span class="divider"></span></li>
		  <?php SignInOut();?>
		</ul>
		<div class="breadcrumb">
			<div class="title">Daftar Pejabat</div>
			<div class="subtitle">Filter Pejabat</div>
		</div>
		<div class="grey-container shortcut-wrapper">
				<a class="shortcut-link " href="<?=$url_rewrite?>/module/pejabat/">
					<span class="fa-stack fa-lg">
				      <i class="fa fa-circle fa-stack-2x"></i>
				      <i class="fa fa-inverse fa-stack-1x">1</i>
				    </span>
					<span class="text">Daftar Pejabat</span>
				</a>
				<a class="shortcut-link active"  href="<?=$url_rewrite?>/module/pejabat/export.php">
					<span class="fa-stack fa-lg">
				      <i class="fa fa-circle fa-stack-2x"></i>
				      <i class="fa fa-inverse fa-stack-1x">2</i>
				    </span>
					<span class="text">Export Pejabat</span>
				</a>
			</div>		
		
		<section class="formLegend">
		<form name="myform" method="post" action="exppejabat.php">
			<ul>
				<li>
					<span class="span2">Tahun Asal</span>
					<input name="tahunawal" id="tahunawal" class="span1"  type="text" required>
				</li>

				<li>
					<span class="span2">Tahun Tujuan</span>
					<input name="tahuntujuan" id="tahuntujuan" class="span1"  type="text" onblur="return check_tahun(this);" required>
				</li>
				<?=selectSatker('kodeSatker','235',true,false,'required');?>
				<br>
				<li>
					<span class="span2">&nbsp;</span>
					<input type="submit" class="btn btn-primary" id= "export"
					value="export" name="submit"/>
					<input type="reset" name="reset" class="btn" value="Bersihkan Data">
				</li>
			</ul>
		</form>

		</section>     
	</section>
	
<?php
	include"$path/footer.php";
?>