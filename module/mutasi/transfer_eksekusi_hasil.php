<?php
include "../../config/config.php";
 
        ?>
<?php
	include"$path/meta.php";
	include"$path/header.php";
	include"$path/menu.php";
	
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
                document.location="hasil_transfer.php";
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
				<div class="subtitle">Daftar Data</div>
			</div>	
			<?php
				$nama=$_POST['mutasi_nama_aset'];
				$satker1=$_POST['bkbppm'];
				$satker2=$_POST['bkbppmtu'];
				$satker3=$_POST['sekretariatdaerah'];
				$satker4=$_POST['sekretariatdaerahbhh'];
				$nodok=$_POST['mutasi_trans_eks_nodok'];
				$tgl=$_POST['mutasi_trans_eks_tglproses'];
				$alasan=$_POST['mutasi_trans_eks_alasan'];
			?>  
		<section class="formLegend">
			
			<div class="detailLeft">
					<span class="label label-success">Filter data: <?php echo $jml?> filter (View seluruh data)</span>
			</div>
		
			<div class="detailRight" align="right">
						
						<ul>
							<li>
								<a href="<?php echo"$url_rewrite/module/mutasi/transfer_antar_skpd.php";?>" class="btn">
								Kembali ke Halaman Utama: Cari Aset</a>
								
							</li>
							<li>
								<a href="<?php echo "$url_rewrite/module/mutasi/"; ?>transfer_hasil_daftar.php?pid=1" class="btn">
									   Daftar Barang Mutasi
								 </a>
							</li>
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
			<form name="form" method="POST" action="<?php echo "$url_rewrite/module/mutasi/"; ?>transfer_eksekusi.php">
			<table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
				<thead>
					
					<tr>
						<th>Nomor</th>
						<th>Nama Aset</th>
						<th>Nomor Registrasi Lama</th>
						<th>Nomor Registrasi Baru</th>
					</tr>
				</thead>
				<tbody>		
							 
				<?php
					if (!empty($row))
					{
					
					
						// $no = 1;
						$no = 1;
						$page = @$_GET['pid'];
						if ($page > 1){
							$no = intval($page - 1 .'01');
						}else{
							$no = 1;
						}
						foreach ($row as $key => $value)
						{
				?>
				
					<tr class="gradeA">
						<td><?php echo "$no.";?></td>
						<td>
							<?php
													// pr($_SESSION['ses_uaksesadmin']);
												if (($_SESSION['ses_uaksesadmin'] == 1)){
													?>
													<input type="checkbox" id="checkbox" class="checkbox" onchange="enable()" name="Mutasi[]" value="<?php echo $value->Aset_ID;?>" 
													<?php 
														for ($i = 0; $i <= count($explode); $i++){
															if ($explode[$i]==$value->Aset_ID) 
																echo 'checked';
														}?>>
													<?php
												}else{
													if ($dataAsetUser){
													if (in_array($value->Aset_ID, $dataAsetUser)){
													?>
													<input type="checkbox" id="checkbox" class="checkbox" onchange="enable()" name="Mutasi[]" value="<?php echo $value->Aset_ID;?>" <?php for ($i = 0; $i <= count($explode); $i++){if ($explode[$i]==$value->Aset_ID) echo 'checked';}?>>
													<?php
													}
												}
												}
												
												?>	
						</td>
						<td>	
						<table width="100%">
								<tr>
									<td style="font-weight: bold;"> <?php echo "$value->Aset_ID";?></b> ( Aset ID - System Number )</td>
								</tr>
								<tr>
									<td style="font-weight: bold;"><?php echo "$value->NomorReg";?></td>
								</tr>
								<tr>
									<td style="font-weight: bold;"><?php echo "$value->Kode";?></td>
								</tr>
								<tr>
									<td style="font-weight: bold;"><?php echo "$value->NamaAset";?></td>
								</tr>
								<tr>
									<td><hr></td>
								</tr>
							</table>	
							<table width="100%">
								<tr>
									
									<td width="20%">No. Kontrak</td>
									<td width="2%">&nbsp;</td>
									<td width="78%"><?php echo "$value->NoKontrak";?></td>
								</tr>
								<tr align="left">
									<td>Satker</td>
									<td>&nbsp;</td>
									<td><?php echo "$value->NamaSatker";?></td>
								</tr>
								<tr align="left">
									<td>Lokasi</td>
									<td>&nbsp;</td>
									<td><?php echo "$value->NamaLokasi";?></td>
								</tr>			
								<tr align="left">				
									<td>Status</td>
									<td>&nbsp;</td>
									<td>-</td>
								</tr>
							</table>
						</td>
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
include "$path/footer.php";
?>