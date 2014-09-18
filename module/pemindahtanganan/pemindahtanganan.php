<?php
include "../../config/config.php";
include"$path/header.php";
include"$path/title.php";



$USERAUTH = new UserAuth();
$DBVAR = new DB();
$SESSION = new Session();

$menu_id = 42;
$SessionUser = $SESSION->get_session_user();
($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
$USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);

$resetDataView = $DBVAR->is_table_exists('pemindahtanganan_'.$SessionUser['ses_uoperatorid'], 0);


?>
<html>
    
   <body>
	<div id="content">
		
                        <?php
                            include"$path/menu.php";
                        ?>
                   </div>
                    </div>
                            <div id="tengah1">	
                                    <div id="frame_tengah1">
                                            <div id="frame_gudang">
                                                    <div id="topright">
                                                            Buat Usulan pemindahtanganan
                                                    </div>
                                                    <div id="bottomright">
                                                            <div align="left"><u style="font-weight: bold;" >Seleksi&nbsp;Pencarian&nbsp;:</u></div>
                                                            <form method="POST" action="<?php echo "$url_rewrite";?>/module/pemindahtanganan/daftar_pemindahtanganan_barang.php?pid=1"  name="usulan_pemindahtanganan" >
                                                                <table>
                                                                    <tr>
                                                                            <td>ID Aset (System ID)<br><input type="text" name="bupt_idaset" placeholder="" style="width:200px;" class="aset_id"></td>
                                                                    </tr>
                                                                    <tr>
                                                                            <td>Nama Aset<br><input type="text" name="bupt_namaaset" placeholder="" style="width:450px;" class="aset_name"></td>
                                                                    </tr>
                                                                    <tr>
                                                                            <td>Nomor Kontrak<br><input type="text" name="bupt_nokontrak" placeholder="" style="width:200px;" class="no_kontrak"></td>
                                                                    </tr>
                                                                     <tr>
                                                                            <td>Tahun Perolehan<br><input type="text" name="bupt_tahun" placeholder="" style="width:130px;" class="thn_perolehan"></td>
                                                                    </tr>
                                                                    <tr>
                                                                            <td>Kelompok<br>
                                                                                    <input type="text" name="lda_kelompok" id="lda_kelompok" style="width:450px;" readonly="readonly" placeholder="">
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
                                                                                                    $alamat_simpul_kelompok="$url_rewrite/function/dropdown/simpul_kelompok.php";
                                                                                                    $alamat_search_kelompok="$url_rewrite/function/dropdown/search_kelompok.php";
                                                                                                    js_radiokelompok($alamat_simpul_kelompok,
                                                                                                    $alamat_search_kelompok,"lda_kelompok","kelompok_id",'kelompok','yuda1');
                                                                                                    $style="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
                                                                                                    radiokelompok($style,"kelompok_id",'kelompok','yuda1');

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
																		<td colspan=2>Pilih Lokasi</td>
																	</tr>
																	<tr>
																		<td>
																			<input type="text" name="entri_lokasi" id="entri_lokasi" style="width:450px;" readonly="readonly" placeholder="">
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
																								js_radiopengadaanlokasi($alamat_simpul_lokasi, $alamat_search_lokasi,"entri_lokasi","lokasi_id",'lokasi','p_provinsi','p_kabupaten','p_kecamatan','p_desa','lok');
																								$style1="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
																								radiopengadaanlokasi($style1,"lokasi_id",'lokasi',"lok");
																								?>
																					</div>
													   
																		</td>
																	</tr>
                                                                      <tr>
                                                                            <td>SKPD<br>
                                                                                    <input type="text" name="lda_skpd" id="lda_skpd" style="width:450px;" readonly="readonly" placeholder="" value="<?php echo $_SESSION['ses_satkername'] ; ?>">
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
                                                                                                    $alamat_simpul_skpd="$url_rewrite/function/dropdown/simpul_skpd.php";
                                                                                                    $alamat_search_skpd="$url_rewrite/function/dropdown/search_skpd.php";
                                                                                                    js_radioskpd($alamat_simpul_skpd, $alamat_search_skpd,"lda_skpd","skpd_id",'skpd','yuda');
                                                                                                    $style2="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
                                                                                                    radioskpd($style2,"skpd_id",'skpd','yuda');
                                                                                                    ?>

                                                                                                    
                                                                                            </div>
                                                                                     </td>
                                                                                </tr>
                                                                            
                                                                    <tr>
                                                                            <td><input type="submit" name="tampil" value="Lanjut" ></td>
                                                                    </tr>
                                                            </table>
                                                          </form>      
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
