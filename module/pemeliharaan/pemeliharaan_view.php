<table width="100%" class="listdata" style="border:1px solid #cccccc; padding:5px; margin:0px;">
<?php
	$query_tampil	= "SELECT a.Aset_ID, p.TglPemeliharaan, p.JenisPemeliharaan, p.KeteranganPemeliharaan, p.NIPPemelihara, p.NamaPemelihara, p.JabatanPemelihara, p.Biaya, n.FromNilai, n.ToNilai, n.KeteranganNilai
					  FROM Aset a, Pemeliharaan p, NilaiAset n
					  WHERE
					  a.Aset_ID = p.Aset_ID AND
					  p.Pemeliharaan_ID = n.Pemeliharaan_ID AND
					  p.Aset_ID = '".$id."'
					  ORDER BY
					  p.Pemeliharaan_ID asc
					  ";
	$exec_tampil	= mysql_query($query_tampil) or die(mysql_error());
	while($hsl_data=mysql_fetch_array($exec_tampil))
	{
?>
	<tr>
		<td class="listdata" valign="top" align="center" width="30"  rowspan="5"><?php echo $i++; ?></td>
		<td class="listdata" valign="top" align="left"   width="100"><?php echo $hsl_data['TglPemeliharaan'];?></td>
		<td class="listdata" valign="top" align="left"   width="*"></td>
		<td class="listdata" valign="top" align="left"   width="175">Nilai Pemeliharaan</td>
		<td class="listdata" valign="top" align="right"  width="150"><?php echo $hsl_data['Biaya'];?></td>
		<td class="listdata" valign="top" align="center" width="100" rowspan="3"style="border:1px solid #cccccc;"><a class="listdata" href="<?php echo "$url_rewrite/module/pemeliharaan/"; ?>pemeliharaan_edit_detail.php">Edit</a>&nbsp;|&nbsp;<a class="listdata" href="<?php echo "$url_rewrite/module/pemeliharaan/"; ?>daftar_pemeliharaan_barang.php"style="cursor:pointer;" title="hapus data standar harga" onclick="HapusDataPemeliharaan( '#');">Hapus</a>
		</td>
	</tr>
	<tr>
		<td class="listdata" valign="top" align="left" colspan="2"><?php echo $hsl_data['JenisPemeliharaan'];?></td>
		<td class="listdata" valign="top" align="left">Nilai sebelum Pemeliharaan</td>
		<td class="listdata" valign="top" align="right"><?php echo $hsl_data['FromNilai'];?></td>
	</tr>
	<tr>
		<td class="listdata" valign="top" align="left" colspan="2"></td>
		<td class="listdata" valign="top" align="left">Nilai setelah Pemeliharaan</td>
		<td class="listdata" valign="top" align="right"><?php echo $hsl_data['ToNilai'];?></td>
	</tr>
	<tr>
		<td class="listdata" rowspan="2" valign="top" align="left"><b>[&nbsp;&nbsp;]</b></td>
		<td class="listdata" valign="top" align="left"></td>
		<td class="listdata" valign="top" align="left" rowspan="2" colspan="2">Keterangan Penilaian:<br></td>
	</tr>
	<tr>
		<td class="listdata" valign="top" align="left"></td>
	</tr>
<?php
}
?>
</table>