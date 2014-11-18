<?php


    $query = "SELECT * FROM Tanah WHERE Aset_ID = $Aset_ID";
    //print_r($query);
    $result = mysql_query($query) or die (mysql_error());
    
    if (mysql_num_rows($result))
    {
        $data = mysql_fetch_object($result);
        
        $dataArrTanah = $data;
    }
    
    echo '<pre>';
    //print_r($dataArrTanah);
    echo '</pre>';
?>

<table border=0>
<tr>
<td>Luas Keseluruhan</td>
<td><input type="text" name="inv_ldahi_gol1_luas_keseluruhan" id="inv_ldahi_gol1_luas_keseluruhan" size=20 value="<?php echo $dataArrTanah->LuasTotal ?>"/></td>
<td>Luas Untuk bangunan</td>
<td><input type="text" name="inv_ldahi_gol1_luas_utk_bangunan" id="inv_ldahi_gol1_luas_utk_bangunan" size=20 value="<?php echo $dataArrTanah->LuasBangunan ?>"/></td>
</tr>
<tr>
<td>Luas Sarana Lingkungan</td>
<td><input type="text" name="inv_ldahi__gol1_luas_sarana_lingkungan" id="inv_ldahi__gol1_luas_sarana_lingkungan" size=20 value="<?php echo $dataArrTanah->LuasSekitar ?>" /></td>
<td>Luas Tanah Kosong</td>
<td><input type="text" name="inv_ldahi_gol1_luas_tnh_kosong" id="inv_ldahi_gol1_luas_tnh_kosong" size=20 value="<?php echo $dataArrTanah->LuasKosong ?>" /></td>
</tr>

</table>
	
<table border=0>
<tr>
<td>
Hak Tanah
</td>
<td> &nbsp;</td>
	<td> &nbsp;</td>
	<td> &nbsp;</td>
	<td> &nbsp;</td>
	<td> &nbsp;</td>
	<td> &nbsp;</td>
	<td> &nbsp;</td>
	<td> &nbsp;</td>
	<td> &nbsp;</td>
	<td> &nbsp;</td>
	<td> &nbsp;</td>
	 <td>
Nomor Sertifikat
</td>
	 <td> &nbsp;</td>
	<td> &nbsp;</td>
	<td> &nbsp;</td>
	<td> &nbsp;</td>
	<td> &nbsp;</td>
	<td> &nbsp;</td>
	<td> &nbsp;</td>
	<td> &nbsp;</td>
	<td> &nbsp;</td>
	<td> &nbsp;</td>
	<td> &nbsp;</td>
	<td> &nbsp;</td>
	 <td> &nbsp;</td> 
	<td>
Tanggal Sertifikat
</td>
																	
 <td> &nbsp;</td>
<td> &nbsp;</td>
<td> &nbsp;</td>
<td> &nbsp;</td>
<td> &nbsp;</td>
<td> &nbsp;</td>
<td> &nbsp;</td>
<td> &nbsp;</td>
<td> &nbsp;</td>
<td> &nbsp;</td>
<td> &nbsp;</td>
	
</tr>
</table>
<table border=0>
<tr>
<td>
<select id="inv_ldahi_gol1_hak_tanah" name="inv_ldahi_gol1_hak_tanah">
<option value="">Hak Pakai</option>
<option value="">Hak Perolehan</option>

</select>
</td>
<td>
&nbsp;
</td>  
<td>
<input type="text" name="inv_ldahi_gol1_no_sertifikat" id="inv_ldahi_gol1_no_sertifikat" value="<?php echo $dataArrTanah->NoSertifikat ?>" size=20 />
</td>
<td>
&nbsp;
</td>  
<td>
<input type="text" name="inv_ldahi_gol1_tgl_sertifikat" id="inv_ldahi_gol1_tgl_sertifikat" value="<?php echo $dataArrTanah->TglSertifikat ?>" size=20 />
</td>  
</tr>
</table>
<table border=0>
<tr>
<td>Penggunaan</td>
</tr>	
</table>            
<table border=0>
<tr>
<td>
<select id="inv_ldahi_gol1_penggunaan" name="inv_ldahi_gol1_penggunaan">
<option value="">Gedung Pemerintah</option>
<option value="">Jalan</option>
<option value="">Irigasi</option>
<option value="">Perkampungan</option>
<option value="">Taman</option>
<option value="">Perkebunan</option>
<option value="">sawah</option>
<option value="">lainnya</option>
</select>
</td>

</tr>
</table>

<table border="0">
<tr>

<td>

</td>

</tr>
</table>

<table border="0">
<tr>
<td>Batas Utara</td>
</tr>
<tr>
<td>
<input type="text" name="inv_ldahi_gol1_batas_utara" id="inv_ldahi_gol1_batas_utara" value="<?php echo $dataArrTanah->BatasUtara ?>" size=45 />
</td>
</tr>
</table>
<table border="0">
<tr>
<td>Batas Selatan</td>
</tr>
<tr>
<td>
<input type="text" name="inv_ldahi_gol1_batas_selatan" id="inv_ldahi_gol1_batas_selatan" value="<?php echo $dataArrTanah->BatasSelatan ?>" size=45 />
</td>
</tr>
</table>

<table border="0">
<tr>
<td>Batas Barat</td>
</tr>
<tr>
<td>
<input type="text" name="inv_ldahi_gol1_batas_barat" id="inv_ldahi_gol1_batas_barat" value="<?php echo $dataArrTanah->BatasBarat ?>" size=45 />
</td>
</tr>
</table>

<table border="0">
<tr>
<td>Batas Timur</td>
</tr>
<tr>
<td>
<input type="text" name="inv_ldahi_gol1_batas_timur" id="inv_ldahi_gol1_batas_timur" value="<?php echo $dataArrTanah->BatasTimur ?>" size=45 />
</td>
</tr>
</table>
