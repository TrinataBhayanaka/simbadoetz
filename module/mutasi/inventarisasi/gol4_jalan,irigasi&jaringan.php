
<table border="0" cellspacing="6">	
        <tr>
                <td>Konstruksi</td>
        </tr>
        <tr>
                <td>
                        <input type="text" name="p_jaringan_konstruksi" value="<?=$dataArr->KonstruksiJaringan?>"size=70 disabled>
                </td>
        </tr>
</table>
<table border="0" cellspacing="6">
        <tr>
                <td>Panjang</td>
                <td><input type="text" name="p_jaringan_panjang" size="5" value="<?=$dataArr->Panjang?>" disabled>m</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>Lebar</td>
                <td><input type="text" name="p_jaringan_lebar" size="5" value="<?=$dataArr->Lebar?>" disabled>m</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>Luas</td>
                <td><input type="text" name="p_jaringan_luas" size="5"  value="<?=$dataArr->LuasJaringan?>" disabled>m2</td>
        </tr>
</table>
<table border="0" cellspacing="6">
        <tr>
                <td>No. Dokumen</td>
                <td>Tanggal Dokumen</td>
        </tr>
        <tr>
                <td>
                        <input type="text" name="p_jaringan_nodokumen" value="<?=$dataArr->NoDokumenJaringan?>" disabled>
                </td>
                <td>
                        <input id="tanggal3"type="text" name="p_jaringan_tgldookumen" value="<?=$dataArr->TglDokumenJaringan?>" disabled>
                </td>
        </tr>
</table>
<table border="0" cellspacing="6">
        <tr>
                <td>Tanggal Pemakaian</td>
        </tr>
        <tr>
                <td>
                <input id="tanggal2" type="text" name="p_jaringan_tglpemakaian" value="<?=$dataArr->TanggalPemakaian?>" disabled>
                </td>
        </tr>
</table>
<table border="0" cellspacing="6">	
        <tr>
                <td>Status Tanah</td>
        </tr>
        <tr>
                <td>
                        <select name="p_jaringan_statustanah" disabled>
                              <option value="10"<?php if ($dataArr->StatusTanahJaringan == '10') echo 'selected'?> >Tanah Pemda</option>
                                <option value="20"<?php if ($dataArr->StatusTanahJaringan == '20') echo 'selected'?> >Tanah Negara</option>
                                <option value="30"<?php if ($dataArr->StatusTanahJaringan == '30') echo 'selected'?>>Tanah Ulayat/Adat</option>
                                <option value="41"<?php if ($dataArr->StatusTanahJaringan == '41') echo 'selected'?>>Tanah Hak Guna Bangunan</option>
                                <option value="42"<?php if ($dataArr->StatusTanahJaringan == '42') echo 'selected'?>>Tanah Pakai</option>
                                <option value="43"<?php if ($dataArr->StatusTanahJaringan == '43') echo 'selected'?> >Tanah Pengelolaan</option>
                                <option value="-"<?php if ($dataArr->StatusTanahJaringan == '-') echo 'selected'?> >Tanah Hak Lainnya</option>
                        </select>
                </td> 
        </tr>
</table>
<table border="0" cellspacing="6">		
        <tr>
                <td>Pilih Aset Tanah</td>
        </tr>
        <tr>
                <td>
                <input type="text" name="lda_kelompok" id="p_gjal_pilihaset_tanah" style="width:450px;" disabled value="<?=$dataArr->KelompokTanah_IDJaringan?>">
											<input type="button" name="idbtnlookupasettanah" id="idbtnlookupasettanah" value="Pilih" disabled>
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
													js_radioasetanah($alamat_aset_tanah, $alamat_search_aset_tanah,"p_gjal_pilihaset_tanah","aset_tanah_id_gol4",'aset_tanahgol4','aset_tanahgol4','p_gjal_nomorkode_tanah',"$url_rewrite/module/perolehan/api_aset_tanah.php?aset=");
													$style="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
													radioasetanah($style,"aset_tanah_id_gol4",'aset_tanahgol4','aset_tanahgol4');
                                                                                                                                                          
												?>
											</div>
                </td>
        </tr>
</table>
<table border="0" cellspacing="6">		
        <tr>
                <td>Nomor Kode  Tanah</td>
        </tr>
        <tr>
                <td>
                     <input type="text" name="p_jaringan_nomorkode_tanah" id="p_gjal_nomorkode_tanah" style="width:450px;" disabled value="<?=$dataArr->Tanah_IDJaringan?>">
											<input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" value="Pilih" disabled>
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
													js_radiokelompoktanah($alamat_simpul_kelompok, $alamat_search_kelompok,"p_gjal_nomorkode_tanah","kelompok_tanah_idgol4",'kelompokgol4','ldakelompokfiltergol4');
													$style="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
													radiokelompoktanah($style,"kelompok_tanah_idgol4",'kelompokgol4','ldakelompokfiltergol4');
												?>
											</div>
                     
                </td>
        </tr>
</table>

