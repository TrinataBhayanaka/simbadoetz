
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

            <style type="text/css">

                    .hide
                    {
                            display:none;
                    }

            </style> 
    <script type="text/javascript">
<?php 
    if ($dataArr->AsetLain == '1') 
    {
     ?>   
        $(document).ready(function(){
             $("#hide1").slideDown("fast"); 
         });
    <?}
      if ($dataArr->AsetLain == '2') 
    {
     ?>   
        $(document).ready(function(){
          $("#hide2").slideDown("fast");
         });
    <?}
     else if ($dataArr->AsetLain == '3') 
    {
     ?>   
        $(document).ready(function(){
               $("#hide3").slideDown("fast"); 
         });
    <?}else if ($dataArr->AsetLain == '') 
    {
     ?>   
        $(document).ready(function(){
               $("#hide1").slideDown("fast"); 
         });
    <?}
    
?>
</script>          
                      
            
            
<table border="0" cellspacing="6">	
        <tr>
                <td>Jenis Aset Lain</td>
        </tr>
        <tr>
                <td>
                    <select name="jenis_aset_lain" id="select1" disabled>
                           <option value="1"<?php if ($dataArr->AsetLain == '1') echo 'selected'?>>Buku / Perpustakaan </option>
                            <option value="3"<?php if ($dataArr->AsetLain == '3') echo 'selected'?>>Barang Kesenian / Kebudayaan</option>
                            <option value="2"<?php if ($dataArr->AsetLain == '2') echo 'selected'?>>Hewan / Tanaman</option>
                    </select>
                </td> 

        </tr>
</table>
<div class="hide" id="hide1">
<table border="0" cellspacing="6">	
        <tr>
                <td>Judul</td>
        </tr>
        <tr>
            <td>
                <input type="text" name="p_gol5_judul" value="<?=$dataArr->Judul?>"size=70 disabled>
            </td>
        </tr>
        <tr>
                <td>Pengarang</td>
        </tr>
        <tr>
                <td>
                    <input type="text" name="p_gol5_pengarang" value="<?=$dataArr->Pengarang?>"size=70 disabled>
                </td>
        </tr>
        <tr>
                <td>Penerbit</td>
        </tr>
        <tr>
                <td>
                    <input type="text" name="p_gol5_penerbit" value="<?=$dataArr->Penerbit?>"size=70 disabled>
                </td>
        </tr>
        <tr>
                <td>Spesifikasi</td>
        </tr>
        <tr>
                <td>
                    <input type="text" name="p_gol5_spesifikasi" value=" <?=$dataArr->Spesifikasi?>"size=70 disabled>
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
                    <input type="text" name="p_gol5_asetlain_tahunterbit" value="<?=$dataArr->TahunTerbit?>" disabled>                                      
                </td>
                <td>
                    <input type="text" name="p_gol5_isbn" value="<?=$dataArr->ISBN?>" disabled>
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
                    <input type="text" name="p_gol5_kuantitas3" style="text-align:right;" value="<?=$dataArr->Kuantitas?>" disabled>
                </td>
                <td>
                    <input type="text" name="p_gol5_satuan3" value="<?=$dataArr->Satuan?>" disabled>
                </td>

        </tr>
</table>
</div>
<div  class="hide" id="hide2"> 
<table border="0" cellspacing="6">	
        <tr>
                <td>Jenis / Spesies</td>
        </tr>
         <tr>
                <td>
                    <input type="text" name="p_gol5_jenis" value="<?=$dataArr->Judul?>"size=70 disabled>
                </td>
        </tr>
        <tr>
                <td>Ukuran</td>
        </tr>
        <tr>
                <td>
                        <input type="text" name="p_gol5_ukuran" value="<?=$dataArr->Ukuran?>"size=70 disabled>
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
                        <input type="text" name="p_gol5_kuantitas2"  style="text-align:right;" value="<?=$dataArr->Kuantitas?>" disabled>
                </td>
                <td>
                        <input type="text" name="p_gol5_satuan2" value="<?=$dataArr->Satuan?>" disabled>
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
                        <input type="text" name="p_gol5_judul1" value="<?=$dataArr->Judul?>"size=70 disabled>
                </td>
        </tr>
                <tr>
                        <td>Asal Daerah</td>
                </tr>
        <tr>
                <td>
                        <input type="text" name="p_gol5_asal" value="<?=$dataArr->AsalDaerah?>"size=70 disabled>
                </td>
        </tr>
        <tr>
                <td>Pencipta</td>
        </tr>
        <tr>
                <td>
                        <input type="text" name="p_gol5_pencipta" value="<?=$dataArr->Pengarang?>"size=70 disabled>
                </td>
        </tr>
        <tr>
                <td>Bahan / Material</td>
        </tr>
        <tr>
                <td>
                        <input type="text" name="p_gol5_bahan" value="<?=$dataArr->Material?>"size=70 disabled>
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
                        <input type="text" name="p_gol5_kuantitas1" style="text-align:right;" value="<?=$dataArr->Kuantitas?>" disabled>
                </td>
                <td>
                        <input type="text" name="p_gol5_satuan1" value="<?=$dataArr->Satuan?>" disabled>
                </td>
        </tr>
</table>
</div>



