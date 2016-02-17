<?php
include "../../config/config.php";
$menu_id = 10;
            $SessionUser = $SESSION->get_session_user();
            ($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
            $USERAUTH->FrontEnd_check_akses_menu($menu_id, $Session);

$get_data_filter = $RETRIEVE->retrieve_kontrak();
// ////pr($get_data_filter);
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
                // $kontrak[] = $dataKontrak;
            }
	?>
	<!-- End Sql -->

	<script>
	jQuery(function($){
	   $("select").select2();
	});
	</script>
	<section id="main">
		<ul class="breadcrumb">
			  <li><a href="#"><i class="fa fa-home fa-2x"></i>  Home</a> <span class="divider"><b>&raquo;</b></span></li>
			  <li><a href="#">Penghapusan</a><span class="divider"><b>&raquo;</b></span></li>
			  <li class="active">Daftar Usulan Penghapusan Pemindahtanganan</li>
			  <?php SignInOut();?>
			</ul>
			<div class="breadcrumb">
				<div class="title">Usulan Penghapusan Pemindahtanganan</div>
				<div class="subtitle">Filter Aset Data </div>
			</div>	

		<div class="grey-container shortcut-wrapper">
				<a class="shortcut-link active" href="<?=$url_rewrite?>/module/penghapusan/dftr_usulan_pmd.php">
					<span class="fa-stack fa-lg">
				      <i class="fa fa-circle fa-stack-2x"></i>
				      <i class="fa fa-inverse fa-stack-1x">1</i>
				    </span>
					<span class="text">Usulan Penghapusan</span>
				</a>
				<a class="shortcut-link" href="<?=$url_rewrite?>/module/penghapusan/dftr_penetapan_pmd.php">
					<span class="fa-stack fa-lg">
				      <i class="fa fa-circle fa-stack-2x"></i>
				      <i class="fa fa-inverse fa-stack-1x">2</i>
				    </span>
					<span class="text">Penetapan Penghapusan</span>
				</a>
				<a class="shortcut-link" href="<?=$url_rewrite?>/module/penghapusan/dftr_validasi_pmd.php">
					<span class="fa-stack fa-lg">
				      <i class="fa fa-circle fa-stack-2x"></i>
				      <i class="fa fa-inverse fa-stack-1x">3</i>
				    </span>
					<span class="text">Validasi Penghapusan</span>
				</a>
			</div>		

		<section class="formLegend">
			
			<form method="POST" action="<?php echo"$url_rewrite"?>/module/penghapusan/dftr_aset_usulan_pmd.php?pid=1&flegAset=1" onsubmit="return requiredFilterHPS(1,1, 'kodeSatker')">
				<ul>
					<li>&nbsp;</li>
					<li><i>*) <u>cukup isi field <strong class="blink_text_red" >Tipe Aset</strong> & <strong class="blink_text_red">Kode Satker</strong> untuk menampilkan seluruh data </u></i></li>
					<li>&nbsp;</li>
					<li>
						<span class="span2">Nomor Kontrak</span>
						<input type='text' style="width: 200px;" name="bup_nokontrak" placeholder=""/>
					</li>
					<li>
						<span class="span2">Tahun Perolehan</span>
						<input type='text' id="#lda_tp" maxlength="4" name="bup_tahun" placeholder="" />
					</li>
					<li>&nbsp;</li>
					<li>

						<span class="span2">Kode Pemilik</span>
						<select id="kodepemilik" name="kodepemilik" style="width:255px" class="full">
							<option value="00">00 Pemerintah Pusat</option>
							<option value="11">11 Pemerintah Provinsi</option>
							<option value="12" selected>12 Pemerintah Kabupaten/Kota</option>
							<option value="13">13 Pemerintah Provinsi Lain</option>
							<option value="14">14 Pemerintah Kabupaten/Kota Lain</option>
							<option value="15">15 Non Pemerintah</option>
						</select>

                    </li>  
                    <li>&nbsp;</li>

					<?php selectAset('kodeKelompok','235',true,false); ?>

                    <li>&nbsp;</li>
					<li>

						<span class="span2">Tipe Aset</span>
						<select name="jenisaset[]" style="width:170px" id="jenisaset">

							<option value="">Pilih Tipe Aset</option>
							<option value="1">Tanah</option>
							<option value="2">Mesin</option>
							<option value="3">Bangunan</option>
							<option value="4">Jaringan</option>
							<option value="5">Aset Tetap Lain</option>
							<option value="6">KDP</option>
						</select>

						<!-- 
                        <span class="span2">Jenis Aset</span>
                        <input type="checkbox" name="jenisaset[]" value="1" class="jenisaset1">Tanah
                        <input type="checkbox" name="jenisaset[]" value="2" class="jenisaset2">Mesin
                        <input type="checkbox" name="jenisaset[]" value="3" class="jenisaset3">Bangunan
                        <input type="checkbox" name="jenisaset[]" value="4" class="jenisaset4">Jaringan
                        <input type="checkbox" name="jenisaset[]" value="5" class="jenisaset5">Aset Lain
                        <input type="checkbox" name="jenisaset[]" value="6" class="jenisaset6">KDP -->
                       
                    </li>  
                    <li>&nbsp;</li>
					<?=selectSatker('kodeSatker',$width='205',$br=true,false);?>
                    <li>&nbsp;</li>
					<li>
						<span class="span2">&nbsp;</span>
						<input type="submit" name="submit" class="btn btn-primary" value="Tampilkan Data" />
						<input type="hidden" name="filterAsetUsulan" value="1" />
						<input type="reset" name="reset" class="btn" value="Bersihkan Data">
					</li>
				</ul>
			</form>
			    
		</section> 
		
	</section>
	
<?php
	include"$path/footer.php";
?>