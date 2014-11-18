<?php ob_start() ?>
<html>
	<?php
        include "../../../config/config.php";
        include "$path/header.php";
        include "$path/title.php";
        ?>
    
	<body>
            <?php
            include "$path/menu.php";
            ?>

        <div id="tengah1">	
        <div id="frame_tengah1">
        <div id="frame_gudang">
        <div id="topright"> Cetak laporan Inventarisasi</div>
        <div id="bottomright">
         
            <form method="post" action="proses_cetak_laporan.php">
       
        <script>
            $(function()
                {
                $('#tanggal').datepicker($.datepicker.regional['id']);
                }

             );
        </script>


        <strong><span style="text-decoration: underline;">Seleksi Pencarian</span></strong>
        
        <table>
            <tr>
                <td>Tahun</td>
                <td>:</td>
                <td><select>
                    <option>2007</option>
                    <option>2008</option>
                    <option>2009</option>
                    <option>2010</option>
                    </select></td>
                <td></td>
                <td></td>
        </tr>
        </table>
        SKPD<br>
        <input type="hidden" name="idgetkelompok" id="idgetkelompok" value="">
        <input type="text" name="idkelompok" id="idkelompok"
        style="width:480px;"
        readonly="readonly"
        value="(semua SKPD)">
        <input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok"
        value="pilih"
        onclick = "Spoiler(document.getElementById('idbtnlookupkelompok').value)">
        <script>
            function Spoiler(status){
               // alert(status);
                if(status=='pilih'){
                    document.getElementById('spoiler_1').setAttribute('style','display:block');
                    document.getElementById('idbtnlookupkelompok').value = 'tutup';
                }
                if(status=='tutup'){
                 document.getElementById('spoiler_1').setAttribute('style','display:none');
                  document.getElementById('idbtnlookupkelompok').value = 'pilih';
                }
            }
           
    
        </script>
        <style>
            td.checkbox{text-align:center}
            td.header{text-align:left;font-weight: bold}
        </style>
        <div class="inner"  id="spoiler_1" style="display:none">
        
        <div style="width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;" >
         
     <table width="100%" align="left" border="0" class="tabel">
        <tr>
            <th align="left" border="0" nowrap colspan="3">
            <input type="text" id="kelompok_search" style="width: 70%;" value="">
            <input type="button" id="kelompok_btn_search" value="Cari" onclick="search_child( 'kelompok', '&prefix=kelompok&tag=' )">
            </th>
        </tr>
        <tr id="kelompok_row_">

            <td width="100px" class="header">&nbsp;</td>
            <td width="150px" class="header"> <b>Kode</b></td>
            <td width="500px"  class="header"><b>Nama</b></td>
        </tr>
        <tr id="zzzzzzzzzz">
            <td colspan="3" id="kelompok_data"></td>
        </tr>
        <tr>
            <td class="checkbox"><input type="checkbox"></td>
            <td class=Item><a href=./ class=Item onClick="processTree (3); return false;" STYLE="text-decoration: none">BID 18</a></td>
            <td class=Item><a href=./ class=Item onClick="processTree (3); return false;">Kesatuan Bangsa</a></td>
        </tr>
        <tr id='sub_3_1' class=SubItemRow>
            <td class="checkbox" ><input type="checkbox"></td>
            <td class=SubItem><a href=./ class=Item onClick="processTree (5); return false;">20</a></td>
            <td class=SubItem><a href=./ class=Item onClick="processTree (5); return false;">Badan Kesatuan Bangsa, Politik dan Perlindungan Masyarakat</a></td>
        </tr>

        <tr id='sub_5_3_1' class=SubItemRow>
            <td class="checkbox"><input type="checkbox"></td>
            <td class=SubItem>20.00</td>
            <td class=SubItem>Badan Kesatuan Bangsa, Politik dan Perlindungan Masyarakat - Tata Usaha</td>

        </tr>

        <tr>
            <td class="checkbox"><input type="checkbox"></td>
            <td class=Item><a href=./ class=Item onClick="processTree (4); return false;" STYLE="text-decoration: none">BID 1</a></td>
            <td class=Item><a href=./ class=Item onClick="processTree (4); return false;">Sekretariat Daerah</a></td>
        </tr>

        <tr id='sub_4_1' class=SubItemRow>
            <td class="checkbox"><input type="checkbox"></td>
            <td  class=SubItem><a href=./ class=Item onClick="processTree (6); return false;">1</a></td>
            <td class=SubItem><a href=./ class=Item onClick="processTree (6); return false;">Sekretariat Daerah</a></td>
        </tr>

        <tr id='sub_6_4_1' class=SubItemRow>
            <td class="checkbox"><input type="checkbox"></td>
            <td class=SubItem>1.1</td>
            <td class=SubItem>Sekretariat Daerah - Biro Hukum dan Humas</td>
        </tr>
                 </table>
            </div> </div>
   <table>
          <tr>
            <td>
            <script type="text/javascript">
                function show_confirm()
                {
                    var r=confirm("Cetak dokumen");
                    if (r==true)
                    {
                        alert("Dokumen telah dicetak");
                    }
                    else
                    {
                        alert("Batal cetak dokumen");
                    }
                }
            </script>
            <input type="submit" onclick="show_confirm()" value="Lanjut" />
            </td>
      
            </tr>
      
    </table>
            
                    
    <table>
        
        
        <tr>
            <td>Tanggal Cetak Report</td>
            <td>:</td>
            <td>
            <input placeholder="(dd/mm/yyyy)" name="" id="tanggal" type="text" value="">
            </td>
            <td></td>
            <td></td>
        </tr>

    </table>
        </form>
           </div>
 </div>
            </div>
        </div>
			<?php
                        include "$path/footer.php";
                        ?>
             
       
            
	</body>
        
</html>	
