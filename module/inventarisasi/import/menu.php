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
	

	<!-- End Sql -->
	<script>
	// $(document).ajaxStart(function() { Pace.restart(); });
	$body = $("body");
	function testing(){
		$.post('<?=$url_rewrite?>/function/api/progressCount.php', { UserNm:'<?=$_SESSION['ses_uoperatorid']?>'}, function(data){
						var total = data.total;
						if(!total) total = 1;
						var percentVal = data.count/total; 
				        // Pace.restart();
				        console.log(data.count);
				        NProgress.set(percentVal);
						testing();
					},"JSON");
	}
    jQuery(function($) {
        $('#hrgmask,#total').autoNumeric('init');
        $("select").select2({});
        $( "#tglPerolehan,#tglPembukuan,#tglSurat,#tglDokumen" ).datepicker({ format: 'yyyy-mm-dd' });
		$( "#tglPerolehan,#tglPembukuan,#tglSurat,#tglDokumen,#datepicker" ).mask('9999-99-99');    
    });

    function getCurrency(item){
      $('#hrgSatuan').val($(item).autoNumeric('get'));
    }

    function chgForm(){
    	$("#myForm").attr('action',$("#jenisaset").val()+'.php');
    }

  </script>
	<section id="main">
		<ul class="breadcrumb">
			  <li><a href="#"><i class="fa fa-home fa-2x"></i>  Home</a> <span class="divider"><b>&raquo;</b></span></li>
			  <li><a href="#">Inventarisasi</a><span class="divider"><b>&raquo;</b></span></li>
			  <li class="active">Import xls</li>
			  <?php SignInOut();?>
			</ul>
			<div class="breadcrumb">
				<div class="title">Migrasi Data</div>
				<div class="subtitle">Import Data xls</div>
			</div>		

		<section class="formLegend">
			
			
			<div class="detailRight">
				<ul>
					<li>
						<a href="template.zip" class="btn btn-success btn-small"><i class="fa fa-download"></i>&nbsp;&nbsp;Download xls Template</a>
				&nbsp;
					</li>
				</ul>	
			</div>
			
			<div>
			<form method="POST" enctype="multipart/form-data" id="myForm" action="mesin.php">
				 <div class="formKontrak">
				 		<ul>
							<?=selectSatker('kodeSatker','255',true,false,'required');?>
						</ul>
						<ul>
							<li>
								<span class="span2">Jenis Aset</span>
								<select id="jenisaset" name="jenisaset" style="width:255px" onchange="return chgForm();">
									<!-- <option value="a">KIB A - Tanah</option> -->
									<option value="mesin">KIB B - Mesin</option>
									<!-- <option value="c">KIB C - Mesin</option> -->
									<!-- <option value="d">KIB D - Jaringan</option> -->
									<option value="asetlain">KIB E - Aset Tetap Lain</option>
									<!-- <option value="f">KIB F - KDP</option> -->
								</select>
							</li>
						</ul>
						<ul>
							<li>
								<span class="span2">Upload File</span>
								<input type="file" class="span3" name="myFile"/>
							</li>
							<li>
								<span class="span2">
								  <button type="submit" id="submit" class="btn btn-primary load-one-item">Upload</button></span>
							</li>
						</ul>
							
					</div>
					<!-- hidden -->
					<input type="hidden" name="UserNm" value="<?=$_SESSION['ses_uoperatorid']?>">
		</form>
		</div> 
		</section> 
		     
	</section>
	<style type="text/css">
	/* Start by setting display:none to make this hidden.
   Then we position it in relation to the viewport window
   with position:fixed. Width, height, top and left speak
   speak for themselves. Background we set to 80% white with
   our animation centered, and no-repeating */
	.modal {
	    display:    none;
	    position:   fixed;
	    z-index:    1000;
	    top:        0;
	    left:       21.5%;
	    height:     100%;
	    width:      100%;
	    background: rgba( 0, 0, 0, .8 ) 
	                url('<?=$url_rewrite?>/js/url2.gif') 
	                50% 50% 
	                no-repeat;
	}

	/* When the body has the loading class, we turn
	   the scrollbar off with overflow:hidden */
	body.loading {
	    overflow: hidden;   
	}

	/* Anytime the body has the loading class, our
	   modal element will be visible */
	body.loading .modal {
	    display: block;
	}
	</style>
	<div class="modal"></div>
<?php
	include"$path/footer.php";
?>

<script type="text/javascript">
	$(document).on('change','#kodeKelompok', function(){

		var kode = $('#kodeKelompok').val();
		var gol = kode.split(".");

		if(gol[0] == '01')
		{
			$("#TipeAset").val('A');
			$(".mesin,.bangunan,.jaringan,.asetlain,.kdp").hide('');
			$(".mesin li > input,.bangunan li > input,.jaringan li > input,.asetlain li > input,.kdp li > input").attr('disabled','disabled');
			$(".tanah li > input,textarea").removeAttr('disabled');
			$("#hakpakai").removeAttr('disabled');
			$("#beton_bangunan,#beton_kdp").attr('disabled','disabled');
			$(".tanah").show('');
		} else if(gol[0] == '02')
		{
			$("#TipeAset").val('B');
			$(".tanah,.bangunan,.jaringan,.asetlain,.kdp").hide('');
			$(".tanah li > input,.bangunan li > input,.jaringan li > input,.asetlain li > input,.kdp li > input").attr('disabled','disabled');
			$(".mesin li > input,textarea").removeAttr('disabled');
			$("#hakpakai,#beton_bangunan,#beton_kdp").attr('disabled','disabled');
			$(".mesin").show('');
		} else if(gol[0] == '03')
		{
			$("#TipeAset").val('C');
			$(".tanah,.mesin,.jaringan,.asetlain,.kdp").hide('');
			$(".tanah li > input,.mesin li > input,.jaringan li > input,.asetlain li > input,.kdp li > input").attr('disabled','disabled');
			$(".bangunan li > input,textarea").removeAttr('disabled');
			$("#beton_bangunan").removeAttr('disabled');
			$("#hakpakai,#beton_kdp").attr('disabled','disabled');
			$(".bangunan").show('');
		} else if(gol[0] == '04')
		{
			$("#TipeAset").val('D');
			$(".tanah,.mesin,.bangunan,.asetlain,.kdp").hide('');
			$(".tanah li > input,.mesin li > input,.bangunan li > input,.asetlain li > input,.kdp li > input").attr('disabled','disabled');
			$(".jaringan li > input,textarea").removeAttr('disabled');
			$("#hakpakai,#beton_bangunan,#beton_kdp").attr('disabled','disabled');
			$(".jaringan").show('');
		} else if(gol[0] == '05'){
			$("#TipeAset").val('E');
			$(".tanah,.mesin,.bangunan,.jaringan,.kdp").hide('');
			$(".tanah li > input,.mesin li > input,.bangunan li > input,.jaringan li > input,.kdp li > input").attr('disabled','disabled');
			$(".asetlain li > input,textarea").removeAttr('disabled');
			$("#hakpakai,#beton_bangunan,#beton_kdp").attr('disabled','disabled');
			$(".asetlain").show('');
		} else if(gol[0] == '06'){
			$("#TipeAset").val('F');
			$(".tanah,.mesin,.bangunan,.asetlain,.jaringan").hide('');
			$(".tanah li > input,.mesin li > input,.bangunan li > input,.asetlain li > input,.jaringan li > input,textarea").attr('disabled','disabled');
			$(".kdp li > input,textarea").removeAttr('disabled');
			$("#beton_kdp").removeAttr('disabled');
			$("#hakpakai,#beton_bangunan").attr('disabled','disabled');
			$(".kdp").show('');
		} else {
			$("#TipeAset").val('G');
			$(".tanah,.mesin,.bangunan,.asetlain,.jaringan,.kdp").hide('');
			$(".tanah li > input,.mesin li > input,.bangunan li > input,.asetlain li > input,.jaringan li > input,.kdp li > input").attr('disabled','disabled');
			$("#hakpakai,#beton_bangunan,#beton_kdp").attr('disabled','disabled');
		}			
		
	});

	$(document).on('submit', function(){
		var perolehan = $("#nilaiPerolehan").val();
		var total = $("#totalRB").val();
		var spk = $("#spk").val();
		var str = parseInt(spk.replace(/[^0-9\.]+/g, ""));
		var rb = parseInt(total.replace(/[^0-9\.]+/g, ""));

		var diff = parseInt(perolehan) + parseInt(rb);

		if(diff > str) {
			alert("Total rincian barang melebihi nilai SPK");
			return false;	
		}
	});

		function totalHrg(){	
		var jml = $("#jumlah").val();
		var hrgSatuan = $("#hrgSatuan").val();
		var total = jml*hrgSatuan;
		$("#total").val(total);
		$('#nilaiPerolehan').val($("#total").autoNumeric('get'));
	}
</script>
