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
			  <li><a href="#">Pemanfaatan</a><span class="divider"><b>&raquo;</b></span></li>
			  <li class="active">Daftar Validasi Barang Pemanfaatan</li>
			  <?php SignInOut();?>
			</ul>
			<div class="breadcrumb">
				<div class="title">Daftar Validasi Barang Pemanfaatan</div>
				<div class="subtitle">Daftar Data</div>
			</div>	
		<section class="formLegend">
			
			<div class="detailLeft">
					<span class="label label-success">Filter data: Tidak ada filter (View seluruh data)</span>
			</div>
		
			<div class="detailRight" align="right">
						
						<ul>
							<li>
								<a href="<?php echo "$url_rewrite/module/pemanfaatan/"; ?>pemanfaatan_validasi_filter.php" class="btn">
								Kembali ke Form Filter</a>
							</li>
							<li>
								<a href="<?php echo "$url_rewrite/module/pemanfaatan/"; ?>pemanfaatan_validasi_filter.php" class="btn">
								Tambah Data
								 </a>
							</li>
							 <?php
							$query2="SELECT * FROM Pemanfaatan where FixPemanfaatan=1 and Status=1";
							$exec2 = mysql_query($query2) or die(mysql_error());
							$count =mysql_num_rows($exec2);	
							//sementara
								$query = "select distinct Pemanfaatan_ID from PemanfaatanAset where StatusPengembalian = 1";
								// print_r($query);
								$result  = mysql_query($query) or die (mysql_error());
								while ($dataNew = mysql_fetch_object($result))
								{
									$dataArr[] = $dataNew->Pemanfaatan_ID;
								}
								// pr($dataArr);
							?>
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
			<table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
				<thead>
					<tr>
						<th>No</th>
						<th>Nomor SKKDH</th>
						<th>Tgl SKKDH</th>
						<th>Keterangan</th>
						<th>Tindakan</th>
					</tr>
				</thead>
				<tbody>		
							 
				 <?php
                                        
					$page = @$_GET['pid'];
					if ($page > 1){
						$no = intval($page - 1 .'01');
					}else{
						$no = 1;
					}	  
					while($hsl_data=mysql_fetch_array($exec2)){
					// pr($hsl_data);	
				?>
						  
					<tr class="gradeA">
						<td><?php echo "$no";?></td>
						<td>
							<?php echo "$hsl_data[NoSKKDH]";?>
						</td>
						<td><?php $change=$hsl_data[TglUpdate]; $change2=  format_tanggal_db3($change); echo "$change2";?></td>
						<td><?php echo "$hsl_data[Keterangan]";?></td>
						<td>	
						<?php
											// pr($_SESSION);
											if($dataArr){
												if($_SESSION['ses_uaksesadmin'] == 1){
													
													if(in_array($hsl_data['Pemanfaatan_ID'], $dataArr)){
														echo "&nbsp;";
													}else{
													?>
														<a href="<?php echo "$url_rewrite/module/pemanfaatan/"; ?>pemanfaatan_validasi_daftar_proses_hapus.php?id=<?php echo "$hsl_data[Pemanfaatan_ID]";?>"  onclick="return confirm('Hapus Data');">Hapus</a>
													<?php
													}
												}elseif($_SESSION['ses_uoperatorid'] == $hsl_data[UserNm]){
													if(in_array($hsl_data['Pemanfaatan_ID'], $dataArr)){
														echo "&nbsp;";
													}else{
														?>
														<a href="<?php echo "$url_rewrite/module/pemanfaatan/"; ?>pemanfaatan_validasi_daftar_proses_hapus.php?id=<?php echo "$hsl_data[Pemanfaatan_ID]";?>"  onclick="return confirm('Hapus Data');">Hapus</a>
													<?php	
													}
												}
											}else{
												if($_SESSION['ses_uaksesadmin'] == 1){
												// echo "masuk sini ";
												?>
													<a href="<?php echo "$url_rewrite/module/pemanfaatan/"; ?>pemanfaatan_validasi_daftar_proses_hapus.php?id=<?php echo "$hsl_data[Pemanfaatan_ID]";?>"  onclick="return confirm('Hapus Data');">Hapus</a>
												<?php
												}elseif($_SESSION['ses_uoperatorid'] == $hsl_data[UserNm]){
												?>
													<a href="<?php echo "$url_rewrite/module/pemanfaatan/"; ?>pemanfaatan_validasi_daftar_proses_hapus.php?id=<?php echo "$hsl_data[Pemanfaatan_ID]";?>"  onclick="return confirm('Hapus Data');">Hapus</a>
												<?php
												}else{
													echo "&nbsp;";
												}
											}									
											?>
						</td>
					</tr>
					<?php 
							$no++; 
									}?>
				</tbody>
				<tfoot>
					<tr>
						<th>&nbsp;</th>
						<th>&nbsp;</th>
						<th>&nbsp;</th>
						<th>&nbsp;</th>
					</tr>
				</tfoot>
			</table>
			</div>
			<div class="spacer"></div>
			
			
		</section> 
	</section>
<?php
include "$path/footer.php";
?>