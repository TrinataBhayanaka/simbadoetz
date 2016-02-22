<?php
include "../../config/config.php";
$menu_id = 10;
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

		$idTransfer = $_GET['id'];
	$sql = mysql_query("SELECT * FROM transfer WHERE id='{$idTransfer}'");
		while ($dataTransfer = mysql_fetch_assoc($sql)){
				$transfer[] = $dataTransfer;
			}

	//get data
	$RKsql = mysql_query("SELECT * FROM transferaset WHERE transfer_id = '{$idTransfer}'");
	while ($dataRTrs = mysql_fetch_array($RKsql)){
				$rTransfer[] = $dataRTrs;
			}
	if($rTransfer){
		foreach ($rTransfer as $key => $value) {
			$sqlnmBrg = mysql_query("SELECT Uraian FROM kelompok WHERE Kode = '{$value['kodeKelompok']}' LIMIT 1");
			while ($uraian = mysql_fetch_array($sqlnmBrg)){
					$tmp = $uraian;
					$rTransfer[$key]['uraian'] = $tmp['Uraian'];
				}
		}
	}

	//End SQL
?>
	<!-- End Sql -->
	<section id="main">
		<ul class="breadcrumb">
			  <li><a href="#"><i class="fa fa-home fa-2x"></i>  Home</a> <span class="divider"><b>&raquo;</b></span></li>
			  <li><a href="#">Gudang</a><span class="divider"><b>&raquo;</b></span></li>
			  <li><a href="#">Distribusi Barang</a><span class="divider"><b>&raquo;</b></span></li>
			  <li class="active">Rincian Barang</li>
			  <?php SignInOut();?>
			</ul>
			<div class="breadcrumb">
				<div class="title">Rincian Barang</div>
				<div class="subtitle">Daftar Aset</div>
			</div>		

		<section class="formLegend">
			
			<div class="detailLeft">
						
						<ul>
							<li>
								<span class="labelInfo">No. Dokumen</span>
								<input type="text" value="<?=$transfer[0]['noDokumen']?>" disabled/>
							</li>
							<li>
								<span class="labelInfo">Tgl. Distribusi</span>
								<input type="text" value="<?=$transfer[0]['tglDistribusi']?>" disabled/>
							</li>
						</ul>
							
					</div>
			<div class="detailRight">
						
						<ul>
							<li>
								<span class="labelInfo">Kode Satker</span>
								<input type="text" value="<?=$transfer[0]['toSatker']?>" disabled/>
							</li>
						</ul>
							
					</div>
			<div style="height:5px;width:100%;clear:both"></div>
				<?php
				if($transfer[0]['n_status'] == 1){
				} else {	
				?>
				<p><a href="search_aset_filter.php?id=<?=$transfer[0]['id']?>" class="btn btn-info btn-small"><i class="icon-plus-sign icon-white"></i>&nbsp;&nbsp;Tambah Rincian Barang</a>
				&nbsp;</p>
				<?php } ?>
				
			<div id="demo">
			<table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
				<thead>
					<tr>
						<th>No</th>
						<th>Kode Barang</th>
						<th>Nama Barang</th>
						<th>Kode Lokasi</th>
						<th>No. Registrasi</th>
						<th>Jumlah</th>
						<th>Nilai</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
				<?php
					if($rTransfer){
						$i = 1;
						foreach ($rTransfer as $key => $value) {
							
						
				?>
					<tr class="gradeA">
						<td><?=$i?></td>
						<td><?=$value['kodeKelompok']?></td>
						<td><?=$value['uraian']?></td>
						<td class="center"><?=$value['kodeLokasi']?></td>
						<td class="center"><?=$value['noReg_awal']?> s/d <?=$value['noReg_akhir']?></td>
						<td class="center"><?=1+$value['noReg_akhir']-$value['noReg_awal']?></td>
						<td><?=$value['NilaiPerolehan']?></td>
						<td class="center">
						<?php
							if($transfer[0]['n_status'] != 1){
						?>
						<a href="gudang_rincianhapus.php?id=<?=$value['id']?>&tmpthis=<?=$_GET['id']?>" class="btn btn-danger btn-small" onclick="return confirm('Hapus Aset?')"><i class="fa fa-trash"></i>&nbsp;Hapus</a>
						<?php
						} else {
							echo "<span class='label label-Success'>Sudah di validasi</span>";
						}
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