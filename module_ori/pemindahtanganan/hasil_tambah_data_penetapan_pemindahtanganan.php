<?php
                   include "../../config/config.php";
                   include"$path/header.php";
                   include"$path/title.php";

?>
<html>
	
	  <script type="text/javascript" src="<?php echo "$url_rewrite";?>/js/tabel.js"></script>
                    <script type="text/javascript" src="<?php echo "$url_rewrite";?>/JS/script.js"></script>
                    <script type="text/javascript" src="<?php echo "$url_rewrite";?>/JS2/simbada.js"></script>
                    <script type="text/javascript" src="<?php echo "$url_rewrite";?>/JS2/simbada.js"></script>
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
                                                                Penetapan Pemindahtanganan
                                                        </div>
                                                                <div id="bottomright">
                                                                        <form method="POST" action="tampil_penetapan_pemindahtanganan.php" style="padding:0px; width:625px; border: 0px;">
                                                                            <table width="1050" cellpadding="0" cellspacing="0" border="0">
                                                                                <tr>
                                                                                    <td width="50%" align="left" style="border:0px;">
                                                                                        <input type="button" id="frmfilter" name="frmfilter" value="Kembali ke form filter" onclick="document.location='penetapan_pemindahtanganan.php'">
                                                                                    </td>
                                                                                    <td width="50%" align="right" style="border:0px;">
                                                                                        <input type="submit" id="idbtnact"  name="idbtnact"  value="Tambah Data">
                                                                                    </td>
                                                                                </tr>
                                                                            </table>    
                                                                        </form>
                                                                        <br>
                                                                            <div style="margin-top:5px; font-weight:bold; border:1px solid #999; padding:5px;">
                                                                                <u>Daftar Aset yang akan di buatkan penetapan pemindahtanganan:</u>
                                                                            </div>
                                                                            <div style="margin-top:0px; padding:5px; padding-top:10px; border: 1px solid #999; border-top:0px;">
                                                                                <table width="100%" cellpadding="0" cellspacing="0" border="1">
                                                                                    <tr>
                                                                                        <td valign="top" align="right"  width="5px" rowspan="2">1&nbsp;.&nbsp;</td>
                                                                                        <td valign="top" align="left"   width="*">
                                                                                            <input type="hidden" name="idaset[0]" id="idaset[0]" value="48774">
                                                                                            <b>99.02.23.1.XX.1 - 02.03.01.02.02.0001</b>
                                                                                            <br>
                                                                                            Mobil              
                                                                                        </td>
                                                                                        <td valign="top" align="center" width="10px">
                                                                                            <div style="margin: 5px;">
                                                                                                <div style="margin-bottom: 2px;"align="right" valign="top" >
                                                                                                    <input type="button" value="View Detail" onclick="if (this.parentNode.parentNode.getElementsByTagName('div')[1].getElementsByTagName('div')[0].style.display != '') { this.parentNode.parentNode.getElementsByTagName('div')[1].getElementsByTagName('div')[0].style.display = ''; this.innerText = ''; this.value = 'Tutup Detail'; } else { this.parentNode.parentNode.getElementsByTagName('div')[1].getElementsByTagName('div')[0].style.display = 'none'; this.innerText = ''; this.value = 'View Detail'; }" style="vertical-align:middle" />
                                                                                                </div>
                                                                                            </div>
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td valign="top" align="left" colspan="2">
                                                                                            <div id="idv_detaildata[0]"></div>
                                                                                        </td>
                                                                                    </tr>
                                                                                </table>
                                                                                <table width="100%" cellpadding="0" cellspacing="0" border="1">
                                                                                    <tr>
                                                                                        <td valign="top" colspan="3" align="center" width="10px">
                                                                                                <input type="hidden" name="jmlaset" id="jmlaset" value="0">
                                                                                                <input type="button" id="btn_tambahaset" value="Tambah Aset" onclick="window.open('tambah_aset.php','','width=600,height=600,scrollbars=Yes')">
                                                                                        </td>
                                                                                    </tr>
                                                                                </table>
                                                                            </div>
                                                                            <br>
                                                                            <div style="margin-top:15px; font-weight:bold; border:1px solid #999; padding:5px;">
                                                                                <u>Berita Acara Serah Terima</u>
                                                                            </div>
                                                                            <div style="margin-top:0px; padding:5px; padding-top:10px; border: 1px solid #999; border-top:0px;">
                                                                                <table width="100%" border="0" cellpadding="1" cellspacing="1">
                                                                                    <tr>
                                                                                         <!-- Nomor Ketetapan -->
                                                                                        <td valign="top" align="left" width="120px">Nomor&nbsp;Penetapan </td>
                                                                                        <td valign="top" align="left" >
                                                                                            <input type="text" name="id_no_tap" id="id_no_tap" disabled
                                                                                                    style="width:180px;"
                                                                                                    onchange="toggle_data_valid()"
                                                                                                    onkeydown="toggle_data_valid()"
                                                                                                    onkeypress="toggle_data_valid()"
                                                                                                    onkeyup="toggle_data_valid()" value="">
                                                                                        </td>
                                                                                        <td valign="top" align="left" width="120px">
                                                                                            Tanggal&nbsp;Penetapan
                                                                                        </td>
                                                                                        <!-- Tanggal Ketetapan -->
                                                                                        <td valign="top" align="left" >
                                                                                            <input type="text" name="id_tgl_tap" id="id_tgl_tap"
                                                                                                    style="width:120px; text-align: center" disabled
                                                                                                    datepicker="true" datepicker_format=""
                                                                                                    onclick="toggle_data_valid()"
                                                                                                    onchange="toggle_data_valid()"
                                                                                                    onkeydown="toggle_data_valid()"
                                                                                                    onkeypress="toggle_data_valid()"
                                                                                                    onkeyup="toggle_data_valid()" value="28/05/2012" >
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <!-- Nomor BASP -->
                                                                                        <td valign="top" align="left" width="120px">
                                                                                            Nomor&nbsp;BAST
                                                                                        </td>
                                                                                        <td valign="top" align="left" >
                                                                                            <input type="text" name="id_no_basp" id="id_no_basp" disabled
                                                                                                    style="width:180px;"
                                                                                                    onchange="toggle_data_valid()"
                                                                                                    onkeydown="toggle_data_valid()"
                                                                                                    onkeypress="toggle_data_valid()"
                                                                                                    onkeyup="toggle_data_valid()" value="">
                                                                                        </td>
                                                                                        <td valign="top" align="left" width="120px">
                                                                                            Tanggal&nbsp;BAST
                                                                                        </td>
                                                                                        <!-- Tanggal BASP -->
                                                                                        <td valign="top" align="left" >
                                                                                            <input type="text" name="id_tgl_basp" id="id_tgl_basp" disabled
                                                                                                    style="width:120px; text-align: center"
                                                                                                    datepicker="true" datepicker_format=""
                                                                                                    onclick="toggle_data_valid()"
                                                                                                    onchange="toggle_data_valid()"
                                                                                                    onkeydown="toggle_data_valid()"
                                                                                                    onkeypress="toggle_data_valid()"
                                                                                                    onkeyup="toggle_data_valid()" value="28/05/2012">
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td valign="top" align="left">
                                                                                            Lokasi&nbsp;Serah&nbsp;Terima
                                                                                        </td>
                                                                                        <td valign="top" align="left" colspan="3"><input type="text" name="id_lokasi_basp" id="id_lokasi_basp"
                                                                                                        disabled style="width:490px"
                                                                                                        onclick="toggle_data_valid()"
                                                                                                        onchange="toggle_data_valid()"
                                                                                                        onkeydown="toggle_data_valid()"
                                                                                                        onkeypress="toggle_data_valid()"
                                                                                                        onkeyup="toggle_data_valid()" value="">
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td valign="top" align="left">
                                                                                            Tipe Pemindahtanganan
                                                                                        </td>
                                                                                        <td valign="top" align="left" colspan="3">
                                                                                            <select name="id_tipe" id="id_tipe" disabled
                                                                                                    style="width:490px"
                                                                                                    onclick="toggle_data_valid()"
                                                                                                    onchange="toggle_data_valid()"
                                                                                                    onkeydown="toggle_data_valid()"
                                                                                                    onkeypress="toggle_data_valid()"
                                                                                                    onkeyup="toggle_data_valid()">
                                                                                                <option value="">-</option>
                                                                                                <option value="pjl" >Penjualan</option>
                                                                                                <option value="tkr" >Tukar Menukar</option>
                                                                                                <option value="hbh" >Hibah</option>
                                                                                                <option value="mdl" >Penyertaan Modal</option>
                                                                                            </select>
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td valign="top" align="left">
                                                                                            Peruntukan
                                                                                        </td>
                                                                                        <td valign="top" align="left" colspan="3">
                                                                                            <select name="id_untuk" id="id_untuk" disabled
                                                                                                    style="width:490px"
                                                                                                    onclick="toggle_data_valid()"
                                                                                                    onchange="toggle_data_valid()"
                                                                                                    onkeydown="toggle_data_valid()"
                                                                                                    onkeypress="toggle_data_valid()"
                                                                                                    onkeyup="toggle_data_valid()">
                                                                                                <option value="">-</option>
                                                                                                <option value="00" >Kementerian/Lembaga</option>
                                                                                                <option value="11" >Pemerintah Provinsi</option>
                                                                                                <option value="12" >Pemerintah Kabupaten/Kota</option>
                                                                                                <option value="99" >Yayasan/Masyarakat</option>
                                                                                            </select><br>Alamat Pihak Kedua :
                                                                                            <br>
                                                                                            <textarea name="id_dtl_untuk" id="id_dtl_untuk"
                                                                                                        disabled style="width:490px"
                                                                                                        onclick="toggle_data_valid()"
                                                                                                        onchange="toggle_data_valid()"
                                                                                                        onkeydown="toggle_data_valid()"
                                                                                                        onkeypress="toggle_data_valid()"
                                                                                                        onkeyup="toggle_data_valid()">
                                                                                             </textarea>
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td colspan="4">&nbsp;</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td width="50%" valign="top" align="left" colspan="2">
                                                                                            <b>Pihak Pertama</b>
                                                                                        </td>
                                                                                        <td valign="top" align="left" colspan="2">

                                                                                            <b>Pihak Kedua</b>
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                    <td valign="top" align="left" colspan="2">
                                                                                        <!-- Pihak Pertama -->
                                                                                        <table width="100%">
                                                                                            <tr>
                                                                                                <!-- Nama -->
                                                                                                <td width="95px" valign="top" align="left">
                                                                                                    Nama
                                                                                                </td>
                                                                                                <td width="*" valign="top" align="left"><input type="text" style="width:95%;" disabled
                                                                                                        name="id_nama_1" id="id_nama_1" value=""
                                                                                                        onchange="toggle_data_valid()"
                                                                                                        onkeydown="toggle_data_valid()"
                                                                                                        onkeypress="toggle_data_valid()"
                                                                                                        onkeyup="toggle_data_valid()">
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <!-- Jabatan -->
                                                                                                <td width="*" valign="top" align="left">
                                                                                                    Jabatan
                                                                                                </td>
                                                                                                <td valign="top" align="left"><input type="text" style="width:95%;" disabled
                                                                                                        name="id_jabatan_1" id="id_jabatan_1" value=""
                                                                                                        onchange="toggle_data_valid()"
                                                                                                        onkeydown="toggle_data_valid()"
                                                                                                        onkeypress="toggle_data_valid()"
                                                                                                        onkeyup="toggle_data_valid()">
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <!-- NIP -->
                                                                                                <td width="*" valign="top" align="left">
                                                                                                    NIP
                                                                                                </td>
                                                                                                <td valign="top" align="left"><input type="text" style="width:95%;" disabled
                                                                                                        name="id_nip_1" id="id_nip_1" value=""
                                                                                                        onchange="toggle_data_valid()"
                                                                                                        onkeydown="toggle_data_valid()"
                                                                                                        onkeypress="toggle_data_valid()"
                                                                                                        onkeyup="toggle_data_valid()">
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <!-- Lokasi -->
                                                                                                <td width="*" valign="top" align="left">
                                                                                                    Lokasi
                                                                                                </td>
                                                                                                <td valign="top" align="left"><input type="text" style="width:95%;" disabled
                                                                                                        name="id_lokasi_1" id="id_lokasi_1" value=""
                                                                                                        onchange="toggle_data_valid()"
                                                                                                        onkeydown="toggle_data_valid()"
                                                                                                        onkeypress="toggle_data_valid()"
                                                                                                        onkeyup="toggle_data_valid()">
                                                                                                </td>
                                                                                            </tr>
                                                                                        </table>
                                                                                    </td>
                                                                                    <td valign="top" align="left" colspan="2">
                                                                                        <!-- Pihak Kedua -->
                                                                                        <table width="100%">
                                                                                            <tr>
                                                                                                <!-- Nama -->
                                                                                                <td width="95px" valign="top" align="left">
                                                                                                    Nama
                                                                                                </td>
                                                                                                <td valign="top" align="left">
                                                                                                    <input type="text" style="width:95%;" disabled
                                                                                                        name="id_nama_2" id="id_nama_2" value=""
                                                                                                        onchange="toggle_data_valid()"
                                                                                                        onkeydown="toggle_data_valid()"
                                                                                                        onkeypress="toggle_data_valid()"
                                                                                                        onkeyup="toggle_data_valid()">
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <!-- Jabatan -->
                                                                                                <td width="*" valign="top" align="left">
                                                                                                    Jabatan
                                                                                                </td>
                                                                                                <td valign="top" align="left">
                                                                                                    <input type="text" style="width:95%;" disabled
                                                                                                        name="id_jabatan_2" id="id_jabatan_2" value=""
                                                                                                        onchange="toggle_data_valid()"
                                                                                                        onkeydown="toggle_data_valid()"
                                                                                                        onkeypress="toggle_data_valid()"
                                                                                                        onkeyup="toggle_data_valid()">
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <!-- NIP -->
                                                                                                <td width="*" valign="top" align="left">
                                                                                                    NIP
                                                                                                </td>
                                                                                                <td valign="top" align="left"><input type="text" style="width:95%;" disabled
                                                                                                        name="id_nip_2" id="id_nip_2" value=""
                                                                                                        onchange="toggle_data_valid()"
                                                                                                        onkeydown="toggle_data_valid()"
                                                                                                        onkeypress="toggle_data_valid()"
                                                                                                        onkeyup="toggle_data_valid()">
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <!-- Lokasi -->
                                                                                                <td width="*" valign="top" align="left">
                                                                                                    Lokasi
                                                                                                </td>
                                                                                                <td valign="top" align="left"><input type="text" style="width:95%;" disabled
                                                                                                        name="id_lokasi_2" id="id_lokasi_2" value=""
                                                                                                        onchange="toggle_data_valid()"
                                                                                                        onkeydown="toggle_data_valid()"
                                                                                                        onkeypress="toggle_data_valid()"
                                                                                                        onkeyup="toggle_data_valid()">
                                                                                                </td>
                                                                                            </tr>
                                                                                        </table>
                                                                                    </td>
                                                                                </tr>
                                                                                    <tr>
                                                                                        <td colspan="4">&nbsp;</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <th colspan="4" align="center">
                                                                                        <input type="button" name="btn_action" id="btn_action" value="Pemindahtanganan" onclick="document.location='tampil_penetapan_pemindahtanganan.php';">
                                                                                        <input type="button" name="btn_action" id="btn_action_cancel"  style="width:100px;"  value="Batal"
                                                                                                onclick="document.location='tambah_penetapan_pemindahtanganan.php';">

                                                                                        </th>
                                                                                    </tr>
                                                                                </table>
                                                                            <br>
                                                                                <table class="listdata" width="100%" border="1" cellpadding="0" cellspacing="0" style="padding:2px; margin-top:0px; border: 1px solid #cccccc; border-width: 1px 1px 1px 1px;">
                                                                                    <tr>
                                                                                        <th align="center" width="40px" >No</th>
                                                                                        <th align="center" width="170px" >Nomor Pemindahtanganan</th>
                                                                                        <th align="center" width="150px" >Tgl Pemindahtanganan</th>
                                                                                        <th align="center" width="%" >Lokasi Pemindahtanganan</th>
                                                                                        <th align="center" width="85px">Tindakan</th>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <th align="center" width="40px" >1.</th>
                                                                                        <th align="center" width="170px" >9.02.23.1.XX.1</th>
                                                                                        <th align="center" width="150px" >2012-05-08</th>
                                                                                        <th align="center" width="%" >ORAHILI SOMOLO-MOLO </th>
                                                                                        <th align="center" width="85px"><a href="doc.df" class="detail_link" target="_blank">Cetak</a></th>
                                                                                    </tr>
                                                                                </table>
                                                                            </div>
                                                                    </div>
                                                                    <script type="text/javascript" language="javascript">
                                                                        toggle_data_valid();
                                                                    </script>    
                                                                    <table width="100%" style="border:0px; padding:0px;" cellpadding="0" cellspacing="0">
                                                                        <tr>
                                                                            <td width="*" style="border: 1px solid #cccccc; border-width: 1px 0px 0px 0px; padding: 2px 4px 2px 4px;">
                                                                                &nbsp;
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                    <table width="100%" style="border:0px; padding:0px;" cellpadding="0" cellspacing="0">
                                                                        <tr>
                                                                            <td width="*" style="border: 1px solid #cccccc; border-width: 1px 0px 0px 0px; padding: 2px 4px 2px 4px;">
                                                                                &nbsp;
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                            </div>
                                                    </div>
                                            </div>
                         <?php
                            include"$path/footer.php";
                        ?>
</body>
</html>	
	
