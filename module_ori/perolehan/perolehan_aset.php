
<div class="blok_judul">Perolehan Aset</div>
<table width="100%" cellspacing="6">
		<tr>
			<td width="12%">Cara Perolehan</td>
			<td colspan=2>Keterangan Asal Usul</td>
			<td></td>
		</tr>
		<tr>
			<td>
				<select name="p_perolehan_caraperolehan" id="p_perolehan_caraperolehan">
                                                                    <option value='0'name="">Off-Budget</option>
                                                                    <option value='1'name="">Pengadaan</option>
                                                                    <option value='2'name="">Hibah</option>
                                                                    <option value='3'>Keputusan_Pengadilan</option>
                                                                    <option value='4'>Keputusan_Undang-undang</option>
				</select>
			</td>
			<td colspan=2><input type="text" name="p_perolehan_ket_asalusul" value=""></td>
			<td></td>
		</tr>
		<tr>
			<td width="15%">Tanggal Perolehan</td>
			<td width="15%">Tahun Aset</td>
			<td>Nilai Perolehan</td>
		</tr>

		<tr>
			<td><input id="tanggal13" type="text" name="p_perolehan_tglperolehan" value=""></td>
			<td>
			   <input type="text" name="p_perolehan_thnperolehan" value="<?=$dataArr->Tahun ?>"required=" required" >
			</td>
			<script src="accounting.js"></script>

<script type="text/javascript">
	function format_nilais(){
	var get_nilai = document.getElementById('p_perolehan_nilai1');
	document.getElementById('p_perolehan_nilai').value=get_nilai.value;
	nilai = accounting.formatMoney(get_nilai.value, "", 2, ".", ",");
	get_nilai.value=nilai;
	
}
</script>																									
			<td><input type="text" name="p_perolehan_nilai1" id="p_perolehan_nilai1" value="<?php echo number_format($dataArr->NilaiAnggaran,2,',','.')?>"required=" required" onchange="return format_nilais();";>
			<input type="hidden" name="p_perolehan_nilai" id="p_perolehan_nilai" value ="<?=$dataArr->NilaiAnggaran?> "> </td>
                                                   
		</tr>
		<tr>
			<td colspan=3>&nbsp;</td>
			<td></td>
			<td></td>
		</tr>
</table>
		
		<table cellspacing="6">
		<div class="blok_judul">Detail Perolehan</div>
		
		<table cellspacing="6">
		<tr>
		<td width='100%' colspan='3'>
		<div class="hide" id="hide7">

</div>
		</td>
		</tr>
		
		<tr>
		<td width='100%' colspan='3'>
			<div class="hide" id="hide8">
				<?php
				include "kontrak.php";
				?>
			</div>
		</td>
		</tr>
		<tr>
		<td width='100%' colspan='3'>
			<div class="hide" id="hide9">
				<?php
				include "pengadaan_hibah.php";  
				?>
            </div>
		</td>
		</tr>
                                    <tr>
		<td width='100%' colspan='3'>
			<div class="hide" id="hide10">
				<?php
				include "keputusan_pengadilan.php";
				?>
            </div>
		</td>
		</tr>
                                    <tr>
		<td width='100%' colspan='3'>
			<div class="hide" id="hide11">
				<?php
				include "keputusan_undangundang.php";
				?>
            </diV>
		</td>
		</tr>
</table>
<div class="blok_judul">Penghapusan Aset</div>
<table width="100%" cellspacing="6">
		<tr>
			<td>
				<select name="p_penghapusan_aset" id="p_penghapusan_aset">
                                                                    <option value='0'>-</option>
                                                                    <option value='1'>Pemindahtanganan</option>
                                                                    <option value='2'>Pemusnahan</option>
				</select>
			</td>
			
			<td></td>
		</tr>
		
		<tr>
		<td width='100%' colspan='3'>
			<div class="hide" id="hide4">

			</diV>
		</td>
		</tr>
		<tr>
		<td width='100%' colspan='3'>
		<div class="hide" id="hide5">
			<?php
				include "pengadaan_pemindahtanganan.php";
			?>
		</diV>
		</td>
		</tr>
		<tr>
		<td width='100%' colspan='3'>
			<div class="hide" id="hide6">
				<?php
					include "pengadaan_pemusnahan.php";
				?>
</div>
</table>
	
