<?php
include "../../config/config.php";

$USERAUTH = new UserAuth();
$SESSION = new Session();
$menu_id = 16;
$SessionUser = $SESSION->get_session_user();
$USERAUTH->FrontEnd_check_akses_menu($menu_id,$SessionUser);
?>

<?php
	include"$path/meta.php";
	include"$path/header.php";
	include"$path/menu.php";
	
?>

<link href="<?php echo "$url_rewrite/"; ?>css/jquery-ui.css" type="text/css" rel="stylesheet">
<script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/jquery-ui.min.js"></script> 
<script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/jquery.ui.datepicker-id.js"></script>
<script type="text/javascript" src="<?php echo "$url_rewrite"?>/JS/tabel.js"></script>
<script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/ajax_checkbox.js"></script>

<script>
$(function()
{
	$('#tanggal1').datepicker($.datepicker.regional['id']);
}
);
<!-- end TAnggal-->
</script>  
  
	<section id="main">
		<ul class="breadcrumb">
		  <li><a href="#"><i class="fa fa-home fa-2x"></i>  Home</a> <span class="divider"><b>&raquo;</b></span></li>
		  <li><a href="#">Gudang</a><span class="divider"><b>&raquo;</b></span></li>
		  <li class="active">Validasi Distribusi Barang </li>
		  <?php SignInOut();?>
		</ul>
		<div class="breadcrumb">
			<div class="title">Validasi Distribusi Barang </div>
			<div class="subtitle">Filter Data</div>
		</div>
		<section class="formLegend">
			
			<form action='gudang_validasi_daftar.php?pid=1' method='post' name='formvalid'>
			<ul>
							<li>
								<span class="span2">Tanggal Distribusi</span>
								<input id="tanggal1" type="text" name="gdg_tglpengeluaran" style="width:150px;">
							</li>
							<li>
								<span class="span2">Nomor Dokumen</span>
								<input type="text" name="gdg_nomorpengeluaran" style="width:150px;">
							</li>
							<li>
								<span class="span2">Transfer ke SKPD </span>
								<div class="input-append">
										<input type="hidden" name="idgetkelompok" id="idgetkelompok" value="">
										<input type="text" name="lda_skpd" id="lda_skpd" class="span5" readonly="readonly" value="<?php echo $_SESSION['ses_satkername'] ; ?>">
										<input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" class="btn" value="Pilih" onclick = "showSpoiler(this);">
										<div class="inner" style="display:none;">
										<?php

										//include "$path/function/dropdown/function_skpd.php";
										$alamat_simpul_skpd="$url_rewrite/function/dropdown/radio_simpul_skpd.php";
										$alamat_search_skpd="$url_rewrite/function/dropdown/radio_search_skpd.php";
										js_radioskpd($alamat_simpul_skpd, $alamat_search_skpd,"lda_skpd","skpd_id",'skpd','sk');
										$style2="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
										radiopengadaanskpd($style2,"skpd_id",'skpd','sk');
										?>

											</div>
								</div>
							</li>
							<li>
								<span class="span2">&nbsp;</span>
								<input type="submit" name="Lanjut" class="btn btn-primary" value="Tampilkan Data" />
								<input type="reset" name="reset" class="btn" value="Bersihkan Data">
							</li>
						</ul>
						
						</form>
			
		</section>     
	</section>
	
<?php
	include"$path/footer.php";
?>