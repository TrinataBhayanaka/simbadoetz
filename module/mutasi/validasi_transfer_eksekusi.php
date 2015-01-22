<?php
include "../../config/config.php";


?>

<?php
	include"$path/meta.php";
	include"$path/header.php";
	include"$path/menu.php";
	

	$MUTASI = new RETRIEVE_MUTASI;

	// pr($_GET);
    $data = $MUTASI->retrieve_detailMutasi($_GET);


    // pr($data);	
?>
  <!-- buat alert-->

        <script type="text/javascript">
            <!--
            function sendit(){
                alert("OK");
                document.location="transfer_antar_skpd.php";
            }
            -->
            <!--
            function sendit_1(){
                alert("SUCCESS");
                document.location="transfer_hasil_filter.php";
            }
            -->
            <!--
            function sendit_2(){
                document.location="transfer_hasil_filter.php?pid=1";
            }
            -->
            <!--
            function sendit_3(){
                alert("OK")
                document.location="hasil_transfer_1.php";
            }
            -->
        </script>
        
        <!--buat date-->
        <script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/jquery-ui.min.js"></script> 
        <script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/jquery.ui.datepicker-id.js"></script>
        <script type="text/javascript" src="<?php echo "$url_rewrite/";?>JS/ajax_radio.js"></script>

        <script>
            $(function()
            {
            $('#tanggal1').datepicker($.datepicker.regional['id']);
            $('#tanggal2').datepicker($.datepicker.regional['id']);
            $('#tanggal3').datepicker($.datepicker.regional['id']);
            $('#tanggal4').datepicker($.datepicker.regional['id']);
            $('#tanggal5').datepicker($.datepicker.regional['id']);
            $('#tanggal6').datepicker($.datepicker.regional['id']);
            $('#tanggal7').datepicker($.datepicker.regional['id']);
            $('#tanggal8').datepicker($.datepicker.regional['id']);
            $('#tanggal9').datepicker($.datepicker.regional['id']);
            $('#tanggal10').datepicker($.datepicker.regional['id']);
            $('#tanggal11').datepicker($.datepicker.regional['id']);
            $('#tanggal12').datepicker($.datepicker.regional['id']);
            $('#tanggal13').datepicker($.datepicker.regional['id']);
            $('#tanggal14').datepicker($.datepicker.regional['id']);
            $('#tanggal15').datepicker($.datepicker.regional['id']);

            }

            );
        </script>   
        <link href="<?php echo "$url_rewrite/"; ?>css/jquery-ui.css" type="text/css" rel="stylesheet">
        
        <!--buat number only-->
        <style>
            #errmsg { color:red; }
        </style>
        <!--
        <script src="../../JS/jquery-latest.js"></script>
        <script src="../../JS/jquery.js"></script>
        -->
        <script type="text/javascript">
            $(document).ready(function(){

                //called when key is pressed in textbox
                    $("#posisiKolom").keypress(function (e)  
                    { 
                    //if the letter is not digit then display error and don't type anything
                    if( e.which!=8 && e.which!=0 && (e.which<48 || e.which>57))
                    {
                            //display error message
                            $("#errmsg").html("Hanya Bisa Input Angka").show().fadeOut("slow"); 
                        return false;
                }	
                    });
            });
			function spoiler(obj)
			{
			var inner = obj.parentNode.parentNode.parentNode.parentNode.getElementsByTagName("tfoot")[0];
			//alert(obj.parentNode.parentNode.parentNode.parentNode.nodeName);
			if (inner.style.display =="none") {
			inner.style.display = "";
			document.getElementById(obj.id).value="Tutup Detail";}
			else {
			inner.style.display = "none";
			document.getElementById(obj.id).value="View Detail";}
			}
						
			function spoilsub(obj)
			{
				var inner = obj.parentNode.parentNode.parentNode.parentNode.parentNode.getElementsByTagName("div")[1];
				//alert(obj.parentNode.parentNode.parentNode.parentNode.parentNode.nodeName);
				if (inner.style.display =="none") {
				inner.style.display = "";
				document.getElementById(obj.id).value="Tutup Sub Detail";}
				else {
				inner.style.display = "none";
				document.getElementById(obj.id).value="Sub Detail";}
			}
        </script>
        <script>
		function AreAnyCheckboxesChecked () 
		{
			setTimeout(function() {
		  if ($("#Form2 input:checkbox:checked").length > 0)
			{
			    $("#submit").removeAttr("disabled");
			}
			else
			{
			   $('#submit').attr("disabled","disabled");
			}}, 100);
		}

		$(document).on('click','.hapus_aset', function(){

			var idaset = $(this).attr('asetid');
			var mutasiid = $(this).attr('mutasiid');

			// setTimeout(function(){

				$.post(basedomain+'/function/phpajax/ajax.php',{hapusAset:true, idaset:idaset, mutasiid:mutasiid}, function(data){

		            var html = "";

		            if (data.status==true){
		                
		            	location.reload();
		               
		            } else {
		              	$('.formData').html('Load data gagal');
		            }
		            
		            

		        }, "JSON")

			// }, 2000);
			 
			
		})
		</script>
	
	<section id="main">
		<ul class="breadcrumb">
		  <li><a href="#"><i class="fa fa-home fa-2x"></i>  Home</a> <span class="divider"><b>&raquo;</b></span></li>
		  <li><a href="#">Mutasi</a><span class="divider"><b>&raquo;</b></span></li>
		  <li class="active">Transfer Antar SKPD</li>
		  <?php SignInOut();?>
		</ul>
		<div class="breadcrumb">
			<div class="title">Transfer Antar SKPD</div>
			<div class="subtitle">Filter Data</div>
		</div>
		<section class="formLegend">
			
                            
			<div class="detailLeft">
					<span class="label label-success">Filter data: <?php echo $jml?> filter (View seluruh data)</span>
			</div>
		
			<div class="detailRight" align="right">
						
						<ul>
							<li>
								<a href="<?php echo"$url_rewrite/module/mutasi/validasi_transfer_antar_skpd.php";?>" class="btn">
								Kembali ke Halaman Utama: Cari Aset</a>
								
							</li>
							<!--
							<li>
								<a href="<?php echo "$url_rewrite/module/mutasi/"; ?>validasi_transfer_hasil_daftar.php?pid=1" class="btn">
									   Daftar Barang Mutasi
								 </a>
							</li>-->
							<li>
								<input type="hidden" class="hiddenpid" value="<?php echo @$_GET['pid']?>">
								<input type="hidden" class="hiddenrecord" value="<?php echo @$count?>">
								   <ul class="pager">
										<li><a href="#" class="buttonprev" >Previous</a></li>
										<li>Page</li>
										<li><a href="#" class="buttonnext">Next</a></li>
									</ul>
							</li>
						</ul>
							
					</div>
			<div style="height:5px;width:100%;clear:both"></div>
			
			
			<div id="demo">
			<form name="form" method="POST" action="<?php echo "$url_rewrite/module/mutasi/"; ?>validasi_transfer_eksekusi_proses.php">
			<table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
				<thead>
					<tr>
						
						<td  align="left">   
							<input type="submit" name="submit" value="Validasi Barang" class="btn btn-primary" id="submit" />
						</td>
					</tr>
					<tr>
						<th class="checkbox-column"><input type="checkbox" class="icheck-input" onchange="return AreAnyCheckboxesChecked();"></th>
						
						<th>NoSKKDH</th>
						<th>TglSKKDH</th>
						<th>Kode Lokasi</th>
						<th>Satker Awal</th>
						<th>Satker Tujuan</th>
						<th>Pemakai</th>
						<th>Uraian</th>
						<!--<th>Aksi</th>-->
					</tr>
				</thead>
				<tbody>		
							 
				<?php
					if (!empty($data))
					{
					
					
						// $no = 1;
						$no = 1;
						$page = @$_GET['pid'];
						if ($page > 1){
							$no = intval($page - 1 .'01');
						}else{
							$no = 1;
						}
						foreach ($data[0]['aset'] as $key => $value)
						{
				?>
				
					<tr class="gradeA">
						
						<td>
							<input type="checkbox" id="checkbox" class="checkbox" onchange="enable()" name="aset_id[]" value="<?php echo $value['Aset_ID'];?>" >
													
						</td>
						<td><?php echo $data[0]['NoSKKDH']?></td>
						<td style="font-weight: bold;"> <?php echo $data[0]['TglSKKDH'];?> </td>
						<td style="font-weight: bold;"> <?php echo $value['kodeLokasi'];?> </td>
						<td style="font-weight: bold;"><?php echo "$value[SatkerAwal] - $value[NamaSatkerAwal]";?></td>
						<td style="font-weight: bold;"><?php echo "$value[kode] - $value[NamaSatker]";?></td>	
						<td style="font-weight: bold;"><?php echo $data[0]['Pemakai'];?></td>	
						<td>
							<?php echo "$value[Uraian]";?>
							<input type="hidden" name="Mutasi_ID" value="<?php echo $data[0]['Mutasi_ID']?>">
							<input type="hidden" name="aset_id_count[]" value="<?php echo $value['Aset_ID']?>">
							<input type="hidden" name="noDokumen" value="<?php echo $data[0]['NoSKKDH']?>">
							<input type="hidden" name="TglSKKDH" value="<?php echo $data[0]['TglSKKDH']?>">
							

						
						</td>	
						<!--<td><a href="javascript:void(0)" class="btn btn-danger hapus_aset" asetid="<?php echo $value['Aset_ID']?>" mutasiid="<?php echo $value['Mutasi_ID']?>">Hapus<a/></td>
						-->
					</tr>
					 <?php 
						$no++; 
							} 
						}
						  else
						{
							$disabled = 'disabled';
						}
						?>
				</tbody>
				<tfoot>
					<tr>
						<th>&nbsp;</th>
						<th>&nbsp;</th>
						<th>&nbsp;</th>
					</tr>
				</tfoot>
			</table>
			</form>
			</div>
			<div class="spacer"></div>
			

			
		</section>     
	</section>
	
<?php
	include"$path/footer.php";
?>
