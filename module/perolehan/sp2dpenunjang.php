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

	//post
	if(isset($_POST['nosp2d'])){

		foreach ($_POST as $key => $val) {
				$tmpfield[] = $key;
				$tmpvalue[] = "'$val'";
			}
			$field = implode(',', $tmpfield);
			$value = implode(',', $tmpvalue);

			$query = mysql_query("INSERT INTO sp2d ({$field}) VALUES ($value)");

			echo "<meta http-equiv=\"Refresh\" content=\"0; url={$url_rewrite}/module/perolehan/sp2dpenunjang.php?id={$idKontrak}\">";

	}

	//getdata
	$sql = mysql_query("SELECT * FROM sp2d WHERE idKontrak='{$idKontrak}' AND type = '2'");
		while ($dataSP2D = mysql_fetch_array($sql)){
				$sp2d[] = $dataSP2D;
			}
	$sql = mysql_query("SELECT SUM(nilai) as total FROM sp2d WHERE idKontrak='{$idKontrak}' AND type = '1'");
		while ($sumsp2d = mysql_fetch_array($sql)){
				$totalsp2d[] = $sumsp2d;
			}
	$sql = mysql_query("SELECT SUM(nilai) as total FROM sp2d WHERE idKontrak='{$idKontrak}' AND type = '2'");
		while ($sumsp2dP = mysql_fetch_array($sql)){
				$totalsp2dP[] = $sumsp2dP;
			}

	$sisaKontrak = $kontrak[0]['nilai']-$totalsp2d[0]['total'];

	//end SQL
?>
	
	<section id="main">
		<ul class="breadcrumb">
			  <li><a href="#"><i class="fa fa-home fa-2x"></i>  Home</a> <span class="divider"><b>&raquo;</b></span></li>
			  <li><a href="#">Perolehan Aset</a><span class="divider"><b>&raquo;</b></span></li>
			  <li class="active">SP2D Penunjang</li>
			  <?php SignInOut();?>
			</ul>
			<div class="breadcrumb">
				<div class="title">SP2D Penunjang</div>
				<div class="subtitle">Daftar SP2D Penunjang</div>
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
								<span class="labelInfo">Nilai Kontrak</span>
								<input type="text" value="<?=number_format($kontrak[0]['nilai'])?>" disabled/>
							</li>
							<li>
								<span  class="labelInfo">Total SP2D Penunjang</span>
								<input type="text" value="<?=isset($totalsp2dP) ? number_format($totalsp2dP[0]['total']) : '0'?>" disabled/>
							</li>
						</ul>
							
					</div>
			<div style="height:5px;width:100%;clear:both"></div>
			<?php
				if($kontrak[0]['n_status'] != 1){
			?>	
			<p><a href="<?=$url_rewrite?>/module/perolehan/sp2dpenunjangedit.php/?id=<?=$kontrak[0]['id']?>" class="btn btn-info btn-small"><i class="icon-plus-sign icon-white"></i>&nbsp;&nbsp;Tambah SP2D Penunjang</a>
			&nbsp;</p>
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
						<th>No. SP2D</th>
						<th>Tanggal</th>
						<th>Nilai</th>
						<th>Keterangan</th>
						<th>Rincian</th>
					</tr>
				</thead>
				<tbody>
				<?php
					if($sp2d){
						$i = 1;
						foreach ($sp2d as $key => $value) {
							
						
				?>
					<tr class="gradeA">
						<td><?=$i?></td>
						<td><?=$value['nosp2d']?></td>
						<td><?=$value['tglsp2d']?></td>
						<td class="center"><?=number_format($value['nilai'])?></td>
						<td class="center"><?=$value['keterangan']?></td>
						<td class="center">
						<?php
							if($kontrak[0]['n_status'] != 1){
						?>	
						<a href="sp2dpenunjangedit.php?id=<?=$kontrak[0]['id']?>&idsp2d=<?=$value['id']?>" class="btn btn-success btn-small"><i class="icon-pencil icon-white"></i>&nbsp;Edit</a>
						<a href="<?=$url_rewrite?>/module/perolehan/sp2dpenunjang_rinc.php?idsp2d=<?=$value['id']?>&idkontrak=<?=$idKontrak?>" class="btn btn-info btn-small"><i class="icon-edit icon-white"></i>&nbsp;Rincian</a>
						<a href="sp2dterminhapus.php?id=<?=$kontrak[0]['id']?>&idsp2d=<?=$value['id']?>" class="btn btn-danger btn-small" onclick="return confirm('Hapus Kontrak?')"><i class="icon-trash icon-white"></i>&nbsp;Hapus</a>
						<?php
						} else {
							echo "<span class='label label-Success'>Sudah di posting</span>";
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
		<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div id="titleForm" class="modal-header" >
				  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				  <h3 id="myModalLabel">Form Tambah SP2D Penunjang</h3>
				</div>
			<form action="" method="POST">
				<div class="modal-body">
				 <div class="formKontrak">
						<h3 class="grs-bottom"><span class="titleForm">SP2D Penunjang </span></h3>
						<ul>
							<li>
								<span class="labelkontrak">No.SP2D</span>
								<input type="text" name="nosp2d"/>
							</li>
							<li>
								<span class="labelkontrak">Tgl.SP2D</span>
								<input type="text" name="tglsp2d" />
							</li>
							<li>
								<span class="labelkontrak">Keterangan</span>
								<textarea name="keterangan"></textarea>
							</li>
						</ul>
							<!-- Hidden -->
							<input type="hidden" name="idKontrak" value="<?=$idKontrak?>" >
							<input type="hidden" name="type" value="2" >
					</div>
					
			</div>
			<div class="modal-footer">
			  <button class="btn" data-dismiss="modal">Kembali</button>
			  <button class="btn btn-primary">Simpan</button>
			</div>
		</form>
		</div>        
	</section>
	
<?php
	include"$path/footer.php";
?>