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
	

?>
	<script>
	jQuery(function($){
	   $("#tglsp2d,#tglkontrak,#tglpemeliharaan").mask('9999-99-99');
	   $("#tglsp2d,#tglkontrak,#tglpemeliharaan" ).datepicker({ dateFormat: 'yy-mm-dd' });
	   $("select").select2();
	});
	
	</script>
	<section id="main">
		<ul class="breadcrumb">
		  <li><a href="#"><i class="fa fa-home fa-2x"></i>  Home</a> <span class="divider"><b>&raquo;</b></span></li>
		  <li><a href="#">Pemeliharaan</a><span class="divider"></span></li>
		  <?php SignInOut();?>
		</ul>
		<div class="breadcrumb">
			<div class="title">Pemeliharaan</div>
			<div class="subtitle">Filter Pemeliharaan</div>
		</div>
		<section class="formLegend">
			
		<form name="myform" method="post" action="<?=$url_rewrite?>/module/pemeliharaan/pemeliharaan_tambah_proses.php">
			<ul>
				<?=selectSatker('kodeSatker','235',true,false,'required');?>
				<li>&nbsp;</li>
				<li>
					<span class="span2">No.SP2D</span>
					<input name="nosp2d" id="" class=""  type="text" value="" required>
				</li>
				<li>
					<span class="span2">Tgl.SP2D</span>
					<input name="tglsp2d" id="tglsp2d" class=""  type="text" required>
				</li>
				<li>
					<span class="span2">No.Kontrak</span>
					<input name="nokontrak" id="" class=""  type="text" value="" >
				</li>
				<li>
					<span class="span2">Tgl.Kontrak</span>
					<input name="tglkontrak" id="tglkontrak" class=""  type="text">
				</li>
				<li>
					<span class="span2">Nama Penyedia Jasa</span>
					<input name="namaPenyedia" id="" class=""  type="text" value="" >
				</li>
				<li>
					<span class="span2">Tgl.Pemeliharaan</span>
					<input name="tglpemeliharaan" id="tglpemeliharaan" class=""  type="text">
				</li>
				<li>
					<span class="span2">Keterangan</span>
					<textarea style="width:; height:;" name="keterangan" class="" ></textarea>
				</li>
				
				<li>
					<span class="span2">&nbsp;</span>
					<input type="submit" class="btn btn-primary" value="Simpan" id="submit" />
					<input type="reset" name="reset" class="btn" value="Bersihkan Data">
					<input type="hidden" name="urlParam" class="" value="<?=$_GET['url']?>">
					<input type="hidden" name="createddate" class="" value="<?=date('Y-m-d')?>">
					<input type="hidden" name="userNm" class="" value="<?=$SessionUser['ses_uoperatorid']?>">
				</li>
			</ul>
		</form>

		</section>     
	</section>
	
<?php
	include"$path/footer.php";
?>