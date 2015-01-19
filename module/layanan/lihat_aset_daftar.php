<?php
include "../../config/config.php";

$LAYANAN = new RETRIEVE_LAYANAN;
// pr($_POST);exit;
// $menu_id = 51;
$SessionUser = $SESSION->get_session_user();
$USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);
?>
<?php
	include"$path/meta.php";
	include"$path/header.php";
	include"$path/menu.php";
	
	$resetDataView = $DBVAR->is_table_exists('penghapusan_filter_'.$SessionUser['ses_uoperatorid'], 0);
	
	if ($_POST['submit']){
               // pr($_POST);
               // exit;
		
		/*
				if ($_POST['kd_idaset'] == "" && $_POST['kd_namaaset'] == "" && $_POST['kd_nokontrak'] == "" && $_POST['kd_tahun'] == "" && $_POST['skpd_id'] == "" && $_POST['lokasi_id'] == "" && $_POST['kelompok_id5'] == "") {
                    ?>
                    <script>var r=confirm('Tidak ada isian filter');
                         if (r==false)
                         {
                              document.location="<?php echo "$url_rewrite/module/layanan/"; ?>lihat_aset_filter.php";
                         }
                    </script>
				<?php
					}
	*/


	}
				
    $filterParam = $SESSION->smartFilter('layanan');
	$data = $LAYANAN->retrieve_layanan_aset_daftar($filterParam);	
	// pr($data);
	if ($data){
		foreach ($data as $key => $value) {
			if ($value['Status_Validasi_Barang']==1) $data[$key]['statusAset'] = "Terdistribusi";
			else $data[$key]['statusAset'] = "Belum Terdistribusi";
		}
	}
	// exit;		
			?>


          <section id="main">
			<ul class="breadcrumb">
			  <li><a href="#"><i class="fa fa-home fa-2x"></i>  Home</a> <span class="divider"><b>&raquo;</b></span></li>
			  <li><a href="#">Layanan Umum</a><span class="divider"><b>&raquo;</b></span></li>
			  <li class="active">Lihat Daftar Aset</li>
			  <?php SignInOut();?>
			</ul>
			<div class="breadcrumb">
				<div class="title">Lihat Daftar Aset</div>
				<div class="subtitle">Daftar Aset</div>
			</div>
		<section class="formLegend">
			
			<!--
			<div class="detailLeft">
					<span class="label label-success">Filter data : <span class="badge badge-warning"><?php echo $_SESSION['parameter_sql_total'] ?></span> Record</span>
			</div>
			-->
		<?php $HELPER_FILTER->back($link=$url_rewrite.'/module/layanan/lihat_aset_filter.php',$val='Kembali ke halaman utama : Cari aset',$page=1)?>
			<!--
			<div class="detailRight">
						
						<ul>
							<li>
								<a href="<?php echo "$url_rewrite/module/layanan/lihat_aset_filter.php?pid=1"; ?>">
									   <input type="submit" name="Lanjut" class="btn" value="Kembali ke halaman utama : Cari aset" >
								 </a>
							</li>
							<li>
								<input type="hidden" class="hiddenpid" value="<?php echo @$_GET['pid'] ?>">
								  <input type="hidden" class="hiddenrecord" value="<?php echo @$count ?>">
								   <ul class="pager">
										<li><a href="#" class="buttonprev" >Previous</a></li>
										<li>Page</li>
										<li><a href="#" class="buttonnext">Next</a></li>
									</ul>
							</li>
						</ul>
							
			</div>-->

			<div style="height:5px;width:100%;clear:both"></div>
			
			
			<div id="demo">
			<table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
				<thead>
					<tr>
						<th>No</th>
						<th>Informasi aset</th>
						<th>Status aset</th>
						
					</tr>
				</thead>
				<tbody>		
							 
				<?php
				// pr($data);
				if (!empty($data)) {
					$nomor = 1;
					$page = @$_GET['pid'];
					if ($page > 1){
						$nomor = intval($page - 1 .'01');
					}else{
						$nomor = 1;
					}
					 foreach ($data as $key => $value) {
						  // echo"<pre>";
						  // print_r($value);
						  ?>
					
					<tr class="gradeA">
						<td><?php echo $nomor;?></td>
						<td>
							 <table align="center" border="0" width="100%">
								<tr>
									<td width="20%">No Register</td>
									<td><?php echo $value['noRegister'] ?></td>
									
								</tr>
								<tr>
									<td>Kode Kelompok</td>
									<td><?php echo $value['kodeKelompok'] ?></td>
								</tr>
								<tr>
									<td width="20%">Uraian</td>
									<td><?php echo $value['Uraian'] ?></td>
								</tr>
								<tr>
									<td>No Kontrak</td>
									<td><?php echo $value['noKontrak'];?></td>
								</tr>
								<tr>
									<td>Satker</td>
									<td><?php echo $value['kodeSatker'];?> <?php echo $value['NamaSatker'];?></td>
								</tr>
								
								<tr>
									<td>Info</td>
									<td><?php echo $value['Info'];?></td>
								</tr>
								<tr>
									<td>Kondisi</td>
									<td><?php echo $value['Kondisi_ID'] . '-' . $value['InfoKondisi'] ?></td>
								</tr>
							</table>
						</td>
						<td>
							<?php echo $value['statusAset']?>
							<?php if ($value['Status_Validasi_Barang']==1){?>

							<a href="<?php echo "$url_rewrite/module/layanan/history_aset.php?id=$value[Aset_ID]&jenisaset=$value[TipeAset]"; ?>">
									   <input type="submit" name="Lanjut" class="btn" value="Lihat Histori" >
								 </a>
							<?php } ?>
						</td>
						
					</tr>

					
					
				     <?php
						  $nomor++;
					 }
				}
				?>
				</tbody>
				<tfoot>
					<tr>
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