<?php
include "../../config/config.php";
?>

<html>


<script type="text/javascript" src="<?php echo"$path/JS/simbada.js"; ?>"></script>
<script type="text/javascript" src="<?php echo"$path/JS/script.js"; ?>"></script>
<script type="text/javascript" src="<?php echo"$path/JS2/tabel.js"; ?>"></script>

     <?php
     include "$path/header.php";
     ?>
     <body>
	<div id="content">
	<?php
        include "$path/title.php";
        include "$path/menu.php";
        ?>
        <!edit content!>
            <div id="tengah1">
                <div id="frame_tengah1">
                    <div id="frame_gudang">
                        <div id="topright">
                            Pemeliharaan
                        </div>
                        <div id="bottomright">
                            <table border="0" cellpadding="1" cellspacing="1" width="100%">
                                <tbody>
                                    <tr>
                                        <td style="height: 5px;"><!-- just give a space --></td>
                                    </tr>
                                    <tr>
                                        <td>ID Aset(System ID)
                                            <br />
                                            <input isdatepicker="true" style="width: 200px;" name="idgetasetid" id="idgetasetid" type="text">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Nama Aset
                                            <br />
                                            <input isdatepicker="true" style="width: 480px;" name="idgetnamaaset" id="idgetnamaaset" type="text">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Nomor Kontrak
                                            <br />
                                            <input isdatepicker="true" style="width: 200px;" name="idgetnokontrak" id="idgetnokontrak" type="text">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Tahun Perolehan
                                            <br />
                                            <input isdatepicker="true" style="width: 70px;" name="idgettahun" id="idgettahun" maxlength="4" type="text">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Kelompok
                                            <br />
                                            <input type="hidden" name="idgetkelompok" id="idgetkelompok" value="">
                                            <input type="text" name="idkelompok" id="idkelompok" style="width:480px;"readonly="readonly" value="(semua Kelompok)">
                                            <input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" value="Pilih" onclick = "showSpoiler(this);"> <div class="inner" style="display:none;">
                                                <style>
                                                    .tabel th {
                                                    background-color: #eeeeee;
                                                    border: 1px solid #dddddd;
                                                              }
                                                    .tabel td {
                                                    border: 1px solid #dddddd;
                                                              }
                                                </style>
                                                <div style="width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;">
                                                    <table width="100%" align="left" border="0" class="tabel">
                                                        <tr>
                                                            <th align="left" border="0" nowrap colspan="3">
                                                                <input type="text" id="kelompok_search" style="width: 70%;" value="">
                                                                <input type="button" id="kelompok_btn_search" value="Cari" onclick="search_child( 'kelompok', '&prefix=kelompok&tag=' )">
                                                            </th>
                                                        </tr>
                                                        <tr id="kelompok_row_">
                                                            <th width="100px">&nbsp;</th>
                                                            <th width="150px"align="center"><b>Kode</b></th>
                                                            <th width="500px" align="left"><b>Nama</b></th>
                                                        </tr>
                                                        <tr id="zzzzzzzzzz">
                                                            <td colspan="3" id="kelompok_data"></td>
                                                        </tr>
                                                        <tr> 
                                                            <td width=1><input type="checkbox"></td>
                                                            <td class=Item><a href=./ class=Item onClick="processTree (12); return false;" STYLE="text-decoration: none">01</a></td>
                                                            <td width=149 height=20 class=Item><a href=./ class=Item onClick="processTree (12); return false;">GOLONGAN TANAH</a></td>
                                                      </tr>
                                                      <tr id='sub_0_1' class=SubItemRow> 
                                                          <td width=1>&nbsp;<input type="checkbox"></td>
                                                          <td width=149 height=20 class=SubItem><a href=./ class=Item onClick="processTree (13); return false;">01.01</a></td>
                                                          <td width=149 height=20 class=SubItem><a href=./ class=Item onClick="processTree (13); return false;">TANAH</a></td>
                                                      </tr>
                                                      <tr id='sub_0_1_1' class=SubItemRow> 
                                                          <td width=1>&nbsp;&nbsp;<input type="checkbox"></td>
                                                          <td width=149 height=20 class=SubItem><a href=./ class=Item onClick="processTree (14); return false;">01.01.01</a></td>
                                                          <td width=149 height=20 class=SubItem><a href=./ class=Item onClick="processTree (14); return false;">PERKAMPUNGAN</a></td>
                                                      </tr>
                                                      <tr id='sub_0_1_1_1' class=SubItemRow> 
                                                          <td width=1>&nbsp;&nbsp;&nbsp;<input type="checkbox"></td>
                                                          <td width=149 height=20 class=SubItem>01.01.01.01</td>
                                                          <td width=149 height=20 class=SubItem>Kampung</td>
                                                      </tr>
                                                      <tr id='sub_0_1_2' class=SubItemRow> 
                                                          <td width=1>&nbsp;&nbsp;<input type="checkbox"></td>
                                                          <td width=149 height=20 class=SubItem><a href=./ class=Item onClick="processTree (15); return false;">01.01.02</a></td>
                                                          <td width=149 height=20 class=SubItem><a href=./ class=Item onClick="processTree (15); return false;">TANAH PERTANIAN</a></td>
                                                      </tr>
                                                      <tr><td colspan="3"></td></tr>
                                                    </table>
                                                </div>
                                            </div>
                                           
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Lokasi
                                            <br />
                                            <input type="hidden" name="idgetkelompok" id="idgetkelompok" value="">
                                            <input type="text" name="idkelompok" id="idkelompok" style="width:480px;" readonly="readonly" value="(semua Lokasi)">
                                            <input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" value="Pilih" onclick = "showSpoiler(this);">
                                            <div class="inner" style="display:none;">
                                                <div style="width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;">
                                                    <table width="100%" align="left" border="0" class="tabel">
                                                        <tr>
                                                            <th align="left" border="0" nowrap colspan="3">
                                                                <input type="text" id="kelompok_search" style="width: 70%;" value="">
                                                                <input type="button" id="kelompok_btn_search" value="Cari" onclick="search_child( 'kelompok', '&prefix=kelompok&tag=' )">
                                                            </th>
                                                        </tr>
                                                        <tr id="kelompok_row_">
                                                            <th width="100px">&nbsp;</th>
                                                            <th width="150px"align="center"><b>Kode</b></th>
                                                            <th width="500px" align="left"><b>Nama</b></th>
                                                        </tr>
                                                        <tr id="zzzzzzzzzz">
                                                            <td colspan="3" id="kelompok_data"></td>
                                                        </tr>
                                                        <tr>
                                                            <td width=1><input type="checkbox"></td>
                                                            <td class=Item><a href=./ class=Item onClick="processTree (0); return false;" STYLE="text-decoration: none">12</a></td>
                                                            <td width=149 height=20 class=Item><a href=./ class=Item onClick="processTree (0); return false;">SUMATERA UTARA</a></td>
                                                        </tr>
                                                        <tr id='sub_1_1' class=SubItemRow>
                                                            <td width=1>&nbsp;<input type="checkbox"></td>
                                                            <td width=149 height=20 class=SubItem><a href=./ class=Item onClick="processTree (1); return false;">1201</a></td>
                                                            <td width=149 height=20 class=SubItem><a href=./ class=Item onClick="processTree (1); return false;">NIAS</a></td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="left" valign="top">
                                            <hr size="0.5pt">
                                            <input type="button" onclick="show_confirm()" value="Lanjut" />
                                            <hr size="0.5pt">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <?php 
        include "$path/footer.php";
        ?>
     </body>
</html>	
