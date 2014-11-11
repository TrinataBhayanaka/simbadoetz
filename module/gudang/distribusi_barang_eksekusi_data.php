<?php
include "../../config/config.php";

?>

<?php
	include"$path/meta.php";
	include"$path/header.php";
	include"$path/menu.php";
	
?>
	<section id="main">
		<ul class="breadcrumb">
		  <li><a href="#"><i class="fa fa-home fa-2x"></i>  Home</a> <span class="divider"><b>&raquo;</b></span></li>
		  <li><a href="#">Gudang</a><span class="divider"><b>&raquo;</b></span></li>
		  <li class="active">Distribusi Barang</li>
		  <?php SignInOut();?>
		</ul>
		<div class="breadcrumb">
			<div class="title">Distribusi Barang</div>
			<div class="subtitle">Transfer SKPD</div>
		</div>
		<section class="formLegend">
			
			<form action='gudang_validasi_daftar.php?pid=1' method='post' name='formvalid'>
			<ul>
				<?=selectSatker('toSatker','205',true,false);?>
			</ul>
			<ul>
							<li>
								<span class="span2">Nomor Dokumen</span>
								<input type="text" name="no_dokumen" id="no_dokumen" style="width:205px;" required>
							</li>
							<li>
								<span class="span2">Tanggal Proses</span>
								<input type="text" id="datepicker" name="tanggal_proses"value="" style="width:205px;" required>
							</li>
							<li>
								<span class="span2">Alasan</span>
								<textarea name="alasan" cols="90" rows="5"></textarea>
							</li>
							
						</ul>
						
						</form>
						<div style="height:5px;width:100%;clear:both"></div>
			<div class="detailLeft">
						
						<ul>
							<li>
								<span class="span2"><strong>Pihak Penyimpan</strong></span><br/><hr/>
							</li>
							<li>
								<span class="span2">Nama</span>
								<input type="text" name="nama_penyimpan" >
								
							</li>
							<li>
								<span class="span2">Pangkat/Golongan</span>
								<input type="text" name="pangkat_penyimpan" >
							</li>
							<li>
								<span class="span2">NIP</span>
								<input type="text" name="nip_penyimpan" >
							</li>
							<li>
								<span class="span2">Nama Atasan</span>
								<input type="text" name="nama_atasan" >
							</li>
							<li>
								<span class="span2">Pangkat/Golongan</span>
								<input type="text" name="pangkat_atasan_penyimpan" >
							</li>
							<li>
								<span class="span2">NIP</span>
								<input type="text" name="nip_atasan_penyimpan" >
							</li>
							<li>
								<span class="span2">Jabatan</span>
								<input type="text" name="jabatan_penyimpan" >
							</li>
						</ul>
							
					</div>
			<div class="detailRight">
						
						<ul>
							
							<li>
								<span class="span2"><strong>Pihak Pengurus</strong></span><br/><hr/>
							</li>
							<li>
								<span class="span2">Nama</span>
								<input type="text" name="nama_pengurus" >
							</li>
							<li>
								<span class="span2">Pangkat/Golongan</span>
								<input type="text" name="pangkat_pengurus" >
							</li>
							<li>
								<span class="span2">NIP</span>
								<input type="text" name="nip_pengurus">
							</li>
						</ul>
							
					</div>
			<div style="height:5px;width:100%;clear:both"></div>
			
							<ul>
							<li>
								<span class="span2">&nbsp;</span>
								<input type="submit" name="Lanjut" class="btn btn-primary" value="Tampilkan Data" />
								<input type="reset" name="reset" class="btn" value="Bersihkan Data">
							</li>
							</ul>
			
		</section>     
	</section>
	
<?php
	include"$path/footer.php";
?>
