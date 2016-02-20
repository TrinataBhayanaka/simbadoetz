<?php
include "../../config/config.php";
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

		//kontrak
		$idKontrak = $_GET['id'];
		$sql = mysql_query("SELECT * FROM kontrak WHERE id='{$idKontrak}' LIMIT 1");
			while ($dataKontrak = mysql_fetch_assoc($sql)){
					$kontrak[] = $dataKontrak;
				}
		// pr($kontrak);

		if(isset($_POST['kodeKelompok'])){
		    if($_POST['Aset_ID'] == "")
		    {
		      	if($kontrak[0]['tipeAset'] == 1)
		      	{
		      		$dataArr = $STORE->store_aset($_POST);
		      	} elseif($kontrak[0]['tipeAset'] == 2) {
		      		$dataArr = $STORE->store_aset_kapitalisasi($_POST,$_GET);
		      	} elseif ($kontrak[0]['tipeAset'] == 3) {
		      		$dataArr = $STORE->store_aset_kdp($_POST,$_GET);
		      	}	
		      
		    }  else
		    {
		      $dataArr = $STORE->store_edit_aset($_POST,$_POST['Aset_ID']);
		    }
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
								<input type="text" id="totalRB" value="<?=isset($sumTotal) ? number_format($sumTotal['total']) : '0'?>" disabled/>
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
							<?=selectSatker('kodeSatker','255',true,false,'required');?>
						</ul>
				 		<ul>
							<?=selectRuang('kodeRuangan','kodeSatker','255',true,false);?>
						</ul>
						<ul>
							<?php selectAset('kodeKelompok','255',true,false,'required'); ?>
						</ul>
						<ul class="tanah" style="display:none">
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
							<li>
								<span class="span2">Penggunaan</span>
								<input type="text" class="span3" name="Penggunaan" disabled/>
							</li>
						</ul>
						<ul class="mesin" style="display:none">
							<li>
								<span class="span2">Merk</span>
								<input type="text" class="span3" name="Merk" disabled/>
							</li>
							<li>
								<span class="span2">Type</span>
								<input type="text" class="span3" name="Model" disabled/>
							</li>
							<li>
								<span class="span2">Ukuran / CC</span>
								<input type="text" class="span3" name="Ukuran" disabled/>
							</li>
							<li>
								<span class="span2">No. Pabrik</span>
								<input type="text" class="span3" name="Pabrik" disabled/>
							</li>
							<li>
								<span class="span2">No. Mesin</span>
								<input type="text" class="span3" name="NoMesin" disabled/>
							</li>
							<li>
								<span class="span2">No. Polisi</span>
								<input type="text" class="span3" name="NoSeri" disabled/>
							</li>
							<li>
								<span class="span2">No. BPKB</span>
								<input type="text" class="span3" name="NoBPKB" disabled/>
							</li>
							<li>
								<span class="span2">Bahan</span>
								<input type="text" class="span3" name="Material" disabled/>
							</li>
							<li>
								<span class="span2">No. Rangka</span>
								<input type="text" class="span3" name="NoRangka" disabled/>
							</li>
						</ul>
						<ul class="bangunan" style="display:none">
							<li>
								<span class="span2">Beton / Tidak</span>
								<select id="beton_bangunan" name="Beton" style="width:155px" disabled>
									<option value="1">Beton</option>
									<option value="2">Tidak</option>
								</select>
							</li>
							<li>&nbsp;</li>
							<li>
								<span class="span2">Jumlah Lantai</span>
								<input type="text" class="span3" name="JumlahLantai" value="<?=($kontrak[0]['tipeAset'] == 3)? $aset[0]['JumlahLantai'] : ''?>" disabled/>
							</li>
							<li>
								<span class="span2">Luas Lantai (M2)</span>
								<input type="text" class="span3" name="LuasLantai" value="<?=($kontrak[0]['tipeAset'] == 3)? $aset[0]['LuasLantai'] : ''?>" disabled/>
							</li>
							<li>
								<span class="span2">No. Dokumen</span>
								<input type="text" class="span3" name="NoSurat" value="<?=($kontrak[0]['tipeAset'] == 3)? $aset[0]['LuasLantai'] : ''?>" disabled/>
							</li>
							<li>
								<span class="span2">Tgl. Dokumen</span>
								<input type="text" class="span2" placeholder="yyyy-mm-dd" name="tglSurat" id="tglSurat" disabled/>
							</li>
						</ul>
						<ul class="jaringan" style="display:none">
							<li>
								<span class="span2">Konstruksi</span>
								<input type="text" class="span3" name="Konstruksi" disabled/>
							</li>
							<li>
								<span class="span2">Panjang (KM)</span>
								<input type="text" class="span2" name="Panjang" disabled/>
							</li>
							<li>
								<span class="span2">Lebar (M)</span>
								<input type="text" class="span2" name="Lebar" disabled/>
							</li>
							<li>
								<span class="span2">Luas (M2)</span>
								<input type="text" class="span2" name="LuasJaringan" disabled/>
							</li>
							<li>
								<span class="span2">No. Dokumen</span>
								<input type="text" class="span3" name="NoDokumen" value="<?=($kontrak[0]['tipeAset'] == 3)? $aset[0]['LuasLantai'] : ''?>" disabled/>
							</li>
							<li>
								<span class="span2">Tgl. Dokumen</span>
								<input type="text" placeholder="yyyy-mm-dd" class="span2" name="tglDokumen" id="tglDokumen" disabled/>
							</li>
						</ul>
						<ul class="asetlain" style="display:none">
							<li>
								<span class="span2">Judul</span>
								<input type="text" class="span3" name="Judul" disabled/>
							</li>
							<li>
								<span class="span2">Pengarang</span>
								<input type="text" class="span3" name="Pengarang" disabled/>
							</li>
							<li>
								<span class="span2">Penerbit</span>
								<input type="text" class="span3" name="Penerbit" disabled/>
							</li>
							<li>
								<span class="span2">Spesifikasi</span>
								<input type="text" class="span3" name="Spesifikasi" disabled/>
							</li>
							<li>
								<span class="span2">Asal Daerah</span>
								<input type="text" class="span3" name="AsalDaerah" disabled/>
							</li>
							<li>
								<span class="span2">Bahan</span>
								<input type="text" class="span3" name="Material" disabled/>
							</li>
							<li>
								<span class="span2">Ukuran</span>
								<input type="text" class="span3" name="Ukuran" disabled/>
							</li>
						</ul>
						<ul class="kdp" style="display:none">
							<li>
								<span class="span2">Beton / Tidak</span>
								<select id="beton_kdp" name="Beton" style="width:155px">
									<option value="1">Beton</option>
									<option value="2">Tidak</option>
								</select>
							</li>
							<li>&nbsp;</li>
							<li>
								<span class="span2">Jumlah Lantai</span>
								<input type="text" class="span3" name="JumlahLantai" disabled/>
							</li>
							<li>
								<span class="span2">Luas Lantai</span>
								<input type="text" class="span3" name="LuasLantai" disabled/>
							</li>
						</ul>
						<ul>
							<li>
								<span class="span2">Tgl. Perolehan</span>
								<div class="control">
									<div class="input-prepend">
										<span class="add-on"><i class="fa fa-calendar"></i></span>
										<input type="text" class="span2 datepicker" placeholder="yyyy-mm-dd" id="datepicker" name="TglPerolehan" value="<?=($kontrak[0]['tipeAset'] == '3')? $aset[0]['TglPerolehan'] : ''?>" required <?=($kontrak[0]['tipeAset'] == '3')? readonly : ''?>/>
									</div>
								</div>
							</li>
							<li>
								<span class="span2">Alamat</span>
								<textarea name="Alamat" class="span3" ><?=($kontrak[0]['tipeAset'] == 3)? $aset[0]['Alamat'] : ''?></textarea>
							</li>
							<li>
								<span class="span2">Jumlah</span>
								<input type="text" class="span3" name="Kuantitas" id="jumlah" value="<?=($kontrak[0]['tipeAset'] == 3)? 1 : ''?>" onchange="return totalHrg()" required <?=($kontrak[0]['tipeAset'] == '3')? readonly : ''?>/>
							</li>
							<li>
								<span class="span2">Harga Satuan</span>
								<input type="text" class="span3" data-a-sign="Rp " id="hrgmask" data-a-dec="," data-a-sep="." value="<?=($kontrak[0]['tipeAset'] == 3)? $aset[0]['NilaiPerolehan'] : ''?>" onkeyup="return getCurrency(this);" onchange="return totalHrg();" required/>
								<input type="hidden" name="Satuan" id="hrgSatuan" value="<?=($kontrak[0]['tipeAset'] == 3)? $aset[0]['NilaiPerolehan'] : ''?>" >
							</li>
							<li>
								<span class="span2">Nilai Perolehan</span>
								<input type="text" class="span3" name="NilaiPerolehan" data-a-sign="Rp " data-a-dec="," data-a-sep="." id="total" value="<?=($kontrak[0]['tipeAset'] == 3)? $aset[0]['NilaiPerolehan'] : ''?>" readonly/>
								<input type="hidden" name="NilaiPerolehan" id="nilaiPerolehan" value="<?=($kontrak[0]['tipeAset'] == 3)? $aset[0]['NilaiPerolehan'] : ''?>" >
							</li>
							<li>
								<span class="span2">Info</span>
								<textarea name="Info" class="span3" ><?=($kontrak[0]['tipeAset'] == 3)? $aset[0]['Info'] : ''?></textarea>
							</li>
							<li>
								<span class="span2">
								  <button class="btn" type="reset">Reset</button>
								  <button type="submit" id="submit" class="btn btn-primary">Simpan</button></span>
							</li>
						</ul>
							
					</div>
					<!-- hidden -->
					<input type="hidden" name="Aset_ID" value="">
					<input type="hidden" name="id" value="<?=$kontrak[0]['id']?>">
					<input type="hidden" name="kodeSatker" value="<?=$kontrak[0]['kodeSatker']?>">
					<input type="hidden" name="noKontrak" value="<?=$kontrak[0]['noKontrak']?>">
					<input type="hidden" name="kondisi" value="1">
					<input type="hidden" name="AsalUsul" value="Pembelian">
					<input type="hidden" name="UserNm" value="<?=$_SESSION['ses_uoperatorid']?>">
					<input type="hidden" name="TipeAset" id="TipeAset" value="">
					<input type="hidden" name="getTipe" id="getTipe" value="<?=$_GET['tipeaset']?>">
			
		</form>
		</div>  
			    
		</section> 
		     
	</section>
	
<?php
	include"$path/footer.php";
?>

<script type="text/javascript">
	$(document).ready(function(){
		setTimeout(function(){
			var tipe = $("#getTipe").val();
			var spk = $("#spk").val();
			var str = parseInt(spk.replace(/[^0-9\.]+/g, ""));
			if(tipe == "mesin"){
				if(str < 300000){
					alert("Maaf nilai kontrak anda tidak sesuai dengan aturan. Untuk jenis barang mesin minimal Rp. 300.000. Silahkan edit kontrak anda.");
					window.location.replace("kontrak_simbada.php");
				} 
			}else if(tipe == "bangunan"){
				if(str < 10000000){
					alert("Maaf nilai kontrak anda tidak sesuai dengan aturan. Untuk jenis bangunan minimal Rp. 10.000.000. Silahkan edit kontrak anda.");
					window.location.replace("kontrak_simbada.php");
				} 
			}
		}, 1000);
	})

	$(document).on('change','#kodeKelompok', function(){

		var kode = $('#kodeKelompok').val();
		var gol = kode.split(".");

		if(gol[0] == '01')
		{
			$("#TipeAset").val('A');
			$(".mesin,.bangunan,.jaringan,.asetlain,.kdp").hide('');
			$(".mesin li > input,.bangunan li > input,.jaringan li > input,.asetlain li > input,.kdp li > input").attr('disabled','disabled');
			$(".tanah li > input,textarea").removeAttr('disabled');
			$("#hakpakai").removeAttr('disabled');
			$("#beton_bangunan,#beton_kdp").attr('disabled','disabled');
			$(".tanah").show('');
		} else if(gol[0] == '02')
		{
			$("#TipeAset").val('B');
			$(".tanah,.bangunan,.jaringan,.asetlain,.kdp").hide('');
			$(".tanah li > input,.bangunan li > input,.jaringan li > input,.asetlain li > input,.kdp li > input").attr('disabled','disabled');
			$(".mesin li > input,textarea").removeAttr('disabled');
			$("#hakpakai,#beton_bangunan,#beton_kdp").attr('disabled','disabled');
			$(".mesin").show('');
		} else if(gol[0] == '03')
		{
			$("#TipeAset").val('C');
			$(".tanah,.mesin,.jaringan,.asetlain,.kdp").hide('');
			$(".tanah li > input,.mesin li > input,.jaringan li > input,.asetlain li > input,.kdp li > input").attr('disabled','disabled');
			$(".bangunan li > input,textarea").removeAttr('disabled');
			$("#beton_bangunan").removeAttr('disabled');
			$("#hakpakai,#beton_kdp").attr('disabled','disabled');
			$(".bangunan").show('');
		} else if(gol[0] == '04')
		{
			$("#TipeAset").val('D');
			$(".tanah,.mesin,.bangunan,.asetlain,.kdp").hide('');
			$(".tanah li > input,.mesin li > input,.bangunan li > input,.asetlain li > input,.kdp li > input").attr('disabled','disabled');
			$(".jaringan li > input,textarea").removeAttr('disabled');
			$("#hakpakai,#beton_bangunan,#beton_kdp").attr('disabled','disabled');
			$(".jaringan").show('');
		} else if(gol[0] == '05'){
			$("#TipeAset").val('E');
			$(".tanah,.mesin,.bangunan,.jaringan,.kdp").hide('');
			$(".tanah li > input,.mesin li > input,.bangunan li > input,.jaringan li > input,.kdp li > input").attr('disabled','disabled');
			$(".asetlain li > input,textarea").removeAttr('disabled');
			$("#hakpakai,#beton_bangunan,#beton_kdp").attr('disabled','disabled');
			$(".asetlain").show('');
		} else if(gol[0] == '06'){
			$("#TipeAset").val('F');
			$(".tanah,.mesin,.bangunan,.asetlain,.jaringan").hide('');
			$(".tanah li > input,.mesin li > input,.bangunan li > input,.asetlain li > input,.jaringan li > input,textarea").attr('disabled','disabled');
			$(".kdp li > input,textarea").removeAttr('disabled');
			$("#beton_kdp").removeAttr('disabled');
			$("#hakpakai,#beton_bangunan").attr('disabled','disabled');
			$(".kdp").show('');
		} else {
			$("#TipeAset").val('G');
			$(".tanah,.mesin,.bangunan,.asetlain,.jaringan,.kdp").hide('');
			$(".tanah li > input,.mesin li > input,.bangunan li > input,.asetlain li > input,.jaringan li > input,.kdp li > input").attr('disabled','disabled');
			$("#hakpakai,#beton_bangunan,#beton_kdp").attr('disabled','disabled');
		}			
		
	});

	$(document).on('submit', function(){
		var perolehan = $("#nilaiPerolehan").val();
		var total = $("#totalRB").val();
		var spk = $("#spk").val();
		var str = parseInt(spk.replace(/[^0-9\.]+/g, ""));
		var rb = parseInt(total.replace(/[^0-9\.]+/g, ""));

		var diff = parseInt(perolehan) + parseInt(rb);

		if(diff > str) {
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
