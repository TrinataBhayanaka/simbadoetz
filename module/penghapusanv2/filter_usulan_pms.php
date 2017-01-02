<?php
include "../../config/config.php";
$menu_id = 75;
            $SessionUser = $SESSION->get_session_user();
            ($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
            $USERAUTH->FrontEnd_check_akses_menu($menu_id, $Session);


	include"$path/meta.php";
	include"$path/header.php";
	include"$path/menu.php";

?>
	<!-- End Sql --> 
	<section id="main">
		<ul class="breadcrumb">
			  <li><a href="#"><i class="fa fa-home fa-2x"></i>  Home</a> <span class="divider"><b>&raquo;</b></span></li>
			  <li><a href="#">Penghapusan</a><span class="divider"><b>&raquo;</b></span></li>
			  <li class="active">Daftar Penetapan Penghapusan Pemindahtanganan</li>
			  <?php SignInOut();?>
			</ul>
			<div class="breadcrumb">
				<div class="title">Penetapan Penghapusan Pemindahtanganan</div>
				<div class="subtitle">Filter Data Usulan </div>
			</div>	

		<div class="grey-container shortcut-wrapper">
				<a class="shortcut-link" href="<?=$url_rewrite?>/module/penghapusanv2/dftr_usulan_pms.php">
					<span class="fa-stack fa-lg">
				      <i class="fa fa-circle fa-stack-2x"></i>
				      <i class="fa fa-inverse fa-stack-1x">1</i>
				    </span>
					<span class="text">Usulan Penghapusan</span>
				</a>
				<a class="shortcut-link active" href="<?=$url_rewrite?>/module/penghapusanv2/dftr_penetapan_pms.php">
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
			<form method="POST" action="<?php echo"$url_rewrite";?>/module/penghapusanv2/dftr_usulan_aset_pms.php" onsubmit="return requiredFilter(0,1, 'kodeSatker')">
				<ul>
					<li>&nbsp;</li>
					<li><i>*)<u> cukup isi field <strong class="blink_text_red">Kode Satker</strong> untuk menampilkan seluruh data yang tersedia berdasarkan Satker </u></i></li>
					<li>&nbsp;</li>
					<li>
						<span class="span2">Nomor&nbsp;Usulan</span>
						<input isdatepicker="true" style="width: 200px;" id="bup_pp_sp_nousulan" name="bup_pp_sp_nousulan"  type="text">
					</li>
					<li>
						<span class="span2">Tanggal&nbsp;Usulan</span>
						<input id="tanggal13" name="bup_pp_sp_tglusul" class="datepicker" type="text" >
					</li>
                    <li>&nbsp;</li>
					
					<?php //selectAllSatker('kodeSatker','255',true,false,'required'); 
						selectAllSatker('kodeSatker','255',true,false,false,true);
					?>
					
					<li>&nbsp;</li>
					
					<li>
						<span class="span2">&nbsp;</span>
						<input type="submit" name="submit" class="btn btn-primary" value="Tampilkan Data" />
						<!--<input type="hidden" name="filterAsetUsulan" value="1" />-->
						<input type="hidden" name="Penghapusan_ID" value="<?=$_GET['id']?>" />
						<input type="reset" name="reset" class="btn" value="Bersihkan Data">
					</li>
				</ul>
				
			</form>
			    
		</section> 
		
	</section>
	
<?php
	include"$path/footer.php";
?>