Keterangan Pemusnahan<br>
	<textarea cols="50"  rows="5"  name="p_pmusnah_keterangan" > <?=$dataArr->KetPemusnahan?></textarea>
<table cellspacing="6">
	<tr>
		<td width='250'>Nomor SK Penetapan</td><td>Tanggal SK Penetapan</td>
	</tr>
	<tr>
		<td><input type='text' size='30'name="p_pmusnah_noskpenetapan" value="<?=$dataArr->NoSKPenetapan?>"></td><td><input id="tanggal21" type='text' size='23'name="p_pmusnah_tglskpenetapan"value="<?=$dataArr->TglSKPenetapan?>"></td>
	</tr>
	<tr>
		<td width='250'>Nomor SK Penghapusan</td><td>Tanggal SK Penghapusan</td>
	</tr>
	<tr>
		<td><input type='text' size='30'name="p_pmusnah_noskhapus"value="<?=$dataArr->NoSKPenghapusan?>"></td><td><input id="tanggal22"type='text' size='23'name="p_pmusnah_tglskhapus"value="<?=$dataArr->TglSKPenghapusan?>"></td>
	</tr>
</table>
