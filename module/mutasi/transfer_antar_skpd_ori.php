<?php
    include "../../config/config.php";
    $USERAUTH = new UserAuth();

	$SESSION = new Session();

$menu_id = 22;
$SessionUser = $SESSION->get_session_user();
$USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);

    $resetDataView = $DBVAR->is_table_exists('filter_mutasi_'.$SessionUser['ses_uoperatorid'], 0);
?>

<html>
    <?php
     include "$path/header.php";
     ?>
	
   
    
    <!--buat date-->
    <script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/jquery-ui.min.js"></script> 
    <script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/jquery.ui.datepicker-id.js"></script>
    <script type="text/javascript" src="<?php echo "$url_rewrite/";?>JS/ajax_checkbox.js"></script>
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
        }
        );
    </script>   
    <link href="<?php echo "$url_rewrite/"; ?>css/jquery-ui.css" type="text/css" rel="stylesheet">
        
    <!--buat number only-->
    <style>
        #errmsg { color:red; }
        #errmsg2 { color:red; }
    </style>
    <!--
    <script src="../../JS/jquery-latest.js"></script>
    <script src="../../JS/jquery.js"></script>
    -->
    <script type="text/javascript">
        $(document).ready(function(){

            //called when key is pressed in textbox
                $("#posisiKolom").keypress(function (e)  
                { 
                //if the letter is not digit then display error and don't type anything
                if( e.which!=8 && e.which!=0 && (e.which<48 || e.which>57))
                {
                        //display error message
                        $("#errmsg").html("Hanya Bisa Input Angka").show().fadeOut("slow"); 
                    return false;
            }	
                });
        });
    </script>
   
 
	<body>
                    <div id="content">
                    <?php
                        include "$path/title.php";
                        include "$path/menu.php";
                    ?>
	
                        <div id="tengah1">	
                            <div id="frame_tengah1">
                                <div id="frame_gudang">
                                    <div id="topright">
                                        Transfer Antar SKPD
                                    </div>
                                    <div id="bottomright">
                                        
                                        <form name="form" method="POST" action="<?php echo "$url_rewrite/module/mutasi/"; ?>transfer_hasil_filter.php?pid=1">
                                        <script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/tabel.js"></script>
                                        <table>
                                            <strong>
												<u>Seleksi Pencarian:</u>
											</strong>
                                            <tr>			
                                                <td><label>ID Aset (System ID)</label><br>
                                                    <input type="text" placeholder="" name="mutasi_trans_filt_idaset"style="width: 200px;"/>
                                                </td>
                                            </tr>
                                            <tr>			
                                                <td><label>Nama Aset</label><br>
                                                    <input  type="text" placeholder="" style="width:480px;" name="mutasi_trans_filt_nmaset" style="width: 480px;"/>
                                                </td>
                                            </tr>
                                            <tr>			
                                                <td><label>Nomor Kontrak</label><br>
                                                    <input  type="text" placeholder="" name="mutasi_trans_filt_nokontrak" id="posisiKolom" style="width: 200px;"/>&nbsp;<span id="errmsg"></span>
                                                </td>
                                            </tr>
											<tr>			
                                                <td><label>Tahun Perolehan</label><br>
                                                    <input  type="text" placeholder="" name="mutasi_trans_filt_thn" id="" style=""/>&nbsp;<span id="errmsg"></span>
                                                </td>
                                            </tr>
											<tr>
														<td>
															Kelompok<br>
																<input type="text" name="pem_kelompok" id="pem_kelompok" style="width:480px;" readonly="readonly" value="">
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
														<td colspan=2>Lokasi</td>
                                                    </tr>
                                                    <tr>
														<td>
															<input type="text" name="entri_lokasi" id="entri_lokasi" style="width:480px;" readonly="readonly" placeholder="">
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
										</table>

                                        <table>
                                            <tr>
                                                <td>SKPD</td>
                                            </tr>
                                            <tr>	
                                                <td>
                                                    <input type="text" name="lda_skpd" id="lda_skpd" style="width:480px;" readonly="readonly" placeholder="(Semua SKPD)">
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
                                                            js_radioskpd($alamat_simpul_skpd, $alamat_search_skpd,"lda_skpd","skpd_id",'skpd','yuda');
                                                            $style2="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
                                                            radioskpd($style2,"skpd_id",'skpd','yuda');
                                                            ?>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>

                                        <table width="100%">	
                                            <tr>
                                                <td>
                                                    <input type="submit" name="transfer" value="Lanjut" />
                                                </td>
                                            </tr>
										</table>
									</form>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            
                    <div id="footer">Sistem Informasi Barang Daerah ver. 0.x.x <br />
			Powered by BBSDM Team 2012
                    </div>
	</body>
</html>	
