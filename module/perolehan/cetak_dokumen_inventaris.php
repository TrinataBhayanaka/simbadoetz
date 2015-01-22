<?php
include "../../config/config.php";

$USERAUTH = new UserAuth();
$SESSION = new Session();
$menu_id = 5;
$SessionUser = $SESSION->get_session_user();
$USERAUTH->FrontEnd_check_akses_menu($menu_id,$SessionUser);
?>

<?php
	include"$path/meta.php";
	include"$path/header.php";
	include"$path/menu.php";
	
?>
	
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
						<li><a href="#kir" data-toggle="tab">KIR</a></li>
						<li><a href="#biskpd" data-toggle="tab">Buku Inventaris SKPD</a></li>
						<li><a href="#rbiskpd" data-toggle="tab">Rekapitulasi Buku Inventaris SKPD</a></li>
						<li><a href="#biid" data-toggle="tab">Buku Induk Inventaris Daerah</a></li>
						<li><a href="#rbiid" data-toggle="tab">Rekapitulasi Buku Induk Inventaris Daerah</a></li>
						<li><a href="#label" data-toggle="tab">Label Kode Barang</a></li>
						<li><a href="#kb" data-toggle="tab">Kartu Barang</a></li>
						</ul>
					  <div class="tab-content" style="padding-bottom: 9px; border-bottom: 1px solid #ddd;">
						
						<div class="tab-pane active" id="kib">
						<div class="breadcrumb">
							<div class="titleTab">Kartu Inventaris Barang</div>
						</div>
						 <form name="form" method="POST" action="<?php echo "$url_rewrite/report/template/PEROLEHAN/kib.php"; ?>">
						 <script>
						$(document).ready(function() {
							$( "#tglPerolehan_1,#tglPerolehan_2,#tglPerolehan_awal_kir,#tglPerolehan_akhir_kir,#tglawalPerolehan_bis,#tglakhirPerolehan_bis,#tglPerolehan_Awal_biid,#tglPerolehan_Akhir_biid,#tglPerolehan_awal_intra,#tglPerolehan_akhir_intra,#tglPerolehan_awal_ekstra,#tglPerolehan_akhir_ekstra,#tglPerolehan_awal_rekapbis,#tglPerolehan_akhir_rekapbis,#tglPerolehan_awal_induk,#tglPerolehan_akhir_induk,#tglCetakKib,#tglCetakRekapKib,#tglCetakKir,#tglCetakBiv,#tglCetakRekapBiv,#tglCetakBivIndk,#tglCetakRekapBivIndk,#tglPerolehan_awal_kb,#tglPerolehan_akhir_kb,#tglCetakKb").mask('9999-99-99');
							$( "#tahun_label").mask('9999');
							$( "#tglPerolehan_1,#tglPerolehan_2,#tglPerolehan_awal_kir,#tglPerolehan_akhir_kir,#tglawalPerolehan_bis,#tglakhirPerolehan_bis,#tglPerolehan_Awal_biid,#tglPerolehan_Akhir_biid,#tglPerolehan_awal_intra,#tglPerolehan_akhir_intra,#tglPerolehan_awal_ekstra,#tglPerolehan_akhir_ekstra,#tglPerolehan_awal_rekapbis,#tglPerolehan_akhir_rekapbis,#tglPerolehan_awal_induk,#tglPerolehan_akhir_induk,#tglCetakKib,#tglCetakRekapKib,#tglCetakKir,#tglCetakBiv,#tglCetakRekapBiv,#tglCetakBivIndk,#tglCetakRekapBivIndk,#tglPerolehan_awal_kb,#tglPerolehan_akhir_kb,#tglCetakKb" ).datepicker({ dateFormat: 'yy-mm-dd' });
							/*$('#tahun_label').keydown(function (e) {
								// Allow: backspace, delete, tab, escape, enter and .
								if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
									 // Allow: Ctrl+A
									(e.keyCode == 65 && e.ctrlKey === true) || 
									 // Allow: home, end, left, right
									(e.keyCode >= 35 && e.keyCode <= 39)) {
										 // let it happen, don't do anything
										 return;
								}
								// Ensure that it is a number and stop the keypress
								if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
									e.preventDefault();
								}
							});*/
						
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
								if($_SESSION[ses_uoperatorid] == '1'){
										selectAllSatker('kodeSatker','255',true,false); 
									}else{
										selectSatker('kodeSatker','255',true,false); 
									}
							?>
							<br />
							<li>
								<span class="span2">Tanggal Cetak</span>
								<div class="control">
									<div class="input-prepend">
										<span class="add-on"><i class="fa fa-calendar"></i></span>
										<input type="text" class="span2 full" name="tglCetakKib" id="tglCetakKib" value=""/>
									</div>
								</div>
							</li>
							<!--<li>
								<span class="span2">Nama Skpd </span>
								<div class="input-append">
										<input type="hidden" name="idgetkelompok" id="idgetkelompok" value="">
										<input type="text" name="lda_skpd" id="lda_skpd" class="span5" readonly="readonly" value="<?php echo $_SESSION['ses_satkername'] ; ?>">
										<input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" class="btn" value="Pilih" onclick = "showSpoiler(this);">
										<div class="inner" style="display:none;">
					
										<div style="width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;">
								   
											<?php
											 /*$alamat_simpul_skpd="$url_rewrite/function/dropdown/radio_simpul_skpd.php";
											 $alamat_search_skpd="$url_rewrite/function/dropdown/radio_search_skpd.php";
											 js_radioskpd($alamat_simpul_skpd, $alamat_search_skpd,"lda_skpd","skpd_id",'skpd', 'skpd1');
											 $style="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
											 radioskpd($style,"skpd_id",'skpd', 'skpd1');*/
											 ?>  
											
										</div>
										</div>
								</div>
							</li>
							<li>
								<span class="span2">Tanggal Cetak Report</span>
								<input type="text" input id="tanggal1"  name="cdi_kib_tglreport" value="" >
								(format tanggal : dd/mm/yyyy)
							</li>-->
							
							
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
							<!--<li>
								<span class="span2">Tahun</span>
								<input name="tahun" id ="tahun_rekap_kib" type="text" maxlength='4' value="<?php echo date('Y')?>" required>
							</li>-->
							<?php //selectAllSatker('kodeSatker7','255',true,false); 
								if($_SESSION[ses_uoperatorid] == '1'){
										selectAllSatker('kodeSatker7','255',true,false); 
									}else{
										selectSatker('kodeSatker7','255',true,false); 
									}
							
							?>
							<br />
							<li>
								<span class="span2">Tanggal Cetak</span>
								<div class="control">
									<div class="input-prepend">
										<span class="add-on"><i class="fa fa-calendar"></i></span>
										<input type="text" class="span2 full" name="tglCetakRekapKib" id="tglCetakRekapKib" value=""/>
									</div>
								</div>
							</li>
							<!--<li>
								<span class="span2">Nama Skpd </span>
								<div class="input-append">
										<input type="hidden" name="idgetkelompok" id="idgetkelompok" value="">
										<input type="text" name="lda_skpd" id="lda_skpd" class="span5" readonly="readonly" value="<?php echo $_SESSION['ses_satkername'] ; ?>">
										<input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" class="btn" value="Pilih" onclick = "showSpoiler(this);">
										<div class="inner" style="display:none;">
					
										<div style="width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;">
								   
											<?php
											 /*$alamat_simpul_skpd="$url_rewrite/function/dropdown/radio_simpul_skpd.php";
											 $alamat_search_skpd="$url_rewrite/function/dropdown/radio_search_skpd.php";
											 js_radioskpd($alamat_simpul_skpd, $alamat_search_skpd,"lda_skpd","skpd_id",'skpd', 'skpd1');
											 $style="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
											 radioskpd($style,"skpd_id",'skpd', 'skpd1');*/
											 ?>  
											
										</div>
										</div>
								</div>
							</li>
							<li>
								<span class="span2">Tanggal Cetak Report</span>
								<input type="text" input id="tanggal1"  name="cdi_kib_tglreport" value="" >
								(format tanggal : dd/mm/yyyy)
							</li>-->
							
							
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
								if($_SESSION[ses_uoperatorid] == '1'){
										selectAllSatker('kodeSatker2','255',true,false); 
									}else{
										selectSatker('kodeSatker2','255',true,false); 
									}
							
							?>
							<br>
							<li>
								<span class="span2">Tanggal Cetak</span>
								<div class="control">
									<div class="input-prepend">
										<span class="add-on"><i class="fa fa-calendar"></i></span>
										<input type="text" class="span2 full" name="tglCetakKir" id="tglCetakKir" value=""/>
									</div>
								</div>
							</li>
							<!--<li>
								<span class="span2">Nama Skpd </span>
								<div class="input-append">
										   <input type="hidden" name="idgetkelompok" id="idgetkelompok" value="">
											<input type="text" name="lda_skpd2" id="lda_skpd2" class="span5"creadonly="readonly"value="<?php echo $_SESSION['ses_satkername'] ; ?>">
											<input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" class="btn" value="Pilih"onclick = "showSpoiler(this);">
											<div class="inner" style="display:none;">
											
											<div style="width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;">
									   
												<?php
												/*$alamat_simpul_skpd="$url_rewrite/function/dropdown/radio_simpul_skpd.php";
												$alamat_search_skpd="$url_rewrite/function/dropdown/radio_search_skpd.php";
												js_radioskpd($alamat_simpul_skpd, $alamat_search_skpd,"lda_skpd2","skpd_id2",'skpd_b', 'skpd2');
												$style="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
												radioskpd($style,"skpd_id2",'skpd_b', 'skpd2');*/
												?>  
												
											</div>
											</div>
								</div>
							</li>-->
							<!--<li>
								<span class="span2">Tanggal Cetak Report</span>
								<input type="text" input id="tanggal2" name="cdi_kir_tglreport" value="" >(format tanggal : dd/mm/yyyy)
							</li>-->
						
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
								if($_SESSION[ses_uoperatorid] == '1'){
										selectAllSatker('kodeSatker3','255',true,false); 
									}else{
										selectSatker('kodeSatker3','255',true,false); 
									}
							
							?>
							<br>
							<li>
								<span class="span2">Tanggal Cetak</span>
								<div class="control">
									<div class="input-prepend">
										<span class="add-on"><i class="fa fa-calendar"></i></span>
										<input type="text" class="span2 full" name="tglCetakBiv" id="tglCetakBiv" value=""/>
									</div>
								</div>
							</li>
							<!--<li>
								<span class="span2">Nama Skpd </span>
								<div class="input-append">
									 <input type="hidden" name="idgetkelompok" id="idgetkelompok" value="">
										<input type="text" name="lda_skpd3" id="lda_skpd3" class="span5" readonly="readonly"value="" placeholder="<?php echo $_SESSION['ses_satkername'] ; ?>">
										<input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" class="btn" value="Pilih"onclick = "showSpoiler(this);">
										<div class="inner" style="display:none;">
										<div style="width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;">
								   
											<?php
											/*$alamat_simpul_skpd="$url_rewrite/function/dropdown/radio_simpul_skpd.php";
											$alamat_search_skpd="$url_rewrite/function/dropdown/radio_search_skpd.php";
											js_radioskpd($alamat_simpul_skpd, $alamat_search_skpd,"lda_skpd3","skpd_id3",'skpd_c', 'skpd3');
											$style="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
											radioskpd($style,"skpd_id3",'skpd_c', 'skpd3');*/
											?>  
											
										</div>
										</div>
								</div>
							</li>-->
							<!--<li>
								<span class="span2">Tanggal Cetak Report</span>
								<input type="text"  input id="tanggal3" name="cdi_bukuskpd_tglreport" value="" >(format tanggal : dd/mm/yyyy)
							</li>-->
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
						
						<div class="tab-pane" id="rbiskpd">
						<div class="breadcrumb">
							<div class="titleTab">Rekapitulasi Buku Inventaris SKPD</div>
						</div>
						 <form name="form" method="POST" action="<?php echo "$url_rewrite/report/template/PEROLEHAN/rekapskpd.php"; ?>">
			    
			<ul>
							<!--<li>
								<span class="span2">Tahun</span>
								<input name="tahun_rekap_buku_inventaris_skpd" id="tahun_rekap_buku_inventaris_skpd" maxlength="4" type="text" value="<?php echo date('Y')?>" required>
							</li>-->
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
							</li>
							<?php //selectAllSatker('kodeSatker4','255',true,false);
								if($_SESSION[ses_uoperatorid] == '1'){
										selectAllSatker('kodeSatker4','255',true,false); 
									}else{
										selectSatker('kodeSatker4','255',true,false); 
									}
							?>
							<br>
							<li>
								<span class="span2">Tanggal Cetak</span>
								<div class="control">
									<div class="input-prepend">
										<span class="add-on"><i class="fa fa-calendar"></i></span>
										<input type="text" class="span2 full" name="tglCetakRekapBiv" id="tglCetakRekapBiv" value=""/>
									</div>
								</div>
							</li>
							<!--<li>
								<span class="span2">Nama Skpd</span>
								<div class="input-append">
										 <input type="hidden" name="idgetkelompok" id="idgetkelompok" value="">
										<input type="text" name="lda_skpd4" id="lda_skpd4" class="span5" readonly="readonly"value="<?php echo $_SESSION['ses_satkername'] ; ?>">
										<input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok"class="btn" value="Pilih"onclick = "showSpoiler(this);">
										<div class="inner" style="display:none;">
										<div style="width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;">
								   
											<?php
											$alamat_simpul_skpd="$url_rewrite/function/dropdown/radio_simpul_skpd.php";
											$alamat_search_skpd="$url_rewrite/function/dropdown/radio_search_skpd.php";
											js_radioskpd($alamat_simpul_skpd, $alamat_search_skpd,"lda_skpd4","skpd_id4",'skpd_d', 'skpd4');
											$style="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
											radioskpd($style,"skpd_id4",'skpd_d', 'skpd4');
											?>  
											
										</div>
										</div>
								</div>
							</li>-->
							<!--<li>
								<span class="span2">Tanggal Cetak Report</span>
								<input type="text"  input id="tanggal4"  name="cdi_rekskpd_tglreport" value="" >(format tanggal : dd/mm/yyyy)
							</li>-->
							
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
						</div>
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
										<input type="text" class="span2 full" name="tglCetakBivIndk" id="tglCetakBivIndk" value=""/>
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
										<input type="text" class="span2 full" name="tglCetakRekapBivIndk" id="tglCetakRekapBivIndk" value=""/>
									</div>
								</div>
							</li>
							<!--<li>
								<span class="span2">Tanggal Cetak Report</span>
								<input  input id="tanggal5"  name="cdi_rbiid_tglreport" value="">(format tanggal dd/mm/yy)
							</li>-->
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
							<li>
								<span class="span2">Tahun</span>
								<input name="tahun_label" id="tahun_label" maxlength='4' type="text" value="<?php echo date('Y')?>" required>
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
							<?php //selectAllSatker('kodeSatker8','255',true,false); 
								if($_SESSION[ses_uoperatorid] == '1'){
										selectAllSatker('kodeSatker8','255',true,false); 
									}else{
										selectSatker('kodeSatker8','255',true,false); 
									}
							?>
							<br>
							<!--<li>
								<span class="span2">Nama Skpd </span>
								<div class="input-append">
									 <input type="hidden" name="idgetkelompok" id="idgetkelompok" value="">
										<input type="text" name="lda_skpd3" id="lda_skpd3" class="span5" readonly="readonly"value="" placeholder="<?php echo $_SESSION['ses_satkername'] ; ?>">
										<input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" class="btn" value="Pilih"onclick = "showSpoiler(this);">
										<div class="inner" style="display:none;">
										<div style="width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;">
								   
											<?php
											/*$alamat_simpul_skpd="$url_rewrite/function/dropdown/radio_simpul_skpd.php";
											$alamat_search_skpd="$url_rewrite/function/dropdown/radio_search_skpd.php";
											js_radioskpd($alamat_simpul_skpd, $alamat_search_skpd,"lda_skpd3","skpd_id3",'skpd_c', 'skpd3');
											$style="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
											radioskpd($style,"skpd_id3",'skpd_c', 'skpd3');*/
											?>  
											
										</div>
										</div>
								</div>
							</li>-->
							<!--<li>
								<span class="span2">Tanggal Cetak Report</span>
								<input type="text"  input id="tanggal3" name="cdi_bukuskpd_tglreport" value="" >(format tanggal : dd/mm/yyyy)
							</li>-->
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
								<span class="span2">Tanggal Awal</span>
								<div class="control">
									<div class="input-prepend">
										<span class="add-on"><i class="fa fa-calendar"></i></span>
										<input type="text" class="span2 full" name="tglPerolehan_awal_kb" id="tglPerolehan_awal_kb" value="" />
									</div>
								</div>
							</li>
							<li>
								<span class="span2">Tanggal Akhir</span>
								<div class="control">
									<div class="input-prepend">
										<span class="add-on"><i class="fa fa-calendar"></i></span>
										<input type="text" class="span2 full" name="tglPerolehan_akhir_kb" id="tglPerolehan_akhir_kb" value="" required/>
									</div>
								</div>
							</li>
							<li>
								<span class="span2">Kelompok</span>
								<div class="input-append">
										<input type="text" name="lda_kelompok3" id="lda_kelompok3" class="span5" readonly="readonly" value="" placeholder="(Semua Kelompok)">
										<input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" class="btn" value="Pilih" onclick = "showSpoiler(this);"><font size="1" color="grey"><i>&nbsp;</i></font>
										<div class="inner" style="display:none;">
										
											<?php
												$alamat_simpul_kelompok="$url_rewrite/function/dropdown/radio_simpul_kelompok.php";
												$alamat_search_kelompok="$url_rewrite/function/dropdown/radio_search_kelompok.php";
												js_radiokelompok($alamat_simpul_kelompok, $alamat_search_kelompok,"lda_kelompok3","kelompok_id3",'kelompok3','ldakelompokfilter3');
												$style="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
												radiokelompok($style,"kelompok_id3",'kelompok3','ldakelompokfilter3');
											?>
										</div>
								</div>
							</li>
							<?php selectAllSatker('kodeSatker10','255',true,false); ?>
							<br />
							<li>
								<span class="span2">Tanggal Cetak</span>
								<div class="control">
									<div class="input-prepend">
										<span class="add-on"><i class="fa fa-calendar"></i></span>
										<input type="text" class="span2 full" name="tglCetakKb" id="tglCetakKb" value=""/>
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
						<input type="hidden" name="tab" value="4">
						</form>
						</div>
						
					  </div>
			</div> 
			
			
		</section>     
	</section>
	
<?php
	include"$path/footer.php";
?>