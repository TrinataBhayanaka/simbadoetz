<?php
    $query = "SELECT * FROM Mesin WHERE Aset_ID = $Aset_ID ";
    $result = mysql_query($query) or die (mysql_error());
    
    if (mysql_num_rows($result))
    {
        $data = mysql_fetch_object($result);
        
        $dataArrMesin = $data;
    }
    
    echo '<pre>';
    //print_r($dataArrMesin);
    echo '</pre>';


?>

<table border=0>
<tr>
<td>Merk Peralatan</td>
<td>Tipe/Model</td>
</tr>
<tr>
<td>
<input type="text" name="inv_ldahi_gol2_merk_peralatan" id="inv_ldahi_gol2_merk_peralatan" value="<?php echo $dataArrMesin->Merk ?>" size=30 />
</td>
<td>
<input type="text" name="inv_ldahi_gol2_tipe_model" id="inv_ldahi_gol2_tipe_model" value="<?php echo $dataArrMesin->Model ?>" size=30 />
</td>
</tr>
<tr>
<td>Ukuran</td>
<td>Silinder</td>
</tr>
</table>
<table border=0>
<tr>
<td>
<input type="text" name="inv_ldahi_gol2_ukuran" id="inv_ldahi_gol2_ukuran" value="<?php echo $dataArrMesin->Ukuran ?>" size=30 />
</td>
<td>
<input type="text" name="inv_ldahi_gol2_silinder" id="inv_ldahi_gol2_silinder" value="<?php echo $dataArrMesin->Silinder ?>" size=10 />
</td>
<td align=left width=10>cc</td>
</tr>
</table>
<table border=0>
<tr>
<td>Merk Mesin</td>
<td>Jumlah Mesin</td>
</tr>
<tr>
<td>
<input type="text" name="inv_ldahi_gol2_merk_mesin" id="inv_ldahi_gol2_merk_mesin" value="<?php echo $dataArrMesin->MerkMesin ?>" size=30 />
</td>
<td>
<input type="text" name="inv_ldahi_gol2_jml_mesin" id="inv_ldahi_gol2_jml_mesin" value="<?php echo $dataArrMesin->JumlahMesin ?>" size=10 />
</td>
</tr>
<tr>
<td>Bahan Material</td>
<td>No Seri Pabrik</td>
</tr>
<tr>
<td>
<input type="text" name="inv_ldahi_gol2_bahan_material" id="inv_ldahi_gol2_bahan_material" value="<?php echo $dataArrMesin->Material ?>" size=30 />
</td>
<td>
<input type="text" name="inv_ldahi_gol2_no_seri_pabrik" id="inv_ldahi_gol2_no_seri_pabrik" value="<?php echo $dataArrMesin->NoSeri ?>" size=30 />
</td>
</tr>
<tr>
<td>Nomor Rangka</td>
<td>Nomor Mesin</td>
</tr>
<tr>
<td>
<input type="text" name="inv_ldahi_gol2_no_rangka" id="inv_ldahi_gol2_no_rangka" value="<?php echo $dataArrMesin->NoRangka ?>" size=30 />
</td>
<td>
<input type="text" name="inv_ldahi_gol2_no_mesin" id="inv_ldahi_gol2_no_mesin" value="<?php echo $dataArrMesin->NoMesin ?>" size=30 />
</td>
</tr>
<tr>
<td>Nomor STNK</td>
<td>Tanggal STNK </td>
</tr>
<tr>
<td>
<input type="text" name="inv_ldahi_gol2_no_stnk" id="inv_ldahi_gol2_no_stnk" value="<?php echo $dataArrMesin->NoSTNK ?>" size=30 />
</td>
<td>
<input type="text" name="inv_ldahi_gol2_tgl_stnk" id="inv_ldahi_gol2_tgl_stnk" value="<?php echo $dataArrMesin->TglSTNK ?>" size=15 />
</td>
</tr>
<tr>
<td>Nomor BPKB</td>
<td>Tanggal BPKB</td>

</tr>
<tr>
<td>
<input type="text" name="inv_ldahi_gol2_no_bpkb" id="inv_ldahi_gol2_no_bpkb" value="<?php echo $dataArrMesin->NoBPKB ?>" size=30 />
</td>
<td>
<input type="text" name="inv_ldahi_gol2_tgl_bpkb" id="inv_ldahi_gol2_tgl_bpkb" value="<?php echo $dataArrMesin->TglBPKB ?>" size=15 />
</td>
</tr>
<tr>
<td>Nomor Dokumen lain</td>
<td>Tanggal Dokumen lain </td>
</tr>
<tr>
<td>
<input type="text" name="inv_ldahi_gol2_no_dok_lain" id="inv_ldahi_gol2_no_dok_lain" value="<?php echo $dataArrMesin->NoDokumen ?>" size=30 />
</td>
<td>
<input type="text" name="inv_ldahi_gol2_tgl_dok_lain" id="inv_ldahi_gol2_tgl_dok_lain" value="<?php echo $dataArrMesin->TglDokumen ?>" size=15 />
</td>
</tr>
<tr>
<td>Tahun Pembuatan</td>
<td>Bahan Bakar</td>
</tr>
<tr>
<td>
<input type="text" name="inv_ldahi_gol2_thn_pembuatan" id="inv_ldahi_gol2_thn_pembuatan" value="<?php echo $dataArrMesin->TahunBuat ?>" size=8 />
</td>
<td>
<input type="text" name="inv_ldahi_gol2_bahan_bakar" id="inv_ldahi_gol2_bahan_bakar" value="<?php echo $dataArrMesin->BahanBakar ?>" size=30 />
</td>
</tr>
<tr>
<td>Pabrik</td>
<td>Negara Asal </td>
</tr>
<tr>
<td>
<input type="text" name="inv_ldahi_gol2_pabrik" id="inv_ldahi_gol2_pabrik" value="<?php echo $dataArrMesin->Pabrik ?>" size=30 />
</td>
<td>
<input type="text" name="inv_ldahi_gol2_negara_asal" id="inv_ldahi_gol2_negara_asal" value="<?php echo $dataArrMesin->NegaraAsal ?>" size=30 />
</td>
</tr>
<tr>
<td>Kapasitas/Tonase</td>
<td>Bobot/Berat </td>
</tr>
<tr>
<td>
<input type="text" name="inv_ldahi_gol2_kapasitas_tonase" id="inv_ldahi_gol2_kapasitas_tonase" value="<?php echo $dataArrMesin->Kapasitas ?>" size=8 />
</td>
<td>
<input type="text" name="inv_ldahi_gol2_bobot_berat" id="inv_ldahi_gol2_bobot_berat" value="<?php echo $dataArrMesin->Bobot ?>" size=8 style="text-align:right;" />
</td>
</tr>
<tr>
<td>Negara Perakitan</td>
</tr>	
<tr>
<td>
<input type="text" name="inv_ldahi_gol2_negara_perakitan" id="inv_ldahi_gol2_negara_perakitan" value="<?php echo $dataArrMesin->NegaraRakit ?>" size=30 />
</td>
</tr>
</table>