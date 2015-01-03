<?php
	include "../../config/config.php";
                  include"$path/header.php";
	include"$path/title.php";
        
        $menu_id = 38;
        $SessionUser = $SESSION->get_session_user();
        ($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
        $USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);
		
		$resetDataView = $DBVAR->is_table_exists('penghapusan_filter_'.$SessionUser['ses_uoperatorid'], 0);
        
?>
<html>
	<script type="text/javascript" src="<?php echo "$url_rewrite";?>/JS2/script.js"></script>
	<script type="text/javascript" src="<?php echo "$url_rewrite";?>/JS2/tabel.js"></script>
	<script type="text/javascript" src="<?php echo "$url_rewrite";?>/JS2/simbada.js"></script>
	<script type="text/javascript" src="<?php echo "$url_rewrite";?>/JS2/simbada.js"></script>
                    <script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/jquery.min.js"></script>
                    <script type="text/javascript" src="<?php echo "$url_rewrite/";?>JS/ajax_checkbox.js"></script>
	<!--<script type="text/javascript">
		function show_confirm()
		{
		var r=confirm("Tidak ada data yang dijadikan filter? Seluruh isian filter kosong.");
		if (r==true)
		  {
		  alert("You pressed OK!");
		  //document.location="daftar_usulan_penghapusan_lanjut.php";
                                        document.forms[0].submit();
		  }
		else
		  {
		  alert("You pressed Cancel!");
		  document.location="daftar_usulan_penghapusan_filter.php";
		  }
		}
	</script>-->
		<!--[if IE]>
		<link rel="stylesheet" type="text/css" href="ie_office.css" />
		<![endif]-->

	<body>
	
	<div id="content">
	<?php
		include"$path/menu.php";
	?>
    </div>			
	<div id="tengah1">	
		<div id="frame_tengah1">
			<div id="frame_gudang">
				<div id="topright">
						Daftar Usulan Penghapusan
				</div>
				<div id="bottomright">
					<u>Seleksi Pencarian :</u>
					<form method="POST" action="<?php echo"$url_rewrite"?>/module/penghapusan/daftar_usulan_penghapusan_lanjut.php?pid=1">
					<table>
						<tr> 
							<td>ID Aset (System ID)</td>
						</tr>
						<tr>
							<td><input type='text' style="width: 200px;" name="bup_idaset" placeholder=""/></td>
						</tr>
						<tr> 
							<td>Nama Aset</td>
						</tr>
						<tr>
							<td><input type='text' style="width: 480px;" name="bup_namaaset" placeholder=""/></td>
						</tr>
						<tr> 
							<td>Nomor Kontrak</td>
						</tr>
						<tr>
							<td><input type='text' style="width: 200px;" name="bup_nokontrak" placeholder=""/></td>
						</tr>
						<tr> 
							<td>Tahun Perolehan</td>
						</tr>
						<tr>
							<td><input type='text'  name="bup_tahun" placeholder=""/></td>
						</tr>
						 <tr> 
							<td>Kelompok<br>
									<input type="text" name="lda_kelompok" id="lda_kelompok"style="width:480px;"readonly="readonly" placeholder="">
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
													//include "$path/function/dropdown/function_kelompok.php";
													$alamat_simpul_kelompok="$url_rewrite/function/dropdown/radio_simpul_kelompok.php";
													$alamat_search_kelompok="$url_rewrite/function/dropdown/radio_search_kelompok.php";
													js_radiokelompok($alamat_simpul_kelompok, $alamat_search_kelompok,"lda_kelompok","kelompok_id",'kelompok','pemkelompokfilter');
													$style="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
													radiokelompok($style,"kelompok_id",'kelompok','pemkelompokfilter');
												?>
									</div>
							</td>
						</tr>
						<tr>
							<td>
							<table border=0 cellspacing="6" style="display: none">
                                                <tr>
                                                    <td>Desa</td>
                                                    <td>Kecamatan</td> 
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <input type="text" id="p_desa" name="p_desa" value="" size="45"  readonly="readonly">
                                                    </td>
                                                    <td>
                                                        <input type="text" id="p_kecamatan" name="p_kecamatan" value="" size="45" readonly="readonly" >
                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td>Kabupaten</td>
                                                    <td>Provinsi</td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <input type="text" id="p_kabupaten" name="p_kabupaten" value=""size="45" readonly="readonly" >
                                                    </td>
                                                    <td>
                                                        <input type="text" id="p_provinsi" name="p_provinsi" value=""size="45" readonly="readonly" >
                                                    </td>
                                                    <td></td>
                                                </tr>
                                            </table>
                                            
							</td>
						</tr>
						<tr>
							<td>Lokasi<br>
								<input type="text" name="lda_lokasi" id="lda_lokasi" style="width:480px;" readonly="readonly" placeholder="">
								<input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok"value="Pilih"onclick = "showSpoiler(this);">
									<div class="inner" style="display:none;">
                                      <?php
									   // include "$path/function/dropdown/radio_function_lokasi_pengadaan.php";
										$alamat_simpul_lokasi="$url_rewrite/function/dropdown/radio_simpul_lokasi_pengadaan.php";
										$alamat_search_lokasi="$url_rewrite/function/dropdown/radio_search_lokasi_pengadaan.php";

										js_radiopengadaanlokasi($alamat_simpul_lokasi, $alamat_search_lokasi,"lda_lokasi","lokasi_id",'lokasi','p_provinsi','p_kabupaten','p_kecamatan','p_desa','lok');
										$style1="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
										radiopengadaanlokasi($style1,"lokasi_id",'lokasi',"lok");
										?>

									</div>
							</td>
						</tr>
						<tr>
							<td> SKPD<br>
							<input type="text" name="lda_skpd" id="lda_skpd" style="width:480px;" readonly="readonly" placeholder="" value="<?php echo $_SESSION['ses_satkername'] ; ?>">
							<input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok"value="Pilih" onclick = "showSpoiler(this);">
								<div class="inner" style="display:none;">
                                                <?php
													//include "$path/function/dropdown/function_skpd.php";
													$alamat_simpul_skpd="$url_rewrite/function/dropdown/radio_simpul_skpd.php";
													$alamat_search_skpd="$url_rewrite/function/dropdown/radio_search_skpd.php";
													js_radioskpd($alamat_simpul_skpd, $alamat_search_skpd,"lda_skpd","skpd_id",'skpd','pemskpdfilter');
													$style2="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
													radioskpd($style2,"skpd_id",'skpd','pemskpdfilter');
												?>

								</div>
							</td>
						</tr>
						<!--<tr>
							<td>NGO<br>
								<input type="text" name="lda_ngo" id="lda_ngo" style="width:480px;" readonly="readonly" placeholder="(semua NGO)">
								<input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" value="Pilih" onclick = "showSpoiler(this);">
									<div class="inner" style="display:none;">
                                      <?php
													//include "$path/function/dropdown/function_ngo.php";
													/*$alamat_simpul_ngo="$url_rewrite/function/dropdown/radio_simpul_ngo.php";
													$alamat_search_ngo="$url_rewrite/function/dropdown/radio_search_ngo.php";
													js_radiongo($alamat_simpul_ngo, $alamat_search_ngo,"lda_ngo","ngo_id",'ngo','pemngofilter');
													$style3="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
													radiongo($style3,"ngo_id",'ngo','pemngofilter');*/
												?>
									</div>
							</td>
							</tr>-->
							<tr>
								<td>
									<input type='submit' name='tampil' value='Lanjut'/>
								</td>
							</tr>
					</table>
					</form>
				</div>
			</div>
		</div>
	</div>
                    
	<?php
		include"$path/footer.php";
	?>
    </body>
</html>	
