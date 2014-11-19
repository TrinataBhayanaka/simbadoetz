<?php
include "../../config/config.php";

?>

<?php
    include"$path/meta.php";
    include"$path/header.php";
    include"$path/menu.php";
    
?>
           
    <section id="main">
        <ul class="breadcrumb">
          <li><a href="#"><i class="fa fa-home fa-2x"></i>  Home</a> <span class="divider"><b>&raquo;</b></span></li>
          <li><a href="#">GIS</a><span class="divider"><b>&raquo;</b></span></li>
          <li class="active">GIS</li>
          <?php SignInOut();?>
        </ul>
        <div class="breadcrumb">
            <div class="title">GIS</div>
            <div class="subtitle">Filter Data</div>
        </div>
        <section class="formLegend">
     
        <form method="POST" action="<?php echo "$url_rewrite";?>/module/gis/gis_map.php"  name="GIS" >
            <ul>
                            <li>
                                <span class="span2">ID Aset (System ID)</span>
                               <input type="text" name="gis_idaset" style="width:200px;">
                            </li>
                            <li>
                                <span class="span2">Nama Aset</span>
                                <input type="text" name="gis_namaaset" style="width:450px;">
                            </li>
                            <li>
                                <span class="span2">Nomor Kontrak</span>
                                <input type="text" name="gis_nokontrak" style="width:200px;">
                            </li>
                            <li>
                                <span class="span2">Tahun Perolehan</span>
                               <input type="text" name="gis_tahun" style="width:70px;">
                            </li>
                            <li>
                                <span class="span2">Kelompok</span>
                                <div class="input-append">
                                    <input type="text" name="lda_kelompok" id="lda_kelompok" class="span5" readonly="readonly" placeholder="(semua Kelompok)">
                                    <input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" class="btn" value="Pilih" onclick = "showSpoiler(this);">
                                            <div class="inner" style="display:none;">
                                                  
                                                    <?php
                                                    $alamat_simpul_kelompok="$url_rewrite/function/dropdown/simpul_kelompok.php";
                                                    $alamat_search_kelompok="$url_rewrite/function/dropdown/search_kelompok.php";
                                                    js_checkboxkelompok($alamat_simpul_kelompok,
                                                    $alamat_search_kelompok,"lda_kelompok","kelompok_id",'kelompok','yuda1');
                                                    $style="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
                                                    checkboxkelompok($style,"kelompok_id",'kelompok','yuda1');

                                                    ?>          
                                                    
                                            </div>
                                </div>
                            </li>
                            <li>
                                <span class="span2">Lokasi</span>
                                <div class="input-append">
                               <input type="text" name="lda_lokasi" id="lda_lokasi" class="span5" readonly="readonly" placeholder="(semua Lokasi)">
                                    <input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" class="btn" value="Pilih" onclick = "showSpoiler(this);">
                                            <div class="inner" style="display:none;">
                                            
                                                    <?php
                                                    $alamat_simpul_lokasi="$url_rewrite/function/dropdown/simpul_lokasi.php";
                                                    $alamat_search_lokasi="$url_rewrite/function/dropdown/search_lokasi.php";
                                                    js_checkboxlokasi($alamat_simpul_lokasi, $alamat_search_lokasi,"lda_lokasi","lokasi_id",'lokasi','yuda2');
                                                    $style1="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
                                                    checkboxlokasi($style1,"lokasi_id",'lokasi','yuda2');
                                                    ?>


                                                    
                                            </div>
                                        </div>
                            </li>
                            <li>
                                <span class="span2">SKPD</span>

                                <div class="input-append">
                               <input type="text" name="lda_skpd" id="lda_skpd" class="span5" readonly="readonly" placeholder="(semua SKPD)" value="<?php echo $_SESSION['ses_satkername'] ; ?>">
                                    <input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" class="btn" value="Pilih" onclick = "showSpoiler(this);">
                                            <div class="inner" style="display:none;">
                                                  
                                                    <?php
                                                    $alamat_simpul_skpd="$url_rewrite/function/dropdown/simpul_skpd.php";
                                                    $alamat_search_skpd="$url_rewrite/function/dropdown/search_skpd.php";
                                                    js_checkboxskpd($alamat_simpul_skpd, $alamat_search_skpd,"lda_skpd","skpd_id",'skpd','yuda');
                                                    $style2="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
                                                    checkboxskpd($style2,"skpd_id",'skpd','yuda');
                                                    ?>

                                                    
                                            </div>
                                        </div>
                            </li>
                            <li>
                                <span class="span2">NGO</span>

                                <div class="input-append">
                               <input type="text" name="lda_ngo" id="lda_ngo" class="span5" readonly="readonly" placeholder="(semua NGO)">
                                    <input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" class="btn" value="Pilih" onclick = "showSpoiler(this);">
                                            <div class="inner" style="display:none;">
                                                  
                                                     <?php
                                                    $alamat_simpul_ngo="$url_rewrite/function/dropdown/simpul_ngo.php";
                                                    $alamat_search_ngo="$url_rewrite/function/dropdown/search_ngo.php";
                                                    js_checkboxngo($alamat_simpul_ngo, $alamat_search_ngo,"lda_ngo","ngo_id",'ngo','yuda3');
                                                    $style3="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
                                                    checkboxngo($style3,"ngo_id",'ngo','yuda3');

                                                     ?> 
                                            </div>
                                        </div>
                            </li>
                           
                            <li>
                                <span class="span2">&nbsp;</span>
                                <input type="submit" name="submit" class="btn btn-primary" value="Lanjut" />
                                <input type="reset" name="reset" class="btn" value="Bersihkan Data">
                            </li>
                        </ul>
                        <table border="0" cellspacing="6" style="display: none">
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
                        </form>
            
        </section>     
    </section>
    
<?php
    include"$path/footer.php";
?>