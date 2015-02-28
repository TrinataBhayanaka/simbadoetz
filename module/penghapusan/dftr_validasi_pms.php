<?php
include "../../config/config.php";


$PENGHAPUSAN = new RETRIEVE_PENGHAPUSAN;
//////pr($_SESSION);
$menu_id = 10;
            $SessionUser = $SESSION->get_session_user();
            ($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
            $USERAUTH->FrontEnd_check_akses_menu($menu_id, $Session);

// $get_data_filter = $RETRIEVE->retrieve_kontrak();
// //////pr($get_data_filter);
?>

<?php
	include"$path/meta.php";
	include"$path/header.php";
	include"$path/menu.php";
	
?>
	<!-- SQL Sementara -->
	<?php
		$paging = $LOAD_DATA->paging($_GET['pid']);
		unset($_SESSION['ses_retrieve_filter_'.$menu_id.'_'.$SessionUser['ses_uid']]);
		$parameter = array('menuID'=>$menu_id,'type'=>'','paging'=>$paging);
		// $data = $RETRIEVE->retrieve_daftar_validasi_penghapusan($parameter);
        // //////pr($data);        
	// //////pr($_POST);
	$data = $PENGHAPUSAN->retrieve_validasi_penghapusan_pms($_POST);
	// ////pr($data);

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
			  <li class="active">Daftar Penetapan Penghapusan Pemusnahan Tervalidasi</li>
			  <?php SignInOut();?>
			</ul>
			<div class="breadcrumb">
				<div class="title">Validasi Penghapusan Pemusnahan</div>
				<div class="subtitle">Daftar Penetapan Penghapusan Pemusnahan Tervalidasi</div>
			</div>	

		<div class="grey-container shortcut-wrapper">
				<a class="shortcut-link" href="<?=$url_rewrite?>/module/penghapusan/dftr_usulan_pms.php">
					<span class="fa-stack fa-lg">
				      <i class="fa fa-circle fa-stack-2x"></i>
				      <i class="fa fa-inverse fa-stack-1x">1</i>
				    </span>
					<span class="text">Usulan Penghapusan</span>
				</a>
				<a class="shortcut-link" href="<?=$url_rewrite?>/module/penghapusan/dftr_penetapan_pms.php">
					<span class="fa-stack fa-lg">
				      <i class="fa fa-circle fa-stack-2x"></i>
				      <i class="fa fa-inverse fa-stack-1x">2</i>
				    </span>
					<span class="text">Penetapan Penghapusan</span>
				</a>
				<a class="shortcut-link active" href="<?=$url_rewrite?>/module/penghapusan/dftr_validasi_pms.php">
					<span class="fa-stack fa-lg">
				      <i class="fa fa-circle fa-stack-2x"></i>
				      <i class="fa fa-inverse fa-stack-1x">3</i>
				    </span>
					<span class="text">Validasi Penghapusan</span>
				</a>
			</div>		

		<section class="formLegend">
			<?php
				if($_SESSION['ses_ujabatan']==1){
			?>
			<p><a href="<?=$url_rewrite?>/module/penghapusan/dftr_penetapan_validasi_pms.php" class="btn btn-info btn-small"><i class="icon-plus-sign icon-white"></i>&nbsp;&nbsp;Validasi Penetapan</a>
			&nbsp;
			<?php
				}
			?>
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
						<td align="center">	
						 <!--<a href="<?php echo "$url_rewrite/report/template/PENGHAPUSAN/";?>tes_class_penetapan_aset_yang_dihapuskan.php?menu_id=39&mode=1&id=<?php echo "$row[Penghapusan_ID]";?>" target="_blank">Cetak</a> ||--> 
						<a href="<?php echo "$url_rewrite/module/penghapusan/"; ?>dftr_review_edit_penetapan_usulan_validasi_pms.php?id=<?php echo "$row[Penghapusan_ID]";?>" class="btn btn-success"><i class="fa fa-pencil-square-o"></i> View</a>&nbsp;
						<!-- <a href="<?php echo "$url_rewrite/module/penghapusan/"; ?>penetapan_penghapusan_daftar_hapus_pms.php?id=<?php echo "$row[Penghapusan_ID]";?>" class="btn btn-danger"> <i class="fa fa-trash"></i>
 Hapus</a>   -->
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