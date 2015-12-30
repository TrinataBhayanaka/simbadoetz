<?php
include "../../config/config.php";

$LAYANAN = new RETRIEVE_LAYANAN;

?>

<?php
	include"$path/meta.php";
	include"$path/header.php";
	include"$path/menu.php";
	
	$data = $LAYANAN->retrieve_history_aset($_GET);
	// pr($data);	
	if (!$data){
		?>
		<script>
		alert('Tidak ada histori aset');
		document.location="<?php echo "$url_rewrite/module/layanan/"; ?>lihat_aset_daftar.php";
        
        </script>
		<?php
	}
	// pr($data);
?>
	
	<!-- End Sql -->
	<section id="main">
		<ul class="breadcrumb">
			  <li><a href="#"><i class="fa fa-home fa-2x"></i>  Home</a> <span class="divider"><b>&raquo;</b></span></li>
			  <li><a href="#">Layanan Aset</a><span class="divider"><b>&raquo;</b></span></li>
			  <li class="active">History Aset</li>
			  <?php SignInOut();?>
			</ul>
			<div class="breadcrumb">
				<div class="title">Layanan Aset</div>
				<div class="subtitle">History Aset</div>
			</div>	

		

		<section class="formLegend">
			
		<?php $HELPER_FILTER->back($url_rewrite.'/module/layanan/lihat_aset_daftar.php')?>

			<div class="detailLeft">
						
						<ul>
							<li>
								<span class="labelInfo">No Register</span>
								<input type="text" value="<?=$data[0]['noRegister']?>" disabled/>
							</li>
							<li>
								<span class="labelInfo">Kode Lokasi</span>
								<input type="text" value="<?=$data[0]['kodeLokasi']?>" disabled/>
							</li>

							<li>
								<span class="labelInfo">Nilai Perolehan</span>
								<input type="text" value="<?=number_format($data[0]['NilaiPerolehan'])?>" disabled/>
							</li>
						</ul>
							
					</div>
			<div class="detailRight">
						
						<ul>
							<li>
								<span class="labelInfo">Nama Barang</span>
								<input type="text" value="<?=$data[0]['Uraian']?>" disabled/>
							</li>
							<li>
								<span  class="labelInfo">SKPD</span>
								<input type="text" value="<?=$data[0]['kodeSatker']?>" disabled/>
							</li>
						</ul>
							
					</div>
			<div style="height:5px;width:100%;clear:both"></div>

			
				
			<div id="demo">
			<table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
				<thead>
					<tr>
						<th>No</th>
						<th>Tanggal</th>
						<th>Keterangan</th>
						<th>SKPD</th>
						<th>Nilai Perolehan</th>
						<th>Status</th>
					</tr>
				</thead>
				<tbody>
				<?php
					if($data){
						$i = 1;
						foreach ($data as $key => $value) {
							
						
				?>
					<tr class="gradeA">
						<td><?=$i?></td>
						<td><?=$value['changeDate']?></td>
						<td><?=$value['Nm_Riwayat']?></td>
						<td class="center"><?=$value['kodeSatker']?></td>
						<td class="center"><?=number_format($value['NilaiPerolehan'])?></td>
						<td class="center">
						<?php
							// if($kontrak[0]['n_status'] != 1){
						?>
						<!--<a href="kontrak_rincianubah.php?id=<?=$value['Aset_ID']?>&tmpthis=<?=$_GET['id']?>" class="btn btn-warning btn-small" ><i class="icon-pencil icon-white"></i>&nbsp;Edit</a>-->
						<!-- <a href="kontrak_rincianhapus.php?id=<?=$value['kodeKelompok']?>&idLok=<?=$value['kodeLokasi']?>&tmpthis=<?=$_GET['id']?>" class="btn btn-danger btn-small" onclick="return confirm('Hapus Aset?')"><i class="icon-trash icon-white"></i>&nbsp;Hapus</a> -->
						
						<?php
						// } else {
							echo "<span class='label label-Success'>Berhasil</span>";
						// }
						?>
						</td>
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