<?php
    include "../../config/config.php";
?>

<html>
    <?php
         include "$path/header.php";
    ?>
    
    <!--buat date-->
    <script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/jquery-ui.min.js"></script> 
    <script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/jquery.ui.datepicker-id.js"></script>
    <script>
        $(function()
        {
        $('#tanggal1').datepicker($.datepicker.regional['id']);
        $('#tanggal2').datepicker($.datepicker.regional['id']);
        $('#tanggal3').datepicker($.datepicker.regional['id']);
        $('#tanggal4').datepicker($.datepicker.regional['id']);
        $('#tanggal5').datepicker($.datepicker.regional['id']);
        $('#tanggal6').datepicker($.datepicker.regional['id']);
        $('#tanggal7').datepicker($.datepicker.regional['id']);
        $('#tanggal8').datepicker($.datepicker.regional['id']);
        $('#tanggal9').datepicker($.datepicker.regional['id']);
        $('#tanggal10').datepicker($.datepicker.regional['id']);
        $('#tanggal11').datepicker($.datepicker.regional['id']);
        $('#tanggal12').datepicker($.datepicker.regional['id']);
        $('#tanggal13').datepicker($.datepicker.regional['id']);
        $('#tanggal14').datepicker($.datepicker.regional['id']);
        $('#tanggal15').datepicker($.datepicker.regional['id']);
        }
        );
    </script>   
    <link href="<?php echo "$url_rewrite/"; ?>css/jquery-ui.css" type="text/css" rel="stylesheet">
    
    <body>
        <div id="content">
            <?php
                include "$path/title.php";
                include "$path/menu.php";
            ?>
            <div id="tengah1">	
                <div id="frame_tengah1">
                    <div id="frame_gudang">
                        <div id="topright">
                            Rekapitulasi LMB Daerah Semesteran
                        </div>
                        <div id="bottomright">
                            
                            <form name="form" method="POST" action="<?php echo "$url_rewrite/module/mutasi/"; ?>proses_rekapitulasi_lmb_daerah_semesteran.php">
                            <script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/tabel.js"></script>	
                            <table>
                                <tr>
                                    <td><label>Semester </label><select name="mutasi_reklmb_smster">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                        </select>
                                    </td>
                                    <td><select name="mutasi_reklmb_tahun">
                                            <option value="2012">2012</option>
                                            <option value="2009">2009</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                            </table>
                            
                            <table>
                                <tr>
                                    <td>
                                        Satker<br>
                                        <input type="text" name="kelompok" id="idkelompok" style="width:480px;" readonly="readonly" value="(semua Satker)">
                                        <input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" value="Pilih" onclick = "showSpoiler(this);">
                                        <div class="inner" style="display:none;">
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
                                                        <th width="50px"style="background-color:rgb(238,238,238); border:1px solid rgb(221,221,221);"> </th>
                                                        <th width="50px" align="center" style="background-color:rgb(238,238,238); border:1px solid rgb(221,221,221);"><b>Kode</b></th>
                                                        <th align="left" style="background-color:rgb(238,238,238); border:1px solid rgb(221,221,221);"><b>Nama</b></th>
                                                    </tr>
                                                    <tr id="zzzzzzzzzz">
                                                        <td colspan="3" id="kelompok_data"></td>
                                                    </tr>
                                                    <tr>
                                                        <td width=1><input type="checkbox"></td>
                                                        <td class=Item><a href=./ class=Item onClick="processTree (3); return false;" STYLE="text-decoration: none">BID 18</a></td>
                                                        <td width=149 height=20 class=Item><a href=./ class=Item onClick="processTree (3); return false;">Kesatuan Bangsa</a></td>
                                                    </tr>
                                                    <tr id='sub_3_1' class=SubItemRow>
                                                        <td width=1>&nbsp;<input type="checkbox"></td>
                                                        <td width=149 height=20 class=SubItem><a href=./ class=Item onClick="processTree (5); return false;">20</a></td>
                                                        <td width=149 height=20 class=SubItem><a href=./ class=Item onClick="processTree (5); return false;">Badan Kesatuan Bangsa, Politik dan Perlindungan Masyarakat</a></td>
                                                    </tr>
                                                    <tr id='sub_5_3_1' class=SubItemRow>
                                                        <td width=1>&nbsp;&nbsp;<input type="checkbox"></td>
                                                        <td width=149 height=20 class=SubItem>20.00</td>
                                                        <td width=149 height=20 class=SubItem>Badan Kesatuan Bangsa, Politik dan Perlindungan Masyarakat - Tata Usaha</td>
                                                    </tr>
                                                    <tr>
                                                        <td width=1><input type="checkbox"></td>
                                                        <td class=Item><a href=./ class=Item onClick="processTree (4); return false;" STYLE="text-decoration: none">BID 1</a></td>
                                                        <td width=149 height=20 class=Item><a href=./ class=Item onClick="processTree (4); return false;">Sekretariat Daerah</a></td>
                                                    </tr>
                                                    <tr id='sub_4_1' class=SubItemRow>
                                                        <td width=1>&nbsp;<input type="checkbox"></td>
                                                        <td width=149 height=20 class=SubItem><a href=./ class=Item onClick="processTree (6); return false;">1</a></td>
                                                        <td width=149 height=20 class=SubItem><a href=./ class=Item onClick="processTree (6); return false;">Sekretariat Daerah</a></td>
                                                    </tr>
                                                    <tr id='sub_6_4_1' class=SubItemRow>
                                                        <td width=1>&nbsp;&nbsp;<input type="checkbox"></td>
                                                        <td width=149 height=20 class=SubItem>1.1</td>
                                                        <td width=149 height=20 class=SubItem>Sekretariat Daerah - Biro Hukum dan Humas</td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="3"></td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                            &nbsp;
                            <hr>
                            <table>
                                <tr>
                                    <td>
										<a href="<?echo $url_rewrite.'/module/mutasi/report/rp_rekapitulasilaporanmutasibarang.php';?>" target="main"><input type="button" name="submit" value="Lanjut" /></a>
                                        
                                        <input type="reset" name="reset" value="Bersihkan Filter" />
                                    </td>	
                                </tr>
                            </table>
                            <hr>
                            &nbsp;
                            <table>
                                <tr>
                                    <td>Tanggal Cetak Report</td>
                                    <td>:</td>
                                    <td>
                                        <input type="text"  style="text-align:center;" name="mutasi_reklmb_tanggal" id="tanggal12"> ( format tanggal : dd/mm/yyyy )
                                    </td>
                                </tr>
                            </table>
                            </form>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="footer">Sistem Informasi Barang Daerah ver. 0.x.x <br />
			Powered by BBSDM Team 2012
        </div>
    </body>
</html>	
