<?php
include "../../config/config.php";

$PENGHAPUSAN = new RETRIEVE_PENGHAPUSAN;
$menu_id = 75;
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
			  <li><a href="#">Penghapusan</a><span class="divider"><b>&raquo;</b></span></li>
			  <li class="active">Daftar Aset Usulan Penghapusan Pemusnahan</li>
			  <?php SignInOut();?>
			</ul>
			<div class="	">
				<div class="title">Usulan Penghapusan Pemusnahan</div>
				<div class="subtitle">Buat Usulan</div>
			</div>	

		<div class="grey-container shortcut-wrapper">
				<a class="shortcut-link active" href="<?=$url_rewrite?>/module/penghapusanv2/dftr_usulan_pms.php">
					<span class="fa-stack fa-lg">
				      <i class="fa fa-circle fa-stack-2x"></i>
				      <i class="fa fa-inverse fa-stack-1x">1</i>
				    </span>
					<span class="text">Usulan Penghapusan</span>
				</a>
				<a class="shortcut-link" href="<?=$url_rewrite?>/module/penghapusanv2/dftr_penetapan_pms.php">
					<span class="fa-stack fa-lg">
				      <i class="fa fa-circle fa-stack-2x"></i>
				      <i class="fa fa-inverse fa-stack-1x">2</i>
				    </span>
					<span class="text">Penetapan Penghapusan</span>
				</a>
				<a class="shortcut-link" href="<?=$url_rewrite?>/module/penghapusanv2/dftr_validasi_pms.php">
					<span class="fa-stack fa-lg">
				      <i class="fa fa-circle fa-stack-2x"></i>
				      <i class="fa fa-inverse fa-stack-1x">3</i>
				    </span>
					<span class="text">Validasi Penghapusan</span>
				</a>
			</div>		

		<section class="formLegend">
			<form method="POST" ID="Form2" action="<?php echo "$url_rewrite/module/penghapusanv2/"; ?>tambah_usul_proses_pms.php"> 
			
			<div class="row">
				<ul>
					<?=selectSatker('SatkerUsul','260',true,false,'required');?>
					<br/>
					<li>
						<span  class="labelInfo span2">Jenis Penghapusan</span>
						<select  name="jenis_hapus" class="span3 " required="" width="100%">
			            <option value="" >Pilih Jenis Penghapusan</option>
			            <option value="hilang">Hilang</option>
			            <option value="pemusnahan">Pemusnahan</option>
			            <option value="alasan lain" >Alasan lain sesuai dengan ketentuan Perundang-undangan</option>
			          </select>
					</li>
					<li>&nbsp;</li>
					<li>&nbsp;</li>
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