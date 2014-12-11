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
	$idsp2d = $_GET['idsp2d'];
	$sql = mysql_query("SELECT * FROM sp2d WHERE id='{$idsp2d}' LIMIT 1");
		while ($dataSp2d = mysql_fetch_array($sql)){
				$sp2d[] = $dataSp2d;
			}
	$idKontrak = $_GET['idkontrak'];
	$sql = mysql_query("SELECT * FROM kontrak WHERE id='{$idKontrak}'");
		while ($dataKontrak = mysql_fetch_array($sql)){
				$kontrak[] = $dataKontrak;
			}

	//sum total 
	$sqlsum = mysql_query("SELECT SUM(jumlah) as total FROM sp2d_rinc WHERE idsp2d = '{$idsp2d}'");
	while ($sum = mysql_fetch_array($sqlsum)){
				$sumTotal = $sum;
			}	
		
	//post
	if(isset($_POST['kdRekening'])){

		foreach ($_POST as $key => $val) {
				$tmpfield[] = $key;
				$tmpvalue[] = "'$val'";
			}
			$field = implode(',', $tmpfield);
			$value = implode(',', $tmpvalue);

			$query = mysql_query("INSERT INTO sp2d_rinc ({$field}) VALUES ($value)");

			//sum total 
			$sqlsum = mysql_query("SELECT SUM(jumlah) as total FROM sp2d_rinc WHERE idsp2d = '{$_POST['idsp2d']}'");
			while ($sum = mysql_fetch_array($sqlsum)){
						$jmlTotal = $sum;
					}	

			$updquery = mysql_query("UPDATE sp2d SET nilai = '{$jmlTotal['total']}' WHERE id = '{$_POST['idsp2d']}'");
			
			echo "<meta http-equiv=\"Refresh\" content=\"0; url={$url_rewrite}/module/perolehan/sp2dpenunjang_rinc.php?idsp2d={$idsp2d}&idkontrak={$kontrak[0]['id']}\">";

	}

	//getdata
	//ajax rekening
	//###Tipe###
	$sqlTipe = mysql_query("SELECT * FROM koderekening WHERE Kelompok is NULL AND Jenis is NULL AND Objek is NULL AND RincianObjek is NULL ORDER BY KodeRekening_ID");	
	while ($dataTipe = mysql_fetch_array($sqlTipe)){
				$Tipe[] = $dataTipe;
			}
	$sqlrinc = mysql_query("SELECT * FROM sp2d_rinc WHERE idsp2d='{$idsp2d}'");
		while ($datarinc = mysql_fetch_array($sqlrinc)){
				$sp2drinc[] = $datarinc;
			}
	if($sp2drinc){
		foreach ($sp2drinc as $key => $value) {
			$sqlnmBrg = mysql_query("SELECT NamaRekening FROM koderekening WHERE KodeRekening = '{$value['kdRekening']}' LIMIT 1");
			while ($uraian = mysql_fetch_array($sqlnmBrg)){
					$tmp[] = $uraian;
					$sp2drinc[$key]['uraian'] = $tmp[$key]['NamaRekening'];
				}
		}	
	}
		
	//end SQL
?>
	<section id="main">
		<ul class="breadcrumb">
			  <li><a href="#"><i class="fa fa-home fa-2x"></i>  Home</a> <span class="divider"><b>&raquo;</b></span></li>
			  <li><a href="#">Perolehan Aset</a><span class="divider"><b>&raquo;</b></span></li>
			  <li class="active">Rincian SP2D Penunjang</li>
			  <?php SignInOut();?>
			</ul>
			<div class="breadcrumb">
				<div class="title">Rincian SP2D Penunjang</div>
				<div class="subtitle">Rincian SP2D Penunjang</div>
			</div>	
			<div class="grey-container shortcut-wrapper">
				<a class="shortcut-link" href="<?=$url_rewrite?>/module/perolehan/kontrak_simbada.php">
					<span class="fa-stack fa-lg">
				      <i class="fa fa-circle fa-stack-2x"></i>
				      <i class="fa fa-inverse fa-stack-1x">1</i>
				    </span>
					<span class="text">Kontrak</span>
				</a>
				<a class="shortcut-link" href="<?=$url_rewrite?>/module/perolehan/kontrak_rincian.php">
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
			<div style="height:5px;width:100%;clear:both"></div>
			<div class="detailLeft">
						
						<ul>
							<li>
								<span class="labelInfo">No. SP2D</span>
								<input type="text" value="<?=$sp2d[0]['nosp2d']?>" disabled/>
							</li>
							<li>
								<span class="labelInfo">Tgl. SP2D</span>
								<input type="text" value="<?=$sp2d[0]['tglsp2d']?>" disabled/>
							</li>
						</ul>
							
					</div>
			<div class="detailRight">
						
						<ul>
							<li>
								<span class="labelInfo">Nilai Kontrak</span>
								<input type="text" value="<?=number_format($kontrak[0]['nilai'])?>" disabled/>
							</li>
							<li>
								<span  class="labelInfo">Total SP2D Penunjang</span>
								<input type="text" value="<?=isset($sumTotal) ? number_format($sumTotal['total']) : '0'?>" disabled/>
							</li>
						</ul>
							
					</div>
			<div style="height:5px;width:100%;clear:both"></div>
			
			<p><a href="<?=$url_rewrite?>/module/perolehan/sp2dpenunjang_rincedit.php/?idsp2d=<?=$idsp2d?>&idkontrak=<?=$idKontrak?>" class="btn btn-warning btn-small"><i class="icon-plus-sign icon-white"></i>&nbsp;&nbsp;Tambah Rincian SP2D Penunjang</a>
			&nbsp;</p>	
			<div id="demo">
			<table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
				<thead>
					<tr>
						<th>No</th>
						<th>Kode Rekening</th>
						<th>Uraian Rekening</th>
						<th>Nilai</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
				<?php
					if($sp2drinc){
						$i = 1;
						foreach ($sp2drinc as $key => $value) {
							
						
				?>
					<tr class="gradeA">
						<td><?=$i?></td>
						<td><?=$value['kdRekening']?></td>
						<td><?=$value['uraian']?></td>
						<td class="center"><?=number_format($value['jumlah'])?></td>
						<td class="center">
						<a href="<?=$url_rewrite?>/module/perolehan/sp2dpenunjang_rincedit.php/?id=<?=$value['id']?>&idsp2d=<?=$idsp2d?>&idkontrak=<?=$idKontrak?>" class="btn btn-warning btn-small"><i class="icon-pencil icon-white"></i>&nbsp;Edit</a>
						<a href="<?=$url_rewrite?>/module/perolehan/sp2dpenunjang_rinc_hapus.php/?id=<?=$value['id']?>&idsp2d=<?=$idsp2d?>&idkontrak=<?=$idKontrak?>" class="btn btn-danger btn-small" onclick="return confirm('Hapus data?')"><i class="icon-trash icon-white"></i>&nbsp;Hapus</a>
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