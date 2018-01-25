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
			   
			$( "#tahun" ).mask('9999');
		});	

		function getCurrency(item){
	      $('#hrgSatuan').val($(item).autoNumeric('get'));
	    }
	</script>
	<section id="main">
		<ul class="breadcrumb">
			  <li><a href="#"><i class="fa fa-home fa-2x"></i>  Home</a> <span class="divider"><b>&raquo;</b></span></li>
			  <li><a href="#">Perencanaan</a><span class="divider"><b>&raquo;</b></span></li>
			  <li class="active">Rencana Pengadaan</li>
			  <?php SignInOut();?>
			</ul>
			<div class="breadcrumb">
				<div class="title">Rencana Pengadaan</div>
				<div class="subtitle">Tambah Rencana Pengadaan</div>
			</div>	

			<div class="grey-container shortcut-wrapper">
				<a class="shortcut-link " href="<?=$url_rewrite?>/module/perencanaan/rencana/prcn_pengadaan_tambah.php">
					<span class="fa-stack fa-lg">
				      <i class="fa fa-circle fa-stack-2x"></i>
				      <i class="fa fa-inverse fa-stack-1x">1</i>
				    </span>
					<span class="text">Tambah Rencana Pengadaan</span>
				</a>
				<a class="shortcut-link" href="<?=$url_rewrite?>/module/perencanaan/rencana/prcn_pengadaan_filter.php">
					<span class="fa-stack fa-lg">
				      <i class="fa fa-circle fa-stack-2x"></i>
				      <i class="fa fa-inverse fa-stack-1x">2</i>
				    </span>
					<span class="text">Data Rencana Pengadaan</span>
				</a>
				<a class="shortcut-link active" href="<?=$url_rewrite?>/module/perencanaan/rencana/import.php">
					<span class="fa-stack fa-lg">
				      <i class="fa fa-circle fa-stack-2x"></i>
				      <i class="fa fa-inverse fa-stack-1x">3</i>
				    </span>
					<span class="text">Import Data Rencana Pengadaan ke Pengadaan</span>
				</a>
			</div>		

		<section class="formLegendInve">
			
			<div style="height:5px;width:100%;clear:both"></div>
			

			<div>
			<form action="<?php echo"$url_rewrite";?>/module/perencanaan/rencana/import_proses.php" method="POST">
				 <ul>
				<?php //selectTahun('Tahun','235',true,false,false); ?>
				<li>
					<span class="span2">Tahun Rencana Pengadaan</span>
					<input name="tahun" id="tahun" class="span1"  type="text" required>
				</li>
				<?=selectSatker('kodeSatker','235',true,false,'required');?>
				<br>
				<li style="display:none" id="message">
                	<span  class="span2">&nbsp;</span>
                		<div class="checkbox">
                  	<em id="info"></em>
                </div>
              	</li>
				<li>
					<span class="span2">&nbsp;</span>
					<input type="submit" class="btn btn-primary" id= "simpan" value="Tampilkan Data" name="post"/>
					<input type="reset" name="reset" class="btn" value="Bersihkan Data">
				</li>
			</ul>
		</form>
		</div>  
			    
		</section> 
		     
	</section>
	
<?php
	include"$path/footer.php";
?>

<script type="text/javascript">
	$(document).on('change', function(){
		var tahun = $("#tahun").val();
		var kodeSatker = $("#kodeSatker").val();
		if(tahun !='' && kodeSatker !=''){
			$.post('../../../function/api/importExist.php', {tahun:tahun,KodeSatker:kodeSatker}, function(result){
			if(result == 0){
				$("#message").show();
				$('#info').html('Data Import Tidak Tersedia');
	            $('#info').css("color","red");
				$('#simpan').attr('disabled','disabled');
	            $('#simpan').css("background","grey");
			}else{
				$("#message").show();
				$('#info').html('Data Import Tersedia'); 
				$('#info').css("color","green");
				$('#simpan').removeAttr('disabled');
			    $('#simpan').css("background","#04c");
			}
			})
	 	}
	})
</script>