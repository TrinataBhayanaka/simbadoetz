<?php
include "../../config/config.php";
$menu_id = 21;
            $SessionUser = $SESSION->get_session_user();
            ($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
            $USERAUTH->FrontEnd_check_akses_menu($menu_id, $Session);

$dataArr = $RETRIEVE->retrieve_koreksi_aset($_GET);
// pr($dataArr);
?>

<?php
	include"$path/meta.php";
	include"$path/header.php";
	include"$path/menu.php";
	
?>
	<!-- SQL Sementara -->
	<?php
		if(isset($_GET['del'])){
			$dataArr = $DELETE->delKoreksiAset($_GET);

		}
		if(isset($_POST['old_kelompok'])){

		      	$dataArr = $STORE->koreksiAset($_POST);

		  }		

		  $dataArr['aset']['kodepemilik'] = substr($dataArr['aset']['kodeLokasi'], 0,2);

		  // pr($dataArr);exit;
	?>
	<!-- End Sql -->
	<script type="text/javascript">
		$(document).ready(function() {

			$('#hrgmask,#total').autoNumeric('init');
			$("select").select2({});
			$( "#tglPerolehan,#tglPembukuan,#tglSurat,#tglDokumen,#tglPerubahan" ).mask('9999-99-99');
			$( "#tglPerolehan,#tglPembukuan,#tglSurat,#tglDokumen,#datepicker,#tglPerubahan,#dp-ex-3" ).datepicker({ format: 'yyyy-mm-dd',autoclose:true,clearBtn:true,forceParse:true });
			setTimeout(function() {
			 	initKondisi();
			}, 1000);
			});	

		function getCurrency(item){
	      $('#hrgSatuan').val($(item).autoNumeric('get'));
	    }
	</script>
	<section id="main">
		<ul class="breadcrumb">
			  <li><a href="#"><i class="fa fa-home fa-2x"></i>  Home</a> <span class="divider"><b>&raquo;</b></span></li>
			  <li><a href="#">Koreksi</a><span class="divider"><b>&raquo;</b></span></li>
			  <li class="active">Koreksi Data Aset</li>
			  <?php SignInOut();?>
			</ul>
			<div class="breadcrumb">
				<div class="title">Koreksi</div>
				<div class="subtitle">Koreksi Data Aset</div>
			</div>		

		<section class="formLegendInve">
			
			<div style="height:5px;width:100%;clear:both"></div>
			

			<div>

			<form action="" method="POST">
				 <div class="detailLeft">
				 	<ul>
				 		<li>
				 			<h2><?=$dataArr['aset']['NamaAset']?></h2>
				 			<h4>No. Register <?=$dataArr['aset']['noRegister']?></h4>
				 		</li>
				 		<li>
					 		<span class="span6">
					 			<ul class="nav nav-pills" role="tablist">
								  <li role="presentation" class="active" id="data"><a href="javascript:void(0)" onclick="return option('data');">Rubah Data</a></li>
								  <li role="presentation" id="kapital"><a href="javascript:void(0)" onclick="return option('kapital');">Kapitalisasi</a></li>
								  <li role="presentation" id="nilai"><a href="javascript:void(0)" onclick="return option('nilai');">Koreksi Nilai</a></li>
								  <li role="presentation" id="kondisi"><a href="javascript:void(0)" onclick="return option('kondisi');">Rubah Kondisi</a></li>
								  <li role="presentation" id="koreksi"><a href="javascript:void(0)" onclick="return option('koreksi');">Reklas</a></li>
								</ul>
							</span>
						</li>
				</ul>
						<ul>
							<li>
								<span class="span2">Kode Pemilik</span>
								<select id="kodepemilik" name="kodepemilik" style="width:255px" class="full" disabled>
									<option value="0" <?=($dataArr['aset']['kodepemilik'] == '0') ? selected : ""?>>0 Pemerintah Pusat</option>
									<option value="11" <?=($dataArr['aset']['kodepemilik'] == '11') ? selected : ""?>>11 Pemerintah Provinsi</option>
									<option value="12" <?=($dataArr['aset']['kodepemilik'] == '12') ? selected : ""?>>12 Pemerintah Kabupaten/Kota</option>
									<option value="13" <?=($dataArr['aset']['kodepemilik'] == '13') ? selected : ""?>>13 Pemerintah Provinsi Lain</option>
									<option value="14" <?=($dataArr['aset']['kodepemilik'] == '14') ? selected : ""?>>14 Pemerintah Kabupaten/Kota Lain</option>
									<option value="15" <?=($dataArr['aset']['kodepemilik'] == '15') ? selected : ""?>>15 Non Pemerintah</option>
								</select>
							</li>
						</ul>
						<ul>	
							<?=selectSatker('kodeSatker','255',true,$dataArr['aset']['kodeSatker'],'disabled');?>
						</ul>
						<ul>
							<?=selectRuang('kodeRuangan','kodeSatker','255',true,$dataArr['aset']['Tahun']."_".$dataArr['aset']['kodeRuangan'],'disabled');?>
						</ul>
						<ul>
							<?php selectAset('kodeKelompok','255',true,$dataArr['aset']['kodeKelompok'],'disabled required'); ?>
						</ul>		
						<ul>
							<!-- <li>
								<span class="span2">Kode Aset</span>
								<input type="text" class="span2" id="kodeKelompok" name="kodeKelompok" value="<?=$dataArr['aset']['kodeKelompok']?>" readonly/>
							</li> -->
							<li>
								<span class="span2">Tgl. Pembelian</span>
								<div class="control">
									<div class="input-prepend">
										<span class="add-on"><i class="fa fa-calendar"></i></span>
										<input type="text" class="span2 full rubahaset" name="tglPerolehan" id="tglPerolehan" value="<?=$dataArr['aset']['TglPerolehan']?>" disabled/>
									</div>
								</div>
							</li>
							<li>
								<span class="span2">Tgl. Pembukuan</span>
								<div class="control">
									<div class="input-prepend">
										<span class="add-on"><i class="fa fa-calendar"></i></span>
										<input type="text" class="span2 full rubahaset" name="tglPembukuan" id="datepicker" value="<?=$dataArr['aset']['TglPembukuan']?>" disabled/>
									</div>
								</div>
							</li>
							<li>
								<span class="span2">Dok. Perubahan</span>
								<input type="text" class="span3" name="dokperubahan" id="dokperubahan" value="<?=$dataArr['aset']['dokperubahan']?>" required/>
							</li>
							<li>
								<span class="span2">Tgl. Perubahan</span>
								<div class="control">
									<div class="input-prepend">
										<span class="add-on"><i class="fa fa-calendar"></i></span>
										<input type="text" class="span2" name="tglPerubahan" id="datepicker2" value="<?=$dataArr['aset']['tglPerubahan']?>" required/>
									</div>
								</div>
							</li>
							<li>
								<span class="span2">Keterangan Koreksi</span>
								<textarea name="GUID" class="span3" id="ketkor"><?=$dataArr['aset']['GUID']?></textarea>
							</li>
						</ul>
						<ul>
							<li>
								<span class="span2">Kondisi</span>
								<select name="kondisi" style="width:155px" class="ubahkondisi" disabled>
									<option></option>
									<option value="1" <?=$dataArr['kib']['kondisi'] == '1' ? 'selected' : ''?>>Baik</option>
									<option value="2" <?=$dataArr['kib']['kondisi'] == '2' ? 'selected' : ''?>>Rusak Ringan</option>
									<option value="3" <?=$dataArr['kib']['kondisi'] == '3' ? 'selected' : ''?>>Rusak Berat</option>
								</select>
							</li>
						</ul>
					</div>
					<div class="detailLeft">
						<div class="well span3">
							<h2>Rubah Data</h2>
							<p>Koreksi data aset yang digunakan khusus untuk melakukan perubahan data rincian aset.</p>
						</div>
					</div>

					<div style="height:5px;width:100%;clear:both"></div>

						<div class="detailLeft">
						<ul>
							<li>
								<span class="span2">Asal Usul</span>
								<select id="asalusul" name="asalusul" style="width:255px" class="koreksi">
									<option></option>
									<optgroup label="Pembelian">
										<option value="Inventarisasi" <?=$dataArr['aset']['AsalUsul'] == 'Inventarisasi' ? 'selected' : ''?>>Inventarisasi</option>
										<option value="perolehan sah lainnya" <?=$dataArr['aset']['AsalUsul'] == 'perolehan sah lainnya' ? 'selected' : ''?>>perolehan sah lainnya</option>
									</optgroup>

									<optgroup label="Hibah">
												<option value="Hibah" <?=$dataArr['aset']['AsalUsul'] == 'Hibah' ? 'selected' : ''?>>Hibah</option>
											<option value="BOS" <?=$dataArr['aset']['AsalUsul'] == 'BOS' ? 'selected' : ''?>>BOS</option>
											<option value="Hibah BOS" <?=$dataArr['aset']['AsalUsul'] == 'Hibah BOS' ? 'selected' : ''?>>Hibah BOS</option>
											<option value="Hibah Komite" <?=$dataArr['aset']['AsalUsul'] == 'Hibah Komite' ? 'selected' : ''?>>Hibah Komite</option>
											<option value="Hibah Pusat" <?=$dataArr['aset']['AsalUsul'] == 'Hibah Pusat' ? 'selected' : ''?>>Hibah Pusat</option>
											<option value="Hibah Provinsi" <?=$dataArr['aset']['AsalUsul'] == 'Hibah Provinsi' ? 'selected' : ''?>>Hibah Provinsi</option>
											<option value="Hibah Pihak ke-3" <?=$dataArr['aset']['AsalUsul'] == 'Hibah Pihak ke-3' ? 'selected' : ''?>>Hibah Pihak ke-3</option>
									</optgroup>
									<optgroup label="Sitaan/ Rampasan">
										<option value="Sitaan/ Rampasan" <?=$dataArr['aset']['AsalUsul'] == 'Sitaan/ Rampasan' ? 'selected' : ''?>>Sitaan/ Rampasan</option>
									</optgroup>
									
									
								
								</select>
							</li>
							<li>&nbsp;</li>
							<li>
								<span class="span2">Alamat</span>
								<textarea name="Alamat" class="span3 rubahaset" ><?=$dataArr['aset']['Alamat']?></textarea>
							</li>
							<li>
								<span class="span2">Jumlah</span>
								<input type="text" class="span3" name="Kuantitas" id="jumlah" value="1" onchange="return totalHrg()" required readonly/>
							</li>
							<li>
								<span class="span2">Harga Satuan</span>
								<!-- <input type="text" class="span3 kapitalisasi" name="Satuan" id="hrgSatuan" value="<?=$dataArr['aset']['Satuan']?>" onchange="return totalHrg()" required readonly/> -->
								<input type="text" class="span3 kapitalisasi" data-a-sign="Rp " id="hrgmask" data-a-dec="," data-a-sep="." value="<?=$dataArr['aset']['NilaiPerolehan']?>" onkeyup="return getCurrency(this);" onchange="return totalHrg();" required readonly/>
								<input type="hidden" name="Satuan" class="kapitalisasi" id="hrgSatuan" value="<?=$dataArr['aset']['NilaiPerolehan']?>" >
							</li>
							<li>
								<span class="span2">Nilai Perolehan</span>
								<!-- <input type="text" class="span3" name="NilaiPerolehan" id="total" value="<?=$dataArr['aset']['NilaiPerolehan']?>" readonly/> -->
								<input type="text" class="span3" name="NilaiPerolehan" data-a-sign="Rp " data-a-dec="," data-a-sep="." id="total" value="<?=$dataArr['aset']['NilaiPerolehan']?>" readonly/>
								<input type="hidden" name="NilaiPerolehan" id="nilaiPerolehan" value="<?=$dataArr['aset']['NilaiPerolehan']?>" readonly>
							</li>
							<li>
								<span class="span2">Info</span>
								<textarea name="Info" class="span3 kapitalisasi" readonly><?=$dataArr['aset']['Info']?></textarea>
							</li>
						</ul>
							
					</div>
					<div class="detailLeft">
						<ul class="tanah" style="display:none">
							<li>
								<span class="span2">Hak Tanah</span>
								<select id="hakpakai" name="HakTanah" style="width:255px" disabled>
									<option></option>
									<option value="Hak Pakai" <?=$dataArr['kib']['HakTanah'] == 'Hak Pakai' ? 'selected' : ''?>>Hak Pakai</option>
									<option value="Hak Pengelolaan" <?=$dataArr['kib']['HakTanah'] == 'Hak Pengelolaan' ? 'selected' : ''?>>Hak Pengelolaan</option>
								</select>
							</li>
							<li>&nbsp;</li>
							<li>
								<span class="span2">Luas (M2)</span>
								<input type="text" class="span3" name="LuasTotal" value="<?=$dataArr['kib']['LuasTotal']?>" disabled/>
							</li>
							<li>
								<span class="span2">No. Sertifikat</span>
								<input type="text" class="span3" name="NoSertifikat" value="<?=$dataArr['kib']['NoSertifikat']?>" disabled/>
							</li>
							<li>
								<span class="span2">Tgl. Sertifikat</span>
								<input type="text" class="span2" name="TglSertifikat" id="datepicker" value="<?=$dataArr['kib']['TglSertifikat']?>" disabled/>
							</li>
							<li>
								<span class="span2">Penggunaan</span>
								<input type="text" class="span3" name="Penggunaan" value="<?=$dataArr['kib']['Penggunaan']?>" disabled/>
							</li>

						</ul>
						<ul class="mesin" style="display:none">
							<li>
								<span class="span2">Merk</span>
								<input type="text" class="span3" name="Merk" value="<?=$dataArr['kib']['Merk']?>" disabled/>
							</li>
							<li>
								<span class="span2">Type</span>
								<input type="text" class="span3" name="Model" value="<?=$dataArr['kib']['Model']?>" disabled/>
							</li>
							<li>
								<span class="span2">Ukuran / CC</span>
								<input type="text" class="span3" name="Ukuran" value="<?=$dataArr['kib']['Ukuran']?>" disabled/>
							</li>
							<li>
								<span class="span2">No. Pabrik</span>
								<input type="text" class="span3" name="Pabrik" value="<?=$dataArr['kib']['Pabrik']?>" disabled/>
							</li>
							<li>
								<span class="span2">No. Mesin</span>
								<input type="text" class="span3" name="NoMesin" value="<?=$dataArr['kib']['NoMesin']?>" disabled/>
							</li>
							<li>
								<span class="span2">No. Polisi</span>
								<input type="text" class="span3" name="NoSeri" value="<?=$dataArr['kib']['NoSeri']?>" disabled/>
							</li>
							<li>
								<span class="span2">No. STNK</span>
								<input type="text" class="span3" name="NoSTNK" value="<?=$dataArr['kib']['NoSTNK']?>" disabled/>
							</li>
							<li>
								<span class="span2">No. BPKB</span>
								<input type="text" class="span3" name="NoBPKB" value="<?=$dataArr['kib']['NoBPKB']?>" disabled/>
							</li>
							<li>
								<span class="span2">Bahan</span>
								<input type="text" class="span3" name="Material" value="<?=$dataArr['kib']['Material']?>" disabled/>
							</li>
							<li>
								<span class="span2">No. Rangka</span>
								<input type="text" class="span3" name="NoRangka" value="<?=$dataArr['kib']['NoRangka']?>" disabled/>
							</li>
						</ul>
						<ul class="bangunan" style="display:none">
							<li>
								<span class="span2">Beton / Tidak</span>
								<select name="Beton" style="width:155px" disabled>
									<option></option>
									<option value="1" <?=$dataArr['kib']['Beton'] == '1' ? 'selected' : ''?>>Beton</option>
									<option value="2" <?=$dataArr['kib']['Beton'] == '2' ? 'selected' : ''?>>Tidak</option>
								</select>
							</li>
							<li>&nbsp;</li>
							<li>
								<span class="span2">Jumlah Lantai</span>
								<input type="text" class="span3" name="JumlahLantai" value="<?=$dataArr['kib']['JumlahLantai']?>" disabled/>
							</li>
							<li>
								<span class="span2">Luas Lantai (M2)</span>
								<input type="text" class="span3" name="LuasLantai" value="<?=$dataArr['kib']['LuasLantai']?>" disabled/>
							</li>
							<li>
								<span class="span2">No. Dokumen</span>
								<input type="text" class="span3" name="NoSurat" value="<?=$dataArr['kib']['NoSurat']?>" disabled/>
							</li>
							<li>
								<span class="span2">Tgl. Dokumen</span>
								<input type="text" class="span2" name="tglSurat" id="tglSurat" value="<?=$dataArr['kib']['tglSurat']?>" disabled/>
							</li>
						</ul>
						<ul class="jaringan" style="display:none">
							<li>
								<span class="span2">Konstruksi</span>
								<input type="text" class="span3" name="Konstruksi" value="<?=$dataArr['kib']['Konstruksi']?>" disabled/>
							</li>
							<li>
								<span class="span2">Panjang (KM)</span>
								<input type="text" class="span2" name="Panjang" value="<?=$dataArr['kib']['Panjang']?>" disabled/>
							</li>
							<li>
								<span class="span2">Lebar (M)</span>
								<input type="text" class="span2" name="Lebar" value="<?=$dataArr['kib']['Lebar']?>" disabled/>
							</li>
							<li>
								<span class="span2">Luas (M2)</span>
								<input type="text" class="span2" name="LuasJaringan" value="<?=$dataArr['kib']['LuasJaringan']?>" disabled/>
							</li>
							<li>
								<span class="span2">No. Dokumen</span>
								<input type="text" class="span3" name="NoDokumen" value="<?=$dataArr['kib']['NoDokumen']?>" disabled/>
							</li>
							<li>
								<span class="span2">Tgl. Dokumen</span>
								<input type="text" class="span2" name="tglDokumen" id="tglDokumen" value="<?=$dataArr['kib']['tglDokumen']?>" disabled/>
							</li>
						</ul>
						<ul class="asetlain" style="display:none">
							<li>
								<span class="span2">Judul</span>
								<input type="text" class="span3" name="Judul" value="<?=$dataArr['kib']['Judul']?>" disabled/>
							</li>
							<li>
								<span class="span2">Pengarang</span>
								<input type="text" class="span3" name="Pengarang" value="<?=$dataArr['kib']['Pengarang']?>" disabled/>
							</li>
							<li>
								<span class="span2">Penerbit</span>
								<input type="text" class="span3" name="Penerbit" value="<?=$dataArr['kib']['Penerbit']?>" disabled/>
							</li>
							<li>
								<span class="span2">Spesifikasi</span>
								<input type="text" class="span3" name="Spesifikasi" value="<?=$dataArr['kib']['Spesifikasi']?>" disabled/>
							</li>
							<li>
								<span class="span2">Asal Daerah</span>
								<input type="text" class="span3" name="AsalDaerah" value="<?=$dataArr['kib']['AsalDaerah']?>" disabled/>
							</li>
							<li>
								<span class="span2">Bahan</span>
								<input type="text" class="span3" name="Material" value="<?=$dataArr['kib']['Material']?>" disabled/>
							</li>
							<li>
								<span class="span2">Ukuran</span>
								<input type="text" class="span3" name="Ukuran" value="<?=$dataArr['kib']['Ukuran']?>" disabled/>
							</li>
						</ul>
						<ul class="kdp" style="display:none">
							<li>
								<span class="span2">Beton / Tidak</span>
								<select name="Beton" style="width:155px" disabled>
									<option></option>
									<option value="1" <?=$dataArr['kib']['Beton'] == '1' ? 'selected' : ''?>>Beton</option>
									<option value="2" <?=$dataArr['kib']['Beton'] == '2' ? 'selected' : ''?>>Tidak</option>
								</select>
							</li>
							<li>&nbsp;</li>
							<li>
								<span class="span2">Jumlah Lantai</span>
								<input type="text" class="span3" name="JumlahLantai" value="<?=$dataArr['kib']['JumlahLantai']?>" disabled/>
							</li>
							<li>
								<span class="span2">Luas Lantai</span>
								<input type="text" class="span3" name="LuasLantai" value="<?=$dataArr['kib']['LuasLantai']?>" disabled/>
							</li>
						</ul>
					</div>
					<!-- hidden -->
					<input type="hidden" name="Aset_ID" value="<?=$dataArr['aset']['Aset_ID']?>">
					<input type="hidden" id="id" >
					<input type="hidden" name="UserNm" value="<?=$_SESSION['ses_uoperatorid']?>">
					<input type="hidden" name="TipeAset" id="TipeAset" value="">
					<input type="hidden" name="old_tabel" value="<?=$dataArr['aset']['TipeAset']?>">
					<input type="hidden" name="noRegister" value="<?=$dataArr['kib']['noRegister']?>">
					<input type="hidden" name="kodeLokasi" value="<?=$dataArr['kib']['kodeLokasi']?>">
					<input type="hidden" name="rubahkondisi" id="rubahkondisi" value="1" disabled>
					<input type="hidden" name="koreksinilai" id="koreksinilai" value="1" disabled>
					<input type="hidden" name="ubahkapitalisasi" id="ubahkapitalisasi" value="1" disabled>
					<input type="hidden" name="rubahdata" id="rubahdata" value="1">
					<input type="hidden" name="pindahruang" id="pindahruang" value="1" disabled>
					<input type="hidden" name="old_kelompok" value = "<?=$dataArr['aset']['kodeKelompok']?>">
					<input type="hidden" name="old_kondisi" value="<?=$dataArr['kib']['kondisi']?>">
					<input type="hidden" name="flagupd" id="flagupd" value="1">
		<div style="height:5px;width:100%;clear:both"></div>		
		<ul>
			<li>
				<span class="span3">
				  <button class="btn" type="reset">Reset</button>

				  <?php
				  	if($_SESSION['ses_ujabatan'] == 1){
				  ?>
				  	<a onclick="return konfirmasigokil()" href="koreksi_data.php?id=<?=$dataArr['aset']['Aset_ID']?>&tbl=<?=$_GET['tbl']?>&del=1"><button type="button" class="btn btn-danger">Hapus</button></a>
				  <?php		
				  	}
				  ?>

				  <button type="submit" id="submit" class="btn btn-primary">Simpan</button></span>
			</li>
		</ul>
					
			
		</form>
		</div>  
			    
		</section> 
		     
	</section>
	
<?php
	include"$path/footer.php";
?>

<script type="text/javascript">
	function konfirmasigokil(){
		var r = confirm("Yakin mau di hapus? Datanya tidak bisa dikembalikan lagi lho");
		if (r == true) {
		    
			r = confirm("Ciyuss nii?");
			if (r == true) {
			    
				r = confirm("Enelan ^^?");
				if (r == true) {
				    
					return true;
				    
				} else {
				    return false;
				}
			    
			} else {
			    return false;
			}

		} else {
		    return false;
		}
	}
	$(document).on('submit', function(){
		var perolehan = $("#total").val();
		var total = $("#totalRB").val();
		var spk = $("#spk").val();
		var str = parseInt(spk.replace(/[^0-9\.]+/g, ""));
		var rb = parseInt(total.replace(/[^0-9\.]+/g, ""));

		var diff = parseInt(perolehan) + parseInt(rb);

		if(diff > str) {
			alert("Total rincian barang melebihi nilai SPK");
			return false;	
		}
	})

	function initKondisi(){	
			$(".rubahaset").removeAttr('readonly');
			$(".rubahaset").removeAttr('disabled');
			var kode = $('#kodeKelompok').val();
			var gol = kode.split(".");
			
			if(gol[0] == '01')
			{
				$("#TipeAset").val('A');
				$(".mesin,.bangunan,.jaringan,.asetlain,.kdp").hide('');
				$(".mesin li > input,.bangunan li > input,.jaringan li > input,.asetlain li > input,.kdp li > input").attr('disabled','disabled');
				$(".mesin li > select,.bangunan li > select,.jaringan li > select,.asetlain li > select,.kdp li > select").attr('disabled','disabled');
				$(".tanah li > select,.tanah li > input").removeAttr('disabled');
				$(".tanah").show('');
				$("#id").attr('name','Tanah_ID');
				$("#id").val("<?=$dataArr['kib']['Tanah_ID']?>");
			} else if(gol[0] == '02')
			{
				$("#TipeAset").val('B');
				$(".tanah,.bangunan,.jaringan,.asetlain,.kdp").hide('');
				$(".tanah li > input,.bangunan li > input,.jaringan li > input,.asetlain li > input,.kdp li > input").attr('disabled','disabled');
				$(".tanah li > select,.bangunan li > select,.jaringan li > select,.asetlain li > select,.kdp li > select").attr('disabled','disabled');
				$(".mesin li > input,.mesin li > select").removeAttr('disabled');
				$(".mesin").show('');
				$("#id").attr('name','Mesin_ID');
				$("#id").val("<?=$dataArr['kib']['Mesin_ID']?>");
			} else if(gol[0] == '03')
			{
				$("#TipeAset").val('C');
				$(".tanah,.mesin,.jaringan,.asetlain,.kdp").hide('');
				$(".tanah li > input,.mesin li > input,.jaringan li > input,.asetlain li > input,.kdp li > input").attr('disabled','disabled');
				$(".tanah li > select,.mesin li > select,.jaringan li > select,.asetlain li > select,.kdp li > select").attr('disabled','disabled');
				$(".bangunan li > input,.bangunan li > select").removeAttr('disabled');
				$(".bangunan").show('');
				$("#id").attr('name','Bangunan_ID');
				$("#id").val("<?=$dataArr['kib']['Bangunan_ID']?>");
			} else if(gol[0] == '04')
			{
				$("#TipeAset").val('D');
				$(".tanah,.mesin,.bangunan,.asetlain,.kdp").hide('');
				$(".tanah li > input,.mesin li > input,.bangunan li > input,.asetlain li > input,.kdp li > input").attr('disabled','disabled');
				$(".tanah li > select,.mesin li > select,.bangunan li > select,.asetlain li > select,.kdp li > select").attr('disabled','disabled');
				$(".jaringan li > input,.jaringan li > select").removeAttr('disabled');
				$(".jaringan").show('');
				$("#id").attr('name','Jaringan_ID');
				$("#id").val("<?=$dataArr['kib']['Jaringan_ID']?>");
			} else if(gol[0] == '05')
			{
				$("#TipeAset").val('E');
				$(".tanah,.mesin,.bangunan,.jaringan,.kdp").hide('');
				$(".tanah li > input,.mesin li > input,.bangunan li > input,.jaringan li > input,.kdp li > input").attr('disabled','disabled');
				$(".tanah li > select,.mesin li > select,.bangunan li > select,.jaringan li > select,.kdp li > select").attr('disabled','disabled');
				$(".asetlain li > input,.asetlain li > select").removeAttr('disabled');
				$(".asetlain").show('');
				$("#id").attr('name','AsetLain_ID');
				$("#id").val("<?=$dataArr['kib']['AsetLain_ID']?>");
			} else if(gol[0] == '06')
			{
				$("#TipeAset").val('F');
				$(".tanah,.mesin,.bangunan,.asetlain,.jaringan").hide('');
				$(".tanah li > input,.mesin li > input,.bangunan li > input,.asetlain li > input,.jaringan li > input").attr('disabled','disabled');
				$(".tanah li > select,.mesin li > select,.bangunan li > select,.asetlain li > select,.jaringan li > select").attr('disabled','disabled');
				$(".kdp li > input,.kdp li > select").removeAttr('disabled');
				$(".kdp").show('');
				$("#id").attr('name','KDP_ID');
				$("#id").val("<?=$dataArr['kib']['KDP_ID']?>");
			} else if(gol[0] == '07') {
				$("#TipeAset").val('G');
				$(".tanah,.mesin,.bangunan,.asetlain,.jaringan,.kdp").hide('');
				$(".tanah li > input,.mesin li > input,.bangunan li > input,.asetlain li > input,.jaringan li > input,.kdp li > input").attr('disabled','disabled');
				$(".tanah li > select,.mesin li > select,.bangunan li > select,.asetlain li > select,.jaringan li > select,.kdp li > select").attr('disabled','disabled');
			} else if(gol[0] == '08') {
				$("#TipeAset").val('H');
				$(".tanah,.mesin,.bangunan,.asetlain,.jaringan,.kdp").hide('');
				$(".tanah li > input,.mesin li > input,.bangunan li > input,.asetlain li > input,.jaringan li > input,.kdp li > input").attr('disabled','disabled');
				$(".tanah li > select,.mesin li > select,.bangunan li > select,.asetlain li > select,.jaringan li > select,.kdp li > select").attr('disabled','disabled');
			}
	}

	$(document).on('change','#kodeKelompok', function(){

		initKondisi();		
		
	});

	function totalHrg(){
		var jml = $("#jumlah").val();
		var hrgSatuan = $("#hrgSatuan").val();
		var total = jml*hrgSatuan;
		$("#total").val(total);
	}

	function option(item){
		$(".nav li").removeAttr('class');
		$("#"+item).attr('class','active');
		if($("#"+item).attr('id') == "data"){
			initKondisi();
			$(".kapitalisasi").attr('readonly','readonly');
			$(".ubahkondisi,.full,#rubahkondisi,#koreksinilai,#pindahruang").attr('disabled','disabled');
			$(".koreksi,#rubahdata,#flagupd").removeAttr('disabled');
			$(".well h2").html("Rubah Data");
			$("#kodeKelompok,#kodeSatker,#kodeRuangan").select2("enable", false);
			$(".rubahaset").removeAttr('readonly');
			$(".rubahaset").removeAttr('disabled');
			$(".well p").html("Koreksi data aset yang digunakan khusus untuk melakukan perubahan data rincian aset.");
		} else if ($("#"+item).attr('id') == "kapital") {
			$("textarea").attr('readonly','readonly');
			$(".tanah li > input,.mesin li > input,.bangunan li > input,.jaringan li > input,.asetlain li > input,.kdp li > input").attr('disabled','disabled');
			$(".kapitalisasi,#ketkor").removeAttr('readonly');
			$("#ubahkapitalisasi").removeAttr('disabled');
			$(".ubahkondisi,.koreksi,.full,#flagupd,#rubahkondisi,#koreksinilai,#rubahdata,#pindahruang").attr('disabled','disabled');
			$(".well h2").html("Kapitalisasi");
			$("#kodeKelompok,#kodeSatker,#kodeRuangan").select2("enable", false);
			$(".well p").html("Koreksi data aset yang digunakan khusus untuk melakukan penambahan nilai aset dengan kondisi tertentu.");
		} else if ($("#"+item).attr('id') == "nilai") {
			$("textarea").attr('readonly','readonly');
			$(".kapitalisasi,#ketkor").removeAttr('readonly');
			$("#koreksinilai").removeAttr('disabled');
			$(".tanah li > input,.mesin li > input,.bangunan li > input,.jaringan li > input,.asetlain li > input,.kdp li > input").attr('disabled','disabled');
			$(".ubahkondisi,.koreksi,.full,#flagupd,#rubahkondisi,#ubahkapitalisasi,#rubahdata,#pindahruang").attr('disabled','disabled');
			$(".well h2").html("Koreksi Nilai");
			$("#kodeKelompok,#kodeSatker,#kodeRuangan").select2("enable", false);
			$(".well p").html("Koreksi data aset yang digunakan khusus untuk melakukan koreksi nilai aset.");
		} else if ($("#"+item).attr('id') == "kondisi") {
			$("textarea").attr('readonly','readonly');
			$(".kapitalisasi").attr('readonly','readonly');
			$(".tanah li > input,.mesin li > input,.bangunan li > input,.jaringan li > input,.asetlain li > input,.kdp li > input").attr('disabled','disabled');
			$(".ubahkondisi,#rubahkondisi").removeAttr('disabled');
			$(".koreksi,.full,#koreksinilai,#flagupd,#ubahkapitalisasi,#rubahdata,#pindahruang").attr('disabled','disabled');
			$(".well h2").html("Rubah Kondisi");
			$("#kodeKelompok,#kodeSatker,#kodeRuangan").select2("enable", false);
			$("#ketkor").removeAttr('readonly');
			$(".well p").html("Koreksi data aset yang digunakan khusus untuk melakukan perubahan kondisi aset.");
		} else if ($("#"+item).attr('id') == "koreksi") {
			initKondisi();
			$("textarea").removeAttr('readonly');
			$(".kapitalisasi").removeAttr('readonly');
			$(".ubahkondisi").removeAttr('disabled');
			$(".koreksi,.full,#pindahruang,#flagupd").removeAttr('disabled');
			$("#rubahkondisi,#koreksinilai,#ubahkapitalisasi,#rubahdata").attr('disabled','disabled');
			$(".well h2").html("Reklas");
			$("#kodeKelompok,#kodeSatker,#kodeRuangan").select2("enable", true);
			$(".well p").html("Koreksi data aset khusus untuk melakukan <b>Reklasifikasi</b> barang. Pergunakan menu ini khusus hanya untuk melakukan reklas, jika bukan dilarang menggunakan menu ini!!");
		}
	}
</script>