<?php

$query = " SELECT * FROM AsetLain WHERE Aset_ID = $Aset_ID ";
//print_r($query);
$result = mysql_query($query) or die (mysql_error());

if (mysql_num_rows($result))
{
    $data = mysql_fetch_object($result);
    $dataArrAsetLain = $data;
}

echo "<pre>";
//print_r($dataArrAsetLain);
echo "</pre>";

?>

	

	<script type="text/javascript">

	/* <![CDATA[ */
	$(document).ready(function(){
		$("#select1").change(function(){

			if ($(this).val() == "1" ) {
				$("#hide3").slideUp("fast");
				$("#hide2").slideUp("fast");
				$("#hide1").slideDown("fast"); //Slide Down Effect

			}
			if ($(this).val() == "2" ) {
				$("#hide1").slideUp("fast");
				$("#hide3").slideUp("fast");
				$("#hide2").slideDown("fast"); //Slide Down Effect

			}
			
			if ($(this).val() == "3" ) {
				$("#hide1").slideUp("fast");
				$("#hide2").slideUp("fast");
				$("#hide3").slideDown("fast"); 
				 //Slide Down Effect

			}
			
			else {
				
				
				
					//Slide Up Effect

			}
		});

		$("#select2").change(function(){

			if ($(this).val() == "1" ) {

				$("#hide2").slideDown("fast"); //Slide Down Effect

			} else {

				$("#hide1").slideUp("fast");	//Slide Up Effect

			}
		});
	});

	/* ]]> */

	</script>

	

	<style type="text/css">

		.hide
		{
			display:none;
		}
	
	</style> 




	
<table border=0>	
<tr>
<td>Jenis Aset Lain</td>

</tr>
<tr>
<td>
			<select name="inv_ldahi_gol5_jenis_aset_lain" id="inv_ldahi_gol_aset_jenis_aset_lain">
				<option value="1">Buku / Perpustakaan </option>
				<option value="3">Buku Kesenian / Kebudayaan</option>
				<option value="2" selected="selected">Hewan / Tanaman</option>
			</select>
</td> 

</tr>
</table>
		<div class="hide" id="hide1">
			<table border=0>	
<tr>
<td>Judul</td>
</tr>
<tr>
<td>
<input type="text" name="inv_ldahi_gol5_judul" id="inv_ldahi_gol5_judul" value=" "size=70 />
</td>
</tr>
<tr>
<td>Pengarang</td>
</tr>
<tr>
<td>
<input type="text" name="inv_ldahi_gol5_pengarang" id="inv_ldahi_gol5_pengarang" value=" "size=70 />
</td>
</tr>
<tr>
<td>Penerbit</td>
</tr>
<tr>
<td>
<input type="text" name="inv_ldahi_gol5_penerbit" id="inv_ldahi_gol5_penerbit" value=" "size=70 />
</td>
</tr>
<tr>
<td>Spesifikasi</td>
</tr>
<tr>
<td>
<input type="text" name="inv_ldahi_gol_spesifikasi" id="inv_ldahi_gol_spesifikasi" value=" "size=70 />
</td>
</tr>
</table>

<table border=0>
<tr>
<td>Tahun Terbit</td>
<td>ISBN</td>

</tr>
<tr>
<td>
<input type="text" name="inv_ldahi_gol5_tahun_terbit" id="inv_ldahi_gol5_tahun_terbit" value="" />
</td>
<td>
<input type="text" name="inv_ldahi_gol5_isbn" id="inv_ldahi_gol5_isbn" value="" />
</td>

</tr>
</table>
<table border=0>
<tr>
<td>Kuantitas</td>
<td>Satuan</td>

</tr>
<tr>
<td>
<input type="text" name="inv_ldahi_gol5_kuantitas" id="inv_ldahi_gol5_kuantitas" value="" style="text-align:right;" />
</td>
<td>
<input type="text" name="inv_ldahi_gol5_satuan" id="inv_ldahi_gol5_satuan" value="" />
</td>

</tr>
</table>
		</div>
		<div id="hide2"> 
			<table border=0>	
<tr>
<td>Jenis / Spesies</td>
</tr>
<tr>
<td>
<input type="text" name="inv_ldahi_gol5_jenis_spesies" id="inv_ldahi_gol5_jenis_spesies" value=" "size=70 />
</td>
</tr>
<tr>
<td>Ukuran</td>
</tr>
<tr>
<td>
<input type="text" name="inv_ldahi_gol5_ukuran" id="inv_ldahi_gol5_ukuran" value="" size=70 />
</td>
</tr>
</table>


<table border=0>
<tr>
<td>Kuantitas</td>
<td>Satuan</td>

</tr>
<tr>
<td>
<input type="text" name="inv_ldahi_gol5_kuantitas1" id="inv_ldahi_gol5_kuantitas1" value="" style="text-align:right;" />
</td>
<td>
<input type="text" name="inv_ldahi_gol5_satuan1" id="inv_ldahi_gol5_satuan1" value="" />
</td>

</tr>
</table>
		</div>
<div class="hide" id="hide3">
<table border=0>	
<tr>
<td>Judul</td>
</tr>
<tr>
<td>
<input type="text" name="inv_ldahi_gol5_judul" id="inv_ldahi_gol5_judul" value="" size=70 />
</td>
</tr>
<tr>
<td>Asal Daerah</td>
</tr>
<tr>
<td>
<input type="text" name="inv_ldahi_gol5_asal_daerah" id="inv_ldahi_gol5_asal_daerah" value="" size=70 />
</td>
</tr>
<tr>
<td>Pencipta</td>
</tr>
<tr>
<td>
<input type="text" name="inv_ldahi_gol5_pencipta" id="inv_ldahi_gol5_pencipta" value="" size=70 />
</td>
</tr>
<tr>
<td>Bahan / Material</td>
</tr>
<tr>
<td>
<input type="text" name="inv_ldahi_gol5_bahan_material" id="inv_ldahi_gol5_bahan_material" value="" size=70 />
</td>
</tr>
</table>


<table border=0>
<tr>
<td>Kuantitas</td>
<td>Satuan</td>

</tr>
<tr>
<td>
<input type="text" name="inv_ldahi_gol5_kuantitas2" id="inv_ldahi_gol5_kuantitas2" value="" style="text-align:right;" />
</td>
<td>
<input type="text" name="inv_ldahi_gol5_satuan2" id="inv_ldahi_gol5_satuan2" value="" />
</td>

</tr>
</table>
</div>


