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
                    <td>Luas Lantai</td>
            </tr>
</table>
<table border="0" cellspacing="6">
            <tr>
                    <td>
                            <select name="p_gjal_konstruksi" disabled>
                            <option value="P"<?php if ($dataArr->KonstruksiKDP == 'P') echo 'selected'?>>Permanent</option>
                            <option value="SP"<?php if ($dataArr->KonstruksiKDP == 'SP') echo 'selected'?>>Semi Permanent </option>
                            <option value="D"<?php if ($dataArr->KonstruksiKDP == 'D') echo 'selected'?>>Darurat </option>
                            </select>
                    </td>
                    <td>
                            <select name="p_gjal_konstruksi1" disabled>
                                    <option value="1"<?php if ($dataArr->Beton == '1') echo 'selected'?>>Beton</option>
                                    <option value="0"<?php if ($dataArr->Beton == '0') echo 'selected'?>>Bukan Beton</option>
                            </select>
                    </td>
            <td>
            &nbsp;
            </td>  
                    <td>
                            <input type="text" name="p_gjal_panjang" value="<?=$dataArr->JumlahLantai?>"size=20 disabled>
                    </td>
                    <td>
                    &nbsp;
                    </td>  
                    <td>
                            <input type="text" name="p_gol6_luas_lantai" value="<?=$dataArr->LuasLantai?>" size=20 style="text-align:right;" disabled>m2
                    </td>  
            </tr>
</table>
<table border="0" cellspacing="6">
            <tr>
                    <td>Tanggal Pembangunan</td>
            </tr>
            <tr>
                    <td>
                            <input id="tanggal16"type="text" name="tanggal_pembangunan" value="<?=$dataArr->LuasLantai?>" disabled>
                    </td>

            </tr>
</table>
<table border="0" cellspacing="6">	
            <tr>
                    <td>Status Tanah</td>
            </tr>
            <tr>
                    <td>
                            <select name="p_gol6_statustanah" disabled>
                                   <option value="10"<?php if ($dataArr->StatusTanah == '10') echo 'selected'?>>Tanah Pemda</option>
                                    <option value="20"<?php if ($dataArr->StatusTanah == '20') echo 'selected'?>>Tanah Negara</option>
                                    <option value="30"<?php if ($dataArr->StatusTanah == '30') echo 'selected'?>>Tanah Ulayat/Adat</option>
                                    <option value="41"<?php if ($dataArr->StatusTanah == '41') echo 'selected'?>>Tanah Hak Guna Bangunan</option>
                                    <option value="42"<?php if ($dataArr->StatusTanah == '42') echo 'selected'?>>Tanah Pakai</option>
                                    <option value="43"<?php if ($dataArr->StatusTanah == '43') echo 'selected'?>>Tanah Pengelolaan</option>
                                    <option value="-"<?php if ($dataArr->StatusTanah == '-') echo 'selected'?>>Tanah Hak Lainnya</option>
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
                          <input type="text" name="p_gol6_pilih_asettanah" id="p_gol6_pilih_asettanah" style="width:450px;" disabled value="<?=$dataArr->KelompokTanah_IDKDP?>">
											<input type="button" name="idbtnlookupasettanah20" id="idbtnlookupasettanah20" value="Pilih" disabled>
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
													 $alamat_aset_tanah="";
													$alamat_search_aset_tanah="";
													js_radioasetanah($alamat_aset_tanah, $alamat_search_aset_tanah,"p_gol6_pilih_asettanah","aset_tanah_id_gol6",'aset_tanahgol6','aset_tanahgol6','p_gol6_nomor_kodetanah',"$url_rewrite/module/perolehan/api_aset_tanah.php?aset=");
													$style="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
													radioasetanah($style,"aset_tanah_id_gol6",'aset_tanahgol6','aset_tanahgol6');
                                                                                                                                                          
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
                     <input type="text" name="p_gol6_nomor_kodetanah" id="p_gol6_nomor_kodetanah" style="width:450px;" disabled value="<?=$dataArr->Tanah_IDKDP?>">
											<input type="button" name="idbtnlookupkelompok101" id="idbtnlookupkelompok101" value="Pilih" disabled>
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
													js_radiokelompoktanah($alamat_simpul_kelompok, $alamat_search_kelompok,"p_gol6_nomor_kodetanah","kelompok_tanah_idgol6",'kelompokgol6','ldakelompokfiltergol6');
													$style="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
													radiokelompoktanah($style,"kelompok_tanah_idgol6",'kelompokgol6','ldakelompokfiltergol6');
												?>
											</div>
                    </td>
            </tr>
</table>

