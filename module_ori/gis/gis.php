<?php
include "../../config/config.php";
include"$path/header.php";
include"$path/title.php";

/*

$menu_id = 52;
$SessionUser = $SESSION->get_session_user();
($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
$USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);
echo "<pre>";
//print_r($_SESSION);
echo "</pre>";
 * 
 */




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
                                                            GIS
                                                    </div>
                                                    <div id="bottomright">
                                                            <div align="left"><u style="font-weight: bold;" >Seleksi&nbsp;Pencarian&nbsp;:</u></div>
                                                            <form method="POST" action="<?php echo "$url_rewrite";?>/module/gis/gis_map.php"  name="GIS" >
                                                                <table>
                                                                    <tr>
                                                                            <td>ID Aset (System ID)<br><input type="text" name="gis_idaset" style="width:200px;"></td>
                                                                    </tr>
                                                                    <tr>
                                                                            <td>&nbsp;</td>
                                                                    </tr>
                                                                    <tr>
                                                                            <td>Nama Aset<br><input type="text" name="gis_namaaset" style="width:450px;"></td>
                                                                    </tr>
                                                                    <tr>
                                                                            <td>&nbsp;</td>
                                                                    </tr>
                                                                    <tr>
                                                                            <td>Nomor Kontrak<br><input type="text" name="gis_nokontrak" style="width:200px;"></td>
                                                                    </tr>
                                                                    <tr>
                                                                            <td>&nbsp;</td>
                                                                    </tr>
                                                                     <tr>
                                                                            <td>Tahun Perolehan<br><input type="text" name="gis_tahun" style="width:70px;"></td>
                                                                    </tr>
                                                                    <tr>
                                                                            <td>&nbsp;</td>
                                                                    </tr>
                                                                    <tr>
                                                                            <td>Kelompok<br>
                                                                                    <input type="text" name="lda_kelompok" id="lda_kelompok" style="width:450px;" readonly="readonly" placeholder="(semua Kelompok)">
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
                                                                                                    js_checkboxkelompok($alamat_simpul_kelompok,
                                                                                                    $alamat_search_kelompok,"lda_kelompok","kelompok_id",'kelompok','yuda1');
                                                                                                    $style="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
                                                                                                    checkboxkelompok($style,"kelompok_id",'kelompok','yuda1');

                                                                                                    ?>		    
                                                                                                    
                                                                                            </div>
                                                                            </td>
                                                                    </tr>
                                                                    <tr>
                                                                            <td>&nbsp;</td>
                                                                    </tr>
                                                                    <tr>
                                                                            <td>Lokasi<br>
                                                                                    <input type="text" name="lda_lokasi" id="lda_lokasi" style="width:450px;" readonly="readonly" placeholder="(semua Lokasi)">
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
                                                                                                    $alamat_simpul_lokasi="$url_rewrite/function/dropdown/simpul_lokasi.php";
                                                                                                    $alamat_search_lokasi="$url_rewrite/function/dropdown/search_lokasi.php";
                                                                                                    js_checkboxlokasi($alamat_simpul_lokasi, $alamat_search_lokasi,"lda_lokasi","lokasi_id",'lokasi','yuda2');
                                                                                                    $style1="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
                                                                                                    checkboxlokasi($style1,"lokasi_id",'lokasi','yuda2');
                                                                                                    ?>


                                                                                                    
                                                                                            </div>
                                                                            </td>
                                                                    </tr>
                                                                    <tr>
                                                                            <td>&nbsp;</td>
                                                                    </tr>
                                                                      <tr>
                                                                            <td>SKPD<br>
                                                                                    <input type="text" name="lda_skpd" id="lda_skpd" style="width:450px;" readonly="readonly" placeholder="(semua SKPD)" value="<?php echo $_SESSION['ses_satkername'] ; ?>">
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
                                                                        </tr>
                                                                            <tr>
                                                                            <td>NGO<br>
                                                                                    <input type="text" name="lda_ngo" id="lda_ngo" style="width:450px;" readonly="readonly" placeholder="(semua NGO)">
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
                                                                                                    $alamat_simpul_ngo="$url_rewrite/function/dropdown/simpul_ngo.php";
                                                                                                    $alamat_search_ngo="$url_rewrite/function/dropdown/search_ngo.php";
                                                                                                    js_checkboxngo($alamat_simpul_ngo, $alamat_search_ngo,"lda_ngo","ngo_id",'ngo','yuda3');
                                                                                                    $style3="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
                                                                                                    checkboxngo($style3,"ngo_id",'ngo','yuda3');

                                                                                                     ?> 
                                                                                            </div>
                                                                            </td>
                                                                    </tr>
                                                                    <tr>
                                                                            <td>&nbsp;</td>
                                                                    </tr>
                                                                    <tr>
                                                                            <td><input type="submit" name="tampil" value="Lanjut"></td>
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
