<?php
include "../../config/config.php";

$PENGHAPUSAN = new RETRIEVE_PENGHAPUSAN;
		$menu_id = 38;
        ($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
        $SessionUser = $SESSION->get_session_user();
        $USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);
        
        $paging = $LOAD_DATA->paging($_GET['pid']);

// $get_data_filter = $RETRIEVE->retrieve_kontrak();
// //pr($get_data_filter);
				

?>

<?php
	include"$path/meta.php";
	include"$path/header.php";
	include"$path/menu.php";
	
?>
	<!-- SQL Sementara -->
	<?php
			unset($_SESSION['ses_retrieve_filter_'.$menu_id.'_'.$SessionUser['ses_uid']]);
				$parameter = array('menuID'=>$menu_id,'type'=>'','paging'=>$paging);
			// $data = $RETRIEVE->retrieve_daftar_usulan_penghapusan($parameter);
				// //pr($data);
				$query = "select distinct Usulan_ID from UsulanAset where StatusPenetapan = 1 AND Jenis_Usulan = 'HPS'";
				$result  = mysql_query($query) or die (mysql_error());
				while ($dataNew = mysql_fetch_object($result))
				{
					$dataArr[] = $dataNew->Usulan_ID;
				}

$data = $PENGHAPUSAN->retrieve_daftar_usulan_penghapusan_psb($_POST);
//pr($data);

		 // $sql = mysql_query("SELECT * FROM kontrak ORDER BY id ");
   //      while ($dataKontrak = mysql_fetch_assoc($sql)){
   //              $kontrak[] = $dataKontrak;
   //          }
	?>
	<!-- End Sql -->
	<section id="main">
		<ul class="breadcrumb">
			  <li><a href="#"><i class="fa fa-home fa-2x"></i>  Home</a> <span class="divider"><b>&raquo;</b></span></li>
			  <li><a href="#">Penghapusan</a><span class="divider"><b>&raquo;</b></span></li>
			  <li class="active">Daftar Usulan Penghapusan Sebagian</li>
			  <?php SignInOut();?>
			</ul>
			<div class="breadcrumb">
				<div class="title">Usulan Penghapusan Sebagian</div>
				<div class="subtitle">Daftar Usulan Penghapusan Sebagian</div>
			</div>	

		<div class="grey-container shortcut-wrapper">
				<a class="shortcut-link active" href="<?=$url_rewrite?>/module/penghapusan/dftr_usulan_psb.php">
					<span class="fa-stack fa-lg">
				      <i class="fa fa-circle fa-stack-2x"></i>
				      <i class="fa fa-inverse fa-stack-1x">1</i>
				    </span>
					<span class="text">Usulan Penghapusan</span>
				</a>
				<a class="shortcut-link" href="<?=$url_rewrite?>/module/penghapusan/dftr_penetapan_psb.php">
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
			
			<p><a href="filter_aset_usulan_psb.php" class="btn btn-info btn-small"><i class="icon-plus-sign icon-white"></i>&nbsp;&nbsp;Tambah Usulan</a>
			&nbsp;
			<div id="demo">
			<table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
				<thead>
					<tr>
						<th>No</th>
						<th>Nomor Usulan</th>
						<th>Satker</th>
						<th>Jumlah Aset</th>
						<th>Tgl Usulan</th>
						<th>Nilai</th>
						<th>Keterangan</th>
						<th>Status</th>
						<th>Tindakan</th>
					</tr>
				</thead>
				<tbody>		
							 
				 <?php
                                        
					// //pr($dataArr);
					$no=1;	
					// //pr($data);
					if($data){
					foreach($data as $key => $hsl_data){
						
						if($dataArr!="")
							{
								(in_array($hsl_data['Usulan_ID'], $dataArr))   ? $disable = "return false" : $disable = "return true";
							}
					$jmlh=explode(",", $hsl_data[Aset_ID]);
					$jumlahAset=count($jmlh);
				?>
						  
					<tr class="gradeA">
						<td><?php echo "$no";?></td>
						<td><?php echo $hsl_data['NoUsulan'];?></td>
						<td><?php echo $hsl_data['NamaSatkerUsul'];?></td>
						<td>
							<?php echo $jumlahAset;?>
						</td>
						<td><?php $change=$hsl_data[TglUpdate]; $change2=  format_tanggal_db3($change); echo "$change2";?>
						</td>
						<td><?=number_format($hsl_data['TotalNilaiPerolehan'])?>
						</td>
						<td>
							<?=$hsl_data['KetUsulan']?>
						</td>
						<td>
							<?php
								if($hsl_data['StatusPenetapan']==0){
									$label="warning";
									$text="belum diproses";
								}elseif($hsl_data['StatusPenetapan']==1){
									$label="info";
									$text="sudah ditetapkan";
								}
							?>
							<span class="label label-<?=$label?>" ><?=$text?></span>
						</td>
						<td>	
						<?php
						if($hsl_data['StatusPenetapan']==0){
							if($dataArr){
								if($_SESSION['ses_uaksesadmin'] == 1){
									
									if(in_array($hsl_data['Usulan_ID'], $dataArr)){
										echo "&nbsp;";
									}else{
									?>
										<a href="<?php echo "$url_rewrite/module/penghapusan/"; ?>penghapusan_usulan_daftar_proses_hapus_psb.php?id=<?php echo "$hsl_data[Usulan_ID]";?>" onclick="return confirm('Hapus Data');">Hapus</a>
							
									<?php
									}
								}elseif($_SESSION['ses_uoperatorid'] == $hsl_data[UserNm]){
									if(in_array($hsl_data['Pemanfaatan_ID'], $dataArr)){
										echo "&nbsp;";	
									}else{
									?>	
										<a href="<?php echo "$url_rewrite/module/penghapusan/"; ?>penghapusan_usulan_daftar_proses_hapus_psb.php?id=<?php echo "$hsl_data[Usulan_ID]";?>" onclick="return confirm('Hapus Data');">Hapus</a>
									<?php
									}
								}
							}else{
								if($_SESSION['ses_uaksesadmin'] == 1){
								// echo "masukkkkkk";
								?>
									<a href="<?php echo "$url_rewrite/module/penghapusan/"; ?>penghapusan_usulan_daftar_proses_hapus_psb.php?id=<?php echo "$hsl_data[Usulan_ID]";?>" class="btn btn-danger btn-small" onclick="return confirm('Hapus Data');"><i class="fa fa-trash"></i>&nbsp;Hapus</a>
									<a href="<?php echo "$url_rewrite/module/penghapusan/"; ?>dftr_review_edit_aset_usulan_psb.php?id=<?php echo "$hsl_data[Usulan_ID]";?>" class="btn btn-success btn-small" onclick="return confirm('View Data');"><i class="fa fa-pencil-square-o"></i>&nbsp;View</a>
								<?php	
								}elseif($_SESSION['ses_uoperatorid'] == $hsl_data[UserNm]){
								?>
									<a href="<?php echo "$url_rewrite/module/penghapusan/"; ?>penghapusan_usulan_daftar_proses_hapus_psb.php?id=<?php echo "$hsl_data[Usulan_ID]";?>" class="btn btn-danger btn-small" onclick="return confirm('Hapus Data');"><i class="fa fa-trash"></i>&nbsp;Hapus</a>
									<a href="<?php echo "$url_rewrite/module/penghapusan/"; ?>dftr_review_edit_aset_usulan_psb.php?id=<?php echo "$hsl_data[Usulan_ID]";?>" class="btn btn-success btn-small" onclick="return confirm('View Data');"><i class="fa fa-pencil-square-o"></i>&nbsp;View</a>
							
								<?php
								}else{
								echo "&nbsp;";
								}
							}	
						}elseif($hsl_data['StatusPenetapan']==1){
							?>
								<a href="<?php echo "$url_rewrite/module/penghapusan/"; ?>dftr_review_edit_aset_usulan_psb.php?id=<?php echo "$hsl_data[Usulan_ID]";?>" class="btn btn-success btn-small" onclick="return confirm('View Data');"><i class="fa fa-pencil-square-o"></i>&nbsp;View</a>
							<?php
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