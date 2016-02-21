<?php
include "../../config/config.php";

$LAYANAN = new RETRIEVE_LAYANAN;

$menu_id = 61;
$SessionUser = $SESSION->get_session_user();
($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
$USERAUTH->FrontEnd_check_akses_menu($menu_id, $Session);

$data = $LAYANAN->retrieve_detail_aset($_GET);
if ($data){
	pr($data);
	if ($_GET['tabel']==1){

		$kondisi = $data['kib'][0]['kondisi'];
		$disable_kondisi = "disabled";

		$kodeKA = $data['kib'][0]['kodeKA'];
		$disable_kodeKA = "";

		$TglPembukuan = $data['kib'][0]['TglPembukuan'];
		$disable_TglPembukuan = "";

		$TglPerubahan = $data['kib'][0]['TglPerubahan'];
		$disable_TglPerubahan = "";

		$NilaiPerolehan = $data['kib'][0]['NilaiPerolehan'];
		$disable_NilaiPerolehan = "disabled";

		$NilaiPerolehan_Awal = $data['kib'][0]['NilaiPerolehan_Awal'];
		$disable_NilaiPerolehan_Awal = "disabled";

		$Info = $data['kib'][0]['Info'];
		$disable_Info = "";

		$StatusTampil = $data['kib'][0]['StatusTampil'];
		$disable_StatusTampil = "";

		$StatusValidasi = $data['kib'][0]['StatusValidasi'];
		$disable_StatusValidasi = "";

		$Status_Validasi_Barang = $data['kib'][0]['Status_Validasi_Barang'];
		$disable_Status_Validasi_Barang = "";

		$dataParam = urlencode(serialize(array('Aset_ID'=>$data['log'][0]['Aset_ID'], 'TipeAset'=>$data['aset'][0]['TipeAset'])));
	}else{
		$kondisi = $data['log'][0]['kondisi'];
		$disable_kondisi = "disabled";

		$kodeKA = $data['log'][0]['kodeKA'];
		$disable_kodeKA = "";

		$TglPembukuan = $data['log'][0]['TglPembukuan'];
		$disable_TglPembukuan = "";

		$TglPerubahan = $data['log'][0]['TglPerubahan'];
		$disable_TglPerubahan = "";

		$NilaiPerolehan = $data['log'][0]['NilaiPerolehan'];
		$disable_NilaiPerolehan = "disabled";

		$NilaiPerolehan_Awal = $data['log'][0]['NilaiPerolehan_Awal'];
		$disable_NilaiPerolehan_Awal = "disabled";

		$Info = $data['log'][0]['Info'];
		$disable_Info = "";

		$StatusTampil = $data['log'][0]['StatusTampil'];
		$disable_StatusTampil = "disabled";

		$StatusValidasi = $data['log'][0]['StatusValidasi'];
		$disable_StatusValidasi = "disabled";

		$Status_Validasi_Barang = $data['log'][0]['Status_Validasi_Barang'];
		$disable_Status_Validasi_Barang = "disabled";

		$dataParam = urlencode(serialize(array('log_id'=>$data['log'][0]['log_id'], 'Aset_ID'=>$data['log'][0]['Aset_ID'], 'TipeAset'=>$data['aset'][0]['TipeAset'])));
	}
}



?>

<?php
	include"$path/meta.php";
	include"$path/header.php";
	include"$path/menu.php";
	
?>
	
	<script type="text/javascript">
		$(document).ready(function() {
			$('#hrgmask,#total').autoNumeric('init');
			$("select").select2({
			});
			   
			$( "#tglPerolehan,#tglPembukuan,#tglSurat,#tglDokumen" ).datepicker({ format: 'yyyy-mm-dd' });
			$( "#tglPerolehan,#tglPembukuan,#tglSurat,#tglDokumen,#datepicker" ).mask('9999-99-99');
		});	

		function getCurrency(item){
	      $('#nilaiPerolehan').val($(item).autoNumeric('get'));
	    }
	</script>
	<section id="main">
		<ul class="breadcrumb">
			  <li><a href="#"><i class="fa fa-home fa-2x"></i>  Home</a> <span class="divider"><b>&raquo;</b></span></li>
			  <li><a href="#">Pemeriksaan</a><span class="divider"><b>&raquo;</b></span></li>
			  <li class="active">Pemeriksaan Edit</li>
			  <?php SignInOut();?>
			</ul>
			<div class="breadcrumb">
				<div class="title">Pemeriksaan</div>
				<div class="subtitle">Pemeriksaan Edit</div>
			</div>		

		<section class="formLegendInve">
			
			<div style="height:5px;width:100%;clear:both"></div>
			<div>
			<form action="" method="POST">
				 
					<div style="height:5px;width:100%;clear:both"></div>

						<div class="detailLeft">
						<ul>
							<li>
								<span class="span2">Kondisi</span>
								<select  name="kondisi" style="width:255px" <?=$disable_kondisi?>>
									<option value="1" <?php if ($kondisi == 1) echo 'selected';?>>Baik</option>
									<option value="2" <?php if ($kondisi == 2) echo 'selected';?>>Rusak Ringan</option>
									<option value="3" <?php if ($kondisi == 3) echo 'selected';?>>Rusak Berat</option>
								</select>
							</li>
							<li>&nbsp;</li>
							<li>
								<span class="span2">Kode KA</span>
								<input id="kodeKA" type="text" class="span3" name="kodeKA" value="<?=$kodeKA?>" <?=$disable_kodeKA?> required onblur="ajaxPemeriksaan('kodeKA',this.value)" data-param="<?php echo $dataParam?>"/>
							</li>
							<li>
								<span class="span2">Tanggal Pembukuan</span>
								<input id="TglPembukuan" type="text" class="span3" name="TglPembukuan" value="<?=$TglPembukuan?>" <?=$disable_TglPembukuan?> required onblur="ajaxPemeriksaan('TglPembukuan',this.value)" data-param="<?php echo $dataParam?>"/>
							</li>
							<li>
								<span class="span2">Tanggal Perubahan</span>
								<input id="TglPerubahan" type="text" class="span3" name="TglPerubahan" value="<?=$TglPerubahan?>" <?=$disable_TglPerubahan?> required onblur="ajaxPemeriksaan('TglPerubahan',this.value)" data-param="<?php echo $dataParam?>"/>
							</li>
							<li>
								<span class="span2">Nilai Perolehan</span>
								<input type="text" class="span3" name="NilaiPerolehan" data-a-sign="Rp " data-a-dec="," data-a-sep="." id="total" value="<?=$NilaiPerolehan?>" <?=$disable_NilaiPerolehan?> onkeyup="return getCurrency(this);"/>
								<input type="hidden" name="NilaiPerolehan" id="nilaiPerolehan" value="<?=($kontrak[0]['tipeAset'] == 3)? $aset[0]['NilaiPerolehan'] : ''?>" >
							</li>
							<li>
								<span class="span2">Nilai Perolehan Awal</span>
								<input type="text" class="span3" name="NilaiPerolehan_Awal" data-a-sign="Rp " data-a-dec="," data-a-sep="." id="total" value="<?=$NilaiPerolehan_Awal?>" <?=$disable_NilaiPerolehan_Awal?>/>
								
							</li>
							<li>
								<span class="span2">Info</span>
								<textarea id="Info" name="Info" class="span3" <?=$disable_Info?> onblur="ajaxPemeriksaan('Info',this.value)" data-param="<?php echo $dataParam?>"><?=$Info?></textarea>
							</li>
							<li>
								<span class="span2">Status Tampil</span>
								<select id="StatusTampil" name="StatusTampil" style="width:255px" <?=$disable_StatusTampil?> onchange="ajaxPemeriksaan('StatusTampil',this.value)" data-param="<?php echo $dataParam?>">
									<option value="0" <?php if ($StatusTampil == 0) echo 'selected';?>>Tidak Tampil</option>
									<option value="1" <?php if ($StatusTampil == 1) echo 'selected';?>>Tampil</option>
									<option value="2" <?php if ($StatusTampil == 2) echo 'selected';?>>Non Aktif</option>
								</select>
							</li>
							<li>&nbsp;</li>
							<li>
								<span class="span2">Status Validasi</span>
								<select id="StatusValidasi" name="StatusValidasi" style="width:255px" <?=$disable_StatusValidasi?> onchange="ajaxPemeriksaan('StatusValidasi',this.value)" data-param="<?php echo $dataParam?>">
									<option value="0" <?php if ($StatusValidasi == 0) echo 'selected';?>>Belum Validasi</option>
									<option value="1" <?php if ($StatusValidasi == 1) echo 'selected';?>>Sudah validasi</option>
									<option value="2" <?php if ($StatusValidasi == 2) echo 'selected';?>>Non Aktif</option>
								</select>
							</li>
							<li>&nbsp;</li>
							<li>
								<span class="span2">Status validasi Barang</span>
								<select id="Status_Validasi_Barang" name="Status_Validasi_Barang" style="width:255px" <?=$disable_Status_Validasi_Barang?> onchange="ajaxPemeriksaan('Status_Validasi_Barang',this.value)" data-param="<?php echo $dataParam?>">
									<option value="0" <?php if ($Status_Validasi_Barang == 0) echo 'selected';?>>Belum Validasi Distribusi</option>
									<option value="1" <?php if ($Status_Validasi_Barang == 1) echo 'selected';?>>Sudah validasi</option>
									<option value="2" <?php if ($Status_Validasi_Barang == 2) echo 'selected';?>>Non Aktif</option>
								</select>
							</li>
						</ul>
							
					</div>
					
		<div style="height:5px;width:100%;clear:both"></div>		
		<!-- <ul>
			<li>
				<span class="span2">
				  <button class="btn" type="reset">Reset</button>
				  <button type="submit" id="submit" class="btn btn-primary">Simpan</button></span>
			</li>
		</ul> -->
					
			
		</form>
		</div>  
			    
		</section> 
		     
	</section>
	
<?php
	include"$path/footer.php";
?>
