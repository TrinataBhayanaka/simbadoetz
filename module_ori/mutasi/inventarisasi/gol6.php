<?php

$query = " SELECT * FROM KDP WHERE Aset_ID = $Aset_ID ";
//print_r($query);
$result = mysql_query($query) or die (mysql_error());


if (mysql_num_rows($result))
{
    $data = mysql_fetch_object($result);
    $dataArr = $data;
}
echo '<pre>';
//print_r($dataArr);
echo '</pre>';

?>


<html>
<table border=0>
<tr>
<td>Konstruksi</td>
<td>&nbsp;</td>  
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>

<td>Jumlah Lantai</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>Luas Lantai</td>
</tr>

</table>

<table border=0>
<tr>
<td>
<select id="inv_ldahi_gol6_konstruksi" name="inv_ldahi_gol6_konstruksi">
<option value="">Permanent</option>
<option value="">Semi Permanent </option>
<option value="">Darurat </option>
</select>
</td>
<td>
<select id="inv_ldahi_gol6_jumlah_lantai" name="inv_ldahi_gol6_jumlah_lantai">
<option value="">Beton</option>
<option value="">Bukan Beton</option>

</select>
</td>
<td>
&nbsp;
</td>  
<td>
<input type="text" name="inv_ldahi_gol6_jml_lantai" id="inv_ldahi_gol6_jml_lantai" value="<?php echo $dataArr->JumlahLantai ?>" size=20 />
</td>
<td>
&nbsp;
</td>  
<td>
<input type="text" name="inv_ldahi_gol6_luas_lantai" name="inv_ldahi_gol6_luas_lantai" value="<?php echo $dataArr->LuasLantai ?>" size=20 style="text-align:right;" />m2
</td>  
</tr>
</table>



<table border=0>
<tr>
<td>Tanggal Pembangunan</td>


</tr>
<tr>
<td>
<input type="text" name="inv_ldahi_gol6_tgl_pembangunan" id="inv_ldahi_gol6_tgl_pembangunan" value="<?php echo $dataArr->TglMulai ?>" />
</td>

</tr>
</table>



<table border=0>	
<tr>
<td>Status Tanah</td>

</tr>
<tr>
<td>
<select id="inv_ldahi_gol6_status_tanah" name="inv_ldahi_gol6_status_tanah" />
<option value="" >Tanah Pemda</option>
<option value="" >Tanah Negara</option>
<option value="" >Tanah Ulayat/Adat</option>
<option value="" >Tanah Hak Guna Bangunan</option>
<option value="" >Tanah Pakai</option>
<option value="" >Tanah Pengelolaan</option>
<option value="" >Tanah Hak Lainnya</option>
</select>

</td> 

</tr>
</table>

<table border=0>		
<tr>
<td>Pilih Aset Tanah</td>
</tr>
<tr>
<td>
<input type="text" name="inv_ldahi_gol6_pilih_aset_tanah" id="inv_ldahi_gol6_pilih_aset_tanah" value="" size=70 />
</td>
<td>
<input type="submit" name="tampilkan_data" value="Pilih" >
</td>
</tr>
</table>

<table border=0>		
<tr>
<td>Nomor Kode  Tanah</td>
</tr>
<tr>
<td>
<input type="text" name="inv_ldahi_gol6_no_kode_tanah" id="inv_ldahi_gol6_no_kode_tanah" value="" size=70 />
</td>
<td>
<input type="submit" name="tampilkan_data" value="Pilih" />
</td>
</tr>
</table>
</html>
