
<table border=0 cellspacing="6">
        <tr>
            <td>Luas Keseluruhan</td>
            <td><input type="text" name="p_gtanah_luaskeseluruhan" size=20 value="<?=$dataArr->LuasTotal?>" disabled></td>
            <td>Luas Untuk bangunan</td>
            <td><input type="text" name="p_gtanah_luasbangunan" size=20 value="<?=$dataArr->LuasBangunan?>" disabled></td>
        </tr>
        <tr>
            <td>Luas Sarana Lingkungan</td>
            <td><input type="text" name="p_gtanah_saranalingkungn"value="<?=$dataArr->LuasSekitar?>" size=20 disabled></td>
            <td>Luas Tanah Kosong</td>
            <td><input type="text" name="p_gtanah_tanahkosong" value="<?=$dataArr->LuasKosong?>"size=20 disabled></td>
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
            <select  name="p_gtanah_hakpakai" disabled>
                   <option value="1"<?php if ($dataArr->HakTanah == '1') echo 'selected'?>>Hak Pakai</option>
                        <option value="0"<?php if ($dataArr->HakTanah == '0') echo 'selected'?>>Hak Perolehan</option>
            </select>
            </td>
            <td>
                 &nbsp;
            </td>  
            <td>
                <input type="text" name="p_gtanah_nosertifikat" value="<?=$dataArr->no_sertifikat_tanah?>"size=20 disabled>
            </td>
            <td>
                &nbsp;
            </td>  
            <td>
                <input type="text" id="tanggal12" name="p_gtanah_tglsertifikat" value="<?=$dataArr->tgl_sertifikat_tanah?>"size=20 disabled>
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
                <select name="p_gtanah_penggunaan" disabled>
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
                <input type="text" name="p_gtanah_batasutara" value="<?=$dataArr->BatasUtara?>"size=45 disabled>
            </td>
        </tr>
</table>
<table border="0" cellspacing="6">
        <tr>
            <td>Batas Selatan</td>
        </tr>
        <tr>
            <td>
                <input type="text" name="p_gtanah_batasselatan" value="<?=$dataArr->BatasSelatan?>"size=45 disabled >
            </td>
        </tr>
</table>

<table border="0" cellspacing="6">
        <tr>
            <td>Batas Barat</td>
        </tr>
        <tr>
            <td>
                <input type="text" name="p_gtanah_batasbarat" value="<?=$dataArr->BatasBarat?>"size=45 disabled>
            </td>
         </tr>
</table>

<table border="0" cellspacing="6">
        <tr>
            <td>Batas Timur</td>
        </tr>
        <tr>
            <td>
                <input type="text" name="p_gtanah_batastimur" value="<?=$dataArr->BatasTimur?>"size=45 disabled>
            </td>
        </tr>
</table>
