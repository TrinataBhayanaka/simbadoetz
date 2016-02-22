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

		$idKontrak = $_GET['id'];
	$sql = mysql_query("SELECT * FROM kontrak WHERE id='{$idKontrak}'");
		while ($dataKontrak = mysql_fetch_assoc($sql)){
				$kontrak[] = $dataKontrak;
			}

	//get data
	$RKsql = mysql_query("SELECT Aset_ID,kodeLokasi, kodeKelompok,TipeAset,MIN(noRegister) as minreg, MAX(noRegister) as maxreg,SUM(Kuantitas) as Kuantitas, SUM(NilaiPerolehan) as NilaiPerolehan FROM aset WHERE noKontrak = '{$kontrak[0]['noKontrak']}' AND (StatusValidasi != 9 OR StatusValidasi IS NULL) AND (Status_Validasi_Barang != 9 OR Status_Validasi_Barang IS NULL) GROUP BY kodeKelompok, kodeLokasi");
	while ($dataRKontrak = mysql_fetch_assoc($RKsql)){
				$rKontrak[] = $dataRKontrak;
			}
	if($rKontrak){
		foreach ($rKontrak as $key => $value) {
			$sqlnmBrg = mysql_query("SELECT Uraian FROM kelompok WHERE Kode = '{$value['kodeKelompok']}' LIMIT 1");
			while ($uraian = mysql_fetch_array($sqlnmBrg)){
					$tmp = $uraian;
					$rKontrak[$key]['uraian'] = $tmp['Uraian'];
				}
		}
	}
	// pr($rKontrak);
	//sum total 
	$sqlsum = mysql_query("SELECT SUM(NilaiPerolehan) as total FROM aset WHERE noKontrak = '{$kontrak[0]['noKontrak']}' AND (StatusValidasi != 9 OR StatusValidasi IS NULL) AND (Status_Validasi_Barang != 9 OR Status_Validasi_Barang IS NULL)");
	while ($sum = mysql_fetch_array($sqlsum)){
				$sumTotal = $sum;
			}

	//End SQL
?>
	<script>
	function totalHrg(){
		var jml = $("#jumlah").val();
		var hrgSatuan = $("#hrgSatuan").val();
		var total = jml*hrgSatuan;
		$("#total").val(total);
	}
	</script>
	<!-- End Sql -->
	<section id="main">
		<ul class="breadcrumb">
			  <li><a href="#"><i class="fa fa-home fa-2x"></i>  Home</a> <span class="divider"><b>&raquo;</b></span></li>
			  <li><a href="#">Perolehan Aset</a><span class="divider"><b>&raquo;</b></span></li>
			  <li><a href="#">Kontrak</a><span class="divider"><b>&raquo;</b></span></li>
			  <li class="active">Rincian Barang</li>
			  <?php SignInOut();?>
			</ul>
			<div class="breadcrumb">
				<div class="title">Rincian Barang</div>
				<div class="subtitle">Daftar Aset</div>
			</div>	

		<div class="grey-container shortcut-wrapper">
				<a class="shortcut-link" href="<?=$url_rewrite?>/module/perolehan/kontrak_simbada.php">
					<span class="fa-stack fa-lg">
				      <i class="fa fa-circle fa-stack-2x"></i>
				      <i class="fa fa-inverse fa-stack-1x">1</i>
				    </span>
					<span class="text">Kontrak</span>
				</a>
				<a class="shortcut-link active" href="<?=$url_rewrite?>/module/perolehan/kontrak_rincian.php">
					<span class="fa-stack fa-lg">
				      <i class="fa fa-circle fa-stack-2x"></i>
				      <i class="fa fa-inverse fa-stack-1x">2</i>
				    </span>
					<span class="text">Rincian Barang</span>
				</a>
				<a class="shortcut-link" href="<?=$url_rewrite?>/module/perolehan/kontrak_sp2d.php">
					<span class="fa-stack fa-lg">
				      <i class="fa fa-circle fa-stack-2x"></i>
				      <i class="fa fa-inverse fa-stack-1x">3</i>
				    </span>
					<span class="text">SP2D</span>
				</a>
				<a class="shortcut-link" href="<?=$url_rewrite?>/module/perolehan/kontrak_penunjang.php">
					<span class="fa-stack fa-lg">
				      <i class="fa fa-circle fa-stack-2x"></i>
				      <i class="fa fa-inverse fa-stack-1x">4</i>
				    </span>
					<span class="text">Penunjang</span>
				</a>
				<a class="shortcut-link" href="<?=$url_rewrite?>/module/perolehan/kontrak_posting.php">
					<span class="fa-stack fa-lg">
				      <i class="fa fa-circle fa-stack-2x"></i>
				      <i class="fa fa-inverse fa-stack-1x">5</i>
				    </span>
					<span class="text">Posting</span>
				</a>
			</div>		

		<section class="formLegend">
			
			<div class="detailLeft">
						
						<ul>
							<li>
								<span class="labelInfo">No. Kontrak</span>
								<input type="text" value="<?=$kontrak[0]['noKontrak']?>" disabled/>
							</li>
							<li>
								<span class="labelInfo">Tgl. Kontrak</span>
								<input type="text" value="<?=$kontrak[0]['tglKontrak']?>" disabled/>
							</li>
						</ul>
							
					</div>
			<div class="detailRight">
						
						<ul>
							<li>
								<span class="labelInfo">Nilai SPK</span>
								<input type="text" value="<?=number_format($kontrak[0]['nilai'])?>" disabled/>
							</li>
							<li>
								<span  class="labelInfo">Total RIncian Barang</span>
								<input type="text" value="<?=isset($sumTotal) ? number_format($sumTotal['total']) : '0'?>" disabled/>
							</li>
						</ul>
							
					</div>
			<div style="height:5px;width:100%;clear:both"></div>

			<?php
				if($kontrak[0]['n_status'] != 1){
					if($kontrak[0]['tipeAset'] == 1){
						$link = "kontrak_rincianedit.php";
						$edit = 1;
					} elseif ($kontrak[0]['tipeAset'] == 2) {
						$link = "search_aset_filter.php";
						$display = "display:none";
						$edit = 2;
					} elseif ($kontrak[0]['tipeAset'] == 3) {
						$link = "search_kdp.php";
						$display = "display:none";
						$edit = 3;
					}
			?>	
				<p>
				<a href="kontrak_barang_detail.php?id=<?=$kontrak[0]['id']?>" class="btn btn-default btn-small" style="<?=$display?>"><i class="fa fa-bars"></i>&nbsp;&nbsp;Tampilan Detail</a>
				<br><br>
				<a href="<?=$link?>?id=<?=$kontrak[0]['id']?>" class="btn btn-info btn-small"><i class="icon-plus-sign icon-white"></i>&nbsp;&nbsp;Tambah Rincian Barang</a>
				&nbsp;
				<a href="importmenu.php?id=<?=$kontrak[0]['id']?>" class="btn btn-success btn-small" style="<?=$display?>"><i class="fa fa-file-excel-o"></i>&nbsp;&nbsp;Import xls</a>
				&nbsp;
				</p>
			<?php
				} else {
					echo "";
				}
			?>
				
			<div id="demo">
			<table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
				<thead>
					<tr>
						<th>No</th>
						<th>Kode Barang</th>
						<th>Nama Barang</th>
						<th>No. Register</th>
						<th>Jumlah</th>
						<th>Total</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
				<?php
					if($rKontrak){
						$i = 1;
						foreach ($rKontrak as $key => $value) {
							
						
				?>
					<tr class="gradeA">
						<td><?=$i?></td>
						<td><?=$value['kodeKelompok']?></td>
						<td><?=$value['uraian']?></td>
						<td class="center"><?=$value['minreg']?> s/d <?=$value['maxreg']?></td>
						<td class="center"><?=$value['Kuantitas']?></td>
						<td class="center"><?=number_format($value['NilaiPerolehan'])?></td>
						<td class="center">
						<?php
							if($kontrak[0]['n_status'] != 1){
								if($edit == 1){
						?>
						<a href="kontrak_rincianubah.php?kdkel=<?=$value['kodeKelompok']?>&kdlok=<?=$value['kodeLokasi']?>&tmpthis=<?=$_GET['id']?>&tbl=<?=$value['TipeAset']?>" class="btn btn-warning btn-small" ><i class="icon-pencil icon-white"></i>&nbsp;Edit</a>
						
						<?php } ?>

						<a href="kontrak_rincianhapus.php?idKel=<?=$value['kodeKelompok']?>&idLok=<?=$value['kodeLokasi']?>&tmpthis=<?=$_GET['id']?>" class="btn btn-danger btn-small" onclick="return confirm('Hapus Aset?')"><i class="icon-trash icon-white"></i>&nbsp;Hapus</a>
						</td>
						<?php
						} else {
							echo "<span class='label label-Success'>Sudah di posting</span>";
						}
						?>
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