<?php
include "../../config/config.php";

$USERAUTH = new UserAuth();
$SESSION = new Session();
$menu_id = 54;
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
				<div class="title">Cetak Dokumen Penyusutan</div>
				<div class="subtitle">Cetak Dokumen</div>
			</div>	
		<section class="formLegend">
			
			<div class="tabbable" style="margin-bottom: 18px;">
					  <ul class="nav nav-tabs">
						<li class="active"><a href="#kib" data-toggle="tab">KIB</a></li>
						<li><a href="#rbiskpd" data-toggle="tab">Rekapitulasi Buku Inventaris SKPD</a></li>
						</ul>
					  <div class="tab-content" style="padding-bottom: 9px; border-bottom: 1px solid #ddd;">
						
						<div class="tab-pane active" id="kib">
						<div class="breadcrumb">
							<div class="titleTab">Kartu Inventaris Barang</div>
						</div>
						 <form name="form" method="POST" action="<?php echo "$url_rewrite/report/template/PENYUSUTAN/kib.php"; ?>">
						 <script>
							
						// function show_kelompok(kib){
						// url='<?php echo $url_rewrite?>'+'/module/perolehan/api_kib.php?kib='+kib;
						// ambilData(url,'isi_kib');
						// }
						
						$(document).ready(function() {
							$('#tahun_kib,#tahun_kir,#tahun_buku_inventaris_skpd,#tahun_buku_induk_inventaris,#tahun_rekap_buku_inventaris_skpd,#ThnbukuIntra,#ThnbukuEkstra').keydown(function (e) {
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
							});
						
							
						
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
								<span class="span2">Tahun</span>
								<input name="tahun" id ="tahun_kib" type="text" maxlength='4' value="<?php echo date('Y')?>" required>
							</li>
							<?php selectSatker('kodeSatker','255',true,false); ?>
							<br />
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
						
						<div class="tab-pane" id="rbiskpd">
						<div class="breadcrumb">
							<div class="titleTab">Rekapitulasi Buku Inventaris SKPD</div>
						</div>
						 <form name="form" method="POST" action="<?php echo "$url_rewrite/report/template/PEROLEHAN/report_perolehanaset_cetak_rekapitulasibukuinventarisSKPD.php"; ?>">
			    
			<ul>
							<li>
								<span class="span2">Tahun</span>
								<input name="tahun_rekap_buku_inventaris_skpd" id="tahun_rekap_buku_inventaris_skpd" maxlength="4" type="text" value="<?php echo date('Y')?>" required>
							</li>
							<?php selectSatker('kodeSatker4','255',true,false); ?>
							<br>
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
				
					  </div>
			</div> 
			
			
		</section>     
	</section>
	
<?php
	include"$path/footer.php";
?>