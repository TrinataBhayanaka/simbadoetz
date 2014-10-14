<?php
include "../../config/config.php";
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
		      pr($_POST);exit;
		      $dataArr = $STORE->store_aset($_POST);
		    }  else
		    {
		      $dataArr = $STORE->store_edit_aset($_POST,$_POST['Aset_ID']);
		    }
		      

		  }

	?>
	<!-- End Sql -->
	<section id="main">
		<ul class="breadcrumb">
			  <li><a href="#"><i class="fa fa-home fa-2x"></i>  Home</a> <span class="divider"><b>&raquo;</b></span></li>
			  <li><a href="#">Perolehan Aset</a><span class="divider"><b>&raquo;</b></span></li>
			  <li><a href="#">Kontrak</a><span class="divider"><b>&raquo;</b></span></li>
			  <li class="active">Rincian Barang</li>
			  <?php SignInOut();?>
			</ul>
			<div class="breadcrumb">
				<div class="title">Rincian Barang</div>
				<div class="subtitle">Input Data Aset</div>
			</div>		

		<section class="formLegend">
			
			
			<div>
			<form action="" method="POST">
				 <div class="formKontrak">
						<ul>
							<?php selectAset('kodeKelompok','255',true,false); ?>
							<li>&nbsp;
							</li>
							<li>
								<span class="span2">Merk</span>
								<input type="text"class="span3 mesin all" name="Merk" disabled/>
							</li>
							<li>
								<span class="span2">Model</span>
								<input type="text" class="span3 mesin all" name="Model" disabled/>
							</li>
							<li>
								<span class="span2">Ukuran</span>
								<input type="text" class="span3 mesin asetlain all" name="Ukuran" disabled/>
							</li>
							<li>
								<span class="span2">Panjang</span>
								<input type="text" class="span3 jaringan all" name="Panjang" disabled/>
							</li>
					 		<li>
								<span class="span2">Lebar</span>
								<input type="text" class="span3 jaringan all" name="Lebar" disabled/>
							</li>
							<li>
								<span class="span2">luas</span>
								<input type="text" class="span3 tanah bangunan jaringan kdp all" name="luas" disabled/>
							</li>
							<li>
								<span class="span2">Jumlah</span>
								<input type="text" class="span3 mesin bangunan kdp all" name="jumlah" id="jumlah" onchange="return totalHrg()"/>
							</li>
							<li>
								<span class="span2">Harga Satuan</span>
								<input type="text" class="span3" name="hrgSatuan" id="hrgSatuan" onchange="return totalHrg()"/>
							</li>
							<li>
								<span class="span2">Total</span>
								<input type="text" class="span3" name="total" id="total" disabled/>
							</li>
							<li>
								<span class="span2">Info</span>
								<textarea name="info" class="span3" ></textarea>
							</li>
							<li>
								<span class="span2">
								  <button class="btn" type="reset">Reset</button>
								  <button type="submit" class="btn btn-primary">Simpan</button></span>
							</li>
						</ul>
							
					</div>
					<!-- hidden -->
					<input type="hidden" name="Aset_ID" value="">
			
			
		</form>
		</div>  
			    
		</section> 
		     
	</section>
	
<?php
	include"$path/footer.php";
?>

<script type="text/javascript">
	$(document).on('change','#aset', function(){

		var kode = $('#aset').val();
		var gol = kode.split(".");

		if(gol[0] == '01')
		{
			$(".all").attr('disabled','disabled');
			$(".tanah").removeAttr('disabled');
		} else if(gol[0] == '02')
		{
			$(".all").attr('disabled','disabled');
			$(".mesin").removeAttr('disabled');
		} else if(gol[0] == '03')
		{
			$(".all").attr('disabled','disabled');
			$(".bangunan").removeAttr('disabled');
		} else if(gol[0] == '04')
		{
			$(".all").attr('disabled','disabled');
			$(".jaringan").removeAttr('disabled');
		} else if(gol[0] == '05')
		{
			$(".all").attr('disabled','disabled');
			$(".asetlain").removeAttr('disabled');
		} else if(gol[0] == '06')
		{
			$(".all").attr('disabled','disabled');
			$(".kdp").removeAttr('disabled');
		}				
		
	})
</script>