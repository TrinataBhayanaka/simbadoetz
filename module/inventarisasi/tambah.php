
<html>
<head><title>...</title>

</head>


<div>
<table border=1 width="100%">
        <tr bgcolor="#004933" style="color:white;">
        <td>
        <strong>Inventarisasi</strong>
        </td>
    </tr>
</table>
</div>
<?php 
$selectDataKondisi = "SELECT TglKondisi,NoDokumen, TglDokumen,
					Baik,RusakRingan,RusakBerat,BelumManfaat,BelumSelesai,BelumDikerjakan,TidakSempurna,
					TidakSesuaiUntuk,TidakSesuaiSpec,TidakDikunjungi,TidakJelas	
					FROM kondisi WHERE Aset_ID =$dataArr->Aset_ID ORDER BY TglKondisi DESC";
// pr($selectDataKondisi);
$exe_selectDataKondisi = mysql_query($selectDataKondisi) or die(mysql_error());
$DataKondisi = mysql_fetch_array($exe_selectDataKondisi); 
// pr($DataKondisi);
if($DataKondisi['TglKondisi'] != ''){
	list($tahunKondisi, $bulanKondisi, $tanggalKondisi)= explode('-', $DataKondisi['TglKondisi']);
	$tglKondisi = "$tanggalKondisi/$bulanKondisi/$tahunKondisi";
}else{
	$tglKondisi ="";
}

if($DataKondisi['TglDokumen'] !=''){
	list($tahunDokumen, $bulanDokumen, $tanggalDokumen)= explode('-', $DataKondisi['TglDokumen']);
	$tglDokumen = "$tanggalDokumen/$bulanDokumen/$tahunDokumen";
}else{
	$tglDokumen ="";
}
?>          



<div>
<table border=0>
      <input type="hidden" id="p_gol7_kuantitas" name="p_gol7_kuantitas" value="<?=$dataArr->Kuantitas ?>" style="text-align:right;" onchange="nilai()">
        <tr>
            <td>Tanggal Kondisi</td>
            <td>Nomor Dokumen</td>
            <td>Tanggal Dokumen</td>
        </tr>
        <tr>
            <td>
                    <input  id="tanggal30" type="text"  name="inv_ldahi_tbh_tglkondisi" value ="<?=$tglKondisi?>" required>
            </td>
			
            <td>
                    <input type="text"  name="inv_ldahi_tbh_no_dokumen" id="inv_ldahi_tbh_no_dokumen"  value ="<?=$DataKondisi['NoDokumen'] ?>" required>
            </td>
            <td>
                    <input id="tanggal29" type="text"  name="inv_ldahi_tbh_tgldokumen" value ="<?=$tglDokumen?>" required>
            </td>
        </tr>
</table>
<table border=0>
        <tr>
		<td>jumlah aset</td>
            <td><input name="jumlahaset" id="jumlahaset" size="20"  value ="<?=$dataArr->Kuantitas ?>" disabled required></td>
        </tr>
		<tr>
            <td>Baik</td>
            <td><input type="number" name="inv_ldahi_tbh_baik" id="inv_ldahi_tbh_baik" size="20"  value ="<?=$DataKondisi['Baik'] ?>" class="kuantitas" disabled onchange="jumlah(this)"></td>
            <td>Tidak sempurna</td>
            <td><input type="number" name="inv_ldahi_tbh_tdk_sempurna" id="inv_ldahi_tbh_tdk_sempurna" size="20"  value ="<?=$DataKondisi['TidakSempurna'] ?>" class="kuantitas" disabled required onchange="jumlah(this)"></td>
        </tr>
        <tr>
            <td>Rusak ringan</td>
            <td><input type="number" name="inv_ldahi_tbh_rusak_ringan" id="inv_ldahi_tbh_rusak_ringan" size="20"  value ="<?=$DataKondisi['RusakRingan'] ?>" class="kuantitas" disabled required onchange="jumlah(this)"></td>
            <td>Tidak sesuai peruntukan</td>
            <td><input type="number" name="inv_ldahi_tbh_tdk_sesuai_peruntukan" id="inv_ldahi_tbh_tdk_sesuai_peruntukan" size="20"  value ="<?=$DataKondisi['TidakSesuaiUntuk'] ?>"class="kuantitas" disabled required onchange="jumlah(this)"></td>
        <tr>
            <td>Rusak berat</td>
            <td><input type="number" name="inv_ldahi_tbh_rusak_berat" id="inv_ldahi_tbh_rusak_berat" size="20"  value ="<?=$DataKondisi['RusakBerat'] ?>"class="kuantitas" disabled required onchange="jumlah(this)"></td>
            <td>Tidak sesuai spesifikasi</td>
            <td><input type="number" name="inv_ldahi_tbh_tdk_sesuai_spesifikasi" id="inv_ldahi_tbh_tdk_sesuai_spesifikasi" size="20"  value ="<?=$DataKondisi['TidakSesuaiSpec'] ?>"class="kuantitas" disabled required onchange="jumlah(this)"></td>
        </tr>
        <tr>
            <td>Belum dimanfaatkan</td>
            <td><input type="number" name="inv_ldahi_tbh_blm_dimanfaatkan" id="inv_ldahi_tbh_blm_dimanfaatkan" size="20"  value ="<?=$DataKondisi['BelumManfaat'] ?>"class="kuantitas" disabled required onchange="jumlah(this)"></td>
            <td>Tidak dapat dikunjungi</td>
            <td><input type="number" name="inv_ldahi_tbh_tdk_dpt_dikunjungi" id="inv_ldahi_tbh_tdk_dpt_dikunjungi" size="20"  value ="<?=$DataKondisi['TidakDikunjungi'] ?>"class="kuantitas" disabled required onchange="jumlah(this)"></td>
        </tr>
        <tr>
            <td>Belum selesai</td>
            <td><input type="number" name="inv_ldahi_tbh_blm_selesai" id="inv_ldahi_tbh_blm_selesai" size="20"  value ="<?=$DataKondisi['BelumSelesai'] ?>"class="kuantitas" disabled required onchange="jumlah(this)"></td>
            <td>Alamat tidak jelas</td>
            <td><input type="number" name="inv_ldahi_tbh_almt_tdk_jelas" id="inv_ldahi_tbh_almt_tdk_jelas" size="20"  value ="<?=$DataKondisi['TidakJelas'] ?>"class="kuantitas" disabled required onchange="jumlah(this)"></td>
        </tr>
        <tr>
            <td>Belum dikerjakan</td>
            <td><input type="number" name="inv_ldahi_tbh_blm_dikerjakan" id="inv_ldahi_tbh_blm_dikerjakan" size="20"  value ="<?=$DataKondisi['BelumDikerjakan'] ?>"class="kuantitas" disabled required onchange="jumlah(this)"></td>
            <td>Kegiatan tidak ditemukan</td>
            <td><input type="number" name="inv_ldahi_tbh_kegiatan_tdk_ditemukan" id="inv_ldahi_tbh_kegiatan_tdk_ditemukan" size="20"  value ="<?=$DataKondisi['TidakDitemukan'] ?>"class="kuantitas" disabled required onchange="jumlah(this)"></td>
        </tr>
</table>
<table border=0>
<!-- 
        <tr width=100%>
            <td>Keterangan Inventarisasi</td>
        </tr>
        <tr>			
            <td>
            <textarea name="inv_ldahi_tbh_ket_inventarisasi" id="inv_ldahi_tbh_ket_inventarisasi" rows="5" cols="80" ></textarea>
            </td>
        </tr>
-->
</table>

</div>   

<div>

<table border=1 width="100%">
        <tr bgcolor="#004933" style="color:white;">
            <td>
            <strong>Keterangan Tambahan</strong>
            </td>
        </tr>
</table>
</div>

<div><table border=0>
<!--
        <tr>
            <td>
            <textarea name="inv_ldahi_infoaset" rows="5" cols="80""><?=$dataArr->Info ?></textarea>
            </td>
        </tr>
-->
</table>		
</div>


</html>
