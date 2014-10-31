    <?php
        include "../../config/config.php";
    ?>

<html>
    <?php
        include "$path/header.php";
    ?>
        
        <!--buat number only-->
        <style>
            #errmsg { color:red; }
        </style>
        <script src="<?php echo "$url_rewrite/"; ?>JS/jquery-latest.js"></script>
        <script src="<?php echo "$url_rewrite/"; ?>JS/jquery.js"></script>
        <script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo "$url_rewrite/";?>JS/ajax_checkbox.js"></script>
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
                                Penggunaan Penetapan
                            </div>
                            <div id="bottomright">
                                
                                <form name="form" method="POST" action="<?php echo "$url_rewrite/module/penggunaan/"; ?>penggunaan_penetapan_tambah_data.php?pid=1">
                                <table width="100%">
                                    <script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/tabel.js"></script>
                                    <tr>
                                        <td colspan="2"><u style="font-weight:bold;">Seleksi Pencarian :</u></td>
                                <td></td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td>Nama Aset</td>
                                    <td><input placeholder="Nama Aset..." type="text" name="penggu_penet_filt_add_nmaset" style="width:200px;"></td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td>Nomor Kontrak</td>
                                    <td>
                                        <input placeholder="Nomor Kontrak..." type="text" name="penggu_penet_filt_add_nokontrak" style="width:450px;" id="posisiKolom">&nbsp;<span id="errmsg"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td valign="top">Satker</td>
                                    <td>
                                        <input type="text" name="lda_skpd" id="lda_skpd" style="width:450px;" readonly="readonly" placeholder="(Semua SKPD)">
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
                                                    js_checkboxskpd($alamat_simpul_skpd, $alamat_search_skpd,"lda_skpd","skpd_id",'skpd','yuda');
                                                    $style2="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
                                                    checkboxskpd($style2,"skpd_id",'skpd','yuda');
                                                    ?>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td colspan="2"><hr></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td colspan="2">&nbsp;&nbsp;&nbsp;<input type="submit" name="tampil2" value="Lanjut"></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td colspan="2"><hr></td>
                                    <td></td>
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

