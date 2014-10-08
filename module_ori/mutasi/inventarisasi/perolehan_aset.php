

<table width="100%" cellspacing="6">
		<tr>
			<td width="12%">Cara Perolehan</td>
			<td colspan=2>Keterangan Asal Usul</td>
			<td></td>
		</tr>
		<tr>
			<td>
			    <?php
			    $default = (($dataArr->Kontrak_ID !='') AND ($dataArr->BAST_ID != '') AND ($dataArr->KeputusanUndangUndang_ID != '') AND ($dataArr->KeputusanPengadilan_ID != ''));
			    
			    ?>
				<select name="p_perolehan_caraperolehan" id="p_perolehan_caraperolehan" disabled>
                                                                    <option value='0'>Off-Budget</option>
                                                                    <option value='1'<?php if ($dataArr->CaraPerolehan == '1') echo 'selected'?>>Pengadaan</option>
                                                                    <option value='2'<?php if ($dataArr->CaraPerolehan == '2') echo 'selected'?>>Hibah</option>
                                                                    <option value='3'<?php if ($dataArr->CaraPerolehan == '3') echo 'selected'?>>Keputusan_Pengadilan</option>
                                                                    <option value='4'<?php if ($dataArr->CaraPerolehan == '4') echo 'selected'?>>Keputusan_Undang-undang</option>
				</select>
			</td>
			<td colspan=2><input type="text" name="p_perolehan_ket_asalusul" value="<?=$dataArr->AsalUsul?>" disabled></td>
			<td></td>
		</tr>
		<tr>
			<td width="15%">Tanggal Perolehan</td>
			<td width="15%">Tahun Aset</td>
			<td>Nilai Perolehan</td>
		</tr>

		<tr>
			<td><input id="tanggal13" type="text" name="p_perolehan_tglperolehan" value="<?=$dataArr->TglPerolehan?>" disabled></td>
			<td>
			   <input type="text" name="p_perolehan_thnperolehan" value="<?=$dataArr->Tahun?>" disabled>
			</td>
			<td><input type="text" name="p_perolehan_nilai" value="<?=$dataArr->NilaiPerolehan?>" disabled></td>
                                                   
		</tr>
		<tr>
			<td colspan=3>&nbsp;</td>
			<td></td>
			<td></td>
		</tr>
</table>
		
		