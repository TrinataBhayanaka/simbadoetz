<?php
include "../../config/config.php";
$menu_id = 10;
            $SessionUser = $SESSION->get_session_user();
            ($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
            $USERAUTH->FrontEnd_check_akses_menu($menu_id, $Session);

$dataArr = $RETRIEVE->retrieve_editkontrak($_GET);
// pr($dataArr);


	include"$path/meta.php";
	include"$path/header.php";
	include"$path/menu.php";
	
?>
	<!-- SQL Sementara -->
	<?php

		//kontrak
		$idKontrak = $_GET['tmpthis'];
		$sql = mysql_query("SELECT * FROM kontrak WHERE id='{$idKontrak}' LIMIT 1");
			while ($dataKontrak = mysql_fetch_assoc($sql)){
					$kontrak[] = $dataKontrak;
				}
		// pr($kontrak);

		
		    if($_POST)
		    {
		    	// pr($_POST);exit;
				$dataArr = $STORE->store_upd_aset($_POST);
		    }
		  	
		//sum total 
		$sqlsum = mysql_query("SELECT SUM(NilaiPerolehan) as total FROM aset WHERE noKontrak = '{$kontrak[0]['noKontrak']}'");
		while ($sum = mysql_fetch_array($sqlsum)){
					$sumTotal = $sum;
				}

	?>
	<!-- End Sql -->
	<script>
    jQuery(function($) {
        $('#hrgmask,#total').autoNumeric('init');
        $("select").select2({});
        $( "#tglPerolehan,#tglPembukuan,#tglSurat,#tglDokumen" ).datepicker({ format: 'yyyy-mm-dd' });
		$( "#tglPerolehan,#tglPembukuan,#tglSurat,#tglDokumen,#datepicker" ).mask('9999-99-99');
		setTimeout(function() {
		 	initKondisi();
		}, 100);
    });

    function getCurrency(item){
      $('#hrgSatuan').val($(item).autoNumeric('get'));
    }

  </script>
	<section id="main">
		<ul class="breadcrumb">
			  <li><a href="#"><i class="fa fa-home fa-2x"></i>  Home</a> <span class="divider"><b>&raquo;</b></span></li>
			  <li><a href="#">Perolehan Aset</a><span class="divider"><b>&raquo;</b></span></li>
			  <li><a href="#">Kontrak</a><span class="divider"><b>&raquo;</b></span></li>
			  <li class="active">Rincian Barang</li>
			  <?php SignInOut();?>
			</ul>
			<div class="breadcrumb">
				<div class="title">Rincian Barang</div>
				<div class="subtitle">Input Data Aset</div>
			</div>		

		<section class="formLegend">
			
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
								<input type="text" id="spk" value="<?=number_format($kontrak[0]['nilai'])?>" disabled/>
							</li>
							<li>
								<span  class="labelInfo">Total Rincian Barang</span>
								<input type="text" id="totalRB" value="<?=isset($sumTotal) ? number_format($sumTotal['total']-$dataArr['aset']['NilaiPerolehan']) : '0'?>" disabled/>
							</li>
						</ul>
							
					</div>
			<div style="height:5px;width:100%;clear:both"></div>
			
			<?php
				if($kontrak[0]['tipeAset'] != 1)
				{
					$sql = mysql_query("SELECT * FROM {$_GET['tipeaset']} WHERE Aset_ID = '{$_GET['idaset']}' AND noRegister = '{$_GET['noreg']}' LIMIT 1");
					while ($dataAset = mysql_fetch_assoc($sql)){
	                    $aset[] = $dataAset;
	                }
	                if($aset){
				        foreach ($aset as $key => $value) {
				            $sqlnmBrg = mysql_query("SELECT Uraian FROM kelompok WHERE Kode = '{$value['kodeKelompok']}' LIMIT 1");
				            while ($uraian = mysql_fetch_array($sqlnmBrg)){
				                    $tmp = $uraian;
				                    $aset[$key]['uraian'] = $tmp['Uraian'];
				                }
				        }
				    }
	        ?>
	        		<div class="search-options clearfix">
	        			<strong style="margin-right:20px;"><?=($kontrak[0]['tipeAset'] == 2)? 'Kapitalisasi Aset' : 'Rubah Status'?></strong>
	        			<hr style="padding:0px;margin:0px">
						<table border='0' width="100%" style="font-size:12">
							<tr>
								<th>Kode Kelompok</th>
								<th>Nama Barang</th>
								<th>Kode Satker</th>
								<th>Kode Lokasi</th>
								<th>NoReg</th>
								<th>Nilai</th>
							</tr>
							<tr>
								<td align="center"><?=$aset[0]['kodeKelompok']?></td>
								<td align="center"><?=$aset[0]['uraian']?></td>
								<td align="center"><?=$aset[0]['kodeSatker']?></td>
								<td align="center"><?=$aset[0]['kodeLokasi']?></td>
								<td align="center"><?=$aset[0]['noRegister']?></td>
								<td align="center"><?=number_format($aset[0]['NilaiPerolehan'])?></td>
							</tr>	
						</table>	

					</div><!-- /search-option -->
	        <?php
				}
					
			?>

			<div>
			<form action="" method="POST">
				 <div class="formKontrak">
				 		<ul>
							<?=selectSatker('kodeSatker','255',true,$dataArr['aset']['kodeSatker'],'required');?>
						</ul>
				 		<ul>
							<?=selectRuang('kodeRuangan','kodeSatker','255',true,$dataArr['aset']['Tahun']."_".$dataArr['aset']['kodeRuangan']);?>
						</ul>
						<ul>
							<?php selectAset('kodeKelompok','255',true,$dataArr['aset']['kodeKelompok'],'required'); ?>
						</ul>
						<ul class="tanah" style="display:none">
							<li>
								<span class="span2">Hak Tanah</span>
								<select id="hakpakai" name="HakTanah" style="width:255px" disabled>
									<option value="Hak Pakai" <?=$dataArr['kib']['HakTanah'] == 'Hak Pakai' ? 'selected' : ''?>>Hak Pakai</option>
									<option value="Hak Pengelolaan" <?=$dataArr['kib']['HakTanah'] == 'Hak Pengelolaan' ? 'selected' : ''?>>Hak Pengelolaan</option>
								</select>
							</li>
							<li>&nbsp;</li>
							<li>
								<span class="span2">Luas (M2)</span>
								<input type="text" class="span3" name="LuasTotal" value="<?=(isset($dataArr['kib']['LuasTotal'])) ? $dataArr['kib']['LuasTotal'] : ''?>" disabled/>
							</li>
							<li>
								<span class="span2">No. Sertifikat</span>
								<input type="text" class="span3" name="NoSertifikat" value="<?=(isset($dataArr['kib']['NoSertifikat'])) ? $dataArr['kib']['NoSertifikat'] : ''?>" disabled/>
							</li>
							<li>
								<span class="span2">Tgl. Sertifikat</span>
								<input type="text" class="span2" name="TglSertifikat" value="<?=(isset($dataArr['kib']['TglSertifikat'])) ? $dataArr['kib']['TglSertifikat'] : ''?>" id="datepicker" disabled/>
							</li>
							<li>
								<span class="span2">Penggunaan</span>
								<input type="text" class="span3" name="Penggunaan" value="<?=(isset($dataArr['kib']['Penggunaan'])) ? $dataArr['kib']['Penggunaan'] : ''?>" disabled/>
							</li>
						</ul>
						<ul class="mesin" style="display:none">
							<li>
								<span class="span2">Merk</span>
								<input type="text" class="span3" name="Merk" value="<?=(isset($dataArr['kib']['Merk'])) ? $dataArr['kib']['Merk'] : ''?>" disabled/>
							</li>
							<li>
								<span class="span2">Type</span>
								<input type="text" class="span3" name="Model" value="<?=(isset($dataArr['kib']['Model'])) ? $dataArr['kib']['Model'] : ''?>" disabled/>
							</li>
							<li>
								<span class="span2">Ukuran / CC</span>
								<input type="text" class="span3" name="Ukuran" value="<?=(isset($dataArr['kib']['Ukuran'])) ? $dataArr['kib']['Ukuran'] : ''?>" disabled/>
							</li>
							<li>
								<span class="span2">No. Pabrik</span>
								<input type="text" class="span3" name="Pabrik" value="<?=(isset($dataArr['kib']['Pabrik'])) ? $dataArr['kib']['Pabrik'] : ''?>" disabled/>
							</li>
							<li>
								<span class="span2">No. Mesin</span>
								<input type="text" class="span3" name="NoMesin" value="<?=(isset($dataArr['kib']['NoMesin'])) ? $dataArr['kib']['NoMesin'] : ''?>" disabled/>
							</li>
							<li>
								<span class="span2">No. Polisi</span>
								<input type="text" class="span3" name="NoSeri" value="<?=(isset($dataArr['kib']['NoSeri'])) ? $dataArr['kib']['NoSeri'] : ''?>" disabled/>
							</li>
							<li>
								<span class="span2">No. BPKB</span>
								<input type="text" class="span3" name="NoBPKB" value="<?=(isset($dataArr['kib']['NoBPKB'])) ? $dataArr['kib']['NoBPKB'] : ''?>" disabled/>
							</li>
							<li>
								<span class="span2">Bahan</span>
								<input type="text" class="span3" name="Material" value="<?=(isset($dataArr['kib']['Material'])) ? $dataArr['kib']['Material'] : ''?>" disabled/>
							</li>
							<li>
								<span class="span2">No. Rangka</span>
								<input type="text" class="span3" name="NoRangka" value="<?=(isset($dataArr['kib']['NoRangka'])) ? $dataArr['kib']['NoRangka'] : ''?>" disabled/>
							</li>
						</ul>
						<ul class="bangunan" style="display:none">
							<li>
								<span class="span2">Beton / Tidak</span>
								<select id="beton_bangunan" name="Beton" style="width:155px" disabled>
									<option value="1" <?=$dataArr['kib']['Beton'] == '1' ? 'selected' : ''?>>Beton</option>
									<option value="2" <?=$dataArr['kib']['Beton'] == '2' ? 'selected' : ''?>>Tidak</option>
								</select>
							</li>
							<li>&nbsp;</li>
							<li>
								<span class="span2">Jumlah Lantai</span>
								<input type="text" class="span3" name="JumlahLantai" value="<?=(isset($dataArr['kib']['JumlahLantai'])) ? $dataArr['kib']['JumlahLantai'] : ''?>" disabled/>
							</li>
							<li>
								<span class="span2">Luas Lantai (M2)</span>
								<input type="text" class="span3" name="LuasLantai" value="<?=(isset($dataArr['kib']['LuasLantai'])) ? $dataArr['kib']['LuasLantai'] : ''?>" disabled/>
							</li>
							<li>
								<span class="span2">No. Dokumen</span>
								<input type="text" class="span3" name="NoSurat" value="<?=(isset($dataArr['kib']['NoSurat'])) ? $dataArr['kib']['NoSurat'] : ''?>" disabled/>
							</li>
							<li>
								<span class="span2">Tgl. Dokumen</span>
								<input type="text" class="span2" placeholder="yyyy-mm-dd" value="<?=(isset($dataArr['kib']['TglSurat'])) ? $dataArr['kib']['TglSurat'] : ''?>" name="TglSurat" id="tglSurat" disabled/>
							</li>
						</ul>
						<ul class="jaringan" style="display:none">
							<li>
								<span class="span2">Konstruksi</span>
								<input type="text" class="span3" name="Konstruksi" value="<?=(isset($dataArr['kib']['Konstruksi'])) ? $dataArr['kib']['Konstruksi'] : ''?>" disabled/>
							</li>
							<li>
								<span class="span2">Panjang (KM)</span>
								<input type="text" class="span2" name="Panjang" value="<?=(isset($dataArr['kib']['Panjang'])) ? $dataArr['kib']['Panjang'] : ''?>" disabled/>
							</li>
							<li>
								<span class="span2">Lebar (M)</span>
								<input type="text" class="span2" name="Lebar" value="<?=(isset($dataArr['kib']['Lebar'])) ? $dataArr['kib']['Lebar'] : ''?>" disabled/>
							</li>
							<li>
								<span class="span2">Luas (M2)</span>
								<input type="text" class="span2" name="LuasJaringan" value="<?=(isset($dataArr['kib']['LuasJaringan'])) ? $dataArr['kib']['LuasJaringan'] : ''?>" disabled/>
							</li>
							<li>
								<span class="span2">No. Dokumen</span>
								<input type="text" class="span3" name="NoDokumen" value="<?=(isset($dataArr['kib']['NoDokumen'])) ? $dataArr['kib']['NoDokumen'] : ''?>" disabled/>
							</li>
							<li>
								<span class="span2">Tgl. Dokumen</span>
								<input type="text" placeholder="yyyy-mm-dd" class="span2" name="TglDokumen" id="tglDokumen" value="<?=(isset($dataArr['kib']['TglDokumen'])) ? $dataArr['kib']['TglDokumen'] : ''?>" disabled/>
							</li>
						</ul>
						<ul class="asetlain" style="display:none">
							<li>
								<span class="span2">Judul</span>
								<input type="text" class="span3" name="Judul" value="<?=(isset($dataArr['kib']['Judul'])) ? $dataArr['kib']['Judul'] : ''?>" disabled/>
							</li>
							<li>
								<span class="span2">Pengarang</span>
								<input type="text" class="span3" name="Pengarang" value="<?=(isset($dataArr['kib']['Pengarang'])) ? $dataArr['kib']['Pengarang'] : ''?>" disabled/>
							</li>
							<li>
								<span class="span2">Penerbit</span>
								<input type="text" class="span3" name="Penerbit" value="<?=(isset($dataArr['kib']['Penerbit'])) ? $dataArr['kib']['Penerbit'] : ''?>" disabled/>
							</li>
							<li>
								<span class="span2">Spesifikasi</span>
								<input type="text" class="span3" name="Spesifikasi" value="<?=(isset($dataArr['kib']['Spesifikasi'])) ? $dataArr['kib']['Spesifikasi'] : ''?>" disabled/>
							</li>
							<li>
								<span class="span2">Asal Daerah</span>
								<input type="text" class="span3" name="AsalDaerah" value="<?=(isset($dataArr['kib']['AsalDaerah'])) ? $dataArr['kib']['AsalDaerah'] : ''?>" disabled/>
							</li>
							<li>
								<span class="span2">Bahan</span>
								<input type="text" class="span3" name="Material" value="<?=(isset($dataArr['kib']['Material'])) ? $dataArr['kib']['Material'] : ''?>" disabled/>
							</li>
							<li>
								<span class="span2">Ukuran</span>
								<input type="text" class="span3" name="Ukuran" value="<?=(isset($dataArr['kib']['Ukuran'])) ? $dataArr['kib']['Ukuran'] : ''?>" disabled/>
							</li>
						</ul>
						<ul class="kdp" style="display:none">
							<li>
								<span class="span2">Beton / Tidak</span>
								<select id="beton_kdp" name="Beton" style="width:155px">
									<option value="1" <?=$dataArr['kib']['Beton'] == '1' ? 'selected' : ''?>>Beton</option>
									<option value="2" <?=$dataArr['kib']['Beton'] == '2' ? 'selected' : ''?>>Tidak</option>
								</select>
							</li>
							<li>&nbsp;</li>
							<li>
								<span class="span2">Jumlah Lantai</span>
								<input type="text" class="span3" name="JumlahLantai" value="<?=(isset($dataArr['kib']['JumlahLantai'])) ? $dataArr['kib']['JumlahLantai'] : ''?>" disabled/>
							</li>
							<li>
								<span class="span2">Luas Lantai</span>
								<input type="text" class="span3" name="LuasLantai" value="<?=(isset($dataArr['kib']['LuasLantai'])) ? $dataArr['kib']['LuasLantai'] : ''?>" disabled/>
							</li>
						</ul>
						<ul>
							<li>
								<span class="span2">Tgl. Perolehan</span>
								<div class="control">
									<div class="input-prepend">
										<span class="add-on"><i class="fa fa-calendar"></i></span>
										<input type="text" class="span2" placeholder="yyyy-mm-dd" name="TglPerolehan" id="tglPerolehan" value="<?=$dataArr['aset']['TglPerolehan']?>" required/>
									</div>
								</div>
							</li>
							<li>
								<span class="span2">Alamat</span>
								<textarea name="Alamat" class="span3" ><?=$dataArr['aset']['Alamat']?></textarea>
							</li>
							<li>
								<span class="span2">Jumlah</span>
								<input type="text" class="span3" name="Kuantitas" id="jumlah" value="<?=$dataArr['aset']['Kuantitas']?>" onchange="return totalHrg()" required/>
							</li>
							<li>
								<span class="span2">Harga Satuan</span>
								<input type="text" class="span3" data-a-sign="Rp " id="hrgmask" data-a-dec="," data-a-sep="." value="<?=$dataArr['aset']['NilaiPerolehan']?>" onkeyup="return getCurrency(this);" onchange="return totalHrg();" required/>
								<input type="hidden" name="Satuan" id="hrgSatuan" value="<?=$dataArr['aset']['NilaiPerolehan']?>" >
							</li>
							<li>
								<span class="span2">Nilai Perolehan</span>
								<input type="text" class="span3" name="NilaiPerolehan" data-a-sign="Rp " data-a-dec="," data-a-sep="." id="total" value="<?=$dataArr['aset']['NilaiPerolehan']?>" readonly/>
								<input type="hidden" name="NilaiPerolehan" id="nilaiPerolehan" value="<?=$dataArr['aset']['NilaiPerolehan']?>" >
							</li>
							<li>
								<span class="span2">Info</span>
								<textarea name="Info" class="span3" ><?=$dataArr['aset']['Info']?></textarea>
							</li>
							<li>
								<span class="span2">
								  <button class="btn" type="reset">Reset</button>
								  <button type="submit" id="submit" class="btn btn-primary">Simpan</button></span>
							</li>
						</ul>
							
					</div>
					<!-- hidden -->
					<input type="hidden" name="id" value="<?=$kontrak[0]['id']?>">
					<input type="hidden" name="kodeSatker" value="<?=$dataArr['aset']['kodeSatker']?>">
					<input type="hidden" name="noKontrak" value="<?=$kontrak[0]['noKontrak']?>">
					<input type="hidden" name="kondisi" value="1">
					<input type="hidden" name="UserNm" value="<?=$_SESSION['ses_uoperatorid']?>">
					<input type="hidden" name="TipeAset" id="TipeAset">
					<input type="hidden" name="old_jumlah" value = "<?=$dataArr['aset']['Kuantitas']?>">
					<input type="hidden" name="old_kelompok" value = "<?=$dataArr['aset']['kodeKelompok']?>">
					<input type="hidden" name="old_lokasi" value = "<?=$dataArr['aset']['kodeLokasi']?>">
					<input type="hidden" name="tabel" id="tabel" value="<?=$dataArr['tabel']?>">
					<input type="hidden" name="AsalUsul" value="Pembelian">
			
		</form>
		</div>  
			    
		</section> 
		     
	</section>
	
<?php
	include"$path/footer.php";
?>

<script type="text/javascript">

	function initKondisi(){	
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

	$(document).on('change','#kodeKelompok', function(){

		initKondisi();		
		
	});

	$(document).on('submit', function(){
		var perolehan = $("#nilaiPerolehan").val();
		var total = $("#totalRB").val();
		var spk = $("#spk").val();
		var str = parseInt(spk.replace(/[^0-9\.]+/g, ""));
		var rb = parseInt(total.replace(/[^0-9\.]+/g, ""));
		var tgl= $("#TglPerolehan").val();

		if (tgl == "") {
            alert("Tgl Perolehan tidak boleh kosong");
            return false;
        } else if (tgl == "0000-00-00") {
            alert("Tgl Perolehan tidak boleh kosong");
            return false;
        }

		var diff = parseInt(perolehan) + parseInt(rb);

		if(diff > str) {
			console.log(diff+" = "+str);
			alert("Total rincian barang melebihi nilai SPK");
			return false;	
		}
	});

		function totalHrg(){	
		var jml = $("#jumlah").val();
		var hrgSatuan = $("#hrgSatuan").val();
		var total = jml*hrgSatuan;
		$("#total").val(total);
		$('#total').autoNumeric('set', total);
		$('#nilaiPerolehan').val($("#total").autoNumeric('get'));
	}
</script>
