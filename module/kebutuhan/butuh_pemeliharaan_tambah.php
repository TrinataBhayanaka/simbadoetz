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
			  <li class="active">Rencana Pemeliharaan</li>
			  <?php SignInOut();?>
			</ul>
			<div class="breadcrumb">
				<div class="title">Rencana Pemeliharaan</div>
				<div class="subtitle">Data Rencana Pemeliharaan</div>
			</div>	

			<div class="grey-container shortcut-wrapper">
				<a class="shortcut-link" href="<?=$url_rewrite?>/module/perencanaan/rencana/prcn_pemeliharaan_buat_filter.php">
					<span class="fa-stack fa-lg">
				      <i class="fa fa-circle fa-stack-2x"></i>
				      <i class="fa fa-inverse fa-stack-1x">1</i>
				    </span>
					<span class="text">Buat Rencana Pemeliharaan</span>
				</a>
				<a class="shortcut-link active" href="<?=$url_rewrite?>/module/perencanaan/rencana/prcn_pemeliharaan_filter.php">
					<span class="fa-stack fa-lg">
				      <i class="fa fa-circle fa-stack-2x"></i>
				      <i class="fa fa-inverse fa-stack-1x">2</i>
				    </span>
					<span class="text">Data Rencana Pemeliharaan</span>
				</a>
			</div>		

		<section class="formLegendInve">
			
			<div style="height:5px;width:100%;clear:both"></div>
			

			<div>
			<form action="<?php echo"$url_rewrite";?>/module/perencanaan/rencana/prcn_pengadaan_pemeliharaan_prosestambah.php" method="POST">

				 <div class="detailLeft">
								
						<ul>	
							<?php //selectAset('kodeKelompok','255',true,false,'required'); ?>

							<li>
								<span class="span2">Jenis Aset</span>
								<input type="text" class="span3"  value="<?=$data['Uraian']?> / <?=$data['Kode_Kelompok']?>"  disabled/>
							</li>
						</ul>
						
					</div>

					<div style="height:5px;width:100%;clear:both"></div>

						<div class="detailLeft">
						<ul>
							<li>
								<span class="span2">Jumlah</span>
								<input type="text" class="span3" name="Kuantitas" id="jumlah" value="<?=$data['Kuantitas']?>" onchange="return totalHrg()" disabled/>
							</li>
							<li>
								<span class="span2">Harga Satuan</span>
								
								<input type="text" class="span3" data-a-sign="Rp " data-a-dec="," data-a-sep="." value="<?=$data['Harga_Satuan']?>" disabled/>
							</li>
							<li>
								<span class="span2">Nilai Perolehan</span>
								
								<input type="text" class="span3" name="NilaiPerolehan" data-a-sign="Rp " data-a-dec="," data-a-sep="." value="<?=$data['Kuantitas']*$data['Harga_Satuan']?>" disabled/>
							</li>
							<li>
								<span class="span2">Rekening</span>
								<input type="text" class="span3"  value="<?=$data['NamaRekening']?> / <?=$data['Kode_Rekening']?>"  disabled/>
							</li>
							
							<li>
								<span class="span2">Info</span>
								<textarea name="Info" class="span3" disabled><?=$data['Info']?></textarea>
							</li>
							<li>
								<span class="span2">Harga Pemeliharaan</span>
								
								<input type="text" class="span3" data-a-sign="Rp " id="hrgmask" data-a-dec="," data-a-sep="." value="" onkeyup="return getCurrency(this);" onchange="return totalHrg();" required/>
								<input type="hidden" name="Harga_Pemeliharaan" id="hrgSatuan" value="" >
							</li>
							<li>
								<span class="span2">Total Pemeliharaan</span>
								
								<input type="text" class="span3" name="NilaiPerolehan" data-a-sign="Rp " data-a-dec="," data-a-sep="." id="total" value="" readonly/>
								<input type="hidden" name="TotalPemeliharaan" id="nilaiPerolehan" value="" >
								
							</li>
							<li>
								<span class="span2">Uraian Pemeliharaan</span>
								<textarea name="uraian_pemeliharaan" class="span3" ></textarea>
							</li>
						</ul>
							
					</div>
					<div class="detailLeft">
						<?php
							if($_GET['tipe']=="A"){
						?>
						<ul class="tanah">
							<li>
								<span class="span2">Hak Tanah</span>
								<select id="hakpakai" name="HakTanah" style="width:255px" disabled>
									<option value="Hak Pakai">Hak Pakai</option>
									<option value="Hak Pengelolaan">Hak Pengelolaan</option>
								</select>
							</li>
							<li>&nbsp;</li>
							<li>
								<span class="span2">Luas (M2)</span>
								<input type="text" class="span3" name="LuasTotal" disabled/>
							</li>
							<li>
								<span class="span2">No. Sertifikat</span>
								<input type="text" class="span3" name="NoSertifikat" disabled/>
							</li>
							<li>
								<span class="span2">Tgl. Sertifikat</span>
								<input type="text" class="span2" name="TglSertifikat" id="datepicker" disabled/>
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
								<input type="text" class="span3" name="Merk" value="<?=$kib['Merk']?>" disabled/>
							</li>
							<li>
								<span class="span2">Type</span>
								<input type="text" class="span3" name="Model" value="<?=$kib['Model']?>" disabled/>
							</li>
							<li>
								<span class="span2">Ukuran / CC</span>
								<input type="text" class="span3" name="Ukuran" value="<?=$kib['Ukuran']?>" disabled/>
							</li>
							<li>
								<span class="span2">No. Pabrik</span>
								<input type="text" class="span3" name="Pabrik" value="<?=$kib['NoSeri']?>" disabled/>
							</li>
							<li>
								<span class="span2">No. Mesin</span>
								<input type="text" class="span3" name="NoMesin" value="<?=$kib['NoMesin']?>" disabled/>
							</li>
							<li>
								<span class="span2">No. Polisi</span>
								<input type="text" class="span3" name="NoSeri" value="<?=$kib['NoSTNK']?>" disabled/>
							</li>
							<li>
								<span class="span2">No. BPKB</span>
								<input type="text" class="span3" name="NoBPKB" value="<?=$kib['NoBPKB']?>" disabled/>
							</li>
							<li>
								<span class="span2">Bahan</span>
								<input type="text" class="span3" name="Material" value="<?=$kib['Bahan']?>" disabled/>
							</li>
							<li>
								<span class="span2">No. Rangka</span>
								<input type="text" class="span3" name="NoRangka" value="<?=$kib['NoRangka']?>" disabled/>
							</li>
						</ul>

						<?php
							}elseif($_GET['tipe']=="C"){
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
								<select name="Beton" style="width:155px" disabled>
									<option value="1">Beton</option>
									<option value="2">Tidak</option>
								</select>
							</li>
							<li>&nbsp;</li>
							<li>
								<span class="span2">Jumlah Lantai</span>
								<input type="text" class="span3" name="JumlahLantai" value="<?=$kib['JumlahLantai']?>" disabled/>
							</li>
							<li>
								<span class="span2">Luas Lantai (M2)</span>
								<input type="text" class="span3" name="LuasLantai"value="<?=$kib['LuasLantai']?>" disabled/>
							</li>
							<li>
								<span class="span2">No. Dokumen</span>
								<input type="text" class="span3" name="NoSurat" value="<?=$kib['NoDokumen']?>" disabled/>
							</li>
							<li>
								<span class="span2">Tgl. Dokumen</span>
								<input type="text" class="span2" placeholder="yyyy-mm-dd" name="tglSurat" id="tglSurat" value="<?=$kib['TglDokumen']?>" disabled/>
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
								<input type="text" class="span3" name="Konstruksi" value="<?=$kib['Konstruksi']?>" disabled/>
							</li>
							<li>
								<span class="span2">Panjang (KM)</span>
								<input type="text" class="span2" name="Panjang" value="<?=$kib['Panjang']?>" disabled/>
							</li>
							<li>
								<span class="span2">Lebar (M)</span>
								<input type="text" class="span2" name="Lebar" value="<?=$kib['Lebar']?>" disabled/>
							</li>
							<li>
								<span class="span2">Luas (M2)</span>
								<input type="text" class="span2" name="LuasJaringan"  value="<?=$kib['LuasJaringan']?>" disabled/>
							</li>
							<li>
								<span class="span2">No. Dokumen</span>
								<input type="text" class="span3" name="NoDokumen" value="<?=$kib['NoDokumen']?>" disabled/>
							</li>
							<li>
								<span class="span2">Tgl. Dokumen</span>
								<input type="text" placeholder="yyyy-mm-dd" class="span2" name="tglDokumen" id="tglDokumen" value="<?=$kib['TglDokumen']?>" disabled/>
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
								<input type="text" class="span3" name="Judul" value="<?=$kib['Judul']?>" disabled/>
							</li>
							<li>
								<span class="span2">Pengarang</span>
								<input type="text" class="span3" value="<?=$kib['Pengarang']?>" name="Pengarang" disabled/>
							</li>
							<li>
								<span class="span2">Penerbit</span>
								<input type="text" class="span3" value="<?=$kib['Penerbit']?>" name="Penerbit" disabled/>
							</li>
							<li>
								<span class="span2">Spesifikasi</span>
								<input type="text" class="span3" value="<?=$kib['Spesifikasi']?>" name="Spesifikasi" disabled/>
							</li>
							<li>
								<span class="span2">Asal Daerah</span>
								<input type="text" class="span3" value="<?=$kib['AsalDaerah']?>" name="AsalDaerah" disabled/>
							</li>
							<li>
								<span class="span2">Bahan</span>
								<input type="text" class="span3" value="<?=$kib['Material']?>" name="Material" disabled/>
							</li>
							<li>
								<span class="span2">Ukuran</span>
								<input type="text" class="span3" value="<?=$kib['Ukuran']?>" name="Ukuran" disabled/>
							</li>
						</ul>

						<?php
							}elseif($_GET['tipe']=="F"){
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
								<select name="Beton" style="width:155px" disabled>
									<option value="1">Beton</option>
									<option value="2">Tidak</option>
								</select>
							</li>
							<li>&nbsp;</li>
							<li>
								<span class="span2">Jumlah Lantai</span>
								<input type="text" class="span3" value="<?=$kib['JumlahLantai']?>" name="JumlahLantai" disabled/>
							</li>
							<li>
								<span class="span2">Luas Lantai</span>
								<input type="text" class="span3" value="<?=$kib['LuasLantai']?>"  name="LuasLantai" disabled/>
							</li>
						</ul>
						<?php
					}
						?>
					</div>
					<!-- hidden -->
					<input type="hidden" name="UserNm" value="<?=$_SESSION['ses_uoperatorid']?>">
					<input type="hidden" name="TipeAset" id="TipeAset" value="<?=$_GET['tipe']?>">
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