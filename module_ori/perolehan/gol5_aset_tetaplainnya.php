
 <script type="text/javascript">
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

                           
                    });

                  
            });

</script>
<script src="accounting.js"></script>
	<script type="text/javascript">
		function format_nilaikuantitas1(){
		var get_nilai = document.getElementById('p_gol5_kuantitas1a');
		document.getElementById('p_gol5_kuantitas1').value=get_nilai.value;
		nilai = accounting.formatMoney(get_nilai.value, "", 0, ".", ",");
		get_nilai.value=nilai;
		
	}
		function format_nilaikuantitas2(){
		var get_nilai = document.getElementById('p_gol5_kuantitas2a');
		document.getElementById('p_gol5_kuantitas2').value=get_nilai.value;
		nilai = accounting.formatMoney(get_nilai.value, "", 0, ".", ",");
		get_nilai.value=nilai;
		
	}
	
		function format_nilaikuantitas3(){
		
		console.log('masuksss');
		var get_nilai = document.getElementById('p_gol5_kuantitas3a');
		document.getElementById('p_gol5_kuantitas3').value=get_nilai.value;
		nilai = accounting.formatMoney(get_nilai.value, "", 0, ".", ",");
		get_nilai.value=nilai;
		
	}
</script>


            <style type="text/css">

                    .hide
                    {
                            display:none;
                    }

            </style> 
            
<table border="0" cellspacing="6">	
        <tr>
                <td>Jenis Aset Lain</td>
        </tr>
        <tr>
                <td>
                    <select name="jenis_aset_lain" id="select1">
                            <option value="1">Buku / Perpustakaan </option>
                            <option value="3">Barang Kesenian / Kebudayaan</option>
                            <option value="2">Hewan / Tanaman</option>
                    </select>
                </td> 

        </tr>
</table>

<div  class="hide" id="hide1">
<table border="0" cellspacing="6">	

        <tr>
                <td>Judul</td>
        </tr>
        <tr>
            <td>
                <input type="text" name="p_gol5_judul" value=" "size=70 >
            </td>
        </tr>
        <tr>
                <td>Pengarang</td>
        </tr>
        <tr>
                <td>
                    <input type="text" name="p_gol5_pengarang" value=" "size=70 >
                </td>
        </tr>
        <tr>
                <td>Penerbit</td>
        </tr>
        <tr>
                <td>
                    <input type="text" name="p_gol5_penerbit" value=" "size=70 >
                </td>
        </tr>
        <tr>
                <td>Spesifikasi</td>
        </tr>
        <tr>
                <td>
                    <input type="text" name="p_gol5_spesifikasi" value=" "size=70 >
                </td>
        </tr>
        </table>

       <table border="0" cellspacing="6">
        <tr>
                <td>Tahun Terbit</td>
                <td>ISBN</td>
        </tr>
        <tr>
                <td>
                    <input type="text" name="p_gol5_asetlain_tahunterbit" value= >                                      
                </td>
                <td>
                    <input type="text" name="p_gol5_isbn" value="" >
                </td>
        </tr>
</table>
       <table border="0" cellspacing="6">
        <tr>
                <td>Kuantitas</td>
                <td>Satuan</td>

        </tr>
        <tr>
                <td>
	
                    <input type="text" name="p_gol5_kuantitas3a" id="p_gol5_kuantitas3a" style="text-align:right" value="<?php echo number_format($dataArr->kuantitas3,0,',','.')?>"required=" required" onblur="return format_nilaikuantitas3();";>
					<input type="hidden" name="p_gol5_kuantitas3" id="p_gol5_kuantitas3"style="text-align:right" value="<?=$dataArr->kuantitas3?>">
                </td>
                <td>
                    <input type="text" name="p_gol5_satuan3" >
                </td>

        </tr>
</table>
</div>
<div class="hide" id="hide2"> 
<table border="0" cellspacing="6">	
        <tr>
                <td>Jenis / Spesies</td>
        </tr>
         <tr>
                <td>
                    <input type="text" name="p_gol5_jenis" value=""size=70 >
                </td>
        </tr>
        <tr>
                <td>Ukuran</td>
        </tr>
        <tr>
                <td>
                        <input type="text" name="p_gol5_ukuran" value=""size=70 >
                </td>
        </tr>
</table>
<table border="0" cellspacing="6">
        <tr>
                <td>Kuantitas</td>
                <td>Satuan</td>

        </tr>
        <tr>
                <td>
                        <input type="text" name="p_gol5_kuantitas2a" id="p_gol5_kuantitas2a"  style="text-align:right" value="<?php echo number_format($dataArr->kuantitas2,0,',','.')?>"required=" required" onchange="return format_nilaikuantitas2();";>
						 <input type="hidden" name="p_gol5_kuantitas2" id="p_gol5_kuantitas2" style="text-align:right" value="<?=$dataArr->kuantitas2?>">
                </td>
                <td>
                        <input type="text" name="p_gol5_satuan2" >
                </td>

        </tr>
</table>
</div>
<div class="hide" id="hide3">
       <table border="0" cellspacing="6">	
        <tr>
                  <td>Judul</td>
        </tr>
        <tr>
                <td>
                        <input type="text" name="p_gol5_judul1" value=" "size=70 >
                </td>
        </tr>
                <tr>
                        <td>Asal Daerah</td>
                </tr>
        <tr>
                <td>
                        <input type="text" name="p_gol5_asal" value=" "size=70 >
                </td>
        </tr>
        <tr>
                <td>Pencipta</td>
        </tr>
        <tr>
                <td>
                        <input type="text" name="p_gol5_pencipta" value=" "size=70 >
                </td>
        </tr>
        <tr>
                <td>Bahan / Material</td>
        </tr>
        <tr>
                <td>
                        <input type="text" name="p_gol5_bahan" value=" "size=70 >
                </td>
        </tr>
</table>
<table border="0" cellspacing="6">
        <tr>
                <td>Kuantitas</td>
                <td>Satuan</td>
        </tr>
        <tr>
                <td>
                        <input type="text" name="p_gol5_kuantitas1a" id="p_gol5_kuantitas1a" style="text-align:right" value="<?php echo number_format($dataArr->kuantitas1,0,',','.')?>"required=" required" onchange="return format_nilaikuantitas1();";>
						<input type="hidden" name="p_gol5_kuantitas1" id="p_gol5_kuantitas1"style="text-align:right" value="<?=$dataArr->kuantitas1?>">
                </td>
                <td>
                        <input type="text" name="p_gol5_satuan1" >
                </td>
        </tr>
</table>
</div>



