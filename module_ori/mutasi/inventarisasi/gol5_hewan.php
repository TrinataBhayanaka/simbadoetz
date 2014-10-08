<html>

<script type="text/javascript">

	/* <![CDATA[ */
	$(document).ready(function(){
		$("#inv_ldahi_gol5hewan_jenis_aset_lain").change(function(){

			if ($(this).val() == "1" ) {

				$("#hide1").slideDown("fast"); //Slide Down Effect

			} else {

				$("#hide1").slideUp("fast");	//Slide Up Effect

			}
		});

		

	/* ]]> */

	</script>


<table border=0>	
<tr>
<td>Jenis Aset Lain</td>

</tr>
<tr>
<td>
<select name="inv_ldahi_gol5hewan_jenis_aset_lain" id="inv_ldahi_gol5hewan_jenis_aset_lain">
<option value="">Buku / Perpustakaan </option>
<option value="">Buku Kesenian / Kebudayaan</option>                
<option selected="selected"> Hewan / Tanaman</option>

</select>

</td> 

</tr>
</table>
<table border=0>	
<tr>
<td>Jenis / Spesies</td>
</tr>
<tr>
<td>
<input type="text" name="inv_ldahi_gol5hewan_jenis_spesies" id="inv_ldahi_gol5hewan_jenis_spesies" value="" size=70 >
</td>
</tr>
<tr>
<td>Ukuran</td>
</tr>
<tr>
<td>
<input type="text" name="inv_ldahi_gol5hewan_ukuran" id="inv_ldahi_gole_hewan_ukuran" value="" size=70 >
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
<input type="text" name="inv_ldahi_gol5hewan_kuantitas" id="inv_ldahi_gol5hewan_kuantitas" value="0,00" style="text-align:right;" >
</td>
<td>
<input type="text" name="inv_ldahi_gol5hewan_satuan" id="inv_ldahi_gol5hewan_satuan" value="buah" readonly="readonly">
</td>

</tr>
</table>
</html>