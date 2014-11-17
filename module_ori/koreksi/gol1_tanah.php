<script src="accounting.js"></script>
						<script type="text/javascript">
							function format_nilaikeseluruhan(){
							var get_nilai = document.getElementById('p_gtanah_luaskeseluruhan1');
							document.getElementById('p_gtanah_luaskeseluruhan').value=get_nilai.value;
							nilai = accounting.formatMoney(get_nilai.value, "", 0, ".", ",");
							get_nilai.value=nilai;
							
						}
						function format_nilailuasbangunan(){
							var get_nilai = document.getElementById('p_gtanah_luasbangunan1');
							document.getElementById('p_gtanah_luasbangunan').value=get_nilai.value;
							nilai = accounting.formatMoney(get_nilai.value, "", 0, ".", ",");
							get_nilai.value=nilai;
							
						}
						function format_nilaisaranalingkungan(){
							var get_nilai = document.getElementById('p_gtanah_saranalingkungn1');
							document.getElementById('p_gtanah_saranalingkungn').value=get_nilai.value;
							nilai = accounting.formatMoney(get_nilai.value, "", 0, ".", ",");
							get_nilai.value=nilai;
							
						}
						function format_nilaitanahkosong(){
							var get_nilai = document.getElementById('p_gtanah_tanahkosong1');
							document.getElementById('p_gtanah_tanahkosong').value=get_nilai.value;
							nilai = accounting.formatMoney(get_nilai.value, "", 0, ".", ",");
							get_nilai.value=nilai;
							
						}
			</script>

<table border=0 cellspacing="6">
        <tr>
            <td>Luas Keseluruhan</td>
			<td><input type="text" name="p_gtanah_luaskeseluruhan1" id="p_gtanah_luaskeseluruhan1" size='20' value="<?= $dataArr->LuasTotal!=0 ? number_format($dataArr->LuasTotal,0,',','.') : 0 ?>"required=" required" onchange="return format_nilaikeseluruhan();";>M<sup>2</sup></td>
            <td><input type="hidden" name="p_gtanah_luaskeseluruhan" id="p_gtanah_luaskeseluruhan" size='20' value="<?=$dataArr->LuasTotal?>"></td>
            <td>Luas Untuk bangunan</td>
			<td><input type="text" name="p_gtanah_luasbangunan1" id="p_gtanah_luasbangunan1" size='20' value="<?= $dataArr->LuasBangunan!=0 ? number_format($dataArr->LuasBangunan,0,',','.') : 0 ?>"required=" required" onchange="return format_nilailuasbangunan();";>M<sup>2</sup></td>
            <td><input type="hidden" name="p_gtanah_luasbangunan" id="p_gtanah_luasbangunan" size='20' value="<?=$dataArr->LuasBangunan?>"></td>
        </tr>
        <tr>
            <td>Luas Sarana Lingkungan</td>
			<td><input type="text" name="p_gtanah_saranalingkungn1" id="p_gtanah_saranalingkungn1" value="<?= $dataArr->LuasSekitar!=0 ? number_format($dataArr->LuasSekitar,0,',','.') : 0 ?>"required=" required" onchange="return format_nilaisaranalingkungan();";>M<sup>2</sup></td> 
            <td><input type="hidden" name="p_gtanah_saranalingkungn" id="p_gtanah_saranalingkungn" value="<?= $dataArr->LuasSekitar?>" size='20'></td>
            <td>Luas Tanah Kosong</td>
			<td><input type="text" name="p_gtanah_tanahkosong1"id="p_gtanah_tanahkosong1" value="<?=$dataArr->LuasKosong!=0 ? number_format($dataArr->LuasKosong,0,',','.'): 0 ?>"required=" required" onchange="return format_nilaitanahkosong();";>M<sup>2</sup></td>
            <td><input type="hidden" name="p_gtanah_tanahkosong" id="p_gtanah_tanahkosong" value="<?=$dataArr->LuasKosong?>" size='20'></td>
        </tr>

</table>
	
<table border=0 cellspacing="6">
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
<table border=0 cellspacing="6">
        <tr>
            <td>
            <select  name="p_gtanah_hakpakai">
                   <option value="1"<?php if ($dataArr->HakTanah == '1') echo 'selected'?>>Hak Pakai</option>
                        <option value="0"<?php if ($dataArr->HakTanah == '0') echo 'selected'?>>Hak Perolehan</option>
            </select>
            </td>
            <td>
                 &nbsp;
            </td>  
            <td>
                <input type="text" name="p_gtanah_nosertifikat" value="<?=$dataArr->no_sertifikat_tanah?>"size=20 >
            </td>
            <td>
                &nbsp;
            </td>  
            <td>
                <input type="text" id="tanggal12" name="p_gtanah_tglsertifikat" value="<?=$dataArr->tgl_sertifikat_tanah?>"size=20 >
            </td>  
        </tr>
</table>
<table border=0 cellspacing="6">
        <tr>
            <td>Penggunaan</td>
        </tr>	
</table>	
<table border=0 cellspacing="6">
        <tr>
            <td>
                <select name="p_gtanah_penggunaan">
                    <option value="Gedung Pemerintah"<?php if ($dataArr->Penggunaan == 'Gedung Pemerintah') echo 'selected'?>>Gedung Pemerintah</option>
                    <option value="Jalan"<?php if ($dataArr->Penggunaan == 'Jalan') echo 'selected'?>>Jalan</option>
                    <option value="Irigasi"<?php if ($dataArr->Penggunaan == 'Irigasi') echo 'selected'?>>Irigasi</option>
                    <option value="Perkampungan"<?php if ($dataArr->Penggunaan == 'Perkampungan') echo 'selected'?>>Perkampungan</option>
                    <option value="Taman"<?php if ($dataArr->Penggunaan == 'Taman') echo 'selected'?>>Taman</option>
                    <option value="Perkebunan"<?php if ($dataArr->Penggunaan == 'Perkebunan') echo 'selected'?>>Perkebunan</option>
                    <option value="Sawah"<?php if ($dataArr->Penggunaan == 'Sawah') echo 'selected'?>>Sawah</option>
                    <option value="Lainnya"<?php if ($dataArr->Penggunaan == 'Lainnya') echo 'selected'?>>Lainnya</option>
                </select>
            </td>

        </tr>
</table>
<table border="0" cellspacing="6">
        <tr>
            <td>Batas Utara</td>
        </tr>
        <tr>
            <td>
                <input type="text" name="p_gtanah_batasutara" value="<?=$dataArr->BatasUtara?>"size=45 >
            </td>
        </tr>
</table>
<table border="0" cellspacing="6">
        <tr>
            <td>Batas Selatan</td>
        </tr>
        <tr>
            <td>
                <input type="text" name="p_gtanah_batasselatan" value="<?=$dataArr->BatasSelatan?>"size=45 >
            </td>
        </tr>
</table>

<table border="0" cellspacing="6">
        <tr>
            <td>Batas Barat</td>
        </tr>
        <tr>
            <td>
                <input type="text" name="p_gtanah_batasbarat" value="<?=$dataArr->BatasBarat?>"size=45 >
            </td>
         </tr>
</table>

<table border="0" cellspacing="6">
        <tr>
            <td>Batas Timur</td>
        </tr>
        <tr>
            <td>
                <input type="text" name="p_gtanah_batastimur" value="<?=$dataArr->BatasTimur?>"size=45 >
            </td>
        </tr>
</table>
