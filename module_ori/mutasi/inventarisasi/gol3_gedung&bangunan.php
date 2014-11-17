
<table border="0" cellspacing="6">
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

                <td>Jumlah Lantai</td>
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
<table border="0" cellspacing="6">
        <tr>
                <td>
                        <select name="p_gdg_konstruksi" disabled>
                              <option value="1"<?php if ($dataArr->Konstruksi == '1') echo 'selected'?>>Permanent</option>
                                <option value="2"<?php if ($dataArr->Konstruksi == '2') echo 'selected'?>>Semi Permanent </option>
                                <option value="3"<?php if ($dataArr->Konstruksi == '3') echo 'selected'?>>Darurat </option>
                        </select>
                </td>
                <td>
                        <select name="p_gdg_konstruksib" disabled>
                                <option value="1"<?php if ($dataArr->Beton == '1') echo 'selected'?>>Beton</option>
                                <option value="2"<?php if ($dataArr->Beton == '2') echo 'selected'?>>Bukan Beton</option>

                        </select>
                </td>
                <td>
	&nbsp;
                </td>  
                <td>
                        <input type="text" name="p_gdg_jumlah_lantai" value="<?=$dataArr->jumlahLantaiBangunan?>"size="20" disabled>
                </td>
                <td>
	&nbsp;
                </td>  
                <td>
                        <input type="text" name="p_gdg_luaslantai" value="<?=$dataArr->LuasLantaiBangunan?>"size="20" disabled>m2
                </td>  
        </tr>
</table>
<table border="0" cellspacing="6">
        <tr>
                <td>Spesifikasi Dinding</td>
        </tr>
        <tr>
                <td>
                        <input type="text" name="p_gdg_dinding" value="<?=$dataArr->Dinding?>"size="45" disabled>
                </td>
        </tr>
</table>
<table border="0" cellspacing="6">
        <tr>
                <td>Spesifikasi Lantai</td>
        </tr>
        <tr>
                <td>
                        <input type="text" name="p_gdg_lantai" value="<?=$dataArr->Lantai?>"size="45" disabled>
                </td>
        </tr>
</table>
<table border="0" cellspacing="6">
        <tr>
                <td>Spesifikasi Plafon</td>
        </tr>
        <tr>
                <td>
                        <input type="text" name="p_gdg_plafon" value="<?=$dataArr->LangitLangit?>"size="45" disabled>
                </td>
        </tr>
</table>
<table border="0" cellspacing="6">
        <tr>
                <td>Spesifikasi Atap</td>
        </tr>
        <tr>
                <td>
                        <input type="text" name="p_gdg_atap" value="<?=$dataArr->Atap?>"size="45" disabled>
                </td>
        </tr>
</table>
<table border="0" cellspacing="6">
        <tr>
                <td>No. Dokumen</td>
                <td>Tanggal Dokumen</td>

        </tr>
        <tr>
                <td>
                        <input type="text" name="p_gdg_nodokumen" value="<?=$dataArr->NoSurat?>" disabled>
                </td>
                <td>
                        <input id="tanggal6"type="text" name="p_gdg_tgldokumen" value="<?=$dataArr->TglSurat?>" disabled>
                </td>

        </tr>
</table>
<table border="0" cellspacing="6">
        <tr>
                <td>Tanggal Pemakaian</td>
        </tr>
        <tr>
                <td>
                        <input id="tanggal5"type="text" name="p_gdg_tglpemakaian" value="<?=$dataArr->TglPakai?>" disabled>
                </td>         
        </tr>
</table>
<table border="0" cellspacing="6">	
        <tr>
                <td>Status Tanah</td>

        </tr>
        <tr>
                <td>
                        <select name="p_gdg_ststustanah" disabled>
                                 <option value="1"<?php if ($dataArr->StatusTanah == '1') echo 'selected'?> >Tanah Pemda</option>
                                <option value="2"<?php if ($dataArr->StatusTanah == '2') echo 'selected'?>>Tanah Negara</option>
                                <option value="3"<?php if ($dataArr->StatusTanah == '3') echo 'selected'?>>Tanah Ulayat/Adat</option>
                                <option value="4"<?php if ($dataArr->StatusTanah == '4') echo 'selected'?>>Tanah Hak Guna Bangunan</option>
                                <option value="5"<?php if ($dataArr->StatusTanah == '5') echo 'selected'?>>Tanah Pakai</option>
                                <option value="6"<?php if ($dataArr->StatusTanah == '6') echo 'selected'?>>Tanah Pengelolaan</option>
                                <option value="7"<?php if ($dataArr->StatusTanah == '7') echo 'selected'?> >Tanah Hak Lainnya</option>
                        </select>

                </td> 

        </tr>
</table>
<table border="0" cellspacing="6">		
        <tr>
                <td>Pilih Aset Tanah </td>
        </tr>
        <tr>
                <td>
                     <input type="text" name="p_gdg_asettanah" id="p_gdg_asettanah" style="width:450px;" disabled value="<?=$dataArr->KelompokTanah_IDBangunan?>">
                    <input type="button" name="idbtnlookupasettanah2" id="idbtnlookupasettanah2" value="Pilih" 
                                                                         disabled>
                    <div class="inner" style="display:none;" id="content_aset_tanahgol3">
                            <style>
                                    .tabel th {
                                            background-color: #eeeeee;
                                            border: 1px solid #dddddd;
                                    }
                                    .tabel td {
                                            border: 1px solid #dddddd;
                                    }
                            </style>
                            <?php

                                        $alamat_aset_tanah="";
                                    $alamat_search_aset_tanah="";
                                    js_radioasetanah($alamat_aset_tanah, $alamat_search_aset_tanah,"p_gdg_asettanah","aset_tanah_id_gol3",'aset_tanahgol3','aset_tanahgol3','p_gdg_kodetanah',"$url_rewrite/module/perolehan/api_aset_tanah.php?aset=");
                                    $style="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
                                    radioasetanah($style,"aset_tanah_id_gol3",'aset_tanahgol3','aset_tanahgol3');

                            ?>
                    </div>
                </td>
        </tr>
</table>
		
<table border="0" cellspacing="6">		
        <tr>
                <td>Nomor Kode  Tanah </td>
        </tr>
        <tr>
            
                <td>
               <input type="text" name="p_gdg_kodetanah" id="p_gdg_kodetanah" style="width:450px;" disabled value="<?=$dataArr->Tanah_IDBangunan?>">
                <input type="button" name="idbtnlookupkelompok10" id="idbtnlookupkelompok10" value="Pilih" disabled>
                <div class="inner" style="display:none;">
                        <style>
                                .tabel th {
                                        background-color: #eeeeee;
                                        border: 1px solid #dddddd;
                                }
                                .tabel td {
                                        border: 1px solid #dddddd;
                                }
                        </style>
                        <?php
                                //include "$path/function/dropdown/function_kelompok.php";
                                $alamat_simpul_kelompok="$url_rewrite/function/dropdown/simpul_kelompok.php";
                                $alamat_search_kelompok="$url_rewrite/function/dropdown/search_kelompok.php";
                                js_radiokelompoktanah($alamat_simpul_kelompok, $alamat_search_kelompok,"p_gdg_kodetanah","kelompok_tanah_idgol3",'kelompokgol3','ldakelompokfiltergol3');
                                $style="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
                                radiokelompoktanah($style,"kelompok_tanah_idgol3",'kelompokgol3','ldakelompokfiltergol3');
                        ?>
                </div>
                </td>
        </tr>
</table>
<table border="0" cellspacing="6">
        <tr>
                <td>No. IMB</td>
                <td>Tanggal IMB</td>
        </tr>
                <tr>
                <td>
                        <input type="text" name="p_gdg_no_imb" value="<?=$dataArr->NoIMB?>" disabled>
                </td>
                <td>
                        <input id="tanggal4"type="text" name="p_gdg_tglimb" value="<?=$dataArr->TglIMB?>" disabled>
                </td>
        </tr>
</table>

