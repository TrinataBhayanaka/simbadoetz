<?php
include "../config/config.php";
//echo 'oke';
if(!isset($_SESSION['ses_uid'])){
//echo 'ada';
echo "<script>alert('silahkan login dahulu');window.location.href='$url_rewrite'; </script>";
}
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Import Pengadaan Aset / Barang</title>
	<script src="function/require.js"></script>
    </head>
    <body>
        <div id="content">
            <?php
                include "$path/header.php";
                include "$path/title.php";
                include "$path/menu_import.php"
            ?>
            <div id="tengah1">	
                <div id="frame_tengah1">
                    <div id="frame_gudang">
                        <div id="topright">
                            Kartu Inventaris Barang B
                        </div>
                        <!--==================-->
                        <div id="bottomright">
                            <form method="post" enctype="multipart/form-data" action="proses_kibb.php">
                            <table border=0 cellspacing="6">
                                <tr>
                                    <td colspan=11 style="font-weight:bold; text-decoration:underline;">Nomor Register</td>
                                </tr>		
                                <tr>
                                    <td>
                                        <input type="text" name="p_noreg_pemilik"   value ="12" size="1" maxlength="2" readonly="readonly" id="posisiKolom" />
                                    </td>
                                    <td>.</td>
                                    <td>
                                        <input type="text" name="p_noreg_prov" value="<?php echo $KODE_PROVINSI?>"  size=1 maxlength="2"  id="posisiKolom1" readonly/>
                                    </td>
                                    <td>.</td>
                                    <td>
                                        <input type="text" name="p_noreg_kab" value="<?php echo $KODE_KABUPATEN?>"  size=1 maxlength="2"  id="posisiKolom2" readonly/>
                                    </td>
                                    <td>.</td>
                                    <td>
                                        <input type="text" id="p_noreg_satker" name="p_noreg_satker" value="00.00"  size=5 maxlength="5"  id="posisiKolom3" readonly/>

                                    </td>
                                    <td>.</td>
                                    <td>
                                        <input type="text" name="p_noreg_tahun" value="xx"  size=1 maxlength="2" readonly="readonly" id="posisiKolom4"/>
                                    </td>
                                    <td>.</td>
                                    <td>
                                        <input type="text" name="p_noreg_unit" value="00"  size=1 maxlength="2"  readonly="readonly" id="posisiKolom5"/><span id="errmsg"></span>
                                    </td>
                                </tr>
                            </table>
                
                                <br/>
                                <hr/>
                                <br/>
                            <table border=0 cellspacing="6">
                                <tr>
                                    <td style="font-weight:bold; text-decoration:underline;">Pemilik</td>
                                    <td style="font-weight:bold; text-decoration:underline;">.</td>
                                    <td style="font-weight:bold; text-decoration:underline;">SKPD</td>
                                    <td style="font-weight:bold; text-decoration:underline;">.</td>
                                    <td style="font-weight:bold; text-decoration:underline;">Kode Aset</td>							
                                </tr>
                                <tr>
                                    <td>
                                        <select id="p_pemilik" name="p_pemilik"  onchange="change_pemilik();">
                                            <option value="12">12 - Pemerintah Kab/Kota</option>
                                            <option value="00">00 - kementrian lembaga</option>
                                            <option value="11">11 - Pemerintah Provinsi</option>
                                            <option value="99">99 - Yayasan/Masyarakat</option>
                                        </select>
                                    </td>
                                    <td>.</td>
                                    <td><input type="text" id="p_skpd" name="p_skpd" value="" readonly></td>
                                    <td>.</td>
                                    <td><input type="text" id="p_kodeaset" name="p_kodeaset" value=""  readonly></td>
                                </tr>		
                            </table>
                                <br/>
                                <hr/>
                                <br/>
                           
                            <table cellspacing="6">
                                <tr>
                                                <td colspan=2 style="font-weight:bold; text-decoration:underline;">SKPD</td>
                                        </tr>
                                        <tr>
                                                <td>
                                                        <input type="hidden" name="idgetkelompok" id="idgetkelompok" value="">
                                                        <input type="text" name="lda_skpd" id="lda_skpd" style="width:450px;" readonly="readonly" value="(Pilih SKPD)">
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
                                                                    
                                                                      //  include "$path/function/dropdown/radio_function_skpd_pengadaan.php";
                                                                        $alamat_simpul_skpd="$url_rewrite/function/dropdown/radio_simpul_skpd.php";
                                                                        $alamat_search_skpd="$url_rewrite/function/dropdown/radio_search_skpd.php";
                                                                        js_radiopengadaanskpd($alamat_simpul_skpd, $alamat_search_skpd,"lda_skpd","skpd_id",'skpd','p_skpd','p_noreg_satker','sk');
                                                                        $style2="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
                                                                        radiopengadaanskpd($style2,"skpd_id",'skpd','sk');
                                                                      
                                                                        ?>
                                                        </div>
                                                
                                                        <?php
                                                        
                                                        $skpppd=$_POST['p_skpd'];
                                                        
                                                        ?>
                                                        <?php echo $skpppd ;?>
                                                </td>
                                        </tr>
                                </table>
                                <br>
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
                                            <div>
                                            <table>
                                            <tr>
                                                            <td colspan=2 style="font-weight:bold; text-decoration:underline;">Lokasi</td>
                                                    </tr>
                                                    <tr>
                                                            <td>
                                                                    <input type="text" name="lda_lokasi" id="lda_lokasi" style="width:450px;" readonly="readonly" value="(Pilih Lokasi)">
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

                                                                                    js_radiopengadaanlokasi($alamat_simpul_lokasi, $alamat_search_lokasi,"lda_lokasi","lokasi_id",'lokasi','p_provinsi','p_kabupaten','p_kecamatan','p_desa','lok');
                                                                                    $style1="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
                                                                                    radiopengadaanlokasi($style1,"lokasi_id",'lokasi',"lok");
                                                                                    ?>
                                                                    </div>
                                           
                                                            </td>
                                                    </tr>
                                            </table>

                                                            </div>
                                    <br/>
                                    <hr/>
                                    <br/>
                                <table>
                                    <tr>
                                        <td style="font-weight:bold; text-decoration:underline;">Unggah File (*.xls)</td>
                                    </tr>
                                    <tr>
                                        <td><input name="userfile" type="file" required></td>
                                    </tr>
                                </table>
                                <br/>
                                <hr/>
                                <br/>
                                <table>
                                    <tr>
                                        <td style="padding-left:435px;"><input type="submit" name="submit" onclick="return check_satker();" value="Upload" style="width: 100px;"/></td>
                                    </tr>
                                </table>
                                <br/>
                                <hr/>
                                <br/>
                                </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <?php
        include "$path/footer.php"
    ?>
</html>
