
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
                        <select name="p_gdg_konstruksi">
                                <option value="1">Permanent</option>
                                <option value="2">Semi Permanent </option>
                                <option value="3">Darurat </option>
                        </select>
                </td>
                <td>
                        <select name="p_gdg_konstruksib">
                                <option value="1">Beton</option>
                                <option value="2">Bukan Beton</option>

                        </select>
                </td>
                <td>
	&nbsp;
                </td>  
                <td>
                        <input type="text" name="p_gdg_jumlah_lantai" value=""size=20 >
                </td>
                <td>
	&nbsp;
                </td>  
                <td>
				<script src="accounting.js"></script>
						<script type="text/javascript">
							function format_nilailuaslantai(){
							var get_nilai = document.getElementById('p_gdg_luaslantai1');
							document.getElementById('p_gdg_luaslantai').value=get_nilai.value;
							nilai = accounting.formatMoney(get_nilai.value, "", 0, ".", ",");
							get_nilai.value=nilai;
							
						}
			</script>
                        <input type="text" name="p_gdg_luaslantai1" id="p_gdg_luaslantai1" value="<?php echo number_format($dataArr->luaslantai,0,',','.')?>"required=" required" onchange="return format_nilailuaslantai();";>M<sup>2</sup>
						<input type="hidden" name="p_gdg_luaslantai" id="p_gdg_luaslantai" value="<?=$dataArr->luaslantai?>"size=20 >
                </td>  
        </tr>
</table>
<table border="0" cellspacing="6">
        <tr>
                <td>Spesifikasi Dinding</td>
        </tr>
        <tr>
                <td>
                        <input type="text" name="p_gdg_dinding" value=""size=45 >
                </td>
        </tr>
</table>
<table border="0" cellspacing="6">
        <tr>
                <td>Spesifikasi Lantai</td>
        </tr>
        <tr>
                <td>
                        <input type="text" name="p_gdg_lantai" value=""size=45 >
                </td>
        </tr>
</table>
<table border="0" cellspacing="6">
        <tr>
                <td>Spesifikasi Plafon</td>
        </tr>
        <tr>
                <td>
                        <input type="text" name="p_gdg_plafon" value=""size=45 >
                </td>
        </tr>
</table>
<table border="0" cellspacing="6">
        <tr>
                <td>Spesifikasi Atap</td>
        </tr>
        <tr>
                <td>
                        <input type="text" name="p_gdg_atap" value=""size=45 >
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
                        <input type="text" name="p_gdg_nodokumen" value="" >
                </td>
                <td>
                        <input id="tanggal6"type="text" name="p_gdg_tgldokumen" value="" >
                </td>

        </tr>
</table>
<table border="0" cellspacing="6">
        <tr>
                <td>Tanggal Pemakaian</td>
        </tr>
        <tr>
                <td>
                        <input id="tanggal5"type="text" name="p_gdg_tglpemakaian" value="" >
                </td>         
        </tr>
</table>
<table border="0" cellspacing="6">	
        <tr>
                <td>Status Tanah</td>

        </tr>
        <tr>
                <td>
                        <select name="p_gdg_ststustanah">
                                <option value="1" >Tanah Pemda</option>
                                <option value="2" >Tanah Negara</option>
                                <option value="3" >Tanah Ulayat/Adat</option>
                                <option value="4">Tanah Hak Guna Bangunan</option>
                                <option value="5">Tanah Pakai</option>
                                <option value="6" >Tanah Pengelolaan</option>
                                <option value="7" >Tanah Hak Lainnya</option>
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
                     <input type="text" name="p_gdg_asettanah" id="p_gdg_asettanah" style="width:450px;" readonly="readonly" value="">
											<input type="button" name="idbtnlookupasettanah2" id="idbtnlookupasettanah2" value="Pilih" 
                                                                         onclick = "showSpoiler(this);
                                                                               ">
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
               <input type="text" name="p_gdg_kodetanah" id="p_gdg_kodetanah" style="width:450px;" readonly="readonly" value="">
											<input type="button" name="idbtnlookupkelompok10" id="idbtnlookupkelompok10" value="Pilih" onclick = "showSpoiler(this);">
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
                        <input type="text" name="p_gdg_no_imb" value="" >
                </td>
                <td>
                        <input id="tanggal4"type="text" name="p_gdg_tglimb" value="" >
                </td>
        </tr>
</table>

