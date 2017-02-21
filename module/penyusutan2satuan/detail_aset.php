<?php
include "../../config/config.php";

$LAYANAN = new RETRIEVE_LAYANAN;

?>

<?php
	include"$path/meta.php";
	include"$path/header.php";
	include"$path/menu.php";
	
	$data = $LAYANAN->retrieve_detail_aset($_GET);
	// pr($data);
	if (!$data){
		?>
		<script>
		alert('Tidak ada histori aset');
		document.location="<?php echo "$url_rewrite/module/layanan/"; ?>lihat_aset_daftar.php";
        
        </script>
		<?php
	}
	
	$allowUser = array(1,350);
	$operator = $_SESSION['ses_uoperatorid'];
	$rollbackID = array(28,21,1,3);
	if (in_array($operator, $allowUser)) $allow = true;
	else $allow = false;
?>
	
	<!-- End Sql -->
	<section id="main">
		<ul class="breadcrumb">
			  <li><a href="#"><i class="fa fa-home fa-2x"></i>  Home</a> <span class="divider"><b>&raquo;</b></span></li>
			  <li><a href="#">Log Aset</a><span class="divider"><b>&raquo;</b></span></li>
			  <li class="active">Detail Log  Aset</li>
			  <?php SignInOut();?>
			</ul>
			<div class="breadcrumb">
				<div class="title">Log Aset</div>
				<div class="subtitle">Detail data Aset</div>
			</div>	

		

		<section class="formLegend">
			
		<?php $HELPER_FILTER->back($url_rewrite.'/module/layanan/pemeriksaan_filter_hasil.php?pid=1')?>

			<div class="detailLeft">
				<ul>
					<li>
						<span class="labelInfo">No Register</span>
						<input type="text" value="<?=$data['aset'][0]['noRegister']?>" disabled/>
					</li>
					<li>
						<span class="labelInfo">Kode Lokasi</span>
						<input type="text" value="<?=$data['aset'][0]['kodeLokasi']?>" disabled/>
					</li>

					<li>
						<span class="labelInfo">Nilai Perolehan</span>
						<input type="text" value="<?=number_format($data['aset'][0]['NilaiPerolehan'])?>" disabled/>
					</li>
				</ul>
			</div>
			<div class="detailRight">
				<ul>
					<li>
						<span class="labelInfo">Kode Barang</span>
						<input type="text" value="<?=$data['aset'][0]['kodeKelompok']?>" disabled/>
					</li>
					<li>
						<span  class="labelInfo">SKPD</span>
						<input type="text" value="<?=$data['aset'][0]['kodeSatker']?>" disabled/>
					</li>
				</ul>
							
			</div>
			<div style="height:5px;width:100%;clear:both"></div>
			Tabel Riwayat
			<div id="demo">
			<table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
				<thead>
					<tr>
						<th>Log ID</th>
						<th>Informasi Tambahan</th>
						<th>Tanggal Perubahan</th>
						<th>Keterangan Log</th>
						<th>Nilai Perolehan Awal</th>
						<th>Nilai Perolehan</th>
						<th>Selisih Nilai</th>
						<th>Nilai Buku</th>
						<th>AkumulasiPenyusutan</th>
						<th>PenyusutanPertahun</th>
						<th>TahunPenyusutan</th>
						<th>Masa Manfaat</th>
						<th>Umur Ekonomis</th>


						<th>Kondisi</th>
						<th>Kode KA</th>
						<th>Tanggal Perolehan</th>
						<th>Tanggal Pembukuan</th>
						
						<th>Info</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
				<?php
					if($data['log']){
						$i = 1;
						foreach ($data['log'] as $key => $value) {
						//pr($value);
						$TglPerubahan=$value['TglPerubahan'];
						if($TglPerubahan!="0000-00-00 00:00:00" && $TglPerubahan!=""   ){
						
				?>
					<tr class="gradeA">
						<td><?=$value['log_id']?></td>
						<td><?=$value['data_awal'][0]['kodeSatker']. " - " .$value['data_awal'][0]['Uraian']?><br/>
								<?=$value['kodeSatker']?>
							</td>
						<td><?=$value['TglPerubahan']?></td>
						<td><?="[Kode ". $value['Kd_Riwayat'] .'] - '. $value['Nm_Riwayat']?></td>
						
						<td class="center"><?=number_format($value['NilaiPerolehan_Awal'])?></td>
						<td class="center"><?=number_format($value['NilaiPerolehan'])?></td>
						<?php
							$Selisih=0;//andreas
							if($value['NilaiPerolehan_Awal']!=""||$value['NilaiPerolehan_Awal']!=0){
								$Selisih=$value['NilaiPerolehan']-$value['NilaiPerolehan_Awal'];
							}
						?>
						<td class="center"><?=$Selisih?></td>
						
						<td><?=number_format($value['NilaiBuku'])?></td>
						<td><?=number_format($value['AkumulasiPenyusutan'])?></td>
						<td><?=number_format($value['PenyusutanPerTahun'])?></td>
						<td><?=$value['TahunPenyusutan']?></td>
						<td><?=$value['MasaManfaat']?></td>
						<td><?=$value['UmurEkonomis']?></td>

						<td><?=$value['kondisi']?></td>
						<td><?=$value['kodeKA']?></td>
						<td><?=$value['TglPerolehan']?></td>
						<td><?=$value['TglPembukuan']?></td>
						
						<td><?=$value['Info']?></td>
						<td>
							<?php if (in_array($value['Kd_Riwayat'], $rollbackID)):?>
							<?php if ($allow):?><a href='<?php echo "$url_rewrite/module/layanan/pemeriksaan_edit.php?logid={$value['log_id']}&id={$value['Aset_ID']}&jenisaset={$_GET['jenisaset']}&act=1&tabel=2"?>'><input class="btn btn-warning" type="button" value="Edit"></a><?php endif;?>
							<?php if ($key==0):?><a href='<?php echo "$url_rewrite/module/layanan/pemeriksaan_aksi.php?logid={$value['log_id']}&idaset={$value['Aset_ID']}&jenisaset={$_GET['jenisaset']}&act=2&kd_riwayat={$value['Kd_Riwayat']}&kodeSatker={$value['kodeSatker']}"?>' onclick="return confirmBox('Rollback Data ?')"><input class="btn btn-danger" type="button" value="Rollback"></a><?php endif;?>
							<?php endif;?>
						</td>
					</tr>
				<?php
					}
						$i++;
						}
					}
				?>
				</tbody>
				<tfoot>
					<tr>
						<th colspan="5">&nbsp;</th>
					</tr>
				</tfoot>
			</table>
			</div>
			<!-- <div class="spacer"></div> -->
			
			<div style="height:5px;width:100%;clear:both; margin-top:60px"></div>
			<div id="demo1">
			Tabel Aset
			<table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
				<thead>
					<tr>
						<th>Aset ID</th>
						<th>Nomor Register</th>
						<th>Status Validasi</th>
						<th>Status Validasi Barang</th>
						<th>Nilai Perolehan</th>
						<th>Tahun</th>
						<th>Kondisi</th>
						<th>Kode KA</th>
						<th>Tanggal Perolehan</th>
						<th>Tanggal Pembukuan</th>
						<th>Info</th>
						<?php if ($allow):?><th>Aksi</th><?php endif;?>
					</tr>
				</thead>
				<tbody>
				<?php
					if($data['aset']){
						$i = 1;
						foreach ($data['aset'] as $key => $value) {
							
						
				?>
					<tr class="gradeA">
						<td><?=$value['Aset_ID']?></td>
						<td><?=$value['noRegister']?></td>
						<td><?=$value['StatusValidasi']?></td>
						<td><?=$value['Status_Validasi_Barang']?></td>
						<td class="center"><?=number_format($value['NilaiPerolehan'])?></td>
						<td><?=$value['Tahun']?></td>
						<td><?=$value['kondisi']?></td>
						<td><?=$value['kodeKA']?></td>
						<td class="center"><?=$value['TglPerolehan']?></td>
						<td class="center"><?=$value['TglPembukuan']?></td>
						<td><?=$value['Info']?></td>
						<?php if ($allow):?>
						<td>
							<a href='<?php echo "$url_rewrite/module/layanan/pemeriksaan_edit.php?logid={$value['log_id']}&id={$value['Aset_ID']}&jenisaset={$_GET['jenisaset']}&act=1&tabel=1"?>'><input class="btn btn-warning" type="button" value="Edit"></a>
						</td>
						<?php endif;?>
					</tr>
				<?php
						$i++;
						}
					}	
				?>
				</tbody>
				<tfoot>
					<tr>
						<th colspan="5">&nbsp;</th>
					</tr>
				</tfoot>
			</table>
			</div>
			<div class="spacer"></div>

			<div style="height:5px;width:100%;clear:both"></div>
			<div id="demo2">
			Tabel KIB
			<table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
				<thead>
					<tr>
						<th>Aset ID</th>
						<th>Nomor Register</th>
						<th>Status Tampil</th>
						<th>Status Validasi</th>
						<th>Status Validasi Barang</th>
						<th>Nilai Perolehan</th>
						<th>Tahun</th>
						<th>Kondisi</th>
						<th>Kode KA</th>
						<th>Tanggal Perolehan</th>
						<th>Tanggal Pembukuan</th>
						<th>Info</th>

					</tr>
				</thead>
				<tbody>
				<?php
					if($data['kib']){
						$i = 1;
						foreach ($data['kib'] as $key => $value) {
							
						
				?>
					<tr class="gradeA">
						<td><?=$value['Aset_ID']?></td>
						<td><?=$value['noRegister']?></td>
						<td><?=$value['StatusTampil']?></td>
						<td><?=$value['StatusValidasi']?></td>
						<td><?=$value['Status_Validasi_Barang']?></td>
						<td class="center"><?=number_format($value['NilaiPerolehan'])?></td>
						<td><?=$value['Tahun']?></td>
						<td><?=$value['kondisi']?></td>
						<td><?=$value['kodeKA']?></td>
						<td class="center"><?=$value['TglPerolehan']?></td>
						<td class="center"><?=$value['TglPembukuan']?></td>
						<td><?=$value['Info']?></td>
					</tr>
				<?php
						$i++;
						}
					}	
				?>
				</tbody>
				<tfoot>
					<tr>
						<th colspan="5">&nbsp;</th>
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