<?php
include "../../config/config.php";
$menu_id = 1;
            $SessionUser = $SESSION->get_session_user();
            ($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
            $USERAUTH->FrontEnd_check_akses_menu($menu_id, $Session);
?>
<?php
	include"$path/meta.php";
	include"$path/header.php";
	include"$path/menu.php";

	//SQL Sementara
	$idKontrak = $_GET['id'];
	$sql = mysql_query("SELECT * FROM kontrak WHERE id='{$idKontrak}'");
		while ($dataKontrak = mysql_fetch_array($sql)){
				$kontrak[] = $dataKontrak;
			}

	//getdata
	$RKsql = mysql_query("SELECT * FROM kontrak_rinc WHERE idKontrak = '{$idKontrak}'");
	while ($dataRKontrak = mysql_fetch_array($RKsql)){
				$rKontrak[] = $dataRKontrak;
			}
	foreach ($rKontrak as $key => $value) {
		$sqlnmBrg = mysql_query("SELECT Uraian FROM kelompok WHERE Kode = '{$value['kd_brg']}' LIMIT 1");
		while ($uraian = mysql_fetch_array($sqlnmBrg)){
				$tmp = $uraian;
				$rKontrak[$key]['uraian'] = $tmp['Uraian'];
			}
	}

	$sql = mysql_query("SELECT SUM(nilai) as total FROM sp2d WHERE idKontrak='{$idKontrak}' AND type = '2'");
		while ($dataSP2D = mysql_fetch_array($sql)){
				$sumsp2d[] = $dataSP2D;
			}
	$bop = $sumsp2d[0]['total']/count($rKontrak);

	//sum total 
	$sqlsum = mysql_query("SELECT SUM(total) as total FROM kontrak_rinc WHERE idKontrak = '{$idKontrak}'");
	while ($sum = mysql_fetch_array($sqlsum)){
				$sumTotal = $sum;
			}
		
	//end SQL
?>
	
	<section id="main">
		<div id="breadcrumb"> Pengadaan / Posting Kontrak</div>
		<?php
				if($kontrak[0]['nilai'] != $sumTotal['total']){
					pr("<p style='color:red'>* Total Rincian Barang tidak sama dengan total SPK</p>");
					$disabled = "disabled";
				}
			?>
		<section class="formLegend">
			<div class="titleSp2dTermin">Posting</div>
			<div style="height:5px;width:100%;clear:both"></div>
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
								<span  class="labelInfo">Total Nilai Kontrak</span>
								<input type="text" value="<?=isset($sumTotal) ? number_format($sumTotal['total']) : '0'?>" disabled/>
							</li>
						</ul>
							
					</div>
			<div style="height:5px;width:100%;clear:both"></div>
			
			<p><button data-toggle="modal" href="#myModal" class="btn btn-info btn-small" <?=$disabled?>><i class="icon-upload icon-white"></i>&nbsp;&nbsp;Posting KIB</button>
			&nbsp;
			<a class="btn btn-danger btn-small" disabled><i class="icon-download icon-white"></i>&nbsp;&nbsp;Unpost</a>
			&nbsp;</p>	
			<div id="demo">
			<table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
				<thead>
					<tr>
						<th>No</th>
						<th>Kode Barang</th>
						<th>Nama Barang</th>
						<th>Jumlah</th>
						<th>Harga Satuan</th>
						<th>Total</total>
						<th>Penunjang</th>
						<th>Total Perolehan</th>
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
						<td><?=$value['kd_brg']?></td>
						<td><?=$value['uraian']?></td>
						<td><?=$value['jumlah']?></td>
						<td><?=number_format($value['hrgSatuan'])?></td>
						<td><?=number_format($value['total'])?></td>
						<td><?=number_format($bop)?></td>
						<td><?=number_format($value['total']+$bop)?></td>
						
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
		<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div id="titleForm" class="modal-header" >
				  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				  <h3 id="myModalLabel">&nbsp;</h3>
				</div>
			<form action="" method="POST">
				<div class="modal-body">
				 <div class="formKontrak">
						<p>Sukses</p>
							
					</div>
					
			</div>
			<div class="modal-footer">
			  <button class="btn" data-dismiss="modal">Kembali</button>
			  <button class="btn btn-primary">Ok</button>
			</div>

		</div>        
	</section>
	
<?php
	include"$path/footer.php";
?>