<?php
include "../../config/config.php";
$menu_id = 10;
            $SessionUser = $SESSION->get_session_user();
            ($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
            $USERAUTH->FrontEnd_check_akses_menu($menu_id, $Session);

$get_data_filter = $RETRIEVE->retrieve_kontrak();
// pr($get_data_filter);
?>

<?php
	include"$path/meta.php";
	include"$path/header.php";
	include"$path/menu.php";
	
?>
	<!-- SQL Sementara -->
	<?php

		 $sql = mysql_query("SELECT * FROM kontrak ORDER BY id ");
        while ($dataKontrak = mysql_fetch_assoc($sql)){
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

		<div class="grey-container shortcut-wrapper">
				<a class="shortcut-link active" href="<?=$url_rewrite?>/module/perolehan/kontrak_simbada.php">
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
			
			<p><a href="kontrakedit.php" class="btn btn-info btn-small"><i class="icon-plus-sign icon-white"></i>&nbsp;&nbsp;Tambah Kontrak</a>
			&nbsp;
			<a href="pledit.php" class="btn btn-danger btn-small"><i class="icon-plus-sign icon-white"></i>&nbsp;&nbsp;Pembelian Langsung</a>
			&nbsp;</p>	
			<div id="demo">
			<table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
				<thead>
					<tr>
						<th>No</th>
						<th>Nama Satker</th>
						<th>No. Dokumen</th>
						<th>Tanggal</th>
						<th>Jenis Dokumen</th>
						<th>Tipe Aset</th>
						<th>Nilai</th>
						<th width="18%">Action</th>
					</tr>
				</thead>
				<tbody>
					
				<?php
				if($get_data_filter){
					$no = 1;
					foreach($get_data_filter as $val){
				?>
					<tr class="gradeA">
						<td><?=$no?></td>
						<td width="20%"><?=$val['NamaSatker']?></td>
						<td><?=$val['noKontrak']?></td>
						<td><?=$val['tglKontrak']?></td>
						<td><?=($val['tipe_kontrak'] == 2) ? 'Pembelian Langsung' : 'Kontrak'?></td>
						<td><?=$val['tipeAset']?></td>
						<td><?=number_format($val['nilai'])?></td>
						<td class="center">
						<?php
						if($val['n_status'] != 1){
						?>	
							<a href="<?=($val['tipe_kontrak'] == 1) ? 'kontrakedit' : 'pledit'?>.php?id=<?=$val['id']?>" class="btn btn-warning btn-small"><i class="icon-edit icon-white"></i>&nbsp;Ubah</a>
							<a href="kontrakhapus.php?id=<?=$val['id']?>" class="btn btn-danger btn-small"><i class="icon-trash icon-white"></i>&nbsp;Hapus</a>
						<?php
						} else {
							echo "<span class='label label-Success'>Sudah di posting</span>";
						}
						?>
						</td>
						
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
								<input type="text" name="noKontrak" required/>
							</li>
							<li>
								<span class="labelkontrak">Tgl.SPK/Perjanjian Kontrak</span>

								<input type="text" name="tglKontrak" id="datepicker" required/>

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
								<input type="text" name="nilai" required/>
							</li>
							<li>
								<span  class="labelkontrak">Jenis Posting</span>
								<input type="radio" name="tipeAset" value="1"/>&nbsp;Aset Baru
								<input type="radio" name="tipeAset" value="2"/>&nbsp;Kapitalisasi
								<input type="radio" name="tipeAset" value="3"/>&nbsp;Ubah Status
							</li>
						</ul>
							
					</div>
					<div class="formPerusahaan">
						<h3 class="grs-bottom"><i class="fa fa-briefcase"></i>&nbsp;<span>Perusahaan</span></h3>
						<ul>
							<li>
								<span class="labelperusahaan">Nama</span>
								<input type="text" name="nm_p"/>
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
								<input type="text" name="pimpinan_p"/>
							</li>
							<li>
								<span class="labelperusahaan">NPWP</span>
								<input type="text" name="npwp_p" />
							</li>
							<li>
								<span class="labelperusahaan">Bank</span>
								<input type="text" name="bank_p" />
							</li>
							<li>
								<span class="labelperusahaan">Atas Nama</span>
								<input type="text" name="norek_p" />
							</li> 
							<li>
								<span class="labelperusahaan">No.Rekening</span>
								<input type="text" name="norek_pemilik" />
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