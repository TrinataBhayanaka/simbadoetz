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
	
?>
	<!-- SQL Sementara -->
	<?php

		if(isset($_POST['noKontrak'])){

			if($_POST['s_posting'] == "on") $_POST['s_posting'] = 1; else $_POST['s_posting'] = 2; 

			foreach ($_POST as $key => $val) {
				$tmpfield[] = $key;
				$tmpvalue[] = "'$val'";
			}
			$field = implode(',', $tmpfield);
			$value = implode(',', $tmpvalue);

			$query = mysql_query("INSERT INTO kontrak ({$field}) VALUES ($value)");

			echo "<meta http-equiv=\"Refresh\" content=\"0; url={$url_rewrite}/module/perolehan/kontrak_simbada.php\">";

		}

		$sql = mysql_query("SELECT * FROM kontrak");
		while ($dataKontrak = mysql_fetch_array($sql)){
				$kontrak[] = $dataKontrak;
			}
	?>
	<!-- End Sql -->
	<section id="main">
		<ul class="breadcrumb">
			  <li><a href="#"><i class="fa fa-home fa-2x"></i>  Home</a> <span class="divider"><b>&raquo;</b></span></li>
			  <li><a href="#">Perolehan Aset</a><span class="divider"><b>&raquo;</b></span></li>
			  <li class="active">Kontrak</li>
			  <?php SignInOut();?>
			</ul>
			<div class="breadcrumb">
				<div class="title">Kontrak</div>
				<div class="subtitle">Daftar Kontrak</div>
			</div>	
			<!-- <div id="tmm-form-wizard" class="container substrate">

					<div class="row stage-container">

						<div class="stage tmm-current col-md-2 col-sm-2">
							<div class="stage-header"></div>
							<div class="stage-content">
								<h3 class="stage-title">Unit Organisasi</h3>
								
							</div>
						</div>
						
						<div class="stage tmm-current col-md-3 col-sm-3">
							<div class="stage-header"></div>

							<div class="stage-content">
								<h3 class="stage-title">Kontrak / SPK</h3>
								
							</div>
						</div>

						<div class="stage col-md-3 col-sm-3">
							<div class="stage-header"></div>
							<div class="stage-content">
								<h3 class="stage-title">SP2D Termin</h3>
								
							</div>
						</div>
						
						<div class="stage col-md-2 col-sm-2">
							<div class="stage-header"></div>
							<div class="stage-content">
								<h3 class="stage-title">SP2D Penunjang</h3>
								
							</div>
						</div>
											

					</div>

				</div> -->

		<div class="grey-container shortcut-wrapper">
				<a class="shortcut-link" href="#">
					<span class="fa-stack fa-lg">
				      <i class="fa fa-circle fa-stack-2x"></i>
				      <i class="fa fa-inverse fa-stack-1x">1</i>
				    </span>
					<span class="text">Kontrak</span>
				</a>
				<a class="shortcut-link" href="#">
					<span class="fa-stack fa-lg">
				      <i class="fa fa-circle fa-stack-2x"></i>
				      <i class="fa fa-inverse fa-stack-1x">2</i>
				    </span>
					<span class="text">Rincian Barang</span>
				</a>
				<a class="shortcut-link" href="#">
					<span class="fa-stack fa-lg">
				      <i class="fa fa-circle fa-stack-2x"></i>
				      <i class="fa fa-inverse fa-stack-1x">3</i>
				    </span>
					<span class="text">SP2D</span>
				</a>
				<a class="shortcut-link" href="#">
					<span class="fa-stack fa-lg">
				      <i class="fa fa-circle fa-stack-2x"></i>
				      <i class="fa fa-inverse fa-stack-1x">4</i>
				    </span>
					<span class="text">Penunjang</span>
				</a>
				<a class="shortcut-link" href="#">
					<span class="fa-stack fa-lg">
				      <i class="fa fa-circle fa-stack-2x"></i>
				      <i class="fa fa-inverse fa-stack-1x">5</i>
				    </span>
					<span class="text">Posting</span>
				</a>
			</div>		

		<section class="formLegend">
			
			<p><a data-toggle="modal" href="#myModal" class="btn btn-info btn-small"><i class="icon-plus-sign icon-white"></i>&nbsp;&nbsp;Tambah Kontrak</a>
			&nbsp;
			<!-- <a class="btn btn-danger btn-small"><i class="icon-plus-sign icon-white"></i>&nbsp;&nbsp;Kontrak Simral</a>
			&nbsp; --></p>	
			<div id="demo">
			<table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
				<thead>
					<tr>
						<th>No</th>
						<th>No. SPK/Perjanjian Kontrak</th>
						<th>Tanggal</th>
						<th>Tipe Aset</th>
						<th>Nilai</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					
				<?php
				if($kontrak){
					$no = 1;
					foreach($kontrak as $val){
				?>
					<tr class="gradeA">
						<td><?=$no?></td>
						<td><?=$val['noKontrak']?></td>
						<td><?=$val['tglKontrak']?></td>
						<td class="center"><?=$val['keterangan']?></td>
						<td class="center">
						<a href="<?=$url_rewrite?>/module/perolehan/kontrak_rincian.php?id=<?=$val['id']?>" class="btn btn-success"><i class="icon-edit icon-white"></i>&nbsp;Tambah</a></td>
						<td class="center">
						<a href="<?=$url_rewrite?>/module/perolehan/sp2dtermin.php?id=<?=$val['id']?>" class="btn btn-info"><i class="icon-edit icon-white"></i>&nbsp;Tambah</a></td>
						<td class="center">
						<a href="<?=$url_rewrite?>/module/perolehan/sp2dpenunjang.php?id=<?=$val['id']?>" class="btn btn-danger"><i class="icon-edit icon-white"></i>&nbsp;Tambah</a></td>
						<td class="center">
						<a href="<?=$url_rewrite?>/module/perolehan/posting.php?id=<?=$val['id']?>" class="btn btn-default">&nbsp;Post</a></td>
					</tr>
				<?php
					$no++;
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
		<div id="myModal" class="modal hide fade modalkontrak" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div id="titleForm" class="modal-header" >
				  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				  <h3 id="myModalLabel"><i class="fa fa-plus-square"></i>&nbsp;Form Tambah Kontrak</h3>
				</div>
				<form action="" method="POST">
				<div class="modal-body">
				 <div class="formKontrak">
						<h3 class="grs-bottom"><i class="fa fa-file-text"></i>&nbsp;<span>Kontrak</span></h3>
						<ul>
							<li>
								<span class="labelkontrak">No.SPK/Perjanjian Kontrak</span>
								<input type="text" name="noKontrak"/>
							</li>
							<li>
								<span class="labelkontrak">Tgl.SPK/Perjanjian Kontrak</span>

								<input type="text" name="tglKontrak" id="datepicker"/>

							</li>
							<li>
								<span class="labelkontrak">Keterangan</span>
								<textarea name="keterangan"></textarea>
							</li>
							<li>
								<span  class="labelkontrak">Jangka Waktu</span>
								<input type="text" name="jangkaWkt"/>
							</li>
							<li>
								<span  class="labelkontrak">Nilai</span>
								<input type="text" name="nilai"/>
							</li>
							<li>
								<span  class="labelkontrak">Jenis Posting</span>
								<input type="radio" name="s_posting"/>&nbsp;Aset Baru
								<input type="radio" name="s_posting" />&nbsp;Kapitalisasi
								<input type="radio" name="s_posting" />&nbsp;Ubah Status
							</li>
						</ul>
							
					</div>
					<div class="formPerusahaan">
						<h3 class="grs-bottom"><i class="fa fa-briefcase"></i>&nbsp;<span>Perusahaan</span></h3>
						<ul>
							<li>
								<span class="labelperusahaan">Nama</span>
								<input type="text" name="nm_company"/>
							</li>
							<li>
								<span class="labelperusahaan">Bentuk</span>
								<input type="text" name="bentuk"/>
							</li>
							<li>
								<span class="labelperusahaan">Alamat</span>
								<input type="text" name="alamat"/>
							</li>
							<li>
								<span class="labelperusahaan">Pimpinan</span>
								<input type="text" name="pimpinan_comp"/>
							</li>
							<li>
								<span class="labelperusahaan">NPWP</span>
								<input type="text" name="npwp_comp" />
							</li>
							<li>
								<span class="labelperusahaan">Bank</span>
								<input type="text" name="bank_comp" />
							</li>
							<li>
								<span class="labelperusahaan">Atas Nama</span>
								<input type="text" name="pemilik_rek" />
							</li> 
							<li>
								<span class="labelperusahaan">No.Rekening</span>
								<input type="text" name="no_rek_comp" />
							</li>
						</ul>
					</div>
					
				</div>
			
			<div class="modal-footer">
			  <button class="btn" data-dismiss="modal">Kembali</button>
			  <button type="submit" class="btn btn-primary">Simpan</button>
			</div>
			</form>
		</div>        
	</section>
	
<?php
	include"$path/footer.php";
?>