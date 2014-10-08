<html>
<?php
include "../../config/config.php";


$USERAUTH = new UserAuth();
$SESSION = new Session();
$menu_id = 50;
$SessionUser = $SESSION->get_session_user();
$USERAUTH->FrontEnd_check_akses_menu($menu_id,$SessionUser);

$resetDataView = $DBVAR->is_table_exists('penilaian_'.$SessionUser['ses_uoperatorid'], 0);

include "$path/header.php";
include "$path/title.php";
?>

<body>
    <?php
    include "$path/menu.php";
    ?>

        <div id="tengah1">	
        <div id="frame_tengah1">
        <div id="frame_gudang">
        <div id="topright">Entri Hasil Penilaian</div>
        <div id="bottomright">

<strong><u>Seleksi Pencarian:</u></strong>
<script type="text/javascript" src="<?php echo "$url_rewrite";?>/JS/tabel.js"></script>

<form method="POST" action="<?php echo "$url_rewrite"?>/module/penilaian/entri_penilaian_daftar.php?pid=1" 
        name="penilaian">           

<table border="0" cellpadding="1" cellspacing="1" width='100%'>
    <tr>
        <td style="height: 5px;"><!-- just give a space --></td>
    </tr>
    <tr>
        <td>ID Aset (System ID)</td>
    </tr>
    <tr>
        <td><input type='text'  name='pen_ID_aset' style="width: 200px;"/></td>
    </tr>
    <tr>
        <td>Nama Aset</td>
    </tr>
    <tr>
        <td><input type='text' name='pen_nama_aset'style="width: 480px;" /></td>
    </tr>
    <tr>
        <td>Nomor Kontrak</td>
    </tr>
    <tr>
        <td><input type='text' name='pen_nomor_kontrak' style="width: 200px;"/></td>
    </tr>
    <tr>
        <td>Tahun Perolehan</td>
    </tr>
    <tr>
        <td><input type='text' name='pen_tahun_perolehan'/></td>
    </tr>

    <tr>
        <td>
                    Kelompok<br>

                        <input type="text" name="pem_kelompok" id="pem_kelompok" style="width:450px;" readonly="readonly" value="">
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
                    <td>
                        Lokasi
                        <br>

                                <input type="text" name="pem_lokasi" id="pem_lokasi" style="width:450px;" readonly="readonly" value="">
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

														js_radiopengadaanlokasi($alamat_simpul_lokasi, $alamat_search_lokasi,"pem_lokasi","lokasi_id",'lokasi','p_provinsi','p_kabupaten','p_kecamatan','p_desa','lok');
														$style1="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
														radiopengadaanlokasi($style1,"lokasi_id",'lokasi',"lok");
			?> 
        
                </div>

                    </div>
                </td>
            </tr>

    <tr>
        <td>
                SKPD
                    <br>
                        <input type="text" name="pem_skpd" id="pem_skpd" style="width:450px;" readonly="readonly" value="<?php echo $_SESSION['ses_satkername'] ; ?>">
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
													//include "$path/function/dropdown/function_skpd.php";
													$alamat_simpul_skpd="$url_rewrite/function/dropdown/radio_simpul_skpd.php";
													$alamat_search_skpd="$url_rewrite/function/dropdown/radio_search_skpd.php";
													js_radioskpd($alamat_simpul_skpd, $alamat_search_skpd,"pem_skpd","skpd_id",'skpd','pemskpdfilter');
													$style2="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
													radioskpd($style2,"skpd_id",'skpd','pemskpdfilter');
			?>  
                       
            </div>
            </div>
        </td>
    </tr>


    <!--<tr>
            <td>
                    NGO
                        <br>
                                <input type="text" name="pem_ngo" id="pem_ngo" style="width:450px;" readonly="readonly" value="">
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
													//include "$path/function/dropdown/function_ngo.php";
													$alamat_simpul_ngo="$url_rewrite/function/dropdown/radio_simpul_ngo.php";
													$alamat_search_ngo="$url_rewrite/function/dropdown/radio_search_ngo.php";
													js_radiongo($alamat_simpul_ngo, $alamat_search_ngo,"pem_ngo","ngo_id",'ngo','pemngofilter');
													$style3="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
													radiongo($style3,"ngo_id",'ngo','pemngofilter');
			?>
                        
                    </div>

                            </div>
            </td>
    </tr>-->
    <tr>
        <td>
            <br>
            
            <input type='submit' value='Lanjut'  name="submit" />
            
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
