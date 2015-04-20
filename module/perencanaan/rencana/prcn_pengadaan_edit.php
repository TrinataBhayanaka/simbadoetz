<?php
include "../../../config/config.php";

	$PERENCANAAN = new RETRIEVE_PERENCANAAN;

$menu_id = 10;
            $SessionUser = $SESSION->get_session_user();
            ($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
            $USERAUTH->FrontEnd_check_akses_menu($menu_id, $Session);

// $get_data_filter = $RETRIEVE->retrieve_kontrak();
// pr($get_data_filter);
            
?>

<?php
	include"$path/meta.php";
	include"$path/header.php";
	include"$path/menu.php";
	
?>
	<!-- SQL Sementara -->
	<?php

		// if(isset($_POST['kodeKelompok'])){
		//     if($_POST['Aset_ID'] == "")
		//     {
		//       	$dataArr = $STORE->store_inventarisasi($_POST);
		//     }  else
		//     {
		//       $dataArr = $STORE->store_edit_aset($_POST,$_POST['Aset_ID']);
		//     }
		//   }		

$dataDatabase = $PERENCANAAN->retrieve_daftar_perencanaan_pengadaan_edit($_GET); 
// pr($dataDatabase);
$data=$dataDatabase['data'];
$kib=$dataDatabase['kib'];
	?>
	<!-- End Sql -->
	<script type="text/javascript">
		$(document).ready(function() {
			$('#hrgmask,#total').autoNumeric('init');
			$("select").select2({
			});
			   
			$( "#tglPerolehan,#tglPembukuan,#tglSurat,#tglDokumen" ).datepicker({ format: 'yyyy-mm-dd' });
			$( "#tglPerolehan,#tglPembukuan,#tglSurat,#tglDokumen,#datepicker" ).mask('9999-99-99');
		});	

		function getCurrency(item){
	      $('#hrgSatuan').val($(item).autoNumeric('get'));
	    }
	</script>
	<section id="main">
		<ul class="breadcrumb">
			  <li><a href="#"><i class="fa fa-home fa-2x"></i>  Home</a> <span class="divider"><b>&raquo;</b></span></li>
			  <li><a href="#">Perencanaan</a><span class="divider"><b>&raquo;</b></span></li>
			  <li class="active">Rencana Pengadaan</li>
			  <?php SignInOut();?>
			</ul>
			<div class="breadcrumb">
				<div class="title">Rencana Pengadaan</div>
				<div class="subtitle">Edit Rencana Pengadaan</div>
			</div>	

			<div class="grey-container shortcut-wrapper">
				<a class="shortcut-link " href="<?=$url_rewrite?>/module/perencanaan/rencana/prcn_pengadaan_tambah.php">
					<span class="fa-stack fa-lg">
				      <i class="fa fa-circle fa-stack-2x"></i>
				      <i class="fa fa-inverse fa-stack-1x">1</i>
				    </span>
					<span class="text">Tambah Rencana Pengadaan</span>
				</a>
				<a class="shortcut-link active" href="<?=$url_rewrite?>/module/perencanaan/rencana/prcn_pengadaan_filter.php">
					<span class="fa-stack fa-lg">
				      <i class="fa fa-circle fa-stack-2x"></i>
				      <i class="fa fa-inverse fa-stack-1x">2</i>
				    </span>
					<span class="text">Data Rencana Pengadaan</span>
				</a>
			</div>		

		<section class="formLegendInve">
			
			<div style="height:5px;width:100%;clear:both"></div>
			

			<div>
			<form action="<?php echo"$url_rewrite";?>/module/perencanaan/rencana/prcn_pengadaan_prosesedit.php" method="POST">
				 <div class="detailLeft">
								
						<ul>	
							<?php //selectAset('kodeKelompok','255',true,false,'required'); ?>
							<li>
								<span class="span2">Tahun</span>
								<input type="text" class="span1" name="Tahun" value="<?=$data['Tahun']?>"  required/>
							</li>
							<li>
								<span class="span2">Jenis Aset</span>
								<input type="text" class="span3"  value="<?=$data['Uraian']?> / <?=$data['Kode_Kelompok']?>"  disabled/>
							</li>
							<li>
								<span class="span2">Kode Satker</span>
								<input type="text" class="span4"  value="<?=$data['NamaSatker']?>"  disabled/>
							</li>
						</ul>
						
					</div>

					<div style="height:5px;width:100%;clear:both"></div>

						<div class="detailLeft">
						<ul>
							<li>
								<span class="span2">Jumlah</span>
								<input type="text" class="span3" name="Kuantitas" id="jumlah" value="<?=$data['Kuantitas']?>" onchange="return totalHrg()" required/>
							</li>
							<li>
								<span class="span2">Harga Satuan</span>
								
								<input type="text" class="span3" data-a-sign="Rp " id="hrgmask" data-a-dec="," data-a-sep="." value="<?=$data['Harga_Satuan']?>" onkeyup="return getCurrency(this);" onchange="return totalHrg();" required/>
								<input type="hidden" name="Satuan" id="hrgSatuan" value="<?=$data['Harga_Satuan']?>" >
							</li>
							<li>
								<span class="span2">Nilai Perolehan</span>
								
								<input type="text" class="span3" name="NilaiPerolehan" data-a-sign="Rp " data-a-dec="," data-a-sep="." id="total" value="<?=$data['Kuantitas']*$data['Harga_Satuan']?>" readonly/>
								<input type="hidden" name="NilaiPerolehan" id="nilaiPerolehan" value="<?=$data['Kuantitas']*$data['Harga_Satuan']?>" >
							<li>
								<span class="span2">Rekening</span>
								<input type="text" class="span3"  value="<?=$data['NamaRekening']?> / <?=$data['Kode_Rekening']?>"  disabled/>
							</li>
							
							</li>
							<li>
								<span class="span2">Info</span>
								<textarea name="Info" class="span3" ><?=$data['Info']?></textarea>
							</li>
						</ul>
							
					</div>
					<div class="detailLeft">
						<?php
							if($_GET['tipe']=="A"){
								$selectPakai="";
								$seletPengelolaan="";
								// pr($kib['HakTanah']);
								if($kib['HakTanah']=="Hak Pakai"){
									$seletPakai="selected";
								}elseif($kib['HakTanah']=="Hak Pengelolaan"){
									$seletPengelolaan="selected";

								}
						?>
						<ul class="tanah">
							<li>
								<span class="span2">Hak Tanah</span>
								<select id="hakpakai" name="HakTanah" style="width:255px" >
									<option value="Hak Pakai" <?=$selectPakai?>>Hak Pakai</option>
									<option value="Hak Pengelolaan" <?=$seletPengelolaan?>>Hak Pengelolaan</option>
								</select>
							</li>
							<li>&nbsp;</li>
							<li>
								<span class="span2">Luas (M2)</span>
								<input type="text" class="span3" name="LuasTotal" value="<?=$kib['LuasTanah']?>" />
							</li>
							<li>
								<span class="span2">No. Sertifikat</span>
								<input type="text" class="span3" name="NoSertifikat"value="<?=$kib['NoSertifikat']?>"  />
							</li>
							<li>
								<span class="span2">Tgl. Sertifikat</span>
								<input type="text" class="span2" name="TglSertifikat" id="datepicker" value="<?=$kib['TglSertifikat']?>" />
							</li>
							<!-- <li>
								<span class="span2">Penggunaan</span>
								<input type="text" class="span3" name="Penggunaan" disabled/>
							</li> -->

						</ul>
						<?php
							}elseif($_GET['tipe']=="B"){
						?>
						<ul class="mesin" >
							<!-- <li>
								<span class="span2">Kondisi</span>
								<select id="kondisiMesin" name="kondisi" style="width:155px" disabled>
									<option value="1">Baik</option>
									<option value="2">Rusak Ringan</option>
									<option value="3">Rusak Berat</option>
								</select>
							</li> -->
							<li>&nbsp;</li>
							<li>
								<span class="span2">Merk</span>
								<input type="text" class="span3" name="Merk" value="<?=$kib['Merk']?>" />
							</li>
							<li>
								<span class="span2">Type</span>
								<input type="text" class="span3" name="Model" value="<?=$kib['Model']?>" />
							</li>
							<li>
								<span class="span2">Ukuran / CC</span>
								<input type="text" class="span3" name="Ukuran" value="<?=$kib['Ukuran']?>" />
							</li>
							<li>
								<span class="span2">No. Pabrik</span>
								<input type="text" class="span3" name="NoPabrik" value="<?=$kib['NoSeri']?>" />
							</li>
							<li>
								<span class="span2">No. Mesin</span>
								<input type="text" class="span3" name="NoMesin" value="<?=$kib['NoMesin']?>" />
							</li>
							<li>
								<span class="span2">No. Polisi</span>
								<input type="text" class="span3" name="NoSTNK" value="<?=$kib['NoSTNK']?>" />
							</li>
							<li>
								<span class="span2">No. BPKB</span>
								<input type="text" class="span3" name="NoBPKB" value="<?=$kib['NoBPKB']?>" />
							</li>
							<li>
								<span class="span2">Bahan</span>
								<input type="text" class="span3" name="Material" value="<?=$kib['Bahan']?>" />
							</li>
							<li>
								<span class="span2">No. Rangka</span>
								<input type="text" class="span3" name="NoRangka" value="<?=$kib['NoRangka']?>" />
							</li>
						</ul>

						<?php
							}elseif($_GET['tipe']=="C"){
								$select1="";
								$select2="";
								if($kib['Beton']=="1"){
									$select1="selected";
								}elseif($kib['Beton']=="2"){
									$select2="selected";
								}
						?>
						<ul class="bangunan" >
							<!-- <li>
								<span class="span2">Kondisi Bangunan</span>
								<select name="kondisi" style="width:155px" disabled>
									<option value="1">Baik</option>
									<option value="2">Rusak Ringan</option>
									<option value="3">Rusak Berat</option>
								</select>
							</li> -->
							<li>&nbsp;</li>
							<li>
								<span class="span2">Beton / Tidak</span>
								<select name="Beton" style="width:155px" >
									<option value="1" <?=$select1?>>Beton</option>
									<option value="2" <?=$select2?>>Tidak</option>
								</select>
							</li>
							<li>&nbsp;</li>
							<li>
								<span class="span2">Jumlah Lantai</span>
								<input type="text" class="span3" name="JumlahLantai" value="<?=$kib['JumlahLantai']?>" />
							</li>
							<li>
								<span class="span2">Luas Lantai (M2)</span>
								<input type="text" class="span3" name="LuasLantai"value="<?=$kib['LuasLantai']?>" />
							</li>
							<li>
								<span class="span2">No. Dokumen</span>
								<input type="text" class="span3" name="NoSurat" value="<?=$kib['NoDokumen']?>" />
							</li>
							<li>
								<span class="span2">Tgl. Dokumen</span>
								<input type="text" class="span2" placeholder="yyyy-mm-dd" name="tglSurat" id="tglSurat" value="<?=$kib['TglDokumen']?>" />
							</li>
						</ul>

						<?php
							}elseif($_GET['tipe']=="D"){
						?>
						<ul class="jaringan" >
							<!-- <li>
								<span class="span2">Kondisi</span>
								<select name="kondisi" style="width:155px" >disabled
									<option value="1">Baik</option>
									<option value="2">Rusak Ringan</option>
									<option value="3">Rusak Berat</option>
								</select>
							</li> -->
							<li>&nbsp;</li>
							<li>
								<span class="span2">Konstruksi</span>
								<input type="text" class="span3" name="Konstruksi" value="<?=$kib['Konstruksi']?>" />
							</li>
							<li>
								<span class="span2">Panjang (KM)</span>
								<input type="text" class="span2" name="Panjang" value="<?=$kib['Panjang']?>" />
							</li>
							<li>
								<span class="span2">Lebar (M)</span>
								<input type="text" class="span2" name="Lebar" value="<?=$kib['Lebar']?>" />
							</li>
							<li>
								<span class="span2">Luas (M2)</span>
								<input type="text" class="span2" name="LuasJaringan"  value="<?=$kib['LuasJaringan']?>" />
							</li>
							<li>
								<span class="span2">No. Dokumen</span>
								<input type="text" class="span3" name="NoDokumen" value="<?=$kib['NoDokumen']?>" />
							</li>
							<li>
								<span class="span2">Tgl. Dokumen</span>
								<input type="text" placeholder="yyyy-mm-dd" class="span2" name="tglDokumen" id="tglDokumen" value="<?=$kib['TglDokumen']?>" />
							</li>
						</ul>

						<?php
							}elseif($_GET['tipe']=="E"){
						?>
						<ul class="asetlain">
							<!-- <li>
								<span class="span2">Kondisi</span>
								<select name="kondisi" style="width:155px" disabled>
									<option value="1">Baik</option>
									<option value="2">Rusak Ringan</option>
									<option value="3">Rusak Berat</option>
								</select>
							</li> -->
							<li>&nbsp;</li>
							<li>
								<span class="span2">Judul</span>
								<input type="text" class="span3" name="Judul" value="<?=$kib['Judul']?>" />
							</li>
							<li>
								<span class="span2">Pengarang</span>
								<input type="text" class="span3" value="<?=$kib['Pengarang']?>" name="Pengarang" />
							</li>
							<li>
								<span class="span2">Penerbit</span>
								<input type="text" class="span3" value="<?=$kib['Penerbit']?>" name="Penerbit" />
							</li>
							<li>
								<span class="span2">Spesifikasi</span>
								<input type="text" class="span3" value="<?=$kib['Spesifikasi']?>" name="Spesifikasi" />
							</li>
							<li>
								<span class="span2">Asal Daerah</span>
								<input type="text" class="span3" value="<?=$kib['AsalDaerah']?>" name="AsalDaerah" />
							</li>
							<li>
								<span class="span2">Bahan</span>
								<input type="text" class="span3" value="<?=$kib['Material']?>" name="Material" />
							</li>
							<li>
								<span class="span2">Ukuran</span>
								<input type="text" class="span3" value="<?=$kib['Ukuran']?>" name="Ukuran" />
							</li>
						</ul>

						<?php
							}elseif($_GET['tipe']=="F"){

								$select1="";
								$select2="";
								if($kib['Beton']=="1"){
									$select1="selected";
								}elseif($kib['Beton']=="2"){
									$select2="selected";
								}
						?>
						<ul class="kdp" >
							<!-- <li>
								<span class="span2">Kondisi Bangunan</span>
								<select name="kondisi" style="width:155px" disabled>
									<option value="1">Baik</option>
									<option value="2">Rusak Ringan</option>
									<option value="3">Rusak Berat</option>
								</select>
							</li> -->
							<li>&nbsp;</li>
							<li>
								<span class="span2">Beton / Tidak</span>
								<select name="Beton" style="width:155px" >
									<option value="1" <?=$select1?>>Beton</option>
									<option value="2" <?=$select2?>>Tidak</option>
								</select>
							</li>
							<li>&nbsp;</li>
							<li>
								<span class="span2">Jumlah Lantai</span>
								<input type="text" class="span3" value="<?=$kib['JumlahLantai']?>" name="JumlahLantai" />
							</li>
							<li>
								<span class="span2">Luas Lantai</span>
								<input type="text" class="span3" value="<?=$kib['LuasLantai']?>"  name="LuasLantai" />
							</li>
						</ul>
						<?php
					}
						?>
					</div>
					<!-- hidden -->
					<input type="hidden" name="UserNm" value="<?=$_SESSION['ses_uoperatorid']?>"><input type="hidden" name="TipeAset" id="TipeAset" value="<?=$_GET['tipe']?>">
					<input type="hidden" name="IDRENCANA"  value="<?=$_GET['id']?>">
		
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
	$(document).on('change','#kodeKelompok', function(){

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
		} else if(gol[0] == '02')
		{
			$("#TipeAset").val('B');
			$(".tanah,.bangunan,.jaringan,.asetlain,.kdp").hide('');
			$(".tanah li > input,.bangunan li > input,.jaringan li > input,.asetlain li > input,.kdp li > input").attr('disabled','disabled');
			$(".tanah li > select,.bangunan li > select,.jaringan li > select,.asetlain li > select,.kdp li > select").attr('disabled','disabled');
			$(".mesin li > input,.mesin li > select").removeAttr('disabled');
			$(".mesin").show('');
		} else if(gol[0] == '03')
		{
			$("#TipeAset").val('C');
			$(".tanah,.mesin,.jaringan,.asetlain,.kdp").hide('');
			$(".tanah li > input,.mesin li > input,.jaringan li > input,.asetlain li > input,.kdp li > input").attr('disabled','disabled');
			$(".tanah li > select,.mesin li > select,.jaringan li > select,.asetlain li > select,.kdp li > select").attr('disabled','disabled');
			$(".bangunan li > input,.bangunan li > select").removeAttr('disabled');
			$(".bangunan").show('');
		} else if(gol[0] == '04')
		{
			$("#TipeAset").val('D');
			$(".tanah,.mesin,.bangunan,.asetlain,.kdp").hide('');
			$(".tanah li > input,.mesin li > input,.bangunan li > input,.asetlain li > input,.kdp li > input").attr('disabled','disabled');
			$(".tanah li > select,.mesin li > select,.bangunan li > select,.asetlain li > select,.kdp li > select").attr('disabled','disabled');
			$(".jaringan li > input,.jaringan li > select").removeAttr('disabled');
			$(".jaringan").show('');
		} else if(gol[0] == '05')
		{
			$("#TipeAset").val('E');
			$(".tanah,.mesin,.bangunan,.jaringan,.kdp").hide('');
			$(".tanah li > input,.mesin li > input,.bangunan li > input,.jaringan li > input,.kdp li > input").attr('disabled','disabled');
			$(".tanah li > select,.mesin li > select,.bangunan li > select,.jaringan li > select,.kdp li > select").attr('disabled','disabled');
			$(".asetlain li > input,.asetlain li > select").removeAttr('disabled');
			$(".asetlain").show('');
		} else if(gol[0] == '06')
		{
			$("#TipeAset").val('F');
			$(".tanah,.mesin,.bangunan,.asetlain,.jaringan").hide('');
			$(".tanah li > input,.mesin li > input,.bangunan li > input,.asetlain li > input,.jaringan li > input").attr('disabled','disabled');
			$(".tanah li > select,.mesin li > select,.bangunan li > select,.asetlain li > select,.jaringan li > select").attr('disabled','disabled');
			$(".kdp li > input,.kdp li > select").removeAttr('disabled');
			$(".kdp").show('');
		} else {
			$("#TipeAset").val('G');
			$(".tanah,.mesin,.bangunan,.asetlain,.jaringan,.kdp").hide('');
			$(".tanah li > input,.mesin li > input,.bangunan li > input,.asetlain li > input,.jaringan li > input,.kdp li > input").attr('disabled','disabled');
			$(".tanah li > select,.mesin li > select,.bangunan li > select,.asetlain li > select,.jaringan li > select,.kdp li > select").attr('disabled','disabled');
		}			
		
	})

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

	function totalHrg(){
		var jml = $("#jumlah").val();
		var hrgSatuan = $("#hrgSatuan").val();
		var total = jml*hrgSatuan;
		$("#total").val(total);
	}
</script>