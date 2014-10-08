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

			echo "<meta http-equiv=\"Refresh\" content=\"0; url={$url_rewrite}/module/perolehan/sp2dtermin.php?id={$idKontrak}\">";

	}

	//getdata
	$sql = mysql_query("SELECT * FROM sp2d WHERE idKontrak='{$idKontrak}' AND type = '1'");
		while ($dataSP2D = mysql_fetch_array($sql)){
				$sp2d[] = $dataSP2D;
			}
	$sql = mysql_query("SELECT SUM(nilai) as total FROM sp2d WHERE idKontrak='{$idKontrak}' AND type = '1'");
		while ($sumsp2d = mysql_fetch_array($sql)){
				$totalsp2d[] = $sumsp2d;
			}
	$sisaKontrak = $kontrak[0]['nilai']-$totalsp2d[0]['total'];

	//end SQL
?>
	
	<section id="main">
	<ul class="breadcrumb">
			  <li><a href="#"><i class="fa fa-home fa-2x"></i>  Home</a> <span class="divider"><b>&raquo;</b></span></li>
			  <li><a href="#">Perolehan Aset</a><span class="divider"><b>&raquo;</b></span></li>
			  <li class="active">SP2D Termin</li>
			  <?php SignInOut();?>
			</ul>
			<div class="breadcrumb">
				<div class="title">SP2D Termin</div>
				<div class="subtitle">Daftar Kontrak</div>
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
								<span class="labelInfo">Total SP2D</span>
								<input type="text" value="<?=isset($totalsp2d) ? number_format($totalsp2d[0]['total']) : '0'?>" disabled/>
							</li>
							<li>
								<span  class="labelInfo">Sisa Kontrak</span>
								<input type="text" value="<?=isset($sisaKontrak) ? number_format($sisaKontrak) : 0?>" disabled/>
							</li>
						</ul>
							
					</div>
			<div style="height:5px;width:100%;clear:both"></div>
			
			<p><a data-toggle="modal" href="#myModal" class="btn btn-info btn-small"><i class="icon-plus-sign icon-white"></i>&nbsp;&nbsp;Tambah SP2D Termin</a>
			&nbsp;</p>	
			<div id="demo">
			<table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
				<thead>
					<tr>
						<th>No</th>
						<th>No. SP2D</th>
						<th>Tanggal</th>
						<th>Nilai</th>
						<th>Keterangan</th>
						<th>Aksi</th>
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
						<a href="#" class="btn btn-info"><i class="icon-edit icon-white"></i></a>
						<a href="#" class="btn btn-success"><i class="icon-edit icon-white"></i></a>
						<a href="#" class="btn btn-danger"><i class="icon-trash icon-white"></i></a></td>
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
				  <h3 id="myModalLabel">Form Tambah SP2D Termin</h3>
				</div>
			<form action="" method="POST">
				<div class="modal-body">
				 <div class="formKontrak">
						<h3 class="grs-bottom"><span class="titleForm">SP2D Termin </span></h3>
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
								<span  class="labelkontrak">Nilai</span>
								<input type="text" name="nilai"/>
							</li>
							<li>
								<span class="labelkontrak">Keterangan</span>
								<textarea name="keterangan"></textarea>
							</li>
						</ul>
							<!-- Hidden -->
							<input type="hidden" name="idKontrak" value="<?=$idKontrak?>" >
							<input type="hidden" name="type" value="1" >
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