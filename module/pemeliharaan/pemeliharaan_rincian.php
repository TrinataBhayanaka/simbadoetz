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
	$urlParam = $_GET['url'];
	$tmp = explode ('&',decode($urlParam));
	// pr(decode($urlParam));
	$pmlhrnid=explode('=',$tmp[0]);
	$satker=explode('=',$tmp[1]);
	// pr($pmlhrnid[1]);
	$idpmlrn = encode($pmlhrnid[1]);
	// pr($satker[1]);
	$skpd = encode($satker[1]);
    
	//informasi
	// $query = "select * from pemeliharaan where Pemeliharaan_ID ='$Pemeliharaan_ID'";
	// pr($queryTipe);
	// $exequery = $DBVAR->query($query);
	// $GetData = $DBVAR->fetch_array($exequery);
?>
	<script>
	jQuery(function($){
	   $("#Tahun").mask("9999");
	   $("select").select2();
	});
	function check(){
		var satker = document.getElementById("satker");
		// alert(satker);
		var satkerfilter = document.getElementById("kodeSatker");
		 if(satker.value != satkerfilter.value){
			alert('KodeSatker Harus Sama\n Dengan Filter KodeSatker Pemeliharaan');
			return false;
		}
	}
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
		<form name="myform" method="post" action="<?=$url_rewrite.'/module/pemeliharaan/pemeliharaan_dftr_rincian.php?id='.$idpmlrn.'&sk='.$skpd?>" onsubmit="return check(this)";>
			<ul>
				<li>
					<span class="span2">Tahun Perolehan</span>
					<input name="Tahun" id="Tahun" class="span1"  type="text" required>
				</li>
				<?=selectSatker('kodeSatker','235',true,false,'required');?>
				<input type="hidden" name="satker" id="satker" value="<?=$satker[1]?>">
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