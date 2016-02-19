 
<?php
include "../../config/config.php";
include"$path/meta.php";
include"$path/header.php";
include"$path/menu.php";
	
$menu_id = 1;
$SessionUser = $SESSION->get_session_user();
($SessionUser['ses_uid'] != '') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title' => 'GuestMenu', 'ses_name' => 'menu_without_login'));
$USERAUTH->FrontEnd_check_akses_menu($menu_id, $Session);
	
?>
<script type="text/javascript">
  	$(document).ready(function(){

       	$("#lda_tp").keypress(function (e)  
       	{
            if( e.which!=8 && e.which!=0 && (e.which<48 || e.which>57))
            {
                 $("#errmsg3").html("Hanya Bisa Input Angka").show().fadeOut("slow"); 
                 return false;
            }	
       	});

  	});

	$( "#lda_tp" ).mask('9999'); 
</script>

	<section id="main">
		<ul class="breadcrumb">
		  <li><a href="#"><i class="fa fa-home fa-2x"></i>  Home</a> <span class="divider"><b>&raquo;</b></span></li>
		  <li><a href="#">Layanan Umum</a><span class="divider"><b>&raquo;</b></span></li>
		  <li class="active">Pemeriksaan Aset</li>
		  <?php SignInOut();?>
		</ul>
		<div class="breadcrumb">
			<div class="title">Pemeriksaan Aset</div>
			<div class="subtitle">Filter Pemeriksaan</div>
		</div>
		
		<section class="formLegend">
			<form name="lda_filter" action="<?php echo "$url_rewrite/module/layanan/"; ?>pemeriksaan_filter_hasil.php?pid=1" method="post" onsubmit="return requiredFilter(0,1, 'kodeSatker')">
				<ul>
					<li>
						<span class="span2">Tahun Perolehan</span>
						<input name="Tahun" id="lda_tp" class="span2"  type="text" required placeholder="2015" maxlength="4">
					</li>
						<?php selectSatker('kodeSatker','255',true,false); ?>
						<br>
						<?php selectAset('kodeKelompok','255',true,false,'required'); ?>
						<br>
					<li>
						<span class="span2">Nomor Register Terakhir</span>
						<input name="noRegister" id="" class="span2"  type="text" required placeholder="Example : 10" maxlength="4">
					</li>
					<li>
						<span class="span2"><input type='submit' value='Lanjut'  name="submit" class="btn btn-primary"></span>
						<input type="hidden" name="modul" value="pemeriksaan">
					</li>
				</ul>
			</form>
		</section>     
	</section>
	
<?php
	include"$path/footer.php";
?>
<script>
	$(document).on('submit', function(){
		var kode = $("#satker1").val();
		if(kode==""){
			alert("pilih satker dulu");
			return false;
		}
	});
</script>
