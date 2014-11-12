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
			<div class="subtitle">Filter Data</div>
		</div>
		<section class="formLegend">
			
			<form action='gudang_validasi_daftar.php?pid=1' method='post' name='formvalid'>
			<ul>
							<li>
								<span class="span8"><strong>Daftar aset yang akan dikeluarkan dari gudang :</strong></span><br/><hr/>
							</li>
							<li>
								<span class="span2">Transfer ke Satker</span>
								
								<div class="input-append">
									<input type="hidden" name="idgetkelompok" id="idgetkelompok" value="">
									<input type="text" name="lda_skpd" id="lda_skpd" class="span5" readonly="readonly" value="(semua SKPD)">
									<input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" class="btn" value="Pilih" onclick = "showSpoiler(this);">
									<div class="inner" style="display:none;">
									
									<?php
									//include "$path/function/dropdown/radio_function_skpd.php";
									$alamat_simpul_skpd="$url_rewrite/function/dropdown/radio_simpul_skpd.php";
									$alamat_search_skpd="$url_rewrite/function/dropdown/radio_search_skpd.php";
									js_radioskpd($alamat_simpul_skpd, $alamat_search_skpd,"lda_skpd","skpd_id",'skpd','sk');
									$style2="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
									radioskpd($style2,"skpd_id",'skpd','sk');
									?>
									</div>
								</div>
							</li>
							<li>
								<span class="span2">Nomor Dokumen</span>
								<input type="text" name="no_dokumen" id="no_dokumen" style="width:180px;">
							</li>
							<li>
								<span class="span2">Tanggal Proses</span>
								<input id="tanggal1"type="text" name="tanggal_proses"value="" style="width:180px;">
							</li>
							<li>
								<span class="span2">Alasan</span>
								<textarea name="alasan" cols="90" rows="5"></textarea>
							</li>
							<li>
								<span class="span2">No. SPBB</span>
								<input type="text" name="no_spbb" style="width:180px;">
							</li>
							<li>
								<span class="span2">Tanggal SPBB</span>
								<input id="tanggal2"type="text" name="tgl_spbb" value="" style="width:180px;"><br/><hr/>
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
			<div class="detailLeft">
						
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
