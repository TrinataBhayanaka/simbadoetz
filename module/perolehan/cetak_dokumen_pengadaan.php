<?php
include "../../config/config.php";

$USERAUTH = new UserAuth();

$SESSION = new Session();

$menu_id = 13;
$SessionUser = $SESSION->get_session_user();
$USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);

?>


<html>
    <?php
    include"$path/header.php";
    ?>
    <body>
        <div id="content">
                <?php
                include"$path/title.php";
                include"$path/menu.php";
                ?>
                  <script type="text/javascript" src="<?php echo "$url_rewrite"?>/JS/jquery.min.js"></script>                     <!-- end TAnggal-->
    <script type="text/javascript" src="<?php echo "$url_rewrite"?>/JS/jquery-ui.min.js"></script>                 <!-- end TAnggal-->                  
    <script type="text/javascript" src="<?php echo "$url_rewrite"?>/JS/jquery.ui.datepicker-id.js"></script>    <!-- end TAnggal-->
<script type="text/javascript" src="<?php echo "$url_rewrite"?>/JS/tabel.js"></script>

<script type="text/javascript" src="<?php echo "$url_rewrite"?>/JS/script.js"></script>


                    <div id="tengah1">
                         <div id="frame_tengah1">
                             <div id="frame_gudang">
                                        <div id="topright">
                                            Cetak Dokumen Pengadaan
                                        </div>
                                        <div id="bottomright">
                                              
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
                                                            }
                                                    );
                                                    <!-- end TAnggal-->
                                                </script>
                                           
                                           
<div class="tabber">
	<div class="tabbertab">
		<form method="post" name="form" action="<?php echo "$url_rewrite/report/template/PEROLEHAN/report_perolehanaset_cetak_daftarpengadaanBMD.php"; ?>">
			<h2>Pengadaan BMD</h2>
			<p><br><h1>Daftar Pengadaan BMD</h1><br>
				<table width="100%" style="padding:2px; margin-top:0px; border: 1px solid #004933;" cellspacing="6">
				<tr>
					<td>
						<table width="100%">
							<tr>
								<td>Periode</td>
								<td><input type="checkbox" name="check_peng" value="1">
								<td>
								<input id="tanggal14" type="text" name="tglawal" value="01/01/<?php echo date ("Y");?>" style="text-align:center">&nbsp;sampai&nbsp;<input id="tanggal15"type="text" name="tglakhir" value="31/12/<?php echo date ("Y");?>" style="text-align:center">( format tanggal : dd/mm/yyyy )
								</td>
							</tr>
						</table>
						<table width="100%">
							<tr>
								<td>SKPD</td>
								<td><input type="text" name="lda_skpd" id="lda_skpd" style="width:450px;" readonly="readonly" placeholder="<?php echo $_SESSION['ses_satkername'] ; ?>">
									<input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" value="Pilih" onclick = "showSpoiler(this);">
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
										//include "$path/function/dropdown/function_skpd.php";

										$alamat_simpul_skpd="$url_rewrite/function/dropdown/radio_simpul_skpd.php";
										$alamat_search_skpd="$url_rewrite/function/dropdown/radio_search_skpd.php";
										js_radioskpd($alamat_simpul_skpd, $alamat_search_skpd,"lda_skpd","skpd_id8",'skpd8','sk8');
										$style2="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
										radioskpd($style2,"skpd_id8",'skpd8','sk8');

										?>
									</div>
								</td>
							</tr>
						</table>
						&nbsp;
						<hr>
						<table>
							<tr>
								<td>
								<input type="submit" name="pengadaanbmd" value="Lanjut" />&nbsp;
								<input type="reset" name="reset" value="Bersihkan Filter" />
								</td>  
							</tr>
						</table>
						<hr>
						&nbsp;
						<table cellspacing="6">
							<tr>
								<td>Tanggal Cetak Report</td>
								<td>
									<input type="text" input id="tanggal8" name="cdp_cetak_bmdreport" value="" >(format tanggal : dd/mm/yyyy)
								</td>
							</tr>
						</table>
							<input type="hidden" name="menuID" value="13">
							<input type="hidden" name="mode" value="1">
							<input type="hidden" name="tab" value="1">
						</td>
						</tr> 
						</table>
						</form>
						</div>


	<div class="tabbertab">
		<form name="form" method="POST" action="<?php echo "$url_rewrite/report/template/PEROLEHAN/report_perolehanaset_cetak_rekapitulasidaftarhasilpengadaanBMD.php"; ?>">
			<h2>Rekapitulasi Pengadaan BMD</h2>
			<p><br><h1>Rekapitulasi Daftar Hasil Pengadaan BMD</h1><br>

<table width="100%" style="padding:2px; margin-top:0px; border: 1px solid #004933;" cellspacing="6">
<tr><td>			
<table width="100%">
	<tr>
		<td>Periode</td>
		<td><input type="checkbox" name="check_peng_bmd" value="1">
		<input type="text" id="tanggal12"  name="cdp_rekap_bmdperiode1" value="01/01/<?php echo date ("Y");?>" style="text-align:center">&nbsp;sampai&nbsp;<input id="tanggal13" type="text" name="cdp_rekap_bmdperiode2"value="31/12/<?php echo date ("Y");?>" style="text-align:center">( format tanggal : dd/mm/yyyy )
		</td>
	</tr>
</table>	
<table width="100%">
	<tr>
		<td>SKPD</td>
		<td>
		<input type="text" name="kelompok2" id="idkelompok9" style="width:450px;" readonly="readonly" placeholder="<?php echo $_SESSION['ses_satkername'] ; ?>">
		<input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" value="Pilih" onclick = "showSpoiler(this);">
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
$alamat_simpul_skpd="$url_rewrite/function/dropdown/radio_simpul_skpd.php";
$alamat_search_skpd="$url_rewrite/function/dropdown/radio_search_skpd.php";
js_radioskpd($alamat_simpul_skpd, $alamat_search_skpd,"idkelompok9","skpd_id9",'skpd9','sk9');
$style2="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
radioskpd($style2,"skpd_id9",'skpd9','sk9');
?>        
</div>
</td>
</tr>
</table>

<hr>
<table>
	<tr>                  
		<td></td>
		<td><input type="submit" value="Lanjut" name="rekappengadaanbmd"/> &nbsp;
		<input type="reset" name="reset" value="Bersihkan Filter" />
		</td>
		<td></td>
	</tr>
</table>
<hr>
<table>
	<tr>
		<td colspan=2><hr></td>
	</tr>
</table>

<table>
	<tr>
		<td>Tanggal Cetak Report</td>
		<td>
		<input type="text" input id="tanggal1" name="cdp_rekap_cetakreport" value="" >(format tanggal : dd/mm/yyyy)
		</td>
	</tr>

</table>
</td></tr>
</table>
<input type="hidden" name="menuID" value="13">
<input type="hidden" name="mode" value="1">
<input type="hidden" name="tab" value="2">
</form>
</div>



<div class="tabbertab">
<form name="form" method="POST" action="<?php echo "$url_rewrite/report/template/PEROLEHAN/report_perolehanaset_cetak_daftarhasilpemeliharaanBMD.php"; ?>">
<h2>Pemeliharaan BMD</h2>
<p><br><h1>Daftar Hasil Pemeliharaan BMD</h1><br>

<table width="100%" style="padding:2px; margin-top:0px; border: 1px solid #004933;" cellspacing="6">
<tr><td>

<table width="100%">
	<tr>
		<td>Periode</td>
		<td><input type="checkbox" name="check_pml" value="1">
		<td><input id="tanggal10" type="text" name="cdp_pembmd_periode1" value="01/01/<?php echo date ("Y");?>" style="text-align:center">&nbsp;sampai&nbsp;<input id="tanggal9"type="text" name="cdp_pembmd_periode2" value="31/12/<?php echo date ("Y");?>" style="text-align:center">( format tanggal : dd/mm/yyyy )</td>
	</tr>
</table>

<table width="100%">
	<tr>
		<td>SKPD</td>
		<td>
			<input type="text" name="kelompok2" id="idkelompok10" style="width:450px;" readonly="readonly" value="<?php echo $_SESSION['ses_satkername'] ; ?>">
			<input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" value="Pilih" onclick = "showSpoiler(this);">
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
$alamat_simpul_skpd="$url_rewrite/function/dropdown/radio_simpul_skpd.php";
$alamat_search_skpd="$url_rewrite/function/dropdown/radio_search_skpd.php";
js_radioskpd($alamat_simpul_skpd, $alamat_search_skpd,"idkelompok10","skpd_id10",'skpd10','sk10');
$style2="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
radioskpd($style2,"skpd_id10",'skpd10','sk10');
?>        
</div>
</td>
</tr>
</table>

<hr>
<table>
	<tr>
		<td>
			<input type="submit" value="Lanjut" name="pemeliharaanbmd"/>&nbsp;
			<input type="reset" name="reset" value="Bersihkan Filter" />
		</td>
	</tr>
</table>

<hr>

<table>
	<tr>
		<td colspan=2><hr></td>
	</tr>
</table>

<table>
	<tr>
		<td>Tanggal Cetak Report</td>
		<td>
			<input type="text" input id="tanggal7" name="cdp_pembmd_cetakreport" value="" >(format tanggal : dd/mm/yyyy)
		</td>
	</tr>

</table>
</td></tr>
</table>
<input type="hidden" name="menuID" value="13">
<input type="hidden" name="mode" value="1">
<input type="hidden" name="tab" value="3">
</form>
</div>


                                                     
<div class="tabbertab">
<form name="form" method="POST" action="<?php echo "$url_rewrite/report/template/PEROLEHAN/report_perencanaan_cetak_rekapitulasi_pemeliharaan_bmd.php"; ?>">
<h2>Rekapitulasi Pemeliharaan BMD</h2>
<p><br><h1>Rekapitulasi Daftar Hasil Pemeliharaan BMD</h1><br>

<table width="100%" style="padding:2px; margin-top:0px; border: 1px solid #004933;" cellspacing="6">
<tr><td>

<table width="100%">
	<tr>
		<td>Periode</td>
		<td><input type="checkbox" name="check_rkp_pml" value="1">
		<td><input type="text" input id="tanggal6" name="cdi_rekpembmd_periode1"value="01/01/<?php echo date ("Y");?>" style="text-align:center">&nbsp;sampai&nbsp;<input type="text" input id="tanggal5"name="cdi_rekpembmd_periode2"value="31/12/<?php echo date ("Y");?>" style="text-align:center">( format tanggal : dd/mm/yyyy )</td>
	</tr>
</table>

<table width="100%">
	<tr>
		<td>SKPD</td>
		<td>
			<input type="text" name="kelompok2" id="idkelompok11" style="width:450px;" readonly="readonly" placeholder="<?php echo $_SESSION['ses_satkername'] ; ?>">
			<input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" value="Pilih" onclick = "showSpoiler(this);">
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
$alamat_simpul_skpd="$url_rewrite/function/dropdown/radio_simpul_skpd.php";
$alamat_search_skpd="$url_rewrite/function/dropdown/radio_search_skpd.php";
js_radioskpd($alamat_simpul_skpd, $alamat_search_skpd,"idkelompok11","skpd_id11",'skpd11','sk11');
$style2="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
radioskpd($style2,"skpd_id11",'skpd11','sk11');
?>        
</div>
		</td>
	</tr>
</table>

<hr>

<table>
	<tr>
		<td>
			<input type="submit" value="Lanjut" name="rekappemeliharaanbmd"/>&nbsp;
			<input type="reset" name="reset" value="Bersihkan Filter" />
		</td>
	</tr>
</table>

<hr>

<table>
	<tr>
		<td colspan=2></td>
	</tr>
</table>

<table>
	<tr>
		<td>Tanggal Cetak Report</td>
		<td>
			<input type="text" input id="tanggal4" name="cdi_rekpembmd_cetakreport" value="" >(format tanggal : dd/mm/yyyy)
		</td>
	</tr>
</table>

</td></tr>
</table>
<input type="hidden" name="menuID" value="13">
<input type="hidden" name="mode" value="1">
<input type="hidden" name="tab" value="4">
</form>
</div>

                                                        
<div class="tabbertab">
<form method="post" name="form" action="<?php echo "$url_rewrite/report/template/PEROLEHAN/report_perolehanaset_cetak_daftarbarangdaripihakketiga.php";?>">

<h2>Barang Dari Pihak III </h2>
<p><br><h1>Daftar Penerimaan Barang Dari Pihak Ketiga (Hibah)</h1><br>

<table width="100%" style="padding:2px; margin-top:0px; border: 1px solid #004933;" cellspacing="6">
<tr><td>

<table width="100%">
	<tr>
		<td>Periode</td>
		<td><input type="checkbox" name="check_phk_3" value="1">
		<td><input type="text" input id="tanggal6" name="cdi_rekpembmd_periode1"value="01/01/<?php echo date ("Y");?>" style="text-align:center">&nbsp;sampai&nbsp;<input type="text" input id="tanggal5"name="cdi_rekpembmd_periode2"value="31/12/<?php echo date ("Y");?>" style="text-align:center">( format tanggal : dd/mm/yyyy )</td>
	</tr>
</table>

<table width="100%">
	<tr>
		<td>SKPD</td>
		<td>
			<input type="text" name="kelompok2" id="idkelompok6" style="width:450px;" readonly="readonly" placeholder="<?php echo $_SESSION['ses_satkername'] ; ?>">
			<input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" value="Pilih" onclick = "showSpoiler(this);">
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
$alamat_simpul_skpd="$url_rewrite/function/dropdown/radio_simpul_skpd.php";
$alamat_search_skpd="$url_rewrite/function/dropdown/radio_search_skpd.php";
js_radioskpd($alamat_simpul_skpd, $alamat_search_skpd,"idkelompok6","skpd_id",'skpd6','sk6');
$style2="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
radioskpd($style2,"skpd_id",'skpd6','sk6');
?>  
      
</div>
		</td>
	</tr>
</table>

<hr>

<table>
	<tr>
		<td>
			<input type="submit" value="Lanjut" name="barangpihak3"/>&nbsp;
			<input type="reset" name="reset" value="Bersihkan Filter" />
		</td>
	</tr>
</table>

<hr>

<table>
	<tr>
		<td colspan=2></td>
	</tr>
</table>

<table>
	<tr>
		<td>Tanggal Cetak Report</td>
		<td>
			<input type="text" input id="tanggal3"name="cdi_pihak3_cetakreport" value="" >(format tanggal : dd/mm/yyyy)
		</td>
	</tr>
</table>
<input type="hidden" name="menuID" value="13">
<input type="hidden" name="mode" value="1">
<input type="hidden" name="tab" value="5">
</td></tr>
</table>
</form>          
</div>

<div class="tabbertab">
<form method="post" name="form" action="<?php echo "$url_rewrite/report/template/PEROLEHAN/report_perencanaan_cetak_rekapitulasi_penerimaan_pihak_ketiga_bmd.php";?>">

    <h2>Rekapitulasi Barang Dari Pihak III</h2>
<p><br><h1>Rekapitulasi Daftar Penerimaan Barang Dari Pihak Ketiga (Hibah)</h1><br>

<table width="100%" style="padding:2px; margin-top:0px; border: 1px solid #004933;" cellspacing="6">
<tr><td>
<table width="100%">
	<tr>
		<td>Periode</td>
		<td><input type="checkbox" name="check_rkp_phk_3" value="1">
		<td>
		<input type="text" id="tanggal16"  name="tanggalawal_rekap_3" value="01/01/<?php echo date ("Y");?>" style="text-align:center">&nbsp;sampai&nbsp;<input id="tanggal17" type="text" name="tanggalakhir_rekap_3"value="31/12/<?php echo date ("Y");?>" style="text-align:center">( format tanggal : dd/mm/yyyy )
		</td>
	</tr>
</table>
<table>
	<tr>
		<td>SKPD</td>
		<td>
			<input type="text" name="kelompok2" id="idkelompok7" style="width:450px;" readonly="readonly" placeholder="<?php echo $_SESSION['ses_satkername'] ; ?>">
			<input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" value="Pilih" onclick = "showSpoiler(this);">
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
$alamat_simpul_skpd="$url_rewrite/function/dropdown/radio_simpul_skpd.php";
$alamat_search_skpd="$url_rewrite/function/dropdown/radio_search_skpd.php";
js_radioskpd($alamat_simpul_skpd, $alamat_search_skpd,"idkelompok7","skpd_id7",'skpd7','sk7');
$style2="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
radioskpd($style2,"skpd_id7",'skpd7','sk7');
?>   
     
</div>
		</td>
	</tr>
</table>

<hr>

<table>
	<tr>
		<td>
			<input type="submit" value="Lanjut" name="rekapbarangpihak3"/>&nbsp;
			<input type="reset"name="reset" value="Bersihkan Filter" />
		</td>
	</tr>
</table>

<hr>

<table>
	<tr>
		<td colspan=2></td>
	</tr>
</table>

<table>
	<tr>
		<td>Tanggal Cetak Report</td>
		<td>
			<input type="text" input id="tanggal2"name="cdi_rekpembmd_cetakreport" value="" >(format tanggal : dd/mm/yyyy)
		</td>
	</tr>
</table>

</td></tr>
</table>
<input type="hidden" name="menuID" value="13">
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
        </div>
                        
        <?php
        include"$path/footer.php";
        ?>
    </body>
</html>
