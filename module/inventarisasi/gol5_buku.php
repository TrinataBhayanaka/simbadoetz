<?php

$query = " SELECT * FROM AsetLain WHERE Aset_ID = $Aset_ID ";
//print_r($query);
$result = mysql_query($query) or die (mysql_error());

if (mysql_num_rows($result))
{
    $data = mysql_fetch_object($result);
    $dataArrAsetLain = $data;
}

echo "<pre>";
//print_r($dataArrAsetLain);
echo "</pre>";

?>

<html>

<table border=0>	
<tr>
<td>Jenis Aset Lainnya</td>
</tr>

<tr>
<td>
<select>
<option>Buku Kesenian / Kebudayaan</option>
<option>Hewan / Tanaman</option>                
<option>Buku / Perpustakaan</option>

</select>

</td> 

</tr>
</table>

<table border=0>	
<tr>
<td>Judul</td>
</tr>
<tr>
<td>
<input type="text" name="inv_ldahi_gol5buku_judul" id="inv_ldahi_gol5buku_judul" value="<?php echo $dataArrAsetLain->Judul ?>" size=70  />
</td>
</tr>
<tr>
<td>Pengarang</td>
</tr>
<tr>
<td>
<input type="text" name="inv_ldahi_gol5buku_pengarang" id="inv_ldahi_gol5buku_pengarang" value="<?php echo $dataArrAsetLain->Pengarang ?>" size=70 />
</td>
</tr>
<tr>
<td>Penerbit</td>
</tr>
<tr>
<td>
<input type="text" name="inv_ldahi_gol5buku_penerbit" id="inv_ldahi_gol5buku_penerbit" value="<?php echo $dataArrAsetLain->Penerbit ?>" size=70 />
</td>
</tr>
<tr>
<td>Spesifikasi</td>
</tr>
<tr>
<td>
<input type="text" name="inv_ldahi_gol5buku_spesifikasi" id="inv_ldahi_gol5buku_spesifikasi" value="<?php echo $dataArrAsetLain->Spesifikasi ?>" size=70 />
</td>
</tr>
</table>

<table border=0>
<tr>
<td>Tahun Terbit</td>
<td>ISBN</td>

</tr>
<tr>
<td>
<input type="text" name="inv_ldahi_gol5buku_tahun_terbit" id="inv_ldahi_gol5buku_tahun_terbit" value="<?php echo $dataArrAsetLain->TahunTerbit ?>" />
</td>
<td>
<input type="text" name="inv_ldahi_gol5buku_isbn" id="inv_ldahi_gol5buku_isbn" value="<?php echo $dataArrAsetLain->ISBN ?>" />
</td>

</tr>
</table>
<table border=0>
<tr>
<td>Kuantitas</td>
<td>Satuan</td>

</tr>
<tr>
<td>
<input type="text" name="inv_ldahi_gol5buku_kuantitas" id="inv_ldahi_gol5buku_kuantitas" value="" style="text-align:right;" />
</td>
<td>
<input type="text" name="inv_ldahi_gol5buku_satuan" id="inv_ldahi_gol5buku_satuan" value=""  />
</td>

</tr>
</table>




		
</html>
