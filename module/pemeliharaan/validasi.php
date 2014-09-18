<?php
ob_start();
include "../../config/config.php";
?>

<html>
    <?php
    include "../../header.php";
    ?>
    <body>
        <?php
        include '../../title.php';
        include "../../menu.php";
        ?>
	
	<div id="tengah1">	
            <div id="frame_tengah1">
		<div id="frame_gudang">
                    <div id="topright">
                    Validasi Pemeliharaan
                    </div>
                    <div id="bottomright">
                        
                        <table width="100%">
                              <tr>
                                <td align="left">
                                  Pilihan&nbsp;:<br>
                                  <span class="listdata"
                                        style="cursor:pointer;text-decoration:underline;"
                                        title="Pilih semua yang ada pada halaman ini"
                                        onclick="CheckAll(); ModifyChart( 'spindah' );">Pilih halaman ini</span>
                                  <span class="listdata"
                                        style="cursor:pointer;text-decoration:underline;"
                                        title="Kosongkan pilihan yang ada pada halaman ini."
                                        onclick="ClearAll(); ModifyChart( 'spindah' );">Kosongkan halaman ini</span>
                                  <span class="listdata"
                                        style="cursor:pointer;text-decoration:underline;"
                                        title="Bersihkan memory dari daftar aset yang pernah anda pilih"
                                        onclick="ClearChart( 'spindah' );">Bersihkan semua pilihan</span>
                                </td>
                                <td align="right">
                                  <input type="button" name="btn_action" id="btn_action_spindah" value="Validasi Pemeliharaan" onClick="show_confirm()" />    
                                </td>
                              </tr>
                        </table>
                        
                        <table class="listdata" style="margin-top:2px;" width="100%" border="1" cellpadding="0" cellspacing="0">
                            <tr>
                                <th class="listdata" align="center"bgcolor="#003333"><p style="color:#FFFFFF">No</p></th>
                                <th class="listdata" align="left"   colspan="2"bgcolor="#003333"><p style="color:#FFFFFF">Informasi Aset</p></th>
                                <!--
                                <th class="listdata" align="center">&nbsp;Tindakan&nbsp;</th>
                                -->
                            </tr>
                            <tr>
                                <td class="listdata_type_00" valign="top" align="right">1&nbsp;</td>
                                <td class="listdata_type_00" valign="top" align="center">
                                    <input type="checkbox" name="idchkbox_asetid[0]" id="idchkbox_asetid" value="48774" onclick="ModifyChart( 'spindah' );">
                                </td>
                                <td class="listdata_type_00" valign="top" align="left">
                                    <div style="padding:5px;">
                                        <b><span style="padding:1px 5px 1px 5px; background-color:#eeeeee; border: 1px solid #cccccc;">48774</span></b>
                                        ( Aset ID - System Number )<br>
                                        <b>99.02.23.1.XX.1<br>02.03.01.02.02.0001</b><br>
                                        <b>Mobil</b>
                                    </div>
                                  
                                    <hr size="1px">
                                    <div id="idv_asetid" style="width:100%; margin:0px; padding:0px;">
                                        <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                            <tr>
                                                <td rowspan="5" width="50px" valign="top" align="center" style="padding: 2px; border:0px;">
                                                    <img src="./lib/loadpict.php?sz=1&id=" style="padding: 2px; border: 1px solid #ccc;" border="0" width="85%">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td valign="top" align="left" style="padding:0px 2px 0px 3px;" width="100px">No.Kontrak</td>
                                                <td valign="top" align="left" style="border-width:0px 0px 1px 0px; padding:0px 2px 0px 3px;"><b>-</b></td>
                                            </tr>
                                            <tr>
                                                <td valign="top" align="left" style="padding:0px 2px 0px 3px;" width="100px">Satker</td>
                                                <td valign="top" align="left" style="border-width:0px 0px 1px 0px; padding:0px 2px 0px 3px;">[1] - Biro Hukum dan Humas</td>
                                            </tr>
                                            <tr>
                                                <td valign="top" align="left" style="padding:0px 2px 0px 3px;">Lokasi</td>
                                                <td valign="top" align="left" style="padding:0px 2px 0px 3px;">Tidak ada keterangan lokasi...</td>
                                            </tr>
                                            <tr>
                                                <td valign="top" align="left" style="padding:0px 2px 0px 3px;">Status</td>
                                                <td valign="top" align="left" style="padding:0px 2px 0px 3px;">Dihapus tanggal [2012-05-08] dengan alasan fghgf</td>
                                            </tr>
                                      </table>
                                    </div>
                                </td>
                            </tr>     
                            <tr>
                                <th class="listdata" align="center"bgcolor="#003333"><p style="color:#FFFFFF">&nbsp;No</p></th>
                                <th class="listdata" align="left"   colspan="2"bgcolor="#003333"><p style="color:#FFFFFF">&nbsp;Informasi&nbsp;Aset&nbsp;</p></th>
                            </tr>
                        </table>
                        <table width="100%" >
                            <tr>
                                    <td align="left">
                                        Pilihan
                                        <span class="listdata" style="cursor:pointer;text-decoration:underline;" title="Pilih semua yang ada pada halaman ini" onclick="CheckAll(); ModifyChart( 'spindah' );">Pilih halaman ini</span>
                                        <span class="listdata" style="cursor:pointer;text-decoration:underline;" title="Kosongkan pilihan yang ada pada halaman ini." onclick="ClearAll(); ModifyChart( 'spindah' );">Kosongkan halaman ini</span>
                                        <span class="listdata" style="cursor:pointer;text-decoration:underline;" title="Bersihkan memory dari daftar aset yang pernah anda pilih" onclick="ClearChart( 'spindah' );">Bersihkan semua pilihan</span>
                                    </td>
                                    <td align="right">
                                        <input type="button" name="btn_action" id="btn_action_spindah" value="Validasi Pemeliharaan" onClick="window.location = 'daftar_pemeliharaan_barang.php'">    </td>
                            </tr>
                        </table>

                    </div>
                </div>
            </div>
        </div>
        
        <?php
        include "../../footer.php";
        ?>
    </body>
</html>	
