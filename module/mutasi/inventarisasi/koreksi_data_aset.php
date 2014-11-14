<?php
include "../../config/config.php";

$USERAUTH = new UserAuth();

$SESSION = new Session();

$menu_id = 21;
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
                    <div id="tengah1">
                         <div id="frame_tengah1">
                             <div id="frame_gudang">
                                <div id="topright">
                                        Koreksi Data Aset
                                        <script type="text/javascript" src="<?php echo "$url_rewrite"?>/JS/script.js"></script>
                                         <script type="text/javascript" src="<?php echo "$url_rewrite"?>/JS/simbada.js"></script>
                                         <script type="text/javascript" src="<?php echo "$url_rewrite"?>/JS/simbada.js"></script>
                                         <script type="text/javascript" src="<?php echo "$url_rewrite"?>/JS/tabel.js"></script>
                                         <script>
                                                    
                                            </script>
                                </div>
                                <div id="bottomright">
                                        <!edit isi content!>
                                        <script type="text/javascript" src="JS/tabel.js"></script>
                                        <strong><u>Seleksi Pencarian:</u></strong>
                                                 <form action="<?php echo "$url_rewrite"?>/module/koreksi/hasil_koreksi_data.php?pid=1" method="post">
                                                                                                                                         
                                                        <table border="0" cellpadding="1" cellspacing="1" width="100%">
                                                                    <tbody><tr><td style="height: 5px;"><!-- just give a space --></td></tr>
                                                                            <tr>
                                                                                    <td>ID&nbsp;Aset&nbsp;(System&nbsp;ID)<br>
                                                                                            <input style="width: 200px;"  name="kd_idaset" type="text" ></td>
                                                                            </tr>
                                                                            <tr>
                                                                                    <td>Nama&nbsp;Aset<br>
                                                                                                <input isdatepicker="true" style="width: 480px;"  name="kd_namaaset"  type="text"></td>
                                                                            </tr>
                                                                            <tr>
                                                                                    <td>Nomor&nbsp;Kontrak<br>
                                                                                                <input isdatepicker="true" style="width: 200px;" name="kd_nokontrak"  type="text"></td>
                                                                            </tr>
                                                                            <tr>
                                                                                    <td>Tahun&nbsp;Perolehan<br>
                                                                                    <input name="kd_tahun"  type="text" ></td>
                                                                                            
                                                                            </tr>
                                                                            <tr>
                                                                                    <td>
                                                                                            Kelompok<br>

                                                                                               
                                                                                                <input type="text" name="idgetkelompok5" id="idgetkelompok5"
                                                                                                    style="width:480px;"readonly="readonly" placeholder="(Semua Kelompok)">
                                                                                                <input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" value="Pilih" onclick = "showSpoiler(this);"> <div class="inner" style="display:none;">


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
                                                                                                    $alamat_search_kelompok,"idgetkelompok5","kelompok_id5",'kelompok5','kas');
                                                                                                    $style="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
                                                                                                    checkboxkelompok($style,"kelompok_id5",'kelompok5','kas');
                                                                                                    ?>
                                                                                                
                                                                                                </div>
                                                                                    </td>
                                                                            </tr>
                                                                            <tr>
                                                                <td>
                                                                    Lokasi
                                                                    <br>
                                                                    <table>
                                                                        <tr>
                                                                            <td>
                                                                                    <input type="text" style="width:480px;" name="lda_lokasi" id="lda_lokasi2"  style="width:450px;" readonly="readonly" placeholder="(Semua Lokasi)">
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
                                                                                                        $alamat_simpul_lokasi="$url_rewrite/function/dropdown/simpul_lokasi.php";
                                                                                                        $alamat_search_lokasi="$url_rewrite/function/dropdown/search_lokasi.php";
                                                                                                        js_checkboxlokasi($alamat_simpul_lokasi, $alamat_search_lokasi,"lda_lokasi2","lokasi_id2",'lokasi2','ki');
                                                                                                        $style1="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
                                                                                                        checkboxlokasi($style1,"lokasi_id2",'lokasi2','ki');
                                                                                                        ?>
                                                                                    </div>
                                                                            </td>
                                                                    </tr>
                                                                    </td>
                                                                    </tr>
                                                                            <tr>
                                                                                        <td>
                                                                                                SKPD
                                                                                                    <br>
                                                                                                        <input type="text"style="width:480px;" name="lda_skpd" id="lda_skpd5" placeholder="(Semua SKPD)" readonly="readonly">
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
                                                                                                                                $alamat_simpul_skpd="$url_rewrite/function/dropdown/simpul_skpd.php";
                                                                                                                                $alamat_search_skpd="$url_rewrite/function/dropdown/search_skpd.php";
                                                                                                                                js_checkboxskpd($alamat_simpul_skpd, $alamat_search_skpd,"lda_skpd5","skpd_id5",'skpd5','ki5');
                                                                                                                                $style2="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
                                                                                                                                checkboxskpd($style2,"skpd_id5",'skpd5','ki5');
                                                                                                                                ?>
                                                                                                                    </div>
                                                                                                            </td>
                                                                                                    </tr> 
                                                                                                    </table>
                                                                                            <tr>
                                                                                                    <td>
                                                                                            NGO
                                                                                                <br>
                                                                                                        <input type="text" name="lda_ngo" id="lda_ngo10"style="width:480px;"readonly="readonly" placeholder="(Semua NGO)">
                                                                                                        <input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" value="Pilih"onclick = "showSpoiler(this);">
                                                                                                
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
                                                                                                $alamat_simpul_ngo="$url_rewrite/function/dropdown/simpul_ngo.php";
                                                                                                $alamat_search_ngo="$url_rewrite/function/dropdown/search_ngo.php";
                                                                                                js_checkboxngo($alamat_simpul_ngo, $alamat_search_ngo,"lda_ngo10","ngo_id",'ngo','su');
                                                                                                $style3="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
                                                                                                checkboxngo($style3,"ngo_id",'ngo','su');
                                                                                                ?>         
                                                                                            </div>

                                                                                    </td>
                                                                            </tr>
                                                                           <tr>
                                                                                    <td align="left" valign="top">
                                                                                        <hr size="0.5pt">
                                                                                               <script>
                                                                                                    <!--
                                                                                                            function sendit(){
                                                                                                            alert("lihat koreksi data aset");
                                                                                                            //document.location="pengadaan_proses.php";
                                                                                                            document.forms[0].submit(); // ini yang bener//
                                                                                                            
                                                                                                            }
                                                                                                    -->
                                                                                                </script>
                                                                                              <input type='submit' value='Lanjut'  name="submit" onclick="show_confirm()"/>
                                                                                           <hr size="0.5pt">
                                                                                     </td>
                                                                                </tr>	
                                                                    </tbody>
                                                         </table>
                                                </form>
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