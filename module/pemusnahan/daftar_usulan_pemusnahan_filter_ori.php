<?php
    include  "../../config/config.php";
    include"$path/header.php";
    include"$path/title.php";
    
    
        $menu_id = 46;
        $SessionUser = $SESSION->get_session_user();
        ($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
        $USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);
		
		$resetDataView = $DBVAR->is_table_exists('pemusnahan_filter_'.$SessionUser['ses_uoperatorid'], 0);
?>
<html>
                    <script type="text/javascript" src="<?php echo "$url_rewrite";?>/JS/script.js"></script>
                    <script type="text/javascript" src="<?php echo "$url_rewrite";?>/JS2/tabel.js"></script>
                    <script type="text/javascript" src="<?php echo "$url_rewrite";?>/JS2/simbada.js"></script>
                    <script type="text/javascript" src="<?php echo "$url_rewrite";?>/JS2/simbada.js"></script>
                    <script type="text/javascript" src="<?php echo "$url_rewrite";?>/JS/ajax_checkbox.js"></script>
                    <script type="text/javascript" src="<?php echo "$url_rewrite";?>/JS/jquery.min.js"></script>

	<script type="text/javascript">
		function show_confirm()
		{
		var r=confirm("Tidak ada data yang dijadikan filter? \n Seluruh isian filter kosong.");
		if (r==true)
		  {
		  alert("Pencarian data aset akan dilakukan");
		  //document.location="daftar_usulan_pemusnahan_lanjut.php";
                                        document.forms[0].submit();
		  }
		else
		  {
		  alert("Membatalkan pencarian data aset");
		  document.location="daftar_usulan_pemusnahan_filter.php";
		  }
		}
	</script>
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
                                                            Daftar Usulan Pemusnahan
                                                    </div>
                                                            <div id="bottomright">
                                                                <u>Seleksi Pencarian :</u>
                                                                <form method="POST" action="<?php echo "$url_rewrite/module/pemusnahan/"; ?>daftar_usulan_pemusnahan_lanjut.php?pid=1">
                                                                    <table width='100%'>
                                                                        <tr>
                                                                            <td>ID Aset (System ID)</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><input type='text' size='30px' name="buph_idaset" placeholder="Isi Aset ID..."/></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Nama Aset</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><input type='text' size='100px' name="buph_namaaset" placeholder="Isi Nama Aset..."/></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Nomor Kontrak</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><input type='text' size='30px' name="buph_nokontrak" placeholder="Isi Nomor Kontrak..."/></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Tahun Perolehan</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><input type='text' size='10px' name="buph_tahun" placeholder="Isi Tahun..."/></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Kelompok<br>
                                                                                    <input type="text" name="pem_kelompok" id="pem_kelompok" style="width:450px;" readonly="readonly" value="">
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
																							js_radiokelompok($alamat_simpul_kelompok, $alamat_search_kelompok,"pem_kelompok","kelompok_id",'kelompok','pemkelompokfilter');
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
                                                                            <input type="text" name="pem_lokasi" id="pem_lokasi" style="width:450px;" readonly="readonly" value="">
                                                             <input type="button" name="idbtnlookuplokasi" id="idbtnlookuplokasi" value="Pilih" onclick = "showSpoiler(this);">
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
                                                                                   // include "$path/function/dropdown/radio_function_lokasi_pengadaan.php";
                                                                                    $alamat_simpul_lokasi="$url_rewrite/function/dropdown/radio_simpul_lokasi_pengadaan.php";
                                                                                    $alamat_search_lokasi="$url_rewrite/function/dropdown/radio_search_lokasi_pengadaan.php";

                                                                                    js_radiopengadaanlokasi($alamat_simpul_lokasi, $alamat_search_lokasi,"pem_lokasi","lokasi_id",'lokasi','p_provinsi','p_kabupaten','p_kecamatan','p_desa','lok');
                                                                                    $style1="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
                                                                                    radiopengadaanlokasi($style1,"lokasi_id",'lokasi',"lok");
                                                                                                ?>

                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><br>
                                                                                <hr/>
                                                                                    <a href='#'><input type='submit' value='Lanjut' name="submit"/></a>
                                                                                <hr/>
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
