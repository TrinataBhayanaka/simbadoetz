<?php
include "../../config/config.php";

?>

<?php
	include"$path/meta.php";
	include"$path/header.php";
	include"$path/menu.php";
	
?>               
    <script>
        $(function()
                {
                $('#tanggal1').datepicker($.datepicker.regional['id']);
                $('#tanggal2').datepicker($.datepicker.regional['id']);
                $('#tanggal3').datepicker($.datepicker.regional['id']);
                $('#tanggal4').datepicker($.datepicker.regional['id']);
                $('#tanggal5').datepicker($.datepicker.regional['id']);
                $('#tanggal6').datepicker($.datepicker.regional['id']);
                $('#tanggal7').datepicker($.datepicker.regional['id']);
                $('#tanggal8').datepicker($.datepicker.regional['id']);
                $('#tanggal9').datepicker($.datepicker.regional['id']);
                $('#tanggal10').datepicker($.datepicker.regional['id']);
                $('#tanggal11').datepicker($.datepicker.regional['id']);
                $('#tanggal12').datepicker($.datepicker.regional['id']);
                $('#tanggal13').datepicker($.datepicker.regional['id']);
                $('#tanggal14').datepicker($.datepicker.regional['id']);
                $('#tanggal15').datepicker($.datepicker.regional['id']);
                $('#tanggal16').datepicker($.datepicker.regional['id']);
                $('#tanggal17').datepicker($.datepicker.regional['id']);
                $('#tanggal18').datepicker($.datepicker.regional['id']);
                $('#tanggal19').datepicker($.datepicker.regional['id']);
                $('#tanggal20').datepicker($.datepicker.regional['id']);
                $('#tanggal21').datepicker($.datepicker.regional['id']);
                $('#tanggal22').datepicker($.datepicker.regional['id']);
                    $('#tanggal23').datepicker($.datepicker.regional['id']);
                $('#tanggal24').datepicker($.datepicker.regional['id']);
                $('#tanggal25').datepicker($.datepicker.regional['id']);
                $('#tanggal26').datepicker($.datepicker.regional['id']);
                }
        );
        <!-- end TAnggal-->
    </script>    
	<section id="main">
		<ul class="breadcrumb">
			  <li><a href="#"><i class="fa fa-home fa-2x"></i>  Home</a> <span class="divider"><b>&raquo;</b></span></li>
			  <li><a href="#">Gudang</a><span class="divider"><b>&raquo;</b></span></li>
			  <li class="active">Cetak Dokumen Gudang</li>
			  <?php SignInOut();?>
			</ul>
			<div class="breadcrumb">
				<div class="title">Cetak Dokumen Gudang</div>
				<div class="subtitle">Cetak Dokumen</div>
			</div>	
		<section class="formLegend">
			
			<div class="tabbable" style="margin-bottom: 18px;">
					  <ul class="nav nav-tabs">
						<li class="active"><a href="#kartuI" data-toggle="tab">Kartu I</a></li>
						<li><a href="#kartuPH" data-toggle="tab">Kartu PH</a></li>
						<li><a href="#persediaanI" data-toggle="tab">Persedian I</a></li>
						<li><a href="#persediaanPH" data-toggle="tab">Persedian PH</a></li>
						<li><a href="#penerimaanI" data-toggle="tab">Penerimaan I</a></li>
						<li><a href="#penerimaanPH" data-toggle="tab">Penerimaan PH</a></li>
						<li><a href="#bukuI" data-toggle="tab">Buku I</a></li>
						<li><a href="#bukuPH" data-toggle="tab">Buku PH</a></li>
						<li><a href="#laporan" data-toggle="tab">Laporan Pemeriksaan</a></li>
					  </ul>
					  <div class="tab-content" style="padding-bottom: 9px; border-bottom: 1px solid #ddd;">
						<div class="tab-pane active" id="kartuI">
						<div class="breadcrumb">
							<div class="titleTab">Kartu Barang Inventaris</div>
						</div>
						 <form name="kartu1" method="POST" action="<?php echo "$url_rewrite/report/template/GUDANG/report_gudang_cetak_kartubaranginventaris.php"; ?>"target="_blank">
			<ul>
							<li>
								<span class="span2">SKPD</span>
								<div class="input-append">
										<input type="hidden" name="idgetkelompok" id="idgetkelompok" value="">
										<input type="text" name="lda_skpd" id="lda_skpd" class="span5" readonly="readonly" value="<?php echo $_SESSION['ses_satkername'] ; ?>">
										<input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" class="btn" value="Pilih" onclick = "showSpoiler(this);">
										<div class="inner" style="display:none;">
										<?php
										$alamat_simpul_skpd="$url_rewrite/function/dropdown/radio_simpul_skpd.php";
										$alamat_search_skpd="$url_rewrite/function/dropdown/radio_search_skpd.php";
										js_radioskpd($alamat_simpul_skpd, $alamat_search_skpd,"lda_skpd","skpd_id",'skpd','sk');
										$style2="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
										radioskpd($style2,"skpd_id",'skpd','sk');
										?>


										</div>
								</div>
							</li>
							<li>
								<span class="span2">Jenis Barang</span>
								<div class="input-append">
									<input type="hidden" name="idgetkelompok" id="idgetkelompok" value="">
									<input type="text" name="lda_kelompok" id="lda_kelompok" class="span5" readonly="readonly" value="(semua Kelompok)">
									<input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" class="btn" value="Pilih" onclick = "showSpoiler(this);">
									<div class="inner" style="display:none;"> 
									<?php
									$alamat_simpul_kelompok="$url_rewrite/function/dropdown/radio_simpul_kelompok.php";
									$alamat_search_kelompok="$url_rewrite/function/dropdown/radio_search_kelompok.php";
									js_radiokelompok($alamat_simpul_kelompok, $alamat_search_kelompok,"lda_kelompok","kelompok_id",'kelompok','skl');
									$style2="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
									radiokelompok($style2,"kelompok_id",'kelompok','skl');
									?>


									</div>
								</div>
							</li>
							<li>
								<span class="span2">Tanggal Awal</span>
								<input type="text" id="tanggal1" name="gdg_cdgkar1_tglawal" value=""> (format tanggal : dd/mm/yyyy)
							</li>
							<li>
								<span class="span2">Tanggal Akhir</span>
								<input type="text" id="tanggal2" name="gdg_cdgkar1_tglakhir"> (format tanggal : dd/mm/yyyy)
							</li>
							<li>
								<span class="span2">Tanggal Cetak Report</span>
								<input type="text" id="tanggal3" name="gdg_cdgkar1_tglreport" value=""> (format tanggal : dd/mm/yyyy)
							</li>
							<li>
								<span class="span2">&nbsp;</span>
								<input type="submit" name="kartu1" class="btn btn-primary" value="Lanjut" />
								<input type="reset" name="reset" class="btn" value="Bersihkan Data">
							</li>
						</ul>
						
								<input type="hidden" name="menuID" value="18">
								<input type="hidden" name="mode" value="1">
								<input type="hidden" name="tab" value="1">
						</form>
						</div>
						<div class="tab-pane" id="kartuPH">
						<div class="breadcrumb">
							<div class="titleTab">Kartu Barang Pakai Habis</div>
						</div>
						  <form name="kartuph" method="POST" action="<?php echo "$url_rewrite/report/template/GUDANG/report_gudang_cetak_kartubarangpakaihabis.php"; ?>"target="_blank">
			<ul>
							<li>
								<span class="span2">SKPD</span>
								<div class="input-append">
										<input type="hidden" name="idgetkelompok" id="idgetkelompok" value="">
										<input type="text" name="lda_skpd2" id="lda_skpd2" class="span5" readonly="readonly" value="<?php echo $_SESSION['ses_satkername'] ; ?>">
										<input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" class="btn" value="Pilih" onclick = "showSpoiler(this);">
										<div class="inner" style="display:none;">
										<?php
										//include "$path/function/dropdown/function_skpd.php";
										$alamat_simpul_skpd="$url_rewrite/function/dropdown/radio_simpul_skpd.php";
										$alamat_search_skpd="$url_rewrite/function/dropdown/radio_search_skpd.php";
										js_radioskpd($alamat_simpul_skpd, $alamat_search_skpd,"lda_skpd2","skpd_id2",'skpd2','sk2');
										$style2="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
										radioskpd($style2,"skpd_id2",'skpd2','sk2');
										?>


										</div>
								</div>
							</li>
							<li>
								<span class="span2">Jenis Barang</span>
								<div class="input-append">
									<input type="hidden" name="idgetkelompok" id="idgetkelompok" value="">
									<input type="text" name="lda_kelompok2" id="lda_kelompok2" class="span5" readonly="readonly" value="(semua Kelompok)">
									<input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" class="btn" value="Pilih" onclick = "showSpoiler(this);">
									<div class="inner" style="display:none;">

									<?php
									//include "$path/function/dropdown/function_kelompok.php";
									$alamat_simpul_kelompok="$url_rewrite/function/dropdown/radio_simpul_kelompok.php";
									$alamat_search_kelompok="$url_rewrite/function/dropdown/radio_search_kelompok.php";
									js_radiokelompok($alamat_simpul_kelompok, $alamat_search_kelompok,"lda_kelompok2","kelompok_id2",'kelompok2','skl2');
									$style2="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
									radiokelompok($style2,"kelompok_id2",'kelompok2','skl2');
									?>

									</div>
								</div>
							</li>
							<li>
								<span class="span2">Tanggal Awal</span>
								<input type="text" id="tanggal4"name="gdg_cdgkarph_tglawal"value=""> (format tanggal : dd/mm/yyyy)
							</li>
							<li>
								<span class="span2">Tanggal Akhir</span>
								<input type="text" id="tanggal5"name="gdg_cdgkarph_tglakhir"value=""> (format tanggal : dd/mm/yyyy)
							</li>
							<li>
								<span class="span2">Tanggal Cetak Report</span>
								<input type="text" id="tanggal6"name="gdg_cdgkarph_tglreport" value=""> (format tanggal : dd/mm/yyyy)
							</li>
							<li>
								<span class="span2">&nbsp;</span>
								<input type="submit" name="kartuph" onClick="sendit_5()" class="btn btn-primary" value="Lanjut" />
								<input type="reset" name="reset" class="btn" value="Bersihkan Data">
							</li>
						</ul>
						
							<input type="hidden" name="menuID" value="18">
							<input type="hidden" name="mode" value="1">
							<input type="hidden" name="tab" value="2">
						</form>
						</div>
						<div class="tab-pane" id="persediaanI">
						<div class="breadcrumb">
							<div class="titleTab">Kartu Persediaan Barang Inventaris</div>
						</div>
						  <form name="persediaan1" method="POST" action="<?php echo "$url_rewrite/report/template/GUDANG/report_gudang_cetak_bukupersediaanbaranginventaris.php"; ?>"target="_blank">
			<ul>
							<li>
								<span class="span2">Tahun</span>
								<input name="gdg_cdgper1_tahun" type="text" value="<?php echo date('Y')?>">
							</li>
							<li>
								<span class="span2">SKPD</span>
								<div class="input-append">
										<input type="hidden" name="idgetkelompok" id="idgetkelompok" value="">
										<input type="text" name="lda_skpd3" id="lda_skpd3" class="span5" readonly="readonly" value="<?php echo $_SESSION['ses_satkername'] ; ?>">
										<input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" class="btn" value="Pilih" onclick = "showSpoiler(this);">
										<div class="inner" style="display:none;">
										<?php
										//include "$path/function/dropdown/function_skpd.php";
										$alamat_simpul_skpd="$url_rewrite/function/dropdown/radio_simpul_skpd.php";
										$alamat_search_skpd="$url_rewrite/function/dropdown/radio_search_skpd.php";
										js_radioskpd($alamat_simpul_skpd, $alamat_search_skpd,"lda_skpd3","skpd_id3",'skpd3','sk3');
										$style2="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
										radioskpd($style2,"skpd_id3",'skpd3','sk3');
										?>

										</div>
								</div>
							</li>
							<li>
								<span class="span2">Jenis Barang</span>
								<div class="input-append">
									<input type="hidden" name="idgetkelompok" id="idgetkelompok" value="">
									<input type="text" name="lda_kelompok3" id="lda_kelompok3" class="span5" readonly="readonly" value="(semua Kelompok)">
									<input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" class="btn" value="Pilih" onclick = "showSpoiler(this);">
									<div class="inner" style="display:none;">
									<?php
									//include "$path/function/dropdown/function_kelompok.php";
									$alamat_simpul_kelompok="$url_rewrite/function/dropdown/radio_simpul_kelompok.php";
									$alamat_search_kelompok="$url_rewrite/function/dropdown/radio_search_kelompok.php";
									js_radiokelompok($alamat_simpul_kelompok, $alamat_search_kelompok,"lda_kelompok3","kelompok_id3",'kelompok3','skl3');
									$style2="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
									radiokelompok($style2,"kelompok_id3",'kelompok3','skl3');
									?>

									</div>
								</div>
							</li>
							<li>
								<span class="span2">Tanggal Cetak Report</span>
								<input type="text" id="tanggal7"name="gdg_cdgper1_tglreport"value=""> (format tanggal : dd/mm/yyyy)
							</li>
							<li>
								<span class="span2">&nbsp;</span>
								<input type="submit" name="persediaan1" class="btn btn-primary" value="Lanjut" />
								<input type="reset" name="reset" class="btn" value="Bersihkan Data">
							</li>
						</ul>
						
							<input type="hidden" name="menuID" value="18">
							<input type="hidden" name="mode" value="1">
							<input type="hidden" name="tab" value="3">
						</form>
						</div>
						
						<div class="tab-pane" id="persediaanPH">
						<div class="breadcrumb">
							<div class="titleTab">Kartu Persediaan Barang Pakai Habis</div>
						</div>
						 <form name="persediaanph" method="POST" action="<?php echo "$url_rewrite/report/template/GUDANG/report_gudang_cetak_bukupersediaanbarangpakaihabis.php"; ?>"target="_blank">
			<ul>
							<li>
								<span class="span2">Tahun</span>
								<input name="gdg_cdgperph_tahun" type="text" value="<?php echo date('Y')?>">
							</li>
							<li>
								<span class="span2">SKPD</span>
								<div class="input-append">
										<input type="hidden" name="idgetkelompok" id="idgetkelompok" value="">
										<input type="text" name="lda_skpd4" id="lda_skpd4" class="span5" readonly="readonly" value="<?php echo $_SESSION['ses_satkername'] ; ?>">
										<input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" class="btn" value="Pilih" onclick = "showSpoiler(this);">
										<div class="inner" style="display:none;">
										<?php
										//include "$path/function/dropdown/function_skpd.php";
										$alamat_simpul_skpd="$url_rewrite/function/dropdown/radio_simpul_skpd.php";
										$alamat_search_skpd="$url_rewrite/function/dropdown/radio_search_skpd.php";
										js_radioskpd($alamat_simpul_skpd, $alamat_search_skpd,"lda_skpd4","skpd_id4",'skpd4','sk4');
										$style2="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
										radioskpd($style2,"skpd_id4",'skpd4','sk4');
										?>


										</div>
								</div>
							</li>
							<li>
								<span class="span2">Jenis Barang</span>
								<div class="input-append">
									<input type="hidden" name="idgetkelompok" id="idgetkelompok" value="">
									<input type="text" name="lda_kelompok4" id="lda_kelompok4" class="span5" readonly="readonly" value="(semua Kelompok)">
									<input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" class="btn" value="Pilih" onclick = "showSpoiler(this);">
									<div class="inner" style="display:none;">
									<?php
									//include "$path/function/dropdown/function_kelompok.php";
									$alamat_simpul_kelompok="$url_rewrite/function/dropdown/radio_simpul_kelompok.php";
									$alamat_search_kelompok="$url_rewrite/function/dropdown/radio_search_kelompok.php";
									js_radiokelompok($alamat_simpul_kelompok, $alamat_search_kelompok,"lda_kelompok4","kelompok_id4",'kelompok4','skl4');
									$style2="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
									radiokelompok($style2,"kelompok_id4",'kelompok4','skl4');
									?>

									</div>
								</div>
							</li>
							<li>
								<span class="span2">Tanggal Cetak Report</span>
								<input type="text" id="tanggal8"name="gdg_cdgperph_tglreport"value=""> (format tanggal : dd/mm/yyyy)
							</li>
							<li>
								<span class="span2">&nbsp;</span>
								<input type="submit" name="persediaanph" class="btn btn-primary" value="Lanjut" />
								<input type="reset" name="reset" class="btn" value="Bersihkan Data">
							</li>
						</ul>
						
							<input type="hidden" name="menuID" value="18">
							<input type="hidden" name="mode" value="1">
							<input type="hidden" name="tab" value="4">
						</form>
						</div>
						<div class="tab-pane" id="penerimaanI">
						<div class="breadcrumb">
							<div class="titleTab">Buku Penerimaan Barang Inventaris</div>
						</div>
						<form name="penerimaan1" method="POST" action="<?php echo "$url_rewrite/report/template/GUDANG/report_gudang_cetak_bukupenerimaanbaranginventaris.php"; ?>"target="_blank">
			<ul>
							
							<li>
								<span class="span2">SKPD</span>
								<div class="input-append">
										<input type="hidden" name="idgetkelompok" id="idgetkelompok" value="">
										<input type="text" name="lda_skpd5" id="lda_skpd5" class="span5" readonly="readonly" value="<?php echo $_SESSION['ses_satkername'] ; ?>">
										<input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" class="btn" value="Pilih" onclick = "showSpoiler(this);">
										<div class="inner" style="display:none;">
										<?php
										//include "$path/function/dropdown/function_skpd.php";
										$alamat_simpul_skpd="$url_rewrite/function/dropdown/radio_simpul_skpd.php";
										$alamat_search_skpd="$url_rewrite/function/dropdown/radio_search_skpd.php";
										js_radioskpd($alamat_simpul_skpd, $alamat_search_skpd,"lda_skpd5","skpd_id5",'skpd5','sk5');
										$style2="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
										radioskpd($style2,"skpd_id5",'skpd5','sk5');
										?>

										</div>
								</div>
							</li>
							<li>
								<span class="span2">Jenis Barang</span>
								<div class="input-append">
									<input type="hidden" name="idgetkelompok" id="idgetkelompok" value="">
									<input type="text" name="lda_kelompok5" id="lda_kelompok5" class="span5" readonly="readonly" value="(semua Kelompok)">
									<input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" class="btn" value="Pilih" onclick = "showSpoiler(this);">
									<div class="inner" style="display:none;">
									<?php
									//include "$path/function/dropdown/function_kelompok.php";
									$alamat_simpul_kelompok="$url_rewrite/function/dropdown/radio_simpul_kelompok.php";
									$alamat_search_kelompok="$url_rewrite/function/dropdown/radio_search_kelompok.php";
									js_radiokelompok($alamat_simpul_kelompok, $alamat_search_kelompok,"lda_kelompok5","kelompok_id5",'kelompok5','skl5');
									$style2="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
									radiokelompok($style2,"kelompok_id5",'kelompok5','skl5');
									?>

									</div>
								</div>
							</li>
							<li>
								<span class="span2">Tanggal Awal</span>
								<input type="text" id="tanggal9"name="gdg_cdgpen1_awal"value=""> (format tanggal : dd/mm/yyyy)
							</li>
							<li>
								<span class="span2">Tanggal Akhir</span>
								<input type="text" id="tanggal10"name="gdg_cdgpen1_akhir"value=""> (format tanggal : dd/mm/yyyy)
							</li>
							<li>
								<span class="span2">Tanggal Cetak Report</span>
								<input type="text" id="tanggal11" name="gdg_cdgpen1_tglreport"value=""> (format tanggal : dd/mm/yyyy)
							</li>
							<li>
								<span class="span2">&nbsp;</span>
								<input type="submit" name="penerimaan1" class="btn btn-primary" value="Lanjut" />
								<input type="reset" name="reset" class="btn" value="Bersihkan Data">
							</li>
						</ul>
						
							<input type="hidden" name="menuID" value="18">
							<input type="hidden" name="mode" value="1">
							<input type="hidden" name="tab" value="5">
						</form>
						</div>
						<div class="tab-pane" id="penerimaanPH">
						<div class="breadcrumb">
							<div class="titleTab">Buku Penerimaan Barang Pakai Habis</div>
						</div>
						<form name="penerimaanph" method="POST" action="<?php echo "$url_rewrite/report/template/GUDANG/report_gudang_cetak_bukupenerimaanbaranginventaris.php";?>"target="_blank">
			<ul>
							
							<li>
								<span class="span2">SKPD</span>
								<div class="input-append">
										<input type="hidden" name="idgetkelompok" id="idgetkelompok" value="">
										<input type="text" name="lda_skpd6" id="lda_skpd6" class="span5" readonly="readonly" value="<?php echo $_SESSION['ses_satkername'] ; ?>">
										<input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" class="btn" value="Pilih" onclick = "showSpoiler(this);">
										<div class="inner" style="display:none;">
										<?php
										//include "$path/function/dropdown/function_skpd.php";
										$alamat_simpul_skpd="$url_rewrite/function/dropdown/radio_simpul_skpd.php";
										$alamat_search_skpd="$url_rewrite/function/dropdown/radio_search_skpd.php";
										js_radioskpd($alamat_simpul_skpd, $alamat_search_skpd,"lda_skpd6","skpd_id6",'skpd6','sk6');
										$style2="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
										radioskpd($style2,"skpd_id6",'skpd6','sk6');
										?>

										</div>
								</div>
							</li>
							<li>
								<span class="span2">Jenis Barang</span>
								<div class="input-append">
									<input type="hidden" name="idgetkelompok" id="idgetkelompok" value="">
									<input type="text" name="lda_kelompok6" id="lda_kelompok6" class="span5" readonly="readonly" value="(semua Kelompok)">
									<input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" class="btn" value="Pilih" onclick = "showSpoiler(this);">
									<div class="inner" style="display:none;">
									<?php
									//include "$path/function/dropdown/function_kelompok.php";
									$alamat_simpul_kelompok="$url_rewrite/function/dropdown/radio_simpul_kelompok.php";
									$alamat_search_kelompok="$url_rewrite/function/dropdown/radio_search_kelompok.php";
									js_radiokelompok($alamat_simpul_kelompok, $alamat_search_kelompok,"lda_kelompok6","kelompok_id6",'kelompok6','skl6');
									$style2="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
									radiokelompok($style2,"kelompok_id6",'kelompok6','skl6');
									?>


									</div>
								</div>
							</li>
							<li>
								<span class="span2">Tanggal Awal</span>
								<input type="text" id="tanggal12" name="gdg_cdgpenph_tglawal"value=""> (format tanggal : dd/mm/yyyy)
							</li>
							<li>
								<span class="span2">Tanggal Akhir</span>
								<input type="text" id="tanggal13"name="gdg_cdgpenphakhir"value=""> (format tanggal : dd/mm/yyyy)
							</li>
							<li>
								<span class="span2">Tanggal Cetak Report</span>
								<input type="text"id="tanggal14" name="gdg_cp_ph_tglreport"value=""> (format tanggal : dd/mm/yyyy)
							</li>
							<li>
								<span class="span2">&nbsp;</span>
								<input type="submit" name="penerimaanph" class="btn btn-primary" value="Lanjut" />
								<input type="reset" name="reset" class="btn" value="Bersihkan Data">
							</li>
						</ul>
						
							<input type="hidden" name="menuID" value="18">
							<input type="hidden" name="mode" value="1">
							<input type="hidden" name="tab" value="6">
						</form>
						</div>
						<div class="tab-pane" id="bukuI">
						<div class="breadcrumb">
							<div class="titleTab">Buku Barang Inventaris</div>
						</div>
						<form name="pengeluaran1" method="POST" action="<?php echo "$url_rewrite/report/template/GUDANG/report_gudang_cetak_bukubaranginventaris.php"; ?>"target="_blank">
			<ul>
							<li>
								<span class="span2">Jenis Barang</span>
								<div class="input-append">
										<input type="hidden" name="idgetkelompok" id="idgetkelompok" value="">
										<input type="text" name="lda_kelompok9" id="lda_kelompok9" class="span5" readonly="readonly" value="(semua Kelompok)">
										<input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" class="btn" value="Pilih" onclick = "showSpoiler(this);">
										<div class="inner" style="display:none;">

										<?php
										//include "$path/function/dropdown/function_kelompok.php";
										$alamat_simpul_kelompok="$url_rewrite/function/dropdown/radio_simpul_kelompok.php";
										$alamat_search_kelompok="$url_rewrite/function/dropdown/radio_search_kelompok.php";
										js_radiokelompok($alamat_simpul_kelompok, $alamat_search_kelompok,"lda_kelompok9","kelompok_id9",'kelompok9','skl9');
										$style2="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
										radiokelompok($style2,"kelompok_id9",'kelompok9','skl9');
										?>


										</div>
								</div>
							</li>
							<li>
								<span class="span2">Lokasi</span>
								<div class="input-append">
									<input type="hidden" name="idgetkelompok" id="idgetkelompok" value="">
									<input type="text" name="idlokasi1" id="idlokasi1" class="span5" readonly="readonly" value="(semua Lokasi)">
									<input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok"class="btn" value="Pilih"onclick = "showSpoiler(this);">
									<div class="inner" style="display:none;">

									<?php
									//include "$path/function/dropdown/function_kelompok.php";
									$alamat_simpul_lokasi="$url_rewrite/function/dropdown/simpul_lokasi.php";
									$alamat_search_lokasi="$url_rewrite/function/dropdown/search_lokasi.php";
									js_checkboxlokasi($alamat_simpul_lokasi, $alamat_search_lokasi,"idlokasi1","lokasi_id1",'lokasi1','l1');
									$style2="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
									checkboxlokasi($style2,"lokasi_id1",'lokasi1','l1');
									?>

									</div>
								</div>
							</li>
							<li>
								<span class="span2">SKPD</span>
								<div class="input-append">
									<input type="hidden" name="idgetkelompok" id="idgetkelompok" value="">
									<input type="text" name="lda_skpd9" id="lda_skpd9" class="span5" readonly="readonly" value="<?php echo $_SESSION['ses_satkername'] ; ?>">
									<input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" class="btn" value="Pilih" onclick = "showSpoiler(this);">
									<div class="inner" style="display:none;">
									<?php
									//include "$path/function/dropdown/function_skpd.php";
									$alamat_simpul_skpd="$url_rewrite/function/dropdown/radio_simpul_skpd.php";
									$alamat_search_skpd="$url_rewrite/function/dropdown/radio_search_skpd.php";
									js_radioskpd($alamat_simpul_skpd, $alamat_search_skpd,"lda_skpd9","skpd_id9",'skpd9','sk9');
									$style2="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
									radioskpd($style2,"skpd_id9",'skpd9','sk9');
									?>

									</div>
								</div>
							</li>
							<li>
								<span class="span2">Tanggal Cetak Report</span>
								<input type="text" id="tanggal21"name="gdg_cdg_buku1_tglreport"value=""> (format tanggal : dd/mm/yyyy)
							</li>
							<li>
								<span class="span2">&nbsp;</span>
								<input type="submit" name="submit" class="btn btn-primary" value="Lanjut" />
								<input type="reset" name="reset" class="btn" value="Bersihkan Data">
							</li>
						</ul>
						
								<input type="hidden" name="menuID" value="18">
								<input type="hidden" name="mode" value="1">
								<input type="hidden" name="tab" value="9">
						</form>
						</div>
						<div class="tab-pane" id="bukuPH">
						<div class="breadcrumb">
							<div class="titleTab">Buku Barang Pakai Habis</div>
						</div>
						<form name="pengeluaran1" method="POST" action="<?php echo "$url_rewrite/report/template/GUDANG/report_gudang_cetak_bukubarangpakaihabis.php"; ?>"target="_blank">
			<ul>
							
							<li>
								<span class="span2">Jenis Barang</span>
								<div class="input-append">
										<input type="hidden" name="idgetkelompok" id="idgetkelompok" value="">
										<input type="text" name="lda_kelompok10" id="lda_kelompok10" class="span5" readonly="readonly" value="(semua Kelompok)">
										<input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" class="btn" value="Pilih" onclick = "showSpoiler(this);">
										<div class="inner" style="display:none;">
										<?php
										//include "$path/function/dropdown/function_kelompok.php";
										$alamat_simpul_kelompok="$url_rewrite/function/dropdown/radio_simpul_kelompok.php";
										$alamat_search_kelompok="$url_rewrite/function/dropdown/radio_search_kelompok.php";
										js_radiokelompok($alamat_simpul_kelompok, $alamat_search_kelompok,"lda_kelompok10","kelompok_id10",'kelompok10','skl10');
										$style2="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
										radiokelompok($style2,'kelompok_id10','kelompok10','skl10');
										?>

										</div>
								</div>
							</li>
							<li>
								<span class="span2">Lokasi</span>
								<div class="input-append">
									<input type="hidden" name="idgetkelompok" id="idgetkelompok" value="">
									<input type="text" name="idlokasi2" id="idlokasi2" class="span5" readonly="readonly" value="(semua Lokasi)">
									<input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok"class="btn" value="Pilih"onclick = "showSpoiler(this);">
									<div class="inner" style="display:none;">
									<?php
									//include "$path/function/dropdown/function_kelompok.php";
									$alamat_simpul_lokasi="$url_rewrite/function/dropdown/simpul_lokasi.php";
									$alamat_search_lokasi="$url_rewrite/function/dropdown/search_lokasi.php";
									js_checkboxlokasi($alamat_simpul_lokasi, $alamat_search_lokasi,"idlokasi2","lokasi_id2",'lokasi2','l2');
									$style2="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
									checkboxlokasi($style2,"lokasi_id2",'lokasi2','l2');
									?>

									</div>
								</div>
							</li>
							<li>
								<span class="span2">SKPD</span>
								<div class="input-append">
									<input type="hidden" name="idgetkelompok" id="idgetkelompok" value="">
									<input type="text" name="lda_skpd10" id="lda_skpd10" class="span5" readonly="readonly" value="<?php echo $_SESSION['ses_satkername'] ; ?>">
									<input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" class="btn" value="Pilih" onclick = "showSpoiler(this);">
									<div class="inner" style="display:none;">
									<?php
									//include "$path/function/dropdown/function_skpd.php";
									$alamat_simpul_skpd="$url_rewrite/function/dropdown/radio_simpul_skpd.php";
									$alamat_search_skpd="$url_rewrite/function/dropdown/radio_search_skpd.php";
									js_radioskpd($alamat_simpul_skpd, $alamat_search_skpd,"lda_skpd10","skpd_id10",'skpd10','sk10');
									$style2="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
									radioskpd($style2,'skpd_id10','skpd10','sk10');
									?>

									</div>
								</div>
							</li>
							<li>
								<span class="span2">Tanggal Cetak Report</span>
								<input type="text" id="tanggal22"name="gdg_cdg_bukuph_tglreport"value=""> (format tanggal : dd/mm/yyyy)
							</li>
							<li>
								<span class="span2">&nbsp;</span>
								<input type="submit" name="bukuph" class="btn btn-primary" value="Lanjut" />
								<input type="reset" name="reset" class="btn" value="Bersihkan Data">
							</li>
						</ul>
						
								<input type="hidden" name="menuID" value="18">
								<input type="hidden" name="mode" value="1">
								<input type="hidden" name="tab" value="10">
						</form>
						</div>
						<div class="tab-pane" id="laporan">
						<div class="breadcrumb">
							<div class="titleTab">Laporan Pemeriksaan Gudang</div>
						</div>
						<form name="buku1" method="POST" action="<?php echo "$url_rewrite/report/template/GUDANG/report_gudang_cetak_laporanpemeriksaanbarangataugudang.php"; ?>"target="_blank">

			<ul>
							<li>
								<span class="span2">SKPD</span>
								<div class="input-append">
										<input type="hidden" name="idgetkelompok" id="idgetkelompok" value="">
										<input type="text" name="lda_skpd11" id="lda_skpd11" class="span5" readonly="readonly" value="<?php echo $_SESSION['ses_satkername'] ; ?>">
										<input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" class="btn" value="Pilih" onclick = "showSpoiler(this);">
										<div class="inner" style="display:none;">
										<?php
										//include "$path/function/dropdown/function_skpd.php";
										$alamat_simpul_skpd="$url_rewrite/function/dropdown/radio_simpul_skpd.php";
										$alamat_search_skpd="$url_rewrite/function/dropdown/radio_search_skpd.php";
										js_radioskpd($alamat_simpul_skpd, $alamat_search_skpd,"lda_skpd11","skpd_id11",'skpd11','sk11');
										$style2="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
										radioskpd($style2,'skpd_id11','skpd11','sk11');
										?>

										</div>
								</div>
							</li>
							<li>
								<span class="span2">Jenis Barang</span>
								<div class="input-append">
									<input type="hidden" name="idgetkelompok" id="idgetkelompok" value="">
									<input type="text" name="lda_kelompok11" id="lda_kelompok11" class="span5" readonly="readonly" value="(semua Kelompok)">
									<input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" class="btn" value="Pilih" onclick = "showSpoiler(this);">
									<div class="inner" style="display:none;">
									<?php
									//include "$path/function/dropdown/function_kelompok.php";
									$alamat_simpul_kelompok="$url_rewrite/function/dropdown/radio_simpul_kelompok.php";
									$alamat_search_kelompok="$url_rewrite/function/dropdown/radio_search_kelompok.php";
									js_radiokelompok($alamat_simpul_kelompok, $alamat_search_kelompok,"lda_kelompok11","kelompok_id11",'kelompok11','skl11');
									$style2="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
									radiokelompok($style2,'kelompok_id11','kelompok11','skl11');
									?>

									</div>
								</div>
							</li>
							<li>
								<span class="span2">Tanggal Awal</span>
								<input type="text" id="tanggal23"name="gdg_cdg_lapem_tglawal"value="">
							</li>
							<li>
								<span class="span2">Tanggal Akhir</span>
								<input type="text"id="tanggal24" name="gdg_cdg_lapem_tglakhir"value="">
							</li>
							<li>
								<span class="span2">Tanggal Cetak Report</span>
								<input type="text"id="tanggal25" name="gdg_cd_lapem_tglreport"value=""> (format tanggal : dd/mm/yyyy)
							</li>
							<li>
								<span class="span2">&nbsp;</span>
								<input type="submit" name="laporanpemeriksaan" class="btn btn-primary" value="Lanjut" />
								<input type="reset" name="reset" class="btn" value="Bersihkan Data">
							</li>
						</ul>
						
							<input type="hidden" name="menuID" value="18">
							<input type="hidden" name="mode" value="1">
							<input type="hidden" name="tab" value="11">
						</form>
						</div>
					  </div>
			</div> 
			
			
		</section>     
	</section>
	
<?php
	include"$path/footer.php";
?>