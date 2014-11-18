<?php
include "../../config/config.php";
 
        ?>
<?php
	include"$path/meta.php";
	include"$path/header.php";
	include"$path/menu.php";
	
			?>
		
        

          <section id="main">
			<ul class="breadcrumb">
			  <li><a href="#"><i class="fa fa-home fa-2x"></i>  Home</a> <span class="divider"><b>&raquo;</b></span></li>
			  <li><a href="#">Mutasi</a><span class="divider"><b>&raquo;</b></span></li>
			  <li class="active">Cetak Dokumen Mutasi</li>
			  <?php SignInOut();?>
			</ul>
			<div class="breadcrumb">
				<div class="title">Cetak Dokumen Mutasi</div>
				<div class="subtitle">Cetak Data</div>
			</div>	
			 
		<section class="formLegend">
				There Is No Information About Path
		<!--	<div class="detailLeft">
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
						<td width="130px"><span><a href="#" onclick="enable_submit()" id="pilihHalamanIni"><u>Pilih halaman ini</u></a></span></td>
						<td  align=left><a href="#" onclick="disable_submit()" id="kosongkanHalamanIni" ><u>Kosongkan halaman ini</u></a></td>
						
						<td  align="right">   
							<input type="submit" name="submit" value="Pengeluaran Barang" id="submit" disabled/>
						</td>
					</tr>
					<tr>
						<th>No</th>
						<th>&nbsp;</th>
						<th>Informasi Aset</th>
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
			<div class="spacer"></div>-->
			
			
		</section> 
	</section>
<?php
include "$path/footer.php";
?>