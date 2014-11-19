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

		if(isset($_POST['kodeKelompok'])){

		      	$dataArr = $STORE->koreksiAset($_POST);

		  }		

	?>
	<!-- End Sql -->
	<script type="text/javascript">
		$(document).ready(function() {
			$("select").select2({});
			$( "#tglSurat,#tglDokumen" ).datepicker({ dateFormat: 'yy-mm-dd' });
			initKondisi();
			});	
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
					 		<span class="span6">
					 			<ul class="nav nav-pills" role="tablist">
								  <li role="presentation" class="active" id="data"><a href="#" onclick="return option('data');">Rubah Data</a></li>
								  <li role="presentation" id="kapital"><a href="#" onclick="return option('kapital');">Kapitalisasi</a></li>
								  <li role="presentation" id="nilai"><a href="#" onclick="return option('nilai');">Koreksi Nilai</a></li>
								  <li role="presentation" id="kondisi"><a href="#" onclick="return option('kondisi');">Rubah Kondisi</a></li>
								</ul>
							</span>
						</li>
				</ul>
						<ul>
							<li>
								<span class="span2">Kode Pemilik</span>
								<select id="kodepemilik" name="kodepemilik" style="width:255px">
									<option value="0">0 Pemerintah Pusat</option>
									<option value="11">11 Pemerintah Provinsi</option>
									<option value="12" selected>12 Pemerintah Kabupaten/Kota</option>
									<option value="13">13 Pemerintah Provinsi Lain</option>
									<option value="14">14 Pemerintah Kabupaten/Kota Lain</option>
									<option value="15">15 Non Pemerintah</option>
								</select>
							</li>
						</ul>
						<ul>	
							<li>
								<span class="span2">Kode Satker</span>
								<input type="text" name="kodeSatker" id="kodeSatker" value="<?=$dataArr['aset']['kodeSatker']?>" readonly>
							</li>	
						</ul>	
						<ul>	
							<li>
								<span class="span2">Kode Barang</span>
								<input type="text" name="kodeKelompok" id="kodeKelompok" value="<?=$dataArr['aset']['kodeKelompok']?>" readonly>
							</li>
						</ul>
						<ul>
							<li>
								<span class="span2">Tgl. Pembelian</span>
								<div class="control">
									<div class="input-prepend">
										<span class="add-on"><i class="fa fa-calendar"></i></span>
										<input type="text" class="span2" name="tglPerolehan" id="tglPerolehan" value="<?=$dataArr['aset']['TglPerolehan']?>" readonly/>
									</div>
								</div>
							</li>
							<li>
								<span class="span2">Tgl. Pembukuan</span>
								<div class="control">
									<div class="input-prepend">
										<span class="add-on"><i class="fa fa-calendar"></i></span>
										<input type="text" class="span2" name="tglPembukuan" id="tglPembukuan" value="<?=$dataArr['aset']['TglPembukuan']?>" readonly/>
									</div>
								</div>
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
							<li>&nbsp;</li>
						</ul>
					</div>

					<div style="height:5px;width:100%;clear:both"></div>

						<div class="detailLeft">
						<ul>
							<li>
								<span class="span2">Asal Usul</span>
								<select id="asalusul" name="asalusul" style="width:255px" disabled>
									<option></option>
									<option value="Pembelian" <?=$dataArr['aset']['AsalUsul'] == 'Pembelian' ? 'selected' : ''?>>Pembelian</option>
									<option value="Hibah" <?=$dataArr['aset']['AsalUsul'] == 'Hibah' ? 'selected' : ''?>>Hibah</option>
								</select>
							</li>
							<li>&nbsp;</li>
							<li>
								<span class="span2">Alamat</span>
								<textarea name="Alamat" class="span3 rubahaset" ><?=$dataArr['aset']['Alamat']?></textarea>
							</li>
							<li>
								<span class="span2">Jumlah</span>
								<input type="text" class="span3" name="Kuantitas" id="jumlah" value="<?=$dataArr['aset']['Kuantitas']?>" onchange="return totalHrg()" required readonly/>
							</li>
							<li>
								<span class="span2">Harga Satuan</span>
								<input type="text" class="span3 kapitalisasi" name="Satuan" id="hrgSatuan" value="<?=$dataArr['aset']['Satuan']?>" onchange="return totalHrg()" required readonly/>
							</li>
							<li>
								<span class="span2">Nilai Perolehan</span>
								<input type="text" class="span3" name="NilaiPerolehan" id="total" value="<?=$dataArr['aset']['NilaiPerolehan']?>" readonly/>
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
					<input type="hidden" name="noRegister" value="<?=$dataArr['kib']['noRegister']?>">
					<input type="hidden" name="kodeLokasi" value="<?=$dataArr['kib']['kodeLokasi']?>">
		<div style="height:5px;width:100%;clear:both"></div>		
		<ul>
			<li>
				<span class="span2">
				  <button class="btn" type="reset">Reset</button>
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
			} else {
				$("#TipeAset").val('G');
				$(".tanah,.mesin,.bangunan,.asetlain,.jaringan,.kdp").hide('');
				$(".tanah li > input,.mesin li > input,.bangunan li > input,.asetlain li > input,.jaringan li > input,.kdp li > input").attr('disabled','disabled');
				$(".tanah li > select,.mesin li > select,.bangunan li > select,.asetlain li > select,.jaringan li > select,.kdp li > select").attr('disabled','disabled');
			}
	}

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
			$(".ubahkondisi").attr('disabled','disabled');
		} else if ($("#"+item).attr('id') == "kapital") {
			$("textarea").attr('readonly','readonly');
			$(".tanah li > input,.mesin li > input,.bangunan li > input,.jaringan li > input,.asetlain li > input,.kdp li > input").attr('disabled','disabled');
			$(".kapitalisasi").removeAttr('readonly');
			$(".ubahkondisi").attr('disabled','disabled');
		} else if ($("#"+item).attr('id') == "nilai") {
			$("textarea").attr('readonly','readonly');
			$(".kapitalisasi").removeAttr('readonly');
			$(".tanah li > input,.mesin li > input,.bangunan li > input,.jaringan li > input,.asetlain li > input,.kdp li > input").attr('disabled','disabled');
			$(".ubahkondisi").attr('disabled','disabled');
		} else if ($("#"+item).attr('id') == "kondisi") {
			$("textarea").attr('readonly','readonly');
			$(".kapitalisasi").attr('readonly','readonly');
			$(".tanah li > input,.mesin li > input,.bangunan li > input,.jaringan li > input,.asetlain li > input,.kdp li > input").attr('disabled','disabled');
			$(".ubahkondisi").removeAttr('disabled');
		}
	}
</script>