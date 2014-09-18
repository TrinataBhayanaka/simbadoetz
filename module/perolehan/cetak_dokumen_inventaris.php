<?php
include "../../config/config.php";
include"$path/header.php";


?>
<body>
    
<div id="content">
<?php
include"$path/title.php";
include"$path/menu.php";
?>
<script type="text/javascript" src="<?php echo "$url_rewrite"?>/JS/control.js"></script>
     <script type="text/javascript" src="<?php echo "$url_rewrite"?>/JS/jquery.min.js"></script>                     <!-- end TAnggal-->
    <script type="text/javascript" src="<?php echo "$url_rewrite"?>/JS/jquery-ui.min.js"></script>                 <!-- end TAnggal-->                  
    <script type="text/javascript" src="<?php echo "$url_rewrite"?>/JS/jquery.ui.datepicker-id.js"></script>    <!-- end TAnggal-->
<script type="text/javascript" src="<?php echo "$url_rewrite"?>/JS/tabel.js"></script>

<script type="text/javascript" src="<?php echo "$url_rewrite"?>/JS/script.js"></script>
    <div id="tengah1">
	<div id="frame_tengah1">
	    <div id="frame_gudang">
		<div id="topright">Cetak Dokumen Inventaris</div>

		<div id="bottomright">
		    
		    <div class="tabber">
    
    
			<script>
			// fungsi untuk tanggal //
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
			}
			);
			
			</script> 

			<div class="tabbertab">
				
			    <form name="form" method="POST" action="<?php echo "$url_rewrite/report/template/PEROLEHAN/kib.php"; ?>">
				<h2>KIB</h2>
				<strong>Kartu Inventaris Barang</strong>
				<script>
				function show_kelompok(kib){
				url='<?php echo $url_rewrite?>'+'/module/perolehan/api_kib.php?kib='+kib;
				ambilData(url,'isi_kib');
				}
				</script>
				<table border="0" cellspacing="6">
				    <tr>
					<td ><input type="radio" name="kib" value="KIB-A" class="inven1" onclick="show_kelompok('KIB-A');">&nbsp; KIB-A</td> 
					<td>&nbsp;</td>
					<td><input type="radio" name="kib" value="KIB-B"class="inven2" onclick="show_kelompok('KIB-B');">&nbsp; KIB-B</td> 
					<td>&nbsp;</td>
					<td><input type="radio" name="kib" value="KIB-C"class="inven3" onclick="show_kelompok('KIB-C');"> &nbsp; KIB-C</td>
					<td>&nbsp;</td>
					<td><input type="radio" name="kib" value="KIB-D"class="inven4" onclick="show_kelompok('KIB-D');"> &nbsp;KIB-D</td>
					<td>&nbsp;</td>
					<td><input type="radio" name="kib" value="KIB-E"class="inven5" onclick="show_kelompok('KIB-E');"> &nbsp;KIB-E</td>
					<td>&nbsp;</td>
					<td><input type="radio"name="kib" value="KIB-F"class="inven6" onclick="show_kelompok('KIB-F');"> &nbsp;KIB-F</td>
					<td>&nbsp;</td>
					<td><input type="button" name="kib" value="Cetak KIB Kosong"></td>
				    </tr>
				</table>
                              
				

                <div id ='isi_kib'> &nbsp;</div>
              
                                                                      <table>
				<table border="0" width=10%  cellspacing="6">
				    <tr>
						<td width=8%>Tahun</td>
						<td width=10%><input name="tahun" type="text" value="<?php echo date('Y')?>"></td>
					</tr>
				</table>
				
				<table  cellspacing="6" border='0'>
				    <tr>
					<td colspan=2 valign='top'>Nama Skpd </td>
					<td>
					    <input type="hidden" name="idgetkelompok" id="idgetkelompok" value="">
					    <input type="text" name="lda_skpd" id="lda_skpd" style="width:480px;" readonly="readonly" value="<?php echo $_SESSION['ses_satkername'] ; ?>">
					    <input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" value="Pilih" onclick = "showSpoiler(this);">
					    <div class="inner" style="display:none;">
	
						<div style="width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;">
			       
						    <?php
							 $alamat_simpul_skpd="$url_rewrite/function/dropdown/radio_simpul_skpd.php";
							 $alamat_search_skpd="$url_rewrite/function/dropdown/radio_search_skpd.php";
							 js_radioskpd($alamat_simpul_skpd, $alamat_search_skpd,"lda_skpd","skpd_id",'skpd', 'skpd1');
							 $style="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
							 radioskpd($style,"skpd_id",'skpd', 'skpd1');
						     ?>  
						    
						</div>
					    </div>
					</td>
				    </tr>
				</table>
				<table  border="0" cellspacing="6">
				    <tr>
					<td align="left" valign="top">
					    <hr size="0.5pt">
					    <input type="submit" onClick="sendit_5()"name="lanjut" value="Lanjut" />
					    <input type="reset"name="reset" onClick="sendit_6()" value="Bersihkan Filter" />
					    <hr size="0.5pt">
					</td>
				    </tr>
				</table>
				
				<hr>
				<table cellspacing="6">
				    <tr>
					<td>Tanggal Cetak Report</td>
					<td><input type="text" input id="tanggal1"  name="cdi_kib_tglreport" value="" ></td>
					<td>(format tanggal : dd/mm/yyyy)</td>
				    </tr>
				</table>
				<input type="hidden" name="menuID" value="14">
				<input type="hidden" name="mode" value="1">
				<input type="hidden" name="tab" value="1">
				
			    </form>
			</div>
			
			<div class="tabbertab">
			    <form name="form" method="POST" action="<?php echo "$url_rewrite/report/template/PEROLEHAN/report_perolehanaset_cetak_kir.php"; ?>">
				<h2>KIR</h2>
				<strong>Kartu Inventaris Ruangan</strong>
				
				
				<table border="0" width=10%  cellspacing="6">
				    <tr>
						<td width=8%>Tahun</td>
						<td width=10%><input name="tahun_kir" type="text" value="<?php echo date('Y')?>"></td>
					</tr>				
				</table>
				
				<table cellspacing="6">
				    
				    <tr>
					<td colspan=2>Nama Skpd </td>
				    </tr>
				    <tr>
					<td>
					    <input type="hidden" name="idgetkelompok" id="idgetkelompok" value="">
					    <input type="text" name="lda_skpd2" id="lda_skpd2"style="width:480px;"readonly="readonly"value="<?php echo $_SESSION['ses_satkername'] ; ?>">
					    <input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok"value="Pilih"onclick = "showSpoiler(this);">
					    <div class="inner" style="display:none;">
						
						<div style="width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;">
				   
						    <?php
							$alamat_simpul_skpd="$url_rewrite/function/dropdown/radio_simpul_skpd.php";
							$alamat_search_skpd="$url_rewrite/function/dropdown/radio_search_skpd.php";
							js_radioskpd($alamat_simpul_skpd, $alamat_search_skpd,"lda_skpd2","skpd_id2",'skpd_b', 'skpd2');
							$style="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
							radioskpd($style,"skpd_id2",'skpd_b', 'skpd2');
						    ?>  
							
						</div>
					    </div>
					</td>
				    </tr>
				</table>
				
				<table>
				<tr>
				    <td align="left" valign="top"><hr size="0.5pt">
				    <input type="submit" onClick="testsendit_5()" name="kir"value="Lanjut" />
				    <input type="reset"name="reset" onClick="sendit_6()" value="Bersihkan Filter" />
				    <hr size="0.5pt">
				    </td>
				</tr>
				</table>
				
				<hr>
				<table cellspacing="6">
				    <tr>
					<td>Tanggal Cetak Report</td>
					<td><input type="text" input id="tanggal2" name="cdi_kir_tglreport" value="" ></td>
					<td>(format tanggal : dd/mm/yyyy)</td>
				    </tr>
				</table>
                        <input type="hidden" name="menuID" value="14">
						<input type="hidden" name="mode" value="1">
						<input type="hidden" name="tab" value="2">
			    </form>    
			</div>
			
			<div class="tabbertab">
			    <form name="form" method="POST" action="<?php echo "$url_rewrite/report/template/PEROLEHAN/skpd.php"; ?>">
				<h2>Buku Inventaris SKPD</h2>
				<strong>Buku Inventaris SKPD</strong>
				
				<table border="0" width=10%  cellspacing="6">
				    <tr>
					<td width=10%>
					    <tr>
						<td width=8%>Tahun</td>
						<td width=10%><input name="tahun_buku_inventaris_skpd" type="text" value="<?php echo date('Y')?>"></td>
					</tr>
				</table>
				<table cellspacing="6">
				<tr>
					<td colspan="2">Kelompok</td>
				
					<td>
						<input type="text" name="lda_kelompok" id="lda_kelompok" style="width:450px;" readonly="readonly" value="" placeholder="(Semua Kelompok)">
						<input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" value="Pilih" onclick = "showSpoiler(this);"><font size="1" color="grey"><i>&nbsp;</i></font>
						<div class="inner" style="display:none;">
							<style>
								.tabel th {
									background-color: #eeeeee;
									border: 1px solid #dddddd;
								}
								.tabel td {
									border: 1px solid #dddddd;
								}
							</style>
							<?php
								$alamat_simpul_kelompok="$url_rewrite/function/dropdown/radio_simpul_kelompok.php";
								$alamat_search_kelompok="$url_rewrite/function/dropdown/radio_search_kelompok.php";
								js_radiokelompok($alamat_simpul_kelompok, $alamat_search_kelompok,"lda_kelompok","kelompok_id",'kelompok','ldakelompokfilter');
								$style="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
								radiokelompok($style,"kelompok_id",'kelompok','ldakelompokfilter');
							?>
						</div>
					</td>
				</tr>
				</table>
				<table cellspacing="6">
				    <tr>
					<td colspan="2">Nama Skpd </td>
					<td>
					    <input type="hidden" name="idgetkelompok" id="idgetkelompok" value="">
					    <input type="text" name="lda_skpd3" id="lda_skpd3" style="width:480px;"readonly="readonly"value="" placeholder="<?php echo $_SESSION['ses_satkername'] ; ?>">
					    <input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok"value="Pilih"onclick = "showSpoiler(this);">
					    <div class="inner" style="display:none;">
						<div style="width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;">
				   
						    <?php
							$alamat_simpul_skpd="$url_rewrite/function/dropdown/radio_simpul_skpd.php";
							$alamat_search_skpd="$url_rewrite/function/dropdown/radio_search_skpd.php";
							js_radioskpd($alamat_simpul_skpd, $alamat_search_skpd,"lda_skpd3","skpd_id3",'skpd_c', 'skpd3');
							$style="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
							radioskpd($style,"skpd_id3",'skpd_c', 'skpd3');
						    ?>  
							
						</div>
					    </div>
					</td>
				    </tr>
				</table>
				<hr>
				<table>
				    <tr>
					<td align="left" valign="top"><hr size="0.5pt">
					  
						
					    <input type="submit" onClick="sendit_5()" name="bi_skpd" value="Lanjut" />
					    <input type="reset"name="reset" onClick="sendit_6()" value="Bersihkan Filter" />
					    <hr size="0.5pt">
					</td>
				    </tr>
				</table>
				<hr>
				    
				<table cellspacing="6">
				    <tr>
					<td>Tanggal Cetak Report</td>
					<td><input type="text"  input id="tanggal3" name="cdi_bukuskpd_tglreport" value="" ></td>
					<td>(format tanggal : dd/mm/yyyy)</td>
				    </tr>
				</table>
				
				<input type="hidden" name="menuID" value="14">
				<input type="hidden" name="mode" value="1">
				<input type="hidden" name="tab" value="3">
				
			    </form>
			</div>
			
			<div class="tabbertab">
			    <form name="form" method="POST" action="<?php echo "$url_rewrite/report/template/PEROLEHAN/report_perolehanaset_cetak_rekapitulasibukuinventarisSKPD.php"; ?>">
			    
				<h2>Rekapitulasi Buku Inventaris SKPD</h2>
				<strong>Rekapitulasi Buku Inventaris SKPD</strong>
				
				<table border="0" width=10%  cellspacing="6">
				    <tr>
					<td width=10%>
					    <tr>
						<td width=8%>Tahun</td>
						<td width=10%><input name="tahun_rekap_buku_inventaris_skpd" type="text" value="<?php echo date('Y')?>"></td>
					</tr>
				</table>
				<table>
				    <tr>
					<td colspan=2>Nama Skpd </td>
					<td>
					    <input type="hidden" name="idgetkelompok" id="idgetkelompok" value="">
					    <input type="text" name="lda_skpd4" id="lda_skpd4" style="width:480px;"readonly="readonly"value="<?php echo $_SESSION['ses_satkername'] ; ?>">
					    <input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok"value="Pilih"onclick = "showSpoiler(this);">
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
					</td>
				    </tr>
				</table>
				    
				<table>
				    <tr>
					<td align="left" valign="top"><hr size="0.5pt">
					    <input type="submit" onClick="sendit_5()" name="rbi_skpd"value="Lanjut" />
					    <input type="reset"name="reset" onClick="sendit_6()" value="Bersihkan Filter" />
					    <hr size="0.5pt">
					</td>
				    </tr>
				</table>
				
				<hr>
				<table cellspacing="6">
				    <tr>
					<td>Tanggal Cetak Report</td>
					<td><input type="text"  input id="tanggal4"  name="cdi_rekskpd_tglreport" value="" ></td>
					<td>(format tanggal : dd/mm/yyyy)</td>
				    </tr>
				</table>
                        <input type="hidden" name="menuID" value="14">
						<input type="hidden" name="mode" value="1">
						<input type="hidden" name="tab" value="4">
			    </form>
			</div>
			
			<div class="tabbertab">
			    <form name="form" method="POST" action="<?php echo "$url_rewrite/report/template/PEROLEHAN/induk.php"; ?>">
				<h2>Buku Induk Inventaris Daerah</h2>
				<br>
				Buku Induk Inventaris Daerah
				<br>
				<table border="0" width=10%  cellspacing="6">
				<tr>
					<td width=10%>
					    <tr>
						<td width=8%>Tahun</td>
						<td width=10%><input name="tahun_buku_induk_inventaris" type="text" value="<?php echo date('Y')?>"></td>
				</tr>
				</table>
				<table cellspacing="6">
				<tr>
					<td colspan="2">Kelompok</td>
				
					<td>
						<input type="text" name="lda_kelompok2" id="lda_kelompok2" style="width:450px;" readonly="readonly" value="" placeholder="(Semua Kelompok)">
						<input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" value="Pilih" onclick = "showSpoiler(this);"><font size="1" color="grey"><i>&nbsp;</i></font>
						<div class="inner" style="display:none;">
							<style>
								.tabel th {
									background-color: #eeeeee;
									border: 1px solid #dddddd;
								}
								.tabel td {
									border: 1px solid #dddddd;
								}
							</style>
							<?php
								$alamat_simpul_kelompok="$url_rewrite/function/dropdown/radio_simpul_kelompok.php";
								$alamat_search_kelompok="$url_rewrite/function/dropdown/radio_search_kelompok.php";
								js_radiokelompok($alamat_simpul_kelompok, $alamat_search_kelompok,"lda_kelompok2","kelompok_id2",'kelompok2','ldakelompokfilter2');
								$style="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
								radiokelompok($style,"kelompok_id2",'kelompok2','ldakelompokfilter2');
							?>
						</div>
					</td>
				</tr>
				</table>
				
				<hr>	
				<table cellspacing="6">
				    <tr>
					<td align="left" valign="top">
					    <hr size="0.5pt">

						
					    <input type="submit" name="bi_inventaris_daerah"onClick="sendit_5()" value="Lanjut" />
					    <hr size="0.5pt">
					</td>
				    </tr>
				</table>
				<table cellspacing="6">
				    <tr>
					<td>Tanggal Cetak Report</td>
					<td><input type="text"  input id="tanggal6" name="cdi_biid_tglreport" value=""></td>
					<td>(format tanggal dd/mm/yy)</td>
				    </tr>
				</table>	
                        <input type="hidden" name="menuID" value="14">
						<input type="hidden" name="mode" value="1">
						<input type="hidden" name="tab" value="5">
			    </form>
			</div>
			
			<div class="tabbertab">
			    <form name="form" method="POST" action="<?php echo "$url_rewrite/report/template/PEROLEHAN/report_perolehanaset_cetak_rekapitulasibukuindukinventarisdaerah.php"; ?>">
				<h2>Rekapitulasi Buku Induk Inventaris Daerah</h2>
				<br>
				Rekapitulasi Buku Induk Inventaris Daerah
				<table border="0" width=10%  cellspacing="6">
				    <tr>
					<td width=10%>
					    <tr>
						<td width=8%>Tahun</td>
						<td width=10%><input name="tahun_rekap_buku_induk_inventaris" type="text" value="<?php echo date('Y')?>"></td>
					</tr>
					
				</table>
				<hr>	
				<table>
				    <tr>
					<td align="left" valign="top">
					    <hr size="0.5pt"> 
					    <input type="submit" name="rekap_bi_inventaris_daerah" onClick="sendit_5()" name="biid"value="Lanjut" />
					    <hr size="0.5pt">
					</td>
				    </tr>    
				</table>
				<table>
				    <tr>
					<td>Tanggal Cetak Report</td>
					<td><input  input id="tanggal5"  name="cdi_rbiid_tglreport" value=""></td>
					<td>(format tanggal dd/mm/yy)</td>
				    </tr>
				</table>	
						<input type="hidden" name="menuID" value="14">
						<input type="hidden" name="mode" value="1">
						<input type="hidden" name="tab" value="6">
			    </form>
			</div>

			
		    </div>

		</div>
	    </div>
	</div> 
    </div>
</div> 
</body>
<?php
include"$path/footer.php";
?>
</html>
