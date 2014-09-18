<?php
 include "../../config/config.php";
     include"$path/header.php";
    include"$path/title.php";
?>
<html>
	<script type="text/javascript" src="<?php echo "$url_rewrite";?>/JS/script.js"></script>
                  <script type="text/javascript" src="<?php echo "$url_rewrite";?>/JS2/simbada.js"></script>
	<script type="text/javascript" src="<?php echo "$url_rewrite";?>/JS2/simbada.js"></script>
	<script type="text/javascript">
		function show_confirm()
		{
		var r=confirm("Tidak ada data yang dijadikan filter? Seluruh isian filter kosong.");
		if (r==true)
		  {
		  alert("You pressed OK!");
		  document.location="penetapan_penghapusan_konfirmasi.php";
		  }
		else
		  {
		  alert("You pressed Cancel!");
		  document.location="penetapan_penghapusan_tambah_data.php";
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
                                                                                <input type="button" id="frmfilter" name="frmfilter" value="Kembali ke form filter"onclick="document.location='penetapan_penghapusan_filter.php'">
                                                                            </td>
                                                                            <td width="50%" align="right" style="border:0px;">
                                                                                <input type="submit" id="idbtnact"  name="idbtnact"  value="Tambah Data" onclick="document.location='penetapan_penghapusan_tambah.php'">
                                                                            </td>
                                                                        </tr>
                                                                </table>
                                                                <table width="100%">
                                                                        <tr>
                                                                        <td style="margin-top:5px; font-weight:bold; border:1px solid #999; padding:5px;">
                                                                            <table width="100%">
                                                                                <tr>
                                                                                    <td width='10%'>1.</td>
                                                                                    <td width='30%'><span style="font-weight:bold;">99.02.23.1.XX.1 - 02.03.01.02.02.0001</span><br> Mobil</td>
                                                                                    <td align="right" style="border-style:none;"> 
                                                                                        <input type="button" value="Tutup Detail" onclick="window.location='penetapan_penghapusan_tambah_data.php'">		
                                                                                    </td>
                                                                                </tr>
                                                                            </table>
                                                                                <div style="width:100%; height:200px; overflow:auto; border:1px solid #dddddd;">
                                                                                    <table width="100%">
                                                                                        <tr>
                                                                                            <td width="45px"><input type="text" value="99" readonly="readonly" size="1%" style="text-align:center; font-weight:bold;">-</td>
                                                                                            <td width="7%"><input type="text" value="1" readonly="readonly" size="5%" style="text-align:center; font-weight:bold;">-</td>
                                                                                            <td width="160px"><input type="text" value="02.03.01.02.02" readonly="readonly" style="text-align:center; font-weight:bold;">-</td>
                                                                                            <td>
                                                                                                <input type="text" value="1" readonly="readonly" size="5%" style="text-align:center; font-weight:bold;">
                                                                                            </td>
                                                                                            <td align="right">
                                                                                                <input type="button" value="Sub Detail" onclick="window.location='penetapan_penghapusan_tambah_data_subdetail.php'">
                                                                                            </td>
                                                                                        </tr>
                                                                                    </table>
                                                                                    <table width="100%" height="3%" border="1" style="border-collapse:collapse;">
                                                                                            <tr>
                                                                                                <td>
                                                                                                    <table>
                                                                                                        <tr>
                                                                                                            <td width="30%">Nama Aset</td>
                                                                                                            <td style="font-weight:bold;">Mobil</td>
                                                                                                        </tr>   
                                                                                                        <tr>
                                                                                                            <td>Satuan Kerja</td>
                                                                                                            <td style="font-weight:bold;">Biro Hukum dan Humas</td>
                                                                                                        </tr>
                                                                                                        <tr>
                                                                                                            <td>Jenis Barang</td>
                                                                                                            <td style="font-weight:bold;">Bicro Bus (Penumpang 15 - 30 orang)</td>
                                                                                                        </tr>
                                                                                                         
                                                                                                    </table>
                                                                                                    <tr>
                                                                                                            <td valign="top" colspan="3" align="center" width="10px">
                                                                                                                    <input type="hidden" name="jmlaset" id="jmlaset" value="1">
                                                                                                                    
                                                                                                            </td>
                                                                                                        </tr>
                                                                                                         <table width="99%" align="center" border="0">
                                                                                                            <tr>
                                                                                                                <td align="center">
                                                                                                                    <input type="button" id="btn_tambahaset"value="Tambah Aset"onclick="window.location='penetapan_penghapusan_tambah_aset.php'">
                                                                                                                </td>
                                                                                                            </tr>
                                                                                                          </table>  

                                                                                                </td>
                                                                                            </tr>
                                                                                    </table>
                                                                            </div>
                                                                    </td>  
                                                                    </tr>
                                                                    <tr>
                                                                        <td><hr size="1"></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td nowrap="true" align="left" valign="top" colspan="2" style="padding-left: 0px">
                                                                            <table width='100%'>
                                                                                <tr>
                                                                                    <td nowrap="true" align="left" valign="top" colspan="2" style="padding-left: 0px">
                                                                                <tr>
                                                                                    <td nowrap="true" align="left" valign="top">
                                                                                        Keterangan Penghapusan<br>
                                                                                            <textarea style="width: 500px; height: 100px;" id="idinfohapus" name="bup_pp_get_keterangan"></textarea>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td nowrap="true" align="left" valign="top" colspan="2" style="padding-left: 0px">
                                                                                        <table cellspacing="0">
                                                                                            <tr>
                                                                                                <td nowrap="true" align="left" valign="top">
                                                                                                    Nomor SK Penghapusan<br>
                                                                                                    <input type="text" style="width: 280px;" id="idnoskhapus" name="bup_pp_noskpenghapusan"onchange="toggle_data_valid()"onkeydown="toggle_data_valid()" onkeypress="toggle_data_valid()"onkeyup="toggle_data_valid()"  value="">
                                                                                                </td>
                                                                                                <td nowrap="true">&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                                                                                <td nowrap="true" align="left" valign="top">
                                                                                                    Tanggal SK Penghapusan<br>
                                                                                                    <input name="bup_pp_tanggal" type="text" id="idtglskhapus" datepicker="true" datepicker_format="DD/MM/YYYY" style="width: 150px;" onchange="toggle_data_valid()" onkeydown="toggle_data_valid()" onkeypress="toggle_data_valid()" onkeyup="toggle_data_valid()" onmouseout="toggle_data_valid()" value="">
                                                                                                </td>
                                                                                            </tr>
                                                                                        </table>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th colspan="4" align="center">
                                                                                        <input type="submit" name="btn_action" id="btn_action" value="Hapus" onclick="show_confirm()">
                                                                                        <input type="button" name="btn_action" id="btn_action_cancel"  style="width:100px;"  value="Batal" onclick="window.location='penetapan_penghapusan_daftar_kosong.php'">
                                                                                    </th>
                                                                                </tr>
                                                                            </table>
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
