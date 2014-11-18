<?php

$query = "SELECT * FROM Jaringan WHERE Aset_ID = $Aset_ID";
$result = mysql_query($query) or die (mysql_error());

if (mysql_num_rows($result))
{
    $data = mysql_fetch_object($result);
    $dataArrJaringan = $data;
}
 else {
     
    echo 'kosong';

}

echo "<pre>";
//print_r($dataArrJaringan);
echo "</pre>";

?>

<html>
<table border=0>	
<tr>
<td>Konstruksi</td>
</tr>
<tr>
<td>
<input type="text" name="inv_ldahi_gol4_konstruksi" id="inv_ldahi_gol4_konstruksi" value="<?php echo $dataArrJaringan->Konstruksi ?>" size=70 />
</td>
</tr>
</table>
<table border=0>
<tr>
<td>Panjang</td>
<td><input type="text" name="inv_ldahi_gol4_panjang" id="inv_ldahi_gol4_panjang" value="<?php echo $dataArrJaringan->Panjang ?>" size=5 />m</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>Lebar</td>
<td><input type="text" name="inv_ldahi_gol4_lebar" id="inv_ldahi_gol4_lebar" value="<?php echo $dataArrJaringan->Lebar ?>" size=5 />m</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>

<td>Luas</td>
<td><input type="text" name="inv_ldahi_gol4_luas" id="inv_ldahi_gol4_luas" size=5 value="" />m2</td>
</tr>

<table border=0>
<tr>
<td>No. Dokumen</td>
<td>Tanggal Dokumen</td>

</tr>
<tr>
<td>
<input type="text" name="inv_ldahi_gol4_no_dokumen" id="inv_ldahi_gol4_no_dokumen" value="<?php echo $dataArrJaringan->NoDokumen ?>" />
</td>
<td>
<input type="text" name="inv_ldahi_gol4_tgl_dokumen" id="inv_ldahi_gol4_tgl_dokumen" value="<?php echo $dataArrJaringan->TglDokumen ?>" />
</td>

</tr>
</table>
<table border=0>
<tr>
<td>Tanggal Pemakaian</td>


</tr>
<tr>
<td>
<input type="text" name="inv_ldahi_gol4_tgl_pemakain" id="inv_ldahi_gol4_tgl_pemakain" value="" />
</td>

</tr>
</table>



<table border=0>	
<tr>
<td>Status Tanah</td>

</tr>
<tr>
<td>
<select id="inv_ldahi_gol4_status_tanah" name="inv_ldahi_gol4_status_tanah"  >
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
<input type="text" name="inv_ldahi_gol4_pilih_aset_tanah" id="inv_ldahi_gol4_pilih_aset_tanah" value="" size=70 />
</td>
<td>
<input type="submit" name="tampilkan_data" value="Pilih" />
</td>
</tr>
</table>

<table border=0>		
<tr>
<td>Nomor Kode  Tanah</td>
</tr>
<tr>
<td>
<input type="text" name="inv_ldahi_gol4_no_kode_tanah" id="inv_ldahi_gol4_no_kode_tanah" value="" size=70 />
</td>
<td>
<input type="submit" name="tampilkan_data" value="Pilih" />
</td>
</tr>
</table>

</html>

