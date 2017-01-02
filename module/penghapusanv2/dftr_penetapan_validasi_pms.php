<?php
include "../../config/config.php";

$PENGHAPUSAN = new RETRIEVE_PENGHAPUSAN;
$menu_id = 75;
$SessionUser = $SESSION->get_session_user();
($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
$USERAUTH->FrontEnd_check_akses_menu($menu_id, $Session);

include"$path/meta.php";
include"$path/header.php";
include"$path/menu.php";
	
$data = $PENGHAPUSAN->retrieve_daftar_penetapan_penghapusan_validasi_pms($_POST);
?>
	<!-- End Sql -->
	<script>
		/*function AreAnyCheckboxesChecked () 
		{
			setTimeout(function() {
		  if ($("#Form2 input:checkbox:checked").length > 0)
			{
			    $("#submit").removeAttr("disabled");
			    updDataCheckbox('VLDUSPMD');
			}
			else
			{
			   $('#submit').attr("disabled","disabled");
			    updDataCheckbox('VLDUSPMD');
			}}, 100);
		}*/
		</script>
	<section id="main">
		<ul class="breadcrumb">
			  <li><a href="#"><i class="fa fa-home fa-2x"></i>  Home</a> <span class="divider"><b>&raquo;</b></span></li>
			  <li><a href="#">Penghapusan</a><span class="divider"><b>&raquo;</b></span></li>
			  <li class="active">Daftar Penetapan Penghapusan Pemindahtanganan</li>
			  <?php SignInOut();?>
			</ul>
			<div class="breadcrumb">
				<div class="title">Penetapan Penghapusan Pemindahtanganan</div>
				<div class="subtitle">Daftar Penetapan Penghapusan Pemindahtanganan</div>
			</div>	

		<div class="grey-container shortcut-wrapper">
				<a class="shortcut-link" href="<?=$url_rewrite?>/module/penghapusanv2/dftr_usulan_pms.php">
					<span class="fa-stack fa-lg">
				      <i class="fa fa-circle fa-stack-2x"></i>
				      <i class="fa fa-inverse fa-stack-1x">1</i>
				    </span>
					<span class="text">Usulan Penghapusan</span>
				</a>
				<a class="shortcut-link " href="<?=$url_rewrite?>/module/penghapusanv2/dftr_penetapan_pms.php">
					<span class="fa-stack fa-lg">
				      <i class="fa fa-circle fa-stack-2x"></i>
				      <i class="fa fa-inverse fa-stack-1x">2</i>
				    </span>
					<span class="text">Penetapan Penghapusan</span>
				</a>
				<a class="shortcut-link active" href="<?=$url_rewrite?>/module/penghapusanv2/dftr_validasi_pms.php">
					<span class="fa-stack fa-lg">
				      <i class="fa fa-circle fa-stack-2x"></i>
				      <i class="fa fa-inverse fa-stack-1x">3</i>
				    </span>
					<span class="text">Validasi Penghapusan</span>
				</a>
			</div>		

		<section class="formLegend">
			
			<!-- <p><a href="filter_usulan_pmd.php" class="btn btn-info btn-small"><i class="icon-plus-sign icon-white"></i>&nbsp;&nbsp;Tambah Penetapan Penghapusan</a>
			&nbsp;</p>	 -->

			<div id="demo">
			<form name="form" method="POST" ID="Form2" action="<?php echo "$url_rewrite/module/penghapusan/"; ?>validasi_proses_pmd.php">
			
			<table cellpadding="0" cellspacing="0" border="0" class="display table-checkable" id="penghapusan8">
				<thead>
					<?php
							if($_SESSION['ses_ujabatan']==1){
						?>
					<!-- <tr>
						<td colspan="8" align="Left">
								<span><button type="submit" name="submit" id="submit" value="tetapkan" class="btn btn-info " id="submit" disabled/><i class="icon-plus-sign icon-white"></i>&nbsp;&nbsp;Validasi Barang</button></span>
						</td>
					</tr> -->
					<?php
						}
					?>
					<tr>
						<th>No</th>
						<?php
							if($_SESSION['ses_ujabatan']==1){
						?>
						<th class="checkbox-column">
							&nbsp;<!-- <input type="checkbox" class="icheck-input" onchange="return AreAnyCheckboxesChecked();"> -->
						</th>
						<?php
							}
						?>
						<th>Nomor SK Penghapusan</th>
						<th>Satker</th>
						<th>Jumlah Usulan</th>
						<th>Tgl Penetapan</th>
						<th>Keterangan</th>
						<th>Tindakan</th>
					</tr>
				</thead>
				<tbody>		
							 
				 <?php
                                                                            
				 // '<pre>';
				//print_r($data['dataArr']);
				// echo '</pre>';
				
				$nomor = 1;
				if (!empty($data))
				{
				   
				foreach($data as $key => $row)
					{
					?>
						  
					<tr class="gradeA">
						<td><?php echo "$nomor";?></td>
						<?php
							if($_SESSION['ses_ujabatan']==1){
						?>
						<td class="checkbox-column">
							&nbsp;<!-- <input type="checkbox" class="icheck-input checkbox" onchange="return AreAnyCheckboxesChecked();" name="ValidasiPenghapusan[]" value="<?php echo $row[Penghapusan_ID];?>" > -->
							
						</td>
						<?php
							}
						?>
						<td>
							<?php echo "$row[NoSKHapus]";?>
						</td>
						<td>
							<?php
							if($row['SatkerUsul']){ echo "[".$row['SatkerUsul']."]";}
							?>
							<br/>
							<?php echo $row['NamaSatkerUsul'];?>
						</td>
						<td><center>
							<?php 
							$jmlUsul=explode(",", $row[Usulan_ID]);
							$clearArr = array_filter($jmlUsul);
							echo count($clearArr);
							?>
							</center>
						</td>
						<td><?php $change=$row[TglHapus]; $change2=  format_tanggal_db3($change); echo "$change2";?></td>
						<td><?php echo "$row[AlasanHapus]";?></td>
						<td align="center">	
						<a href="<?php echo "$url_rewrite/module/penghapusanv2/"; ?>validasi_proses_penetapan_pms.php?id=<?php echo "$row[Penghapusan_ID]";?>" class="btn btn-warning"><i class="fa fa-check"></i> Lakukan Validasi</a>&nbsp;
						</td>
					</tr>
					<?php $nomor++;} }?>
				</tbody>
				<tfoot>
					<tr>
						<th>&nbsp;</th>
						<?php
							if($_SESSION['ses_ujabatan']==1){
						?>
						<th>&nbsp;</th>
						<?php
							}
						?>
						<th>&nbsp;</th>
						<th>&nbsp;</th>
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