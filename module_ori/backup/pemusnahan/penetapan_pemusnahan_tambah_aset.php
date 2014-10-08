<?php
 include "../../config/config.php";
    include"$path/header.php";
   include"$path/title.php";
?>
<html>
                        <script type="text/javascript" src="<?php echo "$url_rewrite/";?>JS/script.js"></script>
                        <script type="text/javascript" src="<?php echo "$url_rewrite/";?>JS2/tabel.js"></script>
                        <script type="text/javascript" src="<?php echo "$url_rewrite/";?>JS2/simbada.js"></script>
                        <script type="text/javascript" src="<?php echo "$url_rewrite/";?>JS2/simbada.js"></script>
                        <script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/jquery.min.js"></script>
                        <script type="text/javascript" src="<?php echo "$url_rewrite/";?>JS/ajax_checkbox.js"></script>
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
                                                            Penetapan Pemusnahan
                                                    </div>
                                                            <div id="bottomright">
                                                                    <div align="left" style="font-weight:bold;text-decoration:underline; margin-bottom:10px;">Seleksi&nbsp;Pencarian&nbsp;:</div>
                                                                    <form method="POST" action="<?php echo "$url_rewrite";?>/module/pemusnahan/penetapan_pemusnahan_tambah_data.php?pid=1">  
                                                                            <table width="100%" cellpadding="1" cellspacing="1" border="0">
                                                                                <tr>
                                                                                    <td>Nama&nbsp;Aset<br>
                                                                                        <input style="width:480px" type="text" name="idgetnamaaset" id="idgetnamaaset" value="">
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                        <td>&nbsp;</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>Nomor&nbsp;Kontrak<br>
                                                                                        <input style="width:200px" type="text" name="idgetnokontrak" id="idgetnokontrak" value="">
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                        <td>&nbsp;</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>No&nbsp;Usulan<br>
                                                                                        <input style="width:200px" type="text" name="nousulan" id="nousulan" value="">
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                        <td>&nbsp;</td>
                                                                                </tr>
                                                                                <tr>
                                                                                        <td>Lokasi<br>
                                                                                                <input type="text" name="lda_lokasi" id="lda_lokasi" style="width:480px;" readonly="readonly" placeholder="(Semua Lokasi)">
                                                                                                <input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" value="Pilih"  onclick = "showSpoiler(this);">
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
                                                                                        <td>&nbsp;</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>&nbsp;</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                            <td valign="top" align="left">
                                                                                                    <input type="submit" name="submit_aset" style="width:120px;" value="Tampilkan Data">
                                                                                                    <input type="reset" style="width:120px;" value="Bersihkan Filter">
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
