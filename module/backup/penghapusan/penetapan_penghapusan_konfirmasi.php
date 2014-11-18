<?php
 include "../../config/config.php";
     include"$path/header.php";
    include"$path/title.php";
?>
<html>
	<script type="text/javascript" src="<?php echo "$url_rewrite";?>/JS/script.js"></script>
                 <script type="text/javascript" src="<?php echo "$url_rewrite";?>/JS2/tabel.js"></script>
                  <script type="text/javascript" src="<?php echo "$url_rewrite";?>/JS2/simbada.js"></script>
	<script type="text/javascript" src="<?php echo "$url_rewrite";?>/JS2/simbada.js"></script>
	<script type="text/javascript">
		function show_confirm()
		{
		var r=confirm("Tidak ada data yang dijadikan filter? Seluruh isian filter kosong.");
		if (r==true)
		  {
		  alert("You pressed Ok!");
		  document.location="penetapan_penghapusan_daftar_kosong.php";
		  }
		else
		  {
		  alert("You pressed Cancel!");
		  document.location="penetapan_penghapusan_filter.php";
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
                                                        Penetapan Penghapusan
                                                </div>
                                                        <div id="bottomright">
                                                                <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                                                        <tr>
                                                                            <td width="50%" align="left" style="border:0px;">
                                                                                <input type="button" id="frmfilter" name="frmfilter" value="Kembali ke form filter" onclick="document.location='penetapan_penghapusan_filter.php'">
                                                                            </td>
                                                                            <td width="50%" align="right" style="border:0px;">
                                                                                <input type="submit" id="idbtnact"  name="idbtnact"  value="Tambah Data" onclick="document.location='penetapan_penghapusan_tambah.php'">
                                                                            </td>
                                                                        </tr>
                                                                </table>
                                                                    <div align="center"style="margin:10px; margin-top:25px;">
                                                                        <big style="font-size:11pt; font-weight:bold;">Data Aset sudah di hapuskan.</big><br>
                                                                            <table width="100%"align="center" border='1' style="border-collapse:collapse">
                                                                    <tr>
                                                                        <td valign="top" align="left" colspan="3" style="border: 1px solid #999999; padding: 5px 5px 5px 5px;">
                                                                            <p>
                                                                            Daftar aset yang di hapuskan:
                                                                            </p>
                                                                            <p>&nbsp</p>
                                                                            <p>
                                                                                <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                                                                    <tr>
                                                                                        <th valign="top" align="center" style="border: 1px solid #999999; padding: 3px 5px 2px 5px;background-color:#eeeeee;">Nomor</td>
                                                                                        <th valign="top" align="left" style="border: 1px solid #999999; padding: 3px 5px 2px 5px;background-color:#eeeeee;">Nama Aset</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td valign="top" align="right" style="border: 1px solid #999999; padding: 3px 5px 2px 5px;">1&nbsp;</td>
                                                                                        <td valign="top" align="left" style="border: 1px solid #999999; padding: 3px 5px 2px 5px;">Mobil</td>
                                                                                    </tr>
                                                                                </table>
                                                                            </p>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                            <td valign="top" align="left">Keterangan</td>
                                                                            <td valign="top" align="center" width='10px'>:</td>
                                                                            <td valign="top" align="left">vbvb</td>
                                                                    </tr>
                                                                    <tr>
                                                                            <td valign="top" align="left">No. SK Penetapan Penghapusan</td>
                                                                            <td valign="top" align="center">:</td>
                                                                            <td valign="top" align="left">vbvb</td>
                                                                    </tr>
                                                                    <tr>
                                                                            <td valign="top" align="left">Tgl.SK Penetapan Penghapusan</td>
                                                                            <td valign="top" align="center">:</td>
                                                                            <td valign="top" align="left">01/05/2012</td>
                                                                    </tr>
                                                                    </table>   <br/>
                                                                    
                                                                        <table class="listdata" width="100%" border="1"cellpadding="0" cellspacing="0"style="padding:2px; margin-top:0px; border: 1px solid #cccccc; border-width: 0px 1px 0px 1px;border-collapse:collapse;">
                                                                                <tr>
                                                                                    <th align="center" width="40px" >No</th>
                                                                                    <th align="center" width="170px" >Nomor Penghapusan</th>
                                                                                    <th align="center" width="150px" >Tgl Penghapusan</th>
                                                                                    <th align="center" width="%" >Detail Penghapusan</th>
                                                                                    <th align="center" width="85px">Tindakan</th>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td align="center" colspan="5"style="padding:15px 5px 10px 5px; color: #cc3333; font-weight: bold;">..:: Tidak ada data ::..</td>
                                                                                </tr>
                                                                            </table>
                                                                  <table width="100%" cellpadding="0" cellspacing="0" border="0">    
                                                                    <tr>
                                                                            <td colspan="3" align="center" style="padding:10px 5px 10px 5px;">
                                                                                <div align="center" style="padding:5px; margin-top:5px; margin-bottom:5px; border:1px solid #ccc;"><a class="a_listdata" href="./modules/aset/aset_daftar_barang_penghapusan.php?menuid=37&id=vbvb" target="_blank" >Cetak&nbsp;Penghapusan</a>&nbsp;&nbsp;&nbsp;&nbsp;<a class="a_listdata" href="?menuid=37&m=&exec=yes">
                                                                                    <a href='penetapan_penghapusan_daftar_isi.php'>Kembali ke menu utama</a></div></div>
                                                                            </td>
                                                                    </tr>
                                                            </table>
                                                    </div>
                                                </div>
                                        </div>
                                </div>
                        </div>
                
        <?php
            include"$path/footer.php";
        ?>
</body>
</html>	
