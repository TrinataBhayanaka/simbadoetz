<?php

    $query = "SELECT * FROM Bangunan WHERE Aset_ID = $Aset_ID ";
    //print_r($query);
    $result = mysql_query($query) or die (mysql_error());

    if (mysql_num_rows($result))
    {

        $data = mysql_fetch_object($result);
        $dataArrBangunan = $data;

    }
    else
    {
        echo 'kosong';
    }



    echo '<pre>';
    //print_r($dataArrBangunan);
    echo '</pre>';
?>


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
<select id="inv_ldahi_gol3_konstruksi1" name="inv_ldahi_gol3_konstruksi1">
<option value="">Permanent</option>
<option value="">Semi Permanent </option>
<option value="">Darurat </option>
</select>
</td>
<td>
<select id="inv_ldahi_gol3_konstruksi2" name="inv_ldahi_gol3_konstruksi2">
<option value="">Beton</option>
<option value="">Bukan Beton</option>

</select>
</td>
<td>
&nbsp;
</td>  
<td>
<input type="text" name="inv_ldahi_gol3_jml_lantai" id="inv_ldahi_gol3_jml_lantai" value="<?php echo $dataArrBangunan->JumlahLantai ?>" size=20 />
</td>
<td>
&nbsp;
</td>  
<td>
<input type="text" name="inv_ldahi_gol3_luas_lantai" id="inv_ldahi_gol3_luas_lantai" value="<?php echo $dataArrBangunan->LuasLantai ?>" size=20 />m2
</td>  
</tr>
</table>

<table border="0">
<tr>
<td>Spesifikasi Dinding</td>
</tr>
<tr>
<td>
<input type="text" name="inv_ldahi_gol3_spek_dinding" id="inv_ldahi_gol3_spek_dinding" value="<?php echo $dataArrBangunan->Dinding ?>" size=45 />
</td>
</tr>
</table>
<table border="0">
<tr>
<td>Spesifikasi Lantai</td>
</tr>
<tr>
<td>
<input type="text" name="inv_ldahi_gol3_spek_lantai" id="inv_ldahi_gol3_spek_lantai" value="<?php echo $dataArrBangunan->Lantai ?>" size=45 />
</td>
</tr>
</table>

<table border="0">
<tr>
<td>Spesifikasi Plafon</td>
</tr>
<tr>
<td>
<input type="text" name="inv_ldahi_gol3_spek_plafon" id="inv_ldahi_gol3_spek_plafon" value="<?php echo $dataArrBangunan-LangitLangit ?>" size=45 />
</td>
</tr>
</table>

<table border="0">
<tr>
<td>Spesifikasi Atap</td>
</tr>
<tr>
<td>
<input type="text" name="inv_ldahi_gol3_spek_atap" id="inv_ldahi_gol3_spek_atap" value="<?php echo $dataArrBangunan->Atap ?>" size=45 />
</td>
</tr>
</table>
<table border=0>
<tr>
<td>No. Dokumen</td>
<td>Tanggal Dokumen</td>

</tr>
<tr>
<td>
<input type="text" name="inv_ldahi_gol3_no_dokumen" id="inv_ldahi_gol3_no_dokumen" value="<?php echo $dataArrBangunan->NoSurat ?>" />
</td>
<td>
<input type="text" name="inv_ldahi_gol3_tgl_dokumen" id="inv_ldahi_gol3_tgl_dokumen" value="<?php echo $dataArrBangunan->TglSurat ?>" />
</td>

</tr>
</table>
<table border=0>
<tr>
<td>Tanggal Pemakaian</td>


</tr>
<tr>
<td>
<input type="text" name="inv_ldahi_gol3_tgl_pemakaian" id="inv_ldahi_gol3_tgl_pemakaian" value="" />
</td>

</tr>
</table>



<table border=0>	
<tr>
<td>Status Tanah</td>

</tr>
<tr>
<td>
<select id="inv_ldahi_gol3_status_tanah" name="inv_ldahi_gol3_status_tanah" >
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
<input type="text" name="inv_ldahi_gol3_pilih_aset_tanah" id="inv_ldahi_gol3_pilih_aset_tanah" value="" size=70 />
</td>
<td>
<input type="button" name="pilih" value="Pilih" >
</td>
</tr>
</table>

<table border=0>		
<tr>
<td>Nomor Kode  Tanah</td>
</tr>
<tr>
<td>
<input type="text" name="inv_ldahi_gol3_no_kode_tanah" id="inv_ldahi_gol3_no_kode_tanah" value="" size=70 />
</td>
<td>
<input type="button" name="pilih" value="Pilih" >
</td>
</tr>
</table>

<table border=0>
<tr>
<td>No. IMB</td>
<td>Tanggal IMB</td>

</tr>
<tr>
<td>
<input type="text" name="inv_ldahi_gol3_no_imb" id="inv_ldahi_gol3_no_imb" value="<?php echo $dataArrBangunan->NoIMB ?>" />
</td>
<td>
<input type="text" name="inv_ldahi_gol3_tgl_imb" id="inv_ldahi_tgl_imb" value="<?php echo $dataArrBangunan->TglIMB ?>" />
</td>

</tr>
</table>