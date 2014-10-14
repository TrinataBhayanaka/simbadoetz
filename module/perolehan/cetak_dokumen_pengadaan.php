<?php
include "../../config/config.php";

$USERAUTH = new UserAuth();

$SESSION = new Session();

$menu_id = 13;
$SessionUser = $SESSION->get_session_user();
$USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);

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
			  <li class="active"> Cetak Dokumen Pengadaan</li>
			  <?php SignInOut();?>
			</ul>
			<div class="breadcrumb">
				<div class="title"> Cetak Dokumen Pengadaan</div>
				<div class="subtitle">Cetak Dokumen</div>
			</div>	
		<section class="formLegend">
			
			<div class="tabbable" style="margin-bottom: 18px;">
					  <ul class="nav nav-tabs">
						<li class="active"><a href="#pbmd" data-toggle="tab">Pengadaan BMD</a></li>
						<li><a href="#rpbmd" data-toggle="tab">Rekapitulasi Pengadaan BMD</a></li>
						<li><a href="#pmbmd" data-toggle="tab">Pemeliharaan BMD</a></li>
						<li><a href="#rpmbmd" data-toggle="tab">Rekapitulasi Pemeliharaan BMD</a></li>
						<li><a href="#bdp3" data-toggle="tab">Barang Dari Pihak III</a></li>
						<li><a href="#rbdp3" data-toggle="tab">Rekapitulasi Barang Pihak III</a></li>
					  </ul>
					  <div class="tab-content" style="padding-bottom: 9px; border-bottom: 1px solid #ddd;">
						<div class="tab-pane active" id="pbmd">
						<div class="breadcrumb">
							<div class="titleTab">Daftar Pengadaan BMD</div>
						</div>
						 <form method="post" name="form" action="<?php echo "$url_rewrite/report/template/PEROLEHAN/report_perolehanaset_cetak_daftarpengadaanBMD.php"; ?>">
			<ul>
							<li>
								<span class="span2">Periode</span>
								<input type="checkbox" name="check_peng" value="1">
								<input id="tanggal14" type="text" name="tglawal" value="01/01/<?php echo date ("Y");?>" style="text-align:center">&nbsp;sampai&nbsp;<input id="tanggal15"type="text" name="tglakhir" value="31/12/<?php echo date ("Y");?>" style="text-align:center">( format tanggal : dd/mm/yyyy )
							</li>
							<li>
								<span class="span2">SKPD</span>
								<div class="input-append">
										<input type="text" name="lda_skpd" id="lda_skpd" class="span5" readonly="readonly" placeholder="<?php echo $_SESSION['ses_satkername'] ; ?>">
									<input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" class="btn" value="Pilih" onclick = "showSpoiler(this);">
									<div class="inner" style="display:none;">
										
										<?php
										//include "$path/function/dropdown/function_skpd.php";

										$alamat_simpul_skpd="$url_rewrite/function/dropdown/radio_simpul_skpd.php";
										$alamat_search_skpd="$url_rewrite/function/dropdown/radio_search_skpd.php";
										js_radioskpd($alamat_simpul_skpd, $alamat_search_skpd,"lda_skpd","skpd_id8",'skpd8','sk8');
										$style2="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
										radioskpd($style2,"skpd_id8",'skpd8','sk8');

										?>
									</div>
								</div>
							</li>
							<li>
								<span class="span2">Tanggal Cetak Report</span>
								<input type="text" input id="tanggal8" name="cdp_cetak_bmdreport" value="" >(format tanggal : dd/mm/yyyy)
							</li>
							<li>
								<span class="span2">&nbsp;</span>
								<input type="submit" name="pengadaanbmd" class="btn btn-primary" value="Lanjut" />&nbsp;
								<input type="reset" name="reset" class="btn" value="Bersihkan Filter" />
							</li>
						</ul>
							<input type="hidden" name="menuID" value="13">
							<input type="hidden" name="mode" value="1">
							<input type="hidden" name="tab" value="1">
						</form>
						</div>
						<div class="tab-pane" id="rpbmd">
						<div class="breadcrumb">
							<div class="titleTab">Rekapitulasi Daftar Hasil Pengadaan BMD</div>
						</div>
						 <form name="form" method="POST" action="<?php echo "$url_rewrite/report/template/PEROLEHAN/report_perolehanaset_cetak_rekapitulasidaftarhasilpengadaanBMD.php"; ?>">
			<ul>
							<li>
								<span class="span2">Periode</span>
								<input type="checkbox" name="check_peng_bmd" value="1">
								<input type="text" id="tanggal12"  name="cdp_rekap_bmdperiode1" value="01/01/<?php echo date ("Y");?>" style="text-align:center">&nbsp;sampai&nbsp;<input id="tanggal13" type="text" name="cdp_rekap_bmdperiode2"value="31/12/<?php echo date ("Y");?>" style="text-align:center">( format tanggal : dd/mm/yyyy )
							</li>
							<li>
								<span class="span2">SKPD</span>
								<div class="input-append">
										<input type="text" name="kelompok2" id="idkelompok9" class="span5" readonly="readonly" placeholder="<?php echo $_SESSION['ses_satkername'] ; ?>">
										<input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" class="btn" value="Pilih" onclick = "showSpoiler(this);">
										<div class="inner" style="display:none;">
								
										<?php
										$alamat_simpul_skpd="$url_rewrite/function/dropdown/radio_simpul_skpd.php";
										$alamat_search_skpd="$url_rewrite/function/dropdown/radio_search_skpd.php";
										js_radioskpd($alamat_simpul_skpd, $alamat_search_skpd,"idkelompok9","skpd_id9",'skpd9','sk9');
										$style2="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
										radioskpd($style2,"skpd_id9",'skpd9','sk9');
										?>        
										</div>
								</div>									
							</li>
							<li>
								<span class="span2">Tanggal Cetak Report</span>
								<input type="text" input id="tanggal1" name="cdp_rekap_cetakreport" value="" >(format tanggal : dd/mm/yyyy)
							</li>
							<li>
								<span class="span2">&nbsp;</span>
								<input type="submit" value="Lanjut" class="btn btn-primary" name="rekappengadaanbmd"/> &nbsp;
								<input type="reset" name="reset" class="btn" value="Bersihkan Filter" />
							</li>
						</ul>
						
							<input type="hidden" name="menuID" value="13">
							<input type="hidden" name="mode" value="1">
							<input type="hidden" name="tab" value="2">
						</form>
						</div>
						<div class="tab-pane" id="pmbmd">
						<div class="breadcrumb">
							<div class="titleTab">Daftar Hasil Pemeliharaan BMD</div>
						</div>
						  <form name="form" method="POST" action="<?php echo "$url_rewrite/report/template/PEROLEHAN/report_perolehanaset_cetak_daftarhasilpemeliharaanBMD.php"; ?>">
			<ul>
							<li>
								<span class="span2">Periode</span>
								<input type="checkbox" name="check_pml" value="1">
								<input id="tanggal10" type="text" name="cdp_pembmd_periode1" value="01/01/<?php echo date ("Y");?>" style="text-align:center">&nbsp;sampai&nbsp;<input id="tanggal9"type="text" name="cdp_pembmd_periode2" value="31/12/<?php echo date ("Y");?>" style="text-align:center">( format tanggal : dd/mm/yyyy )
							</li>
							<li>
								<span class="span2">SKPD</span>
								<div class="input-append">
										<input type="text" name="kelompok2" id="idkelompok10" class="span5" readonly="readonly" value="<?php echo $_SESSION['ses_satkername'] ; ?>">
											<input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" class="btn" value="Pilih" onclick = "showSpoiler(this);">
											<div class="inner" style="display:none;">
								
										<?php
										$alamat_simpul_skpd="$url_rewrite/function/dropdown/radio_simpul_skpd.php";
										$alamat_search_skpd="$url_rewrite/function/dropdown/radio_search_skpd.php";
										js_radioskpd($alamat_simpul_skpd, $alamat_search_skpd,"idkelompok10","skpd_id10",'skpd10','sk10');
										$style2="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
										radioskpd($style2,"skpd_id10",'skpd10','sk10');
										?>        
										</div>
								</div>
							</li>
							<li>
								<span class="span2">Tanggal Cetak Report</span>
									<input type="text" input id="tanggal7" name="cdp_pembmd_cetakreport" value="" >(format tanggal : dd/mm/yyyy)
							</li>
							
							<li>
								<span class="span2">&nbsp;</span>
								<input type="submit" value="Lanjut" class="btn btn-primary" name="pemeliharaanbmd"/>&nbsp;
								<input type="reset" name="reset" class="btn" value="Bersihkan Filter" />
							</li>
						</ul>
						
							<input type="hidden" name="menuID" value="13">
							<input type="hidden" name="mode" value="1">
							<input type="hidden" name="tab" value="3">
						</form>
						</div>
						
						<div class="tab-pane" id="rpmbmd">
						<div class="breadcrumb">
							<div class="titleTab">Rekapitulasi Daftar Hasil Pemeliharaan BMD</div>
						</div>
						<form name="form" method="POST" action="<?php echo "$url_rewrite/report/template/PEROLEHAN/report_perencanaan_cetak_rekapitulasi_pemeliharaan_bmd.php"; ?>">
			<ul>
							<li>
								<span class="span2">Periode</span>
								<input type="checkbox" name="check_rkp_pml" value="1">
								<input type="text" input id="tanggal6" name="cdi_rekpembmd_periode1"value="01/01/<?php echo date ("Y");?>" style="text-align:center">&nbsp;sampai&nbsp;<input type="text" input id="tanggal5"name="cdi_rekpembmd_periode2"value="31/12/<?php echo date ("Y");?>" style="text-align:center">( format tanggal : dd/mm/yyyy )
							</li>
							<li>
								<span class="span2">SKPD</span>
								<div class="input-append">
										<input type="text" name="kelompok2" id="idkelompok11" class="span5" readonly="readonly" placeholder="<?php echo $_SESSION['ses_satkername'] ; ?>">
											<input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" class="btn" value="Pilih" onclick = "showSpoiler(this);">
											<div class="inner" style="display:none;">
											
											<?php
											$alamat_simpul_skpd="$url_rewrite/function/dropdown/radio_simpul_skpd.php";
											$alamat_search_skpd="$url_rewrite/function/dropdown/radio_search_skpd.php";
											js_radioskpd($alamat_simpul_skpd, $alamat_search_skpd,"idkelompok11","skpd_id11",'skpd11','sk11');
											$style2="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
											radioskpd($style2,"skpd_id11",'skpd11','sk11');
											?>        
											</div>
								</div>
							</li>
							<li>
								<span class="span2">Tanggal Cetak Report</span>
									<input type="text" input id="tanggal4" name="cdi_rekpembmd_cetakreport" value="" >(format tanggal : dd/mm/yyyy)
							</li>
						
							<li>
								<span class="span2">&nbsp;</span>
								<input type="submit" value="Lanjut" class="btn btn-primary" name="rekappemeliharaanbmd"/>&nbsp;
								<input type="reset" name="reset" class="btn" value="Bersihkan Filter" />
							</li>
						</ul>
						<input type="hidden" name="menuID" value="13">
						<input type="hidden" name="mode" value="1">
						<input type="hidden" name="tab" value="4">
						</form>
						</div>
						<div class="tab-pane" id="bdp3">
						<div class="breadcrumb">
							<div class="titleTab">Daftar Penerimaan Barang Dari Pihak Ketiga (Hibah)</div>
						</div>
						<form method="post" name="form" action="<?php echo "$url_rewrite/report/template/PEROLEHAN/report_perolehanaset_cetak_daftarbarangdaripihakketiga.php";?>">
			<ul>
							<li>
								<span class="span2">Periode</span>
								<input type="checkbox" name="check_phk_3" value="1">
								<input type="text" input id="tanggal6" name="cdi_rekpembmd_periode1"value="01/01/<?php echo date ("Y");?>" style="text-align:center">&nbsp;sampai&nbsp;<input type="text" input id="tanggal5"name="cdi_rekpembmd_periode2"value="31/12/<?php echo date ("Y");?>" style="text-align:center">( format tanggal : dd/mm/yyyy )
							</li>
							<li>
								<span class="span2">SKPD</span>
								<div class="input-append">
										<input type="text" name="kelompok2" id="idkelompok6" class="span5" readonly="readonly" placeholder="<?php echo $_SESSION['ses_satkername'] ; ?>">
										<input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" class="btn" value="Pilih" onclick = "showSpoiler(this);">
										<div class="inner" style="display:none;">
									

										<?php
										$alamat_simpul_skpd="$url_rewrite/function/dropdown/radio_simpul_skpd.php";
										$alamat_search_skpd="$url_rewrite/function/dropdown/radio_search_skpd.php";
										js_radioskpd($alamat_simpul_skpd, $alamat_search_skpd,"idkelompok6","skpd_id",'skpd6','sk6');
										$style2="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
										radioskpd($style2,"skpd_id",'skpd6','sk6');
										?>  
											  
										</div>
								</div>
							</li>
							<li>
								<span class="span2">Tanggal Cetak Report</span>
								<input type="text" input id="tanggal3"name="cdi_pihak3_cetakreport" value="" >(format tanggal : dd/mm/yyyy)
							</li>
							
							<li>
								<span class="span2">&nbsp;</span>
								<input type="submit" value="Lanjut" class="btn btn-primary" name="barangpihak3"/>&nbsp;
								<input type="reset" name="reset" class="btn" value="Bersihkan Filter" />
							</li>
						</ul>
						<input type="hidden" name="menuID" value="13">
						<input type="hidden" name="mode" value="1">
						<input type="hidden" name="tab" value="5">
						</form>
						</div>
						<div class="tab-pane" id="rbdp3">
						<div class="breadcrumb">
							<div class="titleTab">Rekapitulasi Daftar Penerimaan Barang Dari Pihak Ketiga (Hibah)</div>
						</div>
						<form method="post" name="form" action="<?php echo "$url_rewrite/report/template/PEROLEHAN/report_perencanaan_cetak_rekapitulasi_penerimaan_pihak_ketiga_bmd.php";?>">

			<ul>
							<li>
								<span class="span2">Periode</span>
								<input type="checkbox" name="check_rkp_phk_3" value="1">
								<input type="text" id="tanggal16"  name="tanggalawal_rekap_3" value="01/01/<?php echo date ("Y");?>" style="text-align:center">&nbsp;sampai&nbsp;<input id="tanggal17" type="text" name="tanggalakhir_rekap_3"value="31/12/<?php echo date ("Y");?>" style="text-align:center">( format tanggal : dd/mm/yyyy )
							</li>
							<li>
								<span class="span2">SKPD</span>
								<div class="input-append">
										<input type="text" name="kelompok2" id="idkelompok7" class="span5" readonly="readonly" placeholder="<?php echo $_SESSION['ses_satkername'] ; ?>">
											<input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" class="btn" value="Pilih" onclick = "showSpoiler(this);">
											<div class="inner" style="display:none;">
										
											<?php
											$alamat_simpul_skpd="$url_rewrite/function/dropdown/radio_simpul_skpd.php";
											$alamat_search_skpd="$url_rewrite/function/dropdown/radio_search_skpd.php";
											js_radioskpd($alamat_simpul_skpd, $alamat_search_skpd,"idkelompok7","skpd_id7",'skpd7','sk7');
											$style2="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
											radioskpd($style2,"skpd_id7",'skpd7','sk7');
											?>   
												 
											</div>
								</div>
							</li>
							<li>
								<span class="span2">Tanggal Cetak Report</span>
								<input type="text" input id="tanggal2"name="cdi_rekpembmd_cetakreport" value="" >(format tanggal : dd/mm/yyyy)
							</li>
							<li>
								<span class="span2">&nbsp;</span>
								<input type="submit" value="Lanjut" class="btn btn-primary" name="rekapbarangpihak3"/>&nbsp;
								<input type="reset"name="reset" class="btn" value="Bersihkan Filter" />
							</li>
						</ul>
						<input type="hidden" name="menuID" value="13">
						<input type="hidden" name="mode" value="1">
						<input type="hidden" name="tab" value="6">
						</form>
						</div>
						
					  </div>
			</div> 
			
			
		</section>     
	</section>
	
<?php
	include"$path/footer.php";
?>