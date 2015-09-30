<?php
	include "../../config/config.php";
	$menu_id = 64;

	$SessionUser = $SESSION->get_session_user();
	($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
	$USERAUTH->FrontEnd_check_akses_menu($menu_id, $Session);
	
	include"$path/meta.php";
	include"$path/header.php";
	include"$path/menu.php";
?>
	<script>
	jQuery(function($){
	   $("select").select2();
	   $("#TglPenyusutan").mask('9999-99-99');
	   $("#TglPenyusutan" ).datepicker({ dateFormat: 'yy-mm-dd' });
	});
	$(document).on('change', '#kodeSatker', function (){
	   if($("#kodeSatker").val() != ""){	
			$.post('<?=$url_rewrite?>/function/api/cekpenetapanpenyusutan.php', {kodesatker:$("#kodeSatker").val(),tahun:$("#tahun").val()}, function(data){
			// alert(data);
			if(data != 0){
				 alert("Anda Telah Membuat \n Lebih dari satu Penetapan di Tahun yang sama");
				 $('#simpan').attr("disabled","disabled");
			}else{
				$("#simpan").removeAttr("disabled");
			}
		})
		}
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
				<a class="shortcut-link" href="<?=$url_rewrite?>/module/penyusutan/dftr_usulan_pnystn.php">
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
			<form method="POST" action="<?php echo"$url_rewrite"?>/module/penyusutan/proses_penetapan_pynstn.php" onsubmit="return requiredFilterHPS(1,1, 'kodeSatker')">
				<ul>
					<li>&nbsp;</li>
						<?=selectSatker('kodeSatker',$width='205',$br=true,false);?>
					<li>&nbsp;</li>
					<li>
						<span class="span2">No Penetapan</span>
						<input type="text" class="" name="NoSKPenyusutan" id="NoSKPenyusutan"/ required>
					</li>
					<li>
						<span class="span2">Tanggal Penetapan</span>
						<input type="text" class="" name="TglPenyusutan" id="TglPenyusutan"/ required>
					</li>
					<li>
						<span class="span2">Keterangan Penetapan</span>
						<textarea name="AlasanPenyusutan" ></textarea>
					</li>
						<input type="hidden" name="UserNm" value="<?=$_SESSION['ses_uoperatorid']?>">
						<input type="hidden" name="FixPenyusutan" value="1">
						<input type="hidden" id= "tahun" name="Tahun" value=<?=date('Y')?>>
					<li>
						<span class="span2">&nbsp;</span>
						<input type="submit" name="simpan" id="simpan" class="btn btn-primary" value="Simpan" />
						<a href="javascript:history.back()"><input type="button" name="batal" class="btn" value="Batal" ></a>
					</li>
				</ul>
			</form>
		</section> 
	</section>
	
<?php
	include"$path/footer.php";
?>