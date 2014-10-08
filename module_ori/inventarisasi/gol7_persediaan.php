<script src="accounting.js"></script>
	<script type="text/javascript">
		function format_nilaikuantitas(){
		var get_nilai = document.getElementById('p_gol7_kuantitas41');
		document.getElementById('p_gol7_kuantitas').value=get_nilai.value;
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
					<input type="text" name="p_gol7_kuantitas41" id="p_gol7_kuantitas41" value="<?=$dataArr->Kuantitas !=0 ?  number_format($dataArr->Kuantitas,0,',','.') : 0 ?>"required=" required" onblur="return format_nilaikuantitas();" style="text-align:right;" disabled >
					<input type="hidden" id="p_gol7_kuantitas" name="p_gol7_kuantitas" value="<?=$dataArr->Kuantitas?>" style="text-align:right;" disabled>
                </td>                                                              <input type="hidden" value="" id="hidden">
                <td>
					<input type="text" name="p_gol7_satuan" value="<?=$dataArr->Satuan?>" disabled>
                </td>
        </tr>
</table>
