<script src="accounting.js"></script>
	<script type="text/javascript">
		function format_nilaikuantitas(){
		var get_nilai = document.getElementById('p_gol7_kuantitas41');
		document.getElementById('p_gol7_kuantitas4').value=get_nilai.value;
		nilai = accounting.formatMoney(get_nilai.value, "", 0, ".", ",");
		get_nilai.value=nilai;
		
	}
		
</script>
<table border="0" cellspacing="6">
        <tr>
                <td>Kuantitas</td>
                <td>Satuan</td>
        </tr>
        <tr>
                <td>
					<input type="text" name="p_gol7_kuantitas41" id="p_gol7_kuantitas41" value="<?php echo number_format($dataArr->kuantitas,0,',','.')?>"required=" required" onblur="return format_nilaikuantitas();" style="text-align:right;" >
					<input type="hidden" name="p_gol7_kuantitas4" id="p_gol7_kuantitas4" value="<?=$dataArr->kuantitas?>" style="text-align:right;" >
                </td>
                <td>
					<input type="text" name="p_gol7_satuan4" value="" >
                </td>
        </tr>
</table>
