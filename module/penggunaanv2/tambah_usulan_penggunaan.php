<?php
include "../../config/config.php";

$PENGHAPUSAN = new RETRIEVE_PENGGUNAAN;
$menu_id = 76;
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
			  <li><a href="#">Penggunaan</a><span class="divider"><b>&raquo;</b></span></li>
			  <li class="active">Daftar Penetapan Penggunaan</li>
			  <?php SignInOut();?>
		</ul>
			<div class="breadcrumb">
				<div class="title">Penetapan Penggunaan</div>
				<div class="subtitle">Daftar Penetapan Penggunaan</div>
			</div>	

		<div class="grey-container shortcut-wrapper">
			<a class="shortcut-link active" href="<?=$url_rewrite?>/module/penggunaanv2/dftr_usulan_pmd.php">
				<span class="fa-stack fa-lg">
			      <i class="fa fa-circle fa-stack-2x"></i>
			      <i class="fa fa-inverse fa-stack-1x">1</i>
			    </span>
				<span class="text">Penetapan Penggunaan</span>
			</a>
			<a class="shortcut-link" href="<?=$url_rewrite?>/module/penggunaanv2/dftr_validasi_pmd.php">
				<span class="fa-stack fa-lg">
			      <i class="fa fa-circle fa-stack-2x"></i>
			      <i class="fa fa-inverse fa-stack-1x">2</i>
			    </span>
				<span class="text">Validasi Penggunaan</span>
			</a>
		</div>				  	

		<section class="formLegend">
			<form method="POST" ID="Form2" action="<?php echo "$url_rewrite/module/penggunaanv2/"; ?>tambah_usul_proses_penggunaan.php"> 
			
			<div class="row">
				<ul>
					<li>
						<span  class="labelInfo span2">No Penetapan</span>
						<input type="text" class="span3" name="NoSKKDH" value="" required/>
					</li>
					<li>
						<span  class="labelInfo span2">Tanggal Penetapan</span>
						<input name="TglSKKDH" class="span3" type="text" id="datepicker" <?php echo $disabledForm;?> required/>
					</li>
					
					<li>
						<span class="labelInfo span2">Keterangan Penetapan</span>
						<textarea rows="3" class="span3" cols="100" name="Keterangan" required ></textarea>
					</li>
					<input type="hidden" name="UserNm" value="<?=$_SESSION['ses_uoperatorid']?>">
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