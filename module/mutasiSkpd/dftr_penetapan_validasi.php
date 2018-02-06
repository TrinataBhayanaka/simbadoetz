<?php
include "../../config/config.php";

$MUTASI = new RETRIEVE_MUTASI;
$menu_id = 78;
$SessionUser = $SESSION->get_session_user();
($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
$USERAUTH->FrontEnd_check_akses_menu($menu_id, $Session);
?>

<?php
	include"$path/meta.php";
	include"$path/header.php";
	include"$path/menu.php";
	
?>
	<!-- SQL Sementara -->
	<?php
		$data = $MUTASI->retrieve_daftar_penetapan_mutasi_validasi();
	?>
	<!-- End Sql -->
	<section id="main">
		<ul class="breadcrumb">
			  <li><a href="#"><i class="fa fa-home fa-2x"></i>  Home</a> <span class="divider"><b>&raquo;</b></span></li>
			  <li><a href="#">Transfer SKPD</a><span class="divider"><b>&raquo;</b></span></li>
			  <li class="active">Daftar Penetapan Transfer SKPD</li>
			  <?php SignInOut();?>
			</ul>
			<div class="breadcrumb">
				<div class="title">Penetapan Transfer SKPD</div>
				<div class="subtitle">Daftar Penetapan Transfer SKPD</div>
			</div>	

		<div class="grey-container shortcut-wrapper">
				<a class="shortcut-link " href="<?=$url_rewrite?>/module/mutasiSkpd/list_usulan.php">
					<span class="fa-stack fa-lg">
				      <i class="fa fa-circle fa-stack-2x"></i>
				      <i class="fa fa-inverse fa-stack-1x">1</i>
				    </span>
					<span class="text">Usulan Transfer SKPD</span>
				</a>
				<a class="shortcut-link" href="<?=$url_rewrite?>/module/mutasiSkpd/list_penetapan.php">
					<span class="fa-stack fa-lg">
				      <i class="fa fa-circle fa-stack-2x"></i>
				      <i class="fa fa-inverse fa-stack-1x">2</i>
				    </span>
					<span class="text">Penetapan Transfer SKPD</span>
				</a>
				<a class="shortcut-link active" href="<?=$url_rewrite?>/module/mutasiSkpd/list_validasi.php">
					<span class="fa-stack fa-lg">
				      <i class="fa fa-circle fa-stack-2x"></i>
				      <i class="fa fa-inverse fa-stack-1x">3</i>
				    </span>
					<span class="text">Validasi Transfer SKPD</span>
				</a>
			</div>	

		<section class="formLegend">

			<div id="demo">
			<table cellpadding="0" cellspacing="0" border="0" class="display table-checkable" id="penghapusan8">
				<thead>
					<tr>
						<th>No</th>
						<th>Nomor SK Mutasi</th>
						<th>Satker Usul</th>
						<th>Satker Tujuan</th>
						<th>Jumlah Usulan</th>
						<th>Tgl Penetapan</th>
						<th>Keterangan</th>
						<th>Tindakan</th>
					</tr>
				</thead>
				<tbody>		
							 
				 <?php
                $nomor = 1;
				if (!empty($data))
				{
				   
				foreach($data as $key => $row)
					{
					?>
						  
					<tr class="gradeA">
						<td><?php echo "$nomor";?></td>
						<td>
							<?php echo "$row[NoSKKDH]";?>
						</td>
						<td>
							<?php
							if($row['SatkerUsul']){ echo "[".$row['SatkerUsul']."]";}
							?>
							<br/>
							<?php echo $row['NamaSatkerUsul'];?>
						</td>
						<td>
							<?php
							if($row['SatkerTujuan']){ echo $row['SatkerTujuan'];}
							?>
						</td>
						<td>
							<?php 
							$jmlUsul=explode(",", $row[Usulan_ID]);
							echo count($jmlUsul);
							?>
						
						</td>
						<td><?php $change=$row[TglSKKDH]; $change2=  format_tanggal_db3($change); echo "$change2";?></td>
						<td><?php echo "$row[Keterangan]";?></td>
						<td align="center">	
						<a href="<?php echo "$url_rewrite/module/mutasiSkpd/"; ?>validasi_proses_penetapan.php?id=<?php echo "$row[Mutasi_ID]";?>" class="btn btn-warning"><i class="fa fa-check"></i> Lakukan Validasi</a>&nbsp;
						</td>
					</tr>
					<?php $nomor++;} }?>
				</tbody>
				<tfoot>
					<tr>
						<th>&nbsp;</th>
						<th>&nbsp;</th>
						<th>&nbsp;</th>
						<th>&nbsp;</th>
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
	include"$path/footer.php";
?>