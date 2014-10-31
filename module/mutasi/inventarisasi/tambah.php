
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
          



<div>
<table border=0>
      <input type="hidden" id="p_gol7_kuantitasa" name="p_gol7_kuantitasa" value="1" style="text-align:right;" onchange="nilai()">
        <tr>
            <td>Tanggal Kondisi</td>
            <td>Nomor Dokumen</td>
            <td>Tanggal Dokumen</td>
        </tr>
        <tr>
            <td>
                    <input  id="tanggal30" type="text"  name="inv_ldahi_tbh_tglkondisi" value ="<?=$dataArr->TglKondisi?>">
            </td>
            <td>
                    <input type="text" name="inv_ldahi_tbh_no_dokumen" id="inv_ldahi_tbh_no_dokumen"  value ="<?=$dataArr->NoDokumen ?>">
            </td>
            <td>
                    <input id="tanggal29" type="text" name="inv_ldahi_tbh_tgldokumen" value ="<?=$dataArr->TglDokumeninventaris ?>">
            </td>
        </tr>
</table>
<table border=0>
        <tr>
            <td>Baik</td>
            <td><input type="text" name="inv_ldahi_tbh_baik" id="inv_ldahi_tbh_baik" size="20"  value ="<?=$dataArr->Baik ?>" class="kuantitas" disabled onchange="jumlah(this)"></td>
            <td>Tidak sempurna</td>
            <td><input type="text" name="inv_ldahi_tbh_tdk_sempurna" id="inv_ldahi_tbh_tdk_sempurna" size="20"  value ="<?=$dataArr->TidakSempurna ?>" class="kuantitas" disabled onchange="jumlah(this)"></td>
        </tr>
        <tr>
            <td>Rusak ringan</td>
            <td><input type="text" name="inv_ldahi_tbh_rusak_ringan" id="inv_ldahi_tbh_rusak_ringan" size="20"  value ="<?=$dataArr->RusakRingan ?>" class="kuantitas" disabled onchange="jumlah(this)"></td>
            <td>Tidak sesuai peruntukan</td>
            <td><input type="text" name="inv_ldahi_tbh_tdk_sesuai_peruntukan" id="inv_ldahi_tbh_tdk_sesuai_peruntukan" size="20"  value ="<?=$dataArr->TidakSesuaiUntuk ?>"class="kuantitas" disabled onchange="jumlah(this)"></td>
        <tr>
            <td>Rusak berat</td>
            <td><input type="text" name="inv_ldahi_tbh_rusak_berat" id="inv_ldahi_tbh_rusak_berat" size="20"  value ="<?=$dataArr->RusakBerat ?>"class="kuantitas" disabled onchange="jumlah(this)"></td>
            <td>Tidak sesuai spesifikasi</td>
            <td><input type="text" name="inv_ldahi_tbh_tdk_sesuai_spesifikasi" id="inv_ldahi_tbh_tdk_sesuai_spesifikasi" size="20"  value ="<?=$dataArr->TidakSesuaiSpec ?>"class="kuantitas" disabled onchange="jumlah(this)"></td>
        </tr>
        <tr>
            <td>Belum dimanfaatkan</td>
            <td><input type="text" name="inv_ldahi_tbh_blm_dimanfaatkan" id="inv_ldahi_tbh_blm_dimanfaatkan" size="20"  value ="<?=$dataArr->BelumManfaat ?>"class="kuantitas" disabled onchange="jumlah(this)"></td>
            <td>Tidak dapat dikunjungi</td>
            <td><input type="text" name="inv_ldahi_tbh_tdk_dpt_dikunjungi" id="inv_ldahi_tbh_tdk_dpt_dikunjungi" size="20"  value ="<?=$dataArr->TidakDikunjungi ?>"class="kuantitas" disabled onchange="jumlah(this)"></td>
        </tr>
        <tr>
            <td>Belum selesai</td>
            <td><input type="text" name="inv_ldahi_tbh_blm_selesai" id="inv_ldahi_tbh_blm_selesai" size="20"  value ="<?=$dataArr->BelumSelesai ?>"class="kuantitas" disabled onchange="jumlah(this)"></td>
            <td>Alamat tidak jelas</td>
            <td><input type="text" name="inv_ldahi_tbh_almt_tdk_jelas" id="inv_ldahi_tbh_almt_tdk_jelas" size="20"  value ="<?=$dataArr->TidakJelas ?>"class="kuantitas" disabled onchange="jumlah(this)"></td>
        </tr>
        <tr>
            <td>Belum dikerjakan</td>
            <td><input type="text" name="inv_ldahi_tbh_blm_dikerjakan" id="inv_ldahi_tbh_blm_dikerjakan" size="20"  value ="<?=$dataArr->BelumDikerjakan ?>"class="kuantitas" disabled onchange="jumlah(this)"></td>
            <td>Kegiatan tidak ditemukan</td>
            <td><input type="text" name="inv_ldahi_tbh_kegiatan_tdk_ditemukan" id="inv_ldahi_tbh_kegiatan_tdk_ditemukan" size="20"  value ="<?=$dataArr->TidakDitemukan ?>"class="kuantitas" disabled onchange="jumlah(this)"></td>
        </tr>
</table>
<table border=0>
        <tr width=100%>
            <td>Keterangan Inventarisasi</td>
        </tr>
        <tr>			
            <td>
            <textarea name="inv_ldahi_tbh_ket_inventarisasi" id="inv_ldahi_tbh_ket_inventarisasi" rows="5" cols="80" ></textarea>
            </td>
        </tr>
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
        <tr>
            <td>
            <textarea name="inv_ldahi_infoaset" rows="5" cols="80""><?=$dataArr->Info ?></textarea>
            </td>
        </tr>
</table>		
</div>


</html>
