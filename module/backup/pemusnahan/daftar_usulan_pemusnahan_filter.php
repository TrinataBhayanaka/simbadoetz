<?php
    include  "../../config/config.php";
    include"$path/header.php";
    include"$path/title.php";
    
    
        $menu_id = 46;
        $SessionUser = $SESSION->get_session_user();
        ($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
        $USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);
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
                                                                            <td><input type='text' size='30px' name="buph_idaset"/></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Nama Aset</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><input type='text' size='100px' name="buph_namaaset"/></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Nomor Kontrak</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><input type='text' size='30px' name="buph_nokontrak"/></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Tahun Perolehan</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><input type='text' size='10px' name="buph_tahun"/></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Kelompok<br>
                                                                                    <input type="text" name="lda_kelompok" readonly="readonly" id="lda_kelompok" style="width:480px;" placeholder="(Semua Kelompok)">
                                                                                    <input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok"value="Pilih"onclick = "showSpoiler(this);">
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
                                                                                                js_checkboxkelompok($alamat_simpul_kelompok,
                                                                                                $alamat_search_kelompok,"lda_kelompok","kelompok_id",'kelompok','yuda');
                                                                                                $style="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
                                                                                                checkboxkelompok($style,"kelompok_id",'kelompok','yuda');
                                                                                                ?>

                                                                                    </div>
                                                                            </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Lokasi<br>
                                                                            <input type="text" name="lda_lokasi" readonly="readonly" id="lda_lokasi" style="width:480px;" placeholder="(Semua Lokasi)">
                                                                            <input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok"value="Pilih" onclick = "showSpoiler(this);">
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
                                                                                                
                                                                                                $alamat_simpul_lokasi="$url_rewrite/function/dropdown/simpul_lokasi.php";
                                                                                                $alamat_search_lokasi="$url_rewrite/function/dropdown/search_lokasi.php";
                                                                                                js_checkboxlokasi($alamat_simpul_lokasi, $alamat_search_lokasi,"lda_lokasi","lokasi_id",'lokasi','yuda1');
                                                                                                $style1="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
                                                                                                checkboxlokasi($style1,"lokasi_id",'lokasi','yuda1');
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
