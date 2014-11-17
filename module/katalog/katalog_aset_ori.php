<html>
    <?php
           
           include "../../config/config.php";
           include "$path/header.php";
           include "$path/title.php";
           
            $menu_id = 51;
            $SessionUser = $SESSION->get_session_user();
            ($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
            $USERAUTH->FrontEnd_check_akses_menu($menu_id, $Session);

            
            
    ?>
    <body>
        <?php
        include "$path/menu.php";
        ?>

            <!edit content!>
        <div id="tengah1">	
        <div id="frame_tengah1">
        <div id="frame_gudang">
        <div id="topright">Katalog Aset</div>
        <div id="bottomright">

        <!edit isi content!>
        
        <strong><u>Seleksi Pencarian:</u></strong>
        
        <form method="POST" action="<?php echo "$url_rewrite"?>/module/katalog/katalog_aset_informasi.php?pid=1" 
              name="katalog">

<table border="0" cellpadding="1" cellspacing="1" width="100%">
            <tr>
                <td style="height: 5px;"><!-- just give a space --></td>
            </tr>
            <tr>
                <td>ID Aset (System ID)<br>
                <input isdatepicker="true" style="width: 270px;" name="ka_id_aset" id="ka_id_aset" type="text"></td>
            </tr>
            <tr>
                <td>Nama Aset<br>
                <input isdatepicker="true" style="width: 270px;" name="ka_nama_aset" id="ka_nama_aset" type="text"></td>
            </tr>
            <tr>
                <td>Nomor Kontrak<br>
                <input isdatepicker="true" style="width: 270px;" name="ka_no_kontrak" id="ka_no_kontrak" type="text"></td>
            </tr>
            <tr>
                <td>Tahun Perolehan<br>
                <input isdatepicker="true" style="width: 90px;" name="ka_thn_perolehan" id="ka_thn_perolehan" maxlength="4" type="text"></td>
            </tr>
            <tr>
            <td>
                    Kelompok<br>

                        <input type="text" name="lda_kelompok" id="lda_kelompok"
                            style="width:480px;"readonly="readonly"  placeholder="(Semua Kelompok)">
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
			    $alamat_simpul_kelompok="$url_rewrite/function/dropdown/radio_simpul_kelompok.php";
                            $alamat_search_kelompok="$url_rewrite/function/dropdown/radio_search_kelompok.php";
                            js_radiokelompok($alamat_simpul_kelompok, $alamat_search_kelompok,"lda_kelompok","kelompok_id",'kelompok', 'kelompk');
			    $style="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
			    radiokelompok($style,"kelompok_id",'kelompok', 'kelompk');
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
                    <td>
                        Lokasi
                        <br>
						<!---->
                        <input type="text" name="entri_lokasi" id="entri_lokasi" style="width:480px;" readonly="readonly" placeholder="(Semua Lokasi)">
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
						<!---->    
                </td>
            </tr>

    <tr>
        <td>
                SKPD
                    <br>
                    <input type="text" name="lda_skpd" id="lda_skpd" style="width:480px;" readonly="readonly" placeholder="(Semua SKPD)" value="<?php echo $_SESSION['ses_satkername'] ; ?>">
					<input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" value="Pilih" onclick = "showSpoiler(this);">
						<div class="inner" style="display:none;">

						<div style="width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;">
							   
                       <?php
                            $alamat_simpul_skpd="$url_rewrite/function/dropdown/radio_simpul_skpd.php";
							$alamat_search_skpd="$url_rewrite/function/dropdown/radio_search_skpd.php";
							js_radioskpd($alamat_simpul_skpd, $alamat_search_skpd,"lda_skpd","skpd_id",'skpd1','sk');
							$style2="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
							radioskpd($style2,"skpd_id",'skpd1','sk');
			?>  
                       
            </div>
            </div>
        </td>
    </tr>


    <tr>
            <td>
                    NGO
                        <br>
                                <input type="hidden" name="idgetkelompok" id="idgetkelompok" placeholder="(Semua SKPD)">
                                <input type="text" name="lda_ngo" id="lda_ngo"style="width:480px;"readonly="readonly"value="(semua NGO)">
                                <input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" value="Pilih"onclick = "showSpoiler(this);">
                    <div class="inner" style="display:none;">
                    <div style="width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;">
                            
                            <?php
                            $alamat_simpul_ngo="$url_rewrite/function/dropdown/radio_simpul_ngo.php";
			    $alamat_search_ngo="$url_rewrite/function/dropdown/radio_search_ngo.php";
			    js_radiongo($alamat_simpul_ngo, $alamat_search_ngo,"lda_ngo","ngo_id",'ngo', 'ngo1');
			    $style="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
			    radiongo($style,"ngo_id",'ngo', 'ngo1');
			?>
                        
                    </div>

                            </div>
            </td>
    </tr>


    <tr>
    <td align="left" valign="top">
        <hr size="0.5pt">
                                            <script type="text/javascript">
                    function show_confirm()
                    {
                    var r=confirm("Tidak ada data yang dijadikan filter. Seluruh isian filter kosong");
                    if (r==true)
                            {
                                //document.location="katalog_aset_informasi.php";
                                //alert("Dokumen telah dicetak");
                                document.forms[0].submit();

                            }
                            else
                            {
                                document.location="katalog_aset.php";
                                //alert("Batal cetak dokumen");
                            }
                    }
                    </script>
                                                        <input type="submit" onclick="show_confirm()" value="Lanjut" name="submit"/>

                                                        <hr size="0.5pt">
                            </td>
                        </tr>
                    </table>
                </form>
                </div> 
            </div>
            </div>                           
        </div>


                <?php
                include "$path/footer.php";
                ?>
        </body>
</html>	
