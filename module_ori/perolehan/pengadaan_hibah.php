
<table cellspacing="6">
	<tr>
			<td colspan=>Pemberi HIBAH</td>
			<td></td>
			<td></td>
	</tr>
	<tr>
			<td colspan=3><input type="text"name="p_hibah_pemberi"value="" value size="60"></td>
			<td></td>
			<td></td>
	</tr>
</table>
<table cellspacing="6">
	<tr>
			<td rowspan=4></td>
		
                        <td>Nomor BAST &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            Tanggal BAST</td>
	
	</tr>
        </table>
         <table cellspacing="6">
                                        <tr>
                                                <td>
                                                        <input type="text" name="p_hibah_nobbast" id="lda_bast" style="width:450px;" value="">
                                                        <input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" value="Pilih" onclick = "showSpoiler(this);">&nbsp;&nbsp;&nbsp;<input id="tanggal17"type="text"name="p_hibah_tglbast"value="">
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
                                                                    
                                                                      //  include "$path/function/dropdown/radio_function_skpd_pengadaan.php";
                                                                        $alamat_simpul_bast="$url_rewrite/function/dropdown/radio_simpul_bast.php";
                                                                        $alamat_search_bast="$url_rewrite/function/dropdown/radio_search_bast.php";
                                                                        js_radiobast($alamat_simpul_bast, $alamat_search_bast,"lda_bast","bast_id",'bast','sk2','as','sa');
                                                                        $style2="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
                                                                        radiobast($style2,"bast_id",'bast','sk2','as','sa');
                                                                      
                                                                        ?>
                                                        </div>
                                                </td>
                                        </tr>
                                            
               </table>
<table cellspacing="6">
	<tr>
			<td>Nama Pihak Pertama</td>
			<td></td>
			<td></td>
	</tr>
	<tr>
			<td colspan=3><input type="text"name="p_hibah_namapertama"value="" value size="60"></td>
			<td></td>
			<td></td>
	</tr>
	<tr>
			<td>Jabatan Pihak Pertama</td>
			<td>Nip Pihak Pertama</td>
	</tr>
	<tr>
			<td><input type="text"name="p_hibah_jabatan_pertama"value="" value size="30"></td>

			<td><input type="text"name="p_hibah_nippertama"value="" value size="27"></td>
	</tr>
	<tr>
			<td>Nama Pihak Kedua</td>
			<td></td>
			<td></td>
	</tr>
	<tr>
			<td colspan=3><input type="text"name="p_hibah_namakedua"value="" value size="60"></td>
			<td></td>
			<td></td>
	</tr>
	<tr>
			<td>Jabatan Pihak kedua</td>
			<td>Nip Pihak kedua</td>
	</tr>
	<tr>
			<td><input type="text"name="p_hibah_jabatan_kedua"value="" value size="30"></td>
			<td><input type="text"name="p_hibah_nipkedua"value="" value size="27"></td>
	</tr>     
</table>

