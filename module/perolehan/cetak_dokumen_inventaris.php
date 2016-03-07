<?php
include "../../config/config.php";

$USERAUTH = new UserAuth();
$SESSION = new Session();
$menu_id = 14;
$SessionUser = $SESSION->get_session_user();
$USERAUTH->FrontEnd_check_akses_menu($menu_id,$SessionUser);
?>

<?php
	include"$path/meta.php";
	include"$path/header.php";
	include"$path/menu.php";
	
?>
	<script>
		function newruangan(){
				if($("#kodeSatker2").val() != "" && $("#tglCetakKir").val() != ""){
					var tgl = $("#tglCetakKir").val();
					var tmp = tgl.split("-");
					$('#hiddenthn').val(tmp[0]);
				} 
			}
			
		function newruangan2(){
				if($("#kodeSatker8").val() != "" && $("#tahun_label").val() != ""){
					var tgl = $("#tahun_label").val();
					//var tmp = tgl.split("-");
					// $('#hiddenthn2').val(tmp[0]);
					$('#tahun_label').val(tgl);
				} 
			}	
	</script>
	<section id="main">
		<ul class="breadcrumb">
			  <li><a href="#"><i class="fa fa-home fa-2x"></i>  Home</a> <span class="divider"><b>&raquo;</b></span></li>
			  <li><a href="#">Perolehan</a><span class="divider"><b>&raquo;</b></span></li>
			  <li class="active">Cetak Dokumen Inventaris</li>
			  <?php SignInOut();?>
			</ul>
			<div class="breadcrumb">
				<div class="title">Cetak Dokumen Inventaris</div>
				<div class="subtitle">Cetak Dokumen</div>
			</div>	
		<section class="formLegend">
			
			<div class="tabbable" style="margin-bottom: 18px;">
					  <ul class="nav nav-tabs">
						<li class="active"><a href="#kib" data-toggle="tab">KIB</a></li>
						<li><a href="#rekapkib" data-toggle="tab">Rekapitulasi KIB</a></li>
						<li><a href="#rekapbarang" data-toggle="tab">Rekapitulasi Barang</a></li>
						<li><a href="#rekapsensusbarang" data-toggle="tab">Rekapitulasi Sensus Barang</a></li>
						<li><a href="#kir" data-toggle="tab">KIR</a></li>
						<!--<li><a href="#biskpd" data-toggle="tab">Buku Inventaris SKPD</a></li>-->
						<li><a href="#biskpdgab" data-toggle="tab">Buku Inventaris Gabungan SKPD</a></li>
						<!--<li><a href="#rbiskpd" data-toggle="tab">Rekapitulasi Buku Inventaris SKPD</a></li>
						<li><a href="#biid" data-toggle="tab">Buku Induk Inventaris Daerah</a></li>
						<li><a href="#rbiid" data-toggle="tab">Rekapitulasi Buku Induk Inventaris Daerah</a></li>-->
						<li><a href="#label" data-toggle="tab">Label Kode Barang</a></li>
						<li><a href="#kb" data-toggle="tab">Kartu Barang</a></li>
						<li><a href="#lpri" data-toggle="tab">Laporan Inventaris</a></li>
						</ul>
					  <div class="tab-content" style="padding-bottom: 9px; border-bottom: 1px solid #ddd;">
						
						<div class="tab-pane active" id="kib">
						<div class="breadcrumb">
							<div class="titleTab">Kartu Inventaris Barang</div>
						</div>
						 <form name="form" method="POST" action="<?php echo "$url_rewrite/report/template/PEROLEHAN/kib.php"; ?>">
						 <script>
						$(document).ready(function() {
							$( "#tglPerolehan_1,#tglPerolehan_2,#tglPerolehan_awal_kir,#tglPerolehan_akhir_kir,#tglawalPerolehan_bis,#tglakhirPerolehan_bis,#tglPerolehan_Awal_biid,#tglPerolehan_Akhir_biid,#tglPerolehan_awal_intra,#tglPerolehan_akhir_intra,#tglPerolehan_awal_ekstra,#tglPerolehan_akhir_ekstra,#tglPerolehan_awal_rekapbis,#tglPerolehan_akhir_rekapbis,#tglPerolehan_awal_induk,#tglPerolehan_akhir_induk,#tglCetakKib,#tglCetakRekapKib,#tglCetakKir,#tglCetakBiv,#tglCetakRekapBiv,#tglCetakBivIndk,#tglCetakRekapBivIndk,#tglPerolehan_awal_kb,#tglPerolehan_akhir_kb,#tglCetakKb,#tglawalPerolehan_bisgab,#tglakhirPerolehan_bisgab,#tglCetakBivgab,#tglawalPerolehan_li,#tglpembukuan_li,#tglawalLabel,#tglakhirlLabel").mask('9999-99-99');
							$( "#tahun_label,#tahun_rekap_kib,#tahun_rekap,#tahun_kb").mask('9999');
							$( "#tglPerolehan_1,#tglPerolehan_2,#tglPerolehan_awal_kir,#tglPerolehan_akhir_kir,#tglawalPerolehan_bis,#tglakhirPerolehan_bis,#tglPerolehan_Awal_biid,#tglPerolehan_Akhir_biid,#tglPerolehan_awal_intra,#tglPerolehan_akhir_intra,#tglPerolehan_awal_ekstra,#tglPerolehan_akhir_ekstra,#tglPerolehan_awal_rekapbis,#tglPerolehan_akhir_rekapbis,#tglPerolehan_awal_induk,#tglPerolehan_akhir_induk,#tglCetakKib,#tglCetakRekapKib,#tglCetakKir,#tglCetakBiv,#tglCetakRekapBiv,#tglCetakBivIndk,#tglCetakRekapBivIndk,#tglPerolehan_awal_kb,#tglPerolehan_akhir_kb,#tglCetakKb,#tglawalPerolehan_bisgab,#tglakhirPerolehan_bisgab,#tglCetakBivgab,#tglawalPerolehan_li,#tglpembukuan_li,#tglawalLabel,#tglakhirlLabel" ).datepicker({ dateFormat: 'yy-mm-dd' });
						});
						
						</script>
						<ul>
							<li>
								<input type="radio" name="kib" value="KIB-A" class="inven1" checked onclick="show_kelompok('KIB-A'); ">&nbsp; KIB-A
								<input type="radio" name="kib" value="KIB-B" class="inven2" onclick="show_kelompok('KIB-B');">&nbsp; KIB-B
								<input type="radio" name="kib" value="KIB-C" class="inven3" onclick="show_kelompok('KIB-C');"> &nbsp; KIB-C
								<input type="radio" name="kib" value="KIB-D" class="inven4" onclick="show_kelompok('KIB-D');"> &nbsp;KIB-D
								<input type="radio" name="kib" value="KIB-E" class="inven5" onclick="show_kelompok('KIB-E');"> &nbsp;KIB-E
								<input type="radio"name="kib" value="KIB-F" class="inven6" onclick="show_kelompok('KIB-F');"> &nbsp;KIB-F
								<!--<input type="button" name="kib" class="btn btn-info" value="Cetak KIB Kosong">-->
								<br/>
							</li>
							<li>&nbsp;
							</li>
							<li>
								<span class="span2">Tanggal Awal</span>
								<div class="control">
									<div class="input-prepend">
										<span class="add-on"><i class="fa fa-calendar"></i></span>
										<input type="text" class="span2 full" name="tglPerolehan_1" id="tglPerolehan_1" value="" />
									</div>
								</div>
							</li>
							<li>
								<span class="span2">Tanggal Akhir</span>
								<div class="control">
									<div class="input-prepend">
										<span class="add-on"><i class="fa fa-calendar"></i></span>
										<input type="text" class="span2 full" name="tglPerolehan_2" id="tglPerolehan_2" value="" required/>
									</div>
								</div>
							</li>
							<?php //selectAllSatker('kodeSatker','255',true,false,'required'); 
								selectAllSatker('kodeSatker','255',true,false,false,true);
							?>
							<br />
							<li>
								<span class="span2">Kode Pemilik</span>
								<select name = "pemilik" class="" id="sel1">
									<option value="12" selected>12 - Pemerintah Kota</option>
									<option value="11">11 - Pemerintah Provinsi</option>
									<option value="00">00 - Kementrian Lembaga</option>
							  </select>
							</li>
							<li>
								<span class="span2">Tanggal Cetak</span>
								<div class="control">
									<div class="input-prepend">
										<span class="add-on"><i class="fa fa-calendar"></i></span>
										<input type="text" class="span2 full" name="tglCetakKib" id="tglCetakKib" value="" required/>
									</div>
								</div>
							</li>
							<li>
								<span class="span2">&nbsp;</span>
								<input type="submit" name="lanjut" class="btn btn-primary" value="Lanjut" />
								<input type="reset" name="reset" class="btn" value="Bersihkan Filter" />
							</li>
						</ul>
						<input type="hidden" name="menuID" value="14">
						<input type="hidden" name="mode" value="1">
						<input type="hidden" name="tab" value="1">
						</form>
						</div>
						
						<div class="tab-pane" id="rekapkib">
						<div class="breadcrumb">
							<div class="titleTab">Rekapitulasi Kartu Inventaris Barang</div>
						</div>
						 <form name="form" method="POST" action="<?php echo "$url_rewrite/report/template/PEROLEHAN/rekapkib.php"; ?>">
						<ul>
							<li>
								<input type="radio" name="rekap" value="RekapKIB-A" class="inven1" checked >&nbsp; KIB-A
								<input type="radio" name="rekap" value="RekapKIB-B" class="inven2" >&nbsp; KIB-B
								<input type="radio" name="rekap" value="RekapKIB-C" class="inven3" > &nbsp; KIB-C
								<input type="radio" name="rekap" value="RekapKIB-D" class="inven4" > &nbsp;KIB-D
								<input type="radio" name="rekap" value="RekapKIB-E" class="inven5" > &nbsp;KIB-E
								<input type="radio"name="rekap" value="RekapKIB-F" class="inven6"> &nbsp;KIB-F
								<!--<input type="button" name="kib" class="btn btn-info" value="Cetak KIB Kosong">-->
								<br/>
							</li>
							<li>&nbsp;
							</li>
							<li>
								<span class="span2">Tahun</span>
								<input name="tahun" id ="tahun_rekap_kib" type="text" maxlength='4' value="<?php echo date('Y')?>" required>
							</li>
							<?php //selectAllSatker('kodeSatker7','255',true,false); 
					
									selectAllSatker('kodeSatker7','255',true,false,false,true);
							
							?>
							<br />
							<li>
								<span class="span2">Kode Pemilik</span>
								<select name = "pemilik" class="" id="sel1">
									<option value="12" selected>12 - Pemerintah Kota</option>
									<option value="11">11 - Pemerintah Provinsi</option>
									<option value="00">00 - Kementrian Lembaga</option>
							  </select>
							</li>
							<li>
								<span class="span2">Tanggal Cetak</span>
								<div class="control">
									<div class="input-prepend">
										<span class="add-on"><i class="fa fa-calendar"></i></span>
										<input type="text" class="span2 full" name="tglCetakRekapKib" id="tglCetakRekapKib" value="" required/>
									</div>
								</div>
							</li>
							<li>
								<span class="span2">&nbsp;</span>
								<input type="submit" name="lanjut" class="btn btn-primary" value="Lanjut" />
								<input type="reset" name="reset" class="btn" value="Bersihkan Filter" />
							</li>
						</ul>
						<input type="hidden" name="menuID" value="14">
						<input type="hidden" name="mode" value="1">
						<input type="hidden" name="tab" value="9">
						</form>
						</div>
						
						<div class="tab-pane" id="rekapbarang">
						<div class="breadcrumb">
							<div class="titleTab">Rekapitulasi Barang </div>
						</div>
						 <form name="form" method="POST" action="<?php echo "$url_rewrite/report/template/PEROLEHAN/rekapBarangkib.php"; ?>">
						<ul>
							<li>
								<input type="radio" name="rekap_barang" value="RekapBarangKIB-A" class="inven1" checked >&nbsp; KIB-A
								<input type="radio" name="rekap_barang" value="RekapBarangKIB-B" class="inven2" >&nbsp; KIB-B
								<input type="radio" name="rekap_barang" value="RekapBarangKIB-C" class="inven3" > &nbsp; KIB-C
								<input type="radio" name="rekap_barang" value="RekapBarangKIB-D" class="inven4" > &nbsp;KIB-D
								<input type="radio" name="rekap_barang" value="RekapBarangKIB-E" class="inven5" > &nbsp;KIB-E
								<input type="radio"name="rekap_barang" value="RekapBarangKIB-F" class="inven6"> &nbsp;KIB-F
								<br/>
							</li>
							<li>&nbsp;
							</li>
							<li>
								<span class="span2">Tahun</span>
								<input name="tahun_rekap" id ="tahun_rekap" type="text" maxlength='4' value="<?php echo date('Y')?>" required>
							</li>
							<?php //selectAllSatker('kodeSatker7','255',true,false); 
					
									selectAllSatker('kodeSatker16','255',true,false,false,true);
							
							?>
							<br />
							<li>
								<span class="span2">Kode Pemilik</span>
								<select name = "pemilik" class="" id="sel1">
									<option value="12" selected>12 - Pemerintah Kota</option>
									<option value="11">11 - Pemerintah Provinsi</option>
									<option value="00">00 - Kementrian Lembaga</option>
							  </select>
							</li>
							
							<!--<li>
								<span class="span2">Tanggal Cetak</span>
								<div class="control">
									<div class="input-prepend">
										<span class="add-on"><i class="fa fa-calendar"></i></span>
										<input type="text" class="span2 full" name="tglCetakRekapKib" id="tglCetakRekapKib" value="" required/>
									</div>
								</div>
							</li>-->
							<li>
								<span class="span2">&nbsp;</span>
								<input type="submit" name="lanjut" class="btn btn-primary" value="Lanjut" />
								<input type="reset" name="reset" class="btn" value="Bersihkan Filter" />
							</li>
						</ul>
						<input type="hidden" name="menuID" value="14">
						<input type="hidden" name="mode" value="1">
						<input type="hidden" name="tab" value="11">
						</form>
						</div>
						
						<div class="tab-pane" id="rekapsensusbarang">
						<div class="breadcrumb">
							<div class="titleTab">Rekapitulasi Sensus Barang </div>
						</div>
						 <form name="form" method="POST" action="<?php echo "$url_rewrite/report/template/PEROLEHAN/rekapSensusBarangkib.php"; ?>">
						<ul>
							<li>
								<input type="radio" name="rekap_barang_sensus" value="RekapBarangSensusKIB-A" class="inven1" checked >&nbsp; KIB-A
								<input type="radio" name="rekap_barang_sensus" value="RekapBarangSensusKIB-B" class="inven2" >&nbsp; KIB-B
								<input type="radio" name="rekap_barang_sensus" value="RekapBarangSensusKIB-C" class="inven3" > &nbsp; KIB-C
								<input type="radio" name="rekap_barang_sensus" value="RekapBarangSensusKIB-D" class="inven4" > &nbsp;KIB-D
								<input type="radio" name="rekap_barang_sensus" value="RekapBarangSensusKIB-E" class="inven5" > &nbsp;KIB-E
								<input type="radio"name="rekap_barang_sensus" value="RekapBarangSensusKIB-F" class="inven6"> &nbsp;KIB-F
								<br/>
							</li>
							<li>&nbsp;
							</li>
							<li>
								<span class="span2">Tahun</span>
								<input name="tahun_rekap_sensus" id ="tahun_rekap" type="text" maxlength='4' value="<?php echo date('Y')?>" required>
							</li>
							<?php //selectAllSatker('kodeSatker7','255',true,false); 
					
									selectAllSatker('kodeSatker18','255',true,false,false,true);
							
							?>
							<br />
							<li>
								<span class="span2">Kode Pemilik</span>
								<select name = "pemilik" class="" id="sel1">
									<option value="12" selected>12 - Pemerintah Kota</option>
									<option value="11">11 - Pemerintah Provinsi</option>
									<option value="00">00 - Kementrian Lembaga</option>
							  </select>
							</li>
							<li>
								<span class="span2">&nbsp;</span>
								<input type="submit" name="lanjut" class="btn btn-primary" value="Lanjut" />
								<input type="reset" name="reset" class="btn" value="Bersihkan Filter" />
							</li>
						</ul>
						<input type="hidden" name="menuID" value="14">
						<input type="hidden" name="mode" value="1">
						<input type="hidden" name="tab" value="12">
						</form>
						</div>
						
						
						
						<div class="tab-pane" id="kir">
						<div class="breadcrumb">
							<div class="titleTab">Kartu Inventaris Ruangan</div>
						</div>
						   <form name="form" method="POST" action="<?php echo "$url_rewrite/report/template/PEROLEHAN/kir.php"; ?>">
						<ul>
							<li>
								<span class="span2">Tanggal Awal</span>
								<div class="control">
									<div class="input-prepend">
										<span class="add-on"><i class="fa fa-calendar"></i></span>
										<input type="text" class="span2 full" name="tglPerolehan_awal_kir" id="tglPerolehan_awal_kir" value=""/>
									</div>
								</div>
							</li>
							<li>
								<span class="span2">Tanggal Akhir</span>
								<div class="control">
									<div class="input-prepend">
										<span class="add-on"><i class="fa fa-calendar"></i></span>
										<input type="text" class="span2 full" name="tglPerolehan_akhir_kir" id="tglPerolehan_akhir_kir" value="" required/>
									</div>
								</div>
							</li>
							<?php //selectAllSatker('kodeSatker2','255',true,false); 
						
									selectAllSatker('kodeSatker2','255',true,false,false,true);
							
							?>
							<br>
							<li>
								<span class="span2">Kode Pemilik</span>
								<select name = "pemilik" class="" id="sel1">
									<option value="12" selected>12 - Pemerintah Kota</option>
									<option value="11">11 - Pemerintah Provinsi</option>
									<option value="00">00 - Kementrian Lembaga</option>
							  </select>
							</li>
							<li>
								<span class="span2">Tanggal Cetak</span>
								<div class="control">
									<div class="input-prepend">
										<span class="add-on"><i class="fa fa-calendar"></i></span>
										<input type="text" class="span2 full" name="tglCetakKir" id="tglCetakKir" value="" onchange="return newruangan();"
										required/>
									</div>
								</div>
							</li>
							<?=selectRuangKir('kodeRuangan','kodeSatker2','255',true,false,false,'hiddenthn');?>
							<br>
							<li>
								<span class="span2">&nbsp;</span>
								 <input type="submit" onClick="testsendit_5()" class="btn btn-primary" name="submit"value="Lanjut" />
								<input type="reset"name="reset" onClick="sendit_6()" class="btn" value="Bersihkan Filter" />
							</li>
						</ul>
						 <input type="hidden" name="menuID" value="14">
						<input type="hidden" name="mode" value="1">
						<input type="hidden" name="tab" value="2">
						<input type="hidden" name="kir" value="kir">
						<input type="hidden" id="hiddenthn" value="">

						</form>
						</div>
						
						<div class="tab-pane" id="biskpd">
						<div class="breadcrumb">
							<div class="titleTab">Buku Inventaris SKPD</div>
						</div>
						  <form name="form" method="POST" action="<?php echo "$url_rewrite/report/template/PEROLEHAN/skpd.php"; ?>">
						<ul>
							<li>
								<span class="span2">Tanggal Awal</span>
								<div class="control">
									<div class="input-prepend">
										<span class="add-on"><i class="fa fa-calendar"></i></span>
										<input type="text" class="span2 full" name="tglawalPerolehan_bis" id="tglawalPerolehan_bis" value="" />
									</div>
								</div>
							</li>
							<li>
								<span class="span2">Tanggal Akhir</span>
								<div class="control">
									<div class="input-prepend">
										<span class="add-on"><i class="fa fa-calendar"></i></span>
										<input type="text" class="span2 full" name="tglakhirPerolehan_bis" id="tglakhirPerolehan_bis" value="" required/>
									</div>
								</div>
							</li>
							<li>
								<span class="span2">Kelompok</span>
								<div class="input-append">
									<input type="text" name="lda_kelompok" id="lda_kelompok" class="span5" readonly="readonly" value="" placeholder="(Semua Kelompok)">
									<input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" class="btn" value="Pilih" onclick = "showSpoiler(this);"><font size="1" color="grey"><i>&nbsp;</i></font>
									<div class="inner" style="display:none;">
										
										<?php
											$alamat_simpul_kelompok="$url_rewrite/function/dropdown/radio_simpul_kelompok.php";
											$alamat_search_kelompok="$url_rewrite/function/dropdown/radio_search_kelompok.php";
											js_radiokelompok($alamat_simpul_kelompok, $alamat_search_kelompok,"lda_kelompok","kelompok_id",'kelompok','ldakelompokfilter');
											$style="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
											radiokelompok($style,"kelompok_id",'kelompok','ldakelompokfilter');
										?>
									</div>
								</div>
							</li>
							<?php //selectAllSatker('kodeSatker3','255',true,false); 
					
									selectAllSatker('kodeSatker3','255',true,false,false,true);
							
							?>
							<br>
							<li>
								<span class="span2">Tanggal Cetak</span>
								<div class="control">
									<div class="input-prepend">
										<span class="add-on"><i class="fa fa-calendar"></i></span>
										<input type="text" class="span2 full" name="tglCetakBiv" id="tglCetakBiv" value=""
										required/>
									</div>
								</div>
							</li>
							<li>
								<span class="span2">&nbsp;</span>
								 <input type="submit" onClick="sendit_5()" class="btn btn-primary" name="bi_skpd" value="Lanjut" />
								<input type="reset"name="reset" onClick="sendit_6()" value="Bersihkan Filter" />
							</li>
						</ul>
						<input type="hidden" name="menuID" value="14">
						<input type="hidden" name="mode" value="1">
						<input type="hidden" name="tab" value="3">
						<input type="hidden" name="bukuInv" value="bukuInv">
						</form>
						</div>
						
						<div class="tab-pane" id="biskpdgab">
						<div class="breadcrumb">
							<div class="titleTab">Buku Inventaris Gabungan SKPD</div>
						</div>
						  <form name="form" method="POST" action="<?php echo "$url_rewrite/report/template/PEROLEHAN/skpdGabungan.php"; ?>">
						<ul>
							<li>
								<span class="span2">Tanggal Awal</span>
								<div class="control">
									<div class="input-prepend">
										<span class="add-on"><i class="fa fa-calendar"></i></span>
										<input type="text" class="span2 full" name="tglawalPerolehan_bisgab" id="tglawalPerolehan_bisgab" value="" />
									</div>
								</div>
							</li>
							<li>
								<span class="span2">Tanggal Akhir</span>
								<div class="control">
									<div class="input-prepend">
										<span class="add-on"><i class="fa fa-calendar"></i></span>
										<input type="text" class="span2 full" name="tglakhirPerolehan_bisgab" id="tglakhirPerolehan_bisgab" value="" required/>
									</div>
								</div>
							</li>
							<?php selectAllAset('kelompok_id3','235',true,false); ?>
							<li>&nbsp;</li>
							<!--<li>
								<span class="span2">Kelompok</span>
								<div class="input-append">
									<input type="text" name="lda_kelompok3" id="lda_kelompok3" class="span5" readonly="readonly" value="" placeholder="(Semua Kelompok)">
									<input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" class="btn" value="Pilih" onclick = "showSpoiler(this);"><font size="1" color="grey"><i>&nbsp;</i></font>
									<div class="inner" style="display:none;">
										
										<?php
											// $alamat_simpul_kelompok="$url_rewrite/function/dropdown/radio_simpul_kelompok.php";
											// $alamat_search_kelompok="$url_rewrite/function/dropdown/radio_search_kelompok.php";
											// js_radiokelompok($alamat_simpul_kelompok, $alamat_search_kelompok,"lda_kelompok3","kelompok_id3",'kelompok3','ldakelompokfilter3');
											// $style="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
											// radiokelompok($style,"kelompok_id3",'kelompok3','ldakelompokfilter3');
										?>
									</div>
								</div>
							</li>-->
							<li>
							<?php //selectAllSatker('kodeSatker3','255',true,false); 
					
									// selectAllSatker(kodeSatker15);
									selectAllSatker('kodeSatker15','255',true,false,false,true);
							?>
							<br>
							</li>
							<li>
								<span class="span2">Kode Pemilik</span>
								<select name = "pemilik" class="" id="sel1">
									<option value="12" selected>12 - Pemerintah Kota</option>
									<option value="11">11 - Pemerintah Provinsi</option>
									<option value="00">00 - Kementrian Lembaga</option>
							  </select>
							</li>
							<li>
								<span class="span2">Tanggal Cetak</span>
								<div class="control">
									<div class="input-prepend">
										<span class="add-on"><i class="fa fa-calendar"></i></span>
										<input type="text" class="span2 full" name="tglCetakBivgab" id="tglCetakBivgab" value=""
										required/>
									</div>
								</div>
							</li>
							<li>
								<span class="span2">&nbsp;</span>
								 <input type="submit" onClick="sendit_5()" class="btn btn-primary" name="bi_skpd" value="Lanjut" />
								<input type="reset"name="reset" onClick="sendit_6()" value="Bersihkan Filter" />
							</li>
						</ul>
						<input type="hidden" name="menuID" value="14">
						<input type="hidden" name="mode" value="1">
						<input type="hidden" name="tab" value="6">
						<input type="hidden" name="bukuInvGab" value="bukuInvGab">
						</form>
						</div>
						
						<!--<div class="tab-pane" id="rbiskpd">
						<div class="breadcrumb">
							<div class="titleTab">Rekapitulasi Buku Inventaris SKPD</div>
						</div>
						 <form name="form" method="POST" action="<?php echo "$url_rewrite/report/template/PEROLEHAN/rekapskpd.php"; ?>">
			    
						<ul>
							<!--<li>
								<span class="span2">Tahun</span>
								<input name="tahun_rekap_buku_inventaris_skpd" id="tahun_rekap_buku_inventaris_skpd" maxlength="4" type="text" value="<?php echo date('Y')?>" required>
							</li>
							<li>
								<span class="span2">Tanggal Awal</span>
								<div class="control">
									<div class="input-prepend">
										<span class="add-on"><i class="fa fa-calendar"></i></span>
										<input type="text" class="span2 full" name="tglPerolehan_awal_rekapbis" id="tglPerolehan_awal_rekapbis" value="" />
									</div>
								</div>
							</li>
							<li>
								<span class="span2">Tanggal Akhir</span>
								<div class="control">
									<div class="input-prepend">
										<span class="add-on"><i class="fa fa-calendar"></i></span>
										<input type="text" class="span2 full" name="tglPerolehan_akhir_rekapbis" id="tglPerolehan_akhir_rekapbis" value="" required/>
									</div>
								</div>
							</li>-->
							<?php //selectAllSatker('kodeSatker4','255',true,false);
						
									//selectAllSatker('kodeSatker4','255',true,false,false,true);
							?>
							<!--<br>
							<li>
								<span class="span2">Tanggal Cetak</span>
								<div class="control">
									<div class="input-prepend">
										<span class="add-on"><i class="fa fa-calendar"></i></span>
										<input type="text" class="span2 full" name="tglCetakRekapBiv" id="tglCetakRekapBiv" value="" required/>
									</div>
								</div>
							</li>
							<li>
								<span class="span2">Nama Skpd</span>
								<div class="input-append">
										 <input type="hidden" name="idgetkelompok" id="idgetkelompok" value="">
										<input type="text" name="lda_skpd4" id="lda_skpd4" class="span5" readonly="readonly"value="<?php echo $_SESSION['ses_satkername'] ; ?>">
										<input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok"class="btn" value="Pilih"onclick = "showSpoiler(this);">
										<div class="inner" style="display:none;">
										<div style="width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;">
								   
											<?php
											/*$alamat_simpul_skpd="$url_rewrite/function/dropdown/radio_simpul_skpd.php";
											$alamat_search_skpd="$url_rewrite/function/dropdown/radio_search_skpd.php";
											js_radioskpd($alamat_simpul_skpd, $alamat_search_skpd,"lda_skpd4","skpd_id4",'skpd_d', 'skpd4');
											$style="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
											radioskpd($style,"skpd_id4",'skpd_d', 'skpd4');*/
											?>  
											
										</div>
										</div>
								</div>
							</li>-->
							<!--<li>
								<span class="span2">Tanggal Cetak Report</span>
								<input type="text"  input id="tanggal4"  name="cdi_rekskpd_tglreport" value="" >(format tanggal : dd/mm/yyyy)
							</li>
							
							<li>
								<span class="span2">&nbsp;</span>
								 <input type="submit" onClick="sendit_5()" class="btn btn-primary" name="rbi_skpd"value="Lanjut" />
								<input type="reset"name="reset" onClick="sendit_6()" class="btn" value="Bersihkan Filter" />
							</li>
						</ul>
						 <input type="hidden" name="menuID" value="14">
						<input type="hidden" name="mode" value="1">
						<input type="hidden" name="tab" value="4">
						</form>
						</div>-->
						
						<div class="tab-pane" id="biid">
						<div class="breadcrumb">
							<div class="titleTab">Buku Induk Inventaris Daerah</div>
						</div>
						<form name="form" method="POST" action="<?php echo "$url_rewrite/report/template/PEROLEHAN/induk.php"; ?>">
							<ul>
							<li>
								<span class="span2">Tanggal Awal</span>
								<div class="control">
									<div class="input-prepend">
										<span class="add-on"><i class="fa fa-calendar"></i></span>
										<input type="text" class="span2 full" name="tglPerolehan_Awal_biid" id="tglPerolehan_Awal_biid" value="" />
									</div>
								</div>
							</li>
							<li>
								<span class="span2">Tanggal Akhir</span>
								<div class="control">
									<div class="input-prepend">
										<span class="add-on"><i class="fa fa-calendar"></i></span>
										<input type="text" class="span2 full" name="tglPerolehan_Akhir_biid" id="tglPerolehan_Akhir_biid" value="" required/>
									</div>
								</div>
							</li>
							<li>
								<span class="span2">Kelompok</span>
								<div class="input-append">
										<input type="text" name="lda_kelompok2" id="lda_kelompok2" class="span5" readonly="readonly" value="" placeholder="(Semua Kelompok)">
										<input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" class="btn" value="Pilih" onclick = "showSpoiler(this);"><font size="1" color="grey"><i>&nbsp;</i></font>
										<div class="inner" style="display:none;">
										
											<?php
												$alamat_simpul_kelompok="$url_rewrite/function/dropdown/radio_simpul_kelompok.php";
												$alamat_search_kelompok="$url_rewrite/function/dropdown/radio_search_kelompok.php";
												js_radiokelompok($alamat_simpul_kelompok, $alamat_search_kelompok,"lda_kelompok2","kelompok_id2",'kelompok2','ldakelompokfilter2');
												$style="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
												radiokelompok($style,"kelompok_id2",'kelompok2','ldakelompokfilter2');
											?>
										</div>
								</div>
							</li>
							<li>
								<span class="span2">Tanggal Cetak</span>
								<div class="control">
									<div class="input-prepend">
										<span class="add-on"><i class="fa fa-calendar"></i></span>
										<input type="text" class="span2 full" name="tglCetakBivIndk" id="tglCetakBivIndk" value="" required>
									</div>
								</div>
							</li>
							<!--<li>
								<span class="span2">Tanggal Cetak Report</span>
								<input type="text"  input id="tanggal6" name="cdi_biid_tglreport" value="">(format tanggal dd/mm/yy)
							</li>-->
							
							<li>
								<span class="span2">&nbsp;</span>
								 <input type="submit" name="bi_inventaris_daerah"onClick="sendit_5()" class="btn btn-primary" value="Lanjut" />
								<input type="reset" name="reset" class="btn" value="Bersihkan Data">
							</li>
						</ul>
						 <input type="hidden" name="menuID" value="14">
						<input type="hidden" name="mode" value="1">
						<input type="hidden" name="tab" value="5">
						<input type="hidden" name="bukuIndk" value="bukuIndk">
						</form>
						</div>
						
						<div class="tab-pane" id="rbiid">
						<div class="breadcrumb">
							<div class="titleTab">Rekapitulasi Buku Induk Inventaris Daerah</div>
						</div>
						 <form name="form" method="POST" action="<?php echo "$url_rewrite/report/template/PEROLEHAN/rekapinduk.php"; ?>">
						<ul>
							<li>
								<span class="span2">Tanggal Awal</span>
								<div class="control">
									<div class="input-prepend">
										<span class="add-on"><i class="fa fa-calendar"></i></span>
										<input type="text" class="span2 full" name="tglPerolehan_awal_induk" id="tglPerolehan_awal_induk" value="" />
									</div>
								</div>
							</li>
							<li>
								<span class="span2">Tanggal Akhir</span>
								<div class="control">
									<div class="input-prepend">
										<span class="add-on"><i class="fa fa-calendar"></i></span>
										<input type="text" class="span2 full" name="tglPerolehan_akhir_induk" id="tglPerolehan_akhir_induk" value="" required/>
									</div>
								</div>
							</li>
							<li>
								<span class="span2">Tanggal Cetak</span>
								<div class="control">
									<div class="input-prepend">
										<span class="add-on"><i class="fa fa-calendar"></i></span>
										<input type="text" class="span2 full" name="tglCetakRekapBivIndk" id="tglCetakRekapBivIndk" value="" required/>
									</div>
								</div>
							</li>
							<li>
								<span class="span2">&nbsp;</span>
								 <input type="submit" name="rekap_bi_inventaris_daerah" class="btn btn-primary" onClick="sendit_5()" name="biid"value="Lanjut" />
								<input type="reset" name="reset" class="btn" value="Bersihkan Data">
							</li>
						</ul>
						<input type="hidden" name="menuID" value="14">
						<input type="hidden" name="mode" value="1">
						<input type="hidden" name="tab" value="6">
						</form>
						</div>
						
						<div class="tab-pane" id="label">
						<div class="breadcrumb">
							<div class="titleTab">Label Kode Barang</div>
						</div>
						  <form name="form" method="POST" action="<?php echo "$url_rewrite/report/template/PEROLEHAN/report_perolehanaset_cetak_label.php"; ?>">
						<ul>
							<!--<li>
								<span class="span2">Tahun</span>
								<input name="tahun_label" id="tahun_label" maxlength='4' type="text" value="<?php //echo date('Y')?>" required>
							</li>-->
							<li>
								<span class="span2">Tanggal Awal</span>
								<div class="control">
									<div class="input-prepend">
										<span class="add-on"><i class="fa fa-calendar"></i></span>
										<input type="text" class="span2 full" name="tglawalLabel" id="tglawalLabel" value="" />
									</div>
								</div>
							</li>
							<li>
								<span class="span2">Tanggal Akhir</span>
								<div class="control">
									<div class="input-prepend">
										<span class="add-on"><i class="fa fa-calendar"></i></span>
								<input type="text" class="span2 full" name="tglakhirlLabel" id="tglakhirlLabel" value="" required/>
									</div>
								</div>
							</li>
							<li>
								<span class="span2">Kelompok</span>
								<select name = "gol" class="" id="sel1">
									<option value="01" selected>A Tanah</option>
									<option value="02">B Peralatan mesin</option>
									<option value="03">C Gedung dan Bangunan</option>
									<option value="04">D Jalan, Irigasi dan Bangunan</option>
									<option value="05">E Aset Tetap Lainnya</option>
									<option value="06">F Konstruksi dan Pengerjaan</option>
							  </select>
							</li>
							<?php 
								selectAllSatker('kodeSatker8','255',true,false,false,true);
							?>
							<br>
							<li>
								<span class="span2">Tahun Ruangan</span>
								<input name="tahun_label" id="tahun_label" maxlength='4' width="10px" type="text" value="<?php //echo date('Y')?>" onblur="return newruangan2();">
							</li>
								<?=selectRuangKir('kodeRuangan2','kodeSatker8','255',true,false,false,'tahun_label');?>
							<br>
							<li>
								<span class="span2">&nbsp;</span>
								 <input type="submit" onClick="sendit_5()" class="btn btn-primary" name="bi_skpd" value="Lanjut" />
								<input type="reset"name="reset" onClick="sendit_6()" value="Bersihkan Filter" />
							</li>
						</ul>
						<input type="hidden" name="menuID" value="14">
						<input type="hidden" name="mode" value="1">
						<input type="hidden" name="tab" value="10">
						<input type="hidden" name="label" value="label">
						<input type="hidden" id="tahun_label" value="">
						</form>
						</div>
						
						<div class="tab-pane" id="kb">
						<div class="breadcrumb">
							<div class="titleTab">Kartu Barang</div>
						</div>
						 <form name="form" method="POST" action="<?php echo "$url_rewrite/report/template/PEROLEHAN/kb.php"; ?>">
						<ul>
							<li>
								<input type="radio" name="kb" value="KB-A" class="inven1" checked>&nbsp; KB-A
								<input type="radio" name="kb" value="KB-B" class="inven2" >&nbsp; KB-B
								<input type="radio" name="kb" value="KB-C" class="inven3" > &nbsp; KB-C
								<input type="radio" name="kb" value="KB-D" class="inven4" > &nbsp;KB-D
								<input type="radio" name="kb" value="KB-E" class="inven5" > &nbsp;KB-E
								<input type="radio"name="kb" value="KB-F" class="inven6" > &nbsp;KB-F
								<!--<input type="button" name="kib" class="btn btn-info" value="Cetak KIB Kosong">-->
								<br/>
							</li>
							<li>&nbsp;
							</li>
							<li>
								<!--<span class="span2">Tanggal Perolehan</span>
								<div class="control">
									<div class="input-prepend">
										<span class="add-on"><i class="fa fa-calendar"></i></span>
										<input type="text" class="span2 full" name="tglPerolehan_awal_kb" id="tglPerolehan_awal_kb" value="" required/>
									</div>
								</div>-->
								<span class="span2">Tahun</span>
								<input type="text" class="span2 full" name="tahun_kb" id="tahun_kb" value="" required/>
							</li>
							<li>
								<span class="span2">Tanggal Perubahan</span>
								<div class="control">
									<div class="input-prepend">
										<span class="add-on"><i class="fa fa-calendar"></i></span>
										<input type="text" class="span2 full" name="tglPerolehan_akhir_kb" id="tglPerolehan_akhir_kb" value="" required/>
									</div>
								</div>
							</li>
							<!--<li>
								<span class="span2">Kelompok</span>
								<div class="input-append">
										<input type="text" name="lda_kelompok4" id="lda_kelompok4" class="span5" readonly="readonly" value="" placeholder="(Semua Kelompok)">
										<input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" class="btn" value="Pilih" onclick = "showSpoiler(this);"><font size="1" color="grey"><i>&nbsp;</i></font>
										<div class="inner" style="display:none;">
										
											<?php
												/*$alamat_simpul_kelompok="$url_rewrite/function/dropdown/radio_simpul_kelompok.php";
												$alamat_search_kelompok="$url_rewrite/function/dropdown/radio_search_kelompok.php";
												js_radiokelompok($alamat_simpul_kelompok, $alamat_search_kelompok,"lda_kelompok4","kelompok_id4",'kelompok4','ldakelompokfilter4');
												$style="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
												radiokelompok($style,"kelompok_id4",'kelompok4','ldakelompokfilter4');*/
											?>
										</div>
								</div>
							</li>-->
							<?php selectAset('kelompok_id4','235',true,false); ?>
							<li>&nbsp;</li>
							<?php selectAllSatker('kodeSatker10','255',true,false,false,true); ?>
							<br />
							<li>
								<span class="span2">Kode Registrasi</span>
								<input type="number" name="noRegisterAwal" class="span1" value="1"/> . 
								<input type="number" name="noRegisterAkhir" class="span1" value="1"/>
							</li>
							<li>
								<span class="span2">&nbsp;</span>
								<input type="submit" name="lanjut" class="btn btn-primary" value="Lanjut" />
								<input type="reset" name="reset" class="btn" value="Bersihkan Filter" />
							</li>
						</ul>
						<input type="hidden" name="menuID" value="14">
						<input type="hidden" name="mode" value="1">
						<input type="hidden" name="tab" value="4">
						</form>
						</div>
						
						<div class="tab-pane" id="lpri">
						<div class="breadcrumb">
							<div class="titleTab">Laporan Inventaris</div>
						</div>
						  <form name="form" method="POST" action="<?php echo "$url_rewrite/report/template/PEROLEHAN/report_perolehanaset_cetak_laporan_inventaris.php"; ?>">
						<ul>
							<li>
								<span class="span2">Tanggal Perolehan</span>
								<div class="control">
									<div class="input-prepend">
										<span class="add-on"><i class="fa fa-calendar"></i></span>
										<input type="text" class="span2 full" name="tglawalPerolehan_li" id="tglawalPerolehan_li" value="" />
									</div>
								</div>
							</li>
							<li>
								<span class="span2">Tanggal Pembukuan</span>
								<div class="control">
									<div class="input-prepend">
										<span class="add-on"><i class="fa fa-calendar"></i></span>
										<input type="text" class="span2 full" name="tglpembukuan_li" id="tglpembukuan_li" value=""/>
									</div>
								</div>
							</li>
							<li>
								<?php selectAset('kodeKelompok','255',true,false,''); ?>
							</li>
							<br>
							<li>
							<?php 
								selectAllSatker('kodeSatker17','255',true,false,false,true);
							?>
							<br>
							</li>
							
							<li>
								<span class="span2">&nbsp;</span>
								 <input type="submit" class="btn btn-primary" name="bi_skpd" value="Lanjut" />
								<input type="reset"name="reset" onClick="sendit_6()" value="Bersihkan Filter" />
							</li>
						</ul>
						</form>
						</div>
						
						
					  </div>
			</div> 
			
			
		</section>     
	</section>
	
<?php
	include"$path/footer.php";
?>