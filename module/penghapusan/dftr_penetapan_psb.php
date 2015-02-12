<?php
include "../../config/config.php";

	$PENGHAPUSAN = new RETRIEVE_PENGHAPUSAN;
$menu_id = 10;
            $SessionUser = $SESSION->get_session_user();
            ($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
            $USERAUTH->FrontEnd_check_akses_menu($menu_id, $Session);

$get_data_filter = $RETRIEVE->retrieve_kontrak();
// //////pr($get_data_filter);
?>

<?php
	include"$path/meta.php";
	include"$path/header.php";
	include"$path/menu.php";
	
?>
	<!-- SQL Sementara -->
	<?php
	// //pr($_SESSION);
		$data = $PENGHAPUSAN->retrieve_daftar_penetapan_penghapusan_psb($_POST);
		//////pr($data);
		 $sql = mysql_query("SELECT * FROM kontrak ORDER BY id ");
        while ($dataKontrak = mysql_fetch_assoc($sql)){
                $kontrak[] = $dataKontrak;
            }
	?>
	<!-- End Sql -->
	<section id="main">
		<ul class="breadcrumb">
			  <li><a href="#"><i class="fa fa-home fa-2x"></i>  Home</a> <span class="divider"><b>&raquo;</b></span></li>
			  <li><a href="#">Penghapusan</a><span class="divider"><b>&raquo;</b></span></li>
			  <li class="active">Daftar Penetapan Penghapusan Sebagian</li>
			  <?php SignInOut();?>
			</ul>
			<div class="breadcrumb">
				<div class="title">Penetapan Penghapusan Sebagian</div>
				<div class="subtitle">Daftar Penetapan Penghapusan Sebagian</div>
			</div>	

		<div class="grey-container shortcut-wrapper">
				<a class="shortcut-link" href="<?=$url_rewrite?>/module/penghapusan/dftr_usulan_psb.php">
					<span class="fa-stack fa-lg">
				      <i class="fa fa-circle fa-stack-2x"></i>
				      <i class="fa fa-inverse fa-stack-1x">1</i>
				    </span>
					<span class="text">Usulan Penghapusan</span>
				</a>
				<a class="shortcut-link active" href="<?=$url_rewrite?>/module/penghapusan/dftr_penetapan_psb.php">
					<span class="fa-stack fa-lg">
				      <i class="fa fa-circle fa-stack-2x"></i>
				      <i class="fa fa-inverse fa-stack-1x">2</i>
				    </span>
					<span class="text">Penetapan Penghapusan</span>
				</a>
				<a class="shortcut-link" href="<?=$url_rewrite?>/module/penghapusan/dftr_validasi_psb.php">
					<span class="fa-stack fa-lg">
				      <i class="fa fa-circle fa-stack-2x"></i>
				      <i class="fa fa-inverse fa-stack-1x">3</i>
				    </span>
					<span class="text">Validasi Penghapusan</span>
				</a>
			</div>		

		<section class="formLegend">
			
			<p><a href="filter_usulan_psb.php" class="btn btn-info btn-small"><i class="icon-plus-sign icon-white"></i>&nbsp;&nbsp;Tambah Penetapan Penghapusan</a>
			&nbsp;</p>	
			<div id="demo">
			<table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
				<thead>
					<tr>
						<th>No</th>
						<th>Nomor SK Penghapusan</th>
						<th>Satker</th>
						<th>Jumlah Usulan</th>
						<th>Tgl Penetapan</th>
						<th>Keterangan</th>
						<th>Status</th>
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
						<td>
							<?php 
							$jmlUsul=explode(",", $row[Usulan_ID]);
							echo count($jmlUsul);

							?>
						
						</td>
						<td><?php $change=$row[TglHapus]; $change2=  format_tanggal_db3($change); echo "$change2";?></td>
						<td><?php echo "$row[AlasanHapus]";?></td>
						<td>
							<?php
							if($row['Status']==0){
								$label="warning";
								$text="Belum Divalidasi";
							}elseif($row['Status']==1){
								$label="success";
								$text="sudah Divalidasi";
							}
						?>
						<span class="label label-<?=$label?>"><?=$text?></span>
					</td>

						<td align="center">	
							<?php
							if($row['Status']==0 && $_SESSION['ses_uaksesadmin']==1){
							?>
						 <!--<a href="<?php echo "$url_rewrite/report/template/PENGHAPUSAN/";?>tes_class_penetapan_aset_yang_dihapuskan.php?menu_id=39&mode=1&id=<?php echo "$row[Penghapusan_ID]";?>" target="_blank">Cetak</a> ||--> 
						<a href="<?php echo "$url_rewrite/module/penghapusan/"; ?>dftr_review_edit_penetapan_usulan_psb.php?id=<?php echo "$row[Penghapusan_ID]";?>" class="btn btn-success btn-small"><i class="fa fa-pencil-square-o"></i> View</a>&nbsp;
						<a href="<?php echo "$url_rewrite/module/penghapusan/"; ?>penetapan_penghapusan_daftar_hapus_psb.php?id=<?php echo "$row[Penghapusan_ID]";?>" class="btn btn-danger btn-small"> <i class="fa fa-trash"></i>Hapus</a>  
						<?php
						}else{ ?>
							<a href="<?php echo "$url_rewrite/module/penghapusan/"; ?>dftr_review_edit_penetapan_usulan_psb.php?id=<?php echo "$row[Penghapusan_ID]";?>" class="btn btn-success btn-small"><i class="fa fa-pencil-square-o"></i> View</a>&nbsp;
							<a target="_blank" href="<?php echo "$url_rewrite/";?>report/template/PENGHAPUSAN/cetak_sk_penghapusan.php?idpenetapan=<?=$row[Penghapusan_ID]?>&sk=<?=$row[NoSKHapus]?>" class="btn btn-info btn-small"><i class="fa fa-file-pdf-o"></i> Report</a>&nbsp;
						
			<?php			}

						?>
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