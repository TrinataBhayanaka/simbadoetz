
	<table border=0 cellspacing="6">
	<tr>
		<td colspan=2>Peruntukan</td>
		<td></td>
	</tr>
	<tr>
		<td colspan=2>
				<select name="p_p_tangan_peruntukan">
					<option value="01"<?php if ($dataArr->Peruntukan == '01') echo 'selected'?>>Kementrian/Lembaga</option>
					<option value="11"<?php if ($dataArr->Peruntukan == '11') echo 'selected'?>>Pemerintah Provinsi</option>
					<option value="12"<?php if ($dataArr->Peruntukan == '12') echo 'selected'?>>Pemerintah Kabupaten Kota</option>
					<option value="99"<?php if ($dataArr->Peruntukan == '99') echo 'selected'?>>Yayasan Masyarakat</option>
				</select>
		</td>
		<td></td>
	</tr>
	<tr>
		<td colspan=2><input type="text"></td>
		<td></td>
	</tr>
	<tr>
		<td>Nomor BASP</td>
		<td>Tanggal BASP</td>
	</tr>
	<tr>
		<td><input type="text" name="p_p_tangan_nobasp"value="<?=$dataArr->NoBASP?>"></td>
		<td><input id="tanggal18"type="text"name="p_p_tangan_tglbasp"value="<?=$dataArr->TglBASP?>"></td>
	</tr>
	<tr>
		<td colspan=2>Nama Pihak Pertama</td>
		<td></td>
	</tr>
	<tr>
		<td colspan=2><input type="text"name="p_p_tangan_namapertama"value="<?=$dataArr->Nama1BASP?>"></td>
		<td></td>
	</tr><tr>
		<td>Jabatan Pihak Pertama</td>
		<td>NIP Pihak Pertama</td>
	</tr>
	<tr>
		<td><input type="text"name="p_p_tangan_jbtnpertama"value="<?=$dataArr->Jabatan1BASP?>"></td>
		<td><input type="text"name="p_p_tangan_nippertama"value="<?=$dataArr->NIP1BASP?>"></td>
	</tr>
	<tr>
		<td colspan=2>Lokasi Pihak Pertama</td>
		<td></td>
	</tr>
	<tr>
		<td colspan=2><input type="text"name="p_p_tangan_lokasipertama"value="<?=$dataArr->Lokasi1BASP?>"></td>
		<td></td>
	</tr>
	<tr>
		<td colspan=2>Nama Pihak Kedua</td>
		<td></td>
	</tr>
	<tr>
		<td colspan=2><input type="text"name="p_p_tangan_namakedua"value="<?=$dataArr->Nama2BASP?>"></td>
		<td></td>
	</tr>
	
	<tr>
		<td>Jabatan Pihak Kedua</td>
		<td>NIP Pihak Kedua</td>
	</tr>
	<tr>
		<td><input type="text"name="p_p_tangan_jbtnkedua"value="<?=$dataArr->Jabatan2BASP?>"></td>
		<td><input type="text"name="p_p_tangan_nipkedua"value="<?=$dataArr->NIP2BASP?>"></td>
	</tr>
	<tr>
		<td colspan=2>Lokasi Pihak Kedua</td>
		<td></td>
	</tr>
	<tr>
		<td colspan=2><input type="text"name="p_p_tangan_lokasikedua"value="<?=$dataArr->Lokasi2BASP?>"></td>
		<td></td>
	</tr>
	<tr>
		<td>Nomor SK Penetapan</td>
		<td>Tanggal SK Penetapan</td>
	</tr>
	<tr>
		<td><input type="text"name="p_p_tangan_noskpenetapan"value="<?=$dataArr->NoSKPenetapanBASP?>"></td>
		<td><input id="tanggal19"type="text"name="p_p_tangan_tglskpenetapan"value="<?=$dataArr->TglSKPenetapanBASP?>"></td>
	</tr>
	<tr>
		<td>Nomor SK Penghapusan</td>
		<td>Tanggal SK Penghapusan</td>
	</tr>
	<tr>
		<td><input type="text"name="p_p_tangan_noskhapus"value="<?=$dataArr->NoSKPenghapusanBASP?>"></td>
		<td><input id="tanggal20" type="text"name="p_p_tangan_tglskhapus"value="<?=$dataArr->TglSKPenghapusanBASP?>"></td>
	</tr>
        </table>
