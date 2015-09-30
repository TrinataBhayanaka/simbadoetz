<?php
include "../../../config/config.php";
$menu_id = 10;
            $SessionUser = $SESSION->get_session_user();
            ($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
            $USERAUTH->FrontEnd_check_akses_menu($menu_id, $Session);

// $get_data_filter = $RETRIEVE->retrieve_kontrak();
// pr($get_data_filter);
?>

<?php
	include"$path/meta.php";
	include"$path/header.php";
	include"$path/menu.php";
	
?>
	<!-- SQL Sementara -->
	<?php

		if(isset($_POST['kodeKelompok'])){
		    if($_POST['Aset_ID'] == "")
		    {
		      	$dataArr = $STORE->store_inventarisasi($_POST);
		    }  else
		    {
		      $dataArr = $STORE->store_edit_aset($_POST,$_POST['Aset_ID']);
		    }
		  }		

	?>
	<!-- End Sql -->
	<script type="text/javascript">
		$(document).ready(function() {
			$('#hrgmask,#total').autoNumeric('init');
			$("select").select2({
			});
			   
			$( "#tglPerolehan,#tglPembukuan,#tglSurat,#tglDokumen" ).datepicker({ format: 'yyyy-mm-dd' });
			$( "#tglPerolehan,#tglPembukuan,#tglSurat,#tglDokumen,#datepicker" ).mask('9999-99-99');
		});	

		function getCurrency(item){
	      $('#hrgSatuan').val($(item).autoNumeric('get'));
	    }
	</script>
	<section id="main">
		<ul class="breadcrumb">
			  <li><a href="#"><i class="fa fa-home fa-2x"></i>  Home</a> <span class="divider"><b>&raquo;</b></span></li>
			  <li><a href="#">Perencanaan</a><span class="divider"><b>&raquo;</b></span></li>
			  <li class="active">Rencana Pemeliharaan</li>
			  <?php SignInOut();?>
			</ul>
			<div class="breadcrumb">
				<div class="title">Rencana Pemeliharaan</div>
				<div class="subtitle">Buat Rencana Pemeliharaan</div>
			</div>	

			<div class="grey-container shortcut-wrapper">
				<a class="shortcut-link active" href="<?=$url_rewrite?>/module/perencanaan/rencana/prcn_pemeliharaan_buat_filter.php">
					<span class="fa-stack fa-lg">
				      <i class="fa fa-circle fa-stack-2x"></i>
				      <i class="fa fa-inverse fa-stack-1x">1</i>
				    </span>
					<span class="text">Buat Rencana Pemeliharaan</span>
				</a>
				<a class="shortcut-link " href="<?=$url_rewrite?>/module/perencanaan/rencana/prcn_pemeliharaan_filter.php">
					<span class="fa-stack fa-lg">
				      <i class="fa fa-circle fa-stack-2x"></i>
				      <i class="fa fa-inverse fa-stack-1x">2</i>
				    </span>
					<span class="text">Data Rencana Pemeliharaan</span>
				</a>
			</div>		

		<section class="formLegendInve">
			
			<div style="height:5px;width:100%;clear:both"></div>
			

			<div>
			<form action="<?php echo"$url_rewrite";?>/module/perencanaan/rencana/prcn_pengadaan_dataPemeliharaan.php" method="POST" onsubmit="return requiredFilterHPS(0,1, 'kodeSatker')">
				<ul>
					<!-- <li>
						<?php selectAset('kodeKelompok','255',true,false,'required'); ?>
					</li> -->
					<li>
						&nbsp;
					</li>
					<li>

						<span class="span2">Tipe Aset</span>
						<select name="jenisaset" style="width:170px" id="jenisaset">

							<option value="">Pilih Tipe Aset</option>
							<option value="A">Tanah</option>
							<option value="B">Mesin</option>
							<option value="C">Bangunan</option>
							<option value="D">Jaringan</option>
							<option value="E">Aset Tetap Lain</option>
							<option value="F">KDP</option>
						</select>
                    </li>  
					<li>
						&nbsp;
					</li>
					<?=selectSatker('kodeSatker',$width='205',$br=true,false);?>
                    <li>&nbsp;</li>
					<!--  <li>
						<?php selectRekening('kdRekening','205',true,(isset($rinc) ? $rinc['kdRekening'] : false)); ?><br />
					</li> -->
					<li>
						<span class="span2">&nbsp;
						  </span>
						  <button class="btn" type="reset">Reset</button>
						  <button type="submit" id="submit" class="btn btn-primary">Filter</button>
					</li>
				</ul>
		</form>
		</div>  
			    
		</section> 
		     
	</section>
	
<?php
	include"$path/footer.php";
?>

