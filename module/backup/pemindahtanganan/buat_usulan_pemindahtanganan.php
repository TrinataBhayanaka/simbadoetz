<?php
                    include "../../config/config.php";
                    include"$path/header.php";
                    include"$path/title.php";

?>
<html>
            <script type="text/javascript" src="<?php echo "$url_rewrite";?>/js/tabel.js"></script>
            <script type="text/javascript" src="<?php echo "$url_rewrite";?>/JS2/simbada.js"></script>
            <script type="text/javascript" src="<?php echo "$url_rewrite";?>/JS/script.js"></script>
            <script type="text/javascript" src="<?php echo "$url_rewrite";?>/JS2/simbada.js"></script>
            <script type="text/javascript">
                            function show_confirm()
                            {
                            var r=confirm("Tidak ada data yang dijadikan filter? Seluruh isian filter kosong.");
                            if (r==true)
                            {
                            alert("Anda akan masuk ke halaman daftar pemeliharaan Barang");
                            //document.location="<?php echo "$url_rewrite";?>/module/pemindahtanganan/daftar_pemindahtanganan_barang.php";
                            document.forms[0].submit();
                            }
                            else
                            {
                            alert("You pressed Cancel!");
                            document.location="pemindahtanganan.php";
                            }
                            }
            </script>
            <!--[if IE]>
            <link rel="stylesheet" type="text/css" href="ie_office.css" />
            <![endif]-->

    <body>
            <div id="content">
                        <?php
                            include"$path/menu.php";
                        ?>
            </div>
                            <div id="tengah1">	
                                    <div id="frame_tengah1">
                                            <div id="frame_gudang">
                                                    <div id="topright">
                                                            Buat Usulan pemindahtanganan
                                                    </div>
                                                    <div id="bottomright">
                                                        <form method="POST" action="<?php echo "$url_rewrite";?>/module/pemindahtanganan/daftar_pemindahtanganan_barang.php"  name="usulan_pemindahtanganan" >
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
                                                                                <input type="button" name="btn_action" id="btn_action_spindah" value="Usul Pemindahtanganan" onclick="window.location = 'usulan_pemindahtanganan.php'">    
                                                                            </td>
                                                                    </tr>
                                                        </table>
                                                        <table class="listdata" style="margin-top:2px;" width="100%" border="1" cellpadding="0" cellspacing="0">
                                                            <tr>
                                                                    <th class="listdata" align="center"bgcolor="#004933"><p style="color:#FFFFFF">&nbsp;No</p></th>
                                                                    <th class="listdata" align="left"   colspan="2"bgcolor="#004933"><p style="color:#FFFFFF">&nbsp;Informasi&nbsp;Aset&nbsp;</p></th>
                                                                    <!--
                                                                    <th class="listdata" align="center">&nbsp;Tindakan&nbsp;</th>
                                                                    -->
                                                            </tr>
                                                            <tr>
                                                                <td class="listdata_type_00" valign="top" align="center">1&nbsp;</td>
                                                                <td class="listdata_type_00" valign="top" align="center">
                                                                    <input type="checkbox" name="idchkbox_asetid[0]"  id="idchkbox_asetid[0]" onclick="ModifyChart( 'spindah' );">
                                                                </td>
                                                                <td class="listdata_type_00" valign="top" align="left">
                                                                        <div style="padding:5px;">
                                                                                <b><span style="padding:1px 5px 1px 5px; background-color:#eeeeee; border: 1px solid #cccccc;">48774</span></b>
                                                                                    ( Aset ID - System Number )<br>
                                                                                <b>99.02.23.1.XX.1<br>02.03.01.02.02.0001</b><br>
                                                                                <b>Mobil</b>
                                                                        </div>
                                                                                <!--
                                                                                <div style="float:right"><input type="button" value="more detail"></div>
                                                                                -->
                                                                    <hr size="1px">
                                                                    <div id="idv_asetid[0]" style="width:100%; margin:0px; padding:0px;">
                                                                        <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                                                                <tr>
                                                                                    <td rowspan="5" width="50px" valign="top" align="center" style="padding: 2px; border:0px;">
                                                                                        <img src="./lib/loadpict.php?sz=1&id=" style="padding: 2px; border: 1px solid #ccc;" border="0" width="85%">
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                        <td valign="top" align="left" style="padding:0px 2px 0px 3px;" width="100px">No.Kontrak</td>
                                                                                        <td valign="top<td valign="top" align="left" style="padding:0px 2px 0px 3px;" width="100px">No.Kontrak</td>
                                                                                        <td va" align="left" style="border-width:0px 0px 1px 0px; padding:0px 2px 0px 3px;"><b>-</b></td>
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
                                                            <!--
                                                            <td class="listdata_type_00" valign="top" align="center"><a href="?menuid=39&m=1&id=48774&exec=spindah" class="detail_link">Usul Pemindahtanganan</a></td>
                                                            -->
                                                     </tr>     
                                                        <!--
                                                        <td class="listdata_type_01" valign="top" align="center"><a href="usulan_pemindahtanganan.php" class="detail_link">Usul Pemindahtanganan</a></td>
                                                        -->
                                                    <tr>
                                                            <th class="listdata" align="center"bgcolor="#004933"><p style="color:#FFFFFF">&nbsp;No</p></th>
                                                            <th class="listdata" align="left"   colspan="2"bgcolor="#004933"><p style="color:#FFFFFF">&nbsp;Informasi&nbsp;Aset&nbsp;</p></th>
                                                            <!--
                                                            <th class="listdata" align="center">&nbsp;Tindakan&nbsp;</th>
                                                            -->
                                                    </tr>
                                          </table>
                                            <table width="100%" >
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
                                                                <input type="button" name="btn_action" id="btn_action_spindah" value="Usul Pemindahtanganan" onclick="window.location = 'usulan_pemindahtanganan.php'">    
                                                            </td>
                                                    </tr>
                                            </table>
                                          </form>
                                    </div>
                            </div>
                    </div>
            </div>
                            
                   
           <?php
                include"$path/footer.php";
           ?>
    </body>
</html>	
