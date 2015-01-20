<?php
include "../../config/config.php";

$PENGHAPUSAN = new RETRIEVE_PENGHAPUSAN;

        $menu_id = 38;
        ($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
        $SessionUser = $SESSION->get_session_user();
        $USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);
        
        $paging = $LOAD_DATA->paging($_GET['pid']);
	?>
	
<?php

	include"$path/meta.php";
	include"$path/header.php";
	include"$path/menu.php";
	

?>


          <section id="main">
			<ul class="breadcrumb">
			  <li><a href="#"><i class="fa fa-home fa-2x"></i>  Home</a> <span class="divider"><b>&raquo;</b></span></li>
			  <li><a href="#">Penghapusan</a><span class="divider"><b>&raquo;</b></span></li>
			  <li class="active">Daftar Usulan Penghapusan Pemindahtanganan</li>
			  <?php SignInOut();?>
			</ul>
			<div class="breadcrumb">
				<div class="title">Daftar Usulan Penghapusan Pemindahtanganan</div>
				<div class="subtitle">Daftar Data</div>
			</div>	
		<section class="formLegend">
			
			<div class="detailLeft">
					<span class="label label-success">Filter data: Tidak ada filter (View seluruh data)</span>
			</div>
		
			<div class="detailRight" align="right">
						<?php 
								unset($_SESSION['ses_retrieve_filter_'.$menu_id.'_'.$SessionUser['ses_uid']]);
								$parameter = array('menuID'=>$menu_id,'type'=>'','paging'=>$paging);
							// $data = $RETRIEVE->retrieve_daftar_usulan_penghapusan($parameter);
								// pr($data);
								$query = "select distinct Usulan_ID from UsulanAset where StatusPenetapan = 1 AND Jenis_Usulan = 'HPS'";
								$result  = mysql_query($query) or die (mysql_error());
								while ($dataNew = mysql_fetch_object($result))
								{
									$dataArr[] = $dataNew->Usulan_ID;
								}
								
								
	// pr($_POST);
	$data = $PENGHAPUSAN->retrieve_daftar_usulan_penghapusan_pmd($_POST);
	// pr($data);
							?>
						<ul>
							<li>
								<a href="<?php echo "$url_rewrite/module/penghapusan/"; ?>daftar_usulan_penghapusan_filter_pmd.php" class="btn">
								Kembali ke Form Filter</a>
								
							</li>
							<!-- <li>
								<a href="<?php echo "$url_rewrite/module/penghapusan/"; ?>daftar_usulan_penghapusan_lanjut_pmd.php?pid=1" class="btn">
								Tambah Data</a>
							</li> -->
							<li>
								<input type="hidden" class="hiddenpid" value="<?php echo @$_GET['pid']?>">
								<input type="hidden" class="hiddenrecord" value="<?php echo @$_SESSION['parameter_sql_total']?>">
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
						<th>Nomor Usulan</th>
						<th>Tgl Usulan</th>
						<!-- <th>Aset</th> -->
						<th>Tindakan</th>
					</tr>
				</thead>
				<tbody>		
							 
				 <?php
                                        
					// pr($dataArr);
					$no=1;	
					// pr($data);
					if($data){
					foreach($data as $key => $hsl_data){
						
						if($dataArr!="")
							{
								(in_array($hsl_data['Usulan_ID'], $dataArr))   ? $disable = "return false" : $disable = "return true";
							}
				?>
						  
					<tr class="gradeA">
						<td><?php echo "$no";?></td>
						<td>
							<?php echo "$hsl_data[Usulan_ID]";?>
						</td>
						<td><?php $change=$hsl_data[TglUpdate]; $change2=  format_tanggal_db3($change); echo "$change2";?></td>
						<!-- <td>
							<ul type="1">
						<?php
						$dataAset = $PENGHAPUSAN->retrieve_daftar_usulan_penghapusan_aset($hsl_data[Aset_ID]);
							$noAset=1;
							foreach ($dataAset as $valueAset) {
								if($valueAset[StatusKonfirmasi]==1){
										$textLabel="Diterima";
										$labelColor="label label-success";
									}elseif($valueAset[StatusKonfirmasi]==2){
										$textLabel="Ditolak";
										$labelColor="label label-danger";
									}else{
										$textLabel="Ditunda";
										$labelColor="label label-warning";
									}
								echo "<li>".$noAset.".  Aset ID[".$valueAset['Aset_ID']."][".$valueAset['kodeSatker']."]<span class='".$labelColor."'>".$textLabel."</span></li>";
							$noAset++;
							}
						?>
							</ul>
						</td> -->
						<td>	
						 <!--<a href="<?php echo "$url_rewrite/report/template/PENGHAPUSAN/";?>tes_class_usulan_aset_yang_akan_dihapuskan.php?id=<?php echo "$hsl_data[Usulan_ID]";?>" target="_blank">Cetak</a> || -->
											<?php
											if($dataArr){
												if($_SESSION['ses_uaksesadmin'] == 1){
													
													if(in_array($hsl_data['Usulan_ID'], $dataArr)){
														echo "&nbsp;";
													}else{
													?>
														<a href="<?php echo "$url_rewrite/module/penghapusan/"; ?>penghapusan_usulan_daftar_proses_hapus_pmd.php?id=<?php echo "$hsl_data[Usulan_ID]";?>" onclick="return confirm('Hapus Data');">Hapus</a>
											
													<?php
													}
												}elseif($_SESSION['ses_uoperatorid'] == $hsl_data[UserNm]){
													if(in_array($hsl_data['Pemanfaatan_ID'], $dataArr)){
														echo "&nbsp;";	
													}else{
													?>	
														<a href="<?php echo "$url_rewrite/module/penghapusan/"; ?>penghapusan_usulan_daftar_proses_hapus_pmd.php?id=<?php echo "$hsl_data[Usulan_ID]";?>" onclick="return confirm('Hapus Data');">Hapus</a>
													<?php
													}
												}
											}else{
												if($_SESSION['ses_uaksesadmin'] == 1){
												// echo "masukkkkkk";
												?>
													<a href="<?php echo "$url_rewrite/module/penghapusan/"; ?>penghapusan_usulan_daftar_proses_hapus_pmd.php?id=<?php echo "$hsl_data[Usulan_ID]";?>" class="btn btn-danger" onclick="return confirm('Hapus Data');">Hapus</a>
													<a href="<?php echo "$url_rewrite/module/penghapusan/"; ?>penghapusan_usulan_daftar_view_edit_pmd.php?id=<?php echo "$hsl_data[Usulan_ID]";?>" class="btn btn-success" onclick="return confirm('View Data');">View</a>
												<?php	
												}elseif($_SESSION['ses_uoperatorid'] == $hsl_data[UserNm]){
												?>
													<a href="<?php echo "$url_rewrite/module/penghapusan/"; ?>penghapusan_usulan_daftar_proses_hapus_pmd.php?id=<?php echo "$hsl_data[Usulan_ID]";?>" class="btn btn-danger" onclick="return confirm('Hapus Data');">Hapus</a>
													<a href="<?php echo "$url_rewrite/module/penghapusan/"; ?>penghapusan_usulan_daftar_view_edit_pmd.php?id=<?php echo "$hsl_data[Usulan_ID]";?>" class="btn btn-success" onclick="return confirm('View Data');">View</a>
											
												<?php
												}else{
												echo "&nbsp;";
												}
											}				
											?>
						</td>
					</tr>
					
				     <?php $no++; } }?>
				</tbody>
				<tfoot>
					<tr>
						<th>&nbsp;</th>
						<th>&nbsp;</th>
						<th>&nbsp;</th>
						<!-- <th>&nbsp;</th> -->
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