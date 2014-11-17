<script type="text/javascript">
<?php 
    if ($dataArr->Kontrak_ID != '') 
    {
    ?>   
         $(document).ready(function(){
              $("#hide8").slideDown("fast"); 
         });
        
       
    <?}
  
    else if ($dataArr->CaraPerolehan == '1') 
    {
     ?>   
        $(document).ready(function(){
              $("#hide8").slideDown("fast"); 
         });
    <?}
      if ($dataArr->CaraPerolehan == '2') 
    {
     ?>   
        $(document).ready(function(){
              $("#hide9").slideDown("fast"); 
         });
    <?}
     else if ($dataArr->CaraPerolehan == '3') 
    {
     ?>   
        $(document).ready(function(){
              $("#hide10").slideDown("fast"); 
         });
    <?}
     else if ($dataArr->CaraPerolehan == '4') 
    {
     ?>   
        $(document).ready(function(){
              $("#hide11").slideDown("fast"); 
         });
    <?}
    
    
?>
</script>
<div class="blok_judul">Perolehan Aset</div>
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
				<select name="p_perolehan_caraperolehan" id="p_perolehan_caraperolehan">
                                                                    <option value='0'>Off-Budget</option>
                                                                    <option value='1'<?php if ($dataArr->CaraPerolehan == '1') echo 'selected'?>>Pengadaan</option>
                                                                    <option value='2'<?php if ($dataArr->CaraPerolehan == '2') echo 'selected'?>>Hibah</option>
                                                                    <option value='3'<?php if ($dataArr->CaraPerolehan == '3') echo 'selected'?>>Keputusan_Pengadilan</option>
                                                                    <option value='4'<?php if ($dataArr->CaraPerolehan == '4') echo 'selected'?>>Keputusan_Undang-undang</option>
				</select>
			</td>
			<td colspan=2><input type="text" name="p_perolehan_ket_asalusul" value="<?=$dataArr->AsalUsul?>"></td>
			<td></td>
		</tr>
		<tr>
			<td width="15%">Tanggal Perolehan</td>
			<td width="15%">Tahun Aset</td>
			<td>Nilai Perolehan</td>
		</tr>

		<tr>
			<td><input id="tanggal13" type="text" name="p_perolehan_tglperolehan" value="<?=$dataArr->TglPerolehan?>"></td>
			<td>
			   <input type="text" name="p_perolehan_thnperolehan" required=" required"  value="<?=$dataArr->Tahun?>">
			</td>

			 <script src="accounting.js"></script>

	<script type="text/javascript">
	function format_nilai(){
	
	var get_nilai = document.getElementById('p_perolehan_nilai2');
	document.getElementById('p_perolehan_nilai').value=get_nilai.value;
	nilai = accounting.formatMoney(get_nilai.value, "", 2, ".", ",");
	get_nilai.value=nilai;
	
	
	
}
</script>
			<td><input type="text" onchange="return format_nilai()"; name="p_perolehan_nilai2" id="p_perolehan_nilai2" required=" required"  value="<?= number_format($dataArr->NilaiPerolehan,2,',','.')?>"</td>
			
			<input type="hidden" name="p_perolehan_nilai" id="p_perolehan_nilai" value="<?=$dataArr->NilaiPerolehan?>" onload="return format_nilai();"> </td>                                   
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
        <script type="text/javascript">
        
    <?php 
    if ($dataArr->PenghapusanAset == '-') 
    {
    ?>   
         $(document).ready(function(){
              $("#hide4").slideDown("fast"); 
         });
        
    <?}
    else if ($dataArr->PenghapusanAset  == '1') 
    {
     ?>   
        $(document).ready(function(){
              $("#hide5").slideDown("fast"); 
         });
    <?}
     else if ($dataArr->PenghapusanAset  == '2') 
    {
     ?>   
        $(document).ready(function(){
              $("#hide6").slideDown("fast"); 
         });
    <?}  
?>
</script>
		<tr>
			<td>
				<select name="p_penghapusan_aset" id="p_penghapusan_aset">
                                                                    <option value='0' >-</option>
                                                                    <option value='1' <?php if ($dataArr->PenghapusanAset =='1') echo 'selected'?>>Pemindahtanganan</option>
                                                                    <option value='2' <?php if ($dataArr->PenghapusanAset =='2') echo 'selected'?>>Pemusnahan</option>
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
	