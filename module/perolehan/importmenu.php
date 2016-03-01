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
		//kontrak
		$idKontrak = $_GET['id'];
		$sql = mysql_query("SELECT * FROM kontrak WHERE id='{$idKontrak}' LIMIT 1");
			while ($dataKontrak = mysql_fetch_assoc($sql)){
					$kontrak[] = $dataKontrak;
				}
		// pr($kontrak);

		if(isset($_POST['kodeKelompok'])){
		    
		  }		
		//sum total 
		$sqlsum = mysql_query("SELECT SUM(NilaiPerolehan) as total FROM aset WHERE noKontrak = '{$kontrak[0]['noKontrak']}'");
		while ($sum = mysql_fetch_array($sqlsum)){
					$sumTotal = $sum;
				}

		$sqlImport = mysql_query("SELECT * FROM log_import WHERE noKontrak = '{$kontrak[0]['noKontrak']}' ORDER BY create_date DESC LIMIT 1");
		while ($import = mysql_fetch_assoc($sqlImport)){
					$logImport = $import;
				}
	?>
	<!-- End Sql -->
	<script>
	// $(document).ajaxStart(function() { Pace.restart(); });
	$body = $("body");
	$(document).ready(function() { 
		var total = $("#totalRB").val();
		var spk = $("#spk").val();
		if(total == spk){
			$("#submit").attr('disabled','disabled');
		}
		var bar = $('.bar');
		var percent = $('.percent');
		var status = $('#status');
	    // bind form using ajaxForm 
	    $('#myForm').ajaxForm({ 
	        beforeSend: function() {
		        status.empty();
		        var percentVal = 0;
		        $body.addClass("loading");
		        // NProgress.set(percentVal);
		        NProgress.inc();
		        // Pace.restart();
		    },
		    uploadProgress: function(event, position, total, percentComplete) {
		        // NProgress.inc();
		        // Pace.start();
		    },
		    success: function() {
		        var percentVal = 1;
		        // console.log('ada');
		        $body.removeClass("loading");
		        NProgress.set(percentVal);
		    },
			complete: function(xhr) {
				var chgform = $("#jenisaset").val();
				window.location.replace("<?=$url_rewrite?>/module/perolehan/import/"+chgform+".php?id=<?=$_GET['id']?>");
			}
	    }); 
	});
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
    	$("#myForm").attr('action','import/'+$("#jenisaset").val()+'.php');
    }

  </script>
	<section id="main">
		<ul class="breadcrumb">
			  <li><a href="#"><i class="fa fa-home fa-2x"></i>  Home</a> <span class="divider"><b>&raquo;</b></span></li>
			  <li><a href="#">Perolehan Aset</a><span class="divider"><b>&raquo;</b></span></li>
			  <li><a href="#">Kontrak</a><span class="divider"><b>&raquo;</b></span></li>
			  <li><a href="#">Rincian Barang</a><span class="divider"><b>&raquo;</b></span></li>
			  <li class="active">Import xls</li>
			  <?php SignInOut();?>
			</ul>
			<div class="breadcrumb">
				<div class="title">Rincian Barang</div>
				<div class="subtitle">Import Data xls</div>
			</div>		

		<section class="formLegend">
			
		<div class="detailLeft">
						
						<ul>
							<li>
								<span class="labelInfo">No. Kontrak</span>
								<input type="text" value="<?=$kontrak[0]['noKontrak']?>" disabled/>
							</li>
							<li>
								<span class="labelInfo">Tgl. Kontrak</span>
								<input type="text" value="<?=$kontrak[0]['tglKontrak']?>" disabled/>
							</li>
						</ul>
							
					</div>
			<div class="detailRight">
						
						<ul>
							<li>
								<span class="labelInfo">Nilai SPK</span>
								<input type="text" id="spk" value="<?=number_format($kontrak[0]['nilai'])?>" disabled/>
							</li>
							<li>
								<span  class="labelInfo">Total Rincian Barang</span>
								<input type="text" id="totalRB" value="<?=isset($sumTotal) ? number_format($sumTotal['total']) : '0'?>" disabled/>
							</li>
						</ul>
							
					</div>
			
			<div style="height:5px;width:100%;clear:both"></div>
			
			<div class="detailRight">
				<ul>
					<li>
						<a href="import/template.zip" class="btn btn-success btn-small"><i class="fa fa-download"></i>&nbsp;&nbsp;Download xls Template</a>
				&nbsp;
					</li>
				</ul>	
			</div>

			<div style="height:5px;width:100%;clear:both"></div>

		<?php
			if(!empty($logImport)){
		?>
			<div class="search-options clearfix">
    			<strong style="margin-right:20px;">Status Import Terakhir</strong>
    			<hr style="padding:0px;margin:0px">
				<table border='0' width="100%" style="font-size:12">
					<tr>
						<th>Nomor Kontrak</th>
						<th>Nama File</th>
						<th>Total Perolehan</th>
						<th>User</th>
						<th>Tanggal</th>
						<th>Status</th>
					</tr>
					<tr>
						<td align="center"><?=$logImport['noKontrak']?></td>
						<td align="center"><?=$logImport['desc']?></td>
						<td align="center"><?=number_format($logImport['totalPerolehan'])?></td>
						<td align="center"><?=$logImport['user']?></td>
						<td align="center"><?=$logImport['create_date']?></td>
						<td align="center"><?=($logImport['status'] == 0) ? 'Sedang di proses' : 'Selesai'?></td>
					</tr>	
				</table>	

			</div><!-- /search-option -->
			<?php
				}
			?>
			<div class="well span9">
				<h4>Note Import Data</h4>
				<ol>
					<li>1. Pastikan urutan kolom sudah sesuai dengan template yang diberikan, sesuai dengan jenis barang.</li>
					<li>2. Isi terlebih dahulu nilai sp2d dan penunjang.</li>
					<li>3. Jumlah total keseluruhan aset sudah pasti benar.</li>
					<li>4. Kolom tanggal pembelian di isi dengan format : yyyy-mm-dd.</li>
					<li>5. Kolom nilai perolehan dan totalnya dilarang mencantumkan nilai sen atau koma dibelakangnya.</li>
				</ol>
			</div>

			<div>
				<form method="POST" enctype="multipart/form-data" id="myForm" action="import/mesin.php">
					 <div class="formKontrak">
					 		<ul>
								<?=selectSatker('kodeSatker','255',true,false,'required');?>
							</ul>
					 		<ul>
								<?=selectRuang('kodeRuangan','kodeSatker','255',true,false);?>
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
						<input type="hidden" name="kontrakid" value="<?=$kontrak[0]['id']?>">
						<input type="hidden" name="kodeSatker" value="<?=$kontrak[0]['kodeSatker']?>">
						<input type="hidden" name="noKontrak" value="<?=$kontrak[0]['noKontrak']?>">
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
	.modalload {
	    display:    none;
	    position:   fixed;
	    z-index:    1000;
	    top:        0;
	    left:       0;
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
	body.loading .modalload {
	    display: block;
	}
	</style>
	<div class="modalload"></div>
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
